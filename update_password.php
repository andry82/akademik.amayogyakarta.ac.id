<?php
include 'config.php';
$nodos = $_POST['nodos'];
$pawd = $_POST['password'];
$pawdlg = $_POST['password_lagi'];
if (empty($pawd) || empty($pawdlg)) {
    echo "Tidak Boleh Kosong";
} elseif (($pawd) != ($pawdlg)) {
    echo "Password Baru dan Password Baru Lagi tidak sama";
} else {
    $password_baru = md5($pawd);
    $query = "UPDATE msdos SET LOGPASWD='$password_baru' WHERE NODOSMSDOS='$nodos'";
    $sql = mysqli_query($mysqli, $query);
    if ($sql) {
        echo "Password berhasil di Update";
    }
}
header("Location: ganti_password.php");
