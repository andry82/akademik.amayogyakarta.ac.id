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

$excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA WISUDA MAHASISWA"); // Set kolom A1 dengan tulisan "DATA SISWA"
$excel->getActiveSheet()->mergeCells('A1:K1'); // Set Merge Cell pada kolom A1 sampai F1
$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
// Buat header tabel nya pada baris ke 3
// Buat header tabel nya pada baris ke 3
$excel->setActiveSheetIndex(0)->setCellValue('A3', "NAMA MAHASISWA"); // Set kolom A3 dengan tulisan "NO"
$excel->setActiveSheetIndex(0)->setCellValue('B3', "TEMPAT / TANGGAL LAHIR"); // Set kolom A3 dengan tulisan "NO"
$excel->setActiveSheetIndex(0)->setCellValue('C3', "NIM"); // Set kolom B3 dengan tulisan "NIS"
$excel->setActiveSheetIndex(0)->setCellValue('D3', "KONSENTRASI"); // Set kolom C3 dengan tulisan "NAMA"
$excel->setActiveSheetIndex(0)->setCellValue('E3', "KEAHLIAN"); // Set kolom C3 dengan tulisan "NAMA"
$excel->setActiveSheetIndex(0)->setCellValue('F3', "NAMA ORANG TUA"); // Set kolom C3 dengan tulisan "NAMA"
$excel->setActiveSheetIndex(0)->setCellValue('G3', "ALAMAT ASAL"); // Set kolom C3 dengan tulisan "NAMA"
$excel->setActiveSheetIndex(0)->setCellValue('H3', "NOMOR TELP"); // Set kolom C3 dengan tulisan "NAMA"
$excel->setActiveSheetIndex(0)->setCellValue('I3', "LOKASI PKL"); // Set kolom C3 dengan tulisan "NAMA"
$excel->setActiveSheetIndex(0)->setCellValue('J3', "JUDUL LTA"); // Set kolom C3 dengan tulisan "NAMA"
$excel->setActiveSheetIndex(0)->setCellValue('K3', "UKURAN KAOS"); // Set kolom C3 dengan tulisan "NAMA"
// Apply style header yang telah kita buat tadi ke masing-masing kolom header
$excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('J3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('K3')->applyFromArray($style_col);


// Set height baris ke 1, 2 dan 3
$excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
$excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
$excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);

// Buat query untuk menampilkan semua data siswa
//$sql = $pdo->prepare("SELECT ks.urutan, ms.NMMHSMSMHS, ms.TPLHRMSMHS, ms.TGLHRMSMHS, ms.KEAHLIAN, ms.ALAMATLENGKAP, ms.NAMAORTUWALI, ms.TELP, jup.nim, ks.nmkonsen, t.judul_lta FROM  jadwal_ujian_pendadaran jup, msmhs ms, konsentrasi ks, ta t WHERE jup.nim=ms.NIMHSMSMHS AND jup.nim=t.nim AND t.status='2' AND jup.status=3 AND jup.tahun='$ta' AND ms.kdkonsen=ks.kdkonsen ORDER BY ks.urutan, jup.nim ASC");
$sql = $pdo->prepare("SELECT ks.urutan, ms.NMMHSMSMHS, ms.TPLHRMSMHS, ms.TGLHRMSMHS, ms.KEAHLIAN, ms.ALAMATLENGKAP, ms.NAMAORTUWALI, ms.TELP, jup.nim, ks.nmkonsen, t.judul_lta, ut.nama_lokasi_pkl, ms.UKURAN_KAOS FROM  jadwal_ujian_pendadaran jup, msmhs ms, konsentrasi ks, ta t, upload_ta ut WHERE jup.nim=ms.NIMHSMSMHS AND jup.nim=t.nim AND ut.nim=ms.NIMHSMSMHS AND t.status='2' AND jup.status=3 AND ut.tahun=jup.tahun AND jup.tahun='$ta' AND t.tahun='$ta' AND ms.kdkonsen=ks.kdkonsen ORDER BY ks.urutan, jup.nim ASC");
//$res = mysqli_query($mysqli, "SELECT ks.urutan, ms.NMMHSMSMHS, ms.TPLHRMSMHS, ms.TGLHRMSMHS, ms.KEAHLIAN, ms.ALAMATLENGKAP, ms.NAMAORTUWALI, ms.TELP, jup.nim, ks.nmkonsen, t.judul_lta, ut.nama_lokasi_pkl FROM  jadwal_ujian_pendadaran jup, msmhs ms, konsentrasi ks, ta t, upload_ta ut WHERE jup.nim=ms.NIMHSMSMHS AND jup.nim=t.nim AND ut.nim=ms.NIMHSMSMHS AND t.status='2' AND jup.status=3 AND ut.tahun=jup.tahun AND jup.tahun='$ta' AND t.tahun='$ta' AND ms.kdkonsen=ks.kdkonsen ORDER BY ks.urutan, jup.nim ASC");
                                
$sql->execute(); // Eksekusi querynya

$no = 1; // Untuk penomoran tabel, di awal set dengan 1
$numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
while ($d = $sql->fetch()) { // Ambil semua data dari hasil eksekusi $sql  
    $nim = $d['nim'];
    $urutan = $d['urutan'];
    $nama = $d['NMMHSMSMHS'];
    $tempat_lahir = ucwords(strtolower($d['TPLHRMSMHS']));
    $tanggal_lahir = $d['TGLHRMSMHS'];
    $nama_konsentrasi = $d['nmkonsen'];
    $telp = $d['TELP'];
    $ukuran_kaos = $d['UKURAN_KAOS'];
    $nama_lokasi_pkl = ucwords(strtolower($d['nama_lokasi_pkl']));
    $judul_lta = ucwords(strtolower($d['judul_lta']));
    $alamat_lengkap = ucwords(strtolower($d['ALAMATLENGKAP']));
    $keahlian = ucwords(strtolower($d['KEAHLIAN']));
    $nama_orang_tua = ucwords(strtolower($d['NAMAORTUWALI']));

    $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, trim($nama));
    $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, trim($tempat_lahir).",".$tanggal_lahir);
    $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, trim($nim));
    $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, trim($nama_konsentrasi));
    $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, trim($keahlian));
    $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, trim($nama_orang_tua));
    $excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, trim($alamat_lengkap));
    $excel->setActiveSheetIndex(0)->setCellValue('H' . $numrow, trim($telp));
    $excel->setActiveSheetIndex(0)->setCellValue('I' . $numrow, $nama_lokasi_pkl);
    $excel->setActiveSheetIndex(0)->setCellValue('J' . $numrow, $judul_lta);
    $excel->setActiveSheetIndex(0)->setCellValue('K' . $numrow, $ukuran_kaos);
    
    // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
    $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($center_col);
    $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($center_col);
    $excel->getActiveSheet()->getStyle('I' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('J' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('K' . $numrow)->applyFromArray($center_col);
    $excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(20);
    $no++; // Tambah 1 setiap kali looping
    $numrow++; // Tambah 1 setiap kali looping
}

// Set width kolom
$excel->getActiveSheet()->getColumnDimension('A')->setWidth(25); // Set width kolom A
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(35); // Set width kolom B
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(15); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('D')->setWidth(40); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('E')->setWidth(30); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('F')->setWidth(20); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('G')->setWidth(50); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('H')->setWidth(10); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('I')->setWidth(30); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('J')->setWidth(100); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('K')->setWidth(10); // Set width kolom C
// Set orientasi kertas jadi LANDSCAPE
$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

// Set judul file excel nya
$excel->getActiveSheet(0)->setTitle("Data Wisuda");
$excel->setActiveSheetIndex(0);

// Proses file excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="Data_Wisuda.xlsx"'); // Set nama file excel nya
header('Cache-Control: max-age=0');

$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$write->save('php://output');
?>
