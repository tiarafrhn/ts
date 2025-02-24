<?php
session_start();
require("koneksi.php");

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

$response = ["success" => false, "message" => ""];

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    $response["message"] = "Metode request tidak diizinkan.";
    echo json_encode($response);
    exit();
}

if (!isset($_SESSION['userEmail'])) {
    $response["message"] = "User tidak terautentikasi.";
    echo json_encode($response);
    exit();
}

$input = $_POST;

$required_fields = ["subject", "product", "module", "priority", "description"];
foreach ($required_fields as $field) {
    if (empty($input[$field])) {
        $response["message"] = "Field $field harus diisi!";
        echo json_encode($response);
        exit();
    }
}

$userEmail = $_SESSION['userEmail'];
$created_by = $_SESSION['userName'];

$subject = trim($input['subject']);
$product = trim($input['product']);
$module = trim($input['module']);
$priority = trim($input['priority']);
$description = trim($input['description']);
$file_content = "";

// File Upload Handling
if (!empty($_FILES['file_content']['name'])) {
    $file_name = basename($_FILES['file_content']['name']);
    $file_tmp = $_FILES['file_content']['tmp_name'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $allowed_ext = ["jpg", "jpeg", "png"];
    $max_size = 2 * 1024 * 1024; // 2MB

    if (!in_array($file_ext, $allowed_ext) || $_FILES['file_content']['size'] > $max_size) {
        $response["message"] = "File tidak valid atau terlalu besar (Max 2MB, JPG/PNG)!";
        echo json_encode($response);
        exit();
    }

    $upload_dir = _DIR_ . '/uploads/';
    if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);
    $file_content = time() . "_" . uniqid() . "." . $file_ext;
    move_uploaded_file($file_tmp, $upload_dir . $file_content);
}

// Generate ID Tiket
$query = "SELECT id_tiket FROM tickets ORDER BY id_tiket DESC LIMIT 1";
$result = $koneksi->query($query);
$new_id = $result && $result->num_rows > 0 ? 'TKT' . str_pad(intval(substr($result->fetch_assoc()['id_tiket'], 3)) + 1, 3, '0', STR_PAD_LEFT) : 'TKT001';

$stmt = $koneksi->prepare("INSERT INTO tickets (id_tiket, subject, product, module, priority, description, attachment, created_by, date_created) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");
$stmt->bind_param("ssssssss", $new_id, $subject, $product, $module, $priority, $description, $file_content, $created_by);

if ($stmt->execute()) {
    $response["success"] = true;
    $response["message"] = "Tiket berhasil dibuat!";
    $response["data"] = ["id_tiket" => $new_id, "subject" => $subject, "created_by" => $created_by];
} else {
    $response["message"] = "Gagal menyimpan tiket!";
}

$stmt->close();
$koneksi->close();

echo json_encode($response);
?>