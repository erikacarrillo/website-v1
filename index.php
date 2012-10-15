<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="google-site-verification" content="69kBc_GXCNa3_Kj8bYPVkFLZErNpjPBquo8BewgNCGo" />
<style>
img.bttn{visibility:visible;}
img.load{position:absolute;z-index:1;width:0px;height:0px;top:0px;left:0px;visibility:hidden;}
</style>
<title>Erika Carrillo Photography</title>
<script type="text/javascript" src="scripts.js"></script>
</head>
<body style="background-color:black;">
<div style="position:relative;width:802px;height:602px;top:-8px;margin-left:auto;margin-right:auto;background-color:black;">
<img src="img/main_bg.jpg" id="main_bg" style="position:absolute;width:800px;height:600px;top:1px;left:1px;z-index:1;" />
<img src="img/title.png" style="position:absolute;width:669px;height:101px;top:1px;left:1px;z-index:2;" />

<?php

$base['vt'] = 240;
$step['vt'] = 44;
$rad = 332;
$base['hz'] = 362;


$url = "http://picasaweb.google.com/data/feed/api/user/erika.carrillo?kind=album&access=all";
require_once("inc/xml2array.inc.php");
require_once("inc/rsaprivkey.inc.php");
$method = "GET"; $time = @mktime(); $rndm = strval(9000000000000000000-$time);
$pkeyid = openssl_get_privatekey($priv_key);
$data = "{$method} {$url} {$time} {$rndm}"; $sig = ""; openssl_sign($data, $sig, $pkeyid); openssl_free_key($pkeyid);
$curl_opt = array( CURLOPT_URL=>$url, CURLOPT_TIMEOUT=>30, CURLOPT_FAILONERROR=>1, CURLOPT_NOPROGRESS=>true, CURLOPT_NOPROGRESS=>true, CURLOPT_RETURNTRANSFER=>true
		, CURLOPT_HTTPHEADER=>array('auth' => "Authorization: AuthSub token=\"{$token}\" data=\"{$data}\" sig=\"".base64_encode($sig)."\" sigalg=\"rsa-sha1\"") );
$curl = curl_init(); curl_setopt_array($curl, $curl_opt);
$out = xml2array(curl_exec($curl), $get_attributes=0);

$cnt = 0;
for ($i = 0; $i < count($out['feed']['entry']); $i++)
{	if (substr($out['feed']['entry'][$i]['title'],0,4) == "Site")
	{
		$alb[$cnt]['ttl'] = strtolower(substr($out['feed']['entry'][$i]['title'],6));
		$alb[$cnt]['ref'] = $out['feed']['entry'][$i]['gphoto:name'];
		$alb[$cnt]['id'] = $out['feed']['entry'][$i]['gphoto:id'];
		$cnt++;
	}
}

sort($alb);

$load_images = "";

for($i = 0; $i < count($alb); $i++)
{
	$img[$i] = "img/txt.php?str=24_160_dddddd_222222_{$alb[$i]['ttl']}";
//	$hov[$i] = "img/txt.php?str=24_160_21b451_222222_{$alb[$i]['ttl']}";	

	echo "\n<img src=\"{$img[$i]}\" id=\"bttn_{$i}\" class=\"bttn\""
			." style=\"position:absolute;z-index:3;cursor:pointer;width:160px;height:56px;"
				."top:".($base['vt']+($i*$step['vt']))."px;"
				."left:".(362-sqrt(($rad*$rad)-($i*$step['vt']+100)*($i*$step['vt']+100)))."px;"
			."\""
			." onMouseOver=\"bulge(0,'{$i}','up');\""
			." onMouseOut=\"bulge(0,'{$i}','dn');\""
			." onClick=\"shrink_bg(1,'{$alb[$i]['ref']}');\""
			." />";
	
} 



$cat = array( 0=>'contact', 1=>'info' );


for($i = 0; $i < count($cat); $i++)
{
	$img[$i] = "img/txt.php?str=24_160_dddddd_222222_{$cat[$i]}";

	echo "\n<img src=\"{$img[$i]}\" id=\"bttn_{$cat[$i]}\" class=\"bttn\""
			." style=\"position:absolute;z-index:3;cursor:pointer;width:160px;height:56px;"
				."top:".($base['vt']+(($i+1)*$step['vt']))."px;"
				."left:".(362+sqrt(($rad*$rad)-(($i+1)*$step['vt']+100)*(($i+1)*$step['vt']+100)))."px;"
			."\""
			." onMouseOver=\"bulge(0,'{$cat[$i]}','up');\""
			." onMouseOut=\"bulge(0,'{$cat[$i]}','dn');\""
			." onClick=\"location='other.php?ref={$cat[$i]}';\""
			." />";
	
} 


?>



</div>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-6075198-1");
pageTracker._trackPageview();
</script>
</body>
</html>