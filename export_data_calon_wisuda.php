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

$excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA CALON WISUDA MAHASISWA"); // Set kolom A1 dengan tulisan "DATA SISWA"
$excel->getActiveSheet()->mergeCells('A1:H1'); // Set Merge Cell pada kolom A1 sampai F1
$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
// Buat header tabel nya pada baris ke 3
// Buat header tabel nya pada baris ke 3
$excel->setActiveSheetIndex(0)->setCellValue('A3', "NIM"); // Set kolom A3 dengan tulisan "NO"
$excel->setActiveSheetIndex(0)->setCellValue('B3', "NAMA MAHASISWA"); // Set kolom A3 dengan tulisan "NO"
$excel->setActiveSheetIndex(0)->setCellValue('C3', "KELAS"); // Set kolom B3 dengan tulisan "NIS"
$excel->setActiveSheetIndex(0)->setCellValue('D3', "D"); // Set kolom C3 dengan tulisan "NAMA"
$excel->setActiveSheetIndex(0)->setCellValue('E3', "E"); // Set kolom C3 dengan tulisan "NAMA"
$excel->setActiveSheetIndex(0)->setCellValue('F3', "E"); // Set kolom C3 dengan tulisan "NAMA"
$excel->setActiveSheetIndex(0)->setCellValue('G3', "TOTAL MK"); // Set kolom C3 dengan tulisan "NAMA"
$excel->setActiveSheetIndex(0)->setCellValue('H3', "TOTAL SKS"); // Set kolom C3 dengan tulisan "NAMA"
// Apply style header yang telah kita buat tadi ke masing-masing kolom header
$excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);

// Set height baris ke 1, 2 dan 3
$excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
$excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
$excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);

// Buat query untuk menampilkan semua data siswa
$sql = $pdo->prepare("SELECT * FROM trakm t, msmhs m, kelasparalel_mhs km WHERE t.NIMHSTRAKM=km.nimhs AND t.NIMHSTRAKM=m.NIMHSMSMHS AND t.SKSTTTRAKM>='91' AND m.STMHSMSMHS='A' AND t.THSMSTRAKM='$ta_lengkap'");
$sql->execute(); // Eksekusi querynya

$no = 1; // Untuk penomoran tabel, di awal set dengan 1
$numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
while ($d = $sql->fetch()) { // Ambil semua data dari hasil eksekusi $sql  
    $nim = $d['NIMHSTRAKM'];
    $nama_mhs = $d['NMMHSMSMHS'];
    $konsentrasi = $d['kdkonsen'];
    $thmskmhs = $d['TAHUNMSMHS'];
    $pecah_kelas = explode("/", $d['nmkelas']);
    $kelas = $pecah_kelas[0];
    $semester = (($ta - $thmskmhs) * 2) + $smtgg;
    $total_sks = $d['SKSTTTRAKM'];
    $total_mk = mysqli_query($mysqli, "SELECT * FROM rekapitulasi_nilai WHERE nim='$nim'");
    $data_total_mk = mysqli_fetch_array($total_mk);
    $jumlah_nilai_a = $data_total_mk['nilai_a'];
    $jumlah_nilai_b = $data_total_mk['nilai_b'];
    $jumlah_nilai_c = $data_total_mk['nilai_c'];
    $jumlah_nilai_d = $data_total_mk['nilai_d'];
    if ($jumlah_nilai_d != '') {
        $nilai_d = $data_total_mk['nilai_d'];
    } else {
        $nilai_d = 0;
    }
    $jumlah_nilai_e = $data_total_mk['nilai_e'];
    if ($jumlah_nilai_e != '') {
        $nilai_e = $data_total_mk['nilai_e'];
    } else {
        $nilai_e = 0;
    }
    $jumlah_nilai_k = $data_total_mk['nilai_k'];
    if ($jumlah_nilai_k != '') {
        $nilai_k = $data_total_mk['nilai_k'];
    } else {
        $nilai_k = 0;
    }
    $jumlah_mk = $jumlah_nilai_a + $jumlah_nilai_b + $jumlah_nilai_c + $jumlah_nilai_d + $jumlah_nilai_e + $jumlah_nilai_k;

    $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, trim($nim));
    $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, trim($nama_mhs));
    $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, trim($kelas.''.$semester));
    $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, trim($nilai_d));
    $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, trim($nilai_e));
    $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, trim($nilai_k));
    $excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, trim($jumlah_mk));
    $excel->setActiveSheetIndex(0)->setCellValue('H' . $numrow, trim($total_sks));

    // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
    $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($center_col);
    $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($center_col);
    $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($center_col);
    $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($center_col);
    $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($center_col);
    $excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($center_col);
    $excel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($center_col);
    $excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(20);
    $no++; // Tambah 1 setiap kali looping
    $numrow++; // Tambah 1 setiap kali looping
}

// Set width kolom
$excel->getActiveSheet()->getColumnDimension('A')->setWidth(15); // Set width kolom A
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(35); // Set width kolom B
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(10); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('D')->setWidth(5); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('E')->setWidth(5); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('F')->setWidth(5); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('G')->setWidth(15); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('H')->setWidth(15); // Set width kolom C
$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

// Set judul file excel nya
$excel->getActiveSheet(0)->setTitle("Data Wisuda");
$excel->setActiveSheetIndex(0);

// Proses file excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="Data_Calon_Wisuda.xlsx"'); // Set nama file excel nya
header('Cache-Control: max-age=0');

$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$write->save('php://output');
?>
