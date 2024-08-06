<?php
header("Access-Control-Allow-Origin: *"); // Atur sesuai dengan domain yang diizinkan
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");

include_once 'koneksi.php'; // File koneksi database

// Mendapatkan data POST
$nomor_kendaraan = isset($_POST['nomor_kendaraan']) ? $_POST['nomor_kendaraan'] : '';
$trayek = isset($_POST['trayek']) ? $_POST['trayek'] : '';
$waktu_kedatangan = isset($_POST['waktu_kedatangan']) ? $_POST['waktu_kedatangan'] : '';
$jumlah_penumpang_masuk = isset($_POST['jumlah_penumpang_masuk']) ? (int)$_POST['jumlah_penumpang_masuk'] : 0;
$asal_terminal = isset($_POST['asal_terminal']) ? $_POST['asal_terminal'] : '';
$waktu_keberangkatan = isset($_POST['waktu_keberangkatan']) ? $_POST['waktu_keberangkatan'] : '';
$jumlah_penumpang_keluar = isset($_POST['jumlah_penumpang_keluar']) ? (int)$_POST['jumlah_penumpang_keluar'] : 0;
$tujuan_terminal = isset($_POST['tujuan_terminal']) ? $_POST['tujuan_terminal'] : '';
$retribusi = isset($_POST['retribusi']) ? (int)$_POST['retribusi'] : 0;

// Validasi data
if (empty($nomor_kendaraan) || empty($trayek) || empty($waktu_kedatangan) || empty($asal_terminal) || empty($waktu_keberangkatan) || empty($tujuan_terminal)) {
    echo json_encode(["message" => "Semua field harus diisi"]);
    http_response_code(400); // Bad Request
    exit();
}

// Menyimpan data ke database
$sql = "INSERT INTO kendaraan_keluar (nomor_kendaraan, trayek, waktu_kedatangan, jumlah_penumpang_masuk, asal_terminal, waktu_keberangkatan, jumlah_penumpang_keluar, tujuan_terminal, retribusi) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $koneksi->prepare($sql);
$stmt->bind_param(
    "sssissssi",
    $nomor_kendaraan,
    $trayek,
    $waktu_kedatangan,
    $jumlah_penumpang_masuk,
    $asal_terminal,
    $waktu_keberangkatan,
    $jumlah_penumpang_keluar,
    $tujuan_terminal,
    $retribusi
);

if ($stmt->execute()) {
    echo json_encode(["message" => "Data kendaraan keluar berhasil disimpan."]);
    http_response_code(200); // OK
} else {
    echo json_encode(["message" => "Terjadi kesalahan saat menyimpan data: " . $stmt->error]);
    http_response_code(500); // Internal Server Error
}

$stmt->close();
$koneksi->close();
?>
