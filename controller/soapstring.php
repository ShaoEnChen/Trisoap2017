<?php
include_once("resource/custom.php");

if (isset($_COOKIE['identity'])) {
	callView('soapstring', $_COOKIE['identity']);
}
else {
	callView('soapstring');
}