<?php
session_start();

include_once 'config.php';

// Inisialisasi variabel $logout_button
$logout_button = '';

// Cek apakah pengguna sudah login atau belum
if (isset($_SESSION['username'])) {
    // Jika sudah login, tampilkan tombol logout
    $logout_button = '<a class="nav-link" href="logout.php">Logout</a>';

} else {
    // Jika belum login, tampilkan tombol login
    $logout_button = '<a class="nav-link" href="login.php">Login</a>';
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

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1 class="">Selamat datang di Sistem Informasi Dinas Perhubungan Kabupaten Fakfak!<br></h1>
                        <p class="mb-0">Menyambut Era Baru Mobilitas di Fakfak: Sistem Informasi Dinas Perhubungan Kabupaten Fakfak.</p>
                        <p class="mb-0">Website ini hadir sebagai wujud komitmen kami untuk menghadirkan layanan publik yang transparan, akuntabel, dan mudah diakses bagi seluruh masyarakat Fakfak.</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="index.php">Home</a></li>
                    <li class="current">About Us<br></li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <!-- About Us Section -->
    <section id="about-us" class="section about-us">

        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="100">
                    <img src="assets/img/about-2.jpg" class="img-fluid" alt="">
                </div>

                <div class="col-lg-6 order-2 order-lg-1 content" data-aos="fade-up" data-aos-delay="200">
                    <h3>Sistem Informasi Dinas Perhubungan Kabupaten Fakfak</h3>
                    <p class="fst-italic">
                        Website ini dirancang sebagai gerbang informasi dan layanan terpadu bagi masyarakat Fakfak dalam mengakses berbagai kebutuhan terkait transportasi dan perhubungan. Di sini, Anda akan menemukan berbagai informasi penting.</p>
                    <ul>
                        <li><i class="bi bi-check-circle"></i> <span>Informasi terkini: Temukan berita terbaru, pengumuman penting, dan agenda kegiatan Dinas Perhubungan.</span></li>
                        <li><i class="bi bi-check-circle"></i> <span>Pelayanan publik: Akses berbagai layanan online seperti perizinan, pembayaran retribusi, dan aduan masyarakat.</span></li>
                        <li><i class="bi bi-check-circle"></i> <span>Data dan statistik: Dapatkan informasi statistik terkini terkait sektor perhubungan di Kabupaten Fakfak.</span></li>
                        <li><i class="bi bi-check-circle"></i> <span>Profil Dinas: Kenali lebih dekat tentang struktur organisasi, tugas pokok dan fungsi, serta program kerja Dinas Perhubungan.</span></li>
                    </ul>
                </div>

            </div>

        </div>

    </section><!-- /About Us Section -->

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

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Testimonials</h2>
            <p class="">What are they saying</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="swiper">
                <script type="application/json" class="swiper-config">
                    {
                        "loop": true,
                        "speed": 600,
                        "autoplay": {
                            "delay": 5000
                        },
                        "slidesPerView": "auto",
                        "pagination": {
                            "el": ".swiper-pagination",
                            "type": "bullets",
                            "clickable": true
                        },
                        "breakpoints": {
                            "320": {
                                "slidesPerView": 1,
                                "spaceBetween": 40
                            },
                            "1200": {
                                "slidesPerView": 2,
                                "spaceBetween": 20
                            }
                        }
                    }
                </script>
                <div class="swiper-wrapper">

                    <?php
                    include_once 'config.php';

                    // Query untuk mengambil data testimoni dari tabel testimoni_sistem
                    $sql = "SELECT * FROM testimoni_sistem";
                    $result = $koneksi->query($sql);

                    if ($result->num_rows > 0) {
                        // Loop untuk menampilkan setiap testimoni dalam slider
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="swiper-slide">';
                            echo '    <div class="testimonial-wrap">';
                            echo '        <div class="testimonial-item">';
                            echo '            <img src="assets/img/testimonials/' . $row['foto'] . '" class="testimonial-img" alt="' . $row['nama'] . '">';
                            echo '            <h3>' . $row['nama'] . '</h3>';
                            echo '            <h4>' . $row['jabatan'] . '</h4>';
                            echo '            <div class="stars">';
                            echo '                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>';
                            echo '            </div>';
                            echo '            <p>';
                            echo '                <i class="bi bi-quote quote-icon-left"></i>';
                            echo '                <span>' . $row['keterangan'] . '</span>';
                            echo '                <i class="bi bi-quote quote-icon-right"></i>';
                            echo '            </p>';
                            echo '        </div>';
                            echo '    </div>';
                            echo '</div><!-- End testimonial item -->';
                        }
                    } else {
                        echo "Tidak ada testimoni yang tersedia.";
                    }

                    // Tutup koneksi database
                    $koneksi->close();
                    ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section><!-- /Testimonials Section -->
</main>
<?php include("footer.php"); ?>