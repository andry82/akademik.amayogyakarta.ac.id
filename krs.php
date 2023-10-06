<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>KARTU RENCANA STUDI| SISTEM INFORMASI AKADEMIK - AMA Yogyakarta</title>

        <!-- Bootstrap Core CSS -->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
        <link href="dist/css/sb-admin-2.css" rel="stylesheet">
        <link href="stylesheet/site.css" rel="stylesheet">
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
                        <h4 class="page-header"><i class="fa fa-list-alt fa-fw"></i> KARTU RENCANA STUDI</h4>
                        <?php
                        $nim = $_GET['nim'];
                        if (isset($_POST['tahun_ajaran'])) {
                            $kurikulum = $_POST['kurikulum'];
                            $jml_cek = count($_POST['kodemk']);
                            mysqli_query($mysqli, "delete from tmpkrs where nimhs = '" . $nim . "' and KURIKULUM = '" . $kurikulum . "' and thsms = '" . $ta_lengkap . "'");
                            $waktu = date("d-m-Y, H:i:s");
                            foreach ($_POST['kodemk'] as $kodemk) {
                                if ($kodemk) {
                                    $parse = explode("##", $kodemk);
                                    $kodemk = $parse[0];
                                    $sksmk = $parse[1];
                                    $ulang = $parse[2];
                                    mysqli_query($mysqli, "INSERT INTO tmpkrs (nimhs,thsms,kdjen,kdpst,kdkmk,tglinput,KURIKULUM,sksmk,ulang) VALUES ('" . $nim . "','$ta_lengkap','E','61401','$kodemk','$waktu','$kurikulum','$sksmk','$ulang')");
                                    //echo "INSERT INTO tmpkrs (nimhs,thsms,kdjen,kdpst,kdkmk,tglinput,sksmk,ulang) VALUES ('".$nim."','$ta_lengkap','E','61401','$kodemk','$tgl_tmpkrs','$sksmk','$ulang')";
                                }
                            }
                            $jumlah_status = mysqli_query($mysqli, "SELECT * FROM statusmhs WHERE nim='$nim' and tahun='$ta_lengkap'");
                            $count = mysqli_num_rows($jumlah_status);
                            if ($count == '0') {
                                $statusmhs = "INSERT INTO `statusmhs` (`tahun`, `nim`, `status`, `tglaktifasi`, `tglkrs`, `tglacc`, `tglrekap`, `tglmid`, `tgluas`, `terlambat`) VALUES ('$ta_lengkap', '$nim', 'A', '$waktu', '$waktu', '', '', '', '', 'T')";
                                mysqli_query($mysqli, $statusmhs);
                            } elseif ($count != '0' && $jml_cek == '0') {
                                mysqli_query($mysqli, "UPDATE statusmhs SET tglkrs='' where nim = '" . $nim . "' and tahun='" . $ta_lengkap . "' and status='A'");
                            } else {
                                mysqli_query($mysqli, "UPDATE statusmhs SET tglkrs='$waktu' where nim = '" . $nim . "' and tahun='" . $ta_lengkap . "' and status='A'");
                            }
                        }
                        ?>
                        <?php
                        $res = mysqli_query($mysqli, "SELECT * FROM msmhs m, kelasparalel_mhs km, kelasparalel k, msdos md WHERE m.NIMHSMSMHS=km.nimhs AND km.nmkelas=k.namakelas AND k.nodos=md.NODOSMSDOS AND m.NIMHSMSMHS='$nim'");
                        while ($data = mysqli_fetch_array($res)) {
                            $nik = $data['NIKMSMHS'];
                            $nama = $data['NMMHSMSMHS'];
                            $kelas = $data['nmkelas'];
                            $no_dos = $data['nodos'];
                            $nama_dosen = $data['NMDOSMSDOS'];
                            $tplahir = $data['TPLHRMSMHS'];
                            $tglahir = $data['TGLHRMSMHS'];
                            $jenis_kelamin = $data['KDJEKMSMHS'];
                            $alamat_sekarang = $data['ALAMATYOGYA'];
                            $alamat_lengkap = $data['ALAMATLENGKAP'];
                            $propinsi = $data['ASSMAMSMHS'];
                            $agama = $data['AGAMA'];
                            $telp = $data['TELP'];
                            $email = $data['EMAIL'];
                            $asal_sekolah = $data['NAMASEKOLAH'];
                            $nama_ortu = $data['NAMAORTUWALI'];
                            $telp_ortu = $data['TELPORTUWALI'];
                            $alamat_ortu = $data['ALAMATORTUWALI'];
                            $keahlian = $data['keahlian'];
                            $profesi = $data['profesi'];
                            $images = $data['ktpkk'];
                            $status_data = $data['tgl_update'];
                            $konsentrasi = $data['kdkonsen'];
                            $thmskmhs = $data['TAHUNMSMHS'];
                            $kurikulum = $data['KURIKULUM'];
                            $statusmhs = $data['STMHSMSMHS'];
                        }
                        $semester = (($ta - $thmskmhs) * 2) + $smtgg;
                        $smt_view = "0$semester";
                        $smt = "$semester";
                        $trakm = mysqli_query($mysqli, "SELECT * FROM trakm WHERE NIMHSTRAKM='$nim' AND THSMSTRAKM<'$ta_lengkap' AND KURIKULUM='$kurikulum' ORDER BY THSMSTRAKM DESC LIMIT 1");
                        while ($dttrakm = mysqli_fetch_array($trakm)) {
                            $NLIPSTRAKM = $dttrakm['NLIPSTRAKM'];
                        }
                        $SKSMAX = "24";
                        ?>
                        <table class="table table-striped table-bordered">
                            <tr><th>NIM</th><td><?php echo $nim; ?></td><th>Dosen Pembimbing Akademik</th><td><?php echo $nama_dosen; ?></td></tr>
                            <tr><th>Nama Lengkap</th><td><?php echo $nama; ?></td><th>IPK Semester Lalu</th><td><?php echo $NLIPSTRAKM; ?></td></tr>
                            <tr><th>Konsentrasi</th><td>
                                    <?php if ($konsentrasi == 'MRS') { ?>
                                        MANAJEMEN ADMINISTRASI RUMAH SAKIT
                                    <?php } elseif ($konsentrasi == 'MTU') { ?>
                                        MANAJEMEN ADMINISTRASI TRANSPORTASI UDARA
                                    <?php } elseif ($konsentrasi == 'MOF') { ?>
                                        MANAJEMEN ADMINISTRASI OBAT DAN FARMASI
                                    <?php } ?>
                                </td><th>Jumlah Maksimal SKS diambil</th><td><?php echo $SKSMAX; ?> SKS</td></tr>
                            <tr><th>Kelas</th><td><?php
                                    $parts = explode('-', $kelas);
                                    echo $parts[0]
                                    ?> - <?php echo $smt; ?></td><th>Jumlah SKS diambil</th><td><span id="JumlahSksDipilih" style="font-weight: bold;">0</span> SKS<?php echo $totalambil; ?></td></tr>
                        </table>    
                        <h4 class="page-header"><i class="fa fa-list-alt fa-fw"></i> MATA KULIAH REKOMENDASI MENGULANG</h4>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th class="col-lg-2">KODE MK</th>
                                <th class="col-lg-8">MATA KULIAH</th>
                                <th class="col-lg-1">SKS</th>
                                <th class="col-lg-1">NILAI</th>
                            </tr>
                            <?php
                            $ta = substr($ta_lengkap, 0, 4);                            
                            $smtgg = substr($ta_lengkap, 4, 1);
                            $ta_1 = $ta - 1 .$smtgg;
                            $ta_2 = $ta - 2 .$smtgg;
                            $ta_3 = $ta - 3 .$smtgg;
                            $ta_4 = $ta - 4 .$smtgg;
                            $ta_5 = $ta - 5 .$smtgg;
                            $query = "SELECT distinct(tr.KDKMKTRNLM) from trnlm tr, tbkmk tbk where tr.KURIKULUM=tbk.KURIKULUM AND tr.KDKMKTRNLM=tbk.KDKMKTBKMK AND (tr.THSMSTRNLM='$ta_1' OR tr.THSMSTRNLM='$ta_2' OR tr.THSMSTRNLM='$ta_3' OR tr.THSMSTRNLM='$ta_4' OR tr.THSMSTRNLM='$ta_5') and tr.NIMHSTRNLM='$nim' and tbk.KURIKULUM='$kurikulum' order by tr.KDKMKTRNLM,tr.NLAKHTRNLM ASC";
                            $hasil = mysqli_query($mysqli, $query);
                            while ($data_mk = mysqli_fetch_array($hasil)) {
                                $kode2 = $data_mk["KDKMKTRNLM"];
                                $totip3 = "SELECT NLAKHTRNLM,BOBOTTRNLM,THSMSTRNLM,KDKMKTRNLM from trnlm  where NIMHSTRNLM='$nim' and KDKMKTRNLM='$kode2' and KURIKULUM='$kurikulum' order by NLAKHTRNLM ASC LIMIT 0,1";
                                $hasilip3 = mysqli_query($mysqli, $totip3);
                                $dataip3 = mysqli_fetch_array($hasilip3);
                                $nilai2 = $dataip3["NLAKHTRNLM"];
                                $bobot2 = $dataip3["BOBOTTRNLM"];
                                $THSMSTRNLM = $dataip3["THSMSTRNLM"];
                                $kode3 = $dataip3["KDKMKTRNLM"];
                                $totmk2 = "SELECT m.SKSMKTBKMK,m.NAKMKTBKMK, m.NAKMKTBKMK_EN, m.KDKMKTBKMK from tbkmk m where m.KDKMKTBKMK='$kode3' and m.THSMSTBKMK='$THSMSTRNLM' and (m.kdkonsen='u' or m.kdkonsen='$konsentrasi') and m.KURIKULUM='$kurikulum'";
                                $hasilmk2 = mysqli_query($mysqli, $totmk2);
                                $datamk2 = mysqli_fetch_array($hasilmk2);
                                $sks2 = $datamk2["SKSMKTBKMK"];
                                $kode_mk = $datamk2["KDKMKTBKMK"];
                                $namamk = $datamk2["NAKMKTBKMK"];
                                $namamk_en = $datamk2["NAKMKTBKMK_EN"];
                                if ($nilai2 == "T" or $nilai2 == "D" or $nilai2 == "E" or $nilai2 == "0") {
                                    ?>
                                    <tr>
                                        <td><?php echo $kode3; ?></td>
                                        <td><?php echo $namamk; ?></td>
                                        <td><?php echo $sks2; ?></td>
                                        <td><?php echo $nilai2; ?></td>
                                    </tr>
                                <?php
                                }
                            }
                            ?>

                        </table>
                        <form name="form" method="post" action="">
                            <input name="nim" value="<?php echo $nim; ?>" type="hidden">
                            <input name="kurikulum" value="<?php echo $kurikulum; ?>" type="hidden">
                            <input name="tahun_ajaran" value="<?php echo $ta; ?>" type="hidden">
                            <button id="tab01" onclick="bukaPilihan('01')" type="button" class="btn btn-primary">SEMESTER 1</button>
                            <button id="tab02" onclick="bukaPilihan('02')" type="button" class="btn btn-primary">SEMESTER 2</button>
                            <button id="tab03" onclick="bukaPilihan('03')" type="button" class="btn btn-primary">SEMESTER 3</button>
                            <button id="tab04" onclick="bukaPilihan('04')" type="button" class="btn btn-primary">SEMESTER 4</button>
                            <button id="tab05" onclick="bukaPilihan('05')" type="button" class="btn btn-primary">SEMESTER 5</button>
                            <button id="tab06" onclick="bukaPilihan('06')" type="button" class="btn btn-primary">SEMESTER 6</button>                            
                            <br/><br/>
                            <?php
                            $smt = mysqli_query($mysqli, "SELECT DISTINCT SEMESTBKMK FROM tbkmk WHERE KURIKULUM='$kurikulum' AND THSMSTBKMK='$ta_lengkap' ORDER BY SEMESTBKMK ASC");
                            while ($dtsmt = mysqli_fetch_array($smt)) {
                                $semester = $dtsmt['SEMESTBKMK'];
                                ?>
                                <table id="SEMESTER_<?php print($semester); ?>" style="display:table" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th class="col-lg-1">#</th>
                                            <th class="col-lg-2">KODE MK</th>
                                            <th class="col-lg-8">MATA KULIAH</th>
                                            <th class="col-lg-1">SKS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $result = mysqli_query($mysqli, "SELECT * FROM tbkmk WHERE THSMSTBKMK='$ta_lengkap' AND KURIKULUM='$kurikulum' AND SEMESTBKMK='$semester' AND (kdkonsen='u' or kdkonsen='$konsentrasi') ORDER BY KDKMKTBKMK ASC");
                                        $no = 1;
                                        while ($data = mysqli_fetch_array($result)) {
                                            $urutan = $semester . $no++;
                                            $kdmk = $data['KDKMKTBKMK'];
                                            $smsmk = $data['SKSMKTBKMK'];
                                            $tmprs = mysqli_query($mysqli, "SELECT * FROM tmpkrs WHERE nimhs='$nim' AND kdkmk='$kdmk' AND thsms='$ta_lengkap' AND sksmk='$smsmk'");
                                            while ($jumlahsks = mysqli_fetch_array($tmprs)) {
                                                $tt++;
                                                $tots = $jumlahsks['sksmk'];
                                                $totalambil = $totalambil + $tots;
                                            }
                                            $jumambil = mysqli_num_rows($tmprs);
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php if ($jumambil >= 1) { ?>
                                                        <input name="kodemk[<?php echo $urutan ?>]" id="checkboxMK<?php echo $urutan ?>" onclick="hitungSKS('<?php echo $data['SKSMKTBKMK']; ?>', '<?php echo $urutan ?>')" value="<?php echo $data['KDKMKTBKMK']; ?>##<?php echo $data['SKSMKTBKMK']; ?>##<? print($ulang); ?>" type="checkbox" checked="checked">
                                                    <?php } else { ?>
                                                        <input name="kodemk[<?php echo $urutan ?>]" id="checkboxMK<?php echo $urutan ?>" onclick="hitungSKS('<?php echo $data['SKSMKTBKMK']; ?>', '<?php echo $urutan ?>')" value="<?php echo $data['KDKMKTBKMK']; ?>##<?php echo $data['SKSMKTBKMK']; ?>##<? print($ulang); ?>" type="checkbox">
                                                <?php } ?>
                                                </td>
                                                <?php
                                                $data_krs_mhs = mysqli_query($mysqli, "SELECT * FROM tmpkrs WHERE nimhs='$nim' AND kdkmk='$kdmk' AND thsms < '$ta_lengkap'");
                                                $count = mysqli_num_rows($data_krs_mhs);
                                                if ($count == 0) {
                                                    ?>
                                                    <td><?php echo $data['KDKMKTBKMK']; ?></td>
                                                    <td><?php echo $data['NAKMKTBKMK']; ?></td>
                                                    <td><?php echo $data['SKSMKTBKMK']; ?></td>
        <?php } else { ?>
                                                    <td><b><?php echo $data['KDKMKTBKMK']; ?></b></td>
                                                    <td><b><?php echo $data['NAKMKTBKMK']; ?></b></td>
                                                    <td><b><?php echo $data['SKSMKTBKMK']; ?></b></td>
                                            <?php } ?>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>             
<?php } ?>
                            <a href="data_bimbingan_krs.php?nim=<?php echo $nim ?>" class="btn btn-danger" role="button" aria-pressed="true"> KEMBALI</a> <button type="submit" class="btn btn-success"><i class="fa fa-save fa-fw"></i> SIMPAN</button>
                        </form>
                        <br/>


                    </div>
                </div>
            </div>
        </div>
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
    <script language="javascript" type="text/javascript">

                                                // -- jumlah sks yg tersimpan di database
                                                //-- var jmlSksTersimpan = '';
                                                var jmlSksTersimpan = '<? print($totalambil); ?>';
                                                var f = document.getElementById('JumlahSksDipilih');
                                                var cf = document.getElementById('captionJumlahSksDipilih');
                                                var finsertmk = document.getElementById('finsertmk');
                                                f.innerHTML = jmlSksTersimpan;
                                                function styleMKdipilih(n) {
                                                    var c = document.getElementById('checkboxMK' + n);
                                                    var itemmk = document.getElementById('itemmk' + n);
                                                    if (c.checked == true) {
                                                        itemmk.style.backgroundColor = '#F7FF9C'
                                                    } else {
                                                        itemmk.style.backgroundColor = ''
                                                    }
                                                }

                                                function hitungSKS(sks, n) {
                                                    var f = document.getElementById('JumlahSksDipilih');
                                                    var msgerr = document.getElementById('error');
                                                    var batasanSks = '<? print($SKSMAX);?>';
                                                    var jmlSksTersimpan = '';

                                                    if (document.getElementById('checkboxMK' + n).checked) {
                                                        if (f.innerHTML) {
                                                            f.innerHTML = parseInt(f.innerHTML) + parseInt(sks);
                                                        } else {
                                                            f.innerHTML = sks;
                                                        }
                                                    } else {
                                                        if (f.innerHTML) {
                                                            f.innerHTML = parseInt(f.innerHTML) - parseInt(sks);
                                                        }
                                                        if (f.innerHTML <= 0) {
                                                            f.innerHTML = 0;
                                                        }
                                                    }
                                                    if (parseInt(f.innerHTML) > parseInt(batasanSks)) {
                                                        //msgerr.innerHTML = '<br><b>MAAF! Berdasarkan peraturan yang berlaku, Anda hanya boleh menempuh '+ batasanSks +' SKS</b>';
                                                        alert('MAAF! Anda hanya boleh menempuh ' + batasanSks + ' SKS\n\n');
                                                        f.innerHTML = parseInt(f.innerHTML) - parseInt(sks);
                                                        document.getElementById('checkboxMK' + n).checked = false;
                                                    } else {
                                                        msgerr.innerHTML = '';
                                                    }
                                                    cekJmlSksDipilih();
                                                    styleMKdipilih(n)
                                                }

                                                function checkedBox(sks, n) {
                                                    var c = document.getElementById('checkboxMK' + n);
                                                    var f = document.getElementById('JumlahSksDipilih');
                                                    var msgerr = document.getElementById('error');
                                                    var batasanSks = '<? print($SKSMAX);?>';
                                                    if (c.checked == true) {
                                                        c.checked = false;
                                                        if (f.innerHTML) {
                                                            f.innerHTML = parseInt(f.innerHTML) - parseInt(sks);
                                                        }
                                                        if (f.innerHTML <= 0) {
                                                            f.innerHTML = 0;
                                                        }
                                                    } else {
                                                        c.checked = true;
                                                        if (f.innerHTML) {
                                                            f.innerHTML = parseInt(f.innerHTML) + parseInt(sks);
                                                        } else {
                                                            f.innerHTML = sks;
                                                        }
                                                    }
                                                    if (parseInt(f.innerHTML) > parseInt(batasanSks)) {
                                                        //msgerr.innerHTML = '<br><b>MAAF! Berdasarkan peraturan yang berlaku, Anda hanya boleh menempuh '+ batasanSks +' SKS</b>';
                                                        alert('MAAF! Anda hanya boleh menempuh ' + batasanSks + ' SKS\n\n');
                                                        f.innerHTML = parseInt(f.innerHTML) - parseInt(sks);
                                                        document.getElementById('checkboxMK' + n).checked = false;
                                                    } else {
                                                        msgerr.innerHTML = '';
                                                    }
                                                    cekJmlSksDipilih();
                                                    styleMKdipilih(n)
                                                }

                                                for (s = 1; s <= 6; s++) {
                                                    var smtdisplay = document.getElementById('SEMESTER_0' + s).style.display;
                                                    smtdisplay = 'none';
                                                }

                                                function overButton(smt) {
                                                    var tab = document.getElementById('tab' + smt);
                                                    tab.style.backgroundColor = '#717171';
                                                }

                                                function outButton(smt) {
                                                    var tab = document.getElementById('tab' + smt);
                                                    //tab.style.backgroundColor = '#313131';
                                                }

                                                // display matakuliah
                                                for (smtr = 1; smtr <= 6; smtr++) {
                                                    var tab = document.getElementById('tab0' + smtr);
                                                    var smtdisplay = document.getElementById('SEMESTER_0' + smtr);
                                                    if (smtr == "<? print($smt_view); ?>") {
                                                        tab.style.backgroundColor = '#449d44'
                                                        tab.style.color = '#FFFFFF'
                                                        smtdisplay.style.display = 'table';
                                                    } else {
                                                        //tab.style.backgroundColor = '#313031'
                                                        tab.style.color = '#FFFFFF'
                                                        smtdisplay.style.display = 'none';
                                                    }
                                                }

                                                function bukaPilihan(smt) {
                                                    var tab = document.getElementById('tab' + smt);
                                                    var smtdisplay = document.getElementById('SEMESTER_' + smt);
                                                    if (smtdisplay.style.display == 'table') {
                                                        smtdisplay.style.display = 'none';
                                                    } else {
                                                        for (s = 1; s <= 6; s++) {
                                                            var smtd = document.getElementById('SEMESTER_0' + s);
                                                            var tabs = document.getElementById('tab0' + s);
                                                            if (smt != '0' + s) {
                                                                smtd.style.display = 'none';
                                                                tabs.style.backgroundColor = '#337ab7'
                                                                tabs.style.color = '#FFFFFF'
                                                            }
                                                        }
                                                        smtdisplay.style.display = 'table';
                                                        tab.style.backgroundColor = '#449d44'
                                                        tab.style.color = '#FFFFFF'
                                                    }
                                                }
    </script>
</body>
</html>
