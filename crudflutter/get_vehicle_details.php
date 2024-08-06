<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *"); // Mengizinkan permintaan dari semua domain
header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); // Mengizinkan metode HTTP tertentu
header("Access-Control-Allow-Headers: Content-Type"); // Mengizinkan header tertentu

// Menghubungkan ke database
include_once 'koneksi.php';

// Memastikan nomor kendaraan diambil dari parameter URL
if (!isset($_GET['nomor_kendaraan'])) {
    echo json_encode(["error" => "Nomor kendaraan tidak diberikan"]);
    exit();
}

$nomorKendaraan = $koneksi->real_escape_string($_GET['nomor_kendaraan']);

// Query untuk mendapatkan detail kendaraan
$sql = "SELECT * FROM kendaraan_masuk WHERE nomor_kendaraan = '$nomorKendaraan'";
$result = $koneksi->query($sql);

if ($result->num_rows > 0) {
    // Mengambil data dari hasil query
    $data = $result->fetch_assoc();
    
    // Menyusun data yang akan dikirimkan
    $response = [
        'trayek' => $data['trayek'],
        'waktu_kedatangan' => $data['waktu_kedatangan'],
        'jumlah_penumpang_masuk' => $data['jumlah_penumpang_masuk'],
        'asal_terminal' => $data['asal_terminal']
    ];
    
    // Mengirimkan data dalam format JSON
    echo json_encode($response);
} else {
    // Jika tidak ditemukan data
    echo json_encode(["error" => "Data kendaraan tidak ditemukan"]);
}

// Menutup koneksi database
$koneksi->close();
?>
