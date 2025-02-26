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

$input = $_POST;

$subject = trim($input['subject']);
$product = trim($input['product']);
$module = trim($input['module']);
$priority = trim($input['priority']);
$description = trim($input['description']);
$created_by = trim($input['created_by']);
$file_content = "";

$file_name = $_FILES["attachment"]["name"];
$file_tmp = $_FILES["attachment"]["tmp_name"];

$file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
$upload_dir = $_SERVER["DOCUMENT_ROOT"] . "/upload/" . time() . "_" . uniqid() . "." . $file_ext;
move_uploaded_file($file_tmp, $upload_dir);

// Generate ID Tiket
$query = "SELECT id_tiket FROM tickets ORDER BY id_tiket DESC LIMIT 1";
$result = $koneksi->query($query);
$new_id = $result && $result->num_rows > 0 ? 'TKT' . str_pad(intval(substr($result->fetch_assoc()['id_tiket'], 3)) + 1, 3, '0', STR_PAD_LEFT) : 'TKT001';

$stmt = $koneksi->prepare("INSERT INTO tickets (id_tiket, subject, product, module, priority, description, attachment, created_by, date_created) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");
$stmt->bind_param("ssssssss", $new_id, $subject, $product, $module, $priority, $description, $upload_dir, $created_by);

if ($stmt->execute()) {
    $response["success"] = true;
    $response["message"] = "Tiket berhasil dibuat!" . $file_content;
    $response["data"] = ["id_tiket" => $new_id, "subject" => $subject, "created_by" => $created_by];
} else {
    $response["message"] = "Gagal menyimpan tiket!";
}

$stmt->close();
$koneksi->close();

echo json_encode($response);
?>