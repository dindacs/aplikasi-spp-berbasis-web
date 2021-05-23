<?php

$kdPembayaran = $_POST['kdPembayaran'];
$nisn = $_POST['nisn'];
$tglBayar = $_POST['tglBayar'];
$blnBayar = $_POST['blnBayar'];
$thnBayar = $_POST['thnBayar'];
$idSpp = $_POST['spp'];
$jmlhBayar = $_POST['jmlhBayar'];

$sqlEditPembayaran = mysqli_query($con, "UPDATE tb_pembayaran SET
id_pembayaran = '$kdPembayaran',
nisn = '$nisn',
tgl_bayar = '$tglBayar',
bulan_dibayar = '$blnBayar',
tahun_dibayar = '$thnBayar',
id_spp = '$idSpp',
jumlah_bayar = '$jmlhBayar'
WHERE id_pembayaran = '$_POST[kdPembayaran]'; ");

if ($sqlEditPembayaran) {
  echo "<script>alert('Data Berhasil Diubah'); document.location='index.php?page=pembayaran&ids=$_POST[nisn]';</script>";
} else {
  echo "<script>alert('Data Gagal Diubah');</script>" . mysqli_error($con);
}
