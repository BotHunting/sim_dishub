<?php
require('fpdf/fpdf.php');

// Jika tidak ada data POST, redirect ke halaman utama atau berikan pesan error
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: mutasi_masuk.php");
    exit;
}

// Ambil data dari POST
$nomor_surat = $_POST['nomor_surat'];
$sk_mutasi = $_POST['sk_mutasi'];
$tgl_skmutasi = $_POST['tgl_skmutasi'];
$nomor_uji = $_POST['nomor_uji'];
$nomor_kendaraan = $_POST['nomor_kendaraan'];
$nama_pemilik = $_POST['nama_pemilik'];
$alamat_pemilik = $_POST['alamat_pemilik'];
$jenis_kendaraan = $_POST['jenis_kendaraan'];
$merk = $_POST['merk'];
$type = $_POST['type'];
$tahun = $_POST['tahun'];
$nomor_rangka = $_POST['nomor_rangka'];
$nomor_mesin = $_POST['nomor_mesin'];
$bahan_bakar = $_POST['bahan_bakar'];
$perakit = $_POST['perakit'];
$panjang_total = $_POST['panjang_total'];
$lebar_total = $_POST['lebar_total'];
$tinggi_total = $_POST['tinggi_total'];
$roh = $_POST['roh'];
$foh = $_POST['foh'];
$s1_s2 = $_POST['s1_s2'];
$s2_s3 = $_POST['s2_s3'];
$s3_s4 = $_POST['s3_s4'];
$s4_s5 = $_POST['s4_s5'];
$isi_silinder = $_POST['isi_silinder'];
$daya_motor = $_POST['daya_motor'];
$jbb = $_POST['jbb'];
$konfig_sumbu = $_POST['konfig_sumbu'];
$bentuk_kendaraan = $_POST['bentuk_kendaraan'];
$sifat = $_POST['sifat'];
$bahan_utama = $_POST['bahan_utama'];
$jenis_karoseri = $_POST['jenis_karoseri'];
$kursi = $_POST['kursi'];
$pejabat = $_POST['pejabat'];

// Instansiasi class FPDF
$pdf = new FPDF();
$pdf->AddPage();

// Judul
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Form Mutasi Masuk', 0, 1, 'C');

// Tampilkan data yang diambil dari POST
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, "Nomor Surat: $nomor_surat", 0, 1);
$pdf->Cell(0, 10, "SK Mutasi: $sk_mutasi", 0, 1);
$pdf->Cell(0, 10, "Tanggal SK Mutasi: $tgl_skmutasi", 0, 1);
$pdf->Cell(0, 10, "Nomor Uji: $nomor_uji", 0, 1);
$pdf->Cell(0, 10, "Nomor Kendaraan: $nomor_kendaraan", 0, 1);
$pdf->Cell(0, 10, "Nama Pemilik: $nama_pemilik", 0, 1);
$pdf->Cell(0, 10, "Alamat Pemilik: $alamat_pemilik", 0, 1);
$pdf->Cell(0, 10, "Jenis Kendaraan: $jenis_kendaraan", 0, 1);
$pdf->Cell(0, 10, "Merk: $merk", 0, 1);
$pdf->Cell(0, 10, "Type: $type", 0, 1);
$pdf->Cell(0, 10, "Tahun: $tahun", 0, 1);
$pdf->Cell(0, 10, "Nomor Rangka: $nomor_rangka", 0, 1);
$pdf->Cell(0, 10, "Nomor Mesin: $nomor_mesin", 0, 1);
$pdf->Cell(0, 10, "Bahan Bakar: $bahan_bakar", 0, 1);
$pdf->Cell(0, 10, "Perakit: $perakit", 0, 1);
$pdf->Cell(0, 10, "Panjang Total: $panjang_total", 0, 1);
$pdf->Cell(0, 10, "Lebar Total: $lebar_total", 0, 1);
$pdf->Cell(0, 10, "Tinggi Total: $tinggi_total", 0, 1);
$pdf->Cell(0, 10, "ROH: $roh", 0, 1);
$pdf->Cell(0, 10, "FOH: $foh", 0, 1);
$pdf->Cell(0, 10, "S1-S2: $s1_s2", 0, 1);
$pdf->Cell(0, 10, "S2-S3: $s2_s3", 0, 1);
$pdf->Cell(0, 10, "S3-S4: $s3_s4", 0, 1);
$pdf->Cell(0, 10, "S4-S5: $s4_s5", 0, 1);
$pdf->Cell(0, 10, "Isi Silinder: $isi_silinder", 0, 1);
$pdf->Cell(0, 10, "Daya Motor: $daya_motor", 0, 1);
$pdf->Cell(0, 10, "JBB: $jbb", 0, 1);
$pdf->Cell(0, 10, "Konfigurasi Sumbu: $konfig_sumbu", 0, 1);
$pdf->Cell(0, 10, "Bentuk Kendaraan: $bentuk_kendaraan", 0, 1);
$pdf->Cell(0, 10, "Sifat: $sifat", 0, 1);
$pdf->Cell(0, 10, "Bahan Utama: $bahan_utama", 0, 1);
$pdf->Cell(0, 10, "Jenis Karoseri: $jenis_karoseri", 0, 1);
$pdf->Cell(0, 10, "Kursi: $kursi", 0, 1);
$pdf->Cell(0, 10, "Pejabat: $pejabat", 0, 1);

// Output file PDF
$pdf->Output();
?>
