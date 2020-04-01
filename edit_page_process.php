<?php 
include_once("init.php");
if(!$seller || !isset($_POST['page_id'])){ 
  redirect_to("logout.php");
}
$page_id = $_POST['page_id'];

$page_title = trim($dtb->escape_value($_POST['page_title']));
$page_description = trim($dtb->escape_value($_POST['page_description']));
$page_subtitle = trim($dtb->escape_value($_POST['page_subtitle']));

if(isset($_POST['visibility'])){
	$visibility = 'private';
}else{
	$visibility = 'public';
}

$sql="UPDATE `pages` SET `page_title` = '{$page_title}',`page_subtitle` = '{$page_subtitle}', `page_description` = '{$page_description}', `visibility` = '{$visibility}' WHERE `pages`.`id` = {$page_id} AND seller_id ={$seller_id};
";

if($dtb->query($sql)){
	redirect_to("pages.php");
}else{
	redirect_to("index.php");
}
?>