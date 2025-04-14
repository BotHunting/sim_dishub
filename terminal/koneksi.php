<?php
require_once '../config.php'; // Menggunakan sambungan SQL dari config.php

// Membuat koneksi ke database
$koneksi = new mysqli($db_host, $db_username, $db_password, $db_database);

// Memeriksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Set encoding UTF-8 untuk koneksi
$koneksi->set_charset("utf8");
