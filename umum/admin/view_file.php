<?php
// Ambil nama file dari URL
$file_name = isset($_GET['file']) ? $_GET['file'] : '';

// Lokasi folder tempat menyimpan file
$folder_path = '../templates/anjab/';

// Lokasi lengkap file yang akan ditampilkan
$file_path = $folder_path . $file_name;

// Periksa apakah file ada
if (file_exists($file_path)) {
    // Header untuk menentukan jenis konten
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="' . $file_name . '"');
    header('Content-Transfer-Encoding: binary');
    header('Accept-Ranges: bytes');

    // Baca file dan tampilkan kontennya
    readfile($file_path);
} else {
    echo "File tidak ditemukan.";
}
