<?php
session_start();
$_SESSION = ['admin'];
session_unset();
session_destroy();
header("Location: ../welcome.php");
exit;
