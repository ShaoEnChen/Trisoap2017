<?php
include_once("../resource/database.php");
include_once("../resource/custom.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	if ($_GET['module'] == 'manager') {
		if ($_GET['event'] == 'create') {
			$message = create($_GET['account'], $_GET['token'], $_GET['target']);
			echo json_encode(array('message' => $message));
			return;
		}
		elseif ($_GET['event'] == 'delete') {
			$message = delete($_GET['account'], $_GET['token'], $_GET['target']);
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
	if ($_POST['module'] == 'manager') {
		if ($_POST['event'] == 'create') {
			$message = create($_POST['account'], $_POST['token'], $_POST['target']);
			echo json_encode(array('message' => $message));
			return;
		}
		elseif ($_POST['event'] == 'delete') {
			$message = delete($_POST['account'], $_POST['token'], $_POST['target']);
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

function create($account, $token, $target) {
	$sql1 = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$account'");
	$fetch1 = mysql_fetch_array($sql1);
	$sql2 = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$target'");
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
	elseif (empty($target)) {
		return 'Empty target';
	}
	elseif (mysql_num_rows($sql2) == 0) {
		return 'Unregistered target account';
	}
	else {
		$sql3 = "UPDATE CUSMAS SET CUSIDT='A' WHERE EMAIL='$target'";
		if (mysql_query($sql3)) {
			return 'Success';
		}
		else {
			return 'Database operation error';
		}
	}
}

function delete($account, $token, $target) {
	$sql1 = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$account'");
	$fetch1 = mysql_fetch_array($sql1);
	$sql2 = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$target'");
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
	elseif (empty($target)) {
		return 'Empty target';
	}
	elseif (mysql_num_rows($sql2) == 0) {
		return 'Unregistered target account';
	}
	else {
		$sql3 = "UPDATE CUSMAS SET CUSIDT='B' WHERE EMAIL='$target'";
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
		$sql2 = mysql_query("SELECT * FROM CUSMAS WHERE CUSIDT='A' ORDER BY CREATEDATE DESC");
		while ($fetch2 = mysql_fetch_array($sql2)) {
			$content .= '<tr><td>'.$fetch2['EMAIL'].'</td><td>'.$fetch2['CUSNM'].'</td><td>'.$fetch2['TEL'].'</td><td>'.$fetch2['CUSADD'].'</td><td>'.$fetch2['CREATEDATE'].'</td></tr>';
		}
		return array('message' => 'Success', 'content' => $content);
	}
}