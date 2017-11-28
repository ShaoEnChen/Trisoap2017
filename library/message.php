<?php
function message_verify($mobile, $code) {
	$username = "a2313045";
	$password = "vg4m528b";
	$message = "親愛的三三客戶您好：\n
	您的會員註冊驗證碼為 ".$code." ，請至原註冊頁面輸入以完成會員註冊。\n
	感謝您對三三吾鄉的支持。";
	$MSGData = "";
	$msg = "username=".$username."&password=".$password."&mobile=".$mobile."&longsms=Y&message=".urlencode($message);
	$num = strlen($msg);  
	// 打開 API 閘道
	$fp = fsockopen ("api.twsms.com", 80);
	if ($fp) {
		$MSGData .= "POST /smsSend.php HTTP/1.1\r\n";
		$MSGData .= "Host: api.twsms.com\r\n";
		$MSGData .= "Content-Length: ".$num."\r\n";
		$MSGData .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$MSGData .= "Connection: Close\r\n\r\n";
		$MSGData .= $msg."\r\n";
		fputs ($fp, $MSGData);
		$Tmp ="";
		// 取出回傳值
		while (!feof($fp)) $Tmp.=fgets($fp,128); 
		$temp2 = explode(PHP_EOL, $Tmp);
		// 關閉閘道
		fclose ($fp);
	}
	else {
		echo "您無法連接 TwSMS API Server";
	}
}

function message_pass_order($mobile, $ORDNO) {
	$username = "a2313045";
	$password = "vg4m528b";
	$message = "親愛的三三客戶您好：\n
    您的訂單（編號 ".$ORDNO."）已於今日出貨，故來信通知您，產品將於1-3日或依您指定時間到達。\n
    您所指定的到貨的時間及需求，我們已請貨運公司配合您的需求，但物流過程因交通、配送路線等因素，無法保證一定可以完全依您指定時間到達，敬請見諒。若收到貨款後發現有瑕疵，請務必保留原商品並儘速與我們聯絡，感謝您！\n
    非常謝謝您對三三吾鄉的支持，歡迎您再次蒞臨本站！\n
    三三敬上";
	$MSGData = "";
	$msg = "username=".$username."&password=".$password."&mobile=".$mobile."&longsms=Y&message=".urlencode($message);
	$num = strlen($msg);  
	// 打開 API 閘道
	$fp = fsockopen ("api.twsms.com", 80);
	if ($fp) {
		$MSGData .= "POST /smsSend.php HTTP/1.1\r\n";
		$MSGData .= "Host: api.twsms.com\r\n";
		$MSGData .= "Content-Length: ".$num."\r\n";
		$MSGData .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$MSGData .= "Connection: Close\r\n\r\n";
		$MSGData .= $msg."\r\n";
		fputs ($fp, $MSGData);
		$Tmp ="";
		// 取出回傳值
		while (!feof($fp)) $Tmp.=fgets($fp,128); 
		$temp2 = explode(PHP_EOL, $Tmp);
		// 關閉閘道
		fclose ($fp);
	}
	else {
		echo "您無法連接 TwSMS API Server";
	}
}
?>
