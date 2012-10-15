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


<body style="background-color:black;" onLoad="">

<div style="position:relative;width:669px;height:101px;margin-left:auto;margin-right:auto;border:none;background-image:url('img/title.png');"></div>


<div style="width:660px;height:300px;position:relative;margin-top:45px;margin-left:auto;margin-right:auto;border:none;">
<?php

echo "<img id=\"bttn_menu\" src=\"img/txt.php?str=18_100_ffffff_000000_<*menu\" style=\"position:absolute;top:-50px;left:0px;width:100px;height:50px;cursor:pointer;\""
		." onMouseOver=\"bulge(0,'menu','up');\""
		." onMouseOut=\"bulge(0,'menu','dn');\""
		." onClick=\"location='http://www.erikacarrillophotography.com/';\""
	." />";

echo "<img src=\"img/txt.php?str=28_160_ffffff_000000_". strtolower(strval($_GET['ref'])) ."\" style=\"position:absolute;top:-60px;left:509px;\" />";

$text['style']['info'] = "text-align:left;padding-top:5px;";
$text['info'] = "Erika Carrillo is a trained photojournalist in the San Francisco Bay Area with experience shooting weddings, events, portraits, nature, and culture. Erika began photographing the world around her when she was seven years old with a point and shoot film camera that she carried with her everywhere. She always felt compelled to document the experiences and share them with others in a way that recreates the moment."
				."<br /><br />From her photojournalism background, Erika always tries to photograph without disturbing or altering a situation in order to capture the true nature of the person or scene. She studied photojournalism at Boston University and was influenced by photographers like Henri Cartier Bresson, Ansel Adams, James Nachtway, Jim Marshall, and Danny Clinch. Erika began with black and white film photography and progressed to digital color photography. She had a black and white photograph juried into the Stebbins Gallery in Harvard Square in 2003 and has been displaying her photographs at the Kings Mountain Art Fair in Woodside for the last two years."
				."<br /><br />Erika has been photographing the Bridge School Benefit Concert for the last seven years, and is inspired by the interaction between musicians and the emotion that comes through the songs. She has been shooting weddings for five years and treasures the little moments that bring joy to the bride and groom. Erika has also documented her travels through the United States, Canada, Costa Rica, Panama, Germany, Denmark, and Sweden to show the differing cultures and landscapes around the world. Erika values awareness about what is going on in the world and finds that photography can be a useful tool to share experiences and bring people together."
				."<br /><br />To order prints or to book an event, please contact Erika by telephone at (650) 722-2735 or by email at <a href=\"mailto:erikacarrillo@gmail.com\" style=\"\">erikacarrillo@gmail.com</a>";


$text['style']['contact'] = "text-align:center;padding-top:30px;";
$text['contact'] = "To order prints or to book an event, please contact Erika Carrillo"
					."<br /><br />by telephone at"
					."<br /><b>(650) 722-2735</b>"
					."<br /><br />or by email at"
					."<br /><a href=\"mailto:erikacarrillo@gmail.com\" style=\"font-weight:bold;\">erikacarrillo@gmail.com</a>"
					."<br /><br /><br />To read about Erika&#39;s training and experience, please visit <a href=\"other.php?ref=info\">the &#39;info&#39; page</a>."
					;


echo 	"<div style=\"color:white;width:600px;height:auto;border:none;"
			."position:relative;margin-right:auto;margin-left:auto;"
			."font-family:arial;font-weight:normal;font-size:14px;"
			.$text['style'][strtolower(strval($_GET['ref']))]
			."\">". $text[strtolower(strval($_GET['ref']))] ."</div>";





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
