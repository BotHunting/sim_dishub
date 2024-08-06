<?php
// Mulai sesi
session_start();

// Sertakan file koneksi ke database
require_once 'koneksi.php';

// Inisialisasi variabel error
$error = '';

// Proses form jika tombol "Simpan" ditekan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi input
    if (empty($_POST['nama_bidang'])) {
        $error = "Nama bidang harus diisi";
    } else {
        // Gunakan prepared statement untuk mencegah SQL Injection
        $nama_bidang = $_POST['nama_bidang'];
        $query = "INSERT INTO bidang (nama_bidang) VALUES (?)";

        if ($stmt = $koneksi->prepare($query)) {
            // Bind parameter ke prepared statement
            $stmt->bind_param("s", $nama_bidang);

            // Eksekusi statement
            if ($stmt->execute()) {
                // Redirect ke halaman daftar jabatan setelah berhasil menambahkan bidang
                header("Location: jabatan.php");
                exit();
            } else {
                $error = "Error: " . $query . "<br>" . $koneksi->error;
            }

            // Tutup statement
            $stmt->close();
        }
    }
}
?>

<?php include_once 'header.php'; ?>
<div class="container mt-5">
    <h1>Tambah Bidang</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label for="nama_bidang">Nama Bidang:</label>
            <input type="text" class="form-control" id="nama_bidang" name="nama_bidang" required>
        </div>
        <div class="text-danger"><?php echo $error; ?></div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="bidang.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
<div style="height: 100px;"></div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>