<?php 
include_once("init.php");
if(!$seller || !isset($_POST['gallery_id'])){ 
  redirect_to("logout.php");
}
$gallery_id = $_POST['gallery_id'];

$gallery_title = trim($dtb->escape_value($_POST['gallery_title']));
$gallery_description = trim($dtb->escape_value($_POST['gallery_description']));

if(isset($_POST['visibility'])){
	$visibility = 'private';
}else{
	$visibility = 'public';
}

$sql="UPDATE `gallery` SET `gallery_title` = '{$gallery_title}', `gallery_description` = '{$gallery_description}', `visibility` = '{$visibility}' WHERE `gallery`.`id` = {$gallery_id} AND seller_id ={$seller_id};
";

if($dtb->query($sql)){
	redirect_to("gallery.php");
}else{
	redirect_to("index.php");
}
?>