<?php
include_once("resource/custom.php");

if (isset($_COOKIE['identity'])) {
	callView('index', $_COOKIE['identity']);
}
else {
	callView('index');
}