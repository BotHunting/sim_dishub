<?php
include_once 'koneksi.php';
$tanggal = $pengirim = $penerima = $judul = $isi = $file_google_drive = ""; // Definisikan $file_google_drive
$error = "";
$status = "Pending";

// Ambil data nama_seksi dari tabel seksi
$query_seksi = "SELECT * FROM seksi";
$result_seksi = mysqli_query($koneksi, $query_seksi);
$seksi_options = "";
if (mysqli_num_rows($result_seksi) > 0) {
    while ($row_seksi = mysqli_fetch_assoc($result_seksi)) {
        $seksi_options .= '<option value="' . $row_seksi["nama_seksi"] . '">' . $row_seksi["nama_seksi"] . '</option>';
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tanggal = $_POST['tanggal'];
    $pengirim = $_POST['pengirim'];
    $penerima = $_POST['penerima'];
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $file_google_drive = $_POST['file_google_drive']; // Ambil nilai dari form

    if (empty($tanggal) || empty($pengirim) || empty($penerima) || empty($judul) || empty($isi) || empty($file_google_drive)) {
        $error = "Semua kolom harus diisi";
    } else {
        // Simpan data ke database
        $sql = "INSERT INTO disposisi (tanggal, pengirim, penerima, judul, isi, file_google_drive, status) 
                VALUES ('$tanggal', '$pengirim', '$penerima', '$judul', '$isi', '$file_google_drive', '$status')";
        if (mysqli_query($koneksi, $sql)) {
            header("Location: disposisi.php");
            exit;
        } else {
            $error = "Terjadi kesalahan saat menambahkan data: " . mysqli_error($koneksi);
        }
    }
}
?>

<?php include_once 'header.php'; ?>
<div class="container mt-5">
    <h2>Tambah Disposisi</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label>Tanggal:</label>
            <input type="date" class="form-control" name="tanggal" value="<?php echo date('Y-m-d'); ?>">
        </div>
        <div class="form-group">
            <label>Pengirim :</label>
            <select class="form-control" name="pengirim">
                <?php echo $seksi_options; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Ditujukan ke :</label>
            <select class="form-control" name="penerima">
                <?php echo $seksi_options; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Judul:</label>
            <input type="text" class="form-control" name="judul" value="<?php echo $judul; ?>">
        </div>
        <div class="form-group">
            <label>Isi:</label>
            <textarea class="form-control" name="isi"><?php echo $isi; ?></textarea>
        </div>
        <div class="form-group">
            <label>Link Google Drive (Pastikan file sudah diupload ke Google Drive):</label>
            <input type="text" class="form-control" name="file_google_drive" value="<?php echo $file_google_drive; ?>" placeholder="Masukkan link file Google Drive">
        </div>
        <input type="hidden" name="status" value="<?php echo $status; ?>">
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Tambah</button>
            <a href="disposisi.php" class="btn btn-secondary">Kembali</a>
        </div>
        <?php if (!empty($error)) { ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php } ?>
    </form>
</div>
<div style="height: 100px;"></div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
