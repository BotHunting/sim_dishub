<?php
require_once __DIR__ . '/../config.php';

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

// Query untuk menghitung jumlah pegawai
$query = "SELECT COUNT(*) AS total_pegawai FROM pegawai_pkb";
$result = mysqli_query($koneksi, $query);

$total_pegawai = 0;
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $total_pegawai = $row['total_pegawai'];
}

// Query untuk menghitung jumlah mutasi masuk dan mutasi keluar
$sql_mutasi_masuk = "SELECT COUNT(*) AS total_mutasi_masuk FROM mutasi_masuk";
$result_mutasi_masuk = mysqli_query($koneksi, $sql_mutasi_masuk);
$row_mutasi_masuk = mysqli_fetch_assoc($result_mutasi_masuk);
$total_mutasi_masuk = $row_mutasi_masuk['total_mutasi_masuk'];

$sql_mutasi_keluar = "SELECT COUNT(*) AS total_mutasi_keluar FROM mutasi_keluar";
$result_mutasi_keluar = mysqli_query($koneksi, $sql_mutasi_keluar);
$row_mutasi_keluar = mysqli_fetch_assoc($result_mutasi_keluar);
$total_mutasi_keluar = $row_mutasi_keluar['total_mutasi_keluar'];

// Menjumlahkan mutasi masuk dan mutasi keluar
$total_mutasi = $total_mutasi_masuk + $total_mutasi_keluar;

// Query untuk menghitung jumlah numpang uji masuk dan keluar
$sql_numpanguji_masuk = "SELECT COUNT(*) AS total_numpanguji_masuk FROM numpanguji_masuk";
$result_numpanguji_masuk = mysqli_query($koneksi, $sql_numpanguji_masuk);
$row_numpanguji_masuk = mysqli_fetch_assoc($result_numpanguji_masuk);
$total_numpanguji_masuk = $row_numpanguji_masuk['total_numpanguji_masuk'];

$sql_numpanguji_keluar = "SELECT COUNT(*) AS total_numpanguji_keluar FROM numpanguji_keluar";
$result_numpanguji_keluar = mysqli_query($koneksi, $sql_numpanguji_keluar);
$row_numpanguji_keluar = mysqli_fetch_assoc($result_numpanguji_keluar);
$total_numpanguji_keluar = $row_numpanguji_keluar['total_numpanguji_keluar'];

// Menjumlahkan numpang uji masuk dan keluar
$total_numpanguji = $total_numpanguji_masuk + $total_numpanguji_keluar;

// Query untuk menghitung jumlah Rubah Bentuk
$sql_rubah_bentuk = "SELECT COUNT(*) AS total_rubah_bentuk FROM rubah_bentuk";
$result_rubah_bentuk = mysqli_query($koneksi, $sql_rubah_bentuk);
$row_rubah_bentuk = mysqli_fetch_assoc($result_rubah_bentuk);
$total_rubah_bentuk = $row_rubah_bentuk['total_rubah_bentuk'];

// Query untuk menghitung jumlah Rubah Sifat
$sql_rubah_sifat = "SELECT COUNT(*) AS total_rubah_sifat FROM rubah_sifat";
$result_rubah_sifat = mysqli_query($koneksi, $sql_rubah_sifat);
$row_rubah_sifat = mysqli_fetch_assoc($result_rubah_sifat);
$total_rubah_sifat = $row_rubah_sifat['total_rubah_sifat'];

// Query untuk menghitung jumlah Tidak Aktif
$sql_tidak_aktif = "SELECT COUNT(*) AS total_tidak_aktif FROM kendaraan WHERE status = 'Keluar'";
$result_tidak_aktif = mysqli_query($koneksi, $sql_tidak_aktif);
$row_tidak_aktif = mysqli_fetch_assoc($result_tidak_aktif);
$total_tidak_aktif = $row_tidak_aktif['total_tidak_aktif'];

?>

<?php include("header.php"); ?>
<main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">
        <img src="assets/img/hero-bg.jpg" alt="" data-aos="fade-in">
        <div class="container">
            <h2 data-aos="fade-up" data-aos-delay="100">Unit Pelaksana Teknis<br>Pengujian Kendaraan Bermotor Gresik
            </h2>
            <p data-aos="fade-up" data-aos-delay="200">Selamat datang di website pengurusan rekomendasi seputar pengujian kendaraan bermotor!</p>
            <div class="d-flex mt-4" data-aos="fade-up" data-aos-delay="300">
                <a href="courses.php" class="btn-get-started">Get Started</a>
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
                    <h3>Dengan menggunakan website</h3>
                    <p class="fst-italic">
                        Anda dapat mengurus pengujian kendaraan bermotor dengan mudah, cepat, dan hemat biaya. Kami juga
                        menyediakan fitur-fitur unggulan seperti:
                    </p>
                    <ul>
                        <li><i class="bi bi-check-circle"></i> <span>Pencarian bengkel dan tempat pengujian kendaraan
                                bermotor berdasarkan lokasi dan jenis pengujian.</span></li>
                        <li><i class="bi bi-check-circle"></i> <span>Perkiraan biaya pengujian kendaraan
                                bermotor.</span></li>
                        <li><i class="bi bi-check-circle"></i> <span>Tips dan trik untuk mempersiapkan kendaraan Anda
                                sebelum pengujian.</span></li>
                        <li><i class="bi bi-check-circle"></i> <span>Informasi terbaru tentang peraturan dan kebijakan
                                pengujian kendaraan bermotor.</span></li>
                    </ul>
                    <a href="#" class="read-more"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
                </div>

            </div>

        </div>

    </section><!-- /About Section -->

    <!-- Counts Section -->
    <section id="counts" class="section counts light-background">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4">

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <!-- Menampilkan jumlah pegawai yang bukan pensiun -->
                        <span data-purecounter-start="0" data-purecounter-end="<?php echo $total_pegawai; ?>"
                            data-purecounter-duration="1" class="purecounter"></span>
                        <p>Pegawai</p>
                    </div>
                </div><!-- End Stats Item -->

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <!-- Menampilkan jumlah mutasi -->
                        <span data-purecounter-start="0" data-purecounter-end="<?php echo $total_mutasi; ?>"
                            data-purecounter-duration="1" class="purecounter"></span>
                        <p>Mutasi</p>
                    </div>
                </div><!-- End Stats Item -->

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <!-- Menampilkan jumlah numpang uji -->
                        <span data-purecounter-start="0" data-purecounter-end="<?php echo $total_numpanguji; ?>"
                            data-purecounter-duration="1" class="purecounter"></span>
                        <p>Numpang Uji</p>
                    </div>
                </div><!-- End Stats Item -->

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <!-- Menampilkan jumlah Rubah Bentuk -->
                        <span data-purecounter-start="0" data-purecounter-end="<?php echo $total_rubah_bentuk; ?>"
                            data-purecounter-duration="1" class="purecounter"></span>
                        <p>Rubah Bentuk</p>
                    </div>
                </div><!-- End Stats Item -->

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <!-- Menampilkan jumlah Rubah Sifat -->
                        <span data-purecounter-start="0" data-purecounter-end="<?php echo $total_rubah_sifat; ?>"
                            data-purecounter-duration="1" class="purecounter"></span>
                        <p>Rubah Sifat</p>
                    </div>
                </div><!-- End Stats Item -->

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <!-- Menampilkan jumlah Tidak Aktif -->
                        <span data-purecounter-start="0" data-purecounter-end="<?php echo $total_tidak_aktif; ?>"
                            data-purecounter-duration="1" class="purecounter"></span>
                        <p>Tidak Aktif</p>
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
                        <h3>Selamat datang di website PKB Gresik</h3>
                        <p>
                            Di website ini, Anda dapat menemukan informasi lengkap tentang berbagai jenis pengujian
                            kendaraan bermotor, seperti pengujian emisi, pengujian KIR, dan pengujian laik jalan. Kami
                            juga menyediakan rekomendasi terbaik untuk bengkel dan tempat pengujian kendaraan bermotor
                            yang berkualitas.
                        </p>
                        <div class="text-center">
                            <a href="#" class="more-btn"><span>Learn More</span> <i class="bi bi-chevron-right"></i></a>
                        </div>
                    </div>
                </div><!-- End Why Box -->

                <div class="col-lg-8 d-flex align-items-stretch">
                    <div class="row gy-4" data-aos="fade-up" data-aos-delay="200">

                        <div class="col-xl-4">
                            <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                                <i class="bi bi-clipboard-data"></i>
                                <h4>Quality</h4>
                                <p>Kami ingin membantu Anda dalam menjaga kendaraan Anda tetap prima dan aman di jalan
                                </p>
                            </div>
                        </div><!-- End Icon Box -->

                        <div class="col-xl-4" data-aos="fade-up" data-aos-delay="300">
                            <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                                <i class="bi bi-gem"></i>
                                <h4>Control</h4>
                                <p>Anda dapat menemukan informasi penting tentang pengujian kendaraan bermotor dan
                                    mendapatkan rekomendasi terbaik untuk tempat pengujian</p>
                            </div>
                        </div><!-- End Icon Box -->

                        <div class="col-xl-4" data-aos="fade-up" data-aos-delay="400">
                            <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                                <i class="bi bi-inboxes"></i>
                                <h4>Safety</h4>
                                <p>Mari kita jaga bersama kesehatan dan keselamatan di jalan dengan memastikan kendaraan
                                    kita terawat dengan baik</p>
                            </div>
                        </div><!-- End Icon Box -->

                    </div>
                </div>

            </div>

        </div>

    </section><!-- /Why Us Section -->

    <!-- Features Section -->
    <section id="features" class="features section">

        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="features-item">
                        <i class="bi bi-calendar-check" style="color: #ffbb2c;"></i>
                        <h3><a href="https://play.google.com/store/apps/details?id=com.inotafstudio.kirgresik&pcampaignid=web_share"
                                class="stretched-link">Uji Berkala</a></h3>
                    </div>
                </div><!-- End Feature Item -->

                <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="features-item">
                        <i class="bi bi-truck" style="color: #5578ff;"></i>
                        <h3><a href="numpanguji/" class="stretched-link">Numpang Uji</a></h3>
                    </div>
                </div><!-- End Feature Item -->

                <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="features-item">
                        <i class="bi bi-arrow-left-right" style="color: #e80368;"></i>
                        <h3><a href="mutasi/" class="stretched-link">Mutasi</a></h3>
                    </div>
                </div><!-- End Feature Item -->

                <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="features-item">
                        <i class="bi bi-tools" style="color: #e361ff;"></i>
                        <h3><a href="rubah_bentuk/" class="stretched-link">Rubah Bentuk</a></h3>
                    </div>
                </div><!-- End Feature Item -->

                <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="500">
                    <div class="features-item">
                        <i class="bi bi-gear" style="color: #47aeff;"></i>
                        <h3><a href="rubah_sifat/" class="stretched-link">Rubah Sifat</a></h3>
                    </div>
                </div><!-- End Feature Item -->

                <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="700">
                    <div class="features-item">
                        <i class="bi bi-camera-video" style="color: #ffbb2c;"></i>
                        <h3><a href="cctv/" class="stretched-link">CCTV</a></h3>
                    </div>
                </div><!-- End Feature Item -->

            </div>

        </div>

    </section><!-- /Features Section -->

    <!-- Courses Section -->
    <section id="courses" class="courses section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Pelayanan</h2>
            <p>Pelayanan Rekomendasi</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row">

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                    <div class="course-item">
                        <img src="assets/img/course-1.jpg" class="img-fluid" alt="...">
                        <div class="course-content">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <p class="category">Mutasi</p>
                                <p class="price">$</p>
                            </div>

                            <h3><a href="mutasi/">Mutasi Kendaraan Bermotor</a></h3>
                            <p class="description">Kami siap membantu Anda dalam mengurus semua dokumen yang diperlukan
                                untuk mutasi kendaraan.</p>
                            <div class="trainer d-flex justify-content-between align-items-center">
                                <div class="trainer-profile d-flex align-items-center">
                                    <img src="assets/img/trainers/trainer-1-2.jpg" class="img-fluid" alt="">
                                    <a href="" class="trainer-link">Yulianto</a>
                                </div>
                                <div class="trainer-rank d-flex align-items-center">
                                    <i class="bi bi-person user-icon"></i>&nbsp;50
                                    &nbsp;&nbsp;
                                    <i class="bi bi-heart heart-icon"></i>&nbsp;65
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- End Course Item-->

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in"
                    data-aos-delay="200">
                    <div class="course-item">
                        <img src="assets/img/course-2.jpg" class="img-fluid" alt="...">
                        <div class="course-content">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <p class="category">Numpang Uji</p>
                                <p class="price">$</p>
                            </div>

                            <h3><a href="unmpanguji/">Numpang Uji Kendaraan Bermotor</a></h3>
                            <p class="description">Manfaatkan layanan numpang uji kendaraan kami untuk menghemat waktu
                                dan tenaga Anda.</p>
                            <div class="trainer d-flex justify-content-between align-items-center">
                                <div class="trainer-profile d-flex align-items-center">
                                    <img src="assets/img/trainers/trainer-2-2.jpg" class="img-fluid" alt="">
                                    <a href="" class="trainer-link">Silfi Maulidatur Rohmah</a>
                                </div>
                                <div class="trainer-rank d-flex align-items-center">
                                    <i class="bi bi-person user-icon"></i>&nbsp;35
                                    &nbsp;&nbsp;
                                    <i class="bi bi-heart heart-icon"></i>&nbsp;42
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- End Course Item-->

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0" data-aos="zoom-in"
                    data-aos-delay="300">
                    <div class="course-item">
                        <img src="assets/img/course-3.jpg" class="img-fluid" alt="...">
                        <div class="course-content">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <p class="category">Rubah Bentuk</p>
                                <p class="price">$</p>
                            </div>

                            <h3><a href="rubah_bentuk/">Rubah Bentuk Kendaraan Bermotor</a></h3>
                            <p class="description">Kami siap membantu Anda dalam mengurus semua dokumen yang diperlukan
                                untuk rubah bentuk kendaraan.</p>
                            <div class="trainer d-flex justify-content-between align-items-center">
                                <div class="trainer-profile d-flex align-items-center">
                                    <img src="assets/img/trainers/trainer-3-2.jpg" class="img-fluid" alt="">
                                    <a href="" class="trainer-link">Patriot Teguh</a>
                                </div>
                                <div class="trainer-rank d-flex align-items-center">
                                    <i class="bi bi-person user-icon"></i>&nbsp;20
                                    &nbsp;&nbsp;
                                    <i class="bi bi-heart heart-icon"></i>&nbsp;85
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- End Course Item-->

            </div>

        </div>

    </section><!-- /Courses Section -->

    <!-- Trainers Index Section -->
    <section id="trainers-index" class="section trainers-index">

        <div class="container">

            <div class="row">

                <div class="col-lg-4 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
                    <div class="member">
                        <img src="assets/img/trainers/trainer-1.jpg" class="img-fluid" alt="">
                        <div class="member-content">
                            <h4>Dwi Feri Ardiansyah</h4>
                            <span>Kepala UPT PKB</span>
                            <p>
                                Saya harap website ini dapat membantu masyarakat dalam mengurus pengujian kendaraan
                                bermotor dengan lebih mudah dan nyaman
                            </p>
                            <div class="social">
                                <a href=""><i class="bi bi-twitter-x"></i></a>
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>
                                <a href=""><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div><!-- End Team Member -->

                <div class="col-lg-4 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
                    <div class="member">
                        <img src="assets/img/trainers/trainer-2.jpg" class="img-fluid" alt="">
                        <div class="member-content">
                            <h4>Yulianto</h4>
                            <span>Administrasi Pengujian</span>
                            <p>
                                Website ini dibuat untuk membantu masyarakat dalam mendapatkan informasi tentang
                                persyaratan, prosedur, dan biaya pengujian kendaraan bermotor
                            </p>
                            <div class="social">
                                <a href=""><i class="bi bi-twitter-x"></i></a>
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>
                                <a href=""><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div><!-- End Team Member -->

                <div class="col-lg-4 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
                    <div class="member">
                        <img src="assets/img/trainers/trainer-3.jpg" class="img-fluid" alt="">
                        <div class="member-content">
                            <h4>Patriot Teguh</h4>
                            <span>Penguji Kendaraan Bermotor</span>
                            <p>
                                Saya harap website ini dapat membantu masyarakat dalam memahami pentingnya menjaga
                                kondisi kendaraan agar selalu prima dan aman di jalan
                            </p>
                            <div class="social">
                                <a href=""><i class="bi bi-twitter-x"></i></a>
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>
                                <a href=""><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div><!-- End Team Member -->

            </div>

        </div>

    </section><!-- /Trainers Index Section -->

</main>
<?php include("footer.php"); ?>