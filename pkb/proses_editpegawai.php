<?php
// Sertakan file konfigurasi utama dan mulai sesi
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../assets/config.php';

// Cek apakah pengguna login dan form disubmit
if (!isset($_SESSION['username'])) {
    die("Akses ditolak. Silakan login terlebih dahulu.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    // Ambil dan sanitasi data dari form
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
    $jabatan = filter_input(INPUT_POST, 'jabatan', FILTER_SANITIZE_STRING);
    $deskripsi = filter_input(INPUT_POST, 'deskripsi', FILTER_SANITIZE_STRING);
    $twitter = filter_input(INPUT_POST, 'twitter', FILTER_SANITIZE_URL);
    $facebook = filter_input(INPUT_POST, 'facebook', FILTER_SANITIZE_URL);
    $instagram = filter_input(INPUT_POST, 'instagram', FILTER_SANITIZE_URL);
    $linkedin = filter_input(INPUT_POST, 'linkedin', FILTER_SANITIZE_URL);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = $_POST["password"]; // Tidak difilter karena akan di-hash

    if (!$id) {
        die("ID Pegawai tidak valid.");
    }

    // Inisialisasi query dan parameter
    $params = [];
    $types = "";

    // Data dasar yang selalu diupdate
    $sql = "UPDATE pegawai_pkb SET nama = ?, jabatan = ?, deskripsi = ?, twitter = ?, facebook = ?, instagram = ?, linkedin = ?, username = ?";
    array_push($params, $nama, $jabatan, $deskripsi, $twitter, $facebook, $instagram, $linkedin, $username);
    $types .= "ssssssss";

    // Proses upload foto jika ada file baru
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $target_dir = __DIR__ . "/assets/img/trainers/";
        $file_info = pathinfo($_FILES["foto"]["name"]);
        $file_extension = strtolower($file_info['extension']);
        $new_filename = uniqid('pegawai_', true) . '.' . $file_extension;
        $target_file = $target_dir . $new_filename;

        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
            $sql .= ", foto = ?";
            $params[] = $new_filename;
            $types .= "s";
        }
    }

    // Enkripsi dan update password jika diubah
    if (!empty($password)) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $sql .= ", password = ?";
        $params[] = $password_hash;
        $types .= "s";
    }

    // Tambahkan klausa WHERE
    $sql .= " WHERE id = ?";
    $params[] = $id;
    $types .= "i";

    // Eksekusi prepared statement
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param($types, ...$params);

    if ($stmt->execute()) {
        header("Location: trainers.php?status=updated");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $koneksi->close();
}
?>
