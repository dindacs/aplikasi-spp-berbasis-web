  <?php
  if (isset($_POST['btnTambahKelas'])) {
    function kelas($data)
    {
      global $con;

      $kodeKelas = $data["kd_kelas"];
      $nmKelas = $data["nm_kelas"];
      $komKeahlian = $data["kom_keahlian"];

      // cek kode Kelas sudah ada atau belum
      $result = mysqli_query($con, "SELECT id_kelas FROM tb_kelas WHERE id_kelas = '$kodeKelas'");
      if (mysqli_fetch_assoc($result)) {
        echo "<script>alert('Kode Kelas Sudah Terdaftar!! Coba Lagi..');</script>";
        return false;
      }

      // Input Kelas
      mysqli_query($con, "INSERT INTO tb_kelas VALUES ('$kodeKelas','$nmKelas','$komKeahlian')");
      return mysqli_affected_rows($con);
    }

    if (kelas($_POST) > 0) {
      echo "<script>alert('Data Berhasil Ditambahkan');document.location='?page=kelas_data';</script>";
    } else {
      echo "<script>alert('Data Gagal Ditambahkan');document.location='?page=kelas_data';</script>" . mysqli_error($con);
    }
  } // punyanya btn
  ?>