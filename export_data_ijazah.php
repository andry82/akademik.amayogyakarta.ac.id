<?php

// Load file koneksi.php
include 'config.php';

// Load plugin PHPExcel nya
require_once 'PHPExcel/PHPExcel.php';

// Panggil class PHPExcel nya
$excel = new PHPExcel();

// Settingan awal fil excel
$excel->getProperties()->setCreator('My Notes Code')
        ->setLastModifiedBy('My Notes Code')
        ->setTitle("Data Mahasiswa")
        ->setSubject("Mahasiswa")
        ->setDescription("Laporan Data Mahasiswa")
        ->setKeywords("Data Mahasiswa");

// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
$style_col = array(
    'font' => array('bold' => true), // Set font nya jadi bold
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
    ),
    'borders' => array(
        'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
        'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN), // Set border right dengan garis tipis
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
    )
);

$center_col = array(
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
    ),
    'borders' => array(
        'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
        'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN), // Set border right dengan garis tipis
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
    )
);

// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
$style_row = array(
    'alignment' => array(
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
    ),
    'borders' => array(
        'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
        'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN), // Set border right dengan garis tipis
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
    )
);

$excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA IJAZAH"); // Set kolom A1 dengan tulisan "DATA SISWA"
$excel->getActiveSheet()->mergeCells('A1:G1'); // Set Merge Cell pada kolom A1 sampai F1
$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
// Buat header tabel nya pada baris ke 3
// Buat header tabel nya pada baris ke 3
$excel->setActiveSheetIndex(0)->setCellValue('A3', "PIN"); // Set kolom A3 dengan tulisan "NO"
$excel->setActiveSheetIndex(0)->setCellValue('B3', "NO SERI IJAZAH"); // Set kolom A3 dengan tulisan "NO"
$excel->setActiveSheetIndex(0)->setCellValue('C3', "NAMA MAHASISWA"); // Set kolom A3 dengan tulisan "NO"
$excel->setActiveSheetIndex(0)->setCellValue('D3', "NIM"); // Set kolom B3 dengan tulisan "NIS"
$excel->setActiveSheetIndex(0)->setCellValue('E3', "TEMPAT LAHIR"); // Set kolom C3 dengan tulisan "NAMA"
$excel->setActiveSheetIndex(0)->setCellValue('F3', "TANGGAL LAHIR"); // Set kolom C3 dengan tulisan "NAMA"
$excel->setActiveSheetIndex(0)->setCellValue('G3', "NIk"); // Set kolom C3 dengan tulisan "NAMA"
// Apply style header yang telah kita buat tadi ke masing-masing kolom header
$excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);


// Set height baris ke 1, 2 dan 3
$excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
$excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
$excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);

// Buat query untuk menampilkan semua data siswa
$sql = $pdo->prepare("SELECT ks.urutan, ms.NMMHSMSMHS, ms.TPLHRMSMHS, ms.TGLHRMSMHS, ms.KEAHLIAN, ms.ALAMATLENGKAP, ms.NAMAORTUWALI, ms.TELP, jup.nim, ks.nmkonsen, t.judul_lta, ms.UKURAN_KAOS, ms.NIKMSMHS FROM jadwal_ujian_pendadaran jup, msmhs ms, konsentrasi ks, ta t WHERE jup.nim=ms.NIMHSMSMHS AND t.nim=ms.NIMHSMSMHS AND t.status='2' AND jup.status=3 AND jup.tahun='$ta' AND t.tahun='$ta' AND ms.kdkonsen=ks.kdkonsen ORDER BY ks.urutan, jup.nim ASC");

$sql->execute(); // Eksekusi querynya

$no = 1; // Untuk penomoran tabel, di awal set dengan 1
$numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4

function TanggalIndonesia($date) {
    $date = date('Y-m-d', strtotime($date));
    if ($date == '0000-00-00')
        return 'Tanggal Kosong';

    $tgl = substr($date, 8, 2);
    $bln = substr($date, 5, 2);
    $thn = substr($date, 0, 4);

    switch ($bln) {
        case 1 : {
                $bln = 'Januari';
            }break;
        case 2 : {
                $bln = 'Februari';
            }break;
        case 3 : {
                $bln = 'Maret';
            }break;
        case 4 : {
                $bln = 'April';
            }break;
        case 5 : {
                $bln = 'Mei';
            }break;
        case 6 : {
                $bln = "Juni";
            }break;
        case 7 : {
                $bln = 'Juli';
            }break;
        case 8 : {
                $bln = 'Agustus';
            }break;
        case 9 : {
                $bln = 'September';
            }break;
        case 10 : {
                $bln = 'Oktober';
            }break;
        case 11 : {
                $bln = 'November';
            }break;
        case 12 : {
                $bln = 'Desember';
            }break;
        default: {
                $bln = 'UnKnown';
            }break;
    }

    $tanggalIndonesia = $tgl . " " . $bln . " " . $thn;
    return $tanggalIndonesia;
}

while ($d = $sql->fetch()) { // Ambil semua data dari hasil eksekusi $sql  
    $nim = $d['nim'];
    $urutan = $d['urutan'];
    $nik = $d['NIKMSMHS'];
    $nama = $d['NMMHSMSMHS'];
    $tempat_lahir = ucwords(strtolower($d['TPLHRMSMHS']));
    $tanggal_lahir = TanggalIndonesia($d['TGLHRMSMHS']);
    $nama_konsentrasi = $d['nmkonsen'];
    $telp = $d['TELP'];
    $ukuran_kaos = $d['UKURAN_KAOS'];
    $data_pkl = mysqli_query($mysqli, "SELECT nama_lokasi_pkl FROM upload_ta WHERE nim='$nim'");
    $data_lokasi = mysqli_fetch_array($data_pkl);
    if ($data_lokasi['nama_lokasi_pkl'] == '') {
        $nama_lokasi_pkl = '-';
    } else {
        $nama_lokasi_pkl = ucwords(strtolower($data_lokasi['nama_lokasi_pkl']));
    }


    $judul_lta = ucwords(strtolower($d['judul_lta']));
    $alamat_lengkap = ucwords(strtolower($d['ALAMATLENGKAP']));
    $keahlian = ucwords(strtolower($d['KEAHLIAN']));
    $nama_orang_tua = ucwords(strtolower($d['NAMAORTUWALI']));

    $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, trim());
    $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, trim());
    $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, trim($nama));
    $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, trim($nim));
    $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, trim($tempat_lahir));
    $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, trim($tanggal_lahir));
    $excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, trim($nik));
    // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
    $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($center_col);
    $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($center_col);
    $excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(20);
    $no++; // Tambah 1 setiap kali looping
    $numrow++; // Tambah 1 setiap kali looping
}

// Set width kolom
$excel->getActiveSheet()->getColumnDimension('A')->setWidth(20); // Set width kolom A
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(30); // Set width kolom B
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(45); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('D')->setWidth(10); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('E')->setWidth(30); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('F')->setWidth(20); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('G')->setWidth(20); // Set width kolom C
// Set orientasi kertas jadi LANDSCAPE
$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

// Set judul file excel nya
$excel->getActiveSheet(0)->setTitle("Data Ijazah");
$excel->setActiveSheetIndex(0);

// Proses file excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="Data_Ijazah.xlsx"'); // Set nama file excel nya
header('Cache-Control: max-age=0');

$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$write->save('php://output');
?>