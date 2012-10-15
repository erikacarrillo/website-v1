<?php

$token = $_GET['token'];

	$url = "https://www.google.com/accounts/AuthSubSessionToken";

	require_once("../inc/rsaprivkey.inc.php");
	$method = "GET"; $time = @mktime(); $rndm = strval(9000000000000000000-$time);
	$pkeyid = openssl_get_privatekey($priv_key);

	$data = "{$method} {$url} {$time} {$rndm}"; $sig = ""; openssl_sign($data, $sig, $pkeyid); openssl_free_key($pkeyid);  
	$header = array('auth' => "Authorization: AuthSub token=\"{$token}\" data=\"{$data}\" sig=\"".base64_encode($sig)."\" sigalg=\"rsa-sha1\"");
	
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_PORT, 443);
	curl_setopt($curl, CURLOPT_TIMEOUT, 10);
	curl_setopt($curl, CURLOPT_FAILONERROR, 1);
	curl_setopt($curl, CURLOPT_NOPROGRESS, true);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
	// curl_setopt($curl, CURLOPT_PROXY,"http://proxy.shr.secureserver.net:3128");	
	curl_setopt($curl, CURLOPT_HTTPHEADER, $header );
	$response = curl_exec($curl);
	
	die($response);
	
?>