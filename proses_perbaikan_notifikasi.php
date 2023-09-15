<?php
include 'config.php';
$id = $_POST['id'];
$notifikasi = $_POST['notifikasi'];
mysqli_query($mysqli, "UPDATE notifikasi_simakad SET content='$notifikasi' WHERE id='$id'");
//echo "UPDATE notifikasi_simakad SET content='$notifikasi' WHERE id='$id'";
header("location:notifikasi_simakad.php?id=$id");