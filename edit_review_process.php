<?php 
include_once("init.php");
$data = array();

if(!$seller || !isset($_POST['review_id'])){ 
  redirect_to("logout.php");
}
$review_id = $_POST['review_id'];

$reviewer = trim($dtb->escape_value($_POST['reviewer']));
$site = trim($dtb->escape_value($_POST['site']));
$review_description = trim($dtb->escape_value($_POST['review_description']));



$sql="UPDATE `reviews` SET `reviewer` = '{$reviewer}', `site`='{$site}',`review_description` = '{$review_description}' WHERE `reviews`.`id` = {$review_id} AND seller_id ={$seller_id}";

//echo $sql;

if($dtb->query($sql)){
	$data['status']="success";
}else{
	$data['status']="error";
}


echo json_encode($data);
?>