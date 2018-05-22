<?php
include_once('router.php');
include_once('resource/layout.php');

if (isset($_GET['in']) || isset($_POST['in'])) {
	$in = isset($_GET['in']) ? $_GET['in'] : $_POST['in'];
	if ($in == 'signin') {
		if (isset($_COOKIE['account'])) {
			router('index');
		}
		else {
			$page = 'member_signin';
			include_u_view_head($page);

			$content_dir = 'view/user_function/' . $page . '.html';

			$content = file_get_contents($content_dir);
			$origin = isset($_GET['origin']) ? $_GET['origin'] : '';
			$amount = isset($_GET['amount']) ? $_GET['amount'] : '';
			$content = str_replace('[origin]', $origin, $content);
			$content = str_replace('[index]', $index, $content);
			$content = str_replace('[amount]', $amount, $content);
			echo $content;

			include_u_view_footer($page);
		}
	}
	elseif ($in == 'signup') {
		if (isset($_COOKIE['account'])) {
			router('index');
		}
		else {
			$page = 'member_signup';
			include_u_view_head($page);

			$content_dir = 'view/user_function/' . $page . '.html';
			include_once($content_dir);

			include_u_view_footer($page);
		}
	}
	elseif ($in == 'resetPassword') {
		if (isset($_COOKIE['account'])) {
			router('index');
		}
		else {
			$page = 'member_reset_password';
			include_u_view_head($page);

			$content_dir = 'view/user_function/' . $page . '.html';
			include_once($content_dir);

			include_u_view_footer($page);
		}
	}
	elseif ($in == 'changePassword') {
		if (isset($_COOKIE['account'])) {
			$page = 'member_change_password';
			include_u_view_head($page);

			$content_dir = 'view/user_function/' . $page . '.html';
			include_once($content_dir);

			include_u_view_footer($page);
		}
		else {
			router('index');
		}
	}
	elseif ($in == 'edit') {
		if (isset($_COOKIE['account'])) {
			$page = 'member_edit';
			include_u_view_head($page);

			$content_dir = 'view/user_function/' . $page . '.html';
			$content = file_get_contents($content_dir);

			$name = curl_post(array('module' => 'cue', 'target' => 'member_name', 'account' => $_COOKIE['account']), 'cue');
			$phone = curl_post(array('module' => 'cue', 'target' => 'member_phone', 'account' => $_COOKIE['account']), 'cue');
			$address = curl_post(array('module' => 'cue', 'target' => 'member_address', 'account' => $_COOKIE['account']), 'cue');
			$taxid = curl_post(array('module' => 'cue', 'target' => 'member_taxid', 'account' => $_COOKIE['account']), 'cue');
			$notice = curl_post(array('module' => 'cue', 'target' => 'member_notice', 'account' => $_COOKIE['account']), 'cue');

			// Remove FB prefix when email is shown in view
			$account_email = $_COOKIE['account'];
			if (substr($account_email, 0, 3) === 'FB_') {
				$account_email = substr($_COOKIE['account'], 3);
			}
			$content = str_replace('[member_email]', $account_email, $content);

			$content = str_replace('[member_name]', $name, $content);
			$content = str_replace('[member_address]', $address, $content);
			$content = str_replace('[member_phone]', $phone, $content);
			$content = str_replace('[member_taxid]', $taxid, $content);
			$content = str_replace('[member_notice]', $notice, $content);
			echo $content;

			include_u_view_footer($page);
		}
		else {
			router('index');
		}
	}
	elseif ($in == 'verify') {
		if (isset($_COOKIE['account'])) {
			$page = 'member_verify';
			include_u_view_head($page);

			$content_dir = 'view/user_function/' . $page . '.html';
			include_once($content_dir);

			include_u_view_footer($page);
		}
		else {
			router('index');
		}
	}
	elseif ($in == 'adddata') {
		if (isset($_COOKIE['account'])) {
			$adddata = curl_post(array('module' => 'cue', 'target' => 'member_adddata', 'account' => $_COOKIE['account']), 'cue');
			if ($adddata == 'valid') {
				$page = 'member_adddata';
				include_u_view_head($page);

				$content_dir = 'view/user_function/' . $page . '.html';
				$content = file_get_contents($content_dir);

				$name = curl_post(array('module' => 'cue', 'target' => 'member_name', 'account' => $_COOKIE['account']), 'cue');
				$phone = curl_post(array('module' => 'cue', 'target' => 'member_phone', 'account' => $_COOKIE['account']), 'cue');

				// Remove FB prefix when email is shown in view
				$account_email = $_COOKIE['account'];
				if (substr($account_email, 0, 3) === 'FB_') {
					$account_email = substr($_COOKIE['account'], 3);
				}
				$content = str_replace('[member_email]', $account_email, $content);

				$content = str_replace('[member_name]', $name, $content);
				$content = str_replace('[member_phone]', $phone, $content);
				echo $content;

				include_u_view_footer($page);
			}
			else {
				echo "<script>alert('您已參加過此活動');</script>";
				echo "<script>location.assign('index.php');</script>";
			}
		}
		else {
			router('index');
		}
	}
	else {
		router('index');
	}
}

elseif (isset($_COOKIE['account']) && isset($_COOKIE['identity']) && $_COOKIE['identity'] == 'A') {
	$page = 'member';
	include_m_view_head($page);

	controller_get_nav('member');

	$content_dir = 'view/manage_ui/' . $page . '.html';
	$content = file_get_contents($content_dir);

	$show = curl_post(array('module' => 'member', 'event' => 'show', 'account' => $_COOKIE['account'], 'token' => $_COOKIE['token']), 'member');
	$content = str_replace('[memberShow]', $show, $content);

	$name = curl_post(array('module' => 'cue', 'target' => 'member_name', 'account' => $_COOKIE['account']), 'cue');
	$content = str_replace('[member_name]', $name, $content);

	echo $content;

	include_m_view_footer();
}

else {
	router('index');
}