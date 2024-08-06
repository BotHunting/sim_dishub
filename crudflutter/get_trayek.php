<?php
header('Content-Type: application/json');
include_once 'koneksi.php';

$nomor_kendaraan = $_GET['nomor_kendaraan'];

if (!$nomor_kendaraan) {
    echo json_encode(['error' => 'Nomor kendaraan tidak diberikan']);
    exit;
}

$sql = "SELECT trayek FROM kendaraan_masuk WHERE nomor_kendaraan = ?";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("s", $nomor_kendaraan);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row['trayek']);
} else {
    echo json_encode(['error' => 'Data tidak ditemukan']);
}

$stmt->close();
$koneksi->close();
?>
