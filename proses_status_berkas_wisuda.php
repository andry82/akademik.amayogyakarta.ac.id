<?php
include 'config.php';
if ($_GET['status'] == 2 OR $_GET['status'] == 0) {
    $status = $_GET['status'];
    $nim = $_GET['nim'];
    $keycode = MD5($nim);
    mysqli_query($mysqli, "UPDATE pendaftaran_wisuda SET pesan_revisi='', status='$status', keycode='$keycode' WHERE nim='$nim' AND tahun='$ta'");
}
if ($_POST['status'] == 1) {
    $status = $_POST['status'];
    $nim = $_POST['nim'];
    $content = $_POST['content'];
    $keycode = MD5($nim);
    mysqli_query($mysqli, "UPDATE pendaftaran_wisuda SET pesan_revisi='$content', status='$status', keycode='$keycode' WHERE nim='$nim' AND tahun='$ta'");    
}
header("location: detail_pendaftaran_wisuda.php?nim=$nim");
