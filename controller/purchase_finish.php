<?php

if (isset($_COOKIE['account'])) {
	include_once("view/user_function/purchase_finish.html");
}

else {
	include_once("controller/index.php");
}