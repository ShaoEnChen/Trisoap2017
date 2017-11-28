<?php
include_once("../resource/database.php");
include_once("../resource/custom.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	if ($_GET['module'] == 'orderitem') {
		if ($_GET['event'] == 'create') {
			$message = create($_GET['account'], $_GET['token'], $_GET['index'], $_GET['amount']);
			echo json_encode(array('message' => $message));
			return;
		}
		elseif ($_GET['event'] == 'cartDelete') {
			$message = cartDelete($_GET['account'], $_GET['token'], $_GET['index']);
			echo json_encode(array('message' => $message));
			return;
		}
		elseif ($_GET['event'] == 'search') {
			$message = search($_GET['account'], $_GET['token']);
			if (is_array($message)) {
				echo json_encode(array('message' => $message['message'], 'item' => $message['item'], 'amount' => $message['amonut']));
				return;
			}
			else {
				echo json_encode(array('message' => $message));
				return;
			}
		}
		elseif ($_GET['event'] == 'cartOperate') {
			$message = cartOperate($_GET['account'], $_GET['token']);
			if (is_array($message)) {
				echo $message['content'];
				return;
			}
			else {
				echo $message;
				return;
			}
		}
		elseif ($_GET['event'] == 'orderitemOperate') {
			$message = orderitemOperate($_GET['account'], $_GET['token'], $_GET['order']);
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
	if ($_POST['module'] == 'orderitem') {
		if ($_POST['event'] == 'create') {
			$message = create($_POST['account'], $_POST['token'], $_POST['index'], $_POST['amount']);
			echo json_encode(array('message' => $message));
			return;
		}
		elseif ($_POST['event'] == 'cartDelete') {
			$message = cartDelete($_POST['account'], $_POST['token'], $_POST['index']);
			echo json_encode(array('message' => $message));
			return;
		}
		elseif ($_POST['event'] == 'search') {
			$message = search($_POST['account'], $_POST['token']);
			if (is_array($message)) {
				echo json_encode(array('message' => $message['message'], 'item' => $message['item'], 'amount' => $message['amonut']));
				return;
			}
			else {
				echo json_encode(array('message' => $message));
				return;
			}
		}
		elseif ($_POST['event'] == 'cartOperate') {
			$message = cartOperate($_POST['account'], $_POST['token']);
			if (is_array($message)) {
				echo $message['content'];
				return;
			}
			else {
				echo $message;
				return;
			}
		}
		elseif ($_POST['event'] == 'orderitemOperate') {
			$message = orderitemOperate($_POST['account'], $_POST['token'], $_POST['order']);
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

function create($account, $token, $index, $amount) {
	$sql1 = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$account'");
	$fetch1 = mysql_fetch_array($sql1);
	$sql2 = mysql_query("SELECT * FROM ORDITEMMAS WHERE EMAIL='$account' AND ITEMNO='$index' AND ORDNO='0'");
	$sql3 = mysql_query("SELECT * FROM ITEMMAS WHERE ITEMNO='$index'");
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
		return 'Empty index';
	}
	elseif (mysql_num_rows($sql3) == 0) {
		return 'Unregistered item';
	}
	elseif (!is_nonnegativeInt($amount)) {
		return 'Wrong amount format';
	}
	else {
		date_default_timezone_set('Asia/Taipei');
		$date = date("Y-m-d H:i:s");
		$sql4 = (mysql_num_rows($sql2) == 0) ? "INSERT INTO ORDITEMMAS (ORDNO, ITEMNO, ORDAMT, EMAIL, CREATEDATE, UPDATEDATE) VALUES ('0', '$index', '$amount', '$account', '$date', '$date')" : "UPDATE ORDITEMMAS SET ORDAMT=ORDAMT+'$amount', UPDATEDATE='$date' WHERE EMAIL='$account' AND ITEMNO='$index' AND ORDNO='0'";
		if (mysql_query($sql4)) {
			orderRecalculate($account, '0');
			return 'Success';
		}
		else {
			return 'Database operation error';
		}
	}
}

function cartDelete($account, $token, $index) {
	$sql1 = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$account'");
	$fetch1 = mysql_fetch_array($sql1);
	$sql2 = mysql_query("SELECT * FROM ORDITEMMAS WHERE EMAIL='$account' AND ORDNO='0' AND ITEMNO='$index'");
	$sql3 = mysql_query("SELECT * FROM ITEMMAS WHERE ITEMNO='$index'");
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
		return 'Empty index';
	}
	elseif (mysql_num_rows($sql3) == 0) {
		return 'Unregistered item';
	}
	else {
		date_default_timezone_set('Asia/Taipei');
		$date = date("Y-m-d H:i:s");
		$sql4 = "DELETE FROM ORDITEMMAS WHERE EMAIL='$account' AND ORDNO='0' AND ITEMNO='$index'";
		if (mysql_query($sql4)) {
			orderRecalculate($account, '0');
			return 'Success';
		}
		else {
			return 'Database operation error';
		}
	}
}

function search($account, $token) {
	$sql1 = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$account'");
	$fetch1 = mysql_fetch_array($sql1);
	$sql2 = mysql_query("SELECT * FROM ORDITEMMAS WHERE EMAIL='$account' AND ORDNO='0'");
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
		$item = array();
		$amount = array();
		while ($fetch2 = mysql_fetch_array($sql2)) {
			array_push($item, $fetch2['ITEMNO']);
			array_push($amount, $fetch2['ORDAMT']);
		}
		return array('message' => 'Success', 'item' => $item, 'amount' => $amount);
	}
}

function cartOperate($account, $token) {
	$sql1 = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$account'");
	$fetch1 = mysql_fetch_array($sql1);
	$sql2 = mysql_query("SELECT * FROM ORDITEMMAS WHERE EMAIL='$account' AND ORDNO='0'");
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
		$sql2 = mysql_query("SELECT * FROM ORDITEMMAS WHERE ORDNO='0' AND EMAIL='$account' AND ACTCODE='1' ORDER BY CREATEDATE ASC");
		while ($fetch2 = mysql_fetch_array($sql2)) {
			$content .= '<tr><td>'.query_name($fetch2['ITEMNO']).'</td><td>'.query_price($fetch2['ITEMNO']).'</td><td>'.$fetch2['ORDAMT'].'</td><td>'.(query_price($fetch2['ITEMNO']) * $fetch2['ORDAMT']).'</td><td><button onclick="cartDelete(\''.$fetch2['ITEMNO'].'\')">取消</button></td></tr>';
		}
		return array('message' => 'Success', 'content' => $content);
	}
}

function orderitemOperate($account, $token, $order) {
	$sql1 = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$account'");
	$fetch1 = mysql_fetch_array($sql1);
	$sql2 = ($order == 'cart') ? mysql_query("SELECT * FROM ORDITEMMAS WHERE EMAIL='$account' AND ORDNO='0'") : mysql_query("SELECT * FROM ORDITEMMAS WHERE EMAIL='$account' AND ORDNO='$order'");
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
		while ($fetch2 = mysql_fetch_array($sql2)) {
			$content .= '<tr><td>'.query_name($fetch2['ITEMNO']).'</td><td>'.query_price($fetch2['ITEMNO']).'</td><td>'.$fetch2['ORDAMT'].'</td><td>'.(query_price($fetch2['ITEMNO']) * $fetch2['ORDAMT']).'</td><td><button onclick="cartDelete(\''.$fetch2['ITEMNO'].'\')">取消</button></td></tr>';
		}
		return array('message' => 'Success', 'content' => $content);
	}
}