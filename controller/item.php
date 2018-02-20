<?php
include_once('router.php');
include_once('resource/layout.php');

if (isset($_GET['in']) || isset($_POST['in'])) {
	$in = isset($_GET['in']) ? $_GET['in'] : $_POST['in'];
	if ($in == 'create') {
		if (isset($_COOKIE['account']) && isset($_COOKIE['identity']) && $_COOKIE['identity'] == 'A') {
			$page = 'item_create';
			include_m_view_head($page);

			controller_get_nav('item');

			$content_dir = 'view/manage_ui/' . $page . '.html';
			include_once($content_dir);

			include_m_view_footer();
		}
	}
	elseif ($in == 'edit') {
		if (isset($_COOKIE['account']) && isset($_COOKIE['identity']) && $_COOKIE['identity'] == 'A') {
			$page = 'item_edit';
			include_m_view_head($page);

			controller_get_nav('item');

			$content_dir = 'view/manage_ui/' . $page . '.html';
			include_once($content_dir);

			include_m_view_footer();
		}
	}
	elseif ($in == 'offshelf') {
		if (isset($_COOKIE['account']) && isset($_COOKIE['identity']) && $_COOKIE['identity'] == 'A') {
			$page = 'item_offshelf';
			include_m_view_head($page);

			controller_get_nav('item');

			$content_dir = 'view/manage_ui/' . $page . '.html';
			include_once($content_dir);

			include_m_view_footer();
		}
	}
	elseif ($in == 'onshelf') {
		if (isset($_COOKIE['account']) && isset($_COOKIE['identity']) && $_COOKIE['identity'] == 'A') {
			$page = 'item_onshelf';
			include_m_view_head($page);

			controller_get_nav('item');

			$content_dir = 'view/manage_ui/' . $page . '.html';
			include_once($content_dir);

			include_m_view_footer();
		}
	}
	elseif ($in == 'replenish') {
		if (isset($_COOKIE['account']) && isset($_COOKIE['identity']) && $_COOKIE['identity'] == 'A') {
			$page = 'item_replenish';
			include_m_view_head($page);

			controller_get_nav('item');

			$content_dir = 'view/manage_ui/' . $page . '.html';
			include_once($content_dir);

			include_m_view_footer();
		}
	}
	elseif ($in == 'sell') {
		if (isset($_COOKIE['account']) && isset($_COOKIE['identity']) && $_COOKIE['identity'] == 'A') {
			$page = 'item_sell';
			include_m_view_head($page);

			controller_get_nav('item');

			$content_dir = 'view/manage_ui/' . $page . '.html';
			include_once($content_dir);

			include_m_view_footer();
		}
	}
}

elseif (isset($_COOKIE['account']) && isset($_COOKIE['identity']) && $_COOKIE['identity'] == 'A') {
	$page = 'item';
	include_m_view_head($page);

	controller_get_nav('item');

	$content_dir = 'view/manage_ui/' . $page . '.html';
	$content = file_get_contents($content_dir);

	$show = curl_post(array('module' => 'item', 'event' => 'show', 'account' => $_COOKIE['account'], 'token' => $_COOKIE['token']), 'item');
	$content = str_replace('[itemShow]', $show, $content);

	$name = curl_post(array('module' => 'cue', 'target' => 'member_name', 'account' => $_COOKIE['account']), 'cue');
	$content = str_replace('[member_name]', $name, $content);

	echo $content;

	include_m_view_footer();
}

else {
	router('index');
}