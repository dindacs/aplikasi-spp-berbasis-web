<?php
if ($_GET['hapus'] == 'hapus-kelas') {
  $sqlhapusKelas = mysqli_query($con, "DELETE FROM tb_kelas WHERE id_kelas = '$_GET[id]'");
  if ($sqlhapusKelas) {
    echo "<script>alert('Data Berhasil Dihapus');document.location.href = '?page=kelas_data';</script>";
  } else {
    echo "<script>alert('Data Gagal Dihapus');</script>";
  }
}
