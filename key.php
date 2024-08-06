<?php
session_start();

// Cek apakah pengguna sudah login, jika belum redirect ke halaman login
if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
    header("location: login.php");
    exit;
}

// Inisialisasi array untuk menyimpan kunci
$keys = array("rumbati", "fatagar", "arguni", "patipi", "atiati", "sekar", "wertuer");
$error_message = "";

// Cek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Periksa apakah kunci yang dimasukkan adalah salah satu dari yang diterima
    if (in_array($_POST['key'], $keys)) {
        // Jika benar, simpan kunci di session
        $_SESSION['authenticator_key'] = $_POST['key'];
        // Redirect ke halaman panel.php
        header("location: panel.php");
        exit;
    } else {
        // Jika kunci tidak cocok, tampilkan pesan kesalahan
        $error_message = "Kunci yang dimasukkan tidak valid. Silakan coba lagi.";
    }
}
?>

<?php include("header.php"); ?>
<div class="container">
    <h2>Set Authenticator Key</h2>
    <?php if (!empty($error_message)) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error_message; ?>
        </div>
    <?php endif; ?>
    <p>Masukkan kunci dari aplikasi autentikasi:</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label for="key1">Key 1:</label>
            <input type="text" class="form-control" id="key1" name="key" value="">
        </div><br>
        <div class="form-group">
            <label for="key2">Key 2:</label>
            <input type="text" class="form-control" id="key2" name="key" value="">
        </div><br>
        <div class="form-group">
            <label for="key3">Key 3:</label>
            <input type="text" class="form-control" id="key3" name="key" value="">
        </div><br>
        <div class="form-group">
            <input type="submit" class="btn" value="Simpan">
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </div><br>
    </form>
</div>
<?php include("footer.php"); ?>
