<?php
include 'config.php';
$matalkuliah = mysqli_query($mysqli, "SELECT DISTINCT KDKMKTRNLM, NIMHSTRNLM FROM trnlm  WHERE NIMHSTRNLM='$nim' ORDER BY KDKMKTRNLM ASC");
$nomor=1;
while ($data_matakuliah = mysqli_fetch_array($matalkuliah)) {
    $nim_id = trim($data_matakuliah['NIMHSTRNLM']);
    $kode_matkul = $data_matakuliah['KDKMKTRNLM'];
    $result = mysqli_query($mysqli, "SELECT * FROM trnlm WHERE NIMHSTRNLM='$nim_id' AND KDKMKTRNLM='$kode_matkul' ORDER BY BOBOTTRNLM DESC LIMIT 0,1");
    $data_matkul = mysqli_fetch_array($result);
    
    if($data_matkul['NLAKHTRNLM']=='A'){
        $nilai_a[$nim_id][] = 1;
    }
    if($data_matkul['NLAKHTRNLM']=='B'){
        $nilai_b[$nim_id][] = 1;
    }
    if($data_matkul['NLAKHTRNLM']=='C'){
        $nilai_c[$nim_id][] = 1;
    }
    if($data_matkul['NLAKHTRNLM']=='D'){
        $nilai_d[$nim_id][] = 1;
    }
    if($data_matkul['NLAKHTRNLM']=='E'){
        $nilai_e[$nim_id][] = 1;
    }
    if($data_matkul['NLAKHTRNLM']==''){
        $nilai_kosong[$nim_id][] = 1;
    }    
}
$rekap_nilai_a[$nim_id] = array_sum($nilai_a[$nim_id]);
$rekap_nilai_b[$nim_id] = array_sum($nilai_b[$nim_id]);
$rekap_nilai_c[$nim_id] = array_sum($nilai_c[$nim_id]);
$rekap_nilai_d[$nim_id] = array_sum($nilai_d[$nim_id]);
$rekap_nilai_e[$nim_id] = array_sum($nilai_e[$nim_id]);
$rekap_nilai_k[$nim_id] = array_sum($nilai_kosong[$nim_id]);

$rekapitulasi[$nim_id] = mysqli_query($mysqli, "SELECT * FROM rekapitulasi_nilai WHERE nim='$nim_id'");
$count_rekap[$nim_id] = mysqli_num_rows($rekapitulasi[$nim_id]);
$data_rekapitulasi = mysqli_fetch_array($rekapitulasi[$nim_id]);
if($count_rekap[$nim_id]==0){
    mysqli_query($mysqli, "INSERT INTO rekapitulasi_nilai(nim,nilai_a,nilai_b,nilai_c,nilai_d,nilai_e,nilai_k) VALUES('$nim_id','$rekap_nilai_a[$nim_id]','$rekap_nilai_b[$nim_id]','$rekap_nilai_c[$nim_id]','$rekap_nilai_d[$nim_id]','$rekap_nilai_e[$nim_id]','$rekap_nilai_k[$nim_id]')");
}else{
    mysqli_query($mysqli, "UPDATE rekapitulasi_nilai SET nilai_a='$rekap_nilai_a[$nim_id]', nilai_b='$rekap_nilai_b[$nim_id]', nilai_c='$rekap_nilai_c[$nim_id]', nilai_d='$rekap_nilai_d[$nim_id]', nilai_e='$rekap_nilai_e[$nim_id]', nilai_k='$rekap_nilai_k[$nim_id]' WHERE nim='$nim_id'");      
}
