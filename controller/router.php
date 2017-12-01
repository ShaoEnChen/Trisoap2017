<?php
include_once("resource/custom.php");

function router($route) {
	if (isset($_COOKIE['identity'])) {
		callView($route, $_COOKIE['identity']);
	}
	else {
		callView($route);
	}
}
