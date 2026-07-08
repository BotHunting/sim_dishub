<?php
session_start(); // Memulai sesi untuk menyimpan data login
include("../config.php"); // Mengimpor koneksi database

// Cek jika pengguna sudah login, jika tidak, redirect ke halaman login
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

// --- PROSES DATA UNTUK NUMPANG UJI MASUK ---

// Proses simpan data baru (Masuk)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_masuk'])) {
    $nomor_kendaraan = strtoupper(trim($_POST['nomor_kendaraan']));
    $nomor_uji = strtoupper(trim($_POST['nomor_uji']));
    $nama_pemilik = strtoupper(trim($_POST['nama_pemilik']));
    $tujuan = strtoupper(trim($_POST['tujuan']));
    $nomor_surat = strtoupper(trim($_POST['nomor_surat']));
    $link_file_gdrive = trim($_POST['link_file_gdrive']);

    $sql = "INSERT INTO numpanguji_masuk (nomor_kendaraan, nomor_uji, nama_pemilik, tujuan, nomor_surat, link_file_gdrive) VALUES (?, ?, ?, ?, ?, ?)";
    if ($stmt = $koneksi->prepare($sql)) {
        $stmt->bind_param("ssssss", $nomor_kendaraan, $nomor_uji, $nama_pemilik, $tujuan, $nomor_surat, $link_file_gdrive);
        if ($stmt->execute()) {
            echo "<script>alert('Data Numpang Uji Masuk berhasil disimpan!'); window.location.href='dashboard.php';</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan: " . $stmt->error . "');</script>";
        }
        $stmt->close();
    }
}

// Proses hapus data (Masuk)
if (isset($_GET['hapus_masuk_id'])) {
    $hapus_id = (int)$_GET['hapus_masuk_id'];
    $sql_hapus = "DELETE FROM numpanguji_masuk WHERE id = ?";
    if ($stmt = $koneksi->prepare($sql_hapus)) {
        $stmt->bind_param("i", $hapus_id);
        if ($stmt->execute()) {
            echo "<script>alert('Data Numpang Uji Masuk berhasil dihapus!'); window.location.href='dashboard.php';</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan saat menghapus data.');</script>";
        }
        $stmt->close();
    }
}

// --- PROSES DATA UNTUK NUMPANG UJI KELUAR ---

// Proses simpan data baru (Keluar)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_keluar'])) {
    $nomor_kendaraan = strtoupper(trim($_POST['nomor_kendaraan_keluar']));
    $nomor_uji = strtoupper(trim($_POST['nomor_uji_keluar']));
    $nama_pemilik = strtoupper(trim($_POST['nama_pemilik_keluar']));
    $tujuan = strtoupper(trim($_POST['tujuan_keluar']));
    $nomor_surat = strtoupper(trim($_POST['nomor_surat_keluar']));
    $link_file_gdrive = trim($_POST['link_file_gdrive_keluar']);

    $sql = "INSERT INTO numpanguji_keluar (nomor_kendaraan, nomor_uji, nama_pemilik, tujuan, nomor_surat, link_file_gdrive) VALUES (?, ?, ?, ?, ?, ?)";
    if ($stmt = $koneksi->prepare($sql)) {
        $stmt->bind_param("ssssss", $nomor_kendaraan, $nomor_uji, $nama_pemilik, $tujuan, $nomor_surat, $link_file_gdrive);
        if ($stmt->execute()) {
            echo "<script>alert('Data Numpang Uji Keluar berhasil disimpan!'); window.location.href='dashboard.php#keluar-tab';</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan: " . $stmt->error . "');</script>";
        }
        $stmt->close();
    }
}

// Proses hapus data (Keluar)
if (isset($_GET['hapus_keluar_id'])) {
    $hapus_id = (int)$_GET['hapus_keluar_id'];
    $sql_hapus = "DELETE FROM numpanguji_keluar WHERE id = ?";
    if ($stmt = $koneksi->prepare($sql_hapus)) {
        $stmt->bind_param("i", $hapus_id);
        if ($stmt->execute()) {
            echo "<script>alert('Data Numpang Uji Keluar berhasil dihapus!'); window.location.href='dashboard.php#keluar-tab';</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan saat menghapus data.');</script>";
        }
        $stmt->close();
    }
}


// --- PENGAMBILAN DATA & PAGINATION (MASUK) ---
$limit_masuk = 5;
$page_masuk = isset($_GET['page_masuk']) ? (int)$_GET['page_masuk'] : 1;
$start_masuk = ($page_masuk - 1) * $limit_masuk;

$search_query_masuk = "";
$search_param_masuk = [];
$sql_search_masuk = "SELECT * FROM numpanguji_masuk";
$sql_count_masuk = "SELECT COUNT(*) AS total FROM numpanguji_masuk";

if (isset($_REQUEST['search_masuk']) && !empty(trim($_REQUEST['search_masuk']))) {
    $search_query_masuk = trim($_REQUEST['search_masuk']);
    $search_like_masuk = "%" . strtoupper($search_query_masuk) . "%";
    $sql_search_masuk .= " WHERE nomor_surat LIKE ?";
    $sql_count_masuk .= " WHERE nomor_surat LIKE ?";
    $search_param_masuk[] = $search_like_masuk;
}

// Total data (Masuk)
$stmt_count_masuk = $koneksi->prepare($sql_count_masuk);
if (!empty($search_param_masuk)) {
    $stmt_count_masuk->bind_param("s", ...$search_param_masuk);
}
$stmt_count_masuk->execute();
$total_result_masuk = $stmt_count_masuk->get_result();
$total_rows_masuk = $total_result_masuk->fetch_assoc()['total'];
$total_pages_masuk = ceil($total_rows_masuk / $limit_masuk);
$stmt_count_masuk->close();

// Data untuk tabel (Masuk)
$sql_search_masuk .= " ORDER BY created_at DESC LIMIT ?, ?";
$stmt_search_masuk = $koneksi->prepare($sql_search_masuk);
if (!empty($search_param_masuk)) {
    $stmt_search_masuk->bind_param("sii", $search_param_masuk[0], $start_masuk, $limit_masuk);
} else {
    $stmt_search_masuk->bind_param("ii", $start_masuk, $limit_masuk);
}
$stmt_search_masuk->execute();
$result_search_masuk = $stmt_search_masuk->get_result();


// --- PENGAMBILAN DATA & PAGINATION (KELUAR) ---
$limit_keluar = 5;
$page_keluar = isset($_GET['page_keluar']) ? (int)$_GET['page_keluar'] : 1;
$start_keluar = ($page_keluar - 1) * $limit_keluar;

$search_query_keluar = "";
$search_param_keluar = [];
$sql_search_keluar = "SELECT * FROM numpanguji_keluar";
$sql_count_keluar = "SELECT COUNT(*) AS total FROM numpanguji_keluar";

if (isset($_REQUEST['search_keluar']) && !empty(trim($_REQUEST['search_keluar']))) {
    $search_query_keluar = trim($_REQUEST['search_keluar']);
    $search_like_keluar = "%" . strtoupper($search_query_keluar) . "%";
    $sql_search_keluar .= " WHERE nomor_surat LIKE ?";
    $sql_count_keluar .= " WHERE nomor_surat LIKE ?";
    $search_param_keluar[] = $search_like_keluar;
}

// Total data (Keluar)
$stmt_count_keluar = $koneksi->prepare($sql_count_keluar);
if (!empty($search_param_keluar)) {
    $stmt_count_keluar->bind_param("s", ...$search_param_keluar);
}
$stmt_count_keluar->execute();
$total_result_keluar = $stmt_count_keluar->get_result();
$total_rows_keluar = $total_result_keluar->fetch_assoc()['total'];
$total_pages_keluar = ceil($total_rows_keluar / $limit_keluar);
$stmt_count_keluar->close();

// Data untuk tabel (Keluar)
$sql_search_keluar .= " ORDER BY created_at DESC LIMIT ?, ?";
$stmt_search_keluar = $koneksi->prepare($sql_search_keluar);
if (!empty($search_param_keluar)) {
    $stmt_search_keluar->bind_param("sii", $search_param_keluar[0], $start_keluar, $limit_keluar);
} else {
    $stmt_search_keluar->bind_param("ii", $start_keluar, $limit_keluar);
}
$stmt_search_keluar->execute();
$result_search_keluar = $stmt_search_keluar->get_result();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Numpang Uji - UPT PKB Gresik</title>
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/css/main.css" rel="stylesheet">

    <!-- JavaScript untuk membuat input otomatis menjadi huruf kapital -->
    <script>
        function toUpperCaseInput(event) {
            event.target.value = event.target.value.toUpperCase();
        }
    </script>
</head>

<body>
    <?php include("header.php"); ?>

    <main class="main">
        <!-- Page Title -->
        <div class="page-title" data-aos="fade">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1>Dashboard Numpang Uji</h1>
                            <p class="mb-0">Kelola data rekomendasi numpang uji masuk dan keluar.</p>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="../index.php">Home</a></li>
                        <li class="current">Dashboard Numpang Uji</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Page Title -->

        <div class="container mt-5">
            
            <ul class="nav nav-tabs" id="numpangUjiTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="masuk-tab" data-bs-toggle="tab" data-bs-target="#masuk-tab-pane" type="button" role="tab" aria-controls="masuk-tab-pane" aria-selected="true">Numpang Uji Masuk</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="keluar-tab" data-bs-toggle="tab" data-bs-target="#keluar-tab-pane" type="button" role="tab" aria-controls="keluar-tab-pane" aria-selected="false">Numpang Uji Keluar</button>
                </li>
            </ul>

            <div class="tab-content" id="numpangUjiTabContent">
                <!-- ================================== -->
                <!-- TAB CONTENT UNTUK NUMPANG UJI MASUK -->
                <!-- ================================== -->
                <div class="tab-pane fade show active" id="masuk-tab-pane" role="tabpanel" aria-labelledby="masuk-tab" tabindex="0">
                    <div class="py-4">
                        <h2>Form Numpang Uji Masuk</h2>
                        <form action="dashboard.php" method="POST">
                            <div class="mb-3"><label for="nomor_kendaraan" class="form-label">Nomor Kendaraan</label><input type="text" class="form-control" id="nomor_kendaraan" name="nomor_kendaraan" required oninput="toUpperCaseInput(event)"></div>
                            <div class="mb-3"><label for="nomor_uji" class="form-label">Nomor Uji</label><input type="text" class="form-control" id="nomor_uji" name="nomor_uji" required oninput="toUpperCaseInput(event)"></div>
                            <div class="mb-3"><label for="nama_pemilik" class="form-label">Nama Pemilik</label><input type="text" class="form-control" id="nama_pemilik" name="nama_pemilik" required oninput="toUpperCaseInput(event)"></div>
                            <div class="mb-3"><label for="tujuan" class="form-label">Asal</label><input type="text" class="form-control" id="tujuan" name="tujuan" required oninput="toUpperCaseInput(event)"></div>
                            <div class="mb-3"><label for="nomor_surat" class="form-label">Nomor Surat</label><input type="text" class="form-control" id="nomor_surat" name="nomor_surat" required oninput="toUpperCaseInput(event)"></div>
                            <div class="mb-3"><label for="link_file_gdrive" class="form-label">Link File Google Drive</label><input type="url" class="form-control" id="link_file_gdrive" name="link_file_gdrive" required></div>
                            <button type="submit" class="btn btn-primary" name="submit_masuk">Simpan</button>
                        </form>

                        <hr class="my-5">

                        <h3 class="mt-5">Tabel Numpang Uji Masuk</h3>
                        <form method="POST" action="dashboard.php#masuk-tab-pane" class="mb-4">
                            <div class="input-group"><input type="text" class="form-control" name="search_masuk" placeholder="Cari Nomor Surat" value="<?php echo htmlspecialchars($search_query_masuk); ?>" oninput="toUpperCaseInput(event)"><button type="submit" class="btn btn-secondary">Cari</button></div>
                        </form>

                        <table class="table table-bordered table-striped">
                            <thead><tr><th>No</th><th>Nomor Kendaraan</th><th>Nomor Uji</th><th>Nama Pemilik</th><th>Asal</th><th>Nomor Surat</th><th>Link File</th><th>Aksi</th></tr></thead>
                            <tbody>
                                <?php
                                if ($result_search_masuk->num_rows > 0) {
                                    $no = $start_masuk + 1;
                                    while ($row = $result_search_masuk->fetch_assoc()) {
                                        echo "<tr><td>" . $no++ . "</td><td>" . htmlspecialchars($row['nomor_kendaraan']) . "</td><td>" . htmlspecialchars($row['nomor_uji']) . "</td><td>" . htmlspecialchars($row['nama_pemilik']) . "</td><td>" . htmlspecialchars($row['tujuan']) . "</td><td>" . htmlspecialchars($row['nomor_surat']) . "</td><td><a href='" . htmlspecialchars($row['link_file_gdrive']) . "' target='_blank'>Lihat</a></td><td><a href='edit_numpanguji_masuk.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Edit</a> <a href='dashboard.php?hapus_masuk_id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus data ini?\")'>Hapus</a></td></tr>";
                                    }
                                } else { echo "<tr><td colspan='8' class='text-center'>Tidak ada data.</td></tr>"; }
                                ?>
                            </tbody>
                        </table>

                        <nav><ul class="pagination">
                            <?php for ($i = 1; $i <= $total_pages_masuk; $i++): $active = ($i == $page_masuk) ? 'active' : ''; $search_param = !empty($search_query_masuk) ? "&search_masuk=" . urlencode($search_query_masuk) : ""; ?>
                                <li class='page-item <?php echo $active; ?>'><a class='page-link' href='dashboard.php?page_masuk=<?php echo $i . $search_param; ?>#masuk-tab-pane'><?php echo $i; ?></a></li>
                            <?php endfor; ?>
                        </ul></nav>
                    </div>
                </div>

                <!-- =================================== -->
                <!-- TAB CONTENT UNTUK NUMPANG UJI KELUAR -->
                <!-- =================================== -->
                <div class="tab-pane fade" id="keluar-tab-pane" role="tabpanel" aria-labelledby="keluar-tab" tabindex="0">
                    <div class="py-4">
                        <h2>Form Numpang Uji Keluar</h2>
                        <form action="dashboard.php#keluar-tab-pane" method="POST">
                            <div class="mb-3"><label for="nomor_kendaraan_keluar" class="form-label">Nomor Kendaraan</label><input type="text" class="form-control" id="nomor_kendaraan_keluar" name="nomor_kendaraan_keluar" required oninput="toUpperCaseInput(event)"></div>
                            <div class="mb-3"><label for="nomor_uji_keluar" class="form-label">Nomor Uji</label><input type="text" class="form-control" id="nomor_uji_keluar" name="nomor_uji_keluar" required oninput="toUpperCaseInput(event)"></div>
                            <div class="mb-3"><label for="nama_pemilik_keluar" class="form-label">Nama Pemilik</label><input type="text" class="form-control" id="nama_pemilik_keluar" name="nama_pemilik_keluar" required oninput="toUpperCaseInput(event)"></div>
                            <div class="mb-3"><label for="tujuan_keluar" class="form-label">Tujuan</label><input type="text" class="form-control" id="tujuan_keluar" name="tujuan_keluar" required oninput="toUpperCaseInput(event)"></div>
                            <div class="mb-3"><label for="nomor_surat_keluar" class="form-label">Nomor Surat</label><input type="text" class="form-control" id="nomor_surat_keluar" name="nomor_surat_keluar" required oninput="toUpperCaseInput(event)"></div>
                            <div class="mb-3"><label for="link_file_gdrive_keluar" class="form-label">Link File Google Drive</label><input type="url" class="form-control" id="link_file_gdrive_keluar" name="link_file_gdrive_keluar" required></div>
                            <button type="submit" class="btn btn-primary" name="submit_keluar">Simpan</button>
                        </form>

                        <hr class="my-5">

                        <h3 class="mt-5">Tabel Numpang Uji Keluar</h3>
                        <form method="POST" action="dashboard.php#keluar-tab-pane" class="mb-4">
                            <div class="input-group"><input type="text" class="form-control" name="search_keluar" placeholder="Cari Nomor Surat" value="<?php echo htmlspecialchars($search_query_keluar); ?>" oninput="toUpperCaseInput(event)"><button type="submit" class="btn btn-secondary">Cari</button></div>
                        </form>

                        <table class="table table-bordered table-striped">
                            <thead><tr><th>No</th><th>Nomor Kendaraan</th><th>Nomor Uji</th><th>Nama Pemilik</th><th>Tujuan</th><th>Nomor Surat</th><th>Link File</th><th>Aksi</th></tr></thead>
                            <tbody>
                                <?php
                                if ($result_search_keluar->num_rows > 0) {
                                    $no = $start_keluar + 1;
                                    while ($row = $result_search_keluar->fetch_assoc()) {
                                        echo "<tr><td>" . $no++ . "</td><td>" . htmlspecialchars($row['nomor_kendaraan']) . "</td><td>" . htmlspecialchars($row['nomor_uji']) . "</td><td>" . htmlspecialchars($row['nama_pemilik']) . "</td><td>" . htmlspecialchars($row['tujuan']) . "</td><td>" . htmlspecialchars($row['nomor_surat']) . "</td><td><a href='" . htmlspecialchars($row['link_file_gdrive']) . "' target='_blank'>Lihat</a></td><td><a href='edit_numpanguji_keluar.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Edit</a> <a href='dashboard.php?hapus_keluar_id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus data ini?\")'>Hapus</a></td></tr>";
                                    }
                                } else { echo "<tr><td colspan='8' class='text-center'>Tidak ada data.</td></tr>"; }
                                ?>
                            </tbody>
                        </table>

                        <nav><ul class="pagination">
                            <?php for ($i = 1; $i <= $total_pages_keluar; $i++): $active = ($i == $page_keluar) ? 'active' : ''; $search_param = !empty($search_query_keluar) ? "&search_keluar=" . urlencode($search_query_keluar) : ""; ?>
                                <li class='page-item <?php echo $active; ?>'><a class='page-link' href='dashboard.php?page_keluar=<?php echo $i . $search_param; ?>#keluar-tab-pane'><?php echo $i; ?></a></li>
                            <?php endfor; ?>
                        </ul></nav>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php
    $stmt_search_masuk->close();
    $stmt_search_keluar->close();
    $koneksi->close();
    include("footer.php"); 
    ?>
</body>

</html>