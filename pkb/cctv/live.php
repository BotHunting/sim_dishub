<?php
include("header.php");
require_once __DIR__ . '/../config.php'; // Pastikan file config.php di-include

// Cek login
$logged_in = isset($_SESSION['username']);

// Hapus video jika sudah login dan ada parameter hapus
if ($logged_in && isset($_GET['hapus']) && is_numeric($_GET['hapus'])) {
    $hapus_id = $_GET['hapus'];
    $stmt = $koneksi->prepare("DELETE FROM video_cctv WHERE id = ?");
    $stmt->bind_param("i", $hapus_id);
    $stmt->execute();
    echo "<script>alert('Video berhasil dihapus'); window.location='live.php';</script>";
    exit;
}

// Ambil data video
$stmt = $koneksi->prepare("SELECT * FROM video_cctv ORDER BY id ASC");
$stmt->execute();
$videos = $stmt->get_result();
?>

<main class="main">

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Live CCTV</h1>
                        <p class="mb-0">Pantau layanan UPT PKB Gresik secara langsung melalui CCTV yang tersedia di berbagai lokasi strategis.</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="index.php">Home</a></li>
                    <li class="current">Live CCTV</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <!-- Section Live CCTV -->
    <section id="live-cctv" class="section trainers-index">
        <?php if ($logged_in): ?>
            <div class="col-lg-12 text-center mb-4">
                <a href="tambah_video.php" class="btn btn-primary">+ Tambah Video</a>
            </div>
        <?php endif; ?>
        <div class="container">
            <h2 class="text-center mb-4">Daftar CCTV</h2>
            <div class="row">
                <?php if ($videos->num_rows > 0): ?>
                    <?php while ($video = $videos->fetch_assoc()): ?>
                        <div class="col-lg-4 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
                            <div class="member">
                                <iframe width="100%" height="250" src="<?= htmlspecialchars($video['link_embed']) ?>" frameborder="0" allowfullscreen></iframe>
                                <div class="member-content">
                                    <h4><?= htmlspecialchars($video['lokasi']) ?></h4>
                                    <?php if ($logged_in): ?>
                                        <div class="mt-3">
                                            <a href="edit_video.php?id=<?= $video['id'] ?>" class="btn btn-warning btn-sm mr-2">Edit</a>
                                            <a href="live.php?hapus=<?= $video['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus video ini?')">Hapus</a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p class="text-center">Tidak ada data CCTV yang tersedia.</p>
                <?php endif; ?>
            </div>
        </div>
    </section><!-- End Section Live CCTV -->

</main>

<?php include("footer.php"); ?>
