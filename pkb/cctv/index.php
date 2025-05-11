<?php
// Memuat file header
include "header.php";
?>

<main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">
        <img src="../assets/img/cctv-hero.jpg" alt="CCTV Pelayanan" data-aos="fade-in">
        <div class="container">
            <h2 data-aos="fade-up" data-aos-delay="100">CCTV Pelayanan<br>UPT PKB Gresik</h2>
            <p data-aos="fade-up" data-aos-delay="200">Pantau aktivitas pelayanan pengujian kendaraan bermotor secara real-time di UPT PKB Gresik.</p>
            <div class="d-flex mt-4" data-aos="fade-up" data-aos-delay="300">
                <a href="live.php" class="btn-get-started">Lihat CCTV</a>
            </div>
        </div>
    </section><!-- End Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="100">
                    <img src="../assets/img/cctv-about.jpg" class="img-fluid" alt="Tentang CCTV">
                </div>
                <div class="col-lg-6 order-2 order-lg-1 content" data-aos="fade-up" data-aos-delay="200">
                    <h3>Tentang CCTV Pelayanan</h3>
                    <p class="fst-italic">
                        CCTV pelayanan di Kantor UPT Pengujian Kendaraan Bermotor Gresik digunakan untuk mendukung transparansi, efisiensi, dan keamanan dalam proses pengujian kendaraan bermotor.
                    </p>
                    <ul>
                        <li><i class="bi bi-check-circle"></i> <span>Memantau aktivitas pelayanan secara real-time.</span></li>
                        <li><i class="bi bi-check-circle"></i> <span>Menjamin transparansi dan akuntabilitas pelayanan.</span></li>
                        <li><i class="bi bi-check-circle"></i> <span>Meningkatkan keamanan dan efisiensi operasional.</span></li>
                    </ul>
                    <a href="live.php" class="read-more"><span>Lihat CCTV</span><i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section><!-- End About Section -->

    <!-- Counts Section -->
    <section id="counts" class="section counts light-background">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <span data-purecounter-start="0" data-purecounter-end="10" data-purecounter-duration="1" class="purecounter"></span>
                        <p>Kamera CCTV</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <span data-purecounter-start="0" data-purecounter-end="5" data-purecounter-duration="1" class="purecounter"></span>
                        <p>Area Pemantauan</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <span data-purecounter-start="0" data-purecounter-end="24" data-purecounter-duration="1" class="purecounter"></span>
                        <p>Jam Pemantauan</p>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Counts Section -->

    <!-- Features Section -->
    <section id="features" class="features section">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="features-item">
                        <i class="bi bi-camera-video" style="color: #ffbb2c;"></i>
                        <h3>Live Streaming</h3>
                        <p>Pantau aktivitas pelayanan secara langsung melalui kamera CCTV.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="features-item">
                        <i class="bi bi-shield-check" style="color: #5578ff;"></i>
                        <h3>Keamanan</h3>
                        <p>Menjamin keamanan dan kenyamanan dalam proses pelayanan.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="features-item">
                        <i class="bi bi-graph-up" style="color: #e80368;"></i>
                        <h3>Efisiensi</h3>
                        <p>Meningkatkan efisiensi operasional dengan pemantauan real-time.</p>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Features Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">
                    <div class="info-box">
                        <h3>Kontak Kami</h3>
                        <ul class="list-unstyled">
                            <li><strong>Telepon:</strong> (031) 3984567</li>
                            <li><strong>Email:</strong> uptpkbgresik@gmail.com</li>
                            <li><strong>Alamat:</strong> Jl. Raya Cerme Lor, Gresik</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Contact Section -->

</main>

<?php include "footer.php"; ?>
