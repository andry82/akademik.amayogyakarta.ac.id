<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>MIGRASI KURIKULUM | SISTEM INFORMASI AKADEMIK - AMA Yogyakarta</title>

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
                        <h4 class="page-header"><i class="fa fa-arrows-v fa-fw"></i> MIGRASI KURIKULUM</h4>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">          
                    <?php
                    $nim = $_GET['nim'];
                    $result = mysqli_query($mysqli, "SELECT * FROM msmhs WHERE NIMHSMSMHS='$nim'");
                    $data = mysqli_fetch_array($result);
                    $kurikulum_lama = $data['KURIKULUM'];
                    $kdkonsen = $data['kdkonsen'];
                    ?>
                    <div class="col-lg-12">
                        NIM : <?php echo $data['NIMHSMSMHS']; ?><br/>
                        Nama : <?php echo $data['NMMHSMSMHS']; ?><br/>
                        Kurikulum : <?php echo $kurikulum_lama; ?><br/>
                        <br/>
                        <form name="form1" method="post" action="proses_migrasi_kurikulum.php">
                            <input type="hidden" name="nim" value="<?php echo $nim; ?>">                            
                            <input type="hidden" name="kurikulum_lama" value="<?php echo $kurikulum_lama; ?>">                            
                            <input type="hidden" name="kdkonsen" value="<?php echo $kdkonsen; ?>">                            
                            <div class="form-group">
                                <label for="Pembimbing">MIGRASI KE KURIKULUM</label><br/>
                                <select class="form-control" name="kurikulum_baru" style="width: 25%">
                                    <?php
                                    $kurikulum = mysqli_query($mysqli, "SELECT DISTINCT(kurikulum_baru) FROM konfersi_mata_kuliah WHERE kurikulum_lama=$kurikulum_lama");
                                    $count = mysqli_num_rows($kurikulum);
                                    while ($data_kurikulum = mysqli_fetch_array($kurikulum)) {
                                        ?>
                                        <option value="<?php echo $data_kurikulum['kurikulum_baru'] ?>"><?php echo $data_kurikulum['kurikulum_baru']; ?></option>
                                        <?}?>
                                    </select>
                                </div>
                                <table border="0">
                                    <tr>
                                        <td>
                                          <?php if ($count > '0') { ?>
                                                <input class="btn btn-success" type="submit" name="update" value="SIMPAN"></td>
                                        <?php } else { ?>
                                        <input class="btn btn-success" type="submit" name="update" value="SIMPAN" disabled></td>
                                    <?php } ?>
                                </div>
                                </tr>
                            </table>
                        </form>
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
