<?php include_once 'header.php'; ?>
<div class="container mt-5">
    <h1>Laporan Kendaraan Keluar</h1>
    <form action="" method="get" class="mb-3">
        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="bulan" class="form-label">Pilih Bulan:</label>
                <select name="bulan" id="bulan" class="form-select">
                    <option value="01">Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label for="tahun" class="form-label">Pilih Tahun:</label>
                <select name="tahun" id="tahun" class="form-select">
                    <?php
                    // Mendapatkan tahun saat ini
                    $tahun_sekarang = date('Y');
                    // Menampilkan pilihan tahun dari tahun saat ini sampai 10 tahun ke belakang
                    for ($i = $tahun_sekarang; $i >= $tahun_sekarang - 10; $i--) {
                        echo "<option value='$i'>$i</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label for="asal_terminal" class="form-label">Pilih Terminal:</label>
                <select name="asal_terminal" id="asal_terminal" class="form-select">
                    <option value="">Semua Terminal</option>
                    <?php
                    // Ambil data terminal dari database
                    include_once 'koneksi.php';
                    $sql = "SELECT DISTINCT asal_terminal FROM kendaraan_keluar";
                    $result = $koneksi->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['asal_terminal'] . "'>" . $row['asal_terminal'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label for="">&nbsp;</label>
                <button type="submit" class="btn btn-primary form-control">Tampilkan</button>
            </div>
        </div>
    </form>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nomor Kendaraan</th>
                    <th>Trayek</th>
                    <th>Waktu Kedatangan</th>
                    <th>Jumlah Penumpang Masuk</th>
                    <th>Asal Terminal</th>
                    <th>Waktu Keberangkatan</th>
                    <th>Jumlah Penumpang Keluar</th>
                    <th>Tujuan Terminal</th>
                    <th>Retribusi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Mengambil parameter bulan, tahun, dan asal terminal dari URL
                $bulan = isset($_GET['bulan']) ? $_GET['bulan'] : date('m');
                $tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');
                $asal_terminal = isset($_GET['asal_terminal']) ? $_GET['asal_terminal'] : '';
                // Membuat query berdasarkan parameter yang dipilih
                $sql = "SELECT * FROM kendaraan_keluar WHERE MONTH(waktu_keberangkatan) = $bulan AND YEAR(waktu_keberangkatan) = $tahun";
                if (!empty($asal_terminal)) {
                    $sql .= " AND asal_terminal = '$asal_terminal'";
                }
                $sql .= " ORDER BY waktu_keberangkatan";
                $result = $koneksi->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['nomor_kendaraan'] . "</td>";
                        echo "<td>" . $row['trayek'] . "</td>";
                        echo "<td>" . $row['waktu_kedatangan'] . "</td>";
                        echo "<td>" . $row['jumlah_penumpang_masuk'] . "</td>";
                        echo "<td>" . $row['asal_terminal'] . "</td>";
                        echo "<td>" . $row['waktu_keberangkatan'] . "</td>";
                        echo "<td>" . $row['jumlah_penumpang_keluar'] . "</td>";
                        echo "<td>" . $row['tujuan_terminal'] . "</td>";
                        echo "<td>Rp " . number_format($row['retribusi'], 0, ',', '.') . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>Tidak ada data kendaraan keluar untuk bulan ini.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php
    // Menghitung total retribusi
    $total_retribusi = 0;
    $result = $koneksi->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $total_retribusi += $row['retribusi'];
        }
    }
    ?>
    <h3 class="mt-5">Total Retribusi: Rp <?php echo number_format($total_retribusi, 0, ',', '.'); ?></h3>
    <form action="cetak_laporan.php" method="get" target="_blank" class="mt-3">
        <input type="hidden" name="bulan" value="<?php echo $bulan; ?>">
        <input type="hidden" name="tahun" value="<?php echo $tahun; ?>">
        <input type="hidden" name="asal_terminal" value="<?php echo $asal_terminal; ?>">
        <select name="petugas" id="petugas" class="form-select mb-3">
            <?php
            include_once 'koneksi.php';
            $sql_petugas = "SELECT * FROM petugas";
            $result_petugas = $koneksi->query($sql_petugas);
            if ($result_petugas->num_rows > 0) {
                while ($row = $result_petugas->fetch_assoc()) {
                    echo "<option value='" . $row['nip'] . "'>" . $row['nama'] . "</option>";
                }
            } else {
                echo "<option value=''>Tidak ada data petugas</option>";
            }
            ?>
        </select>
        <button type="submit" class="btn btn-primary">Cetak Laporan</button>
    </form>
</div>
<?php include_once 'footer.php'; ?>
