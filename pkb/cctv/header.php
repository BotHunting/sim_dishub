<?php
session_start();

// Inisialisasi variabel $logged_in dan $role
$logged_in = false;
$role = ''; // Menyimpan role pengguna

// Periksa apakah pengguna sudah login
if (isset($_SESSION['username'])) {
    $logged_in = true;
    $role = isset($_SESSION['role']) ? $_SESSION['role'] : ''; // Ambil role dari session jika ada
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" >
    <title>CCTV Pelayanan UPT PKB Gresik</title>
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
            <a href="../index.php" class="logo d-flex align-items-center me-auto">
                <h1 class="sitename">UPT PKB Gresik</h1>
            </a>

            <!-- Navigasi -->
            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="index.php" class="active">Beranda</a></li>
                    <li><a href="live.php">CCTV Pelayanan</a></li>
                    <li><a href="layanan.php">Layanan</a></li>
                    <li><a href="kontak.php">Kontak</a></li>

                    <!-- Menu tambahan berdasarkan role -->
                    <?php if ($logged_in): ?>
                        <?php if ($role === 'Kepala'): ?>
                            <li><a href="dishub/lalin/live.php">Live CCTV</a></li>
                            <li><a href="dishub/lalin/tambah_video.php">Tambah Video</a></li>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>
            </nav><!-- End Navigasi -->

            <!-- Tombol Login/Logout -->
            <?php if ($logged_in): ?>
                <a class="btn-getstarted" href="../">Home</a>
            <?php else: ?>
                <a class="btn-getstarted" href="../index.php">Home</a>
            <?php endif; ?>

            <!-- Mobile Navigation -->
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </div>
    </header>
    <div class="container mt-5">
