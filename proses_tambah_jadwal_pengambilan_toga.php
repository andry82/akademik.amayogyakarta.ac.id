<?php
session_start();
if ($_SESSION['level'] != "akademik") {
        header("location:login.php");
    }
include 'config.php';
$kelas = $_POST['kelas'];
$tanggal = $_POST['tanggal'];
$waktu= $_POST['waktu'];
$ruang = $_POST['ruang'];
$tahun = $_POST['tahun'];

$result = mysqli_query($mysqli, "INSERT INTO  jadwal_pengambilan_toga(kelas,tanggal,waktu,ruang,tahun) VALUES('$kelas','$tanggal','$waktu','$ruang','$tahun')");

header("Location: jadwal_pengambilan_toga.php");
//var_dump($query);
