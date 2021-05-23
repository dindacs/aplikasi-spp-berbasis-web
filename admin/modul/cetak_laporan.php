<?php
session_start();
//menyertakan file fpdf
include '../../lib/koneksi.php';
include "../fpdf/fpdf.php";

$pdf = new FPDF("L", "mm", "A4");
// membuat halaman baru
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 16);
// judul
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(290, 10, 'SMK GENERASI MADANI', 0, 1, 'C');

// tulisan LAPORAN PEMBAYARAN
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(290, 4, 'LAPORAN PEMBAYARAN SPP BULANAN', 0, 1, 'C');

$pdf->Cell(10, 7, '', 0, 1, 'C');

// tabel hasil pembayaran
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(15, 7, 'NO', 1, 0, 'C');
$pdf->Cell(40, 7, 'KODE BAYAR', 1, 0, 'C');
$pdf->Cell(30, 7, 'NISN', 1, 0, 'C');
$pdf->Cell(40, 7, 'NAMA SISWA', 1, 0, 'C');
$pdf->Cell(35, 7, 'BULAN DIBAYAR', 1, 0, 'C');
$pdf->Cell(40, 7, 'TANGGAL BAYAR', 1, 0, 'C');
$pdf->Cell(40, 7, 'JUMLAH BAYAR', 1, 0, 'C');
$pdf->Cell(40, 7, 'STATUS', 1, 1, 'C');

$pdf->SetFont('Arial', '', 10);

setlocale(LC_ALL, 'id-ID', 'id_ID');
$no = 1;
$sqlTampil = mysqli_query($con, "SELECT*FROM tb_pembayaran 
INNER JOIN tb_petugas ON tb_pembayaran.id_petugas = tb_petugas.id_petugas
INNER JOIN tb_siswa ON tb_pembayaran.nisn = tb_siswa.nisn 
INNER JOIN tb_spp ON tb_pembayaran.id_spp = tb_spp.id_spp") or die(mysqli_error($con));
while ($rsHasilnya = mysqli_fetch_array($sqlTampil)) {
  $pdf->Cell(15, 7, $no++, 1, 0, 'C');
  $pdf->Cell(40, 7, $rsHasilnya['id_pembayaran'], 1, 0, 'C');
  $pdf->Cell(30, 7, $rsHasilnya['nisn'], 1, 0, 'C');
  $pdf->Cell(40, 7, $rsHasilnya['nama'], 1, 0, 'C');
  $pdf->Cell(35, 7, $rsHasilnya['bulan_dibayar'], 1, 0, 'C');
  $pdf->Cell(40, 7, strftime("%d %B %Y", strtotime($rsHasilnya['tgl_bayar'])), 1, 0, 'C');
  $pdf->Cell(40, 7, number_format($rsHasilnya['jumlah_bayar']), 1, 0, 'C');
  if ($rsHasilnya['jumlah_bayar'] == '200000') {
    $pdf->Cell(40, 7, 'Lunas', 1, 1, 'C');
  } elseif ($rsHasilnya['jumlah_bayar'] <= '200000') {
    $pdf->Cell(40, 7, 'Tertunggak', 1, 1, 'C');
  } else {
    $pdf->Cell(40, 7, 'Kelebihan', 1, 1, 'C');
  }
}

// untuk total
$sqlTampilTotal = mysqli_query($con, "SELECT sum(jumlah_bayar) AS total FROM tb_pembayaran") or die(mysqli_error($con));
$rvTampilTotal = $sqlTampilTotal->fetch_array();

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(200, 7, 'Total', 1, 0, 'C');
$pdf->Cell(40, 7, number_format($rvTampilTotal['total']), 1, 0, 'R');
$pdf->Cell(40, 7, '', 1, 1);

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
