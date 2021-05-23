<?php
if (isset($_POST['btnTambahSiswa'])) {
  function siswa($data)
  {
    global $con;

    $nisn = $data["nisn"];
    $nis = $data["nis"];
    $nm = $data["nama"];
    $kls = $data["kelas"];
    $kom = $data["kom_keahlian"];
    $almt = $data["alamat"];
    $telp = $data["no_telp"];
    $spp = $data['spp'];


    // cek Nisn sudah ada atau belum
    $resultNisn = mysqli_query($con, "SELECT nisn FROM tb_siswa WHERE nisn = '$nisn'");
    if (mysqli_fetch_assoc($resultNisn)) {
      echo "<script>alert('Nisn Siswa Sudah Terdaftar!! Coba Lagi..');</script>";
      return false;
    }

    // cek Nis sudah ada atau belum
    $resultNis = mysqli_query($con, "SELECT nis FROM tb_siswa WHERE nis = '$nis'");
    if (mysqli_fetch_assoc($resultNis)) {
      echo "<script>alert('Nis Siswa Sudah Terdaftar!! Coba Lagi..');</script>";
      return false;
    }

    mysqli_query($con, "INSERT INTO tb_siswa VALUES ('$nisn','$nis','$nm','$kls','$kom','$almt','$telp','$spp')");
    return mysqli_affected_rows($con);
  } // punya function siswa

  if (siswa($_POST) > 0) {
    echo "<script>alert('Data Berhasil Ditambahkan');document.location='?page=siswa_data';</script>";
  } else {
    echo "<script>alert('Data Gagal Ditambahkan');</script>" . mysqli_error($con);
  }
} // punya isset btn
