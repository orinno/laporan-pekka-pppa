<?php
session_start();
session_unset();

header("location:login.php");
// $pesan = $_SESSION['msg'];
$_SESSION['error'] = 'Sesi login berakhir.';

?>