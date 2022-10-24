<?php 
if(isset($_POST['add'])){
    $nama = $_POST['nama'];
    $almt = $_POST['alamat'];
    $tgl = $_POST['tgl'];
    
    $insert = mysqli_query($dbconnect, "INSERT INTO kelompok_pekka SET 
    nama_kelompok='$nama', alamat_kelompok='$almt', tgl_dibentuk='$tgl'");

    if($insert){
        $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Data berhasil ditambahkan.</div>';
    } else {
        $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Data gagal ditambahkan.</div>';
    }
}
?>

<!-- header -->
<div class="content-header">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Kelompok PEKKA</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item">Kelompok PEKKA</li>
            <li class="breadcrumb-item">Tambah</li>
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
        <h5>Tambah Data Kelompok Pekka</h5>
    </div>
    <div class="card-body">
        <div class="">
        <form action="" method="POST" >
            <div class="col-4 mb-3">
                <label for="" class="col-form-label">Nama Kelompok</label>
                <input type="text" name="nama" placeholder=""  class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
            </div>
            <div class="col-4 mb-3">
                <label for="" class="col-form-label">Alamat Kelompok</label>
                <input type="text" name="alamat" placeholder=""  class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
            </div>
            <div class="col-4 mb-3">
                <label for="" class="col-form-label">Tanggal dibentuk</label>
                <input type="text" minlength="10" maxlength="10" name="tgl" placeholder="01-01-2000"  class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
            </div>
            <button name="add" class="btn btn-primary ml-2" type="submit">Tambah</button>
            <a href="?pages=kelompokPekka" class="btn btn-warning" type="submit">Kembali</a>
        </form>
        </div>
    </div>
</div>