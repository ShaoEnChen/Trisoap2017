<?php
include_once("resource/database.php");
include_once("resource/custom.php");
include_once("library/message.php");

if (isset($_POST['module'])) {
	if ($_POST['module'] == 'member') {
		if (isset($_POST['event'])) {
			if ($_POST['event'] == 'login') {
				$return = json_decode(curl_post($_POST, $_POST['module']), true);
				if ($return['message'] == 'Success') {
					setcookie('account', $_POST['account']);
					setcookie('token', $return['token']);
					setcookie('identity', $return['identity']);
				}
				elseif ($return['message'] == 'Unverified account') {
					setcookie('account', $_POST['account']);
					$account = $_POST['account'];
					$verify = get_verify();
					$phone = curl_post(array('module' => 'cue', 'target' => 'member_phone', 'account' => $account), 'cue');
					message_verify($phone, $verify);
					mysql_query("UPDATE CUSMAS SET VERIFY='$verify' WHERE EMAIL='$account'");
				}
				echo json_encode(array('message' => $return['message']));
				return;
			}
			elseif ($_POST['event'] == 'logon') {
				$return = json_decode(curl_post($_POST, $_POST['module']), true);
				if ($return['message'] == 'Success') {
					setcookie('account', $_POST['account']);
				}
				echo json_encode(array('message' => $return['message']));
				return;
			}
			elseif ($_POST['event'] == 'logout') {
				$id = array('account' => $_COOKIE['account'], 'token' => $_COOKIE['token']);
				$post = array_merge($id, $_POST);
				$return = json_decode(curl_post($post, $_POST['module']), true);
				if ($return['message'] == 'Success') {
					setcookie("account", "", time()-3600);
					setcookie("token", "", time()-3600);
					setcookie("identity", "", time()-3600);
				}
				echo json_encode(array('message' => $return['message']));
				return;
			}
			elseif ($_POST['event'] == 'verify') {
				$id = array('account' => $_COOKIE['account']);
				$post = array_merge($id, $_POST);
				$return = json_decode(curl_post($post, $_POST['module']), true);
				if ($return['message'] == 'Success') {
					setcookie('token', $return['token']);
					setcookie('identity', $return['identity']);
				}
				echo json_encode(array('message' => $return['message']));
				return;
			}
			elseif (in_array($_POST['event'], array('search', 'edit', 'change_password', 'detail'))) {
				$id = array('account' => $_COOKIE['account'], 'token' => $_COOKIE['token']);
				$post = array_merge($id, $_POST);
				echo curl_post($post, $_POST['module']);
				return;
			}
			elseif ($_POST['event'] == 'reset_password') {
				echo curl_post($_POST, $_POST['module']);
				return;
			}
		}
	}
	elseif ($_POST['module'] == 'discount') {
		if (isset($_POST['event'])) {
			if (in_array($_POST['event'], array('create', 'delete', 'apply', 'search'))) {
				$id = array('account' => $_COOKIE['account'], 'token' => $_COOKIE['token']);
				$post = array_merge($id, $_POST);
				echo curl_post($post, $_POST['module']);
				return;
			}
		}
	}
	elseif ($_POST['module'] == 'item') {
		if (isset($_POST['event'])) {
			if (in_array($_POST['event'], array('create', 'edit', 'editData', 'onshelf', 'offshelf', 'replenish', 'sell'))) {
				$id = array('account' => $_COOKIE['account'], 'token' => $_COOKIE['token']);
				$post = array_merge($id, $_POST);
				echo curl_post($post, $_POST['module']);
				return;
			}
		}
	}
	elseif ($_POST['module'] == 'manager') {
		if (isset($_POST['event'])) {
			if (in_array($_POST['event'], array('create', 'delete'))) {
				$id = array('account' => $_COOKIE['account'], 'token' => $_COOKIE['token']);
				$post = array_merge($id, $_POST);
				echo curl_post($post, $_POST['module']);
				return;
			}
		}
	}
	elseif ($_POST['module'] == 'message') {
		if (isset($_POST['event'])) {
			if (in_array($_POST['event'], array('create', 'search', 'pass', 'reject', 'publish', 'save' ,'delete', 'showPhoto', 'showVideo'))) {
				$id = array('account' => $_COOKIE['account'], 'token' => $_COOKIE['token']);
				$post = array_merge($id, $_POST);
				echo curl_post($post, $_POST['module']);
				return;
			}
			elseif ($_POST['event'] == 'photoCheck') {
				if (isset($_FILES['fileData'])) {
					if (in_array($_FILES['fileData']['type'], array('image/jpeg', 'image/jpg', 'image/png'))) {
						$message = ($_FILES['fileData']['size'] <= 3000000) ? 'Success' : '檔案大小超過上限(3MB)';
						echo json_encode(array('message' => $message));
						return;
					}
					else {
						echo json_encode(array('message' => '影片格式必須為jpeg/jpg/png'));
						return;
					}
				}
				else {
					echo json_encode(array('message' => '檔案附加失敗'));
					return;
				}
			}
			elseif ($_POST['event'] == 'videoCheck') {
				if (isset($_FILES['fileData'])) {
					if ($_FILES['fileData']['type'] == 'video/mp4') {
						$message = ($_FILES['fileData']['size'] <= 10000000) ? 'Success' : '檔案大小超過上限(10MB)';
						echo json_encode(array('message' => $message));
						return;
					}
					else {
						echo json_encode(array('message' => '影片格式必須為jpeg/jpg/png'));
						return;
					}
				}
				else {
					echo json_encode(array('message' => '檔案附加失敗'));
					return;
				}
			}
			elseif ($_POST['event'] == 'photoSend') {
				$msgno = $_POST['msgno'];
				$update = move_uploaded_file($_FILES['fileData']['tmp_name'], 'source/photo/'.$msgno.'.png');
				if ($update) {
					mysql_query("UPDATE MSGMAS SET MSGPHOTO='1' WHERE MSGNO='$msgno'");
				}
			}
			elseif ($_POST['event'] == 'videoSend') {
				$msgno = $_POST['msgno'];
				$update = move_uploaded_file($_FILES['fileData']['tmp_name'], 'source/video/'.$msgno.'.mp4');
				if ($update) {
					mysql_query("UPDATE MSGMAS SET MSGVIDEO='1' WHERE MSGNO='$msgno'");
				}
			}
		}
	}
	elseif ($_POST['module'] == 'order') {
		if (isset($_POST['event'])) {
			if (in_array($_POST['event'], array('search', 'detail', 'active', 'outstock', 'complete', 'close', 'create'))) {
				$id = array('account' => $_COOKIE['account'], 'token' => $_COOKIE['token']);
				$post = array_merge($id, $_POST);
				echo curl_post($post, $_POST['module']);
				return;
			}
		}
	}
	elseif ($_POST['module'] == 'orderitem') {
		if (isset($_POST['event'])) {
			if (in_array($_POST['event'], array('create', 'cartDelete'))) {
				if (isset($_COOKIE['account']) && isset($_COOKIE['token'])) {
					$id = array('account' => $_COOKIE['account'], 'token' => $_COOKIE['token']);
					$post = array_merge($id, $_POST);
					echo curl_post($post, $_POST['module']);
					return;
				}
				else {
					echo json_encode(array('message' => '請先註冊或登入'));
					return;
				}
			}
		}
	}
	else {
		include_once("controller/index.php");
	}
}
elseif (isset($_GET['route']) || isset($_POST['route'])) {
	include_once("controller/router.php");
	$route = isset($_GET['route']) ? $_GET['route'] : $_POST['route'];
	if (in_array($route, array('about', 'brand_intro', 'cart', 'cashing', 'contact', 'discount', 'faq', 'heart_message', 'item', 'manager', 'media', 'member', 'message', 'order', 'partner', 'pay', 'purchaseFinish', 'service', 'shopping_guide', 'single_product', 'soap', 'soapstring', 'trial'))) {
		router($route);
	}
	else {
		router('index');
	}
}
else {
	include_once("controller/router.php");
	router('index');
}