<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Selamat Datang</title>
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
      position: absolute;
      height: 100%;
      width: 100%;
    }

    .bg-utama {
      background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.50), rgba(0, 0, 0, 0.50)), url('image/20.jpg');
      background-size: cover;
      background-position: center;
      text-align: center;
      height: 100%;
      width: 100%;
      display: table;
      vertical-align: middle;
    }

    .extradiv {
      border: medium none;
      padding: 30px !important;
      border-radius: 3px;
      transition: 0.3s;
    }

    .extradiv i {
      color: #d11d22;
    }

    .extradiv:hover {
      box-shadow: 0 0 50px 0 rgba(0, 0, 0, 3);
      transform: translateY(0.3s);

    }

    .extradiv a h3 {
      text-decoration: none;
    }
  </style>
</head>

<body>
  <div class="bg-utama">
    <div class="container h-100">
      <div class="text-ucapan align-items-center p-5 vertical-center">
        <h1 class="text-center text-light display-4">Selamat Datang</h1>
        <p class="text-center text-light pt-2">Sistem Pembayaran SPP SMK Genarasi Madani</p>
      </div>
      <div class="row align-items-center h-50 vertical-center">
        <div class="extradiv col-sm-4 mx-auto bg-light mb-4">
          <a href="admin/login.php" class="nav-link">
            <div class="justify-content-center d-flex">
              <i class="fa-4x fa fa-desktop p-4" aria-hidden="true"></i>
            </div>
            <h3 class="text-center">Login Sebagai Admin</h3>
          </a>
        </div>
        <div class="extradiv col-sm-4 mx-auto bg-light mb-4">
          <a href="login.php" class="nav-link">
            <div class="justify-content-center d-flex">
              <i class="fa-4x fa fa-graduation-cap p-4" aria-hidden="true"></i>
            </div>
            <h3 class="text-center">Login Sebagai Siswa</h3>
          </a>
        </div>
      </div>
    </div>
  </div>
</body>

</html>