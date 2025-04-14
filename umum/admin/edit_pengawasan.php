<?php
session_start();
require_once '../../config.php'; // Update to use config.php
$id = $nomor_surat = $jenis_pengawasan = $tanggal = $deskripsi = $status = $file_google_drive = '';
$error = '';
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    // Menggunakan prepared statement untuk menghindari SQL Injection
    $query = "SELECT * FROM pengawasan WHERE id = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $nomor_surat = $row['nomor_surat'];
        $jenis_pengawasan = $row['jenis_pengawasan'];
        $tanggal = $row['tanggal'];
        $deskripsi = $row['deskripsi'];
        $status = $row['status'];
        $file_google_drive = $row['file_google_drive'];  // Mengambil link Google Drive
    } else {
        header("Location: pengawasan.php");
        exit();
    }
} else {
    header("Location: pengawasan.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Menggunakan prepared statement untuk menghindari SQL Injection
    $nomor_surat = $_POST['nomor_surat'];
    $jenis_pengawasan = $_POST['jenis_pengawasan'];
    $tanggal = $_POST['tanggal'];
    $deskripsi = $_POST['deskripsi'];
    $status = $_POST['status'];

    // Jika link Google Drive baru diinputkan, update link
    if (!empty($_POST['file_google_drive'])) {
        $file_google_drive = $_POST['file_google_drive'];
    }

    // Validasi jika kolom wajib kosong
    if (empty($nomor_surat) || empty($jenis_pengawasan) || empty($tanggal) || empty($deskripsi) || empty($status)) {
        $error = "Semua kolom harus diisi";
    } else {
        // Menggunakan prepared statement untuk menghindari SQL Injection
        $query = "UPDATE pengawasan SET nomor_surat = ?, jenis_pengawasan = ?, tanggal = ?, deskripsi = ?, status = ?, file_google_drive = ? WHERE id = ?";
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param('ssssssi', $nomor_surat, $jenis_pengawasan, $tanggal, $deskripsi, $status, $file_google_drive, $id);
        if ($stmt->execute()) {
            header("Location: pengawasan.php");
            exit;
        } else {
            $error = "Error: " . $query . "<br>" . $koneksi->error;
        }
    }
}
?>

<?php include("header.php"); ?>
<div class="container mt-5">
    <h2>Edit Surat Perintah</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $id; ?>">
        <div class="form-group">
            <label for="nomor_surat" class="form-label">Nomor Surat</label>
            <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" value="<?php echo $nomor_surat; ?>">
        </div>
        <div class="form-group">
            <label>Jenis SPT:</label>
            <input type="text" name="jenis_pengawasan" class="form-control" value="<?php echo $jenis_pengawasan; ?>">
        </div>
        <div class="form-group">
            <label>Tanggal:</label>
            <input type="date" name="tanggal" class="form-control" value="<?php echo $tanggal; ?>">
        </div>
        <div class="form-group">
            <label>Deskripsi:</label>
            <textarea name="deskripsi" class="form-control"><?php echo $deskripsi; ?></textarea>
        </div>
        <div class="form-group">
            <label>Status:</label>
            <select name="status" class="form-control">
                <option value="Pending" <?php if ($status == 'Pending') echo 'selected'; ?>>Pending</option>
                <option value="Approved" <?php if ($status == 'Approved') echo 'selected'; ?>>Approved</option>
                <option value="Rejected" <?php if ($status == 'Rejected') echo 'selected'; ?>>Rejected</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Link Google Drive Sebelumnya:</label>
            <?php if (!empty($file_google_drive)) : ?>
                <a href="<?php echo $file_google_drive; ?>" class="btn btn-info" target="_blank">Lihat File</a>
            <?php else : ?>
                <span class="text-muted">Tidak ada link file sebelumnya</span>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label>Masukkan Link Google Drive Baru (jika ingin diperbarui):</label>
            <input type="text" class="form-control" name="file_google_drive" value="<?php echo $file_google_drive; ?>" placeholder="Masukkan link Google Drive">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="javascript:history.go(-1);" class="btn btn-secondary">Kembali</a>
        <?php if (!empty($error)) : ?>
            <div class="alert alert-danger mt-3"><?php echo $error; ?></div>
        <?php endif; ?>
    </form>
</div>
<div style="height: 100px;"></div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
