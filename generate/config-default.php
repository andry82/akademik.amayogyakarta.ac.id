<?php
session_start();

//cegah pengaksesan langsung dari browser
if (eregi('config.php', $_SERVER['PHP_SELF']))
	exit('Error: Akses anda ditolak.');

//fungsi untuk koneksi ke MySQL
function konek_db($dbhost = 'localhost', $dbuser = 'root', $dbpass = 'root', $dbname = 'siakad')
{
	@ $koneksi = mysql_connect($dbhost, $dbuser, $dbpass);
	if (!$koneksi)
		return false;
	else
	{
		mysql_select_db($dbname);
		return true;
	}
}

//setting default situs
@ $baca_dir = opendir('download/');
if($_SESSION['mhs']=="")
{
@ $nama_situs = 'KRS Online Mahasiswa - AMA YPK YOGYAKARTA';
}else
{

$nama_situs = ''.$_SESSION['mhs'].' - KRS Online Mahasiswa - AMA YPK YOGYAKARTA';
}

//fungsi untuk menutup koneksi ke MySQL
function close_konek_db()
{
	mysql_close($koneksi);
}

//fungsi untuk mengenkripsi string dengan metode MD5
function enkrip_md5($string)
{
	//untuk membalik urutan string digunakan fungsi strrev()
	$chiper_text = strrev(md5($string));
	return $chiper_text;
}

//fungsi untuk mengdekripsi string dengan metode MD5
function dekrip_md5($string)
{
	//untuk membalik urutan string digunakan fungsi strrev()
	$chiper_text = strrev(md5($string));
	return $chiper_text;
}

//fungsi untuk membuat password secara acak (digunakan utk mengirim password pada form lupa password
function pass_acak($panjang=8)
{
	$kar = "ABCDEFGHIJKLMNOPQRSTUVWXZ0123456789abcdefghijklmnopqrstuvwxz";
	
	//acak karater
	srand((double)microtime() * 1000000);
	
	//lakukan looping sepanjang $panjang(parameter)
	for ($i=0; $i<$panjang; $i++)
	{
		$nom_acak = rand() % 53;  //untuk mendapatkan satu nomor acak
		$pass .= substr($kar, $nom_acak, 1);  //ambil satu karakter
	}
	
	return $pass;
}

//fungsi untuk mengecek kata-kata kotor
function filter_kata($string, $file)
{
	$daftar_kata = file($file);
	
	//lakukan looping untuk mengganti setiap kata kotor dengan !@#$%
	foreach($daftar_kata as $kotor)
	{
		//hilangkan spasi diawal dan diakhir kata
		$kotor = trim($kotor);
		
		//ganti menggunakan fungsi eregi_replace()
		$string = eregi_replace($kotor, '!@#$%', $string);
	}
	
	return $string;
}



//fungsi untuk login level
function login($tabel, $username, $password)
{
	$query = "select * from $tabel where NIMHSMSMHS = '$username' and login_pass = '$password'";
	$hasil = mysql_query($query);
	
	//cek jumlah baris yang dikembalikan
	if (mysql_num_rows($hasil) > 0) {
		return true;
	} else {
		return false;
	}
}

//fungsi untuk cek status global
function cekstatusglobal($tabel, $username, $password)
{
	$query = "select * from $tabel where NIMHSMSMHS = '$username' and login_pass = '$password' and STMHSMSMHS='A'";
	$hasil = mysql_query($query);
	
	//cek jumlah baris yang dikembalikan
	if (mysql_num_rows($hasil) > 0) {
		return true;
	} else {
		return false;
	}
}
//cegah dari SQL Injection dan cross site scripting
function filter_str($string)
{
	$filter = ereg_replace('[^a-zA-z0-9_]', '', $string);
	return $filter;
}

//cek setiap field apa ada yang kosong
function cek_field($var)
{
	foreach($var as $field)
	{
		if ($field == '' || !isset($field))
			return false;
	}
	return true;
}

//cek setiap field apa ada yang diisi dengan digit
function cek_number($digit)
{
	if (ereg('[0-9]',$digit))
		return true;
	else
		return false;
}

//cek kevalidan email
function cek_email($email)
{
	if (ereg('^[a-zA-Z0-9_\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$', $email))
		return true;
	else 
		return false;
}

//fungsi untuk logout
function logout($nama_session)
{
	if (isset($_SESSION[$nama_session]))
	{
		unset($_SESSION[$nama_session]);
		//session_destroy();
		return true;
	}
	else
		return false;
}

//cek session
function cek_session($nama_session)
{
	if (isset($_SESSION[$nama_session]))
		return true; //session login terisi
	else
		return false; //session login kosong
}

//menampilkan nama session
function name_session($nama_session)
{
	if (isset($_SESSION[$nama_session]))
		return $_SESSION[$nama_session]; 
	else
		return ''; //session kosong
}

//mendapatkan id dari session
function getid_session($nama_session, $tabel)
{
	if (isset($_SESSION[$nama_session])) {
		$user_session = $_SESSION[$nama_session];
		$hasil = mysql_query("select NIMHSMSMHS from $tabel where NIMHSMSMHS = '$user_session'");
		$data = mysql_fetch_array($hasil);
		return $data[0];
	} else
		return ''; //session kosong
}

//cek register session
function cek_register_session($nama_session)
{
	if (session_is_registered($nama_session))
		return true; //session login terisi
	else
		return false; //session login kosong
}

//menampilkan tanggal
function show_tanggal($pilihan)
{
	//buat ketentuan
	$tanggal = date('j');
	$hari = date('w');
	$bulan = date('n') - 1;
	$tahun = date('Y');
	$jml_hari = date('t');
	
	//buat variable
	$nama_hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
	$nama_bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	
	//tentukan jumlah penambahan dr tgl sekarang
	$tglplus = 1;
	$blnplus = 0;
	$thnplus = 0;
	
	$hari_ini = $nama_hari[$hari];
	$bulan_ini = $nama_bulan[$bulan];
	$hari_nanti = $nama_hari[$hari + $tglplus];
	
	if ($hari_nanti == null && $hari_ini == "Jumat")
		$hari_nanti = "Minggu";
	else if ($hari_nanti == null && $hari_ini == "Sabtu")
		$hari_nanti = "Senin";
	
	$tgl_nanti = $tanggal + $tglplus;
	
	if ($jml_hari == 31)
	{
		if ($tgl_nanti > 31)
		{
			$tgl_nanti = $tgl_nanti - 31;
			$blnplus = 1;
		}
	}
	else if ($jml_hari == 30)
	{
		if ($tgl_nanti > 30)
		{
			$tgl_nanti = $tgl_nanti - 30;
			$blnplus = 1;
		}
	}
	else if ($jml_hari == 28)
	{
		if ($tgl_nanti > 28)
		{
			$tgl_nanti = $tgl_nanti - 28;
			$blnplus = 1;
		}
	}
	else
	{
		//tahun kabisat
		if ($tgl_nanti > 29)
		{
			$tgl_nanti = $tgl_nanti - 29;
			$blnplus = 1;
		}
	}
	$bln_nanti = $nama_bulan[$bulan + $blnplus];
	
	if ($bln_nanti == null)
	{
		$bln_nanti = "Januari";
		$thnplus = 1;
	}
	
	//buat variabel
	$thn_nanti = $tahun + $thnplus;
	
	if ($pilihan == 1)
	{
		$hari_tanggal = $hari_nanti.', '.$tgl_nanti.' '.$bln_nanti.' '.$thn_nanti;
		return $hari_tanggal;
	}
	else if ($pilihan == 0)
	{
		$hari_ini = $hari_ini.', '.$tanggal.' '.$bulan_ini.' '.$tahun;
		return $hari_ini;
	}
}

//fungsi untuk menghitung selisih
function selisih_hari($date1, $date2)
{
	$tanggal1=explode("-", $date1);
	$tahun1=(int)$tanggal1[0];
	$bulan1=(int)$tanggal1[1];
	$hari_array1=explode(" ", $tanggal1[2]);
	$hari1=(int)$hari_array1[0];
	
	if (bcmod($tahun1, 4)==0) { //tahun kabisat
	$jml_hari1=$tahun1*366;
	$jml_hari1=$jml_hari1+ceil(($bulan1/2)) * 31;
	$jml_hari1=$jml_hari1+floor(($bulan1/2)) * 30;
	
	if ($bulan1>2) {
	$jml_hari1 = $jml_hari1 - 1;
	}
	$jml_hari1=$jml_hari1+$hari1;
	}else{
	$jml_hari1=$tahun1*365;
	$jml_hari1=$jml_hari1+ceil(($bulan1/2)) * 31;
	$jml_hari1=$jml_hari1+floor(($bulan1/2)) * 30;
	if ($bulan1>2) {
	$jml_hari1 = $jml_hari1 - 1;
	}
	$jml_hari1=$jml_hari1+$hari1;
	}
	
	$tanggal2=explode("-", $date2);
	$tahun2=(int)$tanggal2[0];
	$bulan2=(int)$tanggal2[1];
	$hari_array2=explode(" ", $tanggal2[2]);
	$hari2=(int)$hari_array2[0];
	
	if (bcmod($tahun2, 4)==0) { //tahun kabisat
	$jml_hari2=$tahun2*366;
	$jml_hari2=$jml_hari2+ceil(($bulan2/2)) * 31;
	$jml_hari2=$jml_hari2+floor(($bulan2/2)) * 30;
	if ($bulan2>2) {
	$jml_hari2 = $jml_hari2 - 2;
	}
	$jml_hari2=$jml_hari2+$hari2;
	}else{
	$jml_hari2=$tahun2*365;
	$jml_hari2=$jml_hari2+ceil(($bulan2/2)) * 31;
	$jml_hari2=$jml_hari2+floor(($bulan2/2)) * 30;
	if ($bulan2>2) {
	$jml_hari2 = $jml_hari2 - 2;
	}
	$jml_hari2=$jml_hari2+$hari2;
	}
	$out = abs(($jml_hari1-$jml_hari2))-1;
	return $out;
}

function cekkata($string, $fields, $katacari)
{
	$qCari = "select $fields from $tabel where $fields = '$katacari' ";
	$hCari = mysql_query($qCari);
	
	if (!$hCari) return false;
	
	//cek jumlah baris yang dikembalikan
	if (mysql_num_rows($hCari) > 0) {
		return true;
	} else {
		return false;
	}
}

//fungsi untuk pencarian data berdasarkan query
function cekquery($query)
{
	$hCari = mysql_query($query);			
	//cek jumlah baris yang dikembalikan
	if (mysql_num_rows($hCari) > 0) {
		return true;
	} else {
		return false;
	}
}

//fungsi untuk memeriksa ke-valid-an tanggal
function cektanggal($tgl, $bln, $thn)
{
	if (isset($thn)) 
		if (($tgl == 0) or ($bln == 0) or ($thn == 0)) 
			return false;
		else 
			return true;
}

//fungsi untuk mendapatkan data berdasarkan query
function getquery($query)
{
	$hCari = mysql_query($query);			
	$data = mysql_fetch_array($hCari);
	
	return $data[0];
}

//fungsi untuk mendapatkan count data
function getcount($tabel)
{
	$hasil = mysql_query("select count(0) from $tabel");	 
	$data = mysql_fetch_array($hasil);
	
	return $data[0];
}

function getcount_query($query)
{
	$hasil = mysql_query($query);	 
	$data = mysql_fetch_array($hasil);
	
	return $data[0];
}

//fungsi untuk mendapatkan max data
function getmax($tabel, $field)
{
	$hasil = mysql_query("select max($field) from $tabel");
	$data = mysql_fetch_array($hasil);
	return $data[0];
}

//fungsi untuk menampilkan pesan salah
function error_msg($pesan)
{
	echo '<p align="center" class="text4">'.$pesan.', '
		.'silahkan <a href="javascript:history.back();">login</a> lagi !!</p>';
}
function error_nonaktif($pesan)
{
	echo '<p align="center" class="text4">'.$pesan.', '
		.'silahkan Hubungi Bagian Akademik Bila terdapat kesalahan !!<br>silahkan <a href="javascript:history.back();">ulangi</a> lagi !!</p>';
}

?> 
