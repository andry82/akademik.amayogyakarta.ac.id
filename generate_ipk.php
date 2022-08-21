<?php
include('generate/config.php');
if (!konek_db()) {//koneksi database	
    echo '<p align="center">Dalam Tahap Maintenance</p>';
    exit;
}
$self = $_SERVER['PHP_SELF'];
$SEMESTER = $_POST['semester'];
$NIM = $_GET['nim'];
$kls = "SELECT kpm.nmkelas, m.KURIKULUM from kelasparalel_mhs kpm, msmhs m where m.NIMHSMSMHS=kpm.nimhs AND kpm.nimhs='$NIM'";
$hasilkls = mysql_query($kls);
$datakls = mysql_fetch_array($hasilkls);
$KELAS = $datakls["nmkelas"];
$kurikulum = $datakls["KURIKULUM"];

$IPSEMYA = 'ya';
$IPKYA = 'ya';
echo $SEMESTER;
$pecahkelas = explode("/", $KELAS);
$kelas1 = strtoupper($pecahkelas[0]); // buat huruf besar semua 
$kelas2 = strtoupper($pecahkelas[1]);
//$MASUK=strtoupper($pecahkelas[2]);
$pecahtahun = explode("-", $pecahkelas[2]);
$MASUK = strtoupper($pecahtahun[0]);

$JUR = strtoupper($pecahkelas[1]);
$kdkonsen = $JUR;
$JUR = "61401";
if ($kdkonsen == "OF") {
    $JUR = "61401";
    $KONSEN = "MANAJEMEN ADMINISTRASI OBAT DAN FARMASI";
    $KODEX = "33";
} elseif ($kdkonsen == "RS") {
    $JUR = "61401";
    $KODEX = "03";
    $KONSEN = "MANAJEMEN ADMINISTRASI RUMAH SAKIT";
} elseif ($kdkonsen == "TU") {
    $JUR = "61401";
    $KODEX = "13";
    $KONSEN = "MANAJEMEN ADMINISTRASI TRANSPORTASI UDARA";
}
$PRODI = "MANAJEMEN ADMINISTRASI";
$NAMAP = "MANAJEMEN ADMINISTRASI";
$TAHUN = "20$MASUK";
$ASALXX = "20$MASUK";
$ASALXX2 = "1";
$CEKXX = substr($SEMESTER, 0, 4);
$CEKXX2 = substr($SEMESTER, 4, 1);
$CEKXXX = $CEKXX + 1;

$qmapel2 = "SELECT distinct(THSMSTRAKM) from trakm order by THSMSTRAKM ASC";
$hasilmapel2 = mysql_query($qmapel2);



$SEMESTERAN = substr($SEMESTER, 4, 2);

$SEMESTERAN = "0$SEMESTERAN";
$KODETH = "$KODEX$MASUK";
?>
<html>
    <head>
        <title><? print("$KODETH");?>-<? print("$kelas2");?></title>
        <style>


            body {
                background-color: #ffffff; /* background color */
                color: inherit; /* text color */
                font-family: Arial Narrow; /* font name */
                font-size: 14; /* font size */
                margin: 0px 0px 0px 0px; /* top right bottom left */
            }

            .phpreportmaker {
                color: inherit; /* text color */
                font-family: Verdana; /* font name */
                font-size: xx-small; /* font size */	
            }

            /* main table */
            .ewTable {
                width: inherit; /* table width */	
                color: inherit; /* text color */
                font-family: Arial Narrow; /* font name */
                font-size: 10; /* font size */

                border-collapse: collapse;
            }

            /* main table data cells */
            .ewTable td {
                padding: 3px; /* cell padding */

                border-color: #000000;  /* table background color */
            }

            /* main table header cells */
            .ewTableHeader {
                background-color: #6699CC; /* header color */
                color: #FFFFFF; /* header font color */	
                vertical-align: top;	
            }

            .ewTableHeader a:link {	
                color: #FFFFFF; /* header font color */	
            }

            .ewTableHeader a:visited {	
                color: #FFFFFF; /* header font color */	
            }

            /* main table row color */
            .ewTableRow {
                background-color: #FFFFFF;  /* alt row color 1 */
            }

            /* main table alternate row color */
            .ewTableAltRow {
                background-color: #F5F5F5; /* alt row color 2 */	
            }


            /* group 1 */
            .ewRptGrpHeader1 {
                background-color: #CCFFFF;
                font-weight: bold;		
            }

            .ewRptGrpField1 {
                background-color: #CCFFFF;
            }

            .ewRptGrpSummary1 {
                background-color: #BBEEEE;	
            }

            /* group 2 */
            .ewRptGrpHeader2 {
                background-color: #CCFFCC;
                font-weight: bold;
            }

            .ewRptGrpField2 {
                background-color: #CCFFCC;
            }

            .ewRptGrpSummary2 {
                background-color: #BBEEBB;	
            } 

            /* group 3 */
            .ewRptGrpHeader3 {
                background-color: #99FFCC;
                font-weight: bold;	
            }

            .ewRptGrpField3 {
                background-color: #99FFCC;
            }

            .ewRptGrpSummary3 {
                background-color: #88EEBB;	
            }

            /* group 4 */
            .ewRptGrpHeader4 {
                background-color: #99FF99;
                font-weight: bold;	
            }

            .ewRptGrpField4 {
                background-color: #99FF99;
            }

            .ewRptGrpSummary4 {
                background-color: #88EE88;	
            }

            .ewRptGrpAggregate {
                font-weight: bold;
            }

            .ewRptPageSummary {
                background-color: #FFFFCC; /* page total background color */	
            }

            .ewRptGrandSummary {
                background-color: #FFFF66; /* grand total background color */	
            }

            /* classes for crosstab report only */

            .ewRptColHeader {
                background-color: #CCFF66; /* column background color */
                font-weight: bold;
            }

            .ewRptColField {
                background-color: #CCFF66; /* column background color */
            }



        </style>
    </head>
    <body>
        <?
        $perintah=mysql_query("select * from kelasparalel k,msdos t where k.namakelas='$KELAS' and t.NODOSMSDOS=k.nodos"); 
        $datanya=mysql_fetch_array($perintah);
        $namados=$datanya['NMDOSMSDOS'];
        ?>
        <BR>
        <br>
        <div id="report_summary">
            <table id="ewReport" class="ewTable" border=1>
                <tbody>
                    <tr class="ewTableAltRow">

                        <td class="ewRptDtlField" align="center" valign="center" rowspan=2>No. </td>
                        <td class="ewRptDtlField" align="center" valign="center" rowspan=2>NIM</td>
                        <td class="ewRptDtlField" align="center" valign="center" rowspan=2>Nama</td>
                        <?
                        if($IPSEMYA=="ya")
                        {
                        $qmapel = "SELECT distinct(THSMSTRAKM) from trakm WHERE KURIKULUM='$kurikulum' order by THSMSTRAKM ASC";


                        $hasilmapel = mysql_query($qmapel);
                        $tr=0;
                        while($datamapel = mysql_fetch_array($hasilmapel))
                        {
                        $tr++;
                        $THSMSTRAKM= $datamapel["THSMSTRAKM"];
                        $awal=substr($THSMSTRAKM,0,4);
                        if(($awal==$TAHUN) or ($next==1))
                        {

                        ?>
                        <td class="ewRptDtlField" colspan=4 align="center" valign="center">
                            <? print("$THSMSTRAKM");?>

                        </td>

                        <?
                        $next=1;
                        }

                        }
                        }
                        if($IPKYA=="ya")
                        {	
                        ?>
                        <td class="ewRptDtlField" align="center" valign="center" colspan=2>IP TRANSKRIP KOMULATIF</td>
                        <?
                        }
                        ?>

                    </tr>
                    <tr class="ewTableAltRow">
                        <?
                        if($IPSEMYA=="ya")
                        {
                        $tr=0;
                        while($datamapel = mysql_fetch_array($hasilmapel))
                        {
                        $tr++;
                        $THSMSTRAKMx= $datamapel["THSMSTRAKM"];
                        $awalx=substr($THSMSTRAKMx,0,4);
                        if(($awalx==$TAHUN) or ($nextx==1))
                        {

                        ?>
                        <td class="ewRptDtlField" align="center" valign="center">SKS SEM</td>
                        <td class="ewRptDtlField" align="center" valign="center">IP SEM</td>
                        <td class="ewRptDtlField" align="center" valign="center">SKS TOT</td>
                        <td class="ewRptDtlField" align="center" valign="center">IPK</td>

                        <?
                        $nextx=1;
                        }

                        }
                        }
                        if($IPKYA=="ya")
                        {	
                        ?>
                        <td class="ewRptDtlField" align="center" valign="center">SKS TOTAL</td>
                        <td class="ewRptDtlField" align="center" valign="center">IPK</td>
                        <?
                        }
                        ?>

                    </tr>


                    <?
                    $qall = "SELECT * FROM msmhs m where m.TAHUNMSMHS='$TAHUN' and m.KDPSTMSMHS='$JUR' and m.NIMHSMSMHS='$NIM' and KURIKULUM='$kurikulum' order by m.NIMHSMSMHS ASC";		
                    $hasilall = mysql_query($qall);
                    $noxcc=0;
                    while($dataall = mysql_fetch_array($hasilall))
                    {
                    $noxcc++;
                    $nim= $dataall["NIMHSMSMHS"];
                    $nama= $dataall["NMMHSMSMHS"];
                    $kelas= $dataall["nmkelas"];


                    //tambahan
                    $kdkonsen=$dataall["kdkonsen"];
                    if($kdkonsen=="OF")
                    {
                    $JUR="61401";
                    $KONSEN="MANAJEMEN ADMINISTRASI OBAT DAN FARMASI";
                    $KODEX="33";
                    }elseif($kdkonsen=="RS")
                    {
                    $JUR="61401";
                    $KODEX="03";
                    $KONSEN="MANAJEMEN ADMINISTRASI RUMAH SAKIT";
                    }
                    elseif($kdkonsen=="TU")
                    {
                    $JUR="61401";
                    $KODEX="13";
                    $KONSEN="MANAJEMEN ADMINISTRASI TRANSPORTASI UDARA";
                    }
                    $PRODI="MANAJEMEN ADMINISTRASI";
                    $NAMAP="MANAJEMEN ADMINISTRASI";


                    //tambahan end
                    ?>
                    <tr class="ewTableRow">
                        <td bgcolor="#ffffff" align="center"><? print("$noxcc");?></td>
                        <td bgcolor="#ffffff" align="center" valign="center"><? print("$nim");?></td>
                        <td bgcolor="#ffffff" >&nbsp;&nbsp;<? print("$nama");?></td>
                        <?
                        if($IPSEMYA=="ya")
                        {							 
                        $qmapel2 = "SELECT distinct(THSMSTRAKM) from trakm WHERE KURIKULUM='$kurikulum' order by THSMSTRAKM ASC";


                        $hasilmapel2 = mysql_query($qmapel2);
                        $tr2=0;

                        $totsksipk=0;
                        $nasksipk=0;
                        $totnasksipk=0;

                        $ipk=0;											 
                        while($datamapel2 = mysql_fetch_array($hasilmapel2))
                        {
                        $THSMSTRAKM2= $datamapel2["THSMSTRAKM"];

                        $awal2=substr($THSMSTRAKM2,0,4);
                        if(($awal2==$TAHUN) or ($next2==1))
                        {

                        $cekaktif = "SELECT NLIPSTRAKM,SKSEMTRAKM,NLIPKTRAKM,SKSTTTRAKM from trakm where THSMSTRAKM='$THSMSTRAKM2' and NIMHSTRAKM='$nim' and KURIKULUM='$kurikulum' order by THSMSTRAKM ASC";
                        $hasilaktif = mysql_query($cekaktif);
                        $aktif=mysql_numrows($hasilaktif);
                        if($aktif>=1)
                        {

                        $tahun[$tr2]=$THSMSTRAKM2;
                        for($name1array=0; $name1array <= $tr2; $name1array++)
                        {
                        if($name1array <= ($tr2-1)) { $name1_cond = " OR "; }
                        else { $name1_cond = ""; }
                        $name1q = $name1q."THSMSTRNLM='".$tahun[$name1array]."'$name1_cond";
                        }
                        $tr2++;
                        $totip = "SELECT distinct(KDKMKTRNLM),NIMHSTRNLM,NLAKHTRNLM,BOBOTTRNLM from trnlm  where THSMSTRNLM='$THSMSTRAKM2' and NIMHSTRNLM='$nim' and KURIKULUM='$kurikulum' order by KDKMKTRNLM ASC,BOBOTTRNLM DESC";
                        $hasilip = mysql_query($totip);


                        $a=0;
                        $totbobot=0;
                        $totsks=0;
                        $nasks=0;
                        $totnasks=0;
                        $sks=0;
                        $ipsem=0;
                        while($dataip = mysql_fetch_array($hasilip))
                        {
                        $kode= $dataip["KDKMKTRNLM"];
                        $nilai= $dataip["NLAKHTRNLM"];
                        $bobot= $dataip["BOBOTTRNLM"];

                        $totmk= "SELECT m.SKSMKTBKMK,m.kdkonsen from tbkmk m where m.KDKMKTBKMK='$kode' and m.THSMSTBKMK='$THSMSTRAKM2' and m.KURIKULUM='$kurikulum' and (m.kdkonsen='u' or m.kdkonsen='$kdkonsen') limit 0,1";
                        $hasilmk = mysql_query($totmk);
                        $datamk = mysql_fetch_array($hasilmk);
                        $sks= $datamk["SKSMKTBKMK"];


                        $nasks=$sks*$bobot;
                        $totnasks=$totnasks+$nasks;
                        $totsks=$totsks+$sks;

                        if($totsks<=0)
                        {
                        $ipsem=0;
                        }
                        else
                        {
                        $ipsem=$totnasks/$totsks;
                        }
                        $ipsem=number_format($ipsem,2); 		


                        $a++;
                        }

                        $totip2 = "SELECT distinct(KDKMKTRNLM) from trnlm  where ($name1q) and NIMHSTRNLM='$nim' and KURIKULUM='$kurikulum' order by KDKMKTRNLM,NLAKHTRNLM ASC";

                        $hasilip2 = mysql_query($totip2);
                        $a2=0;
                        $nasks2=0;
                        $totnasksipk2=0;
                        $totsksipk2=0;
                        $ipk2=0;
                        while($dataip2 = mysql_fetch_array($hasilip2))
                        {
                        $a2++;
                        $kode2= $dataip2["KDKMKTRNLM"];
                        //perubahan 29 oktt 2012
                        $totip3 = "SELECT NLAKHTRNLM,BOBOTTRNLM,THSMSTRNLM,KDKMKTRNLM from trnlm  where ($name1q) and NIMHSTRNLM='$nim' and KDKMKTRNLM='$kode2' and KURIKULUM='$kurikulum' order by NLAKHTRNLM ASC LIMIT 0,1";
                        //
                        $hasilip3 = mysql_query($totip3);
                        $dataip3 = mysql_fetch_array($hasilip3);

                        $nilai2= $dataip3["NLAKHTRNLM"];
                        $bobot2= $dataip3["BOBOTTRNLM"];
                        $THSMSTRNLM= $dataip3["THSMSTRNLM"];
                        $kode3= $dataip3["KDKMKTRNLM"];

                        $totmk2= "SELECT m.SKSMKTBKMK,m.kdkonsen from tbkmk m where m.KDKMKTBKMK='$kode3' and m.THSMSTBKMK='$THSMSTRNLM' and m.KURIKULUM='$kurikulum' and (m.kdkonsen='u' or m.kdkonsen='$kdkonsen') limit 0,1";
                        $hasilmk2 = mysql_query($totmk2);
                        $datamk2 = mysql_fetch_array($hasilmk2);
                        $sks2= $datamk2["SKSMKTBKMK"];


                        $nasks2=$sks2*$bobot2;
                        $totnasksipk2=$totnasksipk2+$nasks2;
                        $totsksipk2=$totsksipk2+$sks2;
                        if($totsksipk2<=0)
                        {
                        $ipk2="0.00";
                        }else
                        {
                        $ipk2=$totnasksipk2/$totsksipk2;

                        }

                        $ipk2=number_format($ipk2,2); 
                        }


                        $cekada = "SELECT * from trakm where NIMHSTRAKM='$nim' and THSMSTRAKM='$THSMSTRAKM2' and KURIKULUM='$kurikulum'";
                        $hasilada = mysql_query($cekada);
                        $adakah=mysql_numrows($hasilada);
                        if($adakah<=0)
                        {
                        $qall22 = "INSERT INTO trakm(THSMSTRAKM,KURIKULUM,KDPTITRAKM,KDJENTRAKM,KDPSTTRAKM,NIMHSTRAKM,SKSEMTRAKM,nodos,NLIPSTRAKM,NLIPKTRAKM,SKSTTTRAKM,bobottotal) VALUES('$THSMSTRAKM2','$kurikulum','054043','E','61401','$nim','$sks_mapelx','$totsks','$ipsem','$ipk2','$totsksipk2','$totnasks')";
                        $hasilall22 = mysql_query($qall22);
                        }else
                        {

                        $updatenilai = "UPDATE trakm SET NLIPSTRAKM=$ipsem,SKSEMTRAKM=$totsks,NLIPKTRAKM=$ipk2,SKSTTTRAKM=$totsksipk2,bobottotal=$totnasks where NIMHSTRAKM='$nim' and THSMSTRAKM='$THSMSTRAKM2' and KURIKULUM='$kurikulum'";
                        $hasilall211 = mysql_query($updatenilai);
                        }

                        if($totsks>24)
                        {
                        ?>
                        <td bgcolor="#ffffff" colspan=4 align="center" valign="center"><b>DOUBLE TRNLM</b></td>
                        <?
                        }else
                        {
                        ?>
                        <td bgcolor="#ffffff" align="center" valign="center"> <b> <? print("$totsks"); ?> </b></td>
                        <td bgcolor="#ffffff"  align="center" valign="center"> <b> <? print("$ipsem"); ?> </b></td>
                        <td bgcolor="#ffffff" align="center" valign="center"> <b> <? print("$totsksipk2"); ?> </b></td>
                        <td bgcolor="#ffffff" align="center" valign="center"> <b> <? print("$ipk2"); ?> </b></td>

                        <?
                        }

                        $name1q ="";
                        }else
                        {

                        ?>
                        <td bgcolor="#000000" colspan=4 align="center" valign="center"><b>TDK KRS</b></td>
                        <?
                        }

                        $next2=1;
                        }





                        ?>

                        <?

                        }
                        $next2=0;
                        }
                        if($IPKYA=="ya")
                        {	
                        ?>

                        <td bgcolor="#ffffff" align="center" valign="center"> 
                            <?


                            $totip2 = "SELECT distinct(KDKMKTRNLM) from trnlm  where NIMHSTRNLM='$nim' and KURIKULUM='$kurikulum' and (NLAKHTRNLM<>'')  order by KDKMKTRNLM,NLAKHTRNLM ASC";

                            $hasilip2 = mysql_query($totip2);
                            $a2=0;
                            $nasks2=0;
                            $totnasksipk2=0;
                            $totsksipk2=0;
                            $ipk2=0;
                            while($dataip2 = mysql_fetch_array($hasilip2))
                            {
                            $a2++;
                            $kode2= $dataip2["KDKMKTRNLM"];
                            $totip3 = "SELECT NLAKHTRNLM,BOBOTTRNLM,THSMSTRNLM,KDKMKTRNLM from trnlm  where NIMHSTRNLM='$nim' and KDKMKTRNLM='$kode2' and KURIKULUM='$kurikulum' order by NLAKHTRNLM ASC LIMIT 0,1";
                            $hasilip3 = mysql_query($totip3);
                            $dataip3 = mysql_fetch_array($hasilip3);

                            $nilai2= $dataip3["NLAKHTRNLM"];
                            $bobot2= $dataip3["BOBOTTRNLM"];
                            $THSMSTRNLM= $dataip3["THSMSTRNLM"];
                            $kode3= $dataip3["KDKMKTRNLM"];

                            $totmk2= "SELECT m.SKSMKTBKMK from tbkmk m where m.KDKMKTBKMK='$kode3' and m.THSMSTBKMK='$THSMSTRNLM' and m.KDPSTTBKMK='$JUR' and m.KURIKULUM='$kurikulum' and (m.kdkonsen='u' or m.kdkonsen='$kdkonsen') ";
                            $hasilmk2 = mysql_query($totmk2);
                            $datamk2 = mysql_fetch_array($hasilmk2);
                            $sks2= $datamk2["SKSMKTBKMK"];
                            $nasks2=$sks2*$bobot2;
                            $totnasksipk2=$totnasksipk2+$nasks2;
                            $totsksipk2=$totsksipk2+$sks2;
                            if($totsksipk2<=0)
                            {
                            $ipk2="0.00";
                            }else
                            {
                            $ipk2=$totnasksipk2/$totsksipk2;
                            $ipk2=number_format($ipk2,2); 
                            }


                            }
                            ?>
                            <b> <? print("$totsksipk2"); ?> </b></td>			  			
                        <td bgcolor="#ffffff" align="center" valign="center"> <b> <? print("$ipk2"); ?> </b></td>
                    </tr>


                    <?
                    }
                    for($name1array=0; $name1array <= $tr2; $name1array++)
                    {
                    $tahun[$tr2]="";
                    }

                    }
                    ?>

                </tbody></table>
            <br>

            <?
            $engDate=date("l F d, Y H:i:s A");

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
            $indDate="$hari, ". date("d") ." $bulan". date(" Y");
            ?>
<?php echo '<script>window.location.href = "data_bimbingan_krs.php?nim=' . $NIM . '";</script>'; ?>
        </div>
    </body>
</html>
