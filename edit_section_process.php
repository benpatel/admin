<?php 
include_once("init.php");
if(!$seller || !isset($_POST['section_id']) ||  !isset($_POST['page_id'])){ 
  //redirect_to("logout.php");
}


$page_id = $_POST['page_id'];
$section_id= $_POST['section_id'];


$section_title = trim($dtb->escape_value($_POST['section_title']));
$section_description = trim($dtb->escape_value($_POST['section_description']));
$section_subtitle = trim($dtb->escape_value($_POST['section_subtitle']));
$section_image = trim($dtb->escape_value($_POST['section_image']));


if(isset($_POST['visibility'])){
	$visibility = 'private';
}else{
	$visibility = 'public';
}

$sql="UPDATE `sections` SET `section_title` = '{$section_title}',`section_subtitle` = '{$section_subtitle}', `section_description` = '{$section_description}',`section_image` = '{$section_image}', `visibility` = '{$visibility}' WHERE `page_id` = {$page_id} AND seller_id ={$seller_id} and id={$section_id};
";

if($dtb->query($sql)){
	redirect_to("sections.php?id=".$page_id);
}else{
	redirect_to("index.php");
}
?>