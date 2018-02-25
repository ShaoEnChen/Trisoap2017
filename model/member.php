<?php
include_once("../resource/database.php");
include_once("../resource/custom.php");
include_once("../library/message.php");
include_once("../library/mail.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	if ($_GET['module'] == 'member') {
		if ($_GET['event'] == 'signin') {
			$message = signin($_GET['account'], $_GET['password']);
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
			$message = signup($_GET['account'], $_GET['name'], $_GET['password1'], $_GET['password2'], $_GET['address'], $_GET['skintype'], $_GET['birth'], $_GET['phone'], $_GET['add'], $_GET['taxid'], $_GET['knowtype'], $_GET['notice']);
			echo json_encode(array('message' => $message));
			return;
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
			$message = edit($_GET['account'], $_GET['token'], $_GET['name'], $_GET['address'], $_GET['skintype'], $_GET['phone'], $_GET['taxid'], $_GET['notice']);
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
			$message = signin($_POST['account'], $_POST['password']);
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
			$message = signup($_POST['account'], $_POST['name'], $_POST['password1'], $_POST['password2'], $_POST['skintype'], $_POST['birth'], $_POST['phone'], $_POST['add'], $_POST['taxid'], $_POST['knowtype'], $_POST['notice']);
			echo json_encode(array('message' => $message));
			return;
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
			$message = edit($_POST['account'], $_POST['token'], $_POST['name'], $_POST['address'], $_POST['skintype'], $_POST['phone'], $_POST['taxid'], $_POST['notice']);
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

function signin($account, $password) {
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
			return array('message' => 'Success', 'token' => $token, 'identity' => $fetch1['CUSIDT']);
		}
		else {
			return 'Database operation error';
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

function signup($account, $name, $password1, $password2, $skintype, $birth, $phone, $add=null, $taxid=null, $knowtype, $notice=null) {
	$sql1 = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$account'");
	$explode = explode('-', $birth);
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
	elseif (empty($skintype)) {
		return 'Empty skin type';
	}
	elseif (empty($birth)) {
		return 'Empty birthday';
	}
	elseif (empty($phone)) {
		return 'Empty phone number';
	}
	elseif (empty($knowtype)) {
		return 'Empty knowtype';
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
	elseif (!preg_match('/^[0][9][0-9]{8}$/', $phone)) {
		return 'Wrong phone format';
	}
	elseif (!empty($taxid) && !check_taxid($taxid)) {
		return 'Wrong taxid format';
	}
	elseif (!checkdate($explode[1], $explode[2], $explode[0])) {
		return 'Wrong birth format';
	}
	else {
		date_default_timezone_set('Asia/Taipei');
		$date = date("Y-m-d H:i:s");
		$verify = get_verify();
		$password = encrypt($password1);
		message_verify($phone, $verify);
		$sql2 = "INSERT INTO CUSMAS (EMAIL, CUSPW, CUSNM, CUSADD, CUSBIRTH, TEL, CUSTYPE, KNOWTYPE, TAXID, SPEINS, VERIFY, CREATEDATE, UPDATEDATE, ACTCODE) VALUES ('$account', '$password', '$name', '$add', '$birth', '$phone', '$skintype', '$knowtype', '$taxid', '$notice', '$verify', '$date', '$date', '2')";
		if (mysql_query($sql2)) {
			return 'Success';
		}
		else {
			return 'Database operation error';
		}
	}
}

function verify($account, $verify) {
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
}

function edit($account, $token, $name, $address, $skintype, $phone, $taxid=null, $notice=null) {
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
	elseif (empty($name)) {
		return 'Empty name';
	}
	elseif (empty($skintype)) {
		return 'Empty skin type';
	}
	elseif (empty($phone)) {
		return 'Empty phone number';
	}
	elseif (!preg_match('/^[0][9][0-9]{8}$/', $phone)) {
		return 'Wrong phone format';
	}
	elseif (!check_taxid($taxid)) {
		return 'Wrong taxid format';
	}
	else {
		date_default_timezone_set('Asia/Taipei');
		$date = date("Y-m-d H:i:s");
		$sql2 = "UPDATE CUSMAS SET CUSNM='$name', CUSADD='$address', CUSTYPE='$skintype', TEL='$phone', TAXID='$taxid', SPEINS='$notice', UPDATEDATE='$date' WHERE EMAIL='$account'";
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
			$content .= '<td data-title="膚質">' . $fetch2['CUSTYPE'] . '</td>';
			$content .= '<td data-title="生日">' . $fetch2['CUSBIRTH'] . '</td>';
			$content .= '<td data-title="聯絡電話">' . $fetch2['TEL'] . '</td>';
			$content .= '<td data-title="如何得知">' . $fetch2['KNOWTYPE'] . '</td>';
			$content .= '<td data-title="建立時間">' . $fetch2['CREATEDATE'] . '</td>';
			$content .= '<td data-title="最後修改時間">' . $fetch2['UPDATEDATE'] .'</td>';
			$content .= '<td data-title="操作">';
			$content .= '<button onclick="memberDetail(\'' . $fetch2['EMAIL'] . '\')">查看</button>';
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
		$content = '<table><tbody>';
		$content .= '<tr><td>顧客信箱</td><td>'.$fetch2['EMAIL'].'</td></tr>';
		$content .= '<tr><td>顧客姓名</td><td>'.$fetch2['CUSNM'].'</td></tr>';
		$content .= '<tr><td>顧客權限</td><td>'.show_CUSIDT($fetch2['CUSIDT']).'</td></tr>';
		$content .= '<tr><td>顧客地址</td><td>'.$fetch2['CUSADD'].'</td></tr>';
		$content .= '<tr><td>顧客生日</td><td>'.$fetch2['CUSBIRTH'].'</td></tr>';
		$content .= '<tr><td>顧客電話</td><td>'.$fetch2['TEL'].'</td></tr>';
		$content .= '<tr><td>顧客膚質</td><td>'.show_CUSTYPE($fetch2['CUSTYPE']).'</td></tr>';
		$content .= '<tr><td>如何認識三三</td><td>'.show_KNOWTYPE($fetch2['KNOWTYPE']).'</td></tr>';
		$content .= '<tr><td>統一編號</td><td>'.$fetch2['TAXID'].'</td></tr>';
		$content .= '<tr><td>留心語折扣</td><td>'.$fetch2['DISCOUNT'].'</td></tr>';
		$content .= '<tr><td>月消費額</td><td>'.$fetch2['SALEAMTMTD'].'</td></tr>';
		$content .= '<tr><td>季消費額</td><td>'.$fetch2['SALEAMTSTD'].'</td></tr>';
		$content .= '<tr><td>年消費額</td><td>'.$fetch2['SALEAMTYTD'].'</td></tr>';
		$content .= '<tr><td>總消費額</td><td>'.$fetch2['SALEAMT'].'</td></tr>';
		$content .= '<tr><td>備註</td><td>'.$fetch2['SPEINS'].'</td></tr>';
		$content .= '<tr><td>建立日期</td><td>'.$fetch2['CREATEDATE'].'</td></tr>';
		$content .= '<tr><td>最後修改日期</td><td>'.$fetch2['UPDATEDATE'].'</td></tr>';
		$content .= '</tbody></table>';
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
			$content .= '<td data-title="操作">';
			$content .= '<button onclick="memberDetail(\'' . $fetch2['EMAIL'] . '\')">查看</button>';
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