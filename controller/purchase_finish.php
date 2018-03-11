<?php
include_once('router.php');
include_once('resource/layout.php');

if (isset($_COOKIE['account'])) {
	$page = 'purchase_finish';
	include_u_view_head($page);

	$content_dir = 'view/user_function/' . $page . '.html';
	include_once($content_dir);

	include_u_view_footer($page);
}

else {
	router('index');
}