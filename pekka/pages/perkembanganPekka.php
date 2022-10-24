<?php 

if (isset($_POST['submit'])) {
    $nama_klmpok = $_POST['nama_klmpok'];
    $alamat_klmpok = $_POST['alamat_klmpok'];
    $tgl_dibentuk = $_POST['tanggal'];
    $jml_anggota = $_POST['jml_anggota'];
    $jenis_usaha = $_POST['jenis_usaha'];
    $awal_modal = preg_replace('/\D/', '', $_POST['awal_modal']); // supaya format nya nomor engga pake titik
    $akhir_modal = preg_replace('/\D/', '', $_POST['akhir_modal']);
    // $kurleb = preg_replace('/\D/', '', $_POST['kurleb']);
    $kurleb = $awal_modal - $akhir_modal;
    $ket = $_POST['ket'];
    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];

    $insert = mysqli_query($dbconnect, "INSERT INTO laporan_pekka SET nama_kelompok='$nama_klmpok', alamat_kelompok='$alamat_klmpok',
    tgl_dibentuk='$tgl_dibentuk', jumlah_anggota='$jml_anggota', jenis_usaha='$jenis_usaha', awal_modal='$awal_modal', akhir_modal='$akhir_modal', 
    kurang_lebih='$kurleb', ket='$ket', bulan='$bulan', tahun='$tahun' ");

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
        <h1 class="m-0">Perkembangan PEKKA</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Laporan</a></li>
            <li class="breadcrumb-item active">Perkembangan</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div>
<!-- end header -->

<?php if (isset($_SESSION['msg']) && $_SESSION['msg'] != '') { ?>
        <?=$_SESSION['msg']?>
<?php }
    $_SESSION['msg'] = '';
?> 

<div class="card">
    <div class="card-header">
        Update Data Perkembangan Kelompok PEKKA
    </div>
    <div class="card-body">
        <div class="form-group row">
            <div class="col-md-3 mb-1">
                <form action="" method="post" >
                    <label for="" class="form-label">Pilih Kelompok PEKKA:</label>
                    <select class="form-control" id="pilih" name="pilih" onchange="this.form.submit()" required>
                        <option value="pilih">--Pilih--</option>
                        <?php 
                            $sql= mysqli_query($dbconnect, "SELECT * FROM kelompok_pekka");
                            while ($data=$sql->fetch_assoc()) {?>
                            <option value="<?=$data['id']?>" 
                            <?php 
                            if ($data['nama_kelompok'] == $data['id']) {
                                echo "selected";
                            }
                            ?>
                            > <?= $data['nama_kelompok'] ?> </option> 
                            <?php } ?>
                    </select>
                </form>
            </div>
            <div class="col-md-1" style="margin-top: 2em;">
                <a href="index.php?pages=perkembanganPekka" class="btn btn-primary"><i class="fas fa-sync-alt"></i> </a>
            </div>
        </div>
        <form class="row g-3 needs-validation" method="post" novalidate>
                <div class="col-md-2 mb-1">
                    <label for="" class="form-label">Laporan Bulan:</label>
                    <select name="bulan" class="form-control" id="" required>
                        <option value="pilih">--Pilih--</option>
                        <option value="Januari">Januari</option>
                        <option value="Februari">Februari</option>
                        <option value="Maret">Maret</option>
                        <option value="April">April</option>
                        <option value="Mei">Mei</option>
                        <option value="Juni">Juni</option>
                        <option value="Juli">Juli</option>
                        <option value="Agustus">Agustus</option>
                        <option value="September">September</option>
                        <option value="Oktober">Oktober</option>
                        <option value="November">November</option>
                        <option value="Desember">Desember</option>
                    </select>
                </div>
                <div class="col-md-2 mb-1">
                    <label for="">Tahun</label>
                    <input type="text" readonly name="tahun" class="form-control" value="<?= date('Y') ?>">
                </div>
            <?php 
            if (isset($_POST['pilih'])) {
                $query = mysqli_query($dbconnect, "SELECT * FROM kelompok_pekka WHERE id='$_POST[pilih]'");
                $show = mysqli_fetch_assoc($query); ?>

            <div class="col-md-4 mb-1">
                <label for="validationCustom01" class="form-label fw-bold">Nama Kelompok</label>
                <input type="text" name="nama_klmpok" readonly value="<?= $show['nama_kelompok']?>" class="form-control" id="validationCustom01" required>
            </div>
            <div class="col-md-4 mb-1">
                <label for="validationCustom02" class="form-label">Tgl/Bln/Th Dibentuk</label>
                <input type="text" name="tanggal" readonly value="<?= $show['tgl_dibentuk']?>" class="form-control" id="validationCustom03" required>
            </div>
            <div class="col-md-4 mb-1">
                <label for="validationCustom03" class="form-label">Alamat Kelompok</label>
                <input type="text" name="alamat_klmpok" readonly value="<?= $show['alamat_kelompok']?>" class="form-control" id="validationCustom03" required>
            </div>
            <div class="col-md-4 mb-1">
                <label for="validationCustom02" class="form-label">Jumlah Anggota</label>
                <input type="text" name="jml_anggota"  class="form-control" id="validationCustom03" required>
            </div>
            <div class="col-md-4 mb-1">
                <label for="validationCustom02" class="form-label">Jenis Usaha (Jml)</label>
                <input type="text" aria-rowspan="2" name="jenis_usaha"  class="form-control" id="validationCustom03" required>
            </div> <br>
            <div class="col-md-6 mb-1">
                <label for="validationCustom03" class="form-label">Perkembangan Modal</label>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="validationCustom02" class="form-label">Awal</label>
                        <input type="text" id="rupiah" name="awal_modal"  class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="validationCustom02" class="form-label">Akhir</label>
                        <input type="text" id="rupiah2" name="akhir_modal"  class="form-control"  required>
                    </div>
                </div>
            </div>
            <div class="col-md-6" style="margin-top: 1.7em">
                <div class="row">
                    <!-- <div class="col-md-6 mb-3">
                        <label for="validationCustom02" class="form-label">+/-</label>
                        <input type="text" id="rupiah3" name="kurleb" class="form-control" id="validationCustom03" required>
                    </div> -->
                    <div class="col-md-6 mb-3">
                        <label for="validationCustom02" class="form-label">Keterangan</label>
                        <select name="ket" class="form-control" id="" required>
                            <option value="">--Pilih--</option>
                            <option value="APBD I">APBD I</option>
                            <option value="APBD II">APBD II</option>
                            <option value="BUMDES">BUMDES</option>
                            <option value="Belum dapat bantuan">Belum dapat bantuan</option>
                        </select>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-12" >
                <button type="submit" name="submit" class="btn btn-primary">Submit Form</button>
            </div>
            <?php } ?>
        </form>
    </div>
</div>

<style>
    .mb-1{
        margin-bottom: 1.5em;
    }
</style>


<script type="text/javascript">
    
    var rupiah = document.getElementById('rupiah');
    rupiah.addEventListener('keyup', function(e){
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        rupiah.value = formatRupiah(this.value);
        formatRupiah(this.value) = text; 
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split   		= number_string.split('.'),
        sisa     		= split[0].length % 3,
        rupiah     		= split[0].substr(0, sisa),
        ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + '.' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>

<script type="text/javascript">
    
    var rupiah2 = document.getElementById('rupiah2');
    rupiah2.addEventListener('keyup', function(e){
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        rupiah2.value = formatRupiah(this.value);
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split   		= number_string.split(','),
        sisa     		= split[0].length % 3,
        rupiah     		= split[0].substr(0, sisa),
        ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>

<script type="text/javascript">
    
    var rupiah3 = document.getElementById('rupiah3');
    rupiah3.addEventListener('keyup', function(e){
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        rupiah3.value = formatRupiah(this.value);
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split   		= number_string.split(','),
        sisa     		= split[0].length % 3,
        rupiah     		= split[0].substr(0, sisa),
        ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>


