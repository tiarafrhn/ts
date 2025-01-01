<?php
session_start();
require("koneksi.php");

if (isset($_POST['blogin'])) {
    $email = trim($_POST['temail']);
    $pwd = trim($_POST['tpwd']);

    $stmt = $koneksi->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $email); 
    $stmt->execute();
    $result = $stmt->get_result();
    $isCanLogin = mysqli_num_rows($result);

    if ($isCanLogin === 1) {
        $row = $result->fetch_assoc();

        // Periksa apakah password cocok
        if (password_verify($pwd, $row['pwd'])) {
            $_SESSION['login'] = $row['email'];
            $_SESSION['role'] = $row['role'];  // Menyimpan role pengguna
            $_SESSION['nama'] = $row['nama'];  // Menyimpan nama pengguna (asumsi kolom 'nama' ada di tabel 'users')

            // // Bersihkan nilai role
            // $role = trim($row['role']);

            // Arahkan ke dashboard sesuai peran
            switch ($row['role']) {
                case 'admin':
                    echo "
                        <script>
                            alert('Login berhasil! Selamat datang Admin.');
                            document.location.href = '/ts/db_admin.php';
                        </script>
                    ";
                    break;
                case 'timIT':
                    echo "
                        <script>
                            alert('Login berhasil! Selamat datang Tim IT.');
                            document.location.href = '/ts/db_it.php';
                        </script>
                    ";
                    break;
                case 'user':
                default:
                    echo "
                        <script>
                            alert('Login berhasil! Selamat datang, " . htmlspecialchars($row['nama']) . "!');
                            document.location.href = '/ts/db_user_regis.php';
                        </script>
                    ";
                    break;
            }
        } else {
            echo "
                <script>
                    alert('Email atau kata sandi tidak sesuai. Coba lagi!');
                    document.location.href = '/ts/login.php';
                </script>
            ";
        }
    } else {
        echo "
            <script>
                alert('Email tidak ditemukan! Periksa kembali alamat email yang Anda masukkan.');
                document.location.href = '/ts/login.php';
            </script>
        ";
    }

    // Menutup prepared statement
    $stmt->close();

    // Menutup koneksi ke database
    mysqli_close($koneksi);
}
?>
