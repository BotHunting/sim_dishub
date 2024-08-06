<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dishub_sim";

// Membuat koneksi
$koneksi = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
?>
