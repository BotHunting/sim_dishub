<?php
include_once 'koneksi.php';
session_start();

// Query SQL untuk mengambil jumlah semua petugas
$sql = "SELECT COUNT(*) AS total_petugas FROM petugas";
$result = $koneksi->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $total_petugas = $row['total_petugas'];
} else {
  $total_petugas = 0;
}

// Query SQL untuk mengambil jumlah semua terminal
$sql = "SELECT COUNT(*) AS total_terminal FROM terminal";
$result = $koneksi->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $total_terminal = $row['total_terminal'];
} else {
  $total_terminal = 0;
}

// Query SQL untuk menghitung jumlah semua data hari ini dalam tabel kendaraan_masuk
$sql = "SELECT COUNT(*) AS total_armada FROM kendaraan_masuk";
$result = $koneksi->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $total_armada = $row['total_armada'];
} else {
  $total_armada = 0;
}

// Query SQL untuk menghitung jumlah semua kendaraan keluar hari ini
$sql = "SELECT COUNT(*) AS total_berangkat FROM kendaraan_keluar WHERE DATE(waktu_keberangkatan) = CURDATE()";
$result = $koneksi->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $total_berangkat = $row['total_berangkat'];
} else {
  $total_berangkat = 0;
}
?>

<?php include("header.php"); ?>
<main class="main">

  <!-- Hero Section -->
  <section id="hero" class="hero section">

    <img src="assets/img/hero-bg.jpg" alt="" data-aos="fade-in">

    <div class="container">
      <h2 data-aos="fade-up" data-aos-delay="100" class="">Terminal Penumpang,<br>Dinas Perhubungan Kabupaten Fakfak</h2>
      <p data-aos="fade-up" data-aos-delay="200">Bingung mau bepergian jauh tapi takut kehabisan tiket? Atau pusing cari informasi seputar terminal? Website Sistem Terminal Dinas Perhubungan hadir sebagai solusi cerdas untuk Anda!</p>
      <div class="d-flex mt-4" data-aos="fade-up" data-aos-delay="300">
        <?php
        // Periksa apakah pengguna sudah login
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
          // Jika sudah login, arahkan ke tambah_kendaraan.php
          echo '<a href="tambah_kendaraan.php" class="btn-get-started">Get Started</a>';
        } else {
          // Jika belum login, arahkan ke tampil_kendaraan.php
          echo '<a href="tampil_terminal.php" class="btn-get-started">Get Started</a>';
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
          <h3>Bernavigasi Lancar di Terminal - Website Sistem Terminal Dinas Perhubungan!</h3>
          <p class="fst-italic">
            Selamat datang di website resmi Sistem Terminal Dinas Perhubungan! Di sini, perjalanan Anda akan terasa lebih mudah dan terencana. Website kami dirancang khusus untuk memenuhi kebutuhan Anda, para pengguna setia terminal.</p>
          <ul>
            <li><i class="bi bi-check-circle"></i> <span>Statistik Real-time: Lihat statistik jumlah penumpang, kendaraan, dan pendapatan terminal secara langsung.</span></li>
            <li><i class="bi bi-check-circle"></i> <span>Tetap Terhubung: Dapatkan berita terbaru terkait terminal dan Dinas Perhubungan.</span></li>
            <li><i class="bi bi-check-circle"></i> <span>Jangkau Kami: Hubungi Dinas Perhubungan dan terminal melalui informasi kontak yang tersedia.</span></li>
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
            <p class="">Terminal</p>
          </div>
        </div><!-- End Stats Item -->

        <div class="col-lg-3 col-md-6">
          <div class="stats-item text-center w-100 h-100">
            <span data-purecounter-start="0" data-purecounter-end="<?php echo $total_armada; ?>" data-purecounter-duration="1" class="purecounter"></span>
            <p class="">Armada</p>
          </div>
        </div><!-- End Stats Item -->

        <div class="col-lg-3 col-md-6">
          <div class="stats-item text-center w-100 h-100">
            <span data-purecounter-start="0" data-purecounter-end="<?php echo $total_berangkat; ?>" data-purecounter-duration="1" class="purecounter"></span>
            <p class="">Berangkat</p>
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
            <h3>Rencanakan perjalanan Anda dengan cerdas</h3>
            <p>
              Website ini juga responsif, sehingga dapat diakses dengan mudah melalui smartphone, tablet, maupun komputer Anda.
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
                <h4>Terminal Sekitar Anda</h4>
                <p>Cari tahu alamat, jam operasional, dan fasilitas terminal yang dikelola Dinas Perhubungan</p>
              </div>
            </div><!-- End Icon Box -->

            <div class="col-xl-4" data-aos="fade-up" data-aos-delay="300">
              <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                <i class="bi bi-gem"></i>
                <h4>Menuju Tujuan Tepat Waktu</h4>
                <p>Akses jadwal keberangkatan dan informasi trayek dengan mudah</p>
              </div>
            </div><!-- End Icon Box -->

            <div class="col-xl-4" data-aos="fade-up" data-aos-delay="400">
              <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                <i class="bi bi-inboxes"></i>
                <h4>Layanan Lengkap</h4>
                <p>Pelajari berbagai layanan yang tersedia di terminal, seperti pembelian tiket, penitipan barang, dan pusat informasi perjalanan</p>
              </div>
            </div><!-- End Icon Box -->

          </div>
        </div>

      </div>

    </div>

  </section><!-- /Why Us Section -->

</main>
<?php include("footer.php"); ?>