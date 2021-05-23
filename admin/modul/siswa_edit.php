<?php

$nisn = $_POST['nisn'];
$nis = $_POST['nis'];
$nama = $_POST['nama'];
$kelas = $_POST['kelas'];
$jurusan = $_POST['jurusan'];
$alamat = $_POST['almt'];
$telp = $_POST['telp'];
$spp = $_POST['spp'];

$sqlEditKelas = mysqli_query($con, "UPDATE tb_siswa SET
nisn = '$nisn',
nis = '$nis',
nama = '$nama',
id_kelas = '$kelas',
kom_keahlian = '$jurusan',
alamat = '$alamat',
no_telp = '$telp',
id_spp = '$spp'
WHERE nisn = '$_POST[nisn]'; ");

if ($sqlEditKelas) {
  echo "<script>alert('Data Berhasil Diubah'); document.location='index.php?page=siswa_data';</script>";
} else {
  echo "<script>alert('Data Gagal Diubah');</script>" . mysqli_error($con);
}
