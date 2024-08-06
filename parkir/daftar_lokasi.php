<?php
// Sertakan file koneksi.php untuk terhubung ke database
require_once('koneksi.php');
// Inisialisasi variabel error
$errors = [];
$message = "";
// Proses saat formulir disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil dan bersihkan data yang diinput dari formulir
    $lokasi = htmlspecialchars($_POST['lokasi']);

    // Validasi input (contoh: memastikan semua field tidak kosong)
    if (empty($lokasi)) {
        $errors[] = "Field lokasi harus diisi";
    } else {
        // Jika tidak ada kesalahan, tambahkan data ke database
        $sql = "INSERT INTO parkir (lokasi) VALUES (?)";
        $stmt = $koneksi->prepare($sql);
        $stmt->bind_param("s", $lokasi);
        if ($stmt->execute()) {
            // Set pesan notifikasi
            $message = "Data lokasi berhasil disimpan.";

            // Kosongkan nilai variabel
            $lokasi = "";
        } else {
            $errors[] = "Gagal menambahkan lokasi";
        }
    }
}
$errors = [];
// Definisikan variabel $no
$no = 1;
// Proses saat formulir disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil dan bersihkan data yang diinput dari formulir
    $lokasi = htmlspecialchars($_POST['lokasi']);

    // Validasi input (contoh: memastikan semua field tidak kosong)
    if (empty($lokasi)) {
        $errors[] = "Field lokasi harus diisi";
    } else {
        // Jika tidak ada kesalahan, tambahkan data ke database
        $sql = "INSERT INTO parkir (lokasi) VALUES (?)";
        $stmt = $koneksi->prepare($sql);
        $stmt->bind_param("s", $lokasi);
        if ($stmt->execute()) {
            // Set pesan notifikasi
            $message = "Data lokasi berhasil disimpan.";
        } else {
            $errors[] = "Gagal menambahkan lokasi";
        }
    }
}
// Ambil data dari tabel parkir
$sql_parkir = "SELECT * FROM parkir";
$result_parkir = $koneksi->query($sql_parkir);
// Tutup koneksi database
$koneksi->close();
?>
<?php include("header.php"); ?> <header>
      <!-- Page Title -->
  <div class="page-title" data-aos="fade">
    <div class="heading">
      <div class="container">
        <div class="row d-flex justify-content-center text-center">
          <div class="col-lg-8">
            <h1>Daftar dan Tambah Lokasi</h1>
            <p class="mb-0">Rencanakan perjalanan Anda dengan cerdas. Akses website Sistem Terminal Dinas Perhubungan sekarang!</p>
          </div>
        </div>
      </div>
    </div>
    <nav class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="index.php">Home</a></li>
          <li class="current">Parkir</li>
        </ol>
      </div>
    </nav>
  </div><!-- End Page Title -->

<div class="container">
    <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error) : ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <?php if (!empty($message)) : ?>
        <div class="success-message">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div class="form-group">
            <label for="lokasi">Lokasi:</label>
            <input type="text" name="lokasi" id="lokasi" value="<?php echo isset($lokasi) ? $lokasi : ''; ?>">
        </div>
        <div class="form-group">
            <input type="submit" class="btn-submit" value="Tambah Lokasi">
        </div>
    </form>
</div>
<div class="container">
    <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error) : ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <?php if (isset($message)) : ?>
        <div class="success-message">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
    <table>
        <tr>
            <th>No</th>
            <th>Lokasi</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = $result_parkir->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $row['lokasi']; ?></td>
                <td>
                    <a href="edit_lokasi.php?id=<?php echo $row['id']; ?>">Edit</a> | <!-- Tautan untuk edit -->
                    <a href="hapus_lokasi.php?id=<?php echo $row['id']; ?>">Hapus</a> <!-- Tautan untuk hapus -->
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</div>
<?php include("footer.php"); ?>