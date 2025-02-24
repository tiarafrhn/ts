<?php
require("koneksi.php");  // Pastikan koneksi berhasil
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Ambil data dari body request (mendukung JSON & Form-Data)
    $input = json_decode(file_get_contents("php://input"), true);
    
    // Jika menggunakan Form-Data, gunakan $_POST
    if (!$input) {
        $input = $_POST;
    }

    // Validasi input
    if (empty($input['temail']) || empty($input['tnama']) || empty($input['tpwd']) || empty($input['trole'])) {
        echo json_encode(["success" => false, "message" => "Semua field harus diisi!"]);
        exit();
    }

    $email = filter_var(trim($input['temail']), FILTER_SANITIZE_EMAIL);
    $nama = filter_var(trim($input['tnama']), FILTER_SANITIZE_STRING);
    $pwd = trim($input['tpwd']);
    $role = filter_var(trim($input['trole']), FILTER_SANITIZE_STRING);

    // Validasi format email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["success" => false, "message" => "Format email tidak valid!"]);
        exit();
    }

    // Cek apakah email sudah terdaftar
    $stmt = $koneksi->prepare("SELECT email FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo json_encode(["success" => false, "message" => "Email sudah digunakan. Silakan gunakan email lain."]);
        $stmt->close();
        $koneksi->close();
        exit();
    }
    $stmt->close();

    // Hash password untuk keamanan
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    // Masukkan data user ke database
    $stmt = $koneksi->prepare("INSERT INTO users (email, nama, pwd, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $email, $nama, $hashedPwd, $role);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Akun berhasil didaftarkan!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Terjadi kesalahan saat mendaftar. Silakan coba lagi."]);
    }

    // Tutup statement dan koneksi
    $stmt->close();
    $koneksi->close();
} else {
    echo json_encode(["success" => false, "message" => "Metode request tidak diizinkan."]);
}
