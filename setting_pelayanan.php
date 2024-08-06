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
                        <h1>Menu Pelayanan</h1>
                        <p class="mb-0">Dinas Perhubungan Kabupaten Fakfak berkomitmen untuk memberikan pelayanan terbaik bagi masyarakat. Kami terus berbenah dan berinovasi untuk menghadirkan layanan yang cepat, mudah, dan memuaskan.</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="index.php">Home</a></li>
                    <li class="current">Services</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <div class="container mt-5">
        <h2>Form Testimoni Pelayanan</h2>
        <form action="proses_input_testimoni_pelayanan.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="sebutan">Sebutan:</label><br>
                <input type="text" class="form-control" id="sebutan" name="sebutan" required><br>
            </div>
            <div class="form-group">
                <label for="harga">Harga:</label><br>
                <input type="number" class="form-control" id="harga" name="harga" required><br>
            </div>
            <div class="form-group">
                <label for="nama">Nama:</label><br>
                <input type="text" class="form-control" id="nama" name="nama" required><br>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan:</label><br>
                <textarea id="keterangan" class="form-control" name="keterangan" rows="4" required></textarea><br>
            </div>
            <div class="form-group">
                <label for="pejabat">Pejabat:</label><br>
                <input type="text" class="form-control" id="pejabat" name="pejabat" required><br>
            </div>
            <div class="form-group">
                <label for="foto">Foto:</label><br>
                <input type="file" class="form-control" id="foto" name="foto" accept="image/*" required><br>
            </div>
            <div class="form-group">
                <label for="gambar">Gambar:</label><br>
                <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*" required><br>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Kirim Testimoni</button>
                <a href="setting.php" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>

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
                                    <div class="mt-3">
                                        <a href="edit_testimoni.php?id=<?php echo $row['id']; ?>" class="btn btn-primary mr-2">Edit</a> |
                                        <a href="hapus_testimoni.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Hapus</a>
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

</main>
<?php include("footer.php"); ?>