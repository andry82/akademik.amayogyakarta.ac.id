<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>DETAIL PRESENSI YUDISIUM | SISTEM INFORMASI AKADEMIK - AMA Yogyakarta</title>

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
                        <h4 class="page-header"><i class="fa fa-user fa-fw"></i> DETAIL PRESENSI YUDISIUM</h4>
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
                        <?php
                        $id = $_GET['id'];
                        $yudisium = mysqli_query($mysqli, "SELECT * FROM kegiatan WHERE id=$id");
                        $data_yudisium = mysqli_fetch_array($yudisium);
                        ?>
                        NAMA KEGIATAN : <?php echo $data_yudisium['nama_kegiatan']; ?><br/>
                        TANGGAL : <?php echo TanggalIndonesia($data_yudisium['tanggal']); ?><br/>
                        WAKTU : <?php echo $data_yudisium['waktu']; ?> WIB<br/>
                        TEMPAT : <?php echo $data_yudisium['ruang']; ?><br/><br/>
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>NIM</th>
                                    <th>NAMA MAHASISWA</th>
                                    <th>KELAS</th>
                                    <th>KEHADIRAN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $pendaftar_yudisium = mysqli_query($mysqli, "SELECT * FROM pendaftaran_yudisium py, msmhs m, upload_ta ut, kelasparalel_mhs km WHERE km.nimhs=m.NIMHSMSMHS AND py.nim=m.NIMHSMSMHS AND ut.nim=m.NIMHSMSMHS AND ut.tahun=py.tahun AND py.tahun=$ta AND py.sesi=$id");
                                while ($data_pendaftar = mysqli_fetch_array($pendaftar_yudisium)) {
                                    $nim = $data_pendaftar['nim'];
                                    $kehadiran = $data_pendaftar['kehadiran'];
                                    $nama_mahasiswa = $data_pendaftar['NMMHSMSMHS'];
                                    $thmskmhs = $data_pendaftar['TAHUNMSMHS'];
                                    $status_ta = $data_pendaftar['status_ta'];
                                    $kelas = $data_pendaftar['nmkelas'];
                                    if ($status_ta == 2) {
                                        ?>
                                        <tr>
                                            <td class="col-lg-1"><?php echo $nim; ?></td>
                                            <td class="col-lg-4"><?php echo $nama_mahasiswa; ?></td>
                                            <td class="col-lg-4">
                                                <?php
                                                $splite = explode("/", $kelas);
                                                echo $splite[0];
                                                echo (($ta - $thmskmhs) * 2) + $smtgg; ?>
                                            </td>
                                            <td class="col-lg-3"><?php echo $kehadiran; ?></td>
                                        </tr>
                                    <?php } else { ?>
                                        <tr style="color: red">
                                            <td class="col-lg-1"><?php echo $nim; ?></td>
                                            <td class="col-lg-4"><?php echo $nama_mahasiswa; ?></td>
                                            <td class="col-lg-4">
                                                <?php
                                                $splite = explode("/", $kelas);
                                                echo $splite[0];
                                                echo (($ta - $thmskmhs) * 2) + $smtgg; ?>
                                            </td>
                                            <td class="col-lg-3"><?php echo $kehadiran; ?></td>
                                        </tr>
                                        <?php
                                    }
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
