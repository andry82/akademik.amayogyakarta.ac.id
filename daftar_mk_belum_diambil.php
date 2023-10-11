<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>DAFTAR MATA KULIAH BELUM DIAMBIL | SISTEM INFORMASI AKADEMIK - AMA Yogyakarta</title>

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
                        <h4 class="page-header"><i class="fa fa-user fa-fw"></i> DAFTAR MATA KULIAH BELUM DIAMBIL</h4>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th class="col-lg-2">KODE MK</th>
                                    <th class="col-lg-9">NAMA MK</th>
                                    <th class="col-lg-1">SKS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $nim = $_GET['nim'];
                                $tbkmk = mysqli_query($mysqli, "SELECT * FROM tbkmk t, msmhs m WHERE t.THSMSTBKMK='$ta_lengkap' AND (t.kdkonsen='u' OR t.kdkonsen=m.kdkonsen) AND t.KURIKULUM=m.KURIKULUM AND m.NIMHSMSMHS='$nim' ORDER BY t.KDKMKTBKMK ASC");
                                $nomor = 1;
                                while ($data = mysqli_fetch_array($tbkmk)) {
                                $kdmk = $data['KDKMKTBKMK'];
                                $mk = mysqli_query($mysqli, "SELECT * FROM trnlm WHERE NIMHSTRNLM='$nim' AND KDKMKTRNLM='$kdmk'");
                                $count_mk = mysqli_num_rows($mk);
                                if($count_mk == 0){
                                ?>
                                <tr>
                                    <td class="col-lg-2"><?php echo $data['KDKMKTBKMK'];?></td>
                                    <td class="col-lg-9"><?php echo $data['NAKMKTBKMK']; ?></td>
                                    <td class="col-lg-1"><?php echo $data['SKSMKTBKMK']; ?></td>
                                </tr>
                                <?php } } ?>
                            </tbody>
                        </table>
                        <a href="data_bimbingan_krs.php?nim=<?php echo $nim ?>" class="btn btn-success" role="button" aria-pressed="true"><i class="fa fa-arrow-left fa-fw"></i> KEMBALI</a>
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