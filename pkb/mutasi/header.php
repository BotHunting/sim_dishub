<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Memulai sesi hanya jika belum dimulai
}


?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPT PKB Gresik</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../assets/img/favicon.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

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
            <a href="../index.php" class="logo d-flex align-items-center me-auto">
                <h1 class="sitename">UPT PKB Gresik</h1>
            </a>

            <!-- Navigasi -->
            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="../index.php" class="active">Home</a></li>
                    <li><a href="mutasi_masuk.php">Mutasi Masuk</a></li>
                    <li><a href="mutasi_keluar.php">Mutasi Keluar</a></li>
                </ul>
            </nav><!-- End Navigasi -->

            <!-- Tombol Login/Logout -->
            <?php if (isset($_SESSION['username'])): ?>
                <a class="btn-getstarted" href="../proses_logout.php">Logout</a>
            <?php else: ?>
                <a class="btn-getstarted" href="../index.php">Home</a>
            <?php endif; ?>

            <!-- Mobile Navigation -->
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </div>
    </header>