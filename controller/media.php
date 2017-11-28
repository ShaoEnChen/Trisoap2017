<?php
include_once("resource/custom.php");

if (isset($_COOKIE['identity'])) {
	callView('media', $_COOKIE['identity']);
}
else {
	callView('media');
}