<?php
	function getDataByPlate($plate) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'http://www.vr.org.vn/ptpublicweb/Login.aspx');
              http://www.vr.org.vn/ptpublicweb
		curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.132 Safari/537.36'); 
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "__VIEWSTATE=%2FwEPDwUKMTU1NDU2ODg0NQ9kFgICAQ9kFgICDQ8PFgIeB1Zpc2libGVoZGRkTBhGZ4k3OcaysOxjtHn1ydwFNNQ%3D&__VIEWSTATEGENERATOR=DA943E64&__EVENTVALIDATION=%2FwEWBALDta%2B%2BDQL6yqb2BwLhi9CEDQKukYrKDtzI468IQEj9kn05FKRbT%2Fb9z944&txtNguoiDung=sgtvtdanang&txtMatKhau=123456789A&btnDangNhap=%C3%90%C4%83ng+nh%E1%BA%ADp");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_COOKIESESSION, true);
		curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie-name');  //could be empty, but cause problems on some hosts
		curl_setopt($ch, CURLOPT_COOKIEFILE, '/var/www/GetTTDK/cookie.txt');  //could be empty, but cause problems on some hosts
		$answer = curl_exec($ch);
		echo $answer;

		//another request preserving the session

		curl_setopt($ch, CURLOPT_URL, 'http://www.vr.org.vn/ptpublicweb/ThongTinPT.aspx');

		$answer = curl_exec($ch);
		echo $answer;
		$oDom = new simple_html_dom();
		$oDom->load($answer);
		$VIEWSTATE = $oDom->find('[name="__VIEWSTATE"]',0)->value;
		$VIEWSTATEGENERATOR = $oDom->find('[name="__VIEWSTATEGENERATOR"]',0)->value;
		$EVENTVALIDATION = $oDom->find('[name="__EVENTVALIDATION"]',0)->value;
		$postParam = "__VIEWSTATE=".$VIEWSTATE."&__VIEWSTATEGENERATOR=".$VIEWSTATEGENERATOR."&__EVENTVALIDATION=".$EVENTVALIDATION."&txtBienDK=".$plate."&Button1=Tra+c%E1%BB%A9u";
                curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postParam);
		$result = curl_exec($ch);
		$domResult = new simple_html_dom();
		$domResult->load($result);
		/////////////////////////////
		//Table
		/////////////////////////////
                //LblBinDangKy
		foreach($domResult->find('tr td') as $e){
                    echo "^";
			array_push($dataTable,$e->plaintext);
		}	
//		$txtLoaiPT = $domResult->getElementById("txtLoaiPT")->innertext;
//		$txtSoMay = $domResult->getElementById("txtSoMay")->innertext;
//		$txtChuPT = $domResult->getElementById("txtChuPT")->innertext;
//		$txtDiaChi = $domResult->getElementById("txtDiaChi")->innertext;
//		$txtNhanHieu = $domResult->getElementById("txtNhanHieu")->innertext;
//		$txtSoKhung = $domResult->getElementById("txtSoKhung")->innertext;
//		//$txtDiaChi = $domResult->getElementById("txtDiaChi")->innertext;
//
//		$txtTuTrongTK = $domResult->getElementById("txtTuTrongTK")->innertext;
//		$txtSoCho = $domResult->getElementById("txtSoCho")->innertext;
//		$txtKDVT = $domResult->getElementById("txtKDVT")->innertext;
//		$txtTB_GSHT = $domResult->getElementById("txtTB_GSHT")->innertext;
//		$txtCTBanhXe = $domResult->getElementById("txtCTBanhXe")->innertext;
//		$txtKichThuocBao = $domResult->getElementById("txtKichThuocBao")->innertext;
//		$txtChieuDaiCoSo = $domResult->getElementById("txtChieuDaiCoSo")->innertext;
//		
//		$taitrongGT = $domResult->getElementById("txtTaiTrongGT")->innertext;
//		$txtTrLgToanBoGT = $domResult->getElementById("txtTrLgToanBoGT")->innertext;
//		$txtTrLgMoocCP = $domResult->getElementById("txtTrLgMoocCP")->innertext;
//		$txtCaiTao = $domResult->getElementById("txtCaiTao")->innertext;
//		$txtVetBanhXe = $domResult->getElementById("txtVetBanhXe")->innertext;
//		$txtKichThuocThung = $domResult->getElementById("txtKichThuocThung")->innertext;
//		$txtCoLop = $domResult->getElementById("txtCoLop")->innertext;
//		$info = $taitrongGT."-".$txtTrLgToanBoGT;
//		$data = array();
//		array_push($data,$txtLoaiPT);
//		array_push($data,$txtSoMay);
//		array_push($data,$txtChuPT);
//		array_push($data,$txtDiaChi);
//		array_push($data,$txtNhanHieu);
//		array_push($data,$txtSoKhung);
//		array_push($data,$txtTuTrongTK);
//		array_push($data,$txtSoCho);
//		array_push($data,$txtKDVT);
//		array_push($data,$txtTB_GSHT);
//		array_push($data,$txtCTBanhXe);
//		array_push($data,$txtKichThuocBao);
//		array_push($data,$txtChieuDaiCoSo);
//		array_push($data,$taitrongGT);
//		array_push($data,$txtTrLgToanBoGT);
//		array_push($data,$txtTrLgMoocCP);
//		array_push($data,$txtCaiTao);
//		array_push($data,$txtVetBanhXe);
//		array_push($data,$txtKichThuocThung);
//		array_push($data,$txtCoLop);
//		
//		$strData = "";
//		for($i = 0; $i < count($data); $i++) {
//			$strData.="|";
//			$strData.= $data[$i];
//		}
//		$strData = substr($strData, 1);
//		$strData.="|";
//		$strData.=$dataTable[25];
//		$strData.="|";
//		$strData.=$dataTable[26];
//		$strData.="|";
//		$strData.=$dataTable[27];
//		$strData.="|";
//		$strData.=$dataTable[28];
//		
//		return $strData;

	}
	

	function connect($host,$user,$pass,$db) {
		$mysqli = new mysqli($host, $user, $pass, $db);
		mysqli_set_charset($mysqli,"utf8");
		if($mysqli->connect_error) 
			die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());

		return $mysqli;
	}
?>