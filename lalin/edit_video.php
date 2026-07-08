<?php
include "header.php";

// Cek login, hanya admin yang bisa edit video
if (!$logged_in) {
    header("Location: ../login.php");
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<script>alert('ID video tidak valid'); window.location='live.php';</script>";
    exit;
}

$id = (int)$_GET['id'];

$stmt = $koneksi->prepare("SELECT * FROM video_cctv WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<script>alert('Video tidak ditemukan'); window.location='live.php';</script>";
    exit;
}
$video = $result->fetch_assoc();
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $lokasi = filter_input(INPUT_POST, 'lokasi', FILTER_SANITIZE_STRING);
    $link_embed = filter_input(INPUT_POST, 'link_embed', FILTER_SANITIZE_URL);

    if (!empty($lokasi) && !empty($link_embed)) {
        $stmt_update = $koneksi->prepare("UPDATE video_cctv SET lokasi = ?, link_embed = ? WHERE id = ?");
        $stmt_update->bind_param("ssi", $lokasi, $link_embed, $id);
        if ($stmt_update->execute()) {
            echo "<script>alert('Video berhasil diperbarui!'); window.location='live.php';</script>";
            exit;
        } else {
            $error = "Gagal memperbarui video: " . $stmt_update->error;
        }
        $stmt_update->close();
    } else {
        $error = "Harap isi semua kolom.";
    }
}
?>

<main class="main">

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Edit Video CCTV</h1>
                        <p class="mb-0">Perbarui informasi lokasi atau link video CCTV.</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="live.php">Live CCTV</a></li>
                    <li class="current">Edit Video</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="container">
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="mb-3">
                    <label for="lokasi" class="form-label">Lokasi</label>
                    <input type="text" name="lokasi" id="lokasi" class="form-control"
                        value="<?= htmlspecialchars($video['lokasi']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="link_embed" class="form-label">Link Embed Video</label>
                    <input type="url" name="link_embed" id="link_embed" class="form-control"
                        value="<?= htmlspecialchars($video['link_embed']) ?>"
                        placeholder="https://www.youtube.com/embed/..." required>
                    <div class="form-text">Bisa berupa link YouTube embed, link .m3u8, atau URL blob/iframe lainnya.</div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Preview Video</label>
                    <div id="video-preview" class="ratio ratio-16x9 border rounded bg-light"></div>
                </div>

                <button type="submit" class="btn btn-success">Perbarui</button>
                <a href="live.php" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </section>

</main>

<script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
<script>
    function updatePreview() {
        const url = document.getElementById('link_embed').value;
        const preview = document.getElementById('video-preview');
        let videoElement;

        if (!url) {
            preview.innerHTML = '';
            return;
        }

        if (url.includes("youtube.com") || url.includes("youtu.be")) {
            preview.innerHTML = `<iframe class="embed-responsive-item" src="${url.replace('watch?v=', 'embed/')}" frameborder="0" allowfullscreen></iframe>`;
        } else if (url.endsWith(".m3u8")) {
            preview.innerHTML = `<video id="hls-video" controls autoplay class="w-100 h-100"></video>`;
            videoElement = document.getElementById('hls-video');
            if (Hls.isSupported()) {
                var hls = new Hls();
                hls.loadSource(url);
                hls.attachMedia(videoElement);
                hls.on(Hls.Events.MANIFEST_PARSED, function () {
                    videoElement.play();
                });
            } else if (videoElement.canPlayType('application/vnd.apple.mpegurl')) {
                videoElement.src = url;
                videoElement.addEventListener('loadedmetadata', function () {
                    videoElement.play();
                });
            }
        } else {
            preview.innerHTML = `<iframe class="embed-responsive-item" src="${url}" frameborder="0" allowfullscreen></iframe>`;
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        updatePreview();
        document.getElementById('link_embed').addEventListener('input', updatePreview);
    });
</script>

<?php include "footer.php"; ?>