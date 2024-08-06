<?php
session_start();
require_once 'koneksi.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) { // Periksa apakah id barang adalah numerik
    $id_barang = $_GET['id'];

    $query = "SELECT * FROM pengelolaan WHERE id = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("i", $id_barang);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $barang = $result->fetch_assoc();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nomor_inventaris = $_POST['nomor_inventaris'];
            $nama_barang = $_POST['nama_barang'];
            $jumlah = $_POST['jumlah'];
            $kondisi = $_POST['kondisi'];
            $tahun = $_POST['tahun']; // Tambahkan tahun

            if ($_FILES['foto']['name']) {
                // Proses upload foto
                $foto_name = $_FILES['foto']['name'];
                $foto_tmp_name = $_FILES['foto']['tmp_name'];
                $foto_size = $_FILES['foto']['size'];
                $foto_error = $_FILES['foto']['error'];
                $foto_ext = strtolower(pathinfo($foto_name, PATHINFO_EXTENSION));
                $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');

                if (in_array($foto_ext, $allowed_extensions)) {
                    $foto_destination = '../templates/pengelolaan/' . $nama_barang . '_' . uniqid() . '.' . $foto_ext;

                    if (move_uploaded_file($foto_tmp_name, $foto_destination)) {
                        // Hapus foto lama jika ada
                        if ($barang['foto']) {
                            unlink('../templates/pengelolaan/' . $barang['foto']);
                        }

                        // Update data barang dengan foto baru
                        $query = "UPDATE pengelolaan SET nomor_inventaris=?, nama_barang=?, jumlah=?, kondisi=?, foto=?, tahun=? WHERE id=?";
                        $stmt = $koneksi->prepare($query);
                        $stmt->bind_param("ssiissi", $nomor_inventaris, $nama_barang, $jumlah, $kondisi, $foto_destination, $tahun, $id_barang);
                    } else {
                        echo "Error uploading file.";
                        exit();
                    }
                } else {
                    echo "File harus berupa gambar (jpg, jpeg, png, gif).";
                    exit();
                }
            } else {
                // Update data barang tanpa foto baru
                $query = "UPDATE pengelolaan SET nomor_inventaris=?, nama_barang=?, jumlah=?, kondisi=?, tahun=? WHERE id=?";
                $stmt = $koneksi->prepare($query);
                $stmt->bind_param("ssiisi", $nomor_inventaris, $nama_barang, $jumlah, $kondisi, $tahun, $id_barang);
            }

            // Eksekusi query update
            if ($stmt->execute()) {
                header("Location: pengelolaan.php");
                exit();
            } else {
                echo "Error: " . $query . "<br>" . $koneksi->error;
                exit();
            }
        }
    } else {
        echo "Barang tidak ditemukan.";
        exit();
    }
} else {
    echo "ID barang tidak valid.";
    exit();
}
