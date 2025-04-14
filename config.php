<?php
define('DB_HOST', 'localhost'); // Host database
define('DB_USER', 'root'); // Nama pengguna database
define('DB_PASS', ''); // Kata sandi database
define('DB_NAME', 'dishub_sim'); // Nama database

// Konfigurasi koneksi ke database
$db_host = DB_HOST; // Host database (biasanya 'localhost')
$db_username = DB_USER; // Nama pengguna database
$db_password = DB_PASS; // Kata sandi database
$db_database = DB_NAME; // Nama database

// Buat koneksi baru
$koneksi = new mysqli($db_host, $db_username, $db_password, $db_database);

// Periksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi ke database gagal: " . $koneksi->connect_error);
}
