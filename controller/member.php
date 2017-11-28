<?php

if (isset($_GET['in']) || isset($_POST['in'])) {
	$in = isset($_GET['in']) ? $_GET['in'] : $_POST['in'];
	if ($in == 'login') {
		if (isset($_COOKIE['account'])) {
			include_once("controller/index.php");
		}
		else {
			include_once("view/memberLogin.html");
		}
	}
	elseif ($in == 'logon') {
		if (isset($_COOKIE['account'])) {
			include_once("controller/index.php");
		}
		else {
			include_once("view/memberLogon.html");
		}
	}
	elseif ($in == 'resetPassword') {
		if (isset($_COOKIE['account'])) {
			include_once("controller/index.php");
		}
		else {
			include_once("view/memberResetPassword.html");
		}
	}
	elseif ($in == 'changePassword') {
		if (isset($_COOKIE['account'])) {
			include_once("view/memberchangePassword.html");
		}
		else {
			include_once("controller/index.php");
		}
	}
	elseif ($in == 'edit') {
		if (isset($_COOKIE['account'])) {
			$myfile = fopen("view/memberEdit.html", "r");
			$content = fread($myfile, filesize("view/memberEdit.html"));
			fclose($myfile);
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
		}
		else {
			include_once("controller/index.php");
		}
	}
	elseif ($in == 'verify') {
		if (isset($_COOKIE['account'])) {
			include_once("view/memberVerify.html");
		}
		else {
			include_once("controller/index.php");
		}
	}
	else {
		include_once("controller/index.php");
	}
}

elseif (isset($_COOKIE['account']) && isset($_COOKIE['identity']) && $_COOKIE['identity'] == 'A') {
	$myfile = fopen("view/member.html", "r");
	$content = fread($myfile, filesize("view/member.html"));
	fclose($myfile);
	$show = curl_post(array('module' => 'member', 'event' => 'show', 'account' => $_COOKIE['account'], 'token' => $_COOKIE['token']), 'member');
	$content = str_replace('[memberShow]', $show, $content);
	$name = curl_post(array('module' => 'cue', 'target' => 'member_name', 'account' => $_COOKIE['account']), 'cue');
	$content = str_replace('[member_name]', $name, $content);
	echo $content;
}

else {
	include_once("controller/index.php");
}