<?php
require("koneksi.php"); // Pastikan koneksi berhasil

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

$response = ["success" => false, "message" => ""];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Pastikan input JSON dapat dibaca
    $input = json_decode(file_get_contents("php://input"), true);
    if (!$input) {
        $input = $_POST;
    }

    // Validasi input wajib
    $required_fields = ["subject", "product", "module", "priority", "description"];
    foreach ($required_fields as $field) {
        if (empty($input[$field])) {
            $response["message"] = "Field $field harus diisi!";
            echo json_encode($response);
            exit();
        }
    }

    // Menghindari SQL Injection dengan trim
    $subject = trim($input['subject']);
    $product = trim($input['product']);
    $module = trim($input['module']);
    $priority = trim($input['priority']);
    $description = trim($input['description']);

    $file_content = null;

    // Menangani file upload
    if (isset($_FILES['file_content']) && $_FILES['file_content']['error'] === 0) {
        $file_name = basename($_FILES['file_content']['name']);
        $file_tmp = $_FILES['file_content']['tmp_name'];
        $file_size = $_FILES['file_content']['size'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_ext = ["jpg", "jpeg", "png"];
        $max_size = 2 * 1024 * 1024; // 2MB

        if (!in_array($file_ext, $allowed_ext)) {
            $response["message"] = "Format file tidak valid! Harus JPG atau PNG.";
            echo json_encode($response);
            exit();
        }

        if ($file_size > $max_size) {
            $response["message"] = "Ukuran file terlalu besar! Maksimum 2MB.";
            echo json_encode($response);
            exit();
        }

        // Direktori penyimpanan
        $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/ts/upload/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // Pastikan nama file unik
        $file_content = time() . "_" . uniqid() . "." . $file_ext;
        $file_path = $upload_dir . $file_content;

        if (!move_uploaded_file($file_tmp, $file_path)) {
            $response["message"] = "Gagal mengunggah file.";
            echo json_encode($response);
            exit();
        }
    }

    // Membuat ID tiket unik (kombinasi timestamp + random)
    $id_tiket = 'TKT' . date("YmdHis") . rand(100, 999);

    // Menyimpan data ke database dengan prepared statement
    $stmt = $koneksi->prepare("INSERT INTO tickets (id_tiket, subject, product, module, priority, description, attachment, date_created) 
                               VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
    if ($stmt) {
        $stmt->bind_param("ssssssss", $id_tiket, $subject, $product, $module, $priority, $description, $file_content);
        if ($stmt->execute()) {
            $response["success"] = true;
            $response["message"] = "Tiket berhasil dibuat!";
            $response["data"] = [
                "id_tiket" => $id_tiket,
                "subject" => $subject,

            ];
        } else {
            $response["message"] = "Gagal menyimpan tiket. Silakan coba lagi!";
        }
        $stmt->close();
    } else {
        $response["message"] = "Kesalahan SQL: " . $koneksi->error;
    }

    $koneksi->close();
} else {
    $response["message"] = "Metode request tidak diizinkan.";
}

echo json_encode($response);
exit();
