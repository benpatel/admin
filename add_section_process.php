<?php 
include_once("init.php");
if(!$seller){ 
  redirect_to("logout.php");
}
if(!isset($_POST['section_title']) || $_POST['section_title']==''){
	redirect_to("logout.php");
}
$section_title = trim($dtb->escape_value($_POST['section_title']));
$section_description = trim($dtb->escape_value($_POST['section_description']));
$section_subtitle = trim($dtb->escape_value($_POST['section_subtitle']));
$section_image = trim($dtb->escape_value($_POST['section_image']));
$page_id = trim($dtb->escape_value($_POST['page_id']));



if(isset($_POST['visibility'])){
	$visibility = 'private';
}else{
	$visibility = 'public';
}


$sql="INSERT INTO `sections` (`id`,`page_id`, `seller_id`, `section_title`,`section_subtitle`, `section_description`,`section_image`, `visibility`) VALUES (
	NULL, '{$page_id}','{$seller_id}', '{$section_title}','{$section_subtitle}', '{$section_description}','{$section_image}', '{$visibility}')";


if($dtb->query($sql)){
	redirect_to("sections.php?id=".$page_id);
}else{
	redirect_to("index.php");
}
?>