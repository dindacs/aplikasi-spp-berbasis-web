<?php
//menyertakan file fpdf
session_start();
include '../../lib/koneksi.php';
include "../fpdf/fpdf.php";

$sqlTampil = mysqli_query($con, "SELECT*FROM tb_pembayaran 
INNER JOIN tb_siswa ON tb_pembayaran.nisn = tb_siswa.nisn 
WHERE tb_pembayaran.nisn = '$_GET[id]'") or die(mysqli_error($con));
$rsHasil = $sqlTampil->fetch_array();

$pdf = new FPDF("L", "mm", "A4");
// membuat halaman baru
$pdf->AddPage();

// judul
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(290, 7, 'SMK GENERASI MADANI', 0, 1, 'C');

// tulisan bukti pembayaran
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(290, 6, 'BUKTI PEMBAYARAN', 0, 1, 'C');

// Beri jarak vertikal dari bukti pembayaran ke biodata siswa
// $pdf->Cell(10, 4, '', 0, 1, 'C');
$pdf->Cell(59, 4, '', 0, 1);

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(16, 6, 'Nisn :', 0, 0);
$pdf->Cell(15, 6, $rsHasil['nisn'], 0, 1);

$pdf->Cell(16, 6, 'Nama :', 0, 0);
$pdf->Cell(15, 6, $rsHasil['nama'], 0, 1);

$pdf->Cell(16, 6, 'Kelas :', 0, 0);
$pdf->Cell(6, 6, $rsHasil['id_kelas'], 0, 0);
$pdf->Cell(15, 6, $rsHasil['kom_keahlian'], 0, 1);

// beri jarak vertikal
$pdf->Cell(189, 5, '', 0, 1);

// tabel hasil pembayaran
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(15, 6, 'NO', 1, 0, 'C');
$pdf->Cell(40, 6, 'KODE BAYAR', 1, 0, 'C');
$pdf->Cell(55, 6, 'JENIS PEMBAYARAN', 1, 0, 'C');
$pdf->Cell(45, 6, 'BULAN DIBAYAR', 1, 0, 'C');
$pdf->Cell(40, 6, 'TANGGAL BAYAR', 1, 0, 'C');
$pdf->Cell(40, 6, 'JUMLAH BAYAR', 1, 0, 'C');
$pdf->Cell(40, 6, 'STATUS', 1, 1, 'C');

$pdf->SetFont('Arial', '', 10);

setlocale(LC_ALL, 'id-ID', 'id_ID');
$no = 0;
$sqlTampil = mysqli_query($con, "SELECT*FROM tb_pembayaran 
INNER JOIN tb_siswa ON tb_pembayaran.nisn = tb_siswa.nisn 
INNER JOIN tb_spp ON tb_pembayaran.id_spp = tb_spp.id_spp
WHERE tb_pembayaran.nisn = '$_GET[id]'") or die(mysqli_error($con));
while ($rsHasilnya = $sqlTampil->fetch_array()) {
  $pdf->Cell(15, 6, $no = $no + 1, 1, 0, 'C');
  $pdf->Cell(40, 6, $rsHasilnya['id_pembayaran'], 1, 0, 'C');
  $pdf->Cell(55, 6, $rsHasilnya['jenis_pembayaran'], 1, 0, 'C');
  $pdf->Cell(45, 6, $rsHasilnya['bulan_dibayar'], 1, 0, 'C');
  $pdf->Cell(40, 6, strftime("%d %B %Y", strtotime($rsHasilnya['tgl_bayar'])), 1, 0, 'C');
  $pdf->Cell(40, 6, number_format($rsHasilnya['jumlah_bayar']), 1, 0, 'C');
  if ($rsHasilnya['jumlah_bayar'] == '200000') {
    $pdf->Cell(40, 6, 'Lunas', 1, 1, 'C');
  } elseif ($rsHasilnya['jumlah_bayar'] <= '200000') {
    $pdf->Cell(40, 6, 'Tertunggak', 1, 1, 'C');
  } else {
    $pdf->Cell(40, 6, 'Kelebihan', 1, 1, 'C');
  }
}

// untuk total
$sqlTampilTotal = mysqli_query($con, "SELECT nisn, sum(jumlah_bayar) AS total FROM tb_pembayaran WHERE nisn = '$_GET[id]'") or die(mysqli_error($con));
$rvTampilTotal = $sqlTampilTotal->fetch_array();

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(195, 7, 'Total', 1, 0, 'C');
$pdf->Cell(40, 7, number_format($rvTampilTotal['total']), 1, 0, 'R');
$pdf->Cell(40, 7, '', 1, 1, 'R');

// untuk Tanggal dan ttd petugas
date_default_timezone_set("Asia/Jakarta");

// beri jarak vertikal
$pdf->Cell(10, 8, '', 0, 1,);
$pdf->SetFont('Arial', '', 11);
// beri jarak horizontal
$pdf->Cell(230, 0, '', 0, 0);
$pdf->Cell(13, 0, 'Bogor,', 0, 0);
$pdf->Cell(34, 0, strftime("%d %B %Y"), 0, 1);

// nama petugas yang mencetak
$petugas = $_SESSION['namaPetugas'];
$sqlp = mysqli_query($con, "SELECT * FROM tb_petugas WHERE nama_petugas = '$petugas'");
$vPetugas = $sqlp->fetch_array();

$pdf->Cell(215, 45, '', 0, 0);
$pdf->Cell(45, 40, $vPetugas['nama_petugas'], 0, 0, 'R');


$pdf->Output();
