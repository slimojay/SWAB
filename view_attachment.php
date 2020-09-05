<?php
include('BaseClass.php');
$app = new BaseClass();
//echo $app->checkMime($_GET['doc']);
//exit;
$doc = $_GET['doc'];
if(file_exists($doc)){
      header("Cache-Control: maxage=1");
      header("Pragma: public");
      header("Content-type: " . $app->checkMime($doc));
      header('Content-Transfer-Encoding: binary'); 
      header("Content-Description: PHP Generated Data");
      header('Content-Length:' . filesize($doc));
      header('Accept-Ranges: bytes');
      ob_clean();
      //@readfile($file);
     // readfile($file);
     $file_to = file_get_contents($doc);
    echo $file_to;
	
}
else{
	die('file not found');
}





/*$brk = explode('.', $doc);


$pathinfo = pathinfo($doc, PATHINFO_EXTENSION);
if ($pathinfo == ''){
	echo 'no file found __ '; exit;
}
$image_ext = array('png', 'jpg', 'jpeg');
if (in_array($pathinfo, $image_ext)){
	$type = 'image';
}
else if ($pathinfo == 'html' || $pathinfo =='mhtml'){
		$type = 'markup';
	
}

else{
	$type = 'file';
}
if ($type == 'file'){
	
	if(file_exists($doc)){
      header("Cache-Control: maxage=1");
      header("Pragma: public");
      header("Content-type: application/$pathinfo");
      header('Content-Transfer-Encoding: binary'); 
      header("Content-Description: PHP Generated Data");
      header('Content-Length:' . filesize($doc));
      header('Accept-Ranges: bytes');
      ob_clean();
      //@readfile($file);
     // readfile($file);
     $file_to = file_get_contents($doc);
    echo $file_to;
	
}
}
else if($type =='image'){
	
	if(file_exists($doc)){
      header("Cache-Control: maxage=1");
      header("Pragma: public");
      header("Content-type: image/$pathinfo");
      header('Content-Transfer-Encoding: binary'); 
      header("Content-Description: PHP Generated Data");
      header('Content-Length:' . filesize($doc));
      header('Accept-Ranges: bytes');
      ob_clean();
      //@readfile($file);
     // readfile($file);
     $file_to = file_get_contents($doc);
    echo $file_to;
	
}
	
	
	//echo "<img src='$doc' style='height:90%; width:100%'/>";
}else{
	if (file_exists($doc)){
	readfile($doc);}
	else{echo 'no file found..';  exit;}
}
*/

?>