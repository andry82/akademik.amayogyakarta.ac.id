<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>DATA MATA KULIAH | SISTEM INFORMASI AKADEMIK - AMA Yogyakarta</title>

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
                        <h4 class="page-header"><i class="fa fa-user fa-fw"></i> DATA MATA KULIAH</h4>
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
                                    <th width="3%" style="text-align: center;">NO</th>
                                    <th width="40%" style="text-align: center;">MATA KULIAH</th>
                                    <th width="3%" style="text-align: center;">KELAS</th>
                                    <th width="13%" style="text-align: center;">JUMLAH MHS</th>
                                    <th width="25%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $kd_default = 0;                                
                                $res = mysqli_query($mysqli, "SELECT * FROM dosen_pengajar dp, tbkmk tbk WHERE dp.KDMK=tbk.KDKMKTBKMK AND dp.THSMS=tbk.THSMSTBKMK AND dp.NODOS='$nomor_dosen'  AND dp.THSMS='$ta_lengkap' ORDER BY dp.KDMK, dp.KLSMHS ASC");
                                while ($data = mysqli_fetch_array($res)) {
                                    $pecah_kelas = explode("/", $data['KLSMHS']);
                                    $kelas_huruf = $pecah_kelas[0];
                                    $kelas_tahun = $pecah_kelas[2];
                                    $kodemk = $data['KDMK'];
                                    if ($kodemk == "MPK104" or $kodemk == "MPK115") {
                                        if ($kelas_huruf != $kelas_dafault or $kodemk != $kd_default) {
                                            ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $kodemk; ?> - <?php echo $data['NAKMKTBKMK']; ?></td>
                                                <td style="text-align: center;"><?php echo $kelas_huruf; ?>
                                                    <?php
                                                    $ta = substr($data['THSMS'], 2, 2);
                                                    $smtgg = substr($data['THSMS'], 4, 1);
                                                    echo ($kelas_tahun - $ta) + $smtgg;
                                                    ?>
                                                </td>
                                                <td style="text-align: center;">
                                                    <?php
                                                    $agama = mysqli_query($mysqli, "SELECT KODE FROM dosen_agama WHERE NODOS='$nomor_dosen'");
                                                    $dt_agama = mysqli_fetch_array($agama);
                                                    $kode_agama = $dt_agama['KODE'];
                                                    if ($kode_agama == "I") {
                                                        $jumlah = mysqli_query($mysqli, "SELECT * FROM trnlm t, msmhs m, kelasparalel_mhs k WHERE t.NIMHSTRNLM=m.NIMHSMSMHS AND t.NIMHSTRNLM=k.nimhs AND t.THSMSTRNLM='$ta_lengkap' AND t.KDKMKTRNLM='$kodemk' AND m.AGAMA='$kode_agama' AND nmkelas like '$kelas_huruf%' ORDER BY t.NIMHSTRNLM ASC");
                                                    } else {
                                                        $jumlah = mysqli_query($mysqli, "SELECT * FROM trnlm t, msmhs m, kelasparalel_mhs k WHERE t.NIMHSTRNLM=m.NIMHSMSMHS AND t.NIMHSTRNLM=k.nimhs AND t.THSMSTRNLM='$ta_lengkap' AND t.KDKMKTRNLM='$kodemk' AND m.AGAMA='$kode_agama' ORDER BY t.NIMHSTRNLM ASC");
                                                    }
                                                    $count = mysqli_num_rows($jumlah);
                                                    echo $count;
                                                    $total_mhs += $count;
                                                    ?> Mahasiswa
                                                </td>
                                                <td>
                                                    <a href="data_penilaian_mahasiswa_agama.php?kodemk=<?php echo $data['KDMK']; ?>&kelas=<?php echo $kelas_huruf; ?>&ta=<?php echo $kelas_tahun; ?>&nodos=<?php echo $nomor_dosen; ?>"><span class="label label-success">PENILAIAN</span></a>&nbsp;
                                                    <?php if ($data['PUBUTS'] == "0") { ?>                                                            
                                                    <a href="publikasi_nilai_uts_agama.php?kodemk=<?php echo $data['KDMK']; ?>&nodos=<?php echo $nomor_dosen; ?>&kelas=<?php echo $kelas_huruf; ?>"><span class="label label-danger">PUBLISH</span></a>
                                                    <?php } elseif ($data['PUBUTS'] == "1") { ?>
                                                        <a href="batal_publikasi_nilai_uts_agama.php?kodemk=<?php echo $data['KDMK']; ?>&nodos=<?php echo $nomor_dosen; ?>&kelas=<?php echo $kelas_huruf; ?>"><span class="label label-success">BATAL PUBLISH</span></a>
                                                    <?php } ?>
                                                    <?php if ($data['PUBNILAI'] == "0") { ?>                                                            
                                                        <a href="publikasi_nilai_agama.php?kodemk=<?php echo $data['KDMK']; ?>&nodos=<?php echo $nomor_dosen; ?>&kelas=<?php echo $kelas_huruf; ?>"><span class="label label-danger">PUBLISH</span></a>
                                                    <?php } elseif ($data['PUBNILAI'] == "1") { ?>
                                                        <a href="batal_publikasi_nilai_agama.php?kodemk=<?php echo $data['KDMK']; ?>&nodos=<?php echo $nomor_dosen; ?>&kelas=<?php echo $kelas_huruf; ?>"><span class="label label-success">BATAL PUBLISH</span></a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        $kd_default = $kodemk;
                                        $kelas_dafault = $kelas_huruf;
                                    } else {
                                        $model_pengajaran = $data['MDLTBKMK'];
                                        if ($kelas_huruf != $kelas_dafault or $kodemk != $kd_default) {
                                            ?>
                                            <tr>
                                                <td class="col-lg-1"><?php echo $no++; ?></td>
                                                <td class="col-lg-5"><?php echo $kodemk; ?> - <?php echo $data['NAKMKTBKMK']; ?></td>
                                                <td class="col-lg-1" style="text-align: center;"><?php echo $kelas_huruf; ?>
                                                    <?php
                                                    $ta = substr($data['THSMS'], 2, 2);
                                                    $smtgg = substr($data['THSMS'], 4, 1);
                                                    echo (($ta - $kelas_tahun) * 2) + $smtgg;
                                                    ?></td>
                                                <td class="col-lg-2" style="text-align: center;">
                                                    <?php if ($model_pengajaran == 'KELOMPOK') { ?>
                                                        <?php
                                                        $nomor_dosen = $_GET['nodos'];
                                                        $res_kelompok = mysqli_query($mysqli, "SELECT * FROM dosen_kelompok dk, tbkmk t WHERE dk.KDMK=t.KDKMKTBKMK AND dk.NODOS='$nomor_dosen' AND dk.KLSMHS='$kelas_huruf' AND t.THSMSTBKMK=dk.THSMS AND dk.THSMS='$ta_lengkap'");
                                                        while ($data_kelompok = mysqli_fetch_array($res_kelompok)) {
                                                            $kelompok = $data_kelompok['id'];
                                                            $jumlah = mysqli_query($mysqli, "SELECT * FROM trnlm t, msmhs m, kelasparalel_mhs k, kelompok_komputer kk WHERE t.NIMHSTRNLM=m.NIMHSMSMHS AND t.NIMHSTRNLM=k.nimhs AND t.THSMSTRNLM='$ta_lengkap' AND t.KDKMKTRNLM='$kodemk' AND t.NIMHSTRNLM=kk.nims AND kk.dosen_kelompok_id='$kelompok' AND nmkelas like '$kelas_huruf%'");
                                                            $count_kelompok = mysqli_num_rows($jumlah);
                                                            $jumlah_kelompok[$kelas_huruf] += $count_kelompok;
                                                            $total_mhs_kelompok += $count_kelompok;
                                                        }
                                                        echo $jumlah_kelompok[$kelas_huruf]
                                                        ?> Mahasiswa
                                                    <?php } else { ?>
                                                        <?php
                                                        $jumlah = mysqli_query($mysqli, "SELECT * FROM trnlm t, msmhs m, kelasparalel_mhs k WHERE t.NIMHSTRNLM=m.NIMHSMSMHS AND t.NIMHSTRNLM=k.nimhs AND t.THSMSTRNLM='$ta_lengkap' AND t.KDKMKTRNLM='$kodemk' AND nmkelas like '$kelas_huruf%' ORDER BY t.NIMHSTRNLM ASC");
                                                        $count = mysqli_num_rows($jumlah);
                                                        echo $count;
                                                        $total_mhs += $count;
                                                        ?> Mahasiswa
                                                    <?php } ?> 
                                                </td>
                                                <td class="col-lg-3">
                                                    <?php if ($model_pengajaran == 'KELOMPOK') { ?>
                                                        <a href="data_kelompok.php?kodemk=<?php echo $data['KDMK']; ?>&kelas=<?php echo $kelas_huruf; ?>&ta=<?php echo $kelas_tahun; ?>&nodos=<?php echo $nomor_dosen; ?>"><span class="label label-success">PILIH KELOMPOK</span></a>&nbsp;
                                                    <?php } else { ?>     
                                                        <a href="data_penilaian_mahasiswa.php?kodemk=<?php echo $data['KDMK']; ?>&kelas=<?php echo $kelas_huruf; ?>&ta=<?php echo $kelas_tahun; ?>&nodos=<?php echo $nomor_dosen; ?>"><span class="label label-success">PENILAIAN</span></a>&nbsp;
                                                        <?php if ($data['PUBUTS'] == "0") { ?>                                                            
                                                            <a href="publikasi_nilai_uts.php?kodemk=<?php echo $data['KDMK']; ?>&nodos=<?php echo $nomor_dosen; ?>&kelas=<?php echo $kelas_huruf; ?>"><span class="label label-danger">PUBLISH</span></a>
                                                        <?php } elseif ($data['PUBUTS'] == "1") { ?>
                                                            <a href="batal_publikasi_nilai_uts.php?kodemk=<?php echo $data['KDMK']; ?>&nodos=<?php echo $nomor_dosen; ?>&kelas=<?php echo $kelas_huruf; ?>"><span class="label label-success">BATAL PUBLISH</span></a>
                                                        <?php } ?>
                                                        <?php if ($data['PUBNILAI'] == "0") { ?>                                                            
                                                            <a href="publikasi_nilai.php?kodemk=<?php echo $data['KDMK']; ?>&nodos=<?php echo $nomor_dosen; ?>&kelas=<?php echo $kelas_huruf; ?>"><span class="label label-danger">PUBLISH</span></a>
                                                        <?php } elseif ($data['PUBNILAI'] == "1") { ?>
                                                            <a href="batal_publikasi_nilai.php?kodemk=<?php echo $data['KDMK']; ?>&nodos=<?php echo $nomor_dosen; ?>&kelas=<?php echo $kelas_huruf; ?>"><span class="label label-success">BATAL PUBLISH</span></a>
                                                        <?php } ?>
                                                    <?php } ?> 
                                                </td>
                                            </tr>

                                            <?php
                                        }
                                        $kd_default = $kodemk;
                                        $kelas_dafault = $kelas_huruf;
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                        JUMLAH TOTAL MAHASISWA : <?php echo $total_mhs + $total_mhs_kelompok; ?> Mahasiswa

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
