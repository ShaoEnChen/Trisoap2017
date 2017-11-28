<?php
include_once("resource/custom.php");

if (isset($_COOKIE['identity'])) {
	echo callView('faq', $_COOKIE['identity']);
}
else {
	echo callView('faq');
}