<div class="container-fluid mb-4">
  <div class="row mt-4 mb-0">
    <!-- Profil Siswa mulai di sini -->
    <div class="col-lg-3">
      <div class="card card-body">
        <div class="d-flex justify-content-center">
          <img src="image/default.svg" class="img img-responsive rounded-circle" width="160" height="160">
        </div>
        <div class="d-flex justify-content-center mt-4">
          <h4 class="text-danger"><?= $vsiswa['nama']; ?></h4>
        </div>
        <div class="d-flex justify-content-center">
          <p><?= $vsiswa['id_kelas']; ?> <?= $vsiswa['kom_keahlian']; ?></p>
        </div>
      </div>
    </div>
    <!-- Profil Siswa selesai di sini -->

    <div class="col-lg-9">
      <div class="card">
        <div class="card-header"><strong>Riwayat Pembayaran</strong></div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover table-bordered">
              <tbody>
                <tr class="bg-light">
                  <th>No</th>
                  <th>No Transaksi</th>
                  <th>Pembayaran</th>
                  <th>Tanggal Bayar</th>
                  <th>Bulan Dibayar</th>
                  <th>Jumlah Bayar</th>
                  <th>Status</th>
                </tr>
                <?php
                setlocale(LC_ALL, 'id-ID', 'id_ID');
                $no = 0;
                $dataTampil = $_SESSION["siswa"];
                $sqlTampilPembayaran = mysqli_query($con, "SELECT*FROM tb_pembayaran a, tb_spp b WHERE a.id_spp=b.id_spp AND nisn = '$dataTampil' ORDER BY id_pembayaran DESC");
                while ($rvTampilPembayaran = $sqlTampilPembayaran->fetch_array()) {
                ?>
                  <tr>
                    <td><?= $no = $no + 1; ?></td>
                    <td><?= $rvTampilPembayaran['id_pembayaran']; ?></td>
                    <td><?= $rvTampilPembayaran['jenis_pembayaran']; ?></td>
                    <td><?= strftime("%d %B %Y", strtotime($rvTampilPembayaran['tgl_bayar'])); ?></td>
                    <td><?= $rvTampilPembayaran['bulan_dibayar']; ?></td>
                    <td>Rp. <?= number_format($rvTampilPembayaran['jumlah_bayar']); ?></td>
                    <td>
                      <?php
                      if ($rvTampilPembayaran['jumlah_bayar'] == '200000') {
                      ?>
                        <label class="text-success">Lunas</label>
                      <?php
                      } else if ($rvTampilPembayaran['jumlah_bayar'] <= '200000') { ?>
                        <label class="text-danger">Tertunggak</label>
                      <?php } else { ?>
                        <label class="text-warning">Kelebihan</label>
                      <?php
                      }
                      ?>
                    </td>
                  </tr>
                <?php } ?>
                <?php
                $sqlTampilPem = mysqli_query($con, "SELECT sum(jumlah_bayar) AS total FROM tb_pembayaran WHERE nisn = '$dataTampil'");
                $rvTampilPem = $sqlTampilPem->fetch_array();
                ?>
                <tr>
                  <th colspan="5" class="text-center">Total Keseluruhan</th>
                  <th>Rp. <?= number_format($rvTampilPem['total']); ?></th>
                  <th></th>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>