<!-- header -->
<div class="content-header">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Kelompok PEKKA</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Kelompok PEKKA</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div>
<!-- end header -->
<div class="card">
    <div class="card-header" style="display: flex;">
        <h5 class="m-0">Kelompok PEKKA</h5>
        <a href="?pages=addKlmpkPekka" class="btn btn-xs btn-success ml-2">Tambah</a>
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
                        <th class="active">Nama Kelompok</th>
                        <th class="active">Alamat Kelompok</th>
                        <th class="active">Tgl Dibentuk</th>
                        <th class="active">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 0;
                    $no++;
                    $view = mysqli_query($dbconnect, "SELECT * FROM kelompok_pekka");
                    while($row = $view->fetch_array()) { ?>
                    <tr>
                        <td hidden><?= $row['id'] ?></td>
                        <td><?= $no++ ?></td>
                        <td><?= $row['nama_kelompok'] ?></td>
                        <td><?= $row['alamat_kelompok'] ?></td>
                        <td><?= $row['tgl_dibentuk'] ?></td>
                        <td>
                            <div class="dropdown no-arrow">
                                <a class="" data-toggle="dropdown" href="#">
                                    <i class="fas fa-ellipsis-v" style="color: #555;"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-sm dropdown-menu-right" aria-labelledby="dLabel">
                                    <li><a href="" class="dropdown-item" data-toggle="modal" data-target="#editUser<?= $row['id'];?>">
                                        <i class="fas fa fa-edit p-1"></i> Edit</a>
                                    </li>
                                    <li><a class="dropdown-item" href="index.php?pages=kelompokPekka&id=<?php echo $row['id'];?>" 
                                        onclick="javascript:return confirm('Hapus Data?')">
                                        <i class="fas fa-trash-alt p-1"></i> Hapus</a>
                                    </li>
                                </ul>
                                
                            </div>
                        </td>
                    </tr>
                    <?php include 'modalPekka.php'; } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
