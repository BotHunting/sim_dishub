<?php
include_once 'koneksi.php';

// Mendapatkan daftar bulan unik dari tabel pelayananumum
$query_months = "SELECT DISTINCT MONTH(tanggal) AS month, YEAR(tanggal) AS year FROM pelayananumum WHERE status IN ('Approved', 'Rejected') ORDER BY year, month ASC";
$result_months = mysqli_query($koneksi, $query_months);
$months = [];
while ($row_month = mysqli_fetch_assoc($result_months)) {
    $month_num = $row_month['month'];
    $year = $row_month['year'];
    $month_name = date("F Y", mktime(0, 0, 0, $month_num, 10, $year));
    $months["$year-$month_num"] = $month_name;
}

// Mengatur default bulan
$current_month = isset($_GET['month']) ? mysqli_real_escape_string($koneksi, $_GET['month']) : (count($months) > 0 ? array_keys($months)[0] : date('Y-n'));
list($current_year, $current_month_num) = explode('-', $current_month);

// Mendapatkan data pelayananumum untuk bulan yang dipilih
$query_pelayananumum = "SELECT * FROM pelayananumum WHERE YEAR(tanggal) = ? AND MONTH(tanggal) = ? AND status IN ('Approved', 'Rejected') ORDER BY tanggal DESC";
$stmt = $koneksi->prepare($query_pelayananumum);
$stmt->bind_param("ii", $current_year, $current_month_num);
$stmt->execute();
$result_pelayananumum = $stmt->get_result();
?>

<?php include_once 'header.php'; ?>
<div class="container mt-5">
    <h2>Riwayat Pelayanan</h2>
    <form action="" method="get" class="mb-3">
        <div class="form-row">
            <div class="col-auto">
                <label for="month">Pilih Bulan:</label>
                <select name="month" id="month" class="form-control" onchange="this.form.submit()">
                    <?php foreach ($months as $month_key => $month_name) : ?>
                        <option value="<?php echo $month_key; ?>" <?php if ($month_key == $current_month) echo 'selected'; ?>><?php echo $month_name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </form>
    <div class="table-responsive mt-3">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Nama Layanan</th>
                    <th>Deskripsi</th>
                    <th>File</th>
                    <th>Pemohon</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result_pelayananumum->num_rows > 0) : ?>
                    <?php while ($row = $result_pelayananumum->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['tanggal']); ?></td>
                            <td><?php echo htmlspecialchars($row['nama_layanan']); ?></td>
                            <td><?php echo htmlspecialchars($row['deskripsi']); ?></td>
                            <td>
                                <?php if (!empty($row['file_google_drive'])) : ?>
                                    <a href="<?php echo htmlspecialchars($row['file_google_drive']); ?>" target="_blank" class="btn btn-sm btn-primary">Lihat File</a>
                                <?php else : ?>
                                    <span class="text-muted">Tidak ada file</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo htmlspecialchars($row['pemohon']); ?></td>
                            <td><?php echo htmlspecialchars($row['status']); ?></td>
                            <td>
                                <a href="edit_layanan.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="hapus_layanan.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data pelayanan untuk bulan ini.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="javascript:history.go(-1);" class="btn btn-secondary">Kembali</a>
    </div>
</div>
<div style="height: 100px;"></div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
