<div class="col-md-10 col-sm-9 offset-md-2 offset-sm-6 mt-4">
  <?php
  // set timezone
  date_default_timezone_set("Asia/Jakarta");
  setlocale(LC_ALL, 'id-ID', 'id_ID');
  // ambil jam
  $jam = date('H:i');
  // atur
  if ($jam > '05:30' && $jam < '11:00') {
    $salam = 'Pagi';
  } elseif ($jam >= '11:00' && $jam < '15:00') {
    $salam = 'Siang';
  } elseif ($jam < '18:00') {
    $salam = 'Sore';
  } else {
    $salam = 'Malam';
  }
  ?>
  <div class="row mb-4">
    <div class="col-lg-12">
      <div class="alert alert-primary" role="alert">
        <span class="p-2">
          <h4 class="alert-heading">Selamat <?= $salam; ?> <?= $vPetugas['nama_petugas']; ?>..</h4>
          <p>Sistem Pembayaran SPP SMK Generasi Madani. Anda Login Sebagai <b><?= $_SESSION['level']; ?></b></p>
          <p><?= strftime("%A, %d %B %Y"); ?></p>
        </span>
      </div>
    </div>
  </div>
  <!-- end jumbotron -->

  <?php
  $jmlKelas = mysqli_num_rows(mysqli_query($con, "SELECT*FROM tb_kelas"));
  $jmlSiswa = mysqli_num_rows(mysqli_query($con, "SELECT*FROM tb_siswa"));
  $jmlSpp = mysqli_num_rows(mysqli_query($con, "SELECT*FROM tb_spp"));
  $jmlPembayaran = mysqli_query($con, "SELECT sum(jumlah_bayar) as total FROM tb_pembayaran");
  $jlmp = $jmlPembayaran->fetch_array();
  ?>

  <div class="container">
    <div class="row">
      <div class="col-lg-3 mb-2">
        <div class="stat-siswa">
          <ul class="list-group">
            <li class="list-group-item text-white">
              <i class="fa-2x fa fa-users mt-4"></i>
              <span class="float-right pt-2 pb-2" style="font-size: 1.2rem;">
                <p class="text-center mb-0">
                  <?= $jmlSiswa; ?>
                </p>
                <a href="?page=siswa_data" class="text-white">Data Siswa</a>
              </span>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-lg-3 mb-2">
        <div class="stat-kelas">
          <ul class="list-group">
            <li class="list-group-item text-white">
              <i class="fa-2x fa fa-address-book mt-4"></i>
              <span class="float-right pt-2 pb-2" style="font-size: 1.2rem;">
                <p class="text-center mb-0">
                  <?= $jmlKelas; ?>
                </p>
                <a href="?page=kelas_data" class="text-white">Data Kelas</a>
              </span>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-lg-3 mb-2">
        <div class="stat-spp">
          <ul class="list-group">
            <li class="list-group-item text-white">
              <i class="fa-2x fa fa-archive mt-4"></i>
              <span class="float-right pt-2 pb-2" style="font-size: 1.2rem;">
                <p class="text-center mb-0">
                  <?= $jmlSpp; ?>
                </p>
                <a href="?page=spp_data" class="text-white">Data SPP</a>
              </span>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-lg-3 mb-2">
        <div class="stat-tranksaksi">
          <ul class="list-group">
            <li class="list-group-item text-white">
              <i class="fa-2x fa fa-bank mt-4"></i>
              <span class="float-right mt-2" style="font-size: 1.2rem;">
                <p class="text-center mb-0"> Rp.
                  <?= number_format($jlmp['total']); ?>
                </p>
                <a href="?page=laporan" class="text-white">Total Transaksi</a>
              </span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>