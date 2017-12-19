<?
/*
================================================================================
discount.php

function create($account, $token, $name, $price, $mode)

	param (string)$account -- User's email
	param (string)$token -- User's token
	param (string)$name -- Discount's name
	param (string)$price -- Discount's price
	param (string)$mode -- Discount's mode

	return
		1. Success -> (array)('message' => (string)'Success', 'code' => (string))
		2. Fail -> (string)

--------------------------------------------------------------------------------

function delete($account, $token, $index)

	param (string)$account -- User's email
	param (string)$token -- User's token
	param (string)$index -- Discount's index

	return
		1. Success -> (string)'Success'
		2. Fail -> (string)

--------------------------------------------------------------------------------

function apply($account, $token, $index)

	param (string)$account -- User's email
	param (string)$token -- User's token
	param (string)$index -- Discount's index

	return
		1. Success -> (string)'Success'
		2. Fail -> (string)

--------------------------------------------------------------------------------

function search($account, $token, $key, $value)

	param (string)$account -- User's email
	param (string)$token -- User's token
	param (string)$key -- Search key
	param (string)$value -- Key value

	return
		1. Success -> (array('message' => (string)'Success', 'DCTID' => (array(string)), 'DCTPRICE' => (array(string)), 'DCTSTAT' => (array(string)), 'DCTNM' => (array(string)), 'CREATEPERSON' => (array(string)), 'CREATEDATE' => (array(datetime)), 'USEDATE' => (array(datetime)), 'ACTCODE' => (array(string))))
		2. Fail -> (string)

--------------------------------------------------------------------------------

function view($account, $token)

	param (string)$account -- User's email
	param (string)$token -- User's token

	return
		1. Success -> (array('message' => (string)'Success', 'DCTID' => (array(string)), 'DCTPRICE' => (array(string)), 'DCTSTAT' => (array(string)), 'DCTNM' => (array(string)), 'CREATEPERSON' => (array(string)), 'CREATEDATE' => (array(datetime)), 'USEDATE' => (array(datetime)), 'ACTCODE' => (array(string))))
		2. Fail -> (string)

================================================================================

================================================================================
item.php

function create($account, $token, $index, $name, $amount=0, $price, $description=null)

	param (string)$account -- User's email
	param (string)$token -- User's token
	param (string)$index -- Item's index
	param (string)$name -- Item's name
	param (string)$amount -- Item's inventory
	param (string)$price -- Item's price
	param (string)$description -- Item's description

	return
		1. Success -> (string)'Success'
		2. Fail -> (string)

--------------------------------------------------------------------------------

function edit($account, $token, $index, $name, $price, $description=null)

	param (string)$account -- User's email
	param (string)$token -- User's token
	param (string)$index -- Item's index
	param (string)$name -- Item's name
	param (string)$price -- Item's price
	param (string)$description -- Item's description

	return
		1. Success -> (string)'Success'
		2. Fail -> (string)

--------------------------------------------------------------------------------

function onshelf($account, $token, $index)

	param (string)$account -- User's email
	param (string)$token -- User's token
	param (string)$index -- Item's index

	return
		1. Success -> (string)'Success'
		2. Fail -> (string)

--------------------------------------------------------------------------------

function offshelf($account, $token, $index)

	param (string)$account -- User's email
	param (string)$token -- User's token
	param (string)$index -- Item's index

	return
		1. Success -> (string)'Success'
		2. Fail -> (string)

--------------------------------------------------------------------------------

function replenish($account, $token, $index, $amount=0)

	param (string)$account -- User's email
	param (string)$token -- User's token
	param (string)$index -- Item's index
	param (string)$index -- Item's amount

	return
		1. Success -> (string)'Success'
		2. Fail -> (string)

--------------------------------------------------------------------------------

function sell($account, $token, $index, $amount=0)

	param (string)$account -- User's email
	param (string)$token -- User's token
	param (string)$index -- Item's index
	param (string)$index -- Item's amount

	return
		1. Success -> (string)'Success'
		2. Fail -> (string)

--------------------------------------------------------------------------------

function view($account, $token)

	param (string)$account -- User's email
	param (string)$token -- User's token

	return
		1. Success -> (array('message' => (string)'Success', 'ITEMNO' => (array(string)), 'ITEMNM' => (array(string)), 'ITEMAMT' => (array(string)), 'PRICE' => (array(string)), 'UPDATEDATE' => (array(datetime))))
		2. Fail -> (string)

================================================================================

================================================================================
manager.php

function create($account, $token, $target)

	param (string)$account -- User's email
	param (string)$token -- User's token
	param (string)$target -- Target's email

	return
		1. Success -> (string)'Success'
		2. Fail -> (string)

--------------------------------------------------------------------------------

function delete($account, $token, $target)

	param (string)$account -- User's email
	param (string)$token -- User's token
	param (string)$target -- Target's email

	return
		1. Success -> (string)'Success'
		2. Fail -> (string)

--------------------------------------------------------------------------------

function view($account, $token)

	param (string)$account -- User's email
	param (string)$token -- User's token

	return
		1. Success -> (array('message' => (string)'Success', 'EMAIL' => (array(string)), 'CUSNM' => (array(string)), 'TEL' => (array(string)), 'UPDATEDATE' => (array(datetime))))
		2. Fail -> (string)

================================================================================

================================================================================
member.php

function signin($account, $password)

	param (string)$account -- User's email
	param (string)$password -- User's password

	return
		1. Success -> (array('message' => (string)'Success', 'token' => (string), 'identity' => (string)))
		2. Fail -> (string)

--------------------------------------------------------------------------------

function logout($account)

	param (string)$account -- User's email

	return
		1. Success -> (string)'Success'
		2. Fail -> (string)

--------------------------------------------------------------------------------

function register($account, $name, $password1, $password2, $address, $skintype, $birth, $phone, $taxid=null, $knowtype, $notice=null, $privacy)

	param (string)$account -- User's email
	param (string)$name -- User's name
	param (string)$password1 -- User's password
	param (string)$password2 -- User's checking password
	param (string)$address -- User's address
	param (string)$skintype -- User's skintype
	param (string)$birth -- User's birth
	param (string)$phone -- User's phone
	param (string)$taxid -- User's taxid
	param (string)$knowtype -- User's knowtype
	param (string)$notice -- User's notice
	param (bool)$privacy -- Whether user checked the privacy policy

	return
		1. Success -> (string)'Success'
		2. Fail -> (string)

--------------------------------------------------------------------------------

function verify($account, $verify)

	param (string)$account -- User's email
	param (string)$verify -- User's verification code

	return
		1. Success -> (string)'Success'
		2. Fail -> (string)

--------------------------------------------------------------------------------

function edit($account, $token, $name, $address, $skintype, $phone, $taxid=null, $notice=null)

	param (string)$account -- User's email
	param (string)$token -- User's token
	param (string)$name -- User's name
	param (string)$address -- User's address
	param (string)$skintype -- User's skintype
	param (string)$phone -- User's phone
	param (string)$taxid -- User's taxid
	param (string)$notice -- User's notice

	return
		1. Success -> (string)'Success'
		2. Fail -> (string)

--------------------------------------------------------------------------------

function change_password($account, $token, $ori_password, $new_password1, $new_password2)

	param (string)$account -- User's email
	param (string)$token -- User's token
	param (string)$ori_password -- User's original password
	param (string)$new_password1 -- User's new password
	param (string)$new_password2 -- User's checking new password

	return
		1. Success -> (string)'Success'
		2. Fail -> (string)

--------------------------------------------------------------------------------

function reset_password($account)

	param (string)$account -- User's email

	return
		1. Success -> (string)'Success'
		2. Fail -> (string)

--------------------------------------------------------------------------------

function search($account, $token, $key, $value)

	param (string)$account -- User's email
	param (string)$token -- User's token
	param (string)$key -- Search key
	param (string)$value -- Key value

	return
		1. Success -> (array('message' => (string)'Success', 'EMAIL' => (array(string)), 'CUSNM' => (array(string)), 'CUSADD' => (array(string)), 'CUSBIRTH' => (array(string)), 'COUNTRY' => (array(string)), 'ZCODE' => (array(string)), 'TEL' => (array(string)), 'CUSTYPE' => (array(string)), 'KNOWTYPE' => (array(string)), 'TAXID' => (array(string)), 'DISCOUNT' => (array(string)), 'SALEAMTMTD' => (array(string)), 'SALEAMTSTD' => (array(string)), 'SALEAMTYTD' => (array(string)), 'SALEAMT' => (array(string)), 'SPEINS' => (array(string)), 'CREATEDATE' => (array(datetime)), 'UPDATEDATE' => (array(datetime))))
		2. Fail -> (string)

--------------------------------------------------------------------------------

function view($account, $token)

	param (string)$account -- User's email
	param (string)$token -- User's token

	return
		1. Success -> (array('message' => (string)'Success', 'EMAIL' => (array(string)), 'CUSNM' => (array(string)), 'CUSADD' => (array(string)), 'CUSBIRTH' => (array(string)), 'COUNTRY' => (array(string)), 'ZCODE' => (array(string)), 'TEL' => (array(string)), 'CUSTYPE' => (array(string)), 'KNOWTYPE' => (array(string)), 'TAXID' => (array(string)), 'DISCOUNT' => (array(string)), 'SALEAMTMTD' => (array(string)), 'SALEAMTSTD' => (array(string)), 'SALEAMTYTD' => (array(string)), 'SALEAMT' => (array(string)), 'SPEINS' => (array(string)), 'CREATEDATE' => (array(datetime)), 'UPDATEDATE' => (array(datetime))))
		2. Fail -> (string)

================================================================================

================================================================================
message.php

function create($account, $token, $text, $picture, $video)

	param (string)$account -- User's email
	param (string)$token -- User's token
	param (string)$text -- Message's text
	param (file)$picture -- Message picture
	param (file)$video -- Message's video

	return
		1. Success -> (string)'Success'
		2. Fail -> (string)

--------------------------------------------------------------------------------

function pass($account, $token, $index)

	param (string)$account -- User's email
	param (string)$token -- User's token
	param (string)$index -- Message's index

	return
		1. Success -> (string)'Success'
		2. Fail -> (string)

--------------------------------------------------------------------------------

function reject($account, $token, $index)

	param (string)$account -- User's email
	param (string)$token -- User's token
	param (string)$index -- Message's index

	return
		1. Success -> (string)'Success'
		2. Fail -> (string)

--------------------------------------------------------------------------------

function publish($account, $token, $index)

	param (string)$account -- User's email
	param (string)$token -- User's token
	param (string)$index -- Message's index

	return
		1. Success -> (string)'Success'
		2. Fail -> (string)

--------------------------------------------------------------------------------

function save($account, $token, $index)

	param (string)$account -- User's email
	param (string)$token -- User's token
	param (string)$index -- Message's index

	return
		1. Success -> (string)'Success'
		2. Fail -> (string)

--------------------------------------------------------------------------------

function delete($account, $token, $index)

	param (string)$account -- User's email
	param (string)$token -- User's token
	param (string)$index -- Message's index

	return
		1. Success -> (string)'Success'
		2. Fail -> (string)

--------------------------------------------------------------------------------

function search($account, $token, $index)

	param (string)$account -- User's email
	param (string)$token -- User's token
	param (string)$index -- Message's index

	return
		1. Success -> (array('message' => (string)'Success', 'MSGNO' => (string), 'EMAIL' => (string), 'MSGTXT' => (string), 'MSGPHOTO' => (string), 'MSGVIDEO' => (string), 'MSGSTAT' => (string), 'REWARDSTAT' => (string), 'CREATEDATE' => (datetime), 'PUBLICDATE' => (datetime)))
		2. Fail -> (string)

--------------------------------------------------------------------------------

function view($account, $token, $state='A')

	param (string)$account -- User's email
	param (string)$token -- User's token
	param (string)$state -- Message's state

	return
		1. Success -> (array('message' => (string)'Success', 'MSGNO' => (array(string)), 'EMAIL' => (array(string)), 'MSGTXT' => (array(string)), 'MSGPHOTO' => (array(string)), 'MSGVIDEO' => (array(string)), 'MSGSTAT' => (array(string)), 'REWARDSTAT' => (array(string)), 'CREATEDATE' => (array(datetime)), 'PUBLICDATE' => (array(datetime))))
		2. Fail -> (string)

================================================================================

================================================================================
order.php

function create($account, $token, $address, $discount, $notice, $paytype)

	param (string)$account -- User's email
	param (string)$token -- User's token
	param (string)$address -- User's address
	param (string)$discount -- Using discount
	param (string)$notice -- User's notice
	param (string)$paytype -- User's paytype

	return
		1. Success -> (array('message' => (string)'Success', 'ORDNO' => (string)))
		2. Fail -> (string)

--------------------------------------------------------------------------------

function active($account, $token, $index)

	param (string)$account -- User's email
	param (string)$token -- User's token
	param (string)$index -- Order's index

	return
		1. Success -> (string)'Success'
		2. Fail -> (string)

--------------------------------------------------------------------------------

function complete($account, $token, $index)

	param (string)$account -- User's email
	param (string)$token -- User's token
	param (string)$index -- Order's index

	return
		1. Success -> (string)'Success'
		2. Fail -> (string)

--------------------------------------------------------------------------------

function close($account, $token, $index)

	param (string)$account -- User's email
	param (string)$token -- User's token
	param (string)$index -- Order's index

	return
		1. Success -> (string)'Success'
		2. Fail -> (string)

--------------------------------------------------------------------------------

function search($account, $token, $index)

	param (string)$account -- User's email
	param (string)$token -- User's token
	param (string)$index -- Order's index

	return
		1. Success -> (array('message' => (string)'Success', 'ORDNO' => (string), 'EMAIL' => (string), 'ITEMNO' => (array(string)), 'ITEMNM' => (array(string)), 'ITEMAMT' => (array(string)), 'ITEMPRICE' => (array(string)), 'INVOICENO' => (string), 'BACKSTAT' => (string), 'ORDSTAT' => (string), 'PAYTYPE' => (string), 'ORDINST' => (string), 'TOTALAMT' => (string), 'UPDATEDATE' => (datetime)))
		2. Fail -> (string)

--------------------------------------------------------------------------------

function view($account, $token, $state='E')

	param (string)$account -- User's email
	param (string)$token -- User's token
	param (string)$state -- Order's state

	return
		1. Success -> (array('message' => (string)'Success', 'ORDNO' => (array(string)), 'EMAIL' => (array(string)), 'INVOICENO' => (array(string)), 'BACKSTAT' => (array(string)), 'ORDSTAT' => (array(string)), 'PAYTYPE' => (array(string)), 'ORDINST' => (array(string)), 'TOTALAMT' => (array(string)), 'UPDATEDATE' => (array(datetime))))
		2. Fail -> (string)

================================================================================

================================================================================
orderitem.php

function create($account, $token, $index, $amount)

	param (string)$account -- User's email
	param (string)$token -- User's token
	param (string)$index -- Item's index
	param (string)$amount -- Item's amount

	return
		1. Success -> (string)'Success'
		2. Fail -> (string)

--------------------------------------------------------------------------------

function edit($account, $token, $index, $amount)

	param (string)$account -- User's email
	param (string)$token -- User's token
	param (string)$index -- Item's index
	param (string)$amount -- Item's amount

	return
		1. Success -> (string)'Success'
		2. Fail -> (string)

--------------------------------------------------------------------------------

function delete($account, $token, $index)

	param (string)$account -- User's email
	param (string)$token -- User's token
	param (string)$index -- Item's index

	return
		1. Success -> (string)'Success'
		2. Fail -> (string)

--------------------------------------------------------------------------------

function search($account, $token)

	param (string)$account -- User's email
	param (string)$token -- User's token

	return
		1. Success -> (array('message' => (string)'Success', 'item' => (array(string)), 'amount' => (array(string))))
		2. Fail -> (string)

================================================================================