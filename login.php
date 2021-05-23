<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login SPP</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- css -->
  <link rel="stylesheet" href="asset/css/bootstrap.min.css">
  <link rel="stylesheet" href="asset/css/style.css">
  <link rel="stylesheet" href="asset/font/css/font-awesome.min.css">
  <!-- javascript -->
  <script type="text/javascript" src="asset/js/jquery.js"></script>
  <script type="text/javascript" src="asset/js/bootstrap.min.js"></script>

  <style>
    * {
      margin: 0;
      padding: 0;
    }

    body {
      background-color: #fff;
    }

    .kotak {
      box-shadow: 0 0 15px 0 rgba(0, 0, 0, 0.5);
    }

    .input-group-prepend {
      width: 38px;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="row d-flex align-items-center mt-4">
      <div class="kotak col-sm-6 col-md-4 mx-auto p-4">
        <h2 class="text-danger mb-4 mt-2 pb-3 border-bottom text-center">Login Siswa</h2>
        <form action="" method="POST" class="pl-4 pr-4 pb-4">
          <div class="form-group">
            <div class="input-group mb-4">
              <div class="input-group-prepend">
                <label for="" class="input-group-text"><i class="fa fa-user"></i></label>
              </div>
              <input type="text" class="form-control" placeholder="Nama" name="nama" required>
            </div>
            <div class="input-group mb-4">
              <div class="input-group-prepend">
                <label for="" class="input-group-text">
                  <span id="mybutton" onclick="change()"><i class="fa fa-id-card"></i></span>
                </label>
              </div>
              <input type="text" class="form-control" placeholder="Nisn" name="nisn" id="pass" required>
            </div>
            <input type="submit" class="form-control btn btn-danger" name="btnLogin">
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- proses filter username dan password agar bisa masuk -->

  <?php
  session_start();
  include 'lib/koneksi.php';

  if (isset($_POST['btnLogin'])) {
    $nama = $_POST['nama'];
    $nisn = $_POST['nisn'];
    $query = mysqli_query($con, "SELECT*FROM tb_siswa WHERE nama = '$nama' AND nisn = '$nisn'");
    $data = $query->fetch_array();
    $jml = mysqli_num_rows($query);

    if ($jml > 0) {
      $_SESSION['siswa'] = $data['nisn'];
      $_SESSION['namaSiswa'] = $data['nama'];
    } else {
  ?>
      <div class="container d-flex justify-content-center">
        <div class="alert alert-danger alert-dismissible fade show w-50 mt-4" role="alert">
          <h6 class="text-center">Nama atau Nisn Salah!!</h6>
          <button class="close" type="button" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      </div>

  <?php
    }
  }
  // arahkan ke index
  if ($_SESSION['siswa']) {
    header("Location: index.php?page=beranda");
    exit;
  }
  ?>

</body>

</html>