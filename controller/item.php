<?php

if (isset($_GET['in']) || isset($_POST['in'])) {
	$in = isset($_GET['in']) ? $_GET['in'] : $_POST['in'];
	if ($in == 'create') {
		if (isset($_COOKIE['account']) && isset($_COOKIE['identity']) && $_COOKIE['identity'] == 'A') {
			include_once("view/itemCreate.html");
		}
	}
	elseif ($in == 'edit') {
		if (isset($_COOKIE['account']) && isset($_COOKIE['identity']) && $_COOKIE['identity'] == 'A') {
			include_once("view/itemEdit.html");
		}
	}
	elseif ($in == 'offshelf') {
		if (isset($_COOKIE['account']) && isset($_COOKIE['identity']) && $_COOKIE['identity'] == 'A') {
			include_once("view/itemOffshelf.html");
		}
	}
	elseif ($in == 'onshelf') {
		if (isset($_COOKIE['account']) && isset($_COOKIE['identity']) && $_COOKIE['identity'] == 'A') {
			include_once("view/itemOnshelf.html");
		}
	}
	elseif ($in == 'replenish') {
		if (isset($_COOKIE['account']) && isset($_COOKIE['identity']) && $_COOKIE['identity'] == 'A') {
			include_once("view/itemReplenish.html");
		}
	}
	elseif ($in == 'sell') {
		if (isset($_COOKIE['account']) && isset($_COOKIE['identity']) && $_COOKIE['identity'] == 'A') {
			include_once("view/itemSell.html");
		}
	}
}

elseif (isset($_COOKIE['account']) && isset($_COOKIE['identity']) && $_COOKIE['identity'] == 'A') {
	$myfile = fopen("view/item.html", "r");
	$content = fread($myfile, filesize("view/item.html"));
	fclose($myfile);
	$show = curl_post(array('module' => 'item', 'event' => 'show', 'account' => $_COOKIE['account'], 'token' => $_COOKIE['token']), 'item');
	$content = str_replace('[itemShow]', $show, $content);
	$name = curl_post(array('module' => 'cue', 'target' => 'member_name', 'account' => $_COOKIE['account']), 'cue');
	$content = str_replace('[member_name]', $name, $content);
	echo $content;
}

else {
	include_once("controller/index.php");
}