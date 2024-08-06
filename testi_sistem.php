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
                        <h1 class="">Testimoni Sistem<br></h1>
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

    <div class="container mt-5">
        <h2>Form Testimoni Sistem</h2>
        <div class="row">
            <form action="proses_input_testimoni_sistem.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="text" class="form-control" id="nama" name="nama" required><br>
                </div>
                <div class="form-group">
                    <label for="jabatan">Jabatan:</label>
                    <input type="text" class="form-control" id="jabatan" name="jabatan" required><br>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan:</label>
                    <textarea class="form-control" id="keterangan" name="keterangan" rows="4" required></textarea><br>
                </div>
                <div class="form-group">
                    <label for="foto">Foto:</label>
                    <input type="file" class="form-control" id="foto" name="foto" accept="image/*" required><br>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="setting.php" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>


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
                            echo '            <div class="actions">';
                            echo '                <a href="edit_testimoni_sistem.php?id=' . $row['id'] . '" class="btn btn-primary btn-sm">Edit</a>';
                            echo '                <form action="hapus_testimoni_sistem.php" method="post" class="form-hapus">';
                            echo '                    <input type="hidden" name="id" value="' . $row['id'] . '">';
                            echo '                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>';
                            echo '                </form>';
                            echo '            </div>';
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