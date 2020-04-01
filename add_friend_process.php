<?php
include_once("init.php");

$url = $dtb->escape_value(trim($_POST['url']));
$banner = $dtb->escape_value(trim($_POST['banner']));
$name = $dtb->escape_value(trim($_POST['name']));

$sql="INSERT INTO `friends` (`seller_id`, `url`, `banner`,`name`) VALUES ('{$seller_id}', '{$url}', '{$banner}','{$name}')";

if($dtb->query($sql)){
	redirect_to(SITE_BASE."admin/friends.php");
}
?>