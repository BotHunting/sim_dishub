<?php include_once 'header.php'; ?>
<div class="container mt-5">
    <h1 class="mb-4">Pelayanan Masyarakat</h1>
    <?php if ($rules !== 'Staff') : ?>
        <div class="text-end mb-4">
            <a href="riwayat_pelayanan.php" class="btn btn-primary">Riwayat Pelayanan</a>
        </div>
    <?php endif; ?>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nama Layanan</th>
                    <th>Deskripsi</th>
                    <th>Pemohon</th>
                    <th>Status</th>
                    <th>Lampiran</th>
                    <?php
                    if ($rules === 'Kepala') {
                        echo "<th>Aksi</th>";
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once 'koneksi.php';
                $query = "SELECT * FROM pelayananumum WHERE status = ? ORDER BY tanggal DESC"; // Query dengan placeholder dan urutan tanggal terbaru
                $stmt = $koneksi->prepare($query);
                $status = 'Pending';
                $stmt->bind_param('s', $status);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $no = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . htmlspecialchars($row['tanggal']) . "</td>"; // Melindungi dari XSS
                        echo "<td>" . htmlspecialchars($row['nama_layanan']) . "</td>"; // Melindungi dari XSS
                        echo "<td>" . htmlspecialchars($row['deskripsi']) . "</td>"; // Melindungi dari XSS
                        echo "<td>" . htmlspecialchars($row['pemohon']) . "</td>"; // Melindungi dari XSS
                        echo "<td>" . htmlspecialchars($row['status']) . "</td>"; // Melindungi dari XSS
                        echo "<td>";
                        if (!empty($row['file_upload'])) {
                            echo "<a href='../templates/pelayananumum/" . htmlspecialchars($row['file_upload']) . "' class='btn btn-sm btn-primary' target='_blank'>View</a>";
                        } else {
                            echo "File tidak tersedia";
                        }
                        echo "</td>";
                        if ($rules === 'Kepala') {
                            echo "<td><a href='edit_layanan.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-sm btn-warning'>Edit</a> <a href='hapus_layanan.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-sm btn-danger'>Hapus</a></td>";
                        }
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>Tidak ada data pelayanan umum dengan status 'Pending'.</td></tr>";
                }
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