<?php
include_once("config.php");
$nim = $_GET['nim'];
$result = mysqli_query($mysqli, "UPDATE msmhs SET login_pass='123456' WHERE NIMHSMSMHS=$nim");
if (!empty($result));{
header("Location: mahasiswa.php");
}
?>
