<?php include_once 'header.php'; ?>
<div class="container mt-5">
    <h1 class="mb-4">Disposisi</h1>
    <?php if ($rules !== 'Staff') : ?>
        <div class="text-end mb-4">
            <a href="tambah_disposisi.php" class="btn btn-primary">Tambah Disposisi</a>
            <a href="riwayat_disposisi.php" class="btn btn-primary">Riwayat Disposisi</a>
        </div>
    <?php endif; ?>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Pengirim</th>
                    <th>Penerima</th>
                    <th>Judul</th>
                    <th>Isi</th>
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
                // Include file koneksi database
                include_once 'koneksi.php';

                // Prepare and bind SQL statement
                $sql = "SELECT * FROM disposisi WHERE status IN ('Pending', 'Rejected') ORDER BY tanggal DESC";
                $stmt = $koneksi->prepare($sql);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['tanggal']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['pengirim']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['penerima']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['judul']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['isi']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                        echo "<td>";
                        if (!empty($row['file_upload'])) {
                            echo "<a href='lib/disposisi/" . htmlspecialchars($row['file_upload']) . "' class='btn btn-info btn-sm' target='_blank'>View</a>";
                        } else {
                            echo "Tidak ada lampiran";
                        }
                        echo "</td>";
                        // Tampilkan tombol aksi hanya jika pengguna memiliki rules "Staff"
                        if ($rules !== 'Staff') {
                            echo "<td>";
                            echo "<a href='edit_disposisi.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-warning btn-sm'>Edit</a> ";
                            echo "<a href='hapus_disposisi.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-danger btn-sm'>Hapus</a>";
                            echo "</td>";
                        }
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Tidak ada data disposisi dengan status 'Pending' atau 'Rejected'.</td></tr>";
                }
                // Close statement and connection
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