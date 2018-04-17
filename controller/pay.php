<?php
include_once('router.php');
include_once('resource/layout.php');

if (isset($_GET['order']) || isset($_POST['order'])) {
	$order = isset($_GET['order']) ? $_GET['order'] : $_POST['order'];
	if (isset($_COOKIE['account']) && isset($_COOKIE['token'])) {
		$page = 'pay';
		include_u_view_head($page);

		$content_dir = 'view/user_function/' . $page . '.html';
		$content = file_get_contents($content_dir);

		$operate = curl_post(array('module' => 'orderitem', 'event' => 'orderitemOperate', 'order' => $order, 'account' => $_COOKIE['account'], 'token' => $_COOKIE['token']), 'orderitem');
		if (empty($operate)) {
			$innerContent = file_get_contents('view/user_function/pay_empty.html');
			$content = str_replace('[payContent]', $innerContent, $content);
		}
		else {
			$innerContent = file_get_contents('view/user_function/pay_content.html');
			$content = str_replace('[payContent]', $innerContent, $content);
			$content = str_replace('[payOperate]', $operate, $content);
			$shipfee = curl_post(array('module' => 'cue', 'target' => 'order_shipfee', 'order' => $order, 'account' => $_COOKIE['account']), 'cue');
			$shipfee = $_COOKIE['account'];
			$message = curl_post(array('module' => 'cue', 'target' => 'order_message', 'account' => $_COOKIE['account']), 'cue');
			$message = var_dump($message);
			$discountPrice = curl_post(array('module' => 'cue', 'target' => 'order_discountPrice', 'order' => $order, 'account' => $_COOKIE['account']), 'cue');
			$discountPrice = var_dump($discountPrice);
			$discountName = curl_post(array('module' => 'cue', 'target' => 'order_discountName', 'order' => $order, 'account' => $_COOKIE['account']), 'cue');
			$discountName = var_dump($discountName);
			$total = curl_post(array('module' => 'cue', 'target' => 'order_total', 'order' => $order, 'account' => $_COOKIE['account']), 'cue');
			$address = curl_post(array('module' => 'cue', 'target' => 'order_address', 'order' => $order, 'account' => $_COOKIE['account']), 'cue');
			$notice = curl_post(array('module' => 'cue', 'target' => 'order_notice', 'order' => $order, 'account' => $_COOKIE['account']), 'cue');
			$cashing = 'index.php?route=cashing&ordno='.$order.'&account='.$_COOKIE['account'];
			$content = str_replace('[order_shipfee]', $shipfee, $content);
			$content = str_replace('[order_message]', $message, $content);
			$content = str_replace('[order_discount]', $discountPrice.' '.$discountName, $content);
			$content = str_replace('[order_total]', $total, $content);
			$content = str_replace('[order_address]', $address, $content);
			$content = str_replace('[order_notice]', $notice, $content);
			$content = str_replace('[cashing_detail]', $cashing, $content);
		}
		echo $content;

		include_u_view_footer($page);
	}
	else {
		router('index');
	}
}

else {
	router('index');
}