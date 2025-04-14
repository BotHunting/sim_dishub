<?php include_once 'header.php'; ?>
<div class="container mt-5">
    <h1 class="mb-4">Laporan</h1>
    <?php if ($rules !== 'Staff') : ?>
        <div class="text-end mb-4">
            <a href="tambah_laporan.php" class="btn btn-primary">Tambah Laporan</a>
            <a href="riwayat_laporan.php" class="btn btn-primary">Riwayat Laporan</a>
            <a href="sdm.php" class="btn btn-primary">Laporan SDM</a>
            <a href="laporan_absensi.php" class="btn btn-primary">Laporan Absensi</a>
        </div>
    <?php endif; ?>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nomor Surat</th>
                    <th>Tanggal</th>
                    <th>Jenis Laporan</th>
                    <th>Isi</th>
                    <th>Status</th>
                    <th>Lampiran</th>
                    <?php
                    if ($rules !== 'Staff') {
                        echo '<th>Aksi</th>';
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once 'koneksi.php';
                $sql = "SELECT * FROM laporan WHERE status != 'Approved' ORDER BY tanggal DESC"; // Mengambil data dengan status bukan "Approved" dan mengurutkannya berdasarkan tanggal terbaru
                $stmt = $koneksi->prepare($sql);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $no = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . htmlspecialchars($row['nomor_surat']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['tanggal']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['jenis_laporan']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['isi']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                        echo "<td>";
                        if (!empty($row['file_google_drive'])) {
                            echo "<a href=\"" . htmlspecialchars($row['file_google_drive']) . "\" class='btn btn-info btn-sm' target='_blank'>View</a>";
                        } else {
                            echo "Tidak ada lampiran";
                        }
                        echo "</td>";
                        if ($rules !== 'Staff') {
                            echo "<td>";
                            echo "<a href='edit_laporan.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-warning btn-sm'>Edit</a> ";
                            echo "<a href='hapus_laporan.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-danger btn-sm'>Hapus</a>";
                            echo "</td>";
                        }
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Tidak ada data laporan yang belum disetujui.</td></tr>";
                }
                $stmt->close();
                $koneksi->close();
                ?>
            </tbody>
        </table>
    </div>
</div>
<div style="height: 100px;"></div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
