<?php
include_once("resource/custom.php");

if (isset($_COOKIE['identity'])) {
	callView('brand_intro', $_COOKIE['identity']);
}
else {
	callView('brand_intro');
}