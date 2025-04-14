<?php
// Konfigurasi database freesqldatabase.com
define('DB_HOST', 'sql12.freesqldatabase.com');   // Host database
define('DB_USER', 'sql12772394');                // User database
define('DB_PASS', 'rjALslf1bV');                  // Password database
define('DB_NAME', 'sql12772394');                 // Nama database
define('DB_PORT', 3306);                          // Port (default MySQL 3306)

// Buat koneksi baru dengan port
$koneksi = new mysqli(
    DB_HOST,
    DB_USER,
    DB_PASS,
    DB_NAME,
    DB_PORT
);

// Periksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi ke database gagal: " . $koneksi->connect_error);
}
