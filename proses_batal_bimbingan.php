<?php
include 'config.php';
$nim=$_GET['nim'];
$aturan = mysqli_query($mysqli, "select * from config");
$dataaturan = mysqli_fetch_array($aturan);
$tahun=$dataaturan['tahun'];
$bim_ta=$dataaturan['bim_ta'];
$ta =substr($tahun,0,4);
$result = mysqli_query($mysqli, "UPDATE pendaftaran_ta SET bimbingan='0', biaya_bimbingan='0' WHERE nim='$nim'");
header("Location: data_bimbingan_krs.php?nim=$nim");
?>