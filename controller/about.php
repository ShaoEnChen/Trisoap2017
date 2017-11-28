<?php
include_once("resource/custom.php");

if (isset($_COOKIE['identity'])) {
	echo callView('about', $_COOKIE['identity']);
}
else {
	echo callView('about');
}