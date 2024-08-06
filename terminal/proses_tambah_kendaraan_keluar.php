<?php
// Include file koneksi.php untuk menghubungkan ke database
include_once 'koneksi.php';

// Mengambil data yang dikirim melalui form
$nomor_kendaraan = $_POST['nomor_kendaraan'];
$trayek = $_POST['trayek'];
$waktu_kedatangan = $_POST['waktu_kedatangan'];
$jumlah_penumpang_masuk = $_POST['jumlah_penumpang_masuk'];
$asal_terminal = $_POST['asal_terminal'];
$waktu_keberangkatan = $_POST['waktu_keberangkatan'];
$jumlah_penumpang_keluar = $_POST['jumlah_penumpang_keluar'];
$tujuan_terminal = $_POST['tujuan_terminal'];
$retribusi = $_POST['retribusi'];

// Query untuk menyimpan data ke tabel kendaraan_keluar
$sql_insert_keluar = "INSERT INTO kendaraan_keluar (nomor_kendaraan, trayek, waktu_kedatangan, jumlah_penumpang_masuk, asal_terminal, waktu_keberangkatan, jumlah_penumpang_keluar, tujuan_terminal, retribusi) 
                     VALUES ('$nomor_kendaraan', '$trayek', '$waktu_kedatangan', '$jumlah_penumpang_masuk', '$asal_terminal', '$waktu_keberangkatan', '$jumlah_penumpang_keluar', '$tujuan_terminal', '$retribusi')";

// Query untuk menghapus data dari tabel kendaraan_masuk berdasarkan nomor kendaraan yang dipilih
$sql_delete_masuk = "DELETE FROM kendaraan_masuk WHERE nomor_kendaraan = '$nomor_kendaraan'";

// Jalankan query untuk menyimpan data ke tabel kendaraan_keluar
if ($koneksi->query($sql_insert_keluar) === TRUE) {
    // Jalankan query untuk menghapus data dari tabel kendaraan_masuk
    if ($koneksi->query($sql_delete_masuk) === TRUE) {
        // Jika data berhasil disimpan dan dihapus, redirect ke halaman utama dengan pesan sukses
        header("Location: tambah_kendaraan.php?status=success");
        exit;
    } else {
        // Jika gagal menghapus data dari tabel kendaraan_masuk, tampilkan pesan error
        echo "Error: " . $sql_delete_masuk . "<br>" . $koneksi->error;
    }
} else {
    // Jika gagal menyimpan data ke tabel kendaraan_keluar, tampilkan pesan error
    echo "Error: " . $sql_insert_keluar . "<br>" . $koneksi->error;
}

// Tutup koneksi database
$koneksi->close();
