<?php
session_start();
require_once 'koneksi.php';
$error = '';

$query_seksi = "SELECT DISTINCT nama_seksi FROM seksi";
$result_seksi = $koneksi->query($query_seksi);
$seksi_options = [];
if ($result_seksi && $result_seksi->num_rows > 0) {
    while ($row_seksi = $result_seksi->fetch_assoc()) {
        $seksi_options[$row_seksi['nama_seksi']] = $row_seksi['nama_seksi'];
    }
}

// Ambil data bidang dari tabel bidang
$query_bidang = "SELECT * FROM bidang";
$result_bidang = $koneksi->query($query_bidang);
$bidang_options = [];
if ($result_bidang && $result_bidang->num_rows > 0) {
    while ($row_bidang = $result_bidang->fetch_assoc()) {
        $bidang_options[$row_bidang['nama_bidang']] = $row_bidang['nama_bidang'];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $seksi = $_POST['seksi'];
    $nama_jabatan = $_POST['nama_jabatan'];
    $bidang = $_POST['bidang']; // Ambil bidang dari form
    $link_google_drive = $_POST['link_google_drive']; // Ambil link Google Drive dari form
    if (empty($seksi) || empty($nama_jabatan) || empty($bidang) || empty($link_google_drive)) {
        $error = "Seksi, nama jabatan, bidang, dan link Google Drive harus diisi";
    } else {
        $query_insert = "INSERT INTO jabatan (bidang, seksi, nama_jabatan, anjab) VALUES (?, ?, ?, ?)";
        $stmt_insert = $koneksi->prepare($query_insert);
        $stmt_insert->bind_param('ssss', $bidang, $seksi, $nama_jabatan, $link_google_drive);
        if ($stmt_insert->execute()) {
            header("Location: jabatan.php");
            exit;
        } else {
            $error = "Error: " . $koneksi->error;
        }
    }
}
?>

<?php include_once 'header.php'; ?>
<div class="container mt-5">
    <h1>Tambah Jabatan</h1>
    <form action="" method="post">
        <div class="form-group">
            <label for="seksi">Seksi:</label>
            <select class="form-control" id="seksi" name="seksi" required>
                <option value="">Pilih Seksi</option>
                <?php foreach ($seksi_options as $nama_seksi) : ?>
                    <option value="<?php echo $nama_seksi; ?>"><?php echo $nama_seksi; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="bidang">Bidang:</label>
            <select class="form-control" id="bidang" name="bidang" required>
                <option value="">Pilih Bidang</option>
                <?php foreach ($bidang_options as $nama_bidang) : ?>
                    <option value="<?php echo $nama_bidang; ?>"><?php echo $nama_bidang; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="nama_jabatan">Nama Jabatan:</label>
            <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan" required>
        </div>
        <div class="form-group">
            <label for="link_google_drive">Link Google Drive:</label>
            <input type="text" class="form-control" id="link_google_drive" name="link_google_drive" required>
        </div>
        <?php if ($error) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        <button type="submit" class="btn btn-primary">Tambah Jabatan</button>
        <a href="javascript:history.go(-1);" class="btn btn-secondary">Kembali</a>
    </form>
</div>
<div style="height: 100px;"></div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
