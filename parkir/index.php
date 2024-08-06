<?php
include_once 'koneksi.php';

// Query untuk menghitung jumlah petugas
$sql = "SELECT COUNT(*) as total_petugas FROM petugas_parkir";
$result = $koneksi->query($sql);

$total_petugas = 0;
if ($result) {
  $row = $result->fetch_assoc();
  $total_petugas = $row['total_petugas'];
}


// Query untuk menghitung jumlah lokasi unik dalam tabel parkir
$sql = "SELECT COUNT(DISTINCT lokasi) as total_lokasi FROM parkir";
$result = $koneksi->query($sql);

$total_terminal = 0;
if ($result) {
  $row = $result->fetch_assoc();
  $total_terminal = $row['total_lokasi'];
}

// Query untuk menghitung jumlah lokasi unik dalam tabel kendaraan
$sql = "SELECT COUNT(DISTINCT lokasi_parkir) as total_lokasi FROM kendaraan";
$result = $koneksi->query($sql);

$total_armada = 0;
if ($result) {
  $row = $result->fetch_assoc();
  $total_armada = $row['total_lokasi'];
}

// Query untuk menghitung jumlah kendaraan yang telah keluar hari ini
$sql = "SELECT COUNT(*) as total_keluar FROM laporan_parkir WHERE DATE(waktu_keluar) = CURDATE()";
$result = $koneksi->query($sql);

$total_berangkat = 0;
if ($result) {
  $row = $result->fetch_assoc();
  $total_berangkat = $row['total_keluar'];
}
?>

<?php include("header.php"); ?>
<main class="main">

  <!-- Hero Section -->
  <section id="hero" class="hero section">

    <img src="assets/img/hero-bg.jpg" alt="" data-aos="fade-in">

    <div class="container">
      <h2 data-aos="fade-up" data-aos-delay="100" class="">Parkir Cerdas Dishub Fakfak<br>Solusi Parkir Mudah dan Aman di Fakfak</h2>
      <p data-aos="fade-up" data-aos-delay="200">Parkir Bebas Hambatan dengan Parkir Dinas Perhubungan Fakfak!</p>
      <div class="d-flex mt-4" data-aos="fade-up" data-aos-delay="300">
        <?php
        // Periksa apakah pengguna sudah login
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
          // Jika sudah login, arahkan ke tambah_kendaraan.php
          echo '<a href="tambah_kendaraan.php" class="btn-get-started">Get Started</a>';
        } else {
          // Jika belum login, arahkan ke tampil_kendaraan.php
          echo '<a href="tampil_parkir.php" class="btn-get-started">Get Started</a>';
        }
        ?>
      </div>

    </div>

  </section><!-- /Hero Section -->

  <!-- About Section -->
  <section id="about" class="about section">

    <div class="container">

      <div class="row gy-4">

        <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="100">
          <img src="assets/img/about.jpg" class="img-fluid" alt="">
        </div>

        <div class="col-lg-6 order-2 order-lg-1 content" data-aos="fade-up" data-aos-delay="200">
          <h3>Aplikasi Parkir Resmi Dinas Perhubungan Kabupaten Fakfak!</h3>
          <p class="fst-italic">
            Temukan Tempat Parkir Terdekat dengan Mudah, Bayar Parkir Tanpa Ribet, Langsung dari Ponsel Anda.</p>
          <ul>
            <li><i class="bi bi-check-circle"></i> <span>Cari Tempat Parkir: Temukan tempat parkir terdekat dengan mudah dan cepat.</span></li>
            <li><i class="bi bi-check-circle"></i> <span>Pembayaran Cashless: Bayar parkir tanpa uang tunai, aman dan praktis.</span></li>
            <li><i class="bi bi-check-circle"></i> <span>Riwayat Parkir: Pantau riwayat parkir Anda dengan mudah.</span></li>
            <li><i class="bi bi-check-circle"></i> <span>Notifikasi: Dapatkan notifikasi informasi penting terkait parkir.</span></li>
          </ul>
          <a href="#" class="read-more"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
        </div>

      </div>

    </div>

  </section><!-- /About Section -->

  <!-- Counts Section -->
  <section id="counts" class="section counts">

    <div class="container" data-aos="fade-up" data-aos-delay="100">

      <div class="row gy-4">

        <div class="col-lg-3 col-md-6">
          <div class="stats-item text-center w-100 h-100">
            <span data-purecounter-start="0" data-purecounter-end="<?php echo $total_petugas; ?>" data-purecounter-duration="1" class="purecounter"></span>
            <p class="">Petugas</p>
          </div>
        </div><!-- End Stats Item -->

        <div class="col-lg-3 col-md-6">
          <div class="stats-item text-center w-100 h-100">
            <span data-purecounter-start="0" data-purecounter-end="<?php echo $total_terminal; ?>" data-purecounter-duration="1" class="purecounter"></span>
            <p class="">Lokasi</p>
          </div>
        </div><!-- End Stats Item -->

        <div class="col-lg-3 col-md-6">
          <div class="stats-item text-center w-100 h-100">
            <span data-purecounter-start="0" data-purecounter-end="<?php echo $total_armada; ?>" data-purecounter-duration="1" class="purecounter"></span>
            <p class="">Parkir</p>
          </div>
        </div><!-- End Stats Item -->

        <div class="col-lg-3 col-md-6">
          <div class="stats-item text-center w-100 h-100">
            <span data-purecounter-start="0" data-purecounter-end="<?php echo $total_berangkat; ?>" data-purecounter-duration="1" class="purecounter"></span>
            <p class="">Keluar</p>
          </div>
        </div><!-- End Stats Item -->

      </div>

    </div>

  </section><!-- /Counts Section -->

  <!-- Why Us Section -->
  <section id="why-us" class="section why-us">

    <div class="container">

      <div class="row gy-4">

        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
          <div class="why-box">
            <h3>Dukungan Petugas</h3>
            <p>
              Dapatkan bantuan dari petugas parkir jika Anda membutuhkan.
            </p>
            <div class="text-center">
              <a href="#" class="more-btn"><span>Learn More</span> <i class="bi bi-chevron-right"></i></a>
            </div>
          </div>
        </div><!-- End Why Box -->

        <div class="col-lg-8 d-flex align-items-stretch">
          <div class="row gy-4" data-aos="fade-up" data-aos-delay="200">

            <div class="col-xl-4">
              <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                <i class="bi bi-clipboard-data"></i>
                <h4>Hemat Waktu</h4>
                <p>Tidak perlu lagi mencari tempat parkir berlama-lama</p>
              </div>
            </div><!-- End Icon Box -->

            <div class="col-xl-4" data-aos="fade-up" data-aos-delay="300">
              <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                <i class="bi bi-gem"></i>
                <h4>Hemat Biaya</h4>
                <p>Hindari denda parkir karena lupa waktu</p>
              </div>
            </div><!-- End Icon Box -->

            <div class="col-xl-4" data-aos="fade-up" data-aos-delay="400">
              <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                <i class="bi bi-inboxes"></i>
                <h4>Lebih Aman</h4>
                <p>Parkir di tempat yang terjamin keamanannya</p>
              </div>
            </div><!-- End Icon Box -->

          </div>
        </div>

      </div>

    </div>

  </section><!-- /Why Us Section -->

</main>
<?php include("footer.php"); ?>