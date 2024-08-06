<?php
session_start();
require_once 'koneksi.php';
$nama_layanan = $deskripsi = $pemohon = '';
$error = '';

// Fungsi untuk menghasilkan CAPTCHA sederhana
function generateSimpleCaptcha()
{
    $number1 = rand(1, 9);
    $number2 = rand(1, 9);
    $_SESSION['captcha_result'] = $number1 + $number2;
    return "$number1 + $number2 = ?";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Memeriksa apakah jawaban CAPTCHA benar
    if (!isset($_POST['captcha']) || empty($_POST['captcha']) || $_POST['captcha'] != $_SESSION['captcha_result']) {
        $error = "Jawaban Salah!!";
    } else {
        $tanggal = date("Y-m-d H:i:s"); // Menggunakan tanggal, jam, dan detik dari komputer
        $nama_layanan = $_POST['nama_layanan'];
        $deskripsi = $_POST['deskripsi'];
        $pemohon = $_POST['pemohon'];
        $file_upload = ''; // Inisialisasi nama file upload
        $status = 'Pending';
        if (empty($nama_layanan) || empty($pemohon)) {
            $error = "Semua kolom harus diisi";
        } else {
            if (!empty($_FILES['file']['name'])) {
                $target_dir = "templates/pelayananumum/";
                $file_upload = $pemohon . "_" . uniqid() . ".pdf";
                $target_file = $target_dir . basename($file_upload);
                $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                if ($file_type != "pdf") {
                    $error = "Hanya file PDF yang diizinkan";
                } else {
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
                        // Menggunakan prepared statement untuk mencegah SQL Injection
                        $query = "INSERT INTO pelayananumum (tanggal, nama_layanan, deskripsi, pemohon, file_upload, status) VALUES (?, ?, ?, ?, ?, ?)";
                        $stmt = $koneksi->prepare($query);
                        $stmt->bind_param("ssssss", $tanggal, $nama_layanan, $deskripsi, $pemohon, $file_upload, $status);
                        if ($stmt->execute()) {
                            header("Location: pelayanan.php");
                            exit;
                        } else {
                            $error = "Error: " . $stmt->error;
                        }
                        $stmt->close();
                    } else {
                        $error = "Terjadi kesalahan saat mengunggah file";
                    }
                }
            } else {
                $error = "File harus diunggah";
            }
        }
    }
}
?>

<?php include("header.php"); ?>
<div class="container mt-5">
    <h2>Tambah Data Pelayanan Umum</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
        <div class="form-group">
            <label>Tanggal:</label>
            <input type="text" class="form-control" value="<?php echo date("Y-m-d H:i:s"); ?>" readonly>
        </div><br>
        <div class="form-group">
            <label>Perihal:</label>
            <input type="text" name="nama_layanan" class="form-control" value="<?php echo $nama_layanan; ?>">
        </div><br>
        <div class="form-group">
            <label>Deskripsi:</label>
            <textarea name="deskripsi" class="form-control"><?php echo $deskripsi; ?></textarea>
        </div><br>
        <div class="form-group">
            <label>Nama Pemohon:</label>
            <input type="text" name="pemohon" class="form-control" value="<?php echo $pemohon; ?>">
        </div><br>
        <div class="form-group">
            <label>Upload File (PDF):</label>
            <input type="file" name="file" class="form-control-file">
        </div><br>
        <!-- Menampilkan CAPTCHA sederhana -->
        <div class="form-group">
            <label for="captcha">Jawab Pertanyaan Berikut:</label>
            <input type="text" class="form-control" id="captcha" name="captcha" placeholder="<?php echo generateSimpleCaptcha(); ?>" required>
        </div><br>
        <button type="submit" class="btn btn-primary">Tambah</button>
        <a href="pelayanan.php" class="btn btn-secondary">Kembali</a>
        <?php if (!empty($error)) : ?>
            <div class="alert alert-danger mt-3"><?php echo $error; ?></div>
        <?php endif; ?>
    </form>
</div>
<?php include("footer.php"); ?>