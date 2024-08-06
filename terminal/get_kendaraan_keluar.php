<?php
include_once 'koneksi.php';

$sql = "SELECT * FROM kendaraan_keluar ORDER BY waktu_keberangkatan DESC LIMIT 5";
$result = $koneksi->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['nomor_kendaraan'] . "</td>";
        echo "<td>" . $row['trayek'] . "</td>";
        echo "<td>" . $row['waktu_kedatangan'] . "</td>";
        echo "<td>" . $row['jumlah_penumpang_masuk'] . "</td>";
        echo "<td>" . $row['asal_terminal'] . "</td>";
        echo "<td>" . $row['waktu_keberangkatan'] . "</td>";
        echo "<td>" . $row['jumlah_penumpang_keluar'] . "</td>";
        echo "<td>" . $row['tujuan_terminal'] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='8'>Tidak ada data kendaraan keluar.</td></tr>";
}
