<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once 'config.php';
$logged_in = false;
$rules = "";
if (isset($_SESSION['username'])) {
    $logged_in = true;
    if ($stmt = $koneksi->prepare("SELECT rules FROM admin WHERE username = ?")) {
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
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Sistem Informasi Dinas Perhubungan Kabupaten Fakfak</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link rel="icon" href="assets/img/favicon.png" type="image/png">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">

</head>

<body>
    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="index.php" class="logo d-flex align-items-center me-auto">
                <h1 class="">DISHUB FAKFAK</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="index.php" class="active">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="courses.php">Services</a></li>
                    <li><a href="trainers.php">Pegawai</a></li>
                    <li><a href="events.php">Pelayanan</a></li>
                    <li class="dropdown has-dropdown"><a href="#"><span>Menu</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="umum/index.php">Umum</a></li>
                            <li><a href="terminal/index.php">Terminal</a></li>
                            <li><a href="parkir/index.php">Parkir</a></li>
                            <li><a href="pkb/">Pengujian</a></li>
                            <li><a href="lalin/index.php">Lalu Lintas</a></li>
                            <li class="dropdown has-dropdown"><a href="#"><span>Sosial Media</span> <i class="bi bi-chevron-down"></i></a>
                                <ul>
                                    <li><a href="https://dishub.fakfakkab.go.id/" class="active" target="_blank">Pemda Fakfak</a></li>
                                    <li><a href="https://www.facebook.com/dishub.fakfak" target="_blank">Facebook</a></li>
                                    <li><a href="https://discord.gg/Zuh4ES92Hm" target="_blank">Discord</a></li>
                                    <?php echo isset($_SESSION['username']) ? '<li><a href="https://chat.whatsapp.com/LNr7o9wiaNPDtaOedCyxfq" target="_blank">WhatsApp</a></li>' : ''; ?>
                                </ul>
                            </li>
                            <?php
                            if (isset($_SESSION['username']) && $rules !== 'Staff') {
                                echo '<li><a href="setting.php">Setting</a></li>';
                                echo '<li><a href="key.php">Troubleshoot</a></li>';
                            }
                            ?>
                        </ul>
                    </li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <?php if ($logged_in) : ?>
                <a class="btn-getstarted" href="logout.php">Logout</a>
            <?php else : ?>
                <a class="btn-getstarted" href="login.php">Login</a>
            <?php endif; ?>

        </div>
    </header>