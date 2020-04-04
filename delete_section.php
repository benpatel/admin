<?php 
include_once("init.php");
if(!$seller){ 
  redirect_to("logout.php");
}
$data = array();
$data['status']='error';

$seller_id  = $_POST['seller_id'];
$page_id = $_POST['page_id'];
$section_id = $_POST['section_id'];

$sql="DELETE FROM `sections` WHERE `sections`.`id` = {$section_id} AND page_id={$page_id} AND seller_id ={$seller_id} and status='unlocked'";

if($dtb->query($sql)){
	$data['status']='success';	
}

echo json_encode($data);
?>
