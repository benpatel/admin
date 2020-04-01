<?php
include_once("init.php");

$url = $dtb->escape_value(trim($_POST['url']));
$banner = $dtb->escape_value(trim($_POST['banner']));

$sql="INSERT INTO `banners` (`seller_id`, `url`, `banner`) VALUES ('{$seller_id}', '{$url}', '{$banner}')";

if($dtb->query($sql)){
	redirect_to(SITE_BASE."admin/banners.php");
}
?>