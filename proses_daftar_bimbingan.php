<?php
include 'config.php';
$nim=$_GET['nim'];
$aturan = mysqli_query($mysqli, "select * from config");
$dataaturan = mysqli_fetch_array($aturan);
$tahun=$dataaturan['tahun'];
$bim_ta=$dataaturan['bim_ta'];
$ta =substr($tahun,0,4);
$result = mysqli_query($mysqli, "UPDATE pendaftaran_ta SET bimbingan='1', biaya_bimbingan='$bim_ta' WHERE nim='$nim'");
header("Location: data_bimbingan_krs.php?nim=$nim");
?>