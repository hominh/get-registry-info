<?php
	error_reporting(1);
set_time_limit(1500);

$header = "Content-type: text/html; charset=utf-8";
$agent = "Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36";
$url = "http://www.vr.org.vn/ptpublicweb/Login.aspx";
echo file_get_contents($url);
die();

    $ch = curl_init() or die("Error");
    curl_setopt($ch, CURLOPT_USERAGENT, $agent);
    curl_setopt($ch, CURLOPT_URL, $url);    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_PROXY, $url);
	curl_setopt($ch, CURLOPT_PROXYPORT, "80");
    if(curl_exec($ch) === FALSE) 
    {
        die("Curl failed: " . curl_error($ch));  // Never goes here
    }

    curl_close($ch);

?>
