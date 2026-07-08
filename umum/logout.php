<?php
session_start(); // Memulai session
require_once __DIR__ . '/../assets/config.php';
session_unset(); // Menghapus semua variabel session
session_destroy(); // Menghancurkan session
header("Location: index.php"); // Redirect kembali ke halaman utama
exit();
