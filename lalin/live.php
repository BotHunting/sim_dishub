<?php
include("header.php");

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
    <section id="live-cctv" class="section courses">
        <?php if ($logged_in): ?>
            <div class="col-lg-12 text-center mb-4">
                <a href="tambah_video.php" class="btn btn-primary">+ Tambah Video</a>
            </div>
        <?php endif; ?>
        <div class="container">
            <div class="row">
                <?php if ($videos->num_rows > 0): ?>
                    <?php while ($video = $videos->fetch_assoc()): ?>
                        <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                            <div class="course-item w-100">
                                <div class="ratio ratio-16x9">
                                    <iframe src="<?= htmlspecialchars($video['link_embed']) ?>" title="<?= htmlspecialchars($video['lokasi']) ?>" allowfullscreen></iframe>
                                </div>
                                <div class="course-content">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h3 class="m-0"><a href="#"><?= htmlspecialchars($video['lokasi']) ?></a></h3>
                                        <?php if ($logged_in): ?>
                                            <div>
                                                <a href="edit_video.php?id=<?= $video['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                                <a href="live.php?hapus=<?= $video['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus video ini?')">Hapus</a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
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
