<?php
// Mulai sesi
session_start();

// Sertakan file koneksi ke database
require_once '../../config.php'; // Update to use config.php

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

// Query untuk mengambil daftar bidang
$query_bidang = "SELECT * FROM bidang";
$result_bidang = $koneksi->query($query_bidang);

// Inisialisasi array untuk menyimpan daftar bidang
$bidang_options = [];

// Periksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirimkan melalui form
    $nama_seksi = $_POST['nama_seksi'];
    $bidang = $_POST['bidang'];

    // Validasi nama seksi dan bidang
    if (empty($nama_seksi) || empty($bidang)) {
        $error = "Nama seksi dan bidang harus diisi";
    } else {
        // Query untuk mengupdate data seksi
        $query_update = "UPDATE seksi SET nama_seksi = ?, bidang = ? WHERE id = ?";

        // Persiapkan statement
        $stmt = $koneksi->prepare($query_update);
        $stmt->bind_param('ssi', $nama_seksi, $bidang, $id);

        // Jalankan query
        if ($stmt->execute()) {
            // Redirect ke halaman daftar seksi setelah berhasil mengupdate data seksi
            header("Location: seksi.php");
            exit;
        } else {
            $error = "Error: " . $koneksi->error;
        }
    }
}

// Periksa apakah query berhasil dijalankan dan data ditemukan
if ($result && $result->num_rows > 0) {
    $seksi = $result->fetch_assoc();
} else {
    // Redirect ke halaman daftar seksi jika data tidak ditemukan
    header("Location: seksi.php");
    exit;
}

// Ambil daftar bidang dari hasil query
if ($result_bidang && $result_bidang->num_rows > 0) {
    while ($row_bidang = $result_bidang->fetch_assoc()) {
        $bidang_options[] = $row_bidang['nama_bidang'];
    }
}
?>

<?php include_once 'header.php'; ?>
<div class="container mt-5">
    <h1>Edit Seksi</h1>
    <form action="" method="post">
        <div class="form-group">
            <label for="nama_seksi">Nama Seksi:</label>
            <input type="text" class="form-control" id="nama_seksi" name="nama_seksi" value="<?php echo $seksi['nama_seksi']; ?>" required>
        </div>
        <div class="form-group">
            <label for="bidang">Bidang:</label>
            <select class="form-control" id="bidang" name="bidang" required>
                <option value="">Pilih Bidang</option>
                <?php foreach ($bidang_options as $bidang_option) : ?>
                    <option value="<?php echo $bidang_option; ?>" <?php echo ($bidang_option == $seksi['bidang']) ? 'selected' : ''; ?>><?php echo $bidang_option; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <?php if ($error) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
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