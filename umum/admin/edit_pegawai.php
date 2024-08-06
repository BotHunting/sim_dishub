<?php
session_start();
require_once 'koneksi.php';
$error = '';
$id = $_GET['id'] ?? '';
$query = "SELECT * FROM pegawai WHERE id = ?";
$stmt = $koneksi->prepare($query);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    echo "Data pegawai tidak ditemukan.";
    exit;
}
$row = $result->fetch_assoc();
$query_jabatan = "SELECT DISTINCT nama_jabatan FROM jabatan";
$stmt_jabatan = $koneksi->prepare($query_jabatan);
$stmt_jabatan->execute();
$result_jabatan = $stmt_jabatan->get_result();
$jabatan_options = [];
if ($result_jabatan && $result_jabatan->num_rows > 0) {
    while ($row_jabatan = $result_jabatan->fetch_assoc()) {
        $jabatan_options[] = $row_jabatan['nama_jabatan'];
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $pangkat = $_POST['pangkat'];
    $nip = $_POST['nip'];
    $jabatan = $_POST['jabatan'];
    $seksi = $_POST['seksi'];
    $bidang = $_POST['bidang'];
    if (empty($nama) || empty($pangkat) || empty($nip) || empty($jabatan) || empty($seksi) || empty($bidang)) {
        $error = "Semua kolom harus diisi";
    } else {
        $query_update = "UPDATE pegawai SET nama=?, pangkat=?, nip=?, jabatan=?, seksi=?, bidang=? WHERE id=?";
        $stmt_update = $koneksi->prepare($query_update);
        $stmt_update->bind_param('ssssssi', $nama, $pangkat, $nip, $jabatan, $seksi, $bidang, $id);
        if ($stmt_update->execute()) {
            header("Location: pegawai.php");
            exit;
        } else {
            $error = "Error: " . $koneksi->error;
        }
    }
}
?>

<?php include_once 'header.php'; ?>
<div class="container mt-5">
    <h1>Edit Pegawai</h1>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo htmlspecialchars($row['nama']); ?>" required>
        </div>
        <div class="form-group">
            <label for="pangkat">Pangkat:</label>
            <input type="text" class="form-control" id="pangkat" name="pangkat" value="<?php echo htmlspecialchars($row['pangkat']); ?>" required>
        </div>
        <div class="form-group">
            <label for="nip">NIP:</label>
            <input type="text" class="form-control" id="nip" name="nip" value="<?php echo htmlspecialchars($row['nip']); ?>" required oninput="this.value = this.value.replace(/[^0-9]/g, '');">
        </div>
        <div class="form-group">
            <label for="jabatan">Jabatan:</label>
            <select class="form-control" id="jabatan" name="jabatan" required>
                <option value="">Pilih Jabatan</option>
                <?php foreach ($jabatan_options as $jabatan_option) : ?>
                    <option value="<?php echo htmlspecialchars($jabatan_option); ?>" <?php if ($jabatan_option == $row['jabatan']) echo 'selected'; ?>><?php echo htmlspecialchars($jabatan_option); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="seksi">Seksi:</label>
            <input type="text" class="form-control" id="seksi" name="seksi" value="<?php echo htmlspecialchars($row['seksi']); ?>" required>
        </div>
        <div class="form-group">
            <label for="bidang">Bidang:</label>
            <input type="text" class="form-control" id="bidang" name="bidang" value="<?php echo htmlspecialchars($row['bidang']); ?>" required>
        </div>
        <?php if ($error) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="javascript:history.go(-1);" class="btn btn-secondary">Kembali</a>
    </form>
</div>
<script>
    document.getElementById('jabatan').addEventListener('change', function() {
        var jabatan = this.value;
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var bidangInput = document.getElementById('bidang');
                    bidangInput.value = xhr.responseText;
                }
            }
        };
        xhr.open('GET', 'get_bidang.php?jabatan=' + encodeURIComponent(jabatan), true);
        xhr.send();
    });
    document.getElementById('jabatan').addEventListener('change', function() {
        var jabatan = this.value;
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var bidangInput = document.getElementById('seksi');
                    bidangInput.value = xhr.responseText;
                }
            }
        };
        xhr.open('GET', 'get_seksi.php?jabatan=' + encodeURIComponent(jabatan), true);
        xhr.send();
    });
</script>
<div style="height: 100px;"></div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>