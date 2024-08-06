<?php
include_once 'koneksi.php';
$id = $nomor_surat = $tanggal = $pengirim = $penerima = $subjek = $isi = $status = $file_upload = "";
$error = "";
if (isset($_POST['id']) && !empty(trim($_POST['id']))) {
    $id = trim($_POST['id']);
    $query = "SELECT * FROM suratmenyurat WHERE id = ?";
    if ($stmt = $koneksi->prepare($query)) {
        $stmt->bind_param("i", $param_id);
        $param_id = $id;
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $file_upload = $row['file_upload'];
            } else {
                header("location: error.php");
                exit();
            }
        } else {
            echo "Oops! Terjadi kesalahan. Silakan coba lagi nanti.";
            exit();
        }
        $stmt->close();
    }

    // Upload file jika ada yang diunggah
    if (isset($_FILES["file_upload"]) && !empty($_FILES["file_upload"]["name"])) {
        if (!empty($file_upload) && file_exists("lib/surat/" . $file_upload)) {
            unlink("lib/surat/" . $file_upload);
        }
        $targetDir = "lib/surat/";
        $fileName = basename($_FILES["file_upload"]["name"]);
        $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
        $fileName = str_replace("." . $fileExt, "", $fileName) . "_ACC." . $fileExt;
        $targetFilePath = $targetDir . $fileName;
        $allowedExtensions = array("pdf");
        if (!in_array(strtolower($fileExt), $allowedExtensions)) {
            $error = "Hanya file PDF yang diizinkan.";
        } elseif ($_FILES["file_upload"]["size"] > 5000000) { // 5MB
            $error = "File terlalu besar. Maksimum 5MB.";
        } elseif (!move_uploaded_file($_FILES["file_upload"]["tmp_name"], $targetFilePath)) {
            $error = "Terjadi kesalahan saat mengupload file.";
        } else {
            // Update nama file_upload dalam tabel dengan nama baru
            $query = "UPDATE suratmenyurat SET file_upload=? WHERE id=?";
            if ($stmt = $koneksi->prepare($query)) {
                $stmt->bind_param("si", $param_file_upload, $param_id);
                $param_file_upload = $fileName;
                if (!$stmt->execute()) {
                    $error = "Terjadi kesalahan saat menyimpan file baru: " . $stmt->error;
                }
            }
            $stmt->close();
        }
    }

    // Ambil nilai dari form
    $nomor_surat = $_POST['nomor_surat'];
    $tanggal = $_POST['tanggal'];
    $pengirim = $_POST['pengirim'];
    $penerima = $_POST['penerima'];
    $subjek = $_POST['subjek'];
    $isi = $_POST['isi'];
    $status = $_POST['status'];

    // Query untuk update data suratmenyurat ke dalam tabel
    $query = "UPDATE suratmenyurat SET nomor_surat=?, tanggal=?, pengirim=?, penerima=?, subjek=?, isi=?, status=? WHERE id=?";
    if ($stmt = $koneksi->prepare($query)) {
        $stmt->bind_param("sssssssi", $nomor_surat, $tanggal, $pengirim, $penerima, $subjek, $isi, $status, $id);
        if (!$stmt->execute()) {
            $error = "Terjadi kesalahan saat menyimpan data: " . $stmt->error;
        }
        $stmt->close();
    }

    // Redirect ke halaman surat_menyurat.php
    header("location: surat_menyurat.php");
    exit();
} else {
    header("location: error.php");
    exit();
}
