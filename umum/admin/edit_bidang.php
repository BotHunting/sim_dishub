<?php
// Mulai sesi
session_start();

// Sertakan file koneksi ke database
require_once 'koneksi.php';

// Inisialisasi variabel untuk menyimpan pesan error
$error = '';

// Periksa apakah parameter id bidang telah diterima dari URL
if (isset($_GET['id'])) {
    // Gunakan fungsi mysqli_real_escape_string untuk menghindari SQL Injection
    $id_bidang = mysqli_real_escape_string($koneksi, $_GET['id']);

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
    // Ambil data yang dikirimkan melalui form dan gunakan mysqli_real_escape_string
    $nama_bidang_baru = mysqli_real_escape_string($koneksi, $_POST['nama_bidang']);

    // Validasi nama bidang baru
    if (empty($nama_bidang_baru)) {
        $error = "Nama bidang harus diisi";
    } else {
        // Query untuk memperbarui nama bidang
        $query_update = "UPDATE bidang SET nama_bidang = '$nama_bidang_baru' WHERE id = '$id_bidang'";

        // Jalankan query
        if ($koneksi->query($query_update) === TRUE) {
            // Redirect ke halaman daftar bidang setelah berhasil mengupdate data bidang
            header("Location: jabatan.php");
            exit;
        } else {
            $error = "Error: " . $koneksi->error;
        }
    }
}
?>

<?php include_once 'header.php'; ?>
<div class="container mt-5">
    <h1>Edit Bidang</h1>
    <!-- Form untuk mengedit bidang -->
    <form action="" method="post">
        <div class="form-group">
            <label for="nama_bidang">Nama Bidang:</label>
            <input type="text" class="form-control" id="nama_bidang" name="nama_bidang" value="<?php echo htmlspecialchars($bidang['nama_bidang']); ?>" required>
        </div>
        <?php if ($error) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="javascript:history.go(-1);" class="btn btn-secondary">Kembali</a>
    </form>
</div>
<div style="height: 100px;"></div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>