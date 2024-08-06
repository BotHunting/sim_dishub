<?php
// Mulai sesi
session_start();

// Sertakan file koneksi ke database
require_once 'koneksi.php';

// Query untuk mengambil daftar seksi beserta jumlah jabatan dalam setiap seksi
$query_seksi = "SELECT seksi.*, COUNT(jabatan.id) AS jumlah_jabatan 
                FROM seksi 
                LEFT JOIN jabatan ON jabatan.seksi = seksi.nama_seksi 
                GROUP BY seksi.id";
$result_seksi = $koneksi->query($query_seksi);

// Inisialisasi array untuk menyimpan daftar seksi
$daftar_seksi = [];

// Periksa apakah query berhasil dijalankan
if ($result_seksi && $result_seksi->num_rows > 0) {
    // Mendapatkan daftar seksi
    while ($row_seksi = $result_seksi->fetch_assoc()) {
        $daftar_seksi[] = $row_seksi;
    }
}
?>

<?php include_once 'header.php'; ?>
<div class="container mt-5">
    <h1>Daftar Seksi</h1>
    <?php if (!empty($daftar_seksi)) : ?>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Seksi</th>
                        <th>Bidang</th>
                        <th>Jumlah Jabatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($daftar_seksi as $index => $seksi) : ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo $seksi['nama_seksi']; ?></td>
                            <td><?php echo $seksi['bidang']; ?></td>
                            <td><?php echo $seksi['jumlah_jabatan']; ?></td>
                            <td>
                                <a href="edit_seksi.php?id=<?php echo $seksi['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="hapus_seksi.php?id=<?php echo $seksi['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus seksi ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>Tidak ada data seksi.</p>
        <?php endif; ?>
        <a href="tambah_seksi.php" class="btn btn-primary">Tambah Seksi</a>
        <a href="jabatan.php" class="btn btn-secondary">Kembali</a>
        </div>
</div>
<div style="height: 100px;"></div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>