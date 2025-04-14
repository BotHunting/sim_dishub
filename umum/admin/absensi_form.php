<?php
session_start();
require_once '../../config.php'; // Update to use config.php
$query_pegawai = "SELECT id, nama FROM pegawai";
$stmt = $koneksi->prepare($query_pegawai);
$stmt->execute();
$result_pegawai = $stmt->get_result();
$pegawai_list = [];
if ($result_pegawai && $result_pegawai->num_rows > 0) {
    while ($row_pegawai = $result_pegawai->fetch_assoc()) {
        $pegawai_list[] = $row_pegawai;
    }
}
?>

<?php include_once 'header.php'; ?>
<div class="container mt-5">
    <h1 class="mb-4">Form Cetak Absensi Harian</h1>
    <form action="cetak_absensi.php" method="post">
        <div class="form-group">
            <label for="tanggal">Tanggal:</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
        </div>
        <div class="form-group">
            <label>Pilih Pegawai:</label>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="select-all">
                <label class="form-check-label" for="select-all">Pilih Semua</label>
            </div>
            <div>
                <?php foreach ($pegawai_list as $pegawai) : ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="pegawai[]" value="<?php echo htmlspecialchars($pegawai['id']); ?>" id="pegawai_<?php echo htmlspecialchars($pegawai['id']); ?>">
                        <label class="form-check-label" for="pegawai_<?php echo htmlspecialchars($pegawai['id']); ?>">
                            <?php echo htmlspecialchars($pegawai['nama']); ?>
                        </label>
                        <select class="form-control" name="status_<?php echo htmlspecialchars($pegawai['id']); ?>">
                            <option value="hadir">Hadir</option>
                            <option value="Izin">Izin</option>
                            <option value="Cuti">Cuti</option>
                            <option value="Sakit">Sakit</option>
                            <option value="Dinas Luar">Dinas Luar</option>
                            <option value="Tanpa Keterangan">Tanpa Keterangan</option>
                        </select>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Cetak Absensi</button>
        <a href="pegawai.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
<script>
    document.getElementById('select-all').addEventListener('change', function() {
        var checkboxes = document.querySelectorAll('[name="pegawai[]"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = this.checked;
        }.bind(this));
    });
</script>
<div style="height: 100px;"></div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>