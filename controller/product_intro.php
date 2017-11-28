<?php
include_once("resource/custom.php");

if (isset($_COOKIE['identity'])) {
	callView('product_intro', $_COOKIE['identity']);
}
else {
	callView('product_intro');
}