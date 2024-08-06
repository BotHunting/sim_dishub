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

<?php include("header.php"); ?>
<main class="main">

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Pelayanan</h1>
                        <p class="mb-0">Mitra Anda dalam Mewujudkan Mobilitas yang Aman, Nyaman, dan Ramah Lingkungan</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="index.php">Home</a></li>
                    <li class="current">Pelayanan</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <!-- Events Section -->
    <section id="events" class="events section">

        <div class="container" data-aos="fade-up">

            <div class="row">

                <?php
                // Include file konfigurasi database
                include_once 'config.php';

                // Query untuk mengambil data dari tabel pelayanan_kantor
                $sql = "SELECT * FROM pelayanan_kantor";
                $result = $koneksi->query($sql);

                if ($result->num_rows > 0) {
                    // Loop untuk menampilkan data dalam bentuk card
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="col-md-6 d-flex align-items-stretch">
                            <div class="card">
                                <div class="card-img">
                                    <img src="assets/img/servis/<?php echo $row['foto']; ?>" alt="...">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><a href=""><?php echo $row['nama']; ?></a></h5>
                                    <p class="fst-italic text-center"><?php echo $row['jadwal']; ?></p>
                                    <p class="card-text"><?php echo $row['keterangan']; ?></p>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo "Data tidak ditemukan.";
                }
                ?>

            </div>

        </div>

    </section><!-- /Events Section -->

</main>

<?php include("footer.php"); ?>