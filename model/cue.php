<?php
include_once("../resource/database.php");
include_once("../resource/custom.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	if ($_GET['module'] == 'cue') {
		if ($_GET['target'] == 'company_phone') {
			$sql = mysql_query("SELECT COMTEL FROM OWNMAS WHERE COMNM='Trisoap'");
			$fetch = mysql_fetch_array($sql);
			echo $fetch['COMTEL'];
			return;
		}
		elseif ($_GET['target'] == 'company_email') {
			$sql = mysql_query("SELECT COMEMAIL FROM OWNMAS WHERE COMNM='Trisoap'");
			$fetch = mysql_fetch_array($sql);
			echo $fetch['COMEMAIL'];
			return;
		}
		elseif ($_GET['target'] == 'company_address') {
			$sql = mysql_query("SELECT COMADD FROM OWNMAS WHERE COMNM='Trisoap'");
			$fetch = mysql_fetch_array($sql);
			echo $fetch['COMADD'];
			return;
		}
		elseif ($_GET['target'] == 'member_name') {
			$account = $_GET['account'];
			$sql = mysql_query("SELECT CUSNM FROM CUSMAS WHERE EMAIL='$account'");
			$fetch = mysql_fetch_array($sql);
			echo $fetch['CUSNM'];
			return;
		}
		elseif ($_GET['target'] == 'member_address') {
			$account = $_GET['account'];
			$sql = mysql_query("SELECT CUSADD FROM CUSMAS WHERE EMAIL='$account'");
			$fetch = mysql_fetch_array($sql);
			echo $fetch['CUSADD'];
			return;
		}
		elseif ($_GET['target'] == 'member_phone') {
			$account = $_GET['account'];
			$sql = mysql_query("SELECT TEL FROM CUSMAS WHERE EMAIL='$account'");
			$fetch = mysql_fetch_array($sql);
			echo $fetch['TEL'];
			return;
		}
		elseif ($_GET['target'] == 'member_taxid') {
			$account = $_GET['account'];
			$sql = mysql_query("SELECT TAXID FROM CUSMAS WHERE EMAIL='$account'");
			$fetch = mysql_fetch_array($sql);
			echo $fetch['TAXID'];
			return;
		}
		elseif ($_GET['target'] == 'member_notice') {
			$account = $_GET['account'];
			$sql = mysql_query("SELECT SPEINS FROM CUSMAS WHERE EMAIL='$account'");
			$fetch = mysql_fetch_array($sql);
			echo $fetch['SPEINS'];
			return;
		}
		elseif ($_GET['target'] == 'member_adddata') {
			$account = $_GET['account'];
			$sql = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$account'");
			$fetch = mysql_fetch_array($sql);
			if (in_array($fetch['CUSTYPE'], array('A', 'B', 'C', 'D')) || in_array($fetch['KNOWTYPE'], array('A', 'B', 'C', 'D', 'E')) || in_array($fetch['CUSSEX'], array('M', 'F'))) {
				echo 'invalid';
			}
			else {
				echo 'valid';
			}
			return;
		}
		elseif ($_GET['target'] == 'order_shipfee') {
			$order = $_GET['order'];
			$account = $_GET['account'];
			$sql = ($order == 'cart') ? mysql_query("SELECT * FROM ORDMAS WHERE ORDNO='0' AND EMAIL='$account' AND ACTCODE='1'") : mysql_query("SELECT * FROM ORDMAS WHERE ORDNO='$order' AND ACTCODE='1'");
			$fetch = mysql_fetch_array($sql);
			echo $fetch['SHIPFEE'];
			return;
		}
		elseif ($_GET['target'] == 'order_message') {
			$account = $_GET['account'];
			$sql = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$account'");
			$fetch = mysql_fetch_array($sql);
			echo $fetch['DISCOUNT'];
			return;
		}
		elseif ($_GET['target'] == 'order_discountPrice') {
			$order = $_GET['order'];
			$account = $_GET['account'];
			$sql = ($order == 'cart') ? mysql_query("SELECT * FROM ORDMAS WHERE ORDNO='0' AND EMAIL='$account' AND ACTCODE='1'") : mysql_query("SELECT * FROM ORDMAS WHERE ORDNO='$order' AND ACTCODE='1'");
			$fetch = mysql_fetch_array($sql);
			if (empty($fetch['DCTID'])) {
				echo '0';
			}
			else {
				echo query_discountPrice($fetch['DCTID']);
				return;
			}
		}
		elseif ($_GET['target'] == 'order_discountName') {
			$order = $_GET['order'];
			$account = $_GET['account'];
			$sql = ($order == 'cart') ? mysql_query("SELECT * FROM ORDMAS WHERE ORDNO='0' AND EMAIL='$account' AND ACTCODE='1'") : mysql_query("SELECT * FROM ORDMAS WHERE ORDNO='$order' AND ACTCODE='1'");
			$fetch = mysql_fetch_array($sql);
			if (empty($fetch['DCTID'])) {
				echo '';
			}
			else {
				echo query_discountName($fetch['DCTID']);
				return;
			}
		}
		elseif ($_GET['target'] == 'order_total') {
			$order = $_GET['order'];
			$account = $_GET['account'];
			$total = 0;
			$sql1 = ($order == 'cart') ? mysql_query("SELECT * FROM ORDMAS WHERE ORDNO='0' AND EMAIL='$account' AND ACTCODE='1'") : mysql_query("SELECT * FROM ORDMAS WHERE ORDNO='$order' AND ACTCODE='1'");
			$fetch1 = mysql_fetch_array($sql1);
			$total += $fetch1['TOTALPRICE'];
			$total -= $fetch1['SHIPFEE'];
			$sql2 = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$account'");
			$fetch2 = mysql_fetch_array($sql2);
			$total -= $fetch2['DISCOUNT'];
			$sql3 = ($order == 'cart') ? mysql_query("SELECT * FROM ORDMAS WHERE ORDNO='0' AND EMAIL='$account' AND ACTCODE='1'") : mysql_query("SELECT * FROM ORDMAS WHERE ORDNO='$order' AND ACTCODE='1'");
			$fetch3 = mysql_fetch_array($sql3);
			$total -= query_discountPrice($fetch3['DCTID']);
			echo $total;
			return;
		}
		elseif ($_GET['target'] == 'order_address') {
			$order = $_GET['order'];
			$account = $_GET['account'];
			if ($order == 'cart') {
				$sql = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$account' AND ACTCODE='1'");
				$fetch = mysql_fetch_array($sql);
				echo $fetch['CUSADD'];
				return;
			}
			else {
				$sql = mysql_query("SELECT * FROM ORDMAS WHERE ORDNO='$order' AND ACTCODE='1'");
				$fetch = mysql_fetch_array($sql);
				echo $fetch['ORDADD'];
				return;
			}
		}
		elseif ($_GET['target'] == 'order_notice') {
			$order = $_GET['order'];
			$account = $_GET['account'];
			$sql = ($order == 'cart') ? mysql_query("SELECT * FROM ORDMAS WHERE ORDNO='0' AND EMAIL='$account' AND ACTCODE='1'") : mysql_query("SELECT * FROM ORDMAS WHERE ORDNO='$order' AND ACTCODE='1'");
			$fetch = mysql_fetch_array($sql);
			echo $fetch['ORDINST'];
			return;
		}
		else {
			echo 'Invalid target called';
			return;
		}
	}
	else {
		echo 'Invalid module called';
		return;
	}
}

elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if ($_POST['module'] == 'cue') {
		if ($_POST['target'] == 'company_phone') {
			$sql = mysql_query("SELECT COMTEL FROM OWNMAS WHERE COMNM='Trisoap'");
			$fetch = mysql_fetch_array($sql);
			echo $fetch['COMTEL'];
			return;
		}
		elseif ($_POST['target'] == 'company_email') {
			$sql = mysql_query("SELECT COMEMAIL FROM OWNMAS WHERE COMNM='Trisoap'");
			$fetch = mysql_fetch_array($sql);
			echo $fetch['COMEMAIL'];
			return;
		}
		elseif ($_POST['target'] == 'company_address') {
			$sql = mysql_query("SELECT COMADD FROM OWNMAS WHERE COMNM='Trisoap'");
			$fetch = mysql_fetch_array($sql);
			echo $fetch['COMADD'];
			return;
		}
		elseif ($_POST['target'] == 'member_name') {
			$account = $_POST['account'];
			$sql = mysql_query("SELECT CUSNM FROM CUSMAS WHERE EMAIL='$account'");
			$fetch = mysql_fetch_array($sql);
			echo $fetch['CUSNM'];
			return;
		}
		elseif ($_POST['target'] == 'member_address') {
			$account = $_POST['account'];
			$sql = mysql_query("SELECT CUSADD FROM CUSMAS WHERE EMAIL='$account'");
			$fetch = mysql_fetch_array($sql);
			echo $fetch['CUSADD'];
			return;
		}
		elseif ($_POST['target'] == 'member_phone') {
			$account = $_POST['account'];
			$sql = mysql_query("SELECT TEL FROM CUSMAS WHERE EMAIL='$account'");
			$fetch = mysql_fetch_array($sql);
			echo $fetch['TEL'];
			return;
		}
		elseif ($_POST['target'] == 'member_taxid') {
			$account = $_POST['account'];
			$sql = mysql_query("SELECT TAXID FROM CUSMAS WHERE EMAIL='$account'");
			$fetch = mysql_fetch_array($sql);
			echo $fetch['TAXID'];
			return;
		}
		elseif ($_POST['target'] == 'member_notice') {
			$account = $_POST['account'];
			$sql = mysql_query("SELECT SPEINS FROM CUSMAS WHERE EMAIL='$account'");
			$fetch = mysql_fetch_array($sql);
			echo $fetch['SPEINS'];
			return;
		}
		elseif ($_POST['target'] == 'member_adddata') {
			$account = $_POST['account'];
			$sql = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$account'");
			$fetch = mysql_fetch_array($sql);
			echo $fetch['CUSTYPE'];
			echo $fetch['KNOWTYPE'];
			echo $fetch['CUSSEX'];
			if (in_array($fetch['CUSTYPE'], array('A', 'B', 'C', 'D')) || in_array($fetch['KNOWTYPE'], array('A', 'B', 'C', 'D', 'E')) || in_array($fetch['CUSSEX'], array('M', 'F'))) {
				echo 'invalid';
			}
			else {
				echo 'valid';
			}
			return;
		}
		elseif ($_POST['target'] == 'order_shipfee') {
			$order = $_POST['order'];
			$account = $_POST['account'];
			$sql = ($order == 'cart') ? mysql_query("SELECT * FROM ORDMAS WHERE ORDNO='0' AND EMAIL='$account' AND ACTCODE='1'") : mysql_query("SELECT * FROM ORDMAS WHERE ORDNO='$order' AND ACTCODE='1'");
			$fetch = mysql_fetch_array($sql);
			echo $fetch['SHIPFEE'];
			return;
		}
		elseif ($_POST['target'] == 'order_message') {
			$account = $_POST['account'];
			$sql = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$account'");
			$fetch = mysql_fetch_array($sql);
			echo $fetch['DISCOUNT'];
			return;
		}
		elseif ($_POST['target'] == 'order_discountPrice') {
			$order = $_POST['order'];
			$account = $_POST['account'];
			$sql = ($order == 'cart') ? mysql_query("SELECT * FROM ORDMAS WHERE ORDNO='0' AND EMAIL='$account' AND ACTCODE='1'") : mysql_query("SELECT * FROM ORDMAS WHERE ORDNO='$order' AND ACTCODE='1'");
			$fetch = mysql_fetch_array($sql);
			if (empty($fetch['DCTID'])) {
				echo '0';
			}
			else {
				echo query_discountPrice($fetch['DCTID']);
				return;
			}
		}
		elseif ($_POST['target'] == 'order_discountName') {
			$order = $_POST['order'];
			$account = $_POST['account'];
			$sql = ($order == 'cart') ? mysql_query("SELECT * FROM ORDMAS WHERE ORDNO='0' AND EMAIL='$account' AND ACTCODE='1'") : mysql_query("SELECT * FROM ORDMAS WHERE ORDNO='$order' AND ACTCODE='1'");
			$fetch = mysql_fetch_array($sql);
			if (empty($fetch['DCTID'])) {
				echo '';
			}
			else {
				echo query_discountName($fetch['DCTID']);
				return;
			}
		}
		elseif ($_POST['target'] == 'order_total') {
			$order = $_POST['order'];
			$account = $_POST['account'];
			$total = 0;
			$sql1 = ($order == 'cart') ? mysql_query("SELECT * FROM ORDMAS WHERE ORDNO='0' AND EMAIL='$account' AND ACTCODE='1'") : mysql_query("SELECT * FROM ORDMAS WHERE ORDNO='$order' AND ACTCODE='1'");
			$fetch1 = mysql_fetch_array($sql1);
			$total += $fetch1['TOTALPRICE'];
			$total += $fetch1['SHIPFEE'];
			$sql2 = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$account'");
			$fetch2 = mysql_fetch_array($sql2);
			$total -= $fetch2['DISCOUNT'];
			$sql3 = ($order == 'cart') ? mysql_query("SELECT * FROM ORDMAS WHERE ORDNO='0' AND EMAIL='$account' AND ACTCODE='1'") : mysql_query("SELECT * FROM ORDMAS WHERE ORDNO='$order' AND ACTCODE='1'");
			$fetch3 = mysql_fetch_array($sql3);
			$total -= query_discountPrice($fetch3['DCTID']);
			echo $total;
			return;
		}
		elseif ($_POST['target'] == 'order_address') {
			$order = $_POST['order'];
			$account = $_POST['account'];
			if ($order == 'cart') {
				$sql = mysql_query("SELECT * FROM CUSMAS WHERE EMAIL='$account' AND ACTCODE='1'");
				$fetch = mysql_fetch_array($sql);
				echo $fetch['CUSADD'];
				return;
			}
			else {
				$sql = mysql_query("SELECT * FROM ORDMAS WHERE ORDNO='$order' AND ACTCODE='1'");
				$fetch = mysql_fetch_array($sql);
				echo $fetch['ORDADD'];
				return;
			}
		}
		elseif ($_POST['target'] == 'order_notice') {
			$order = $_POST['order'];
			$account = $_POST['account'];
			$sql = ($order == 'cart') ? mysql_query("SELECT * FROM ORDMAS WHERE ORDNO='0' AND EMAIL='$account' AND ACTCODE='1'") : mysql_query("SELECT * FROM ORDMAS WHERE ORDNO='$order' AND ACTCODE='1'");
			$fetch = mysql_fetch_array($sql);
			echo $fetch['ORDINST'];
			return;
		}
		else {
			echo 'Invalid target called';
			return;
		}
	}
	else {
		echo 'Invalid module called';
		return;
	}
}

else {
	echo 'Invalid request method';
	return;
}