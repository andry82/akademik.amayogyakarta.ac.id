<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="#">SISTEM INFORMASI AKADEMIK</a>
</div>
<?php
include 'config.php';
$aturan = mysqli_query($mysqli, "select * from config");
$dataaturan = mysqli_fetch_array($aturan);
$tahunajar = $dataaturan['tahun'];
$status_pembimbing_pkl = $dataaturan['setting_pembimbing_pkl'];
$ta = substr($tahunajar, 0, 4);
?>
<ul class="nav navbar-top-links navbar-right">
    <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> KELUAR</a>
</ul>
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">

            <center>
                <?php
                $hari = date('l');
                /* $new = date('l, F d, Y', strtotime($Today)); */
                if ($hari == "Sunday") {
                    echo "Minggu";
                } elseif ($hari == "Monday") {
                    echo "Senin";
                } elseif ($hari == "Tuesday") {
                    echo "Selasa";
                } elseif ($hari == "Wednesday") {
                    echo "Rabu";
                } elseif ($hari == "Thursday") {
                    echo("Kamis");
                } elseif ($hari == "Friday") {
                    echo "Jum'at";
                } elseif ($hari == "Saturday") {
                    echo "Sabtu";
                }
                ?>,
                <?php
                $tgl = date('d');
                echo $tgl;
                $bulan = date('F');
                if ($bulan == "January") {
                    echo " Januari ";
                } elseif ($bulan == "February") {
                    echo " Februari ";
                } elseif ($bulan == "March") {
                    echo " Maret ";
                } elseif ($bulan == "April") {
                    echo " April ";
                } elseif ($bulan == "May") {
                    echo " Mei ";
                } elseif ($bulan == "June") {
                    echo " Juni ";
                } elseif ($bulan == "July") {
                    echo " Juli ";
                } elseif ($bulan == "August") {
                    echo " Agustus ";
                } elseif ($bulan == "September") {
                    echo " September ";
                } elseif ($bulan == "October") {
                    echo " Oktober ";
                } elseif ($bulan == "November") {
                    echo " November ";
                } elseif ($bulan == "December") {
                    echo " Desember ";
                }
                $tahun = date('Y');
                echo $tahun;
                ?>
                <br/>
                <span id="clock"></span>
            </center>           
            <?php
            $mail = $email;
            $hash = md5(strtolower(trim($mail)));
            $size = 150;
            $grav_url = "https://www.gravatar.com/avatar/" . $hash . "?s=" . $size;
            if ($smtgg == '1') {
                $mt = "GANJIL";
            } elseif ($smtgg == '2') {
                $mt = "GENAP";
            }
            ?>
            <img src="<?php echo $grav_url; ?>" style="padding: 33px;">
            <center>
                Periode : <?php echo $ta ?> / <?php echo $mt ?><br/>
            </center>
            </li>
            <li>
                <a href="index.php"><i class="fa fa-home fa-fw"></i> HALAMAN DEPAN</a>
            </li>
            <li>
                <a href="mahasiswa.php"><i class="fa fa-list fa-fw"></i> DATA MAHASISWA</a>
            </li>    
            <li>
                <a href="data_bimbingan_akademik.php"><i class="fa fa-list fa-fw"></i> DATA BIMBINGAN AKADEMIK</a>
            </li>    
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
