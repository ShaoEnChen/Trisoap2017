<?php
include_once("../resource/database.php");
include_once("../resource/custom.php");
include_once("../library/mail.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	if ($_GET['module'] == 'message') {
		if ($_GET['event'] == 'create') {
			$message = create($_GET['account'], $_GET['token'], $_GET['text']);
			if (is_array($message)) {
				echo json_encode(array('message' => $message['message'], 'msgno' => $message['msgno']));
				return;
			}
			else {
				echo json_encode(array('message' => $message));
				return;
			}
		}
		elseif ($_GET['event'] == 'pass') {
			$message = pass($_GET['account'], $_GET['token'], $_GET['index']);
			echo json_encode(array('message' => $message));
			return;
		}
		elseif ($_GET['event'] == 'reject') {
			$message = reject($_GET['account'], $_GET['token'], $_GET['index']);
			echo json_encode(array('message' => $message));
			return;
		}
		elseif ($_GET['event'] == 'publish') {
			$message = publish($_GET['account'], $_GET['token'], $_GET['index']);
			echo json_encode(array('message' => $message));
			return;
		}
		elseif ($_GET['event'] == 'save') {
			$message = save($_GET['account'], $_GET['token'], $_GET['index']);
			echo json_encode(array('message' => $message));
			return;
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
		elseif ($_GET['event'] == 'showPhoto') {
			$message = showPhoto($_GET['account'], $_GET['token'], $_GET['index']);
			if (is_array($message)) {
				echo json_encode(array('message' => $message['message'], 'content' => $message['content']));
				return;
			}
			else {
				echo json_encode(array('message' => $message));
				return;
			}
		}
		elseif ($_GET['event'] == 'showVideo') {
			$message = showVideo($_GET['account'], $_GET['token'], $_GET['index']);
			if (is_array($message)) {
				echo json_encode(array('message' => $message['message'], 'content' => $message['content']));
				return;
			}
			else {
				echo json_encode(array('message' => $message));
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
	if ($_POST['module'] == 'message') {
		if ($_POST['event'] == 'create') {
			$message = create($_POST['account'], $_POST['token'], $_POST['text']);
			if (is_array($message)) {
				echo json_encode(array('message' => $message['message'], 'msgno' => $message['msgno']));
				return;
			}
			else {
				echo json_encode(array('message' => $message));
				return;
			}
		}
		elseif ($_POST['event'] == 'pass') {
			$message = pass($_POST['account'], $_POST['token'], $_POST['index']);
			echo json_encode(array('message' => $message));
			return;
		}
		elseif ($_POST['event'] == 'reject') {
			$message = reject($_POST['account'], $_POST['token'], $_POST['index']);
			echo json_encode(array('message' => $message));
			return;
		}
		elseif ($_POST['event'] == 'publish') {
			$message = publish($_POST['account'], $_POST['token'], $_POST['index']);
			echo json_encode(array('message' => $message));
			return;
		}
		elseif ($_POST['event'] == 'save') {
			$message = save($_POST['account'], $_POST['token'], $_POST['index']);
			echo json_encode(array('message' => $message));
			return;
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
		elseif ($_POST['event'] == 'showPhoto') {
			$message = showPhoto($_POST['account'], $_POST['token'], $_POST['index']);
			if (is_array($message)) {
				echo json_encode(array('message' => $message['message'], 'content' => $message['content']));
				return;
			}
			else {
				echo json_encode(array('message' => $message));
				return;
			}
		}
		elseif ($_POST['event'] == 'showVideo') {
			$message = showVideo($_POST['account'], $_POST['token'], $_POST['index']);
			if (is_array($message)) {
				echo json_encode(array('message' => $message['message'], 'content' => $message['content']));
				return;
			}
			else {
				echo json_encode(array('message' => $message));
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

function create($account, $token, $text) {
	$sql1 = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$account'");
	$fetch1 = mysql_fetch_array($sql1);
	if (empty($account)) {
		return 'Empty account';
	}
	elseif (mysql_num_rows($sql1) == 0) {
		return 'Unregistered account';
	}
	elseif (empty($token)) {
		return 'Empty token';
	}
	elseif ($fetch1['TOKEN'] != md5($account.$token)) {
		return 'Wrong token';
	}
	elseif (empty($text)) {
		return 'Empty text';
	}
	else {
		$msgno = get_msgno();
		date_default_timezone_set('Asia/Taipei');
		$date = date("Y-m-d H:i:s");
		$sql3 = "INSERT INTO MSGMAS (MSGNO, EMAIL, MSGTXT, MSGPHOTO, MSGVIDEO, CREATEDATE) VALUES ('$msgno', '$account', '$text', '0', '0', '$date')";
		if (mysql_query($sql3)) {
			update_msgno();
			mail_receive_message($account);
			return array('message' => 'Success', 'msgno' => $msgno);
		}
		else {
			return 'Database operation error';
		}
	}
}

function pass($account, $token, $index) {
	$sql1 = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$account'");
	$fetch1 = mysql_fetch_array($sql1);
	$sql2 = mysql_query("SELECT * FROM MSGMAS WHERE MSGNO='$index'");
	$fetch2 = mysql_fetch_array($sql2);
	if (empty($account)) {
		return 'Empty account';
	}
	elseif (mysql_num_rows($sql1) == 0) {
		return 'Unregistered account';
	}
	elseif (empty($token)) {
		return 'Empty token';
	}
	elseif ($fetch1['TOKEN'] != md5($account.$token)) {
		return 'Wrong token';
	}
	elseif ($fetch1['CUSIDT'] != 'A') {
		return 'No authority';
	}
	else {
		if ($fetch2['MSGSTAT'] == 'A') {
			update_rewardstat($index);
			send_discount($fetch2['EMAIL']);
			mail_pass_message($fetch2['EMAIL']);
			$sql3 = "UPDATE MSGMAS SET MSGSTAT='B' WHERE MSGNO='$index'";
			if (mysql_query($sql3)) {
				return 'Success';
			}
			else {
				return 'Database operation error';
			}
		}
		elseif ($fetch2['MSGSTAT'] == 'D' || $fetch2['MSGSTAT'] == 'E') {
			$sql3 = "UPDATE MSGMAS SET MSGSTAT='B' WHERE MSGNO='$index'";
			if (mysql_query($sql3)) {
				return 'Success';
			}
			else {
				return 'Database operation error';
			}
		}
		else {
			return 'Wrong message state';
		}
	}
}

function reject($account, $token, $index) {
	$sql1 = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$account'");
	$fetch1 = mysql_fetch_array($sql1);
	$sql2 = mysql_query("SELECT * FROM MSGMAS WHERE MSGNO='$index'");
	$fetch2 = mysql_fetch_array($sql2);
	if (empty($account)) {
		return 'Empty account';
	}
	elseif (mysql_num_rows($sql1) == 0) {
		return 'Unregistered account';
	}
	elseif (empty($token)) {
		return 'Empty token';
	}
	elseif ($fetch1['TOKEN'] != md5($account.$token)) {
		return 'Wrong token';
	}
	elseif ($fetch1['CUSIDT'] != 'A') {
		return 'No authority';
	}
	elseif ($fetch2['MSGSTAT'] != 'A') {
		return 'Wrong message state';
	}
	else {
		$sql3 = "UPDATE MSGMAS SET MSGSTAT='C' WHERE MSGNO='$index'";
		if (mysql_query($sql3)) {
			return 'Success';
		}
		else {
			return 'Database operation error';
		}
	}
}

function publish($account, $token, $index) {
	$sql1 = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$account'");
	$fetch1 = mysql_fetch_array($sql1);
	$sql2 = mysql_query("SELECT * FROM MSGMAS WHERE MSGNO='$index'");
	$fetch2 = mysql_fetch_array($sql2);
	if (empty($account)) {
		return 'Empty account';
	}
	elseif (mysql_num_rows($sql1) == 0) {
		return 'Unregistered account';
	}
	elseif (empty($token)) {
		return 'Empty token';
	}
	elseif ($fetch1['TOKEN'] != md5($account.$token)) {
		return 'Wrong token';
	}
	elseif ($fetch1['CUSIDT'] != 'A') {
		return 'No authority';
	}
	elseif ($fetch2['MSGSTAT'] != 'B' &&  $fetch2['MSGSTAT'] != 'E') {
		return 'Wrong message state';
	}
	else {
		date_default_timezone_set('Asia/Taipei');
		$date = date("Y-m-d H:i:s");
		$sql3 = "UPDATE MSGMAS SET MSGSTAT='D', PUBLICDATE='$date' WHERE MSGNO='$index'";
		if (mysql_query($sql3)) {
			return 'Success';
		}
		else {
			return 'Database operation error';
		}
	}
}

function save($account, $token, $index) {
	$sql1 = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$account'");
	$fetch1 = mysql_fetch_array($sql1);
	$sql2 = mysql_query("SELECT * FROM MSGMAS WHERE MSGNO='$index'");
	$fetch2 = mysql_fetch_array($sql2);
	if (empty($account)) {
		return 'Empty account';
	}
	elseif (mysql_num_rows($sql1) == 0) {
		return 'Unregistered account';
	}
	elseif (empty($token)) {
		return 'Empty token';
	}
	elseif ($fetch1['TOKEN'] != md5($account.$token)) {
		return 'Wrong token';
	}
	elseif ($fetch1['CUSIDT'] != 'A') {
		return 'No authority';
	}
	elseif ($fetch2['MSGSTAT'] != 'B' &&  $fetch2['MSGSTAT'] != 'D') {
		return 'Wrong message state';
	}
	else {
		$sql3 = "UPDATE MSGMAS SET MSGSTAT='E' WHERE MSGNO='$index'";
		if (mysql_query($sql3)) {
			return 'Success';
		}
		else {
			return 'Database operation error';
		}
	}
}

function delete($account, $token, $index) {
	$sql1 = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$account'");
	$fetch1 = mysql_fetch_array($sql1);
	$sql2 = mysql_query("SELECT * FROM MSGMAS WHERE MSGNO='$index'");
	$fetch2 = mysql_fetch_array($sql2);
	if (empty($account)) {
		return 'Empty account';
	}
	elseif (mysql_num_rows($sql1) == 0) {
		return 'Unregistered account';
	}
	elseif (empty($token)) {
		return 'Empty token';
	}
	elseif ($fetch1['TOKEN'] != md5($account.$token)) {
		return 'Wrong token';
	}
	elseif ($fetch1['CUSIDT'] != 'A') {
		return 'No authority';
	}
	else {
		$sql3 = "UPDATE MSGMAS SET ACTCODE='0' WHERE MSGNO='$index'";
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
		$sql2 = mysql_query("SELECT * FROM MSGMAS WHERE $key='$value' AND ACTCODE='1' ORDER BY CREATEDATE DESC");
		while ($fetch2 = mysql_fetch_array($sql2)) {
			$content .= '<tr><td>'.$fetch2['MSGNO'].'</td><td>'.$fetch2['EMAIL'].'</td><td>'.$fetch2['MSGTXT'].'</td><td>'.$fetch2['MSGPHOTO'].'</td><td>'.$fetch2['MSGVIDEO'].'</td><td>'.$fetch2['MSGSTAT'].'</td><td>'.$fetch2['CREATEDATE'].'</td><td>'.$fetch2['PUBLICDATE'].'</td></tr>';
		}
		return array('message' => 'Success', 'content' => $content);
	}
}

function operate($account, $token, $state='A') {
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
		$sql2 = mysql_query("SELECT * FROM MSGMAS WHERE MSGSTAT='$state' AND ACTCODE='1' ORDER BY CREATEDATE ASC");
		while ($fetch2 = mysql_fetch_array($sql2)) {
			$content .= '<tr><td>'.$fetch2['MSGNO'].'</td><td>'.$fetch2['EMAIL'].'</td><td>'.$fetch2['MSGTXT'].'</td><td>'.show_MSGPHOTO($fetch2['MSGNO'], $fetch2['MSGPHOTO']).'</td><td>'.show_MSGVIDEO($fetch2['MSGNO'], $fetch2['MSGVIDEO']).'</td><td>'.$fetch2['CREATEDATE'].'</td>';
			if ($state == 'A') {
				$content .= '<td><button onclick="messagePass(\''.$fetch2['MSGNO'].'\')">通過</button><button onclick="messageReject(\''.$fetch2['MSGNO'].'\')">拒絕</button></td>';
			}
			elseif ($state == 'B') {
				$content .= '<td><button onclick="messagePublish(\''.$fetch2['MSGNO'].'\')">公開</button><button onclick="messageSave(\''.$fetch2['MSGNO'].'\')">典藏</button><button onclick="messageDelete(\''.$fetch2['MSGNO'].'\')">刪除</button></td>';
			}
			elseif ($state == 'C') {
				$content .= '<td><button onclick="messageDelete(\''.$fetch2['MSGNO'].'\')">刪除</button></td>';
			}
			elseif ($state == 'D') {
				$content .= '<td><button onclick="messagePass(\''.$fetch2['MSGNO'].'\')">通過</button><button onclick="messageSave(\''.$fetch2['MSGNO'].'\')">典藏</button><button onclick="messageDelete(\''.$fetch2['MSGNO'].'\')">刪除</button></td>';
			}
			elseif ($state == 'E') {
				$content .= '<td><button onclick="messagePass(\''.$fetch2['MSGNO'].'\')">通過</button><button onclick="messagePublish(\''.$fetch2['MSGNO'].'\')">公開</button><button onclick="messageDelete(\''.$fetch2['MSGNO'].'\')">刪除</button></td>';
			}
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
		$sql2 = mysql_query("SELECT * FROM MSGMAS WHERE ACTCODE='1' ORDER BY CREATEDATE DESC");
		while ($fetch2 = mysql_fetch_array($sql2)) {
			$content .= '<tr><td>'.$fetch2['MSGNO'].'</td><td>'.$fetch2['EMAIL'].'</td><td>'.$fetch2['MSGTXT'].'</td><td>'.show_MSGPHOTO($fetch2['MSGNO'], $fetch2['MSGPHOTO']).'</td><td>'.show_MSGVIDEO($fetch2['MSGNO'], $fetch2['MSGVIDEO']).'</td><td>'.$fetch2['MSGSTAT'].'</td><td>'.$fetch2['CREATEDATE'].'</td><td>'.$fetch2['PUBLICDATE'].'</td></tr>';
		}
		return array('message' => 'Success', 'content' => $content);
	}
}

function showPhoto($account, $token, $index) {
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
		return array('message' => 'Success', 'content' => '<img src="source/photo/'.$index.'.png" style="max-width: 500px; max-height: 400px;">');
	}
}

function showVideo($account, $token, $index) {
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
		return array('message' => 'Success', 'content' => '<video style="max-width: 500px; max-height: 400px;" controls><source type="video/mp4" src="source/video/'.$index.'.mp4"></video>');
	}
}