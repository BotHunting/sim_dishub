<?php
session_start();
// Include file koneksi database
require_once 'koneksi.php';
// Inisialisasi variabel
$nomor_surat = $jenis_pengawasan = $tanggal = $deskripsi = $status = '';
$error = '';
// Cek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $nomor_surat = $_POST['nomor_surat'];
    $jenis_pengawasan = $_POST['jenis_pengawasan'];
    $tanggal = $_POST['tanggal'];
    $deskripsi = $_POST['deskripsi'];
    $status = $_POST['status'];
    // Validasi data
    if (empty($nomor_surat) || empty($jenis_pengawasan) || empty($tanggal) || empty($deskripsi) || empty($status)) {
        $error = "Semua kolom harus diisi";
    } else {
        // File upload
        $targetDir = "lib/spt/";
        $fileName = $jenis_pengawasan . "_" . uniqid() . ".pdf";
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Validasi file
        if ($_FILES["file"]["size"] > 5000000) { // 5MB
            $error = "File terlalu besar. Maksimum 5MB.";
        } elseif (!in_array($fileType, array('pdf'))) {
            $error = "Hanya file PDF yang diizinkan.";
        } else {
            // Upload file ke folder "lib/spt"
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                // Query untuk menambahkan data pengawasan ke dalam tabel
                $query = "INSERT INTO pengawasan (nomor_surat, jenis_pengawasan, tanggal, deskripsi, status, file_upload) VALUES ('$nomor_surat', '$jenis_pengawasan', '$tanggal', '$deskripsi', '$status', '$fileName')";
                // Jalankan query
                if ($koneksi->query($query) === TRUE) {
                    // Redirect ke halaman pengawasan.php setelah berhasil menambahkan data
                    header("Location: pengawasan.php");
                    exit;
                } else {
                    $error = "Error: " . $query . "<br>" . $koneksi->error;
                }
            } else {
                $error = "Terjadi kesalahan saat mengupload file.";
            }
        }
    }
}
?>

<?php include("header.php"); ?>
<div class="container mt-5">
    <h2>Tambah Surat Perintah</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
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
                <option value="Pending">Pending</option>
                <option value="Approved">Approved</option>
                <option value="Rejected">Rejected</option>
            </select>
        </div>
        <div class="form-group">
            <label>Upload File PDF:</label>
            <input type="file" class="form-control-file" name="file">
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