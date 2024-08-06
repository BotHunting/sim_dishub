<?php
session_start();

include_once 'config.php';
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

?>


<?php include("header.php"); ?>
<main class="main">

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Testimoni Home</h1>
                        <p class="mb-0">Atur Sesuai Keinginan Anda.</p>
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
        <h2>Form Testimoni</h2>
        <form action="proses_input_testimoni.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" required><br><br>
            </div>
            <div class="form-group">
                <label for="jabatan">Jabatan:</label>
                <input type="text" class="form-control" id="jabatan" name="jabatan" required><br><br>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan:</label>
                <textarea class="form-control" id="keterangan" name="keterangan" rows="4" required></textarea><br><br>
            </div>
            <div class="form-group">
                <label for="foto">Foto:</label>
                <input type="file" class="form-control" id="foto" name="foto" accept="image/*" required><br><br>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="setting.php" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>

    <!-- Trainers Index Section -->
    <section id="trainers-index" class="section trainers-index">
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
                                        <!-- Tambahkan tombol edit dan hapus -->
                                        <a href="edit_testimoni_home.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Edit</a> | 
                                        <a href="hapus_testimoni_home.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Hapus</a>
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