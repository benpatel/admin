<?php 
include_once("init.php");
$data = array();

if(!$seller || !isset($_POST['rate_id'])){ 
  redirect_to("logout.php");
}
$rate_id = $_POST['rate_id'];

$amount = trim($dtb->escape_value($_POST['amount']));
$description = trim($dtb->escape_value($_POST['rate_description']));
$disclaimer = trim($dtb->escape_value($_POST['rate_disclaimer']));
$duration = trim($dtb->escape_value($_POST['rate_duration']));
$city = ucfirst(trim($dtb->escape_value($_POST['city_name'])));
$outcall = trim($dtb->escape_value($_POST['outcall']));


$total_result = $dtb->query("select * from rates where seller_id={$seller_id} and duration={$duration} and city='{$city}' and id!={$rate_id}");
$total_row =$dtb->num_rows($total_result);
if($total_row >=1){
    $data['error']="Rates already exists";
    $data['status']="error";
}
else{


$sql="UPDATE `rates` SET `city` = '{$city}', `amount` = '{$amount}', `outcall` = '{$outcall}', `duration`={$duration},`description` = '{$description}', `disclaimer` = '{$disclaimer}' WHERE `rates`.`id` = {$rate_id} AND seller_id ={$seller_id};
";

if($dtb->query($sql)){
	$data['status']="success";
}else{
	$data['status']="error";
}
}

echo json_encode($data);
?>