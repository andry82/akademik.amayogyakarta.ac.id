<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>DATA PENILAIAN KELOMPOK | SISTEM INFORMASI AKADEMIK - AMA Yogyakarta</title>

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
    
    $nomor_dosen = $_GET['nodos'];
    $kdmk = $_GET['kodemk'];
    $kelas = $_GET['kelas'];
    $kelompok = $_GET['kelompok'];
    $id_dk = $_GET['id'];
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
                        <h4 class="page-header"><i class="fa fa-user fa-fw"></i> DATA PENILAIAN</h4>
                    </div>
                    <div class="col-lg-12"> 
                        <?php
                        $klp = mysqli_query($mysqli, "SELECT * FROM dosen_kelompok WHERE KDMK='$kdmk' AND KLSMHS='$kelas' AND KLPKMHS='$kelompok' AND NODOS='$nomor_dosen' AND THSMS='$ta_lengkap' AND id='$id_dk'");
                        $dt_kelompok = mysqli_fetch_array($klp);
                        $id_kelompok = $dt_kelompok['id'];

                        $mkkuliah = mysqli_query($mysqli, "SELECT * FROM tbkmk WHERE KDKMKTBKMK='$kdmk' AND THSMSTBKMK='$ta_lengkap'");
                        $datamkk = mysqli_fetch_array($mkkuliah);
                        $data_uts = mysqli_query($mysqli, "SELECT * FROM dosen_kelompok WHERE KDMK='$kdmk' AND KLSMHS like '$kelas%' AND PUBUTS='1' AND THSMS='$ta_lengkap'");
                        $countuts = mysqli_num_rows($data_uts);
                        $data_uas = mysqli_query($mysqli, "SELECT * FROM dosen_kelompok WHERE KDMK='$kdmk' AND KLSMHS like '$kelas%' AND PUBNILAI='1' AND THSMS='$ta_lengkap'");
                        $countuas = mysqli_num_rows($data_uas);
                        ?>
                        MATA KULIAH : <?php echo $datamkk['NAKMKTBKMK']; ?><br/>
                         <?php
                        $nomor_dosen = $_GET['nodos'];
                        $resmsdos = mysqli_query($mysqli, "SELECT NMDOSMSDOS,GELARMSDOS FROM msdos WHERE NODOSMSDOS='$nomor_dosen'");
                        $data_msdos = mysqli_fetch_array($resmsdos);
                        ?>
                        NAMA DOSEN : <?php echo $data_msdos['NMDOSMSDOS']; ?>, <?php echo $data_msdos['GELARMSDOS']; ?><br/>
                        KELAS : <?php echo $kelas ?>
                        <?php
                        $tahun = $_GET['ta'];
                        $ta = substr($ta_lengkap, 2, 2);
                        $smtgg = substr($ta_lengkap, 4, 1);
                        echo ($ta - $tahun) + $smtgg;
                        if ($kelompok != "") {
                            ?><br/>
                            KELOMPOK : <?php echo $kelompok ?>
                        <?php }
                        ?> 
                        <br/><br/>
                        <form name="form" method="post" action="update_nilai_kelompok.php">   
                            <input type="hidden" name="ta" value="<?php echo $_GET['ta']; ?>" >
                            <input type="hidden" name="kelompok" value="<?php echo $_GET['kelompok']; ?>" >
                            <input type="hidden" name="nodos" value="<?php echo $_GET['nodos']; ?>" >
                            <input type="hidden" name="kelas" value="<?php echo $_GET['kelas']; ?>" >
                            <input type="hidden" name="mk" value="<?php echo $_GET['kodemk']; ?>" >
                            <input type="hidden" name="id_kelompok" value="<?php echo $id_kelompok; ?>" >
                            <div class="form-group">
                                <a href="data_kelompok.php?kodemk=<?php echo $kdmk; ?>&kelas=<?php echo $kelas; ?>&ta=<?php echo $tahun; ?>&nodos=<?php echo $nomor_dosen; ?>" class="btn btn-success btn-sm" role="button" aria-pressed="true"><i class="fa fa-backward fa-fw"></i> KEMBALI</a>
                                <input type="submit" name="update" value="SIMPAN PENILAIAN " class="btn btn-success btn-sm">
                            </div>
                            <table width="100%" class="table table-striped table-bordered table-hover col-lg-12" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th class="col-lg-1" style="text-align: center; vertical-align: middle;">NIM</th>
                                        <th class="col-lg-2" style="text-align: center; vertical-align: middle;">NAMA MAHASISWA</th>
                                        <th class="col-lg-1" style="text-align: center; vertical-align: middle;">PRESENSI (5%)</th>
                                        <th class="col-lg-1" style="text-align: center; vertical-align: middle;">&nbsp;&nbsp;&nbsp;&nbsp;TUGAS&nbsp;&nbsp;&nbsp;&nbsp; (10%)</th>
                                        <th class="col-lg-1" style="text-align: center; vertical-align: middle;">KEAKTIFAN (10%)</th>
                                        <th class="col-lg-1" style="text-align: center; vertical-align: middle;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;UTS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/>(30%)</th>
                                        <th class="col-lg-1" style="text-align: center; vertical-align: middle;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;UAS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/>(45%)</th>
                                        <th class="col-lg-1" style="text-align: center; vertical-align: middle;">ANGKA</th>
                                        <th class="col-lg-1" style="text-align: center; vertical-align: middle;">HURUF</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $res = mysqli_query($mysqli, "SELECT * FROM trnlm t, msmhs m, kelasparalel_mhs k, kelompok_komputer kk WHERE t.NIMHSTRNLM=m.NIMHSMSMHS AND t.NIMHSTRNLM=k.nimhs AND t.THSMSTRNLM='$ta_lengkap' AND t.KDKMKTRNLM='$kdmk' AND t.NIMHSTRNLM=kk.nims AND kk.dosen_kelompok_id='$id_kelompok' AND nmkelas like '$kelas%'");
                                    while ($data = mysqli_fetch_array($res)) {
                                        $nim = $data['NIMHSTRNLM'];
                                        ?>
                                    <input type="hidden" name="nim[]" value="<?php echo $data['NIMHSTRNLM']; ?>" >
                                    <input type="hidden" name="kodemk[]" value="<?php echo $data['KDKMKTRNLM']; ?>" >
                                    <input id="huruf_<?php echo $nim ?>" type="hidden" name="huruf[]" value="<?php echo $data['NILAI']; ?>">
                                    <input id="angka_<?php echo $nim ?>" type="hidden" name="angka[]" value="<?php echo $data['TOTAL']; ?>">
                                    <?php
                                    $absensi = mysqli_query($mysqli, "SELECT * FROM absensi_siswa WHERE thsms='$ta_lengkap' AND kodemk='$kdmk' AND nim='$nim' AND keterangan='MASUK'");
                                    $jumlahabsen = mysqli_num_rows($absensi);
                                    $alpha = mysqli_query($mysqli, "SELECT * FROM absensi_siswa WHERE thsms='$ta_lengkap' AND kodemk='$kdmk' AND nim='$nim' AND keterangan='TIDAK MASUK'");
                                    $jumlahalpha = mysqli_num_rows($alpha);
                                    ?>
                                    <tr>
                                        <td class="col-lg-1">
                                            <?php if ($jumlahalpha > 5) { ?>
                                                <span style="font-weight: bold; color: red"><?php echo $data['NIMHSTRNLM']; ?></span>
                                            <?php } else { ?>
                                                <?php echo $data['NIMHSTRNLM']; ?>
                                            <?php } ?>
                                        </td>
                                        <td class="col-lg-2">
                                            <?php if ($jumlahalpha > 5) { ?>
                                                <span style="font-weight: bold; color: red"><?php echo $data['NMMHSMSMHS']; ?></span>
                                            <?php } else { ?>
                                                <?php echo $data['NMMHSMSMHS']; ?>
                                            <?php } ?>
                                        </td>
                                        <td class="col-lg-1"><input onkeyup="hitungNilai('<?php echo $nim ?>');" maxlength="3" id="presensi_<?php echo $nim ?>" class="form-control col-lg-1" type="text" name="presensi[]" value="<?php echo round(($jumlahabsen / 14) * 100) ?>" disabled></td>
                                        <?php if ($countuas != 0) {?>
                                        <td class="col-lg-1"><input onkeyup="hitungNilai('<?php echo $nim ?>');" maxlength="3" id="tugas_<?php echo $nim ?>" class="form-control col-lg-1" type="text" name="tugas[]" value="<?php echo $data['TUGAS']; ?>" disabled></td>
                                        <input type="hidden" name="tugas[]" id="tugas_<?php echo $nim ?>" value="<?php echo $data['TUGAS']; ?>" ></td>
                                        <?php }else{ ?>
                                        <td class="col-lg-1"><input onkeyup="hitungNilai('<?php echo $nim ?>');" maxlength="3" id="tugas_<?php echo $nim ?>" class="form-control col-lg-1" type="text" name="tugas[]" value="<?php echo $data['TUGAS']; ?>" ></td>
                                        <?php }?>
                                        <?php if ($countuas != 0) {?>
                                        <td class="col-lg-1"><input onkeyup="hitungNilai('<?php echo $nim ?>');" maxlength="3"id="keaktifan_<?php echo $nim ?>" class="form-control col-lg-1" type="text" name="keaktifan[]" value="<?php echo $data['KEAKTIFAN']; ?>" disabled></td>
                                        <input type="hidden" name="keaktifan[]" id="keaktifan_<?php echo $nim ?>" value="<?php echo $data['KEAKTIFAN']; ?>" ></td>
                                        <?php }else{ ?>
                                        <td class="col-lg-1"><input onkeyup="hitungNilai('<?php echo $nim ?>');" maxlength="3"id="keaktifan_<?php echo $nim ?>" class="form-control col-lg-1" type="text" name="keaktifan[]" value="<?php echo $data['KEAKTIFAN']; ?>" ></td>
                                        <?php }?>
                                        <?php if ($countuts != 0) {?>
                                        <td class="col-lg-1"><input onkeyup="hitungNilai('<?php echo $nim ?>');" maxlength="3" id="mid_<?php echo $nim ?>" class="form-control col-lg-1" type="text" name="mid[]" value="<?php echo $data['MID']; ?>" disabled>
                                        <input type="hidden" name="mid[]" id="mid_<?php echo $nim ?>" value="<?php echo $data['MID']; ?>" ></td>
                                        <?php }else{ ?>
                                        <td class="col-lg-1"><input onkeyup="hitungNilai('<?php echo $nim ?>');" maxlength="3" id="mid_<?php echo $nim ?>" class="form-control col-lg-1" type="text" name="mid[]" value="<?php echo $data['MID']; ?>" ></td>
                                        <?php }?>
                                        <?php if ($countuas != 0) {?>
                                        <td class="col-lg-1"><input onkeyup="hitungNilai('<?php echo $nim ?>');" maxlength="3" id="uas_<?php echo $nim ?>" class="form-control col-lg-1" type="text" name="uas[]" value="<?php echo $data['UAS']; ?>" disabled></td>
                                        <input type="hidden" name="uas[]" id="uas_<?php echo $nim ?>" value="<?php echo $data['UAS']; ?>" ></td>
                                        <?php }else{ ?>
                                        <td class="col-lg-1"><input onkeyup="hitungNilai('<?php echo $nim ?>');" maxlength="3" id="uas_<?php echo $nim ?>" class="form-control col-lg-1" type="text" name="uas[]" value="<?php echo $data['UAS']; ?>" ></td>
                                        <?php }?>
                                        <td class="col-lg-1"><input id="angka_view_<?php echo $nim ?>" class="form-control col-lg-1" type="text" value="<?php echo $data['TOTAL']; ?>" disabled></td>
                                        <td class="col-lg-1"><input id="huruf_view_<?php echo $nim ?>" class="form-control col-lg-1" type="text" value="<?php echo $data['NILAI']; ?>" disabled></td>


                                    </tr>      <?php
                                }
                                ?>
                                </tbody>
                            </table>
                            <div class="form-group">
                                <a href="data_kelompok.php?kodemk=<?php echo $kdmk; ?>&kelas=<?php echo $kelas; ?>&ta=<?php echo $tahun; ?>&nodos=<?php echo $nomor_dosen; ?>" class="btn btn-success btn-sm" role="button" aria-pressed="true"><i class="fa fa-backward fa-fw"></i> KEMBALI</a>
                                <input type="submit" name="update" value="SIMPAN PENILAIAN " class="btn btn-success btn-sm">
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
        <script type="text/javascript">
            function hitungNilai(nim) {
                presensi = document.getElementById('presensi_' + nim).value;
                tugas = document.getElementById('tugas_' + nim).value;
                keaktifan = document.getElementById('keaktifan_' + nim).value;
                mid = document.getElementById('mid_' + nim).value;
                uas = document.getElementById('uas_' + nim).value;

                if (presensi < 0 || presensi > 100) {
                    alert("Nilai Hanya dari 0 - 100");
                    document.getElementById('presensi_' + nim).value = "";
                    presensi = '0';
                }
                hasil_presensi = (5 / 100) * presensi;
                if (tugas < 0 || tugas > 100) {
                    alert("Nilai Hanya dari 0 - 100");
                    document.getElementById('tugas_' + nim).value = "";
                    tugas = '0';
                }
                hasil_tugas = (10 / 100) * tugas;
                if (keaktifan < 0 || keaktifan > 100) {
                    alert("Nilai Hanya dari 0 - 100");
                    document.getElementById('keaktifan_' + nim).value = "";
                    keaktifan = '0';
                }
                hasil_keaktifan = (10 / 100) * keaktifan;

                if (mid < 0 || mid > 100) {
                    alert("Nilai Hanya dari 0 - 100");
                    document.getElementById('mid_' + nim).value = "";
                    mid = '0';
                }
                hasil_mid = (30 / 100) * mid;
                if (uas < 0 || uas > 100) {
                    alert("Nilai Hanya dari 0 - 100");
                    document.getElementById('uas_' + nim).value = "";
                    uas = '0';
                }
                hasil_uas = (45 / 100) * uas;

                angka = hasil_presensi + hasil_tugas + hasil_keaktifan + hasil_mid + hasil_uas;
                document.getElementById('angka_' + nim).value = Math.round(angka);
                document.getElementById('angka_view_' + nim).value = Math.round(angka);
                pembulatan = Math.round(angka);
                if (pembulatan >= '85') {
                    huruf = "A";
                    bobot = "4.00";
                } else if (pembulatan >= '70') {
                    huruf = "B";
                    bobot = "3.00";
                } else if (pembulatan >= '55') {
                    huruf = "C";
                    bobot = "2.00";
                } else if (pembulatan >= '40') {
                    huruf = "D";
                    bobot = "1.00";
                } else {
                    huruf = "E";
                    bobot = "0.00";
                }

                document.getElementById('huruf_' + nim).value = huruf;
                document.getElementById('huruf_view_' + nim).value = huruf;
                document.getElementById('bobot_' + nim).value = bobot;
            }
        </script>
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
    </body>
</html>
