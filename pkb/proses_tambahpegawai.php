<?php
// Sertakan file konfigurasi utama dan mulai sesi
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../assets/config.php';

// Cek apakah pengguna login
if (!isset($_SESSION['username'])) {
    die("Akses ditolak. Silakan login terlebih dahulu.");
}

// Cek apakah form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil dan sanitasi data dari form
    $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
    $jabatan = filter_input(INPUT_POST, 'jabatan', FILTER_SANITIZE_STRING);
    $deskripsi = filter_input(INPUT_POST, 'deskripsi', FILTER_SANITIZE_STRING);
    $twitter = filter_input(INPUT_POST, 'twitter', FILTER_SANITIZE_URL);
    $facebook = filter_input(INPUT_POST, 'facebook', FILTER_SANITIZE_URL);
    $instagram = filter_input(INPUT_POST, 'instagram', FILTER_SANITIZE_URL);
    $linkedin = filter_input(INPUT_POST, 'linkedin', FILTER_SANITIZE_URL);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = $_POST["password"]; // Tidak difilter karena akan di-hash

    // Enkripsi password
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Inisialisasi variabel untuk nama file foto
    $new_filename = '';
    $uploadOk = 0;

    // Proses upload foto
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $target_dir = __DIR__ . "/assets/img/trainers/";
        $file_info = pathinfo($_FILES["foto"]["name"]);
        $file_extension = strtolower($file_info['extension']);
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

        // Validasi file
        $check = getimagesize($_FILES["foto"]["tmp_name"]);
        if ($check === false) {
            die("Error: File yang diupload bukan gambar.");
        }

        if ($_FILES["foto"]["size"] > 2000000) { // 2MB limit
            die("Error: Ukuran file terlalu besar. Maksimal 2MB.");
        }

        if (!in_array($file_extension, $allowed_extensions)) {
            die("Error: Hanya file JPG, JPEG, PNG & GIF yang diizinkan.");
        }

        // Buat nama file unik
        $new_filename = uniqid('pegawai_', true) . '.' . $file_extension;
        $target_file = $target_dir . $new_filename;

        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
            $uploadOk = 1;
        } else {
            die("Error: Terjadi kesalahan saat mengupload file.");
        }
    } else {
        die("Error: Foto pegawai wajib diupload.");
    }

    // Jika semua validasi berhasil, lanjutkan penyimpanan data
    if ($uploadOk == 1) {
        // Insert data ke database menggunakan prepared statement
        $sql = "INSERT INTO pegawai_pkb (nama, jabatan, deskripsi, foto, twitter, facebook, instagram, linkedin, username, password) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = $koneksi->prepare($sql)) {
            $stmt->bind_param("ssssssssss", $nama, $jabatan, $deskripsi, $new_filename, $twitter, $facebook, $instagram, $linkedin, $username, $password_hash);

            if ($stmt->execute()) {
                // Redirect ke halaman pegawai dengan status sukses
                header("Location: trainers.php?status=added");
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error: " . $koneksi->error;
        }
    }

    $koneksi->close();
} else {
    // Jika bukan metode POST, redirect
    header("Location: tambah_pegawai.php");
    exit();
}
?>
