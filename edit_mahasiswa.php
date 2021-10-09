<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>EDIT MAHASISWA | SISTEM INFORMASI AKADEMIK - AMA Yogyakarta</title>

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
                        <h4 class="page-header"><i class="fa fa-edit fa-fw"></i> EDIT MAHASISWA</h4>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">                    
                    <div class="col-lg-12">
                        <?php
//getting id from url
                        $nim = $_GET['nim'];
//selecting data associated with this particular id
                        $res = mysqli_query($mysqli, "SELECT * FROM msmhs WHERE NIMHSMSMHS='$nim'");
                        while ($data = mysqli_fetch_array($res)) {
                            $ketarangan_revisi = $data['KET_REV'];
                            $nik = $data['NIKMSMHS'];
                            $nama = $data['NMMHSMSMHS'];
                            $tplahir = $data['TPLHRMSMHS'];
                            $tglahir = $data['TGLHRMSMHS'];
                            $jenis_kelamin = $data['KDJEKMSMHS'];
                            $alamat_sekarang = $data['ALAMATYOGYA'];
                            $jenis_tinggal = $data['JENISTINGGAL'];
                            $alamat_lengkap = $data['ALAMATLENGKAP'];
                            $jalan = $data['JALAN'];
                            $rtrw = $data['RTRW'];
                            $dusun = $data['DUSUN'];
                            $kelurahan = $data['KELURAHAN'];
                            $kecamatan = $data['KECAMATAN_EKSPORT'];
                            $kabupaten = $data['KABUPATEN_EKSPORT'];
                            $kewarganegaraan = $data['KEWARGANEGARAAN'];
                            $nokps = $data['NOKPS'];
                            $propinsi = $data['PROPINSI_EKSPORT'];
                            $agama = $data['AGAMA'];
                            $telp = $data['TELP'];
                            $email = $data['EMAIL'];
                            $facebook = $data['FACEBOOK'];
                            $instagram = $data['INSTAGRAM'];
                            $twiter = $data['TWITER'];
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
                            $prestasi = $data['PRESTASI'];
                            $ktpkk = $data['ktpkk'];
                            $akte_kelahiran = $data['akte_kelahiran'];
                            $ijazah = $data['ijazah_sma'];
                            $statusmhs = $data['STMHSMSMHS'];
                            $status_data = $data['tgl_update'];
                            $stat_data = $data['STATUSDATA'];
                        }
                        ?>
                        <?php if ($status_data == "" && ($stat_data == '2')) { ?>
                            <div class="alert alert-warning" role="alert">
                                <b>KETERANGAN REVISI :</b> <?php echo $ketarangan_revisi; ?>
                            </div>
                        <?php } ?>
                        <form name="form" method="post" action="proses_edit_mahasiswa.php" enctype="multipart/form-data">
                            <input type="hidden" name="NIMHSMSMHS" value="<?php echo $nim; ?>">
                            <div class="form-group">
                                <label for="NamaLengkap">KETERANGAN REVISI</label>
                                <input type="text" class="form-control" name="KET_REV" value="<?php echo $ketarangan_revisi; ?>" placeholder="Keterangan Revisi">
                            </div>
                            <div class="form-group">
                                <label for="NamaLengkap">NIK (KTP / KK)</label>
                                <input type="text" class="form-control" name="NIKMSMHS" value="<?php echo $nik; ?>" placeholder="NIK">
                            </div>
                            <div class="form-group">
                                <label for="NamaLengkap">NAMA LENGKAP</label>
                                <input type="text" class="form-control" name="NMMHSMSMHS" value="<?php echo $nama; ?>" placeholder="Nama Lengkap">
                            </div>
                            <div class="form-group">
                                <label for="TempatLahir">TEMPAT LAHIR</label>
                                <input type="text" class="form-control" name="TPLHRMSMHS" value="<?php echo $tplahir; ?>" placeholder="Tempat Lahir">
                            </div>
                            <div class="form-group">
                                <label for="TanggalLahir">TANGGAL LAHIR</label>
                                <input type="text" class="form-control" name="TGLHRMSMHS" value="<?php echo date('d-m-Y', strtotime($tglahir)); ?>" placeholder="Tanggal Lahir">
                            </div>
                            <div class="form-group">
                                <label for="AlamatSekarang">ALAMAT SEKARANG</label>
                                <input type="text" class="form-control" name="ALAMATYOGYA" value="<?php echo $alamat_sekarang; ?>" placeholder="Alamat Sekarang di Yogyakarta">
                            </div>
                            <div class="form-group">
                                <label for="AlamatSekarang">KEWARGANEGARAAN</label>
                                <input type="text" class="form-control" name="KEWARGANEGARAAN" value="<?php echo $kewarganegaraan; ?>" placeholder="Kewarganegaraan">
                            </div>
                            <div class="form-group">
                                <label for="NoKPS">NO KPS / KARTU PELINDUNGAN SOSIAL</label>
                                <input type="text" class="form-control" name="NOKPS" value="<?php echo $nokps; ?>" placeholder="No Kartu Perlindungan Sosial">
                            </div>
                            <div class="form-group">
                                <label for="JenisTingal">JENIS TINGGAL</label>
                                <input type="text" class="form-control" name="JENISTINGGAL" value="<?php echo $jenis_tinggal; ?>" placeholder="Kos / Bersama Orang Tua">
                            </div>
                            <div class="form-group">
                                <label for="AlamatAsal">ALAMAT ASAL</label>
                                <input type="text" class="form-control" name="ALAMATLENGKAP" value="<?php echo $alamat_lengkap; ?>" placeholder="Alamat Lengkap">
                            </div>
                            <div class="form-group">
                                <label for="Jalan">JALAN</label>
                                <input type="text" class="form-control" name="JALAN" value="<?php echo $jalan; ?>" placeholder="Jalan">
                            </div>
                            <div class="form-group">
                                <label for="Rt/Rw">RT/RW</label>
                                <input type="text" class="form-control" name="RTRW" value="<?php echo $rtrw; ?>" placeholder="RT/RW">
                            </div>
                            <div class="form-group">
                                <label for="Dusun">DUSUN</label>
                                <input type="text" class="form-control" name="DUSUN" value="<?php echo $dusun; ?>" placeholder="Dusun">
                            </div>
                            <div class="form-group">
                                <label for="Kelurahan">KELURAHAN</label>
                                <input type="text" class="form-control" name="KELURAHAN" value="<?php echo $kelurahan; ?>" placeholder="Kelurahan">
                            </div>
                            <div class="form-group">
                                <label for="propinsi">PROPINSI</label>
                                <select style="text-transform: uppercase" class="form-control" name="PROPINSI_EKSPORT" id="propinsi">                                    
                                    <?php
                                    $prov = mysqli_query($mysqli, "SELECT * FROM wilayah WHERE id_level_wil=1"); ?>
                                    <?php if ($propinsi == "") { ?>
                                      <option value="">-- PILIH --</option>
                                    <?php } ?>
                                    <?php while ($data_provinsi = mysqli_fetch_array($prov)) {
                                        ?>   
                                        <?php if ($data_provinsi['id_wilayah'] == $propinsi) { ?>
                                            <option value="<?php echo $data_provinsi['id_wilayah']; ?>" selected><?php echo $data_provinsi['nama_wilayah']; ?></option>
                                        <?php } else { ?>                                            
                                            <option value="<?php echo $data_provinsi['id_wilayah']; ?>"><?php echo $data_provinsi['nama_wilayah']; ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kab_kota">KABUPATEN / KOTA</label>
                                <select style="text-transform: uppercase" class="form-control" name="KABUPATEN_EKSPORT" id="kabupaten">
                                    <?php
                                    $kab = mysqli_query($mysqli, "SELECT * FROM wilayah WHERE id_induk_wilayah='$propinsi'"); ?>
                                    <?php if ($kabupaten == "") { ?>
                                      <option value="">-- PILIH --</option>
                                    <?php } while ($data_kabupaten = mysqli_fetch_array($kab)) {
                                        ?>
                                        <?php if ($data_kabupaten['id_wilayah'] == $kabupaten) { ?>
                                            <option value="<?php echo $data_kabupaten['id_wilayah']; ?>" selected><?php echo $data_kabupaten['nama_wilayah']; ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kecamatan">KECAMATAN</label>
                                <select style="text-transform: uppercase" class="form-control" name="KECAMATAN_EKSPORT" id="kecamatan">
                                    <?php
                                    $kec = mysqli_query($mysqli, "SELECT * FROM wilayah WHERE id_induk_wilayah='$kabupaten'"); ?>
                                    <?php if ($kecamatan == "") { ?>
                                      <option value="">-- PILIH --</option>
                                    <?php } while ($data_kecamatan = mysqli_fetch_array($kec)) {
                                        ?>
                                        <?php if ($data_kecamatan['id_wilayah'] == $kecamatan) { ?>
                                            <option value="<?php echo $data_kecamatan['id_wilayah']; ?>" selected><?php echo $data_kecamatan['nama_wilayah']; ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jeniskelamnin">JENIS KELAMIN</label>
                                <select class="form-control" name="KDJEKMSMHS">
                                    <?
                                    if($jenis_kelamin=="L")
                                    {
                                    ?>
                                    <option value="L">LAKI LAKI</option>
                                    <?
                                    }elseif($jenis_kelamin=="P")
                                    {
                                    ?>
                                    <option value="P">PEREMPUAN</option>
                                    <?
                                    }?>
                                    <option value="L">LAKI LAKI</option>
                                    <option value="P">PEREMPUAN</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="Agama">AGAMA</label>
                                <select class="form-control" name="AGAMA">
                                    <?
                                    if($agama=="B")
                                    {
                                    ?>
                                    <option value="B">BUDHA</option>
                                    <?
                                    }elseif($agama=="H")
                                    {
                                    ?>
                                    <option value="H">HINDU</option>
                                    <?
                                    }elseif($agama=="I")
                                    {
                                    ?>
                                    <option value="I">ISLAM</option>
                                    <?
                                    }elseif($agama=="K")
                                    {
                                    ?>
                                    <option value="K">KATHOLIK</option>
                                    <?
                                    }elseif($agama =="P")
                                    {
                                    ?>
                                    <option value="P">KRISTEN</option>
                                    <?
                                    }elseif($agama =="C")
                                    {
                                    ?>
                                    <option value="C">KEPERCAYAAN</option>
                                    <?
                                    }else
                                    {
                                    ?>
                                    <option value="">--SILAHKAN PILIH--</option>
                                    <?
                                    }
                                    ?>
                                    <option value="B">BUDHA</option>
                                    <option value="H">HINDU</option>
                                    <option value="I">ISLAM</option>
                                    <option value="K">KATOLIK</option>
                                    <option value="P">KRISTEN</option>
                                    <option value="C">KEPERCAYAAN</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="Email">EMAIL</label>
                                <input type="text" class="form-control" name="EMAIL" value="<?php echo $email; ?>" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label for="Email">AKUN TWITTER</label>
                                <input type="text" class="form-control" name="TWITTER" value="<?php echo $twiter; ?>" placeholder="Akum Twitter">
                            </div>
                            <div class="form-group">
                                <label for="Email">AKUN INSTAGRAM</label>
                                <input type="text" class="form-control" name="INSTAGRAM" value="<?php echo $instagram; ?>" placeholder="Akun Instagram">
                            </div>
                            <div class="form-group">
                                <label for="Email">AKUN FACEBOOK</label>
                                <input type="text" class="form-control" name="FACEBOOK" value="<?php echo $facebook; ?>" placeholder="Akun Facebook">
                            </div>
                            <div class="form-group">
                                <label for="AsalSekolah">ASAL SEKOLAH</label>
                                <input type="text" class="form-control" name="ASAl_SEKOLAH" value="<?php echo $asal_sekolah; ?>" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label for="NomorHp">NOMOR HP</label>
                                <input type="text" class="form-control" name="TELP" value="<?php echo $telp; ?>" placeholder="Nomor HP">
                            </div>
                            <div class="form-group">
                                <label for="hobi">HOBI</label>
                                <input type="text" class="form-control" name="HOBI" value="<?php echo $hobi; ?>" placeholder="Hobi">
                            </div>
                            <div class="form-group">
                                <label for="profesi">PRESTASI YANG PERNAH DIRAIH</label>
                                <input type="text" class="form-control" name="PRESTASI" value="<?php echo $prestasi; ?>" placeholder="Prestasi Yang Pernah Diraih">
                            </div>
                            <?php if ($ktpkk) { ?>
                                <img src="../document/ktp/<?php echo $ktpkk; ?>" width="400">
                                <br /><br />
                            <?php } ?>
                            <div class="form-group">
                                <label for="KTPKK">UPLOAD KTP / KK (JPG, JPEG)</label>
                                <input type="file" name="ktp_kk" class="form-control">
                            </div>
                            <?php if ($ijazah) { ?>
                                <img src="../document/ijazah/<?php echo $ijazah; ?>" width="400">
                                <br /><br />
                            <?php } ?>
                            <div class="form-group">
                                <label for="IJAZAH">UPLOAD IJAZAH / SKL (JPG, JPEG)</label>
                                <input type="file" name="ijazah" class="form-control">
                            </div>
                            <?php if ($akte_kelahiran) { ?>
                                <img src="../document/akte/<?php echo $akte_kelahiran; ?>" width="400">
                                <br /><br />
                            <?php } ?>
                            <div class="form-group">
                                <label for="IJAZAH">UPLOAD AKTE KELAHIRAN (JPG, JPEG)</label>
                                <input type="file" name="akte_kelahiran" class="form-control">
                            </div>
                            <br/>
                            <br/>
                            <br/>
                            <div class="form-group">
                                <label for="NamaOrtu">NIK AYAH</label>
                                <input type="text" class="form-control" name="NIKAYAH" value="<?php echo $nikayah; ?>" placeholder="Nama Orang Tua / Wali">
                            </div>
                            <div class="form-group">
                                <label for="NamaOrtu">NAMA AYAH</label>
                                <input type="text" class="form-control" name="NAMAORTU" value="<?php echo $nama_ortu; ?>" placeholder="Nama">
                            </div>
                            <div class="form-group">
                                <label for="TanggalLahirAyah">TANGGAL LAHIR AYAH</label>
                                <input type="text" class="form-control" name="TANGGALLAHIRAYAH" value="<?php echo date('d-m-Y', strtotime($tanggal_lahir_ayah)); ?>" placeholder="Tanggal Lahir">
                            </div>
                            <div class="form-group">
                                <label for="NamaOrtu">PENDIDIKAN AYAH</label>
                                <input type="text" class="form-control" name="PENDIDIKANAYAH" value="<?php echo $pendidikan_ayah; ?>" placeholder="Pendidikan">
                            </div>
                            <div class="form-group">
                                <label for="PekerjaanAyah">PEKERJAAN AYAH</label>
                                <input type="text" class="form-control" name="PEKERJAANORTUWALI" value="<?php echo $pekerjaan_ayah; ?>" placeholder="Pekerjaan">
                            </div>
                            <div class="form-group">
                                <label for="NamaOrtu">PRNGHASILAN AYAH</label>
                                <div class="radio">
                                    <label>
                                        <?php if ($penghasilan_ayah == "< Rp. 1.500.000") { ?>
                                            <input type="radio" name="PENGHASILANAYAH" value="< Rp. 1.500.000" checked>
                                        <?php } else { ?>
                                            <input type="radio" name="PENGHASILANAYAH" value="< Rp. 1.500.000">
                                        <?php } ?>
                                        < Rp. 1.500.000
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <?php if ($penghasilan_ayah == "Rp. 1.500.000 s/d Rp. 2.500.000") { ?>
                                            <input type="radio" name="PENGHASILANAYAH" value="Rp. 1.500.000 s/d Rp. 2.500.000" checked>
                                        <?php } else { ?>
                                            <input type="radio" name="PENGHASILANAYAH" value="Rp. 1.500.000 s/d Rp. 2.500.000">
                                        <?php } ?>
                                        Rp. 1.500.000 s/d Rp. 2.500.000
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <?php if ($penghasilan_ayah == "Rp. 2.500.000 s/d Rp. 3.500.000") { ?>
                                            <input type="radio" name="PENGHASILANAYAH" value="Rp. 2.500.000 s/d Rp. 3.500.000" checked>
                                        <?php } else { ?>
                                            <input type="radio" name="PENGHASILANAYAH" value="Rp. 2.500.000 s/d Rp. 3.500.000">
                                        <?php } ?>
                                        Rp. 2.500.000 s/d Rp. 3.500.000
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <?php if ($penghasilan_ayah == "> Rp. 3.500.000") { ?>
                                            <input type="radio" name="PENGHASILANAYAH" value="> Rp. 3.500.000" checked>
                                        <?php } else { ?>
                                            <input type="radio" name="PENGHASILANAYAH" value="> Rp. 3.500.000">
                                        <?php } ?>
                                        > Rp. 3.500.000
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="NamaOrtu">TELP / HP AYAH</label>
                                <input type="text" class="form-control" name="TELPORTUWALI" value="<?php echo $telp_ortu; ?>" placeholder="Telp / HP">
                            </div>
                            <div class="form-group">
                                <label for="NamaOrtu">ALAMAT AYAH</label>
                                <input type="text" class="form-control" name="ALAMATORTUWALI" value="<?php echo $alamat_ortu; ?>" placeholder="Alamat">
                            </div>                            
                            <br/>
                            <br/>
                            <br/>
                            <div class="form-group">
                                <label for="NamaOrtu">NIK IBU</label>
                                <input type="text" class="form-control" name="NIKIBU" value="<?php echo $nikibu; ?>" placeholder="NIK">
                            </div>
                            <div class="form-group">
                                <label for="NamaOrtu">NAMA IBU</label>
                                <input type="text" class="form-control" name="NAMAIBU" value="<?php echo $nama_ibu; ?>" placeholder="Nama">
                            </div>
                            <div class="form-group">
                                <label for="TanggalLahirAyah">TANGGAL LAHIR IBU</label>
                                <input type="text" class="form-control" name="TANGGALLAHIRIBU" value="<?php echo date('d-m-Y', strtotime($tanggal_lahir_ibu)); ?>" placeholder="Tanggal Lahir">
                            </div>
                            <div class="form-group">
                                <label for="NamaOrtu">PENDIDIKAN IBU</label>
                                <input type="text" class="form-control" name="PENDIDIKANIBU" value="<?php echo $pendidikan_ibu; ?>" placeholder="Pendidikan">
                            </div>
                            <div class="form-group">
                                <label for="PekerjaanAyah">PEKERJAAN IBU</label>
                                <input type="text" class="form-control" name="PEKERJAANIBU" value="<?php echo $pekerjaan_ibu; ?>" placeholder="Pekerjaan">
                            </div>
                            <div class="form-group">
                                <label for="NamaOrtu">PRNGHASILAN IBU</label>
                                <div class="radio">
                                    <label>
                                        <?php if ($penghasilan_ibu == "< Rp. 1.500.000") { ?>
                                            <input type="radio" name="PENGHASILANIBU" value="< Rp. 1.500.000" checked>
                                        <?php } else { ?>
                                            <input type="radio" name="PENGHASILANIBU" value="< Rp. 1.500.000">
                                        <?php } ?>
                                        < Rp. 1.500.000
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <?php if ($penghasilan_ibu == "Rp. 1.500.000 s/d Rp. 2.500.000") { ?>
                                            <input type="radio" name="PENGHASILANIBU" value="Rp. 1.500.000 s/d Rp. 2.500.000" checked>
                                        <?php } else { ?>
                                            <input type="radio" name="PENGHASILANIBU" value="Rp. 1.500.000 s/d Rp. 2.500.000">
                                        <?php } ?>
                                        Rp. 1.500.000 s/d Rp. 2.500.000
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <?php if ($penghasilan_ibu == "Rp. 2.500.000 s/d Rp. 3.500.000") { ?>
                                            <input type="radio" name="PENGHASILANIBU" value="Rp. 2.500.000 s/d Rp. 3.500.000" checked>
                                        <?php } else { ?>
                                            <input type="radio" name="PENGHASILANIBU" value="Rp. 2.500.000 s/d Rp. 3.500.000">
                                        <?php } ?>
                                        Rp. 2.500.000 s/d Rp. 3.500.000
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <?php if ($penghasilan_ibu == "> Rp. 3.500.000") { ?>
                                            <input type="radio" name="PENGHASILANIBU" value="> Rp. 3.500.000" checked>
                                        <?php } else { ?>
                                            <input type="radio" name="PENGHASILANIBU" value="> Rp. 3.500.000">
                                        <?php } ?>
                                        > Rp. 3.500.000
                                    </label>
                                </div> 
                            </div>
                            <div class="form-group">
                                <label for="NamaOrtu">TELP / HP IBU</label>
                                <input type="text" class="form-control" name="TELPIBU" value="<?php echo $telp_ibu; ?>" placeholder="Telp / HP">
                            </div>
                            <div class="form-group">
                                <label for="NamaOrtu">ALAMAT IBU</label>
                                <input type="text" class="form-control" name="ALAMATIBU" value="<?php echo $alamat_ibu; ?>" placeholder="Alamat">
                            </div>                            
                            <br/>
                            <br/>
                            <br/>
                            <div class="form-group">
                                <label for="NamaOrtu">NAMA WALI</label>
                                <input type="text" class="form-control" name="NAMAWALI" value="<?php echo $nama_wali; ?>" placeholder="Nama">
                            </div>
                            <div class="form-group">
                                <label for="TanggalLahirAyah">TANGGAL LAHIR WALI</label>
                                <input type="text" class="form-control" name="TANGGALLAHIRWALI" value="<?php echo date('d-m-Y', strtotime($tanggal_lahir_wali)); ?>" placeholder="Tanggal Lahir">
                            </div>
                            <div class="form-group">
                                <label for="NamaOrtu">PENDIDIKAN WALI</label>
                                <input type="text" class="form-control" name="PENDIDIKANWALI" value="<?php echo $pendidikan_wali; ?>" placeholder="Pendidikan">
                            </div>
                            <div class="form-group">
                                <label for="PekerjaanAyah">PEKERJAAN WALI</label>
                                <input type="text" class="form-control" name="PEKERJAANWALI" value="<?php echo $pekerjaan_wali; ?>" placeholder="Pekerjaan">
                            </div>
                            <div class="form-group">
                                <label for="NamaOrtu">PRNGHASILAN WALI</label>
                                <div class="radio">
                                    <label>
                                        <?php if ($penghasilan_wali == "< Rp. 1.500.000") { ?>
                                            <input type="radio" name="PENGHASILANWALI" value="< Rp. 1.500.000" checked>
                                        <?php } else { ?>
                                            <input type="radio" name="PENGHASILANWALI" value="< Rp. 1.500.000">
                                        <?php } ?>
                                        < Rp. 1.500.000
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <?php if ($penghasilan_wali == "Rp. 1.500.000 s/d Rp. 2.500.000") { ?>
                                            <input type="radio" name="PENGHASILANWALI" value="Rp. 1.500.000 s/d Rp. 2.500.000" checked>
                                        <?php } else { ?>
                                            <input type="radio" name="PENGHASILANWALI" value="Rp. 1.500.000 s/d Rp. 2.500.000">
                                        <?php } ?>
                                        Rp. 1.500.000 s/d Rp. 2.500.000
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <?php if ($penghasilan_wali == "Rp. 2.500.000 s/d Rp. 3.500.000") { ?>
                                            <input type="radio" name="PENGHASILANWALI" value="Rp. 2.500.000 s/d Rp. 3.500.000" checked>
                                        <?php } else { ?>
                                            <input type="radio" name="PENGHASILANWALI" value="Rp. 2.500.000 s/d Rp. 3.500.000">
                                        <?php } ?>
                                        Rp. 2.500.000 s/d Rp. 3.500.000
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <?php if ($penghasilan_wali == "> Rp. 3.500.000") { ?>
                                            <input type="radio" name="PENGHASILANWALI" value="> Rp. 3.500.000" checked>
                                        <?php } else { ?>
                                            <input type="radio" name="PENGHASILANWALI" value="> Rp. 3.500.000">
                                        <?php } ?>
                                        > Rp. 3.500.000
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="NamaOrtu">TELP / HP WALI</label>
                                <input type="text" class="form-control" name="TELPWALI" value="<?php echo $telp_wali; ?>" placeholder="Telp / HP">
                            </div>
                            <div class="form-group">
                                <label for="NamaOrtu">ALAMAT WALI</label>
                                <input type="text" class="form-control" name="ALAMATWALI" value="<?php echo $alamat_wali; ?>" placeholder="Alamat">
                            </div>                            
                            <div class="form-group">
                                <input type="submit" name="update" value="UPDATE" class="btn btn-success btn-sm">
                            </div> 
                        </form>
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
                responsive: true
            });
        });
        </script>
        <script type="text/javascript">
        $("#propinsi").change(function () {
            // variabel dari nilai combo box kendaraan
            var id_wilayah = $("#propinsi").val();
            $.ajax({
                method: "POST",
                dataType: "html",
                url: "kabupaten.php",
                data: {
                    wilayah: id_wilayah
                },
                success: function (data) {
                    $("#kabupaten").html(data);
                    $("#kecamatan").html(data);
                }
            });
        });
        $("#kabupaten").change(function () {
            // variabel dari nilai combo box kendaraan
            var id_wilayah = $("#kabupaten").val();
            $.ajax({
                method: "POST",
                dataType: "html",
                url: "kecamatan.php",
                data: {
                    wilayah: id_wilayah
                },
                success: function (data) {
                    $("#kecamatan").html(data);
                }
            });
        });
        </script>
    </body>
</html>
