<?php
include_once("resource/custom.php");

if (isset($_COOKIE['identity'])) {
	callView('faq', $_COOKIE['identity']);
}
else {
	callView('faq');
}