<?php
session_start();
// Include koneksi ke database
require_once __DIR__ . '/../config.php';
// Ambil data pengelolaan dari database
$query = "SELECT * FROM pengelolaan";
// Membuat prepared statement
$stmt = $koneksi->prepare($query);
// Eksekusi prepared statement
$stmt->execute();
// Mendapatkan hasil query
$result = $stmt->get_result();
// Inisialisasi array untuk menyimpan hasil query
$pengelolaan = [];
// Periksa apakah query berhasil dijalankan
if ($result->num_rows > 0) {
    // Jika berhasil, ambil semua data pengelolaan
    while ($row = $result->fetch_assoc()) {
        $pengelolaan[] = $row;
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
                    <h1>Inventaris Kantor</h1>
                    <p class="mb-0">Halaman Inventaris Kantor di website Tata Usaha Dinas Perhubungan Kabupaten Fakfak memungkinkan Anda untuk Mencatat dan mengelola inventaris kantor.</p>
                </div>
            </div>
        </div>
    </div>
    <nav class="breadcrumbs">
        <div class="container">
            <ol>
                <li><a href="index.php">Home</a></li>
                <li class="current">Inventaris Kantor</li>
            </ol>
        </div>
    </nav>
</div><!-- End Page Title -->

<div class="container mt-5">
    <h2>Pengelolaan Inventaris</h2>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Nomor Inventaris</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Kondisi</th>
                    <th>Tahun</th>
                    <th>Foto</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($pengelolaan)) : ?>
                    <?php foreach ($pengelolaan as $data) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($data['nomor_inventaris']); ?></td>
                            <td><?php echo htmlspecialchars($data['nama_barang']); ?></td>
                            <td><?php echo htmlspecialchars($data['jumlah']); ?></td>
                            <td><?php echo htmlspecialchars($data['kondisi']); ?></td>
                            <td><?php echo htmlspecialchars($data['tahun']); ?></td>
                            <td>
                                <?php if (!empty($data['foto'])) : ?>
                                    <img src="pengelolaan/<?php echo htmlspecialchars($data['foto']); ?>" alt="Foto Barang" style="max-width: 100px;">
                                <?php else : ?>
                                    Foto tidak tersedia
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="5">Tidak ada data pengelolaan barang.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php include("footer.php"); ?>