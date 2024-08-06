<?php
// Sertakan file koneksi ke database
require_once 'koneksi.php';

// Periksa apakah parameter jabatan telah dikirim melalui metode GET
if (isset($_GET['jabatan'])) {
    // Escape karakter khusus untuk menghindari SQL injection
    $jabatan = $koneksi->real_escape_string($_GET['jabatan']);

    // Query untuk mengambil seksi berdasarkan jabatan
    $query = "SELECT DISTINCT seksi FROM jabatan WHERE nama_jabatan = ?";
    $stmt = $koneksi->prepare($query);

    // Periksa apakah prepare statement berhasil
    if ($stmt) {
        $stmt->bind_param('s', $jabatan);
        $stmt->execute();
        $result = $stmt->get_result();

        // Inisialisasi variabel untuk menyimpan hasil
        $seksi = '';

        // Periksa apakah query berhasil dijalankan
        if ($result && $result->num_rows > 0) {
            // Ambil hasil query dan simpan dalam variabel seksi
            while ($row = $result->fetch_assoc()) {
                $seksi .= $row['seksi'] . ', ';
            }
            // Hapus koma dan spasi terakhir
            $seksi = rtrim($seksi, ', ');
        } else {
            // Jika tidak ada hasil, set seksi menjadi string kosong
            $seksi = '';
        }

        // Kembalikan data seksi dalam format teks
        echo $seksi;
    } else {
        // Jika prepare statement gagal, kembalikan pesan error
        echo 'Terjadi kesalahan dalam menyiapkan statement SQL';
    }
} else {
    // Jika parameter jabatan tidak ada, kembalikan pesan error
    echo 'Error: Parameter "jabatan" tidak ditemukan.';
}
