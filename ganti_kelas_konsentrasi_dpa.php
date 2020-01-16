<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>EDIT KELAS, KONSENTRASI dan DPA | Administrator Verifikasi Data Mahasiswa - AMA Yogyakarta</title>

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
                        <h4 class="page-header"><i class="fa fa-eye fa-fw"></i> EDIT KELAS, KONSENTRASI DAN DPA</h4>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">                    
                    <div class="col-lg-12">
                        <?php
//getting id from url
                        $nim = $_GET['nim'];
//selecting data associated with this particular id
                        $kelas = mysqli_query($mysqli, "SELECT * FROM  kelasparalel");
                        $res = mysqli_query($mysqli, "SELECT nmkelas FROM kelasparalel_mhs WHERE nimhs='$nim'");
                        $data = mysqli_fetch_array($res)
                        ?>
                        <form name="form" method="post" action="proses_ganti_kelas_konsentrasi_dpa.php">
                            <input type="hidden" name="nim" value="<?php echo $nim; ?>">

                            <div class="form-group">
                                <label for="jeniskelamnin">KELAS, KONSENTRASI dan DPA</label>
                                <select class="form-control" name="KELAS">                                    
                                    <?php
                                    while ($data_kelas = mysqli_fetch_array($kelas)) {
                                        $nmkelas = $data_kelas['namakelas'];
                                        $kelas_maximal = $data_kelas['maxmhs'];
                                        $jumkelas = mysqli_query($mysqli, "SELECT * FROM kelasparalel_mhs WHERE nmkelas='$nmkelas'");
                                        $kuota_kelas = mysqli_num_rows($jumkelas)
                                        ?>                                    
                                        <?php if ($data_kelas['namakelas'] == $data['nmkelas']) { ?>
                                            <?php if ($kuota_kelas == $kelas_maximal) { ?>
                                                 <option value="<?php echo $data_kelas['namakelas']; ?>" selected="true" disabled="true"><?php echo $data_kelas['namakelas']; ?> - Kapasitas <?php echo $kuota_kelas; ?> Mahasiswa dari <?php echo $kelas_maximal; ?> Mahasiswa</option>
                                            <?php } else { ?>
                                                <option value="<?php echo $data_kelas['namakelas']; ?>" selected="true"><?php echo $data_kelas['namakelas']; ?> - Kapasitas <?php echo $kuota_kelas; ?> Mahasiswa dari <?php echo $kelas_maximal; ?> Mahasiswa</option>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <?php if ($kuota_kelas == $kelas_maximal) { ?>                                                
                                                <option value="<?php echo $data_kelas['namakelas']; ?>" disabled="true"><?php echo $data_kelas['namakelas']; ?> - Kapasitas <?php echo $kuota_kelas; ?> Mahasiswa dari <?php echo $kelas_maximal; ?> Mahasiswa</option>
                                            <?php } else { ?>
                                                <option value="<?php echo $data_kelas['namakelas']; ?>"><?php echo $data_kelas['namakelas']; ?> - Kapasitas <?php echo $kuota_kelas; ?> Mahasiswa dari <?php echo $kelas_maximal; ?> Mahasiswa</option>
                                            <?php } ?>
                                        <?php } ?>
<?php } ?>
                                </select>
                            </div>                                                       
                            <div class="form-group">
                                <input type="submit" name="update" value="UPDATE" class="btn btn-success btn-sm">
                            </div> 
                        </form>
                    </div>
                </div>                
            </div>            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->
        <script src="../vendor/jquery/jquery.min.js"></script>
        <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="../vendor/metisMenu/metisMenu.min.js"></script>
        <script src="../vendor/raphael/raphael.min.js"></script>
        <script src="../vendor/morrisjs/morris.min.js"></script>
        <script src="../dist/js/sb-admin-2.js"></script>
        <!-- DataTables JavaScript -->
        <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
        <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
        <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>
        <script>
        $(document).ready(function () {
            $('#dataTables-example').DataTable({
                responsive: true
            });
        });
        </script>
    </body>
</html>
