<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<style>
img.load{position:absolute;z-index:1;width:0px;height:0px;top:0px;left:0px;visibility:hidden;}
img.thmb{cursor:pointer;border:solid 1px #444444;}
div.cptn{position:absolute;left:40px;width:600px;height:40px;border:none;color:white;font-family:arial;text-align:center;}
</style>
<title>Erika Carrillo Photography</title>
<script type="text/javascript" src="scripts.js"></script>
</head>
<?php


$screen = intval($_GET['nm']);

$url = "http://picasaweb.google.com/data/feed/api/user/erika.carrillo/album/{$_GET['ref']}?kind=photo&access=all";
require_once("inc/xml2array.inc.php");
require_once("inc/rsaprivkey.inc.php");
$method = "GET"; $time = @mktime(); $rndm = strval(9000000000000000000-$time);
$pkeyid = openssl_get_privatekey($priv_key);
$data = "{$method} {$url} {$time} {$rndm}"; $sig = ""; openssl_sign($data, $sig, $pkeyid); openssl_free_key($pkeyid);
$curl_opt = array( CURLOPT_URL=>$url, CURLOPT_TIMEOUT=>10, CURLOPT_FAILONERROR=>1, CURLOPT_NOPROGRESS=>true, CURLOPT_NOPROGRESS=>true, CURLOPT_RETURNTRANSFER=>true
		, CURLOPT_HTTPHEADER=>array('auth' => "Authorization: AuthSub token=\"{$token}\" data=\"{$data}\" sig=\"".base64_encode($sig)."\" sigalg=\"rsa-sha1\"") );
$curl = curl_init(); curl_setopt_array($curl, $curl_opt);
$out = xml2array(curl_exec($curl), $get_attributes=1);


for ($i = 0; $i < count($out['feed']['entry']); $i++)
{
	$pho['orig'][$i] = $out['feed']['entry'][$i]['link'][4]['attr']['href'];
	$pho['view'][$i] = $out['feed']['entry'][$i]['media:group']['media:content']['attr']['url'];
	$pho['view_w'][$i] = $out['feed']['entry'][$i]['media:group']['media:content']['attr']['width'];
	$pho['view_h'][$i] = $out['feed']['entry'][$i]['media:group']['media:content']['attr']['height'];
	$pho['thmb'][$i] = $out['feed']['entry'][$i]['media:group']['media:thumbnail'][2]['attr']['url'];
	$pho['cptn'][$i] = $out['feed']['entry'][$i]['summary']['value'];
	$pho['dim_x'][$i] = $out['feed']['entry'][$i]['gphoto:width']['value'];
	$pho['dim_y'][$i] = $out['feed']['entry'][$i]['gphoto:height']['value'];
		
	if ($pho['dim_x'][$i] >= $pho['dim_y'][$i])
	{	$thmb_ht = 390;
		$top[$i] = "-40";
		$pho['thmb_y'][$i] = $thmb_ht;
		$pho['thmb_x'][$i] = round($thmb_ht*($pho['dim_x'][$i]/$pho['dim_y'][$i]));
	}
	else
	{	$thmb_ht = 400;
		$top[$i] = "-50";
		$pho['thmb_y'][$i] = $thmb_ht;
		$pho['thmb_x'][$i] = round($thmb_ht*($pho['dim_x'][$i]/$pho['dim_y'][$i]));
	}	
}

?>

<body style="background-color:black;" onLoad="">

<div style="position:relative;width:669px;height:101px;margin-left:auto;margin-right:auto;border:none;background-image:url('img/title.png');"></div>


<div style="width:660px;height:300px;position:relative;margin-top:45px;margin-left:auto;margin-right:auto;border:none;">
<?php

$group = 3*ceil(intval($_GET['nm'])/3)-2;

echo ""
	."<img id=\"bttn_sctn\" src=\"img/txt.php?str=18_200_ffffff_000000_<*".strtolower(substr(strval($_GET['ref']),5))."*menu\" style=\"position:absolute;top:400px;left:0px;width:200px;height:50px;cursor:pointer;\""
		." onMouseOver=\"bulge(0,'sctn','up');\""
		." onMouseOut=\"bulge(0,'sctn','dn');\""
		." onClick=\"location='alb.php?ref={$_GET['ref']}&nm={$group}';\""
	." />";	



echo "<img id=\"bttn_nxt\" style=\"position:absolute;top:400px;left:520px;width:100px;z-index:1;height:50px;";

if (count($out['feed']['entry']) > intval($_GET['nm']))
{ 	echo "cursor:pointer;\""
		." src=\"img/txt.php?str=18_100_ffffff_000000_next*>\""
		." onMouseOver=\"bulge(0,'nxt','up');\""
		." onMouseOut=\"bulge(0,'nxt','dn');\""
		." onClick=\"location='pic.php?ref={$_GET['ref']}&nm=".(intval($_GET['nm'])+1)."';\"";
}
else
{ 	echo "\" src=\"img/txt.php?str=18_100_333333_000000_next*>\"";
}
echo " />";

echo "<img id=\"bttn_prv\" style=\"position:absolute;top:400px;left:300px;width:100px;z-index:1;height:50px;";

if (intval($_GET['nm']) > 1)
{ 	echo "cursor:pointer;\""
		." src=\"img/txt.php?str=18_100_ffffff_000000_<*prev\""
		." onMouseOver=\"bulge(0,'prv','up');\""
		." onMouseOut=\"bulge(0,'prv','dn');\""
		." onClick=\"location='pic.php?ref={$_GET['ref']}&nm=".(intval($_GET['nm'])-1)."';\"";
}
else
{ 	echo "\" src=\"img/txt.php?str=18_100_333333_000000_<*prev\"";
}
echo " />";


echo 	""
		."<img src=\"img/txt.php?str=16_100_999999_000000_{$_GET['nm']}*of*".count($out['feed']['entry'])."\""
			." style=\"position:absolute;left:410px;top:400px;height:50px;width:100px;\" />"
		."<img class=\"load\" src=\"img/txt.php?str=16_100_999999_000000_".($_GET['nm']+1)."*of*".count($out['feed']['entry'])."\" />"	
		."<img class=\"load\" src=\"img/txt.php?str=16_100_999999_000000_".($_GET['nm']-1)."*of*".count($out['feed']['entry'])."\" />"
		;


				
$i = intval($_GET['nm']-1);	
	
	echo ""
		//dimensions are passed as hex encoded numbers in a single string delimited by a "z".
		."\n<img class=\"thmb\" src=\"photo.php?url=".urlencode(substr($pho['view'][$i],7))."&d=".dechex($pho['thmb_x'][$i])."z".dechex($pho['thmb_y'][$i])."z".dechex($pho['view_w'][$i])."z".dechex($pho['view_h'][$i])."\" alt=\"{$pho['cptn'][$i]}\""
			." style=\"position:absolute;z-index:1;left:".round((660-$pho['thmb_x'][$i])/2)."px;top:{$top[$i]}px;width:{$pho['thmb_x'][$i]}px;height:{$pho['thmb_y'][$i]}px;\""
			." />"
			."<div class=\"cptn\" style=\"top:".($top[$i]+$pho['thmb_y'][$i]+10)."px;\">{$pho['cptn'][$i]}</div>"
		;
	
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
