<?php

include 'config.php';
$nim = $_GET['nim'];
$aturan = mysqli_query($mysqli, "select * from config");
$dataaturan = mysqli_fetch_array($aturan);
$tahunajar = $dataaturan['tahun'];
$status = mysqli_query($mysqli, "SELECT * FROM statusmhs WHERE nim=$nim AND tahun=$ta_lengkap");
$count_status = mysqli_num_rows($status);

if ($_GET['status_akademik'] == '1') {
    mysqli_query($mysqli, "UPDATE msmhs SET STMHSMSMHS='A', STTHLULUS='' WHERE NIMHSMSMHS='$nim'");
    if ($count_status == 1) {
        mysqli_query($mysqli, "UPDATE statusmhs SET STATUS='A' WHERE nim=$nim AND tahun=$ta_lengkap");
    }
} elseif ($_GET['status_akademik'] == '2') {
    mysqli_query($mysqli, "UPDATE msmhs SET STMHSMSMHS='L', STTHLULUS='$tahunajar' WHERE NIMHSMSMHS='$nim'");
} elseif ($_GET['status_akademik'] == '3') {
    mysqli_query($mysqli, "UPDATE msmhs SET STMHSMSMHS='K', STTHLULUS='' WHERE NIMHSMSMHS='$nim'");
} elseif ($_GET['status_akademik'] == '4') {
    mysqli_query($mysqli, "UPDATE msmhs SET STMHSMSMHS='C', STTHLULUS='' WHERE NIMHSMSMHS='$nim'");
    if ($count_status == 1) {
        mysqli_query($mysqli, "UPDATE statusmhs SET STATUS='C', tglaktifasi='', tglkrs='', tglacc='', tglrekap='', tglmid='', tgluas='', terlambat='' WHERE nim=$nim AND tahun=$ta_lengkap");
        mysqli_query($mysqli, "UPDATE  trakm SET NLIPSTRAKM='', SKSEMTRAKM='', NLIPKTRAKM='', SKSTTTRAKM='', nodos='', sksmaks='', bobottotal='', piutang='' WHERE NIMHSTRAKM=$nim AND THSMSTRAKM=$ta_lengkap");
        mysqli_query($mysqli, "DELETE FROM trnlm where NIMHSTRNLM='$nim' and THSMSTRNLM='$ta_lengkap'");
        mysqli_query($mysqli, "DELETE FROM tmpkrs where nimhs='$nim' and thsms='$ta_lengkap'");
       
    }
}

//$result = mysqli_query($mysqli, "UPDATE ta SET pembimbing_pkl='$pembimbing_pkl',pembimbing='$pembimbing',catatan='$catatan',status='$status' WHERE nim='$nim'");
//redirectig to the display page. In our case, it is index.php
header("location: detail_mahasiswa.php?nim=$nim");

