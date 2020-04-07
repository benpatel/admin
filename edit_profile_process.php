<?php 
include_once("init.php");
$data = array();

if(!$seller || !isset($_POST['profile_id'])){ 
  redirect_to("logout.php");
}
$id = $_POST['profile_id'];

$ans = trim($dtb->escape_value($_POST['ans']));
$que = trim($dtb->escape_value($_POST['que']));




$sql="UPDATE `profile` SET `que` = '{$que}', `ans`='{$ans}' WHERE `profile`.`id` = {$id} AND seller_id ={$seller_id}";

//echo $sql;

if($dtb->query($sql)){
	$data['status']="success";
}else{
	$data['status']="error";
}


echo json_encode($data);
?>