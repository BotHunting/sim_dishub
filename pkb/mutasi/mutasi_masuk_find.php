<?php
session_start(); // Memulai sesi untuk menyimpan data login
include("../config.php"); // Mengimpor koneksi database

// Cek apakah ada pencarian
$search_query = "";
if (isset($_POST['search'])) {
    $search_query = strtoupper($_POST['search']); // Mengubah input pencarian menjadi huruf kapital
    $sql_search = "SELECT * FROM mutasi_masuk WHERE nomor_surat LIKE '%$search_query%' ORDER BY created_at DESC";
} else {
    $sql_search = "SELECT * FROM mutasi_masuk ORDER BY created_at DESC";
}

// Pagination logic
$limit = 5; // Jumlah data per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Halaman yang sedang aktif
$start = ($page - 1) * $limit; // Mulai dari data ke-berapa

// Menambahkan limit pada query
$sql_search .= " LIMIT $start, $limit";

// Mengambil data hasil pencarian dengan pagination
$result_search = $koneksi->query($sql_search);

// Menghitung total data
$sql_count = "SELECT COUNT(*) AS total FROM mutasi_masuk";
$total_result = $koneksi->query($sql_count);
$total_rows = $total_result->fetch_assoc()['total'];
$total_pages = ceil($total_rows / $limit);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mutasi Masuk - UPT PKB Gresik</title>
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/css/main.css" rel="stylesheet">

    <!-- JavaScript untuk membuat input otomatis menjadi huruf kapital -->
    <script>
        function toUpperCaseSearch(event) {
            event.target.value = event.target.value.toUpperCase().replace(/\s/g, '');
        }
    </script>
</head>

<body>
    <?php include("header.php"); ?>

    <main class="main">
        <div class="container mt-5">

            <h3 class="mt-5">Pencarian Nomor Surat</h3>
            <form method="POST">
                <div class="mb-3">
                    <input type="text" class="form-control" name="search" placeholder="Cari Nomor Surat" value="<?php echo $search_query; ?>" oninput="toUpperCaseSearch(event)">
                    <button type="submit" class="btn btn-secondary mt-2">Cari</button>
                </div>
            </form>

            <h3 class="mt-5">Tabel Mutasi Masuk</h3>
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor Kendaraan</th>
                        <th>Nomor Uji</th>
                        <th>Nama Pemilik</th>
                        <th>Asal</th>
                        <th>Nomor Surat</th>
                        <th>Link File Google Drive</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result_search->num_rows > 0) {
                        $no = $start + 1; // Nomor urut data berdasarkan halaman
                        while ($row = $result_search->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . $row['nomor_kendaraan'] . "</td>";
                            echo "<td>" . $row['nomor_uji'] . "</td>";
                            echo "<td>" . $row['nama_pemilik'] . "</td>";
                            echo "<td>" . $row['tujuan'] . "</td>";
                            echo "<td>" . $row['nomor_surat'] . "</td>";
                            echo "<td><a href='" . $row['link_file_gdrive'] . "' target='_blank'>Lihat</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7' class='text-center'>Tidak ada data mutasi masuk.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-4">
                <ul class="pagination">
                    <?php
                    for ($i = 1; $i <= $total_pages; $i++) {
                        echo "<li class='page-item " . ($i == $page ? 'active' : '') . "'><a class='page-link' href='mutasi_masuk_find.php?page=$i'>$i</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </main>

    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
