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
		echo '		<link rel="stylesheet" href="' . $flexslider_css_dir . '" async defer>';
	}
}

function check_dependency_css_jquery_ui($route) {
	$jquery_ui_css_dir = "resource/dist/js/jquery-ui-accordion/jquery-ui.min.css";

	if(file_exists(get_view_js_path('jquery_ui', $route))){
		echo '		<link rel="stylesheet" href="' . $jquery_ui_css_dir . '" async defer>';
	}
}

function check_dependency_footer($route) {
	check_dependency_script_flexslider($route);
	check_dependency_script_jquery_ui($route);
	check_dependency_script_map_api($route);
	check_dependency_script_user_function($route);
}

function check_dependency_script_flexslider($route) {
	$flexslider_js_dir = "resource/flexslider/jquery.flexslider-min.js";
	$js_for_the_route = get_view_js_path('flexslider', $route);

	if(file_exists($js_for_the_route)){
		echo '		<script src="' . $flexslider_js_dir . '" defer></script>';
		echo '		<script src="' . $js_for_the_route . '" defer></script>';
	}
}

function check_dependency_script_jquery_ui($route) {
	$jquery_ui_js_dir = "resource/dist/js/jquery-ui-accordion/jquery-ui.min.js";
	$js_for_the_route = get_view_js_path('jquery_ui', $route);

	if(file_exists($js_for_the_route)){
		echo '		<script src="' . $jquery_ui_js_dir . '" defer></script>';
		echo '		<script src="' . $js_for_the_route . '" defer></script>';
	}
}

function check_dependency_script_map_api($route) {
	$google_map_api_key = "AIzaSyBqLzZouUqN1dWEVR9_75YO6bXL5OuhcRs";
	$google_map_src = "https://maps.googleapis.com/maps/api/js?key=" . $google_map_api_key;
	$js_for_the_route = get_view_js_path('google_map', $route);

	if(file_exists($js_for_the_route)){
		echo '		<script src="' . $google_map_src . '"></script>';
		echo '		<script src="' . $js_for_the_route . '" defer></script>';
	}
}

function check_dependency_script_user_function($route) {
	$user_function_js_dir = "resource/dist/js/view/user_function.js";
	$need_user_function = ['gift_box', 'moonfest', 'newyear', 'products', 'single_product', 'soap', 'soapstring'];

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
	$has_jumbotron = ['about', 'brand_intro', 'contact', 'faq', 'gift_box', 'index', 'media', 'moonfest', 'newyear', 'partner', 'products', 'shopping_guide', 'single_product', 'soap', 'soapstring', 'trial'];
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
		case 'gift_box':
		case 'moonfest':
		case 'newyear':
		case 'products':
		case 'soap':
		case 'soapstring':
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

function get_product_type_keyword($route) {
	// Check route & set json file name keyword in resource/json/product/
	switch ($route) {
		case 'gift_box':
			$product_type_keyword = 'product_.+_box_\d+';
			break;
		case 'moonfest':
			$product_type_keyword = 'moon_box_\d+';
			break;
		case 'newyear':
			$product_type_keyword = 'newyear_box_\d+';
			break;
		case 'soap':
			$product_type_keyword = 'product_sp_';
			if(isset($_GET['cat'])) {
				$product_type_keyword .= ($_GET['cat'] . '_\d+');
			}
			else {
				$product_type_keyword .= '(tt|yl)_\d+';
			}
			break;
		case 'soapstring':
			$product_type_keyword = 'product_ss_';
			if(isset($_GET['cat'])) {
				$product_type_keyword .= ($_GET['cat'] . '_\d+');
			}
			else {
				$product_type_keyword .= '(tt|yl)_\d+';
			}
			break;
		default:
			return;
	}
	return $product_type_keyword;
}

function get_products_content($route) {
	// Check route & set json file name keyword in resource/json/product/
	$product_type_keyword = get_product_type_keyword($route);

	$product_template_dir = 'view/component/products/product.html';
	$product_template = file_get_contents($product_template_dir);

	$products = '';

	// add product category title
	$product_category_title_template_dir = 'view/component/products/product_category_title.html';
	$product_category_title_template = file_get_contents($product_category_title_template_dir);

	$product_category_title_json = 'resource/json/page_info/' . $route . '.json';
	$placeholder = ['{title}'];
	$product_category_title = fetch_json($placeholder, $product_category_title_json);

	$product_category_title_template = str_replace($placeholder, $product_category_title, $product_category_title_template);
	$products .= $product_category_title_template;

	$product_json = 'resource/json/product/*.json';
	$product_regex_pattern = '/^resource\/json\/product\/' . $product_type_keyword . '\.json$/';

	foreach (glob($product_json) as $json_dir) {
		if(preg_match($product_regex_pattern, $json_dir)) {
			$placeholder = ['{item_no}', '{name}', '{price}', '{cover_photo}'];
			$product_info = fetch_json($placeholder, $json_dir);
			$product = $product_template;
			$product = str_replace($placeholder, $product_info, $product);
			$products .= $product;
		}
	}
	return $products;
}

function fetch_products($route, $page) {
	$products = '';
	if($route === 'products') {
		$products .= get_products_content('soap');
		$products .= get_products_content('soapstring');
		$products .= get_products_content('gift_box');
	}
	else {
		$products = get_products_content($route);
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
	check_dependency_footer($route);
	require('view/footer_finish.html');
}

/*
 * user_function/ pages view functions
 */

function check_dependency_u_head($route) {
	// currently there's no link needed in head in user_funtion/ pages
	return;
}

function check_dependency_u_footer($route) {
	$js_for_the_route = get_view_js_path('user_function', $route);

	if(file_exists($js_for_the_route)){
		echo '		<script src="' . $js_for_the_route . '" defer></script>';
	}
}

function include_u_view_head($route) {
	$u_head_dir = 'view/user_function/u_header.html';
	$u_head_content = file_get_contents($u_head_dir);

	$placeholder = ['{title}'];
	$json_dir = 'resource/json/page_info/user_function/' . $route . '.json';
	$route_info = fetch_json($placeholder, $json_dir);

	$u_head_content = str_replace($placeholder, $route_info, $u_head_content);
	echo $u_head_content;

	check_dependency_u_head($route);
	require('view/user_function/u_header_finish.html');
}

function include_u_view_footer($route) {
	require('view/user_function/u_footer.html');
	check_dependency_u_footer($route);
	require('view/user_function/u_footer_finish.html');
}

/*
 * manage_ui/ pages view functions
 */

function check_dependency_m_head($route) {
	// currently there's no link needed in head in manage_ui/ pages
	return;
}

function check_dependency_m_footer($route) {
	// currently there's no script needed in footer in manage_ui/ pages
	return;
}

function include_m_view_head($route) {
	$m_head_dir = 'view/manage_ui/m_header.html';
	$m_head_content = file_get_contents($m_head_dir);

	$placeholder = ['{title}'];
	$json_dir = 'resource/json/page_info/manage_ui/' . $route . '.json';
	$route_info = fetch_json($placeholder, $json_dir);

	$m_head_content = str_replace($placeholder, $route_info, $m_head_content);
	echo $m_head_content;

	check_dependency_m_head($route);
	require('view/manage_ui/m_header_finish.html');
}

function include_m_view_footer() {
	require('view/manage_ui/m_footer.html');

	// there's no dependency needed
	// hence no parameter ($route)
	// check_dependency_m_footer($route);

	require('view/manage_ui/m_footer_finish.html');
}

function controller_get_nav($controller) {
	$nav_content_dir = 'view/manage_ui/nav/nav_' . $controller . '.html';
	$nav_content = file_get_contents($nav_content_dir);

	$name = curl_post(array('module' => 'cue', 'target' => 'member_name', 'account' => $_COOKIE['account']), 'cue');
	$nav_content = str_replace('[member_name]', $name, $nav_content);

	echo $nav_content;
}
