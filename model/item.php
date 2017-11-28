<?php
include_once("../resource/database.php");
include_once("../resource/custom.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	if ($_GET['module'] == 'item') {
		if ($_GET['event'] == 'create') {
			$message = create($_GET['account'], $_GET['token'], $_GET['index'], $_GET['name'], $_GET['amount'], $_GET['price'], $_GET['description']);
			echo json_encode(array('message' => $message));
			return;
		}
		elseif ($_GET['event'] == 'edit') {
			$message = edit($_GET['account'], $_GET['token'], $_GET['index'], $_GET['name'], $_GET['price'], $_GET['description']);
			echo json_encode(array('message' => $message));
			return;
		}
		elseif ($_GET['event'] == 'editData') {
			$message = editData($_GET['account'], $_GET['token'], $_GET['index']);
			if (is_array($message)) {
				echo json_encode(array('message' => $message['message'], 'name' => $message['name'], 'price' => $message['price'], 'description' => $message['description']));
				return;
			}
			else {
				echo json_encode(array('message' => $message));
				return;
			}
		}
		elseif ($_GET['event'] == 'onshelf') {
			$message = onshelf($_GET['account'], $_GET['token'], $_GET['index']);
			echo json_encode(array('message' => $message));
			return;
		}
		elseif ($_GET['event'] == 'offshelf') {
			$message = offshelf($_GET['account'], $_GET['token'], $_GET['index']);
			echo json_encode(array('message' => $message));
			return;
		}
		elseif ($_GET['event'] == 'replenish') {
			$message = replenish($_GET['account'], $_GET['token'], $_GET['index'], $_GET['amount']);
			echo json_encode(array('message' => $message));
			return;
		}
		elseif ($_GET['event'] == 'sell') {
			$message = sell($_GET['account'], $_GET['token'], $_GET['index'], $_GET['amount']);
			echo json_encode(array('message' => $message));
			return;
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
	if ($_POST['module'] == 'item') {
		if ($_POST['event'] == 'create') {
			$message = create($_POST['account'], $_POST['token'], $_POST['index'], $_POST['name'], $_POST['amount'], $_POST['price'], $_POST['description']);
			echo json_encode(array('message' => $message));
			return;
		}
		elseif ($_POST['event'] == 'edit') {
			$message = edit($_POST['account'], $_POST['token'], $_POST['index'], $_POST['name'], $_POST['price'], $_POST['description']);
			echo json_encode(array('message' => $message));
			return;
		}
		elseif ($_POST['event'] == 'editData') {
			$message = editData($_POST['account'], $_POST['token'], $_POST['index']);
			if (is_array($message)) {
				echo json_encode(array('message' => $message['message'], 'name' => $message['name'], 'price' => $message['price'], 'description' => $message['description']));
				return;
			}
			else {
				echo json_encode(array('message' => $message));
				return;
			}
		}
		elseif ($_POST['event'] == 'onshelf') {
			$message = onshelf($_POST['account'], $_POST['token'], $_POST['index']);
			echo json_encode(array('message' => $message));
			return;
		}
		elseif ($_POST['event'] == 'offshelf') {
			$message = offshelf($_POST['account'], $_POST['token'], $_POST['index']);
			echo json_encode(array('message' => $message));
			return;
		}
		elseif ($_POST['event'] == 'replenish') {
			$message = replenish($_POST['account'], $_POST['token'], $_POST['index'], $_POST['amount']);
			echo json_encode(array('message' => $message));
			return;
		}
		elseif ($_POST['event'] == 'sell') {
			$message = sell($_POST['account'], $_POST['token'], $_POST['index'], $_POST['amount']);
			echo json_encode(array('message' => $message));
			return;
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

function create($account, $token, $index, $name, $amount=0, $price, $description=null) {
	$sql1 = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$account'");
	$fetch = mysql_fetch_array($sql1);
	$sql2 = mysql_query("SELECT * FROM ITEMMAS WHERE ITEMNO='$index'");
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
	elseif (empty($index)) {
		return 'Empty index';
	}
	elseif (empty($name)) {
		return 'Empty name';
	}
	elseif ((int)$amount != $amount || $amount < 0) {
		return 'Wrong amount format';
	}
	elseif (empty($price)) {
		return 'Empty price';
	}
	elseif ((int)$price != $price || $price < 0) {
		return 'Wrong price format';
	}
	elseif (mysql_num_rows($sql2) > 0) {
		return 'Registered item';
	}
	else {
		date_default_timezone_set('Asia/Taipei');
		$date = date("Y-m-d H:i:s");
		$sql3 = "INSERT INTO ITEMMAS (ITEMNO, ITEMNM, ITEMAMT, PRICE, DESCRIPTION, CREATEDATE, UPDATEDATE) VALUES ('$index', '$name', '$amount', '$price', '$description', '$date', '$date')";
		if (mysql_query($sql3)) {
			return 'Success';
		}
		else {
			return 'Database operation error';
		}
	}
}

function edit($account, $token, $index, $name, $price, $description=null) {
	$sql1 = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$account'");
	$fetch = mysql_fetch_array($sql1);
	$sql2 = mysql_query("SELECT * FROM ITEMMAS WHERE ITEMNO='$index'");
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
	elseif (empty($index)) {
		return 'Empty index';
	}
	elseif (empty($name)) {
		return 'Empty name';
	}
	elseif (empty($price)) {
		return 'Empty price';
	}
	elseif ((int)$price != $price || $price < 0) {
		return 'Wrong price format';
	}
	elseif (mysql_num_rows($sql2) == 0) {
		return 'Unegistered item';
	}
	else {
		date_default_timezone_set('Asia/Taipei');
		$date = date("Y-m-d H:i:s");
		$sql3 = "UPDATE ITEMMAS SET ITEMNM='$name', PRICE='$price', DESCRIPTION='$description', UPDATEDATE='$date' WHERE ITEMNO='$index'";
		if (mysql_query($sql3)) {
			return 'Success';
		}
		else {
			return 'Database operation error';
		}
	}
}

function editData($account, $token, $index) {
	$sql1 = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$account'");
	$fetch1 = mysql_fetch_array($sql1);
	$sql2 = mysql_query("SELECT * FROM ITEMMAS WHERE ITEMNO='$index'");
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
		return 'Empty index';
	}
	elseif (mysql_num_rows($sql2) == 0) {
		return 'Unegistered item';
	}
	else {
		$fetch2 = mysql_fetch_array($sql2);
		return array('message' => 'Success', 'name' => $fetch2['ITEMNM'], 'price' => $fetch2['PRICE'], 'description' => $fetch2['DESCRIPTION']);
	}
}

function onshelf($account, $token, $index) {
	$sql1 = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$account'");
	$fetch = mysql_fetch_array($sql1);
	$sql2 = mysql_query("SELECT * FROM ITEMMAS WHERE ITEMNO='$index'");
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
	elseif (empty($index)) {
		return 'Empty index';
	}
	elseif (mysql_num_rows($sql2) == 0) {
		return 'Unregistered item';
	}
	else {
		date_default_timezone_set('Asia/Taipei');
		$date = date("Y-m-d H:i:s");
		$sql3 = "UPDATE ITEMMAS SET ACTCODE=1, UPDATEDATE='$date' WHERE ITEMNO='$index'";
		if (mysql_query($sql3)) {
			return 'Success';
		}
		else {
			return 'Database operation error';
		}
	}
}

function offshelf($account, $token, $index) {
	$sql1 = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$account'");
	$fetch = mysql_fetch_array($sql1);
	$sql2 = mysql_query("SELECT * FROM ITEMMAS WHERE ITEMNO='$index'");
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
	elseif (empty($index)) {
		return 'Empty index';
	}
	elseif (mysql_num_rows($sql2) == 0) {
		return 'Unregistered item';
	}
	else {
		date_default_timezone_set('Asia/Taipei');
		$date = date("Y-m-d H:i:s");
		$sql3 = "UPDATE ITEMMAS SET ACTCODE=0, UPDATEDATE='$date' WHERE ITEMNO='$index'";
		if (mysql_query($sql3)) {
			return 'Success';
		}
		else {
			return 'Database operation error';
		}
	}
}

function replenish($account, $token, $index, $amount=0) {
	$sql1 = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$account'");
	$fetch = mysql_fetch_array($sql1);
	$sql2 = mysql_query("SELECT * FROM ITEMMAS WHERE ITEMNO='$index'");
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
	elseif (empty($index)) {
		return 'Empty index';
	}
	elseif ((int)$amount != $amount || $amount < 0) {
		return 'Wrong amount format';
	}
	elseif (mysql_num_rows($sql2) == 0) {
		return 'Unregistered item';
	}
	else {
		date_default_timezone_set('Asia/Taipei');
		$date = date("Y-m-d H:i:s");
		$sql3 = "UPDATE ITEMMAS SET ITEMAMT=ITEMAMT+'$amount', UPDATEDATE='$date' WHERE ITEMNO='$index'";
		if (mysql_query($sql3)) {
			return 'Success';
		}
		else {
			return 'Database operation error';
		}
	}
}

function sell($account, $token, $index, $amount=0) {
	$sql1 = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$account'");
	$fetch1 = mysql_fetch_array($sql1);
	$sql2 = mysql_query("SELECT * FROM ITEMMAS WHERE ITEMNO='$index'");
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
		return 'Empty index';
	}
	elseif ((int)$amount != $amount || $amount < 0) {
		return 'Wrong amount format';
	}
	elseif (mysql_num_rows($sql2) == 0) {
		return 'Unregistered item';
	}
	elseif ($fetch2['ITEMAMT'] - $amount < 0) {
		return 'Not enough inventory';
	}
	else {
		date_default_timezone_set('Asia/Taipei');
		$date = date("Y-m-d H:i:s");
		$sql3 = "UPDATE ITEMMAS SET ITEMAMT=ITEMAMT-'$amount', UPDATEDATE='$date' WHERE ITEMNO='$index'";
		if (mysql_query($sql3)) {
			return 'Success';
		}
		else {
			return 'Database operation error';
		}
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
		$sql2 = mysql_query("SELECT * FROM ITEMMAS ORDER BY ITEMNO ASC");
		while ($fetch2 = mysql_fetch_array($sql2)) {
			$content .= '<tr><td>'.$fetch2['ITEMNO'].'</td><td>'.$fetch2['ITEMNM'].'</td><td>'.$fetch2['ITEMAMT'].'</td><td>'.$fetch2['PRICE'].'</td><td>'.$fetch2['DESCRIPTION'].'</td><td>'.$fetch2['ACTCODE'].'</td></tr>';
		}
		return array('message' => 'Success', 'content' => $content);
	}
}