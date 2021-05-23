<?php
if ($_GET['hapus'] == 'hapus-spp') {
  $sqlHapusSpp = mysqli_query($con, "DELETE FROM tb_spp WHERE id_spp = '$_GET[id]'");
  if ($sqlHapusSpp) {
    echo "<script>alert('Data Berhasil Dihapus');document.location.href = '?page=spp_data';</script>";
  } else {
    echo "<script>alert('Data Gagal Dihapus');</script>" . mysqli_error($con);
  }
}
