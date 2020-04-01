<?php 
include_once("init.php");
if(!$seller){ 
  redirect_to("logout.php");
}
$data = array();
$data['status']='error';

$id = $_POST['banner_id'];

$sql="DELETE FROM `friends` WHERE `id` = {$id} AND seller_id ={$seller_id}";

if($dtb->query($sql)){
	$data['status']='success';	
}

echo json_encode($data);
?>
