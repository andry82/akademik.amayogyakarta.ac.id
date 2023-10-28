<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>DETAIL MAHASISWA | SISTEM INFORMASI AKADEMIK - AMA Yogyakarta</title>

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
        <link href="stylesheet/cetak_ktm_pdf.css" rel="stylesheet">
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
        function printOut() {
            var getDisplay = document.getElementById("printarea").innerHTML;
            var setPrint = window.open("", "printed", "directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=663,height=211");
            setPrint.document.open();
            setPrint.document.write('<html>');
            setPrint.document.write('<head>');
            setPrint.document.write('<meta http-equiv="pragma" content="no-cache">');
            setPrint.document.write("<title>CETAK KARTU MAHASISWA</title>");
            setPrint.document.write('<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">');
            setPrint.document.write('<link href="stylesheet/cetak_ktm_pdf.css" rel="stylesheet" type="text/css">');
            setPrint.document.write('</head>');
            setPrint.document.write('<body onLoad="self.print()">');
            setPrint.document.write(getDisplay);
            setPrint.document.write('</body></html>');
            setPrint.document.close();
            window.close("", "printed");
        }
    </script>
    <body onload="tampilkanwaktu();
            setInterval('tampilkanwaktu()', 1000);">	
        <div id="wrapper">
            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <?php include 'sidebar_menu.php'; ?>
                <!-- /.navbar-static-side -->
            </nav>

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="page-header"><i class="fa fa-eye fa-fw"></i> DETAIL MAHASISWA</h4>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">                    
                    <div class="col-lg-12">
                        <?php
//getting id from url
                        $nim = $_GET['nim'];
//selecting data associated with this particular id
                        $res = mysqli_query($mysqli, "SELECT * FROM msmhs m, kelasparalel_mhs km, kelasparalel k, msdos md, konsentrasi ks WHERE m.NIMHSMSMHS=km.nimhs AND km.nmkelas=k.namakelas AND k.nodos=md.NODOSMSDOS AND m.kdkonsen=ks.kdkonsen AND m.NIMHSMSMHS='$nim'");
                        while ($data = mysqli_fetch_array($res)) {
                            $ketarangan_revisi = $data['KET_REV'];
                            $nik = $data['NIKMSMHS'];
                            $nama = $data['NMMHSMSMHS'];
                            $kelas = $data['nmkelas'];
                            $no_dos = $data['nodos'];
                            $nama_dosen = $data['NMDOSMSDOS'];
                            $gelar_dosen = $data['GELARMSDOS'];
                            $tplahir = $data['TPLHRMSMHS'];
                            $tglahir = $data['TGLHRMSMHS'];
                            $jenis_kelamin = $data['KDJEKMSMHS'];
                            $alamat_sekarang = $data['ALAMATYOGYA'];
                            $alamat_lengkap = $data['ALAMATLENGKAP'];
                            $jalan = $data['JALAN'];
                            $rtrw = $data['RTRW'];
                            $dusun = $data['DUSUN'];
                            $kelurahan = $data['KELURAHAN'];
                            $kecamatan = $data['KECAMATAN_EKSPORT'];
                            $kabupaten = $data['KABUPATEN_EKSPORT'];
                            $propinsi = $data['PROPINSI_EKSPORT'];
                            $kewarganegaraan = $data['KEWARGANEGARAAN'];
                            $nokps = $data['NOKPS'];
                            $agama = $data['AGAMA'];
                            $telp = $data['TELP'];
                            $email = $data['EMAIL'];
                            $asal_sekolah = $data['NAMASEKOLAH'];
                            $nikayah = $data['NIKAYAH'];
                            $nama_ortu = $data['NAMAORTUWALI'];
                            $tempat_lahir_ayah = $data['TEMPATLAHIRAYAH'];
                            $tanggal_lahir_ayah = $data['TANGGALLAHIRAYAH'];
                            $pendidikan_ayah = $data['PENDIDIKANAYAH'];
                            $pekerjaan_ayah = $data['PEKERJAANORTUWALI'];
                            $penghasilan_ayah = $data['PENGHASILANAYAH'];
                            $telp_ortu = $data['TELPORTUWALI'];
                            $alamat_ortu = $data['ALAMATORTUWALI'];
                            $nikibu = $data['NIKIBU'];
                            $nama_ibu = $data['NAMAIBU'];
                            $tempat_lahir_ibu = $data['TEMPATLAHIRIBU'];
                            $tanggal_lahir_ibu = $data['TANGGALLAHIRIBU'];
                            $pendidikan_ibu = $data['PENDIDIKANIBU'];
                            $pekerjaan_ibu = $data['PEKERJAANIBU'];
                            $penghasilan_ibu = $data['PENGHASILANIBU'];
                            $telp_ibu = $data['TELPIBU'];
                            $alamat_ibu = $data['ALAMATIBU'];
                            $nik_wali = $data['NIKWALI'];
                            $nama_wali = $data['NAMAWALI'];
                            $tempat_lahir_wali = $data['TEMPATLAHIRWALI'];
                            $tanggal_lahir_wali = $data['TANGGALLAHIRWALI'];
                            $pendidikan_wali = $data['PENDIDIKANWALI'];
                            $pekerjaan_wali = $data['PEKERJAANWALI'];
                            $penghasilan_wali = $data['PENGHASILANWALI'];
                            $telp_wali = $data['TELPWALI'];
                            $alamat_wali = $data['ALAMATWALI'];
                            $hobi = $data['HOBI'];
                            $keahlian = $data['KEAHLIAN'];
                            $kurikulum_berjalan = $data['KURIKULUM'];
                            $ktp = $data['ktpkk'];
                            $ijazah = $data['ijazah_sma'];
                            $akte_kelahiran = $data['akte_kelahiran'];
                            $status_data = $data['tgl_update'];
                            $konsentrasi = $data['nmkonsen'];
                            $thmskmhs = $data['TAHUNMSMHS'];
                            $statusmhs = $data['STMHSMSMHS'];
                            $stat_data = $data['STATUSDATA'];
                            $password = $data['login_pass'];
                        }
                        $trmkm = mysqli_query($mysqli, "select * from trakm WHERE NIMHSTRAKM=$nim ORDER BY SKSTTTRAKM DESC LIMIT 1");
                        while ($dttr = mysqli_fetch_array($trmkm)) {
                            $skstot = $dttr['SKSTTTRAKM'];
                            $ipk = $dttr['NLIPKTRAKM'];
                        }
                        ?>
                        <?php if ($status_data && ($stat_data == '3')) { ?>
                            <a href="proses_status_data_mahasiswa.php?nim=<?php echo $nim; ?>&status_data=3"><span class="label label-success">TERVERIFIKASI</span></a>
                            <a href="proses_status_data_mahasiswa.php?nim=<?php echo $nim; ?>&status_data=2"><span class="label label-default">REVISI</span></a>
                            <a href="proses_status_data_mahasiswa.php?nim=<?php echo $nim; ?>&status_data=1"><span class="label label-default">PENGAJUAN DATA</span></a>
                            <a href="proses_status_data_mahasiswa.php?nim=<?php echo $nim; ?>&status_data=0"><span class="label label-default">BELUM TERVERIFIKASI</span></a>
                        <?php } else if ($status_data == "" && ($stat_data == '2')) { ?>
                            <a href="proses_status_data_mahasiswa.php?nim=<?php echo $nim; ?>&status_data=3"><span class="label label-default">TERVERIFIKASI</span></a>
                            <a href="proses_status_data_mahasiswa.php?nim=<?php echo $nim; ?>&status_data=2"><span class="label label-success">REVISI</span></a>
                            <a href="proses_status_data_mahasiswa.php?nim=<?php echo $nim; ?>&status_data=1"><span class="label label-default">PENGAJUAN DATA</span></a>
                            <a href="proses_status_data_mahasiswa.php?nim=<?php echo $nim; ?>&status_data=0"><span class="label label-default">BELUM TERVERIFIKASI</span></a>
                        <?php } else if ($status_data == "" && ($stat_data == '1')) { ?>
                            <a href="proses_status_data_mahasiswa.php?nim=<?php echo $nim; ?>&status_data=3"><span class="label label-default">TERVERIFIKASI</span></a>
                            <a href="proses_status_data_mahasiswa.php?nim=<?php echo $nim; ?>&status_data=2"><span class="label label-default">REVISI</span></a>
                            <a href="proses_status_data_mahasiswa.php?nim=<?php echo $nim; ?>&status_data=1"><span class="label label-success">PENGAJUAN DATA</span></a>
                            <a href="proses_status_data_mahasiswa.php?nim=<?php echo $nim; ?>&status_data=0"><span class="label label-default">BELUM TERVERIFIKASI</span></a>
                        <?php } else if ($status_data == "" && ($stat_data == '0')) { ?>
                            <a href="proses_status_data_mahasiswa.php?nim=<?php echo $nim; ?>&status_data=3"><span class="label label-default">TERVERIFIKASI</span></a>
                            <a href="proses_status_data_mahasiswa.php?nim=<?php echo $nim; ?>&status_data=2"><span class="label label-default">REVISI</span></a>
                            <a href="proses_status_data_mahasiswa.php?nim=<?php echo $nim; ?>&status_data=1"><span class="label label-default">PENGAJUAN DATA</span></a>
                            <a href="proses_status_data_mahasiswa.php?nim=<?php echo $nim; ?>&status_data=0"><span class="label label-success">BELUM TERVERIFIKASI</span></a>
                        <?php } ?>
                        &nbsp;&nbsp;&nbsp;<a href="edit_mahasiswa.php?nim=<?php echo $nim; ?>"><span class="label label-danger">EDIT DATA MAHASISWA</span></a>
                        &nbsp;<a href="ganti_kelas_konsentrasi_dpa.php?nim=<?php echo $nim; ?>"><span class="label label-danger">GANTI KELAS, KONSENTRASI DAN DPA</span></a>
                        <br/><br/>
                        <?php if ($status_data == "" && ($stat_data == '2')) { ?>
                            <div class="alert alert-warning" role="alert">
                                <b>KETERANGAN REVISI :</b> <?php echo $ketarangan_revisi; ?>
                            </div>
                        <?php } ?>
                        <center><label>DATA AKADEMIK</label></center>
                        <br/>
                        <table width="100%" class="table table-bordered">                                                     
                            <tr>
                                <th class="col-lg-3">FOTO MAHASISWA</th>
                                <td><img src="http://simaster.amayogyakarta.ac.id/images/foto_mhs/<?php echo $nim ?>.JPG" width="200px"></td>
                            </tr>
                            <tr>
                                <th class="col-lg-3">KTM</th>
                                <td>
                                    <table id="printarea" border="0">
                                        <tr>
                                            <td>                                       
                                                <span class="nama"><b><?php echo $nama; ?></b></span>
                                                <span class="nim"><b><?php echo $nim; ?></b></span>
                                                <img src="images/depan.jpg" style="border-width: 0px; height: 200px;">
                                            </td>
                                            <td>
                                                &nbsp;
                                            </td>
                                            <td>
                                                <span class="nama_lengkap" style="color: #FFFFFF"><b>Nama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $nama; ?></b></span>
                                                <span class="nim_mhs" style="color: #FFFFFF"><b>No Mahasiswa&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $nim; ?></b></span>
                                                <span class="program_studi" style="color: #FFFFFF"><b>Program Studi&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;MANAJEMEN</b></span>
                                                <span class="jenjang" style="color: #FFFFFF"><b>Jenjang&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;DIPLOMA TIGA</b></span>
                                                <img class="foto" src="http://simaster.amayogyakarta.ac.id/images/foto_mhs/<?php echo $nim; ?>.JPG">
                                                <img class="barcode" src="barcode.php?text=<?php echo $nim; ?>">
                                                <img src="images/belakang.jpg" style="border-width: 0px; height: 200px;">
                                            </td>                                    
                                        </tr>
                                    </table>
                                    <br/>
                                    <input class="btn btn-primary btn-xs" id="btncetakkhs" value="Cetak KTM" onclick="printOut();" type="button">
                                </td>
                            </tr>
                            <tr>
                                <th class="col-lg-3">NOMOR INDUK</th>
                                <td><?php echo $nim; ?></td>
                            </tr>
                            <tr>
                                <th class="col-lg-3">PRODI / KONSENTRASI</th>
                                <td>
                                    D3 - <span style="text-transform: uppercase"><?php echo 'MANAJEMEN' ?> / <?php echo $konsentrasi; ?></span>
                                </td>
                            </tr>
                            <tr>
                                <th class="col-lg-3">SEMESTER</th>
                                <?php
                                $ctrakm = mysqli_query($mysqli, "SELECT * FROM statusmhs WHERE nim='$nim' AND tahun='$ta_lengkap'");
                                $rowcount = mysqli_num_rows($ctrakm);
                                ?>
                                <td><?php echo (($ta - $thmskmhs) * 2) + $smtgg; ?> / 
                                    <?php if ($rowcount == '0') { ?>
                                        BELUM AKTIF
                                    <?php } elseif ($rowcount == '1') { ?>
                                        AKTIF
                                    <?php } ?></td>
                            </tr>
                            <tr>
                                <th class="col-lg-3">TOTAL SKS</th>
                                <td><?php echo $skstot; ?> SKS</td>
                            </tr>
                            <tr>
                                <th class="col-lg-3">IP KOMULATIF</th>
                                <td><?php echo $ipk; ?></td>
                            </tr>
                            <tr>
                                <th class="col-lg-3">KELAS</th>
                                <td><?php
                                    $splite = explode("/", $kelas);
                                    echo $splite[0];
                                    ?><?php echo (($ta - $thmskmhs) * 2) + $smtgg; ?>
                                </td>
                            </tr>
                            <tr>
                                <th class="col-lg-3">DOSEN WALI</th>
                                <td><?php echo $nama_dosen; ?>, <?php echo $gelar_dosen; ?>  </td>
                            </tr>    
                            <tr>
                                <th class="col-lg-3">KURIKULUM BERJALAN</th>
                                <td>
                                    <?php
                                    $kurikulum = mysqli_query($mysqli, "SELECT DISTINCT(KURIKULUM) FROM trakm WHERE NIMHSTRAKM='$nim'");
                                    while ($data_kurikulum = mysqli_fetch_array($kurikulum)) {
                                        if ($data_kurikulum['KURIKULUM'] == $kurikulum_berjalan) {
                                            ?>                                    
                                            <a href="proses_pindah_kurikulum.php?nim=<?php echo $nim; ?>&kurikulum=<?php echo $data_kurikulum['KURIKULUM']; ?>"><span class="label label-success"><?php echo $data_kurikulum['KURIKULUM']; ?></span></a>
                                        <?php } else { ?>
                                            <a href="proses_pindah_kurikulum.php?nim=<?php echo $nim; ?>&kurikulum=<?php echo $data_kurikulum['KURIKULUM']; ?>"><span class="label label-default"><?php echo $data_kurikulum['KURIKULUM']; ?></span></a>
                                        <?php }
                                    }
                                    ?>
                                </td>
                            </tr>    
                            <tr>
                                <th class="col-lg-3">STATUS MAHASISWA</th>
                                <td>
<?php if ($statusmhs == 'A') { ?>
                                        <a href="proses_status_akademik_mahasiswa.php?nim=<?php echo $nim; ?>&status_akademik=1"><span class="label label-success">AKTIF</span></a>
                                        <a href="proses_status_akademik_mahasiswa.php?nim=<?php echo $nim; ?>&status_akademik=2"><span class="label label-default">LULUS</span></a>
                                        <a href="proses_status_akademik_mahasiswa.php?nim=<?php echo $nim; ?>&status_akademik=3"><span class="label label-default">KELUAR</span></a>
<?php } elseif ($statusmhs == 'L') { ?>
                                        <a href="proses_status_akademik_mahasiswa.php?nim=<?php echo $nim; ?>&status_akademik=1"><span class="label label-default">AKTIF</span></a>
                                        <a href="proses_status_akademik_mahasiswa.php?nim=<?php echo $nim; ?>&status_akademik=2"><span class="label label-success">LULUS</span></a>
                                        <a href="proses_status_akademik_mahasiswa.php?nim=<?php echo $nim; ?>&status_akademik=3"><span class="label label-default">KELUAR</span></a>
<?php } elseif ($statusmhs == 'K') { ?>
                                        <a href="proses_status_akademik_mahasiswa.php?nim=<?php echo $nim; ?>&status_akademik=1"><span class="label label-default">AKTIF</span></a>
                                        <a href="proses_status_akademik_mahasiswa.php?nim=<?php echo $nim; ?>&status_akademik=2"><span class="label label-default">LULUS</span></a>
                                        <a href="proses_status_akademik_mahasiswa.php?nim=<?php echo $nim; ?>&status_akademik=3"><span class="label label-success">KELUAR</span></a>
<?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <th class="col-lg-3">PASSWORD </th>
                                <td><?php echo $password; ?></td>
                            </tr>  
<?php if ($statusmhs == 'L') { ?>
                                <tr>
                                    <th class="col-lg-3">TH STATUS KELULUSAN</th>
                                    <td><?php echo $thstatuslulusmhs; ?></td>
                                </tr>   
                                <tr>
                                    <th class="col-lg-3">SCAN IJAZAH</th>
                                    <td>
                                        <?php
                                        $ijazahama = "../document/ijazahama/$nim.jpg";
                                        //print($filename);				
                                        if (file_exists($ijazahama)) {
                                            ?>
                                            <img id="zoom_ijazahama" src="../document/ijazahama/<?php echo $nim; ?>.jpg" data-zoom-image="../document/ijazahama/<?php echo $nim; ?>.jpg" width="200">
    <?php } ?>
                                    </td>
                                </tr>   
                                <tr>
                                    <th class="col-lg-3">SCAN TRANSKRIP</th>
                                    <td>
                                        <?php
                                        $transkrip = "../document/transkrip/$nim.jpg";
                                        //print($filename);				
                                        if (file_exists($transkrip)) {
                                            ?>
                                            <img id="zoom_transkrip" src="../document/transkrip/<?php echo $nim; ?>.jpg" data-zoom-image="../document/ijazahama/<?php echo $nim; ?>.jpg" width="200">
    <?php } ?>
                                    </td>
                                </tr>   
<?php } ?>
                        </table>
                        <center><label>DATA MAHASISWA</label></center>
                        <br/>
                        <table width="100%" class="table table-bordered">
                            <tbody>                                
                                <tr>
                                    <th class="col-lg-3">NIK (KTP / KK)</th>
                                    <td><?php echo $nik; ?></td>
                                </tr>
                                <tr>
                                    <th>NAMA LENGKAP</th>
                                    <td><?php echo $nama; ?></td>
                                </tr>
                                <tr>
                                    <th>TEMPAT TANGGAL LAHIR</th>
                                    <td><?php echo $tplahir; ?>, <?php echo date('d-m-Y', strtotime($tglahir)); ?></td>
                                </tr>
                                <tr>
                                    <th>USIA</th>
                                    <td>
                                        <?php
                                        $tanggal_lahir = new DateTime("$tglahir");
                                        $tanggal_sekarang = new DateTime();
                                        $usia = $tanggal_lahir->diff($tanggal_sekarang);
                                        echo $usia->y . ' Tahun ' . $usia->m . ' Bulan ';
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>ALAMAT SEKARANG</th>
                                    <td><?php echo $alamat_sekarang; ?></td>
                                </tr>
                                <tr>
                                    <th>ALAMAT ASAL</th>
                                    <td><?php echo $alamat_lengkap; ?></td>
                                </tr>
                                <tr>
                                    <th>JALAN</th>
                                    <td><?php echo $jalan; ?></td>
                                </tr>
                                <tr>
                                    <th>RT / RW</th>
                                    <td><?php echo $rtrw; ?></td>
                                </tr>
                                <tr>
                                    <th>DUSUN</th>
                                    <td><?php echo $dusun; ?></td>
                                </tr>
                                <tr>
                                    <th>KELURAHAN</th>
                                    <td><?php echo $kelurahan; ?></td>
                                </tr>
                                <tr>
                                    <th>KECAMATAN</th>
                                    <?php
                                    $kec = mysqli_query($mysqli, "SELECT * FROM wilayah WHERE id_wilayah='$kecamatan'");
                                    $data_kec = mysqli_fetch_array($kec)
                                    ?>
                                    <td style="text-transform: uppercase"><?php echo $data_kec['nama_wilayah']; ?></td>
                                </tr>
                                <tr>
                                    <th>KEBUPATEN</th>
                                    <?php
                                    $kab = mysqli_query($mysqli, "SELECT * FROM wilayah WHERE id_wilayah='$kabupaten'");
                                    $data_kab = mysqli_fetch_array($kab)
                                    ?>
                                    <td style="text-transform: uppercase"><?php echo $data_kab['nama_wilayah']; ?></td>
                                </tr>
                                <tr>
                                    <th>PROPINSI</th>
                                    <?php
                                    $prov = mysqli_query($mysqli, "SELECT * FROM wilayah WHERE id_wilayah='$propinsi'");
                                    $data_prov = mysqli_fetch_array($prov)
                                    ?>
                                    <td style="text-transform: uppercase"><?php echo $data_prov['nama_wilayah']; ?></td>
                                </tr>
                                <tr>
                                    <th>KEWARGANEGARAAN</th>
                                    <td><?php echo $kewarganegaraan; ?></td>
                                </tr>
                                <tr>
                                    <th>NO KARTU PERLINDUNGAN SOSIAL</th>
                                    <td><?php echo $nokps; ?></td>
                                </tr>
                                <tr>
                                    <th>JENIS KELAMIN</th>
                                    <td>
                                        <?
                                        if($jenis_kelamin=="L")
                                        {
                                        ?>
                                        LAKI LAKI
                                        <?
                                        }elseif($jenis_kelamin=="P")
                                        {
                                        ?>
                                        PEREMPUAN
                                        <?
                                        }?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>AGAMA</th>
                                    <td>
                                        <?
                                        if($agama=="B")
                                        {
                                        ?>
                                        BUDHA
                                        <?
                                        }elseif($agama=="H")
                                        {
                                        ?>
                                        HINDU
                                        <?
                                        }elseif($agama=="I")
                                        {
                                        ?>
                                        ISLAM
                                        <?
                                        }elseif($agama=="K")
                                        {
                                        ?>
                                        KATOLIK
                                        <?
                                        }elseif($agama=="L")
                                        {
                                        ?>
                                        LAIN-LAIN
                                        <?
                                        }elseif($agama =="P")
                                        {
                                        ?>
                                        KRISTEN
                                        <?
                                        }elseif($agama =="C")
                                        {
                                        ?>
                                        KEPERCAYAAN
                                        <?
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>E-MAIL</th>
                                    <td><?php echo $email; ?></td>
                                </tr>
                                <tr>
                                    <th>ASAL SEKOLAH</th>
                                    <td><?php echo $asal_sekolah; ?></td>
                                </tr>
                                <tr>
                                    <th>NO HANDPHONE</th>
                                    <td><?php echo $telp; ?></td>
                                </tr>
                                <tr>
                                    <th>HOBI</th>
                                    <td><?php echo $hobi; ?></td>
                                </tr>
                                <tr>
                                    <th>KEAHLIAN</th>
                                    <td><?php echo $keahlian; ?></td>
                                </tr>
                                <tr>
                                    <th>KTP / KK SCAN</th>
                                    <td>
<?php if ($ktp) { ?>
                                            <img id="zoom_ktp" src="http://simaster.amayogyakarta.ac.id/document/ktp/<?php echo $ktp; ?>" data-zoom-image="../document/ktp/<?php echo $ktp; ?>" width="200">
                                            <br/>
                                            <a href="http://simaster.amayogyakarta.ac.id/document/ktp/<?php echo $ktp; ?>" target="_blank"><span class="label label-primary">TAMPILKAN KTP</span></a>
                                            <br/>
<?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>IJAZAH SCAN</th>
                                    <td><?php if ($ijazah) { ?>
                                            <img id="zoom_ijazah" src="http://simaster.amayogyakarta.ac.id/document/ijazah/<?php echo $ijazah; ?>" data-zoom-image="../document/ijazah/<?php echo $ijazah; ?>" width="200">
                                            <br/>
                                            <a href="http://simaster.amayogyakarta.ac.id/document/ijazah/<?php echo $ijazah; ?>" target="_blank"><span class="label label-primary">TAMPILKAN IJAZAH</span></a>
                                            <br/>
<?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>IJAZAH AKTA KELAHIRAN</th>
                                    <td><?php
                                        if ($akte_kelahiran) {
                                            ?>
                                            <img id="zoom_akte" src="http://simaster.amayogyakarta.ac.id/document/akte/<?php echo $akte_kelahiran; ?>" data-zoom-image="../document/akte/<?php echo $akte_kelahiran; ?>" width="200">
                                            <br/>
                                            <a href="http://simaster.amayogyakarta.ac.id/document/akte/<?php echo $akte_kelahiran; ?>" target="_blank"><span class="label label-primary">TAMPILKAN AKTE</span></a>
                                            <br/>
<?php } ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <center><label>DATA PRESTASI</label></center>
                        <br/>
                        <table width="100%" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NAMA KEJUARAAN</th>
                                    <th>CAPAIAN PRESTASI</th>
                                    <th>TINGKAT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $data = mysqli_query($mysqli, "select * from data_prestasi WHERE nim=$nim");
                                $no = 1;
                                while ($d = mysqli_fetch_array($data)) {
                                    $id = $d['id'];
                                    ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $d['NAMA_KEJUARAAN']; ?></td>
                                        <td><?php echo $d['CAPAIAN_PRESTASI']; ?></td>
                                        <td><?php echo $d['TINGKAT']; ?></td>
                                    </tr>
<?php } ?>
                            </tbody>
                        </table>
                        <center><label>DATA ORGANISASI</label></center>
                        <br/>
                        <table width="100%" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>JENIS KEGIATAN</th>
                                    <th>NAMA UKM / ORGANISASI</th>
                                    <th>JABATAN</th>
                                    <th>TAHUN</th>
                                    <th>STATUS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $data = mysqli_query($mysqli, "select * from data_organisasi WHERE nim=$nim");
                                $no = 1;
                                while ($d = mysqli_fetch_array($data)) {
                                    $id = $d['id'];
                                    ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td>
                                            <?php if ($d['jenis_kegiatan'] == '1') { ?>
                                                Kegiatan Dalam Kampus
                                            <?php } else { ?>
                                                Kegiatan Luar Kampus
    <?php } ?>
                                        </td>
                                        <td>
                                            <?php if ($d['jenis_kegiatan'] == '1') { ?>
                                                <?php
                                                $id_ukm = $d['nama_ukm'];
                                                $data_ukm = mysqli_query($mysqli, "select * from data_ukm WHERE id='$id_ukm'");
                                                $dukm = mysqli_fetch_array($data_ukm);
                                                echo $dukm['nama_ukm'];
                                                ?>
                                            <?php } else { ?>
                                                <?php echo $d['nama_organisasi']; ?>
    <?php } ?>
                                        </td>
                                        <td><?php echo $d['jabatan']; ?></td>
                                        <td><?php echo $d['tahun']; ?></td>
                                        <td>
                                            <?php if ($d['status'] == '1') { ?>
                                                <a href="proses_aktivasi_organisasi.php?id=<?php echo $id; ?>" class='btn btn-success btn-xs'>AKTIF</a>                                          
                                            <?php } else { ?>
                                                <a href="proses_aktivasi_organisasi.php?id=<?php echo $id; ?>" class='btn btn-danger btn-xs'>TIDAK AKTIF</a>
    <?php } ?>
                                        </td>
                                    </tr>
<?php } ?>
                            </tbody>
                        </table>
                        <center><label>DATA PELATIHAN</label></center>
                        <br/>
                        <table width="100%" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NAMA / BIDANG PELATIHAN</th>
                                    <th>TAHUN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $data = mysqli_query($mysqli, "select * from data_pelatihan WHERE nim=$nim");
                                $no = 1;
                                while ($d = mysqli_fetch_array($data)) {
                                    $id = $d['id'];
                                    ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $d['bidang_pelatihan']; ?></td>
                                        <td><?php echo $d['tahun']; ?></td>
                                    </tr>
<?php } ?>
                            </tbody>
                        </table>
                        <center><label>DATA KEWIRAUSAHAAN</label></center>
                        <br/>
                        <table width="100%" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>JENIS USAHA</th>
                                    <th>PRODUK USAHA</th>
                                    <th>CARA PEMASARAN</th>
                                    <th>TANGGAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $data = mysqli_query($mysqli, "select * from data_kewirausahaan WHERE nim=$nim");
                                $no = 1;
                                while ($d = mysqli_fetch_array($data)) {
                                    $id = $d['id'];
                                    ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $d['jenis_usaha']; ?></td>
                                        <td><?php echo $d['produk_usaha']; ?></td>
                                        <td><?php echo $d['cara_pemasaran']; ?></td>
                                        <td><?php echo $d['tanggal_usaha']; ?></td>
                                    </tr>
<?php } ?>
                            </tbody>
                        </table>
                        <center><label>BIODATA AYAH</label></center>
                        <br/>
                        <table width="100%" class="table table-bordered">                            
                            <tr>
                                <th class="col-lg-3">NIK</th>
                                <td><?php echo $nikayah; ?></td>
                            </tr>
                            <tr>
                                <th class="col-lg-3">NAMA LENGKAP</th>
                                <td><?php echo $nama_ortu; ?></td>
                            </tr>
                            <tr>
                                <th class="col-lg-3">TELP / HP</th>
                                <td><?php echo $telp_ortu; ?></td>
                            </tr>
                            <tr>
                                <th class="col-lg-3">ALAMAT</th>
                                <td><?php echo $alamat_ortu; ?></td>
                            </tr>
                            <tr>
                                <th class="col-lg-3">PENDIDIKAN</th>
                                <td><?php echo $pendidikan_ayah; ?></td>
                            </tr>
                            <tr>
                                <th class="col-lg-3">PEKERJAAN</th>
                                <td><?php echo $pekerjaan_ayah; ?></td>
                            </tr>
                            <tr>
                                <th class="col-lg-3">PENGHASILAN</th>
                                <td><?php echo $penghasilan_ayah; ?></td>
                            </tr>
                        </table>
                        <center><label>BIODATA IBU</label></center>
                        <br/>
                        <table width="100%" class="table table-bordered">                            
                            <tr>
                                <th class="col-lg-3">NIK</th>
                                <td><?php echo $nikibu; ?></td>
                            </tr>
                            <tr>
                                <th class="col-lg-3">NAMA LENGKAP</th>
                                <td><?php echo $nama_ibu; ?></td>
                            </tr>
                            <tr>
                                <th class="col-lg-3">TELP / HP</th>
                                <td><?php echo $telp_ibu; ?></td>
                            </tr>
                            <tr>
                                <th class="col-lg-3">ALAMAT</th>
                                <td><?php echo $alamat_ibu; ?></td>
                            </tr>
                            <tr>
                                <th class="col-lg-3">PENDIDIKAN</th>
                                <td><?php echo $pendidikan_ibu; ?></td>
                            </tr>
                            <tr>
                                <th class="col-lg-3">PEKERJAAN</th>
                                <td><?php echo $pekerjaan_ibu; ?></td>
                            </tr>
                            <tr>
                                <th class="col-lg-3">PENGHASILAN</th>
                                <td><?php echo $penghasilan_ibu; ?></td>
                            </tr>
                        </table>
                        <center><label>BIODATA WALI</label></center>
                        <br/>
                        <table width="100%" class="table table-bordered">                            
                            <tr>
                                <th class="col-lg-3">NAMA LENGKAP</th>
                                <td><?php echo $nama_wali; ?></td>
                            </tr>
                            <tr>
                                <th class="col-lg-3">TELP / HP</th>
                                <td><?php echo $telp_wali; ?></td>
                            </tr>
                            <tr>
                                <th class="col-lg-3">ALAMAT</th>
                                <td><?php echo $alamat_wali; ?></td>
                            </tr>
                            <tr>
                                <th class="col-lg-3">PENDIDIKAN</th>
                                <td><?php echo $pendidikan_wali; ?></td>
                            </tr>
                            <tr>
                                <th class="col-lg-3">PEKERJAAN</th>
                                <td><?php echo $pekerjaan_wali; ?></td>
                            </tr>
                            <tr>
                                <th class="col-lg-3">PENGHASILAN</th>
                                <td><?php echo $penghasilan_wali; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>                
            </div>            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

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
                responsive: true
            });
        });
        </script>
        <script src="dist/js/jquery.elevateZoom-3.0.8.min.js"></script>
        <script type="text/javascript">
//script untuk menampilkan image zoom
        $("#zoom_ktp").elevateZoom({
            zoomType: "lens",
            lensShape: "round",
            lensSize: 450
        });
        $("#zoom_akte").elevateZoom({
            zoomType: "lens",
            lensShape: "round",
            lensSize: 450
        });
        $("#zoom_ijazah").elevateZoom({
            zoomType: "lens",
            lensShape: "round",
            lensSize: 450
        });
        $("#zoom_ijazahama").elevateZoom({
            zoomType: "lens",
            lensShape: "round",
            lensSize: 450
        });
        $("#zoom_transkrip").elevateZoom({
            zoomType: "lens",
            lensShape: "round",
            lensSize: 450
        });
        </script>
    </body>
</html>
