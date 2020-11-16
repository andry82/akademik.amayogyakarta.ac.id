<?php
include 'config.php';
$nim = $_POST['nim'];
$ta = $_POST['ta'];
$jml_cek = count($_POST['kodemk']);
for ($i = 0; $i < $jml_cek; $i++) { 
    $kodemk[$i] = $_POST['kodemk'][$i];
    $total[$i] = $_POST['total'][$i];
    $akhir[$i] = $_POST['huruf'][$i];
    if ($akhir[$i]=="A"){
        $bobot[$i]="4.00";
    }elseif ($akhir[$i]=="B") {
        $bobot[$i]="3.00";
    }elseif ($akhir[$i]=="C") {
        $bobot[$i]="2.00";
    }elseif ($akhir[$i]=="D") {
        $bobot[$i]="1.00";
    }elseif ($akhir[$i]=="E") {
        $bobot[$i]="0.00";
    }
    mysqli_query($mysqli, "UPDATE  trnlm SET TOTAL='$total[$i]',NLAKHTRNLM='$akhir[$i]',BOBOTTRNLM='$bobot[$i]' WHERE KDKMKTRNLM='$kodemk[$i]' AND NIMHSTRNLM='$nim' AND THSMSTRNLM='$ta'");
}
header("Location: cetak_khs.php?ta=$ta&nim=$nim");
