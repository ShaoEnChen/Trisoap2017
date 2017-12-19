<?php

if (isset($_GET['in']) || isset($_POST['in'])) {
	$in = isset($_GET['in']) ? $_GET['in'] : $_POST['in'];
	if ($in == 'create') {
		if (isset($_COOKIE['account'])) {
			include_once("view/function/messageCreate.html");
		}
		else {
			include_once("view/function/memberSignin.html");
		}
	}
	elseif ($in == 'stateA') {
		if (isset($_COOKIE['account']) && isset($_COOKIE['identity']) && $_COOKIE['identity'] == 'A') {
			$myfile = fopen("view/function/messageStateA.html", "r");
			$content = fread($myfile, filesize("view/function/messageStateA.html"));
			fclose($myfile);
			$operate = curl_post(array('module' => 'message', 'event' => 'operate', 'state' => 'A', 'account' => $_COOKIE['account'], 'token' => $_COOKIE['token']), 'message');
			$content = str_replace('[messageOperateA]', $operate, $content);
			$name = curl_post(array('module' => 'cue', 'target' => 'member_name', 'account' => $_COOKIE['account']), 'cue');
			$content = str_replace('[member_name]', $name, $content);
			echo $content;
		}
	}
	elseif ($in == 'stateB') {
		if (isset($_COOKIE['account']) && isset($_COOKIE['identity']) && $_COOKIE['identity'] == 'A') {
			$myfile = fopen("view/function/messageStateB.html", "r");
			$content = fread($myfile, filesize("view/function/messageStateB.html"));
			fclose($myfile);
			$operate = curl_post(array('module' => 'message', 'event' => 'operate', 'state' => 'B', 'account' => $_COOKIE['account'], 'token' => $_COOKIE['token']), 'message');
			$content = str_replace('[messageOperateB]', $operate, $content);
			$name = curl_post(array('module' => 'cue', 'target' => 'member_name', 'account' => $_COOKIE['account']), 'cue');
			$content = str_replace('[member_name]', $name, $content);
			echo $content;
		}
	}
	elseif ($in == 'stateC') {
		if (isset($_COOKIE['account']) && isset($_COOKIE['identity']) && $_COOKIE['identity'] == 'A') {
			$myfile = fopen("view/function/messageStateC.html", "r");
			$content = fread($myfile, filesize("view/function/messageStateC.html"));
			fclose($myfile);
			$operate = curl_post(array('module' => 'message', 'event' => 'operate', 'state' => 'C', 'account' => $_COOKIE['account'], 'token' => $_COOKIE['token']), 'message');
			$content = str_replace('[messageOperateC]', $operate, $content);
			$name = curl_post(array('module' => 'cue', 'target' => 'member_name', 'account' => $_COOKIE['account']), 'cue');
			$content = str_replace('[member_name]', $name, $content);
			echo $content;
		}
	}
	elseif ($in == 'stateD') {
		if (isset($_COOKIE['account']) && isset($_COOKIE['identity']) && $_COOKIE['identity'] == 'A') {
			$myfile = fopen("view/function/messageStateD.html", "r");
			$content = fread($myfile, filesize("view/function/messageStateD.html"));
			fclose($myfile);
			$operate = curl_post(array('module' => 'message', 'event' => 'operate', 'state' => 'D', 'account' => $_COOKIE['account'], 'token' => $_COOKIE['token']), 'message');
			$content = str_replace('[messageOperateD]', $operate, $content);
			$name = curl_post(array('module' => 'cue', 'target' => 'member_name', 'account' => $_COOKIE['account']), 'cue');
			$content = str_replace('[member_name]', $name, $content);
			echo $content;
		}
	}
	elseif ($in == 'stateE') {
		if (isset($_COOKIE['account']) && isset($_COOKIE['identity']) && $_COOKIE['identity'] == 'A') {
			$myfile = fopen("view/function/messageStateE.html", "r");
			$content = fread($myfile, filesize("view/function/messageStateE.html"));
			fclose($myfile);
			$operate = curl_post(array('module' => 'message', 'event' => 'operate', 'state' => 'E', 'account' => $_COOKIE['account'], 'token' => $_COOKIE['token']), 'message');
			$content = str_replace('[messageOperateE]', $operate, $content);
			$name = curl_post(array('module' => 'cue', 'target' => 'member_name', 'account' => $_COOKIE['account']), 'cue');
			$content = str_replace('[member_name]', $name, $content);
			echo $content;
		}
	}
}

elseif (isset($_COOKIE['account']) && isset($_COOKIE['identity']) && $_COOKIE['identity'] == 'A') {
	$myfile = fopen("view/function/message.html", "r");
	$content = fread($myfile, filesize("view/function/message.html"));
	fclose($myfile);
	$show = curl_post(array('module' => 'message', 'event' => 'show', 'account' => $_COOKIE['account'], 'token' => $_COOKIE['token']), 'message');
	$content = str_replace('[messageShow]', $show, $content);
	$name = curl_post(array('module' => 'cue', 'target' => 'member_name', 'account' => $_COOKIE['account']), 'cue');
	$content = str_replace('[member_name]', $name, $content);
	echo $content;
}

else {
	include_once("controller/index.php");
}