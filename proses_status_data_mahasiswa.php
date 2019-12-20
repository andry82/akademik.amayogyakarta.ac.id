<?php
include 'config.php';
$nim = $_GET['nim'];
$status_data = $_GET['status_data'];
$tanggal = date('d-m-Y H:i:s');
if($status_data == '0'){
    mysqli_query($mysqli, "UPDATE msmhs SET tgl_update='', STATUSDATA='$status_data' WHERE NIMHSMSMHS='$nim'");
}elseif($status_data == '1'){
    mysqli_query($mysqli, "UPDATE msmhs SET tgl_update='', STATUSDATA='$status_data' WHERE NIMHSMSMHS='$nim'");
}elseif($status_data == '2'){
    mysqli_query($mysqli, "UPDATE msmhs SET tgl_update='', STATUSDATA='$status_data' WHERE NIMHSMSMHS='$nim'");
}elseif($status_data == '3'){
    mysqli_query($mysqli, "UPDATE msmhs SET tgl_update='$tanggal', STATUSDATA='$status_data' WHERE NIMHSMSMHS='$nim'");
}

//$result = mysqli_query($mysqli, "UPDATE ta SET pembimbing_pkl='$pembimbing_pkl',pembimbing='$pembimbing',catatan='$catatan',status='$status' WHERE nim='$nim'");
//redirectig to the display page. In our case, it is index.php
header("location: detail_mahasiswa.php?nim=$nim");

