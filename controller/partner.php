<?php
include_once("resource/custom.php");

if (isset($_COOKIE['identity'])) {
	echo callView('partner', $_COOKIE['identity']);
}
else {
	echo callView('partner');
}