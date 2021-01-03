<?php
include '../config.php';
$nim = $_GET['nim'];
$result = mysqli_query($mysqli, "SELECT * FROM msmhs WHERE STMHSMSMHS='A' AND NIMHSMSMHS='$nim'");
$no = 1;
while ($data = mysqli_fetch_array($result)) { 
$nama = $data['NMMHSMSMHS'];
//SELECT *  FROM `rtrkrs` WHERE `thsmstrkrs` LIKE '20192' AND `nimhstrkrs` LIKE '%17003301%'
$result_sp = mysqli_query($simakpro, "SELECT * FROM rtrkrs  WHERE nimhstrkrs LIKE '$nim%'");
while ($data_sp = mysqli_fetch_array($result_sp)) {
    $tahun = $data_sp['thsmstrkrs'];
    $kode_mk = $data_sp['kdkmktrkrs'];
    $trnlm = mysqli_query($mysqli, "SELECT * FROM trnlm WHERE KDKMKTRNLM='$kode_mk' AND THSMSTRNLM='$tahun' AND NIMHSTRNLM LIKE '$nim%'");
    $data_trnlm = mysqli_fetch_array($trnlm);
    $count_trnlm = mysqli_num_rows($trnlm);
    if ($count_trnlm==0){
    mysqli_query($mysqli, "INSERT INTO  trnlm(THSMSTRNLM,KDPTITRNLM,KDJENTRNLM,KDPSTTRNLM,NIMHSTRNLM,KDKMKTRNLM)VALUES('$tahun','54039','E','61401','$nim','$kode_mk')");
?>
<?php 
    echo $data_trnlm['KDKMKTRNLM']; ?> - <?php echo $data['NIMHSMSMHS']; ?> - <?php echo $data_sp['thsmstrkrs']; ?> - <?php echo $data_sp['kdkmktrkrs']; ?><br/>    
<?php }}} 
header("Location: ../data_bimbingan_krs.php?nim=$nim");