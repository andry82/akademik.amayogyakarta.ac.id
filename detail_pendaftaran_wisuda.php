<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>DETAIL PENDAFTARAN WISUDA | SISTEM INFORMASI AKADEMIK - AMA Yogyakarta</title>

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
    $nim = $_GET['nim'];
    $res = mysqli_query($mysqli, "SELECT * FROM msmhs m, pendaftaran_wisuda pw WHERE pw.nim=m.NIMHSMSMHS AND m.NIMHSMSMHS=$nim");
    while ($d = mysqli_fetch_array($res)) {
        $nim = $d['NIMHSMSMHS'];
        $nama = $d['NMMHSMSMHS'];
        $status_pendaftaran = $d['status'];
        $file_berkas = $d['berkas_wisuda'];
        $pesan_revisi = $d['pesan_revisi'];
    }

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
                        <h4 class="page-header"><i class="fa fa-user fa-fw"></i> DETAIL PENDAFTARAN WISUDA</h4>
                        NIM : <?php echo $nim; ?><br/>
                        NAMA MAHASISWA : <?php echo $nama; ?><br/>
                        <br/>
                        <?php if ($status_pendaftaran == 0) { ?>
                            <a href="proses_status_berkas_wisuda.php?nim=<?php echo $nim; ?>&status=0" class='btn btn-success btn-xs'>PENGAJUAN</a>&nbsp;
                            <a data-toggle="modal" data-target="#exampleModalCenter" class='btn btn-default btn-xs'>REVISI</a>&nbsp;
                            <a href="proses_status_berkas_wisuda.php?nim=<?php echo $nim; ?>&status=2" class='btn btn-default btn-xs'>ACC</a><br/>
                        <?php } elseif ($status_pendaftaran == 1) { ?>
                            <div class="alert alert-warning alert-dismissible fade in">
                                REVISI : <?php echo $pesan_revisi; ?>
                            </div>
                            <a href="proses_status_berkas_wisuda.php?nim=<?php echo $nim; ?>&status=0" class='btn btn-default btn-xs'>PENGAJUAN</a>&nbsp;
                            <a data-toggle="modal" data-target="#exampleModalCenter" class='btn btn-warning btn-xs'>REVISI</a>&nbsp;
                            <a href="proses_status_berkas_wisuda.php?nim=<?php echo $nim; ?>&status=2" class='btn btn-default btn-xs'>ACC</a><br/>
                        <?php } elseif ($status_pendaftaran == 2) { ?>
                            <a href="proses_status_berkas_wisuda.php?nim=<?php echo $nim; ?>&status=0" class='btn btn-default btn-xs'>PENGAJUAN</a>&nbsp;
                            <a data-toggle="modal" data-target="#exampleModalCenter" class='btn btn-default btn-xs'>REVISI</a>&nbsp;
                            <a href="proses_status_berkas_wisuda.php?nim=<?php echo $nim; ?>&status=2" class='btn btn-success btn-xs'>ACC</a><br/>
                        <?php } ?>
                        <br/>
                        <a class="media" href="http://localhost/sintama.amayogyakarta.ac.id/document/berkas_wisuda/<?php echo $file_berkas; ?>"></a>
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
        <script type="text/javascript" src="js/jquery.media.js"></script>
        <script type="text/javascript">
        $(function () {
            $('.media').media({width: 1000, height: 600});
        });
        </script>
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <table  width="100%">
                            <tr>
                                <td width="95%"><h4 class="modal-title" id="exampleModalLongTitle">KETERANGAN REVISI</h4></td>
                                <td width="5%">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <form action="proses_status_berkas_wisuda.php" method="post">
                        <input type="hidden" name="nim" value="<?php echo $nim; ?>">
                        <input type="hidden" name="tahun" value="<?php echo $ta; ?>">
                        <input type="hidden" name="status" value="1">
                        <div class="modal-body">
                            <textarea type="text" cols="67" rows="5" name="content"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">BATAL</button>
                            <button type="submit" class="btn btn-primary">KIRIM</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </body>
</html>
