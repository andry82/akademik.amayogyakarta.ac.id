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
$nodos= $_GET['nodos'];
$res = mysqli_query($mysqli, "SELECT * FROM trnlm t, msmhs m, kelasparalel_mhs k WHERE t.NIMHSTRNLM=m.NIMHSMSMHS AND t.NIMHSTRNLM=k.nimhs AND t.THSMSTRNLM='$ta_lengkap' AND t.KDKMKTRNLM='$kdmk' AND nmkelas like '$kelas%'");
while ($data = mysqli_fetch_array($res)) {
    $id = $data['id'];
    $nim = $data['NIMHSTRNLM'];
    $nilai = $data['MID'];
    mysqli_query($mysqli, "UPDATE trnlm SET NMID='$nilai' WHERE NIMHSTRNLM='$nim' AND KDKMKTRNLM='$kdmk' AND THSMSTRNLM='$ta_lengkap' AND id='$id'"); 
    ?>
<?php
}
$dp = mysqli_query($mysqli, "SELECT * FROM dosen_pengajar WHERE KDMK='$kdmk' AND THSMS='$ta_lengkap' AND KLSMHS like '$kelas%'");
//header("Location: data_mata_ajar.php");
while ($datadp = mysqli_fetch_array($dp)) {
    mysqli_query($mysqli, "UPDATE dosen_pengajar SET PUBUTS='1' WHERE KDMK='$kdmk' AND THSMS='$ta_lengkap' AND KLSMHS like '$kelas%'");
}
header("Location: data_mata_kuliah.php?nodos=$nodos");
