<?php
include_once("../resource/database.php");
include_once("../resource/custom.php");
include_once("../library/mail.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	if ($_GET['module'] == 'wedding') {
		if ($_GET['event'] == 'create') {
			$message = create($_GET);
			if (is_array($message)) {
				echo json_encode($message);
				return;
			}
			else {
				echo json_encode(array('message' => $message));
				return;
			}
		}
	}
	else {
		echo json_encode(array('message' => 'Invalid module called'));
    	return;
	}
}

elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if ($_POST['module'] == 'wedding') {
		if ($_POST['event'] == 'create') {
			$message = create($_POST);
			if (is_array($message)) {
				echo json_encode($message);
				return;
			}
			else {
				echo json_encode(array('message' => $message));
				return;
			}
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

function create($content) {
	$name = isset($content['name']) ? $content['name'] : '';
	$phone = isset($content['phone']) ? $content['phone'] : '';
	$email = isset($content['email']) ? $content['email'] : '';
	$offer = isset($content['offer']) ? $content['offer'] : '';
	$diy_interest = isset($content['diy_interest']) ? $content['diy_interest'] : '';
	$subscribe = isset($content['subscribe']) ? $content['subscribe'] : '';
	if (empty($name)) {
		return 'Empty name';
	}
	elseif (empty($phone)) {
		return 'Empty phone';
	}
	elseif (empty($email)) {
		return 'Empty email';
	}
	elseif (!preg_match("/^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/", $email)) {
		return 'Wrong email format';
	}
	elseif (empty($offer)) {
		return 'Empty offer';
	}
	elseif (!in_array($offer, array('A', 'B', 'C'))) {
		return 'Wrong offer format';
	}
	elseif (empty($diy_interest)) {
		return 'Empty diy_interest';
	}
	elseif (!in_array($diy_interest, array('A', 'B'))) {
		return 'Wrong diy format';
	}
	elseif (!in_array($subcribe, array('Y', 'N'))) {
		return 'Wrong subcribe format';
	}
	else {
		$wedno = get_wedno();
		date_default_timezone_set('Asia/Taipei');
		$date = date("Y-m-d H:i:s");
		$sql1 = "INSERT INTO WEDDING (WEDNO, WEDNAME, WEDPHONE, WEDEMAIL, WEDOFFER, WEDDIY, SUBSCRIBE, CREATETIME) VALUES ('$wedno', '$name', '$phone', '$email', '$offer', '$diy_interest', '$subscribe', '$date')";
		if (mysql_query($sql1)) {
			mail_receive_wedding($wedno, $name, $phone, $email, $offer, $diy_interest, $subcribe);
			update_wedno();
			return array('message' => 'Success', 'WEDNO' => $wedno);
		}
		else {
			return 'Database operation error';
		}
	}
}