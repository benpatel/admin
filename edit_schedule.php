<?php
include_once("init.php");

$data = array();

$start_date =$_POST['start_date'];
$end_date = $_POST['end_date'];
$city_name = trim($dtb->escape_value($_POST['city_name']));
$class = $_POST['class'];


$sql="UPDATE `schedule` SET `city_name` = '{$city_name}' WHERE `schedule`.`seller_id` = {$seller_id} and start_date = '{$start_date}' and end_date='{$end_date}' and class='{$class}'";

if($dtb->query($sql)){
	$data['status']='success';
}else{
	$data['status']='error';
}

echo json_encode($data)
?>