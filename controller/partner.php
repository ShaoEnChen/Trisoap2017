<?php
include_once("resource/custom.php");

if (isset($_COOKIE['identity'])) {
	callView('partner', $_COOKIE['identity']);
}
else {
	callView('partner');
}