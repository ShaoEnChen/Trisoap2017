<?php
include_once('router.php');
include_once('resource/layout.php');

if (isset($_GET['in']) || isset($_POST['in'])) {
	$in = isset($_GET['in']) ? $_GET['in'] : $_POST['in'];
	if ($in == 'apply') {
		if (isset($_COOKIE['account'])) {
			$page = 'discount_apply';
			include_u_view_head($page);

			$content_dir = 'view/user_function/' . $page . '.html';
			include_once($content_dir);

			include_u_view_footer();
		}
	}
	elseif ($in == 'create') {
		if (isset($_COOKIE['account']) && isset($_COOKIE['identity']) && $_COOKIE['identity'] == 'A') {
			include_once("view/manage_ui/discount_create.html");
		}
	}
	elseif ($in == 'delete') {
		if (isset($_COOKIE['account']) && isset($_COOKIE['identity']) && $_COOKIE['identity'] == 'A') {
			include_once("view/manage_ui/discount_delete.html");
		}
	}
	elseif ($in == 'state0') {
		if (isset($_COOKIE['account']) && isset($_COOKIE['identity']) && $_COOKIE['identity'] == 'A') {
			$myfile = fopen("view/manage_ui/discount_state_0.html", "r");
			$content = fread($myfile, filesize("view/manage_ui/discount_state_0.html"));
			fclose($myfile);
			$view = curl_post(array('module' => 'discount', 'event' => 'view', 'state' => '0', 'account' => $_COOKIE['account'], 'token' => $_COOKIE['token']), 'discount');
			$content = str_replace('[discountView0]', $view, $content);
			$name = curl_post(array('module' => 'cue', 'target' => 'member_name', 'account' => $_COOKIE['account']), 'cue');
			$content = str_replace('[member_name]', $name, $content);
			echo $content;
		}
	}
	elseif ($in == 'state1') {
		if (isset($_COOKIE['account']) && isset($_COOKIE['identity']) && $_COOKIE['identity'] == 'A') {
			$myfile = fopen("view/manage_ui/discount_state_1.html", "r");
			$content = fread($myfile, filesize("view/manage_ui/discount_state_1.html"));
			fclose($myfile);
			$view = curl_post(array('module' => 'discount', 'event' => 'view', 'state' => '1', 'account' => $_COOKIE['account'], 'token' => $_COOKIE['token']), 'discount');
			$content = str_replace('[discountView1]', $view, $content);
			$name = curl_post(array('module' => 'cue', 'target' => 'member_name', 'account' => $_COOKIE['account']), 'cue');
			$content = str_replace('[member_name]', $name, $content);
			echo $content;
		}
	}
	elseif ($in == 'state2') {
		if (isset($_COOKIE['account']) && isset($_COOKIE['identity']) && $_COOKIE['identity'] == 'A') {
			$myfile = fopen("view/manage_ui/discount_state_2.html", "r");
			$content = fread($myfile, filesize("view/manage_ui/discount_state_2.html"));
			fclose($myfile);
			$view = curl_post(array('module' => 'discount', 'event' => 'view', 'state' => '2', 'account' => $_COOKIE['account'], 'token' => $_COOKIE['token']), 'discount');
			$content = str_replace('[discountView2]', $view, $content);
			$name = curl_post(array('module' => 'cue', 'target' => 'member_name', 'account' => $_COOKIE['account']), 'cue');
			$content = str_replace('[member_name]', $name, $content);
			echo $content;
		}
	}
}

elseif (isset($_COOKIE['account']) && isset($_COOKIE['identity']) && $_COOKIE['identity'] == 'A') {
	$myfile = fopen("view/manage_ui/discount.html", "r");
	$content = fread($myfile, filesize("view/manage_ui/discount.html"));
	fclose($myfile);
	$show = curl_post(array('module' => 'discount', 'event' => 'show', 'account' => $_COOKIE['account'], 'token' => $_COOKIE['token']), 'discount');
	$content = str_replace('[discountShow]', $show, $content);
	$name = curl_post(array('module' => 'cue', 'target' => 'member_name', 'account' => $_COOKIE['account']), 'cue');
	$content = str_replace('[member_name]', $name, $content);
	echo $content;
}

else {
	router('index');
}