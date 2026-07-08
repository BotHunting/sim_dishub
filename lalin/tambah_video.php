<?php
include "header.php";

// Cek login, hanya admin yang bisa tambah video
if (!$logged_in) {
    header("Location: ../login.php");
    exit;
}

$error = "";

// Proses ketika form disubmit
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $lokasi = filter_input(INPUT_POST, 'lokasi', FILTER_SANITIZE_STRING);
    $link_embed = filter_input(INPUT_POST, 'link_embed', FILTER_SANITIZE_URL);

    if (!empty($lokasi) && !empty($link_embed)) {
        $stmt = $koneksi->prepare("INSERT INTO video_cctv (lokasi, link_embed) VALUES (?, ?)");
        $stmt->bind_param("ss", $lokasi, $link_embed);
        if ($stmt->execute()) {
            echo "<script>alert('Video berhasil ditambahkan!'); window.location='live.php';</script>";
            exit;
        } else {
            $error = "Gagal menambahkan video: " . $stmt->error;
        }
        $stmt->close();
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
                        <h1>Tambah Video CCTV</h1>
                        <p class="mb-0">Tambahkan video CCTV baru ke dalam sistem pemantauan.</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="live.php">Live CCTV</a></li>
                    <li class="current">Tambah Video</li>
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
                    <input type="text" name="lokasi" id="lokasi" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="link_embed" class="form-label">Link Embed Video</label>
                    <input type="url" name="link_embed" id="link_embed" class="form-control" placeholder="https://www.youtube.com/embed/..." required>
                    <div class="form-text">Bisa berupa link YouTube embed, link .m3u8, atau URL blob/iframe lainnya.</div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Preview Video</label>
                    <div id="video-preview" class="ratio ratio-16x9 border rounded bg-light"></div>
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
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
