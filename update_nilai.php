<?php
session_start();
include 'config.php';
$kelas = $_POST['kelas'];
$ta = $_POST['ta'];
$mk = $_POST['mk'];
$nodos = $_POST['nodos'];
$jml_cek = count($_POST['nim']);
for ($i = 0; $i < $jml_cek; $i++) { 
    $nim[$i] = $_POST['nim'][$i];
    $kodemk[$i] = $_POST['kodemk'][$i];
    $presensi[$i] = $_POST['presensi'][$i];
    $tugas[$i] = $_POST['tugas'][$i];
    $keaktifan[$i] = $_POST['keaktifan'][$i];
    $mid[$i] = $_POST['mid'][$i];
    $uas[$i] = $_POST['uas'][$i];
    $angka[$i] = $_POST['angka'][$i];
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
    mysqli_query($mysqli, "UPDATE  trnlm SET PRESENSI='$presensi[$i]',TUGAS='$tugas[$i]',KEAKTIFAN='$keaktifan[$i]',MID='$mid[$i]', UAS='$uas[$i]', TOTAL='$angka[$i]', NILAI='$akhir[$i]', BOBOT='$bobot[$i]' WHERE NIMHSTRNLM='$nim[$i]' AND KDKMKTRNLM='$kodemk[$i]'");   
}

header("Location: data_penilaian_mahasiswa.php?kodemk=$mk&kelas=$kelas&ta=$ta&nodos=$nodos");
?>