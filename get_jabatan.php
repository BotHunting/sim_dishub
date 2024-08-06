<?php
// Sertakan file koneksi.php
include_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Periksa apakah nama pegawai telah dikirim melalui AJAX request
    if (isset($_POST['pegawai'])) {
        // Escape string nama pegawai untuk mencegah SQL injection
        $nama_pegawai = mysqli_real_escape_string($koneksi, $_POST['pegawai']);

        // Query untuk mengambil jabatan berdasarkan nama pegawai
        $sql = "SELECT jabatan FROM pegawai WHERE nama = '$nama_pegawai'";
        $result = $koneksi->query($sql);

        if ($result->num_rows == 1) {
            // Ambil hasil query dan kirimkan jabatan sebagai respons
            $row = $result->fetch_assoc();
            echo $row['jabatan'];
        } else {
            // Jika tidak ada data yang cocok, kirimkan pesan error
            echo "Jabatan tidak ditemukan untuk pegawai ini.";
        }
    } else {
        // Jika nama pegawai tidak dikirimkan, kirimkan pesan error
        echo "Nama pegawai tidak ditemukan.";
    }
} else {
    // Jika bukan request POST, kirimkan pesan error
    echo "Permintaan tidak valid.";
}

// Tutup koneksi
$koneksi->close();
