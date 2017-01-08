<?php
	/*
		BotReply in PHP
		Made with love by Huy Nguyen(rknguyen) & Phuong Bach(s2demon)
	*/

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

	function MessageReply($text)
	{
		$callback = json_decode(cURL('http://simsimi.com/getRealtimeReq?uuid=8ACtyn1WIRLFvpzhNC6P00QS4sfiqXRa4fz7pbacy23&lc=vn&ft=0&reqText='.urlencode($text)), true);
		if (isset($callback['respSentence'])) return $callback['respSentence']; else return "IDK :v";
	}

	function Reply($uid, $text, $access_token)
	{
		$Mess = MessageReply($text);
		$Rep = array(
			'subject' => 'huynguyen',
			'message' => $Mess
		);
		cURL('https://graph.facebook.com/'.$uid.'/inbox?access_token='.$access_token, $Rep);
		return $Mess;
	}
?>
