<?php
include_once 'koneksi.php';

// Inisialisasi variabel
$id_disposisi = $tanggal = $pengirim = $penerima = $judul = $isi = $file_upload = $status = "";
$error = "";

// Cek apakah parameter id_disposisi disertakan dalam URL
if (isset($_POST['id_disposisi']) && !empty(trim($_POST['id_disposisi']))) {
    // Mendapatkan nilai id_disposisi dari form
    $id_disposisi = $_POST['id_disposisi'];

    // Validasi input
    $input_error = false;
    if (empty(trim($_POST['tanggal'])) || empty(trim($_POST['pengirim'])) || empty(trim($_POST['penerima'])) || empty(trim($_POST['judul'])) || empty(trim($_POST['isi'])) || empty(trim($_POST['status']))) {
        $error = "Semua kolom harus diisi";
        $input_error = true;
    } else {
        // Ambil nilai dari form
        $tanggal = $_POST['tanggal'];
        $pengirim = $_POST['pengirim'];
        $penerima = $_POST['penerima'];
        $judul = $_POST['judul'];
        $isi = $_POST['isi'];
        $status = $_POST['status'];

        // Cek apakah ada file yang diupload
        if ($_FILES["file"]["name"] != '') {
            // Mendapatkan informasi file yang diupload
            $file_name = basename($_FILES["file"]["name"]);
            $file_temp = $_FILES["file"]["tmp_name"];
            $file_type = $_FILES["file"]["type"];

            // Direktori tujuan untuk menyimpan file
            $target_dir = "lib/disposisi/";

            // Membuat nama file baru dengan tambahan "ACC"
            $new_file_name = $pengirim . "_" . $id_disposisi . "_ACC." . pathinfo($file_name, PATHINFO_EXTENSION);
            $target_file = $target_dir . $new_file_name;

            // Hapus file sebelumnya jika ada
            if (!empty($_POST['file_upload'])) {
                // Menggunakan prepared statement untuk menghapus file
                $query_delete = "UPDATE disposisi SET file_upload = NULL WHERE id_disposisi = ?";
                $stmt_delete = $koneksi->prepare($query_delete);
                $stmt_delete->bind_param("i", $id_disposisi);
                $stmt_delete->execute();

                // Periksa apakah file dihapus
                if ($stmt_delete->affected_rows > 0) {
                    // Hapus file fisik dari sistem
                    unlink("lib/disposisi/" . $_POST['file_upload']);
                }
            }

            // Pindahkan file yang diupload ke folder tujuan
            if (move_uploaded_file($file_temp, $target_file)) {
                // Persiapkan statement SQL untuk mengupdate informasi barang dalam database, termasuk foto baru
                $query = "UPDATE disposisi SET tanggal=?, pengirim=?, penerima=?, judul=?, isi=?, file_upload=?, status=? WHERE id_disposisi=?";
                $stmt = $koneksi->prepare($query);
                $stmt->bind_param("sssssssi", $tanggal, $pengirim, $penerima, $judul, $isi, $new_file_name, $status, $id_disposisi);
                if ($stmt->execute()) {
                    // Redirect ke halaman disposisi setelah berhasil update
                    header("location: disposisi.php");
                    exit();
                } else {
                    $error = "Oops! Terjadi kesalahan. Silakan coba lagi nanti.";
                }
            } else {
                $error = "Terjadi kesalahan saat mengupload file.";
            }
        } else {
            // Update data ke database tanpa mengubah file_upload
            $query = "UPDATE disposisi SET tanggal=?, pengirim=?, penerima=?, judul=?, isi=?, status=? WHERE id_disposisi=?";
            $stmt = $koneksi->prepare($query);
            $stmt->bind_param("ssssssi", $tanggal, $pengirim, $penerima, $judul, $isi, $status, $id_disposisi);
            if ($stmt->execute()) {
                // Redirect ke halaman disposisi setelah berhasil update
                header("location: disposisi.php");
                exit();
            } else {
                $error = "Oops! Terjadi kesalahan. Silakan coba lagi nanti.";
            }
        }
    }
} else {
    $error = "ID disposisi tidak valid";
}

// Tampilkan pesan error jika ada
if (!empty($error)) {
    echo $error;
}
