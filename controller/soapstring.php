<?php
include_once("resource/custom.php");

if (isset($_COOKIE['identity'])) {
	echo callView('soapstring', $_COOKIE['identity']);
}
else {
	echo callView('soapstring');
}