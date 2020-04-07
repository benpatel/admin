<?php
include_once("init.php");

$url = $dtb->escape_value(trim($_POST['url']));
$banner = $dtb->escape_value(trim($_POST['banner']));
$id = $dtb->escape_value($_POST['banner_id']);



$sql="UPDATE `banners` SET  `url` = '{$url}', `banner` = '{$banner}' WHERE `banners`.`id` = {$id} and seller_id={$seller_id}";


if($dtb->query($sql)){
	redirect_to(SITE_ADMIN."admin/banners.php");
}



?>