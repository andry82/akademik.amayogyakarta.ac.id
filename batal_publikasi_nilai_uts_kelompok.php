<?php

session_start();
include('bar128.php');
include 'config.php';
$id_dk = $_GET['id'];
$kodemk = $_GET['kodemk'];
$kelompok = $_GET['kelompok'];
$kelas = $_GET['kelas'];
$ta = $_GET['ta'];
$nodos = $_GET['nodos'];

$data_dk = mysqli_query($mysqli, "SELECT * FROM dosen_kelompok WHERE KDMK='$kodemk' AND KLSMHS='$kelas' AND KLPKMHS='$kelompok' AND NODOS='$nodos' AND THSMS='$ta_lengkap' AND id='$id_dk'");
$dt_kelompok = mysqli_fetch_array($data_dk);
$id_kelompok = $dt_kelompok['id'];

$data_kk = mysqli_query($mysqli, "SELECT * FROM kelompok_komputer kk, trnlm tr WHERE tr.NIMHSTRNLM=kk.nims AND kk.dosen_kelompok_id ='$id_kelompok' AND tr.KDKMKTRNLM ='$kodemk'");
while ($data = mysqli_fetch_array($data_kk)) {
    $nim = $data['NIMHSTRNLM'];
    mysqli_query($mysqli, "UPDATE  trnlm SET NMID='0' WHERE NIMHSTRNLM='$nim' AND KDKMKTRNLM='$kodemk'");
}
mysqli_query($mysqli, "UPDATE dosen_kelompok SET PUBUTS='0' WHERE id='$id_kelompok'");

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

header("Location: data_kelompok.php?kodemk=$kodemk&kelas=$kelas&ta=$ta&nodos=$nodos");

