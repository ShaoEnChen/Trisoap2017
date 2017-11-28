<?php

if (isset($_GET['in']) || isset($_POST['in'])) {
	$in = isset($_GET['in']) ? $_GET['in'] : $_POST['in'];
	if (in_array($in, array('rabbit', 'balloon', 'box'))) {
		$myfile = fopen("view/moon_".$in.".html", "r");
		$content = fread($myfile, filesize("view/moon_".$in.".html"));
		fclose($myfile);
		$myfile = fopen("view/nav_Homepage.html", "r");
		$nav_Homepage = fread($myfile, filesize("view/nav_Homepage.html"));
		$content = str_replace('[nav_Homepage]', $nav_Homepage, $content);
		fclose($myfile);
		$myfile = fopen("view/footer_Homepage.html", "r");
		$footer_Homepage = fread($myfile, filesize("view/footer_Homepage.html"));
		$content = str_replace('[footer_Homepage]', $footer_Homepage, $content);
		fclose($myfile);

		if (isset($_COOKIE['identity']) && $_COOKIE['identity'] == 'A') {
			$myfile = fopen("view/bar_buttons_A.html", "r");
			$buttons = fread($myfile, filesize("view/bar_buttons_A.html"));
			fclose($myfile);
			$content = str_replace('[bar_buttons]', $buttons, $content);
		}
		elseif (isset($_COOKIE['identity']) && $_COOKIE['identity'] == 'B') {
			$myfile = fopen("view/bar_buttons_B.html", "r");
			$buttons = fread($myfile, filesize("view/bar_buttons_B.html"));
			fclose($myfile);
			$content = str_replace('[bar_buttons]', $buttons, $content);
		}
		else {
			$myfile = fopen("view/bar_buttons.html", "r");
			$buttons = fread($myfile, filesize("view/bar_buttons.html"));
			fclose($myfile);
			$content = str_replace('[bar_buttons]', $buttons, $content);
		}

		$phone = curl_post(array('module' => 'cue', 'target' => 'company_phone'), 'cue');
		$email = curl_post(array('module' => 'cue', 'target' => 'company_email'), 'cue');
		$address = curl_post(array('module' => 'cue', 'target' => 'company_address'), 'cue');
		$content = str_replace('[company_phone]', $phone, $content);
		$content = str_replace('[company_email]', $email, $content);
		$content = str_replace('[company_address]', $address, $content);
		echo $content;
	}
	else {
		$myfile = fopen("view/moon.html", "r");
		$content = fread($myfile, filesize("view/moon.html"));
		fclose($myfile);
		$myfile = fopen("view/nav_Homepage.html", "r");
		$nav_Homepage = fread($myfile, filesize("view/nav_Homepage.html"));
		$content = str_replace('[nav_Homepage]', $nav_Homepage, $content);
		fclose($myfile);
		$myfile = fopen("view/footer_Homepage.html", "r");
		$footer_Homepage = fread($myfile, filesize("view/footer_Homepage.html"));
		$content = str_replace('[footer_Homepage]', $footer_Homepage, $content);
		fclose($myfile);

		if (isset($_COOKIE['identity']) && $_COOKIE['identity'] == 'A') {
			$myfile = fopen("view/bar_buttons_A.html", "r");
			$buttons = fread($myfile, filesize("view/bar_buttons_A.html"));
			fclose($myfile);
			$content = str_replace('[bar_buttons]', $buttons, $content);
		}
		elseif (isset($_COOKIE['identity']) && $_COOKIE['identity'] == 'B') {
			$myfile = fopen("view/bar_buttons_B.html", "r");
			$buttons = fread($myfile, filesize("view/bar_buttons_B.html"));
			fclose($myfile);
			$content = str_replace('[bar_buttons]', $buttons, $content);
		}
		else {
			$myfile = fopen("view/bar_buttons.html", "r");
			$buttons = fread($myfile, filesize("view/bar_buttons.html"));
			fclose($myfile);
			$content = str_replace('[bar_buttons]', $buttons, $content);
		}

		$phone = curl_post(array('module' => 'cue', 'target' => 'company_phone'), 'cue');
		$email = curl_post(array('module' => 'cue', 'target' => 'company_email'), 'cue');
		$address = curl_post(array('module' => 'cue', 'target' => 'company_address'), 'cue');
		$content = str_replace('[company_phone]', $phone, $content);
		$content = str_replace('[company_email]', $email, $content);
		$content = str_replace('[company_address]', $address, $content);
		echo $content;
	}
}
else {
	$myfile = fopen("view/moon.html", "r");
	$content = fread($myfile, filesize("view/moon.html"));
	fclose($myfile);
	$myfile = fopen("view/nav_Homepage.html", "r");
	$nav_Homepage = fread($myfile, filesize("view/nav_Homepage.html"));
	$content = str_replace('[nav_Homepage]', $nav_Homepage, $content);
	fclose($myfile);
	$myfile = fopen("view/footer_Homepage.html", "r");
	$footer_Homepage = fread($myfile, filesize("view/footer_Homepage.html"));
	$content = str_replace('[footer_Homepage]', $footer_Homepage, $content);
	fclose($myfile);

	if (isset($_COOKIE['identity']) && $_COOKIE['identity'] == 'A') {
		$myfile = fopen("view/bar_buttons_A.html", "r");
		$buttons = fread($myfile, filesize("view/bar_buttons_A.html"));
		fclose($myfile);
		$content = str_replace('[bar_buttons]', $buttons, $content);
	}
	elseif (isset($_COOKIE['identity']) && $_COOKIE['identity'] == 'B') {
		$myfile = fopen("view/bar_buttons_B.html", "r");
		$buttons = fread($myfile, filesize("view/bar_buttons_B.html"));
		fclose($myfile);
		$content = str_replace('[bar_buttons]', $buttons, $content);
	}
	else {
		$myfile = fopen("view/bar_buttons.html", "r");
		$buttons = fread($myfile, filesize("view/bar_buttons.html"));
		fclose($myfile);
		$content = str_replace('[bar_buttons]', $buttons, $content);
	}

	$phone = curl_post(array('module' => 'cue', 'target' => 'company_phone'), 'cue');
	$email = curl_post(array('module' => 'cue', 'target' => 'company_email'), 'cue');
	$address = curl_post(array('module' => 'cue', 'target' => 'company_address'), 'cue');
	$content = str_replace('[company_phone]', $phone, $content);
	$content = str_replace('[company_email]', $email, $content);
	$content = str_replace('[company_address]', $address, $content);
	echo $content;
}