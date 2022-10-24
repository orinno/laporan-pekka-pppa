<?php 
if (isset($_SESSION['userid'])) {
    $id = $_SESSION['userid'];
    $data = mysqli_query($dbconnect, "SELECT * FROM user where id_user='$id'");
    $row = mysqli_fetch_array($data);
}
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $password = mysqli_real_escape_string($dbconnect, $_POST['password']);
    $cpassword = mysqli_real_escape_string($dbconnect, $_POST['cpassword']);

    if ($password == $cpassword) {
        $reset = mysqli_query($dbconnect, "UPDATE user SET password='$password' WHERE id_user = '$id'");
        if ($reset) {
            header('location: ../logout.php');
            // $_SESSION['msg'] = 'Sesi anda telah berakhir. Silahkan login kembali.';
        } else {
            // header('location: ?pages=ubahAkun');
            $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Password gagal diubah!</div>';
        }
    } else {
        $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Password tidak cocok!</div>';
    }
}
?>

<!-- MOdal Edit User -->
<div class="modal fade" id="resetPass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Reset Password</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" action="" method="POST">
                    <input type="hidden" name="id"  value="<?=$_SESSION['userid']?>">
                    <div class=" mb-3">
                        <label for="" class="col-form-label">Password</label>
                        <input type="password" name="password" placeholder="Password"  class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                    </div>
                    <div class=" mb-3">
                        <label for="" class="col-form-label">Confirm Password</label>
                        <input type="password" name="cpassword" placeholder="Confirm Password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                    </div>
                    <div class="modal-footer">
                        <button name="submit" type="submit" class="btn btn-primary">Update</button>
                        <button class="btn btn-warning" type="button" data-dismiss="modal">Kembali</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>