<?php
include_once("resource/custom.php");

if (isset($_GET['itemno']) || isset($_POST['itemno'])) {
	$itemno = isset($_GET['itemno']) ? $_GET['itemno'] : $_POST['itemno'];
	if (in_array($itemno, array('1', '2', '3', '4', '5', '6', '7', '8'))) {
		if (isset($_COOKIE['identity'])) {
			echo callView('product'.$itemno, $_COOKIE['identity']);
		}
		else {
			echo callView('product'.$itemno);
		}
	}
	else {
		if (isset($_COOKIE['identity'])) {
			echo callView('product', $_COOKIE['identity']);
		}
		else {
			echo callView('product');
		}
	}
}
else {
	if (isset($_COOKIE['identity'])) {
		echo callView('product', $_COOKIE['identity']);
	}
	else {
		echo callView('product');
	}
}