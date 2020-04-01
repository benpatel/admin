<?php 
include_once("init.php");
if(!$seller){ 
  redirect_to("logout.php");
}

$data=array();

$que = trim($dtb->escape_value($_POST['que']));
$ans = trim($dtb->escape_value($_POST['ans']));




$sql="INSERT INTO `faqs` (`id`, `seller_id`, `ans`, `que`) VALUES (NULL, '{$seller_id}', '{$ans}', '{$que}')";


if($dtb->query($sql)){
	$data['status']='success';
}else{
	$data['error']['sql']="Error in submission";
	$data['status']="error";
}


echo json_encode($data);
?>