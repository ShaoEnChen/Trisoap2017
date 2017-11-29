<?php
include_once("resource/custom.php");

if (isset($_COOKIE['identity'])) {
		callView('soap', $_COOKIE['identity']);
}
else {
	callView('soap');
}