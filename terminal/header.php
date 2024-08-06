<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Sistem Informasi Terminal</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">
</head>

<body>

    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="index.php" class="logo d-flex align-items-center me-auto">
                <h1 class="">Terminal</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <?php
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
                    if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true) {
                        echo '<li class="nav-item"><a class="nav-link" href="index.php">Dashboard</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="info_terminal.php">Armada</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="tambah_kendaraan.php">Tambah Kendaraan</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="tambah_terminal.php">Tambah Terminal</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="tambah_petugas.php">Tambah Petugas</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="laporan.php">Laporan</a></li>';
                    } else {
                        echo '<li class="nav-item"><a class="nav-link" href="index.php">Beranda</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="tampil_terminal.php">Informasi Terminal</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="info_terminal.php">Informasi Armada</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="tampil_petugas.php">Petugas</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="tampil_kendaraan.php">Kendaraan</a></li>';
                    }
                    ?>
                    <a class="btn-getstarted" href="../index.php">Home</a>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            

        </div>
    </header>