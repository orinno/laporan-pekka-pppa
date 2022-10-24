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
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
