<?php
include_once("resource/custom.php");

if (isset($_COOKIE['identity'])) {
	echo callView('trial', $_COOKIE['identity']);
}
else {
	echo callView('trial');
}