<?php 
    // ADD USER
    if(isset($_POST['addUser'])){
        if (empty($_POST['nama']) || empty($_POST['username']) || empty($_POST['password']) || empty($_POST['role_id']) ) {
            $_SESSION['msg'] = '<div class="alert alert-warning" role="alert">Maaf, data tidak boleh kosong!</div>';
        } else {
            $nama     = $_POST['nama'];
            $user_name    = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $role = $_POST['role_id'];
            
            $insert = mysqli_query($dbconnect, "INSERT INTO user SET name='$nama', username='$user_name', password='$password', role_id='$role'");
            
            if ($insert) {
                header('location: ?pages=user');
                $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Data berhasil ditambahkan.</div>';
            } else {
                header('location: ?pages=user');
                $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Data gagal ditambahkan!</div>';
            }
        }

    }

    // UPDATE USER
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $data = mysqli_query($dbconnect, "SELECT * FROM user where id_user='$id'");
        $row = mysqli_fetch_array($data);
    }

    if(isset($_POST['updateUser'])){
        if (empty($_POST['nama']) || empty($_POST['username']) || empty($_POST['password']) || empty($_POST['role_id'])) {
            $_SESSION['msg'] = '<div class="alert alert-warning" role="alert">Maaf, data tidak boleh kosong!</div>';
        } else {
            $id = $_POST['id'];
            $nama = $_POST['nama'];
            $user_name = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $role = $_POST['role_id'];

            $update = mysqli_query($dbconnect, "UPDATE `user` SET name='$nama', username='$user_name', password='$password', role_id='$role' WHERE id_user='$id'");

            if ($update) {
                $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Data berhasil diubah!</div>';
                header('location: ?pages=user');
            } else {
                header('location: ?pages=user');
                $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Data gagal diubah!</div>';
            }
        }
    }

    // DELETE USER
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $delete = mysqli_query($dbconnect, "DELETE FROM `user` WHERE id_user='$id' ");

        if ($delete) {
            header('location: ?pages=user');
            $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Data berhasil diubah.</div>';
        }else{
            header('location: ?pages=user');
            $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Data gagal diubah.</div>';
        }
        
    }

    // Reset Password
    if (isset($_POST['reset'])) {
        $id = $_POST['id'];
        $reset = mysqli_query($dbconnect, "UPDATE `user` SET `password`='' WHERE id_user = '$id';");

        if ($reset) {
            header('location: ?pages=user');
            $_SESSION['msg'] = '<div class="alert alert-success" role="alert"><b>Password direset!</b></div>';
        } else {
            header('location: ?pages=user');
            $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Password gagal direset.</div>';
        }
    }

?>

<!-- Modal RESET -->
<div class="modal fade" id="resetBtn<?= $row['id_user'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm modal-center" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" >
                    <input type="hidden" name="id"  value="<?php echo $row['id_user'];?>">
                    <p>Apakah anda yakin? Password akan direset</p>
                    <div class="modal-footer">
                        <button name="reset" type="submit" class="btn btn-primary">Reset</button>
                        <button class="btn btn-warning" type="button" data-dismiss="modal">Kembali</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- MOdal Edit User -->
<div class="modal fade" id="editUser<?= $row['id_user'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Edit User</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" action="" method="POST">
                    <input type="hidden" name="id"  value="<?php echo $row['id_user'];?>">
                    <div class=" mb-3">
                        <label for="" class="col-form-label">Nama</label>
                        <input type="text" name="nama" placeholder="Name" value="<?php echo $row['name']; ?>" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                    </div>
                    <div class=" mb-3">
                        <label for="" class="col-form-label">Username</label>
                        <input type="text" name="username" placeholder="Username" value="<?php echo $row['username']; ?>" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                    </div>
                    <div class=" mb-3">
                        <label for="" class="col-form-label">Password</label>
                        <input type="password" name="password" placeholder="Password" value="<?php echo $row['password']; ?>" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-form-label">Role</label>
                        <select class="form-control" name="role_id">
                            <?php 
                                $sql= mysqli_query($dbconnect, "SELECT * FROM role");
                                while ($data=mysqli_fetch_array($sql)) {
                                ?>
                                <option value="<?=$data['id_role']?>" <?=$data['id_role'] == $row['role_id'] ? 'selected' : ''?>> <?= $data['role_name'] ?> </option> 
                                <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button name="updateUser" type="submit" class="btn btn-primary">Update</button>
                        <button class="btn btn-warning" type="button" data-dismiss="modal">Kembali</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add User -->
<div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Tambah User</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" >
                    <div class=" mb-3">
                        <label for="" class="col-form-label">Nama</label>
                        <input type="text" name="nama" placeholder="Name"  class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                    </div>
                    <div class=" mb-3">
                        <label for="" class="col-form-label">User</label>
                        <input type="text" name="username" placeholder="Username"  class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                    </div>
                    <div class=" mb-3">
                        <label for="" class="col-form-label">Password</label>
                        <input type="password" name="password" placeholder="Password"  class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                    </div>
                    <div class=" mb-3">
                        <label for="" class="col-form-label">Role</label>
                        <select class="form-control" name="role_id">
                            <option value="">Pilih Role Akses</option>
                        <?php while($row = mysqli_fetch_array($role)){?>
                            <option value="<?=$row['id_role']?>"><?=$row['role_name']?></option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button name="addUser" type="submit" class="btn btn-primary">Tambah</button>
                        <button class="btn btn-warning" type="button" data-dismiss="modal">Kembali</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>