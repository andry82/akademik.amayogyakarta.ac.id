<?php
include '../config.php';
$result = mysqli_query($mysqli, "SELECT * FROM msmhs WHERE STMHSMSMHS='A' AND NIMHSMSMHS LIKE '1800%'");
$no = 1;
while ($data = mysqli_fetch_array($result)) { 
$nim = $data['NIMHSMSMHS'];
$result_sp = mysqli_query($mysqli_simakpro, "SELECT * FROM rtrkrs WHERE nimhstrkrs='$nim'");
while ($data_sp = mysqli_fetch_array($result_sp)) {
    $tahun = $data_sp['thsmstrkrs'];
    $kode_mk = $data_sp['kdkmktrkrs'];
    mysqli_query($mysqli, "INSERT INTO  trnlm(THSMSTRNLM,KDPTITRNLM,KDJENTRNLM,KDPSTTRNLM,NIMHSTRNLM,KDKMKTRNLM)VALUES('$tahun','54039','E','61401','$nim','$kode_mk')");
    ?>
<?php echo $data['NIMHSMSMHS']; ?> - <?php echo $data_sp['thsmstrkrs']; ?> - <?php echo $data_sp['kdkmktrkrs']; ?><br/>    
<?php }} ?>