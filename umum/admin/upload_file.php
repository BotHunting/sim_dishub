<?php
// Mulai sesi
session_start();

// Sertakan file koneksi ke database
require_once 'koneksi.php';

// Inisialisasi variabel untuk menyimpan pesan error
$error = '';

// Periksa apakah ID jabatan telah diterima melalui POST
if (!isset($_POST['id'])) {
    header("Location: jabatan.php");
    exit;
}

$id = $_POST['id'];

// Query untuk mengambil data jabatan berdasarkan ID
$query = "SELECT * FROM jabatan WHERE id = $id";
$result = $koneksi->query($query);

// Periksa apakah query berhasil dijalankan dan data ditemukan
if ($result && $result->num_rows > 0) {
    $jabatan = $result->fetch_assoc();
} else {
    // Redirect ke halaman daftar jabatan jika data tidak ditemukan
    header("Location: jabatan.php");
    exit;
}

// Periksa apakah file PDF telah dipilih untuk diunggah
if ($_FILES["file_pdf"]["error"] == UPLOAD_ERR_OK) {
    // Upload file PDF
    $target_dir = "../templates/anjab/";
    $file_name = $_FILES["file_pdf"]["name"];
    $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
    $file_name_only = pathinfo($file_name, PATHINFO_FILENAME);
    $new_file_name = $jabatan['nama_jabatan'] . "." . $file_extension;
    $target_file = $target_dir . basename($new_file_name);
    $uploadOk = 1;
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Periksa apakah file sudah ada
    if (file_exists($target_file)) {
        $error = "File sudah ada.";
        $uploadOk = 0;
    }

    // Periksa ekstensi file
    if ($file_type != "pdf") {
        $error = "Hanya file PDF yang diizinkan.";
        $uploadOk = 0;
    }

    // Periksa ukuran file
    if ($_FILES["file_pdf"]["size"] > 500000) {
        $error = "Ukuran file terlalu besar.";
        $uploadOk = 0;
    }

    // Jika semua valid, upload file
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["file_pdf"]["tmp_name"], $target_file)) {
            // Simpan nama file dalam kolom 'anjab' dalam tabel 'jabatan'
            $query_update = "UPDATE jabatan SET anjab = ? WHERE id = ?";

            // Persiapkan statement
            $stmt = $koneksi->prepare($query_update);
            $stmt->bind_param('si', $new_file_name, $id);

            // Jalankan query
            if ($stmt->execute()) {
                // Notifikasi sukses
                $_SESSION['success'] = 'File berhasil diunggah.';
            } else {
                $error = "Error: " . $koneksi->error;
            }
        } else {
            $error = "Terjadi kesalahan saat mengupload file.";
        }
    }
} else {
    $error = "Terjadi kesalahan saat mengupload file.";
}

// Jika terdapat error, kembalikan ke halaman edit jabatan dengan pesan error
if ($error) {
    $_SESSION['error'] = $error;
}

// Redirect ke halaman edit jabatan
header("Location: edit_jabatan.php?id=" . $id);
exit;
