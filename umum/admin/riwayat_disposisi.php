<?php
include_once 'koneksi.php';

// Mendapatkan daftar bulan unik dari tabel disposisi
$query_months = "SELECT DISTINCT MONTH(tanggal) AS month FROM disposisi WHERE status = 'Approved' ORDER BY month ASC";
$result_months = mysqli_query($koneksi, $query_months);
$months = [];
while ($row_month = mysqli_fetch_assoc($result_months)) {
    $month_num = $row_month['month'];
    $month_name = date("F", mktime(0, 0, 0, $month_num, 10));
    $months[$month_num] = $month_name;
}

// Mengatur default bulan
$current_month = isset($_GET['month']) ? $_GET['month'] : (count($months) > 0 ? array_keys($months)[0] : date('n'));

// Mendapatkan data disposisi untuk bulan yang dipilih
$query_disposisi = "SELECT * FROM disposisi WHERE MONTH(tanggal) = $current_month AND status = 'Approved' ORDER BY tanggal DESC";
$result_disposisi = mysqli_query($koneksi, $query_disposisi);

?>

<?php include_once 'header.php'; ?>
<div class="container mt-5">
    <h2>Riwayat Disposisi</h2>
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
                    <th>Tanggal</th>
                    <th>Pengirim</th>
                    <th>Penerima</th>
                    <th>Judul</th>
                    <th>Isi</th>
                    <th>File</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result_disposisi)) : ?>
                    <tr>
                        <td><?php echo $row['tanggal']; ?></td>
                        <td><?php echo $row['pengirim']; ?></td>
                        <td><?php echo $row['penerima']; ?></td>
                        <td><?php echo $row['judul']; ?></td>
                        <td><?php echo $row['isi']; ?></td>
                        <td>
                            <?php if (!empty($row['file_upload'])) : ?>
                                <a href="lib/disposisi/<?php echo $row['file_upload']; ?>" target="_blank">Lihat File</a>
                            <?php else : ?>
                                -
                            <?php endif; ?>
                        </td>
                        <td><?php echo $row['status']; ?></td>
                        <td>
                            <a href="edit_disposisi.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                            <a href="hapus_disposisi.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="disposisi.php" class="btn btn-secondary">Kembali</a>
    </div>
</div>
<div style="height: 100px;"></div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>