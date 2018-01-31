<?php
include_once('router.php');
include_once('resource/layout.php');

if (isset($_GET['in']) || isset($_POST['in'])) {
	$in = isset($_GET['in']) ? $_GET['in'] : $_POST['in'];
	if ($in == 'create') {
		if (isset($_COOKIE['account']) && isset($_COOKIE['identity']) && $_COOKIE['identity'] == 'A') {
			include_once("view/manage_ui/orderCreate.html");
		}
	}
	elseif ($in == 'stateE') {
		if (isset($_COOKIE['account']) && isset($_COOKIE['identity']) && $_COOKIE['identity'] == 'A') {
			$myfile = fopen("view/manage_ui/order_state_E.html", "r");
			$content = fread($myfile, filesize("view/manage_ui/order_state_E.html"));
			fclose($myfile);
			$operate = curl_post(array('module' => 'order', 'event' => 'operate', 'state' => 'E', 'account' => $_COOKIE['account'], 'token' => $_COOKIE['token']), 'order');
			$content = str_replace('[orderOperateE]', $operate, $content);
			$name = curl_post(array('module' => 'cue', 'target' => 'member_name', 'account' => $_COOKIE['account']), 'cue');
			$content = str_replace('[member_name]', $name, $content);
			echo $content;
		}
	}
	elseif ($in == 'stateR') {
		if (isset($_COOKIE['account']) && isset($_COOKIE['identity']) && $_COOKIE['identity'] == 'A') {
			$myfile = fopen("view/manage_ui/order_state_R.html", "r");
			$content = fread($myfile, filesize("view/manage_ui/order_state_R.html"));
			fclose($myfile);
			$operate = curl_post(array('module' => 'order', 'event' => 'operate', 'state' => 'R', 'account' => $_COOKIE['account'], 'token' => $_COOKIE['token']), 'order');
			$content = str_replace('[orderOperateR]', $operate, $content);
			$name = curl_post(array('module' => 'cue', 'target' => 'member_name', 'account' => $_COOKIE['account']), 'cue');
			$content = str_replace('[member_name]', $name, $content);
			echo $content;
		}
	}
	elseif ($in == 'state1') {
		if (isset($_COOKIE['account']) && isset($_COOKIE['identity']) && $_COOKIE['identity'] == 'A') {
			$myfile = fopen("view/manage_ui/order_state_1.html", "r");
			$content = fread($myfile, filesize("view/manage_ui/order_state_1.html"));
			fclose($myfile);
			$operate = curl_post(array('module' => 'order', 'event' => 'operate', 'state' => '1', 'account' => $_COOKIE['account'], 'token' => $_COOKIE['token']), 'order');
			$content = str_replace('[orderOperate1]', $operate, $content);
			$name = curl_post(array('module' => 'cue', 'target' => 'member_name', 'account' => $_COOKIE['account']), 'cue');
			$content = str_replace('[member_name]', $name, $content);
			echo $content;
		}
	}
	elseif ($in == 'stateC') {
		if (isset($_COOKIE['account']) && isset($_COOKIE['identity']) && $_COOKIE['identity'] == 'A') {
			$myfile = fopen("view/manage_ui/order_state_C.html", "r");
			$content = fread($myfile, filesize("view/manage_ui/order_state_C.html"));
			fclose($myfile);
			$operate = curl_post(array('module' => 'order', 'event' => 'operate', 'state' => 'C', 'account' => $_COOKIE['account'], 'token' => $_COOKIE['token']), 'order');
			$content = str_replace('[orderOperateC]', $operate, $content);
			$name = curl_post(array('module' => 'cue', 'target' => 'member_name', 'account' => $_COOKIE['account']), 'cue');
			$content = str_replace('[member_name]', $name, $content);
			echo $content;
		}
	}
	elseif ($in == 'stateF') {
		if (isset($_COOKIE['account']) && isset($_COOKIE['identity']) && $_COOKIE['identity'] == 'A') {
			$myfile = fopen("view/manage_ui/order_state_F.html", "r");
			$content = fread($myfile, filesize("view/manage_ui/order_state_F.html"));
			fclose($myfile);
			$operate = curl_post(array('module' => 'order', 'event' => 'operate', 'state' => 'F', 'account' => $_COOKIE['account'], 'token' => $_COOKIE['token']), 'order');
			$content = str_replace('[orderOperateF]', $operate, $content);
			$name = curl_post(array('module' => 'cue', 'target' => 'member_name', 'account' => $_COOKIE['account']), 'cue');
			$content = str_replace('[member_name]', $name, $content);
			echo $content;
		}
	}
	elseif ($in == 'cusView') {
		if (isset($_COOKIE['account'])) {
			$page = 'order_cus_view';
			include_u_view_head($page);

			$content_dir = 'view/user_function/' . $page . '.html';
			$content = file_get_contents($content_dir);

			$operate = curl_post(array('module' => 'order', 'event' => 'cusOperate', 'account' => $_COOKIE['account'], 'token' => $_COOKIE['token']), 'order');
			$content = str_replace('[cusOrderOperate]', $operate, $content);

			$name = curl_post(array('module' => 'cue', 'target' => 'member_name', 'account' => $_COOKIE['account']), 'cue');
			$content = str_replace('[member_name]', $name, $content);

			echo $content;

			include_u_view_footer();
		}
	}
}

elseif (isset($_COOKIE['account']) && isset($_COOKIE['identity']) && $_COOKIE['identity'] == 'A') {
	$myfile = fopen("view/manage_ui/order.html", "r");
	$content = fread($myfile, filesize("view/manage_ui/order.html"));
	fclose($myfile);
	$show = curl_post(array('module' => 'order', 'event' => 'show', 'account' => $_COOKIE['account'], 'token' => $_COOKIE['token']), 'order');
	$content = str_replace('[orderShow]', $show, $content);
	$name = curl_post(array('module' => 'cue', 'target' => 'member_name', 'account' => $_COOKIE['account']), 'cue');
	$content = str_replace('[member_name]', $name, $content);
	echo $content;
}

else {
	router('index');
}