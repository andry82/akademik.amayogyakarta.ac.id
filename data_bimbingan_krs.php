<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>DATA BIMBINGAN KRS | SISTEM INFORMASI AKADEMIK - AMA Yogyakarta</title>

        <!-- Bootstrap Core CSS -->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
        <link href="stylesheet/sb-admin-2.css" rel="stylesheet">
        <link href="vendor/morrisjs/morris.css" rel="stylesheet">
        <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <!-- DataTables CSS -->
        <link href="vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
        <!-- DataTables Responsive CSS -->
        <link href="vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
    </head>
    <?php
    session_start();
    include('bar128.php');
    include 'config.php';
// cek apakah yang mengakses halaman ini sudah login
    if ($_SESSION['level'] == "") {
        header("location:login.php");
    }
    ?>
    <script type='text/javascript'>
        //fungsi displayTime yang dipanggil di bodyOnLoad dieksekusi tiap 1000ms = 1detik
        function tampilkanwaktu() {
            //buat object date berdasarkan waktu saat ini
            var waktu = new Date();
            //ambil nilai jam, 
            //tambahan script + "" supaya variable sh bertipe string sehingga bisa dihitung panjangnya : sh.length
            var sh = waktu.getHours() + "";
            //ambil nilai menit
            var sm = waktu.getMinutes() + "";
            //ambil nilai detik
            var ss = waktu.getSeconds() + "";
            //tampilkan jam:menit:detik dengan menambahkan angka 0 jika angkanya cuma satu digit (0-9)
            document.getElementById("clock").innerHTML = (sh.length == 1 ? "0" + sh : sh) + ":" + (sm.length == 1 ? "0" + sm : sm) + ":" + (ss.length == 1 ? "0" + ss : ss);
        }
    </script>
    <body onload="tampilkanwaktu(); setInterval('tampilkanwaktu()', 1000);">	
        <div id="wrapper">
            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <?php
                include 'sidebar_menu.php';
                $nim = $_GET['nim'];
                ?>
                <!-- /.navbar-static-side -->
            </nav>

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="page-header"><i class="fa fa-user fa-fw"></i> DATA BIMBINGAN KRS</h4>
                    </div>
                    <div class="col-lg-12">  
                        <?php
                        $mhs = mysqli_query($mysqli, "SELECT * FROM  msmhs m, kelasparalel_mhs kpm, kelasparalel k, msdos md WHERE k.nodos=md.NODOSMSDOS AND kpm.nmkelas=k.namakelas AND m.NIMHSMSMHS=kpm.nimhs AND m.NIMHSMSMHS=$nim");
                        while ($datamhs = mysqli_fetch_array($mhs)) {
                            $nama_mahasiswa = $datamhs['NMMHSMSMHS'];
                            $nama_dpa = $datamhs['NMDOSMSDOS'];
                            $gelar_dpa = $datamhs['GELARMSDOS'];
                            $status_data = $datamhs['tgl_update'];
                            $thmskmhs = $datamhs['TAHUNMSMHS'];
                            $nama_kelas = $datamhs['nmkelas'];
                            $jurusan = $datamhs['kdkonsen'];
                            $kurikulum = $datamhs['KURIKULUM'];
                        }
                        $foto_diri = "http://simaster.amayogyakarta.ac.id/images/foto_mhs/$nim.JPG";
                        $kelas_splite = explode("/", $nama_kelas);
                        $semester = (($ta - $thmskmhs) * 2) + $smtgg;
                        if ($smtgg == '2') {
                            $smt = 1;
                            $semester_lalu = ($ta . $smt);
                        } else {
                            $smt = 2;
                            $semester_lalu = (($ta - 1) . $smt);
                        }
                        ?>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th width="50px" rowspan="5"style="padding: 0px">
                                    <?php if ($foto_diri != "") { ?>       
                                        <img src="<?php echo $foto_diri; ?>" height="200">
                                    <?php } else { ?>
                                        <img src="https://via.placeholder.com/150x200">
                                    <?php } ?>           
                                </th>
                                <th>NIM</th><td><?php echo $nim; ?></td></tr>
                            <tr><th>NAMA MAHASISWA</th>
                                <td><?php echo strtoupper($nama_mahasiswa); ?>&nbsp;&nbsp;
                                    <?php if ($status_data) { ?>
                                        <a href="proses_status_data_mahasiswa.php?nim=<?php echo $nim; ?>&status_data=1"><span class="label label-success">VALID</span></a>
                                    <?php } else { ?>
                                        <a href="proses_status_data_mahasiswa.php?nim=<?php echo $nim; ?>&status_data=2"><span class="label label-default">BELUM VALID</span></a>
                                    <?php } ?>
                                </td></tr>
                            <tr><th>KELAS</th><td><?php echo $kelas_splite[0]; ?><?php echo (($ta - $thmskmhs) * 2) + $smtgg; ?></td></tr>
                            <tr><th>KONSENTRASI</th><td>
                                    <?php
                                    $konsen = mysqli_query($mysqli, "select * from konsentrasi where kdkonsen='$jurusan'");
                                    $data_konsen = mysqli_fetch_array($konsen);
                                    echo $data_konsen['jenjang'] . ' - ' . strtoupper($data_konsen['nmkonsen']);
                                    ?>
                                </td>
                            </tr>
                            <tr><th>DOSEN PEMBIMBING AKADEMIK</th><td><?php echo $nama_dpa; ?>, <?php echo $gelar_dpa; ?></td></tr>
                        </table>
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>TAHUN AJARAN</th> 
                                    <th>JUMLAH SKS</th> 
                                    <th>TOTAL SKS</th> 
                                    <th>IP SEMESTER</th> 
                                    <th>IP KOMULATIF</th> 
                                    <th></th> 
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $nilai = mysqli_query($mysqli, "SELECT * FROM  trakm WHERE NIMHSTRAKM='$nim' and KURIKULUM='$kurikulum' ORDER BY THSMSTRAKM ASC");
                                $nomor = 1;
                                $semester = '01';
                                while ($data = mysqli_fetch_array($nilai)) {
                                    ?>                   
                                    <tr>
                                        <td><?php echo $data['THSMSTRAKM']; ?></td>
                                        <td><?php echo $data['SKSEMTRAKM']; ?></td>
                                        <td><?php echo $data['SKSTTTRAKM']; ?></td>
                                        <td><?php echo $data['NLIPSTRAKM']; ?></td>
                                        <td><?php echo $data['NLIPKTRAKM']; ?></td>
                                        <td><a href="data_khs.php?nim=<?php echo $nim ?>&tahun=<?php echo $data['THSMSTRAKM']; ?>" class="btn btn-success btn-xs" role="button" aria-pressed="true"><i class="fa fa-eye fa-fw"></i> LIHAT KHS</a>
                                        </td>
                                    </tr>
<?php } ?>
                            </tbody>
                        </table>
                        <!--<a href="import/trnlm.php?nim=<?php echo $nim ?>" class="btn btn-primary" role="button" aria-pressed="true"><i class="fa fa-gear fa-fw"></i> GENERATE TRLNLM</a>
                        <a href="import/generate_trakm.php?nim=<?php echo $nim ?>" class="btn btn-primary" role="button" aria-pressed="true"><i class="fa fa-gear fa-fw"></i> GENERATE TRAKM</a>
                        <a href="import/import_nilai_simakpro_nim.php?nim=<?php echo $nim ?>" class="btn btn-success" role="button" aria-pressed="true"><i class="fa fa-gear fa-fw"></i> IMPORT NILAI</a>-->
                        <a href="generate_ipk.php?nim=<?php echo $nim ?>" class="btn btn-success" role="button" aria-pressed="true"><i class="fa fa-gear fa-fw"></i> GENERATE IPK</a>
                        <a href="daftar_semua_mk.php?nim=<?php echo $nim ?>" class="btn btn-success" role="button" aria-pressed="true"><i class="fa fa-book fa-fw"></i> MK BELUM DIAMBIL</a>
                        <a href="daftar_mk_wajib_diulang.php?nim=<?php echo $nim ?>" class="btn btn-success" role="button" aria-pressed="true"><i class="fa fa-book fa-fw"></i> DAFTAR MK WAJIB DIULANG</a>
                        <br/><br/>
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th width="5%">SMT</th>
                                    <th width="55%">MATA KULIAH</th>
                                    <th width="5%" style="text-align: center">SKS</th>
                                    <th width="10%" style="text-align: center">NILAI</th>
                                    <th width="10%" style="text-align: center">HURUF</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $nilai = mysqli_query($mysqli, "SELECT * FROM  trnlm trn, tbkmk tbk WHERE trn.KDKMKTRNLM=tbk.KDKMKTBKMK AND trn.KURIKULUM=tbk.KURIKULUM AND trn.THSMSTRNLM=tbk.THSMSTBKMK AND trn.THSMSTRNLM='$semester_lalu' AND trn.NIMHSTRNLM='$nim' AND tbk.KURIKULUM='$kurikulum' AND (tbk.kdkonsen='u' OR tbk.kdkonsen='$jurusan') ORDER BY tbk.SEMESTBKMK, trn.KDKMKTRNLM ASC");
                                $nomor = 1;
                                $semester = '01';
                                while ($data = mysqli_fetch_array($nilai)) {
                                    ?>
                                    <tr>
                                        <td style="text-align: center"><?php echo $data['SEMESTBKMK']; ?></td>
                                        <td><?php echo $data['KDKMKTRNLM']; ?> - <?php echo $data['NAKMKTBKMK']; ?></td>
                                        <td style="text-align: center"><?php echo $data['SKSMKTBKMK']; ?></td>
                                        <td style="text-align: center"><?php echo $data['TOTAL']; ?></td>
                                        <td style="text-align: center"><?php echo $data['NLAKHTRNLM']; ?></td>
                                    </tr>  
    <?php $total_sks += $data['SKSMKTBKMK'];
} ?>
                                <tr>
                                    <th style="text-align: center" colspan="2"> TOTAL SKS DIAMBIL SEMESTER LALU</th>
                                    <th style="text-align: center"><?php echo $total_sks; ?></th>
                                    <th style="text-align: center"></th>
                                    <th style="text-align: center"></th>
                                </tr>
                            </tbody>
                        </table>
                        <?php
                        $tpmkrs = mysqli_query($mysqli, "SELECT * FROM  tmpkrs WHERE thsms='$ta_lengkap' AND nimhs='$nim'");
                        $trnlm = mysqli_query($mysqli, "SELECT * FROM  trnlm WHERE THSMSTRNLM='$ta_lengkap' AND NIMHSTRNLM='$nim'");
                        $trnlm_lta = mysqli_query($mysqli, "SELECT * FROM  trnlm WHERE KDKMKTRNLM='MKB373' AND THSMSTRNLM='$ta_lengkap' AND NIMHSTRNLM='$nim'");
                        $trnlmcount = mysqli_num_rows($trnlm);
                        $trnlm_lta_count = mysqli_num_rows($trnlm_lta);
                        $tpmkrscount = mysqli_num_rows($tpmkrs);
                        if ($tpmkrscount > 0) {
                            if ($trnlmcount > 0) {
                                ?>
                                <a href="terapkan_acc_krs.php?nim=<?php echo $nim ?>" class="btn btn-danger" role="button" aria-pressed="true"><i class="fa fa-remove fa-fw"></i> BATALKAN ACC KRS</a>
                                <?php if ($trnlm_lta_count == 1) { ?>
                                    <?php
                                    $pendaftar_ta = mysqli_query($mysqli, "select * from pendaftaran_ta WHERE nim=$nim AND tahun=$ta");
                                    $count_ta = mysqli_num_rows($pendaftar_ta);
                                    $pendaftar_bimbingan = mysqli_query($mysqli, "select * from pendaftaran_ta WHERE nim=$nim AND tahun=$ta AND bimbingan='1'");
                                    $count_bimbingan = mysqli_num_rows($pendaftar_bimbingan);
                                    if ($count_bimbingan){?>
                                       <a href="proses_batal_bimbingan.php?nim=<?php echo $nim ?>" class="btn btn-danger"><i class="fa fa-remove fa-fw"></i> BATALKAN BIMBINGAN TA</a>
                                    <?php }else{ ?>
                                       <a href="proses_daftar_bimbingan.php?nim=<?php echo $nim ?>" class="btn btn-primary"><i class="fa fa-folder fa-fw"></i> DAFTAR BIMBINGAN TA</a>
                                    <?php } ?>
                                <?php } ?>
                                <a href="cetak_krs.php?ta=<?php echo $ta_lengkap ?>&nim=<?php echo $nim ?>" target="_blank" class="btn btn-success" role="button" aria-pressed="true"><i class="fa fa-print fa-fw"></i> CETAK KRS</a>
    <?php } else { ?>
                                <a href="terapkan_acc_krs.php?nim=<?php echo $nim ?>" class="btn btn-success" role="button" aria-pressed="true"><i class="fa fa-check fa-fw"></i> TERAPKAN ACC KRS</a>&nbsp;
                                <a href="krs.php?nim=<?php echo $nim ?>" class="btn btn-success" role="button" aria-pressed="true"><i class="fa fa-check fa-fw"></i> INPUT KRS</a>
    <?php }
} else { ?>
                            <a href="krs.php?nim=<?php echo $nim ?>" class="btn btn-success" role="button" aria-pressed="true"><i class="fa fa-check fa-fw"></i> INPUT KRS</a>
<?php } ?>
                        <br/><br/>
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th width="5%">NO</th>
                                    <th width="60%">MATA KULIAH</th>
                                    <th width="5%" style="text-align: center">SMT</th>
                                    <th width="5%"style="text-align: center">SKS</th>
                                    <th width="10%"style="text-align: center">STATUS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $res = mysqli_query($mysqli, "SELECT * FROM  tmpkrs tmp, tbkmk tbk WHERE tmp.kdkmk=tbk.KDKMKTBKMK AND tmp.KURIKULUM=tbk.KURIKULUM AND tmp.thsms=tbk.THSMSTBKMK AND tmp.thsms='$ta_lengkap' AND tmp.nimhs='$nim' AND tbk.KURIKULUM='$kurikulum' AND (tbk.kdkonsen='u' OR tbk.kdkonsen='$jurusan')");
                                while ($data = mysqli_fetch_array($res)) {
                                    $kodemk = $data['kdkmk'];
                                    $totulang = mysqli_query($mysqli, "SELECT * from tmpkrs where nimhs='$nim' and KURIKULUM='$kurikulum' and thsms<='$ta_lengkap' and kdkmk='$kodemk'");
                                    $ulang = mysqli_num_rows($totulang);
                                    $totalsks += $data['SKSMKTBKMK'];
                                    ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $kodemk; ?> - <?php echo $data['NAKMKTBKMK']; ?></td>
                                        <td style="text-align: center"><?php echo $data['SEMESTBKMK']; ?></td>
                                        <td style="text-align: center"><?php echo $data['SKSMKTBKMK']; ?></td>
                                        <td style="text-align: center">
                                    <?php if ($ulang == "1") { ?>
                                                Baru
                                    <?php } elseif ($ulang == "2") { ?>
                                                Mengulang
    <?php } ?>
                                        </td>
                                    </tr>

    <?php
}
?>
                                <tr>
                                    <th></th>
                                    <th colspan="2">TOTAL SKS YANG DIAMBIL </th>
                                    <th  style="text-align: center"><?php echo $totalsks; ?></th>
                                    <th></th>
                                </tr>
                            </tbody>
                        </table>                        
                        <br/>
                        <br/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">

                    </div>
                </div>
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="vendor/metisMenu/metisMenu.min.js"></script>
        <script src="vendor/raphael/raphael.min.js"></script>
        <script src="vendor/morrisjs/morris.min.js"></script>
        <script src="dist/js/sb-admin-2.js"></script>
        <!-- DataTables JavaScript -->
        <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
        <script src="vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
        <script src="vendor/datatables-responsive/dataTables.responsive.js"></script>
        <script>
        </script>
    </body>
</html>
