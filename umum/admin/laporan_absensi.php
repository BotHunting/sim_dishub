<?php
require_once 'koneksi.php';

// Fungsi untuk mengambil data riwayat absensi berdasarkan rentang waktu
function getRiwayatAbsensi($start_date, $end_date)
{
    global $koneksi;
    $query = "SELECT * FROM riwayat_absensi WHERE tanggal_absensi BETWEEN ? AND ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("ss", $start_date, $end_date);
    $stmt->execute();
    $result = $stmt->get_result();
    $riwayat_absensi = [];
    while ($row = $result->fetch_assoc()) {
        $riwayat_absensi[] = $row;
    }
    return $riwayat_absensi;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['tampilkan_harian'])) {
        $tanggal = $_POST['tanggal'];
        $riwayat_absensi = getRiwayatAbsensi($tanggal, $tanggal);
    }
}
?>

<?php include_once 'header.php'; ?>
<div class="container mt-5">
    <h1 class="mb-4">Laporan Absensi</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label for="tanggal">Tampilkan Harian:</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal">
            <button type="submit" class="btn btn-primary mt-2" name="tampilkan_harian">Tampilkan</button>
        </div>
        <a href="laporan.php" class="btn btn-secondary">Kembali</a>
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($riwayat_absensi)) : ?>
        <?php if (empty($riwayat_absensi)) : ?>
            <p class="text-center">Tidak ada data absensi yang ditemukan.</p>
        <?php else : ?>
            <form action="cetak_laporan_absensi.php" method="post">
                <input type="hidden" name="tanggal" value="<?php echo $tanggal; ?>">
                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Pangkat</th>
                            <th>NIP</th>
                            <th>Jabatan</th>
                            <th>Bidang</th>
                            <th>Waktu Pagi</th>
                            <th>Waktu Sore</th>
                            <th>Keterangan</th>
                            <th>Tanggal Absensi</th>
                            <th>Dibuat Pada</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($riwayat_absensi as $data) : ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $data['nama']; ?></td>
                                <td><?php echo $data['pangkat']; ?></td>
                                <td><?php echo $data['nip']; ?></td>
                                <td><?php echo $data['jabatan']; ?></td>
                                <td><?php echo $data['bidang']; ?></td>
                                <td><?php echo $data['waktu_pagi']; ?></td>
                                <td><?php echo $data['waktu_sore']; ?></td>
                                <td><?php echo $data['keterangan']; ?></td>
                                <td><?php echo $data['tanggal_absensi']; ?></td>
                                <td><?php echo $data['created_at']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary mt-2">Cetak Laporan</button>
            </form>
        <?php endif; ?>
    <?php endif; ?>
</div>
<div style="height: 100px;"></div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>