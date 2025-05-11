<?php
// Mulai session hanya jika belum aktif
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Pastikan file config bisa ditemukan dari direktori manapun
$rootPath = __DIR__ . '/config.php';
if (file_exists($rootPath)) {
    include($rootPath);
} elseif (file_exists(__DIR__ . '/../config.php')) {
    include(__DIR__ . '/../config.php');
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>UPT PKB Gresik</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">
</head>

<body class="index-page">

<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="index.php" class="logo d-flex align-items-center me-auto">
            <h1 class="sitename">UPT PKB Gresik</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="index.php" class="active">Home</a></li>
                <li><a href="about.php">About us</a></li>
                <li><a href="courses.php">Services</a></li>
                <li><a href="events.php">Pelayanan</a></li>
                <li><a href="trainers.php">Pegawai</a></li>
                <li><a href="cctv/">CCTV</a></li>
                <li class="dropdown"><a href="#"><span>Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li><a href="mutasi/">Mutasi</a></li>
                        <li><a href="numpanguji/">Numpang Uji</a></li>
                        <?php if (isset($_SESSION['username'])): ?>
                            <li><a href="rubah_bentuk/dashboard.php">Rubah Bentuk</a></li>
                            <li><a href="rubah_sifat/dashboard.php">Rubah Sifat</a></li>
                        <?php else: ?>
                            <li><a href="rubah_bentuk/">Rubah Bentuk</a></li>
                            <li><a href="rubah_sifat/">Rubah Sifat</a></li>
                            <li><a href="tidak_aktif/">Tidak Aktif</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>


            <a class="btn-getstarted" href="../">Home</a>


    </div>
</header>
