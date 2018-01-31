<?php
include_once('router.php');

if (isset($_GET['in']) || isset($_POST['in'])) {
	$in = isset($_GET['in']) ? $_GET['in'] : $_POST['in'];
	if ($in == 'create') {
		if (isset($_COOKIE['account']) && isset($_COOKIE['identity']) && $_COOKIE['identity'] == 'A') {
			include_once("view/manage_ui/managerCreate.html");
		}
	}
	elseif ($in == 'delete') {
		if (isset($_COOKIE['account']) && isset($_COOKIE['identity']) && $_COOKIE['identity'] == 'A') {
			include_once("view/manage_ui/managerDelete.html");
		}
	}
}

elseif (isset($_COOKIE['account']) && isset($_COOKIE['identity']) && $_COOKIE['identity'] == 'A') {
	$myfile = fopen("view/manage_ui/manager.html", "r");
	$content = fread($myfile, filesize("view/manage_ui/manager.html"));
	fclose($myfile);
	$show = curl_post(array('module' => 'manager', 'event' => 'show', 'account' => $_COOKIE['account'], 'token' => $_COOKIE['token']), 'manager');
	$content = str_replace('[managerShow]', $show, $content);
	$name = curl_post(array('module' => 'cue', 'target' => 'member_name', 'account' => $_COOKIE['account']), 'cue');
	$content = str_replace('[member_name]', $name, $content);
	echo $content;
}

else {
	router('index');
}