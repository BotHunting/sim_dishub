<?php include_once 'header.php'; ?>

<div class="container">
    <h1>Edit Parkir</h1>
    <?php
    include_once 'koneksi.php';

    // Cek apakah parameter id telah diterima dari URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Query untuk mengambil data parkir berdasarkan ID
        $sql = "SELECT * FROM parkir WHERE id = $id";
        $result = $koneksi->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
    ?>
            <!-- Form untuk mengedit parkir -->
            <form action="proses_edit_parkir.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <div class="mb-3">
                    <label for="lokasi" class="form-label">Lokasi Parkir:</label>
                    <input type="text" class="form-control" id="lokasi" name="lokasi" value="<?php echo $row['lokasi']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat:</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $row['alamat']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan:</label>
                    <textarea class="form-control" id="keterangan" name="keterangan"><?php echo $row['keterangan']; ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto:</label>
                    <input type="file" class="form-control" id="foto" name="foto">
                </div>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="tambah_parkir.php" class="btn btn-secondary">Kembali</a>
            </form>
    <?php
        } else {
            echo "<p>Data parkir tidak ditemukan.</p>";
        }
    } else {
        echo "<p>Parameter ID tidak ditemukan.</p>";
    }
    $koneksi->close();
    ?>
</div>
<?php include_once 'footer.php'; ?>
