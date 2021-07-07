<?php
session_start();
include 'config.php';

$password= md5($_POST['password']);
$username=addslashes(trim($_POST['username']));

$login = mysqli_query($mysqli, "select * from siakad_admin where passwd='$password' and username='$username'");
$cek = mysqli_num_rows($login);
 while ($d = mysqli_fetch_array($login)) {
    $level_access = $d['level'];
 }
if ($cek > 0) {
    session_start();
    $_SESSION['level'] = $level_access;
    header("location:index.php");
} else { 
    header("location:login.php");
}
?>
