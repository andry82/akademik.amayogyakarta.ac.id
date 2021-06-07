<? // $totip2 = "SELECT distinct(KDKMKTRNLM) from trnlm  where NIMHSTRNLM='$id_mhs' and ((NLAKHTRNLM<>'') AND (NLAKHTRNLM<>'T') AND (NLAKHTRNLM<>'0'))  order by KDKMKTRNLM,NLAKHTRNLM ASC";

if($ipkaktif=="open")
{
$totip2 = "SELECT distinct(KDKMKTRNLM) from trnlm  where NIMHSTRNLM='$id_mhs' order by KDKMKTRNLM,NLAKHTRNLM ASC";
}else
{
$totip2 = "SELECT distinct(tr.KDKMKTRNLM) from trnlm tr, tbkmk tbk where tr.KDKMKTRNLM=tbk.KDKMKTBKMK AND tr.THSMSTRNLM<='$tahunajaran' and tr.NIMHSTRNLM='$id_mhs' order by tbk.SEMESTBKMK ASC";
} 

$hasilip2 = mysql_query($totip2);
$no=0;
$nasks2=0;
$totnasksipk2=0;
$totsksipk2=0;
$ipk2=0;
$w=$strip;
while($dataip2 = mysql_fetch_array($hasilip2))
{
$warna = ($no % 2) ? $color2 : $color1;

$kode2= $dataip2["KDKMKTRNLM"];
$totip3 = "SELECT NLAKHTRNLM,BOBOTTRNLM,THSMSTRNLM,KDKMKTRNLM from trnlm  where NIMHSTRNLM='$id_mhs' and KDKMKTRNLM='$kode2' order by NLAKHTRNLM ASC LIMIT 0,1";
$hasilip3 = mysql_query($totip3);
$dataip3 = mysql_fetch_array($hasilip3);

$nilai2= $dataip3["NLAKHTRNLM"];
$bobot2= $dataip3["BOBOTTRNLM"];
$THSMSTRNLM= $dataip3["THSMSTRNLM"];
$kode3= $dataip3["KDKMKTRNLM"];
$kode4= $dataip3["KDKMKTRNLM"];

$totmk2= "SELECT m.SKSMKTBKMK,m.NAKMKTBKMK, m.NAKMKTBKMK_EN from tbkmk m where m.KDKMKTBKMK='$kode3' and m.THSMSTBKMK='$THSMSTRNLM' and (kdkonsen='u' or kdkonsen='$kdkonsen')";
$hasilmk2 = mysql_query($totmk2);

$datamk2 = mysql_fetch_array($hasilmk2);
$sks2= $datamk2["SKSMKTBKMK"];
$namamk= $datamk2["NAKMKTBKMK"];
$namamk_en = $datamk2["NAKMKTBKMK_EN"];
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
}?>
<tr style="background-color: <?= ($warna) ?>;"><td class="tdl" style="background: none repeat scroll 0 0 white;
    padding: 3px;
    border-bottom: 1px solid black;" align="center"><? print($no + 1); ?></td>

    <?
    if($nilai2=="T" or $nilai2=="E" or $nilai2=="0")
    {
    ?>
    <td class="tdc" style="background: none repeat scroll 0 0 white;
    padding: 3px;
    border-bottom: 1px solid black; text-align: left;"><i><? 
        $nama_mk = strtolower($namamk);
        print(ucwords($nama_mk)); ?></i> - <b><i>*) Ulang</i></b></td>
    <?
    }else
    {
    ?>
    <td class="tdc" style="background: none repeat scroll 0 0 white;
    padding: 3px;
    border-bottom: 1px solid black; text-align: left;">
        <? print($namamk); ?></td>
    <?
    }
    ?>                                     
    <td class="tdc" style="background: none repeat scroll 0 0 white;
    padding: 3px;
    border-bottom: 1px solid black;" align="center"><? print($sks2); ?></td>
    <td class="tdc" style="background: none repeat scroll 0 0 white;
    padding: 3px;
    border-bottom: 1px solid black;" align="center"><? print($nilai2); ?></td>
    <? if($nasks2 == 0){ ?>
    <td class="tdc" style="background: none repeat scroll 0 0 white;
    padding: 3px;
    border-bottom: 1px solid black;" align="center">&nbsp;-</td>
    <? }else{ ?>
    <td class="tdc" style="background: none repeat scroll 0 0 white;
    padding: 3px;
    border-bottom: 1px solid black;" align="center"><? print($nasks2); ?></td>
    <? } ?>                                 
</tr>
<? $nomor2 = $no + 1; ?>
<?php if ($nomor2 =='40'){ ?>
</table>
<table border="0" style="font-size: 10px;" cellpadding="0" cellspacing="0" width="100%" class="alamat"> 
    <tbody>        
        <tr valign="top" style="font-weight: bold"><td width="18%">Nama Mahasiswa</td><td width="1%">:</td><td width="30%"><? print($nama_mahasiswa); ?></td><td width="20%">Nomor Induk Mahasiswa</td><td width="1%">:</td><td width="15%"><? print(strtoupper($nomor_induk_mahasiswa)); ?></td></tr>
    </tbody>
</table>
<table style="margin-top: 5px; font-size: 10px;" class="tabelkhs" bgcolor="#000000" border="0" cellpadding="3" cellspacing="0" width="100%">
                                                                <tbody><tr bgcolor="#ffffff" valign="middle">
                                                                        <th class="thl" width="2%">No.</th>
                                                                        <th class="thc" style="text-align: left;" width="23%">Nama Mata Kuliah</th>
                                                                        <!--<th class="thk" style="border-top: 1px solid #000000;
                border-bottom: 2px solid #000000; text-align: right;" width="23%">Subject</th>-->
                                                                        <th class="thcb" width="5%">SKS/Credit</th>                                                                      
                                                                        <th class="thcb" width="5%">Nilai/Grades</th>
                                                                        <th class="thr" width="5%">Bobot/Weight</th>
                                                                    </tr>
    
<?php } ?>
<? $no++; }?>
