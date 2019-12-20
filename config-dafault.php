<?php
$databaseHost_1 = 'localhost';
$databaseName_1 = 'amaypk_siakad';
$databaseUsername_1 = 'root';
$databasePassword_1 = 'root';
$mysqli = mysqli_connect($databaseHost_1, $databaseUsername_1, $databasePassword_1, $databaseName_1); 

$databaseHost_2 = 'localhost';
$databaseName_2 = 'amaypk_simpus';
$databaseUsername_2 = 'root';
$databasePassword_2 = 'root';
$mysqli_simpus = mysqli_connect($databaseHost_2, $databaseUsername_2, $databasePassword_2, $databaseName_2); 

$aturan = mysqli_query($mysqli, "select * from config");
            $dataaturan = mysqli_fetch_array($aturan);
            $ta_lengkap = $dataaturan['tahun'];
            $ta = substr($ta_lengkap, 0, 4);
            $smtgg = substr($ta_lengkap, 4, 1);
?>
