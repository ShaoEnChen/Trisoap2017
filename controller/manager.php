<?php
include_once('router.php');
include_once('resource/layout.php');

if (isset($_GET['in']) || isset($_POST['in'])) {
	$in = isset($_GET['in']) ? $_GET['in'] : $_POST['in'];
	if ($in == 'create') {
		if (isset($_COOKIE['account']) && isset($_COOKIE['identity']) && $_COOKIE['identity'] == 'A') {
			$page = 'manager_create';
			include_m_view_head($page);

			controller_get_nav('manager');

			$content_dir = 'view/manage_ui/' . $page . '.html';
			include_once($content_dir);

			include_m_view_footer();
		}
	}
	elseif ($in == 'delete') {
		if (isset($_COOKIE['account']) && isset($_COOKIE['identity']) && $_COOKIE['identity'] == 'A') {
			$page = 'manager_delete';
			include_m_view_head($page);

			controller_get_nav('manager');

			$content_dir = 'view/manage_ui/' . $page . '.html';
			include_once($content_dir);

			include_m_view_footer();
		}
	}
}

elseif (isset($_COOKIE['account']) && isset($_COOKIE['identity']) && $_COOKIE['identity'] == 'A') {
	$page = 'manager';
	include_m_view_head($page);

	controller_get_nav('manager');

	$content_dir = 'view/manage_ui/' . $page . '.html';
	$content = file_get_contents($content_dir);

	$show = curl_post(array('module' => 'manager', 'event' => 'show', 'account' => $_COOKIE['account'], 'token' => $_COOKIE['token']), 'manager');
	$content = str_replace('[managerShow]', $show, $content);

	echo $content;

	include_m_view_footer();
}

else {
	router('index');
}