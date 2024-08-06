<?php
include_once 'header.php';
require_once 'koneksi.php';

// Ambil data pinjaman dengan status "Sudah Dikembalikan"
$sql = "SELECT pinjaman.id, pengelolaan.nama_barang, pegawai.nama AS nama_pegawai, pinjaman.waktu_pinjam, pinjaman.waktu_kembali
        FROM pinjaman
        INNER JOIN pengelolaan ON pinjaman.id_barang = pengelolaan.id
        INNER JOIN pegawai ON pinjaman.id_pegawai = pegawai.id
        WHERE pinjaman.status = 'Sudah Dikembalikan'
        ORDER BY pinjaman.waktu_kembali DESC"; // Menambahkan klausa WHERE
$result = $koneksi->query($sql);

?>

<div class="container mt-5">
    <h1 class="mb-4">Riwayat Peminjaman (Sudah Dikembalikan)</h1>
    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Barang</th>
                <th>Pegawai</th>
                <th>Waktu Pinjam</th>
                <th>Waktu Kembali</th>
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
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Tidak ada riwayat peminjaman yang sudah dikembalikan.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="peminjaman.php" class="btn btn-secondary">Kembali</a>
</div>
<div style="height: 100px;"></div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>