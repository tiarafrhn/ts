<?php
include('koneksi.php');
// session_start();

// var_dump($_SESSION); // Untuk memeriksa semua data session
// die();

// // Memeriksa apakah user sudah login
// if (!isset($_SESSION['login'])) {
//     die("Error: User is not logged in.");
// }

// $user_email = $_SESSION['login']; // Mengambil email dari session

// Memeriksa apakah form telah disubmit

// echo $_POST['temail'];
// echo $_POST['tpwd'];
if ($_SERVER["REQUEST_METHOD"]=="POST") {
    // Validasi input wajib
    $subject = $_POST['subject'];
    $product = $_POST['product'];
    $module = $_POST['module'];
    $priority = $_POST['priority'];
    $description = $_POST['description'];
    $file_content = null; // Set default file_content to null

    // Membuat id tiket unik
    $id_tiket = 'TKT' . str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);

    // Menangani file file_content
    if (isset($_FILES['file_content']) && $_FILES['file_content']['error'] == 0) {
        $file_name = $_FILES['file_content']['name'];
        $file_tmp = $_FILES['file_content']['tmp_name'];
        
        echo $file_name;
        // Tentukan direktori untuk menyimpan file
        $upload_dir = $_SERVER['DOCUMENT_ROOT'].'/ts/upload/';
        
        // Buat direktori jika belum ada
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $file_path = $upload_dir . basename($file_name);

        // Cek apakah file berhasil dipindahkan
        if (move_uploaded_file($file_tmp, $file_path)) {
            // Jika upload berhasil, simpan path file
            $file_content = $file_path;
        } else {
            die("Error: Failed to move uploaded file.");
        }
    } else {
        // Jika tidak ada file upload atau terjadi error
        die("Error during file upload: " . $_FILES['file_content']['error']);
    }

    // Menyimpan data ke dalam tabel tickets
    $sql = "INSERT INTO tickets (id_tiket, subject, product, module, priority, description, attachment, date_created, created_by)
            VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), ?)";

    // Persiapkan statement
    $stmt = $koneksi->prepare($sql);

    if ($stmt) {
        // Ikat parameter
        $stmt->bind_param("ssssssss", $id_tiket, $subject, $product, $module, $priority, $description, $file_content, $user_email);

        // Eksekusi query
        if ($stmt->execute()) {
            echo "
                <script>
                    alert('Tiket berhasil dibuat!');
                    document.location.href = '/ts/db_user_regis.html';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Tiket gagal dibuat, isi semua field!');
                    document.location.href = '/ts/create_tiket.html';
                </script>
            ";
        }

        // Tutup statement
        $stmt->close();
    } else {
        echo "Error in SQL statement: " . $koneksi->error;
    }

    // Tutup koneksi
    $koneksi->close();
}
?>
