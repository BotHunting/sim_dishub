<?php
session_start();

// Inisialisasi variabel $logout_button
$logout_button = '';

// Cek apakah pengguna sudah login atau belum
if (isset($_SESSION['username'])) {
    // Jika sudah login, tampilkan tombol logout
    $logout_button = '<a class="nav-link" href="logout.php">Logout</a>';
} else {
    // Jika belum login, tampilkan tombol login
    $logout_button = '<a class="nav-link" href="login.php">Login</a>';
    $whatsapp_button = ''; // Jangan tampilkan tombol WhatsApp jika belum login
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
                        <h1>Pengaturan</h1>
                        <p class="mb-0">Halaman pengaturan website Sistem Informasi Dishub Fakfak memungkinkan Anda untuk mengelola berbagai aspek website.</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="index.html">Home</a></li>
                    <li class="current">Pengaturan</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <!-- Courses Course Details Section -->
    <section id="courses-course-details" class="courses-course-details section">

        <div class="container" data-aos="fade-up">

            <div class="row">
                <div class="col-lg-8">
                    <img src="assets/img/course-details.jpg" class="img-fluid" alt="">
                    <h3>Halaman Pengaturan Website Sistem Informasi Dishub Fakfak</h3>
                    <p>
                        Halaman pengaturan website Sistem Informasi Dishub Fakfak memungkinkan Anda untuk mengelola berbagai aspek website. Berikut adalah beberapa fitur yang tersedia di halaman pengaturan.
                    </p>
                </div>
                <div class="col-lg-4">

                    <div class="course-info d-flex justify-content-between align-items-center">
                        <h5>Pengaturan Umum</h5>
                    </div>

                    <div class="course-info d-flex justify-content-between align-items-center">
                        <h5>Pengaturan Pengguna</h5>
                    </div>

                    <div class="course-info d-flex justify-content-between align-items-center">
                        <h5>Pengaturan Menu</h5>
                    </div>

                    <div class="course-info d-flex justify-content-between align-items-center">
                        <h5>Pengaturan Konten</h5>
                    </div>

                </div>
            </div>

        </div>

    </section><!-- /Courses Course Details Section -->

    <!-- Tabs Section -->
    <section id="tabs" class="tabs section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row">
                <div class="col-lg-3">
                    <ul class="nav nav-tabs flex-column">
                        <li class="nav-item">
                            <a class="nav-link active show" data-bs-toggle="tab" href="#tab-1">Testimoni Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tab-2">Testimoni Sistem</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tab-3">Menu Pelayanan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tab-4">Testimoni Pegawai</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tab-5">Waktu Pelayanan</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-9 mt-4 mt-lg-0">
                    <div class="tab-content">
                        <div class="tab-pane active show" id="tab-1">
                            <div class="row">
                                <div class="col-lg-8 details order-2 order-lg-1">
                                    <h3>Testimoni Home</h3>
                                    <p class="fst-italic">Temukan pengalaman dan testimoni dari pengguna layanan kami</p>
                                    <form action="testi_home.php">
                                        <input type="submit" value="Setting" class="btn btn-primary">
                                    </form>
                                </div>
                                <div class="col-lg-4 text-center order-1 order-lg-2">
                                    <img src="assets/img/tabs/tab-1.png" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-2">
                            <div class="row">
                                <div class="col-lg-8 details order-2 order-lg-1">
                                    <h3>Testimoni Sistem</h3>
                                    <p class="fst-italic">Bagikan pengalaman Anda menggunakan sistem kami</p>
                                    <form action="testi_sistem.php">
                                        <input type="submit" value="Setting" class="btn btn-primary">
                                    </form>
                                </div>
                                <div class="col-lg-4 text-center order-1 order-lg-2">
                                    <img src="assets/img/tabs/tab-2.png" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-3">
                            <div class="row">
                                <div class="col-lg-8 details order-2 order-lg-1">
                                    <h3>Jenis Pelayanan</h3>
                                    <p class="fst-italic">Menu jenis pelayanan kami</p>
                                    <form action="setting_pelayanan.php">
                                        <input type="submit" value="Setting" class="btn btn-primary">
                                    </form>
                                </div>
                                <div class="col-lg-4 text-center order-1 order-lg-2">
                                    <img src="assets/img/tabs/tab-3.png" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-4">
                            <div class="row">
                                <div class="col-lg-8 details order-2 order-lg-1">
                                    <h3>Testimoni Pegawai</h3>
                                    <p class="fst-italic">Dengarkan testimoni dari para pegawai kami</p>
                                    <form action="testi_pegawai.php">
                                        <input type="submit" value="Setting" class="btn btn-primary">
                                    </form>
                                </div>
                                <div class="col-lg-4 text-center order-1 order-lg-2">
                                    <img src="assets/img/tabs/tab-4.png" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-5">
                            <div class="row">
                                <div class="col-lg-8 details order-2 order-lg-1">
                                    <h3>Pelayanan</h3>
                                    <p class="fst-italic">Temukan berbagai layanan yang kami tawarkan</p>
                                    <form action="setting_pelayanan_kantor.php">
                                        <input type="submit" value="Setting" class="btn btn-primary">
                                    </form>
                                </div>
                                <div class="col-lg-4 text-center order-1 order-lg-2">
                                    <img src="assets/img/tabs/tab-5.png" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section><!-- /Tabs Section -->

</main>

<?php include("footer.php"); ?>