<?php
include_once 'koneksi.php';
$tanggal = $pengirim = $penerima = $judul = $isi = "";
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
    if (empty($tanggal) || empty($pengirim) || empty($penerima) || empty($judul) || empty($isi)) {
        $error = "Semua kolom harus diisi";
    } else {
        $targetDir = "lib/disposisi/";
        $fileName = $pengirim . "_" . uniqid() . ".pdf";
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        if ($_FILES["file"]["size"] > 5000000) { // 5MB
            $error = "File terlalu besar. Maksimum 5MB.";
        } elseif (!in_array($fileType, array('pdf'))) {
            $error = "Hanya file PDF yang diizinkan.";
        } else {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                $sql = "INSERT INTO disposisi (tanggal, pengirim, penerima, judul, isi, file_upload, status) VALUES ('$tanggal', '$pengirim', '$penerima', '$judul', '$isi', '$fileName', '$status')";
                if (mysqli_query($koneksi, $sql)) {
                    header("Location: disposisi.php");
                    exit;
                } else {
                    $error = "Terjadi kesalahan saat menambahkan data: " . mysqli_error($koneksi);
                }
            } else {
                $error = "Terjadi kesalahan saat mengupload file.";
            }
        }
    }
}
?>

<?php include_once 'header.php'; ?>
<div class="container mt-5">
    <h2>Tambah Disposisi</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
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
            <label>Upload File PDF:</label>
            <input type="file" class="form-control-file" name="file">
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