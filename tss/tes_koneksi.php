<?php
require("koneksi.php");

if ($koneksi) {
    echo "Koneksi ke database berhasil!";
} else {
    echo "Koneksi ke database gagal: " . mysqli_connect_error();
}
?>
