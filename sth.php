<?php
	/*
		BotReply in PHP
		Made with love by Huy Nguyen(rknguyen) & Phuong Bach(s2demon)
	*/
	require_once 'func.php';

	$PageAcessToken = cURL('http://'.$_SERVER['SERVER_NAME'].'/BotReply/RefreshToken/access_token.txt');

	$LimitMessages = 10;

	$FacebookAPI = new ArrayObject();
	$FacebookAPI->setFlags(ArrayObject::STD_PROP_LIST|ArrayObject::ARRAY_AS_PROPS);

	$FacebookAPI->Threads = 'https://graph.facebook.com/me/threads?access_token='.$PageAcessToken.'&limit='.$LimitMessages;
?>
