<?php
include_once('router.php');
include_once("library/AllPay.Payment.Integration.php");
include_once("resource/database.php");

if (isset($_GET['ordno']) && isset($_GET['account'])) {
	$payType = isset($_GET['payType']) ? $_GET['payType'] : 'A';
	$account = $_GET['account'];
	$address = $_GET['address'];
	$phone = $_GET['phone'];
	$notice = $_GET['notice'];
	if (empty($address)) {
		echo '<script>alert("請填寫寄送地址");</script>';
		echo '<script>location.assign("index.php?route=pay&order='.$_GET['ordno'].'")</script>';
		return;
	}
	else {
		if (empty($phone)) {
			echo '<script>alert("請填寫聯絡電話");</script>';
			echo '<script>location.assign("index.php?route=pay&order='.$_GET['ordno'].'")</script>';
			return;
		}
		else {
			$sqlA = "UPDATE ORDMAS SET ORDADD='$address' WHERE ORDNO='$ordno' AND EMAIL='$account'";
			$sqlB = "UPDATE CUSMAS SET TEL='$phone' WHERE EMAIL='$account'";
			if (mysql_query($sqlA) && mysql_query($sqlB)) {
				$ordno = ($_GET['ordno'] == 'cart') ? '0' : $_GET['ordno'];
				if (!empty($notice) && strlen($notice) <= 100) {
					mysql_query("UPDATE ORDMAS SET ORDINST='$notice' WHERE ORDNO='$ordno' AND EMAIL='$account'");
				}
				$sql1 = mysql_query("SELECT * FROM ORDMAS WHERE ORDNO='$ordno' AND EMAIL='$account'");
				$fetch1 = mysql_fetch_array($sql1);
				$shipfee = curl_post(array('module' => 'cue', 'target' => 'order_shipfee', 'order' => $ordno, 'account' => $account), 'cue');
				$message = curl_post(array('module' => 'cue', 'target' => 'order_message', 'account' => $account), 'cue');
				$discountPrice = curl_post(array('module' => 'cue', 'target' => 'order_discountPrice', 'order' => $ordno, 'account' => $account), 'cue');
				$discountName = curl_post(array('module' => 'cue', 'target' => 'order_discountName', 'order' => $ordno, 'account' => $account), 'cue');
				$total = curl_post(array('module' => 'cue', 'target' => 'order_total', 'order' => $ordno, 'account' => $account), 'cue');

				try {
				    $obj = new AllInOne();

				    // AllPay Service Parameter
				    $obj->ServiceURL = "https://payment.allpay.com.tw/Cashier/AioCheckOut/V2";
				    $obj->HashKey    = 'bwqFcafJNX4GzAWO';	// Hashkey
				    $obj->HashIV     = 'mJf0B3ONPbCfwkmF';	// HashIV
				    $obj->MerchantID = '1385617';			// MerchantID

				    // Basic Order Parameter
				    $obj->Send['ReturnURL'] = "https://trisoap.com.tw/controller/cashing_feedback.php";// 付款完成通知回傳的網址
				    $TradeNo = time();														// Produce TradeNo
				    $obj->Send['MerchantTradeNo']   = $TradeNo;										// Order_id
				    $obj->Send['MerchantTradeDate'] = date("Y/m/d H:i:s");							// Order_time
				    $obj->Send['TotalAmount']       = $total;										// Order_amount
				    $obj->Send['TradeDesc']         = "trisoap";									// Order_Description
				    if ($payType == 'B') {
				        $obj->Send['ChoosePayment'] = PaymentMethod::ATM;
				    }
				    elseif ($payType == 'C') {
				        $obj->Send['ChoosePayment'] = PaymentMethod::WebATM;
				    }
				    else{
				        $obj->Send['ChoosePayment'] = PaymentMethod::Credit;
				    }
				    $obj->Send['ClientBackURL']     = "https://trisoap.com.tw";

				    $sql2 = "UPDATE ORDMAS SET MerchantTradeNo='$TradeNo' WHERE ORDNO='$ordno' AND EMAIL='$account'";
				    mysql_query($sql2);

				    $sql3 = mysql_query("SELECT * FROM ORDITEMMAS WHERE ORDNO='$ordno' AND EMAIL='$account'");
				    while ($fetch3 = mysql_fetch_array($sql3)) {
				        array_push($obj->Send['Items'], array('Name' => query_name($fetch3['ITEMNO']), 'Price' => query_price($fetch3['ITEMNO']), 'Currency' => "元", 'Quantity' => $fetch3['ORDAMT'], 'URL' => "xxx"));
				    }

				    array_push($obj->Send['Items'], array('Name' => "運費", 'Price' => $shipfee, 'Currency' => "元", 'Quantity' => (int) "1", 'URL' => "xxx"));

				    if ($message > 0) {
				    	array_push($obj->Send['Items'], array('Name' => "帳號內折扣", 'Price' => -$message, 'Currency' => "元", 'Quantity' => (int) "1", 'URL' => "xxx"));
				    }

				    if ($discountPrice > 0) {
				        array_push($obj->Send['Items'], array('Name' => $discountName, 'Price' => -$discountPrice, 'Currency' => "元", 'Quantity' => (int) "1", 'URL' => "xxx"));
				    }

				    // Create Order(auto submit to AllPay)
				    $obj->CheckOut();
				}

				catch (Exception $e) {
				    echo $e->getMessage();
				}
			}
			else {
				echo '<script>alert("無法儲存寄送地址/聯絡電話");</script>';
				echo '<script>location.assign("index.php?route=pay&order='.$_GET['ordno'].'")</script>';
				return;
			}
		}
	}
}

else {
	router('index');
}
