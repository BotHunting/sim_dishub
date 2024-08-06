<?php
require_once 'koneksi.php';

function getTahun()
{
    global $koneksi;
    $query = "SELECT DISTINCT tahun FROM pengelolaan ORDER BY tahun DESC";
    $result = $koneksi->query($query);
    $tahun = [];
    while ($row = $result->fetch_assoc()) {
        $tahun[] = $row['tahun'];
    }
    return $tahun;
}

function getLaporanInventaris($start_date, $end_date)
{
    global $koneksi;
    $query = "SELECT * FROM pengelolaan WHERE tahun BETWEEN ? AND ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("ss", $start_date, $end_date);
    $stmt->execute();
    $result = $stmt->get_result();
    $laporan_inventaris = [];
    while ($row = $result->fetch_assoc()) {
        $laporan_inventaris[] = $row;
    }
    return $laporan_inventaris;
}

function getPegawai()
{
    global $koneksi;
    $query = "SELECT * FROM pegawai";
    $result = $koneksi->query($query);
    $pegawai = [];
    while ($row = $result->fetch_assoc()) {
        $pegawai[] = $row;
    }
    return $pegawai;
}

$tahun = getTahun();
$pegawai = getPegawai();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['tampilkan_periode'])) {
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $laporan_inventaris = getLaporanInventaris($start_date, $end_date);

        // Ambil data pegawai pembuat laporan yang dipilih
        $pembuat_laporan_id = $_POST['pembuat_laporan'];
        $pembuat_laporan = getPegawaiById($pembuat_laporan_id);
    }
}

function getPegawaiById($id)
{
    global $pegawai;
    foreach ($pegawai as $pgw) {
        if ($pgw['id'] == $id) {
            return $pgw;
        }
    }
    return null;
}
?>

<?php include_once 'header.php'; ?>
<div class="container mt-5">
    <h1 class="mb-4">Laporan Inventaris</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label for="start_date">Mulai Tahun:</label>
            <select class="form-control" id="start_date" name="start_date">
                <?php foreach ($tahun as $thn) : ?>
                    <option value="<?php echo $thn; ?>"><?php echo $thn; ?></option>
                <?php endforeach; ?>
            </select>
            <label for="end_date">Sampai Tahun:</label>
            <select class="form-control" id="end_date" name="end_date">
                <?php foreach ($tahun as $thn) : ?>
                    <option value="<?php echo $thn; ?>"><?php echo $thn; ?></option>
                <?php endforeach; ?>
            </select>
            <label for="pembuat_laporan">Pembuat Laporan (Pilih Pegawai):</label>
            <select class="form-control" id="pembuat_laporan" name="pembuat_laporan">
                <?php foreach ($pegawai as $pgw) : ?>
                    <option value="<?php echo $pgw['id']; ?>"><?php echo $pgw['nama']; ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="btn btn-primary mt-2" name="tampilkan_periode">Tampilkan</button>
        </div>
        <a href="javascript:history.go(-1);" class="btn btn-secondary">Kembali</a>
    </form>
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($laporan_inventaris)) : ?>
        <?php if (empty($laporan_inventaris)) : ?>
            <p class="text-center">Tidak ada data inventaris yang ditemukan.</p>
        <?php else : ?>
            <form action="cetak_inventaris.php" method="post">
                <input type="hidden" name="start_date" value="<?php echo $start_date; ?>">
                <input type="hidden" name="end_date" value="<?php echo $end_date; ?>">
                <input type="hidden" name="jabatan" value="<?php echo $pembuat_laporan['jabatan']; ?>">
                <input type="hidden" name="nama" value="<?php echo $pembuat_laporan['nama']; ?>">
                <input type="hidden" name="pangkat" value="<?php echo $pembuat_laporan['pangkat']; ?>">
                <input type="hidden" name="nip" value="<?php echo $pembuat_laporan['nip']; ?>">
                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomor Inventaris</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Kondisi</th>
                            <th>Tahun</th>
                            <th>Foto</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($laporan_inventaris as $data) : ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo htmlspecialchars($data['nomor_inventaris']); ?></td>
                                <td><?php echo htmlspecialchars($data['nama_barang']); ?></td>
                                <td><?php echo htmlspecialchars($data['jumlah']); ?></td>
                                <td><?php echo htmlspecialchars($data['kondisi']); ?></td>
                                <td><?php echo htmlspecialchars($data['tahun']); ?></td>
                                <td>
                                    <?php if (!empty($data['foto'])) : ?>
                                        <img src="../pengelolaan/<?php echo htmlspecialchars($data['foto']); ?>" alt="Foto Barang" style="max-width: 100px;">
                                    <?php else : ?>
                                        Foto tidak tersedia
                                    <?php endif; ?>
                                </td>
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