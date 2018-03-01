<?php
$dbhost = '10.0.0.5';
$dbuser = 'cadpro';
$dbpass = 'cadprojsc';
$dbname = 'CadProTEC-DN';
//define ("NguoiDung","");
//define ("Matkhau","");
$arr = array();
$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
if(!$conn) {
    die('Could not connect database: '.mysqli_error());
}
$sql = 'SELECT thamso_giatri FROM tbl_thamso WHERE thamso_ten="TAIKHOANTRACUUDANGKIEM" OR thamso_ten="MATKHAUTRACUUDANGKIEM" ';
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        array_push($arr,$row['thamso_giatri']);
    }
    
}
//global $Nguoidung;
//global $MatKhau;'
if(count($arr)< 2){
    $NguoiDung = 'sgtvtdn';
    $MatKhau = '12345678a';
}
else if(count($arr)>=2) {
    $NguoiDung = $arr[1];
    $MatKhau = $arr[0];
}
//echo NguoiDung;
?>
