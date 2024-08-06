<?php
session_start();

// Inisialisasi variabel $logged_in
$logged_in = false;

// Periksa apakah pengguna sudah login
if (isset($_SESSION['username'])) {
    $logged_in = true;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lalu Lintas Dishub Fakfak</title>
    <link rel="icon" href="images/logo.png" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <header class="container-fluid bg-dark text-light py-3">
        <div class="container d-flex align-items-center justify-content-between">
            <a href="index.php" class="text-light text-decoration-none fs-4">
                <img src="images/logo.png" alt="Logo" height="50" class="me-2">
                Lalu-Lintas Dinas Perhubungan Fakfak
            </a>
            <nav class="nav">
                <a class="nav-link text-light" href="index.php">Beranda</a>
                <a class="nav-link text-light" href="tentang_atcs.php">Tentang ATCS</a>
                <a class="nav-link text-light" href="layanan.php">Layanan</a>
                <a class="nav-link text-light" href="kontak.php">Kontak</a>
                <a class="nav-link text-light" href="../index.php">Home</a>
            </nav>
        </div>
    </header>
    <div class="container mt-5">