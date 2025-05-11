<?php

include("../config.php"); // Mengimpor koneksi database dari config.php

// Mengambil data pegawai jika dibutuhkan (optional)
$sql = "SELECT * FROM pegawai";
$result = $koneksi->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>UPT PKB Gresik</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../assets/img/favicon.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

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

            <a href="../index.php" class="logo d-flex align-items-center me-auto">
                <h1 class="sitename">UPT PKB Gresik</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <!-- Tab Home -->
                    <li><a href="../index.php" class="active">Home<br></a></li>

                    <!-- Tab Numpang Uji Masuk -->
                    <li>
                        <a href="<?php echo isset($_SESSION['username']) ? 'numpanguji_masuk.php' : 'numpanguji_masuk_find.php'; ?>">
                            Numpang Uji Masuk
                        </a>
                    </li>

                    <!-- Tab Numpang Uji Keluar -->
                    <li>
                        <a href="<?php echo isset($_SESSION['username']) ? 'numpanguji_keluar.php' : 'numpanguji_keluar_find.php'; ?>">
                            Numpang Uji Keluar
                        </a>
                    </li>
                    <!-- Menyesuaikan link berdasarkan status login -->
                    <?php
                    if (isset($_SESSION['username'])) {
                        // Jika sudah login, arahkan ke dashboard
                        echo '<li><a href="../rubah_bentuk/dashboard.php">Rubah Bentuk</a></li>';
                        echo '<li><a href="../rubah_sifat/dashboard.php">Rubah Sifat</a></li>';
                    } else {
                        // Jika belum login, arahkan ke halaman utama
                        echo '<li><a href="../rubah_bentuk/">Rubah Bentuk</a></li>';
                        echo '<li><a href="../rubah_sifat/">Rubah Sifat</a></li>';
                    }
                    ?>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <?php
            // Jika pengguna sudah login, tampilkan tombol logout
            if (isset($_SESSION['username'])) {
                echo '<a class="btn-getstarted" href="../proses_logout.php">Logout</a>';
            } else {
                // Jika pengguna belum login, tampilkan tombol Home
                echo '<a class="btn-getstarted" href="../index.php">Home</a>';
            }
            ?>

        </div>
    </header>