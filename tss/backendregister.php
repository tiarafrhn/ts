<?php
require("koneksi.php");

if ($koneksi) {
    echo "Koneksi ke database berhasil!";
} else {
    echo "Koneksi ke database gagal: " . mysqli_connect_error();
}

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['temail']);
    $nama = trim($_POST['tnama']);
    $pwd = trim($_POST['tpwd']);
    $role = trim($_POST['trole']);

    // Validasi input
    if (empty($email) || empty($nama) || empty($pwd) || empty($role)) {
        echo json_encode([
            "success" => false,
            "message" => "Semua field harus diisi!"
        ]);
        exit();
    }

    // Periksa apakah email sudah terdaftar
    $stmt = $koneksi->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Email sudah terdaftar
        echo json_encode([
            "success" => false,
            "message" => "Email sudah digunakan. Silakan gunakan email lain."
        ]);
        exit();
    }

    // Jika email belum terdaftar, tambahkan user baru
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    $stmt = $koneksi->prepare("INSERT INTO users (email, nama, pwd, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $email, $nama, $hashedPwd, $role);

    if ($stmt->execute()) {
        echo json_encode([
            "success" => true,
            "message" => "Akun telah berhasil terdaftar!"
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Terjadi kesalahan saat mendaftar. Silakan coba lagi."
        ]);
    }

    // Tutup statement dan koneksi
    $stmt->close();
    $koneksi->close();
} 
else {
    // Jika bukan metode POST
    http_response_code(405); // Metode tidak diizinkan
    echo json_encode([
        "success" => false,
        "message" => "Metode request tidak diizinkan."
    ]);
    exit();
}
?>
