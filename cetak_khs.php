<?php
session_start();
include_once("config/config.php");
$ta = $_GET['ta'];
$nim = $_GET['nim'];
$status = $_GET['sp'];
?>
<html><head><title>Cetak KHS</title>


        <style type="text/css" media="all">
            body {
                font: 12pt "Times New Roman";
                background-color: white;
            }
            #navigasi{
                font-family: Tahoma, Verdana;
                border: 1px solid #A8A8A8;
                padding: 10px;
                width: 140mm;
                text-align: center;
                background-color: #f5f5f5;
            }
            #navigasi #klik{
                border: 1px solid ButtonText;
                color: ButtonText;
                font-weight: bold;
                background-color: #EEEEEE;
                padding-left: 5px;
                padding-right: 5px;
            }
            #navigasi input.tombol{
                border: 1px solid ButtonText;
                color: ButtonText;
            }
            .paperA4{
                width: 175mm;
                height: 247mm;
                border: 1px dashed #66ff66;
                padding: 1px;
                font-family: "Trebuchet MS", Arial, Tahoma, Verdana;
            }
            .papersetengahA4{
                background-color: White;
                border: 1px dashed #66ff66;
                font-family: "Trebuchet MS",Arial,Tahoma,Verdana;
                height: 147mm;
                padding: 1px;
                width: 194mm;
            }
            .header1{
                font-size: 16px; font-family:Arial, Helvetica, sans-serif; font-weight:bold;
            }
            .header2{
                font-size: 24px; font-family:Georgia, 'Times New Roman', Times, serif;
                font-weight:bold;
            }
            .alamat{
                font-size: 11px; font-family:Arial, Helvetica, sans-serif;
            }
            .garis{ border-bottom: 4px double Black; }
            .judulKHS{ font-family: Arial, Helvetica, sans-serif;  font-size: 18px;  font-weight: bold;   }
            .identitas{	font-family: Arial, Tahoma; font-size: 11px;}
            .tabelkhs{
                /*font-family: Arial, Tahoma, Verdana;*/
                font-family: Arial, Tahoma;
                font-size: 9px;
                border: 1px solid #000000;
                border-right: 2px solid #000000;
            }
            .tabelkhs .thl, .thc{
                border-left: 1px solid #000000;
                border-top: 1px solid #000000;
                border-bottom: 2px solid #000000;
            }
            .tabelkhs .thr{
                border-left: 1px solid #000000;
                border-right: 0px solid #000000;
                border-top: 1px solid #000000;
                border-bottom: 2px solid #000000;
            }
            .tabelkhs .thct{
                border-left: 1px solid #000000;
                border-top: 1px solid #000000;
                border-bottom: 0px solid #000000;
            }
            .tabelkhs .thcb{
                border-left: 1px solid #000000;
                border-top: 1px solid #000000;
                border-bottom: 2px solid #000000;
            }
            .tabelkhs .tdl, .tdc{
                border-left: 1px solid #000000;
                border-bottom: 1px solid #000000;
            }
            .tabelkhs .tdr{
                border-left: 1px solid #000000;
                border-right: 0px solid #000000;
                border-bottom: 1px solid #000000;
            }
            .tabelIndek{
                font-family: Arial, Tahoma; 
                font-size: 10px;
            }
            .tabelIndek .ttd{
                font-size: 12px;
                text-align: center;
            }
            .tabelIndek .rumuskhs{
                font-size: 10px;
            }
            .catatan{
                font-size: 10px;
            }</style></head><body onload="document.getElementById('currPos').focus();">
        <div id="navigasi">
            <?
            $CEKXX=substr($ta,0,4);
            $CEKXX2=substr($ta,4,1);
            $CEKXXX=$CEKXX+1;
            $P=substr($ta,4,1);
            if(($P%2)==1)
            {
            $SS="GANJIL";
            $LALUX=($CEKXX-1);
            $SP="2";
            $LALU="$LALUX$SP";
            $ASLI="GENAP";

            $NEXTX=$CEKXX;
            $SPX="2";
            $NEXT="$NEXTX$SPX";
            }else
            {
            $SS="GENAP";
            $LALUX=$CEKXX;
            $SP="1";
            $LALU="$LALUX$SP";
            $ASLI="GANJIL";

            $NEXTX=($CEKXX+1);
            $SPX="1";
            $NEXT="$NEXTX$SPX";
            }
            $hasilv = mysql_query("select k.nmkonsen from msmhs m,konsentrasi k where m.NIMHSMSMHS = '$nim' and k.kdkonsen=m.kdkonsen");
            $data2 = mysql_fetch_array($hasilv);
            $nama_konsen=$data2['nmkonsen'];
            $qall = "SELECT *,m.KDJENMSMHS as jenjang,m.TPLHRMSMHS as tempatLahir,DAY(m.TGLHRMSMHS) as tanggalLahir,MONTH(m.TGLHRMSMHS) as bulanLahir,YEAR(m.TGLHRMSMHS) as tahunLahir FROM msmhs m,kelasparalel_mhs k,mspst ms where ms.KDPSTMSPST=m.KDPSTMSMHS and k.nimhs=m.NIMHSMSMHS and m.NIMHSMSMHS='$nim'";
            $hasilall = mysql_query($qall);
            while($dataall = mysql_fetch_array($hasilall))
            {
            $nimnya= $dataall["NIMHSMSMHS"];
            $nama= $dataall["NMMHSMSMHS"];
            $KDPSTMSMHS= $dataall["KDPSTMSMHS"];
            $kelas= $dataall["nmkelas"];
            $NMPSTMSPST= $dataall["NMPSTMSPST"];
            $tempatlahir=$dataall["TPLHRMSMHS"];
            $tgl=$dataall['tanggalLahir'];
            $bulan=$dataall['bulanLahir'];
            $tahun=$dataall['tahunLahir'];
            $nama_prodi=$dataall['NMPSTMSPST'];
            $KELAS=$kelas;
            $status_mhs= $dataall["STPIDMSMHS"];
            //$jenjang=$dataall['jenjang'];
            $array_bulan=array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","Nopember","Desember");
            $bulannya=$array_bulan[($bulan-1)];
            }
            //$MASUK=substr($KELAS,5,2);
            $pecahkelas=explode("/",$KELAS); 
            $kelas1=strtoupper($pecahkelas[0]); // buat huruf besar semua 
            $kelas2=strtoupper($pecahkelas[1]);
            $MASUK=strtoupper($pecahkelas[2]);
            $TAHUN="20$MASUK";
            $ASALXX="20$MASUK";
            $ASALXX2="1";
            $CEKXX=substr($ta,0,4);
            $CEKXX2=substr($ta,4,1);
            $CEKXXX=$CEKXX+1;
            if($ASALXX2==$CEKXX2)
            {
            $P=(($CEKXX-$ASALXX)*2)+1;
            }else
            {
            $P=(($CEKXX-$ASALXX)*2)+2;
            }

            if($P==1)
            {
            $R="I";
            $V=1;
            }elseif($P==2)
            {
            $R="II";
            $V=2;
            }elseif($P==3)
            {
            $R="III";
            $V=3;
            }elseif($P==4)
            {
            $R="IV";
            $V=4;
            }elseif($P==5)
            {
            $R="V";
            $V=5;
            }elseif($P==6)
            {
            $R="VI";
            $V=6;
            }elseif($P==7)
            {
            $R="VII";
            $V=7;
            }elseif($P==8)
            {
            $R="VIII";
            $V=8;
            }elseif($P==9)
            {
            $R="IX";
            $V=9;
            }elseif($P==10)
            {
            $R="X";
            $V=10;
            }elseif($P==11)
            {
            $R="XI";
            $V=11;
            }elseif($P==12)
            {
            $R="XII";
            $V=12;
            }elseif($P==13)
            {
            $R="XIII";
            $V=13;
            }elseif($P==14)
            {
            $R="XIV";
            $V=14;
            }elseif($P==15)
            {
            $R="XV";
            $V=15;
            }else
            {
            $R="??";
            }
            $perintah=mysql_query("select * from kelasparalel k,msdos t where k.namakelas='$kelas' and t.NODOSMSDOS=k.nodos"); 
            $datanya=mysql_fetch_array($perintah);
            $namados=$datanya['NMDOSMSDOS'];
            $gelardos=$datanya['GELARMSDOS'];
            $kdkonsen=$datanya['kdkonsen'];
            $qpeg211 = "SELECT * FROM konsentrasi where kdkonsen='$kdkonsen'";
            $datapeg211 = mysql_query($qpeg211);
            $datakonsen= mysql_fetch_array($datapeg211);
            $JUR=$datakonsen["kdpst"];
            $KONSEN=$datakonsen["nmkonsen"];

            $qpeg2111 = "SELECT * FROM mspst";
            $datapeg2111 = mysql_query($qpeg2111);
            $dataprodi= mysql_fetch_array($datapeg2111);
            $PRODI=$dataprodi["NMPSTMSPST"];
            ?>
            <form name="posT" method="post">
                <!-- BEGIN : navigasi THSMS -->
                <? if($status == "1"){ ?>
                <? if($R != "I"){?>
                <font face="Lucida Sans"><a href="cetak_khs.php?ta=<? print($LALU); ?>&nim=<? print($nim); ?>&sp=<? print($status); ?>" id="klik" style="text-decoration: none;"><? print($LALU); ?> <font size="5">&#8592;</font></a>&nbsp;&nbsp;&nbsp;
                <?}else{?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <?}?>
                <input id="currPosTHSMS" name="currPosTHSMS" value="<? print($ta); ?>" size="10" maxlength="5" style="text-align: center; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 14px;" type="text">
                &nbsp;&nbsp;&nbsp;
                <a href="cetak_khs.php?ta=<? print($NEXT); ?>&nim=<? print($nim); ?>&sp=<? print($status); ?>" id="klik" style="text-decoration: none;"><font size="5">&#8594;</font> <? print($NEXT); ?></a><input name="go" value="GO" style="display: none;" onclick="return executeNewThsms();" type="submit">
                <? }else {?>
                <? if($R != "I"){?>
                <font face="Lucida Sans"><a href="cetak_khs.php?ta=<? print($LALU); ?>&nim=<? print($nim); ?>" id="klik" style="text-decoration: none;"><? print($LALU); ?> <font size="5">&#8592;</font></a>&nbsp;&nbsp;&nbsp;
                <?}else{?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <?}?>
                <input id="currPosTHSMS" name="currPosTHSMS" value="<? print($ta); ?>" size="10" maxlength="5" style="text-align: center; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 14px;" type="text">
                &nbsp;&nbsp;&nbsp;
                <a href="cetak_khs.php?ta=<? print($NEXT); ?>&nim=<? print($nim); ?>" id="klik" style="text-decoration: none;"><font size="5">&#8594;</font> <? print($NEXT); ?></a><input name="go" value="GO" style="display: none;" onclick="return executeNewThsms();" type="submit">

                <? }?>
                <!-- END : navigasi THSMS -->

                </font>
                <form name="posN" method="post">
                    <!-- BEGIN : navigasi NIM -->
                    <? if($status == "1"){ ?>
                    <font face="Lucida Sans"><br>
                    <a href="cetak_khs.php?ta=<? print($ta); ?>&nim=<? print($nim-1); ?>&sp=<? print($status); ?>" id="klik" style="text-decoration: none;"><? print($nim-1); ?> <font size="5">&#8592;</font></a>&nbsp;&nbsp;&nbsp;
                    <input id="currPos" name="currPos" value="<? print($nim); ?>" size="10" maxlength="10" style="text-align: center; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 14px;" type="text">
                    &nbsp;&nbsp;&nbsp;
                    <a href="cetak_khs.php?ta=<? print($ta); ?>&nim=<? print($nim+1); ?>&sp=<? print($status); ?>" id="klik" style="text-decoration: none;"><font size="5">&#8594;</font> <? print($nim+1); ?></a>
                    <input name="go" value="GO" style="display: none;" onclick="return executeNewNim();" type="submit">
                    <?}else{?>
                    <font face="Lucida Sans"><br>
                    <a href="cetak_khs.php?ta=<? print($ta); ?>&nim=<? print($nim-1); ?>" id="klik" style="text-decoration: none;"><? print($nim-1); ?> <font size="5">&#8592;</font></a>&nbsp;&nbsp;&nbsp;
                    <input id="currPos" name="currPos" value="<? print($nim); ?>" size="10" maxlength="10" style="text-align: center; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 14px;" type="text">
                    &nbsp;&nbsp;&nbsp;
                    <a href="cetak_khs.php?ta=<? print($ta); ?>&nim=<? print($nim+1); ?>" id="klik" style="text-decoration: none;"><font size="5">&#8594;</font> <? print($nim+1); ?></a>
                    <input name="go" value="GO" style="display: none;" onclick="return executeNewNim();" type="submit">
                    <?}?>
                    <!-- END : navigasi NIM -->


                    <div id="alertMsg" align="left"></div>
                    <hr noshade="noshade">
                    <!--<iframe name="simpankhs" id="iframesimpankhs" frameborder="0" height="0" scrolling="no" width="500"></iframe>
                    <div id="pesanSimpanIframe" align="left"></div>-->
                    </font>
                    <? if($status == "1"){ ?>
                    <div style="text-align: left;">
                        <input class="tombol" value="Kembali" onclick="location.href = 'cetak_berkas.php'" type="button">
                        <!--<input class="tombol" value="Penilaian" onclick="window.location.href = 'index.php?route=nilai_nim&ta=<? print($ta); ?>&nim=<? print($nim); ?>&prodi=E~61401'" type="button">
                        <input class="tombol" value="KRS" onclick="window.location.href = 'cetak_krs_ok.php?&ta=<? print($ta); ?>&nim=<? print($nim); ?>&sp=<? print($status); ?>'" type="button">-->
                        <input class="tombol" id="btncetakkhs" value="Cetak KHS" onclick="printOut();" type="button">
                        <input class="tombol" id="btnpenilaiankhs" value="Penilaian KHS" onclick="window.location.href='penilaian_khs.php?ta=<? print($ta); ?>&nim=<? print($nim); ?>'" type="button">
                        <input class="tombol" value="Generate IPK" onclick="window.location.href = 'generate_khs_ipk.php?&ta=<? print($ta); ?>&nim=<? print($nim); ?>&kelas=<? print($kelas); ?>'" type="button">
                    </div>
                    <?}else{?>
                    <div style="text-align: left;">
                        <input class="tombol" value="Kembali" onclick="location.href = 'cetak_berkas.php'" type="button">
                        <!--<input class="tombol" value="Penilaian" onclick="window.location.href = 'index.php?route=nilai_nim&ta=<? print($ta); ?>&nim=<? print($nim); ?>&prodi=E~61401'" type="button">
                        <input class="tombol" value="KRS" onclick="window.location.href = 'cetak_krs_ok.php?&ta=<? print($ta); ?>&nim=<? print($nim); ?>'" type="button">-->
                        <input class="tombol" id="btncetakkhs" value="Cetak KHS" onclick="printOut();" type="button">
                        <input class="tombol" id="btnpenilaiankhs" value="Penilaian KHS" onclick="window.location.href='penilaian_khs.php?ta=<? print($ta); ?>&nim=<? print($nim); ?>'" type="button">
                        <input class="tombol" value="Generate IPK" onclick="window.location.href = 'generate_khs_ipk.php?&ta=<? print($ta); ?>&nim=<? print($nim); ?>&kelas=<? print($kelas); ?>'" type="button">
                    </div>
                    <?}?></div>
                    <script language="javascript" type="text/javascript">

                        //window.open('','simpankhs');

                        function executeNewNim() {
                            var newNim = document.getElementById('currPos');
                            var alertMsg = document.getElementById('alertMsg');
                            if (newNim.value != "<? print($nim); ?>") {
                                document.posN.action = '?ta=<? print($ta); ?>&nim=' + newNim.value;
                            } else {
                                alertMsg.innerHTML = '<br>Masukkan NIM yang berbeda. Kemudian tekan ENTER!<br>';
                                return false;
                            }
                        }

                        function executeNewThsms() {
                            var newThsms = document.getElementById('currPosTHSMS');
                            var alertMsg = document.getElementById('alertMsg');
                            if (newThsms.value != "<? print($ta); ?>") {
                                document.posT.action = '?ta=' + newThsms.value + '&nim=<? print($nim); ?>';
                            } else {
                                alertMsg.innerHTML = '<br>Masukkan Tahun Ajaran yang berbeda. Kemudian tekan ENTER!<br>';
                                return false;
                            }
                        }

                        function printOut() {
                            var getDisplay = document.getElementById("printarea").innerHTML;

                            var setPrint = window.open("", "printed", "width=700,height=570,menubar=0,scrollbars=1,statusbar=0");
                            setPrint.document.open();
                            setPrint.document.write('<html>');
                            setPrint.document.write('<head>');
                            setPrint.document.write('<meta http-equiv="pragma" content="no-cache">');
                            setPrint.document.write("<title>KHS - <? print($nim); ?></title>");
                            setPrint.document.write('<link href="cetak/cetakkhs.css" rel="stylesheet" type="text/css">');
                            setPrint.document.write('</head>');
                            setPrint.document.write('<body onLoad="self.print()">');
                            setPrint.document.write(getDisplay);
                            setPrint.document.write('</body></html>');
                            setPrint.document.close();
                            window.close("", "printed");
                        }

                        function numeralsOnly(evt) {
                            evt = (evt) ? evt : event;
                            var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
                                    ((evt.which) ? evt.which : 0));
                            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                                return false;
                            }
                            return true;
                        }

                    </script>
                    <br />
                    <table id="contentKHS" border="0" bordercolor="#0000cc" cellpadding="0" cellspacing="0">
                        <tbody><tr><td style="padding: 0.5cm;">
                                    <?

                                    ?>
                                    <div id="printarea" class="papersetengahA4">
                                        <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
                                            <tbody><tr valign="top">
                                                    <td height="1%">
                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                            <!-- header -->
                                                            <tbody><tr>
                                                                    <td colspan="2" align="center"><span class="header1"></span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="border-bottom: 2px solid rgb(51, 51, 51); padding-bottom: 2px;" align="center" width="90"><img src="images/logo.png" class="logo" style="height:75px;border-width:0px;"></td>
                                                                    <td colspan="3" style="border-bottom: 2px solid rgb(51, 51, 51); padding-bottom: 2px;">
                                                                        <span class="header1">AKADEMI MANAJEMEN ADMINISTRASI</span><br>
                                                                        <span class="header2">AMA YOGYAKARTA</span> <br>
                                                                        <span class="alamat">
                                                                            Kampus: Jl. Pramuka No. 70-85B Yogyakarta, 55163<br>Telepon : (0274) 4340658, Fax/Telp. (0274) 4340658<br>
                                                                            Website: http://www.amayogyakarta.ac.id, Email: info@amayagyakarta.ac.id
                                                                        </span>
                                                                        </span>
                                                                    </td>
                                                                </tr>
                                                                <!-- end : header -->
                                                                <tr height="40">
                                                                    <td colspan="4" class="judulKHS" align="center">KARTU HASIL STUDI (KHS)</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="4">
                                                                    <!-- end  <table border="0" cellpadding="0" cellspacing="0" width="100%"> header -->
                                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="alamat"> 
                                                                            <tbody><tr valign="top">
                                                                                    <td width="11%">N A M A</td><td width="1%">:</td><td width="250"><strong><? print($nama); ?></strong></td>
                                                                                    <td width="16%">No. Mahasiswa</td><td width="1%">:</td><td width="200"><strong><? print($nim); ?></strong></td>
                                                                                </tr>
                                                                                <tr valign="top">
                                                                                    <td>Prodi</td><td width="1%">:</td><td width="250"><strong>D3 - <? print($nama_prodi); ?></strong></td>
                                                                                    <td width="16%">Kelas - Semester</td><td width="1%">:</td><td width="200">
                                                                                        <?
                                                                                        $kelas_splite = explode("-", $kelas);
                                                                                        $pieces = explode("/", $kelas_splite[0]);
                                                                                        if($R=='I'){
                                                                                        $klsjw = "1";
                                                                                        }elseif($R=='II'){
                                                                                        $klsjw = "2";
                                                                                        }elseif($R=='III'){
                                                                                        $klsjw = "3";
                                                                                        }elseif($R=='IV'){
                                                                                        $klsjw = "4";
                                                                                        }elseif($R=='V'){
                                                                                        $klsjw = "5";
                                                                                        }elseif($R=='VI'){
                                                                                        $klsjw = "6";
                                                                                        }elseif($R=='VII'){
                                                                                        $klsjw = "7";
                                                                                        }elseif($R=='VIII'){
                                                                                        $klsjw = "8";
                                                                                        }elseif($R=='IX'){
                                                                                        $klsjw = "9";
                                                                                        }elseif($R=='X'){
                                                                                        $klsjw = "10";
                                                                                        }elseif($R=='XI'){
                                                                                        $klsjw = "11";
                                                                                        }elseif($R=='XII'){
                                                                                        $klsjw = "12";
                                                                                        }
                                                                                        if($status == "1"){
                                                                                        $viewsmt = 0;
                                                                                        }else{
                                                                                        $viewsmt = $klsjw;
                                                                                        }
                                                                                        $kelassmt = $pieces[0].$viewsmt;
                                                                                        ?>
                                                                                        <strong><? print($kelassmt); ?></strong></td>
                                                                                </tr>
                                                                                <tr valign="top">
                                                                                    <?
                                                                                    if($KODEX=="14")
                                                                                    {
                                                                                    ?>
                                                                                    <td>Konsentrasi</td><td width="1%">:</td><td width="250"><strong><? print($nama_konsen); ?></strong></td>
                                                                                    <?
                                                                                    }else
                                                                                    {
                                                                                    ?>
                                                                                    <td>&nbsp;</td><td width="1%">&nbsp;</td><td width="250">&nbsp;</td>
                                                                                    <?
                                                                                    }
                                                                                    ?>
                                                                                    <? if($status_mhs == "P") { ?>
                                                                                    <td width="16%">DPA</td><td width="1%">:</td><td width="200"><strong><? print($namados); ?></strong></td>
                                                                                    <?
                                                                                    }else
                                                                                    {
                                                                                    ?>
                                                                                    <td width="16%">DPA</td><td width="1%">:</td><td width="200"><strong><? print($namados); ?>, <? print($gelardos); ?></strong></td>
                                                                                    <?
                                                                                    }
                                                                                    ?>
                                                                                </tr> 
                                                                            </tbody></table>								

                                                                        <br>
                                                                        <!-- end : tabel khs -->
                                                                        <table class="tabelkhs" bgcolor="#000000" border="0" cellpadding="3" cellspacing="0" width="100%">
                                                                            <tbody><tr bgcolor="#ffffff" valign="middle">
                                                                                    <th class="thl" rowspan="2" width="2%">No.</th>
                                                                                    <th class="thc" rowspan="2" width="12%">KODE</th>
                                                                                    <th class="thc" rowspan="2">MATA KULIAH</th>
                                                                                    <th class="thc" rowspan="2" width="5%">SKS</th>
                                                                                    <th class="thct" colspan="2">NILAI</th>
                                                                                    <th class="thr" rowspan="2" width="10%"><nobr>SKS x Bobot</nobr></th>
                                                                </tr>
                                                                <tr bgcolor="#ffffff" valign="middle">
                                                                    <th class="thcb" width="8%">Huruf</th>
                                                                    <th class="thcb" width="8%">Bobot</th>
                                                                </tr>


                                                                <?
                                                                $no = 0;
                                                                $sks2 = 0;
                                                                $totalambil=0;
                                                                //$hasilt = mysql_query("select * from trnlm where NIMHSTRNLM='$nim' and THSMSTRNLM='$ta' order by KDKMKTRNLM ASC");				
                                                                $hasilt = mysql_query("select * from trnlm t, tbkmk m where m.KDKMKTBKMK=t.KDKMKTRNLM and m.THSMSTBKMK=t.THSMSTRNLM and t.NIMHSTRNLM='$nim' and t.THSMSTRNLM='$ta'and (m.kdkonsen='u' or m.kdkonsen='$kdkonsen') order by m.KDKMKTBKMK ASC");				
                                                                while ($datat = mysql_fetch_array($hasilt))
                                                                {						
                                                                //warna pada kolom
                                                                $no++;
                                                                $KDKMKTRNLM=$datat['KDKMKTRNLM'];
                                                                $THSMSTRNLM=$datat['THSMSTRNLM'];
                                                                $NLAKHTRNLM=$datat['NLAKHTRNLM'];
                                                                $bobot= $datat["BOBOTTRNLM"];
                                                                $ulang=$datat['ulang'];
                                                                $totmk2= "SELECT m.SKSMKTBKMK,m.NAKMKTBKMK,m.SEMESTBKMK from tbkmk m where m.KDKMKTBKMK='$KDKMKTRNLM' and m.THSMSTBKMK='$THSMSTRNLM' and m.KDPSTTBKMK='$JUR' and (kdkonsen='u' or kdkonsen='$kdkonsen')";
                                                                $hasilmk2 = mysql_query($totmk2);

                                                                $datamk2 = mysql_fetch_array($hasilmk2);
                                                                $sks2= $datamk2["SKSMKTBKMK"];
                                                                $namamk= $datamk2["NAKMKTBKMK"];

                                                                $SEMESTBKMK= $datamk2["SEMESTBKMK"];
                                                                $totalambil=$totalambil+$sks2;
                                                                $nasks=$sks2*$bobot;
                                                                $totnasksipk2=$totnasksipk2+$nasks;
                                                                $totsksipk2=$totsksipk2+$sks2;
                                                                if($totsksipk2<=0)
                                                                {
                                                                $ipk2="0.00";
                                                                }else
                                                                {
                                                                $ipk2=$totnasksipk2/$totsksipk2;
                                                                $ipk2=number_format($ipk2,2); 
                                                                }
                                                                $nasks=number_format($nasks,2);
                                                                $bobot=number_format($bobot,2);
                                                                $totnasksipk2=number_format($totnasksipk2,2);

                                                                ?>
                                                                <tr bgcolor="#ffffff">
                                                                    <? if($NLAKHTRNLM=="D" or $NLAKHTRNLM=="T" or $NLAKHTRNLM=="E" or $NLAKHTRNLM=="0" or $NLAKHTRNLM=="") { ?>
                                                                    <td class="tdl" align="center"><span style="color: red;"><? print("$no"); ?></span></td>
                                                                    <? }else{ ?>
                                                                    <td class="tdl" align="center"><? print("$no"); ?></td>
                                                                    <? } ?>
                                                                    <? if($NLAKHTRNLM=="D" or $NLAKHTRNLM=="T" or $NLAKHTRNLM=="E" or $NLAKHTRNLM=="0" or $NLAKHTRNLM=="") { ?>
                                                                    <td class="tdc" align="center"><span style="color: red;"><? print("$KDKMKTRNLM"); ?></span></td>
                                                                    <? }else{ ?>
                                                                    <td class="tdc" align="center"><? print("$KDKMKTRNLM"); ?></td>
                                                                    <? } ?>
                                                                    <? if($NLAKHTRNLM=="D" or $NLAKHTRNLM=="T" or $NLAKHTRNLM=="E" or $NLAKHTRNLM=="0" or $NLAKHTRNLM=="") { ?>
                                                                    <td class="tdc"><span style="color: red;"><i><? print(strtoupper($namamk)); ?></i> - <b><i>*) Ulang</i></b></span></td>
                                                                    <? }else{ ?>
                                                                    <td class="tdc"><? print(strtoupper($namamk)); ?></td>
                                                                    <? } ?>
                                                                    <? if($NLAKHTRNLM=="D" or $NLAKHTRNLM=="T" or $NLAKHTRNLM=="E" or $NLAKHTRNLM=="0" or $NLAKHTRNLM=="") { ?>
                                                                    <td class="tdc" align="center"><span style="color: red;"><? print($sks2); ?></span></td>
                                                                    <? }else{ ?>
                                                                    <td class="tdc" align="center"><? print($sks2); ?></td>	
                                                                    <? } ?>
                                                                    <? if($NLAKHTRNLM=="D" or $NLAKHTRNLM=="T" or $NLAKHTRNLM=="E" or $NLAKHTRNLM=="0" or $NLAKHTRNLM=="") { ?>
                                                                    <td class="tdc" align="center">
                                                                        <? if($NLAKHTRNLM==""){ ?>
                                                                        <span style="color: red;">0</span>
                                                                        <? } else {?>
                                                                        <span style="color: red;"><? print($NLAKHTRNLM); ?></span>
                                                                        <?}?>
                                                                    </td>
                                                                    <? }else{ ?>
                                                                    <td class="tdc" align="center">
                                                                        <? if($NLAKHTRNLM==""){ ?>
                                                                        0
                                                                        <? } else {?>
                                                                        <? print($NLAKHTRNLM); ?>
                                                                        <?}?>
                                                                    </td>	
                                                                    <? } ?>
                                                                    <? if($NLAKHTRNLM=="D" or $NLAKHTRNLM=="T" or $NLAKHTRNLM=="E" or $NLAKHTRNLM=="0" or $NLAKHTRNLM=="") { ?>
                                                                    <td class="tdc" align="center"><span style="color: red;"><? print($bobot); ?></span></td>
                                                                    <? }else{ ?>
                                                                    <td class="tdc" align="center"><? print($bobot); ?></td>	
                                                                    <? } ?>
                                                                    <? if($NLAKHTRNLM=="D" or $NLAKHTRNLM=="T" or $NLAKHTRNLM=="E" or $NLAKHTRNLM=="0" or $NLAKHTRNLM=="") { ?>
                                                                    <td class="tdr" align="right"><span style="color: red;"><? print($nasks); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
                                                                    <? }else{ ?>
                                                                    <td class="tdr" align="right"><? print($nasks); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>	
                                                                    <? } ?>
                                                                </tr>


                                                                <?
                                                                }

                                                                $engDate=date("l F d, Y H:i:s A");
                                                                //echo "English Date : ". $engDate ."<p>";

                                                                switch (date("w")) {
                                                                case "0" : $hari="Minggu";break;
                                                                case "1" : $hari="Senin";break;
                                                                case "2" : $hari="Selasa";break;
                                                                case "3" : $hari="Rabu";break;
                                                                case "4" : $hari="Kamis";break;
                                                                case "5" : $hari="Jumat";break;
                                                                case "6" : $hari="Sabtu";break;
                                                                } switch (date("m")) {
                                                                case "1" : $bulan="Januari";break;
                                                                case "2" : $bulan="Februari";break;
                                                                case "3" : $bulan="Maret";break;
                                                                case "4" : $bulan="April";break;
                                                                case "5" : $bulan="Mei";break;
                                                                case "6" : $bulan="Juni";break;
                                                                case "7" : $bulan="Juli";break;
                                                                case "8" : $bulan="Agustus";break;
                                                                case "9" : $bulan="September";break;
                                                                case "10" : $bulan="Oktober";break;
                                                                case "11" : $bulan="November";break;
                                                                case "12" : $bulan="Desember";break;
                                                                }
                                                                $indDate="". date("d") ." $bulan". date(" Y");
                                                                $qall22 = "UPDATE trakm SET SKSEMTRAKM='$totsksipk2',NLIPSTRAKM=$totnasksipk2 where THSMSTRAKM='$ta' and NIMHSTRAKM='$nim' and KDPSTTRAKM='$JUR'";
                                                                $hasilall22 = mysql_query($qall22);
                                                                ?>									


                                                                <tr bgcolor="#ffffff" valign="middle">
                                                                    <td class="tdl" colspan="3" align="center"><strong> 
                                                                            <?
                                                                            //print($kdkonsen);
                                                                            ?>

                                                                            J U M L A H</strong></td>
                                                                    <td class="tdc" align="center"><strong><? print($totsksipk2); ?></strong></td>
                                                                    <td class="tdc">&nbsp;</td>
                                                                    <td class="tdc">&nbsp;</td>
                                                                    <td class="tdr" align="center"><strong><? print($totnasksipk2); ?></strong></td>
                                                                </tr>
                                                            </tbody></table>
                                                        <!-- end : tabel khs -->


                                                    </td>
                                                </tr>
                                            </tbody></table>

                                        <table class="tabelIndek" bgcolor="#000000" border="0" cellpadding="2" cellspacing="0" width="100%">
                                            <tbody><tr bgcolor="#ffffff" valign="top">
                                                    <td width="110">Indek Prestasi Sem. <? print($viewsmt); ?></td>
                                                    <td width="1">:</td>
                                                    <td align="left" width="170">
                                                        <!--0.00-->
                                                        <? print($ipk2); ?></td>

                                                    <?
                                                    $hasilt = mysql_query("select * from trakm where NIMHSTRAKM='$nim' and THSMSTRAKM='$ta'");				
                                                    while ($datat = mysql_fetch_array($hasilt))
                                                    {
                                                    $ipknya=$datat['NLIPKTRAKM'];	
                                                    $ipknya=number_format($ipknya,2);
                                                    }
                                                    ?>
                                                    <td width="125">Indek Prestasi Kumulatif</td>
                                                    <td width="1">:</td>
                                                    <td id="ipKumulatif" align="left"><!--0.00--><? print($ipknya); ?></td>
                                                </tr>
                                                <!--<tr valign="top" bgcolor="#FFFFFF">
                                                        <td width="105">Indek Prestasi Sem. 1</td><td width="1">:</td><td align="left" width="170">0.00</td>
                                                        <td width="105">Indek Prestasi Sem. II</td><td width="1">:</td><td align="left">0.00</td>
                                                </tr>
                                                <tr valign="top" bgcolor="#FFFFFF">
                                                        <td>Predikat Kelulusan</td><td width="1">:</td><td align="left"></td>
                                                        <td>Predikat Komulatif</td><td width="1">:</td><td align="left"></td>
                                                </tr>-->
                                            </tbody></table><!-- end : tabel indek -->



                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" valign="top">	

                                    <table class="tabelIndek" bgcolor="#000000" border="0" cellpadding="3" cellspacing="0" height="100%" width="100%">
                                        <tbody><tr bgcolor="#ffffff" valign="top">
                                                <td colspan="3">
                                                    <table class="rumuskhs" width="100%">
                                                        <tbody><tr>
                                                                <td colspan="3">
                                                                    <img src="images/rumus.png" width="100">
                                                                    <br>
                                                                    <br>
                                                                    <em>
                                                                        Predikat Kelulusan :</em>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="right">
                                                                    <em> 
                                                                        3,51 - 4,00  <br>
                                                                        2,76 - 3,50  <br>
                                                                        2,00 - 2,75  <br>
                                                                        &lt; 1,99  </em>
                                                                </td>
                                                                <td>&nbsp;</td>
                                                                <td><em>Cum Laude</em><em><br>
                                                                        Sangat Memuaskan<br>
                                                                        Memuaskan<br>
                                                                        Kurang Memuaskan</em></td>
                                                            </tr>
                                                        </tbody></table>
                                                </td>
                                                <td colspan="3" class="ttd" valign="top">
                                                    <br/><br/>
                                                    Yogyakarta, <? echo "". $indDate ."";?>								<br>
                                                    AMA YOGYAKARTA<br>
<!--<img src="source/stemple.png" style="border-width: 0px; z-index: 3; position: absolute; height: 122px; margin-top: -54px; margin-left: -40px;">-->
                                                    <img src="images/ttd.png" style="z-index: 2;
                                                         position: absolute;
                                                         height: 78px;
                                                         margin-left: -71px;
                                                         margin-top: -12px;"><br><br><br>
                                                    <u><strong>WAHYUDIYONO, SE.MM.</strong></u><br />                                                              
                                                    Wakil Direktur I
                                                </td>
                                            </tr>
                                        </tbody></table>
                                </td>
                            </tr>
                            <!--<tr valign="bottom">
                                    <td class="catatan" colspan="2" height="30" valign="top">	
                                            <br/><br/>
                                                                                    <em>Catatan : - Nilai x = Kosong/Belum Mengikuti Ujian, Apabila ada kesalahan segera hubungi bagian Akademik.</em>
                                                                            </td>
                            </tr>-->
                        </tbody></table>			

                    </div></td>
                    <td style="font-family: 'Lucida Sans'; font-size: 10px;" valign="top">
                        <div id="pesanMkNgulang" align="left"></div><br><br>
                        <div id="pesanMkDobel" align="left"></div>
                        <div id="accX" align="left"></div>
                    </td>
                    </tr></tbody></table>



        <!--<script>window.open('cetakkhs_simpan.php?ta=20082&kdpti=053030&kdjen=C&kdpst=10104&nim=14081330&nlips=2.63636363636&sksem=22&nlipk=&skstt=&nodos=&sksmaks=','simpankhs');</script>-->

                    </body></html>
