<div class="col-md-10 col-sm-9 offset-md-2 offset-sm-3">
  <div class="container mt-4">
    <div class="card mb-4">
      <div class="card-header bg-light"><strong>Data Kelas</strong></div>
      <div class="card-body">
        <div class="row mb-2">
          <div class="col-lg-6 col-sm-6">
            <a href="?page=kelas_input" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
              <i class="fa fa-plus-circle"></i> Tambah Kelas
            </a>
          </div>
          <!-- Modal Input Kelas mulai di sini-->
          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Tambah Data Kelas</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                  <form role="form" action="?page=kelas_input" method="POST">
                    <div class="form-group">
                      <label>Kelas</label>
                      <input type="text" class="form-control mb-4" name="kd_kelas" required>
                    </div>
                    <div class="form-group">
                      <label>Kode Jurusan</label>
                      <input type="text" class="form-control mb-4" name="nm_kelas" required>
                    </div>
                    <div class="form-group">
                      <label>Kompetensi Keahlian</label>
                      <input type="text" class="form-control mb-2" name="kom_keahlian" required>
                    </div>

                    <div class="modal-footer mt-4">
                      <button type="submit" class="btn btn-primary" name="btnTambahKelas">Tambah</button>
                      <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Batal</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- Input Data Kelas selesai di sini-->


          <!-- Output Data Kelas -->
          <div class="col-lg-3"></div>
          <div class="col-lg-3 col-sm-6">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Cari.." id="myInput">
            </div>
          </div>
        </div>
        <!-- selesai row -->

        <div class="row">
          <div class="col-lg-12">
            <div class="table-responsive p-4">
              <table class="table table-hover">
                <thead>
                  <tr class="bg-light">
                    <th>Kelas</th>
                    <th>Kode Kelas</th>
                    <th>Kompetensi Keahlian</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <?php
                $sqlKelasOutput = mysqli_query($con, "SELECT*FROM tb_kelas");
                while ($rsKelasOutput = $sqlKelasOutput->fetch_array()) {
                ?>
                  <tbody id="myTable">
                    <tr>
                      <td><?= $rsKelasOutput['id_kelas']; ?></td>
                      <td><?= $rsKelasOutput['nama_kelas']; ?></td>
                      <td><?= $rsKelasOutput['kompetensi_keahlian']; ?></td>
                      <td>
                        <!-- Button untuk modal -->
                        <a href="?page=kelas_edit&id=<?= $rsKelasOutput['id_kelas'] ?>" type="button" class="btn btn-warning btn-md" data-toggle="modal" data-target="#myModal<?= $rsKelasOutput['id_kelas']; ?>">
                          <i class="fa fa-pencil"></i>
                        </a>
                        <a href="?page=kelas_hapus&hapus=hapus-kelas&id=<?= $rsKelasOutput['id_kelas']; ?>" onclick="return confirm('Apa Data Akan Dihapus?');" type="button" class="btn btn-danger text-white">
                          <i class="fa fa-trash"></i>
                        </a>
                      </td>
                    </tr>
                    <!-- Output Data Kelas selesai di sini -->

                    <!-- Modal Edit Kelas-->
                    <div class="modal fade" id="myModal<?= $rsKelasOutput['id_kelas']; ?>" role="dialog">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Edit Data Kelas</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body">
                            <form role="form" action="?page=kelas_edit" method="POST">
                              <input type="hidden" class="form-control mb-4" name="idKelas" value="<?= $rsKelasOutput['id_kelas'] ?>" required>
                              <div class="form-group">
                                <label>Kode Kelas</label>
                                <input type="text" class="form-control mb-4" name="kdKelas" value="<?= $rsKelasOutput['id_kelas'] ?>" required>
                              </div>
                              <div class="form-group">
                                <label>Kelas</label>
                                <input type="text" class="form-control mb-4" name="nm_kelas" placeholder="Nama Kelas" value="<?= $rsKelasOutput['nama_kelas'] ?>" required>
                              </div>
                              <div class="form-group">
                                <label>Kompetensi Keahlian</label>
                                <input type="text" class="form-control mb-2" name="kom_keahlian" placeholder="Kompetensi Keahlian" value="<?= $rsKelasOutput['kompetensi_keahlian'] ?>" required>
                              </div>

                              <div class="modal-footer mt-4">
                                <button type="submit" class="btn btn-warning" name="btnEditKelas">Edit</button>
                                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Batal</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Modal Edit Kelas-->
                  <?php  } // punya if select from 
                  ?>
                  </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- row -->
      </div>
    </div>
  </div>
</div>