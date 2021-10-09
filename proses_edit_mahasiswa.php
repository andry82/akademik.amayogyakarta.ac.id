<?php
include 'config.php';
$keterangan_revisi = $_POST['KET_REV'];
$nik = $_POST['NIKMSMHS'];
$nim = $_POST['NIMHSMSMHS'];
$nama = addslashes($_POST['NMMHSMSMHS']);
$tplahir = addslashes($_POST['TPLHRMSMHS']);
$tgllahir = date('Y-m-d', strtotime($_POST['TGLHRMSMHS']));
$agama = $_POST['AGAMA'];
$alamat_sekarang = addslashes($_POST['ALAMATYOGYA']);
$alamat_lengkap = addslashes($_POST['ALAMATLENGKAP']);
$jenis_tinggal = addslashes($_POST['JENISTINGGAL']);
$jalan = addslashes($_POST['JALAN']);
$rtrw = addslashes($_POST['RTRW']);
$dusun = addslashes($_POST['DUSUN']);
$kelurahan = addslashes($_POST['KELURAHAN']);
$kecamatan = addslashes($_POST['KECAMATAN_EKSPORT']);
$kabupaten = addslashes($_POST['KABUPATEN_EKSPORT']);
$kewarganegaraan = addslashes($_POST['KEWARGANEGARAAN']);
$nokps = addslashes($_POST['NOKPS']);
$propinsi = addslashes($_POST['PROPINSI_EKSPORT']);
$jenis_kelamin = addslashes($_POST['KDJEKMSMHS']);
$telp = addslashes($_POST['TELP']);
$email = addslashes($_POST['EMAIL']);
$twiter = addslashes($_POST['TWITTER']);
$instagram = addslashes($_POST['INSTAGRAM']);
$facebook= addslashes($_POST['FACEBOOK']);
$asal_sekolah = addslashes($_POST['ASAl_SEKOLAH']);
$hobi = addslashes($_POST['HOBI']);
$keahlian = addslashes($_POST['KEAHLIAN']);
$nikayah = addslashes($_POST['NIKAYAH']);
$nikibu = addslashes($_POST['NIKIBU']);
$nikwali = addslashes($_POST['NIKWALI']);
$orang_tua = addslashes($_POST['NAMAORTU']);
$nama_ibu = addslashes($_POST['NAMAIBU']);
$nama_wali = addslashes($_POST['NAMAWALI']);
$tempat_lahir_ayah = addslashes($_POST['TEMPATLAHIRAYAH']);
$tempat_lahir_ibu = addslashes($_POST['TEMPATLAHIRIBU']);
$tempat_lahir_wali = addslashes($_POST['TEMPATLAHIRWALI']);
$tanggal_lahir_ayah = date('Y-m-d', strtotime($_POST['TANGGALLAHIRAYAH']));
$tanggal_lahir_ibu = date('Y-m-d', strtotime($_POST['TANGGALLAHIRIBU']));
$tanggal_lahir_wali = date('Y-m-d', strtotime($_POST['TANGGALLAHIRWALI']));
$pendidikan_ayah = addslashes($_POST['PENDIDIKANAYAH']);
$pendidikan_ibu= addslashes($_POST['PENDIDIKANIBU']);
$pendidikan_wali= addslashes($_POST['PENDIDIKANWALI']);
$pekerjaan_ayah = addslashes($_POST['PEKERJAANORTUWALI']);
$pekerjaan_ibu = addslashes($_POST['PEKERJAANIBU']);
$pekerjaan_wali = addslashes($_POST['PEKERJAANWALI']);
$penghasilan_ayah = addslashes($_POST['PENGHASILANAYAH']);
$penghasilan_ibu = addslashes($_POST['PENGHASILANIBU']);
$penghasilan_wali = addslashes($_POST['PENGHASILANWALI']);
$telp_tua = addslashes($_POST['TELPORTUWALI']);
$telp_ibu = addslashes($_POST['TELPIBU']);
$telp_wali = addslashes($_POST['TELPWALI']);
$alamat_tua = addslashes($_POST['ALAMATORTUWALI']);
$alamat_ibu = addslashes($_POST['ALAMATIBU']);
$alamat_wali = addslashes($_POST['ALAMATWALI']);
//Upload KK/KTP
$ktp_kk = $_FILES["ktp_kk"]["name"];
$nama_sementara_ktp = $_FILES['ktp_kk']['tmp_name'];
$file_ext_ktp = substr($ktp_kk, strripos($ktp_kk, '.')); // get file name
$newfilename_ktp = $nim.$file_ext_ktp;
$dirUpload_ktp = "../document/ktp/";
$targetFilePath_ktp = $dirUpload_ktp . $ktp_kk;
$fileType_ktp = pathinfo($targetFilePath_ktp, PATHINFO_EXTENSION);
//Upload IJAZAH
$ijazah = $_FILES["ijazah"]["name"];
$nama_sementara_ijazah = $_FILES['ijazah']['tmp_name'];
$file_ext_ijazah = substr($ijazah, strripos($ijazah, '.')); // get file name
$newfilename_ijazah = $nim.$file_ext_ijazah;
$dirUpload_ijazah = "../document/ijazah/";
$targetFilePath_ijazah = $dirUpload_ijazah . $ijazah;
$fileType_ijazah = pathinfo($targetFilePath_ijazah, PATHINFO_EXTENSION);
//Upload AKTE LAHIR
$akte_kelahiran = $_FILES["akte_kelahiran"]["name"];
$nama_sementara_akte_lahir = $_FILES['akte_kelahiran']['tmp_name'];
$file_ext_akte_lahir = substr($akte_kelahiran, strripos($akte_kelahiran, '.')); // get file name
$newfilename_akte_lahir = $nim.$file_ext_akte_lahir;
$dirUpload_akte_lahir = "../document/akte/";
$targetFilePath_akte_lahir = $dirUpload_akte_lahir . $akte_kelahiran;
$fileType_akte_lahir = pathinfo($targetFilePath_akte_lahir, PATHINFO_EXTENSION);
$allowTypes = array('jpg', 'jpeg');
if (in_array($fileType_ktp, $allowTypes)) {
    $terupload_ktp = move_uploaded_file($nama_sementara_ktp, $dirUpload_ktp.$newfilename_ktp);  
    $result = mysqli_query($mysqli, "UPDATE msmhs SET ktpkk='$newfilename_ktp' WHERE NIMHSMSMHS='$nim'");
} 
if (in_array($fileType_ijazah, $allowTypes)) {
    $terupload_ijazah = move_uploaded_file($nama_sementara_ijazah, $dirUpload_ijazah.$newfilename_ijazah);  
    $result = mysqli_query($mysqli, "UPDATE msmhs SET ijazah_sma='$newfilename_ijazah' WHERE NIMHSMSMHS='$nim'");   
}
if (in_array($fileType_akte_lahir, $allowTypes)) {
    $terupload_akte_lahir = move_uploaded_file($nama_sementara_akte_lahir, $dirUpload_akte_lahir.$newfilename_akte_lahir);  
    $result = mysqli_query($mysqli, "UPDATE msmhs SET akte_kelahiran='$newfilename_akte_lahir' WHERE NIMHSMSMHS='$nim'");   
}
$result = mysqli_query($mysqli, "UPDATE msmhs SET NIKMSMHS='$nik', NMMHSMSMHS='$nama', TPLHRMSMHS='$tplahir', TELP='$telp', TGLHRMSMHS='$tgllahir',KDJEKMSMHS='$jenis_kelamin', AGAMA='$agama',ALAMATLENGKAP='$alamat_lengkap', JALAN='$jalan', RTRW='$rtrw',DUSUN='$dusun', KELURAHAN='$kelurahan', KECAMATAN_EKSPORT='$kecamatan', KABUPATEN_EKSPORT='$kabupaten', KEWARGANEGARAAN='$kewarganegaraan', NOKPS='$nokps', JENISTINGGAL='$jenis_tinggal', PROPINSI_EKSPORT='$propinsi', ALAMATYOGYA='$alamat_sekarang', ALAMATORTUWALI='$alamat_tua', EMAIL='$email', TWITER='$twiter', INSTAGRAM='$instagram', FACEBOOK='$facebook', NAMASEKOLAH='$asal_sekolah', HOBI='$hobi', KEAHLIAN='$keahlian', NIKAYAH='$nikayah', NAMAORTUWALI='$orang_tua', TEMPATLAHIRAYAH='$tempat_lahir_ayah', PENDIDIKANAYAH='$pendidikan_ayah', PEKERJAANORTUWALI='$pekerjaan_ayah', PENGHASILANAYAH='$penghasilan_ayah', TANGGALLAHIRAYAH='$tanggal_lahir_ayah', TELPORTUWALI='$telp_tua', NIKIBU='$nikibu', NAMAIBU='$nama_ibu', TEMPATLAHIRIBU='$tempat_lahir_ibu', TANGGALLAHIRIBU='$tanggal_lahir_ibu', PENDIDIKANIBU='$pendidikan_ibu', PEKERJAANIBU='$pekerjaan_ibu', PENGHASILANIBU='$penghasilan_ibu', TELPIBU='$telp_ibu', ALAMATIBU='$alamat_ibu', NIKWALI='$nikwali', NAMAWALI='$nama_wali', TEMPATLAHIRWALI='$tempat_lahir_wali', TANGGALLAHIRWALI='$tanggal_lahir_wali', PENDIDIKANWALI='$pendidikan_wali', PEKERJAANWALI='$pekerjaan_wali', PENGHASILANWALI='$penghasilan_wali', TELPWALI='$telp_wali', ALAMATWALI='$alamat_wali', KET_REV='$keterangan_revisi' WHERE NIMHSMSMHS='$nim'");
//redirectig to the display page. In our case, it is index.php
header("Location: detail_mahasiswa.php?nim=$nim");
?>
