<?php
include 'config.php';
$id = $_GET['id'];
mysqli_query($mysqli, "UPDATE kegiatan SET status='1' WHERE id='$id'");
mysqli_query($mysqli, "UPDATE kegiatan SET status='0' WHERE id!='$id'");
header("location: presensi_yudisium.php");

