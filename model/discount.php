<?php
include_once("../resource/database.php");
include_once("../resource/custom.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	if ($_GET['module'] == 'discount') {
		if ($_GET['event'] == 'create') {
			$message = create($_GET['account'], $_GET['token'], $_GET['name'], $_GET['price'], $_GET['mode']);
			if (is_array($message)) {
				echo json_encode(array('message' => $message['message'], 'code' => $message['code']));
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
		elseif ($_GET['event'] == 'apply') {
			$message = apply($_GET['account'], $_GET['token'], $_GET['index']);
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
		elseif ($_GET['event'] == 'view') {
			$message = view($_GET['account'], $_GET['token'], $_GET['state']);
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
	if ($_POST['module'] == 'discount') {
		if ($_POST['event'] == 'create') {
			$message = create($_POST['account'], $_POST['token'], $_POST['name'], $_POST['price'], $_POST['mode']);
			if (is_array($message)) {
				echo json_encode(array('message' => $message['message'], 'code' => $message['code']));
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
		elseif ($_POST['event'] == 'apply') {
			$message = apply($_POST['account'], $_POST['token'], $_POST['index']);
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
		elseif ($_POST['event'] == 'view') {
			$message = view($_POST['account'], $_POST['token'], $_POST['state']);
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

function create($account, $token, $name, $price, $mode) {
	$sql1 = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$account'");
	$fetch = mysql_fetch_array($sql1);
	if (empty($account)) {
		return 'Empty account';
	}
	elseif (mysql_num_rows($sql1) == 0) {
		return 'Unregistered account';
	}
	elseif (empty($token)) {
		return 'Not logged in';
	}
	elseif ($fetch['TOKEN'] != md5($account.$token)) {
		return 'Wrong token';
	}
	elseif ($fetch['CUSIDT'] != 'A') {
		return 'No authority';
	}
	elseif (empty($name)) {
		return 'Empty name';
	}
	elseif (empty($price)) {
		return 'Empty price';
	}
	elseif (empty($mode)) {
		return 'Empty mode';
	}
	else {
		do {
			$code = get_code();
			$sql2 = mysql_query("SELECT * FROM DCTMAS WHERE DCTID='$code'");
		} while (mysql_fetch_array($sql2) > 0);
		date_default_timezone_set('Asia/Taipei');
		$date = date("Y-m-d H:i:s");
		$sql3 = "INSERT INTO DCTMAS (DCTID, DCTPRICE, DCTSTAT, DCTNM, CREATEPERSON, CREATEDATE) VALUES ('$code', '$price', '$mode', '$name', '$account', '$date')";
		if (mysql_query($sql3)) {
			return array('message' => 'Success', 'code' => $code);
		}
		else {
			return 'Database operation error';
		}
	}
}

function delete($account, $token, $index) {
	$sql1 = mysql_query("SELECT * FROM DCTMAS WHERE DCTID='$index'");
	$sql2 = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$account'");
	$fetch = mysql_fetch_array($sql2);
	if (empty($account)) {
		return 'Empty account';
	}
	elseif (mysql_num_rows($sql2) == 0) {
		return 'Unregistered account';
	}
	elseif (empty($token)) {
		return 'Not logged in';
	}
	elseif ($fetch['TOKEN'] != md5($account.$token)) {
		return 'Wrong token';
	}
	elseif ($fetch['CUSIDT'] != 'A') {
		return 'No authority';
	}
	elseif (empty($index)) {
		return 'Empty index';
	}
	elseif (mysql_num_rows($sql1) == 0) {
		return 'Unregistered discount';
	}
	else {
		date_default_timezone_set('Asia/Taipei');
		$date = date("Y-m-d H:i:s");
		$sql3 = "UPDATE DCTMAS SET ACTCODE=0 WHERE DCTID='$index'";
		if (mysql_query($sql3)) {
			return 'Success';
		}
		else {
			return 'Database operation error';
		}
	}
}

function apply($account, $token, $index) {
	$sql1 = mysql_query("SELECT * FROM DCTMAS WHERE DCTID='$index'");
	$fetch1 = mysql_fetch_array($sql1);
	$sql2 = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$account'");
	$fetch2 = mysql_fetch_array($sql2);
	if (empty($account)) {
		return 'Empty account';
	}
	elseif (mysql_num_rows($sql2) == 0) {
		return 'Unregistered account';
	}
	elseif (empty($token)) {
		return 'Not logged in';
	}
	elseif ($fetch2['TOKEN'] != md5($account.$token)) {
		return 'Wrong token';
	}
	if (empty($index)) {
		return 'Empty index';
	}
	elseif (mysql_num_rows($sql1) == 0) {
		return 'Unregistered discount';
	}
	elseif ($fetch1['DCTSTAT'] == 0) {
		return 'Used discount';
	}
	elseif ($fetch1['ACTCODE'] == 0) {
		return 'Deleted discount';
	}
	else {
		mysql_query("UPDATE ORDMAS SET DCTID='$index' WHERE ORDNO='0' AND EMAIL='$account'");
		return 'Success';
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
		$sql2 = mysql_query("SELECT * FROM DCTMAS WHERE $key='$value' ORDER BY CREATEDATE ASC");
		while ($fetch2 = mysql_fetch_array($sql2)) {
			$content .= '<tr><td>'.$fetch2['DCTID'].'</td><td>'.$fetch2['DCTNM'].'</td><td>'.$fetch2['DCTPRICE'].'</td><td>'.$fetch2['DCTSTAT'].'</td><td>'.$fetch2['CREATEPERSON'].'</td><td>'.$fetch2['CREATEDATE'].'</td><td>'.$fetch2['USEDATE'].'</td></tr>';
		}
		return array('message' => 'Success', 'content' => $content);
	}
}

function view($account, $token, $state='0') {
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
		$sql2 = mysql_query("SELECT * FROM DCTMAS WHERE DCTSTAT='$state' ORDER BY CREATEDATE ASC");
		while ($fetch2 = mysql_fetch_array($sql2)) {
			$content .= '<tr><td>'.$fetch2['DCTID'].'</td><td>'.$fetch2['DCTNM'].'</td><td>'.$fetch2['DCTPRICE'].'</td><td>'.$fetch2['DCTSTAT'].'</td><td>'.$fetch2['CREATEPERSON'].'</td><td>'.$fetch2['CREATEDATE'].'</td><td>'.$fetch2['USEDATE'].'</td></tr>';
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
		$sql2 = mysql_query("SELECT * FROM DCTMAS ORDER BY CREATEDATE DESC");
		while ($fetch2 = mysql_fetch_array($sql2)) {
			$content .= '<tr><td>'.$fetch2['DCTID'].'</td><td>'.$fetch2['DCTNM'].'</td><td>'.$fetch2['DCTPRICE'].'</td><td>'.$fetch2['DCTSTAT'].'</td><td>'.$fetch2['CREATEPERSON'].'</td><td>'.$fetch2['CREATEDATE'].'</td><td>'.$fetch2['USEDATE'].'</td></tr>';
		}
		return array('message' => 'Success', 'content' => $content);
	}
}