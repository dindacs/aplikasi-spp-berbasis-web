<div class="col-md-10 col-sm-9 offset-md-2 offset-sm-3 mt-4 mb-4">
  <div class="card">
    <div class="card-header bg-light"><strong>Filter Laporan</strong></div>
    <div class="card-body">
      <form action="" method="post">
        <div class="form-group date">
          <label>Dari Tanggal</label>
          <input type="text" class="form-control datepicker" id="tgl_mulai" name="tgl_awal" required autocomplete="off">
        </div>
        <div class="form-group date">
          <label>Sampai Tanggal</label>
          <input type="text" class="form-control datepicker" id="tgl_akhir" name="tgl_akhir" required autocomplete="off">
        </div>
        <button type="submit" class="btn btn-primary text-white mt-2">Tampilkan</button>
        <a href="?page=laporan" class="btn btn-outline-danger mt-2">Reset</a>
      </form>
    </div>
  </div>

  <div class="card mt-4">
    <div class="card-header bg-light"><strong>Hasil Pencarian</strong></div>
    <div class="card-body">
      <a href="modul/cetak_laporan.php" class="btn btn-info" target="_blank">
        <i class="fa fa-print"></i> Cetak
      </a>
      <div class="table-responsive mt-4">
        <table class="table table-bordered table-hover">
          <tbody>
            <tr class="bg-light">
              <th>No</th>
              <th>Nisn</th>
              <th>Nama Siswa</th>
              <th>Tanggal Bayar</th>
              <th>Bulan Dibayar</th>
              <th>Tahun Dibayar</th>
              <th>Jumlah Bayar</th>
              <th>Status</th>
            </tr>
            <?php
            setlocale(LC_ALL, 'id-ID', 'id_ID');
            if (isset($_POST['tgl_awal']) && isset($_POST['tgl_akhir'])) {
              $tgl_awal = date('Y-m-d', strtotime($_POST["tgl_awal"]));
              $tgl_akhir = date('Y-m-d', strtotime($_POST["tgl_akhir"]));
              $no = 0;

              // ambil data dari database
              $sqlLap = mysqli_query($con, "SELECT*FROM tb_pembayaran a, tb_siswa b WHERE a.nisn=b.nisn AND tgl_bayar BETWEEN '" . $tgl_awal . "' AND '" . $tgl_akhir . "'ORDER BY id_pembayaran DESC") or die(mysqli_error($con));
            } else {
              $sqlLap = mysqli_query($con, "SELECT*FROM tb_pembayaran a, tb_siswa b WHERE a.nisn=b.nisn ORDER BY id_pembayaran DESC");
            }
            while ($rvLap = $sqlLap->fetch_array()) {
            ?>
              <tr>
                <td><?= $no = $no + 1; ?></td>
                <td><?= $rvLap["nisn"]; ?></td>
                <td><?= $rvLap["nama"]; ?></td>
                <td><?= strftime("%d %B %Y", strtotime($rvLap["tgl_bayar"])); ?></td>
                <td><?= $rvLap["bulan_dibayar"]; ?></td>
                <td><?= $rvLap["tahun_dibayar"]; ?></td>
                <td>Rp. <?= number_format($rvLap["jumlah_bayar"]); ?></td>
                <td>
                  <?php
                  if ($rvLap['jumlah_bayar'] == '200000') {
                  ?>
                    <label class="text-success">Lunas</label>
                  <?php
                  } else if ($rvLap['jumlah_bayar'] <= '200000') { ?>
                    <label class="text-danger">Tertunggak</label>
                  <?php } else { ?>
                    <label class="text-warning">Kelebihan</label>
                  <?php
                  }
                  ?>
                </td>
              </tr>
            <?php } ?>
            <tr>
              <?php
              // $sqlTampilPem = mysqli_query($con, "SELECT sum(jumlah_bayar) AS total FROM tb_pembayaran WHERE tgl_bayar BETWEEN '" . $tgl_awal . "' AND '" . $tgl_akhir . "'");
              // SQL untul menampilkan total pembayaran
              if (isset($_POST['tgl_awal']) && isset($_POST['tgl_akhir'])) {
                $sqlTampilTotal = mysqli_query($con, "SELECT sum(jumlah_bayar) AS total FROM tb_pembayaran  WHERE tgl_bayar BETWEEN '" . $tgl_awal . "' AND '" . $tgl_akhir . "'");
              } else {
                $sqlTampilTotal = mysqli_query($con, "SELECT sum(jumlah_bayar) AS total FROM tb_pembayaran");
              }
              $rvTampilTotal = $sqlTampilTotal->fetch_array();
              ?>
              <th colspan="6" class="text-center">Total Keseluruhan</th>
              <th>Rp. <?= number_format($rvTampilTotal['total']); ?></th>
              <th></th>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>