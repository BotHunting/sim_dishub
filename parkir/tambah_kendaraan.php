<?php
require_once('koneksi.php');
$nomor_kendaraan = $jenis_kendaraan = '';
$nomor_kendaraan_err = $jenis_kendaraan_err = '';
$success_message = '';

// Ambil data lokasi dari tabel parkir
$sql_parkir = "SELECT * FROM parkir";
$result_parkir = $koneksi->query($sql_parkir);

// Proses saat formulir disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["nomor_kendaraan"]))) {
        $nomor_kendaraan_err = "Masukkan nomor plat kendaraan.";
    } else {
        $nomor_kendaraan = trim($_POST["nomor_kendaraan"]);
    }
    if (empty(trim($_POST["jenis_kendaraan"]))) {
        $jenis_kendaraan_err = "Pilih jenis kendaraan.";
    } else {
        $jenis_kendaraan = trim($_POST["jenis_kendaraan"]);
    }
    if (empty($nomor_kendaraan_err) && empty($jenis_kendaraan_err)) {
        $lokasi_parkir = $_POST["lokasi_parkir"];
        $sql = "INSERT INTO kendaraan (nomor_kendaraan, jenis_kendaraan, waktu_masuk, lokasi_parkir, status) VALUES (?, ?, NOW(), ?, 'Masuk')";
        if ($stmt = $koneksi->prepare($sql)) {
            $stmt->bind_param("sss", $param_nomor_kendaraan, $param_jenis_kendaraan, $param_lokasi_parkir);
            $param_nomor_kendaraan = $nomor_kendaraan;
            $param_jenis_kendaraan = $jenis_kendaraan;
            $param_lokasi_parkir = $lokasi_parkir;
            if ($stmt->execute()) {
                $success_message = "Data kendaraan berhasil disimpan.";
                $nomor_kendaraan = $jenis_kendaraan = '';
            } else {
                echo "Terjadi kesalahan. Silakan coba lagi.";
            }
            $stmt->close();
        }
    }
}
?>
<?php include("header.php"); ?>
<header class="text-center">
    <h1>Tambah Kendaraan Baru</h1>
</header>
<div class="container">
    <?php if (!empty($success_message)) : ?>
        <div class="alert alert-success"><?php echo $success_message; ?></div>
    <?php endif; ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="mb-3">
            <label for="nomor_kendaraan" class="form-label">Nomor kendaraan</label>
            <input type="text" class="form-control <?php echo (!empty($nomor_kendaraan_err)) ? 'is-invalid' : ''; ?>" id="nomor_kendaraan" name="nomor_kendaraan" value="<?php echo $nomor_kendaraan; ?>">
            <span class="invalid-feedback"><?php echo $nomor_kendaraan_err; ?></span>
        </div>
        <div class="mb-3">
            <label for="jenis_kendaraan" class="form-label">Jenis Kendaraan</label>
            <select class="form-select <?php echo (!empty($jenis_kendaraan_err)) ? 'is-invalid' : ''; ?>" id="jenis_kendaraan" name="jenis_kendaraan">
                <option value="">Pilih Jenis Kendaraan</option>
                <option value="Motor" <?php if ($jenis_kendaraan == 'Motor') echo 'selected'; ?>>Motor</option>
                <option value="Mobil" <?php if ($jenis_kendaraan == 'Mobil') echo 'selected'; ?>>Mobil</option>
            </select>
            <span class="invalid-feedback"><?php echo $jenis_kendaraan_err; ?></span>
        </div>
        <div class="mb-3">
            <label for="lokasi_parkir" class="form-label">Lokasi Parkir</label>
            <select class="form-select" id="lokasi_parkir" name="lokasi_parkir">
                <option value="">Pilih Lokasi Parkir</option>
                <?php while ($row = $result_parkir->fetch_assoc()) : ?>
                    <option value="<?php echo $row['lokasi']; ?>"><?php echo $row['lokasi']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3"> <!-- Menambahkan kolom jam -->
            <label for="jam_masuk" class="form-label">Jam Masuk</label>
            <input type="text" class="form-control" id="jam_masuk" name="jam_masuk" readonly>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Tambah Kendaraan</button>
        </div>
    </form>
</div>
<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nomor Kendaraan</th>
                <th scope="col">Jenis Kendaraan</th>
                <th scope="col">Waktu Masuk</th>
                <th scope="col">Lokasi</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Query untuk mengambil data kendaraan dari database, diurutkan berdasarkan waktu masuk secara descending
            $sql = "SELECT * FROM kendaraan ORDER BY waktu_masuk DESC";
            $result = $koneksi->query($sql);
            // Periksa apakah ada baris data yang diambil dari database
            if ($result && $result->num_rows > 0) {
                // Output data dari setiap baris
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["nomor_kendaraan"] . "</td>"; // Kolom "nomor_plat" sesuai dengan struktur tabel kendaraan
                    echo "<td>" . $row["jenis_kendaraan"] . "</td>";
                    echo "<td>" . $row["waktu_masuk"] . "</td>";
                    echo "<td>" . $row["lokasi_parkir"] . "</td>";
                    echo "<td>" . $row["status"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Tidak ada data kendaraan</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Script JavaScript untuk mengambil waktu dari komputer -->
<script>
    const jamMasukInput = document.getElementById('jam_masuk');
    updateClock();
    setInterval(updateClock, 1000);

    function updateClock() {
        const now = new Date();
        const hour = now.getHours().toString().padStart(2, '0');
        const minute = now.getMinutes().toString().padStart(2, '0');
        const second = now.getSeconds().toString().padStart(2, '0');
        const currentTime = `${hour}:${minute}:${second}`;
        jamMasukInput.value = currentTime;
    }
</script>
<?php
$koneksi->close();
?>
<?php include("footer.php"); ?>