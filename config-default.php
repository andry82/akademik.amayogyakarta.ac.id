<?php
$databaseHost = 'localhost';
$databaseName = '';
$databaseUsername = '';
$databasePassword = '';
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
$pdo = new PDO('mysql:host='.$databaseHost.';dbname='.$databaseName, $databaseUsername, $databasePassword);
$aturan = mysqli_query($mysqli, "select * from config");
            $dataaturan = mysqli_fetch_array($aturan);
            $ta_lengkap = $dataaturan['tahun'];
            $ta = substr($ta_lengkap, 0, 4);
            $smtgg = substr($ta_lengkap, 4, 1);
$url_documet_wisuda = "http://sintama.amayogyakarta.ac.id";
?>
