<?php
function spp($data)
{
  global $con;


  $kodeSpp = $data["kd_spp"];
  $tahun = $data["tahun"];
  $jenis = $data["jenis"];
  $nominal = $data["nominal"];

  // cek kode Kelas sudah ada atau belum
  $result = mysqli_query($con, "SELECT id_spp FROM tb_spp WHERE id_spp = '$kodeSpp'");
  if (mysqli_fetch_assoc($result)) {
    echo "<script>alert('Kode SPP Sudah Terdaftar!! Coba Lagi..');</script>";
    return false;
  }

  // Input Kelas
  mysqli_query($con, "INSERT INTO tb_spp VALUES ('$kodeSpp','$tahun','$jenis','$nominal')");
  return mysqli_affected_rows($con);
}

// cek apakah tombol kelas sudah di klik
if (isset($_POST['btnTambahSpp'])) {
  if (spp($_POST) > 0) {
    echo "<script>alert('Data Berhasil Ditambahkan');document.location='?page=spp_data';</script>";
  } else {
    echo "<script>alert('Data Gagal Ditambahkan');document.location='?page=spp_data';</script>" . mysqli_error($con);
  }
}
