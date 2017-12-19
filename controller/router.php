<?php
include_once("resource/custom.php");

function check_identity() {
	if(isset($_COOKIE['identity'])) {
		$identity = $_COOKIE['identity'];
	}
	else {
		$identity = null;
	}
	return $identity;
}

function router($route) {
	$route_pages = ['about', 'brand_intro', 'contact', 'faq', 'index', 'media', 'partner', 'shopping_guide', 'single_product', 'soap', 'soapstring', 'trial'];
	$function_pages = ['cart', 'cashing', 'discount', 'item', 'manager', 'member', 'order', 'pay', 'purchaseFinish'];

	$identity = check_identity();

	if(in_array($route, $route_pages)) {
		callView($route, $identity);
	}
	elseif(in_array($route, $function_pages)) {
		include_once('controller/' . $route . '.php');
	}
	else {
		callView('index', $identity);
	}
}
