<div class="col-md-10 col-sm-9 offset-md-2 offset-sm-3 mb-4">
  <!-- DATA SISWA MULAI DARI SINI  -->
  <!--  -->
  <div class="container-fluid mt-4">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header bg-light"><strong>Data Siswa</strong></div>
          <div class="card-body">
            <!-- TOMBOL TRANSAKSI -->
            <a href="?page=siswa_data" type="button" class="btn btn-primary mb-4">
              <i class="fa fa-users"></i> Halaman Siswa
            </a>
            <a href="" type="button" class="btn btn-danger mb-4 ml-2" data-toggle="modal" data-target="#myModal">
              <i class="fa fa-plus-circle"></i> Pembayaran
            </a>
            <!-- TOMBOL TRANSAKSI -->

            <!-- php untuk menampilkan data siswa -->
            <?php
            $data = mysqli_query($con, "SELECT*FROM tb_siswa a, tb_spp b WHERE a.id_spp=b.id_spp 
            AND nisn = '$_GET[ids]'") or die(mysqli_error($con));
            $dta = $data->fetch_array();            ?>
            <!-- TOMBOL KE HALAMAN SISWA SELESAI DI SINI  -->

            <!-- MODAL PEMBAYARAN MULAI DI SINI  -->
            <!--  -->
            <div class="modal fade" id="myModal" role="dialog">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Transaksi Pembayaran</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <?php
                  $sql = mysqli_query($con, "SELECT max(id_pembayaran) as kode from tb_pembayaran");
                  $data = $sql->fetch_array();
                  $lastID = $data['kode']; // baca nomor urut id terakhir
                  $akhirNoUrut = substr($lastID, 3, 9);
                  $NoUrut = $akhirNoUrut + 1; // nomor urut ditambah 1
                  $NoBaru = "BYR" . sprintf("%03s", $NoUrut); // membuat format nomor berikutnya

                  $sqlPem = mysqli_query($con, "SELECT*FROM tb_siswa a, tb_spp b WHERE a.id_spp=b.id_spp AND nisn = '$_GET[ids]' ");
                  $rvPem = $sqlPem->fetch_array();
                  ?>
                  <div class="modal-body">
                    <form role="form" action="?page=pembayaran_input" method="POST">
                      <div class="form-group">
                        <label>No Transaksi</label>
                        <input type="text" class="form-control mb-4 bg-light" name="kdPembayaran" readonly value="<?= $NoBaru ?>" required>
                      </div>
                      <input type="hidden" class="form-control mb-4 bg-light" name="idPetugas" readonly value="<?= $vPetugas['id_petugas'] ?>" required>
                      <input type="hidden" class="form-control mb-4 bg-light" name="nisn" readonly value="<?= $rvPem['nisn'] ?>" required>
                      <div class="form-group date">
                        <label>Tanggal Bayar</label>
                        <input type="text" class="form-control datepickeri" name="tglBayar" value="<?= $rvPem['tgl_bayar'] ?>" required autocomplete="off" placeholder="Pilih Tanggal">
                      </div>
                      <div class="form-group">
                        <label>Untuk Bulan</label>
                        <select name="blnBayar" class="form-control">
                          <option disabled selected>Pilih</option>
                          <?php
                          $bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
                          $jlh_bln = count($bulan);
                          for ($c = 0; $c < $jlh_bln; $c += 1) { ?>
                            <option value=" <?= $bulan[$c] ?>">
                              <?= $bulan[$c] ?>
                            </option>
                          <?php }  ?>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Tahun</label>
                        <select name="thnBayar" class="form-control">
                          <option disabled selected>Pilih</option>
                          <?php
                          $thn = date('Y');
                          for ($a = 2020; $a <= $thn; $a++) { ?>
                            <option value='<?= $a ?>'>
                              <?= $a ?>
                            </option>;
                          <?php } ?>
                        </select>
                      </div>
                      <input type="hidden" class="form-control mb-2" name="spp" value="<?= $rvPem['id_spp'] ?>" required>
                      <label>Nominal</label>
                      <div class="form-group input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Rp</span>
                        </div>
                        <input type="text" class="form-control" name="jmlhBayar" value="<?= $rvPem['nominal'] ?>" required>
                      </div>
                      <div class="modal-footer mt-4">
                        <button type="submit" class="btn btn-primary" name="btnTambahPem">Tambah</button>
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Batal</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!--  -->
            <!-- MODAL PEMBAYARAN SELESAI DI SINI  -->


            <!-- DATA SISWA DARI HALAMAN SISWA MULAI DI SINI  -->
            <!--  -->
            <div class="table-responsive">
              <table class="table">
                <tbody>
                  <tr>
                    <td class="border-top-0">Nisn</td>
                    <td class="border-top-0">:</td>
                    <td class="border-top-0"><b class="text-danger"><?= $dta['nisn']; ?></b></td>
                  </tr>
                  <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td><b class="text-danger"><?= $dta['nama']; ?></b></td>
                  </tr>
                  <tr>
                    <td>Kelas</td>
                    <td>:</td>
                    <td><b class="text-danger"><?= $dta['id_kelas']; ?> <?= $dta['kom_keahlian']; ?></b></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--  -->
  <!-- DATA SISWA SELESAI DARI SINI  -->


  <!-- HISTORY PEMBAYARAN MULAI DARI SINI  -->
  <!--  -->
  <div class="container-fluid mt-4">
    <div class="row mt-4">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header bg-light"><strong>Riwayat Pembayaran</strong></div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered">
                <tbody>
                  <tr class="bg-light">
                    <th>No</th>
                    <th>No Transaksi</th>
                    <th>Pembayaran</th>
                    <th>Tanggal Bayar</th>
                    <th>Bulan Dibayar</th>
                    <th>Jumlah Bayar</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                  <?php
                  setlocale(LC_ALL, 'id-ID', 'id_ID');
                  $no = 0;
                  $sqlTampilPembayaran = mysqli_query($con, "SELECT*FROM tb_pembayaran 
                  INNER JOIN tb_petugas ON tb_pembayaran.id_petugas = tb_petugas.id_petugas 
                  INNER JOIN tb_siswa ON tb_pembayaran.nisn = tb_siswa.nisn 
                  INNER JOIN tb_spp ON tb_pembayaran.id_spp = tb_spp.id_spp 
                  WHERE tb_pembayaran.nisn = '$_GET[ids]' ORDER BY id_pembayaran DESC") or die(mysqli_error($con));
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
                      <td>
                        <a href="?page=pembayaran_edit&ids=<?= $rvTampilPembayaran['id_pembayaran']; ?>" type="button" class="btn btn-warning btn-md" data-toggle="modal" data-target="#myModal<?= $rvTampilPembayaran['id_pembayaran']; ?>">
                          <i class="fa fa-pencil"></i>
                        </a>
                        <a href="?page=pembayaran&ids=<?= $rvTampilPembayaran['nisn']; ?>&hapus=hapus-pem&idhps=<?= $rvTampilPembayaran['id_pembayaran']; ?>" onclick="return confirm('Apa Data Akan Dihapus?');" type="button" class="btn btn-danger text-white">
                          <i class="fa fa-trash"></i>
                        </a>
                        <!--  -->
                        <?php
                        if ($_GET['hapus'] == 'hapus-pem') {
                          $sqlHapusPem = mysqli_query($con, "DELETE FROM tb_pembayaran WHERE id_pembayaran = '$_GET[idhps]'") or die(mysqli_error($con));
                          if ($sqlHapusPem) {
                            echo "<script>alert('Data Berhasil Dihapus');
                            document.location='?page=pembayaran&ids=<?= $rvTampilPembayaran[nisn]; ?>';
                            </script>";
                          } else {
                            echo "<script>alert('Data Gagal Dihapus');</script>";
                          }
                        }
                        ?>
                        <!--  -->
                      </td>
                    </tr>

                    <!-- Modal Edit Pembayaran-->
                    <div class="modal fade" id="myModal<?= $rvTampilPembayaran['id_pembayaran']; ?>" role="dialog">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Edit Data Pembayaran</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body">
                            <form role="form" action="?page=pembayaran_edit" method="POST">
                              <div class="form-group">
                                <label>No Transaksi</label>
                                <input type="text" class="form-control mb-4 bg-light" name="kdPembayaran" readonly value="<?= $rvTampilPembayaran['id_pembayaran'] ?>" required>
                              </div>
                              <div class="form-group">
                                <label>Nisn / Nama Siswa</label>
                                <input type="text" class="form-control mb-4 bg-light" name="nisn" readonly value="<?= $rvTampilPembayaran['nisn'] ?> / <?= $rvTampilPembayaran['nama'] ?>" required>
                              </div>
                              <div class="form-group">
                                <label>Petugas</label>
                                <input type="text" class="form-control mb-4 bg-light" name="idPetugas" readonly value="<?= $rvTampilPembayaran['nama_petugas'] ?>" required>
                              </div>
                              <div class="form-group">
                                <label>Tanggal Bayar</label>
                                <input type="date" class="form-control mb-4" name="tglBayar" value="<?= $rvTampilPembayaran['tgl_bayar'] ?>" required>
                              </div>
                              <div class="form-group">
                                <label>Bulan Dibayar</label>
                                <select name="blnBayar" class="form-control">
                                  <?php
                                  $sqlBulan = mysqli_query($con, "SELECT bulan_dibayar FROM tb_pembayaran");
                                  while ($rvTampilBulan = $sqlBulan->fetch_array()) {
                                  ?>
                                    <option value="<?= $rvTampilBulan['bulan_dibayar'] ?>" <?php if ($rvTampilBulan['bulan_dibayar'] == $rvTampilPembayaran['bulan_dibayar']) {
                                                                                              echo "selected";
                                                                                            } ?>>

                                      <?= $rvTampilBulan['bulan_dibayar']; ?>
                                    </option>
                                  <?php }  ?>
                                </select>
                              </div>
                              <div class="form-group">
                                <label>Tahun</label>
                                <select name="thnBayar" class="form-control">

                                  <?php
                                  $sqlTahun = mysqli_query($con, "SELECT*FROM tb_pembayaran");
                                  while ($rvTahun = $sqlTahun->fetch_array()) {
                                  ?>
                                    <option value="<?= $rvTahun['tahun_dibayar'] ?>" <?php if ($rvTahun['tahun_dibayar'] == $rvTampilPembayaran['tahun_dibayar']) {
                                                                                        echo "selected";
                                                                                      } ?>>

                                      <?= $rvTahun['tahun_dibayar']; ?>
                                    </option>
                                  <?php } ?>
                                </select>
                              </div>
                              <input type="hidden" class="form-control mb-2" name="spp" value="<?= $rvTampilPembayaran['id_spp'] ?>" required>
                              <label>Nominal</label>
                              <div class="form-group input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text mb-4">Rp</span>
                                </div>
                                <input type="text" class="form-control mb-2" name="jmlhBayar" value="<?= $rvTampilPembayaran['jumlah_bayar'] ?>" required>
                              </div>
                              <div class="modal-footer mt-4">
                                <button type="submit" class="btn btn-warning" name="btnTambahPem">Edit</button>
                                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Batal</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Modal Edit Pembayaran-->

                  <?php } // tutup while 
                  ?>

                  <?php
                  $sqlTampilPem = mysqli_query($con, "SELECT nisn, sum(jumlah_bayar) AS total FROM tb_pembayaran WHERE nisn = '$_GET[ids]'") or die(mysqli_error($con));
                  $rvTampilPem = $sqlTampilPem->fetch_array();
                  ?>
                  <tr>
                    <th colspan="5" class="text-center">Total Keseluruhan</th>
                    <th colspan="2">Rp. <?= number_format($rvTampilPem['total']); ?></th>
                    <th>
                      <a href="modul/cetak_lap_siswa.php?id=<?= $rvTampilPem['nisn']; ?>" target="_blank" class="btn btn-info">
                        <i class="fa fa-print"></i> Cetak
                      </a>
                    </th>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--  -->
  <!-- HISTORY PEMBAYARAN SELESAI DI SINI  -->
</div>