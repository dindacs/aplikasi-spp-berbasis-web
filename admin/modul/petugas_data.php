<div class="col-md-10 col-sm-9 offset-md-2 offset-sm-3">
  <div class="container mt-4">
    <div class="card">
      <div class="card-header bg-light"><strong>Data Admin & Petugas</strong></div>
      <div class="card-body">
        <div class="row mb-4">
          <div class="col-lg-9">
            <a href="" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
              <i class="fa fa-plus-circle"></i> Tambah Data
            </a>
          </div>
          <!-- Modal Input Kelas mulai di sini-->
          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Tambah Data Admin & Petugas</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                  <!--INPUT DATA PETUGAS START DI SINI-->
                  <form action="" method="POST" enctype="multipart/form-data">
                    <label>Username</label>
                    <input type="text" class="form-control mb-4" name="uname" required>
                    <label>Password</label>
                    <input type="password" class="form-control mb-4" name="pass" required>
                    <label>Konfirmasi Password</label>
                    <input type="password" class="form-control mb-4" name="pass2" required>
                    <label>Nama Lengkap</label>
                    <input type="text" class="form-control mb-4" name="nmPetugas" required>
                    <label>Level</label>
                    <select name="lvl" class="form-control mb-4" required>
                      <option disabled selected>Pilih</option>
                      <option value="admin">Admin</option>
                      <option value="petugas">Petugas</option>
                    </select>
                    <div class="modal-footer mt-4">
                      <button class="btn btn-primary" type="submit" name="btnPetugas">Tambah</button>
                      <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Batal</button>
                    </div>
                  </form>

                  <?php
                  function registrasi($data)
                  {
                    global $con;
                    $username = strtolower(stripslashes($data["uname"]));
                    $password = mysqli_real_escape_string($con, $data["pass"]);
                    $password2 = mysqli_real_escape_string($con, $data["pass2"]);
                    $nama = $data["nmPetugas"];
                    $level = $data["lvl"];

                    // cek username sudah ada atau belum
                    $result = mysqli_query($con, "SELECT username FROM tb_petugas WHERE username = '$username'");
                    if (mysqli_fetch_assoc($result)) {
                      echo "<script>alert('Username Sudah Terdaftar');</script>";
                      return false;
                    }

                    // cek konfirmasi password
                    if ($password !== $password2) {
                      echo "<script>alert('Konfirmasi Password Tidak Sesuai');</script>";
                      return false;
                    }
                    // enkripsi password
                    $password = md5($password);

                    // tambahkan user baru ke dalam database
                    mysqli_query($con, "INSERT INTO tb_petugas VALUES ('','$username','$password','$nama','$level')");
                    return mysqli_affected_rows($con);
                  }

                  // cek apakah tombol registrasi sudah di klik
                  if (isset($_POST['btnPetugas'])) {
                    if (registrasi($_POST) > 0) {
                      echo "<script>alert('Data Berhasil Ditambahkan');document.location='?page=petugas_data';</script>";
                    } else {
                      echo mysqli_error($con);
                    }
                  }
                  ?>
                  <!--INPUT DATA PETUGAS SELESAI DI SINI-->
                </div>
              </div>
            </div>
          </div>
          <!-- Input Data Kelas selesai di sini-->
          <div class="col-lg-3 col-sm-6">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Cari.." id="myInput">
            </div>
          </div>
        </div>
        <!--INPUT DATA PETUGAS START DI SINI-->
        <div class="row">
          <div class="col-lg-12">
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr class="bg-light">
                    <th>No</th>
                    <th>Username</th>
                    <th>Nama Lengkap</th>
                    <th>Level</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <?php
                $no;
                $sqlOutputPetugas = mysqli_query($con, "SELECT*FROM tb_petugas ORDER BY id_petugas DESC");
                while ($rvOutputPetugas = $sqlOutputPetugas->fetch_array()) {
                ?>
                  <tbody id="myTable">
                    <tr>
                      <td><?= $no = $no + 1; ?></td>
                      <td><?= $rvOutputPetugas['username']; ?></td>
                      <td><?= $rvOutputPetugas['nama_petugas']; ?></td>
                      <td><?= $rvOutputPetugas['level']; ?></td>
                      <td>
                        <a href="?page=petugas_data&edit=edit-petugas&id=<?= $rvOutputPetugas['id_petugas'] ?>" type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal<?= $rvOutputPetugas['id_petugas']; ?>">
                          <i class="fa fa-pencil"></i>
                        </a>
                        <a href="?page=petugas_data&hapus=hapus-petugas&id=<?= $rvOutputPetugas['id_petugas']; ?>" onclick="return confirm('Apa Data Akan Dihapus?');" type="button" class="btn btn-danger text-white">
                          <i class="fa fa-trash"></i>
                        </a>
                        <?php
                        if ($_GET['hapus'] == 'hapus-petugas') {
                          $sqlHapusPetugas = mysqli_query($con, "DELETE FROM tb_petugas WHERE id_petugas = '$_GET[id]'");
                          if ($sqlHapusPetugas) {
                            echo "<script>alert('Data Berhasil Dihapus');document.location.href = '?page=petugas_data';</script>";
                          } else {
                            echo "<script>alert('Data Gagal Dihapus');</script>";
                          }
                        }
                        ?>
                      </td>
                    </tr>
                    <!-- Modal Edit Kelas-->
                    <div class="modal fade" id="myModal<?= $rvOutputPetugas['id_petugas']; ?>" role="dialog">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Edit Data Petugas</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body">
                            <form role="form" action="" method="POST">
                              <input type="hidden" class="form-control mb-4" name="idPetugas" value="<?= $rvOutputPetugas['id_petugas'] ?>" required>
                              <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control mb-4 bg-light" readonly name="uname" placeholder="Username" required value="<?= $rvOutputPetugas['username'] ?>">
                              </div>
                              <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control mb-4" name="pass" placeholder="Biarkan kosong jika tidak diubah">
                              </div>
                              <div class="form-group">
                                <label>Konfirmasi Password</label>
                                <input type="password" class="form-control mb-4" name="pass2" placeholder="Biarkan kosong jika tidak diubah">
                              </div>
                              <div class="form-group">
                                <label>Nama Petugas</label>
                                <input type="text" class="form-control mb-4" name="nmPetugas" placeholder="Nama Lengkap" required value="<?= $rvOutputPetugas['nama_petugas'] ?>">
                              </div>
                              <label>Level</label>
                              <select name="lvl" class="form-control mb-4">
                                <?php
                                $sqlPt = mysqli_query($con, "SELECT*FROM tb_petugas");
                                while ($rvPt = $sqlPt->fetch_array()) {
                                ?>
                                  <option value="<?= $rvPt['level']; ?>" <?php if ($rvPt['id_petugas'] == $rvOutputPetugas['id_petugas']) {
                                                                            echo "selected";
                                                                          } ?>>
                                    <?= $rvPt['level']; ?>
                                  </option>
                                <?php }
                                ?>
                              </select>
                              <div class="modal-footer mt-4">
                                <button type="submit" class="btn btn-warning" name="btnEditPetugas">Edit</button>
                                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Batal</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php
                    if (isset($_POST['btnEditPetugas'])) {
                      $usrn = $_POST['uname'];
                      $pass = $_POST['pass'];
                      $pass2 = $_POST['pass2'];
                      $nmp = $_POST['nmPetugas'];
                      $level = $_POST['lvl'];

                      // cek konfirmasi password
                      if ($pass !== $pass2) {
                        echo "<script>alert('Konfirmasi Password Tidak Sesuai'); document.location='?page=petugas_data';</script>";
                        return false;
                      }

                      // enkripsi password
                      $pass = md5($pass);

                      $sqlEditPetugas = mysqli_query($con, "UPDATE tb_petugas SET
                      username = '$usrn',
                      pwd = '$pass',
                      nama_petugas = '$nmp',
                      level = '$level'
                      WHERE id_petugas = '$_POST[idPetugas]';
                      ");

                      if ($sqlEditPetugas) {
                        echo "<script>alert('Data Berhasil Diubah'); document.location='?page=petugas_data';</script>";
                      } else {
                        echo "<script>alert('Data Gagal Diubah');</script>";
                      }
                    }
                    ?>
                    <!-- Modal Edit Kelas-->
                  <?php } ?>
                  </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>