<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>PENILAIAN KHS | SISTEM INFORMASI AKADEMIK - AMA Yogyakarta</title>

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
    include 'range_penilaian_khs.php';
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
                $ta = $_GET['ta'];
                ?>
                <!-- /.navbar-static-side -->
            </nav>

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="page-header"><i class="fa fa-edit fa-fw"></i> PENILAIAN KHS</h4>
                    </div>
                    <div class="col-lg-12">
                        <?php
                        $nama_mhs = mysqli_query($mysqli, "SELECT * FROM msmhs m, kelasparalel_mhs km WHERE m.NIMHSMSMHS=km.nimhs AND m.NIMHSMSMHS='$nim'");
                        $data_mhs = mysqli_fetch_array($nama_mhs);
                        $kdkonsen = $data_mhs['kdkonsen']; 
                        $kurikulum = $data_mhs['KURIKULUM']; 
                        $aturan = mysqli_query($mysqli, "select * from config");
                        $dataaturan = mysqli_fetch_array($aturan);
                        $ta_lengkap = $dataaturan['tahun'];
                        $status_survey_dosen = $dataaturan['SURVEI_DOSEN_SISWA'];
                        $tajar = substr($ta_lengkap, 0, 4);
                        $smtgg = substr($ta_lengkap, 4, 1);
                        ?>
                        NAMA MAHASISWA : <?php echo $data_mhs['NMMHSMSMHS']; ?><br/>
                        <?php  
                        $kelas = explode("/", $data_mhs['nmkelas']);
                        ?> 
                        KELAS : <?php echo $kelas['0']; ?><?php echo (($tajar - $data_mhs['TAHUNMSMHS']) * 2) + $smtgg; ?><br/>
                        <br/>
                        <form name="form" method="post" action="update_nilai_khs.php">
                            <input type="hidden" name="nim" value="<?php echo $nim ?>" >
                            <input type="hidden" name="ta" value="<?php echo $ta ?>" >

                            <div class="form-group">
                                <a href="cetak_khs.php?ta=<?php echo $ta; ?>&nim=<?php echo $nim; ?>" class="btn btn-success btn-sm" role="button" aria-pressed="true"><i class="fa fa-backward fa-fw"></i> KEMBALI</a>
                                <input type="submit" name="update" value="SIMPAN PENILAIAN " class="btn btn-success btn-sm">
                            </div>
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th style="text-align: center" width="5%">NO</th>
                                        <th style="text-align: center" width="10%">KODE MK</th>
                                        <th style="text-align: center" width="65%">NAMA MK</th>
                                        <th style="text-align: center" width="10%">NILAI</th>
                                        <th style="text-align: center" width="5%">HURUF</th>
                                        <th style="text-align: center" width="5%">BOBOT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $trnlm = mysqli_query($mysqli, "SELECT * FROM trnlm trn, tbkmk tbk WHERE trn.KURIKULUM=tbk.KURIKULUM AND trn.KDKMKTRNLM=tbk.KDKMKTBKMK AND trn.THSMSTRNLM=tbk.THSMSTBKMK AND trn.NIMHSTRNLM='$nim' AND (tbk.kdkonsen='u' OR tbk.kdkonsen='$kdkonsen')AND trn.KURIKULUM='$kurikulum' AND trn.THSMSTRNLM='$ta'");
                                    while ($datakhs = mysqli_fetch_array($trnlm)) {
                                        $kdmk = trim($datakhs['KDKMKTRNLM']);
                                        ?>
                                    <input type="hidden" name="kodemk[]" value="<?php echo $kdmk; ?>" >
                                    <tr> 
                                        <td style="text-align: center"><?php echo $no++; ?></td> 
                                        <td><?php echo $kdmk; ?></td>
                                        <td><?php echo strtoupper($datakhs['NAKMKTBKMK']); ?></td>
                                        <td style="text-align: center">
                                            <input onkeyup="hitungNilai('<?php echo $kdmk ?>');" maxlength="3" id="nilai_<?php echo $kdmk ?>" class="form-control col-lg-1" type="text" name="total[]" value="<?php echo $datakhs['TOTAL']; ?>" onkeyup="this.value = this.value.toUpperCase()" >
                                        </td>
                                    <input id="huruf_<?php echo $kdmk ?>" type="hidden" name="huruf[]" value="<?php echo $datakhs['NLAKHTRNLM']; ?>">
                                    <input id="bobot_<?php echo $kdmk ?>" type="hidden" name="bobot[]" value="<?php echo $datakhs['BOBOTTRNLM']; ?>">

                                    <td style="text-align: center"><input id="huruf_view_<?php echo $kdmk ?>" class="form-control col-lg-1" type="text" value="<?php echo $datakhs['NLAKHTRNLM']; ?>" disabled></td>
                                    <td style="text-align: center"><input id="bobot_view<?php echo $kdmk ?>" class="form-control col-lg-1" type="text" value="<?php echo $datakhs['BOBOTTRNLM']; ?>" disabled></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                            <div class="form-group">
                                <a href="cetak_khs.php?ta=<?php echo $ta; ?>&nim=<?php echo $nim; ?>" class="btn btn-success btn-sm" role="button" aria-pressed="true"><i class="fa fa-backward fa-fw"></i> KEMBALI</a>
                                <input type="submit" name="update" value="SIMPAN PENILAIAN " class="btn btn-success btn-sm">
                            </div>
                        </form>
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
