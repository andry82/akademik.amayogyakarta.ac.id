<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>DATA WISUDA | SISTEM INFORMASI AKADEMIK - AMA Yogyakarta</title>

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
                        <h4 class="page-header"><i class="fa fa-user fa-fw"></i> DATA WISUDA</h4>
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
                        <a href="export_data_wisuda.php" class="btn btn-primary btn-xs"><i class="fa fa-download fa-fw"></i> DOWNLOAD DATA WISUDA</a>
                        <a href="export_data_ijazah.php" class="btn btn-primary btn-xs"><i class="fa fa-download fa-fw"></i> DOWNLOAD DATA IJAZAH</a>
                        <br /> 
                        <br />
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>FOTO MAHASISWA</th>
                                    <th>DETAIL MAHASISWA</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $res = mysqli_query($mysqli, "SELECT ks.urutan, ms.NMMHSMSMHS, ms.TPLHRMSMHS, ms.TGLHRMSMHS, ms.KEAHLIAN, ms.ALAMATLENGKAP, ms.NAMAORTUWALI, ms.TELP, jup.nim, ks.nmkonsen, t.judul_lta FROM jadwal_ujian_pendadaran jup, msmhs ms, konsentrasi ks, ta t WHERE jup.nim=ms.NIMHSMSMHS AND t.nim=ms.NIMHSMSMHS AND t.status='2' AND jup.status=3 AND jup.tahun='$ta' AND t.tahun='$ta' AND ms.kdkonsen=ks.kdkonsen ORDER BY ks.urutan, jup.nim ASC");
                                while ($d = mysqli_fetch_array($res)) {
                                    $nim = $d['nim'];
                                    $urutan = $d['urutan'];
                                    $nama = $d['NMMHSMSMHS'];
                                    $tempat_lahir = ucwords(strtolower($d['TPLHRMSMHS']));
                                    $tanggal_lahir = $d['TGLHRMSMHS'];
                                    $nama_konsentrasi = $d['nmkonsen'];
                                    $telp = $d['TELP'];
                                    $judul_lta = ucwords(strtolower($d['judul_lta']));
                                    $alamat_lengkap = ucwords(strtolower($d['ALAMATLENGKAP']));
                                    $keahlian = ucwords(strtolower($d['KEAHLIAN']));
                                    $nama_orang_tua = ucwords(strtolower($d['NAMAORTUWALI']));
                                    $data_pkl = mysqli_query($mysqli, "SELECT nama_lokasi_pkl FROM upload_ta WHERE nim='$nim'");
                                    $data_lokasi = mysqli_fetch_array($data_pkl);
                                    $a = $data_lokasi['nama_lokasi_pkl'];
                                    if($a ==''){
                                        $nama_lokasi_pkl = '-';
                                    }else{
                                         $nama_lokasi_pkl = $data_lokasi['nama_lokasi_pkl'];
                                    }
                                    ?>
                                    <tr>
                                        <td class="col-lg-3"></td>
                                        <td class="col-lg-9">
                                            <table border="0" width="100%">
                                                <tr><th width="27%" style="vertical-align:top">NAMA MAHASISWA</th><td width="3%" style="text-align:center; vertical-align:top">&nbsp;&nbsp;:&nbsp;&nbsp;</td><td width="70%"><?php echo $nama; ?></td></tr>
                                                <tr><th style="vertical-align:top">TEMPAT / TANGGAL LAHIR</th><td width="3%" style="text-align:center; vertical-align:top">&nbsp;&nbsp;:&nbsp;&nbsp;</td><td><?php echo $tempat_lahir; ?>, <?php echo TanggalIndonesia($tanggal_lahir); ?></td></tr>
                                                <tr><th style="vertical-align:top">NIM</th><td width="3%" style="text-align:center; vertical-align:top">&nbsp;&nbsp;:&nbsp;&nbsp;</td><td><?php echo $nim; ?></td></tr>
                                                <tr><th style="vertical-align:top">KONSENTRASI</th><td width="3%" style="text-align:center; vertical-align:top">&nbsp;&nbsp;:&nbsp;&nbsp;</td><td><?php echo $nama_konsentrasi; ?></td></tr>
                                                <tr><th style="vertical-align:top">KEAHLIAN</th><td width="3%" style="text-align:center; vertical-align:top">&nbsp;&nbsp;:&nbsp;&nbsp;</td><td><?php echo $keahlian; ?></td></tr>
                                                <tr><th style="vertical-align:top">NAMA ORANG TUA</th><td width="3%" style="text-align:center; vertical-align:top">&nbsp;&nbsp;:&nbsp;&nbsp;</td><td><?php echo $nama_orang_tua; ?></td></tr>
                                                <tr><th style="vertical-align:top">ALAMAT ASAL</th><td width="3%" style="text-align:center; vertical-align:top">&nbsp;&nbsp;:&nbsp;&nbsp;</td><td><?php echo $alamat_lengkap; ?></td></tr>
                                                <tr><th style="vertical-align:top">NOMOR TELP</th><td width="3%" style="text-align:center; vertical-align:top">&nbsp;&nbsp;:&nbsp;&nbsp;</td><td><?php echo $telp; ?></td></tr>
                                                <tr><th style="vertical-align:top">LOKASI PKL</th><td width="3%" style="text-align:center; vertical-align:top">&nbsp;&nbsp;:&nbsp;&nbsp;</td><td><?php echo $nama_lokasi_pkl; ?></td></tr>
                                                <tr><th style="vertical-align:top">JUDUL LTA</th><td width="3%" style="text-align:center; vertical-align:top">&nbsp;&nbsp;:&nbsp;&nbsp;</td><td><?php echo $judul_lta; ?></td></tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <?php
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
