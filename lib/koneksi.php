<?php

$con = new mysqli('localhost', 'root', '', 'db_spp');

if (mysqli_connect_errno()) {
  echo "koneksi gagal" . mysqli_connect_errno();
}
