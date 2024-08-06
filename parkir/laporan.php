<?php
require_once('koneksi.php');

$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : date('m');
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');
$lokasi = isset($_GET['lokasi']) ? $_GET['lokasi'] : '';

// Query untuk mengambil data laporan_parkir berdasarkan bulan, tahun, dan lokasi parkir, diurutkan berdasarkan waktu keluar secara descending
$sql = "SELECT * FROM laporan_parkir WHERE bulan_laporan = $bulan AND tahun_laporan = $tahun";
if (!empty($lokasi)) {
    $sql .= " AND lokasi_parkir = '$lokasi'";
}
$sql .= " ORDER BY waktu_keluar DESC";
$result = $koneksi->query($sql);

$sql_petugas = "SELECT * FROM petugas_parkir";
$result_petugas = $koneksi->query($sql_petugas);
?>

<?php include("header.php"); ?>
<header class="text-center">
    <h1>Laporan Bulanan</h1>
</header>
<div class="container">
    <form action="" method="get" class="row g-3">
        <div class="col-md-3">
            <label for="bulan" class="form-label">Pilih Bulan:</label>
            <select name="bulan" id="bulan" class="form-select">
                <?php
                for ($i = 1; $i <= 12; $i++) {
                    $selected = ($i == $bulan) ? "selected" : "";
                    echo "<option value='$i' $selected>" . date('F', mktime(0, 0, 0, $i, 1)) . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="col-md-3">
            <label for="tahun" class="form-label">Pilih Tahun:</label>
            <select name="tahun" id="tahun" class="form-select">
                <?php
                $tahun_sekarang = date('Y');
                for ($i = 2020; $i <= $tahun_sekarang; $i++) {
                    $selected = ($i == $tahun) ? "selected" : "";
                    echo "<option value='$i' $selected>$i</option>";
                }
                ?>
            </select>
        </div>
        <div class="col-md-3">
            <label for="lokasi" class="form-label">Pilih Lokasi Parkir:</label>
            <select name="lokasi" id="lokasi" class="form-select">
                <option value="">Semua Lokasi</option>
                <?php
                $sql_lokasi = "SELECT DISTINCT lokasi_parkir FROM laporan_parkir";
                $result_lokasi = $koneksi->query($sql_lokasi);
                while ($row_lokasi = $result_lokasi->fetch_assoc()) {
                    $selected = ($row_lokasi['lokasi_parkir'] == $lokasi) ? "selected" : "";
                    echo "<option value='" . $row_lokasi['lokasi_parkir'] . "' $selected>" . $row_lokasi['lokasi_parkir'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <input type="submit" value="Tampilkan Laporan" class="btn btn-primary">
            </div>
        </div>
    </form>
</div>
<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th>Nomor Kendaraan</th>
                <th>Jenis Kendaraan</th>
                <th>Waktu Masuk</th>
                <th>Waktu Keluar</th>
                <th>Biaya Parkir</th>
                <th>Lokasi Parkir</th>
                <th>Status</th>
                <th>Petugas</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total_pemasukan = 0;
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["nomor_kendaraan"] . "</td>";
                    echo "<td>" . $row["jenis_kendaraan"] . "</td>";
                    echo "<td>" . $row["waktu_masuk"] . "</td>";
                    echo "<td>" . $row["waktu_keluar"] . "</td>";
                    echo "<td>Rp " . number_format($row["biaya_parkir"], 0, ',', '.') . "</td>";
                    echo "<td>" . $row["lokasi_parkir"] . "</td>";
                    echo "<td>" . $row["status"] . "</td>";
                    echo "<td>" . $row["nama"] . "</td>";
                    echo "</tr>";
                    $total_pemasukan += $row["biaya_parkir"];
                }
            } else {
                echo "<tr><td colspan='8'>Tidak Ada Data Parkir Bulan Ini</td></tr>";
            }
            ?>
            <tr>
                <td colspan="4"></td>
                <td>Rp <?php echo number_format($total_pemasukan, 0, ',', '.'); ?></td>
            </tr>
        </tbody>
    </table>
    <form action="cetak_laporan.php" method="get" target="_blank">
    <input type="hidden" name="bulan" value="<?php echo $bulan; ?>">
    <input type="hidden" name="tahun" value="<?php echo $tahun; ?>">
    <input type="hidden" name="lokasi" value="<?php echo $lokasi; ?>">
    <div class="mb-3 row">
        <label for="petugas" class="col-sm-2 col-form-label">Pilih Petugas:</label>
        <div class="col-sm-10">
            <select name="petugas" id="petugas" class="form-select">
                <?php
                if ($result_petugas->num_rows > 0) {
                    while ($row = $result_petugas->fetch_assoc()) {
                        echo "<option value='" . $row['id'] . "'>" . $row['nama'] . "</option>";
                    }
                } else {
                    echo "<option value=''>Tidak ada data petugas</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <input type="submit" value="Cetak Laporan" class="btn btn-primary">
    </div>
</form>
</div>
<?php include("footer.php"); ?>