<?php
session_start();
require("koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['temail']);
    $pwd = trim($_POST['tpwd']);

    // Prepared statement untuk mencegah SQL injection
    $stmt = $koneksi->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($pwd, $row['pwd'])) {
            // Simpan data ke session
            $_SESSION['login'] = $row['email'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['nama'] = $row['nama'];

            // Arahkan ke dashboard sesuai peran
            switch ($row['role']) {
                case 'admin':
                    header('Location: /ts/db_admin.php');
                    exit();
                case 'timIT':
                    header('Location: /ts/db_it.php');
                    exit();
                case 'user':
                default:
                    header('Location: /ts/db_user_regis.php');
                    exit();
            }
        } else {
            // Password tidak sesuai
            $_SESSION['error'] = 'Email atau kata sandi tidak sesuai. Coba lagi!';
            header('Location: /ts/login.php');
            exit();
        }
    } else {
        // Email tidak ditemukan
        $_SESSION['error'] = 'Email tidak ditemukan! Periksa kembali alamat email yang Anda masukkan.';
        header('Location: /ts/login.php');
        exit();
    }

    // Tutup prepared statement
    $stmt->close();

    // Tutup koneksi ke database
    $koneksi->close();
}
?>
