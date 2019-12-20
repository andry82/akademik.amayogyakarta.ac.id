<?php
include 'config.php';
$nim = mysqli_real_escape_string($mysqli, $_POST['nim']);
$status = mysqli_real_escape_string($mysqli, $_POST['status']);
$catatan = mysqli_real_escape_string($mysqli, $_POST['catatan']);
//$result = mysqli_query($mysqli, "UPDATE ta SET pembimbing_pkl='$pembimbing_pkl',pembimbing='$pembimbing',catatan='$catatan',status='$status' WHERE nim='$nim'");
if ($_POST['status'] == 'false') {
    $ta_false = mysqli_query($mysqli, "SELECT * FROM ta WHERE nim='$nim' AND status='1'");
    while ($dfalse = mysqli_fetch_array($ta_false)) {
        $idfalse = $dfalse['id'];
        mysqli_query($mysqli, "UPDATE ta SET status='3' WHERE id='$idfalse'");
    }
    mysqli_query($mysqli, "UPDATE pendaftaran_ta SET status_judul='3', catatan='$catatan'  WHERE nim='$nim' AND tahun='$ta_lengkap'");
} else {
    $ta = mysqli_query($mysqli, "SELECT * FROM ta WHERE nim='$nim' AND status='1'");
    while ($d = mysqli_fetch_array($ta)) {
        $id = $d['id'];
        if ($status == $id) {
            mysqli_query($mysqli, "UPDATE ta SET status='2' WHERE id='$id'");
            mysqli_query($mysqli, "UPDATE pendaftaran_ta SET status_judul='2',  catatan='$catatan' WHERE nim='$nim' AND tahun='$ta_lengkap'");
        } else {
            mysqli_query($mysqli, "UPDATE ta SET status='3' WHERE id='$id'");
        }
    }
}
//redirectig to the display page. In our case, it is index.php
header("location:data_bimbingan_lta.php");
