<?php
// UPDATE USER
    if (isset($_SESSION['userid'])) {
        $id = $_SESSION['userid'];
        $data = mysqli_query($dbconnect, "SELECT * FROM user where id_user='$id'");
        $row = mysqli_fetch_array($data);
    }

    if(isset($_POST['updateUser'])){
        if (empty($_POST['nama']) || empty($_POST['username']) || empty($_POST['password1']) || empty($_POST['password2'])) {
            $_SESSION['msg'] = '<div class="alert alert-warning" role="alert">Maaf, data tidak boleh kosong!</div>';
        } else {
            $id = $_POST['id'];
            $nama = $_POST['nama'];
            $user_name = $_POST['username'];

            $update = mysqli_query($dbconnect, "UPDATE `user` SET name='$nama', 
            username='$user_name' WHERE id_user='$id'");

            if ($update) {
                $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Data berhasil diubah!</div>';
                // header('location: ?pages=ubahAkun');
            } else {
                // header('location: ?pages=ubahAkun');
                $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Data gagal diubah!</div>';
            }
        }
    }
?>

<!-- header -->
<div class="content-header">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Ubah Akun</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item">Ubah Akun</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    
</div>
<!-- end header -->

<?php if(isset($_SESSION['msg']) && $_SESSION['msg'] != '') {?>
        <?=$_SESSION['msg']?>
    <?php
        }
        $_SESSION['msg'] = '';
    ?>

<div class="card">
    <div class="card-header">
        <h5 class="float-left">Ubah Akun</h5>
        <button class="btn btn-sm btn-primary float-right"  data-toggle="modal" data-target="#resetPass">
            Reset Password
        </button>
        <?php include 'modalReset.php' ?>
    </div>
    <div class="card-body">
        <div class="">
        <form role="form" action="" method="POST">
            <input type="hidden" name="id"  value="<?= $_SESSION['userid'];?>">
            <div class="col-md-4 mb-3">
                <label for="" class="col-form-label">Nama</label>
                <input type="text" name="nama" placeholder="Name" value="<?php echo $row['name']; ?>" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="" class="col-form-label">Username</label>
                <input type="text" name="username" placeholder="Username" value="<?php echo $row['username']; ?>" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
            </div>
            <!-- <div class="col-md-4 mb-3">
                <label for="" class="col-form-label">Password</label>
                <input type="password" name="password1" placeholder="Password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="" class="col-form-label">Confirm Password</label>
                <input type="password" name="password2" placeholder="Confirm Password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
            </div> -->
            <div class="modal-footer col-md-4">
                <button name="updateUser" type="submit" class="btn btn-primary">Update</button>
                <a href="?pages=dashboard" class="btn btn-warning">Kembali</a>
            </div>
        </form>
        </div>
    </div>
</div>

                