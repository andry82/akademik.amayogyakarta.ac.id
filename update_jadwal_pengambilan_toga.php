<?php
session_start();
if ($_SESSION['level'] != "akademik") {
        header("location:login.php");
    }
include 'config.php';
$id = $_POST['id'];
$kelas = $_POST['kelas'];
$tanggal = $_POST['tanggal'];
$waktu= $_POST['waktu'];
$ruang = $_POST['ruang'];
$tahun = $_POST['tahun'];

$query = "UPDATE jadwal_pengambilan_toga SET kelas='$kelas', tanggal='$tanggal', waktu='$waktu', ruang='$ruang', tahun='$tahun'  WHERE id=$id";
mysqli_query($mysqli, $query);
header("Location: jadwal_pengambilan_toga.php");
//var_dump($query);
