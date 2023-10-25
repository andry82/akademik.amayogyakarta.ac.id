<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>DAFTAR MAHASISWA | SISTEM INFORMASI AKADEMIK - AMA Yogyakarta</title>

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
    include '../config.php';

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
                <!-- /.navbar-static-side -->
            </nav>

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="page-header"><i class="fa fa-list fa-fw"></i> DAFTAR MAHASISWA</h4>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">                    
                    <div class="col-lg-12">
                        <a href="export_data_mahasiswa.php" class="btn btn-primary btn-xs"><i class="fa fa-download fa-fw"></i> DOWNLOAD NIMAN EXCEL</a>&nbsp;
                        <a href="export_data_kartu_mahasiswa.php" class="btn btn-primary btn-xs"><i class="fa fa-download fa-fw"></i> DOWNLOAD KARTU MAHASISWA EXCEL</a>&nbsp;
                        <a href="export_data_revisi.php" class="btn btn-warning btn-xs"><i class="fa fa-download fa-fw"></i> DOWNLOAD DATA REVISI</a>
                        <br /> 
                        <br /> 
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>NIM</th>
                                    <th>NAMA LENGKAP</th>
                                    <th>TEMPAT TANGGAL LAHIR</th>
                                    <th>KELAS</th>
                                    <th>DATA</th>
                                    <th>NAVIGASI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $result = mysqli_query($mysqli, "SELECT * FROM msmhs m,  kelasparalel_mhs km WHERE m.NIMHSMSMHS=km.nimhs AND m.STMHSMSMHS='A' ORDER BY m.NIMHSMSMHS ASC");
                                $no = 1;
                                while ($data = mysqli_fetch_array($result)) {
                                    $nim = $data['NIMHSMSMHS'];
                                    $nikey = md5($data['NIMHSMSMHS']);
                                    mysqli_query($mysqli, "UPDATE msmhs SET NIKEY='$nikey' WHERE NIMHSMSMHS='$nim'");
                                    $kelas = $splite = explode("/", $data['nmkelas']);
                                    $status_data = $data['tgl_update'];
                                    $status_mahasiswa = $data['STMHSMSMHS'];
                                    $thmskmhs = $data['TAHUNMSMHS']; 
                                    $stat_data = $data['STATUSDATA'];
                                    ?>
                                    <tr>
                                        <td><?php echo $nim ?></td>
                                        <td><?php echo $data['NMMHSMSMHS']; ?></td>
                                        <td><?php echo $data['TPLHRMSMHS']; ?>, <?php echo $data['TGLHRMSMHS']; ?></td>
                                        <td style="text-align: center"><?php echo $kelas[0]; ?><?php echo (($ta - $thmskmhs) * 2) + $smtgg; ?></td>
                                        <td>
                                            <?php if ($status_data && ($stat_data == '3')) { ?>
                                                <span class="label label-success">TELAH TERVERIFIKASI</span>
                                            <?php } else if ($status_data == "" && ($stat_data == '0')) { ?>
                                                <span class="label label-default">BELUM TERVERIFIKASI</span>
                                            <?php } else if ($status_data == "" && ($stat_data == '1')) { ?>
                                                <span class="label label-primary">PENGAJUAN DATA</span>
                                            <?php } else if ($status_data == "" && ($stat_data == '2')) { ?>
                                                <span class="label label-warning">REVISI DATA</span>
                                            <?php } ?>
                                        </td>
                                        <td style="text-align: center">
                                            <a href="reset_password.php?nim=<?php echo $nim ?>" class="btn btn-default btn-xs"><i class="fa fa-key fa-fw"></i></a>
                                            <a href="edit_mahasiswa.php?nim=<?php echo $nim ?>" class="btn btn-success btn-xs"><i class="fa fa-edit fa-fw"></i></a>
                                            <a href="detail_mahasiswa.php?nim=<?php echo $nim ?>" class="btn btn-primary btn-xs"><i class="fa fa-eye fa-fw"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>                          
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
                responsive: true
            });
        });
        </script>
    </body>
</html>
