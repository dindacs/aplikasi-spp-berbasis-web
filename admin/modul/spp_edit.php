<?php
$kodeSpp = $_POST["kd_spp"];
$tahun = $_POST["tahun"];
$jenis = $_POST["jenis"];
$nominal = $_POST["nominal"];

$sqlEditSPP = mysqli_query($con, "UPDATE tb_spp SET
id_spp = '$kodeSpp',
tahun = '$tahun',
jenis_pembayaran = '$jenis',
nominal = '$nominal'
WHERE id_spp = '$_POST[idSpp]'; 
");

if ($sqlEditSPP) {
  echo "<script>alert('Data Berhasil Diubah'); document.location='index.php?page=spp_data';</script>";
} else {
  echo "<script>alert('Data Gagal Diubah');</script>" . mysqli_error($con);
}
