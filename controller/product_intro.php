<?php
include_once("resource/custom.php");

if (isset($_COOKIE['identity'])) {
	echo callView('product_intro', $_COOKIE['identity']);
}
else {
	echo callView('product_intro');
}