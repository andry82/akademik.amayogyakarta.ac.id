<?php
require_once "method_alumni.php";
$mhs = new Mahasiswa();
$request_method = $_SERVER["REQUEST_METHOD"];
switch ($request_method) {
    case 'GET':
        if (!empty($_GET["nim"])) {
            $nim = intval($_GET["nim"]);
            $mhs->get_mhs($nim);
        } else {
            $mhs->get_mhss();
        }
        break;
    case 'POST':
        if (!empty($_GET["nim"])) {
            $nim = intval($_GET["nim"]);
            $mhs->update_mhs($nim);
        } else {
            $mhs->insert_mhs();
        }
        break;
    case 'DELETE':
        $nim = intval($_GET["nim"]);
        $mhs->delete_mhs($nim);
        break;
    default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
        break;
}
?>