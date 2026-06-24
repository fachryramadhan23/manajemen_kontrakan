<?php
$host     = "localhost";
$user     = "root";
$password = "root"; // Password default MAMP
$database = "db_kontrakan";

$koneksi = mysqli_connect($host, $user, $password, $database);

// Cek apakah koneksi berhasil
if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>