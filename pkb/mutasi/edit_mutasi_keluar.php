<?php
include("header.php"); // Mengimpor header yang sudah termasuk koneksi database

// Cek jika pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

// Validasi ID dari URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID tidak valid.");
}
$id = (int)$_GET['id'];

// Proses untuk menyimpan data setelah diubah
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Ambil data dari form dan ubah ke kapital (kecuali link)
    $nomor_kendaraan = strtoupper(trim($_POST['nomor_kendaraan']));
    $nomor_uji = strtoupper(trim($_POST['nomor_uji']));
    $nama_pemilik = strtoupper(trim($_POST['nama_pemilik']));
    $tujuan = strtoupper(trim($_POST['tujuan']));
    $nomor_surat = strtoupper(trim($_POST['nomor_surat']));
    $link_file_gdrive = trim($_POST['link_file_gdrive']);

    // Query untuk mengupdate data ke tabel mutasi_keluar
    $sql_update = "UPDATE mutasi_keluar SET nomor_kendaraan = ?, nomor_uji = ?, nama_pemilik = ?, tujuan = ?, nomor_surat = ?, link_file_gdrive = ? WHERE id = ?";

    if ($stmt = $koneksi->prepare($sql_update)) {
        $stmt->bind_param("ssssssi", $nomor_kendaraan, $nomor_uji, $nama_pemilik, $tujuan, $nomor_surat, $link_file_gdrive, $id);
        if ($stmt->execute()) {
            echo "<script>alert('Data berhasil diperbarui!'); window.location.href = 'dashboard.php#keluar-tab-pane';</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan: " . $stmt->error . "');</script>";
        }
        $stmt->close();
    }
}

// Mengambil data mutasi keluar berdasarkan ID
$sql_select = "SELECT * FROM mutasi_keluar WHERE id = ?";
if ($stmt_select = $koneksi->prepare($sql_select)) {
    $stmt_select->bind_param("i", $id);
    $stmt_select->execute();
    $result = $stmt_select->get_result();
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
    } else {
        echo "<script>alert('Data tidak ditemukan!'); window.location.href = 'dashboard.php';</script>";
        exit();
    }
    $stmt_select->close();
}

$koneksi->close();
?>

<head>
    <title>Edit Mutasi Keluar - UPT PKB Gresik</title>
    <!-- JavaScript untuk membuat input otomatis menjadi huruf kapital -->
    <script>
        function toUpperCaseInput(event) {
            event.target.value = event.target.value.toUpperCase();
        }
    </script>
</head>

<main class="main">
    <div class="container mt-5">
        <h2>Edit Mutasi Keluar</h2>
        <form action="edit_mutasi_keluar.php?id=<?php echo $id; ?>" method="POST">
            <div class="mb-3">
                <label for="nomor_kendaraan" class="form-label">Nomor Kendaraan</label>
                <input type="text" class="form-control" id="nomor_kendaraan" name="nomor_kendaraan" value="<?php echo htmlspecialchars($row['nomor_kendaraan']); ?>" required oninput="toUpperCaseInput(event)">
            </div>
            <div class="mb-3">
                <label for="nomor_uji" class="form-label">Nomor Uji</label>
                <input type="text" class="form-control" id="nomor_uji" name="nomor_uji" value="<?php echo htmlspecialchars($row['nomor_uji']); ?>" required oninput="toUpperCaseInput(event)">
            </div>
            <div class="mb-3">
                <label for="nama_pemilik" class="form-label">Nama Pemilik</label>
                <input type="text" class="form-control" id="nama_pemilik" name="nama_pemilik" value="<?php echo htmlspecialchars($row['nama_pemilik']); ?>" required oninput="toUpperCaseInput(event)">
            </div>
            <div class="mb-3">
                <label for="tujuan" class="form-label">Tujuan</label>
                <input type="text" class="form-control" id="tujuan" name="tujuan" value="<?php echo htmlspecialchars($row['tujuan']); ?>" required oninput="toUpperCaseInput(event)">
            </div>
            <div class="mb-3">
                <label for="nomor_surat" class="form-label">Nomor Surat</label>
                <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" value="<?php echo htmlspecialchars($row['nomor_surat']); ?>" required oninput="toUpperCaseInput(event)">
            </div>
            <div class="mb-3">
                <label for="link_file_gdrive" class="form-label">Link File Google Drive</label>
                <input type="url" class="form-control" id="link_file_gdrive" name="link_file_gdrive" value="<?php echo htmlspecialchars($row['link_file_gdrive']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Simpan Perubahan</button>
            <a href="dashboard.php#keluar-tab-pane" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</main>
<?php include("footer.php"); ?>