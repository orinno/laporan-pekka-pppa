<?php 
session_start();
// include '../config.php';

if (!isset($_SESSION['auth'])) 
{
    // kalo belum login tapi urlnya ditulis
    $_SESSION['error'] = "Anda belum Login!";
    header('location: ../login.php');
}
else
{
    // kalo udah login admin tapi diurl nya mau ke buku tamu, harus login dulu, and auto logout
    if ($_SESSION['role_id'] != "1") 
    {
        if (!isset($_SESSION['alert'])) {
            $_SESSION['error'] = "Tidak ada akses ke File!";
         }
        header('location: ../logout.php');
    }
}

?>