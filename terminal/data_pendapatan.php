<?php
include_once 'koneksi.php';

$sql = "SELECT DATE_FORMAT(waktu_keberangkatan, '%m') AS bulan, SUM(retribusi) AS total_retribusi 
        FROM kendaraan_keluar 
        WHERE DATE_FORMAT(waktu_keberangkatan, '%Y') = YEAR(CURRENT_DATE()) 
        GROUP BY DATE_FORMAT(waktu_keberangkatan, '%m')";
$result = $koneksi->query($sql);

$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode($data);

$koneksi->close();
