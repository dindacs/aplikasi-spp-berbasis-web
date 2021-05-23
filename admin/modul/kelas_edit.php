<?php

$kdKelas = $_POST['kdKelas'];
$nmKelas = $_POST['nm_kelas'];
$komKeahlian = $_POST['kom_keahlian'];

$sqlEditKelas = mysqli_query($con, "UPDATE tb_kelas SET
id_kelas = '$kdKelas',
nama_kelas = '$nmKelas',
kompetensi_keahlian = '$komKeahlian'
WHERE id_kelas = '$_POST[idKelas]'; ");

if ($sqlEditKelas) {
  echo "<script>alert('Data Berhasil Diubah'); document.location='index.php?page=kelas_data';</script>";
} else {
  echo "<script>alert('Data Gagal Diubah');</script>" . mysqli_error($con);
}
