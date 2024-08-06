<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once 'koneksi.php';
$logged_in = false;
$rules = "";
if (isset($_SESSION['username'])) {
    $logged_in = true;
    if ($stmt = $koneksi->prepare("SELECT rules FROM admin WHERE username = ?")) {
        $stmt->bind_param("s", $_SESSION['username']);
        $stmt->execute();
        $stmt->bind_result($rules);
        $stmt->fetch();
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Sistem Informasi Dinas Perhubungan Kabupaten Fakfak</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link rel="icon" href="assets/img/favicon.png" type="image/png">
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
                <h1 class="">Tata Usaha</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="pelayanan.php">Pelayanan</a></li>
                    <?php if (isset($logged_in) && $logged_in) : ?>
                        <li><a href="disposisi.php">Disposisi</a></li>
                        <li><a href="surat_menyurat.php">Surat Menyurat</a></li>
                        <li><a href="pengelolaan.php">Pengelolaan</a></li>
                        <li><a href="jabatan.php">Jabatan</a></li>
                    <?php endif; ?>
                    <li><a href="laporan.php">Laporan</a></li>
                    <?php
                    // Check if current page is within the admin directory
                    $is_admin_page = (strpos($_SERVER['REQUEST_URI'], '/admin/') !== false);
                    ?>
                    <?php if (isset($logged_in) && $logged_in && !$is_admin_page) : ?>
                        <li><a class="nav-link" href="admin/index.php">Admin Panel</a></li>
                    <?php endif; ?>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
            <a class="btn-getstarted" href="../index.php">Home</a>
        </div>
    </header>