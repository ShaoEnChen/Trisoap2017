<?php
include_once("resource/custom.php");

if (isset($_COOKIE['identity'])) {
	callView('contact', $_COOKIE['identity']);
}
else {
	callView('contact');
}