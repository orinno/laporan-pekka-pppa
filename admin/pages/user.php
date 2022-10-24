<?php 
$role = mysqli_query($dbconnect, "SELECT * FROM role");
$role2 = mysqli_query($dbconnect, "SELECT * FROM role");
$view = mysqli_query($dbconnect, "SELECT u.*, r.role_name as nama_role FROM user AS u INNER JOIN role AS r ON u.role_id = r.id_role");
?>

<!-- header -->
<div class="content-header">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Users</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Users</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div>
<!-- end header -->

<div class="card">
    <div class="card-header d-flex">
        <h5 class="m-0">Data User</h5>
        <button type="button" class="btn btn-xs btn-success ml-2 p-1 float-right" data-toggle="modal" data-target="#addUser">
            <i class="fa fa-user-plus fa-fw "></i> Tambah
        </button>
    </div>
    <div class="card-body">
        <?php if(isset($_SESSION['msg']) && $_SESSION['msg'] != '') {?>
				<?=$_SESSION['msg']?>
		<?php
			}
			$_SESSION['msg'] = '';
		?>
        <div id="box">
            <table id="tbl" class="display table table-bordered" style="width:100%;" >
            <style>.dt-button{display: none}</style>
                <thead class="">
                    <tr>
                        <th hidden scope="col">Id</th>
                        <th class="active">No</th>
                        <th class="active">Nama</th>
                        <th class="active">Username</th>
                        <th hidden class="active">Password</th>
                        <th class="active">Role Akses</th>
                        <th class="active">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 0;
                    $no++;
                    while($row = $view->fetch_array()) { ?>
                    <tr>
                        <td hidden><?= $row['id_user'] ?></td>
                        <td><?= $no++ ?></td>
                        <td><?= $row['name'] ?></td>
                        <td><?= $row['username'] ?></td>
                        <td hidden><?= md5($row['password'])  ?></td>
                        <td><?= $row['nama_role'] ?></td>
                        <td>
                            <div class="dropdown no-arrow">
                                <a class="" data-toggle="dropdown" href="#">
                                    <i class="fas fa-ellipsis-v" style="color: #555;"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-sm dropdown-menu-right" aria-labelledby="dLabel">
                                    <li><a href="" class="dropdown-item" data-toggle="modal" data-target="#editUser<?= $row['id_user'];?>">
                                        <i class="fas fa fa-edit p-1"></i> Edit</a>
                                    </li>
                                    <li><a class="dropdown-item" href="index.php?pages=user&id=<?php echo $row['id_user'];?>" 
                                        onclick="javascript:return confirm('Hapus Data User ?')">
                                        <i class="fas fa-trash-alt p-1"></i> Hapus</a>
                                    </li>
                                    <li><a class="dropdown-item" href="" data-toggle="modal" style="color: red;" data-target="#resetBtn<?= $row['id_user'];?>">
                                        <i class="fas fa-sync-alt p-1"></i> Reset Pass</button> </a>
                                    </li>
                                </ul>
                                
                            </div>
                        </td>
                    </tr>
                    <?php  ?>
                    <?php include 'modalUser.php'; } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

