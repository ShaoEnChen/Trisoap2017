<?php
include_once("resource/custom.php");

if (isset($_COOKIE['identity'])) {
	callView('trial', $_COOKIE['identity']);
}
else {
	callView('trial');
}