<?php
session_start(); // Memulai sesi
include("../config.php"); // Mengimpor koneksi database

?>

<?php include("header.php"); ?>

<main class="main">

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Numpang Uji</h1>
                        <p class="mb-0">Kami ingin membantu Anda dalam memindahkan kepemilikan kendaraan Anda ke daerah lain.</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="../index.php">Home</a></li>
                    <li class="current">Numpang Uji</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <!-- Events Section -->
    <section id="events" class="events section">

        <div class="container" data-aos="fade-up">

            <div class="row">
                <div class="col-md-6 d-flex align-items-stretch">
                    <div class="card">
                        <div class="card-img">
                            <img src="../assets/img/masuk.jpg" alt="...">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">
                                <!-- Jika belum login, arahkan ke `numpanguji_masuk_find.php` -->
                                <a href="<?php echo isset($_SESSION['username']) ? 'numpanguji_masuk.php' : 'numpanguji_masuk_find.php'; ?>">
                                    Numpang Uji Masuk
                                </a>
                            </h5>
                            <p class="fst-italic text-center">Numpang Uji Masuk Kendaraan: Syarat dan Prosedur Lengkap</p>
                            <p class="card-text">Numpang Uji Masuk adalah layanan pengujian kendaraan bermotor yang dilakukan di luar wilayah domisili kendaraan. Layanan ini diperuntukkan bagi kendaraan yang ingin melakukan pengujian berkala di wilayah UPT PKB Gresik, meskipun kendaraan tersebut terdaftar di wilayah lain</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-flex align-items-stretch">
                    <div class="card">
                        <div class="card-img">
                            <img src="../assets/img/keluar.jpg" alt="...">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">
                                <!-- Jika belum login, arahkan ke `numpanguji_keluar_find.php` -->
                                <a href="<?php echo isset($_SESSION['username']) ? 'numpanguji_keluar.php' : 'numpanguji_keluar_find.php'; ?>">
                                    Numpang Uji Keluar
                                </a>
                            </h5>
                            <p class="fst-italic text-center">Numpang Uji Keluar Kendaraan: Syarat dan Prosedur Lengkap</p>
                            <p class="card-text">Numpang Uji Keluar adalah layanan pengujian kendaraan bermotor yang dilakukan di luar wilayah domisili kendaraan. Layanan ini diperuntukkan bagi kendaraan yang ingin melakukan pengujian berkala di wilayah lain, meskipun kendaraan tersebut terdaftar di wilayah UPT PKB Gresik</p>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </section><!-- /Events Section -->

</main>

<?php include("footer.php"); ?>
