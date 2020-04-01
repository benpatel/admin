<?php 
include_once("init.php");
if(!$seller){ 
  redirect_to("logout.php");
}
if(!isset($_POST['page_title']) || $_POST['page_title']==''){
	redirect_to("logout.php");
}
$page_title = trim($dtb->escape_value($_POST['page_title']));
$page_description = trim($dtb->escape_value($_POST['page_description']));
$page_subtitle = trim($dtb->escape_value($_POST['page_subtitle']));


$slug =  slugify($page_title);
$slug_sql = "select * from pages WHERE  slug  LIKE '$slug%' and seller_id={$seller_id}";
$slug_count = $dtb->num_rows($dtb->query($slug_sql));

if($slug_count > 0){
	$slug_count++;
	$slug=$slug.'-'.$slug_count;
}



if(isset($_POST['visibility'])){
	$visibility = 'private';
}else{
	$visibility = 'public';
}

$sql="INSERT INTO `pages` (`id`, `seller_id`, `page_title`,`slug`,`page_subtitle`, `page_description`, `visibility`) VALUES (
	NULL, '{$seller_id}', '{$page_title}','{$slug}','{$page_subtitle}', '{$page_description}', '{$visibility}')";

if($dtb->query($sql)){
	redirect_to("pages.php");
}else{
	redirect_to("index.php");
}
?>