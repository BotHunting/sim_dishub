<?php
include_once 'config.php';

// Mengecek apakah parameter id tersedia
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mendapatkan data testimoni berdasarkan id
    $sql = "SELECT * FROM testimoni_home WHERE id = $id";
    $result = $koneksi->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $nama = $row['nama'];
        $jabatan = $row['jabatan'];
        $keterangan = $row['keterangan'];
        $foto_lama = $row['foto'];
    } else {
        // Redirect jika id tidak valid
        header("Location: index.php");
        exit();
    }
} else {
    // Redirect jika id tidak tersedia
    header("Location: index.php");
    exit();
}

// Proses update testimoni
if (isset($_POST['submit'])) {
    $nama_baru = $_POST['nama'];
    $jabatan_baru = $_POST['jabatan'];
    $keterangan_baru = $_POST['keterangan'];

    // Upload foto baru jika dipilih
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $nama_file = $_FILES['foto']['name'];
        $lokasi_file = $_FILES['foto']['tmp_name'];
        $ekstensi_file = pathinfo($nama_file, PATHINFO_EXTENSION);

        // Mendapatkan ekstensi file
        $foto_baru = uniqid() . '.' . $ekstensi_file;

        // Pindahkan file ke folder tujuan
        move_uploaded_file($lokasi_file, "assets/img/testihome/$foto_baru");
    } else {
        // Gunakan foto lama jika tidak ada foto baru dipilih
        $foto_baru = $foto_lama;
    }

    // Update data testimoni
    $sql_update = "UPDATE testimoni_home SET nama='$nama_baru', jabatan='$jabatan_baru', keterangan='$keterangan_baru', foto='$foto_baru' WHERE id=$id";
    if ($koneksi->query($sql_update) === TRUE) {
        echo "Testimoni berhasil diperbarui.";
    } else {
        echo "Error: " . $sql_update . "<br>" . $koneksi->error;
    }

    // Redirect ke halaman utama setelah update
    header("Location: testi_home.php");
    exit();
}
?>

<?php include("header.php"); ?>
<div class="container mt-5">
    <h2 class="mb-4">Edit Testimoni</h2>
    <div class="row">
        <form action="" method="POST" enctype="multipart/form-data">
            <label for="nama">Nama:</label><br>
            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama; ?>"><br><br>

            <label for="jabatan">Jabatan:</label><br>
            <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?php echo $jabatan; ?>"><br><br>

            <label for="keterangan">Keterangan:</label><br>
            <textarea id="keterangan" class="form-control" name="keterangan"><?php echo $keterangan; ?></textarea><br><br>

            <label for="foto">Foto:</label><br>
            <input type="file" class="form-control" id="foto" name="foto"><br><br>
            <?php if (!empty($row['foto'])) : ?>
                <img src="assets/img/testihome/<?php echo $row['foto']; ?>" alt="Foto Lama" style="max-width: 200px;">
                <input type="hidden" name="foto_lama" value="<?php echo $row['foto']; ?>">
            <?php endif; ?>
    </div><br>

    <input type="submit" class="btn btn-primary" name="submit" value="Simpan">
    <a href="testi_home.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</div>
<?php include("footer.php"); ?>