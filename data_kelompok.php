<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>DATA KELOMPOK | SISTEM INFORMASI DOSEN - AMA Yogyakarta</title>

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
                        <h4 class="page-header"><i class="fa fa-user fa-fw"></i> DATA KELOMPOK</h4>
                    </div>
                    <div class="col-lg-12">
                        <?php
                        $nomor_dosen = $_GET['nodos'];
                        $resmsdos = mysqli_query($mysqli, "SELECT NMDOSMSDOS,GELARMSDOS FROM msdos WHERE NODOSMSDOS='$nomor_dosen'");
                        $data_msdos = mysqli_fetch_array($resmsdos);
                        ?>
                        NAMA DOSEN : <?php echo $data_msdos['NMDOSMSDOS']; ?>, <?php echo $data_msdos['GELARMSDOS']; ?><br/>
                        <br/>
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">NO</th>
                                    <th style="text-align: center;">MATA KULIAH</th>
                                    <th style="text-align: center;">KELOMPOK</th>
                                    <th style="text-align: center;">JUMLAH MHS</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $kd_default = 0;
                                $kelas = $_GET['kelas'];
                                $res = mysqli_query($mysqli, "SELECT * FROM dosen_kelompok dk, tbkmk t WHERE dk.KDMK=t.KDKMKTBKMK AND dk.NODOS='$nomor_dosen' AND dk.KLSMHS='$kelas' AND t.THSMSTBKMK=dk.THSMS AND dk.THSMS='$ta_lengkap'");
                                while ($data = mysqli_fetch_array($res)) {
                                    $tahun = $data['THSMS'];
                                    $id_kelompok = $data['id'];
                                    ?>
                                    <tr>
                                        <td class="col-lg-1"><?php echo $no++; ?></td>
                                        <td class="col-lg-5"><?php echo $data['KDMK']; ?> - <?php echo $data['NAKMKTBKMK']; ?></td>
                                        <td class="col-lg-1" style="text-align: center;"><?php echo $data['KLSMHS']; ?>
                                            <?php
                                            $tahun = $_GET['ta'];
                                            $ta = substr($ta_lengkap, 2, 2);
                                            $smtgg = substr($ta_lengkap, 4, 1);
                                            echo ($ta - $tahun) + $smtgg;
                                            ?>-<?php echo $data[KLPKMHS]; ?></td>
                                        <td class="col-lg-2" style="text-align: center;">
                                            <?php
                                            $kdmk = $data['KDMK'];
                                            $jumlah = mysqli_query($mysqli, "SELECT * FROM trnlm t, msmhs m, kelasparalel_mhs k, kelompok_komputer kk WHERE t.NIMHSTRNLM=m.NIMHSMSMHS AND t.NIMHSTRNLM=k.nimhs AND t.THSMSTRNLM='$ta_lengkap' AND t.KDKMKTRNLM='$kdmk' AND t.NIMHSTRNLM=kk.nims AND kk.dosen_kelompok_id='$id_kelompok' AND nmkelas like '$kelas%'");
                                            $count = mysqli_num_rows($jumlah);
                                            $total += $count;
                                            echo $count;
                                            ?>
                                            Mahasiswa
                                        </td>
                                        <td class="col-lg-3">
                                            <a href="data_penilaian_mahasiswa_kelompok.php?id=<?php echo $id_kelompok; ?>&kodemk=<?php echo $data['KDMK']; ?>&kelas=<?php echo $data['KLSMHS']; ?>&ta=<?php echo $tahun ?>&kelompok=<?php echo $data['KLPKMHS']; ?>&nodos=<?php echo $nomor_dosen; ?>"><span class="label label-success">PENILAIAN</span></a>&nbsp;
                                            <?php if ($data['PUBUTS'] == "0") { ?>
                                                <a href="publikasi_nilai_uts_kelompok.php?id=<?php echo $id_kelompok; ?>&kodemk=<?php echo $data['KDMK']; ?>&kelas=<?php echo $data['KLSMHS']; ?>&ta=<?php echo $tahun ?>&kelompok=<?php echo $data['KLPKMHS']; ?>&nodos=<?php echo $nomor_dosen; ?>"><span class="label label-danger">NILAI UTS</span></a>
                                            <?php } elseif ($data['PUBUTS'] == "1") { ?>
                                                <a href="batal_publikasi_nilai_uts_kelompok.php?id=<?php echo $id_kelompok; ?>&kodemk=<?php echo $data['KDMK']; ?>&kelas=<?php echo $data['KLSMHS']; ?>&ta=<?php echo $tahun ?>&kelompok=<?php echo $data['KLPKMHS']; ?>&nodos=<?php echo $nomor_dosen; ?>"><span class="label label-success">NILAI UTS</span></a>
                                            <?php } ?>
                                            <?php if ($data['PUBNILAI'] == "0") { ?>                                                            
                                                <a href="publikasi_nilai_kelompok.php?id=<?php echo $id_kelompok; ?>&kodemk=<?php echo $data['KDMK']; ?>&kelas=<?php echo $data['KLSMHS']; ?>&ta=<?php echo $tahun ?>&kelompok=<?php echo $data['KLPKMHS']; ?>&nodos=<?php echo $nomor_dosen; ?>"><span class="label label-danger">NILAI KHS</span></a>
                                            <?php } elseif ($data['PUBNILAI'] == "1") { ?>
                                                <a href="batal_publikasi_nilai_kelompok.php?id=<?php echo $id_kelompok; ?>&kodemk=<?php echo $data['KDMK']; ?>&kelas=<?php echo $data['KLSMHS']; ?>&ta=<?php echo $tahun ?>&kelompok=<?php echo $data['KLPKMHS']; ?>&nodos=<?php echo $nomor_dosen; ?>"><span class="label label-success">NILAI KHS</span></a>
                                            <?php } ?>
                                        </td>
                                    </tr>

                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <a href="data_mata_kuliah.php?nodos=<?php echo $nomor_dosen; ?>" class="btn btn-success btn-sm" role="button" aria-pressed="true"><i class="fa fa-backward fa-fw"></i> KEMBALI</a>

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
