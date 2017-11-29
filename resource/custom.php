<?php

function curl_post($post, $module) {
	$ch = curl_init();
	$protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http";
	curl_setopt($ch, CURLOPT_URL, $protocol.'://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['SCRIPT_NAME']).'/model/'.$module.'.php');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}

function get_ordno() {
	$sql = mysql_query("SELECT NORDNO FROM OWNMAS");
	$fetch = mysql_fetch_array($sql);
	return $fetch['NORDNO'];
}

function update_ordno() {
	$sql = "UPDATE OWNMAS SET NORDNO=NORDNO+1";
	if (mysql_query($sql)) {
		return 'Success';
	}
	else {
		return 'Database operation error';
	}
}

function get_msgno() {
	$sql = mysql_query("SELECT NMSGNO FROM OWNMAS");
	$fetch = mysql_fetch_array($sql);
	return $fetch['NMSGNO'];
}

function update_msgno() {
	$sql = "UPDATE OWNMAS SET NMSGNO=NMSGNO+1";
	if (mysql_query($sql)) {
		return 'Success';
	}
	else {
		return 'Database operation error';
	}
}

function update_orditem($account, $ordno) {
	$sql = "UPDATE ORDITEMMAS SET ORDNO='$ordno' WHERE ORDNO='0' AND EMAIL='$account'";
	if (mysql_query($sql)) {
		return 'Success';
	}
	else {
		return 'Database operation error';
	}
}

function show_CUSIDT($cusidt) {
	if ($cusidt == 'A') return '管理員';
	elseif ($cusidt == 'B') return '顧客';
}

function show_CUSTYPE($custype) {
	if ($custype == 'A') return '乾性';
	elseif ($custype == 'B') return '中性';
	elseif ($custype == 'C') return '油性';
	elseif ($custype == 'D') return '混和性';
}

function show_KNOWTYPE($knowtype) {
	if ($knowtype == 'A') return '粉絲專頁';
	elseif ($knowtype == 'B') return '親友介紹';
	elseif ($knowtype == 'C') return '媒體宣傳';
	elseif ($knowtype == 'D') return '實體攤位';
	elseif ($knowtype == 'E') return '其它';
}

function show_BACKSTAT($backstat) {
	if ($backstat == '1') return '缺貨中';
	elseif ($backstat == '0') return '有存貨';
}

function show_ORDSTAT($ordstat) {
	if ($ordstat == 'E') return '待處理';
	elseif ($ordstat == 'R') return '處理中';
	elseif ($ordstat == 'C') return '已出貨';
	elseif ($ordstat == 'F') return '強制結束';
}

function show_PAYSTAT($paystat, $ordno) {
	if ($paystat == '1') return '已付款';
	elseif ($paystat == '0') return '<a href="index.php?route=pay&ordno='.$ordno.'">立即付款</a>';
}

function show_PAYTYPE($paytype) {
	if ($paytype == 'A') return '信用卡';
	elseif ($paytype == 'B') return '網路ATM';
	elseif ($paytype == 'C') return 'ATM';
}

function show_MSGPHOTO($msgno, $msgphoto) {
	if ($msgphoto == '1') {
		return '<a onclick="showPhoto(\''.$msgno.'\')">點我觀看</a>';
	}
	else {
		return '無';
	}
}

function show_MSGVIDEO($msgno, $msgvideo) {
	if ($msgvideo == '1') {
		return '<a onclick="showVideo(\''.$msgno.'\')">點我觀看</a>';
	}
	else {
		return '無';
	}
}

function is_nonnegativeInt($value) {
	if ((ceil($value) == floor($value)) && $value >= 0) {
		return true;
	}
	else {
		return false;
	}
}

function is_positiveInt($value) {
	if ((ceil($value) == floor($value)) && $value > 0) {
		return true;
	}
	else {
		return false;
	}
}

function query_name($itemno) {
	$sql = mysql_query("SELECT * FROM ITEMMAS WHERE ITEMNO='$itemno'");
	$fetch = mysql_fetch_array($sql);
	return $fetch['ITEMNM'];
}

function query_price($itemno) {
	$sql = mysql_query("SELECT * FROM ITEMMAS WHERE ITEMNO='$itemno'");
	$fetch = mysql_fetch_array($sql);
	return $fetch['PRICE'];
}

function orderRecalculate($account, $ordno) {
	$sql1 = mysql_query("SELECT * FROM ORDITEMMAS WHERE ORDNO='$ordno' AND EMAIL='$account'");
	$total = 0;
	while ($fetch1 = mysql_fetch_array($sql1)) {
		$total += query_price($fetch1['ITEMNO']) * $fetch1['ORDAMT'];
	}
	$shipfee = ($total >= 777) ? 0 : 70;
	date_default_timezone_set('Asia/Taipei');
	$date = date("Y-m-d H:i:s");
	mysql_query("UPDATE ORDMAS SET TOTALPRICE='$total', SHIPFEE='$shipfee', UPDATEDATE='$date' WHERE ORDNO='$ordno' AND EMAIL='$account'");
}

function update_rewardstat($index) {
	$sql = "UPDATE MSGMAS SET REWARDSTAT=1 WHERE MSGNO='$index'";
	if (mysql_query($sql)) {
		return 'Success';
	}
	else {
		return 'Database operation error';
	}
}

function send_discount($account) {
	$sql = "UPDATE CUSMAS SET DISCOUNT=DISCOUNT+25 WHERE EMAIL='$account'";
	if (mysql_query($sql)) {
		return 'Success';
	}
	else {
		return 'Database operation error';
	}
}

function get_verify() {
	$str = "23456789abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ";
	$code = '';
	for ($i = 0; $i < 6; $i++) {
		$code .= $str[mt_rand(0, strlen($str)-1)];
	}
	return $code;
}

function get_token() {
	$str = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$code = '';
	for ($i = 0; $i < 12; $i++) {
		$code .= $str[mt_rand(0, strlen($str)-1)];
	}
	return $code;
}

function check_taxid($id) {
	$tbNum = array(1,2,1,2,1,2,4,1);
	if (!preg_match('/^[0-9]{8}$/', $id)) {
		return false;
	}
	$intSum = 0;
	for ($i = 0; $i < count($tbNum); $i++) {
		$intMultiply = substr($sid, $i, 1) * $tbNum[$i];
		$intAddition = (floor($intMultiply / 10) + ($intMultiply % 10));
		$intSum += $intAddition;
	}
	return ($intSum % 10 == 0) || ($intSum % 10 == 9 && substr($sid, 6, 1) == 7);
}

function encrypt($password) {
	return substr(md5(substr(md5($password), 8, 16)), 12, 12);
}

function get_code() {
	$str = "0123456789";
	$code = '';
	for ($i = 0; $i < 12; $i++) {
		$code .= $str[mt_rand(0, strlen($str)-1)];
	}
	return $code;
}

function query_discountName($dctid) {
	$sql = mysql_query("SELECT * FROM DCTMAS WHERE DCTID='$dctid'");
	$fetch = mysql_fetch_array($sql);
	return $fetch['DCTNM'];
}

function query_discountPrice($dctid) {
	$sql = mysql_query("SELECT * FROM DCTMAS WHERE DCTID='$dctid'");
	$fetch = mysql_fetch_array($sql);
	return $fetch['DCTPRICE'];
}

function query_memberName($email) {
	$sql = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$email'");
	$fetch = mysql_fetch_array($sql);
	return $fetch['CUSNM'];
}

function check_dependency_head($route) {
	$require_flexslider = ['index', 'trial', 'single_product'];
	$require_jquery_ui = ['faq', 'partner', 'single_product'];

	if(in_array($route, $require_flexslider)){
		echo '		<link href="resource/flexslider/flexslider.min.css" rel="stylesheet">';
	}

	if(in_array($route, $require_jquery_ui)){
		echo '		<link href="resource/js/jquery-ui-accordion/jquery-ui.min.css" rel="stylesheet">';
	}
}

function check_dependency_body($route) {
	$require_flexslider = ['index', 'trial', 'single_product'];
	$require_jquery_ui = ['faq', 'partner', 'single_product'];
	$require_map_api = ['contact'];

	if(in_array($route, $require_flexslider)){
		echo '		<script src="resource/flexslider/jquery.flexslider-min.js" defer></script>';
	}

	if(in_array($route, $require_jquery_ui)){
		echo '		<script src="resource/js/jquery-ui-accordion/jquery-ui.min.js" defer></script>';
	}

	if(in_array($route, $require_map_api)){
		echo '		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBqLzZouUqN1dWEVR9_75YO6bXL5OuhcRs"></script>';
		echo '		<script src="resource/js/contact-map.js" defer></script>';
	}
}

function include_view_head($route) {
	require('view/head.html');
	check_dependency_head($route);
	require('view/head_finish.html');
}

function include_view_nav($authority) {
	// Get Nav content, find '{login_status}' and replace with proper function links
	$nav_dir = 'view/nav.html';
	$nav_handle = fopen($nav_dir, 'r');
	$nav_content = fread($nav_handle, filesize($nav_dir));
	fclose($nav_handle);

	// Admin
	if ($authority == 'A') {
		$nav_auth_dir = 'view/component/nav/login_admin.html';
	}
	// Member
	elseif ($authority == 'B') {
		$nav_auth_dir = 'view/component/nav/login_member.html';
	}
	// Anonymous
	else {
		$nav_auth_dir = 'view/component/nav/login_signup.html';
	}

	$nav_auth_handle = fopen($nav_auth_dir, 'r');
	$nav_status_content = fread($nav_auth_handle, filesize($nav_auth_dir));
	fclose($nav_auth_handle);

	$nav_content = str_replace('{login_status}', $nav_status_content, $nav_content);
	echo $nav_content;
}

function include_view_jumbotron($route) {
	if($route === 'index') {
		include_once('view/jumbotron/index_flexslider.html');
	}
	else {
		// Get img jumbotron with background image
		$header_start_dir = 'view/jumbotron/img_jumbotron.html';
		$header_start_handle = fopen($header_start_dir, 'r');
		$header_start_content = fread($header_start_handle, filesize($header_start_dir));
		fclose($header_start_handle);

		$header_start_content = str_replace('{route}', $route, $header_start_content);
		echo $header_start_content;

		// Get jumbotron title
		$title_dir = 'view/jumbotron/title.html';
		$title_handle = fopen($title_dir, 'r');
		$title_content = fread($title_handle, filesize($title_dir));
		fclose($title_handle);

		$title_content = str_replace('{route_title}', 'title', $title_content);
		echo $title_content;

		// Get jumbotron subtitle if $route has subtitle
		$subtitle_dir = 'view/jumbotron/subtitle.html';
		$subtitle_handle = fopen($subtitle_dir, 'r');
		$subtitle_content = fread($subtitle_handle, filesize($subtitle_dir));
		fclose($subtitle_handle);

		$subtitle_content = str_replace('{route_subtitle}', 'subtitle', $subtitle_content);
		echo $subtitle_content;

		// Get jumbotron btn text & link if $route has btn
		$btn_dir = 'view/jumbotron/btn.html';
		$btn_handle = fopen($btn_dir, 'r');
		$btn_content = fread($btn_handle, filesize($btn_dir));
		fclose($btn_handle);

		$btn_content = str_replace('{route_btn_link}', 'btn_link', $btn_content);
		$btn_content = str_replace('{route_btn_text}', 'btn_text', $btn_content);
		echo $btn_content;
	}
	include_once('view/jumbotron/header_finish.html');
}

function include_view_content($route) {
	include_once('view/content/' . $route . '.html');
}

function include_view_footer($route) {
	// Get Footer content, find '{company_}'s and replace with proper company info
	$footer_dir = 'view/footer.html';
	$footer_handle = fopen($footer_dir, 'r');
	$footer_content = fread($footer_handle, filesize($footer_dir));
	fclose($footer_handle);

	$company_phone = curl_post(array('module' => 'cue', 'target' => 'company_phone'), 'cue');
	$company_email = curl_post(array('module' => 'cue', 'target' => 'company_email'), 'cue');
	$company_address = curl_post(array('module' => 'cue', 'target' => 'company_address'), 'cue');

	$footer_content = str_replace('{company_phone}', $company_phone, $footer_content);
	$footer_content = str_replace('{company_email}', $company_email, $footer_content);
	$footer_content = str_replace('{company_address}', $company_address, $footer_content);
	echo $footer_content;

	check_dependency_body($route);
	require('view/footer_finish.html');
}

function callView($route, $authority = null) {
	include_view_head($route);
	include_view_nav($authority);
	include_view_jumbotron($route);
	include_view_content($route);
	include_view_footer($route);
	// return true;
}