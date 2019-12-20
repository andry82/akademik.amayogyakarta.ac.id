<?php
session_start();
include 'config.php';
$nomor_dosen = $_SESSION['nomor_dosen'];
$nama_dosen = $_POST['NMDOSMSDOS'];
$gelar_dosen = $_POST['GELARMSDOS'];
$tempat_lahir = $_POST['TPLHRMSDOS'];
$tgl_lahir = $_POST['TGLHRMSDOS'];
$result = mysqli_query($mysqli, "UPDATE msdos SET NMDOSMSDOS='$nama_dosen', GELARMSDOS='$gelar_dosen', TPLHRMSDOS='$tempat_lahir', TGLHRMSDOS='$tgl_lahir' WHERE NODOSMSDOS='$nomor_dosen'");
header("Location: profile.php");
?>
