<?php
include 'config.php';
$nim = $_POST['nim'];
$kelas = $_POST['KELAS'];
$skelas = explode("/", $kelas);
$kede_jurusan = $skelas[1];
if ($kelas!=""){
   $result = mysqli_query($mysqli, "UPDATE  kelasparalel_mhs SET nmkelas='$kelas' WHERE nimhs='$nim'");
   $result = mysqli_query($mysqli, "UPDATE  msmhs SET kdkonsen='$kede_jurusan' WHERE NIMHSMSMHS='$nim'");
}
header("Location: detail_mahasiswa.php?nim=$nim");
?>
