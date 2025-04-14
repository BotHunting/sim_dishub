<?php
session_start();
// Include file koneksi database
require_once 'koneksi.php';
// Inisialisasi variabel
$nomor_surat = $jenis_pengawasan = $tanggal = $deskripsi = $status = $file_google_drive = '';
$error = '';

// Cek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $nomor_surat = $_POST['nomor_surat'];
    $jenis_pengawasan = $_POST['jenis_pengawasan'];
    $tanggal = $_POST['tanggal'];
    $deskripsi = $_POST['deskripsi'];
    $status = $_POST['status'];
    $file_google_drive = $_POST['file_google_drive']; // Ambil link Google Drive dari form

    // Validasi data
    if (empty($nomor_surat) || empty($jenis_pengawasan) || empty($tanggal) || empty($deskripsi) || empty($status)) {
        $error = "Semua kolom harus diisi";
    } elseif (empty($file_google_drive)) {
        $error = "Link Google Drive harus diisi";
    } else {
        // Query untuk menambahkan data pengawasan ke dalam tabel
        $query = "INSERT INTO pengawasan (nomor_surat, jenis_pengawasan, tanggal, deskripsi, status, file_google_drive) 
                  VALUES ('$nomor_surat', '$jenis_pengawasan', '$tanggal', '$deskripsi', '$status', '$file_google_drive')";
        
        // Jalankan query
        if ($koneksi->query($query) === TRUE) {
            // Redirect ke halaman pengawasan.php setelah berhasil menambahkan data
            header("Location: pengawasan.php");
            exit;
        } else {
            $error = "Error: " . $query . "<br>" . $koneksi->error;
        }
    }
}
?>

<?php include("header.php"); ?>
<div class="container mt-5">
    <h2>Tambah Surat Perintah</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label for="nomor_surat" class="form-label">Nomor Surat</label>
            <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" value="<?php echo $nomor_surat; ?>">
        </div>
        <div class="form-group">
            <label>Jenis SPT:</label>
            <input type="text" name="jenis_pengawasan" class="form-control" value="<?php echo $jenis_pengawasan; ?>">
        </div>
        <div class="form-group">
            <label>Tanggal:</label>
            <input type="date" name="tanggal" class="form-control" value="<?php echo $tanggal; ?>">
        </div>
        <div class="form-group">
            <label>Deskripsi:</label>
            <textarea name="deskripsi" class="form-control"><?php echo $deskripsi; ?></textarea>
        </div>
        <div class="form-group">
            <label>Status:</label>
            <select name="status" class="form-control">
                <option value="Pending" <?php if ($status == 'Pending') echo 'selected'; ?>>Pending</option>
                <option value="Approved" <?php if ($status == 'Approved') echo 'selected'; ?>>Approved</option>
                <option value="Rejected" <?php if ($status == 'Rejected') echo 'selected'; ?>>Rejected</option>
            </select>
        </div>
        <div class="form-group">
            <label>Masukkan Link Google Drive:</label>
            <input type="text" class="form-control" name="file_google_drive" value="<?php echo $file_google_drive; ?>" placeholder="Masukkan link Google Drive">
        </div>
        <button type="submit" class="btn btn-primary">Tambah</button>
        <a href="javascript:history.go(-1);" class="btn btn-secondary">Kembali</a>
        <?php if (!empty($error)) : ?>
            <div class="alert alert-danger mt-3"><?php echo $error; ?></div>
        <?php endif; ?>
    </form>
</div>
<div style="height: 100px;"></div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
