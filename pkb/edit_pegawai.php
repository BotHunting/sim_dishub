<?php
include("header.php");
include("config.php"); // Mengimpor koneksi database dari config.php

// Mengambil ID pegawai dari URL
$id = $_GET['id'];

// Query untuk mengambil data pegawai berdasarkan ID
$sql = "SELECT * FROM pegawai WHERE id = $id";
$result = $conn->query($sql);

// Mengecek apakah data pegawai ditemukan
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Data pegawai tidak ditemukan.";
    exit();
}
?>

<main class="main">

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Edit Pegawai</h1>
                        <p class="mb-0">Ubah data pegawai sesuai kebutuhan</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="trainers.php">Pegawai</a></li>
                    <li class="current">Edit Pegawai</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <div class="container mt-5">
        <h2>Form Edit Pegawai</h2>
        <form action="proses_editpegawai.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>"> <!-- ID Pegawai -->
            <div class="form-group">
                <label for="nama">Nama Pegawai:</label><br>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row['nama']; ?>" required><br><br>
            </div>
            <div class="form-group">
                <label for="jabatan">Jabatan:</label><br>
                <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?php echo $row['jabatan']; ?>" required><br><br>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi:</label><br>
                <textarea id="deskripsi" class="form-control" name="deskripsi" rows="4" required><?php echo $row['deskripsi']; ?></textarea><br><br>
            </div>
            <div class="form-group">
                <label for="foto">Foto Pegawai:</label><br>
                <input type="file" class="form-control" id="foto" name="foto" accept="image/*"><br><br>
                <img src="assets/img/trainers/<?php echo $row['foto']; ?>" class="img-fluid" width="150" alt="Foto Pegawai"><br><br>
            </div>
            <div class="form-group">
                <label for="twitter">Twitter (URL):</label><br>
                <input type="text" class="form-control" id="twitter" name="twitter" value="<?php echo $row['twitter']; ?>"><br><br>
            </div>
            <div class="form-group">
                <label for="facebook">Facebook (URL):</label><br>
                <input type="text" class="form-control" id="facebook" name="facebook" value="<?php echo $row['facebook']; ?>"><br><br>
            </div>
            <div class="form-group">
                <label for="instagram">Instagram (URL):</label><br>
                <input type="text" class="form-control" id="instagram" name="instagram" value="<?php echo $row['instagram']; ?>"><br><br>
            </div>
            <div class="form-group">
                <label for="linkedin">LinkedIn (URL):</label><br>
                <input type="text" class="form-control" id="linkedin" name="linkedin" value="<?php echo $row['linkedin']; ?>"><br><br>
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $row['username']; ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Leave empty if not changing">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="trainers.php" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>

</main>

<?php include("footer.php"); ?>
