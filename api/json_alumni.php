 <?php
 header('Content-Type: application/json; charset=utf8');
 //panggil koneksi.php
 include("../config.php");

 //query tabel produk
 $sql="SELECT * FROM msmhs WHERE STMHSMSMHS='A' AND TAHUNMSMHS='2023'";
 $query=mysqli_query($mysqli, $sql) or die(mysqli_error());

//data array
 $array=array();
 while($data=mysqli_fetch_assoc($query)) $array[]=$data; 
 
//mengubah data array menjadi json
 echo json_encode($array);
 ?>