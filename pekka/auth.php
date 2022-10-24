<?php 
session_start();
// include '../config.php';

if (!isset($_SESSION['auth'])) 
{
    // kalau belum login tapi url nya ditulis
    $_SESSION['error'] = "Anda belum Login!";
    header('location: ../login.php');
}
else
{
    // kalo udah login buku tamu tapi diurl nya mau ke admin, harus login dulu, and auto logout
    if ($_SESSION['role_id'] != "2") 
    {
        if (!isset($_SESSION['error'])) {
           $_SESSION['error'] = "Tidak ada akses ke File!";
        }
        header('location: ../logout.php');
    }
}

?>