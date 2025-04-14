<?php
session_start();
// Include koneksi ke database
require_once __DIR__ . '/../config.php';
// Ambil data pengawasan dari database dengan status "Approved" dan diurutkan berdasarkan tanggal terbaru
$query = "SELECT * FROM pengawasan WHERE status = ? ORDER BY tanggal DESC";
// Membuat prepared statement
$stmt = $koneksi->prepare($query);
$status = 'Approved';
$stmt->bind_param("s", $status);
$stmt->execute();
$result = $stmt->get_result();
// Inisialisasi array untuk menyimpan hasil query
$pengawasan = [];
// Periksa apakah query berhasil dijalankan
if ($result->num_rows > 0) {
    // Jika berhasil, ambil semua data pengawasan
    while ($row = $result->fetch_assoc()) {
        $pengawasan[] = $row;
    }
}
?>

<?php include("header.php"); ?>
<div class="container mt-5">
    <h2>Surat Perintah Tugas</h2>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Jenis Perintah</th>
                    <th>Deskripsi</th>
                    <th>Status</th>
                    <th>Lampiran</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($pengawasan)) : ?>
                    <?php foreach ($pengawasan as $index => $data) : ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo $data['tanggal']; ?></td>
                            <td><?php echo $data['jenis_pengawasan']; ?></td>
                            <td><?php echo $data['deskripsi']; ?></td>
                            <td><?php echo $data['status']; ?></td>
                            <td>
                                <?php if (!empty($data['file_upload'])) : ?>
                                    <a href="admin/lib/spt/<?php echo $data['file_upload']; ?>" class="btn btn-sm btn-primary" target="_blank">View</a>
                                <?php else : ?>
                                    Tidak ada lampiran
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="6">Tidak ada data SPT dengan status "Approved".</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php include("footer.php"); ?>