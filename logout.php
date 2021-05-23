<?php
session_start();
$_SESSION = ['siswa'];
session_unset();
session_destroy();
header("Location: welcome.php");
exit;
