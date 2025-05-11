<?php
include("header.php"); // Memuat header
?>

<main class="main">

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Mutasi</h1>
                        <p class="mb-0">Kami ingin membantu Anda dalam memindahkan kepemilikan kendaraan Anda ke daerah lain.</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="../index.php">Home</a></li>
                    <li class="current">Mutasi</li>
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
                            <img src="../assets/img/masuk.jpg" alt="Mutasi Masuk">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="<?php echo isset($_SESSION['username']) ? 'mutasi_masuk.php' : 'mutasi_masuk_find.php'; ?>">
                                    Mutasi Masuk
                                </a>
                            </h5>
                            <p class="fst-italic text-center">Mutasi Masuk Kendaraan: Syarat dan Prosedur Lengkap</p>
                            <p class="card-text">Mutasi masuk kendaraan adalah proses perpindahan data kepemilikan kendaraan dari daerah lain ke wilayah UPT PKB Gresik.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-flex align-items-stretch">
                    <div class="card">
                        <div class="card-img">
                            <img src="../assets/img/keluar.jpg" alt="Mutasi Keluar">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="<?php echo isset($_SESSION['username']) ? 'mutasi_keluar.php' : 'mutasi_keluar_find.php'; ?>">
                                    Mutasi Keluar
                                </a>
                            </h5>
                            <p class="fst-italic text-center">Mutasi Keluar Kendaraan: Syarat dan Prosedur Lengkap</p>
                            <p class="card-text">Mutasi keluar kendaraan adalah proses perpindahan data kepemilikan kendaraan dari wilayah UPT PKB Gresik ke daerah lain.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Events Section -->

</main>

<?php include("footer.php"); ?>
