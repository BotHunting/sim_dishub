<?php
include_once 'koneksi.php';
// Inisialisasi variabel dengan nilai default
$nomor_surat = $tanggal = $pengirim = $penerima = $subjek = $isi = "";
$error = "";

// Ambil data nama_seksi dari tabel seksi
$query_seksi = "SELECT * FROM seksi";
$result_seksi = mysqli_query($koneksi, $query_seksi);
$seksi_options = "";
if (mysqli_num_rows($result_seksi) > 0) {
    while ($row_seksi = mysqli_fetch_assoc($result_seksi)) {
        $seksi_options .= '<option value="' . $row_seksi["nama_seksi"] . '">' . $row_seksi["nama_seksi"] . '</option>';
    }
}

// Set status secara otomatis ke "Draft"
$status = "Draft";
// Cek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $nomor_surat = $_POST['nomor_surat'];
    $tanggal = $_POST['tanggal'];
    $pengirim = $_POST['pengirim'];
    $penerima = $_POST['penerima'];
    $subjek = $_POST['subjek'];
    $isi = $_POST['isi'];
    // Validasi input
    if (empty($nomor_surat) || empty($tanggal) || empty($pengirim) || empty($penerima) || empty($subjek) || empty($isi)) {
        $error = "Semua kolom harus diisi";
    } else {
        // File upload
        $targetDir = "lib/surat/";
        $fileName = $pengirim . "_" . uniqid() . ".pdf";
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        // Validasi file
        if ($_FILES["file_upload"]["size"] > 5000000) { // 5MB
            $error = "File terlalu besar. Maksimum 5MB.";
        } elseif (!in_array($fileType, array('pdf'))) {
            $error = "Hanya file PDF yang diizinkan.";
        } else {
            // Upload file ke folder "lib"
            if (move_uploaded_file($_FILES["file_upload"]["tmp_name"], $targetFilePath)) {
                // Insert data ke database
                $sql = "INSERT INTO suratmenyurat (nomor_surat, tanggal, pengirim, penerima, subjek, isi, status, file_upload) VALUES ('$nomor_surat', '$tanggal', '$pengirim', '$penerima', '$subjek', '$isi', '$status', '$fileName')";
                if (mysqli_query($koneksi, $sql)) {
                    // Jika berhasil, redirect ke halaman surat_menyurat.php
                    header("Location: surat_menyurat.php");
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
    <h2>Tambah Surat</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nomor_surat">Nomor Surat</label>
            <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" value="<?php echo $nomor_surat; ?>" required>
        </div>
        <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo date('Y-m-d'); ?>" required>
        </div>
        <div class="form-group">
            <label>Pengirim :</label>
            <select class="form-control" id="pengirim" name="pengirim">
                <?php echo $seksi_options; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="penerima">Ditujukan Ke</label>
            <input type="text" class="form-control" id="penerima" name="penerima" value="<?php echo $penerima; ?>" required>
        </div>
        <div class="form-group">
            <label for="subjek">Subjek</label>
            <input type="text" class="form-control" id="subjek" name="subjek" value="<?php echo $subjek; ?>" required>
        </div>
        <div class="form-group">
            <label for="isi">Isi Surat</label>
            <textarea class="form-control" id="isi" name="isi" rows="5" required><?php echo $isi; ?></textarea>
        </div>
        <div class="form-group">
            <label for="file_upload">Upload File PDF</label>
            <input type="file" class="form-control-file" id="file_upload" name="file_upload" accept="application/pdf" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="javascript:history.go(-1);" class="btn btn-secondary">Kembali</a>
        <?php if (!empty($error)) { ?>
            <div class="alert alert-danger mt-3"><?php echo $error; ?></div>
        <?php } ?>
    </form>
</div>
<div style="height: 100px;"></div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>