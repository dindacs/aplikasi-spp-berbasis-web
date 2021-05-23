<?php
if ($_GET['hapus'] == 'hapus-siswa') {
  $sqlHapusSiswa = mysqli_query($con, "DELETE FROM tb_siswa WHERE nisn = '$_GET[id]'");
  if ($sqlHapusSiswa) {
    echo "<script>alert('Data Berhasil Dihapus');document.location.href = '?page=siswa_data';</script>";
  } else {
    echo "<script>alert('Data Gagal Dihapus');</script>" . mysqli_error($con);
  }
}
