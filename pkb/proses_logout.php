<?php
session_start(); // Memulai sesi
session_unset(); // Menghapus semua data sesi
session_destroy(); // Menghancurkan sesi

// Redirect ke halaman login
header("Location: login.php");
exit();
?>
