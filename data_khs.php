<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>DATA KHS | SISTEM INFORMASI AKADEMIK - AMA Yogyakarta</title>

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
                $tahun = $_GET['tahun'];
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
                        $mhs = mysqli_query($mysqli, "SELECT * FROM  msmhs m, kelasparalel_mhs kpm, konsentrasi k WHERE m.NIMHSMSMHS=kpm.nimhs AND m.kdkonsen=k.kdkonsen AND m.NIMHSMSMHS=$nim");
                        while ($datamhs = mysqli_fetch_array($mhs)) {
                            $nama_mahasiswa = $datamhs['NMMHSMSMHS'];
                            $thmskmhs = $datamhs['TAHUNMSMHS'];
                            $nama_kelas = $datamhs['nmkelas'];
                            $konsentrasi = $datamhs['nmkonsen'];
                            $kdkonsen = $datamhs['kdkonsen'];
                        }
                        $kelas_splite = explode("-", $nama_kelas);
                        $knons = explode("/", $nama_kelas);
                        $kelas = explode("/", $nama_kelas);
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
                            <tr><th>NIM</th><td><?php echo $nim; ?></td></tr>
                            <tr><th>NAMA MAHASISWA</th><td><?php echo $nama_mahasiswa; ?></td></tr>
                            <tr><th>KELAS</th><td><?php echo $kelas[0]; ?><?php echo $semester ?></td></tr>
                            <tr><th>KONSENTRASI</th><td style="text-transform: uppercase"><?php echo $konsentrasi; ?></td></tr>
                        </table>
                        <a href="data_bimbingan_krs.php?nim=<?php echo $nim; ?>" class="btn btn-success" role="button" aria-pressed="true"><i class="fa fa-arrow-left fa-fw"></i> KEMBALI</a>
                        <?php
                        $count_sia = mysqli_query($sia, "SELECT * FROM trnlm WHERE NIMHSTRNLM='$nim' AND THSMSTRNLM='$tahun'");
                        $jumlah_sia = mysqli_num_rows($count_sia);
                        if ($jumlah_sia > 0){?>
                        <a href="import/import_nilai_sia.php?nim=<?php echo $nim; ?>&tahun=<?php echo $tahun ?>" class="btn btn-success" role="button" aria-pressed="true"><i class="fa fa-download fa-fw"></i> NILAI SIA</a>
                        <?php }
                        $count_simakpro = mysqli_query($simakpro, "SELECT * FROM rtrnlm WHERE nimhstrnlm='$nim' AND thsmstrnlm='$tahun'");
                        $jumlah_simakpro = mysqli_num_rows($count_simakpro);
                        if ($jumlah_simakpro > 0){?>
                        <a href="import/import_nilai_simakpro.php?nim=<?php echo $nim; ?>&tahun=<?php echo $tahun ?>" class="btn btn-success" role="button" aria-pressed="true"><i class="fa fa-download fa-fw"></i> NILAI SIMAKPRO</a>
                        <?php } ?>
                        <br/><br/>             
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th width="5%">SMT</th>
                                    <th width="65%">MATA KULIAH</th>
                                    <th width="5%" style="text-align: center">SKS</th>
                                    <th width="10%" style="text-align: center">NILAI</th>
                                    <th width="10%" style="text-align: center">HURUF</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $nilai = mysqli_query($mysqli, "SELECT * FROM  trnlm trn, tbkmk tbk WHERE trn.KDKMKTRNLM=tbk.KDKMKTBKMK AND trn.THSMSTRNLM=tbk.THSMSTBKMK AND trn.THSMSTRNLM='$tahun' AND trn.NIMHSTRNLM='$nim' AND (tbk.kdkonsen='u' OR tbk.kdkonsen='$kdkonsen') ORDER BY tbk.SEMESTBKMK, trn.KDKMKTRNLM ASC");
                                $nomor = 1;
                                $semester = '01';
                                while ($data = mysqli_fetch_array($nilai)) {
                                    $nilai_agama = $data['STAGM'];
                                    ?>
                                    <tr>
                                        <td style="text-align: center"><?php echo $data['SEMESTBKMK']; ?></td>
                                        <td><?php echo $data['KDKMKTRNLM']; ?> - <?php echo $data['NAKMKTBKMK']; ?></td>
                                        <td style="text-align: center"><?php echo $data['SKSMKTBKMK']; ?></td>
                                        <td style="text-align: center">
                                            <?php if($nilai_agama==0){
                                                echo $data['TOTAL'];
                                            }else{
                                                if($data['NLAKHTRNLM']){
                                                  echo $data['TOTAL_BPAS'];
                                                }
                                            }?>
                                        </td>
                                        <td style="text-align: center"><?php echo $data['NLAKHTRNLM']; ?></td>
                                    </tr>  
    <?php $total_sks += $data['SKSMKTBKMK'];
} ?>
                                <tr>
                                    <th style="text-align: center" colspan="2"> TOTAL SKS DIAMBIL</th>
                                    <th style="text-align: center"><?php echo $total_sks; ?></th>
                                    <th style="text-align: center"></th>
                                    <th style="text-align: center"></th>
                                </tr>
                            </tbody>
                        </table>                        
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
