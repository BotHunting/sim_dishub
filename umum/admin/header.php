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
    <style>
        .navbar {
            box-shadow: 0 2px 8px rgba(44,62,80,0.08);
            font-size: 1rem;
        }
        .navbar-brand {
            font-weight: 700;
            color: #6dd5fa !important;
            letter-spacing: 1px;
        }
        .navbar-nav .nav-link {
            color: #fff !important;
            margin-right: 8px;
            transition: color 0.2s;
        }
        .navbar-nav .nav-link:hover, .navbar-nav .nav-item.active .nav-link {
            color: #6dd5fa !important;
            background: rgba(41,128,185,0.08);
            border-radius: 8px;
        }
        .navbar-text {
            margin-left: 16px;
            font-weight: 500;
            color: #fff;
        }
        .badge-rules {
            background: linear-gradient(90deg, #2980b9 0%, #6dd5fa 100%);
            color: #fff;
            font-size: 0.95rem;
            padding: 6px 16px;
            border-radius: 12px;
            margin-left: 8px;
            box-shadow: 0 2px 8px rgba(44,62,80,0.08);
        }
        .navbar-logo {
            height: 48px;
            margin-right: 12px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(44,62,80,0.08);
        }
        @media (max-width: 991px) {
            .navbar-text, .badge-rules {
                margin-left: 0;
                margin-top: 8px;
                display: block;
                text-align: right;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top py-2">
        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <img src="img/logo.png" alt="Logo" class="navbar-logo">
            Admin Panel
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="pelayanan.php">Pelayanan</a></li>
                <li class="nav-item"><a class="nav-link" href="disposisi.php">Disposisi</a></li>
                <li class="nav-item"><a class="nav-link" href="surat_menyurat.php">Surat</a></li>
                <li class="nav-item"><a class="nav-link" href="pengawasan.php">SPT</a></li>
                <li class="nav-item"><a class="nav-link" href="pengelolaan.php">Pengelolaan</a></li>
                <li class="nav-item"><a class="nav-link" href="pegawai.php">Pegawai</a></li>
                <li class="nav-item"><a class="nav-link" href="laporan.php">Laporan</a></li>
                <li class="nav-item"><a class="nav-link" href="jabatan.php">Jabatan</a></li>
                <li class="nav-item active"><a class="nav-link" href="../index.php">Home</a></li>
            </ul>
            <?php if ($logged_in && $rules): ?>
                <span class="navbar-text">
                    <span class="badge-rules"><?php echo htmlspecialchars($rules); ?></span>
                </span>
            <?php endif; ?>
        </div>
    </nav>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<div style="height: 60px;"></div>
</html>