<?php
session_start();

include_once 'config.php';
// Inisialisasi variabel $logout_button
$logout_button = '';

// Cek apakah pengguna sudah login atau belum
if (isset($_SESSION['username'])) {
    $logout_button = '<a class="btn-getstarted" href="logout.php">Logout</a>';
} else {
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
            <h2 data-aos="fade-up" data-aos-delay="100" class="">Sistem Informasi,<br>Dinas Perhubungan Kabupten Fakfak</h2>
            <p data-aos="fade-up" data-aos-delay="200">Menuju Fakfak yang Terhubung dan Nyaman: Bersinergi Mewujudkan Sistem Transportasi yang Aman, Efisien, dan Berkelanjutan</p>
            <div class="d-flex mt-4" data-aos="fade-up" data-aos-delay="300">
                <a href="umum/index.php" class="btn-get-started">Get Started</a>
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
                    <h3>Visi dan Misi</h3>
                    <p class="fst-italic">
                        Menjadi Dinas Perhubungan yang unggul dalam mewujudkan sistem transportasi yang aman, efisien, dan berkelanjutan untuk mendukung pembangunan daerah Kabupaten Fakfak.
                    </p>
                    <ul>
                        <li><i class="bi bi-check-circle"></i> <span>Meningkatkan kualitas pelayanan dan keselamatan transportasi.</span></li>
                        <li><i class="bi bi-check-circle"></i> <span>Mengembangkan sistem transportasi yang terintegrasi dan berkelanjutan.</span></li>
                        <li><i class="bi bi-check-circle"></i> <span>Meningkatkan peran serta masyarakat dalam penyelenggaraan transportasi.</span></li>
                        <li><i class="bi bi-check-circle"></i> <span>Mewujudkan tata kelola pemerintahan yang baik dan bersih di bidang perhubungan.</span></li>
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
                        <h3>Dishub Fakfak</h3>
                        <p>
                            Dinas Perhubungan Kabupaten Fakfak selalu berbenah dan berinovasi untuk memberikan pelayanan terbaik bagi masyarakat. Mari bersama-sama membangun Fakfak yang terhubung, aman, dan nyaman untuk masa depan yang lebih gemilang.
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

    <!-- Courses Section -->
    <section id="courses" class="courses section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Services</h2>
            <p class="">Popular Services</p>
        </div><!-- End Section Title -->

        <div class="container">
            <div class="row">

                <?php
                include_once 'config.php';

                // Query untuk mengambil data dari tabel testimoni_pelayanan
                $sql = "SELECT * FROM testimoni_pelayanan";
                $result = $koneksi->query($sql);

                if ($result->num_rows > 0) {
                    // Loop untuk menampilkan data dalam bentuk card
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                            <div class="course-item">
                                <img src="assets/img/pelayanan/<?php echo $row['gambar']; ?>" class="img-fluid" alt="">
                                <div class="course-content">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <p class="category"><?php echo $row['sebutan']; ?></p>
                                        <p class="price">Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></p>
                                    </div>
                                    <h3><a href="#"><?php echo $row['nama']; ?></a></h3>
                                    <p class="description"><?php echo $row['keterangan']; ?></p>
                                    <div class="trainer d-flex justify-content-between align-items-center">
                                        <div class="trainer-profile d-flex align-items-center">
                                            <img src="assets/img/trainers/<?php echo $row['foto']; ?>" class="img-fluid" alt="">
                                            <a href="#" target="_blank" class="trainer-link"><?php echo $row['pejabat']; ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- End Course Item-->
                <?php
                    }
                } else {
                    echo "Data tidak ditemukan.";
                }
                ?>
            </div>
        </div>
    </section><!-- /Courses Section -->

    <!-- Trainers Index Section -->
    <section id="trainers-index" class="section trainers-index">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Quotes</h2>
            <p class="">Opening Speech</p>
        </div><!-- End Section Title -->

        <div class="container">
            <div class="row">
                <?php
                // Mengambil data testimoni dari database
                include_once 'config.php';
                $sql = "SELECT * FROM testimoni_home";
                $result = $koneksi->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="col-lg-4 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
                            <div class="member">
                                <img src="assets/img/testihome/<?php echo $row['foto']; ?>" class="img-fluid" alt="">
                                <div class="member-content">
                                    <h4><?php echo $row['nama']; ?></h4>
                                    <span><?php echo $row['jabatan']; ?></span>
                                    <p><?php echo $row['keterangan']; ?></p>
                                    <div class="social">
                                        <!-- Tambahkan tautan sosial media sesuai kebutuhan -->
                                        <!-- Contoh: <a href=""><i class="bi bi-twitter"></i></a> -->
                                        <!-- Contoh: <a href=""><i class="bi bi-facebook"></i></a> -->
                                        <!-- Contoh: <a href=""><i class="bi bi-instagram"></i></a> -->
                                        <!-- Contoh: <a href=""><i class="bi bi-linkedin"></i></a> -->
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Team Member -->
                <?php
                    }
                } else {
                    echo "Belum ada testimoni.";
                }
                ?>
            </div>
        </div>
    </section><!-- /Trainers Index Section -->

</main>
<?php include("footer.php"); ?>