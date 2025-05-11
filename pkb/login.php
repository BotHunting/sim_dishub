<?php
include("header.php");  // Memanggil header.php yang sudah memulai sesi
include("config.php");  // Mengimpor koneksi database dari config.php

// Cek jika pengguna sudah login, maka redirect ke halaman index.php
if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Cek apakah form login disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk mencari username di tabel pegawai
    $sql = "SELECT * FROM pegawai WHERE username = '$username'";
    $result = $conn->query($sql);

    // Jika username ditemukan
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Verifikasi password
        if (password_verify($password, $row['password'])) {
            // Jika login berhasil, buat session untuk pengguna
            $_SESSION['username'] = $row['username'];
            $_SESSION['id'] = $row['id']; // Menyimpan id pengguna dalam session

            // Redirect ke halaman pegawai (index.php)
            header("Location: index.php");
            exit();
        } else {
            // Jika password salah
            $error_message = "Password salah!";
        }
    } else {
        // Jika username tidak ditemukan
        $error_message = "Username tidak ditemukan!";
    }
}
?>

<main class="main">

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Login</h1>
                        <p class="mb-0">Silakan login untuk mengakses sistem.</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="index.php">Home</a></li>
                    <li class="current">Login</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <div class="container mt-5">
        <h2 class="text-center mb-4">Form Login</h2>

        <!-- Form Login -->
        <?php if (isset($error_message)) { echo "<div class='alert alert-danger'>$error_message</div>"; } ?>

        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="username">Username:</label><br>
                <input type="text" class="form-control" id="username" name="username" required><br><br>
            </div>
            <div class="form-group">
                <label for="password">Password:</label><br>
                <input type="password" class="form-control" id="password" name="password" required><br><br>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
    </div>

</main>

<?php include("footer.php"); ?>
