<?php
	/*
		BotReply in PHP
		Made with love by Huy Nguyen(rknguyen) & Phuong Bach(s2demon)
	*/
	header('Content-Type: text/html; charset=utf-8');
	require_once 'func.php';
	require_once 'sth.php';

	$Message = json_decode(cURL($FacebookAPI->Threads), true);
	$Message = $Message['data'];

	for ($i = 0; $i < count($Message); $i++)
	{
		if ((isset($Message[$i]['unread_count'])) && ($Message[$i]['messages']['data'][0]['from']['id'] == $Message[$i]['participants']['data'][0]['id']))
		{
			$MessReplied = Reply($Message[$i]['participants']['data'][0]['id'], $Message[$i]['snippet'], $PageAcessToken);
			print_r($Message[$i]['participants']['data'][0]['id'].'|Mess: '.$Message[$i]['snippet'].'|Rep: '.$MessReplied);
			print_r('<br>');
		}
		ob_flush();
		flush();
	}
?>
