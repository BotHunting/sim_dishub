<?php
header("Access-Control-Allow-Origin: *"); // Izinkan semua asal
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // Izinkan metode yang diperlukan
header("Access-Control-Allow-Headers: Content-Type"); // Izinkan header yang diperlukan

// Kode PHP Anda
$conn = new mysqli("localhost", "root", "", "dishub_sim");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit; // Stop further processing for OPTIONS request
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $nomor_kendaraan = $data['nomor_kendaraan'];
    $trayek = $data['trayek'];
    $waktu_kedatangan = $data['waktu_kedatangan'];
    $jumlah_penumpang_masuk = $data['jumlah_penumpang_masuk'];
    $asal_terminal = $data['asal_terminal'];

    $stmt = $conn->prepare("INSERT INTO kendaraan_masuk (nomor_kendaraan, trayek, waktu_kedatangan, jumlah_penumpang_masuk, asal_terminal) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssds", $nomor_kendaraan, $trayek, $waktu_kedatangan, $jumlah_penumpang_masuk, $asal_terminal);

    if ($stmt->execute()) {
        echo json_encode(['message' => 'Data berhasil disimpan!']);
    } else {
        echo json_encode(['message' => 'Gagal menyimpan data!']);
    }

    $stmt->close();
    $conn->close();
}
?>
