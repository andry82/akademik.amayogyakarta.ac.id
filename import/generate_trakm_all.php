<?php
session_start();
include '../config.php';
$nim = $_GET['nim'];
$nilai = mysqli_query($mysqli, "SELECT DISTINCT(THSMSTRNLM) FROM  trnlm WHERE NIMHSTRNLM='$nim'");
while ($data = mysqli_fetch_array($nilai)) { 
    $tahun = $data['THSMSTRNLM']; 
    $trakm = mysqli_query($mysqli, "SELECT * FROM trakm WHERE NIMHSTRAKM='$nim' AND THSMSTRAKM='$tahun'");
    $count = mysqli_num_rows($trakm);
    if ($count==0){
        mysqli_query($mysqli, "INSERT INTO  trakm(THSMSTRAKM,KDPTITRAKM,KDJENTRAKM,NIMHSTRAKM)VALUES('$tahun','54039','E','$nim')");
    }
?>
    <?php echo $tahun; ?> - <?php echo $text; ?><br/>
<?php   
} 
header("Location: ../data_bimbingan_krs.php?nim=$nim");
