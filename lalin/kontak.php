<?php
include "header.php";

// Pesan notifikasi dari process_contact.php
$message = "";
if (isset($_GET['message'])) {
    $message = htmlspecialchars($_GET['message']);
}
?>

<main class="main">

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Kontak Kami</h1>
                        <p class="mb-0">Hubungi kami untuk pertanyaan, laporan, atau saran terkait layanan CCTV di UPT PKB Gresik.</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="index.php">Home</a></li>
                    <li class="current">Kontak</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4">

                <div class="col-lg-6">
                    <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="200">
                        <i class="bi bi-geo-alt"></i>
                        <h3>Alamat</h3>
                        <p>Jalan Raya Cerme Lor, Banjarsari, Cerme, Gresik Regency, East Java 61171</p>
                    </div>
                </div><!-- End Info Item -->

                <div class="col-lg-3 col-md-6">
                    <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="300">
                        <i class="bi bi-telephone"></i>
                        <h3>Telepon</h3>
                        <p>+62 123 4556 789</p>
                    </div>
                </div><!-- End Info Item -->

                <div class="col-lg-3 col-md-6">
                    <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="400">
                        <i class="bi bi-envelope"></i>
                        <h3>Email</h3>
                        <p>uptpkbgresik@gmail.com</p>
                    </div>
                </div><!-- End Info Item -->

            </div>

            <div class="row gy-4 mt-1">
                <div class="col-lg-12" data-aos="fade-up" data-aos-delay="300">
                    <form action="process_contact.php" method="post" class="php-email-form">
                        <div class="row gy-4">
                            <div class="col-md-6">
                                <input type="text" name="nama" class="form-control" placeholder="Nama Anda" required="">
                            </div>
                            <div class="col-md-6 ">
                                <input type="email" class="form-control" name="email" placeholder="Email Anda" required="">
                            </div>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="subjek" placeholder="Subjek" required="">
                            </div>
                            <div class="col-md-12">
                                <textarea class="form-control" name="pesan" rows="6" placeholder="Pesan" required=""></textarea>
                            </div>
                            <div class="col-md-12 text-center">
                                <?php if (!empty($message)) : ?>
                                    <div class="alert alert-info my-3"><?php echo $message; ?></div>
                                <?php endif; ?>
                                <div class="loading">Loading</div>
                                <div class="error-message"></div>
                                <div class="sent-message">Pesan Anda telah terkirim. Terima kasih!</div>
                                <button type="submit">Kirim Pesan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section><!-- /Contact Section -->

</main>

<?php include "footer.php"; ?>
