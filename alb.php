<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<style>
img.load{position:absolute;z-index:1;width:0px;height:0px;top:0px;left:0px;visibility:hidden;}
img.thmb{cursor:pointer;border:solid 1px #444444;}
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

$thmb_wd = 260;

for ($i = 0; $i < count($out['feed']['entry']); $i++)
{
	$pho['orig'][$i] = $out['feed']['entry'][$i]['link'][4]['attr']['href'];
	$pho['thmb'][$i] = $out['feed']['entry'][$i]['media:group']['media:thumbnail'][2]['attr']['url'];
	$pho['cptn'][$i] = $out['feed']['entry'][$i]['summary']['value'];
	$pho['dim_x'][$i] = $out['feed']['entry'][$i]['gphoto:width']['value'];
	$pho['dim_y'][$i] = $out['feed']['entry'][$i]['gphoto:height']['value'];
		
	if ($pho['dim_x'][$i] >= $pho['dim_y'][$i])
	{	$pho['thmb_x'][$i] = $thmb_wd;
		$pho['thmb_y'][$i] = round($thmb_wd*($pho['dim_y'][$i]/$pho['dim_x'][$i]));
	}
	else
	{	$pho['thmb_y'][$i] = $thmb_wd;
		$pho['thmb_x'][$i] = round($thmb_wd*($pho['dim_x'][$i]/$pho['dim_y'][$i]));
	}
}

?>

<body style="background-color:black;" onLoad="">

<div style="position:relative;width:669px;height:101px;margin-left:auto;margin-right:auto;border:none;background-image:url('img/title.png');"></div>


<div style="width:660px;height:300px;position:relative;margin-top:45px;margin-left:auto;margin-right:auto;border:none;">
<?php

$group = 3*ceil(intval($_GET['nm'])/3)-2;

echo "<img id=\"bttn_menu\" src=\"img/txt.php?str=18_100_ffffff_000000_<*menu\" style=\"position:absolute;top:-50px;left:0px;width:100px;height:50px;cursor:pointer;\""
		." onMouseOver=\"bulge(0,'menu','up');\""
		." onMouseOut=\"bulge(0,'menu','dn');\""
		." onClick=\"location='http://www.erikacarrillophotography.com/';\""
	." />";

echo "<img src=\"img/txt.php?str=28_160_ffffff_000000_". strtolower(substr(strval($_GET['ref']),5)) ."\" style=\"position:absolute;top:-60px;left:509px;\" />";

echo "<img id=\"bttn_nxt\" style=\"position:absolute;top:400px;left:480px;width:100px;z-index:1;height:50px;";



if (count($out['feed']['entry']) > ($group+2))
{ 	echo "cursor:pointer;\""
		." src=\"img/txt.php?str=18_100_ffffff_000000_next*>\""
		." onMouseOver=\"bulge(0,'nxt','up');\""
		." onMouseOut=\"bulge(0,'nxt','dn');\""
		." onClick=\"location='alb.php?ref={$_GET['ref']}&nm=".($screen+3)."';\"";
}
else
{ 	echo "\" src=\"img/txt.php?str=18_100_333333_000000_next*>\"";
}
echo " />";

echo "<img id=\"bttn_prv\" style=\"position:absolute;top:400px;left:80px;width:100px;z-index:1;height:50px;";

if (intval($_GET['nm']) >= 4)
{ 	echo "cursor:pointer;\""
		." src=\"img/txt.php?str=18_100_ffffff_000000_<*prev\""
		." onMouseOver=\"bulge(0,'prv','up');\""
		." onMouseOut=\"bulge(0,'prv','dn');\""
		." onClick=\"location='alb.php?ref={$_GET['ref']}&nm=".($screen-3)."';\"";
}
else
{ 	echo "\" src=\"img/txt.php?str=18_100_333333_000000_<*prev\"";
}
echo " />";



for ($i = ($screen-1); $i < ($screen+2); $i++)
{	
	$vt[$i] = 1;	if ($i == $group) { $vt[$i] = 220; }
	if (!empty($pho['thmb'][$i]))
	{	echo "<div style=\"position:absolute;top:{$vt[$i]}px;left:".(($i+1-$screen)*($thmb_wd-70+8)+1)."px;width:".($thmb_wd+6)."px;height:".($thmb_wd+6)."px;\">"
		."\n<img id=\"bttn_{$i}\" class=\"thmb\" src=\"photo.php?url=".urlencode(substr($pho['thmb'][$i],7))."\" alt=\"{$pho['cptn'][$i]}\""
			." style=\"position:absolute;z-index:1;left:".(($thmb_wd-$pho['thmb_x'][$i])/2)."px;top:".(($thmb_wd-$pho['thmb_y'][$i])/2)."px;width:{$pho['thmb_x'][$i]}px;height:{$pho['thmb_y'][$i]}px;\""
			." onMouseOver=\"bulge(0,{$i},'up');\""
			." onMouseOut=\"bulge(0,{$i},'dn');\""
			." onClick=\"location='pic.php?ref={$_GET['ref']}&nm=".($i+1)."';\""	
			." />"
		."</div>"
		;
	}
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
