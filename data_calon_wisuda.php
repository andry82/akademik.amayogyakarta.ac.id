<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>DATA CALON WISUDA | SISTEM INFORMASI AKADEMIK - AMA Yogyakarta</title>

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
                <?php include 'sidebar_menu.php'; ?>
            </nav>
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="page-header"><i class="fa fa-user fa-fw"></i> DATA CALON WISUDA <?php echo $ta ?></h4>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <?php
                $aturan = mysqli_query($mysqli, "select * from config");
                $dataaturan = mysqli_fetch_array($aturan);
                $tahun = $dataaturan['tahun'];
                $ta = substr($tahun, 0, 4);

                function TanggalIndonesia($date) {
                    $date = date('Y-m-d', strtotime($date));
                    if ($date == '0000-00-00')
                        return 'Tanggal Kosong';

                    $tgl = substr($date, 8, 2);
                    $bln = substr($date, 5, 2);
                    $thn = substr($date, 0, 4);

                    switch ($bln) {
                        case 1 : {
                                $bln = 'Januari';
                            }break;
                        case 2 : {
                                $bln = 'Februari';
                            }break;
                        case 3 : {
                                $bln = 'Maret';
                            }break;
                        case 4 : {
                                $bln = 'April';
                            }break;
                        case 5 : {
                                $bln = 'Mei';
                            }break;
                        case 6 : {
                                $bln = "Juni";
                            }break;
                        case 7 : {
                                $bln = 'Juli';
                            }break;
                        case 8 : {
                                $bln = 'Agustus';
                            }break;
                        case 9 : {
                                $bln = 'September';
                            }break;
                        case 10 : {
                                $bln = 'Oktober';
                            }break;
                        case 11 : {
                                $bln = 'November';
                            }break;
                        case 12 : {
                                $bln = 'Desember';
                            }break;
                        default: {
                                $bln = 'UnKnown';
                            }break;
                    }

                    $tanggalIndonesia = $tgl . " " . $bln . " " . $thn;
                    return $tanggalIndonesia;
                }
                ?>
                <div class="row">
                    <div class="col-lg-12">
                        <a href="export_data_calon_wisuda.php" class="btn btn-primary btn-xs"><i class="fa fa-download fa-fw"></i> DOWNLOAD DATA WISUDA</a>
                        <br /> 
                        <br />
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th class="col-lg-1">NIM</th>
                                    <th class="col-lg-6">NAMA MAHASISWA</th>
                                    <th class="col-lg-1">KELAS</th>                                    
                                    <th class="col-lg-1">D</th>
                                    <th class="col-lg-1">E</th>
                                    <th class="col-lg-1">TOTAL</th>
                                    <th class="col-lg-1">SKS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $res = mysqli_query($mysqli, "SELECT * FROM trakm t, msmhs m, kelasparalel_mhs km WHERE t.NIMHSTRAKM=km.nimhs AND t.NIMHSTRAKM=m.NIMHSMSMHS AND t.SKSTTTRAKM>='91' AND m.STMHSMSMHS='A' AND t.THSMSTRAKM='$ta_lengkap'");
                                while ($d = mysqli_fetch_array($res)) {
                                    $nim = $d['NIMHSTRAKM'];
                                    $thmskmhs = $d['TAHUNMSMHS'];
                                    $pecah_kelas = explode("/", $d['nmkelas']);
                                    ?>
                                    <tr>
                                        <td class="col-lg-1"><?php echo $d['NIMHSTRAKM']; ?></td>
                                        <td class="col-lg-6"><?php echo $d['NMMHSMSMHS']; ?></td>
                                        <td class="col-lg-1"><?php echo $pecah_kelas[0]; ?><?php echo (($ta - $thmskmhs) * 2) + $smtgg; ?></td>
                                        <?php
                                        $total_mk = mysqli_query($mysqli, "SELECT * FROM trnlm WHERE NIMHSTRNLM='$nim'");
                                        $count_mk = mysqli_num_rows($total_mk);
                                        $total_D = mysqli_query($mysqli, "SELECT * FROM trnlm WHERE NIMHSTRNLM='$nim' AND NLAKHTRNLM='D'");
                                        $count_D = mysqli_num_rows($total_D);
                                        $total_E = mysqli_query($mysqli, "SELECT * FROM trnlm WHERE NIMHSTRNLM='$nim' AND NLAKHTRNLM='E'");
                                        $count_E = mysqli_num_rows($total_E);
                                        ?>
                                        <td class="col-lg-1"><?php echo $count_D; ?> MK</td>
                                        <td class="col-lg-1"><?php echo $count_E; ?> MK</td>
                                        <td class="col-lg-1"><?php echo $count_mk; ?> MK</td>
                                        <td class="col-lg-1"><?php echo $d['SKSTTTRAKM']; ?> SKS</td>
                                    </tr>
                                    <?php
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
