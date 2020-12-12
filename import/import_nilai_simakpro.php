<?php
session_start();
include '../config.php';
$nim = $_GET['nim'];
$tahun = $_GET['tahun'];
$nilai = mysqli_query($simakpro, "SELECT * FROM rtrnlm WHERE nimhstrnlm='$nim' AND thsmstrnlm='$tahun'");
while ($data = mysqli_fetch_array($nilai)) { 
    $kodemk = $data['kdkmktrnlm'];
    $nilai_angka = $data['nlangtrnlm'];
    $nilai_huruf = $data['nlakhtrnlm'];
    $bobot = $data['bobottrnlm'];
    mysqli_query($mysqli, "UPDATE trnlm SET NLAKHTRNLM='$nilai_huruf', BOBOTTRNLM='$bobot' WHERE KDKMKTRNLM='$kodemk' AND NIMHSTRNLM='$nim' AND THSMSTRNLM='$tahun'");
    echo "UPDATE trnlm SET NLAKHTRNLM='$nilai_angka', BOBOTTRNLM='$bobot' WHERE KDKMKTRNLM='$kodemk' AND NIMHSTRNLM='$nim' AND THSMSTRNLM='$tahun'";
}
header("Location: ../data_khs.php?nim=$nim&tahun=$tahun");
