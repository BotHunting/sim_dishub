<?php
include_once 'config.php';

$nip = $nama = $username = $password = $rules = '';
$nip_err = $nama_err = $username_err = $password_err = $rules_err = '';

if (isset($_GET['username']) && !empty($_GET['username'])) {
    $sql = "SELECT * FROM admin WHERE username = ?";
    if ($stmt = $koneksi->prepare($sql)) {
        $stmt->bind_param("s", $param_username);
        $param_username = $_GET['username'];
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();

                $nip = $row['nip'];
                $nama = $row['nama'];
                $username = $row['username'];
                $rules = $row['rules'];
            } else {
                header("location: error.php");
                exit();
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
        $stmt->close();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "UPDATE admin SET nip=?, nama=?, username=?, password=?, rules=? WHERE username=?";
    if ($stmt = $koneksi->prepare($sql)) {
        $stmt->bind_param("ssssss", $param_nip, $param_nama, $param_username, $param_password, $param_rules, $param_original_username);
        $param_nip = $_POST['nip'];
        $param_nama = $_POST['nama'];
        $param_username = $_POST['username'];
        $param_password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Menggunakan hash untuk password
        $param_rules = $_POST['rules'];
        $param_original_username = $_GET['username']; // Menggunakan username asli untuk WHERE clause
        if ($stmt->execute()) {
            // Perbarui data $_SESSION jika username diubah
            if ($_POST['username'] !== $_GET['username']) {
                $_SESSION['username'] = $_POST['username'];
            }
            header("location: panel.php");
            exit();
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
        $stmt->close();
    }
    $koneksi->close();
}
?>

<?php include("header.php"); ?>
<div class="container">
    <h2>Edit Admin</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?username=' . $_GET['username']; ?>" method="post">
        <div class="form-group">
            <label for="nip">NIP:</label>
            <input type="text" id="nip" class="form-control" name="nip" value="<?php echo $nip; ?>">
            <span class="error-message"><?php echo $nip_err; ?></span>
        </div>
        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama; ?>">
            <span class="error-message"><?php echo $nama_err; ?></span>
        </div>
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>">
            <span class="error-message"><?php echo $username_err; ?></span>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password">
            <span class="error-message"><?php echo $password_err; ?></span>
        </div>
        <div class="form-group">
            <label for="rules">Rules:</label>
            <select name="rules" id="rules" class="form-control">
                <option value="">- Select Rule -</option>
                <option value="Staff" <?php if($rules == "Staff") echo "selected"; ?>>Staff</option>
                <option value="Kepala" <?php if($rules == "Kepala") echo "selected"; ?>>Kepala</option>
            </select>
            <span class="error-message"><?php echo $rules_err; ?></span>
        </div><br>
        <div class="form-group">
            <input type="submit" class="btn" value="Simpan">
            <a href="panel.php" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
<?php include("footer.php"); ?>
