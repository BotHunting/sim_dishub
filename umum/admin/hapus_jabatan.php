<?php
// Mulai sesi
session_start();

// Sertakan file koneksi ke database
require_once '../../config.php';

// Inisialisasi variabel untuk menyimpan pesan error
$error = '';

// Periksa apakah parameter id jabatan telah diterima dari URL
if (isset($_GET['id'])) {
    $id_jabatan = $_GET['id'];

    // Query untuk mengambil data jabatan berdasarkan ID
    $query = "SELECT * FROM jabatan WHERE id = '$id_jabatan'";
    $result = $koneksi->query($query);

    // Periksa apakah query berhasil dijalankan
    if ($result && $result->num_rows > 0) {
        // Ambil data jabatan
        $jabatan = $result->fetch_assoc();
    } else {
        // Redirect ke halaman daftar jabatan jika data jabatan tidak ditemukan
        header("Location: jabatan.php");
        exit;
    }
} else {
    // Redirect ke halaman daftar jabatan jika parameter id jabatan tidak diterima
    header("Location: jabatan.php");
    exit;
}

// Periksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Periksa apakah pengguna yakin ingin menghapus jabatan
    if ($_POST['konfirmasi'] == 'ya') {
        // Query untuk menghapus jabatan dari database
        $query_delete = "DELETE FROM jabatan WHERE id = '$id_jabatan'";

        // Jalankan query
        if ($koneksi->query($query_delete) === TRUE) {
            // Redirect ke halaman daftar jabatan setelah berhasil menghapus jabatan
            header("Location: jabatan.php");
            exit;
        } else {
            $error = "Error: " . $koneksi->error;
        }
    } else {
        // Redirect ke halaman daftar jabatan jika pengguna membatalkan penghapusan
        header("Location: jabatan.php");
        exit;
    }
}
?>

<?php include_once 'header.php'; ?>
<div class="container mt-5">
    <h1>Hapus Jabatan</h1>
    <p>Apakah Anda yakin ingin menghapus jabatan "<?php echo $jabatan['nama_jabatan']; ?>"?</p>
    <form action="" method="post">
        <input type="hidden" name="konfirmasi" value="ya">
        <?php if ($error) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
        <a href="jabatan.php" class="btn btn-secondary">Tidak, Batalkan</a>
    </form>
</div>
</body>

</html>