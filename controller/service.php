<?php
include_once("resource/custom.php");

if (isset($_COOKIE['identity'])) {
	echo callView('service', $_COOKIE['identity']);
}
else {
	echo callView('service');
}