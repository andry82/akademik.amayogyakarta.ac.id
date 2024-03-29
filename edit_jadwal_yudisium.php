<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>EDIT JADWAL YUDISIUM | SISTEM INFORMASI AKADEMIK - AMA Yogyakarta</title>

        <!-- Bootstrap Core CSS -->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
        <link href="dist/css/sb-admin-2.css" rel="stylesheet">
        <link href="dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
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
                        <h4 class="page-header"><i class="fa fa-plus fa-fw"></i> TAMBAH PRESENSI YUDISIUM</h4>
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
                        <?PHP
                        $id = $_GET['id'];
                        $result = mysqli_query($mysqli, "SELECT * FROM kegiatan WHERE id=$id");
                        $data = mysqli_fetch_array($result);
                        ?>
                        <form name="form" method="post" action="update_jadwal_yudisium.php">
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                            <div class="form-group">
                                <label for="NamaKegiatanYudisium">NAMA KEGIATAN YUDISIUM</label>
                                <input type="text" class="form-control" name="nama_kegiatan" value="<?php echo $data['nama_kegiatan']; ?>" placeholder="Nama Kegiatan">
                            </div>
                            <div class="form-group">
                                <label for="Tanggal">TANGGAL</label>
                                <input type="text" class="form-control datepicker" name="tanggal" value="<?php echo date('d-m-Y', strtotime($data['tanggal'])); ?>" placeholder="Tanggal">
                            </div>
                            <div class="form-group">
                                <label for="Waktu">WAKTU</label>
                                <input type="text" class="form-control" name="waktu" value="<?php echo $data['waktu']; ?>" placeholder="Waktu">
                            </div>                           
                            <div class="form-group">
                                <label for="TempatLahir">TEMPAT</label>
                                <input type="text" class="form-control" name="ruang" value="<?php echo $data['ruang']; ?>" placeholder="Ruang">
                            </div>                           
                            <div class="form-group">
                                <label for="Tahun">TAHUN</label>
                                <input type="text" class="form-control" name="tahun" value="<?php echo $data['tahun']; ?>" placeholder="Tahun">
                            </div>                           
                            <!--<div class="form-group">
                                <label for="TempatLahir">TAHUN PERIODE SEMESTER</label>
                                <input type="text" class="form-control" name="THPERIODE" value="<?php echo $thperiode; ?>" placeholder="Tahun Periode Semester">
                            </div>         -->                  
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
                                <a href="jadwal_yudisium.php" class='btn btn-primary btn-sm'><i class="fa fa-backward fa-fw"></i> KEMBALI</a>   
                                <input type="submit" name="update" value="SIMPAN" class="btn btn-success btn-sm">
                            </div> 
                        </form>
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
        <script src="dist/js/bootstrap-datepicker.min.js"></script>
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
            $('.datepicker').datepicker({
                locale: 'id',
                format: 'dd-mm-yyyy',
                startDate: '-0d',
                autoclose: true,
                todayHighlight: true
            });
        });
        </script>
    </body>
</html>
