<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>DAFTAR MK WAJIB DIULANG | SISTEM INFORMASI AKADEMIK - AMA Yogyakarta</title>

        <!-- Bootstrap Core CSS -->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
        <link href="dist/css/sb-admin-2.css" rel="stylesheet">
        <link href="vendor/morrisjs/morris.css" rel="stylesheet">
        <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <!-- DataTables CSS -->
        <link href="vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
        <!-- DataTables Responsive CSS -->
        <link href="vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
    </head>
    <?php
    session_start();
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
                <?php include 'sidebar_menu.php'; ?>
            </nav>
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="page-header"><i class="fa fa-user fa-fw"></i> DAFTAR MK WAJIB DIULANG</h4>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th class="col-lg-2">KODE MK</th>
                                    <th class="col-lg-8">MATA KULIAH</th>
                                    <th class="col-lg-1">SKS</th>
                                    <th class="col-lg-1">NILAI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $nim = $_GET['nim'];
                                $res = mysqli_query($mysqli, "SELECT * FROM msmhs m, kelasparalel_mhs km, kelasparalel k, msdos md WHERE m.NIMHSMSMHS=km.nimhs AND km.nmkelas=k.namakelas AND k.nodos=md.NODOSMSDOS AND m.NIMHSMSMHS='$nim'");
                                $data_mhs = mysqli_fetch_array($res);
                                $kurikulum = $data_mhs['KURIKULUM'];
                                $konsentrasi = $data_mhs['kdkonsen'];
                                $query = "SELECT distinct(tr.KDKMKTRNLM) from trnlm tr, tbkmk tbk where tr.KURIKULUM=tbk.KURIKULUM AND tr.KDKMKTRNLM=tbk.KDKMKTBKMK AND tr.THSMSTRNLM<'$ta_lengkap' and tr.NIMHSTRNLM='$nim' and tbk.KURIKULUM='$kurikulum' order by tr.KDKMKTRNLM,tr.NLAKHTRNLM ASC";
                                $hasil = mysqli_query($mysqli, $query);
                                while ($data_mk = mysqli_fetch_array($hasil)) {
                                    $kode2 = $data_mk["KDKMKTRNLM"];
                                    $totip3 = "SELECT NLAKHTRNLM,BOBOTTRNLM,THSMSTRNLM,KDKMKTRNLM from trnlm  where NIMHSTRNLM='$nim' and KDKMKTRNLM='$kode2' and KURIKULUM='$kurikulum' order by NLAKHTRNLM ASC LIMIT 0,1";
                                    $hasilip3 = mysqli_query($mysqli, $totip3);
                                    $dataip3 = mysqli_fetch_array($hasilip3);
                                    $nilai2 = $dataip3["NLAKHTRNLM"];
                                    $bobot2 = $dataip3["BOBOTTRNLM"];
                                    $THSMSTRNLM = $dataip3["THSMSTRNLM"];
                                    $kode3 = $dataip3["KDKMKTRNLM"];
                                    $totmk2 = "SELECT m.SKSMKTBKMK,m.NAKMKTBKMK, m.NAKMKTBKMK_EN, m.KDKMKTBKMK from tbkmk m where m.KDKMKTBKMK='$kode3' and m.THSMSTBKMK='$THSMSTRNLM' and (m.kdkonsen='u' or m.kdkonsen='$konsentrasi') and m.KURIKULUM='$kurikulum'";
                                    $hasilmk2 = mysqli_query($mysqli, $totmk2);
                                    $datamk2 = mysqli_fetch_array($hasilmk2);
                                    $sks2 = $datamk2["SKSMKTBKMK"];
                                    $kode_mk = $datamk2["KDKMKTBKMK"];
                                    $namamk = $datamk2["NAKMKTBKMK"];
                                    $namamk_en = $datamk2["NAKMKTBKMK_EN"];
                                    if ($nilai2 == "T" or $nilai2 == "D" or $nilai2 == "E" or $nilai2 == "0" or $nilai2 == "") {
                                        ?>
                                        <tr>
                                            <td><?php echo $kode3; ?></td>
                                            <td><?php echo $namamk; ?></td>
                                            <td><?php echo $sks2; ?></td>
                                            <td><?php echo $nilai2; ?></td>
                                        </tr>
                                    <?php }
                                }
                                ?>
                            </tbody>
                        </table>
                        <br />
                        <br />
                    </div>
                </div>
            </div>            <!-- /#page-wrapper -->

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
        $(document).ready(function () {
            $('#dataTables-example').DataTable({
                responsive: true,
                ordering: false
            });
        });
        </script>
    </body>
</html>
