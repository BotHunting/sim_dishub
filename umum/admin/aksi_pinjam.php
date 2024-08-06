<?php
include_once 'header.php';
require_once 'koneksi.php';

// Ambil id pinjaman dari URL
$id_pinjaman = $_GET['id'];

// Ambil data pinjaman berdasarkan id
$sql_pinjaman = "SELECT * FROM pinjaman WHERE id = '$id_pinjaman'";
$result_pinjaman = $koneksi->query($sql_pinjaman);

// Periksa apakah id pinjaman valid
if ($result_pinjaman->num_rows == 1) {
    $row_pinjaman = $result_pinjaman->fetch_assoc();
} else {
    echo "<script>alert('ID Peminjaman tidak valid');</script>";
    exit();
}

// Jika aksi adalah "kembalikan"
if ($_GET['aksi'] == 'kembalikan') {
    // Tampilkan notifikasi konfirmasi
    echo "<script>
            if (confirm('Apakah Anda yakin ingin melakukan pengembalian?')) {
                window.location.href = 'proses_kembalikan.php?id=$id_pinjaman';
            } else {
                window.location.href = 'peminjaman.php';
            }
          </script>";
}
?>
