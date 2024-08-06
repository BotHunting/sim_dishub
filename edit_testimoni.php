<?php
include_once 'config.php';

// Ambil ID dari URL
$id = $_GET['id'];

// Query untuk mendapatkan data testimoni berdasarkan ID
$sql = "SELECT * FROM testimoni_pelayanan WHERE id = $id";
$result = $koneksi->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
?>

    <?php include("header.php"); ?>
    <div class="container mt-5">
        <h2>Edit Testimoni Pelayanan</h2>
        <form action="proses_edit_testimoni.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <div class="form-group">
                <label for="sebutan">Sebutan:</label><br>
                <input type="text" class="form-control" id="sebutan" name="sebutan" value="<?php echo $row['sebutan']; ?>" required><br><br>
            </div>
            <div class="form-group">
                <label for="harga">Harga:</label><br>
                <input type="number" class="form-control" id="harga" name="harga" value="<?php echo $row['harga']; ?>" required><br><br>
            </div>
            <div class="form-group">
                <label for="nama">Nama:</label><br>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row['nama']; ?>" required><br><br>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan:</label><br>
                <textarea id="keterangan" class="form-control" name="keterangan" rows="4" required><?php echo $row['keterangan']; ?></textarea><br><br>
            </div>
            <div class="form-group">
                <label for="pejabat">Pejabat:</label><br>
                <input type="text" class="form-control" id="pejabat" name="pejabat" value="<?php echo $row['pejabat']; ?>" required><br><br>
            </div>
            <div class="form-group">
                <label for="foto">Foto:</label><br>
                <input type="file" class="form-control" id="foto" name="foto" accept="image/*"><br>
                <?php if (!empty($row['foto'])) : ?>
                    <img src="assets/img/trainers/<?php echo $row['foto']; ?>" alt="Foto Lama" style="max-width: 200px;">
                    <input type="hidden" name="foto_lama" value="<?php echo $row['foto']; ?>">
                <?php endif; ?>
            </div><br>
            <div class="form-group">
                <label for="gambar">Gambar:</label><br>
                <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*" required><br>
                <?php if (!empty($row['gambar'])) : ?>
                    <img src="assets/img/pelayanan/<?php echo $row['gambar']; ?>" alt="Gambar Lama" style="max-width: 200px;">
                    <input type="hidden" name="gambar_lama" value="<?php echo $row['gambar']; ?>">
                <?php endif; ?>
            </div><br>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="setting_pelayanan.php" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>

<?php
} else {
    echo "Data tidak ditemukan.";
}
?>
<?php include("footer.php"); ?>