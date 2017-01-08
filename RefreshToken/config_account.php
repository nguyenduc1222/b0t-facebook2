<?php
	/*
		BotReply in PHP
		Made with love by Huy Nguyen(rknguyen) & Phuong Bach(s2demon)
	*/
	$username = '';
	$password = '';
	$idPage = '';

	$x = cURL('http://'.$_SERVER['SERVER_NAME'].str_replace('config_account.php', '', $_SERVER['PHP_SELF']).'restapi.php?username='.$username.'&password='.$password);

	$y = json_decode(cURL('https://graph.facebook.com/me/accounts?access_token='.$x), true);

	for ($i = 0; $i < count($y['data']); $i++)
	{
		if ($y['data'][$i]['id'] == $idPage)
		{
			$z = $y['data'][$i]['access_token'];
			break;
		}
	}

	$f = fopen('access_token.txt', 'w');
	fwrite($f, $z);
	fclose($f);

	function cURL($url, $postArray = array(), $setopt = array())
	{
		$opts = array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_FOLLOWLOCATION => false,
			CURLOPT_COOKIEFILE => $cookie,
			CURLOPT_COOKIEJAR => $cookie,
			CURLOPT_AUTOREFERER => true,
			CURLOPT_HEADER => false,
			CURLOPT_FRESH_CONNECT => true,
			CURLOPT_USERAGENT => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.52 Safari/537.36',
			CURLOPT_REFERER => $url
		);
		if(count($postArray) > 0 && $postArray != false){
			$postFields = array(
				'POST' => true, 
				'POSTFIELDS' => http_build_query($postArray),
				'REFERER' => $url
			);
			$setopt = array_merge($setopt, $postFields);
		}
		foreach($setopt as $key => $value){
			$opts[constant('CURLOPT_'.strtoupper($key))] = $value;
		}
		
		$s = curl_init();
		curl_setopt_array($s, $opts);
		$data = curl_exec($s);
		curl_close($s);
		@unlink($cookie);
		return $data;
	}
?>
