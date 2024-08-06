<?php
session_start();
require_once 'koneksi.php';
$query_bidang = "SELECT * FROM bidang";
$stmt_bidang = $koneksi->prepare($query_bidang);
$stmt_bidang->execute();
$result_bidang = $stmt_bidang->get_result();
$jabatan_per_bidang = [];
if ($result_bidang && $result_bidang->num_rows > 0) {
    while ($row_bidang = $result_bidang->fetch_assoc()) {
        $bidang_id = $row_bidang['id'];
        $nama_bidang = $row_bidang['nama_bidang'];
        $query_seksi = "SELECT * FROM seksi WHERE bidang = ?";
        $stmt_seksi = $koneksi->prepare($query_seksi);
        $stmt_seksi->bind_param("s", $nama_bidang);
        $stmt_seksi->execute();
        $result_seksi = $stmt_seksi->get_result();
        $jabatan_per_seksi = [];
        if ($result_seksi && $result_seksi->num_rows > 0) {
            while ($row_seksi = $result_seksi->fetch_assoc()) {
                $seksi_id = $row_seksi['id'];
                $nama_seksi = $row_seksi['nama_seksi'];
                $query_jabatan = "SELECT *, (SELECT COUNT(*) FROM pegawai WHERE jabatan = jabatan.nama_jabatan) as jumlah_pegawai FROM jabatan WHERE bidang = ? AND seksi = ?";
                $stmt_jabatan = $koneksi->prepare($query_jabatan);
                $stmt_jabatan->bind_param("ss", $nama_bidang, $nama_seksi);
                $stmt_jabatan->execute();
                $result_jabatan = $stmt_jabatan->get_result();
                $jabatan_list = [];
                if ($result_jabatan && $result_jabatan->num_rows > 0) {
                    while ($row_jabatan = $result_jabatan->fetch_assoc()) {
                        $jabatan_list[] = $row_jabatan;
                    }
                }
                $jabatan_per_seksi[$nama_seksi] = $jabatan_list;
            }
        }
        $jabatan_per_bidang[$nama_bidang] = $jabatan_per_seksi;
    }
}
?>

<?php include_once 'header.php'; ?>
<div class="container mt-5">
    <h1 class="mb-4">Daftar Jabatan</h1>
    <?php if ($rules !== 'Staff') : ?>
        <div class="text-end mb-4">
            <a href="tambah_jabatan.php" class="btn btn-primary">Tambah Jabatan</a>
            <a href="seksi.php" class="btn btn-primary">Tambah Seksi</a>
            <a href="bidang.php" class="btn btn-primary">Tambah Bidang</a>
        </div>
    <?php endif; ?>
    <?php if (!empty($jabatan_per_bidang)) : ?>
        <?php foreach ($jabatan_per_bidang as $bidang => $seksi_list) : ?>
            <h2><?php echo $bidang; ?></h2>
            <?php foreach ($seksi_list as $seksi => $jabatan_list) : ?>
                <h3><?php echo $seksi; ?></h3>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Jabatan</th>
                                <th>Anjab</th>
                                <th>Jumlah Pegawai</th>
                                <?php if ($rules !== 'Staff') : ?>
                                    <th>Aksi</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($jabatan_list as $index => $jabatan) : ?>
                                <tr>
                                    <td><?php echo $index + 1; ?></td>
                                    <td><?php echo $jabatan['nama_jabatan']; ?></td>
                                    <td>
                                        <?php if (!empty($jabatan['anjab'])) : ?>
                                            <a href="<?php echo $jabatan['anjab']; ?>" target="_blank" class="btn btn-primary">View</a>
                                        <?php else : ?>
                                            File Belum Upload
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo $jabatan['jumlah_pegawai']; ?></td>
                                    <?php if ($rules !== 'Staff') : ?>
                                        <td>
                                            <a href="edit_jabatan.php?id=<?php echo $jabatan['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="hapus_jabatan.php?id=<?php echo $jabatan['id']; ?>" class="btn btn-danger btn-sm">Hapus</a>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endforeach; ?>
        <?php endforeach; ?>
    <?php else : ?>
        <p>Tidak ada data jabatan.</p>
    <?php endif; ?>
</div>
<div style="height: 100px;"></div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>