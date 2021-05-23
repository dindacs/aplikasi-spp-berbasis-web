<?php
function spp($data)
{
  global $con;


  $kdPembayaran = $data["kdPembayaran"];
  $idPetugas = $data["idPetugas"];
  $nisn = $data["nisn"];
  $tglBayar = $data["tglBayar"];
  $blnBayar = $data["blnBayar"];
  $thnBayar = $data["thnBayar"];
  $idSpp = $data["spp"];
  $jmlhBayar = $data["jmlhBayar"];

  // cek kode Kelas sudah ada atau belum
  $result = mysqli_query($con, "SELECT id_pembayaran, nisn FROM tb_pembayaran WHERE id_pembayaran = '$kdPembayaran'");
  if ($v = mysqli_fetch_assoc($result)) {
    echo "<script>alert('Kode SPP Sudah Terdaftar!! Coba Lagi..');</script>";
    return false;
  }

  // Input Kelas
  mysqli_query($con, "INSERT INTO tb_pembayaran VALUES ('$kdPembayaran','$idPetugas','$nisn','$tglBayar','$blnBayar','$thnBayar','$idSpp','$jmlhBayar')");
  return mysqli_affected_rows($con);
}

// cek apakah tombol kelas sudah di klik
if (isset($_POST['btnTambahPem'])) {
  if (spp($_POST) > 0) {
    echo "<script>alert('Data Berhasil Ditambahkan');document.location.href='?page=pembayaran&ids=$_POST[nisn]';</script>";
  } else {
    echo "<script>alert('Data Gagal Ditambahkan');</script>" . mysqli_error($con);
  }
}
