<?php
session_start();
include_once("config/config.php");
$tahunajaran = $_GET['ta'];
$id_mhs = $_GET['nim'];
$nim = $_GET['nim'];
?>
<html><head><title>Cetak Transkrip Akademik Sementara</title>


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
                height: 332mm;
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
                font-size: 25px; font-family:Arial, Helvetica, sans-serif; font-weight:bold;
            }
            .header2{
                font-size: 40px; font-family:Georgia, 'Times New Roman', Times, serif;
                font-weight:bold;
            }
            .alamat{
                font-size: 12px; font-family:Arial, Helvetica, sans-serif; margin-top: 11px;
            }
            .garis{ border-bottom: 4px double Black; }
            .judulKHS{ font-family: Arial, Helvetica, sans-serif;  font-size: 18px;  font-weight: bold;   }
            .identitas{	font-family: Arial, Tahoma; font-size: 12px;}
            .tabelkhs{
                /*font-family: Arial, Tahoma, Verdana;*/
                font-family: Arial, Tahoma;
                font-size: 12px;
                border: 1px solid #000000;
                border-right: 2px solid #000000;
                padding: 1px;
            }
            .tabelkhs .thl, .thc{
                border-left: 1px solid #000000;
                border-top: 1px solid #000000;
                border-bottom: 2px solid #000000;
            }
            .tabelkhs .thk{
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
                background: none repeat scroll 0 0 white;
                padding: 0px;
                border-bottom: 1px solid black;
            }
            .tabelkhs .tdk{
                background: none repeat scroll 0 0 white;
                padding: 0px;
                border-bottom: 1px solid black;
            }
            .tabelkhs .tdr{
                border-left: 1px solid #000000;
                border-right: 0px solid #000000;
                background: none repeat scroll 0 0 white;
            }
            .tabelIndek{
                font-family: Arial, Tahoma; 
                font-size: 12px;
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
            }
            .even { background-color:#EBEBEB; }
            .odd { background-color:#FBFBFB; }
        </style></head><body onload="document.getElementById('currPos').focus();">
        <div id="navigasi">
            <? $aturan = mysql_query("select statuskrs,tahun,prodi,ipkaktif from config");
            $dataaturan = mysql_fetch_array($aturan);
            $ipkaktif=$dataaturan['ipkaktif'];	

            $qall = "SELECT *,DATE_FORMAT(m.TGLHRMSMHS,'%d-%m-%Y') AS tgl_lahir FROM msmhs m,kelasparalel_mhs k where k.nimhs=m.NIMHSMSMHS and m.NIMHSMSMHS='$nim'";		

            $hasilall = mysql_query($qall);
            $data = mysql_fetch_array($hasilall);
            $nomor_induk_mahasiswa = strtoupper($data['NIMHSMSMHS']);
            $nama_mahasiswa = strtoupper($data['NMMHSMSMHS']);
            $kurikulum = strtoupper($data['KURIKULUM']);
            $tptlhr_mahasiswa = strtoupper($data['TPLHRMSMHS']);
            $tgllhr_mahasiswa = strtoupper($data['TGLHRMSMHS']);
            $transkrip = "SELECT * from transkrip where nim='$nomor_induk_mahasiswa'";
            $transkrip2 = mysql_query($transkrip);
            $transkrip3 = mysql_fetch_array($transkrip2);
            
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
            
            $hasilv = mysql_query("select k.nmkonsen,k.kdkonsen, m.STMHSMSMHS from msmhs m,konsentrasi k where m.NIMHSMSMHS = '$id_mhs' and k.kdkonsen=m.kdkonsen");
            $datav = mysql_fetch_array($hasilv);
            $hasil2 = mysql_query("select nmkelas from kelasparalel_mhs where nimhs = '$id_mhs'");
            $data2 = mysql_fetch_array($hasil2);

            $nmkonsen=$datav['nmkonsen'];
            $KELAS=$data2['nmkelas'];
            $kdkonsen=$datav['kdkonsen'];
            $status_mhs=$datav['STMHSMSMHS'];
            $pecahkelas=explode("/",$KELAS); 
            $kelas1=strtoupper($pecahkelas[0]); // buat huruf besar semua 
            $kelas2=strtoupper($pecahkelas[1]);
            $MASUK=strtoupper($pecahkelas[2]);

            $JUR=strtoupper($pecahkelas[1]);
            $qpeg211 = "SELECT * FROM konsentrasi where kdkonsen='$kdkonsen'";
            $datapeg211 = mysql_query($qpeg211);
            $datakonsen= mysql_fetch_array($datapeg211);
            $JUR=$datakonsen["kdpst"];	
            $KONSEN=$datakonsen["nmkonsen"];

            $qpeg2111 = "SELECT * FROM mspst";
            $datapeg2111 = mysql_query($qpeg2111);
            $dataprodi= mysql_fetch_array($datapeg2111);
            $PRODI=$dataprodi["NMPSTMSPST"];

            $pecahkelas=explode("/",$KELAS); 
            $kelas1=strtoupper($pecahkelas[0]); // buat huruf besar semua 
            $kelas2=strtoupper($pecahkelas[1]);
            $MASUK=strtoupper($pecahkelas[2]);
            $TAHUN="20$MASUK";
            $ASALXX="20$MASUK";
            $ASALXX2="1";
            $CEKXX=substr($tahunajaran,0,4);
            $CEKXX2=substr($tahunajaran,4,1);
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


            $CEKXX=substr($tahunajaran,0,4);
            $CEKXX2=substr($tahunajaran,4,1);

            $CEKXXX=$CEKXX+1;
            $P=substr($tahunajaran,4,1);
            if(($P%2)==1)
            {
            $SS="GANJIL";
            $LALUX=($CEKXX-1);
            $SP="2";
            $LALU="$LALUX$SP";
            }else
            {
            $SS="GENAP";
            $LALUX=$CEKXX;
            $SP="1";
            $LALU="$LALUX$SP";
            }
            $hasil3 = mysql_query("select NLIPSTRAKM,NLIPKTRAKM,SKSEMTRAKM from trakm where NIMHSTRAKM = '$id_mhs' and KURIKULUM='$kurikulum' and THSMSTRAKM='$tahunajaran'");
            $data3 = mysql_fetch_array($hasil3);
            $adalalu = mysql_num_rows($hasil3);
            if($adalalu<=0)
            {
            $hasillalu = mysql_query("select THSMSTRAKM,NLIPSTRAKM,NLIPKTRAKM,SKSEMTRAKM from trakm where KURIKULUM='$kurikulum' and NIMHSTRAKM = '$id_mhs' order by THSMSTRAKM DESC limit 0,1");
            $datalalu = mysql_fetch_array($hasillalu);
            $NLIPSTRAKM=$datalalu['NLIPSTRAKM'];
            $NLIPKTRAKM=$datalalu['NLIPKTRAKM'];
            $SKSEMTRAKM=$datalalu['SKSEMTRAKM'];
            $THSMSTRAKMlalu=$datalalu['THSMSTRAKM'];
            }else
            {
            $NLIPSTRAKM=$data3['NLIPSTRAKM'];
            $NLIPKTRAKM=$data3['NLIPKTRAKM'];
            $SKSEMTRAKM=$data3['SKSEMTRAKM'];

            }
            if($NLIPSTRAKM>=3.00)
            {
            $SKSMAX="24";
            }elseif($NLIPSTRAKM>=2.50)
            {
            $SKSMAX="22";
            }elseif($NLIPSTRAKM>=2.00)
            {
            $SKSMAX="20";
            }elseif($NLIPSTRAKM>1.50)
            {
            $SKSMAX="18";
            }
            else
            {
            $SKSMAX="15";
            }
            ?>
            <form name="posN" method="post">
                    <!-- BEGIN : navigasi NIM -->
                    <font face="Lucida Sans">
                    <a href="cetak_transkrip_sementara.php?nim=<? print($nim-1); ?>" id="klik" style="text-decoration: none;"><? print($nim-1); ?> <font size="5">&#8592;</font></a>&nbsp;&nbsp;&nbsp;
                    <input id="currPos" name="currPos" value="<? print($nim); ?>" size="10" maxlength="10" style="text-align: center; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 14px;" type="text">
                    &nbsp;&nbsp;&nbsp;
                    <a href="cetak_transkrip_sementara.php?nim=<? print($nim+1); ?>" id="klik" style="text-decoration: none;"><font size="5">&#8594;</font> <? print($nim+1); ?></a>
                    <input name="go" value="GO" style="display: none;" onclick="return executeNewNim();" type="submit">

                    <!-- END : navigasi NIM -->


                    <div id="alertMsg" align="left"></div>
                    <hr noshade="noshade">
                    <!--<iframe name="simpankhs" id="iframesimpankhs" frameborder="0" height="0" scrolling="no" width="500"></iframe>
                    <div id="pesanSimpanIframe" align="left"></div>-->
                    </font>
                    <div style="text-align: left;">
                        <input class="tombol" value="Kembali" onclick="window.location.href = 'cetak_berkas.php'" type="button">
                        <input class="tombol" id="btncetakkhs" value="Cetak Transkrip Sementara" onclick="printOut();" type="button">
                        <!--<input class="tombol" value="Surat Keterangan Lulus" onclick="window.location.href = 'cetak_surat_keterangan_lulus.php?nim=<? print($nim); ?>&nodosmsdos=<? print($nodosmsdos)?>&nippdakademik=<? print($nippdakademik); ?>&pdakademik=<? print($pdakademik);?>'" type="button">-->

                    </div></div>
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
                            setPrint.document.write("<title>TRANSKRIP AKADEMIK - <? print($nim); ?></title>");
                            setPrint.document.write('<link href="stylesheet/cetak_transkrip_sementara.css" rel="stylesheet" type="text/css">');
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
                    <table id="contentKHS" border="0" bordercolor="#0000cc" cellpadding="0" cellspacing="0">
                        <tbody><tr><td style="padding: 0.5cm;">
                                    KURIKULUM : <?php echo $kurikulum; ?><br/>
                                    <br/>
                                    <div id="printarea" class="paperA4">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                            <tbody><tr valign="top">
                                                    <td height="10%">
                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                            <!-- header -->
                                                            <tbody>
                                                                <tr height="0">
                                                                    <td colspan="4" align="center"><div style="font-family: Arial, Helvetica, sans-serif;
                                                                                                        font-size: 17px;
                                                                                                        font-weight: bold;">DAFTAR NILAI SEMENTARA</div>
                                                                        <!--<div style="font-style: italic; font-family: Arial, Helvetica, sans-serif;
                                                                        font-size: 10px;"><i>List Of Grades</i></div>--><br/></td>
                                                                </tr>
                                                                <!-- end : header -->
                                                                <?php
                                                                switch (date('m', strtotime($data['TGLHRMSMHS']))) {
                                                                    case "1" : $bulan = "Januari";
                                                                        break;
                                                                    case "2" : $bulan = "Februari";
                                                                        break;
                                                                    case "3" : $bulan = "Maret";
                                                                        break;
                                                                    case "4" : $bulan = "April";
                                                                        break;
                                                                    case "5" : $bulan = "Mei";
                                                                        break;
                                                                    case "6" : $bulan = "Juni";
                                                                        break;
                                                                    case "7" : $bulan = "Juli";
                                                                        break;
                                                                    case "8" : $bulan = "Agustus";
                                                                        break;
                                                                    case "9" : $bulan = "September";
                                                                        break;
                                                                    case "10" : $bulan = "Oktober";
                                                                        break;
                                                                    case "11" : $bulan = "November";
                                                                        break;
                                                                    case "12" : $bulan = "Desember";
                                                                        break;
                                                                }
                                                                $indDate = "" . date("d") . " $bulan" . date(" Y");
                                                                ?>
                                                                <tr>                                                        <td colspan="4">                                  
                                                                        <?php
                                                                        include('identitas_transkrip_sementara.php');
                                                                        ?>			
                                                                        <!-- end : tabel khs -->
                                                                        <table style="margin-top: 5px; font-size: 10px;" class="tabelkhs" bgcolor="#000000" border="0" cellpadding="3" cellspacing="0" width="100%">
                                                                            <tbody><tr bgcolor="#ffffff" valign="middle">
                                                                                    <th class="thl" width="2%">No.</th>
                                                                                    <th class="thl" width="5%">Kode<br/>Mata Kuliah</th>
                                                                                    <th class="thc" width="23%">Nama Mata Kuliah</th>
                                                                                    <!--<th class="thk" style="border-top: 1px solid #000000;
                            border-bottom: 2px solid #000000; text-align: right;" width="23%">Subject</th>-->
                                                                                    <th class="thcb" width="5%">SKS/Credit</th>                                                                      
                                                                                    <th class="thcb" width="5%">Nilai/Grades</th>
                                                                                    <th class="thr" width="5%">Bobot/Weight</th>
                                                                                </tr>
                                                                                <? $color1 = "#fff" ?>
                                                                                <? $color2 = "#fff" ?>
                                                                                <?php include('mktranskrip_sementara.php'); ?>
                                                                                <tr bgcolor="#ffffff" valign="middle" style="border: 1px solid #000000; font-size: 11px;">
                                                                                    <td class="tdl" colspan="3" align="center" style="border-top: 2px solid;"><strong> 
                                                                                            <?
                                                                                            //print($kdkonsen);
                                                                                            ?>

                                                                                            J U M L A H</strong></td>                                                                                
                                                                                    <td class="tdc" align="center" style="border-top: 2px solid;"><? print($totsksipk2); ?></td>
                                                                                    <td class="tdc" align="center" style="border-top: 2px solid;"><strong>&nbsp;</strong></td>
                                                                                    <td class="tdr" align="center" style="border-top: 2px solid;"><strong><? print($totnasksipk2); ?></strong></td>
                                                                                </tr>                                                                    
                                                                            </tbody></table>
                                                                    </td>
                                                                </tr>
                                                            </tbody></table>
                                                </tr>

                                            </tbody></table>
                                        <table border="0" style="font-size: 10px;" cellpadding="0" cellspacing="0" width="100%" class="alamat"> 
                                            <?php
                                            if ($NLIPKTRAKM >= '2.00' && $NLIPKTRAKM <= '2.75') {
                                                $predikat = "Memuaskan";
                                            } else if ($NLIPKTRAKM >= 2.76 && $NLIPKTRAKM <= 3.50) {
                                                $predikat = "Sangat Memuaskan";
                                            } else if ($NLIPKTRAKM >= 3.51 && $NLIPKTRAKM <= 4.00) {
                                                $predikat = "Cum Laude";
                                            }
                                            ?>
                                            <tbody>        
                                                <tr valign="top" style="font-weight: bold"><td width="10%">IPK</td><td width="1%">:</td><td width="890%"><?php echo $NLIPKTRAKM; ?></td></tr>
                                                <tr valign="top" style="font-weight: bold"><td width="10%">Predikat</td><td width="1%">:</td><td width="89%"><?php echo $predikat; ?></td></tr>
                                            </tbody>
                                        </table>
                                        <?php
                                        $trankript_sementara = mysql_query("select * from  transkrip where nim= '$id_mhs' and periode_yudisium='$tahunajaran'");
                                        $data_ts  = mysql_fetch_array($trankript_sementara);
                                        $count_ts  = mysql_num_rows($trankript_sementara);
                                        if($count_ts != 0){
                                            $tanggal_ts = tanggal_indo(date($data_ts['tgl_yudisium']));
                                        }else{
                                            $tanggal_ts = tanggal_indo(date('Y-m-d'));
                                        } ?>
                                        <table border="0" style="font-size: 12px;" cellpadding="0" cellspacing="0" width="100%" class="alamat"> 
                                            <tbody>        
                                                <tr valign="top"><td width="70%"></td>
                                                    <td width="30%">
                                                        Yogyakarta, <?php echo $tanggal_ts; ?><br/>
                                                        Wakil Direktur I
                                                        <br/>
                                                        <br/>
                                                        <br/>
                                                        <br/>
                                                        Wahyudiyono, S.E., M.M.
                                                        <br/>
                                                        <br/>
                                                        <br/>
                                                    </td></tr>
                                            </tbody>
                                        </table>
                                    </div></td>
                            </tr></tbody></table>



        <!--<script>window.open('cetakkhs_simpan.php?ta=20082&kdpti=053030&kdjen=C&kdpst=10104&nim=14081330&nlips=2.63636363636&sksem=22&nlipk=&skstt=&nodos=&sksmaks=','simpankhs');</script>-->

                    </body></html>
