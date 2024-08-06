<?php
session_start();
require_once 'koneksi.php';

$query_bidang = "SELECT * FROM bidang";
$result_bidang = $koneksi->query($query_bidang);
$jabatan_per_bidang = [];

if ($result_bidang && $result_bidang->num_rows > 0) {
    while ($row_bidang = $result_bidang->fetch_assoc()) {
        $bidang_id = $row_bidang['id'];
        $nama_bidang = $row_bidang['nama_bidang'];

        $query_seksi = "SELECT * FROM seksi WHERE bidang = '$nama_bidang'";
        $result_seksi = $koneksi->query($query_seksi);
        $jabatan_per_seksi = [];

        if ($result_seksi && $result_seksi->num_rows > 0) {
            while ($row_seksi = $result_seksi->fetch_assoc()) {
                $seksi_id = $row_seksi['id'];
                $nama_seksi = $row_seksi['nama_seksi'];

                $query_jabatan = "SELECT *, (SELECT COUNT(*) FROM pegawai WHERE jabatan = jabatan.nama_jabatan) as jumlah_pegawai FROM jabatan WHERE bidang = '$nama_bidang' AND seksi = '$nama_seksi'";
                $result_jabatan = $koneksi->query($query_jabatan);
                $jabatan_list = [];

                if ($result_jabatan && $result_jabatan->num_rows > 0) {
                    while ($row_jabatan = $result_jabatan->fetch_assoc()) {
                        $jabatan_list[] = $row_jabatan;
                    }
                }

                $jabatan_per_seksi[$nama_seksi] = $jabatan_list;
            }
        }

        $jabatan_per_bidang[$nama_bidang] = $jabatan_per_seksi;
    }
}
?>

<?php include_once 'header.php'; ?>

<!-- Page Title -->
<div class="page-title" data-aos="fade">
    <div class="heading">
        <div class="container">
            <div class="row d-flex justify-content-center text-center">
                <div class="col-lg-8">
                    <h1>Jabatan</h1>
                    <p class="mb-0">Halaman Jabatan di website Tata Usaha Dinas Perhubungan Kabupaten Fakfak berisi informasi tentang struktur organisasi dan jabatan di Dinas Perhubungan Kabupaten Fakfak.</p>
                </div>
            </div>
        </div>
    </div>
    <nav class="breadcrumbs">
        <div class="container">
            <ol>
                <li><a href="index.php">Home</a></li>
                <li class="current">Jabatan</li>
            </ol>
        </div>
    </nav>
</div><!-- End Page Title -->

<div class="container mt-5">
    <h1 class="mb-4">Daftar Jabatan</h1>
    <?php if (!empty($jabatan_per_bidang)) : ?>
        <?php foreach ($jabatan_per_bidang as $bidang => $seksi_list) : ?>
            <h2><?php echo $bidang; ?></h2>
            <?php foreach ($seksi_list as $seksi => $jabatan_list) : ?>
                <h3><?php echo $seksi; ?></h3>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Jabatan</th>
                                <th>Anjab</th>
                                <th>Jumlah Pegawai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($jabatan_list as $index => $jabatan) : ?>
                                <tr>
                                    <td><?php echo $index + 1; ?></td>
                                    <td><?php echo $jabatan['nama_jabatan']; ?></td>
                                    <td>
                                        <?php if (!empty($jabatan['anjab'])) : ?>
                                            <a href="<?php echo $jabatan['anjab']; ?>" target="_blank" class="btn btn-primary">View</a>
                                        <?php else : ?>
                                            File Belum Upload
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo $jabatan['jumlah_pegawai']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endforeach; ?>
        <?php endforeach; ?>
    <?php else : ?>
        <p>Tidak ada data jabatan.</p>
    <?php endif; ?>
</div>

<?php include("footer.php"); ?>