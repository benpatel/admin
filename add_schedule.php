<?php 
include_once("init.php");
if(!$seller){ 
  redirect_to("logout.php");
}
$data = array();
$start_date =$_POST['start_date'];
$end_date = $_POST['end_date'];
$city_name = trim($dtb->escape_value($_POST['city_name']));
$class = $_POST['class'];

$sql = "INSERT INTO `schedule` (`id`, `seller_id`, `city_name`, `start_date`, `end_date`, `class`) VALUES (NULL, '{$seller_id}', '{$city_name}', '{$start_date}', '{$end_date}', '{$class}')";

if($dtb->query($sql)){
	$data['status']="success";
}else{
	$data['status']="error";
}

echo json_encode($data);
?>