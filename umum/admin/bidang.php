<?php
// Mulai sesi
session_start();

// Sertakan file koneksi ke database
require_once '../../config.php';

// Query untuk mengambil daftar bidang
$query_bidang = "SELECT id, nama_bidang FROM bidang";
$stmt = $koneksi->prepare($query_bidang);
$stmt->execute();
$result_bidang = $stmt->get_result();

// Inisialisasi array untuk menyimpan bidang beserta jabatannya
$bidang_dan_jabatan = [];

// Periksa apakah query berhasil dijalankan
if ($result_bidang && $result_bidang->num_rows > 0) {
    // Mendapatkan data bidang
    while ($row_bidang = $result_bidang->fetch_assoc()) {
        $bidang_id = $row_bidang['id'];
        $nama_bidang = $row_bidang['nama_bidang'];

        // Query untuk mengambil jumlah jabatan dalam bidang dengan menggunakan parameterisasi
        $query_jumlah_jabatan = "SELECT COUNT(*) AS total FROM jabatan WHERE bidang = ?";
        $stmt_jumlah_jabatan = $koneksi->prepare($query_jumlah_jabatan);
        $stmt_jumlah_jabatan->bind_param("s", $nama_bidang);
        $stmt_jumlah_jabatan->execute();
        $result_jumlah_jabatan = $stmt_jumlah_jabatan->get_result();

        $jumlah_jabatan = 0;

        if ($result_jumlah_jabatan && $result_jumlah_jabatan->num_rows > 0) {
            $row_jumlah_jabatan = $result_jumlah_jabatan->fetch_assoc();
            $jumlah_jabatan = $row_jumlah_jabatan['total'];
        }

        // Tambahkan data bidang beserta jumlah jabatannya ke dalam array
        $bidang_dan_jabatan[] = array(
            'bidang_id' => $bidang_id,
            'nama_bidang' => $nama_bidang,
            'jumlah_jabatan' => $jumlah_jabatan
        );
    }
}
?>

<?php include_once 'header.php'; ?>
<div class="container mt-5">
    <h1>Daftar Bidang</h1>
    <?php if (!empty($bidang_dan_jabatan)) : ?>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Bidang</th>
                        <th>Jumlah Jabatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bidang_dan_jabatan as $index => $bidang) : ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo htmlspecialchars($bidang['nama_bidang']); ?></td>
                            <td><?php echo htmlspecialchars($bidang['jumlah_jabatan']); ?></td>
                            <td>
                                <a href="edit_bidang.php?id=<?php echo htmlspecialchars($bidang['bidang_id']); ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="hapus_bidang.php?id=<?php echo htmlspecialchars($bidang['bidang_id']); ?>" class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>Tidak ada data bidang.</p>
        <?php endif; ?>
        <a href="tambah_bidang.php" class="btn btn-primary">Tambah Bidang</a>
        <a href="javascript:history.go(-1);" class="btn btn-secondary">Kembali</a>
        </div>
</div>
<div style="height: 100px;"></div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>