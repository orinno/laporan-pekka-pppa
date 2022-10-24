<!-- header -->
<div class="content-header">
    
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Data Laporan</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Laporan</a></li>
            <li class="breadcrumb-item active">Data Laporan</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div>
<!-- end header -->

<div class="card">
    <div class="card-header">
        <h5 class="m-0">Data Laporan</h5>
    </div>
    <div class="card-body">
        <div id="box">
            <table id="tbl" class="table-responsive table table-bordered" style="width:100%; text-align: center; font-size: 14px;" >
                <div class="form-group hiden d-flex">
                    <!-- filter -->
                    <form class="row" method="post">
                        <div class="col-sm-2">
                            <select name="bulan" id="bulan" class="form-control hiden">
                                <option value="">--Pilih Bulan--</option>
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
                        <div class="col-sm-2">
                            <input type="text" id="tahun" name="tahun" class="form-control hiden" readonly value="<?= date('Y') ?>">
                        </div>
                        <div class="col-sm-3" >
                            <button type="submit" name="cari" class="btn btn-primary hiden" onchange="this.form.submit()"><i class="fas fa-search"></i> Cari</button>
                            <a href="index.php?pages=dataLaporan" class="btn btn-success hiden"><i class="fas fa-sync-alt"></i></a>
                            <button type="" class="btn btn-danger hiden" id="btPrint" onclick="createPDF()" ><i class="fas fa-print"></i> Print</button>
                        </div>
                    </form>
                    <!-- end filter -->
                </div>
                <thead style="text-align: center;">
                    <tr>
                        <th  rowspan="2">NO</th>
                        <th  rowspan="2" width="10%">NAMA KELOMPOK</th>
                        <th  rowspan="2" width="20%">ALAMAT KELOMPOK</th>
                        <th  rowspan="2" width="3%">TGL/BULAN/TH DIBENTUK</th>
                        <th  rowspan="2" width="5%">JUMLAH ANGGOTA</th>
                        <th  rowspan="2" width="8%">JENIS USAHA</th>
                        <th  colspan="2">PERKEMBANGAN MODAL</th>
                        <th  rowspan="2">+/-</th>
                        <th  rowspan="2" width="8%">KET</th>
                        <th class="hiden" rowspan="2">Bulan</th>
                        <tr>
                            <th scope>AWAL</th>
                            <th scope>AKHIR</th>
                        </tr>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                     // jika tombol cari diklik, data yang dicari akan ditampilkan pada tabel berikut ini 
                     if(isset($_POST['cari'])){
                        $bulan = $_POST['bulan'];
                        $tahun = $_POST['tahun'];

                        if ($bulan != null || $tahun != null) {
                            $filter = mysqli_query($dbconnect, "SELECT * FROM laporan_pekka WHERE bulan LIKE '%$bulan%'
                            AND tahun LIKE '%$tahun%' ");
                        }else{
                            $filter = mysqli_query($dbconnect, "select * from laporan_pekka");
                        }
                    }
                    // jika tidak ada tombol cari yang diklik, maka data yang ada akan ditampilkan pada tabel berikut ini
                    else{
                        $filter = mysqli_query($dbconnect, "select * from laporan_pekka");
                    }
                    // $filter = mysqli_query($dbconnect, "select * from kelompok_pekka");
                    $no = 0;
                    $no++;
                    while($data = mysqli_fetch_array($filter)){
                        $nama_klmpok = $data['nama_kelompok'];
                        $alamat_klmpok = $data['alamat_kelompok'];
                        $tgl_dibentuk = $data['tgl_dibentuk'];
                        $jml_anggota = $data['jumlah_anggota'];
                        $jenis_usaha = $data['jenis_usaha'];
                        $awal_modal = $data['awal_modal'];
                        $akhir_modal = $data['akhir_modal'];
                        $kurleb = $data['kurang_lebih'];
                        $ket = $data['ket'];
                        $bulan = $data['bulan'];
                        $tahun = $data['tahun'];
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $nama_klmpok ?></td>
                        <td><?= $alamat_klmpok ?></td>
                        <td><?= $tgl_dibentuk ?></td>
                        <td><?= $jml_anggota ?></td>
                        <td><?= $jenis_usaha ?></td>
                        <td class="rupiah"><?= $awal_modal ?></td>
                        <td class="rupiah"><?= $akhir_modal ?></td>
                        <td class="rupiah"><?= $kurleb ?></td>
                        <td><?= $ket ?></td>
                        <td class="hiden"><?= $bulan?>, <?=$tahun?></td>
                    </tr>

                    <?php
                        }	
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- format currency -->
<script>
    // Get all the "row_data" elements into an array
    let cells = Array.prototype.slice.call(document.querySelectorAll(".rupiah"));

    // Loop over the array
    cells.forEach(function(cell){
        const resolvedOptions = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', }).resolvedOptions();
        const currencyOptions = {
            // minimumFractionDigits: resolvedOptions.minimumFractionDigits,
            maximumFractionDigits: resolvedOptions.maximumFractionDigits
        }
        // Convert cell data to a number, call .toLocaleString()
        // on that number and put result back into the cell
        cell.textContent = (+cell.textContent).toLocaleString('id-ID', currencyOptions, {minimumFractionDigits:0});
    });
   
</script>

<script>
    var bulan = document.getElementById("bulan").value ;
    var tahun = document.getElementById("tahun").value ;
</script>

<!-- print -->
<script>
    function createPDF() {
        var sTable = document.getElementById('box').innerHTML;

        var style = "<style>";
        style = style + "* {font-size: 12px; font-family: sans-serif}";
        style = style + "table {width: 100%; margin-bottom: 3em; margin-top: 2em; font-size: 12px}";
        style = style + "th {font-size: 12px}";
        style = style + "table, th, td {border: solid 1px #DDD; border-collapse: collapse; border-color: black;";
        style = style + "padding: 2px 3px;text-align: center;}";
        style = style + ".dt-button {display: none}";
        style = style + ".dataTables_length {display: none}";
        style = style + ".dataTables_info {display: none}";
        style = style + ".dataTables_paginate {display: none}";
        style = style + "#tbl_filter {display: none}";
        style = style + ".title {text-align: center; margin: 1em}";
        style = style + ".ttd {display: flex; justify-content: space-around;}";
        style = style + ".box-ttd {text-align: center; margin-right: 2em;}";
        style = style + ".nama {margin-top: 5em; text-decoration: underline; font-weight: bold;}";
        style = style + "p {margin: 0;}";
        style = style + ".hiden {display: none;}";
        style = style + "</style>";

        // CREATE A WINDOW OBJECT.
        var win = window.open('', '', 'height=700,width=700');

        win.document.write('<html><head>');
        win.document.write('<title>Laporan PEKKA <?= date('F Y') ?></title>');   // <title> FOR PDF HEADER.
        win.document.write(style);          // ADD STYLE INSIDE THE HEAD TAG.
        win.document.write('</head>');
        win.document.write('<body>');
        win.document.write('<h5 class="title">LAPORAN PERKEMBANGAN KELOMPOK PEKKA KABUPATEN CIAMIS</h5>');
        win.document.write('<h5 class="title">TAHUN <?= $tahun ?></h5>');
        win.document.write('<h5 class="title">BULAN : <?= $bulan ?></h5>');
        win.document.write(sTable);         // THE TABLE CONTENTS INSIDE THE BODY TAG.
        win.document.write('<div class="container"><div class="row ttd"><div class="col-md-4 box-ttd"><p>Mengetahui:</p><p>Kasi Pemberdayaan Perempuan</p><p class="nama">Dra.Hj. ERNI MULYANINGSIH, S.Pd</p><p>NIP. 19670224 199303 2 005 -IV/a</p></div><div class="col-md-4 box-ttd"><p>Ciamis, <?= date('j F Y') ?></p><p>Pendamping PEKKA</p><p class="nama">RATNA KOMALASARI</p></div></div></div>');
        win.document.write('</body></html>');

        win.document.close(); 	// CLOSE THE CURRENT WINDOW.

        win.print();    // PRINT THE CONTENTS.
    }
</script>