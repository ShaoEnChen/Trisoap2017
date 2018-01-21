<?php

if (isset($_COOKIE['account'])) {
	include_once("view/manage_ui/purchaseFinish.html");
}

else {
	include_once("controller/index.php");
}