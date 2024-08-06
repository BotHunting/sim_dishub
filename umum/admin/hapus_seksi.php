<?php
// Mulai sesi
session_start();

// Sertakan file koneksi ke database
require_once 'koneksi.php';

// Periksa apakah ID seksi telah diterima melalui parameter
if (!isset($_GET['id'])) {
    header("Location: seksi.php");
    exit;
}

$id = $_GET['id'];

// Query untuk mengambil data seksi berdasarkan ID
$query = "SELECT * FROM seksi WHERE id = $id";
$result = $koneksi->query($query);

// Inisialisasi variabel untuk menyimpan pesan error
$error = '';

// Periksa apakah query berhasil dijalankan dan data ditemukan
if ($result && $result->num_rows > 0) {
    $seksi = $result->fetch_assoc();
} else {
    // Redirect ke halaman daftar seksi jika data tidak ditemukan
    header("Location: seksi.php");
    exit;
}

// Jika form dikirimkan dengan metode POST, hapus data seksi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Periksa apakah pengguna ingin melanjutkan penghapusan
    if (isset($_POST['confirm'])) {
        // Query untuk menghapus data seksi
        $query_delete = "DELETE FROM seksi WHERE id = ?";

        // Persiapkan statement
        $stmt = $koneksi->prepare($query_delete);
        $stmt->bind_param('i', $id);

        // Jalankan query
        if ($stmt->execute()) {
            // Redirect ke halaman daftar seksi setelah berhasil menghapus data seksi
            header("Location: seksi.php");
            exit;
        } else {
            $error = "Error: " . $koneksi->error;
        }
    } else {
        // Jika pengguna membatalkan penghapusan, kembali ke halaman daftar seksi
        header("Location: seksi.php");
        exit;
    }
}
?>

<?php include_once 'header.php'; ?>
<div class="container mt-5">
    <h1>Hapus Seksi</h1>
    <p>Apakah Anda yakin ingin menghapus seksi "<?php echo $seksi['nama_seksi']; ?>"?</p>
    <!-- Form untuk menghapus seksi -->
    <form action="" method="post">
        <button type="submit" class="btn btn-danger" name="confirm">Ya, Hapus Seksi</button>
        <a href="seksi.php" class="btn btn-secondary">Tidak, Kembali</a>
    </form>
    <?php if ($error) : ?>
        <div class="alert alert-danger mt-3" role="alert">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>
</div>
</body>

</html>