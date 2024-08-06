<?php
// Sertakan file koneksi.php untuk terhubung ke database
require_once('koneksi.php');

// Inisialisasi variabel error
$errors = [];

// Periksa apakah ID petugas telah diberikan melalui URL
if (isset($_GET['id'])) {
    // Ambil ID petugas dari URL dan lakukan pembersihan data
    $id = htmlspecialchars($_GET['id']);

    // Periksa apakah tombol hapus telah diklik
    if (isset($_POST['hapus'])) {
        // Proses penghapusan petugas dari database
        $sql = "DELETE FROM petugas_parkir WHERE id=?";
        $stmt = $koneksi->prepare($sql);
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            // Redirect ke halaman daftar_petugas.php setelah berhasil menghapus
            header("Location: daftar_petugas.php");
            exit();
        } else {
            $errors[] = "Gagal menghapus petugas";
        }
    }
} else {
    // Redirect ke halaman daftar_petugas.php jika ID petugas tidak ditemukan dalam URL
    header("Location: daftar_petugas.php");
    exit();
}

// Tutup koneksi database
$koneksi->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Petugas</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-image: url('images/daftar_petugas.jpg');
            background-size: cover;
            background-position: center;
            color: #333;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: auto;
        }

        header {
            background-color: #1877f2;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .container {
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffffc9;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input[type="text"],
        .form-group input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-group .help-block {
            color: red;
        }

        button {
            background-color: #FFC147;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .success-message {
            color: green;
            margin-top: 10px;
        }

        @media only screen and (max-width: 768px) {

            .form-group input[type="text"],
            .form-group input[type="email"] {
                width: 80%;
            }
        }
    </style>
</head>

<body>
    <?php include('navbar.php'); ?>
    <header>
        <h1>Hapus Petugas</h1>
    </header>
    <div class="container">
        <?php if (!empty($errors)) : ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($errors as $error) : ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id; ?>" method="POST">
            <p>Apakah Anda yakin ingin menghapus petugas ini?</p>
            <button type="submit" name="hapus">Hapus</button>
            <a href="daftar_petugas.php">Batal</a>
        </form>
    </div>
</body>

</html>