<?php
include 'config.php';
session_start();

// auth login
if (isset($_SESSION['auth'])) 
{
    if ($_SESSION['role_id'] == 1) {
        // echo '<script>alert("Hello! I am an alert box!!")</script>';
        header('location: admin/index.php?page=dashboard');
    }else if ($_SESSION['role_id'] == 2) {
        header('location: pekka/index.php?page=dashboard');
    }
}

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($dbconnect, $_POST['username']);
    $password = mysqli_real_escape_string($dbconnect, $_POST['password']);

    //crud for status 
    $lastlogin = date('d-m-Y H:i:s');
    $lastLogin = mysqli_query($dbconnect, "UPDATE user SET lastlogin='$lastlogin' WHERE username='$username' ");
    

    $query = mysqli_query($dbconnect, "SELECT * FROM user WHERE username='$username' and password='$password'");
    $data = mysqli_fetch_assoc($query);
    $check = mysqli_num_rows($query);

   
      if (!$check) {
        $_SESSION['error'] = 'Username & password salah';
      } else {
          $_SESSION['auth'] = true;
          $_SESSION['userid'] = $data['id_user'];
          $_SESSION['nama'] = $data['name'];
          $_SESSION['username'] = $data['username'];
          $_SESSION['role_id'] = $data['role_id'];

          if ($_SESSION['role_id'] == 1) {
              header('location: admin/index.php?page=dashboard');
          }else if ($_SESSION['role_id'] == 2) {
              header('location: pekka/index.php?pages=dashboard');
          }
      }
      date_default_timezone_set('Asia/Jakarta');
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login | e-Laporan PEKKA</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <h2>e-Laporan PEKKA</h2>
    </div>
    <div class="card-body">
        <?php if (isset($_SESSION['error']) && $_SESSION['error'] != '') { ?>
            <div class="alert alert-danger" role="alert">
                <?=$_SESSION['error']?>
            </div>
        <?php }
            $_SESSION['error'] = '';
        ?>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="username" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" id="pass" name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" onclick="myFunction()">
              <label for="remember">
                Show Password
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<script>
function myFunction() {
  var x = document.getElementById("pass");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>



