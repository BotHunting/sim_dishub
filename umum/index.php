<?php
session_start();

include_once 'koneksi.php';
// Inisialisasi variabel $logout_button
$logout_button = '';

// Cek apakah pengguna sudah login atau belum
if (isset($_SESSION['username'])) {
    // Jika sudah login, tampilkan tombol logout
    $logout_button = '<a class="btn-getstarted" href="logout.php">Logout</a>';
} else {
    // Jika belum login, tampilkan tombol login
    $logout_button = '<a class="btn-getstarted" href="login.php">Login</a>';
}

$query = "SELECT COUNT(*) AS total_pegawai FROM pegawai";
$result = mysqli_query($koneksi, $query);

$total_pegawai = 0;
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $total_pegawai = $row['total_pegawai'];
}

// Hitung total pelayanan
$query_total_pelayanan = "SELECT COUNT(*) AS total FROM pelayananumum";
$result_total_pelayanan = mysqli_query($koneksi, $query_total_pelayanan);

$total_pelayanan = 0;
if ($result_total_pelayanan && mysqli_num_rows($result_total_pelayanan) > 0) {
    $row_total_pelayanan = mysqli_fetch_assoc($result_total_pelayanan);
    $total_pelayanan = $row_total_pelayanan['total'];
}

// Hitung total pelayanan dengan status 'Approved'
$query_total_pelayanan_approved = "SELECT COUNT(*) AS total_approved FROM pelayananumum WHERE status = 'Approved'";
$result_total_pelayanan_approved = mysqli_query($koneksi, $query_total_pelayanan_approved);

$total_pelayanan_approved = 0;
if ($result_total_pelayanan_approved && mysqli_num_rows($result_total_pelayanan_approved) > 0) {
    $row_total_pelayanan_approved = mysqli_fetch_assoc($result_total_pelayanan_approved);
    $total_pelayanan_approved = $row_total_pelayanan_approved['total_approved'];
}

// Hitung total Inventaris
$query_jumlah_inventaris = "SELECT COUNT(*) AS jumlah FROM pengelolaan";
$result_jumlah_inventaris = mysqli_query($koneksi, $query_jumlah_inventaris);

$jumlah_inventaris = 0;
if ($result_jumlah_inventaris && mysqli_num_rows($result_jumlah_inventaris) > 0) {
    $row_jumlah_inventaris = mysqli_fetch_assoc($result_jumlah_inventaris);
    $jumlah_inventaris = $row_jumlah_inventaris['jumlah'];
}
?>


<?php include("header.php"); ?>
<main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">

        <img src="assets/img/hero-bg.jpg" alt="" data-aos="fade-in">

        <div class="container">
            <h2 data-aos="fade-up" data-aos-delay="100" class="">Selamat datang di website Tata Usaha,<br>Dinas Perhubungan Kabupten Fakfak</h2>
            <p data-aos="fade-up" data-aos-delay="200">Website ini dibuat untuk memberikan informasi dan layanan kepada masyarakat terkait dengan tugas dan fungsi Dinas Perhubungan Kabupaten Fakfak</p>
            <div class="d-flex mt-4" data-aos="fade-up" data-aos-delay="300">
                <a href="pelayanan.php" class="btn-get-started">Pelayanan Masyarakat</a>
            </div>
        </div>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="100">
                    <img src="assets/img/about.jpg" class="img-fluid" alt="">
                </div>

                <div class="col-lg-6 order-2 order-lg-1 content" data-aos="fade-up" data-aos-delay="200">
                    <h3>Fitur Utama</h3>
                    <p class="fst-italic">
                        Tata Usaha Dinas Perhubungan Kabupaten Fakfak berkomitmen untuk memberikan pelayanan terbaik kepada masyarakat.
                    </p>
                    <ul>
                        <li><i class="bi bi-check-circle"></i> <span>Fitur untuk mengelola disposisi surat, baik untuk membuat, menyetujui, atau menolak disposisi.</span></li>
                        <li><i class="bi bi-check-circle"></i> <span>Fitur untuk membuat, mengirim, dan melacak surat-menyurat yang dikelola oleh Dinas Perhubungan.</span></li>
                        <li><i class="bi bi-check-circle"></i> <span>Fitur untuk menghasilkan laporan-laporan terkait aktivitas dan kinerja Dinas Perhubungan.</span></li>
                        <li><i class="bi bi-check-circle"></i> <span>Fitur untuk mengelola inventaris dan barang-barang milik Dinas Perhubungan.</span></li>
                        <li><i class="bi bi-check-circle"></i> <span>Fitur untuk memantau aktivitas dan kinerja Dinas Perhubungan secara berkala.</span></li>
                        <li><i class="bi bi-check-circle"></i> <span>Fitur untuk memberikan layanan publik kepada masyarakat terkait dengan sektor perhubungan.</span></li>
                    </ul>
                    <a href="#" class="read-more"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
                </div>

            </div>

        </div>

    </section><!-- /About Section -->

    <!-- Counts Section -->
    <section id="counts" class="section counts">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4">

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <span data-purecounter-start="0" data-purecounter-end="<?php echo $total_pegawai; ?>" data-purecounter-duration="1" class="purecounter"></span>
                        <p class="">Pegawai</p>
                    </div>
                </div><!-- End Stats Item -->

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <span data-purecounter-start="0" data-purecounter-end="<?php echo $total_pelayanan; ?>" data-purecounter-duration="1" class="purecounter"></span>
                        <p class="">Pelayanan</p>
                    </div>
                </div><!-- End Stats Item -->

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <span data-purecounter-start="0" data-purecounter-end="<?php echo $total_pelayanan_approved; ?>" data-purecounter-duration="1" class="purecounter"></span>
                        <p class="">Selesai</p>
                    </div>
                </div><!-- End Stats Item -->

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <span data-purecounter-start="0" data-purecounter-end="<?php echo $jumlah_inventaris; ?>" data-purecounter-duration="1" class="purecounter"></span>
                        <p class="">Inventaris</p>
                    </div>
                </div><!-- End Stats Item -->

            </div>

        </div>

    </section><!-- /Counts Section -->

    <!-- Why Us Section -->
    <section id="why-us" class="section why-us">

        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="why-box">
                        <h3>Tata Usaha</h3>
                        <p>
                            Website ini diharapkan dapat menjadi sumber informasi yang bermanfaat bagi masyarakat dan menjadi alat yang efektif untuk meningkatkan pelayanan publik Dinas Perhubungan Kabupaten Fakfak.
                        </p>
                        <div class="text-center">
                            <a href="#" class="more-btn"><span>Learn More</span> <i class="bi bi-chevron-right"></i></a>
                        </div>
                    </div>
                </div><!-- End Why Box -->

                <div class="col-lg-8 d-flex align-items-stretch">
                    <div class="row gy-4" data-aos="fade-up" data-aos-delay="200">

                        <div class="col-xl-4" data-aos="fade-up" data-aos-delay="300">
                            <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                                <i class="bi bi-clipboard-data"></i>
                                <h4>Pengembangan Sarpras</h4>
                                <p>Menuju Fakfak yang Terhubung: Membangun Infrastruktur Transportasi yang Aman dan Nyaman</p>
                            </div>
                        </div><!-- End Icon Box -->

                        <div class="col-xl-4">
                            <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                                <i class="bi bi-gem"></i>
                                <h4>Perizinan</h4>
                                <p>Melangkah Maju Bersama: Dapatkan Izin Usaha Transportasi Anda dengan Mudah dan Cepat</p>
                            </div>
                        </div><!-- End Icon Box -->

                        <div class="col-xl-4" data-aos="fade-up" data-aos-delay="400">
                            <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                                <i class="bi bi-inboxes"></i>
                                <h4>Penegakan Hukum</h4>
                                <p>Tertib Lalu Lintas, Fakfak Makin Keren: Bersama Menjaga Keselamatan dan Kenyamanan di Jalan</p>
                            </div>
                        </div><!-- End Icon Box -->

                    </div>
                </div>
            </div>
        </div>

    </section><!-- /Why Us Section -->

</main>
<?php include("footer.php"); ?>