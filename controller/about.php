<?php
include_once("resource/custom.php");

if (isset($_COOKIE['identity'])) {
	callView('about', $_COOKIE['identity']);
}
else {
	callView('about');
}