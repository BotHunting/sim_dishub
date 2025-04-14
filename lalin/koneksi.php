<?php
// Include konfigurasi dari config.php
require_once __DIR__ . '/../config.php';

// Konfigurasi koneksi ke database
$host = DB_HOST;
$username = DB_USER;
$password = DB_PASS;
$database = DB_NAME;

// Membuat koneksi ke database
$conn = new mysqli($host, $username, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Set charset
$conn->set_charset("utf8");

// Fungsi sanitasi input
function bersihkanInput($data) {
    global $conn;
    return mysqli_real_escape_string($conn, stripslashes(htmlspecialchars(trim($data))));
}
