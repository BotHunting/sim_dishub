<?php
session_start(); // Memulai sesi untuk menyimpan data login
include("../config.php"); // Mengimpor koneksi database

// Cek apakah ada pencarian
$search_query = "";
if (isset($_POST['search'])) {
    $search_query = $_POST['search'];
    $sql_search = "SELECT * FROM rubah_bentuk WHERE nomor_surat LIKE '%$search_query%' ORDER BY created_at DESC";
} else {
    $sql_search = "SELECT * FROM rubah_bentuk ORDER BY created_at DESC";
}

// Mengambil data hasil pencarian
$result_search = $koneksi->query($sql_search);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rubah Bentuk - UPT PKB Gresik</title>
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/css/main.css" rel="stylesheet">

    <!-- JavaScript untuk membuat input otomatis menjadi huruf kapital -->
    <script>
        function toUpperCaseSearch(event) {
            event.target.value = event.target.value.toUpperCase(); // Mengubah input menjadi huruf kapital tanpa menghapus spasi
        }
    </script>
</head>

<body>
    <?php include("header.php"); ?>

    <main class="main">
        <div class="container mt-5">

            <!-- Pencarian Nomor Surat -->
            <h3 class="mt-5">Pencarian Nomor Surat</h3>
            <form method="POST">
                <div class="mb-3">
                    <input type="text" class="form-control" name="search" placeholder="Cari Nomor Surat" value="<?php echo $search_query; ?>" oninput="toUpperCaseSearch(event)">
                    <button type="submit" class="btn btn-secondary mt-2">Cari</button>
                </div>
            </form>

            <!-- Tabel Rubah Bentuk -->
            <h3 class="mt-5">Tabel Rubah Bentuk</h3>
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor Kendaraan</th>
                        <th>Nomor Uji</th>
                        <th>Nama Pemilik</th>
                        <th>Rubah Bentuk Ke</th>
                        <th>Nomor Surat</th>
                        <th>Link File Google Drive</th>
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
                            echo "<td>" . $row['rubah_bentuk_ke'] . "</td>";
                            echo "<td>" . $row['nomor_surat'] . "</td>";
                            echo "<td><a href='" . $row['link_file_gdrive'] . "' target='_blank'>Lihat</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7' class='text-center'>Tidak ada data rubah bentuk.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>

        </div>
    </main>

    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
