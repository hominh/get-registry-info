<?php
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
	include('a.php');
	$plate = $_GET['plate'];
        echo $plate."*";
	$info =  getDataByPlate($plate);
	echo $info;
	$errorfilename ="log/".$currentDate.".log";
	$logfile = fopen($errorfilename, "a") or die("Unable to open file!");
	$txt = "[ ".$currentTime." ]".$ip." request;"."Plate: ".$plate. PHP_EOL ;
	fwrite($logfile, $txt);
	fclose($logfile);
?>
