<?php include_once 'header.php'; ?>
<div class="container mt-5">
    <h1 class="mb-4">Surat Perintah Tugas</h1>
    <?php if ($rules !== 'Staff') : ?>
        <div class="text-end mb-4">
            <a href="tambah_pengawasan.php" class="btn btn-primary">Tambah SPT</a>
            <a href="riwayat_spt.php" class="btn btn-primary">Riwayat SPT</a>
        </div>
    <?php endif; ?>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nomor Surat</th>
                    <th>Jenis SPT</th>
                    <th>Tanggal</th>
                    <th>Deskripsi</th>
                    <th>Status</th>
                    <th>Lampiran</th>
                    <?php
                    // Periksa apakah pengguna memiliki rules "Staff"
                    if ($rules !== 'Staff') {
                        echo '<th>Aksi</th>';
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once 'koneksi.php';

                // Filter by status and order by date
                $sql = "SELECT * FROM pengawasan WHERE status IN ('Pending', 'Rejected') ORDER BY tanggal DESC";
                $stmt = $koneksi->prepare($sql);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $no = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . htmlspecialchars($row['nomor_surat']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['jenis_pengawasan']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['tanggal']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['deskripsi']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                        echo "<td>";
                        // Periksa apakah ada link Google Drive
                        if (!empty($row['file_google_drive'])) {
                            echo "<a href='" . htmlspecialchars($row['file_google_drive']) . "' class='btn btn-info btn-sm' target='_blank'>View</a>";
                        } else {
                            echo "Tidak ada lampiran";
                        }
                        echo "</td>";
                        // Tampilkan tombol aksi hanya jika pengguna memiliki rules bukan "Staff"
                        if ($rules !== 'Staff') {
                            echo "<td>";
                            echo "<a href='edit_pengawasan.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-warning btn-sm'>Edit</a> ";
                            echo "<a href='hapus_pengawasan.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-danger btn-sm'>Hapus</a>";
                            echo "</td>";
                        }
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>Tidak ada data pengawasan dengan status 'Pending' atau 'Rejected'.</td></tr>";
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
