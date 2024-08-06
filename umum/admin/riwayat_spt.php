<?php
include_once 'koneksi.php';

// Mendapatkan daftar bulan unik dari tabel pengawasan
$query_months = "SELECT DISTINCT MONTH(tanggal) AS month FROM pengawasan WHERE status = 'Approved' ORDER BY month ASC";
$result_months = mysqli_query($koneksi, $query_months);
$months = [];
while ($row_month = mysqli_fetch_assoc($result_months)) {
    $month_num = $row_month['month'];
    $month_name = date("F", mktime(0, 0, 0, $month_num, 10));
    $months[$month_num] = $month_name;
}

// Mengatur default bulan
$current_month = isset($_GET['month']) ? $_GET['month'] : (count($months) > 0 ? array_keys($months)[0] : date('n'));

// Mendapatkan data pengawasan untuk bulan yang dipilih
$query_pengawasan = "SELECT * FROM pengawasan WHERE MONTH(tanggal) = $current_month AND status = 'Approved' ORDER BY tanggal DESC";
$result_pengawasan = mysqli_query($koneksi, $query_pengawasan);

?>

<?php include_once 'header.php'; ?>
<div class="container mt-5">
    <h2>Riwayat SPT</h2>
    <form action="" method="get" class="mb-3">
        <div class="form-row">
            <div class="col-auto">
                <label for="month">Pilih Bulan:</label>
                <select name="month" id="month" class="form-control" onchange="this.form.submit()">
                    <?php foreach ($months as $month_num => $month_name) : ?>
                        <option value="<?php echo $month_num; ?>" <?php if ($month_num == $current_month) echo 'selected'; ?>><?php echo $month_name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </form>
    <div class="table-responsive mt-3">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nomor Surat</th>
                    <th>Jenis Pengawasan</th>
                    <th>Tanggal</th>
                    <th>Deskripsi</th>
                    <th>Status</th>
                    <th>File</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result_pengawasan)) : ?>
                    <tr>
                        <td><?php echo $row['nomor_surat']; ?></td>
                        <td><?php echo $row['jenis_pengawasan']; ?></td>
                        <td><?php echo $row['tanggal']; ?></td>
                        <td><?php echo $row['deskripsi']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td>
                            <?php if (!empty($row['file_upload'])) : ?>
                                <a href="../admin/lib/spt/<?php echo $row['file_upload']; ?>" target="_blank">Lihat File</a>
                            <?php else : ?>
                                -
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="edit_spt.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                            <a href="hapus_spt.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
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