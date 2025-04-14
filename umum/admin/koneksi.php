<?php
// Menggunakan sambungan SQL dari config.php
require_once __DIR__ . '/../../config.php';

// Fungsi untuk membersihkan input dari potensi SQL Injection
function bersihkanInput($input)
{
    global $koneksi;
    return mysqli_real_escape_string($koneksi, htmlspecialchars($input));
}
