<?php
include_once("resource/custom.php");

$content = (isset($_COOKIE['identity'])) ? callView('heart_message', $_COOKIE['identity']) : callView('heart_message');
$sql1 = mysql_query("SELECT * FROM MSGMAS WHERE MSGSTAT='D' AND MSGPHOTO='0' AND MSGVIDEO='0' ORDER BY RAND()");
$sql2 = mysql_query("SELECT * FROM MSGMAS WHERE MSGSTAT='D' AND MSGPHOTO='1' ORDER BY RAND()");
$sql3 = mysql_query("SELECT * FROM MSGMAS WHERE MSGSTAT='D' AND MSGVIDEO='1' ORDER BY RAND()");
$fetch1 = mysql_fetch_array($sql1);
$fetch2 = mysql_fetch_array($sql2);
$fetch3 = mysql_fetch_array($sql3);
$content = str_replace('[text_1]', $fetch1['MSGTXT'], $content);
$content = str_replace('[text_2]', $fetch2['MSGTXT'], $content);
$content = str_replace('[text_3]', $fetch3['MSGTXT'], $content);
$content = str_replace('[author_1]', query_memberName($fetch1['EMAIL']), $content);
$content = str_replace('[author_2]', query_memberName($fetch2['EMAIL']), $content);
$content = str_replace('[author_3]', query_memberName($fetch3['EMAIL']), $content);
$content = str_replace('[photo]', $fetch2['MSGNO'], $content);
$content = str_replace('[video]', $fetch3['MSGNO'], $content);
echo $content;