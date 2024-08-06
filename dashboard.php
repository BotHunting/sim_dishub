<?php
session_start();

// Inisialisasi variabel $logout_button
$logout_button = '';

// Cek apakah pengguna sudah login atau belum
if (isset($_SESSION['username'])) {
    // Jika sudah login, tampilkan tombol logout
    $logout_button = '<a class="nav-link" href="logout.php">Logout</a>';

    // Tampilkan tombol WhatsApp
    $whatsapp_button = '<a class="nav-link" href="https://chat.whatsapp.com/LNr7o9wiaNPDtaOedCyxfq" target="_blank">WhatsApp</a>';
} else {
    // Jika belum login, tampilkan tombol login
    $logout_button = '<a class="nav-link" href="login.php">Login</a>';
    $whatsapp_button = ''; // Jangan tampilkan tombol WhatsApp jika belum login
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Dinas Perhubungan Kabupaten Fakfak</title>
    <link rel="icon" href="images/logo.png" type="image/png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('images/index.jpg');
            background-size: cover;
            background-position: center;
            overflow: hidden;
            /* Menyembunyikan overflow agar tidak muncul scrollbar */
        }

        .container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: white;
            opacity: 0;
            animation: fadeIn 2s forwards;
            /* Animasi fadeIn */
        }

        /* Animasi fadeIn */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* Animasi efek bayangan teks */
        .text-shadow {
            text-shadow: 2px 2px 4px #000000;
        }

        .navbar-brand img {
            width: 100px;
            /* Sesuaikan ukuran logo */
            height: auto;
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php"><img src="images/logo.png" alt="Logo">Dinas Perhubungan Fakfak</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="https://dishub.fakfakkab.go.id/" target="_blank">Beranda<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="umum/index.php">Umum</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="terminal/index.php">Terminal<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="parkir/index.php">Parkir</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://ngekironline.co.id/" target="_blank">Pengujian</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="lalin/index.php">Lalu Lintas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://discord.gg/Zuh4ES92Hm" target="_blank">Discord</a>
                </li>
                <?php echo $whatsapp_button; ?>
                <li class="nav-item">
                    <?php echo $logout_button; ?>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-4">
        <h2 class="text-shadow">Selamat datang di Sistem Informasi</h2>
        <p class="text-shadow">Dinas Perhubungan Kabupaten Fakfak</p>
    </div>
    <!-- Bootstrap JS (jQuery and Popper.js required) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script type='text/javascript' src='https://assets.trakteer.id/js/trbtn-overlay.min.js'></script>
    <script type='text/javascript' class='troverlay'>
        (function() {
            var trbtnId = trbtnOverlay.init('Support Me', '#FFC147', 'https://trakteer.id/hunty/tip/embed/modal', 'https://cdn.trakteer.id/images/embed/trbtn-icon.png?date=18-11-2023', '35', 'floating-right');
            trbtnOverlay.draw(trbtnId);
        })();
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>