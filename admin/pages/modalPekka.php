<?php 
    // UPDATE USER
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $data = mysqli_query($dbconnect, "SELECT * FROM kelompok_pekka where id='$id'");
        $row = mysqli_fetch_array($data);
    }

    if(isset($_POST['updateUser'])){
        if (empty($_POST['nama_kelompok']) || empty($_POST['alamat_kelompok']) || empty($_POST['tgl_dibentuk'])) {
            $_SESSION['msg'] = '<div class="alert alert-warning" role="alert">Maaf, data tidak boleh kosong!</div>';
        } else {
            $id = $_POST['id'];
            $nama = $_POST['nama_kelompok'];
            $alamat = $_POST['alamat_kelompok'];
            $tgl = $_POST['tgl_dibentuk'];

            $update = mysqli_query($dbconnect, "UPDATE `kelompok_pekka` 
            SET nama_kelompok='$nama', alamat_kelompok='$alamat', tgl_dibentuk='$tgl' WHERE id='$id'");

            if ($update) {
                $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Data berhasil diubah!</div>';
                header('location: ?pages=kelompokPekka');
            } else {
                header('location: ?pages=kelompokPekka');
                $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Data gagal diubah!</div>';
            }
        }
    }

    // DELETE USER
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $delete = mysqli_query($dbconnect, "DELETE FROM `kelompok_pekka` WHERE id='$id' ");

        if ($delete) {
            header('location: ?pages=kelompokPekka');
            $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Data berhasil diubah.</div>';
        }else{
            header('location: ?pages=kelompokPekka');
            $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Data gagal diubah.</div>';
        }
        
    }

?>

<!-- MOdal Edit User -->
<div class="modal fade" id="editUser<?= $row['id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                    <input type="hidden" name="id"  value="<?php echo $row['id'];?>">
                    <div class=" mb-3">
                        <label for="" class="col-form-label">Nama</label>
                        <input type="text" name="nama_kelompok" placeholder="" value="<?php echo $row['nama_kelompok']; ?>" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                    </div>
                    <div class=" mb-3">
                        <label for="" class="col-form-label">Alamat</label>
                        <input type="text" name="alamat_kelompok" placeholder="" value="<?php echo $row['alamat_kelompok']; ?>" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                    </div>
                    <div class=" mb-3">
                        <label for="" class="col-form-label">Tgl dibentuk</label>
                        <input type="text" minlength="10" maxlength="10" name="tgl_dibentuk" placeholder="dd-mm-yyyy" value="<?php echo $row['tgl_dibentuk']; ?>" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
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

