<?php
session_start();

// Inisialisasi variabel $logout_button
$logout_button = '';

// Cek apakah pengguna sudah login atau belum
if (isset($_SESSION['username'])) {
    // Jika sudah login, tampilkan tombol logout
    $logout_button = '<a class="nav-link" href="logout.php">Logout</a>';

}
?>

<?php include("header.php"); ?>
<main class="main">

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Contact</h1>
                        <p class="mb-0">Halaman ini berisi informasi kontak Dinas Perhubungan Kabupaten Fakfak, termasuk alamat, jam operasional, nomor telepon, email, website, dan media sosial. Halaman ini juga dilengkapi dengan peta lokasi untuk memudahkan Anda menemukan kantor Dinas Perhubungan Kabupaten Fakfak.</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="index.php">Home</a></li>
                    <li class="current">Contact</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">
        <div class="mb-5" data-aos="fade-up" data-aos-delay="200">
            <iframe style="border:0; width: 100%; height: 300px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d498.0760111766732!2d132.29699871620903!3d-2.9284433643029817!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d4613c865f70d1d%3A0x117d687dba61797e!2sDinas%20Perhubungan%20Kab%20Fakfak!5e0!3m2!1sid!2sid!4v1711518284779!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" frameborder="0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div><!-- End Google Maps -->
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">
                <div class="col-lg-4">
                    <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                        <i class="bi bi-geo-alt flex-shrink-0"></i>
                        <div>
                            <h3>Alamat</h3>
                            <p>Jl. Imam Bonjol No. 1, Kel. Wagom, Distrik Pariwari, Kabupaten fakfak 98613</p>
                        </div>
                    </div><!-- End Info Item -->
                    <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                        <i class="bi bi-telephone flex-shrink-0"></i>
                        <div>
                            <h3>Call Us</h3>
                            <p>(0956) 222218</p>
                        </div>
                    </div><!-- End Info Item -->
                    <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
                        <i class="bi bi-envelope flex-shrink-0"></i>
                        <div>
                            <h3>Email Us</h3>
                            <p>dishubfakfak.pkb@gmail.com</p>
                        </div>
                    </div><!-- End Info Item -->
                </div>
                <div class="col-lg-8">
                    <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
                        <div class="row gy-4">
                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control" placeholder="Your Name" required="">
                            </div>
                            <div class="col-md-6 ">
                                <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
                            </div>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="subject" placeholder="Subject" required="">
                            </div>
                            <div class="col-md-12">
                                <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                            </div>
                            <div class="col-md-12 text-center">
                                <div class="loading">Loading</div>
                                <div class="error-message"></div>
                                <div class="sent-message">Your message has been sent. Thank you!</div>
                                <button type="submit">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div><!-- End Contact Form -->
            </div>
        </div>
    </section><!-- /Contact Section -->
</main>
<?php include("footer.php"); ?>