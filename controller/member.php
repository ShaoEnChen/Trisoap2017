<?php
include_once('router.php');
include_once('resource/layout.php');

if(isset($_GET['in']) || isset($_POST['in'])) {
	$in = isset($_GET['in']) ? $_GET['in'] : $_POST['in'];
	if($in == 'signin') {
		if(isset($_COOKIE['account'])) {
			router('index');
		}
		else {
			$page = 'member_signin';
			include_u_view_head($page);

			$content_dir = 'view/user_function/' . $page . '.html';
			include_once($content_dir);

			include_u_view_footer();
		}
	}
	elseif($in == 'signup') {
		if(isset($_COOKIE['account'])) {
			router('index');
		}
		else {
			$page = 'member_signup';
			include_u_view_head($page);

			$content_dir = 'view/user_function/' . $page . '.html';
			include_once($content_dir);

			include_u_view_footer();
		}
	}
	elseif($in == 'resetPassword') {
		if(isset($_COOKIE['account'])) {
			router('index');
		}
		else {
			$page = 'member_reset_password';
			include_u_view_head($page);

			$content_dir = 'view/user_function/' . $page . '.html';
			include_once($content_dir);

			include_u_view_footer();
		}
	}
	elseif($in == 'changePassword') {
		if(isset($_COOKIE['account'])) {
			$page = 'member_change_password';
			include_u_view_head($page);

			$content_dir = 'view/user_function/' . $page . '.html';
			include_once($content_dir);

			include_u_view_footer();
		}
		else {
			router('index');
		}
	}
	elseif($in == 'edit') {
		if(isset($_COOKIE['account'])) {
			$page = 'member_edit';
			include_u_view_head($page);

			$content_dir = 'view/user_function/' . $page . '.html';
			$content = file_get_contents($content_dir);

			$name = curl_post(array('module' => 'cue', 'target' => 'member_name', 'account' => $_COOKIE['account']), 'cue');
			$address = curl_post(array('module' => 'cue', 'target' => 'member_address', 'account' => $_COOKIE['account']), 'cue');
			$phone = curl_post(array('module' => 'cue', 'target' => 'member_phone', 'account' => $_COOKIE['account']), 'cue');
			$taxid = curl_post(array('module' => 'cue', 'target' => 'member_taxid', 'account' => $_COOKIE['account']), 'cue');
			$notice = curl_post(array('module' => 'cue', 'target' => 'member_notice', 'account' => $_COOKIE['account']), 'cue');
			$content = str_replace('[member_email]', $_COOKIE['account'], $content);
			$content = str_replace('[member_name]', $name, $content);
			$content = str_replace('[member_address]', $address, $content);
			$content = str_replace('[member_phone]', $phone, $content);
			$content = str_replace('[member_taxid]', $taxid, $content);
			$content = str_replace('[member_notice]', $notice, $content);
			echo $content;

			include_u_view_footer();
		}
		else {
			router('index');
		}
	}
	elseif($in == 'verify') {
		if(isset($_COOKIE['account'])) {
			$page = 'member_verify';
			include_u_view_head($page);

			$content_dir = 'view/user_function/' . $page . '.html';
			include_once($content_dir);

			include_u_view_footer();
		}
		else {
			router('index');
		}
	}
	else {
		router('index');
	}
}

elseif(isset($_COOKIE['account']) && isset($_COOKIE['identity']) && $_COOKIE['identity'] == 'A') {
	$myfile = fopen("view/manage_ui/member.html", "r");
	$content = fread($myfile, filesize("view/manage_ui/member.html"));
	fclose($myfile);
	$show = curl_post(array('module' => 'member', 'event' => 'show', 'account' => $_COOKIE['account'], 'token' => $_COOKIE['token']), 'member');
	$content = str_replace('[memberShow]', $show, $content);
	$name = curl_post(array('module' => 'cue', 'target' => 'member_name', 'account' => $_COOKIE['account']), 'cue');
	$content = str_replace('[member_name]', $name, $content);
	echo $content;
}

else {
	router('index');
}