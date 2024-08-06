<?php
// Sertakan file koneksi.php untuk terhubung ke database
require_once('koneksi.php');

// Inisialisasi variabel error
$errors = [];
$message = "";

// Periksa apakah ID lokasi telah diberikan melalui URL
if (isset($_GET['id'])) {
    // Ambil ID lokasi dari URL dan lakukan pembersihan data
    $id = htmlspecialchars($_GET['id']);

    // Periksa apakah formulir telah disubmit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Ambil dan bersihkan data yang diinput dari formulir
        $lokasi = htmlspecialchars($_POST['lokasi']);

        // Validasi input (contoh: memastikan semua field tidak kosong)
        if (empty($lokasi)) {
            $errors[] = "Field lokasi harus diisi";
        } else {
            // Jika tidak ada kesalahan, update data ke database
            $sql = "UPDATE parkir SET lokasi=? WHERE id=?";
            $stmt = $koneksi->prepare($sql);
            $stmt->bind_param("si", $lokasi, $id);
            if ($stmt->execute()) {
                // Set pesan notifikasi
                $message = "Data lokasi berhasil diperbarui.";
            } else {
                $errors[] = "Gagal memperbarui lokasi";
            }
        }
    } else {
        // Ambil data lokasi berdasarkan ID dari database
        $sql = "SELECT * FROM parkir WHERE id=?";
        $stmt = $koneksi->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Periksa apakah data lokasi ditemukan
        if ($result->num_rows === 0) {
            $errors[] = "Lokasi tidak ditemukan";
        } else {
            // Ambil data lokasi
            $row = $result->fetch_assoc();
            $lokasi = $row['lokasi'];
        }
    }
} else {
    // Redirect ke halaman daftar_lokasi.php jika ID lokasi tidak ditemukan dalam URL
    header("Location: daftar_lokasi.php");
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
    <title>Edit Lokasi</title>
    <link rel="icon" href="images/logo.png" type="image/png">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-image: url('images/tambah_lokasi.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            background-size: cover;
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
            width: auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-group .help-block {
            color: red;
        }

        .form-group .btn-submit {
            background-color: #FFC147;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            box-sizing: border-box;
            display: block;
            margin-top: 10px;
        }

        .form-group .btn-submit:hover {
            background-color: #45a049;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        .success-message {
            color: green;
            margin-top: 10px;
        }

        th {
            background-color: #ffd73f;
        }

        @media only screen and (max-width: 768px) {
            .form-group input[type="text"] {
                width: calc(100% - 20px);
            }

            .form-group .btn-submit {
                margin-top: 20px;
            }
        }
    </style>
</head>

<body>
    <?php include('navbar.php'); ?>
    <header>
        <h1>Edit Lokasi</h1>
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
        <?php if (!empty($message)) : ?>
            <div class="success-message">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id; ?>" method="POST">
            <div class="form-group">
                <label for="lokasi">Lokasi:</label>
                <input type="text" name="lokasi" id="lokasi" value="<?php echo $lokasi; ?>">
            </div>
            <button type="submit" class="btn-submit">Simpan Perubahan</button>
            <a href="daftar_lokasi.php">Kembali</a>
        </form>
    </div>
</body>

</html>