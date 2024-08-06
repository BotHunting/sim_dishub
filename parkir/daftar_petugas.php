<?php
require_once('koneksi.php');
$nama = $jabatan = $nip = $jadwal_kerja = $telepon = '';
$nama_err = $jabatan_err = $nip_err = $jadwal_kerja_err = $telepon_err = '';
$success_message = '';
$parkir_options = '';
$sql_parkir = "SELECT * FROM parkir";
$result_parkir = $koneksi->query($sql_parkir);
if ($result_parkir->num_rows > 0) {
    while ($row_parkir = $result_parkir->fetch_assoc()) {
        $parkir_options .= '<option value="' . $row_parkir["lokasi"] . '">' . $row_parkir["lokasi"] . '</option>';
    }
}
// Proses saat formulir disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi nama
    if (empty(trim($_POST["nama"]))) {
        $nama_err = "Masukkan nama petugas.";
    } else {
        $nama = trim($_POST["nama"]);
    }
    // Validasi jabatan
    if (empty(trim($_POST["jabatan"]))) {
        $jabatan_err = "Masukkan jabatan petugas.";
    } else {
        $jabatan = trim($_POST["jabatan"]);
    }
    // Validasi NIP
    if (empty(trim($_POST["nip"]))) {
        $nip_err = "Masukkan NIP petugas.";
    } else {
        $nip = trim($_POST["nip"]);
    }
    // Validasi jadwal kerja
    if (empty(trim($_POST["jadwal_kerja"]))) {
        $jadwal_kerja_err = "Pilih jadwal kerja petugas.";
    } else {
        $jadwal_kerja = trim($_POST["jadwal_kerja"]);
    }
    // Validasi telepon
    if (empty(trim($_POST["telepon"]))) {
        $telepon_err = "Masukkan nomor telepon petugas.";
    } else {
        $telepon = trim($_POST["telepon"]);
    }
    // Jika tidak ada kesalahan validasi, tambahkan data ke database
    if (empty($nama_err) && empty($jabatan_err) && empty($nip_err) && empty($jadwal_kerja_err) && empty($telepon_err)) {
        // Query untuk menyimpan data petugas ke database
        $sql = "INSERT INTO petugas (nama, jabatan, nip, jadwal_kerja, telepon) VALUES (?, ?, ?, ?, ?)";
        if ($stmt = $koneksi->prepare($sql)) {
            // Bind parameter ke query
            $stmt->bind_param("sssss", $param_nama, $param_jabatan, $param_nip, $param_jadwal_kerja, $param_telepon);
            // Set parameter
            $param_nama = $nama;
            $param_jabatan = $jabatan;
            $param_nip = $nip;
            $param_jadwal_kerja = $jadwal_kerja;
            $param_telepon = $telepon;
            if ($stmt->execute()) {
                $success_message = "Data petugas berhasil disimpan.";
                $nama = $jabatan = $nip = $jadwal_kerja = $telepon = '';
            } else {
                echo "Terjadi kesalahan. Silakan coba lagi.";
            }
            $stmt->close();
        }
    }
}
function hapusPetugas($id)
{
    global $koneksi;
    $sql = "DELETE FROM petugas WHERE id = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
}
$no = 1;
$sql = "SELECT * FROM petugas";
$result = $koneksi->query($sql);
?>
<?php include("header.php"); ?>
<header>
    <h1>Daftar dan Tambah Petugas Baru</h1>
</header>
<div class="container">
    <?php if (!empty($success_message)) : ?>
        <div class="success-message"><?php echo $success_message; ?></div>
    <?php endif; ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group <?php echo (!empty($nama_err)) ? 'has-error' : ''; ?>">
            <label>Nama Petugas</label>
            <input type="text" name="nama" value="<?php echo $nama; ?>">
            <span class="help-block"><?php echo $nama_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($jabatan_err)) ? 'has-error' : ''; ?>">
            <label>Jabatan Petugas</label>
            <input type="text" name="jabatan" value="<?php echo $jabatan; ?>">
            <span class="help-block"><?php echo $jabatan_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($nip_err)) ? 'has-error' : ''; ?>">
            <label>NIP Petugas</label>
            <input type="text" name="nip" value="<?php echo $nip; ?>">
            <span class="help-block"><?php echo $nip_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($jadwal_kerja_err)) ? 'has-error' : ''; ?>">
            <label>Jadwal Kerja Petugas</label>
            <select name="jadwal_kerja">
                <option value="" disabled selected>Pilih Jadwal Kerja</option>
                <?php echo $parkir_options; ?>
            </select>
            <span class="help-block"><?php echo $jadwal_kerja_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($telepon_err)) ? 'has-error' : ''; ?>">
            <label>Telepon Petugas</label>
            <input type="text" name="telepon" value="<?php echo $telepon; ?>">
            <span class="help-block"><?php echo $telepon_err; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn-submit" value="Tambah Petugas">
        </div>
    </form>
</div>
<div class="container">
    <table>
        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>NIP</th>
            <th>Jabatan</th>
            <th>Jadwal Kerja</th>
            <th>Telepon</th>
            <th>Aksi</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . $row["nama"] . "</td>";
                echo "<td>" . $row["nip"] . "</td>";
                echo "<td>" . $row["jabatan"] . "</td>";
                echo "<td>" . $row["jadwal_kerja"] . "</td>";
                echo "<td>" . $row["telepon"] . "</td>";
                echo '<td class="aksi">';
                echo '<a href="edit_petugas.php?id=' . $row["id"] . '">Edit</a>';
                echo ' | ';
                echo '<a href="hapus_petugas.php?id=' . $row["id"] . '">Hapus</a>';
                echo '</td>';
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Tidak ada data petugas</td></tr>";
        }
        ?>
    </table>
</div>
<?php include("footer.php"); ?>