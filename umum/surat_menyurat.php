<?php
session_start();

// Include koneksi ke database
require_once 'koneksi.php';

// Membuat prepared statement untuk query dengan parameter placeholder (?)
$query = "SELECT * FROM suratmenyurat WHERE status = ? ORDER BY tanggal DESC";

// Membuat prepared statement
$stmt = $koneksi->prepare($query);

// Binding parameter ke placeholder (?)
$status = 'Sent'; // Tentukan nilai status
$stmt->bind_param("s", $status);

// Eksekusi prepared statement
$stmt->execute();

// Mendapatkan hasil query
$result = $stmt->get_result();

// Inisialisasi array untuk menyimpan hasil query
$surat_menyurat = [];

// Periksa apakah query berhasil dijalankan
if ($result->num_rows > 0) {
    // Jika berhasil, ambil semua data surat menyurat
    while ($row = $result->fetch_assoc()) {
        $surat_menyurat[] = $row;
    }
}
?>

<?php include("header.php"); ?>

<!-- Page Title -->
<div class="page-title" data-aos="fade">
    <div class="heading">
        <div class="container">
            <div class="row d-flex justify-content-center text-center">
                <div class="col-lg-8">
                    <h1>Kelola Surat</h1>
                    <p class="mb-0">Halaman Kelola Surat di website Tata Usaha Dinas Perhubungan Kabupaten Fakfak memungkinkan Anda untuk Menyimpan surat masuk dan keluar.</p>
                </div>
            </div>
        </div>
    </div>
    <nav class="breadcrumbs">
        <div class="container">
            <ol>
                <li><a href="index.php">Home</a></li>
                <li class="current">Kelola Surat</li>
            </ol>
        </div>
    </nav>
</div><!-- End Page Title -->

<div class="container mt-5">
    <h2>Surat Menyurat</h2>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor Surat</th>
                    <th>Tanggal</th>
                    <th>Pengirim</th>
                    <th>Penerima</th>
                    <th>Subjek</th>
                    <th>Isi</th>
                    <th>Status</th>
                    <th>Lampiran</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($surat_menyurat)) : ?>
                    <?php foreach ($surat_menyurat as $index => $data) : ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo htmlspecialchars($data['nomor_surat']); ?></td>
                            <td><?php echo $data['tanggal']; ?></td>
                            <td><?php echo htmlspecialchars($data['pengirim']); ?></td>
                            <td><?php echo htmlspecialchars($data['penerima']); ?></td>
                            <td><?php echo htmlspecialchars($data['subjek']); ?></td>
                            <td><?php echo htmlspecialchars($data['isi']); ?></td>
                            <td><?php echo htmlspecialchars($data['status']); ?></td>
                            <td>
                                <?php if (!empty($data['file_upload'])) : ?>
                                    <a href="admin/lib/surat/<?php echo $data['file_upload']; ?>" class="btn btn-info btn-sm" target="_blank">View</a>
                                <?php else : ?>
                                    Tidak ada lampiran
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="9">Tidak ada data surat menyurat dengan status "Sent".</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php include("footer.php"); ?>