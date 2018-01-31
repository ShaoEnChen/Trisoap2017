<?php
include_once('router.php');
include_once('resource/layout.php');

if (isset($_COOKIE['account'])) {
	$page = 'cart';
	include_u_view_head($page);

	$content_dir = 'view/user_function/' . $page . '.html';
	$content = file_get_contents($content_dir);
	$operate = curl_post(array('module' => 'orderitem', 'event' => 'cartOperate', 'account' => $_COOKIE['account'], 'token' => $_COOKIE['token']), 'orderitem');
	if (empty($operate)) {
		$innerContent = file_get_contents('view/user_function/cart_empty.html');
		$content = str_replace('[cartContent]', $innerContent, $content);
	}
	else {
		$innerContent = file_get_contents('view/user_function/cart_content.html');
		$content = str_replace('[cartContent]', $innerContent, $content);
		$content = str_replace('[cartOperate]', $operate, $content);
	}
	echo $content;

	include_u_view_footer();
}
else {
	router('index');
}