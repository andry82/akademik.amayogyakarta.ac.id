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

$excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA MAHASISWA"); // Set kolom A1 dengan tulisan "DATA SISWA"
$excel->getActiveSheet()->mergeCells('A1:AP1'); // Set Merge Cell pada kolom A1 sampai F1
$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
// Buat header tabel nya pada baris ke 3
// Buat header tabel nya pada baris ke 3
$excel->setActiveSheetIndex(0)->setCellValue('A3', "NIM"); // Set kolom A3 dengan tulisan "NO"
$excel->setActiveSheetIndex(0)->setCellValue('B3', "NAMA"); // Set kolom B3 dengan tulisan "NIS"
$excel->setActiveSheetIndex(0)->setCellValue('C3', "NAMA IBU"); // Set kolom C3 dengan tulisan "NAMA"
$excel->setActiveSheetIndex(0)->setCellValue('D3', "TEMPAT LAHIR MAHASISWA"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
$excel->setActiveSheetIndex(0)->setCellValue('E3', "TANGGAL LAHIR MAHASISWA"); // Set kolom E3 dengan tulisan "TELEPON"
$excel->setActiveSheetIndex(0)->setCellValue('F3', "JENIS KELAMIN"); // Set kolom F3 dengan tulisan "ALAMAT"
$excel->setActiveSheetIndex(0)->setCellValue('G3', "AGAMA"); // Set kolom F3 dengan tulisan "ALAMAT"
$excel->setActiveSheetIndex(0)->setCellValue('H3', "NIK"); // Set kolom F3 dengan tulisan "ALAMAT"
$excel->setActiveSheetIndex(0)->setCellValue('I3', "KEWARGANEGARAAN"); // Set kolom F3 dengan tulisan "ALAMAT"
$excel->setActiveSheetIndex(0)->setCellValue('J3', "JALAN"); // Set kolom F3 dengan tulisan "ALAMAT"
$excel->setActiveSheetIndex(0)->setCellValue('K3', "RT"); // Set kolom F3 dengan tulisan "ALAMAT"
$excel->setActiveSheetIndex(0)->setCellValue('L3', "RW"); // Set kolom F3 dengan tulisan "ALAMAT"
$excel->setActiveSheetIndex(0)->setCellValue('M3', "DUSUN"); // Set kolom F3 dengan tulisan "ALAMAT"
$excel->setActiveSheetIndex(0)->setCellValue('N3', "KELURAHAN"); // Set kolom F3 dengan tulisan "ALAMAT"
$excel->setActiveSheetIndex(0)->setCellValue('O3', "KECAMATAN KODE"); // Set kolom F3 dengan tulisan "ALAMAT"
$excel->setActiveSheetIndex(0)->setCellValue('P3', "KECAMATAN"); // Set kolom F3 dengan tulisan "ALAMAT"
$excel->setActiveSheetIndex(0)->setCellValue('Q3', "KABUPATEN KODE"); // Set kolom F3 dengan tulisan "ALAMAT"
$excel->setActiveSheetIndex(0)->setCellValue('R3', "KABUPATEN"); // Set kolom F3 dengan tulisan "ALAMAT"
$excel->setActiveSheetIndex(0)->setCellValue('S3', "KODE POS"); // Set kolom F3 dengan tulisan "ALAMAT"
$excel->setActiveSheetIndex(0)->setCellValue('U3', "PROPINSI KODE"); // Set kolom F3 dengan tulisan "ALAMAT"
$excel->setActiveSheetIndex(0)->setCellValue('T3', "PROPINSI"); // Set kolom F3 dengan tulisan "ALAMAT"
$excel->setActiveSheetIndex(0)->setCellValue('U3', "JENIS TINGGAL"); // Set kolom F3 dengan tulisan "ALAMAT"
$excel->setActiveSheetIndex(0)->setCellValue('V3', "TELEPON"); // Set kolom F3 dengan tulisan "ALAMAT"
$excel->setActiveSheetIndex(0)->setCellValue('W3', "EMAIL"); // Set kolom F3 dengan tulisan "ALAMAT"
$excel->setActiveSheetIndex(0)->setCellValue('X3', "PENERIMA KPS"); // Set kolom F3 dengan tulisan "ALAMAT"
$excel->setActiveSheetIndex(0)->setCellValue('Y3', "NO KPS"); // Set kolom F3 dengan tulisan "ALAMAT"
$excel->setActiveSheetIndex(0)->setCellValue('Z3', "NAMA AYAH"); // Set kolom F3 dengan tulisan "ALAMAT"
$excel->setActiveSheetIndex(0)->setCellValue('AA3', "NIK"); // Set kolom F3 dengan tulisan "ALAMAT"
$excel->setActiveSheetIndex(0)->setCellValue('AB3', "TANGGAL LAHIR"); // Set kolom F3 dengan tulisan "ALAMAT"
$excel->setActiveSheetIndex(0)->setCellValue('AC3', "PENDIDIKAN"); // Set kolom F3 dengan tulisan "ALAMAT"
$excel->setActiveSheetIndex(0)->setCellValue('AD3', "PEKERJAAN"); // Set kolom F3 dengan tulisan "ALAMAT"
$excel->setActiveSheetIndex(0)->setCellValue('AE3', "PENGHASILAN"); // Set kolom F3 dengan tulisan "ALAMAT"
$excel->setActiveSheetIndex(0)->setCellValue('AF3', "NAMA IBU"); // Set kolom F3 dengan tulisan "ALAMAT"
$excel->setActiveSheetIndex(0)->setCellValue('AG3', "NIK"); // Set kolom F3 dengan tulisan "ALAMAT"
$excel->setActiveSheetIndex(0)->setCellValue('AH3', "TANGGAL LAHIR"); // Set kolom F3 dengan tulisan "ALAMAT"
$excel->setActiveSheetIndex(0)->setCellValue('AI3', "PENDIDIKAN"); // Set kolom F3 dengan tulisan "ALAMAT"
$excel->setActiveSheetIndex(0)->setCellValue('AJ3', "PEKERJAAN"); // Set kolom F3 dengan tulisan "ALAMAT"
$excel->setActiveSheetIndex(0)->setCellValue('AK3', "PENGHASILAN"); // Set kolom F3 dengan tulisan "ALAMAT"
$excel->setActiveSheetIndex(0)->setCellValue('AL3', "NAMA WALI"); // Set kolom F3 dengan tulisan "ALAMAT"
$excel->setActiveSheetIndex(0)->setCellValue('AM3', "TANGGAL LAHIR"); // Set kolom F3 dengan tulisan "ALAMAT"
$excel->setActiveSheetIndex(0)->setCellValue('AN3', "PENDIDIKAN"); // Set kolom F3 dengan tulisan "ALAMAT"
$excel->setActiveSheetIndex(0)->setCellValue('AO3', "PEKERJAAN"); // Set kolom F3 dengan tulisan "ALAMAT"
$excel->setActiveSheetIndex(0)->setCellValue('AP3', "PENGHASILAN"); // Set kolom F3 dengan tulisan "ALAMAT"
$excel->setActiveSheetIndex(0)->setCellValue('AQ3', "KELAS DPA"); // Set kolom F3 dengan tulisan "ALAMAT"
// Apply style header yang telah kita buat tadike masing-masing kolom header
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
$excel->getActiveSheet()->getStyle('L3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('M3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('N3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('O3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('P3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('Q3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('R3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('S3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('T3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('U3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('V3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('W3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('X3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('Y3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('Z3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('AA3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('AB3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('AC3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('AD3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('AE3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('AF3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('AG3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('AH3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('AI3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('AJ3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('AK3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('AL3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('AM3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('AN3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('AO3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('AP3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('AQ3')->applyFromArray($style_col);
// Apply style header yang telah kita buat tadi ke masing-masing kolom header
$excel->getActiveSheet()->getStyle('A3')->applyFromArray($center_col);
$excel->getActiveSheet()->getStyle('B3')->applyFromArray($center_col);
$excel->getActiveSheet()->getStyle('C3')->applyFromArray($center_col);

// Set height baris ke 1, 2 dan 3
$excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
$excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
$excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);

// Buat query untuk menampilkan semua data siswa
$tahun_masuk = $ta.'1';
$sql = $pdo->prepare("SELECT * FROM msmhs m, kelasparalel_mhs km WHERE m.NIMHSMSMHS=km.nimhs AND m.SMAWLMSMHS='$tahun_masuk' AND m.STATUSDATA='3' ORDER BY m.NIMHSMSMHS ASC");
$sql->execute(); // Eksekusi querynya

$no = 1; // Untuk penomoran tabel, di awal set dengan 1
$numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
while ($data = $sql->fetch()) { // Ambil semua data dari hasil eksekusi $sql 
    $kelas_huruf = $splite = explode("/", $data['nmkelas']);
    $kode_propinsi = $data['PROPINSI_EXPORT'];
    $prop = mysqli_query($mysqli, "SELECT * FROM wilayah WHERE id_wilayah='$kode_propinsi'");
    $data_prop = mysqli_fetch_array($prop);
    $kode_kabupaten = $data['KABUPATEN_EXPORT'];
    $kab = mysqli_query($mysqli, "SELECT * FROM wilayah WHERE id_wilayah='$kode_kabupaten'");
    $data_kab = mysqli_fetch_array($kab);
    $kode_kecamatan = $data['KECAMATAN_EXPORT'];
    $kec = mysqli_query($mysqli, "SELECT * FROM wilayah WHERE id_wilayah='$kode_kecamatan'");
    $data_kec = mysqli_fetch_array($kec);
    $thmskmhs = $data['TAHUNMSMHS'];
    $kelas_mhs = $kelas_huruf[0];
    $semester = (($ta - $thmskmhs) * 2) + $smtgg;
    if ($data['NOKPS']) {
        $kps = "YA";
    } else {
        $kps = "TIDAK";
    }
    $kdpro = $pdo->prepare("SELECT * FROM tbpro WHERE KDPROTBPRO=$kode_propinsi LIMIT 1");
    $kdpro->execute();
    while ($datapro = $kdpro->fetch()) {
        $nama_propinsi = $datapro['NMPROTBPRO'];
    }
    $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $data['NIMHSMSMHS']);
    $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $data['NMMHSMSMHS']);
    $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $data['NAMAIBU']);
    $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $data['TPLHRMSMHS']);
    $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $data['TGLHRMSMHS']);
    $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $data['KDJEKMSMHS']);
    $excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, $data['AGAMA']);
    $excel->setActiveSheetIndex(0)->setCellValue('H' . $numrow, $data['NIKMSMHS']);
    $excel->setActiveSheetIndex(0)->setCellValue('I' . $numrow, $data['KEWARGANEGARAAN']);
    $excel->setActiveSheetIndex(0)->setCellValue('J' . $numrow, $data['JALAN']);
    $excel->setActiveSheetIndex(0)->setCellValue('K' . $numrow, $data['RTRW']);
    $excel->setActiveSheetIndex(0)->setCellValue('L' . $numrow, $data['RTRW']);
    $excel->setActiveSheetIndex(0)->setCellValue('M' . $numrow, $data['DUSUN']);
    $excel->setActiveSheetIndex(0)->setCellValue('N' . $numrow, $data['KELURAHAN']);
    $excel->setActiveSheetIndex(0)->setCellValue('O' . $numrow, $kode_kecamatan);
    $excel->setActiveSheetIndex(0)->setCellValue('P' . $numrow, $data_kec['nama_wilayah']);
    $excel->setActiveSheetIndex(0)->setCellValue('Q' . $numrow, $kode_kabupaten);
    $excel->setActiveSheetIndex(0)->setCellValue('R' . $numrow, $data_kab['nama_wilayah']);
    $excel->setActiveSheetIndex(0)->setCellValue('S' . $numrow, $data['KODEPOS']);
    $excel->setActiveSheetIndex(0)->setCellValue('T' . $numrow, $data_prop['nama_wilayah']);
    $excel->setActiveSheetIndex(0)->setCellValue('U' . $numrow, $data['JENISTINGGAL']);
    $excel->setActiveSheetIndex(0)->setCellValue('V' . $numrow, $data['TELP']);
    $excel->setActiveSheetIndex(0)->setCellValue('W' . $numrow, $data['EMAIL']);
    $excel->setActiveSheetIndex(0)->setCellValue('X' . $numrow, $kps);
    $excel->setActiveSheetIndex(0)->setCellValue('Y' . $numrow, $data['NOKPS']);
    $excel->setActiveSheetIndex(0)->setCellValue('X' . $numrow, $data['NAMAORTUWALI']);
    $excel->setActiveSheetIndex(0)->setCellValue('AA' . $numrow, $data['NIKAYAH']);
    $excel->setActiveSheetIndex(0)->setCellValue('AB' . $numrow, $data['TANGGALLAHIRAYAH']);
    $excel->setActiveSheetIndex(0)->setCellValue('AC' . $numrow, $data['PENDIDIKANAYAH']);
    $excel->setActiveSheetIndex(0)->setCellValue('AD' . $numrow, $data['PEKERJAANORTUWALI']);
    $excel->setActiveSheetIndex(0)->setCellValue('AE' . $numrow, $data['PENGHASILANAYAH']);
    $excel->setActiveSheetIndex(0)->setCellValue('AF' . $numrow, $data['NAMAIBU']);
    $excel->setActiveSheetIndex(0)->setCellValue('AG' . $numrow, $data['NIKIBU']);
    $excel->setActiveSheetIndex(0)->setCellValue('AH' . $numrow, $data['TANGGALLAHIRIBU']);
    $excel->setActiveSheetIndex(0)->setCellValue('AI' . $numrow, $data['PENDIDIKANIBU']);
    $excel->setActiveSheetIndex(0)->setCellValue('AJ' . $numrow, $data['PEKERJAANIBU']);
    $excel->setActiveSheetIndex(0)->setCellValue('AK' . $numrow, $data['PENGHASILANIBU']);
    $excel->setActiveSheetIndex(0)->setCellValue('AL' . $numrow, $data['NAMAWALI']);
    $excel->setActiveSheetIndex(0)->setCellValue('AM' . $numrow, $data['TANGGALLAHIRWALI']);
    $excel->setActiveSheetIndex(0)->setCellValue('AN' . $numrow, $data['PENDIDIKANWALI']);
    $excel->setActiveSheetIndex(0)->setCellValue('AO' . $numrow, $data['PEKERJAANWALI']);
    $excel->setActiveSheetIndex(0)->setCellValue('AP' . $numrow, $data['PENGHASILANWALI']);
    $excel->setActiveSheetIndex(0)->setCellValue('AQ' . $numrow, $kelas_mhs . $semester);
    // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
    $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($center_col);
    $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($center_col);
    $excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($center_col);
    $excel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('I' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('J' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('K' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('L' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('M' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('N' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('O' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('P' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('Q' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('R' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('S' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('T' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('U' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('V' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('W' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('X' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('Y' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('Z' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('AA' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('AB' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('AC' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('AD' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('AE' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('AF' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('AG' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('AH' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('AI' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('AJ' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('AK' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('AL' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('AM' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('AN' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('AO' . $numrow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyle('AP' . $numrow)->applyFromArray($center_col);
    $excel->getActiveSheet()->getStyle('AQ' . $numrow)->applyFromArray($center_col);
    $excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(20);
    $no++; // Tambah 1 setiap kali looping
    $numrow++; // Tambah 1 setiap kali looping
}

// Set width kolom
$excel->getActiveSheet()->getColumnDimension('A')->setWidth(10); // Set width kolom A
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(30); // Set width kolom B
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(30); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('D')->setWidth(30); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('E')->setWidth(30); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('F')->setWidth(15); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('G')->setWidth(15); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('H')->setWidth(15); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('I')->setWidth(15); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('J')->setWidth(15); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('K')->setWidth(15); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('L')->setWidth(15); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('M')->setWidth(15); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('N')->setWidth(15); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('O')->setWidth(15); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('P')->setWidth(15); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('Q')->setWidth(15); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('R')->setWidth(15); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('S')->setWidth(15); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('T')->setWidth(15); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('U')->setWidth(15); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('V')->setWidth(15); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('W')->setWidth(15); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('X')->setWidth(15); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('Y')->setWidth(15); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('Z')->setWidth(15); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('AA')->setWidth(15); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('AB')->setWidth(15); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('AC')->setWidth(30); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('AD')->setWidth(25); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('AE')->setWidth(20); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('AF')->setWidth(15); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('AG')->setWidth(15); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('AH')->setWidth(15); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('AI')->setWidth(30); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('AJ')->setWidth(15); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('AK')->setWidth(15); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('AL')->setWidth(15); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('AM')->setWidth(20); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('AN')->setWidth(30); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('AO')->setWidth(30); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('AP')->setWidth(15); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('AQ')->setWidth(15); // Set width kolom C
// Set orientasi kertas jadi LANDSCAPE
$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

// Set judul file excel nya
$excel->getActiveSheet(0)->setTitle("Data Mahasiswa");
$excel->setActiveSheetIndex(0);

// Proses file excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="Data_Niman_'.$tahun_masuk.'.xlsx"'); // Set nama file excel nya
header('Cache-Control: max-age=0');

$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$write->save('php://output');
?>
