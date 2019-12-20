<?php
include '../config.php';
$status = $_GET['status'];
$nim = $_GET['nim'];
mysqli_query($mysqli, "UPDATE pendaftaran_ta SET acc_bimbingan='$status' WHERE nim='$nim'");
header("location:bimbingan_lta_mahasiswa.php?nim=$nim");