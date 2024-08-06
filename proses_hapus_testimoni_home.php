<?php
session_start();

// Include file konfigurasi
include_once 'config.php';

// Cek apakah pengguna sudah login, jika tidak redirect ke halaman login
if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
    header("location: login.php");
    exit;
}

// Proses penghapusan testimoni
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    // Ambil ID testimoni dari parameter URL
    $testimoni_id = $_GET['id'];

    // Query untuk menghapus testimoni berdasarkan ID
    $sql = "DELETE FROM testimoni_home WHERE id = ?";

    if ($stmt = $koneksi->prepare($sql)) {
        // Bind parameter ke pernyataan persiapan
        $stmt->bind_param("i", $testimoni_id);

        // Mengeksekusi pernyataan
        if ($stmt->execute()) {
            // Jika penghapusan berhasil, redirect kembali ke halaman testimoni
            header("location: testi_home.php");
            exit();
        } else {
            echo "Oops! Terjadi kesalahan. Silakan coba lagi nanti.";
        }

        // Tutup pernyataan
        $stmt->close();
    }

    // Tutup koneksi
    $koneksi->close();
}
?>

<?php include("header.php"); ?>
<main class="main">
    <div class="container">
        <div class="alert alert-warning" role="alert">
            Apakah Anda yakin ingin menghapus testimoni ini?
        </div>
        <div class="d-flex justify-content-between">
            <a href="testi_home.php" class="btn btn-secondary">Batal</a>
            <a href="hapus_testimoni_home.php?id=<?php echo $_GET['id']; ?>&confirm=yes" class="btn btn-danger">Hapus</a>
        </div>
    </div>
</main>
<?php include("footer.php"); ?>
