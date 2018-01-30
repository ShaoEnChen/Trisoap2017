<?php

if (isset($_COOKIE['account'])) {
	$myfile = fopen("view/user_function/cart.html", "r");
	$content = fread($myfile, filesize("view/user_function/cart.html"));
	fclose($myfile);
	$operate = curl_post(array('module' => 'orderitem', 'event' => 'cartOperate', 'account' => $_COOKIE['account'], 'token' => $_COOKIE['token']), 'orderitem');
	if (empty($operate)) {
		$myfile = fopen("view/user_function/cart_empty.html", "r");
		$innerContent = fread($myfile, filesize("view/user_function/cart_empty.html"));
		fclose($myfile);
		$content = str_replace('[cartContent]', $innerContent, $content);
	}
	else {
		$myfile = fopen("view/user_function/cart_content.html", "r");
		$innerContent = fread($myfile, filesize("view/user_function/cart_content.html"));
		fclose($myfile);
		$content = str_replace('[cartContent]', $innerContent, $content);
		$content = str_replace('[cartOperate]', $operate, $content);
	}
	echo $content;
}
else {
	include_once("controller/index.php");
}