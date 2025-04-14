<?php
// Mulai sesi
session_start();

// Sertakan file koneksi ke database
require_once '../../config.php';

// Inisialisasi variabel untuk menyimpan pesan error
$error = '';

// Periksa apakah parameter id bidang telah diterima dari URL
if (isset($_GET['id'])) {
    $id_bidang = $_GET['id'];

    // Query untuk mengambil data bidang berdasarkan ID
    $query = "SELECT * FROM bidang WHERE id = '$id_bidang'";
    $result = $koneksi->query($query);

    // Periksa apakah query berhasil dijalankan
    if ($result && $result->num_rows > 0) {
        // Ambil data bidang
        $bidang = $result->fetch_assoc();
    } else {
        // Redirect ke halaman daftar bidang jika data bidang tidak ditemukan
        header("Location: jabatan.php");
        exit;
    }
} else {
    // Redirect ke halaman daftar bidang jika parameter id bidang tidak diterima
    header("Location: jabatan.php");
    exit;
}

// Periksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Periksa apakah pengguna yakin ingin menghapus bidang
    if ($_POST['konfirmasi'] == 'ya') {
        // Query untuk menghapus bidang dari database
        $query_delete = "DELETE FROM bidang WHERE id = '$id_bidang'";

        // Jalankan query
        if ($koneksi->query($query_delete) === TRUE) {
            // Redirect ke halaman daftar bidang setelah berhasil menghapus bidang
            header("Location: jabatan.php");
            exit;
        } else {
            $error = "Error: " . $koneksi->error;
        }
    } else {
        // Redirect ke halaman daftar bidang jika pengguna membatalkan penghapusan
        header("Location: jabatan.php");
        exit;
    }
}
?>

<?php include_once 'header.php'; ?>
<div class="container mt-5">
    <h1>Hapus Bidang</h1>
    <p>Apakah Anda yakin ingin menghapus bidang "<?php echo $bidang['nama_bidang']; ?>"?</p>
    <p>Perhatian: Penghapusan bidang ini akan menghapus semua jabatan yang terkait dengan bidang ini.</p>
    <!-- Form untuk mengkonfirmasi penghapusan bidang -->
    <form action="" method="post">
        <input type="hidden" name="konfirmasi" value="ya">
        <?php if ($error) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
        <a href="bidang.php" class="btn btn-secondary">Tidak, Batalkan</a>
    </form>
</div>
</body>

</html>