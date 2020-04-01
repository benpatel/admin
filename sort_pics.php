<?php

include_once("init.php");
if(!$seller){ 
  redirect_to("logout.php");
}


$images = $_POST['image_order'];
$gallery_id = $_POST['gallery_id'];

	$sql="UPDATE `gallery` SET `images` = '{$images}' WHERE `gallery`.`id` = {$gallery_id}";
	$dtb->query($sql);

?>