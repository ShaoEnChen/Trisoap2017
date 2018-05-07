<?php
include_once("../library/mail.php");
include_once("../library/AllPay.Payment.Integration.php");
include_once("../resource/database.php");
include_once("../resource/custom.php");

try
{
	$obj = new AllInOne();
 	// AllPay Service Parameter
 	$obj->HashKey     = 'bwqFcafJNX4GzAWO';
    $obj->HashIV      = 'mJf0B3ONPbCfwkmF';
    $obj->MerchantID  = '1385617';
	// FeedBack Parameter
 	$arFeedback = $obj->CheckOutFeedback();
 	/* 檢核與變更訂單狀態 */
 	if (sizeof($arFeedback) > 0) {
 		foreach ($arFeedback as $key => $value){
 			switch ($key)
 			{
	 			/* 支付後的回傳的基本參數 */
	 			case "MerchantID": $szMerchantID = $value; break;
				case "MerchantTradeNo": $szMerchantTradeNo = $value; break;
				case "PaymentDate": $szPaymentDate = $value; break;
				case "PaymentType": $szPaymentType = $value; break;
				case "PaymentTypeChargeFee": $szPaymentTypeChargeFee = $value; break;
				case "RtnCode": $szRtnCode = $value; break;
				case "RtnMsg": $szRtnMsg = $value; break;
				case "SimulatePaid": $szSimulatePaid = $value; break;
				case "TradeAmt": $szTradeAmt = $value; break;
				case "TradeDate": $szTradeDate = $value; break;
				case "TradeNo": $szTradeNo = $value; break;
				case "PayAmt": $szPayAmt = $value; break;
				case "RedeemAmt": $szRedeemAmt = $value; break;
				default: break;
			}
 		}

 		if ($szRtnCode == 1) {
 			date_default_timezone_set('Asia/Taipei');
			$date = date("Y-m-d H:i:s");
 			$queryORDMAS = mysql_query("SELECT * FROM ORDMAS WHERE MerchantTradeNo='$szMerchantTradeNo'");
		    $fetchORDMAS = mysql_fetch_array($queryORDMAS);
		    $email = $fetchORDMAS['EMAIL'];
 			$ordno = get_ordno();
 			$paytype = transfer_PaymentType($szPaymentType);
 			$sql2 = "UPDATE ORDMAS SET ORDNO='$ordno', PAYTYPE='$paytype', PAYSTAT='1', REALPRICE='$szPayAmt' WHERE MerchantTradeNo='$szMerchantTradeNo'";
		    if (mysql_query($sql2)) {
		    	mysql_query("INSERT INTO ORDMAS (ORDNO, EMAIL, SHIPFEE, CREATEDATE, UPDATEDATE) VALUES ('0', '$email', '70', '$date', '$date')");
		    	mysql_query("UPDATE ORDITEMMAS SET ORDNO='$ordno' WHERE ORDNO='0' AND EMAIL='$email'");
		    	update_ordno();
		    }
		    mysql_query("UPDATE CUSMAS SET DISCOUNT='0' WHERE EMAIL='$email'");
		    $discount = $fetchORDMAS['DCTID'];
		    $queryDCTMAS = mysql_query("SELECT * FROM DCTMAS WHERE DCTID='$discount'");
		    $fetchDCTMAS = mysql_fetch_array($queryDCTMAS);
		    $dctstat = $fetchDCTMAS['DCTSTAT'];
		    $update = ($dctstat == 1) ? "UPDATE DCTMAS SET DCTSTAT='0', USEDATE='$date' WHERE DCTID='$discount'" : "UPDATE DCTMAS SET USEDATE='$date' WHERE DCTID='$discount'";
		    mysql_query($update);
		    mail_receive_order_notice();
		    print '1|OK'; // tell AllPay that we get the feedback
 		}
 	}
 	else {
 		print '0|Fail';
 	}
}

catch (Exception $e){
	print '0|' . $e->getMessage();
}

function transfer_PaymentType($paytype) {
	$split = explode('_', $paytype);
	if ($split[0] == 'Credit') {
		return 'A';
	}
	else if ($split[0] == 'ATM') {
		return 'B';
	}
	else if ($split[0] == 'WebATM') {
		return 'C';
	}
	else {
		return 'F';
	}
}