<?php include_once 'header.php'; ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h2 class="mb-4 text-center text-primary">Daftar Pegawai</h2>
                    <?php if ($rules !== 'Staff') : ?>
                        <div class="d-flex justify-content-end mb-4 gap-2">
                            <a href="tambah_pegawai.php" class="btn btn-gradient me-2"><i class="fas fa-user-plus"></i> Tambah Pegawai</a>
                            <a href="absensi.php" class="btn btn-gradient me-2"><i class="fas fa-calendar-check"></i> Absensi</a>
                            <a href="absensi_form.php" class="btn btn-success"><i class="fas fa-file-alt"></i> Form Lembar Absen</a>
                        </div>
                    <?php endif; ?>
                    <div class="table-responsive">
                        <?php
                        require_once 'koneksi.php';
                        $sql = "SELECT DISTINCT seksi, bidang FROM pegawai";
                        $result = $koneksi->query($sql);
                        if ($result && $result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<div class='mb-5'>";
                                echo "<h4 class='mt-4 mb-3 text-info'><i class='fas fa-users'></i> " . htmlspecialchars($row['seksi']) . " - " . htmlspecialchars($row['bidang']) . "</h4>";
                                echo "<table class='table table-bordered table-hover bg-white'>";
                                echo "<thead class='thead-light'>";
                                echo "<tr>";
                                echo "<th style='width:5%'>No.</th>";
                                echo "<th>Nama</th>";
                                echo "<th>Pangkat</th>";
                                echo "<th>NIP</th>";
                                echo "<th>Jabatan</th>";
                                if ($rules !== 'Staff') {
                                    echo "<th style='width:15%'>Aksi</th>";
                                }
                                echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                $sub_sql = "SELECT * FROM pegawai WHERE seksi = ? AND bidang = ?";
                                $stmt = $koneksi->prepare($sub_sql);
                                $stmt->bind_param("ss", $row['seksi'], $row['bidang']);
                                $stmt->execute();
                                $sub_result = $stmt->get_result();
                                if ($sub_result && $sub_result->num_rows > 0) {
                                    $no = 1;
                                    while ($sub_row = $sub_result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $no++ . "</td>";
                                        echo "<td>" . htmlspecialchars($sub_row['nama']) . "</td>";
                                        echo "<td>" . htmlspecialchars($sub_row['pangkat']) . "</td>";
                                        echo "<td>" . htmlspecialchars($sub_row['nip']) . "</td>";
                                        echo "<td>" . htmlspecialchars($sub_row['jabatan']) . "</td>";
                                        if ($rules !== 'Staff') {
                                            echo "<td>";
                                            echo "<a href='edit_pegawai.php?id=" . htmlspecialchars($sub_row['id']) . "' class='btn btn-warning btn-sm me-1'><i class='fas fa-edit'></i> Edit</a>";
                                            echo "<a href='hapus_pegawai.php?id=" . htmlspecialchars($sub_row['id']) . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus data ini?\")'><i class='fas fa-trash'></i> Hapus</a>";
                                            echo "</td>";
                                        }
                                        echo "</tr>";
                                    }
                                } else {
                                    $colspan = ($rules !== 'Staff') ? 6 : 5;
                                    echo "<tr><td colspan='$colspan' class='text-center text-muted'>Tidak ada data pegawai untuk seksi " . htmlspecialchars($row['seksi']) . " dan bidang " . htmlspecialchars($row['bidang']) . ".</td></tr>";
                                }
                                echo "</tbody>";
                                echo "</table>";
                                echo "</div>";
                                $stmt->close();
                            }
                        } else {
                            echo "<p class='text-center text-muted'>Tidak ada data pegawai.</p>";
                        }
                        $koneksi->close();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .btn-gradient {
        background: linear-gradient(90deg, #2980b9 0%, #6dd5fa 100%);
        color: #fff;
        border: none;
        font-weight: 500;
        transition: background 0.3s;
    }
    .btn-gradient:hover {
        background: linear-gradient(90deg, #6dd5fa 0%, #2980b9 100%);
        color: #fff;
    }
    .me-1 { margin-right: 0.25rem; }
    .me-2 { margin-right: 0.5rem; }
    .gap-2 > * { margin-left: 0.5rem; }
    .gap-2 > *:first-child { margin-left: 0; }
    .table th, .table td {
        vertical-align: middle;
    }
</style>
<div style="height: 100px;"></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
