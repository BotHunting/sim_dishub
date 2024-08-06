<?php
// Sertakan file koneksi.php
include_once 'config.php';

// Inisialisasi variabel
$username = "";
$username_err = "";

// Cek parameter dari URL
if (isset($_GET['username']) && !empty($_GET['username'])) {
    // Siapkan pernyataan SELECT
    $sql = "SELECT * FROM admin WHERE username = ?";

    if ($stmt = $koneksi->prepare($sql)) {
        // Bind parameter ke pernyataan persiapan
        $stmt->bind_param("s", $param_username);

        // Set parameter
        $param_username = $_GET['username'];

        // Mencoba mengeksekusi pernyataan persiapan
        if ($stmt->execute()) {
            // Simpan hasilnya
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                // Ambil baris hasil sebagai array asosiatif
                $row = $result->fetch_assoc();

                // Isi variabel dengan nilai dari database
                $username = $row['username'];
            } else {
                // Jika tidak ada baris yang cocok, redirect ke halaman error
                header("location: error.php");
                exit();
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Tutup pernyataan
        $stmt->close();
    }
}

// Proses penghapusan ketika konfirmasi dilakukan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Hapus admin dari database
    $sql = "DELETE FROM admin WHERE username = ?";

    if ($stmt = $koneksi->prepare($sql)) {
        // Bind parameter ke pernyataan persiapan
        $stmt->bind_param("s", $param_username);

        // Set parameter
        $param_username = $_POST['username'];

        // Mencoba mengeksekusi pernyataan persiapan
        if ($stmt->execute()) {
            // Redirect ke halaman data admin setelah penghapusan berhasil
            header("location: panel.php");
            exit();
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Tutup pernyataan
        $stmt->close();
    }

    // Tutup koneksi
    $koneksi->close();
}
?>

<?php include("header.php"); ?>
<div class="container">
    <h2>Hapus Admin</h2>
    <p>Apakah Anda yakin ingin menghapus admin dengan username: <strong><?php echo $username; ?></strong>?</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="hidden" name="username" value="<?php echo $username; ?>">
        <div class="form-group">
            <input type="submit" class="btn btn-danger" value="Hapus">
            <a href="panel.php" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
<?php include("footer.php"); ?>
