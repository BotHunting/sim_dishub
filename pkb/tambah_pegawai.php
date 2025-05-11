<?php
include("header.php");
include("config.php"); // Mengimpor koneksi database dari config.php
?>

<main class="main">

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Tambah Pegawai Baru</h1>
                        <p class="mb-0">Tim yang solid dan profesional: Kami terdiri dari para ASN dan tenaga honorer yang berkomitmen untuk memberikan pelayanan terbaik bagi masyarakat Fakfak.</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="trainers.php">Pegawai</a></li>
                    <li class="current">Tambah Pegawai</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <div class="container mt-5">
        <h2>Form Tambah Pegawai</h2>
        <form action="proses_tambahpegawai.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama">Nama Pegawai:</label><br>
                <input type="text" class="form-control" id="nama" name="nama" required><br><br>
            </div>
            <div class="form-group">
                <label for="jabatan">Jabatan:</label><br>
                <input type="text" class="form-control" id="jabatan" name="jabatan" required><br><br>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi:</label><br>
                <textarea id="deskripsi" class="form-control" name="deskripsi" rows="4" required></textarea><br><br>
            </div>
            <div class="form-group">
                <label for="foto">Foto Pegawai:</label><br>
                <input type="file" class="form-control" id="foto" name="foto" accept="image/*" required><br><br>
            </div>
            <div class="form-group">
                <label for="twitter">Twitter (URL):</label><br>
                <input type="text" class="form-control" id="twitter" name="twitter"><br><br>
            </div>
            <div class="form-group">
                <label for="facebook">Facebook (URL):</label><br>
                <input type="text" class="form-control" id="facebook" name="facebook"><br><br>
            </div>
            <div class="form-group">
                <label for="instagram">Instagram (URL):</label><br>
                <input type="text" class="form-control" id="instagram" name="instagram"><br><br>
            </div>
            <div class="form-group">
                <label for="linkedin">LinkedIn (URL):</label><br>
                <input type="text" class="form-control" id="linkedin" name="linkedin"><br><br>
            </div>
            <div class="form-group">
                <label for="username">Username:</label><br>
                <input type="text" class="form-control" id="username" name="username" required><br><br>
            </div>
            <div class="form-group">
                <label for="password">Password:</label><br>
                <input type="password" class="form-control" id="password" name="password" required><br><br>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="trainers.php" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>

</main>

<?php include("footer.php"); ?>
