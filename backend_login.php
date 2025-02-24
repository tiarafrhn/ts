<?php
session_start();

require("koneksi.php"); // Pastikan koneksi berhasil
header('Content-Type: application/json');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Origin: http://localhost:8081");
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
    if (empty($input['temail']) || empty($input['tpwd'])) {
        echo json_encode(["success" => false, "message" => "Email dan password harus diisi!"]);
        exit();
    }

    $email = filter_var(trim($input['temail']), FILTER_SANITIZE_EMAIL);
    $pwd = trim($input['tpwd']);

    // Validasi format email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["success" => false, "message" => "Format email tidak valid!"]);
        exit();
    }

    // Cek apakah email terdaftar
    $stmt = $koneksi->prepare("SELECT email, nama, pwd, role FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        if (password_verify($pwd, $row['pwd'])) {
            echo json_encode([
                "success" => true,
                "message" => "Login berhasil!",
                "data" => [
                    "email" => $row['email'],
                    "nama" => $row['nama'],
                    "role" => $row['role']
                ]
            ]);
        } else {
            echo json_encode(["success" => false, "message" => "Email atau kata sandi tidak sesuai."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Email tidak ditemukan."]);
    }

    $stmt->close();
    $koneksi->close();
} else {
    echo json_encode(["success" => false, "message" => "Metode request tidak diizinkan."]);
}