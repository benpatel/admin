<?php 
include_once("init.php");
$data = array();

if(!$seller){ 
  redirect_to("logout.php");
}
$action=$_POST['action'];

$sql="UPDATE `seller` SET `site_status` = '{$action}' WHERE `seller`.`id` = {$seller_id}";

if($dtb->query($sql)){
	$data['status']='success';
	$_SESSION['seller_info']['site_status']=$action;
}

echo json_encode($data);
?>