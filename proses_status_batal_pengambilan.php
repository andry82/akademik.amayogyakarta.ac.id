<?php

include 'config.php';
$nim = $_GET['nim'];
$datetime = date('d-m-Y H:i:s');
mysqli_query($mysqli, "UPDATE pendaftaran_wisuda SET pengambilan_toga='' WHERE nim='$nim' AND tahun='$ta'");
header("location: presensi_toga.php");
