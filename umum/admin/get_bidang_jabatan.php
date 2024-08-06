<?php
// Sertakan file koneksi ke database
require_once 'koneksi.php';

// Periksa apakah variabel POST seksi telah diset
if (isset($_POST['seksi'])) {
    // Ambil nilai seksi dari POST data dan bersihkan dari spesial karakter
    $seksi = htmlspecialchars($_POST['seksi']);

    // Buat query untuk mengambil bidang berdasarkan seksi yang dipilih
    $query = "SELECT bidang FROM seksi WHERE nama_seksi = ?";
    $stmt = $koneksi->prepare($query);

    // Periksa apakah prepare statement berhasil
    if ($stmt) {
        $stmt->bind_param('s', $seksi);
        $stmt->execute();
        $result = $stmt->get_result();

        // Periksa apakah query berhasil dijalankan
        if ($result && $result->num_rows > 0) {
            // Ambil baris hasil query dan kembalikan bidangnya
            $row = $result->fetch_assoc();
            echo htmlspecialchars($row['bidang']);
        } else {
            // Jika tidak ada hasil, kembalikan pesan error
            echo "Tidak dapat menemukan bidang untuk seksi yang dipilih";
        }
    } else {
        // Jika prepare statement gagal, kembalikan pesan error
        echo "Terjadi kesalahan dalam menyiapkan statement SQL";
    }
} else {
    // Jika variabel POST tidak diset, kembalikan pesan error
    echo "Seksi tidak tersedia";
}
