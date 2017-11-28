<?php
include_once("resource/custom.php");

if (isset($_COOKIE['identity'])) {
	echo callView('shopping_guide', $_COOKIE['identity']);
}
else {
	echo callView('shopping_guide');
}