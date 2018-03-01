<?php
include "config.php";
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

header('Content-Type: text/html; charset=utf-8');
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
	include('lib/simple_html_dom.php');
	include('function.php');
	$mysqli = connect($HOST,$USER, $PASSWORD, $DATABASE);

	/////////////////////////////////////////////////////






	$plate = $_GET['plate'];
	$info =  getDataByPlate($plate);
	$arrData = explode('|',$info);
	$timeDangkiem = $arrData[23];
	$timeDangkiem = str_replace('/','-',$timeDangkiem);
	$currentDate = date('d-m-Y');
	$currentTime = date('H:i:s');
//	echo $timeDangkiem;
//	echo "<br />";
//	echo $currentDate;
//	die();
	if(strtotime($timeDangkiem) >  strtotime($currentDate)) {
		
		echo $info;
		//echo "con han dk";
		
	}
	
	else{
		echo $info;
		$lxtp = 0;
		$loaixe = 0;
		$arrTT = explode(' ',$arrData[13]);
		$arrSc = explode(' ',$arrData[7]); 
		$sc = $arrSc[0];
		$tt = $arrTT[0];
		
		if (strpos($arrData[0], 'Sơ mi') !== false) {
			
			$loaixe = 4;
			if($tt >=10000 && $tt < 18000) {
				$lxtp = 4;
			}
			if($tt >= 18000) {
				$lxtp = 5;
			}
		}
		if (strpos($arrData[0], 'đầu kéo') !== false) {
			
			$loaixe = 4;
			if($tt >=10000 && $tt < 18000) {
				$lxtp = 4;
			}
			if($tt >= 18000) {
				$lxtp = 5;
			}
		}
		if (strpos($arrData[0], 'khách') !== false) {
		
			$loaixe = 3;
			if($sc != 0){
				if($sc < 12) {
					$lxtp = 1;
				}
				if($sc >= 12 && $sc <= 30) {
					$lxtp = 2;
				}
				if($sc >=31) {
					$lxtp = 3;
				}
			}
		}if (strpos($arrData[0], 'tải') !== false) {
			$loaixe = 2;
			if($tt < 2000) {
				$lxtp = 1;
			}
			if($tt >= 2000 && $tt < 4000) {
				$lxtp = 2;
			}
			if($tt >= 4000 && $tt < 10000) {
				$lxtp = 3;
			}
			if($tt >=10000 && $tt < 18000) {
				$lxtp = 4;
			}
			if($tt >= 18000) {
				$lxtp = 5;
			}
			
		}
		if (strpos($arrData[0], 'xe con') !== false) {
			
			$loaixe = 1;
			$lxtp = 1;
		}
		
		
		
		if($sc == 0 ) {
			
		}
		$lxis = $loaixe * 10 + $lxtp;
		//echo $lxis;
		
		
		
		
		if ($stmt = $mysqli->prepare("UPDATE tbl_dangkiem SET LoaiPT = ?,NhanHieu = ?,SoMay = ?,SoKhung = ?,KichThuocBao = ?, KichThuocThung = ?, TuTrongTK = ?,TaiTrongGT = ?,SoCho = ?,TrLgToanBoGT = ?, TrLgMoocCP = ?, DoViDK = ?,NgayDK = ?, TemDK = ?, HanDK = ?,ChuPT = ?, DiaChiChuPT = ?,KinhDoanhVT = ?,GSHT = ?, CongThucBanhXe = ?,ChieuDaiCoSo = ?, CaiTao = ?,VetBanhXe = ?,CoLop = ? ,LoaiXe = ?  WHERE BIENSO=?")) {
			                            $stmt->bind_param("ssssssssssssssssssssssssss",$arrData[0],$arrData[4],$arrData[1],$arrData[5],$arrData[11],$arrData[18],$arrData[6],$arrData[13],$arrData[7],$arrData[14],$arrData[15],$arrData[20],$arrData[21],$arrData[22],$arrData[23],$arrData[2],$arrData[3],$arrData[8],$arrData[9],$arrData[10],$arrData[12],$arrData[16],$arrData[17],$arrData[19],$lxis,$plate);
			$stmt->execute();
			if ($stmt->errno) {
			  echo "FAILURE!!! " . $stmt->error;
			}
			else echo "Updated {$stmt->affected_rows} rows";
			
			
		}

		
		
	}
	

	//echo json_encode( $info );
	$errorfilename ="log/".$currentDate.".log";
	//echo $errorfilename;
	$logfile = fopen($errorfilename, "a") or die("Unable to open file!");
$txt = "[ ".$currentTime." ]".$ip." request;"."Plates: ".$plate. PHP_EOL ;
//echo $txt;
fwrite($logfile, $txt);
fclose($logfile);
?>
