<?php
// Mulai sesi
session_start();

// Sertakan file koneksi ke database
require_once 'koneksi.php';

// Inisialisasi variabel error
$error = '';

// Proses form jika tombol "Tambah Laporan" ditekan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirimkan melalui form
    $nomor_surat = $_POST['nomor_surat'];
    $tanggal = $_POST['tanggal'];
    $jenis_laporan = $_POST['jenis_laporan'];
    $isi = $_POST['isi'];
    $status = $_POST['status'];
    $file_google_drive = $_POST['file_google_drive'];  // Ambil link Google Drive

    // Validasi link Google Drive
    if (empty($file_google_drive)) {
        $error = "Masukkan link Google Drive untuk file laporan.";
    }

    // Jika tidak ada error, masukkan data ke dalam database
    if (empty($error)) {
        // Query SQL untuk menambahkan data laporan ke dalam tabel
        $sql = "INSERT INTO laporan (nomor_surat, tanggal, jenis_laporan, isi, status, file_google_drive) 
                VALUES (?, ?, ?, ?, ?, ?)";

        // Gunakan prepared statement untuk mencegah SQL Injection
        $stmt = $koneksi->prepare($sql);
        $stmt->bind_param('ssssss', $nomor_surat, $tanggal, $jenis_laporan, $isi, $status, $file_google_drive);
        if ($stmt->execute()) {
            // Redirect ke halaman laporan.php setelah berhasil menambahkan data
            header("Location: laporan.php");
            exit;
        } else {
            $error = "Error: " . $sql . "<br>" . $koneksi->error;
        }
    }
}
?>

<?php include_once 'header.php'; ?>
<div class="container mt-5">
    <h1 class="mb-4">Tambah Laporan</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div class="mb-3">
            <label for="nomor_surat" class="form-label">Nomor Surat</label>
            <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" required>
        </div>
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
        </div>
        <div class="mb-3">
            <label>Jenis Laporan:</label>
            <select name="jenis_laporan" class="form-control" required>
                <option value="">Pilih Jenis Laporan</option>
                <option value="Harian">Harian</option>
                <option value="Mingguan">Mingguan</option>
                <option value="Bulanan">Bulanan</option>
                <option value="Tahunan">Tahunan</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="isi" class="form-label">Isi Laporan</label>
            <textarea class="form-control" id="isi" name="isi" rows="5" required></textarea>
        </div>
        <div class="mb-3">
            <label>Status:</label>
            <select name="status" class="form-control" required>
                <option value="">Pilih Status</option>
                <option value="Pending">Pending</option>
                <option value="Approved">Approved</option>
                <option value="Rejected">Rejected</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="file_google_drive" class="form-label">Link Google Drive:</label>
            <input type="url" class="form-control" id="file_google_drive" name="file_google_drive" required placeholder="Masukkan link Google Drive">
        </div>
        <?php if (!empty($error)) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        <button type="submit" class="btn btn-primary">Tambah Laporan</button>
        <a href="javascript:history.go(-1);" class="btn btn-secondary">Kembali</a>
    </form>
</div>
<div style="height: 100px;"></div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
