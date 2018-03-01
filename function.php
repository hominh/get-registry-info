<?php
	include("config.php");
	function getDataByPlate($plate) {
		$config = new Config;
		$user = $config->getUsername();
		if(count($user)<2) {
		    $NguoiDung = 'ttgtccdanang';
		    $MatKhau = 'dieuhanhgiaothong';
		}
		else if(count($user) >= 2) {
		    $NguoiDung = $user[1];
		    $MatKhau = $user[0];
		}
		$html = file_get_html("http://www.vr.org.vn/ptpublicweb/Login.aspx");
		$VIEWSTATELOG = $html->find('[name="__VIEWSTATE"]',0)->value;
		$VIEWSTATEGENERATORLOG = $html->find('[name="__VIEWSTATEGENERATOR"]',0)->value;
		$VIEWSTATEENCRYPTEDLOG = $html->find('[name="__VIEWSTATEENCRYPTED"]',0)->value;
		$EVENTVALIDATIONLOG = $html->find('[name="__EVENTVALIDATION"]',0)->value;
		$postParamLog = "__VIEWSTATE=%2FwEPDwUKMTU1NDU2ODg0NQ9kFgICAQ9kFgICDQ8PFgIeB1Zpc2libGVoZGRkTBhGZ4k3OcaysOxjtHn1ydwFNNQ%3D&__VIEWSTATEGENERATOR=DA943E64&__EVENTVALIDATION=%2FwEWBALDta%2B%2BDQL6yqb2BwLhi9CEDQKukYrKDtzI468IQEj9kn05FKRbT%2Fb9z944&txtNguoiDung=".$NguoiDung."&txtMatKhau=".$MatKhau."&btnDangNhap=%C3%90%C4%83ng+nh%E1%BA%ADp";
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'http://www.vr.org.vn/ptpublicweb/Login.aspx');
		
		curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.132 Safari/537.36'); 
		//curl_setopt($ch, CURLOPT_USERAGENT,);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postParamLog);
		//curl_setopt($ch, CURLOPT_POSTFIELDS, $postParamLog);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_COOKIESESSION, true);
		curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie-name');  //could be empty, but cause problems on some hosts
		curl_setopt($ch, CURLOPT_COOKIEFILE, '/var/www/GetTTDK/cookie.txt');  //could be empty, but cause problems on some hosts
		$answer = curl_exec($ch);
		//another request preserving the session

		curl_setopt($ch, CURLOPT_URL, 'http://www.vr.org.vn/ptpublicweb/ThongTinPT.aspx');

		$answer = curl_exec($ch);
		//echo $answer;
		$oDom = new simple_html_dom();
		$oDom->load($answer);
		$VIEWSTATE = $oDom->find('[name="__VIEWSTATE"]',0)->value;
		$VIEWSTATEGENERATOR = $oDom->find('[name="__VIEWSTATEGENERATOR"]',0)->value;
		$EVENTVALIDATION = $oDom->find('[name="__EVENTVALIDATION"]',0)->value;
		$EVENTVALIDATION = $oDom->find('[name="__EVENTVALIDATION"]',0)->value;
		$VIEWSTATEENCRYPTED = $html->find('[name="__VIEWSTATEENCRYPTED"]',0)->value;
		$postParam = "__VIEWSTATE=sBNTGnEfayY0Pwcv3c1McrTKAF1MNZwRIBAT9MyY4YuL%2BiWZnT6uOOrs4pnR4aMtcq9iMzfedMg6OOk%2FMSbq2IffuLs5N3q3wiHMtEcDDvz43zR0IPF%2FBpAKOSTBflNVsUSEN%2B74nSrvlP4Iu5fDmsprYAM%3D&__VIEWSTATEGENERATOR=53DB23EF&__VIEWSTATEENCRYPTED=&__EVENTVALIDATION=WxSbp3go9t0m0pO6JGNJVxPr8pTj2ynUH0rDvb5RbBt0kqNuFMlS9vRVktAsgaV52dAnCWnLADMfZzh%2FIHZgoxJa9Gsk9YqRrZ71h6wZh2PzAh%2Bx&txtBienDK=".$plate."&Button1=Tra+c%E1%BB%A9u";
		//echo $postParam;
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postParam);
		$result = curl_exec($ch);
		$domResult = new simple_html_dom();
		$domResult->load($result);
		
		/////////////////////////////
		//Table
		/////////////////////////////
		$dataTable = array();
		foreach($domResult->find('tr td') as $e){
			//echo $e->plaintext . '<br>';
			array_push($dataTable,$e->plaintext);
		}	




		$txtLoaiPT = $domResult->getElementById("txtLoaiPT")->innertext;
		$txtSoMay = $domResult->getElementById("txtSoMay")->innertext;
		$txtChuPT = $domResult->getElementById("txtChuPT")->innertext;
		$txtDiaChi = $domResult->getElementById("txtDiaChi")->innertext;
		$txtNhanHieu = $domResult->getElementById("txtNhanHieu")->innertext;
		$txtSoKhung = $domResult->getElementById("txtSoKhung")->innertext;
		//$txtDiaChi = $domResult->getElementById("txtDiaChi")->innertext;

		$txtTuTrongTK = $domResult->getElementById("txtTuTrongTK")->innertext;
		$txtSoCho = $domResult->getElementById("txtSoCho")->innertext;
		$txtKDVT = $domResult->getElementById("txtKDVT")->innertext;
		$txtTB_GSHT = $domResult->getElementById("txtTB_GSHT")->innertext;
		$txtCTBanhXe = $domResult->getElementById("txtCTBanhXe")->innertext;
		$txtKichThuocBao = $domResult->getElementById("txtKichThuocBao")->innertext;
		$txtChieuDaiCoSo = $domResult->getElementById("txtChieuDaiCoSo")->innertext;
		
		$taitrongGT = $domResult->getElementById("txtTaiTrongGT")->innertext;
		$txtTrLgToanBoGT = $domResult->getElementById("txtTrLgToanBoGT")->innertext;
		$txtTrLgMoocCP = $domResult->getElementById("txtTrLgMoocCP")->innertext;
		$txtCaiTao = $domResult->getElementById("txtCaiTao")->innertext;
		$txtVetBanhXe = $domResult->getElementById("txtVetBanhXe")->innertext;
		$txtKichThuocThung = $domResult->getElementById("txtKichThuocThung")->innertext;
		$txtCoLop = $domResult->getElementById("txtCoLop")->innertext;
		$info = $taitrongGT."-".$txtTrLgToanBoGT;
		$data = array();
		array_push($data,$txtLoaiPT);
		array_push($data,$txtSoMay);
		array_push($data,$txtChuPT);
		array_push($data,$txtDiaChi);
		array_push($data,$txtNhanHieu);
		array_push($data,$txtSoKhung);
		array_push($data,$txtTuTrongTK);
		array_push($data,$txtSoCho);
		array_push($data,$txtKDVT);
		array_push($data,$txtTB_GSHT);
		array_push($data,$txtCTBanhXe);
		array_push($data,$txtKichThuocBao);
		array_push($data,$txtChieuDaiCoSo);
		array_push($data,$taitrongGT);
		array_push($data,$txtTrLgToanBoGT);
		array_push($data,$txtTrLgMoocCP);
		array_push($data,$txtCaiTao);
		array_push($data,$txtVetBanhXe);
		array_push($data,$txtKichThuocThung);
		array_push($data,$txtCoLop);
		
		$strData = "";
		for($i = 0; $i < count($data); $i++) {
			$strData.="|";
			$strData.= $data[$i];
		}
		$strData = substr($strData, 1);
		$strData.="|";
		$strData.=$dataTable[25];
		$strData.="|";
		$strData.=$dataTable[26];
		$strData.="|";
		$strData.=$dataTable[27];
		$strData.="|";
		$strData.=$dataTable[28];
		
		return $strData;

	}
?>
