<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once '../../config.php'; // Menggunakan config.php dari dua folder sebelumnya
$logged_in = false;
$rules = "";
if (isset($_SESSION['username'])) {
    $logged_in = true;
    $rules = ""; // Inisialisasi variabel rules
    $query = "SELECT rules FROM admin WHERE username = ?";
    $stmt = $koneksi->prepare($query);
    if ($stmt) {
        $stmt->bind_param("s", $_SESSION['username']);
        $stmt->execute();
        $stmt->bind_result($rules);
        $stmt->fetch();
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin - Dinas Perhubungan Kabupaten Fakfak</title>
    <link rel="icon" href="img/logo.png" type="image/png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <img src="img/logo.png" alt="Logo" height="50" class="me-2">
        <a class="navbar-brand" href="index.php">Admin Panel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="pelayanan.php">Pelayanan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="disposisi.php">Disposisi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="surat_menyurat.php">Surat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pengawasan.php">SPT</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pengelolaan.php">Pengelolaan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pegawai.php">Pegawai</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="laporan.php">Laporan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="jabatan.php">Jabatan</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="../index.php">Home</a>
                </li>
            </ul>
        </div>
        <span class="navbar-text ms-auto"><?php echo htmlspecialchars($rules); ?></span> <!-- Tambahkan htmlspecialchars untuk menghindari XSS -->
    </nav>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2eKW3xSWfongrtjWLvNStSt0/FKcitL8jaaYO rupture-safety net/qa/1162/8" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-IiCgqACnCBqCioSXj7TUlvrB4VVQsa7QoSUSp9YzLwT5aQkXv8LNLC3R8zTwTwq" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4qIWzYEUvbzcj9hROvSLSLU894LTL8WQrWpFEaItISlXhTmeylgykLNkAhhIwX" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
</body>
<div style="height: 50px;"></div>

</html>