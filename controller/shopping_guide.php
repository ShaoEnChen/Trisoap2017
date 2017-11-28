<?php
include_once("resource/custom.php");

if (isset($_COOKIE['identity'])) {
	callView('shopping_guide', $_COOKIE['identity']);
}
else {
	callView('shopping_guide');
}