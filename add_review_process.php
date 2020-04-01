<?php 
include_once("init.php");
if(!$seller){ 
  redirect_to("logout.php");
}

$data=array();

$reviewer = trim($dtb->escape_value($_POST['reviewer']));
$site = trim($dtb->escape_value($_POST['site']));
$review_description = trim($dtb->escape_value($_POST['review_description']));




$sql="INSERT INTO `reviews` (`id`, `seller_id`, `reviewer`, `site`, `review_description`) VALUES (NULL, '{$seller_id}', '{$reviewer}', '{$site}', '{$review_description}')";


if($dtb->query($sql)){
	$data['status']='success';
}else{
	$data['error']['sql']="Error in submission";
	$data['status']="error";
}


echo json_encode($data);
?>