<div class="col-md-10 col-sm-9 offset-md-2 offset-sm-3">

  <div class="container mt-4">
    <div class="card mb-4">
      <div class="card-header bg-light"><strong>Data SPP</strong></div>
      <div class="card-body">
        <div class="row mb-2">
          <div class="col-lg-6 col-sm-6">
            <a href="?page=kelas_input ?>" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
              <i class="fa fa-plus-circle"></i> Tambah SPP
            </a>
          </div>
          <!-- untuk membuat nomor kode spp -->
          <?php
          $sql = mysqli_query($con, "SELECT max(id_spp) as kode from tb_spp");
          $data = $sql->fetch_array();
          $lastID = $data['kode']; // baca nomor urut id terakhir
          $akhirNoUrut = substr($lastID, 3, 9);
          $NoUrut = $akhirNoUrut + 1; // nomor urut ditambah 1
          $NoBaru = "SPP" . sprintf("%03s", $NoUrut); // membuat format nomor berikutnya
          ?>
          <!-- Modal Input spp mulai di sini-->
          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Tambah Data SPP</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                  <form role="form" action="?page=spp_input" method="POST">
                    <div class="form-group">
                      <label>Kode SPP</label>
                      <input type="text" class="form-control mb-4 bg-light" name="kd_spp" value="<?= $NoBaru; ?>" required readonly>
                    </div>
                    <div class="form-group">
                      <label>Tahun</label>
                      <input type="text" class="form-control mb-4" name="tahun" required>
                    </div>
                    <div class="form-group">
                      <label>Jenis Pembayaran</label>
                      <input type="text" class="form-control mb-4" name="jenis" required>
                    </div>
                    <label>Nominal</label>
                    <div class="form-group input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text mb-4">Rp</span>
                      </div>
                      <input type="text" class="form-control mb-4" name="nominal" required>
                    </div>
                    <div class="modal-footer mt-4">
                      <button type="submit" class="btn btn-primary" name="btnTambahSpp">Tambah</button>
                      <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Batal</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- Modal Input spp selesai di sini-->

          <div class="col-lg-3"></div>
          <div class="col-lg-3 col-sm-6">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Cari.." id="myInput">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="table-responsive p-4">
            <table class="table table-hover">
              <thead>
                <tr class="bg-light">
                  <th>Kode SPP</th>
                  <th>Tahun</th>
                  <th>Jenis</th>
                  <th>Nominal</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <?php
              $sqlSppOutput = mysqli_query($con, "SELECT*FROM tb_spp ORDER BY id_spp DESC");
              while ($rsSppOutput = $sqlSppOutput->fetch_array()) {
              ?>
                <tbody id="myTable">
                  <tr>
                    <td><?= $rsSppOutput['id_spp']; ?></td>
                    <td><?= $rsSppOutput['tahun']; ?></td>
                    <td><?= $rsSppOutput['jenis_pembayaran']; ?></td>
                    <td>Rp. <?= number_format($rsSppOutput['nominal']); ?></td>
                    <td>
                      <a href="?page=spp_edit&id=<?= $rsSppOutput['id_spp'] ?>" type="button" class="btn btn-warning btn-md" data-toggle="modal" data-target="#myModal<?= $rsSppOutput['id_spp']; ?>">
                        <i class="fa fa-pencil"></i>
                      </a>
                      <a href="?page=spp_hapus&hapus=hapus-spp&id=<?= $rsSppOutput['id_spp']; ?>" onclick="return confirm('Apa Data Akan Dihapus?');" type="button" class="btn btn-danger text-white">
                        <i class="fa fa-trash"></i>
                      </a>
                    </td>
                  </tr>

                  <!-- Modal Edit SPP-->
                  <div class="modal fade" id="myModal<?= $rsSppOutput['id_spp']; ?>" role="dialog">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Edit Data SPP</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                          <form role="form" action="?page=spp_edit" method="POST">
                            <input type="hidden" class="form-control mb-4" name="idSpp" value="<?= $rsSppOutput['id_spp'] ?>" required>
                            <div class="form-group">
                              <label>Kode SPP</label>
                              <input type="text" class="form-control mb-4 bg-light" readonly name="kd_spp" value="<?= $rsSppOutput['id_spp'] ?>" required>
                            </div>
                            <div class="form-group">
                              <label>Tahun</label>
                              <input type="text" class="form-control mb-4" name="tahun" value="<?= $rsSppOutput['tahun'] ?>" required>
                            </div>
                            <div class="form-group">
                              <label>Jenis Pembayaran</label>
                              <input type="text" class="form-control mb-2" name="jenis" value="<?= $rsSppOutput['jenis_pembayaran'] ?>" required>
                            </div>
                            <label>Nominal</label>
                            <div class="form-group input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text mb-4">Rp</span>
                              </div>
                              <input type="text" class="form-control mb-4" name="nominal" value="<?= $rsSppOutput['nominal'] ?>" required>
                            </div>
                            <div class="modal-footer mt-4">
                              <button type="submit" class="btn btn-warning" name="btnEditSpp">Edit</button>
                              <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Batal</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Modal Edit SPP-->
                <?php  } // punya if select tb_spp
                ?>
                </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>