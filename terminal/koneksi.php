<?php
// Include koneksi ke database
require_once __DIR__ . '/../config.php';

// Konfigurasi koneksi ke database
$host = DB_HOST; // Host database (diambil dari config.php)
$username = DB_USER; // Nama pengguna database (diambil dari config.php)
$password = DB_PASS; // Kata sandi database (diambil dari config.php)
$database = DB_NAME; // Nama database (diambil dari config.php)

// Membuat koneksi ke database
$koneksi = new mysqli($host, $username, $password, $database);

// Memeriksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Set encoding UTF-8 untuk koneksi
$koneksi->set_charset("utf8");

// Fungsi untuk membersihkan input
function bersihkanInput($data)
{
    global $koneksi;
    return mysqli_real_escape_string($koneksi, stripslashes(htmlspecialchars(trim($data))));
}
