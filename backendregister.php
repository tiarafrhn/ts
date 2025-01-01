<?php
require("koneksi.php");

if ($_SERVER["REQUEST_METHOD"]=="POST") {
    $email = $_POST['temail'];
    $nama = $_POST['tnama'];
    $pwd = $_POST['tpwd'];
    $role = $_POST['trole'];

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    $stmt = $koneksi->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
        $stmt = $koneksi->prepare("INSERT INTO users (email, nama, pwd, role) VALUES (?, ?, ?,?)");
        $stmt->bind_param("ssss", $email, $nama, $hashedPwd, $role);

         if ($stmt->execute()) {
            echo "
                <script>
                    alert('akun telah terdaftar');
                    document.location.href='/ts/login.php';
                </script>
            ";
         } else
            echo "
                <script>
                    alert('terjadi kesalahan saat mendaftar');
                    document.location.href='/ts/register.php';
                </script>
            ";

        //     echo json_encode([
        //         "success" => true,
        //         "message" => "Akun telah terdaftar!"
        //     ]);
        // } else {
        //     echo json_encode([
        //         "success" => false,
        //         "message" => "Terjadi kesalahan saat mendaftar!"
        //     ]);
        // }

        $stmt->close();
    }
?>