<?php

header('Content-Type: image/jpeg');

$url = "http://". strval($_GET['url']);

$path = "cache/".md5($url).".jpg";

if (file_exists($path)) {
  $img_str = file_get_contents($path);
} else {
  $img_str = file_get_contents($url);
  file_put_contents("cache/{$md5}.jpg", $path);
}

if (!empty($_GET['d']))
{	
  $d = explode("z",$_GET['d']);
  $wd = intval(hexdec($d[0]));
  $ht = intval(hexdec($d[1]));
  $f_wd = intval(hexdec($d[2]));
  $f_ht = intval(hexdec($d[3]));

  $offset_x = 0;
  $offset_y = 0;

  if ($wd >= $ht) {


  } else {

  }



	$out = ImageCreateTrueColor($f_wd,$f_ht);
	ImageCopyResampled($out,ImageCreateFromString($img_str),0,0,$offset_x,$offset_y,$f_wd,$f_ht,$wd,$ht);
	ImageJPEG($out,"",90);
	ImageDestroy($out);	
}
else
{
	ImageJPEG(ImageCreateFromString($img_str),"",90);
}

curl_close($curl);

?>