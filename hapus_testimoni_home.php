<?php
// Include file konfigurasi database
include_once 'config.php';

// Periksa apakah parameter id diterima dari URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Ambil nilai id testimoni dari URL
    $id = $_GET['id'];

    // Query untuk mengambil data testimoni berdasarkan id
    $sql = "SELECT * FROM testimoni_home WHERE id = $id";
    $result = $koneksi->query($sql);

    // Periksa apakah testimoni ditemukan
    if ($result->num_rows > 0) {
        // Ambil data testimoni
        $row = $result->fetch_assoc();
        $nama = $row['nama'];

        // Tampilkan peringatan konfirmasi sebelum menghapus testimoni
        echo "<script>
                var konfirmasi = confirm('Apakah Anda yakin ingin menghapus testimoni dari $nama?');
                if(konfirmasi) {
                    window.location.href = 'proses_hapus_testimoni_home.php?id=$id';
                } else {
                    window.location.href = 'testi_home.php'; // Redirect ke halaman utama jika tidak jadi menghapus
                }
            </script>";
    } else {
        echo "Testimoni tidak ditemukan.";
    }
} else {
    echo "Parameter id tidak ditemukan.";
}

// Tutup koneksi database
$koneksi->close();
