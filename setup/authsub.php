<?php

$token = $_GET['token'];
$url = "https://www.google.com/accounts/AuthSubSessionToken";
require_once("../inc/rsaprivkey.inc.php");
$method = "GET"; $time = @mktime(); $rndm = strval(9000000000000000000-$time);
$pkeyid = openssl_get_privatekey($priv_key);
$data = "{$method} {$url} {$time} {$rndm}"; $sig = ""; openssl_sign($data, $sig, $pkeyid); openssl_free_key($pkeyid);
$curl_opt = array( CURLOPT_URL=>$url, CURLOPT_TIMEOUT=>10, CURLOPT_FAILONERROR=>1, CURLOPT_NOPROGRESS=>true, CURLOPT_NOPROGRESS=>true, CURLOPT_RETURNTRANSFER=>true
		, CURLOPT_HTTPHEADER=>array('auth' => "Authorization: AuthSub token=\"{$token}\" data=\"{$data}\" sig=\"".base64_encode($sig)."\" sigalg=\"rsa-sha1\"") );
$curl = curl_init(); curl_setopt_array($curl, $curl_opt);
echo curl_exec($curl);

?>