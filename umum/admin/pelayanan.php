<?php include_once 'header.php'; ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h2 class="mb-4 text-center text-primary">Pelayanan Masyarakat</h2>
                    <?php if ($rules !== 'Staff') : ?>
                        <div class="d-flex justify-content-end mb-3">
                            <a href="riwayat_pelayanan.php" class="btn btn-gradient">
                                <i class="fas fa-history"></i> Riwayat Pelayanan
                            </a>
                        </div>
                    <?php endif; ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover bg-white">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Nama Layanan</th>
                                    <th>Deskripsi</th>
                                    <th>Pemohon</th>
                                    <th>Status</th>
                                    <th>Lampiran</th>
                                    <?php if ($rules === 'Kepala') : ?>
                                        <th>Aksi</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                require_once 'koneksi.php';
                                $query = "SELECT * FROM pelayananumum WHERE status = ? ORDER BY tanggal DESC";
                                $stmt = $koneksi->prepare($query);
                                $status = 'Pending';
                                $stmt->bind_param('s', $status);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                if ($result->num_rows > 0) {
                                    $no = 1;
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $no++ . "</td>";
                                        echo "<td>" . htmlspecialchars($row['tanggal']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['nama_layanan']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['deskripsi']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['pemohon']) . "</td>";
                                        // Status badge
                                        echo "<td>";
                                        $statusClass = $row['status'] === 'Pending' ? 'badge-warning' : 'badge-success';
                                        echo "<span class='badge $statusClass'>" . htmlspecialchars($row['status']) . "</span>";
                                        echo "</td>";
                                        // Lampiran
                                        echo "<td>";
                                        if (!empty($row['file_google_drive'])) {
                                            echo "<a href='" . htmlspecialchars($row['file_google_drive']) . "' class='btn btn-sm btn-primary' target='_blank'><i class='fas fa-file-download'></i> View</a>";
                                        } else {
                                            echo "<span class='text-muted'>Tidak ada file</span>";
                                        }
                                        echo "</td>";
                                        // Aksi
                                        if ($rules === 'Kepala') {
                                            echo "<td>";
                                            echo "<a href='edit_layanan.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-sm btn-warning'><i class='fas fa-edit'></i> Edit</a> ";
                                            echo "<a href='hapus_layanan.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Yakin ingin menghapus data ini?\")'><i class='fas fa-trash'></i> Hapus</a>";
                                            echo "</td>";
                                        }
                                        echo "</tr>";
                                    }
                                } else {
                                    $colspan = ($rules === 'Kepala') ? 8 : 7;
                                    echo "<tr><td colspan='$colspan' class='text-center'>Tidak ada data pelayanan umum dengan status 'Pending'.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
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
    .badge-warning {
        background: #f39c12;
        color: #fff;
        font-size: 0.95rem;
        padding: 6px 16px;
        border-radius: 12px;
    }
    .badge-success {
        background: #27ae60;
        color: #fff;
        font-size: 0.95rem;
        padding: 6px 16px;
        border-radius: 12px;
    }
</style>
<div style="height: 80px;"></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
