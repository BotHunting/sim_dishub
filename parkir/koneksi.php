<?php
require_once '../config.php'; // Menggunakan sambungan SQL dari config.php

// Membuat koneksi ke database
$koneksi = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Memeriksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Set encoding UTF-8 untuk koneksi
$koneksi->set_charset("utf8");
