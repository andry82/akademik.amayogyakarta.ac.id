<?php

session_start();
include('bar128.php');
include 'config.php';
// cek apakah yang mengakses halaman ini sudah login
if ($_SESSION['level'] == "") {
    header("location:login.php");
}
$nomor_dosen = $_SESSION['nomor_dosen'];
$agama = mysqli_query($mysqli, "SELECT KODE FROM dosen_agama WHERE NODOS='$nomor_dosen'");
$dt_agama = mysqli_fetch_array($agama);
$kode_agama = $dt_agama['KODE'];

$kdmk = $_GET['kodemk'];
$kelas = $_GET['kelas'];
$res = mysqli_query($mysqli, "SELECT * FROM trnlm t, msmhs m, kelasparalel_mhs k WHERE t.NIMHSTRNLM=m.NIMHSMSMHS AND t.NIMHSTRNLM=k.nimhs AND t.THSMSTRNLM='$ta_lengkap' AND t.KDKMKTRNLM='$kdmk' AND m.AGAMA='$kode_agama'");
while ($data = mysqli_fetch_array($res)) {
    $nim = $data['NIMHSTRNLM'];
    $nilai = $data['NILAI'];
    $bobot = $data['BOBOT'];
    mysqli_query($mysqli, "UPDATE  trnlm SET NLAKHTRNLM='$nilai', BOBOTTRNLM='$bobot' WHERE NIMHSTRNLM='$nim' AND KDKMKTRNLM='$kdmk'");
}
$dp = mysqli_query($mysqli, "SELECT * FROM dosen_pengajar WHERE KDMK='$kdmk' AND KLSMHS like '$kelas%'");
//header("Location: data_mata_ajar.php");
while ($datadp = mysqli_fetch_array($dp)) {
    mysqli_query($mysqli, "UPDATE dosen_pengajar SET PUBNILAI='1' WHERE KDMK='$kdmk' AND THSMS='$ta_lengkap' AND KLSMHS like '$kelas%'");
}
header("Location: data_mata_kuliah.php");
