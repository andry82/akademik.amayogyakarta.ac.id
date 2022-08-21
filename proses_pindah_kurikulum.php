<?php
session_start();
if ($_SESSION['level'] != "akademik") {
        header("location:login.php");
    }
include 'config.php';

$nim = $_GET['nim'];
$kurikulum = $_GET['kurikulum'];
$query = "UPDATE msmhs SET KURIKULUM='$kurikulum' WHERE NIMHSMSMHS=$nim";
$sql = mysqli_query($mysqli, $query);
header("Location: detail_mahasiswa.php?nim=$nim");
