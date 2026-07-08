<?php
include_once 'header.php';
include_once 'koneksi.php';
?>
<div class="container">
    <h1 class="mt-5">Tambah Kendaraan</h1>
    <div class="mb-4">
        <a href="form_tambah_kendaraan_masuk.php" class="btn btn-primary">Tambah Kendaraan Masuk</a>
        <a href="form_tambah_kendaraan_keluar.php" class="btn btn-primary">Tambah Kendaraan Keluar</a>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h2 class="table-title">Data Kendaraan Masuk</h2>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nomor Kendaraan</th>
                            <th>Trayek</th>
                            <th>Waktu Kedatangan</th>
                            <th>Jumlah Penumpang Masuk</th>
                            <th>Asal terminal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM kendaraan_masuk ORDER BY waktu_kedatangan DESC";
                        $result = $koneksi->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['nomor_kendaraan']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['trayek']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['waktu_kedatangan']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['jumlah_penumpang_masuk']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['asal_terminal']) . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>Tidak ada data kendaraan masuk.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h2 class="table-title">Data Kendaraan Keluar Bulan Ini</h2>
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
                        $bulan_ini = date('Y-m');
                        $sql = "SELECT * FROM kendaraan_keluar WHERE DATE_FORMAT(waktu_keberangkatan, '%Y-%m') = ? ORDER BY waktu_keberangkatan DESC";
                        $stmt = $koneksi->prepare($sql);
                        $stmt->bind_param("s", $bulan_ini);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        if ($result->num_rows > 0) {
                            $total_retribusi = 0;
                            while ($row = $result->fetch_assoc()) {
                                $total_retribusi += $row['retribusi'];
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['nomor_kendaraan']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['trayek']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['waktu_kedatangan']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['jumlah_penumpang_masuk']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['asal_terminal']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['waktu_keberangkatan']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['jumlah_penumpang_keluar']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['tujuan_terminal']) . "</td>";
                                echo "<td>Rp " . number_format($row['retribusi'], 0, ',', '.') . "</td>";
                                echo "</tr>";
                            }
                            echo "<tr><td colspan='8'>Total Retribusi Bulan Ini</td><td>Rp " . number_format($total_retribusi, 0, ',', '.') . "</td></tr>";
                        } else {
                            echo "<tr><td colspan='9'>Tidak ada data kendaraan keluar bulan ini.</td></tr>";
                        }
                        $stmt->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
$koneksi->close();
include_once 'footer.php';
?>