<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>FOTO IJAZAH | SISTEM INFORMASI AKADEMIK - AMA Yogyakarta</title>

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
                        <h4 class="page-header"><i class="fa fa-user fa-fw"></i> DATA FOTO IJAZAH</h4>
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
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>FOTO IJAZAH</th>
                                    <th>DETAIL MAHASISWA</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $res = mysqli_query($mysqli, "SELECT * FROM  pendaftaran_ta pt, konsentrasi k, msmhs ms WHERE ms.kdkonsen=k.kdkonsen AND pt.nim=ms.NIMHSMSMHS AND pt.status_foto_ijazah!=0 ORDER BY status_foto_ijazah ASC");
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
                                    if ($a == '') {
                                        $nama_lokasi_pkl = '-';
                                    } else {
                                        $nama_lokasi_pkl = $data_lokasi['nama_lokasi_pkl'];
                                    }
                                    ?>
                                    <tr>
                                        <td class="col-lg-2">
                                            <img width="150px" src="http://localhost/sintama.amayogyakarta.ac.id/document/foto_ijazah/<?php echo $d['foto_ijazah']; ?>">                         
                                        </td>
                                        <td class="col-lg-6">
                                            <table border="0" width="100%">
                                                <tr><th width="20%" style="vertical-align:top">NAMA</th><td width="3%" style="text-align:center; vertical-align:top">&nbsp;&nbsp;:&nbsp;&nbsp;</td><td width="70%"><?php echo $nama; ?></td></tr>
                                                <tr><th style="vertical-align:top">TTL</th><td width="3%" style="text-align:center; vertical-align:top">&nbsp;&nbsp;:&nbsp;&nbsp;</td><td><?php echo $tempat_lahir; ?>, <?php echo TanggalIndonesia($tanggal_lahir); ?></td></tr>
                                                <tr><th style="vertical-align:top">NIM</th><td width="3%" style="text-align:center; vertical-align:top">&nbsp;&nbsp;:&nbsp;&nbsp;</td><td><?php echo $nim; ?></td></tr>
                                                <tr><th style="vertical-align:top">KONSENTRASI</th><td width="3%" style="text-align:center; vertical-align:top">&nbsp;&nbsp;:&nbsp;&nbsp;</td><td><?php echo $nama_konsentrasi; ?></td></tr>
                                            </table>
                                        </td>
                                        <td class="col-lg-4">
                                            <?php if ($d['status_foto_ijazah'] == 1) { ?>
                                                <a href="proses_status_foto_ijazah.php?nim=<?php echo $nim; ?>&status=1" class="btn btn-primary btn-xs"><i class="fa fa-check fa-fw"></i> PENGAJUAN</a>
                                                <a data-toggle="modal" data-target="#<?php echo $nim; ?>" class='btn btn-default btn-xs'><i class="fa fa-check fa-fw"></i> REVISI</a>
                                                <a href="proses_status_foto_ijazah.php?nim=<?php echo $nim; ?>&status=3" class="btn btn-default btn-xs"><i class="fa fa-check fa-fw"></i> ACC</a>
                                            <?php } elseif ($d['status_foto_ijazah'] == 2) { ?>
                                                <a href="proses_status_foto_ijazah.php?nim=<?php echo $nim; ?>&status=1" class="btn btn-default btn-xs"><i class="fa fa-check fa-fw"></i> PENGAJUAN</a>
                                                <a data-toggle="modal" data-target="#<?php echo $nim; ?>" class='btn btn-primary btn-xs'><i class="fa fa-check fa-fw"></i> REVISI</a>
                                                <a href="proses_status_foto_ijazah.php?nim=<?php echo $nim; ?>&status=3" class="btn btn-default btn-xs"><i class="fa fa-check fa-fw"></i> ACC</a>
                                            <?php } elseif ($d['status_foto_ijazah'] == 3) { ?>
                                                <a href="proses_status_foto_ijazah.php?nim=<?php echo $nim; ?>&status=1" class="btn btn-default btn-xs"><i class="fa fa-check fa-fw"></i> PENGAJUAN</a>
                                                <a data-toggle="modal" data-target="#<?php echo $nim; ?>" class='btn btn-default btn-xs'><i class="fa fa-check fa-fw"></i> REVISI</a>
                                                <a href="proses_status_foto_ijazah.php?nim=<?php echo $nim; ?>&status=3" class="btn btn-primary btn-xs"><i class="fa fa-check fa-fw"></i> ACC</a>
                                            <?php } ?>
                                            <div class="modal fade" id="<?php echo $nim; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <table  width="100%">
                                                                <tr>
                                                                    <td width="95%"><h4 class="modal-title" id="exampleModalLongTitle">REVISI FOTO IJAZAH</h4></td>
                                                                    <td width="5%">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>                    
                                                        <form action="proses_status_foto_ijazah.php" method="post">
                                                            <input type="hidden" name="nim" value="<?php echo $nim; ?>">
                                                            <input type="hidden" name="status" value="2">
                                                            <div class="modal-body">
                                                                <textarea name="notifikasi" rows="5" cols="67"></textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary btn-sm">SIMPAN</button>
                                                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">BATAL</button>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
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
