<?php
session_start();
require_once '../../config.php';
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
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h1 class="mb-4 text-center text-primary">Daftar Jabatan</h1>
            <?php if ($rules !== 'Staff') : ?>
                <div class="d-flex justify-content-end mb-4 gap-2">
                    <a href="tambah_jabatan.php" class="btn btn-gradient me-2"><i class="fas fa-plus"></i> Tambah Jabatan</a>
                    <a href="seksi.php" class="btn btn-gradient me-2"><i class="fas fa-plus"></i> Tambah Seksi</a>
                    <a href="bidang.php" class="btn btn-gradient"><i class="fas fa-plus"></i> Tambah Bidang</a>
                </div>
            <?php endif; ?>
            <?php if (!empty($jabatan_per_bidang)) : ?>
                <?php foreach ($jabatan_per_bidang as $bidang => $seksi_list) : ?>
                    <div class="mb-5">
                        <h3 class="mb-3 text-info"><i class="fas fa-layer-group"></i> <?php echo $bidang; ?></h3>
                        <?php foreach ($seksi_list as $seksi => $jabatan_list) : ?>
                            <h4 class="mb-2 text-secondary"><i class="fas fa-stream"></i> <?php echo $seksi; ?></h4>
                            <div class="table-responsive mb-4">
                                <table class="table table-bordered table-hover bg-white">
                                    <thead class="thead-light">
                                        <tr>
                                            <th style="width:5%;">No.</th>
                                            <th>Jabatan</th>
                                            <th>Anjab</th>
                                            <th>Jumlah Pegawai</th>
                                            <?php if ($rules !== 'Staff') : ?>
                                                <th style="width:15%;">Aksi</th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($jabatan_list as $index => $jabatan) : ?>
                                            <tr>
                                                <td><?php echo $index + 1; ?></td>
                                                <td><?php echo htmlspecialchars($jabatan['nama_jabatan']); ?></td>
                                                <td>
                                                    <?php if (!empty($jabatan['anjab'])) : ?>
                                                        <a href="<?php echo htmlspecialchars($jabatan['anjab']); ?>" target="_blank" class="btn btn-info btn-sm"><i class="fas fa-file-alt"></i> View</a>
                                                    <?php else : ?>
                                                        <span class="text-muted">File Belum Upload</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <span class="badge badge-jumlah"><?php echo $jabatan['jumlah_pegawai']; ?></span>
                                                </td>
                                                <?php if ($rules !== 'Staff') : ?>
                                                    <td>
                                                        <a href="edit_jabatan.php?id=<?php echo $jabatan['id']; ?>" class="btn btn-warning btn-sm me-1"><i class="fas fa-edit"></i> Edit</a>
                                                        <a href="hapus_jabatan.php?id=<?php echo $jabatan['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')"><i class="fas fa-trash"></i> Hapus</a>
                                                    </td>
                                                <?php endif; ?>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p class="text-center text-muted">Tidak ada data jabatan.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<style>
    .btn-gradient {
        background: linear-gradient(90deg, #2980b9 0%, #6dd5fa 100%);
        color: #fff;
        border: none;
        font-weight: 500;
        transition: background 0.3s;
    }
    .btn-gradient:hover {
        background: linear-gradient(90deg, #6dd5fa 0%, #2980b9 100%);
        color: #fff;
    }
    .badge-jumlah {
        background: #2980b9;
        color: #fff;
        font-size: 0.95rem;
        padding: 6px 16px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(44,62,80,0.08);
    }
    .table th, .table td {
        vertical-align: middle;
    }
    .me-1 { margin-right: 0.25rem; }
    .me-2 { margin-right: 0.5rem; }
    .gap-2 > * { margin-left: 0.5rem; }
    .gap-2 > *:first-child { margin-left: 0; }
</style>
<div style="height: 100px;"></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>