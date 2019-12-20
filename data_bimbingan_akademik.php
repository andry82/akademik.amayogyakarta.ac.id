<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>DATA BIMBINGAN AKADEMIK | SISTEM INFORMASI AKADEMIK - AMA Yogyakarta</title>

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
                <?php include 'sidebar_menu.php'; ?>
                <!-- /.navbar-static-side -->
            </nav>

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="page-header"><i class="fa fa-user fa-fw"></i> DATA BIMBINGAN AKADEMIK</h4>
                    </div>
                    <div class="col-lg-12">
                        <?php
                        $no = 1;
                        $res = mysqli_query($mysqli, "SELECT * FROM kelasparalel k, kelasparalel_mhs km, msmhs mhs WHERE k.namakelas=km.nmkelas AND km.nimhs=mhs.NIMHSMSMHS  AND mhs.STMHSMSMHS='A' ORDER BY mhs.NIMHSMSMHS ASC");
                        $jmlbimbingan = mysqli_num_rows($res);
                        ?>
                        Jumlah Mahasiswa Bimbingan : <?php echo $jmlbimbingan; ?> Mahasiswa<br/><br/>
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NIM</th>
                                    <th>NAMA MAHASISWA</th>
                                    <th>KELAS</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($data = mysqli_fetch_array($res)) {

                                    $kelas_splite = explode("-", $data['nmkelas']);
                                    $nim = $data['nimhs'];
                                    $tmp = mysqli_query($mysqli, "SELECT * FROM tmpkrs WHERE nimhs='$nim' AND thsms='$ta_lengkap'");
                                    $jmltmp = mysqli_num_rows($tmp);
                                    $trnlm = mysqli_query($mysqli, "SELECT * FROM  trnlm WHERE NIMHSTRNLM='$nim' AND THSMSTRNLM='$ta_lengkap'");
                                    $jmltrnlm = mysqli_num_rows($trnlm);
                                    ?>
                                    <tr>
                                        <td class="col-lg-1"><?php echo $no++; ?></td>
                                        <td class="col-lg-1"><?php echo $data['nimhs']; ?></td>
                                        <td class="col-lg-7"><?php echo $data['NMMHSMSMHS']; ?></td>
                                        <td class="col-lg-1"><?php echo $kelas_splite[0]; ?></td>
                                        <td class="col-lg-2">
                                            <?php if ($jmltmp == '0' && $jmltrnlm == '0') { ?>
                                                <a href="data_bimbingan_krs.php?nim=<?php echo $data['nimhs']; ?>"><span class="label label-default">BELUM KRS</span></a>
                                            <?php } elseif ($jmltmp > '0' && $jmltrnlm == '0') { ?>
                                                <a href="data_bimbingan_krs.php?nim=<?php echo $data['nimhs']; ?>"><span class="label label-primary">PENGAJUAN KRS</span></a>
                                            <?php } elseif ($jmltmp != '0' && $jmltrnlm != '0') { ?>
                                                <a href="data_bimbingan_krs.php?nim=<?php echo $data['nimhs']; ?>"><span class="label label-success">ACC KRS</span></a>
                                            <?php } ?>
                                        </td>
                                    </tr>

                                    <?php
                                }
                                ?>
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
        $(document).ready(function () {
            $('#dataTables-example').DataTable({
                responsive: true,
                ordering: false
            });
        });
        </script>
    </body>
</html>
