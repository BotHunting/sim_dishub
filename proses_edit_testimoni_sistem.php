<?php
include_once 'config.php';

// Pastikan semua field yang diperlukan telah diisi
if (isset($_POST['id'], $_POST['nama'], $_POST['jabatan'], $_POST['keterangan'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $keterangan = $_POST['keterangan'];

    // Periksa apakah pengguna mengunggah file baru
    if ($_FILES['foto']['name'] != '') {
        // Ambil informasi file yang diunggah
        $file_name = $_FILES['foto']['name'];
        $file_size = $_FILES['foto']['size'];
        $file_tmp = $_FILES['foto']['tmp_name'];
        $file_type = $_FILES['foto']['type'];
        $file_error = $_FILES['foto']['error'];

        // Periksa tipe file yang diunggah
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_ext = array('jpg', 'jpeg', 'png');

        if (in_array($file_ext, $allowed_ext)) {
            // Tentukan lokasi penyimpanan file
            $file_destination = 'assets/img/testimonials/' . $file_name;

            // Pindahkan file yang diunggah ke lokasi tujuan
            if (move_uploaded_file($file_tmp, $file_destination)) {
                // Update data testimoni dengan foto baru
                $sql = "UPDATE testimoni_sistem SET nama='$nama', jabatan='$jabatan', keterangan='$keterangan', foto='$file_name' WHERE id='$id'";
                if ($koneksi->query($sql) === TRUE) {
                    echo "Testimoni berhasil diperbarui.";
                } else {
                    echo "Error: " . $sql . "<br>" . $koneksi->error;
                }
            } else {
                echo "Gagal mengunggah foto.";
            }
        } else {
            echo "Ekstensi file tidak didukung. Harap unggah file dengan ekstensi JPG, JPEG, atau PNG.";
        }
    } else {
        // Update data testimoni tanpa mengubah foto
        $sql = "UPDATE testimoni_sistem SET nama='$nama', jabatan='$jabatan', keterangan='$keterangan' WHERE id='$id'";
        // Eksekusi query SQL
        if ($koneksi->query($sql) === TRUE) {
            // Jika data berhasil disimpan, redirect ke halaman sebelumnya
            header("Location: testi_sistem.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $koneksi->error;
        }
    }

    // Tutup koneksi database
    $koneksi->close();
} else {
    echo "Semua field harus diisi.";
}
