<option value="">-- PILIH --</option>
<?php
include 'config.php';
$wilayah_id = $_POST['wilayah'];
$kabupaten = mysqli_query($mysqli, "SELECT * FROM wilayah WHERE id_induk_wilayah='$wilayah_id'");
while ($data_kabupaten = mysqli_fetch_array($kabupaten)) {
    ?>
    <option value="<?php echo $data_kabupaten['id_wilayah'] ?>"><?php echo $data_kabupaten['nama_wilayah'] ?></option>
<?php } ?>

