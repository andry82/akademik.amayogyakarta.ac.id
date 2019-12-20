<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>PERBAIKI BIMBINGAN LTA MAHASISWA | Administrator Sistem Informasi Tugas Akhir Mahasiswa - AMA YPK Yogyakarta</title>

        <!-- Bootstrap Core CSS -->
        <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
        <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
        <link href="../vendor/morrisjs/morris.css" rel="stylesheet">
        <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <!-- DataTables CSS -->
        <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
        <!-- DataTables Responsive CSS -->
        <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
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
            </nav>
            <div id="page-wrapper">
                <?php
                $nim = $_GET['nim'];
                $id = $_GET['id'];
                ?>
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="page-header"><i class="fa fa-book fa-fw"></i> PERBAIKI BIMBINGAN LTA MAHASISWA</h4>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <?php
                $aturan = mysqli_query($mysqli, "select * from config");
                $dataaturan = mysqli_fetch_array($aturan);
                $tahun = $dataaturan['tahun'];
                $ta = substr($tahun, 0, 4);
                $data = mysqli_query($mysqli, "select * from msmhs WHERE NIMHSMSMHS=$nim");
                while ($d = mysqli_fetch_array($data)) {
                    $nama_mahasiswa = $d['NMMHSMSMHS'];
                }
                ?>
                <div class="row">
                    <div class="col-lg-6">
                        <table width="100%" class="table table-striped table-bordered col-lg-6">
                            <tr>
                                <th class="col-lg-3">FOTO</th>
                                <th class="col-lg-8">NOOR INDUK</th>                                
                            </tr>
                            <tr>
                                <td rowspan="3"></td>
                                <td><?php echo $nim; ?></td>
                            </tr>
                            <tr>
                                <th>NAMA LENGKAP</th>
                            </tr>
                            <tr>
                                <td><?php echo $nama_mahasiswa; ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-12">
                        <?php
                        $uraian_bimbingan = mysqli_query($mysqli, "SELECT * FROM riwayat_pembimbingan_ta WHERE id=$id");
                        while ($duraian = mysqli_fetch_array($uraian_bimbingan)) {
                            $uraian = $duraian['uraian'];
                        }
                        ?>
                        <form name="form" method="post" action="update_riwayat_bimbingan.php">
                            <input type="hidden" name="nim" value="<?php echo $nim; ?>">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <div class="form-group">
                                <input type="text" class="form-control" name="uraian" value="<?php echo $uraian; ?>" placeholder="Pengajuan Judul 1">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="update" value="SIMPAN" class="btn btn-success btn-sm">
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
                responsive: true,
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
            });
        });
        </script>
    </body>
</html>
