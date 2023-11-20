 <?php

include 'config.php';
$nim = $_GET['nim'];
$datetime = date('d-m-Y H:i:s');
mysqli_query($mysqli, "UPDATE pendaftaran_wisuda SET pengambilan_toga='$datetime' WHERE nim='$nim' AND tahun='$ta'");
mysqli_query($mysqli, "UPDATE msmhs SET STMHSMSMHS='L' WHERE NIMHSMSMHS='$nim'");
$generate = mysqli_query($mysqli, "SELECT n.id, n.nim, m.TAHUNMSMHS, k.tanggal FROM nia_generate n,  pendaftaran_yudisium  py, kegiatan k, msmhs m WHERE py.kegiatan_id=k.id AND m.NIMHSMSMHS=py.nim AND py.nim=n.nim AND n.nim='$nim'");
$count = mysqli_num_rows($generate);
$data_nia = mysqli_fetch_array($generate);
if ($count == 1) {  
  $nim = $data_nia['nim'];
  $tanggal_lulus = $data_nia['tanggal'];
  $tahun_msk = $data_nia['TAHUNMSMHS'];
  $bulan = date('m', strtotime($tanggal_lulus));
  $tahun = date('y', strtotime($tanggal_lulus));
  $tahun_masuk = substr($tahun_msk, -2);
  $nim_empat = substr($nim, -4);
  $bulan_tahun_lulus = $bulan . $tahun;
  $nomor_urut = sprintf("%04d", $data_nia['id']);
  $nia = $tahun_masuk . '.' . $nim_empat . '.' . $bulan_tahun_lulus . '.' . ($nomor_urut + 6632);
  mysqli_query($mysqli, "UPDATE nia_generate SET nia='$nia' WHERE nim='$nim'");
}
header("location: presensi_toga.php");
