<?php
include_once("resource/database.php");
include_once("resource/custom.php");
include_once("library/message.php");
include_once("controller/router.php");

function event_post_action() {
	$id = array('account' => $_COOKIE['account'], 'token' => $_COOKIE['token']);
	$post = array_merge($id, $_POST);
	echo curl_post($post, $_POST['module']);
	return;
}

if (isset($_GET['operation']) && $_GET['operation'] == 'logout') {
	$id = array('account' => $_COOKIE['account'], 'token' => $_COOKIE['token'], 'module' => 'member', 'event' => 'logout');
	$return = json_decode(curl_post($id, 'member'), true);
	if ($return['message'] == 'Success') {
		setcookie("account", "", time()-3600);
		setcookie("token", "", time()-3600);
		setcookie("identity", "", time()-3600);
	}
	router('logout');
}

elseif (isset($_POST['module']) && isset($_POST['event'])) {
	$event = $_POST['event'];
	switch ($_POST['module']) {
	case 'member':
		switch ($event) {
		case 'search':
		case 'edit':
		case 'change_password':
		case 'detail':
			event_post_action();
			break;

		case 'signin':
			$return = json_decode(curl_post($_POST, $_POST['module']), true);
			if($return['message'] == 'Success') {
				setcookie('account', $_POST['account']);
				setcookie('token', $return['token']);
				setcookie('identity', $return['identity']);
			}
			elseif($return['message'] == 'Unverified account') {
				setcookie('account', $_POST['account']);
				$account = $_POST['account'];
				$verify = get_verify();
				$phone = curl_post(array('module' => 'cue', 'target' => 'member_phone', 'account' => $account), 'cue');
				message_verify($phone, $verify);
				mysql_query("UPDATE CUSMAS SET VERIFY='$verify' WHERE EMAIL='$account'");
			}
			echo json_encode(array('message' => $return['message']));
			break;

		case 'signup':
			$return = json_decode(curl_post($_POST, $_POST['module']), true);
			if($return['message'] == 'Success') {
				setcookie('account', $_POST['account']);
			}
			echo json_encode(array('message' => $return['message']));
			break;

		case 'verify':
			$id = array('account' => $_COOKIE['account']);
			$post = array_merge($id, $_POST);
			$return = json_decode(curl_post($post, $_POST['module']), true);
			if($return['message'] == 'Success') {
				setcookie('token', $return['token']);
				setcookie('identity', $return['identity']);
			}
			echo json_encode(array('message' => $return['message']));
			break;

		case 'reset_password':
			echo curl_post($_POST, $_POST['module']);
			break;

		default:
			break;
		}	// #end of switch ($event)
		break;

	case 'discount':
		switch ($event) {
		case 'create':
		case 'delete':
		case 'apply':
		case 'search':
			event_post_action();
			break;

		default:
			break;
		}	// #end of switch ($event)
		break;

	case 'item':
		switch ($event) {
		case 'create':
		case 'edit':
		case 'editData':
		case 'onshelf':
		case 'offshelf':
		case 'replenish':
		case 'sell':
			event_post_action();
			break;

		default:
			break;
		}	// #end of switch ($event)
		break;

	case 'manager':
		switch ($event) {
		case 'create':
		case 'delete':
			event_post_action();
			break;

		default:
			break;
		}	// #end of switch ($event)
		break;

	case 'order':
		switch ($event) {
		case 'search':
		case 'detail':
		case 'active':
		case 'outstock':
		case 'complete':
		case 'close':
		case 'create':
			event_post_action();
			break;

		default:
			break;
		}	// #end of switch ($event)
		break;

	case 'orderitem':
		switch ($event) {
		case 'create':
		case 'cartDelete':
			if(isset($_COOKIE['account']) && isset($_COOKIE['token'])) {
				event_post_action();
			}
			else {
				echo json_encode(array('message' => '請先註冊或登入'));
				return;
			}
			break;

		default:
			break;
		}	// #end of switch ($event)
		break;

	default:
		router('index');
		break;
	}	// #end of switch ($_POST['module'])
}

elseif (isset($_GET['route']) || isset($_POST['route'])) {
	$route = isset($_GET['route']) ? $_GET['route'] : $_POST['route'];
	router($route);
}

else {
	router('index');
}
