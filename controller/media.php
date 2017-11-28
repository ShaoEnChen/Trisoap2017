<?php
include_once("resource/custom.php");

if (isset($_COOKIE['identity'])) {
	echo callView('media', $_COOKIE['identity']);
}
else {
	echo callView('media');
}