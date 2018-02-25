<?php
include_once("../resource/database.php");
include_once("../resource/custom.php");
include_once("../library/message.php");
include_once("../library/mail.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	if ($_GET['module'] == 'order') {
		if ($_GET['event'] == 'create') {
			$message = create($_GET['account'], $_GET['token'], $_GET['num_1'], $_GET['num_2'], $_GET['num_3'], $_GET['num_4'], $_GET['num_5'], $_GET['num_6'], $_GET['num_7'], $_GET['num_8'], $_GET['priceType'], $_GET['notice'], (isset($_POST['setPrice']) ? $_POST['setPrice'] : ''));
			if (is_array($message)) {
				echo json_encode(array('message' => $message['message'], 'ORDNO' => $message['ORDNO']));
				return;
			}
			else {
				echo json_encode(array('message' => $message));
				return;
			}
		}
		elseif ($_GET['event'] == 'active') {
			$message = active($_GET['account'], $_GET['token'], $_GET['index']);
			echo json_encode(array('message' => $message));
			return;
		}
		elseif ($_GET['event'] == 'outstock') {
			$message = outstock($_GET['account'], $_GET['token'], $_GET['index']);
			echo json_encode(array('message' => $message));
			return;
		}
		elseif ($_GET['event'] == 'complete') {
			$message = complete($_GET['account'], $_GET['token'], $_GET['index'], $_GET['invoice']);
			echo json_encode(array('message' => $message));
			return;
		}
		elseif ($_GET['event'] == 'close') {
			$message = close($_GET['account'], $_GET['token'], $_GET['index']);
			echo json_encode(array('message' => $message));
			return;
		}
		elseif ($_GET['event'] == 'detail') {
			$message = detail($_GET['account'], $_GET['token'], $_GET['index']);
			if (is_array($message)) {
				echo json_encode(array('message' => $message['message'], 'content' => $message['content']));
				return;
			}
			else {
				echo json_encode(array('message' => $message));
				return;
			}
		}
		elseif ($_GET['event'] == 'delete') {
			$message = delete($_GET['account'], $_GET['token'], $_GET['index']);
			echo json_encode(array('message' => $message));
			return;
		}
		elseif ($_GET['event'] == 'search') {
			$message = search($_GET['account'], $_GET['token'], $_GET['key'], $_GET['value']);
			if (is_array($message)) {
				echo json_encode(array('message' => $message['message'], 'content' => $message['content']));
				return;
			}
			else {
				echo json_encode(array('message' => $message));
				return;
			}
		}
		elseif ($_GET['event'] == 'operate') {
			$message = operate($_GET['account'], $_GET['token'], $_GET['state']);
			if (is_array($message)) {
				echo $message['content'];
				return;
			}
			else {
				echo $message;
				return;
			}
		}
		elseif ($_GET['event'] == 'show') {
			$message = show($_GET['account'], $_GET['token']);
			if (is_array($message)) {
				echo $message['content'];
				return;
			}
			else {
				echo $message;
				return;
			}
		}
		elseif ($_GET['event'] == 'cusOperate') {
			$message = cusOperate($_GET['account'], $_GET['token']);
			if (is_array($message)) {
				echo $message['content'];
				return;
			}
			else {
				echo $message;
				return;
			}
		}
		else {
			echo json_encode(array('message' => 'Invalid event called'));
    		return;
		}
	}
	else {
		echo json_encode(array('message' => 'Invalid module called'));
    	return;
	}
}

elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if ($_POST['module'] == 'order') {
		if ($_POST['event'] == 'create') {
			$message = create($_POST['account'], $_POST['token'], $_POST['num_1'], $_POST['num_2'], $_POST['num_3'], $_POST['num_4'], $_POST['num_5'], $_POST['num_6'], $_POST['num_7'], $_POST['num_8'], $_POST['priceType'], $_POST['notice'], (isset($_POST['setPrice']) ? $_POST['setPrice'] : ''));
			if (is_array($message)) {
				echo json_encode(array('message' => $message['message'], 'ORDNO' => $message['ORDNO']));
				return;
			}
			else {
				echo json_encode(array('message' => $message));
				return;
			}
		}
		elseif ($_POST['event'] == 'active') {
			$message = active($_POST['account'], $_POST['token'], $_POST['index']);
			echo json_encode(array('message' => $message));
			return;
		}
		elseif ($_POST['event'] == 'outstock') {
			$message = outstock($_POST['account'], $_POST['token'], $_POST['index']);
			echo json_encode(array('message' => $message));
			return;
		}
		elseif ($_POST['event'] == 'complete') {
			$message = complete($_POST['account'], $_POST['token'], $_POST['index'], $_POST['invoice']);
			echo json_encode(array('message' => $message));
			return;
		}
		elseif ($_POST['event'] == 'close') {
			$message = close($_POST['account'], $_POST['token'], $_POST['index']);
			echo json_encode(array('message' => $message));
			return;
		}
		elseif ($_POST['event'] == 'detail') {
			$message = detail($_POST['account'], $_POST['token'], $_POST['index']);
			if (is_array($message)) {
				echo json_encode(array('message' => $message['message'], 'content' => $message['content']));
				return;
			}
			else {
				echo json_encode(array('message' => $message));
				return;
			}
		}
		elseif ($_POST['event'] == 'delete') {
			$message = delete($_POST['account'], $_POST['token'], $_POST['index']);
			echo json_encode(array('message' => $message));
			return;
		}
		elseif ($_POST['event'] == 'search') {
			$message = search($_POST['account'], $_POST['token'], $_POST['key'], $_POST['value']);
			if (is_array($message)) {
				echo json_encode(array('message' => $message['message'], 'content' => $message['content']));
				return;
			}
			else {
				echo json_encode(array('message' => $message));
				return;
			}
		}
		elseif ($_POST['event'] == 'operate') {
			$message = operate($_POST['account'], $_POST['token'], $_POST['state']);
			if (is_array($message)) {
				echo $message['content'];
				return;
			}
			else {
				echo $message;
				return;
			}
		}
		elseif ($_POST['event'] == 'show') {
			$message = show($_POST['account'], $_POST['token']);
			if (is_array($message)) {
				echo $message['content'];
				return;
			}
			else {
				echo $message;
				return;
			}
		}
		elseif ($_POST['event'] == 'cusOperate') {
			$message = cusOperate($_POST['account'], $_POST['token']);
			if (is_array($message)) {
				echo $message['content'];
				return;
			}
			else {
				echo $message;
				return;
			}
		}
		else {
			echo json_encode(array('message' => 'Invalid event called'));
    		return;
		}
	}
	else {
		echo json_encode(array('message' => 'Invalid module called'));
    	return;
	}
}

else {
	echo json_encode(array('message' => 'Invalid request method'));
    return;
}

function create($account, $token, $num_1, $num_2, $num_3, $num_4, $num_5, $num_6, $num_7, $num_8, $priceType, $notice, $setPrice='') {
	$sql1 = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$account'");
	$fetch1 = mysql_fetch_array($sql1);
	if (empty($account)) {
		return 'Empty account';
	}
	elseif (mysql_num_rows($sql1) == 0) {
		return 'Unregistered account';
	}
	elseif (empty($token)) {
		return 'Not logged in';
	}
	elseif ($fetch1['TOKEN'] != md5($account.$token)) {
		return 'Wrong token';
	}
	elseif (!is_nonnegativeInt($num_1)) {
		return 'Wrong amount format';
	}
	elseif (!is_nonnegativeInt($num_2)) {
		return 'Wrong amount format';
	}
	elseif (!is_nonnegativeInt($num_3)) {
		return 'Wrong amount format';
	}
	elseif (!is_nonnegativeInt($num_4)) {
		return 'Wrong amount format';
	}
	elseif (!is_nonnegativeInt($num_5)) {
		return 'Wrong amount format';
	}
	elseif (!is_nonnegativeInt($num_6)) {
		return 'Wrong amount format';
	}
	elseif (!is_nonnegativeInt($num_7)) {
		return 'Wrong amount format';
	}
	elseif (!is_nonnegativeInt($num_8)) {
		return 'Wrong amount format';
	}
	elseif (empty($priceType)) {
		return 'Empty price type';
	}
	else {
		if ($priceType == 'A') {
			if (empty($setPrice)) {
				return 'Empty price';
			}
			else {
				$ORDNO = get_ordno();
				date_default_timezone_set('Asia/Taipei');
				$date = date("Y-m-d H:i:s");
				$sql2 = "INSERT INTO ORDMAS (ORDNO, EMAIL, ORDINST, TOTALPRICE, SHIPFEE, CREATEDATE, UPDATEDATE) VALUES ('$ORDNO', '$account', '$notice', '$setPrice', '0', '$date', '$date')";
				if (mysql_query($sql2)) {
					update_ordno();
					if (is_positiveInt($num_1)) {
						mysql_query("INSERT INTO ORDITEMMAS (ORDNO, ITEMNO, ORDAMT, EMAIL, CREATEDATE, UPDATEDATE) VALUES ('$ORDNO', '1', '$num_1', '$account', '$date', '$date')");
					}
					if (is_positiveInt($num_2)) {
						mysql_query("INSERT INTO ORDITEMMAS (ORDNO, ITEMNO, ORDAMT, EMAIL, CREATEDATE, UPDATEDATE) VALUES ('$ORDNO', '2', '$num_2', '$account', '$date', '$date')");
					}
					if (is_positiveInt($num_3)) {
						mysql_query("INSERT INTO ORDITEMMAS (ORDNO, ITEMNO, ORDAMT, EMAIL, CREATEDATE, UPDATEDATE) VALUES ('$ORDNO', '3', '$num_3', '$account', '$date', '$date')");
					}
					if (is_positiveInt($num_4)) {
						mysql_query("INSERT INTO ORDITEMMAS (ORDNO, ITEMNO, ORDAMT, EMAIL, CREATEDATE, UPDATEDATE) VALUES ('$ORDNO', '4', '$num_4', '$account', '$date', '$date')");
					}
					if (is_positiveInt($num_5)) {
						mysql_query("INSERT INTO ORDITEMMAS (ORDNO, ITEMNO, ORDAMT, EMAIL, CREATEDATE, UPDATEDATE) VALUES ('$ORDNO', '5', '$num_5', '$account', '$date', '$date')");
					}
					if (is_positiveInt($num_6)) {
						mysql_query("INSERT INTO ORDITEMMAS (ORDNO, ITEMNO, ORDAMT, EMAIL, CREATEDATE, UPDATEDATE) VALUES ('$ORDNO', '6', '$num_6', '$account', '$date', '$date')");
					}
					if (is_positiveInt($num_7)) {
						mysql_query("INSERT INTO ORDITEMMAS (ORDNO, ITEMNO, ORDAMT, EMAIL, CREATEDATE, UPDATEDATE) VALUES ('$ORDNO', '7', '$num_7', '$account', '$date', '$date')");
					}
					if (is_positiveInt($num_8)) {
						mysql_query("INSERT INTO ORDITEMMAS (ORDNO, ITEMNO, ORDAMT, EMAIL, CREATEDATE, UPDATEDATE) VALUES ('$ORDNO', '8', '$num_8', '$account', '$date', '$date')");
					}
					return array('message' => 'Success', 'ORDNO' => $ORDNO);
				}
				else {
					return 'Database operation error';
				}
			}
		}
		else {
			$total = 0;
			$total += $num_1 * query_price('1');
			$total += $num_2 * query_price('2');
			$total += $num_3 * query_price('3');
			$total += $num_4 * query_price('4');
			$total += $num_5 * query_price('5');
			$total += $num_6 * query_price('6');
			$total += $num_7 * query_price('7');
			$total += $num_8 * query_price('8');
			if ($priceType == 'C') {
				$total = $total * 0.9;
			}
			elseif ($priceType == 'D') {
				$total = $total * 0.8;
			}
			elseif ($priceType == 'E') {
				$total = $total * 0.7;
			}
			elseif ($priceType == 'F') {
				$total = $total * 0.6;
			}
			elseif ($priceType == 'G') {
				$total = $total * 0.5;
			}
			$shipfee = ($total >= 777) ? 0 : 70;
			$ORDNO = get_ordno();
			date_default_timezone_set('Asia/Taipei');
			$date = date("Y-m-d H:i:s");
			$sql2 = "INSERT INTO ORDMAS (ORDNO, EMAIL, ORDINST, TOTALPRICE, SHIPFEE, CREATEDATE, UPDATEDATE) VALUES ('$ORDNO', '$account', '$notice', '$total', '$shipfee', '$date', '$date')";
			if (mysql_query($sql2)) {
				update_ordno();
				if (is_positiveInt($num_1)) {
					mysql_query("INSERT INTO ORDITEMMAS (ORDNO, ITEMNO, ORDAMT, EMAIL, CREATEDATE, UPDATEDATE) VALUES ('$ORDNO', '1', '$num_1', '$account', '$date', '$date')");
				}
				if (is_positiveInt($num_2)) {
					mysql_query("INSERT INTO ORDITEMMAS (ORDNO, ITEMNO, ORDAMT, EMAIL, CREATEDATE, UPDATEDATE) VALUES ('$ORDNO', '2', '$num_2', '$account', '$date', '$date')");
				}
				if (is_positiveInt($num_3)) {
					mysql_query("INSERT INTO ORDITEMMAS (ORDNO, ITEMNO, ORDAMT, EMAIL, CREATEDATE, UPDATEDATE) VALUES ('$ORDNO', '3', '$num_3', '$account', '$date', '$date')");
				}
				if (is_positiveInt($num_4)) {
					mysql_query("INSERT INTO ORDITEMMAS (ORDNO, ITEMNO, ORDAMT, EMAIL, CREATEDATE, UPDATEDATE) VALUES ('$ORDNO', '4', '$num_4', '$account', '$date', '$date')");
				}
				if (is_positiveInt($num_5)) {
					mysql_query("INSERT INTO ORDITEMMAS (ORDNO, ITEMNO, ORDAMT, EMAIL, CREATEDATE, UPDATEDATE) VALUES ('$ORDNO', '5', '$num_5', '$account', '$date', '$date')");
				}
				if (is_positiveInt($num_6)) {
					mysql_query("INSERT INTO ORDITEMMAS (ORDNO, ITEMNO, ORDAMT, EMAIL, CREATEDATE, UPDATEDATE) VALUES ('$ORDNO', '6', '$num_6', '$account', '$date', '$date')");
				}
				if (is_positiveInt($num_7)) {
					mysql_query("INSERT INTO ORDITEMMAS (ORDNO, ITEMNO, ORDAMT, EMAIL, CREATEDATE, UPDATEDATE) VALUES ('$ORDNO', '7', '$num_7', '$account', '$date', '$date')");
				}
				if (is_positiveInt($num_8)) {
					mysql_query("INSERT INTO ORDITEMMAS (ORDNO, ITEMNO, ORDAMT, EMAIL, CREATEDATE, UPDATEDATE) VALUES ('$ORDNO', '8', '$num_8', '$account', '$date', '$date')");
				}
				return array('message' => 'Success', 'ORDNO' => $ORDNO);
			}
			else {
				return 'Database operation error';
			}
		}
	}
}

function active($account, $token, $index) {
	$sql1 = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$account'");
	$fetch1 = mysql_fetch_array($sql1);
	$sql2 = mysql_query("SELECT * FROM ORDMAS WHERE ORDNO='$index'");
	$fetch2 = mysql_fetch_array($sql2);
	if (empty($account)) {
		return 'Empty account';
	}
	elseif (mysql_num_rows($sql1) == 0) {
		return 'Unregistered account';
	}
	elseif (empty($token)) {
		return 'Not logged in';
	}
	elseif ($fetch1['TOKEN'] != md5($account.$token)) {
		return 'Wrong token';
	}
	elseif ($fetch1['CUSIDT'] != 'A') {
		return 'No authority';
	}
	elseif (empty($index)) {
		return 'Empty order number';
	}
	elseif (mysql_num_rows($sql2) == 0) {
		return 'Unregistered order';
	}
	elseif ($fetch2['ORDSTAT'] == 'C') {
		return 'Wrong order state';
	}
	else {
		if ($fetch2['ORDSTAT'] == 'E') {
			$email = $fetch2['EMAIL'];
			$sql3 = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$email'");
			$fetch3 = mysql_fetch_array($sql3);
			mail_receive_order($email, $index, $fetch2['PAYTYPE'], $fetch3['CUSNM']);
		}
		date_default_timezone_set('Asia/Taipei');
		$date = date("Y-m-d H:i:s");
		$sql4 = "UPDATE ORDMAS SET ORDSTAT='R', BACKSTAT='0', UPDATEDATE='$date' WHERE ORDNO='$index'";
		if (mysql_query($sql4)) {
			return 'Success';
		}
		else {
			return 'Database operation error';
		}
	}
}

function outstock($account, $token, $index) {
	$sql1 = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$account'");
	$fetch1 = mysql_fetch_array($sql1);
	$sql2 = mysql_query("SELECT * FROM ORDMAS WHERE ORDNO='$index'");
	$fetch2 = mysql_fetch_array($sql2);
	if (empty($account)) {
		return 'Empty account';
	}
	elseif (mysql_num_rows($sql1) == 0) {
		return 'Unregistered account';
	}
	elseif (empty($token)) {
		return 'Not logged in';
	}
	elseif ($fetch1['TOKEN'] != md5($account.$token)) {
		return 'Wrong token';
	}
	elseif ($fetch1['CUSIDT'] != 'A') {
		return 'No authority';
	}
	elseif (empty($index)) {
		return 'Empty order number';
	}
	elseif (mysql_num_rows($sql2) == 0) {
		return 'Unregistered order';
	}
	elseif ($fetch2['ORDSTAT'] != 'R' && $fetch2['ORDSTAT'] != 'F') {
		return 'Wrong order state';
	}
	else {
		date_default_timezone_set('Asia/Taipei');
		$date = date("Y-m-d H:i:s");
		$sql3 = "UPDATE ORDMAS SET BACKSTAT='1', UPDATEDATE='$date' WHERE ORDNO='$index'";
		if (mysql_query($sql3)) {
			return 'Success';
		}
		else {
			return 'Database operation error';
		}
	}
}

function complete($account, $token, $index, $invoice) {
	$sql1 = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$account'");
	$fetch1 = mysql_fetch_array($sql1);
	$sql2 = mysql_query("SELECT * FROM ORDMAS WHERE ORDNO='$index'");
	$fetch2 = mysql_fetch_array($sql2);
	if (empty($account)) {
		return 'Empty account';
	}
	elseif (mysql_num_rows($sql1) == 0) {
		return 'Unregistered account';
	}
	elseif (empty($token)) {
		return 'Not logged in';
	}
	elseif ($fetch1['TOKEN'] != md5($account.$token)) {
		return 'Wrong token';
	}
	elseif ($fetch1['CUSIDT'] != 'A') {
		return 'No authority';
	}
	elseif (empty($index)) {
		return 'Empty order number';
	}
	elseif (mysql_num_rows($sql2) == 0) {
		return 'Unregistered order';
	}
	elseif ($fetch2['ORDSTAT'] != 'R') {
		return 'Wrong order state';
	}
	elseif (empty($invoice)) {
		return 'Empty invoice number';
	}
	elseif (!preg_match('/^[A-Z]{2}[0-9]{8}$/', $invoice)) {
		return 'Wrong invoice number';
	}
	else {
		mail_pass_order($fetch2['EMAIL'], $index);
		message_pass_order($fetch1['TEL'], $index);
		date_default_timezone_set('Asia/Taipei');
		$date = date("Y-m-d H:i:s");
		$sql3 = "UPDATE ORDMAS SET ORDSTAT='C', INVOICENO='$invoice', UPDATEDATE='$date' WHERE ORDNO='$index'";
		if (mysql_query($sql3)) {
			return 'Success';
		}
		else {
			return 'Database operation error';
		}
	}
}

function close($account, $token, $index) {
	$sql1 = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$account'");
	$fetch1 = mysql_fetch_array($sql1);
	$sql2 = mysql_query("SELECT * FROM ORDMAS WHERE ORDNO='$index'");
	$fetch2 = mysql_fetch_array($sql2);
	if (empty($account)) {
		return 'Empty account';
	}
	elseif (mysql_num_rows($sql1) == 0) {
		return 'Unregistered account';
	}
	elseif (empty($token)) {
		return 'Not logged in';
	}
	elseif ($fetch1['TOKEN'] != md5($account.$token)) {
		return 'Wrong token';
	}
	elseif ($fetch1['CUSIDT'] != 'A') {
		return 'No authority';
	}
	elseif (empty($index)) {
		return 'Empty order number';
	}
	elseif (mysql_num_rows($sql2) == 0) {
		return 'Unregistered order';
	}
	elseif ($fetch2['ORDSTAT'] == 'C') {
		return 'Wrong order state';
	}
	else {
		date_default_timezone_set('Asia/Taipei');
		$date = date("Y-m-d H:i:s");
		$sql3 = "UPDATE ORDMAS SET ORDSTAT='F', BACKSTAT='0', UPDATEDATE='$date' WHERE ORDNO='$index'";
		if (mysql_query($sql3)) {
			return 'Success';
		}
		else {
			return 'Database operation error';
		}
	}
}

function detail($account, $token, $index) {
	$sql1 = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$account'");
	$fetch1 = mysql_fetch_array($sql1);
	$sql2 = mysql_query("SELECT * FROM ORDMAS WHERE ORDNO='$index' AND ACTCODE='1'");
	$sql3 = mysql_query("SELECT * FROM ORDITEMMAS WHERE ORDNO='$index' AND ACTCODE='1'");
	if (empty($account)) {
		return 'Empty account';
	}
	elseif (mysql_num_rows($sql1) == 0) {
		return 'Unregistered account';
	}
	elseif (empty($token)) {
		return 'Not logged in';
	}
	elseif ($fetch1['TOKEN'] != md5($account.$token)) {
		return 'Wrong token';
	}
	else {
		$fetch2 = mysql_fetch_array($sql2);
		$content = '<table><tbody>';
		$content .= '<tr><td>訂單編號</td><td>'.$fetch2['ORDNO'].'</td></tr>';
		$content .= '<tr><td>顧客信箱</td><td>'.$fetch2['EMAIL'].'</td></tr>';
		$content .= '<tr><td>發票編號</td><td>'.$fetch2['INVOICENO'].'</td></tr>';
		$content .= '<tr><td>缺貨狀態</td><td>'.$fetch2['BACKSTAT'].'</td></tr>';
		$content .= '<tr><td>訂單狀態</td><td>'.$fetch2['ORDSTAT'].'</td></tr>';
		$content .= '<tr><td>付款方式</td><td>'.$fetch2['PAYTYPE'].'</td></tr>';
		$content .= '<tr><td colspan=3>------------------------------------------------</td></tr>';
		$content .= '<tr><td>商品名稱</td><td>商品單價</td><td>訂購數量</td></tr>';
		while ($fetch3 = mysql_fetch_array($sql3)) {
			$content .= '<tr><td>'.query_name($fetch3['ITEMNO']).'</td><td>'.query_price($fetch3['ITEMNO']).'</td><td>'.$fetch3['ORDAMT'].'</td></tr>';
		}
		$content .= '<tr><td colspan=3>------------------------------------------------</td></tr>';
		$content .= '<tr><td>訂單金額</td><td>'.$fetch2['TOTALPRICE'].'</td></tr>';
		$content .= '<tr><td>運費</td><td>'.$fetch2['SHIPFEE'].'</td></tr>';
		$content .= '<tr><td>實收金額</td><td>'.$fetch2['REALPRICE'].'</td></tr>';
		$content .= '<tr><td>建立日期</td><td>'.$fetch2['CREATEDATE'].'</td></tr>';
		$content .= '</tbody></table>';
		return array('message' => 'Success', 'content' => $content);
	}
}

function delete($account, $token, $index) {
	$sql1 = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$account'");
	$fetch1 = mysql_fetch_array($sql1);
	$sql2 = mysql_query("SELECT * FROM ORDMAS WHERE ORDNO='$index'");
	$fetch2 = mysql_fetch_array($sql2);
	if (empty($account)) {
		return 'Empty account';
	}
	elseif (mysql_num_rows($sql1) == 0) {
		return 'Unregistered account';
	}
	elseif (empty($token)) {
		return 'Not logged in';
	}
	elseif ($fetch1['TOKEN'] != md5($account.$token)) {
		return 'Wrong token';
	}
	elseif (empty($index)) {
		return 'Empty order number';
	}
	elseif (mysql_num_rows($sql2) == 0) {
		return 'Unregistered order';
	}
	elseif ($fetch2['ORDSTAT'] != 'E') {
		return '無法取消已開始執行之訂單';
	}
	elseif ($fetch2['PAYSTAT'] == '1') {
		return '無法取消已付款之訂單';
	}
	else {
		date_default_timezone_set('Asia/Taipei');
		$date = date("Y-m-d H:i:s");
		$sql3 = "UPDATE ORDMAS SET ACTCODE='0', UPDATEDATE='$date' WHERE ORDNO='$index'";
		if (mysql_query($sql3)) {
			return 'Success';
		}
		else {
			return 'Database operation error';
		}
	}
}

function search($account, $token, $key, $value) {
	$sql1 = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$account'");
	$fetch1 = mysql_fetch_array($sql1);
	if (empty($account)) {
		return 'Empty account';
	}
	elseif (mysql_num_rows($sql1) == 0) {
		return 'Unregistered account';
	}
	elseif (empty($token)) {
		return 'Not logged in';
	}
	elseif ($fetch1['TOKEN'] != md5($account.$token)) {
		return 'Wrong token';
	}
	elseif ($fetch1['CUSIDT'] != 'A') {
		return 'No authority';
	}
	else {
		$content = '';
		$sql2 = mysql_query("SELECT * FROM ORDMAS WHERE $key='$value' AND ACTCODE='1' ORDER BY UPDATEDATE DESC");
		while ($fetch2 = mysql_fetch_array($sql2)) {
			$content .= '<tr>';
			$content .= '<td data-title="訂單編號	">' . $fetch2['ORDNO'] . '</td>';
			$content .= '<td data-title="發票編號">' . $fetch2['INVOICENO'] . '</td>';
			$content .= '<td data-title="缺貨狀態">' . $fetch2['BACKSTAT'] . '</td>';
			$content .= '<td data-title="訂單狀態">' . $fetch2['ORDSTAT'] . '</td>';
			$content .= '<td data-title="付款狀態">' . $fetch2['PAYSTAT'] . '</td>';
			$content .= '<td data-title="訂單總額">' . $fetch2['TOTALPRICE'] . '</td>';
			$content .= '<td data-title="運費">' . $fetch2['SHIPFEE'] . '</td>';
			$content .= '<td data-title="實收金額">' . $fetch2['REALPRICE'] . '</td>';
			$content .= '<td data-title="建立日期">' . $fetch2['CREATEDATE'] . '</td>';
			$content .= '</tr>';
		}
		return array('message' => 'Success', 'content' => $content);
	}
}

function operate($account, $token, $state='E') {
	$sql1 = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$account'");
	$fetch1 = mysql_fetch_array($sql1);
	if (empty($account)) {
		return 'Empty account';
	}
	elseif (mysql_num_rows($sql1) == 0) {
		return 'Unregistered account';
	}
	elseif (empty($token)) {
		return 'Not logged in';
	}
	elseif ($fetch1['TOKEN'] != md5($account.$token)) {
		return 'Wrong token';
	}
	elseif ($fetch1['CUSIDT'] != 'A') {
		return 'No authority';
	}
	else {
		$content = '';
		$sql2 = ($state == '1') ?
			mysql_query("SELECT * FROM ORDMAS WHERE ORDSTAT='R' AND BACKSTAT='1' AND ACTCODE='1' ORDER BY CREATEDATE ASC") :
			mysql_query("SELECT * FROM ORDMAS WHERE ORDNO>0 AND ORDSTAT='$state' AND BACKSTAT='0' AND ACTCODE='1' ORDER BY CREATEDATE ASC");
		while ($fetch2 = mysql_fetch_array($sql2)) {
			$content .= '<tr>';
			$content .= '<td data-title="訂單編號	">' . $fetch2['ORDNO'] . '</td>';
			$content .= '<td data-title="發票編號">' . $fetch2['INVOICENO'] . '</td>';
			$content .= '<td data-title="缺貨狀態">' . $fetch2['BACKSTAT'] . '</td>';
			$content .= '<td data-title="訂單狀態">' . $fetch2['ORDSTAT'] . '</td>';
			$content .= '<td data-title="付款狀態">' . $fetch2['PAYSTAT'] . '</td>';
			$content .= '<td data-title="訂單總額">' . $fetch2['TOTALPRICE'] . '</td>';
			$content .= '<td data-title="運費">' . $fetch2['SHIPFEE'] . '</td>';
			$content .= '<td data-title="實收金額">' . $fetch2['REALPRICE'] . '</td>';
			$content .= '<td data-title="建立日期">' . $fetch2['CREATEDATE'] . '</td>';

			if ($state == 'E') {
				$content .= '<td data-title="操作">';
				$content .= '<button class="neural-btn" onclick="orderDetail(\'' . $fetch2['ORDNO'] . '\')">查看</button>';
				$content .= '<button class="neural-btn" onclick="orderActive(\'' . $fetch2['ORDNO'] . '\')">執行</button>';
				$content .= '<button class="neural-btn" onclick="orderClose(\'' . $fetch2['ORDNO'] . '\')">結束</button>';
				$content .= '</td>';
			}
			elseif ($state == 'R') {
				$content .= '<td data-title="操作">';
				$content .= '<button class="neural-btn" onclick="orderDetail(\'' . $fetch2['ORDNO'] . '\')">查看</button>';
				$content .= '<button class="neural-btn" onclick="orderOutstock(\'' . $fetch2['ORDNO'] . '\')">缺貨</button>';
				$content .= '<button class="neural-btn" onclick="orderComplete(\'' . $fetch2['ORDNO'] . '\')">完成</button>';
				$content .= '<button class="neural-btn" onclick="orderClose(\'' . $fetch2['ORDNO'] . '\')">結束</button>';
				$content .= '</td>';
			}
			elseif ($state == '1') {
				$content .= '<td data-title="操作">';
				$content .= '<button class="neural-btn" onclick="orderDetail(\'' . $fetch2['ORDNO'] . '\')">查看</button>';
				$content .= '<button class="neural-btn" onclick="orderActive(\'' . $fetch2['ORDNO'] . '\')">執行</button>';
				$content .= '<button class="neural-btn" onclick="orderClose(\'' . $fetch2['ORDNO'] . '\')">結束</button>';
				$content .= '</td>';
			}
			elseif ($state == 'C') {
				$content .= '<td data-title="操作">';
				$content .= '<button class="neural-btn" onclick="orderDetail(\'' . $fetch2['ORDNO'] . '\')">查看</button>';
				$content .= '</td>';
			}
			elseif ($state == 'F') {
				$content .= '<td data-title="操作">';
				$content .= '<button class="neural-btn" onclick="orderDetail(\'' . $fetch2['ORDNO'] . '\')">查看</button>';
				$content .= '<button class="neural-btn" onclick="orderActive(\'' . $fetch2['MSGNO'] . '\')">執行</button>';
				$content .= '<button class="neural-btn" onclick="orderOutstock(\'' . $fetch2['MSGNO'] . '\')">缺貨</button>';
				$content .= '</td>';
			}

			$content .= '</tr>';

			$content .= '<tr>';
			$content .= '<td id="' . $fetch2['ORDNO'] . '" class="order-detail" colspan=10>';
			$content .= '</td>';
			$content .= '</tr>';
		}
		return array('message' => 'Success', 'content' => $content);
	}
}

function show($account, $token) {
	$sql1 = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$account'");
	$fetch1 = mysql_fetch_array($sql1);
	if (empty($account)) {
		return 'Empty account';
	}
	elseif (mysql_num_rows($sql1) == 0) {
		return 'Unregistered account';
	}
	elseif (empty($token)) {
		return 'Not logged in';
	}
	elseif ($fetch1['TOKEN'] != md5($account.$token)) {
		return 'Wrong token';
	}
	elseif ($fetch1['CUSIDT'] != 'A') {
		return 'No authority';
	}
	else {
		$content = '';
		$sql2 = mysql_query("SELECT * FROM ORDMAS WHERE ORDNO>0 ORDER BY UPDATEDATE DESC");
		while ($fetch2 = mysql_fetch_array($sql2)) {
			$content .= '<tr>';
			$content .= '<td data-title="訂單編號	">' . $fetch2['ORDNO'] . '</td>';
			$content .= '<td data-title="發票編號">' . $fetch2['INVOICENO'] . '</td>';
			$content .= '<td data-title="缺貨狀態">' . $fetch2['BACKSTAT'] . '</td>';
			$content .= '<td data-title="訂單狀態">' . $fetch2['ORDSTAT'] . '</td>';
			$content .= '<td data-title="付款狀態">' . $fetch2['PAYSTAT'] . '</td>';
			$content .= '<td data-title="訂單總額">' . $fetch2['TOTALPRICE'] . '</td>';
			$content .= '<td data-title="運費">' . $fetch2['SHIPFEE'] . '</td>';
			$content .= '<td data-title="實收金額">' . $fetch2['REALPRICE'] . '</td>';
			$content .= '<td data-title="建立日期">' . $fetch2['CREATEDATE'] . '</td>';
			$content .= '</tr>';
		}
		return array('message' => 'Success', 'content' => $content);
	}
}

function cusOperate($account, $token) {
	$sql1 = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$account'");
	$fetch1 = mysql_fetch_array($sql1);
	if (empty($account)) {
		return 'Empty account';
	}
	elseif (mysql_num_rows($sql1) == 0) {
		return 'Unregistered account';
	}
	elseif (empty($token)) {
		return 'Not logged in';
	}
	elseif ($fetch1['TOKEN'] != md5($account.$token)) {
		return 'Wrong token';
	}
	else {
		$content = '';
		$sql2 = mysql_query("SELECT * FROM ORDMAS WHERE EMAIL='$account' AND ORDNO>0 AND ACTCODE='1' ORDER BY CREATEDATE DESC");
		while ($fetch2 = mysql_fetch_array($sql2)) {
			$content .= '<tr>';
			$content .= '<td data-title="訂單編號	">' . $fetch2['ORDNO'] . '</td>';
			$content .= '<td data-title="發票編號">' . $fetch2['INVOICENO'] . '</td>';
			$content .= '<td data-title="缺貨狀態">' . $fetch2['BACKSTAT'] . '</td>';
			$content .= '<td data-title="訂單狀態">' . $fetch2['ORDSTAT'] . '</td>';
			$content .= '<td data-title="付款狀態">' . $fetch2['PAYSTAT'] . '</td>';
			$content .= '<td data-title="訂單總額">' . $fetch2['TOTALPRICE'] . '</td>';
			$content .= '<td data-title="運費">' . $fetch2['SHIPFEE'] . '</td>';
			$content .= '<td data-title="實收金額">' . $fetch2['REALPRICE'] . '</td>';
			$content .= '<td data-title="建立日期">' . $fetch2['CREATEDATE'] . '</td>';
			$content .= '<td>';
			$content .= '<button class="neural-btn" onclick="orderDetail(\''.$fetch2['ORDNO'].'\')">查看</button>';
			$content .= '<button class="neural-btn" onclick="orderDelete(\''.$fetch2['ORDNO'].'\')">取消</button>';
			$content .= '</td>';
			$content .= '</tr>';
		}
		return array('message' => 'Success', 'content' => $content);
	}
}