<?php
session_start();
include '../lib/koneksi.php';

if (!isset($_SESSION['admin'])) {
  header("location:../welcome.php");
  exit;
}

$petugas = $_SESSION['admin'];
$sqlp = mysqli_query($con, "SELECT * FROM tb_petugas WHERE username = '$petugas'");
$vPetugas = $sqlp->fetch_array();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pembayaran SPP</title>
  <!-- css -->
  <link rel="stylesheet" href="asset/css/bootstrap.min.css">
  <link rel="stylesheet" href="asset/css/style.css">
  <link rel="stylesheet" href="asset/font/css/font-awesome.min.css">
  <link rel="stylesheet" href="asset/datepicker/css/datepicker.css">
</head>

<body>
  <nav class="navbar navbar-expand-sm navbar-light sticky-top bg-light border-bottom">

    <a class="navbar-brand" href="#">
      <img src="images/smk.png" alt="Logo" style="width:40px;">
    </a>
    <a href="?page=dashboard" class="navbar-brand text-primary pt-2">
      <h4>Pembayaran SPP</h4>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"><i class="fa fa-bars-white"></i></span>
    </button>

    <!-- UNTUK TAMPILAN MOBILE -->
    <nav class="collapse navbar-collapse" id="sidebar">
      <ul class="navbar-nav d-sm-none">
        <li class="nav-item">
          <span class="text-dark">
            <img src="images/default.svg" class="img img-responsive rounded-circle" width="24" height="24">
            <?= $vPetugas['nama_petugas']; ?> (<?= $_SESSION['level']; ?>)
          </span>
        </li>
        <li class="nav-item">
          <a href="?page=dashboard" class="nav-link text-dark">
            <i class="fa fa-home"></i> Dashboard
          </a>
        </li>
        <li class="nav-item mb-2">
          <div class="sidenav">
            <button class="dropdown-btn text-dark border-0">
              <i class="fa fa-user"></i> Siswa
              <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-container">
              <a href="?page=siswa_data" class="nav-link text-primary">
                <i class="fa fa-users"></i> Data Siswa
              </a>
              <a href="?page=kelas_data" class="nav-link text-primary">
                <i class="fa fa-address-book"></i> Data Kelas
              </a>
            </div>
          </div>
        </li>
        <li class="nav-item">
          <div class="sidenav">
            <button class="dropdown-btn text-dark border-0">
              <i class="fa fa-bank"></i> Transaksi
              <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-container">
              <!-- <a href="?page=pembayaran" class="nav-link text-primary">
                <i class="fa fa-sign-in"></i> Pembayaran
              </a> -->
              <a href="?page=spp_data" class="nav-link text-primary">
                <i class="fa fa-archive"></i> Data SPP
              </a>
              <a href="?page=laporan" class="nav-link text-primary">
                <i class="fa fa-history"></i> Laporan
              </a>
            </div>
          </div>
        </li>
        <li class="nav-item">
          <a href="?page=petugas_data" class="nav-link text-dark">
            <i class="fa fa-desktop"></i> Data Petugas
          </a>
        </li>
        <li class="nav-item">
          <a href="?page=logout" class="nav-link text-dark">
            <i class="fa fa-sign-out"></i> Keluar
          </a>
        </li>
      </ul>
    </nav>
  </nav>
  <!-- UNTUK TAMPILAN MOBILE -->

  <!-- sidebar -->
  <!-- sidebar -->
  <div class="container-fluid h-100">
    <div class="row h-100">
      <nav class="col-md-2 col-sm-3 bg-light h-100 p-0 position-fixed d-none d-sm-block">
        <ul class="list-group list-group-flush">
          <li class="list-group-item bg-light">
            <div href="?page=petugas" class="nav-link text-primary d-flex justify-content-center">
              <img src="images/user.png" class="img img-responsive rounded-circle ml-2" width="70" height="70">
            </div>
            <h6 class="text-primary d-flex justify-content-center"><?= $vPetugas['nama_petugas']; ?></h6>
            <h6 class="text-primary d-flex justify-content-center">(<?= $_SESSION['level']; ?>)</h6>
          </li>
          <li class="list-group-item bg-light">
            <a href="?page=dashboard" class="nav-link text-dark">
              <i class="fa fa-dashboard"></i> Dashboard
            </a>
          </li>
          <li class="list-group-item bg-light">
            <div class="sidenav" style="padding: 6px 8px 6px 17px;">
              <button class="dropdown-btn text-dark border-0">
                <i class="fa fa-user"></i> Siswa
                <i class="fa fa-caret-down"></i>
              </button>
              <div class="dropdown-container">
                <a href="?page=siswa_data" class="nav-link text-dark">
                  <i class="fa fa-users"></i> Data Siswa
                </a>
                <a href="?page=kelas_data" class="nav-link text-dark">
                  <i class="fa fa-address-book"></i> Data Kelas
                </a>
              </div>
            </div>
          </li>
          <li class="list-group-item bg-light">
            <div class="sidenav" style="padding: 6px 8px 6px 17px;">
              <button class="dropdown-btn text-dark border-0">
                <i class="fa fa-bank"></i> Transaksi
                <i class="fa fa-caret-down"></i>
              </button>
              <div class="dropdown-container">
                <!-- <a href="?page=pembayaran" class="nav-link text-dark">
                  <i class="fa fa-sign-in"></i> Pembayaran
                </a> -->
                <a href="?page=spp_data" class="nav-link text-dark">
                  <i class="fa fa-archive"></i> Data SPP
                </a>
                <a href="?page=laporan" class="nav-link text-dark">
                  <i class="fa fa-history"></i> Laporan
                </a>
              </div>
            </div>
          </li>
          <li class="list-group-item bg-light">
            <a href="?page=petugas_data" class="nav-link text-dark">
              <i class="fa fa-desktop "></i> Data Petugas
            </a>
          </li>
          <li class="list-group-item bg-light">
            <a href="logout.php" onclick="return confirm('Apa Anda Akan Keluar?');" class="nav-link text-dark">
              <i class="fa fa-sign-out"></i> Keluar</a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
  <!-- end navigasi -->


  <?php
  $page = (isset($_GET['page'])) ?
    $_GET['page'] : '';

  if (isset($_SESSION['admin'])) {
    if ($_SESSION['level'] == 'Admin') { // jika sudah login cek levelnya

      // halaman yang boleh diakses admin
      switch ($page) {
        case "index":
          include "../index.php";
          break;
        case "data_petugas":
          include "modul/data_petugas.php";
          break;
        case "dashboard":
          include "modul/dashboard.php";
          break;
        case "spp_data":
          include "modul/spp_data.php";
          break;
        case "spp_input":
          include "modul/spp_input.php";
          break;
        case "spp_edit":
          include "modul/spp_edit.php";
          break;
        case "spp_hapus":
          include "modul/spp_hapus.php";
          break;
        case "pembayaran":
          include "modul/pembayaran.php";
          break;
        case "pembayaran_input":
          include "modul/pembayaran_input.php";
          break;
        case "pembayaran_edit":
          include "modul/pembayaran_edit.php";
          break;
        case "kelas_data":
          include "modul/kelas_data.php";
          break;
        case "kelas_input":
          include "modul/kelas_input.php";
          break;
        case "kelas_edit":
          include "modul/kelas_edit.php";
          break;
        case "kelas_hapus";
          include "modul/kelas_hapus.php";
          break;
        case "siswa_data":
          include "modul/siswa_data.php";
          break;
        case "siswa_input":
          include "modul/siswa_input.php";
          break;
        case "siswa_edit":
          include "modul/siswa_edit.php";
          break;
        case "siswa_hapus":
          include "modul/siswa_hapus.php";
          break;
        case "petugas_data":
          include "modul/petugas_data.php";
          break;
        case "cari":
          include "modul/cari.php";
          break;
        case "laporan":
          include "modul/laporan.php";
          break;
        case "logout":
          include "logout.php";
          break;
        default:
  ?>
          <div class="col-md-10 col-sm-9 offset-md-2 offset-sm-3 mt-4">
            <div class="alert alert-danger">
              <span>
                <i class="fa fa-user-times"></i> Maaf, Hanya Petugas Yang Dapat Akses Halaman Ini!!
              </span><a href="?page=dashboard" class="alert-link">Kembali ke Dashboard</a>.
            </div>
          </div>
        <?php
      }
    }

    // halaman yang boleh diakses petugas
    else {
      switch ($page) {
        case "dashboard":
          include "modul/dashboard.php";
          break;
        case "spp_data":
          include "modul/spp_data.php";
          break;
        case "kelas_data":
          include "modul/kelas_data.php";
          break;
        case "siswa_data":
          include "modul/siswa_data.php";
          break;
        case "pembayaran":
          include "modul/pembayaran.php";
          break;
        case "pembayaran_input":
          include "modul/pembayaran_input.php";
          break;
        case "pembayaran_edit":
          include "modul/pembayaran_edit.php";
          break;
        case "cetak":
          include "modul/cetak.php";
          break;
        case "laporan":
          include "modul/laporan.php";
          break;
        case "logout":
          include "logout.php";
          break;
        default:
        ?>
          <div class="col-md-10 col-sm-9 offset-md-2 offset-sm-3 mt-4">
            <div class="alert alert-danger">
              <span>
                <i class="fa fa-user-times"></i> Maaf, Hanya Admin Yang Dapat Akses Halaman Ini!!
              </span><a href="?page=dashboard" class="alert-link">Kembali ke Dashboard</a>.
            </div>
          </div>
  <?php
      }
    }
  }
  ?>

  <!-- javascript -->
  <script type="text/javascript" src="asset/js/jquery.js"></script>
  <script type="text/javascript" src="asset/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="asset/js/script.js"></script>
  <script type="text/javascript" src="asset/datepicker/js/bootstrap-datepicker.js"></script>

</body>

</html>