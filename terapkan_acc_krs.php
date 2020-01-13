<?php
session_start();
include 'config.php';
$nim = $_GET['nim'];
mysqli_query($mysqli, "UPDATE statusmhs SET  tglacc='', tglrekap='' where nim='$nim' and tahun='$ta_lengkap'");
$trnlm = mysqli_query($mysqli, "SELECT * FROM  trnlm WHERE THSMSTRNLM='$ta_lengkap' AND NIMHSTRNLM='$nim'");
$trnlmcount = mysqli_num_rows($trnlm);
if ($trnlmcount > 0) {
    $dateletrnlm = mysqli_query($mysqli, "DELETE FROM trnlm where NIMHSTRNLM='$nim' and THSMSTRNLM='$ta_lengkap'");
    $dateletrakm = mysqli_query($mysqli, "DELETE FROM trakm where THSMSTRAKM='$ta_lengkap' and NIMHSTRAKM='$nim'");
    $dateleta = mysqli_query($mysqli, "DELETE FROM pendaftaran_ta where tahun='$ta_lengkap' AND nim='$nim'");
    
} elseif ($trnlmcount == 0) {
    $no = 0;
    $tmpkrs = mysqli_query($mysqli, "SELECT * FROM  tmpkrs WHERE thsms='$ta_lengkap' AND nimhs='$nim'");
    while ($datatmpkrs = mysqli_fetch_array($tmpkrs)) {
        $urut_nim = $no + 1;
        $nimhs = $datatmpkrs['nimhs'];
        $kodemk = $datatmpkrs['kdkmk'];
        $sql = "INSERT INTO trnlm (THSMSTRNLM, KDPTITRNLM, KDJENTRNLM, KDPSTTRNLM, NIMHSTRNLM, KDKMKTRNLM, MID, UAS, NLAKHTRNLM, BOBOTTRNLM, acc, ulang, MKASAL) VALUES ('$ta_lengkap', '054039', 'E', '61401', '$nim', '$kodemk', '', '', '', 0.00, '0', 0, 0)";
        mysqli_query($mysqli, $sql);
        $pembimbing = mysqli_query($mysqli, "SELECT pembimbing_1,pembimbing_2,pembimbing_aktif FROM  ploting_pembimbing_ta WHERE nim='$nim'");
        $datapembimbing = mysqli_fetch_array($pembimbing);
        if ($kodemk == MKB373) {
            $pembimbing_1 = trim($datapembimbing['pembimbing_1']);
            $pembimbing_2 = trim($datapembimbing['pembimbing_2']);
            $pembimbing_aktif = trim($datapembimbing['pembimbing_aktif']);
            $tanggal = date('Y-m-d H:i:s');
            $result = mysqli_query($mysqli, "INSERT INTO pendaftaran_ta(nim,tahun,tanggal,pembimbing_1,pembimbing_2,pembimbing_active) VALUES('$nim','$ta','$tanggal','$pembimbing_1','$pembimbing_2','$pembimbing_aktif')");
        }
        $no++;
    }
    $waktu = date("d-m-Y H:i:s");
    mysqli_query($mysqli, "UPDATE statusmhs SET  tglacc='$waktu', tglrekap='$waktu' where nim='$nim' and tahun='$ta_lengkap'");
    $trakm = "INSERT INTO `trakm` (`THSMSTRAKM`, `KDPTITRAKM`, `KDJENTRAKM`, `KDPSTTRAKM`, `NIMHSTRAKM`, `NLIPSTRAKM`, `SKSEMTRAKM`, `NLIPKTRAKM`, `SKSTTTRAKM`, `nodos`, `sksmaks`, `bobottotal`) VALUES
('$ta_lengkap', '054039', 'E', '', '$nim', 0.00, 0, 0.00, 0, '', NULL, 0.00)";
    mysqli_query($mysqli, $trakm);
    
    }
header("location: data_bimbingan_krs.php?nim=$nim");

