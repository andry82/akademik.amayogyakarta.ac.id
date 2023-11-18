<?php

require_once "../config.php";

class Mahasiswa {

    public function get_mhss() {
        global $mysqli;
        $query = "SELECT m.KDPSTMSMHS,m.NIMHSMSMHS,m.NMMHSMSMHS,m.TPLHRMSMHS,m.KDJEKMSMHS,m.ALAMATLENGKAP,m.ALAMATYOGYA,m.TGLHRMSMHS,m.TELP,m.EMAIL,t.tgl_lulus,m.TAHUNMSMHS,m.kdkonsen,m.NIKEY,ta.judul_lta FROM msmhs m, transkrip t, pendaftaran_ta pta, ta ta WHERE ta.nim=pta.nim AND ta.status='2' AND pta.nim=t.nim AND t.nim=m.NIMHSMSMHS AND m.STMHSMSMHS='L'";
        $data = array();
        $result = $mysqli->query($query);
        while ($row = mysqli_fetch_object($result)) {
            $data[] = $row;
        }
        $response = array(
            'status' => 1,
            'message' => 'Get List Mahasiswa Successfully.',
            'data' => $data
        );
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function get_mhs($nim = 0) {
        global $mysqli;
        $query = "SELECT m.KDPSTMSMHS,m.NIMHSMSMHS,m.NMMHSMSMHS,m.TPLHRMSMHS,m.KDJEKMSMHS,m.ALAMATLENGKAP,m.ALAMATYOGYA,m.TGLHRMSMHS,m.TELP,m.EMAIL,t.tgl_lulus,m.TAHUNMSMHS,m.kdkonsen,m.NIKEY,ng.nia,ta.judul_lta FROM msmhs m, transkrip t, pendaftaran_ta pta, ta ta, nia_generate ng";
        if ($nim != 0) {
            $query .= " WHERE ng.nim=ta.nim AND ta.nim=pta.nim AND ta.status='2' AND pta.nim=t.nim AND t.nim=m.NIMHSMSMHS AND m.STMHSMSMHS='L' AND m.NIMHSMSMHS =" . $nim . " LIMIT 1";
        }
        $data = array();
        $result = $mysqli->query($query);
        $count = mysqli_num_rows($result);
        while ($row = mysqli_fetch_object($result)) {
            $data[] = $row;
        }
        $response = array(
            'status' => $count,
            'message' => 'Get Mahasiswa Successfully.',
            'data' => $data
        );
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function insert_mhs() {
        global $mysqli;
        $arrcheckpost = array('nim' => '', 'nama' => '', 'jk' => '', 'alamat' => '', 'jurusan' => '');
        $hitung = count(array_intersect_key($_POST, $arrcheckpost));
        if ($hitung == count($arrcheckpost)) {

            $result = mysqli_query($mysqli, "INSERT INTO tbl_mahasiswa SET
					nim = '$_POST[nim]',
					nama = '$_POST[nama]',
					jk = '$_POST[jk]',
					alamat = '$_POST[alamat]',
					jurusan = '$_POST[jurusan]'");

            if ($result) {
                $response = array(
                    'status' => 1,
                    'message' => 'Mahasiswa Added Successfully.'
                );
            } else {
                $response = array(
                    'status' => 0,
                    'message' => 'Mahasiswa Addition Failed.'
                );
            }
        } else {
            $response = array(
                'status' => 0,
                'message' => 'Parameter Do Not Match'
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function update_mhs($id) {
        global $mysqli;
        $arrcheckpost = array('nim' => '', 'nama' => '', 'jk' => '', 'alamat' => '', 'jurusan' => '');
        $hitung = count(array_intersect_key($_POST, $arrcheckpost));
        if ($hitung == count($arrcheckpost)) {

            $result = mysqli_query($mysqli, "UPDATE tbl_mahasiswa SET
		        nim = '$_POST[nim]',
		        nama = '$_POST[nama]',
		        jk = '$_POST[jk]',
		        alamat = '$_POST[alamat]',
		        jurusan = '$_POST[jurusan]'
		        WHERE id='$id'");

            if ($result) {
                $response = array(
                    'status' => 1,
                    'message' => 'Mahasiswa Updated Successfully.'
                );
            } else {
                $response = array(
                    'status' => 0,
                    'message' => 'Mahasiswa Updation Failed.'
                );
            }
        } else {
            $response = array(
                'status' => 0,
                'message' => 'Parameter Do Not Match'
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function delete_mhs($id) {
        global $mysqli;
        $query = "DELETE FROM tbl_mahasiswa WHERE id=" . $id;
        if (mysqli_query($mysqli, $query)) {
            $response = array(
                'status' => 1,
                'message' => 'Mahasiswa Deleted Successfully.'
            );
        } else {
            $response = array(
                'status' => 0,
                'message' => 'Mahasiswa Deletion Failed.'
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

}

?>