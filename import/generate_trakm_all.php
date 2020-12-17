<?php
session_start();
include '../config.php';
$nilai = mysqli_query($mysqli, "SELECT * FROM  trnlm WHERE NIMHSTRNLM LIKE '1800%'");
while ($data = mysqli_fetch_array($nilai)) { 
    $tahun = $data['THSMSTRNLM']; 
    $nim = $data['NIMHSTRNLM']; 
    $trakm = mysqli_query($mysqli, "SELECT * FROM trakm WHERE NIMHSTRAKM='$nim' AND THSMSTRAKM='$tahun'");
    $count = mysqli_num_rows($trakm);
    if ($count==0){
        #mysqli_query($mysqli, "INSERT INTO  trakm(THSMSTRAKM,KDPTITRAKM,KDJENTRAKM,NIMHSTRAKM)VALUES('$tahun','54039','E','$nim')");
    
?>
    <?php echo $tahun; ?> - <?php echo $nim; ?><br/>
<?php }}
