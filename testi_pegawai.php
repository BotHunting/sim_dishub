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
                        <h1>Bersama Membangun Mobilitas Fakfak yang Lebih Baik!</h1>
                        <p class="mb-0">Tim yang solid dan profesional: Kami terdiri dari para ASN dan tenaga honorer yang berkomitmen untuk memberikan pelayanan terbaik bagi masyarakat Fakfak.</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="index.php">Home</a></li>
                    <li class="current">Pegawai</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <div class="container mt-5">
        <h2>Form Testimoni Pegawai</h2>
        <form action="proses_input_testimoni_pegawai.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama">Nama:</label><br>
                <input type="text" class="form-control" id="nama" name="nama" required><br><br>
            </div>
            <div class="form-group">
                <label for="jabatan">Jabatan:</label><br>
                <input type="text" class="form-control" id="jabatan" name="jabatan" required><br><br>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan:</label><br>
                <textarea id="keterangan" class="form-control" name="keterangan" rows="4" required></textarea><br><br>
            </div>
            <div class="form-group">
                <label for="foto">Foto:</label><br>
                <input type="file" class="form-control" id="foto" name="foto" accept="image/*" required><br><br>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Kirim Testimoni</button>
                <a href="setting.php" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>

    <!-- Trainers Section -->
    <section id="trainers" class="section trainers">

        <div class="container">

            <div class="row gy-5">

                <?php
                // Include file konfigurasi database
                include_once 'config.php';

                // Query untuk mengambil data dari tabel testimoni_pegawai
                $sql = "SELECT * FROM testimoni_pegawai";
                $result = $koneksi->query($sql);

                if ($result->num_rows > 0) {
                    // Loop untuk menampilkan data dalam bentuk card
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="100">
                            <div class="member-img">
                                <img src="assets/img/team/<?php echo $row['foto']; ?>" class="img-fluid" alt="">
                                <div class="social">
                                    <a href="#"><i class="bi bi-twitter"></i></a>
                                    <a href="#"><i class="bi bi-facebook"></i></a>
                                    <a href="#"><i class="bi bi-instagram"></i></a>
                                    <a href="#"><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="member-info text-center">
                                <h4><?php echo $row['nama']; ?></h4>
                                <span class=""><?php echo $row['jabatan']; ?></span>
                                <p><?php echo $row['keterangan']; ?></p>
                                <!-- Tombol aksi edit dan hapus -->
                                <div class="mt-3">
                                    <a href="edit_testimoni_pegawai.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Edit</a> | 
                                    <a href="hapus_testimoni_pegawai.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Hapus</a>
                                </div>
                            </div>
                        </div><!-- End Team Member -->
                <?php
                    }
                } else {
                    echo "Data tidak ditemukan.";
                }
                ?>
            </div>
        </div>
    </section><!-- /Trainers Section -->

</main>
<?php include("footer.php"); ?>