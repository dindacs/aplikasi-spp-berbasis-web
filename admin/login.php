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
        <h2 class="text-primary mb-4 mt-2 pb-3 border-bottom text-center">Login Admin</h2>
        <form action="" method="POST" class="pl-4 pr-4 pb-4">
          <div class="form-group">
            <div class="input-group mb-4">
              <div class="input-group-prepend">
                <label for="" class="input-group-text"><i class="fa fa-user"></i></label>
              </div>
              <input type="text" class="form-control" placeholder="Username" name="usr" required>
            </div>
            <div class="input-group mb-4">
              <div class="input-group-prepend">
                <label for="" class="input-group-text">
                  <span id="mybutton" onclick="change()"><i class="fa fa-eye-slash"></i></span>
                </label>
              </div>
              <input type="password" class="form-control" placeholder="Password" name="pass" id="pass" required>
            </div>
            <!-- <input type="checkbox" onclick="myFunction()" class="mb-4"> Show Password -->
            <button type="submit" class="form-control btn btn-primary" name="btnLogin">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- untuk menampilkan password -->
  <script>
    function change() {
      var x = document.getElementById('pass').type;

      if (x == 'password') {
        document.getElementById('pass').type = 'text';
        document.getElementById('mybutton').innerHTML = '<i class="fa fa-eye"></i>';
      } else {
        document.getElementById('pass').type = 'password';
        document.getElementById('mybutton').innerHTML = '<i class="fa fa-eye-slash"></i>';
      }
    }
  </script>

  <!-- proses filter username dan password agar bisa masuk -->

  <?php
  session_start();
  include '../lib/koneksi.php';

  if (isset($_POST['btnLogin'])) {
    $usr = $_POST['usr'];
    $pass = md5($_POST['pass']);
    $query = mysqli_query($con, "SELECT*FROM tb_petugas WHERE username = '$usr' AND pwd = '$pass'");
    $data = $query->fetch_array();
    $jml = mysqli_num_rows($query);

    if ($jml > 0) {
      $_SESSION['admin'] = $data['username'];
      $_SESSION['level'] = $data['level'];
      $_SESSION['namaPetugas'] = $data['nama_petugas'];

      // header('Location: index.php');
    } else {
  ?>
      <div class="container d-flex justify-content-center">
        <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
          <span class="text-center">Username atau Password Salah!!</span>
          <button class="close" type="button" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      </div>
  <?php
    }
  }
  // arahkan ke index
  if ($_SESSION['admin']) {
    header("Location: index.php?page=dashboard");
    exit;
  }
  ?>

</body>

</html>