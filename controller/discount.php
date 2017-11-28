<?php

if (isset($_GET['in']) || isset($_POST['in'])) {
	$in = isset($_GET['in']) ? $_GET['in'] : $_POST['in'];
	if ($in == 'apply') {
		if (isset($_COOKIE['account'])) {
			include_once("view/discountApply.html");
		}
	}
	elseif ($in == 'create') {
		if (isset($_COOKIE['account']) && isset($_COOKIE['identity']) && $_COOKIE['identity'] == 'A') {
			include_once("view/discountCreate.html");
		}
	}
	elseif ($in == 'delete') {
		if (isset($_COOKIE['account']) && isset($_COOKIE['identity']) && $_COOKIE['identity'] == 'A') {
			include_once("view/discountDelete.html");
		}
	}
	elseif ($in == 'state0') {
		if (isset($_COOKIE['account']) && isset($_COOKIE['identity']) && $_COOKIE['identity'] == 'A') {
			$myfile = fopen("view/discountState0.html", "r");
			$content = fread($myfile, filesize("view/discountState0.html"));
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
			$myfile = fopen("view/discountState1.html", "r");
			$content = fread($myfile, filesize("view/discountState1.html"));
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
			$myfile = fopen("view/discountState2.html", "r");
			$content = fread($myfile, filesize("view/discountState2.html"));
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
	$myfile = fopen("view/discount.html", "r");
	$content = fread($myfile, filesize("view/discount.html"));
	fclose($myfile);
	$show = curl_post(array('module' => 'discount', 'event' => 'show', 'account' => $_COOKIE['account'], 'token' => $_COOKIE['token']), 'discount');
	$content = str_replace('[discountShow]', $show, $content);
	$name = curl_post(array('module' => 'cue', 'target' => 'member_name', 'account' => $_COOKIE['account']), 'cue');
	$content = str_replace('[member_name]', $name, $content);
	echo $content;
}

else {
	include_once("controller/index.php");
}