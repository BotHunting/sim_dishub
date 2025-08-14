<?php include_once 'header.php'; ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h2 class="mb-4 text-center text-primary">Surat Perintah Tugas</h2>
                    <?php if ($rules !== 'Staff') : ?>
                        <div class="d-flex justify-content-end mb-3 gap-2">
                            <a href="tambah_pengawasan.php" class="btn btn-gradient me-2">
                                <i class="fas fa-plus"></i> Tambah SPT
                            </a>
                            <a href="riwayat_spt.php" class="btn btn-gradient">
                                <i class="fas fa-history"></i> Riwayat SPT
                            </a>
                        </div>
                    <?php endif; ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover bg-white">
                            <thead class="thead-light">
                                <tr>
                                    <th>No.</th>
                                    <th>Nomor Surat</th>
                                    <th>Jenis SPT</th>
                                    <th>Tanggal</th>
                                    <th>Deskripsi</th>
                                    <th>Status</th>
                                    <th>Lampiran</th>
                                    <?php if ($rules !== 'Staff') echo '<th>Aksi</th>'; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include_once 'koneksi.php';
                                $sql = "SELECT * FROM pengawasan WHERE status IN ('Pending', 'Rejected') ORDER BY tanggal DESC";
                                $stmt = $koneksi->prepare($sql);
                                $stmt->execute();
                                $result = $stmt->get_result();

                                if ($result->num_rows > 0) {
                                    $no = 1;
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $no++ . "</td>";
                                        echo "<td>" . htmlspecialchars($row['nomor_surat']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['jenis_pengawasan']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['tanggal']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['deskripsi']) . "</td>";
                                        // Status badge
                                        $badgeClass = $row['status'] === 'Pending' ? 'badge-warning' : 'badge-danger';
                                        echo "<td><span class='badge $badgeClass'>" . htmlspecialchars($row['status']) . "</span></td>";
                                        // Lampiran
                                        echo "<td>";
                                        if (!empty($row['file_google_drive'])) {
                                            echo "<a href='" . htmlspecialchars($row['file_google_drive']) . "' class='btn btn-info btn-sm' target='_blank'><i class='fas fa-file-download'></i> View</a>";
                                        } else {
                                            echo "<span class='text-muted'>Tidak ada lampiran</span>";
                                        }
                                        echo "</td>";
                                        // Aksi
                                        if ($rules !== 'Staff') {
                                            echo "<td>";
                                            echo "<a href='edit_pengawasan.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-sm btn-warning me-1'><i class='fas fa-edit'></i> Edit</a> ";
                                            echo "<a href='hapus_pengawasan.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Yakin ingin menghapus data ini?\")'><i class='fas fa-trash'></i> Hapus</a>";
                                            echo "</td>";
                                        }
                                        echo "</tr>";
                                    }
                                } else {
                                    $colspan = ($rules !== 'Staff') ? 8 : 7;
                                    echo "<tr><td colspan='$colspan' class='text-center'>Tidak ada data pengawasan dengan status 'Pending' atau 'Rejected'.</td></tr>";
                                }
                                $stmt->close();
                                $koneksi->close();
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
    .badge-danger {
        background: #e74c3c;
        color: #fff;
        font-size: 0.95rem;
        padding: 6px 16px;
        border-radius: 12px;
    }
    .table th, .table td {
        vertical-align: middle;
    }
    .me-1 { margin-right: 0.25rem; }
    .me-2 { margin-right: 0.5rem; }
    .gap-2 > * { margin-left: 0.5rem; }
    .gap-2 > *:first-child { margin-left: 0; }
</style>
<div style="height: 80px;"></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
