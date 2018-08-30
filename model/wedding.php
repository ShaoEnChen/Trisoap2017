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
	$addr = isset($content['addr']) ? $content['addr'] : '';
	$offer = isset($content['offer']) ? explode(',', $content['offer']) : '';
	$diy = isset($content['diy']) ? strtoupper($content['diy']) : '';
	$subscribe = isset($content['subscribe']) ? strtoupper($content['subscribe']) : '';
	if (empty($name)) {
		return 'Empty name';
	}
	elseif (empty($phone)) {
		return 'Empty phone';
	}
	elseif (empty($addr)) {
		return 'Empty address';
	}
	elseif (empty($offer)) {
		return 'Empty offer';
	}
	elseif (empty($diy)) {
		return 'Empty diy';
	}
	elseif (!in_array($diy, array('Y', 'N'))) {
		return 'Wrong diy format';
	}
	elseif (!in_array($subscribe, array('Y', 'N'))) {
		return 'Wrong subscribe format';
	}
	else {
		$offerA = in_array('a', $offer) ? 1 : 0;
		$offerB = in_array('b', $offer) ? 1 : 0;
		$offerC = in_array('c', $offer) ? 1 : 0;
		$wedno = get_wedno();
		date_default_timezone_set('Asia/Taipei');
		$date = date("Y-m-d H:i:s");
		$sql = "INSERT INTO WEDDING (WEDNO, WEDNAME, WEDPHONE, WEDADDR, WEDOFFERA, WEDOFFERB, WEDOFFERC, WEDDIY, SUBSCRIBE, CREATETIME) VALUES ('$wedno', '$name', '$phone', '$addr', '$offerA', '$offerB', '$offerC', '$diy', '$subscribe', '$date')";
		if (mysql_query($sql)) {
			mail_receive_wedding($wedno, $name, $phone, $addr, $offer, $diy, $subscribe);
			update_wedno();
			return array('message' => 'Success', 'wedno' => $wedno);
		}
		else {
			return 'Database operation error';
		}
	}
}
