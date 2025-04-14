<?php
session_start();
require_once __DIR__ . '/../config.php';
$query = "SELECT * FROM pelayananumum ORDER BY tanggal DESC";
$stmt = $koneksi->prepare($query);
if ($stmt->execute()) {
    $result = $stmt->get_result();
    $pelayanan = [];
    while ($row = $result->fetch_assoc()) {
        $pelayanan[] = $row;
    }
} else {
    die("Query error: " . $koneksi->error);
}
$stmt->close();
?>

<?php include("header.php"); ?>

<!-- Page Title -->
<div class="page-title" data-aos="fade">
    <div class="heading">
        <div class="container">
            <div class="row d-flex justify-content-center text-center">
                <div class="col-lg-8">
                    <h1>Pelayanan Masyarakat</h1>
                    <p class="mb-0">Website ini dibuat untuk memberikan informasi dan layanan kepada masyarakat terkait dengan tugas dan fungsi Dinas Perhubungan Kabupaten Fakfak.</p>
                </div>
            </div>
        </div>
    </div>
    <nav class="breadcrumbs">
        <div class="container">
            <ol>
                <li><a href="index.php">Home</a></li>
                <li class="current">Pelayanan Masyarakat</li>
            </ol>
        </div>
    </nav>
</div><!-- End Page Title -->

<div class="container mt-5">
    <h2>Pelayanan Masyarakat</h2>
    <a href="tambah_pelayanan.php" class="btn btn-primary mb-3">Tambah Pelayanan</a>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Perihal</th>
                    <th>Deskripsi</th>
                    <th>Pemohon</th>
                    <th>Status</th>
                    <th>File</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($pelayanan)) : ?>
                    <?php foreach ($pelayanan as $index => $data) : ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo htmlspecialchars($data['tanggal']); ?></td>
                            <td><?php echo htmlspecialchars($data['nama_layanan']); ?></td>
                            <td><?php echo htmlspecialchars($data['deskripsi']); ?></td>
                            <td><?php echo htmlspecialchars($data['pemohon']); ?></td>
                            <td><?php echo htmlspecialchars($data['status']); ?></td>
                            <td>
                                <?php if (!empty($data['file_google_drive'])) : ?>
                                    <a href="<?php echo htmlspecialchars($data['file_google_drive']); ?>" target="_blank" class="btn btn-info">View</a>
                                <?php else : ?>
                                    Tidak ada file
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="7">Tidak ada data pelayanan masyarakat.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php include("footer.php"); ?>
