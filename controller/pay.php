<?php

if (isset($_GET['order']) || isset($_POST['order'])) {
	$order = isset($_GET['order']) ? $_GET['order'] : $_POST['order'];
	if (isset($_COOKIE['account']) && isset($_COOKIE['token'])) {
		$myfile = fopen("view/user_function/pay.html", "r");
		$content = fread($myfile, filesize("view/user_function/pay.html"));
		fclose($myfile);
		$operate = curl_post(array('module' => 'orderitem', 'event' => 'orderitemOperate', 'order' => $order, 'account' => $_COOKIE['account'], 'token' => $_COOKIE['token']), 'orderitem');
		if (empty($operate)) {
			$myfile = fopen("view/user_function/pay_empty.html", "r");
			$innerContent = fread($myfile, filesize("view/user_function/pay_empty.html"));
			fclose($myfile);
			$content = str_replace('[payContent]', $innerContent, $content);
		}
		else {
			$myfile = fopen("view/user_function/pay_content.html", "r");
			$innerContent = fread($myfile, filesize("view/user_function/pay_content.html"));
			fclose($myfile);
			$content = str_replace('[payContent]', $innerContent, $content);
			$content = str_replace('[payOperate]', $operate, $content);
			$shipfee = curl_post(array('module' => 'cue', 'target' => 'order_shipfee', 'order' => $order, 'account' => $_COOKIE['account']), 'cue');
			$message = curl_post(array('module' => 'cue', 'target' => 'order_message', 'account' => $_COOKIE['account']), 'cue');
			$discountPrice = curl_post(array('module' => 'cue', 'target' => 'order_discountPrice', 'order' => $order, 'account' => $_COOKIE['account']), 'cue');
			$discountName = curl_post(array('module' => 'cue', 'target' => 'order_discountName', 'order' => $order, 'account' => $_COOKIE['account']), 'cue');
			$total = curl_post(array('module' => 'cue', 'target' => 'order_total', 'order' => $order, 'account' => $_COOKIE['account']), 'cue');
			$address = curl_post(array('module' => 'cue', 'target' => 'order_address', 'order' => $order, 'account' => $_COOKIE['account']), 'cue');
			$notice = curl_post(array('module' => 'cue', 'target' => 'order_notice', 'order' => $order, 'account' => $_COOKIE['account']), 'cue');
			$cashing = 'index.php?route=cashing&ordno='.$order.'&account='.$_COOKIE['account'].'&payType=';
			$content = str_replace('[order_shipfee]', $shipfee, $content);
			$content = str_replace('[order_message]', $message, $content);
			$content = str_replace('[order_discount]', $discountPrice.' '.$discountName, $content);
			$content = str_replace('[order_total]', $total, $content);
			$content = str_replace('[order_address]', $address, $content);
			$content = str_replace('[order_notice]', $notice, $content);
			$content = str_replace('[cashing_detail]', $cashing, $content);
		}
		echo $content;
	}
	else {
		include_once("controller/index.php");
	}
}

else {
	include_once("controller/index.php");
}