<?php
session_start();

// Include koneksi ke database
require_once 'koneksi.php';

// Buat prepared statement untuk query
$query = "SELECT * FROM disposisi WHERE status = ? ORDER BY tanggal DESC";
$stmt = $koneksi->prepare($query);

// Bind parameter ke prepared statement
$status = 'Approved';
$stmt->bind_param('s', $status);

// Eksekusi prepared statement
$stmt->execute();

// Ambil hasil query
$result = $stmt->get_result();

// Inisialisasi array untuk menyimpan hasil query
$disposisi = [];

// Periksa apakah query berhasil dijalankan
if ($result && $result->num_rows > 0) {
    // Jika berhasil, ambil semua data disposisi
    while ($row = $result->fetch_assoc()) {
        $disposisi[] = $row;
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
                    <h1>Disposisi</h1>
                    <p class="mb-0">Disposisi biasanya berisi instruksi tentang apa yang harus dilakukan dengan surat atau dokumen tersebut,.</p>
                </div>
            </div>
        </div>
    </div>
    <nav class="breadcrumbs">
        <div class="container">
            <ol>
                <li><a href="index.php">Home</a></li>
                <li class="current">Disposisi</li>
            </ol>
        </div>
    </nav>
</div><!-- End Page Title -->

<div class="container mt-5">
    <h2>Disposisi Surat</h2>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Pengirim</th>
                    <th>Penerima</th>
                    <th>Perihal</th>
                    <th>Catatan</th>
                    <th>Status</th>
                    <th>lampiran</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($disposisi)) : ?>
                    <?php foreach ($disposisi as $index => $data) : ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo $data['tanggal']; ?></td>
                            <td><?php echo $data['pengirim']; ?></td>
                            <td><?php echo $data['penerima']; ?></td>
                            <td><?php echo $data['judul']; ?></td>
                            <td><?php echo $data['isi']; ?></td>
                            <td><?php echo $data['status']; ?></td>
                            <td>
                                <?php if (!empty($data['file_upload'])) : ?>
                                    <a href="admin/lib/disposisi/<?php echo $data['file_upload']; ?>" class="btn btn-info btn-sm" target="_blank">View</a>
                                <?php else : ?>
                                    Tidak ada lampiran
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="7">Tidak ada data disposisi dengan status "Approved".</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php include("footer.php"); ?>