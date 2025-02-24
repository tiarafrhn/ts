<?php
include('koneksi.php');
session_start();

if (!isset($_SESSION['login'])) {
    die("Error: Pengguna belum login."); // Jika belum login, tampilkan pesan error
}

// Mendapatkan email pengguna yang sudah login dari sesi
$user_email = $_SESSION['login'];

// Menyusun query untuk mengambil tiket berdasarkan email pengguna yang sedang login
$sql = "SELECT * FROM tickets WHERE user_email = ? ORDER BY date_created DESC";

// Menyiapkan statement SQL untuk mencegah SQL injection
$stmt = $koneksi->prepare($sql);

if ($stmt) {
    // Mengikat parameter (email pengguna) ke dalam statement SQL
    $stmt->bind_param("s", $user_email);

    // Menjalankan query
    $stmt->execute();
    
    // Mengambil hasil dari query
    $result = $stmt->get_result();

    // Membuat array untuk menyimpan data tiket
    $tickets = [];
    while ($row = $result->fetch_assoc()) {
        $tickets[] = $row; // Menambahkan setiap tiket ke dalam array
    }

    // Menutup statement setelah digunakan
    $stmt->close();
} else {
    // Menampilkan pesan error jika query gagal
    echo "Error: " . $koneksi->error;
}

// Menutup koneksi ke database
$koneksi->close();

// Mengembalikan data tiket dalam format JSON sebagai respons
echo json_encode($tickets);
?>
