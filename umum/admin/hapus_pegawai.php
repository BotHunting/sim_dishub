<?php
session_start();
require_once 'koneksi.php';

// Periksa apakah parameter id pegawai telah diterima melalui URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mengambil data pegawai berdasarkan ID
    $query = "SELECT * FROM pegawai WHERE id = ?";

    // Persiapkan statement
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param('i', $id);

    // Jalankan query
    $stmt->execute();

    // Ambil hasil query
    $result = $stmt->get_result();

    // Periksa apakah data ditemukan
    if ($result->num_rows > 0) {
        $pegawai = $result->fetch_assoc();
    } else {
        // Redirect ke halaman daftar pegawai jika data tidak ditemukan
        header("Location: daftar_pegawai.php");
        exit;
    }
} else {
    // Redirect ke halaman daftar pegawai jika parameter tidak tersedia
    header("Location: daftar_pegawai.php");
    exit;
}

// Jika tombol "Lanjutkan" ditekan
if (isset($_POST['lanjutkan'])) {
    // Query untuk menghapus pegawai dari database
    $query_delete = "DELETE FROM pegawai WHERE id = ?";

    // Persiapkan statement
    $stmt = $koneksi->prepare($query_delete);
    $stmt->bind_param('i', $id);

    // Jalankan query
    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Pegawai berhasil dihapus.";
    } else {
        $_SESSION['error_message'] = "Gagal menghapus pegawai.";
    }

    // Redirect ke halaman daftar pegawai setelah menghapus
    header("Location: pegawai.php");
    exit;
}
?>

<div class="container mt-5">
    <h1>Hapus Pegawai</h1>
    <p>Apakah Anda yakin ingin menghapus pegawai <?php echo $pegawai['nama']; ?>?</p>
    <form action="" method="post">
        <button type="submit" name="lanjutkan" class="btn btn-danger">Lanjutkan</button>
        <a href="daftar_pegawai.php" class="btn btn-secondary">Batalkan</a>
    </form>
</div>
</body>

</html>