<?php

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

function replace_company_info($content) {
	$company_phone = curl_post(array('module' => 'cue', 'target' => 'company_phone'), 'cue');
	$content = str_replace('{company_phone}', $company_phone, $content);

	$company_email = curl_post(array('module' => 'cue', 'target' => 'company_email'), 'cue');
	$content = str_replace('{company_email}', $company_email, $content);

	$company_address = curl_post(array('module' => 'cue', 'target' => 'company_address'), 'cue');
	$content = str_replace('{company_address}', $company_address, $content);

	return $content;
}

function include_view_head($route) {
	require('view/head.html');
	check_dependency_head($route);
	require('view/head_finish.html');
}

function include_view_nav($authority) {
	// Get Nav content, find '{login_status}' and replace with proper function links
	$nav_dir = 'view/nav.html';
	$nav_content = file_get_contents($nav_dir);

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

	$nav_status_content = file_get_contents($nav_auth_dir);
	$nav_content = str_replace('{login_status}', $nav_status_content, $nav_content);
	echo $nav_content;
}

function include_view_jumbotron($route) {
	if($route === 'index') {
		include_once('view/component/jumbotron/index_flexslider.html');
	}
	else {
		include_view_image_jumbotron($route);
	}
	include_once('view/component/jumbotron/header_finish.html');
}

function include_view_image_jumbotron($route) {
	// Get img jumbotron with background image
	$header_start_dir = 'view/component/jumbotron/img_jumbotron.html';
	$header_start_content = file_get_contents($header_start_dir);
	$header_start_content = str_replace('{route}', $route, $header_start_content);
	echo $header_start_content;

	list($title, $subtitle, $btn) = get_img_jumbotron_content($route);

	if(!is_null($title)) {
		// Get jumbotron title
		$title_dir = 'view/component/jumbotron/title.html';
		$title_content = file_get_contents($title_dir);
		if(is_null($subtitle) && is_null($btn)) {
			// change class name
			$title_content = str_replace('jumbotron-title', 'jumbotron-only-title', $title_content);
		}
		$title_content = str_replace('{route_title}', $title, $title_content);
		echo $title_content;
	}
	if(!is_null($subtitle)) {
		// Get jumbotron subtitle if $route has subtitle
		$subtitle_dir = 'view/component/jumbotron/subtitle.html';
		$subtitle_content = file_get_contents($subtitle_dir);
		$subtitle_content = str_replace('{route_subtitle}', $subtitle, $subtitle_content);
		echo $subtitle_content;
	}
	if(!is_null($btn)) {
		// Get jumbotron btn text & link if $route has btn
		$btn_dir = 'view/component/jumbotron/btn.html';
		$btn_content = file_get_contents($btn_dir);
		$btn_content = str_replace('{route_btn_link}', $btn["link"], $btn_content);
		$btn_content = str_replace('{route_btn_text}', $btn["text"], $btn_content);
		echo $btn_content;
	}
}

function get_img_jumbotron_content($route) {
	$content_json_dir = 'resource/json/jumbotron/' . $route . '.json';
	$content = file_get_contents($content_json_dir);
	$content_json = json_decode($content, true);
	$title = $content_json["title"];
	$subtitle = $content_json["subtitle"];
	$btn = $content_json["btn"];	// contain btn-link & btn-text if not null
	return array($title, $subtitle, $btn);
}

function include_view_content($route) {
	$content_dir = 'view/content/' . $route . '.html';
	$content = file_get_contents($content_dir);

	if($route === 'contact') {
		$content = replace_company_info($content);
	}
	else if($route === 'soap' || $route === 'soapstring') {
		$content = fetch_products($route, $content);
	}

	echo $content;
}

function fetch_products($route, $page) {
	$products_pages = ['soap', 'soapstring'];
	if(!in_array($route, $products_pages)) return;	// in case this is called by wrong page/route

	$product_template_dir = 'view/component/product.html';
	$product_template = file_get_contents($product_template_dir);

	$products_dir = "resource/json/product/" . $route . "/";
	$products = '';
	foreach (glob($products_dir . "*.json") as $json_dir) {
		$json_str = file_get_contents($json_dir);
		$product_json = json_decode($json_str, true);

		$item_no = $product_json["item_no"];
		$product_name = $product_json["name"];
		$product_intro = $product_json["intro"];
		$product_cover_photo = $product_json["cover_photo"];

		$placeholder = ['{item_no}', '{product_name}', '{product_intro}', '{product_cover_photo}'];
		$product_contents = [$item_no, $product_name, $product_intro, $product_cover_photo];
		$product = $product_template;
		$product = str_replace($placeholder, $product_contents, $product);
		$products .= $product;
	}

	require_once('resource/simple_html_dom.php');
	$page_html = str_get_html($page);
	$container = $page_html -> find('div#products', 0);
	$container -> innertext = $products;
	$page_html = $page_html -> save();	// return string type
	return $page_html;
}

function include_view_footer($route) {
	// Get Footer content, find '{company_}'s and replace with proper company info
	$footer_dir = 'view/footer.html';
	$footer_content = file_get_contents($footer_dir);
	$footer_content = replace_company_info($footer_content);

	echo $footer_content;

	check_dependency_body($route);
	require('view/footer_finish.html');
}
