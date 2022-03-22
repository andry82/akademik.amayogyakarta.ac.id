<?php
session_start();
include '../config.php';
$nim = $_GET['nim'];
$tahun = $_GET['tahun'];
$nilai = mysqli_query($simakpro, "SELECT * FROM rtrnlm WHERE nimhstrnlm LIKE '1800%'");
while ($data = mysqli_fetch_array($nilai)) { 
    $tahun = $data['thsmstrnlm'];
    $kodemk = $data['kdkmktrnlm'];
    $nilai_angka = $data['nlangtrnlm'];
    $nilai_huruf = $data['nlakhtrnlm'];
    $bobot = $data['bobottrnlm'];
    mysqli_query($mysqli, "UPDATE trnlm SET TOTAL='$nilai_angka', NLAKHTRNLM='$nilai_huruf', BOBOTTRNLM='$bobot' WHERE KDKMKTRNLM='$kodemk' AND NIMHSTRNLM LIKE '1800%' AND THSMSTRNLM='$tahun'");
}
header("Location: ../data_bimbingan_krs.php?nim=$nim");
