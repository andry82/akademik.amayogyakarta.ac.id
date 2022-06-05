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

$excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA PRESENSI YUDISIUM"); // Set kolom A1 dengan tulisan "DATA SISWA"
$excel->getActiveSheet()->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai F1
$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
// Buat header tabel nya pada baris ke 3
// Buat header tabel nya pada baris ke 3
$excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
$excel->setActiveSheetIndex(0)->setCellValue('B3', "NIM"); // Set kolom A3 dengan tulisan "NO"
$excel->setActiveSheetIndex(0)->setCellValue('C3', "NAMA MAHASISWA"); // Set kolom A3 dengan tulisan "NO"
$excel->setActiveSheetIndex(0)->setCellValue('D3', "KELAS"); // Set kolom B3 dengan tulisan "NIS"
$excel->setActiveSheetIndex(0)->setCellValue('E3', "TANDA TANGAN"); // Set kolom C3 dengan tulisan "NAMA"
// Apply style header yang telah kita buat tadi ke masing-masing kolom header
$excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);


// Set height baris ke 1, 2 dan 3
$excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
$excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
$excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);

// Buat query untuk menampilkan semua data siswa
$id = $_GET['id'];
$sql = $pdo->prepare("SELECT * FROM pendaftaran_yudisium py, msmhs m, upload_ta ut, kelasparalel_mhs km WHERE km.nimhs=m.NIMHSMSMHS AND py.nim=m.NIMHSMSMHS AND ut.nim=m.NIMHSMSMHS AND ut.tahun=py.tahun AND py.tahun=$ta AND py.kegiatan_id=$id");

$sql->execute(); // Eksekusi querynya

$no = 1; // Untuk penomoran tabel, di awal set dengan 1
$numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4

while ($data_pendaftar = $sql->fetch()) { // Ambil semua data dari hasil eksekusi $sql  
    $pendaftaran_id = $data_pendaftar['pendaftaran_id'];
    $nim = trim($data_pendaftar['nim']);
    $kehadiran = $data_pendaftar['kehadiran'];
    $nama_mahasiswa = $data_pendaftar['NMMHSMSMHS'];
    $thmskmhs = $data_pendaftar['TAHUNMSMHS'];
    $sesi_awal = $data_pendaftar['sesi'];
    $status_ta = $data_pendaftar['status_ta'];
    $kelas = $data_pendaftar['nmkelas'];
    $splite = explode("/", $kelas);
    $kelas_huruf = $splite[0];
    $semester = (($ta - $thmskmhs) * 2) + $smtgg;

    $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, trim($no++));
    $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, trim($nim));
    $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, trim($nama_mahasiswa));
    $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, trim($kelas_huruf.$semester));
    $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, trim());
    // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
    $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($center_col);
    $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($center_col);
    $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($center_col);
    $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(20);
    $numrow++; // Tambah 1 setiap kali looping
}

// Set width kolom
$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(45); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('D')->setWidth(10); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('E')->setWidth(20); // Set width kolom C
// Set orientasi kertas jadi LANDSCAPE
$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

// Set judul file excel nya
$excel->getActiveSheet(0)->setTitle("Data Peserta Yudisium");
$excel->setActiveSheetIndex(0);

// Proses file excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="Data_Peserta_Yudisium.xlsx"'); // Set nama file excel nya
header('Cache-Control: max-age=0');

$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$write->save('php://output');
?>
