<?php
session_start();
include 'config.php';
$pendaftar = $_GET['id'];
$id = $_GET['kegiatan'];
$nim = $_GET['nim'];
$sesi= $_GET['sesi'];
mysqli_query($mysqli, "UPDATE pendaftaran_yudisium SET sesi='$sesi' WHERE nim='$nim' AND pendaftaran_id='$pendaftar'");
//echo "UPDATE pendaftaran_yudisium SET sesi='$sesi' WHERE nim='$nim' AND id='$pendaftar'";
header("Location: detail_presensi_yudisium.php?id=$id");