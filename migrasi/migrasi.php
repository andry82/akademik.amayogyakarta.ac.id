<?php
include '../config.php';
$result = mysqli_query($mysqli, "SELECT * FROM msmhs");
while ($data = mysqli_fetch_array($result)) {
    $nim = $data['NIMHSMSMHS'];    
    $kurikulum = $data['KURIKULUM'];    
    #mysqli_query($mysqli, "UPDATE trakm SET KURIKULUM='$kurikulum' WHERE NIMHSTRAKM='$nim'");
    #mysqli_query($mysqli, "UPDATE trnlm SET KURIKULUM='$kurikulum' WHERE NIMHSTRNLM='$nim'");
    mysqli_query($mysqli, "UPDATE tmpkrs SET KURIKULUM='$kurikulum' WHERE nimhs='$nim'");
}
?>