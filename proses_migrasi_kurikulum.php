<?php

include 'config.php';
$nim = $_POST['nim'];
$kurikulum_lama = $_POST['kurikulum_lama'];
$kurikulum_baru = $_POST['kurikulum_baru'];
$kdkonsen = $_POST['kdkonsen'];
$totip2 = "SELECT distinct(tr.KDKMKTRNLM) from trnlm tr, tbkmk tbk where tr.KDKMKTRNLM=tbk.KDKMKTBKMK AND tr.THSMSTRNLM<='$ta_lengkap' and tr.NIMHSTRNLM='$nim' and tr.KURIKULUM=tbk.KURIKULUM and tbk.KURIKULUM='$kurikulum_lama' order by tr.KDKMKTRNLM,tr.NLAKHTRNLM ASC";
$hasilip2 = mysqli_query($mysqli, $totip2);
while ($dataip2 = mysqli_fetch_array($hasilip2)) {
    $mk_lama = $dataip2["KDKMKTRNLM"];
    $kurikulum_tujuan = $_POST['kurikulum_baru'];

    $penilaian = "SELECT t.NLAKHTRNLM,t.BOBOTTRNLM,t.THSMSTRNLM,t.KDKMKTRNLM from trnlm t where t.NIMHSTRNLM='$nim' and t.KDKMKTRNLM='$mk_lama' and t.KURIKULUM='$kurikulum_lama' order by t.NLAKHTRNLM ASC LIMIT 0,1";
    $hasil_penilaian = mysqli_query($mysqli, $penilaian);
    $data_penilaian = mysqli_fetch_array($hasil_penilaian);
    $nilai2 = $data_penilaian["NLAKHTRNLM"];
    $bobot2 = $data_penilaian["BOBOTTRNLM"];
    $THSMSTRNLM = $data_penilaian["THSMSTRNLM"];
    $kode3 = $data_penilaian["KDKMKTRNLM"];

    $totmk2 = "SELECT m.SKSMKTBKMK,m.NAKMKTBKMK, m.NAKMKTBKMK_EN, m.KDKMKTBKMK from tbkmk m where m.KDKMKTBKMK='$kode3' and m.THSMSTBKMK='$THSMSTRNLM' and (kdkonsen='u' or kdkonsen='$kdkonsen') and m.KURIKULUM='$kurikulum_lama'";
    $hasilmk2 = mysqli_query($mysqli, $totmk2);
    $datamk2 = mysqli_fetch_array($hasilmk2);
    $sks2 = $datamk2["SKSMKTBKMK"];
    $kode_mk = $datamk2["KDKMKTBKMK"];
    $namamk = $datamk2["NAKMKTBKMK"];
    $namamk_en = $datamk2["NAKMKTBKMK_EN"];

    $mk = "SELECT * from konfersi_mata_kuliah where mk_lama='$kode_mk' and kurikulum_lama='$kurikulum_lama' and kurikulum_baru='$kurikulum_tujuan' and kdkonsen='$kdkonsen'";
    $mk_konversi = mysqli_query($mysqli, $mk);
    while ($data_mk = mysqli_fetch_array($mk_konversi)){
    $mk_lama = $data_mk['mk_lama'];
    $mk_baru = $data_mk['mk_baru'];
    $kurikulum_baru = $data_mk['kurikulum_baru'];
    $migrasi = "SELECT * from  trnlm where NIMHSTRNLM='$nim' and KDKMKTRNLM='$mk_baru' and THSMSTRNLM='$THSMSTRNLM'";
    $mk_migrasi = mysqli_query($mysqli, $migrasi);
    $count_migrasi = mysqli_num_rows($mk_migrasi);
    if ($count_migrasi == 0) {
        $sql_baru = "INSERT INTO trnlm (THSMSTRNLM, KDPTITRNLM, KDJENTRNLM, KURIKULUM, KDPSTTRNLM, NIMHSTRNLM, KDKMKTRNLM, MID, UAS, NLAKHTRNLM, BOBOTTRNLM, acc, ulang, MKASAL) VALUES ('$THSMSTRNLM', '054039', 'E', '$kurikulum_baru', '61401', '$nim', '$mk_baru', '', '', '$nilai2', '$bobot2', '0', 0, 0)";
        mysqli_query($mysqli, $sql_baru);
    }
    }
}
#trakm
$trakm = "SELECT * from trakm where NIMHSTRAKM='$nim'";
$hasil_trakm = mysqli_query($mysqli, $trakm);
while ($data_trakm = mysqli_fetch_array($hasil_trakm)) {
    $nim_trakm = $data_trakm['NIMHSTRAKM'];
    $ips_trakm = $data_trakm['NLIPSTRAKM'];
    $sks_sem = $data_trakm['SKSEMTRAKM'];
    $ipk_trakm = $data_trakm['NLIPKTRAKM'];
    $sks_total = $data_trakm['SKSTTTRAKM'];
    $bobottotal = $data_trakm['bobottotal'];
    $tahun_trakm = $data_trakm['THSMSTRAKM'];
    $kurikulum_trakm = $data_trakm['KURIKULUM'];
    $trakm_baru = "SELECT * from trakm where NIMHSTRAKM='$nim_trakm' and THSMSTRAKM='$tahun_trakm' and KURIKULUM='$kurikulum_baru'";
    $hasil_trakm_baru = mysqli_query($mysqli, $trakm_baru);
    $count_trakm_baru = mysqli_num_rows($hasil_trakm_baru);
    if($count_trakm_baru == 0){
        $sql_trakm_baru = "INSERT INTO trakm (THSMSTRAKM, KURIKULUM, KDPTITRAKM, KDJENTRAKM, KDPSTTRAKM, NIMHSTRAKM, NLIPSTRAKM, SKSEMTRAKM, NLIPKTRAKM, SKSTTTRAKM, bobottotal) VALUES ('$tahun_trakm', '$kurikulum_baru', '054039', 'E', '61401', '$nim', '$ips_trakm', '$sks_sem', '$ipk_trakm', '$sks_total', '$bobottotal')";
        mysqli_query($mysqli, $sql_trakm_baru);
    }
}
mysqli_query($mysqli, "UPDATE msmhs SET KURIKULUM='$kurikulum_baru' WHERE NIMHSMSMHS='$nim'");
header("Location: cetak_transkrip_sementara.php?ta=$ta_lengkap&nim=$nim");
