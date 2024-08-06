<?php
session_start();

// Cek apakah admin sudah login, jika sudah redirect ke halaman dashboard
if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true) {
  header("location: dashboard.php");
  exit;
}

// Sertakan file koneksi.php
include_once 'config.php';

// Definisikan variabel kosong untuk menyimpan pesan error
$username = $password = "";
$username_err = $password_err = "";

// Tangani form submission saat admin mencoba untuk login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Validasi username
  if (empty(trim($_POST["username"]))) {
    $username_err = "Mohon masukkan username.";
  } else {
    $username = trim($_POST["username"]);
  }

  // Validasi password
  if (empty(trim($_POST["password"]))) {
    $password_err = "Mohon masukkan password.";
  } else {
    $password = trim($_POST["password"]);
  }

  // Periksa apakah tidak ada error sebelum melanjutkan proses login
  if (empty($username_err) && empty($password_err)) {
    // Query SQL untuk memeriksa keberadaan admin di database
    $sql = "SELECT nip, username, password FROM admin WHERE username = ?";

    if ($stmt = $koneksi->prepare($sql)) {
      // Bind variabel ke prepared statement sebagai parameter
      $stmt->bind_param("s", $param_username);

      // Set parameter
      $param_username = $username;

      // Mencoba mengeksekusi statement
      if ($stmt->execute()) {
        // Bind result variables
        $stmt->bind_result($nip, $db_username, $hashed_password);
        if ($stmt->fetch()) {
          // Memeriksa apakah password cocok
          if (password_verify($password, $hashed_password)) {
            // Mulai session baru
            session_start();

            // Menyimpan data di session variables
            $_SESSION["logged_in"] = true;
            $_SESSION["username"] = $username;

            // Redirect ke halaman dashboard
            header("location: index.php");
            exit();
          } else {
            // Tampilkan pesan error jika password tidak valid
            $password_err = "Password yang Anda masukkan tidak valid.";
          }
        } else {
          // Tampilkan pesan error jika username tidak valid
          $username_err = "Username yang Anda masukkan tidak valid.";
        }
      } else {
        echo "Oops! Ada yang salah. Silakan coba lagi nanti.";
      }

      // Tutup statement
      $stmt->close();
    }
  }

  // Tutup koneksi database
  $koneksi->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="icon" href="assets/img/favicon.png" type="image/png">
  <link rel="stylesheet" href="css/style.css">
  <style>
    body {
      background-image: url('assets/img/login.jpg');
      background-size: cover;
      background-position: center;
      overflow-x: auto;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .container {
      max-width: 380px;
      padding: 20px;
      background-color: #ffffff61;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      margin-bottom: 20px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    form {
      background-color: #ffffff94;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    label {
      display: block;
      margin-bottom: 5px;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    .btn {
      width: 100%;
      padding: 10px;
      background-color: #1877f2;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .btn:hover {
      background-color: #166fe5;
    }

    .logo {
      text-align: center;
      margin-bottom: 20px;
    }

    .logo img {
      width: 150px;
    }

    .help-block {
      color: #f44336;
      margin-top: 5px;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="logo">
      <img src="assets/img/favicon.png" alt="Logo">
    </div>
    <h1>Login</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
        <label>Username</label>
        <input type="text" name="username" value="<?php echo $username; ?>">
        <span class="help-block"><?php echo $username_err; ?></span>
      </div>
      <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
        <label>Password</label>
        <input type="password" name="password">
        <span class="help-block"><?php echo $password_err; ?></span>
      </div>
      <div class="form-group">
        <input type="submit" class="btn" value="Login">
      </div>
      <p>Belum punya akun? <a href="register.php">Daftar Sekarang</a></p>
      <a href="index.php">Kembali</a>
    </form>
  </div>
</body>

</html>