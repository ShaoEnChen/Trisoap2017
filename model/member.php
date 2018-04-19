<?php
include_once("../resource/database.php");
include_once("../resource/custom.php");
include_once("../library/message.php");
include_once("../library/mail.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	if ($_GET['module'] == 'member') {
		if ($_GET['event'] == 'signin') {
			$message = signin($_GET);
			if (is_array($message)) {
				echo json_encode($message);
				return;
			}
			else {
				echo json_encode(array('message' => $message));
				return;
			}
		}
		elseif ($_GET['event'] == 'FBsignin') {
			$message = FBsignin($_GET['account'], $_GET['name']);
			if (is_array($message)) {
				echo json_encode(array('message' => $message['message'], 'token' => $message['token'], 'identity' => $message['identity']));
				return;
			}
			else {
				echo json_encode(array('message' => $message));
				return;
			}
		}
		elseif ($_GET['event'] == 'logout') {
			$message = logout($_GET['account'], $_GET['token']);
			echo json_encode(array('message' => $message));
			return;
		}
		elseif ($_GET['event'] == 'signup') {
			$message = signup($_GET);
			if (is_array($message)) {
				echo json_encode($message);
				return;
			}
			else {
				echo json_encode(array('message' => $message));
				return;
			}
		}
		elseif ($_GET['event'] == 'verify') {
			$message = verify($_GET['account'], $_GET['verify']);
			if (is_array($message)) {
				echo json_encode(array('message' => $message['message'], 'token' => $message['token'], 'identity' => $message['identity']));
				return;
			}
			else {
				echo json_encode(array('message' => $message));
				return;
			}
		}
		elseif ($_GET['event'] == 'edit') {
			$message = edit($_GET);
			echo json_encode(array('message' => $message));
			return;
		}
		elseif ($_GET['event'] == 'change_password') {
			$message = change_password($_GET['account'], $_GET['token'], $_GET['ori_password'], $_GET['new_password1'], $_GET['new_password2']);
			echo json_encode(array('message' => $message));
			return;
		}
		elseif ($_GET['event'] == 'reset_password') {
			$message = reset_password($_GET['account']);
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
		elseif ($_GET['event'] == 'adddata') {
			$message = adddata($_GET);
			if (is_array($message)) {
				echo json_encode($message);
				return;
			}
			else {
				echo json_encode(array('message' => $message));
				return;
			}
		}
		elseif ($_GET['event'] == 'contact') {
			$message = contact($_GET);
			echo json_encode(array('message' => $message));
			return;
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
	if ($_POST['module'] == 'member') {
		if ($_POST['event'] == 'signin') {
			$message = signin($_POST);
			if (is_array($message)) {
				echo json_encode($message);
				return;
			}
			else {
				echo json_encode(array('message' => $message));
				return;
			}
		}
		elseif ($_POST['event'] == 'FBsignin') {
			$message = FBsignin($_POST['account'], $_POST['name']);
			if (is_array($message)) {
				echo json_encode(array('message' => $message['message'], 'token' => $message['token'], 'identity' => $message['identity']));
				return;
			}
			else {
				echo json_encode(array('message' => $message));
				return;
			}
		}
		elseif ($_POST['event'] == 'logout') {
			$message = logout($_POST['account'], $_POST['token']);
			echo json_encode(array('message' => $message));
			return;
		}
		elseif ($_POST['event'] == 'signup') {
			$message = signup($_POST);
			if (is_array($message)) {
				echo json_encode($message);
				return;
			}
			else {
				echo json_encode(array('message' => $message));
				return;
			}
		}
		elseif ($_POST['event'] == 'verify') {
			$message = verify($_POST['account'], $_POST['verify']);
			if (is_array($message)) {
				echo json_encode(array('message' => $message['message'], 'token' => $message['token'], 'identity' => $message['identity']));
				return;
			}
			else {
				echo json_encode(array('message' => $message));
				return;
			}
		}
		elseif ($_POST['event'] == 'edit') {
			$message = edit($_POST);
			echo json_encode(array('message' => $message));
			return;
		}
		elseif ($_POST['event'] == 'change_password') {
			$message = change_password($_POST['account'], $_POST['token'], $_POST['ori_password'], $_POST['new_password1'], $_POST['new_password2']);
			echo json_encode(array('message' => $message));
			return;
		}
		elseif ($_POST['event'] == 'reset_password') {
			$message = reset_password($_POST['account']);
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
		elseif ($_POST['event'] == 'adddata') {
			$message = adddata($_POST);
			if (is_array($message)) {
				echo json_encode($message);
				return;
			}
			else {
				echo json_encode(array('message' => $message));
				return;
			}
		}
		elseif ($_POST['event'] == 'contact') {
			$message = contact($_POST);
			echo json_encode(array('message' => $message));
			return;
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

function signin($content) {
	$account = $content['account'];
	$password = $content['password'];
	$origin = str_replace("@@", "&", $content['origin']);
	$sql1 = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$account'");
	$fetch1 = mysql_fetch_array($sql1);
	if (empty($account)) {
		return 'Empty account';
	}
	elseif (empty($password)) {
		return 'Empty password';
	}
	elseif (mysql_num_rows($sql1) == 0) {
		return 'Unregistered account';
	}
	elseif (encrypt($password) != $fetch1['CUSPW']) {
		return 'Wrong password';
	}
	elseif ($fetch1['ACTCODE'] == '2') {
		return 'Unverified account';
	}
	else {
		$token = get_token();
		$encrypted_token = md5($account.$token);
		$sql2 = "UPDATE CUSMAS SET TOKEN='$encrypted_token' WHERE EMAIL='$account'";
		if (mysql_query($sql2)) {
			return $origin;
			if (empty($origin)) {
				return array('message' => 'Success', 'token' => $token, 'identity' => $fetch1['CUSIDT']);
			}
			else {
				return array('message' => 'Success', 'token' => $token, 'identity' => $fetch1['CUSIDT'], 'origin' => $origin);
			}
		}
		else {
			return 'Database operation error';
		}
	}
}

function FBsignin($account, $name) {
	$account = 'FB_'.$account;
	$sql1 = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$account'");
	$fetch1 = mysql_fetch_array($sql1);
	if (empty($account)) {
		return 'Empty account';
	}
	elseif (empty($name)) {
		return 'Empty name';
	}
	else {
		if ($sql1 == false || mysql_num_rows($sql1) == 0) {
			date_default_timezone_set('Asia/Taipei');
			$date = date("Y-m-d H:i:s");
			$token = get_token();
			$encrypted_token = md5($account.$token);

			$sql2 = "INSERT INTO CUSMAS (EMAIL, CUSPW, CUSNM, TOKEN, CREATEDATE, UPDATEDATE, ACTCODE) VALUES ('$account', 'facebook', '$name', '$encrypted_token', '$date', '$date', '1')";
			if (mysql_query($sql2)) {
				mysql_query("INSERT INTO ORDMAS (ORDNO, EMAIL, SHIPFEE, CREATEDATE, UPDATEDATE) VALUES ('0', '$account', '70', '$date', '$date')");
				return array('message' => 'Success', 'token' => $token, 'identity' => 'B');
			}
			else {
				return 'Database operation error';
			}
		}
		else {
			$token = get_token();
			$encrypted_token = md5($account.$token);
			$sql2 = "UPDATE CUSMAS SET TOKEN='$encrypted_token' WHERE EMAIL='$account'";
			if (mysql_query($sql2)) {
				return array('message' => 'Success', 'token' => $token, 'identity' => $fetch1['CUSIDT']);
			}
			else {
				return 'Database operation error';
			}
		}
	}
}

function logout($account, $token) {
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
		$sql2 = "UPDATE CUSMAS SET TOKEN='' WHERE EMAIL='$account'";
		if (mysql_query($sql2)) {
			return 'Success';
		}
		else {
			return 'Database operation error';
		}
	}
}

function signup($content) {
	$account = isset($content['account']) ? $content['account'] : '';
	$name = isset($content['name']) ? $content['name'] : '';
	$password1 = isset($content['password1']) ? $content['password1'] : '';
	$password2 = isset($content['password2']) ? $content['password2'] : '';
	$sql1 = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$account'");
	if (empty($account)) {
		return 'Empty account';
	}
	elseif (empty($name)) {
		return 'Empty name';
	}
	elseif (empty($password1)) {
		return 'Empty password';
	}
	elseif (empty($password2)) {
		return 'Empty verify password';
	}
	elseif (mysql_num_rows($sql1) > 0) {
		return 'Registered account';
	}
	elseif (!preg_match("/^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/", $account)) {
		return 'Wrong email format';
	}
	elseif ($password1 != $password2) {
		return 'Unequal password';
	}
	elseif ((strlen($password1) > 15) || (strlen($password2) > 15)) {
		return 'Password exceed length limit';
	}
	elseif (!ctype_alnum($password1) || !ctype_alnum($password2)) {
		return 'Wrong password format';
	}
	else {
		date_default_timezone_set('Asia/Taipei');
		$date = date("Y-m-d H:i:s");
		$password = encrypt($password1);
		$token = get_token();
		$encrypted_token = md5($account.$token);
		// message_verify($phone, $verify);
		$sql2 = "INSERT INTO CUSMAS (EMAIL, CUSPW, CUSNM, TOKEN, CREATEDATE, UPDATEDATE, ACTCODE) VALUES ('$account', '$password', '$name', '$encrypted_token', '$date', '$date', '1')";
		if (mysql_query($sql2)) {
			mail_receive_member_notice($name);
			mysql_query("INSERT INTO ORDMAS (ORDNO, EMAIL, SHIPFEE, CREATEDATE, UPDATEDATE) VALUES ('0', '$account', '70', '$date', '$date')");
			return array('message' => 'Success', 'token' => $token, 'identity' => 'B');
		}
		else {
			return 'Database operation error';
		}
	}
}

/*function verify($account, $verify) {
	$sql1 = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$account'");
	$fetch1 = mysql_fetch_array($sql1);
	if (empty($account)) {
		return 'Empty account';
	}
	elseif (empty($verify)) {
		return 'Empty verification code';
	}
	elseif (mysql_num_rows($sql1) == 0) {
		return 'Unregistered account';
	}
	elseif ($verify != $fetch1['VERIFY']) {
		return 'Wrong verification code';
	}
	else {
		mail_receive_member_notice($fetch1['CUSNM']);
		$sql2 = "UPDATE CUSMAS SET VERIFY='', ACTCODE='1' WHERE EMAIL='$account'";
		if (mysql_query($sql2)) {
			date_default_timezone_set('Asia/Taipei');
			$date = date("Y-m-d H:i:s");
			$address = curl_post(array('module' => 'cue', 'target' => 'member_address', 'account' => $account), 'cue');
			mysql_query("INSERT INTO ORDMAS (ORDNO, EMAIL, ORDADD, CREATEDATE, UPDATEDATE) VALUES ('0', '$account', '$address', '$date', '$date')");
			$token = get_token();
			$encrypted_token = md5($account.$token);
			mysql_query("UPDATE CUSMAS SET TOKEN='$encrypted_token' WHERE EMAIL='$account'");
			return array('message' => 'Success', 'token' => $token, 'identity' => 'B');
		}
		else {
			return 'Database operation error';
		}
	}
}*/

function edit($content) {
	$account = isset($content['account']) ? $content['account'] : '';
	$token = isset($content['token']) ? $content['token'] : '';
	$name = isset($content['name']) ? $content['name'] : '';
	$phone = isset($content['phone']) ? $content['phone'] : '';
	$taxid = isset($content['taxid']) ? $content['taxid'] : '';
	$address = isset($content['address']) ? $content['address'] : '';
	$notice = isset($content['notice']) ? $content['notice'] : '';
	$sql1 = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$account'");
	$fetch1 = mysql_fetch_array($sql1);
	if (empty($phone) && !empty($fetch1['TEL'])) {
		return 'Empty phone';
	}
	elseif (!empty($phone) && !preg_match('/^[0][9][0-9]{8}$/', $phone)) {
		return 'Wrong phone number';
	}
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
	elseif (empty($name)) {
		return 'Empty name';
	}
	elseif (strlen($name) > 30) {
		return 'Name exceed length limit';
	}
	elseif (!empty($taxid) && !check_taxid($taxid)) {
		return 'Wrong taxid format';
	}
	elseif (strlen($notice) > 100) {
		return 'Notice exceed length limit';
	}
	else {
		date_default_timezone_set('Asia/Taipei');
		$date = date("Y-m-d H:i:s");
		$sql2 = "UPDATE CUSMAS SET CUSNM='$name', CUSADD='$address', TEL='$phone', TAXID='$taxid', SPEINS='$notice', UPDATEDATE='$date' WHERE EMAIL='$account'";
		if (mysql_query($sql2)) {
			return 'Success';
		}
		else {
			return 'Database operation error';
		}
	}
}

function change_password($account, $token, $ori_password, $new_password1, $new_password2) {
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
	elseif (empty($ori_password)) {
		return 'Empty original password';
	}
	elseif (empty($new_password1)) {
		return 'Empty password';
	}
	elseif (empty($new_password2)) {
		return 'Empty verify password';
	}
	elseif (encrypt($ori_password) != $fetch1['CUSPW']) {
		return 'Wrong password';
	}
	elseif ($new_password1 != $new_password2) {
		return 'Unequal password';
	}
	elseif ((strlen($new_password1) > 15) || (strlen($new_password2) > 15)) {
		return 'Password exceed length limit';
	}
	elseif (!ctype_alnum($new_password1) || !ctype_alnum($new_password2)) {
		return 'Wrong password format';
	}
	else {
		date_default_timezone_set('Asia/Taipei');
		$date = date("Y-m-d H:i:s");
		$password = encrypt($new_password1);
		$sql2 = "UPDATE CUSMAS SET CUSPW='$password', UPDATEDATE='$date' WHERE EMAIL='$account'";
		if (mysql_query($sql2)) {
			return 'Success';
		}
		else {
			return 'Database operation error';
		}
	}
}

function reset_password($account) {
	$sql1 = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$account'");
	if (empty($account)) {
		return 'Empty account';
	}
	elseif (mysql_num_rows($sql1) == 0) {
		return 'Unregistered account';
	}
	else {
		$code = get_verify();
		mail_reset_password($account, $code);
		date_default_timezone_set('Asia/Taipei');
		$date = date("Y-m-d H:i:s");
		$sql2 = "UPDATE CUSMAS SET CUSPW='$code', UPDATEDATE='$date' WHERE EMAIL='$account'";
		if (mysql_query($sql2)) {
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
		$sql2 = mysql_query("SELECT * FROM CUSMAS WHERE $key='$value' ORDER BY CREATEDATE DESC");
		while ($fetch2 = mysql_fetch_array($sql2)) {
			$content .= '<tr>';
			$content .= '<td data-title="信箱">' . $fetch2['EMAIL'] . '</td>';
			$content .= '<td data-title="姓名">' . $fetch2['CUSNM'] . '</td>';
			$content .= '<td data-title="地址">' . $fetch2['CUSADD'] . '</td>';
			$content .= '<td data-title="膚質">' . show_CUSTYPE($fetch2['CUSTYPE']) . '</td>';
			$content .= '<td data-title="生日">' . $fetch2['CUSBIRTH'] . '</td>';
			$content .= '<td data-title="聯絡電話">' . $fetch2['TEL'] . '</td>';
			$content .= '<td data-title="如何得知">' . show_KNOWTYPE($fetch2['KNOWTYPE']) . '</td>';
			$content .= '<td data-title="建立時間">' . $fetch2['CREATEDATE'] . '</td>';
			$content .= '<td data-title="最後修改時間">' . $fetch2['UPDATEDATE'] .'</td>';
			$content .= '<td class="td-whole-line-title" data-title="操作">';
			$content .= '<button class="neural-btn" onclick="memberDetail(\'' . $fetch2['EMAIL'] . '\')">查看</button>';
			$content .= '</td>';
			$content .= '</tr>';
		}
		return array('message' => 'Success', 'content' => $content);
	}
}

function detail($account, $token, $index) {
	$sql1 = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$account'");
	$fetch1 = mysql_fetch_array($sql1);
	$sql2 = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$index'");
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
	elseif (mysql_num_rows($sql2) == 0) {
		return 'Unregistered account';
	}
	else {
		$fetch2 = mysql_fetch_array($sql2);
		$content .= '<p>顧客權限 ' . show_CUSIDT($fetch2['CUSIDT']) . '</p>';
		$content .= '<p>顧客膚質 ' . show_CUSTYPE($fetch2['CUSTYPE']) . '</p>';
		$content .= '<p>統一編號 ' . $fetch2['TAXID'] . '</p>';
		$content .= '<p>月消費額 ' . $fetch2['SALEAMTMTD'] . '</p>';
		$content .= '<p>季消費額 ' . $fetch2['SALEAMTSTD'] . '</p>';
		$content .= '<p>年消費額 ' . $fetch2['SALEAMTYTD'] . '</p>';
		$content .= '<p>總消費額 ' . $fetch2['SALEAMT'] . '</p>';
		$content .= '<p>備註 ' . $fetch2['SPEINS'] . '</p>';
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
		$sql2 = mysql_query("SELECT * FROM CUSMAS ORDER BY CREATEDATE DESC");
		while ($fetch2 = mysql_fetch_array($sql2)) {
			$content .= '<tr>';
			$content .= '<td data-title="信箱">' . $fetch2['EMAIL'] . '</td>';
			$content .= '<td data-title="姓名">' . $fetch2['CUSNM'] . '</td>';
			$content .= '<td data-title="地址">' . $fetch2['CUSADD'] . '</td>';
			$content .= '<td data-title="膚質">' . $fetch2['CUSTYPE'] . '</td>';
			$content .= '<td data-title="生日">' . $fetch2['CUSBIRTH'] . '</td>';
			$content .= '<td data-title="聯絡電話">' . $fetch2['TEL'] . '</td>';
			$content .= '<td data-title="如何得知">' . $fetch2['KNOWTYPE'] . '</td>';
			$content .= '<td data-title="建立時間">' . $fetch2['CREATEDATE'] . '</td>';
			$content .= '<td data-title="最後修改時間">' . $fetch2['UPDATEDATE'] . '</td>';
			$content .= '<td class="td-whole-line-title" data-title="操作">';
			$content .= '<button class="neural-btn" onclick="memberDetail(\'' . $fetch2['EMAIL'] . '\')">查看</button>';
			$content .= '</td>';
			$content .= '</tr>';

			$content .= '<tr>';
			$content .= '<td id="' . $fetch2['EMAIL'] . '" class="member-detail" colspan=10>';
			$content .= '</td>';
			$content .= '</tr>';
		}
		return array('message' => 'Success', 'content' => $content);
	}
}

function adddata($content) {
	$account = $content['account'];
	$token = $content['token'];
	$sex = isset($content['sex']) ? $content['sex'] : '';
	$skintype = isset($content['skintype']) ? $content['skintype'] : '';
	$knowtype = isset($content['knowtype']) ? $content['knowtype'] : '';
	$birth = isset($content['birth']) ? $content['birth'] : '';
	$phone = isset($content['phone']) ? $content['phone'] : '';
	$discount = 0;
	$sql1 = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$account'");
	$fetch1 = mysql_fetch_array($sql1);
	if (empty($birth)) {
		return 'Empty birth';
	}
	elseif (!empty($birth)) {
		$explode = explode('-', $birth);
		if (!checkdate($explode[1], $explode[2], $explode[0])) {
			return 'Wrong birth format';
		}
	}
	elseif (empty($sex)) {
		return 'Empty sex';
	}
	elseif (!in_array($sex, array('M', 'F'))) {
		return 'Wrong sex format';
	}
	elseif (empty($skintype)) {
		return 'Empty skin type';
	}
	elseif (!in_array($skintype, array('A', 'B', 'C', 'D'))) {
		return 'Wrong skin type format';
	}
	elseif (empty($knowtype)) {
		return 'Empty know type';
	}
	elseif (!in_array($knowtype, array('A', 'B', 'C', 'D', 'E'))) {
		return 'Wrong know type format';
	}
	elseif (empty($phone)) {
		return 'Empty phone';
	}
	elseif (!preg_match('/^[0][9][0-9]{8}$/', $phone)) {
		return 'Wrong phone number';
	}
	elseif (empty($account)) {
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
		date_default_timezone_set('Asia/Taipei');
		$date = date("Y-m-d H:i:s");
		$sql2 = "UPDATE CUSMAS SET TEL='$phone', CUSBIRTH='$birth', CUSSEX='$sex', CUSTYPE='$skintype', KNOWTYPE='$knowtype', DISCOUNT=DISCOUNT+20, UPDATEDATE='$date' WHERE EMAIL='$account'";
		if (mysql_query($sql2)) {
			do {
				$code = get_code();
				$sql3 = mysql_query("SELECT * FROM DCTMAS WHERE DCTID='$code'");
			} while (mysql_fetch_array($sql3) > 0);
			date_default_timezone_set('Asia/Taipei');
			$date = date("Y-m-d H:i:s");
			mysql_query("INSERT INTO DCTMAS (DCTID, DCTPRICE, DCTSTAT, DCTNM, CREATEPERSON, CREATEDATE) VALUES ('$code', '20', '1', '$name', 'trisoap2015@gmail.com', '$date')");
			return array('message' => 'Success', 'discount' => $code);
		}
		else {
			return 'Database operation error';
		}
	}
}

function contact($content) {
	$name = isset($content['name']) ? $content['name'] : '';
	$email = isset($content['email']) ? $content['email'] : '';
	$phone = isset($content['phone']) ? $content['phone'] : '';
	$message = isset($content['message']) ? $content['message'] : '';
	if (empty($email)) {
		return 'Empty email';
	}
	elseif (!preg_match("/^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/", $email)) {
		return 'Wrong email format';
	}
	elseif (!empty($phone) && !preg_match('/^[0][9][0-9]{8}$/', $phone)) {
		return 'Wrong phone format';
	}
	elseif (empty($name)) {
		return 'Empty name';
	}
	else {
		$result = mail_receive_message_notice($email, $name, $phone, $message);
		return $result;
	}
}