<?php

if (isset($_COOKIE['account'])) {
	include_once("view/function/purchaseFinish.html");
}

else {
	include_once("controller/index.php");
}