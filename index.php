<?php
session_start();
include 'lib/koneksi.php';

// ambil dari login
if (!isset($_SESSION["siswa"])) {
  header("Location: welcome.php");
}

$nisn = $_SESSION["siswa"];
$sql = mysqli_query($con, "SELECT * FROM tb_siswa WHERE nisn = '$nisn'");
$vsiswa = $sql->fetch_array();
?>

<!DOCTYPE html>
<html lang="en" id="home">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- css -->
  <link rel="stylesheet" href="asset/css/bootstrap.min.css">
  <link rel="stylesheet" href="asset/css/style.css">
  <link rel="stylesheet" href="asset/font/css/font-awesome.min.css">
  <!-- javascript -->
  <script type="text/javascript" src="asset/js/jquery.js"></script>
  <script type="text/javascript" src="asset/js/bootstrap.min.js"></script>
  <title>Pembayaran SPP | Siswa</title>
</head>

<body>
  <nav class="navbar header-area navbar-expand-sm border-0 bg-danger">
    <a class="navbar-brand" href="#">
      <img src="image/smk.png" alt="Logo" width="40">
    </a>
    <a href="?page=beranda" class="navbar-brand text-white page-scroll">
      <h4 class="text-white pt-2">Pembayaran SPP</h4>
    </a>
    <button class=" navbar-toggler border" type="button" data-toggle="collapse" data-target="#slide" aria-controls="slide" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"><i class="fa fa-bars-white"></i></span>
    </button>

    <nav class="collapse navbar-collapse w-100" id="slide">
      <ul class="navbar-nav d-sm-none pl-4">
        <li class="nav-item">
          <a href="?page=beranda" class="nav-link text-white">Beranda</a>
        </li>
        <li class="nav-item">
          <a href="?page=profil_user" class="nav-link text-white">Profil Anda</a>
        </li>
        <li class="nav-item">
          <a href="?page=beranda#faqStat" class="nav-link text-white">FAQ</a>
        </li>
        <li class="nav-item">
          <a href="?page=logout" class="nav-link text-white">Logout</a>
        </li>
      </ul>
    </nav>

    <div class="container d-none d-sm-block">
      <ul class="navbar-nav nav-hover sticky-top float-right">
        <li class="nav-item">
          <a href="?page=beranda" class="nav-link page-scroll text-white"><i class="fa fa-dashboard"></i> Beranda</a>
        </li>
        <li class="nav-item">
          <a href="?page=logout" onclick="return confirm('Apa Anda Akan Keluar?')" class="nav-link page-scroll text-white"><i class="fa fa-sign-out"></i> Logout</a>
        </li>
      </ul>
    </div>
  </nav>
  <!-- end navigasi -->

  <?php
  $page = $_GET['page'];
  switch ($page) {
    case "beranda";
      include "modul/beranda.php";
      break;
    case "logout";
      include "logout.php";
      break;
  }
  ?>

</body>

</html>