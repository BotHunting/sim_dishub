<?php
include_once 'koneksi.php';

$sql = "SELECT * FROM kendaraan_masuk ORDER BY waktu_kedatangan DESC LIMIT 5";
$result = $koneksi->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['nomor_kendaraan'] . "</td>";
        echo "<td>" . $row['trayek'] . "</td>";
        echo "<td>" . $row['waktu_kedatangan'] . "</td>";
        echo "<td>" . $row['jumlah_penumpang_masuk'] . "</td>";
        echo "<td>" . $row['asal_terminal'] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>Tidak ada data kendaraan masuk.</td></tr>";
}
