<?php 
include_once("init.php");
if(!$seller){ 
  redirect_to("logout.php");
}
$data = array();
$data['status']='error';

$seller_id  = $_POST['seller_id'];
$faq_id = $_POST['faq_id'];

$sql="DELETE FROM `faqs` WHERE `faqs`.`id` = {$faq_id} AND seller_id ={$seller_id}";

if($dtb->query($sql)){
	$data['status']='success';	
}

echo json_encode($data);
?>
