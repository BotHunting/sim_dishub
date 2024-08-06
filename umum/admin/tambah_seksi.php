<?php
// Mulai sesi
session_start();

// Sertakan file koneksi ke database
require_once 'koneksi.php';

// Inisialisasi variabel untuk menyimpan pesan error
$error = '';

// Periksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirimkan melalui form
    $nama_seksi = $_POST['nama_seksi'];
    $bidang = $_POST['bidang'];

    // Validasi nama seksi dan bidang
    if (empty($nama_seksi) || empty($bidang)) {
        $error = "Nama seksi dan bidang harus diisi";
    } else {
        // Query untuk menambahkan seksi baru ke dalam database
        $query = "INSERT INTO seksi (nama_seksi, bidang) VALUES ('$nama_seksi', '$bidang')";

        // Jalankan query
        if ($koneksi->query($query) === TRUE) {
            // Redirect ke halaman daftar jabatan setelah berhasil menambahkan seksi baru
            header("Location: jabatan.php");
            exit;
        } else {
            $error = "Error: " . $koneksi->error;
        }
    }
}

// Query untuk mengambil daftar bidang
$query_bidang = "SELECT * FROM bidang";
$result_bidang = $koneksi->query($query_bidang);

// Inisialisasi array untuk menyimpan daftar bidang
$bidang_options = [];

// Periksa apakah query berhasil dijalankan
if ($result_bidang && $result_bidang->num_rows > 0) {
    // Mendapatkan daftar bidang
    while ($row_bidang = $result_bidang->fetch_assoc()) {
        $bidang_options[$row_bidang['nama_bidang']] = $row_bidang['nama_bidang'];
    }
}
?>

<?php include_once 'header.php'; ?>
<div class="container mt-5">
    <h1>Tambah Seksi</h1>
    <form action="" method="post">
        <div class="form-group">
            <label for="bidang">Bidang:</label>
            <select class="form-control" id="bidang" name="bidang" required>
                <option value="">Pilih Bidang</option>
                <?php foreach ($bidang_options as $bidang) : ?>
                    <option value="<?php echo $bidang; ?>"><?php echo $bidang; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="nama_seksi">Nama Seksi:</label>
            <input type="text" class="form-control" id="nama_seksi" name="nama_seksi" required>
        </div>
        <?php if ($error) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        <button type="submit" class="btn btn-primary">Tambah Seksi</button>
        <a href="javascript:history.go(-1);" class="btn btn-secondary">Kembali</a>
    </form>
</div>
<div style="height: 100px;"></div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>