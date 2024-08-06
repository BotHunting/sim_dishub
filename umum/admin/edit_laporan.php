<?php
// Include file koneksi database
include_once 'koneksi.php';

// Tangkap ID laporan yang akan diedit
$id = $_GET['id'];

// Menggunakan prepared statement untuk menghindari SQL Injection
$stmt = $koneksi->prepare("SELECT * FROM laporan WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// Memeriksa apakah data ditemukan
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
?>
    <?php include_once 'header.php'; ?>
    <div class="container mt-5">
        <h1 class="mt-4">Edit Laporan</h1>
        <form action="proses_edit_laporan.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo htmlspecialchars($row['tanggal']); ?>" required>
            </div>
            <div class="mb-3">
                <label>Nomor Surat:</label>
                <input type="text" class="form-control" name="nomor_surat" value="<?php echo htmlspecialchars($row['nomor_surat']); ?>" required>
            </div>
            <div class="mb-3">
                <label>Jenis Laporan:</label>
                <select name="jenis_laporan" class="form-control">
                    <option value="Harian" <?php echo ($row['jenis_laporan'] == 'Harian') ? 'selected' : ''; ?>>Harian</option>
                    <option value="Mingguan" <?php echo ($row['jenis_laporan'] == 'Mingguan') ? 'selected' : ''; ?>>Mingguan</option>
                    <option value="Bulanan" <?php echo ($row['jenis_laporan'] == 'Bulanan') ? 'selected' : ''; ?>>Bulanan</option>
                    <option value="Tahunan" <?php echo ($row['jenis_laporan'] == 'Tahunan') ? 'selected' : ''; ?>>Tahunan</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="isi" class="form-label">Isi Laporan</label>
                <textarea class="form-control" id="isi" name="isi" rows="3" required><?php echo htmlspecialchars($row['isi']); ?></textarea>
            </div>
            <div class="mb-3">
                <label>Status:</label>
                <select name="status" class="form-control">
                    <option value="Pending" <?php if ($row['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                    <option value="Approved" <?php if ($row['status'] == 'Approved') echo 'selected'; ?>>Approved</option>
                    <option value="Rejected" <?php if ($row['status'] == 'Rejected') echo 'selected'; ?>>Rejected</option>
                </select>
            </div>
            <div class="mb-3">
                <label>File Sebelumnya:</label>
                <?php if (!empty($row['file_upload'])) : ?>
                    <a href="lib/laporan/<?php echo htmlspecialchars($row['file_upload']); ?>" class="btn btn-info" target="_blank">Lihat File</a>
                <?php else : ?>
                    <span class="text-muted">Tidak ada file sebelumnya</span>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label>Upload File Baru (jika ingin diperbarui):</label>
                <input type="file" class="form-control-file" name="file">
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="javascript:history.go(-1);" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
<?php } else {
    echo "Data tidak ditemukan";
} ?>
<div style="height: 100px;"></div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>