<div class="col-md-10 col-sm-9 offset-md-2 offset-sm-3">

  <div class="container mt-4">
    <div class="card mb-4">
      <div class="card-header bg-light"><strong>Data Siswa</strong></div>
      <div class="card-body">
        <div class="row mb-2">
          <div class="col-lg-6 col-sm-6">
            <a href="?page=kelas_input" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
              <i class="fa fa-plus-circle"></i> Tambah Siswa
            </a>
          </div>
          <!-- Modal Input Siswa-->
          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Tambah Data Siswa</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                  <form role="form" action="?page=siswa_input" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                      <label>Nisn</label>
                      <input type="text" class="form-control mb-2" name="nisn" required>
                    </div>
                    <div class="form-group">
                      <label>Nis</label>
                      <input type="text" class="form-control mb-2" name="nis" required>
                    </div>
                    <div class="form-group">
                      <label>Nama Lengkap</label>
                      <input type="text" class="form-control mb-2" name="nama" required>
                    </div>
                    <div class="form-group">
                      <label>Kelas</label>
                      <select name="kelas" class="form-control mb-4">
                        <option disabled selected>Pilih</option>
                        <?php
                        $sqlKelas = mysqli_query($con, "SELECT*FROM tb_kelas");
                        while ($rvKelas = $sqlKelas->fetch_array()) {
                        ?>
                          <option value="<?= $rvKelas['id_kelas']; ?>" required> <?= $rvKelas['id_kelas']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Kompetensi Keahlian</label>
                      <select name="kom_keahlian" class="form-control mb-4">
                        <option disabled selected>Pilih</option>
                        <?php
                        $sqlKelas = mysqli_query($con, "SELECT*FROM tb_kelas");
                        while ($rvKelas = $sqlKelas->fetch_array()) {
                        ?>
                          <option value="<?= $rvKelas['kompetensi_keahlian']; ?>" required><?= $rvKelas['kompetensi_keahlian']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Alamat</label>
                      <textarea type="text" class="form-control mb-2" rows="4" name="alamat" required></textarea>
                    </div>
                    <div class="form-group">
                      <label>No. Telp</label>
                      <input type="number" class="form-control mb-2" name="no_telp" required>
                    </div>

                    <div class="form-group">
                      <?php
                      $sqlSpp = mysqli_query($con, "SELECT*FROM tb_spp");
                      while ($rvSpp = $sqlSpp->fetch_array()) {
                      ?>
                        <input type="hidden" name="spp" value="<?= $rvSpp['id_spp']; ?>">
                      <?php } ?>
                    </div>

                    <div class="modal-footer mt-4">
                      <button type="submit" class="btn btn-primary" name="btnTambahSiswa">Tambah</button>
                      <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Batal</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- SELESAI MODAL INPUT Siswa -->


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
                  <th>No</th>
                  <th>NISN</th>
                  <th>NIS</th>
                  <th>Nama</th>
                  <th>Kelas</th>
                  <th>Jurusan</th>
                  <th>Alamat</th>
                  <th>No.Telp</th>
                  <th>Bayar</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <?php
              $no = 0;
              $sqlSiswaOutput = mysqli_query($con, "SELECT*FROM tb_siswa ORDER BY nisn DESC");
              while ($rsSiswaOutput = $sqlSiswaOutput->fetch_array()) {
              ?>
                <tbody id="myTable">
                  <tr>
                    <td><?= $no = $no + 1; ?></td>
                    <td><?= $rsSiswaOutput['nisn']; ?></td>
                    <td><?= $rsSiswaOutput['nis']; ?></td>
                    <td><?= $rsSiswaOutput['nama']; ?></td>
                    <td><?= $rsSiswaOutput['id_kelas']; ?></td>
                    <td><?= $rsSiswaOutput['kom_keahlian']; ?></td>
                    <td><?= $rsSiswaOutput['alamat']; ?></td>
                    <td><?= $rsSiswaOutput['no_telp']; ?></td>
                    <td>
                      <a href="?page=pembayaran&ids=<?= $rsSiswaOutput['nisn']; ?>" type="button" class="btn btn-success">
                        <i class="fa fa-sign-in"></i>
                      </a>
                    </td>
                    <td>
                      <a href="?page=siswa_edit&id=<?= $rsSiswaOutput['nisn']; ?>" type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal<?= $rsSiswaOutput['nisn']; ?>">
                        <i class="fa fa-pencil"></i>
                      </a>
                      <a href="?page=siswa_hapus&hapus=hapus-siswa&id=<?= $rsSiswaOutput['nisn']; ?>" onclick="return confirm('Apa Data Akan Dihapus?');" type="button" class="btn btn-danger text-white">
                        <i class="fa fa-trash"></i>
                      </a>
                    </td>
                  </tr>

                  <!-- Modal Edit Siswa-->
                  <div class="modal fade" id="myModal<?= $rsSiswaOutput['nisn']; ?>" role="dialog">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Edit Data Siswa</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                          <form role="form" action="?page=siswa_edit" method="POST">
                            <div class="form-group">
                              <label>Nisn</label>
                              <input type="text" class="form-control mb-4 bg-light" readonly name="nisn" value="<?= $rsSiswaOutput['nisn'] ?>" required>
                            </div>
                            <div class="form-group">
                              <label>Nis</label>
                              <input type="text" class="form-control mb-4" name="nis" value="<?= $rsSiswaOutput['nis'] ?>" required>
                            </div>
                            <div class="form-group">
                              <label>Nama</label>
                              <input type="text" class="form-control mb-4" name="nama" value="<?= $rsSiswaOutput['nama'] ?>" required>
                            </div>
                            <div class="form-group">
                              <label>Kelas</label>
                              <select name="kelas" class="form-control mb-4">
                                <?php
                                $sqlKelas = mysqli_query($con, "SELECT*FROM tb_kelas");
                                while ($rvKelas = $sqlKelas->fetch_array()) {
                                ?>
                                  <option value="<?= $rvKelas['id_kelas']; ?>" <?php if ($rvKelas['id_kelas'] == $rsSiswaOutput['id_kelas']) {
                                                                                  echo "selected";
                                                                                } ?>>
                                    <?= $rvKelas['id_kelas']; ?>
                                  </option>
                                <?php } ?>
                              </select>
                            </div>
                            <div class="form-group">
                              <label>Jurusan</label>
                              <input type="text" class="form-control mb-4 bg-light" readonly name="jurusan" value="<?= $rsSiswaOutput['kom_keahlian'] ?>" required>
                            </div>
                            <div class="form-group">
                              <label>Alamat</label>
                              <textarea name="almt" class="form-control mb-4" rows="3"><?= $rsSiswaOutput['alamat'] ?></textarea>
                            </div>
                            <div class="form-group">
                              <label>No.Telp</label>
                              <input type="number" class="form-control mb-4" name="telp" value="<?= $rsSiswaOutput['no_telp'] ?>" required>
                            </div>
                            <input type="hidden" class="form-control mb-4" name="spp" value="<?= $rsSiswaOutput['id_spp'] ?>" required>

                            <div class="modal-footer mt-4">
                              <button type="submit" class="btn btn-warning" name="btnEditKelas">Edit</button>
                              <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Batal</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Modal Edit Siswa-->
                <?php  } ?>
                </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>