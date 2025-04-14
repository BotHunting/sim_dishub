<?php include_once 'header.php'; ?>
<div class="container mt-5">
    <h2>Edit Layanan</h2>
    <link rel="icon" href="img/logo.png" type="image/png">
    <?php
    // Include file koneksi database
    include_once '../../config.php';
    // Periksa apakah parameter id telah diberikan
    if (isset($_GET['id'])) {
        // Menggunakan prepared statement untuk menghindari SQL Injection
        $id = $_GET['id'];
        $stmt = $koneksi->prepare("SELECT * FROM pelayananumum WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
    ?>
            <!-- Form untuk mengedit layanan -->
            <form action="proses_edit_layanan.php" method="post">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                <div class="form-group">
                    <label for="tanggal">Tanggal:</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo htmlspecialchars($row['tanggal']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="nama_layanan">Nama Layanan:</label>
                    <input type="text" class="form-control" id="nama_layanan" name="nama_layanan" value="<?php echo htmlspecialchars($row['nama_layanan']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi:</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5" required><?php echo htmlspecialchars($row['deskripsi']); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="pemohon">Nama Pemohon:</label>
                    <input type="text" class="form-control" id="pemohon" name="pemohon" value="<?php echo htmlspecialchars($row['pemohon']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="status">Status:</label>
                    <select id="status" name="status" class="form-control" required>
                        <option value="Pending" <?php echo ($row['status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                        <option value="Approved" <?php echo ($row['status'] == 'Approved') ? 'selected' : ''; ?>>Approved</option>
                        <option value="Rejected" <?php echo ($row['status'] == 'Rejected') ? 'selected' : ''; ?>>Rejected</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="file_google_drive">Link Google Drive:</label>
                    <input type="url" class="form-control" id="file_google_drive" name="file_google_drive" value="<?php echo htmlspecialchars($row['file_google_drive']); ?>" required>
                    <small class="form-text text-muted">Masukkan link file dari Google Drive (contoh: https://drive.google.com/...)</small>
                </div>
                <div class="mb-3">
                    <label>Link Sebelumnya:</label>
                    <?php if (!empty($row['file_google_drive'])) : ?>
                        <a href="<?php echo htmlspecialchars($row['file_google_drive']); ?>" class="btn btn-info" target="_blank">Lihat File</a>
                    <?php else : ?>
                        <span class="text-muted">Tidak ada link sebelumnya</span>
                    <?php endif; ?>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="javascript:history.go(-1);" class="btn btn-secondary">Kembali</a>
            </form>

    <?php
        } else {
            echo "<p>Data layanan tidak ditemukan.</p>";
        }
        $stmt->close();
    } else {
        echo "<p>Parameter id tidak diberikan.</p>";
    }
    ?>
</div>
<div style="height: 100px;"></div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
