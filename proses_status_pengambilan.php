<?php

include 'config.php';
$nim = $_GET['nim'];
$datetime = date('d-m-Y H:i:s');
mysqli_query($mysqli, "UPDATE pendaftaran_wisuda SET pengambilan_toga='$datetime' WHERE nim='$nim' AND tahun='$ta'");
mysqli_query($mysqli, "UPDATE msmhs SET STMHSMSMHS='L' WHERE NIMHSMSMHS='$nim'");
$tanggal_lulus = $dataaturan['tgl_lulus'];
$generate = mysqli_query($mysqli, "SELECT * FROM nia_generate WHERE nim='$nim' AND tgl_lulus='$tanggal_lulus'");
$count = mysqli_num_rows($generate);
if ($count == 0) {  
  $bulan = date('m', strtotime($tanggal_lulus));
  $tahun = date('y', strtotime($tanggal_lulus));
  $tahun_masuk = substr($nim, 0, 2);
  $nim_empat = substr($nim, -4);
  $bulan_tahun_lulus = $bulan . $tahun;
  mysqli_query($mysqli, "INSERT INTO nia_generate(tgl_lulus,nim) VALUES('$tanggal_lulus','$nim')");
  $nomor_urut = sprintf("%04d", mysqli_insert_id($mysqli));
  $nia = $tahun_masuk . '.' . $nim_empat . '.' . $bulan_tahun_lulus . '.' . ($nomor_urut + 6632);
  mysqli_query($mysqli, "UPDATE nia_generate SET nia='$nia' WHERE nim='$nim' AND tgl_lulus='$tanggal_lulus'");
}
header("location: presensi_toga.php");
