<?php
session_start();
require_once '../../config.php';

$error = '';
$success_message = '';

// Periksa apakah ID jabatan telah diterima melalui parameter
if (!isset($_GET['id'])) {
    header("Location: jabatan.php");
    exit;
}

$id = $_GET['id'];

// Query untuk mengambil data jabatan berdasarkan ID
$query = "SELECT * FROM jabatan WHERE id = ?";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// Ambil data bidang dari tabel bidang
$query_bidang = "SELECT * FROM bidang";
$result_bidang = $koneksi->query($query_bidang);
$bidang_options = [];
if ($result_bidang && $result_bidang->num_rows > 0) {
    while ($row_bidang = $result_bidang->fetch_assoc()) {
        $bidang_options[$row_bidang['nama_bidang']] = $row_bidang['nama_bidang'];
    }
}

// Ambil data seksi dari tabel seksi
$query_seksi = "SELECT DISTINCT nama_seksi FROM seksi";
$result_seksi = $koneksi->query($query_seksi);
$seksi_options = [];
if ($result_seksi && $result_seksi->num_rows > 0) {
    while ($row_seksi = $result_seksi->fetch_assoc()) {
        $seksi_options[$row_seksi['nama_seksi']] = $row_seksi['nama_seksi'];
    }
}

// Periksa apakah query berhasil dijalankan dan data ditemukan
if ($result->num_rows > 0) {
    $jabatan = $result->fetch_assoc();
} else {
    header("Location: jabatan.php");
    exit;
}

// Jika tombol "Simpan Perubahan" ditekan
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['simpan_perubahan'])) {
    // Ambil data yang dikirimkan melalui form
    $nama_jabatan = $_POST['nama_jabatan'];
    $seksi = $_POST['seksi'];
    $bidang = $_POST['bidang'];

    if (empty($nama_jabatan)) {
        $error = "Nama jabatan harus diisi";
    } else {
        // Periksa apakah terdapat perubahan pada data
        if ($jabatan['nama_jabatan'] !== $nama_jabatan || $jabatan['seksi'] !== $seksi || $jabatan['bidang'] !== $bidang) {
            $query_update = "UPDATE jabatan SET nama_jabatan = ?, seksi = ?, bidang = ? WHERE id = ?";
            $stmt_update = $koneksi->prepare($query_update);
            $stmt_update->bind_param("sssi", $nama_jabatan, $seksi, $bidang, $id);

            // Jalankan query update
            if ($stmt_update->execute()) {
                $success_message = "Data jabatan berhasil diperbarui.";
                $jabatan['nama_jabatan'] = $nama_jabatan; // Perbarui nama jabatan di variabel $jabatan
                $jabatan['seksi'] = $seksi; // Perbarui seksi di variabel $jabatan
                $jabatan['bidang'] = $bidang; // Perbarui bidang di variabel $jabatan
            } else {
                $error = "Error: " . $koneksi->error;
            }
            $stmt_update->close();
        } else {
            $success_message = "Tidak ada perubahan yang disimpan.";
        }
    }
}

// Jika tombol "Simpan Link Google Drive" ditekan
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['simpan_link'])) {
    // Ambil link Google Drive yang dikirimkan melalui form
    $link_google_drive = $_POST['link_google_drive'];

    // Update data pada kolom 'anjab' dalam tabel SQL
    $query_update_link = "UPDATE jabatan SET anjab = ? WHERE id = ?";
    $stmt_update_link = $koneksi->prepare($query_update_link);
    $stmt_update_link->bind_param("si", $link_google_drive, $id);
    if ($stmt_update_link->execute()) {
        $success_message = "Link Google Drive berhasil disimpan.";
        $jabatan['anjab'] = $link_google_drive; // Perbarui link Google Drive di variabel $jabatan
    } else {
        $error = "Error: " . $koneksi->error;
    }
    $stmt_update_link->close();
}
?>

<?php include_once 'header.php'; ?>
<div class="container mt-5">
    <h1>Edit Jabatan</h1>
    <form action="" method="post">
        <div class="form-group">
            <label for="nama_jabatan">Nama Jabatan:</label>
            <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan" value="<?php echo htmlspecialchars($jabatan['nama_jabatan']); ?>" required>
        </div>
        <div class="form-group">
            <label for="seksi">Seksi:</label>
            <select class="form-control" id="seksi" name="seksi" required>
                <option value="">Pilih Seksi</option>
                <?php foreach ($seksi_options as $nama_seksi) : ?>
                    <option value="<?php echo $nama_seksi; ?>" <?php echo ($nama_seksi == $jabatan['seksi']) ? 'selected' : ''; ?>><?php echo $nama_seksi; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="bidang">Bidang:</label>
            <select class="form-control" id="bidang" name="bidang" required>
                <option value="">Pilih Bidang</option>
                <?php foreach ($bidang_options as $nama_bidang) : ?>
                    <option value="<?php echo $nama_bidang; ?>" <?php echo ($nama_bidang == $jabatan['bidang']) ? 'selected' : ''; ?>><?php echo $nama_bidang; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <?php if ($error) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        <?php if ($success_message) : ?>
            <div class="alert alert-success" role="alert">
                <?php echo $success_message; ?>
            </div>
        <?php endif; ?>
        <button type="submit" name="simpan_perubahan" class="btn btn-primary">Simpan Perubahan</button>
        <a href="jabatan.php" class="btn btn-secondary">Kembali</a>
    </form>
    <div class="mt-3">
        <?php if (!empty($jabatan['anjab'])) : ?>
            <a href="<?php echo $jabatan['anjab']; ?>" target="_blank" class="btn btn-info">Lihat File Sebelumnya</a>
        <?php endif; ?>
    </div>
    <div class="mt-3">
        <form action="" method="post">
            <div class="form-group">
                <label for="link_google_drive">Link Google Drive:</label>
                <input type="text" class="form-control" id="link_google_drive" name="link_google_drive" value="<?php echo htmlspecialchars($jabatan['anjab']); ?>" required>
            </div>
            <button type="submit" name="simpan_link" class="btn btn-success">Simpan Link Google Drive</button>
        </form>
    </div>
</div>
<div style="height: 100px;"></div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>