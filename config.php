<?php
/*$dbhost = '10.0.0.5';
$dbuser = 'cadpro';
$dbpass = 'cadprojsc';
$dbname = 'CadProTEC-DN';
$arr = array();
$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
if(!$conn) {
    die('Could not connect database: '.mysqli_error());
}
$sql = 'SELECT * FROM tbl_thamso WHERE thamso_ten="TAIKHOANTRACUUDANGKIEM" OR thamso_ten="MATKHAUTRACUUDANGKIEM" ';
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        array_push($arr,$row['thamso_giatri']);
    }
    
}
if(count($arr)< 2){
    $NguoiDung = 'sgtvtdn';
    $MatKhau = '12345678a';
}
else if(count($arr)>=2) {
    $NguoiDung = $arr[1];
    $MatKhau = $arr[0];
}
//echo $MatKhau;*/
include('database.php');
	class Config {
		public function getUsername() {
		    $arr = array();
		    $pdo = Database::connect();
		    $sql = 'SELECT * FROM tbl_thamso WHERE thamso_ten="TAIKHOANTRACUUDANGKIEM" OR thamso_ten="MATKHAUTRACUUDANGKIEM" ';
		    foreach($pdo->query($sql) as $row) {
			array_push($arr,$row['thamso_giatri']);
		    }
		    return $arr;
		}
	}
?>
