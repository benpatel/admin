<?php 
include_once("init.php");
if(!$seller){ 
  redirect_to("logout.php");
}
$data = array();

$private_password = md5(trim($dtb->escape_value($_POST['private_password'])));


$sql="UPDATE `seller` SET `private_password` = '{$private_password}' WHERE id ={$seller_id}";

if($dtb->query($sql)){
	$data['status']='success';
}else{
	$data['status']='error';
}
echo json_encode($data);
?>