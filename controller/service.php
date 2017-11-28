<?php
include_once("resource/custom.php");

if (isset($_COOKIE['identity'])) {
	callView('service', $_COOKIE['identity']);
}
else {
	callView('service');
}