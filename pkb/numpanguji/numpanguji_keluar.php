<?php
session_start(); // Memulai sesi untuk menyimpan data login
include("../config.php"); // Mengimpor koneksi database

// Cek jika pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Jika belum login, hanya tampilkan pencarian dan tabel
    $form_visible = false;
    $hide_actions = true;  // Menyembunyikan tombol aksi
} else {
    // Jika sudah login, tampilkan form input data dan tombol aksi
    $form_visible = true;
    $hide_actions = false;  // Menampilkan tombol aksi
}

// Proses untuk menyimpan data Numpang Uji Keluar (hanya untuk yang sudah login)
if ($form_visible && $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Ambil data dari form dan ubah ke kapital (kecuali link)
    $nomor_kendaraan = strtoupper($_POST['nomor_kendaraan']);
    $nomor_uji = strtoupper($_POST['nomor_uji']);
    $nama_pemilik = strtoupper($_POST['nama_pemilik']);
    $tujuan = strtoupper($_POST['tujuan']);
    $nomor_surat = strtoupper($_POST['nomor_surat']);
    $link_file_gdrive = $_POST['link_file_gdrive'];  // Link tetap dalam format asli

    // Query untuk menyimpan data ke tabel numpanguji_keluar
    $sql = "INSERT INTO numpanguji_keluar (nomor_kendaraan, nomor_uji, nama_pemilik, tujuan, nomor_surat, link_file_gdrive)
            VALUES ('$nomor_kendaraan', '$nomor_uji', '$nama_pemilik', '$tujuan', '$nomor_surat', '$link_file_gdrive')";

    if ($koneksi->query($sql) === TRUE) {
        echo "<script>alert('Data berhasil disimpan!');</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan: " . $koneksi->error . "');</script>";
    }
}

// Cek apakah ada pencarian
$search_query = "";
if (isset($_POST['search'])) {
    $search_query = $_POST['search'];
    $sql_search = "SELECT * FROM numpanguji_keluar WHERE nomor_surat LIKE '%$search_query%' ORDER BY created_at DESC";
} else {
    $sql_search = "SELECT * FROM numpanguji_keluar ORDER BY created_at DESC";
}

// Pagination logic
$limit = 5; // Jumlah data per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Halaman yang sedang aktif
$start = ($page - 1) * $limit; // Mulai dari data ke-berapa

// Mengubah query untuk mengambil 5 data per halaman
$sql_search .= " LIMIT $start, $limit";

// Mengambil data hasil pencarian dengan pagination
$result_search = $koneksi->query($sql_search);

// Menghitung total data
$sql_count = "SELECT COUNT(*) AS total FROM numpanguji_keluar";
$total_result = $koneksi->query($sql_count);
$total_rows = $total_result->fetch_assoc()['total'];
$total_pages = ceil($total_rows / $limit);

// Proses Hapus Data
if (isset($_GET['hapus_id'])) {
    $hapus_id = $_GET['hapus_id'];
    $sql_hapus = "DELETE FROM numpanguji_keluar WHERE id = '$hapus_id'";
    if ($koneksi->query($sql_hapus) === TRUE) {
        echo "<script>alert('Data berhasil dihapus!');</script>";
        echo "<script>window.location.href = 'numpanguji_keluar.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat menghapus data.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Numpang Uji Keluar - UPT PKB Gresik</title>
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/css/main.css" rel="stylesheet">

    <!-- JavaScript untuk membuat input otomatis menjadi huruf kapital -->
    <script>
        function toUpperCaseInput(event) {
            event.target.value = event.target.value.toUpperCase(); // Mengubah input menjadi huruf kapital tanpa menghapus spasi
        }

        function toUpperCaseSearch(event) {
            event.target.value = event.target.value.toUpperCase(); // Mengubah input menjadi huruf kapital tanpa menghapus spasi
        }
    </script>
</head>

<body>
    <?php include("header.php"); ?>

    <main class="main">
        <div class="container mt-5">

            <?php if ($form_visible): ?>
                <h2>Form Numpang Uji Keluar</h2>
                <form action="numpanguji_keluar.php" method="POST">
                    <div class="mb-3">
                        <label for="nomor_kendaraan" class="form-label">Nomor Kendaraan</label>
                        <input type="text" class="form-control" id="nomor_kendaraan" name="nomor_kendaraan" required oninput="toUpperCaseInput(event)">
                    </div>
                    <div class="mb-3">
                        <label for="nomor_uji" class="form-label">Nomor Uji</label>
                        <input type="text" class="form-control" id="nomor_uji" name="nomor_uji" required oninput="toUpperCaseInput(event)">
                    </div>
                    <div class="mb-3">
                        <label for="nama_pemilik" class="form-label">Nama Pemilik</label>
                        <input type="text" class="form-control" id="nama_pemilik" name="nama_pemilik" required oninput="toUpperCaseInput(event)">
                    </div>
                    <div class="mb-3">
                        <label for="tujuan" class="form-label">Tujuan</label>
                        <input type="text" class="form-control" id="tujuan" name="tujuan" required oninput="toUpperCaseInput(event)">
                    </div>
                    <div class="mb-3">
                        <label for="nomor_surat" class="form-label">Nomor Surat</label>
                        <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" required oninput="toUpperCaseInput(event)">
                    </div>
                    <div class="mb-3">
                        <label for="link_file_gdrive" class="form-label">Link File Google Drive</label>
                        <input type="url" class="form-control" id="link_file_gdrive" name="link_file_gdrive" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
                </form>

                <hr>
            <?php endif; ?>

            <h3 class="mt-5">Pencarian Nomor Surat</h3>
            <form method="POST">
                <div class="mb-3">
                    <input type="text" class="form-control" name="search" placeholder="Cari Nomor Surat" value="<?php echo $search_query; ?>" oninput="toUpperCaseSearch(event)">
                    <button type="submit" class="btn btn-secondary mt-2">Cari</button>
                </div>
            </form>

            <h3 class="mt-5">Tabel Numpang Uji Keluar</h3>
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor Kendaraan</th>
                        <th>Nomor Uji</th>
                        <th>Nama Pemilik</th>
                        <th>Tujuan</th>
                        <th>Nomor Surat</th>
                        <th>Link File Google Drive</th>
                        <?php if (!$hide_actions): ?>
                            <th>Aksi</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result_search->num_rows > 0) {
                        $no = 1;
                        while ($row = $result_search->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . $row['nomor_kendaraan'] . "</td>";
                            echo "<td>" . $row['nomor_uji'] . "</td>";
                            echo "<td>" . $row['nama_pemilik'] . "</td>";
                            echo "<td>" . $row['tujuan'] . "</td>";
                            echo "<td>" . $row['nomor_surat'] . "</td>";
                            echo "<td><a href='" . $row['link_file_gdrive'] . "' target='_blank'>Lihat</a></td>";

                            // Tombol Edit dan Hapus
                            if (!$hide_actions) {
                                echo "<td>
                                        <a href='edit_numpanguji_keluar.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Edit</a>
                                        <a href='numpanguji_keluar.php?hapus_id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus data?\")'>Hapus</a>
                                      </td>";
                            }

                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8' class='text-center'>Tidak ada data numpang uji keluar.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-4">
                <ul class="pagination">
                    <?php
                    for ($i = 1; $i <= $total_pages; $i++) {
                        echo "<li class='page-item " . ($i == $page ? 'active' : '') . "'><a class='page-link' href='numpanguji_keluar.php?page=$i'>$i</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </main>

    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>