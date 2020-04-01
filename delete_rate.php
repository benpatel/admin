<?php 
include_once("init.php");
if(!$seller){ 
  redirect_to("logout.php");
}
$data = array();
$data['status']='error';

$seller_id  = $_POST['seller_id'];
$rate_id = $_POST['rate_id'];

$sql="DELETE FROM `rates` WHERE `rates`.`id` = {$rate_id} AND seller_id ={$seller_id}";

if($dtb->query($sql)){
	$data['status']='success';	
}

echo json_encode($data);
?>
