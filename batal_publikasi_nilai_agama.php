<?php
session_start();
include('bar128.php');
include 'config.php';
// cek apakah yang mengakses halaman ini sudah login
if ($_SESSION['level'] == "") {
    header("location:login.php");
}
$kdmk = $_GET['kodemk'];
$kelas = $_GET['kelas'];
$nodos = $_GET['nodos'];
$res = mysqli_query($mysqli, "SELECT * FROM trnlm t, msmhs m, kelasparalel_mhs k WHERE t.NIMHSTRNLM=m.NIMHSMSMHS AND t.NIMHSTRNLM=k.nimhs AND t.THSMSTRNLM='$ta_lengkap' AND t.KDKMKTRNLM='$kdmk' AND nmkelas like '$kelas%'");
while ($data = mysqli_fetch_array($res)) {
    $nim = $data['NIMHSTRNLM'];
    $nilai = $data['NILAI'];
    $bobot = $data['BOBOT'];
    mysqli_query($mysqli, "UPDATE  trnlm SET NLAKHTRNLM='', BOBOTTRNLM='' WHERE NIMHSTRNLM='$nim' AND KDKMKTRNLM='$kdmk'AND THSMSTRNLM='$ta_lengkap'"); 
}
$dp = mysqli_query($mysqli, "SELECT * FROM dosen_pengajar WHERE KDMK='$kdmk' AND THSMS='$ta_lengkap' AND KLSMHS like '$kelas%'");

while ($datadp = mysqli_fetch_array($dp)) {
    mysqli_query($mysqli, "UPDATE dosen_pengajar SET PUBNILAI='0' WHERE KDMK='$kdmk' AND THSMS='$ta_lengkap' AND KLSMHS like '$kelas%'");
    }
header("Location: data_mata_kuliah.php?nodos=$nodos");