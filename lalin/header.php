<?php
// Mulai sesi jika belum aktif
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '../../assets/config.php'; // Mengimpor koneksi database dari root/assets/

// Periksa apakah pengguna sudah login
$logged_in = isset($_SESSION['username']);
$role = $logged_in ? ($_SESSION['role'] ?? '') : ''; // Ambil role dari session jika ada
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" >
    <title>ATCS - Dishub Fakfak</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../assets/img/favicon.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="../assets/css/main.css" rel="stylesheet">
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <!-- Logo -->
            <a href="index.php" class="logo d-flex align-items-center me-auto">
                <h1 class="sitename">ATCS Dishub Fakfak</h1>
            </a>

            <!-- Navigasi -->
            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="index.php" class="active">Beranda</a></li>
                    <li><a href="live.php">Live CCTV</a></li>
                    <li><a href="layanan.php">Layanan</a></li>
                    <li><a href="kontak.php">Kontak</a></li>
                </ul>
            </nav><!-- End Navigasi -->

            <!-- Tombol Kembali -->
            <a class="btn-getstarted" href="../index.php">Kembali ke Home</a>

            <!-- Mobile Navigation -->
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </div>
    </header>
