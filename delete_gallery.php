<?php 
include_once("init.php");
if(!$seller){ 
  redirect_to("logout.php");
}
$data = array();
$data['status']='error';

$seller_id  = $_POST['seller_id'];
$gallery_id = $_POST['gallery_id'];

$sql="DELETE FROM `gallery` WHERE `gallery`.`id` = {$gallery_id} AND seller_id ={$seller_id};";

if($dtb->query($sql)){
	$data['status']='success';	
}

echo json_encode($data);
?>
