<?php include_once 'header.php'; ?>
<div class="container mt-5">
    <h1 class="mb-4">Surat Menyurat</h1>
    <?php if ($rules !== 'Staff') : ?>
        <div class="text-end mb-4">
            <a href="tambah_surat.php" class="btn btn-primary">Tambah Surat</a>
            <a href="riwayat_surat.php" class="btn btn-primary">Riwayat Surat</a>
        </div>
    <?php endif; ?>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>No. Surat</th>
                    <th>Tanggal</th>
                    <th>Pengirim</th>
                    <th>Penerima</th>
                    <th>Subjek</th>
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
                $sql = "SELECT * FROM suratmenyurat WHERE status = ? ORDER BY tanggal DESC";
                $stmt = $koneksi->prepare($sql);
                $status = 'Draft';
                $stmt->bind_param("s", $status);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['nomor_surat']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['tanggal']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['pengirim']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['penerima']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['subjek']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['isi']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                        echo "<td>";
                        if (!empty($row['file_upload'])) {
                            echo "<a href='lib/surat/" . htmlspecialchars($row['file_upload']) . "' class='btn btn-info btn-sm' target='_blank'>View</a>";
                        } else {
                            echo "Tidak ada lampiran";
                        }
                        echo "</td>";
                        if ($rules !== 'Staff') {
                            echo "<td>";
                            echo "<a href='edit_surat.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-warning btn-sm'>Edit</a> ";
                            echo "<a href='hapus_surat.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-danger btn-sm'>Hapus</a>";
                            echo "</td>";
                        }
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>Tidak ada data surat menyurat.</td></tr>";
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