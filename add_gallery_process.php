<?php 
include_once("init.php");
if(!$seller){ 
  redirect_to("logout.php");
}
if(!isset($_POST['gallery_title']) || $_POST['gallery_title']==''){
	redirect_to("logout.php");
}

$gallery_title = trim($dtb->escape_value($_POST['gallery_title']));
$gallery_description = trim($dtb->escape_value($_POST['gallery_description']));

if(isset($_POST['visibility'])){
	$visibility = 'private';
}else{
	$visibility = 'public';
}

$sql="INSERT INTO `gallery` (`id`, `seller_id`, `gallery_title`, `gallery_description`, `visibility`) VALUES (
	NULL, '{$seller_id}', '{$gallery_title}', '{$gallery_description}', '{$visibility}')";

if($dtb->query($sql)){
	redirect_to("gallery.php");
}else{
	redirect_to("index.php");
}
?>