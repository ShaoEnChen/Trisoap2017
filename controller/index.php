<?php
include_once("resource/custom.php");

if (isset($_COOKIE['identity'])) {
	echo callView('index', $_COOKIE['identity']);
}
else {
	echo callView('index');
}