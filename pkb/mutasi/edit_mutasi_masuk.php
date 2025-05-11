<?php
session_start(); // Memulai sesi untuk menyimpan data login
include("../config.php"); // Mengimpor koneksi database

// Cek jika pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Jika belum login, redirect ke halaman login
    header("Location: ../login.php");
    exit();
}

// Mengambil data mutasi masuk berdasarkan ID yang dikirim melalui URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM mutasi_masuk WHERE id = '$id'";
    $result = $koneksi->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<script>alert('Data tidak ditemukan!'); window.location.href = 'mutasi_masuk.php';</script>";
        exit();
    }
}

// Proses untuk menyimpan data setelah diubah
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Ambil data dari form dan ubah ke kapital (kecuali link)
    $nomor_kendaraan = strtoupper($_POST['nomor_kendaraan']);
    $nomor_uji = strtoupper($_POST['nomor_uji']);
    $nama_pemilik = strtoupper($_POST['nama_pemilik']);
    $tujuan = strtoupper($_POST['tujuan']);
    $nomor_surat = strtoupper($_POST['nomor_surat']);
    $link_file_gdrive = $_POST['link_file_gdrive'];  // Link tetap dalam format asli

    // Query untuk mengupdate data ke tabel mutasi_masuk
    $sql_update = "UPDATE mutasi_masuk 
                   SET nomor_kendaraan = '$nomor_kendaraan', 
                       nomor_uji = '$nomor_uji', 
                       nama_pemilik = '$nama_pemilik', 
                       tujuan = '$tujuan', 
                       nomor_surat = '$nomor_surat', 
                       link_file_gdrive = '$link_file_gdrive'
                   WHERE id = '$id'";

    if ($koneksi->query($sql_update) === TRUE) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location.href = 'mutasi_masuk.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan: " . $koneksi->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mutasi Masuk - UPT PKB Gresik</title>
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/css/main.css" rel="stylesheet">

    <!-- JavaScript untuk membuat input otomatis menjadi huruf kapital -->
    <script>
        function toUpperCaseInput(event) {
            event.target.value = event.target.value.toUpperCase();
        }
    </script>
</head>

<body>
    <?php include("header.php"); ?>

    <main class="main">
        <div class="container mt-5">
            <h2>Edit Mutasi Masuk</h2>
            <form action="edit_mutasi_masuk.php?id=<?php echo $id; ?>" method="POST">
                <div class="mb-3">
                    <label for="nomor_kendaraan" class="form-label">Nomor Kendaraan</label>
                    <input type="text" class="form-control" id="nomor_kendaraan" name="nomor_kendaraan" value="<?php echo $row['nomor_kendaraan']; ?>" required oninput="toUpperCaseInput(event)">
                </div>
                <div class="mb-3">
                    <label for="nomor_uji" class="form-label">Nomor Uji</label>
                    <input type="text" class="form-control" id="nomor_uji" name="nomor_uji" value="<?php echo $row['nomor_uji']; ?>" required oninput="toUpperCaseInput(event)">
                </div>
                <div class="mb-3">
                    <label for="nama_pemilik" class="form-label">Nama Pemilik</label>
                    <input type="text" class="form-control" id="nama_pemilik" name="nama_pemilik" value="<?php echo $row['nama_pemilik']; ?>" required oninput="toUpperCaseInput(event)">
                </div>
                <div class="mb-3">
                    <label for="tujuan" class="form-label">Asal</label>
                    <input type="text" class="form-control" id="tujuan" name="tujuan" value="<?php echo $row['tujuan']; ?>" required oninput="toUpperCaseInput(event)">
                </div>
                <div class="mb-3">
                    <label for="nomor_surat" class="form-label">Nomor Surat</label>
                    <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" value="<?php echo $row['nomor_surat']; ?>" required oninput="toUpperCaseInput(event)">
                </div>
                <div class="mb-3">
                    <label for="link_file_gdrive" class="form-label">Link File Google Drive</label>
                    <input type="url" class="form-control" id="link_file_gdrive" name="link_file_gdrive" value="<?php echo $row['link_file_gdrive']; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Simpan Perubahan</button>
                <a href="mutasi_masuk.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </main>

    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
