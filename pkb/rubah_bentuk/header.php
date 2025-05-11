<?php

include("../config.php"); // Mengimpor koneksi database dari config.php

// Mengambil data pegawai jika dibutuhkan (optional)
$sql = "SELECT * FROM pegawai";
$result = $koneksi->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rubah Bentuk - UPT PKB Gresik</title>
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/css/main.css" rel="stylesheet">
</head>

<body>
    <!-- Start of Header -->
    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">
            <a href="../index.php" class="logo d-flex align-items-center me-auto">
                <h1 class="sitename">UPT PKB Gresik</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="../mutasi/">Mutasi</a></li>
                    <li><a href="../numpanguji/">Numpang Uji</a></li>

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
            </nav>


            <!-- Jika pengguna sudah login, tampilkan tombol logout -->
            <?php if (isset($_SESSION['username'])): ?>
                <a class="btn-getstarted" href="../proses_logout.php">Logout</a>
            <?php else: ?>
                <a class="btn-getstarted" href="../index.php">Home</a>
            <?php endif; ?>
        </div>
    </header>

    <!-- Content for Rubah Bentuk can go here -->

</body>

</html>