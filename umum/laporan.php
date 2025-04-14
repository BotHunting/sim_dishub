<?php
session_start();
// Include koneksi ke database
require_once __DIR__ . '/../config.php';
// Ambil data laporan dengan status "Approved" dari database
$query = "SELECT * FROM laporan WHERE status = ?";
// Persiapkan statement SQL
$stmt = $koneksi->prepare($query);
// Bind parameter ke statement
$status = 'Approved';
$stmt->bind_param("s", $status);
// Eksekusi statement
$stmt->execute();
// Dapatkan hasil query
$result = $stmt->get_result();
// Inisialisasi array untuk menyimpan hasil query
$laporan = [];
// Periksa apakah query berhasil dijalankan
if ($result && $result->num_rows > 0) {
    // Jika berhasil, ambil semua data laporan
    while ($row = $result->fetch_assoc()) {
        $laporan[] = $row;
    }
}
// Tutup statement
$stmt->close();
?>

<?php include("header.php"); ?>

<!-- Page Title -->
<div class="page-title" data-aos="fade">
    <div class="heading">
        <div class="container">
            <div class="row d-flex justify-content-center text-center">
                <div class="col-lg-8">
                    <h1>Laporan</h1>
                    <p class="mb-0">Halaman Laporan di website Tata Usaha Dinas Perhubungan Kabupaten Fakfak memungkinkan Anda untuk menyimpan dan mengelola laporan.</p>
                </div>
            </div>
        </div>
    </div>
    <nav class="breadcrumbs">
        <div class="container">
            <ol>
                <li><a href="index.php">Home</a></li>
                <li class="current">Laporan</li>
            </ol>
        </div>
    </nav>
</div><!-- End Page Title -->

<div class="container mt-5">
    <h2>Laporan</h2>
    <a href="sdm.php" class="btn btn-primary mb-3">Laporan SDM</a>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor Surat</th>
                    <th>Tanggal</th>
                    <th>Jenis Laporan</th>
                    <th>Isi</th>
                    <th>Status</th>
                    <th>Lampiran</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($laporan)) : ?>
                    <?php foreach ($laporan as $index => $data) : ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo $data['nomor_surat']; ?></td>
                            <td><?php echo $data['tanggal']; ?></td>
                            <td><?php echo $data['jenis_laporan']; ?></td>
                            <td><?php echo $data['isi']; ?></td>
                            <td><?php echo $data['status']; ?></td>
                            <td>
                                <?php if (!empty($data['file_google_drive'])) : ?>
                                    <a href="<?php echo $data['file_google_drive']; ?>" class="btn btn-sm btn-primary" target="_blank">Lihat Lampiran</a>
                                <?php else : ?>
                                    Tidak ada lampiran
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="7">Tidak ada data laporan yang telah disetujui.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include("footer.php"); ?>