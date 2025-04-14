<?php
session_start();
require_once __DIR__ . '/../config.php';
$nama_layanan = $deskripsi = $pemohon = $file_google_drive = '';
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
        $file_google_drive = $_POST['file_google_drive']; // Link Google Drive
        $status = 'Pending';

        if (empty($nama_layanan) || empty($pemohon) || empty($file_google_drive)) {
            $error = "Semua kolom harus diisi";
        } else {
            // Validasi link Google Drive
            if (!filter_var($file_google_drive, FILTER_VALIDATE_URL) || !str_contains($file_google_drive, 'drive.google.com')) {
                $error = "Link Google Drive tidak valid.";
            } else {
                // Menggunakan prepared statement untuk mencegah SQL Injection
                $query = "INSERT INTO pelayananumum (tanggal, nama_layanan, deskripsi, pemohon, file_google_drive, status) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $koneksi->prepare($query);
                $stmt->bind_param("ssssss", $tanggal, $nama_layanan, $deskripsi, $pemohon, $file_google_drive, $status);
                if ($stmt->execute()) {
                    header("Location: pelayanan.php");
                    exit;
                } else {
                    $error = "Error: " . $stmt->error;
                }
                $stmt->close();
            }
        }
    }
}
?>

<?php include("header.php"); ?>
<div class="container mt-5">
    <h2>Tambah Data Pelayanan Umum</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label>Tanggal:</label>
            <input type="text" class="form-control" value="<?php echo date("Y-m-d H:i:s"); ?>" readonly>
        </div><br>
        <div class="form-group">
            <label>Perihal:</label>
            <input type="text" name="nama_layanan" class="form-control" value="<?php echo $nama_layanan; ?>" required>
        </div><br>
        <div class="form-group">
            <label>Deskripsi:</label>
            <textarea name="deskripsi" class="form-control" required><?php echo $deskripsi; ?></textarea>
        </div><br>
        <div class="form-group">
            <label>Nama Pemohon:</label>
            <input type="text" name="pemohon" class="form-control" value="<?php echo $pemohon; ?>" required>
        </div><br>
        <div class="form-group">
            <label>Link Google Drive (File PDF):</label>
            <input type="url" name="file_google_drive" class="form-control" placeholder="Masukkan link Google Drive" value="<?php echo $file_google_drive; ?>" required>
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
