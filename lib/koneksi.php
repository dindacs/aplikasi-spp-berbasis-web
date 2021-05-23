<?php

$con = new mysqli('localhost', 'root', 'dinda1313', 'db_spp');

if (mysqli_connect_errno()) {
  echo "koneksi gagal" . mysqli_connect_errno();
}
