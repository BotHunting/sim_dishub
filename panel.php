<?php
require_once('config.php');
$username = $password = $confirm_password = $nama = $nip = '';
$username_err = $password_err = $confirm_password_err = $nama_err = $nip_err = $rules_err = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } else {
        $sql = "SELECT id FROM admin WHERE username = ?";
        if ($stmt = $koneksi->prepare($sql)) {
            $stmt->bind_param("s", $param_username);
            $param_username = trim($_POST["username"]);
            if ($stmt->execute()) {
                $stmt->store_result();
                if ($stmt->num_rows == 1) {
                    $username_err = "This username is already taken.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            $stmt->close();
        }
    }
    if (empty(trim($_POST['password']))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST['password'])) < 6) {
        $password_err = "Password must have at least 6 characters.";
    } else {
        $password = trim($_POST['password']);
    }
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }
    if (empty(trim($_POST["nama"]))) {
        $nama_err = "Please enter your name.";
    } else {
        $nama = trim($_POST["nama"]);
    }
    if (empty(trim($_POST["nip"]))) {
        $nip_err = "Please enter your NIP.";
    } else {
        $nip = trim($_POST["nip"]);
    }
    if (empty(trim($_POST["rules"]))) {
        $rules_err = "Please select a rule.";
    } else {
        $rules = trim($_POST["rules"]);
    }
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($nama_err) && empty($nip_err) && empty($rules_err)) {
        $sql = "INSERT INTO admin (nip, nama, username, password, rules) VALUES (?, ?, ?, ?, ?)";

        if ($stmt = $koneksi->prepare($sql)) {
            // Hash password sebelum disimpan
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt->bind_param("sssss", $param_nip, $param_nama, $param_username, $param_password, $param_rules);
            $param_nip = $nip;
            $param_nama = $nama;
            $param_username = $username;
            // Menggunakan password yang telah di-hash
            $param_password = $hashed_password;
            $param_rules = $rules;
            if ($stmt->execute()) {
                header("location: panel.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            $stmt->close();
        }
    }
    $koneksi->close();
}
?>



<?php include("header.php"); ?>
<main class="main">

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Troblesoot</h1>
                        <p class="mb-0">Pengaturan Akun</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="index.php">Home</a></li>
                    <li class="current">Troblesoot</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <div class="container mt-5">
        <h2>Register</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama; ?>">
                <span class="error-message"><?php echo $nama_err; ?></span>
            </div><br>
            <div class="form-group">
                <label for="nip">NIP:</label>
                <input type="text" class="form-control" id="nip" name="nip" value="<?php echo $nip; ?>">
                <span class="error-message"><?php echo $nip_err; ?></span>
            </div><br>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>">
                <span class="error-message"><?php echo $username_err; ?></span>
            </div><br>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" value="<?php echo $password; ?>">
                <span class="error-message"><?php echo $password_err; ?></span>
            </div><br>
            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" value="<?php echo $confirm_password; ?>">
                <span class="error-message"><?php echo $confirm_password_err; ?></span>
            </div><br>
            <div class="form-group">
                <label for="rules">Rule:</label>
                <select name="rules" id="rules" class="form-control">
                    <option value="">- Select Rule -</option>
                    <option value="Staff">Staff</option>
                    <option value="Kepala">Kepala</option>
                </select>
                <span class="error-message"><?php echo $rules_err; ?></span>
            </div><br>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a href="index.php" class="btn btn-secondary">Kembali</a>
            </div><br>
        </form>
    </div>

    <!-- Starter Section Section -->
    <div class="container">
        <h1>Data Akun</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Rules</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Sertakan file koneksi.php
                include_once 'config.php';
                // Query untuk mengambil data admin dari database
                $sql = "SELECT nama, username, rules FROM admin";
                $result = $koneksi->query($sql);
                if ($result->num_rows > 0) {
                    $no = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . $row['nama'] . "</td>";
                        echo "<td>" . $row['username'] . "</td>";
                        echo "<td>" . $row['rules'] . "</td>";
                        echo "<td>";
                        echo "<a href='edit_admin.php?username=" . $row['username'] . "' class='btn btn-primary'>Edit</a> | <a href='hapus_admin.php?username=" . $row['username'] . "' class='btn btn-danger ml-2' onclick='return confirm(\"Apakah Anda yakin ingin menghapus akun ini?\")'>Hapus</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Tidak ada data admin.</td></tr>";
                }
                $koneksi->close();
                ?>
            </tbody>
        </table>
    </div>

</main>

<?php include("footer.php"); ?>