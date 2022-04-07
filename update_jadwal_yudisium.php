<?php
session_start();
if ($_SESSION['level'] != "akademik") {
        header("location:login.php");
    }
include 'config.php';
$id = $_POST['id'];
$nama_kegiatan = $_POST['nama_kegiatan'];
$tanggal = $_POST['tanggal'];
$waktu= $_POST['waktu'];
$ruang = $_POST['ruang'];
$tahun = $_POST['tahun'];

$query = "UPDATE kegiatan SET nama_kegiatan='$nama_kegiatan', tanggal='$tanggal', waktu='$waktu', ruang='$ruang', tahun='$tahun'  WHERE id=$id";
$sql = mysqli_query($mysqli, $query);
header("Location: jadwal_yudisium.php");
//var_dump($query);
