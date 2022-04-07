<?php
session_start();
if ($_SESSION['level'] != "akademik") {
        header("location:login.php");
    }
include 'config.php';
$nama_kegiatan = $_POST['nama_kegiatan'];
$tanggal = $_POST['tanggal'];
$waktu= $_POST['waktu'];
$ruang = $_POST['ruang'];
$tahun = $_POST['tahun'];

$result = mysqli_query($mysqli, "INSERT INTO kegiatan(nama_kegiatan,tanggal,waktu,ruang,tahun,status) VALUES('$nama_kegiatan','$tanggal','$waktu','$ruang','$tahun','0')");

header("Location: jadwal_yudisium.php");
//var_dump($query);
