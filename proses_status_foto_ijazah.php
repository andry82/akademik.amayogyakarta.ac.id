<?php

session_start();
include('bar128.php');
include 'config.php';
if ($_GET['nim'] != "") {
    $nim = $_GET['nim'];
    $status = $_GET['status'];
    mysqli_query($mysqli, "UPDATE pendaftaran_ta SET status_foto_ijazah='$status' WHERE nim='$nim'");
} elseif ($_POST['nim'] != "") {
    $nim = $_POST['nim'];
    $status = $_POST['status'];
    $notifikasi = $_POST['notifikasi'];
    mysqli_query($mysqli, "UPDATE pendaftaran_ta SET notif_foto_ijazah='$notifikasi', status_foto_ijazah='$status' WHERE nim='$nim'");
}
header("Location: data_foto_ijazah.php");

