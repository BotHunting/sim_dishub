<?php
// Sertakan file koneksi.php
include_once 'koneksi.php';

// Ambil data dari formulir tambah petugas
$nama = $_POST['nama'];
$nip = $_POST['nip'];
$jabatan = $_POST['jabatan'];
$jadwal_kerja = $_POST['jadwal_kerja'];
$telepon = $_POST['telepon'];

// Cek apakah file foto sudah diupload
if (isset($_FILES['foto'])) {
    $errors = array();
    $file_name = $_FILES['foto']['name'];
    $file_size = $_FILES['foto']['size'];
    $file_tmp = $_FILES['foto']['tmp_name'];
    $file_type = $_FILES['foto']['type'];
    $file_name_parts = explode('.', $file_name);
    $file_ext = strtolower(end($file_name_parts));
    
    // Ekstensi yang diperbolehkan
    $extensions = array("jpeg", "jpg", "png");

    // Cek apakah ekstensi file sesuai dengan yang diperbolehkan
    if (in_array($file_ext, $extensions) === false) {
        $errors[] = "Ekstensi file hanya bisa jpeg, jpg, atau png.";
    }

    // Cek apakah ukuran file tidak melebihi batas
    if ($file_size > 2097152) {
        $errors[] = 'Ukuran file harus kurang dari 2 MB';
    }

    // Jika tidak ada kesalahan, pindahkan file ke folder tujuan
    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, "assets/img/petugas/" . $nip . "." . $file_ext);
        echo "File berhasil diunggah.";
    } else {
        print_r($errors);
    }
}

// Query untuk menambahkan data petugas ke dalam database
$sql = "INSERT INTO Petugas (nama, nip, jabatan, jadwal_kerja, telepon, foto) VALUES ('$nama', '$nip', '$jabatan', '$jadwal_kerja', '$telepon', '$file_name')";

if ($koneksi->query($sql) === TRUE) {
    // Jika berhasil, redirect kembali ke halaman tambah_petugas.php
    header("Location: tambah_petugas.php");
} else {
    // Jika terjadi kesalahan, tampilkan pesan kesalahan
    echo "Error: " . $sql . "<br>" . $koneksi->error;
}

// Tutup koneksi database
$koneksi->close();
