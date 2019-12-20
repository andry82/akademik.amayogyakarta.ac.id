<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>PROFILE | SISTEM INFORMASI DOSEN - AMA Yogyakarta</title>

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
                        <h4 class="page-header"><i class="fa fa-user fa-fw"></i> PROFILE</h4>
                    </div>
                    <div class="col-lg-12">
                        <?php
//getting id from url
                        $nomor_dosen = $_SESSION['nomor_dosen'];
//selecting data associated with this particular id
                        $res = mysqli_query($mysqli, "SELECT * FROM msdos WHERE NODOSMSDOS='$nomor_dosen'");
                        while ($data = mysqli_fetch_array($res)) {
                            $nama_dosen = $data['NMDOSMSDOS'];
                            $gelar_dosen = $data['GELARMSDOS'];
                            $tplahir = $data['TPLHRMSDOS'];
                            $tgllahir = $data['TGLHRMSDOS'];
                        }
                        ?>
                        <!-- /.col-lg-12 -->
                        <form name="form" method="post" action="update_profile.php" enctype="multipart/form-data">
                            <input type="hidden" name="NIMHSMSMHS" value="<?php echo $nim; ?>">                            
                            <div class="form-group">
                                <label for="NamaLengkap">NAMA LENGKAP</label>
                                <input type="text" class="form-control" name="NMDOSMSDOS" value="<?php echo $nama_dosen; ?>" placeholder="Nama Lengkap">
                            </div>
                            <div class="form-group">
                                <label for="GelarDosen">GELAR DOSEN</label>
                                <input type="text" class="form-control" name="GELARMSDOS" value="<?php echo $gelar_dosen; ?>" placeholder="Gelar Dosen">
                            </div>
                            <div class="form-group">
                                <label for="TempatLahir">TEMPAT LAHIR</label>
                                <input type="text" class="form-control" name="TPLHRMSDOS" value="<?php echo $tplahir; ?>" placeholder="Tempat Lahir">
                            </div>                           
                            <div class="form-group">
                                <label for="TempatLahir">TANGGAL LAHIR</label>
                                <input type="text" class="form-control" name="TGLHRMSDOS" value="<?php echo $tgllahir; ?>" placeholder="Tempat Lahir">
                            </div>                           
                            <!--<?php
                            $filename_ijazah = "document/ijazah/$ijazah";
                            //print($filename);				
                            if (file_exists($filename_ijazah)) {
                                ?>
                                <img src="document/ijazah/<?php echo $ijazah; ?>" width="400">
                                <br /><br />
                            <?php } ?>
                            <div class="form-group">
                                <label for="IJAZAH">UPLOAD IJAZAH / SKL (JPG, JPEG)</label>
                                <input type="file" name="ijazah" class="form-control">
                            </div>-->
                                               
                            <div class="form-group">
                                <input type="submit" name="update" value="SIMPAN" class="btn btn-success btn-sm">
                            </div> 
                        </form>
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
