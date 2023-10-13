<?php if ($ta_lengkap <= '20222') { ?>
    <script type="text/javascript">
        function hitungNilai(kode_mk) {
            nilai = document.getElementById('nilai_' + kode_mk).value;
            if (nilai < 0 || nilai > 100) {
                alert("Nilai Hanya dari 0 - 100");
                document.getElementById('nilai_' + kode_mk).value = "";
                nilai = '0';
            }
            pembulatan = Math.round(nilai);
            if (pembulatan >= '85') {
                huruf = "A";
                bobot = "4.00";
            } else if (pembulatan >= '70') {
                huruf = "B";
                bobot = "3.00";
            } else if (pembulatan >= '55') {
                huruf = "C";
                bobot = "2.00";
            } else if (pembulatan >= '40') {
                huruf = "D";
                bobot = "1.00";
            } else {
                huruf = "E";
                bobot = "0.00";
            }
            document.getElementById('huruf_view_' + kode_mk).value = huruf;
            document.getElementById('huruf_' + kode_mk).value = huruf;
            document.getElementById('bobot_view' + kode_mk).value = bobot;
            document.getElementById('bobot_' + kode_mk).value = bobot;
        }
    </script>
<?php } elseif ($ta_lengkap >= '20231') { ?>
    <script type="text/javascript">
        function hitungNilai(kode_mk) {
            nilai = document.getElementById('nilai_' + kode_mk).value;
            if (nilai < 0 || nilai > 100) {
                alert("Nilai Hanya dari 0 - 100");
                document.getElementById('nilai_' + kode_mk).value = "";
                nilai = '0';
            }
            pembulatan = Math.round(nilai);
            if (pembulatan >= '93') {
                huruf = "A";
                bobot = "4.00";
            } else if (pembulatan >= '85') {
                huruf = "A -";
                bobot = "3.75";
            } else if (pembulatan >= '77') {
                huruf = "B +";
                bobot = "3.50";
            } else if (pembulatan >= '69') {
                huruf = "B";
                bobot = "3.00";
            } else if (pembulatan >= '61') {
                huruf = "B -";
                bobot = "2.75";
            } else if (pembulatan >= '53') {
                huruf = "C +";
                bobot = "2.50";
            } else if (pembulatan >= '45') {
                huruf = "C";
                bobot = "2.00";
            } else if (pembulatan >= '37') {
                huruf = "C -";
                bobot = "1.75";
            } else if (pembulatan >= '29') {
                huruf = "D +";
                bobot = "1.50";
            } else if (pembulatan >= '29') {
                huruf = "D";
                bobot = "1.00";
            } else if (pembulatan >= '21') {
                huruf = "D +";
                bobot = "0.00";
            } else {
                huruf = "E";
                bobot = "0.00";
            }
            document.getElementById('huruf_view_' + kode_mk).value = huruf;
            document.getElementById('huruf_' + kode_mk).value = huruf;
            document.getElementById('bobot_view' + kode_mk).value = bobot;
            document.getElementById('bobot_' + kode_mk).value = bobot;
        }
    </script>
<?php } ?>