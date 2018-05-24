<?php
include_once("resource/custom.php");

function check_identity() {
	if(isset($_COOKIE['identity'])) {
		return $_COOKIE['identity'];
	}
	else {
		return null;
	}
}

function router($route) {
	$route_pages = ['about', 'contact', 'customize', 'faq', 'gift_box', 'index', 'media', 'moonfest', 'newyear', 'partner', 'products', 'shopping_guide', 'single_product', 'soap', 'soapstring', 'trial', 'wedding'];
	$function_pages = ['cart', 'cashing', 'discount', 'item', 'manager', 'member', 'order', 'pay', 'purchase_finish'];

	$identity = check_identity();

	if(in_array($route, $route_pages)) {
		callView($route, $identity);
	}
	elseif(in_array($route, $function_pages)) {
		// if($under_construction) {
		// 	include_once('view/under_construction.html');
		// 	return;
		// }

		include_once('controller/' . $route . '.php');
	}
	else {	// $route not set or not found in above arrays -> clear url and route to 'index'
		header('Location: /index.php');
		die();
	}
}
