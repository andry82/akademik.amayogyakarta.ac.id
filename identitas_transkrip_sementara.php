<table border="0" style="font-size: 10px;" cellpadding="0" cellspacing="0" width="100%" class="alamat"> 
    <tbody>
        <!-- Huruf Kecil -->
        <?php
        $program_studi = strtolower($PRODI);

        function tanggal_indo($tanggal) {
            $bulan = array(1 => 'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            );
            $split = explode('-', $tanggal);
            return $split[2] . ' ' . $bulan[(int) $split[1]] . ' ' . $split[0];
        }

        $revisi_identitas = mysql_query("select * from revisi_identitas where nim='$nomor_induk_mahasiswa'");
        $data_revisi_identitas = mysql_fetch_array($revisi_identitas);
        $count_revisi_identitas = mysql_num_rows($revisi_identitas);
        if ($count_revisi_identitas == 1) {
            $tanggal_mahasiswa = $data_revisi_identitas['value'];
        } else {
            $tanggal_mahasiswa = tanggal_indo($tgllhr_mahasiswa);
        }
        ?>
        <tr valign="top" style="font-weight: bold"><td width="18%">Nama Mahasiswa</td><td width="1%">:</td><td width="30%"><? print($nama_mahasiswa); ?></td><td width="20%">Nomor Induk Mahasiswa</td><td width="1%">:</td><td width="15%"><? print(strtoupper($nomor_induk_mahasiswa)); ?></td></tr>
        <tr valign="top" style="font-weight: bold"><td width="18%">Tempat / Tanggal Lahir</td>
            <td width="1%">:</td><td width="30%"><? print($tptlhr_mahasiswa); ?>, <? print(tanggal_indo($tanggal_mahasiswa)); ?></td>
            <td width="20%">
                <?php
                if ($status_mhs == 'A') {
                    echo "Konsentrasi";
                } elseif ($status_mhs == 'L') {
                    echo "Tanggal Lulus";
                }
                ?></td>
            <td width="1%">:</td>
            <td width="15%" style="text-transform: uppercase">
                <?php
                if ($status_mhs == 'A') {
                    echo $KONSEN;
                } elseif ($status_mhs == 'L') {
                    echo tanggal_indo($transkrip3["tgl_lulus"]);
                }
                ?>
            </td></tr>
    </tbody>
</table>