<?php

include_once("init.php");
if(!$seller){ 
  redirect_to("logout.php");
}


$banner_order = $_POST['banner_order'];
$banner_order = explode("|",$banner_order);

print_r($banner_order);

foreach ($banner_order as $key => $banner_id) {
	echo $key." ";
	$sql="UPDATE `friends` SET `sort` = '{$key}' WHERE `friends`.`id` = {$banner_id}";
	$dtb->query($sql);
}
?>