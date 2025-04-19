<iframe
    src="https://stream.trakteer.id/notification/index.html?key=trstream-Q3jtXqcxH7niIZL0itlg&unit=Pentol&mod=3&hash=eml73oqgxdx5d9qb"
    width="600" height="200" frameborder="0" allowfullscreen></iframe>
<footer id="footer" class="footer position-relative">
    <div class="container footer-top">
        <div class="row gy-4">
            <div class="col-lg-4 col-md-6 footer-about">
                <a href="index.php" class="logo d-flex align-items-center">
                    <span class="">Dishub Fakfak</span>
                </a>
                <div class="footer-contact pt-3">
                    <p>Jl. Imam Bonjol No. 1</p>
                    <p>Fakfak, Papua Barat 98613</p>
                    <p class="mt-3"><strong>Phone:</strong> <span>(0956) 222218</span></p>
                    <p><strong>Email:</strong> <span>dishubfakfak@gmail.com</span></p>
                </div>
                <div class="social-links d-flex mt-4">
                    <a href="https://dishub.fakfakkab.go.id/" target="_blank"><i class="bi bi-twitter"></i></a>
                    <a href="https://www.facebook.com/dishub.fakfak" target="_blank"><i class="bi bi-facebook"></i></a>
                    <a href="https://www.instagram.com/dishubkab.fakfak/" target="_blank"><i
                            class="bi bi-instagram"></i></a>
                    <a href="https://fakfakkab.go.id/" target="_blank"><i class="bi bi-linkedin"
                            target="_blank"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Menu</h4>
                <ul>
                    <?php
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
                    if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true) {
                        echo '<li class="nav-item"><a class="nav-link" href="index.php">Dashboard</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="tambah_kendaraan.php">Tambah Kendaraan</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="tambah_terminal.php">Tambah Terminal</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="tambah_petugas.php">Tambah Petugas</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="laporan.php">Laporan</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="register.php">Tambah Admin</a></li>';
                    } else {
                        echo '<li class="nav-item"><a class="nav-link" href="index.php">Beranda</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="tampil_kendaraan.php">Data Kendaraan</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="tampil_terminal.php">Informasi Terminal</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="tampil_petugas.php">Data Petugas</a></li>';
                    }
                    ?>
                </ul>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
                <h4>We Services</h4>
                <ul>
                    <li><a href="../umum/index.php">Umum</a></li>
                    <li><a href="../terminal/index.php">Terminal</a></li>
                    <li><a href="../parkir/index.php">Parkir</a></li>
                    <li><a href="https://play.google.com/store/apps/details?id=com.inotafstudio.kirgresik&pcampaignid=web_share" target="_blank">Pengujian</a></li>
                    <li><a href="../lalin/index.php">Lalu Lintas</a></li>
                </ul>
            </div>

            <div class="col-lg-4 col-md-12 footer-newsletter">
                <h4>INDEKS KEPUASAN MASYARAKAT</h4>
                <p>Partisipasi Anda sangat berarti bagi kami. Silakan isi survei kami untuk membantu kami meningkatkan
                    layanan kami.</p>
                <form action="https://forms.gle/SVx2djjqmf2eywyL9" target="_blank">
                    <input type="submit" value="Isi Survey" class="btn btn-primary">
                </form>
            </div>

        </div>
    </div>

    <div class="container copyright text-center mt-4">
        <p>&copy; <?php echo date("Y"); ?> Sistem Informasi Dinas Perhubungan Fakfak</p>
        <div class="credits">
            <a href="https://flying-classy-sage.glitch.me/" target="_blank" rel="noopener noreferrer">
                Bot Hunting Company Limited
            </a>
        </div>
    </div>

</footer>

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script type='text/javascript' src='https://assets.trakteer.id/js/trbtn-overlay.min.js'></script>
<script type='text/javascript' class='troverlay'>
    (function () {
        var trbtnId = trbtnOverlay.init('QR Pay', '#FFC147', 'https://trakteer.id/hunty/tip/embed/modal', 'https://cdn.trakteer.id/images/embed/trbtn-icon.png?date=18-11-2023', '35', 'floating-left');
        trbtnOverlay.draw(trbtnId);
    })();
</script>
<script src="https://assets.trakteer.id/js/trws.min.js"></script>

<!-- Main JS File -->
<script src="assets/js/main.js"></script>

</body>

</html>