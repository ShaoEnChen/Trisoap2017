<?php
include_once("resource/custom.php");

if (isset($_COOKIE['identity'])) {
	echo callView('contact', $_COOKIE['identity']);
}
else {
	echo callView('contact');
}