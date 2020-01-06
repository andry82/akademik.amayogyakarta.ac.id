<?
$ipclient = $_SERVER['REMOTE_ADDR'];
$hostname_koneksi = "localhost";
$database_koneksi = "amayo_siakad";
$username_koneksi = "root";
$password_koneksi = "root";
$koneksi = mysql_pconnect($hostname_koneksi, $username_koneksi, $password_koneksi) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_select_db($database_koneksi, $koneksi);

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


function cek_session($nama_session)
{
	if (isset($_SESSION[$nama_session]))
		return true; //session login terisi
	else
		return false; //session login kosong
}


function selisih_hari($date1, $date2){

$tanggal1=explode("-", $date1);
$tahun1=(int)$tanggal1[0];
$bulan1=(int)$tanggal1[1];
//$hari_array1=explode(" ", $tanggal1[2]);
$hari1=(int)$tanggal1[2];

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
$tahun2=(int)$tanggal2[2];
$bulan2=(int)$tanggal2[1];
//$hari_array2=explode(" ", $tanggal2[2]);
$hari2=(int)$tanggal2[0];

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



function rupiah($angka)
{
$rupiah="";
$rp=strlen($angka);
while ($rp>3)
{
$rupiah = ".". substr($angka,-3). $rupiah;
$s=strlen($angka) - 3;
$angka=substr($angka,0,$s);
$rp=strlen($angka);
}
$rupiah = "Rp " . $angka . $rupiah . ",00";
return $rupiah;
}
?>
