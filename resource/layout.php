<?php

$GLOBALS['view_dir'] = "resource/dist/js/view/";

function get_view_js_path($api, $route) {
	global $view_dir;
	return $view_dir . $api . '/' . $route . '.js';
}

function check_dependency_head($route) {
	check_dependency_css_flexslider($route);
	check_dependency_css_jquery_ui($route);
}

function check_dependency_css_flexslider($route) {
	$flexslider_css_dir = "resource/flexslider/flexslider.min.css";

	if(file_exists(get_view_js_path('flexslider', $route))){
		echo '		<link rel="stylesheet" href="' . $flexslider_css_dir . '">';
	}
}

function check_dependency_css_jquery_ui($route) {
	$jquery_ui_css_dir = "resource/dist/js/jquery-ui-accordion/jquery-ui.min.css";

	if(file_exists(get_view_js_path('jquery_ui', $route))){
		echo '		<link rel="stylesheet" href="' . $jquery_ui_css_dir . '">';
	}
}

function check_dependency_body($route) {
	check_dependency_script_flexslider($route);
	check_dependency_script_jquery_ui($route);
	check_dependency_script_map_api($route);
	check_dependency_script_user_function($route);
}

function check_dependency_script_flexslider($route) {
	$flexslider_js_dir = "resource/flexslider/jquery.flexslider-min.js";

	if(file_exists(get_view_js_path('flexslider', $route))){
		echo '		<script src="' . $flexslider_js_dir . '" defer></script>';
		echo '		<script src="' . get_view_js_path('flexslider', $route) . '" defer></script>';
	}
}

function check_dependency_script_jquery_ui($route) {
	$jquery_ui_js_dir = "resource/dist/js/jquery-ui-accordion/jquery-ui.min.js";

	if(file_exists(get_view_js_path('jquery_ui', $route))){
		echo '		<script src="' . $jquery_ui_js_dir . '" defer></script>';
		echo '		<script src="' . get_view_js_path('jquery_ui', $route) . '" defer></script>';
	}
}

function check_dependency_script_map_api($route) {
	$google_map_api_key = "AIzaSyBqLzZouUqN1dWEVR9_75YO6bXL5OuhcRs";
	$google_map_src = "https://maps.googleapis.com/maps/api/js?key=" . $google_map_api_key;

	if(file_exists(get_view_js_path('google_map', $route))){
		echo '		<script src="' . $google_map_src . '"></script>';
		echo '		<script src="' . get_view_js_path('google_map', $route) . '" defer></script>';
	}
}

function check_dependency_script_user_function($route) {
	$user_function_js_dir = "resource/dist/js/view/user_function.js";
	$need_user_function = ['single_product'];

	if(in_array($route, $need_user_function)) {
		echo '		<script src="' . $user_function_js_dir . '" defer></script>';
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

function fetch_json($criteria, $json_dir) {
	$json_str = file_get_contents($json_dir);
	$json = json_decode($json_str, true);
	$info = [];
	foreach ($criteria as $key) {
		$key = str_replace(['{', '}'], '', $key);
		$value = $json[$key];
		array_push($info, $value);
	}
	return $info;
}

function include_view_head($route) {
	$head_dir = 'view/head.html';
	$head_content = file_get_contents($head_dir);
	$placeholder = ['{title}', '{description}'];

	if($route === 'single_product' && isset($_GET['itemno'])) {
		$json_dir = 'resource/json/product/' . $_GET['itemno'] . '.json';
		$product_attr = ['name', 'intro'];
		$page_info = fetch_json($product_attr, $json_dir);
	}
	else {
		$json_dir = 'resource/json/page_info/' . $route . '.json';
		$page_info = fetch_json($placeholder, $json_dir);
	}
	$head_content = str_replace($placeholder, $page_info, $head_content);
	echo $head_content;

	check_dependency_head($route);
	require('view/head_finish.html');
}

function include_view_nav($authority) {
	$nav_dir = 'view/nav.html';
	$nav_content = file_get_contents($nav_dir);

	// Get admin dropdown
	if($authority === 'A') {
		$nav_auth_dir = 'view/component/nav/login_admin.html';
		$nav_admin_content = file_get_contents($nav_auth_dir);
	}

	// Get member dropdown
	if($authority === 'A' || $authority === 'B') {
		$nav_auth_dir = 'view/component/nav/login_member.html';
	}
	else {
		$nav_auth_dir = 'view/component/nav/login_signup.html';
	}

	$nav_status_content = file_get_contents($nav_auth_dir);
	if(!empty($nav_admin_content)) {
		$nav_status_content = $nav_admin_content . $nav_status_content;
	}
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
	$has_jumbotron = ['about', 'brand_intro', 'contact', 'faq', 'index', 'media', 'moonfest', 'newyear', 'partner', 'shopping_guide', 'single_product', 'soap', 'soapstring', 'trial'];
	if(!in_array($route, $has_jumbotron)) {
		return;
	}

	// Get img jumbotron with background image
	$header_start_dir = 'view/component/jumbotron/img_jumbotron.html';
	$header_start_content = file_get_contents($header_start_dir);
	$header_start_content = str_replace('{route}', $route, $header_start_content);
	echo $header_start_content;

	$json_dir = 'resource/json/page_info/' . $route . '.json';
	$criteria = ['title', 'subtitle', 'btn'];
	list($title, $subtitle, $btn) = fetch_json($criteria, $json_dir);

	if(!is_null($title)) {
		// Get jumbotron title
		$title_dir = 'view/component/jumbotron/title.html';
		$title_content = file_get_contents($title_dir);
		$title_content = str_replace('{route_title}', $title, $title_content);
	}
	if(is_null($subtitle) && is_null($btn)) {
		// change class name
		$title_content = str_replace('jumbotron-title', 'jumbotron-only-title', $title_content);
	}
	echo $title_content;

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

function include_view_content($route) {
	$content_dir = 'view/content/' . $route . '.html';
	$content = file_get_contents($content_dir);

	switch ($route) {
		case 'contact':
			$content = replace_company_info($content);
			break;
		case 'soap':
		case 'soapstring':
		case 'moonfest':
		case 'newyear':
			$content = fetch_products($route, $content);
			break;
		case 'single_product':
			$content = fetch_single_product($route, $content);
			break;
		default:
			break;
	}

	echo $content;
}

function fetch_products($route, $page) {
	// Check route & set json prefix in resource/json/product/
	switch ($route) {
		case 'soap':
			$item_type_prefix = 'product_sp_';
			if(isset($_GET['cat'])) {
				$item_type_prefix .= $_GET['cat'];
			}
			break;
		case 'soapstring':
			$item_type_prefix = 'product_ss_';
			if(isset($_GET['cat'])) {
				$item_type_prefix .= $_GET['cat'];
			}
			break;
		case 'moonfest':
			$item_type_prefix = 'moon_';
			break;
		case 'newyear':
			$item_type_prefix = 'newyear_';
			break;
		default:
			return;
	}
	$product_template_dir = 'view/component/product.html';
	$product_template = file_get_contents($product_template_dir);
	$products = '';
	$products_dir = 'resource/json/product/';
	foreach (glob($products_dir . $item_type_prefix . '*.json') as $json_dir) {
		$placeholder = ['{item_no}', '{name}', '{intro}', '{cover_photo}'];
		$product_info = fetch_json($placeholder, $json_dir);
		$product = $product_template;
		$product = str_replace($placeholder, $product_info, $product);
		$products .= $product;
	}

	require_once('resource/simple_html_dom.php');
	$page_html = str_get_html($page);
	$container = $page_html -> find('#products', 0);
	$container -> innertext = $products;
	$page = $page_html -> save();	// return string type
	return $page;
}

function fetch_single_product($route, $page) {
	if($route !== 'single_product')	return;
	if(!isset($_GET['itemno']))	return;
	$itemno = $_GET['itemno'];
	$json_dir = 'resource/json/product/' . $itemno . '.json';

	// Set info directly
	$placeholder = ['{item_no}', '{name}', '{intro}', '{ingredients}', '{skin_type}', '{feature}', '{price}'];
	$product_info = fetch_json($placeholder, $json_dir);
	$page = str_replace($placeholder, $product_info, $page);

	// Set #single-product-carousel
	$placeholder = ['{gallery}'];
	$gallery_dirs = fetch_json($placeholder, $json_dir)[0];
	$image_template_dir = 'view/component/single_product/gallery_image.html';
	$images = '';
	foreach ($gallery_dirs as $value) {
		$image_template = file_get_contents($image_template_dir);
		$image_template = str_replace('{src}', $value, $image_template);
		$images .= $image_template;
	}
	$page = str_replace($placeholder, $images, $page);

	// Set #single-product-desc accordion
	$placeholder = ['{feature}', '{peasant_farmer}', '{supporting_organization}'];
	$templates_dir = ['view/component/single_product/feature.html', 'view/component/single_product/peasant_farmer.html', 'view/component/single_product/supporting_organization.html'];
	$product_info = fetch_json($placeholder, $json_dir);
	$accordion = '';
	foreach ($product_info as $key => $value) {
		if(!empty($value)) {
			$template = file_get_contents($templates_dir[$key]);

			// Handle different type of $value
			if(is_array($value)) {	// has organization properties
				$org_template_dir = 'view/component/single_product/each_org.html';
				$orgs = '';
				foreach ($value as $org) {
					$org_template = file_get_contents($org_template_dir);
					$org_placeholder = ['{name}', '{intro}', '{link_href}', '{link_text}'];
					$org_info = [$org['name'], $org['intro'], $org['link']['link_href'], $org['link']['link_text']];
					$org_template = str_replace($org_placeholder, $org_info, $org_template);
					$orgs .= $org_template;
				}
				$template = str_replace($placeholder[$key], $orgs, $template);
			}
			else {
				$template = str_replace($placeholder[$key], $value, $template);
			}

			$accordion .= $template;
		}
	}

	require_once('resource/simple_html_dom.php');
	$page_html = str_get_html($page);
	$container = $page_html -> find('#single-product-accordion', 0);
	$container -> innertext = $accordion;
	$page = $page_html -> save();	// return string type
	return $page;
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

/*
 * user_function/ pages view functions
 */

function check_dependency_u_head($page) {
	// currently there's no link needed in head in user_funtion/ pages
	return;
}

function check_dependency_u_footer($page) {
	// currently there's no script needed in footer in user_funtion/ pages
	return;
}

function include_u_view_head($page) {
	$u_head_dir = 'view/user_function/u_header.html';
	$u_head_content = file_get_contents($u_head_dir);

	$placeholder = ['{title}'];
	$json_dir = 'resource/json/page_info/user_function/' . $page . '.json';
	$page_info = fetch_json($placeholder, $json_dir);

	$u_head_content = str_replace($placeholder, $page_info, $u_head_content);
	echo $u_head_content;

	check_dependency_u_head($page);
	require('view/user_function/u_header_finish.html');
}

function include_u_view_footer() {
	// currently there's no footer needed in user_funtion/ pages
	// ... require('footer_dir');

	// also there's no dependency needed
	// hence no parameter ($page)
	// check_dependency_u_footer($page);

	require('view/user_function/u_footer_finish.html');
}

/*
 * manage_ui/ pages view functions
 */

function check_dependency_m_head($page) {
	// currently there's no link needed in head in manage_ui/ pages
	return;
}

function check_dependency_m_footer($page) {
	// currently there's no script needed in footer in manage_ui/ pages
	return;
}

function include_m_view_head($page) {
	$m_head_dir = 'view/manage_ui/m_header.html';
	$m_head_content = file_get_contents($m_head_dir);

	$placeholder = ['{title}'];
	$json_dir = 'resource/json/page_info/manage_ui/' . $page . '.json';
	$page_info = fetch_json($placeholder, $json_dir);

	$m_head_content = str_replace($placeholder, $page_info, $m_head_content);
	echo $m_head_content;

	check_dependency_m_head($page);
	require('view/manage_ui/m_header_finish.html');
}

function include_m_view_footer() {
	// currently there's no footer needed in manage_ui/ pages
	// ... require('footer_dir');

	// also there's no dependency needed
	// hence no parameter ($page)
	// check_dependency_m_footer($page);
	require('view/manage_ui/m_footer_finish.html');
}
