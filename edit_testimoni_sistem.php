<?php
include_once 'config.php';

// Cek apakah parameter id diberikan
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mengambil data testimoni dengan id tertentu
    $sql = "SELECT * FROM testimoni_sistem WHERE id = $id";
    $result = $koneksi->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
?>
        <?php include("header.php"); ?>
        <div class="container mt-5">
            <h2 class="mb-4">Edit Testimoni Sistem</h2>
            <div class="row">
                <form action="proses_edit_testimoni_sistem.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <div>
                        <label for="nama">Nama:</label><br>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row['nama']; ?>" required><br><br>
                    </div>
                    <div>
                        <label for="jabatan">Jabatan:</label><br>
                        <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?php echo $row['jabatan']; ?>" required><br><br>
                    </div>
                    <div>
                        <label for="keterangan">Keterangan:</label><br>
                        <textarea id="keterangan" class="form-control" name="keterangan" rows="4" required><?php echo $row['keterangan']; ?></textarea><br><br>
                    </div>
                    <div>
                        <label for="foto">Foto:</label><br>
                        <input type="file" class="form-control" id="foto" name="foto" accept="image/*"><br><br>
                        <?php if (!empty($row['foto'])) : ?>
                            <img src="assets/img/testimonials/<?php echo $row['foto']; ?>" alt="Foto Lama" style="max-width: 200px;">
                            <input type="hidden" name="foto_lama" value="<?php echo $row['foto']; ?>">
                        <?php endif; ?>
                    </div><br>
                    <div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="testi_sistem.php" class="btn btn-secondary">Kembali</a>
                    </div><br>
                </form>
            </div>
        </div>
<?php
    } else {
        echo "Testimoni tidak ditemukan.";
    }
} else {
    echo "ID testimoni tidak diberikan.";
}
?>
<?php include("footer.php"); ?>