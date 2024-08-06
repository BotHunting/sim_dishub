<?php
include_once 'header.php';
require_once 'koneksi.php';

// Ambil data pinjaman dengan status "Belum Dikembalikan"
$sql = "SELECT pinjaman.id, pengelolaan.nama_barang, pegawai.nama AS nama_pegawai, pinjaman.waktu_pinjam, pinjaman.waktu_kembali, pinjaman.status
        FROM pinjaman
        INNER JOIN pengelolaan ON pinjaman.id_barang = pengelolaan.id
        INNER JOIN pegawai ON pinjaman.id_pegawai = pegawai.id
        WHERE pinjaman.status = 'Belum Dikembalikan'
        ORDER BY pinjaman.waktu_pinjam DESC"; // Menambahkan klausa WHERE
$result = $koneksi->query($sql);

?>

<div class="container mt-5">
    <h1 class="mb-4">Data Peminjaman (Belum Dikembalikan)</h1>
    <?php if ($rules !== 'Staff') : ?>
        <div class="text-end mb-4">
            <a href="pinjam_barang.php" class="btn btn-primary">Pinjam</a>
            <a href="riwayat_pinjam.php" class="btn btn-primary">Riwayat Peminjaman</a>
        </div>
    <?php endif; ?>
    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Barang</th>
                <th>Pegawai</th>
                <th>Waktu Pinjam</th>
                <th>Waktu Kembali</th>
                <th>Status</th>
                <?php if ($rules !== 'Staff') : ?>
                    <th>Aksi</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result && $result->num_rows > 0) {
                $no = 1;
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td>" . htmlspecialchars($row['nama_barang'] ?? '') . "</td>";
                    echo "<td>" . htmlspecialchars($row['nama_pegawai'] ?? '') . "</td>";
                    echo "<td>" . htmlspecialchars($row['waktu_pinjam'] ?? '') . "</td>";
                    echo "<td>" . htmlspecialchars($row['waktu_kembali'] ?? '') . "</td>";
                    echo "<td>" . htmlspecialchars($row['status'] ?? '') . "</td>";
                    // Tampilkan tombol aksi hanya jika pengguna bukan "Staff"
                    if ($rules !== 'Staff') {
                        echo "<td>";
                        // Tampilkan tombol aksi sesuai status
                        if ($row['status'] === 'Belum Dikembalikan') {
                            echo "<a href='aksi_pinjam.php?id=" . $row['id'] . "&aksi=kembalikan' class='btn btn-warning btn-sm'>Kembalikan</a>";
                        } else {
                            echo "<button class='btn btn-secondary btn-sm' disabled>Sudah Dikembalikan</button>";
                        }
                        echo "</td>";
                    }
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Tidak ada data peminjaman.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="pengelolaan.php" class="btn btn-secondary">Kembali</a>

</div>
<div style="height: 100px;"></div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
