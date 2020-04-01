<?php 
include_once("init.php");
if(!$seller){ 
  redirect_to("logout.php");
}

$data=array();

$amount = trim($dtb->escape_value($_POST['amount']));
$outcall = trim($dtb->escape_value($_POST['outcall']));
$duration = trim($dtb->escape_value($_POST['rate_duration']));
$description = trim($dtb->escape_value($_POST['rate_description']));
$disclaimer = trim($dtb->escape_value($_POST['rate_disclaimer']));
$city = ucfirst(trim($dtb->escape_value($_POST['city_name'])));

$total_result = $dtb->query("select * from rates where seller_id={$seller_id} and duration={$duration} and city='{$city}'");
$total_row =$dtb->num_rows($total_result);
if($total_row >=1){
    $data['error']="Rates already exists";
    $data['status']="error";
}
else{


$sql="INSERT INTO `rates` (`id`,`city`, `seller_id`, `amount`,`outcall`, `duration`, `description`, `disclaimer`) VALUES (NULL,'{$city}', '{$seller_id}', '{$amount}', '{$outcall}',{$duration}', '{$description}', '{$disclaimer}')";

if($dtb->query($sql)){
	$data['status']='success';
}else{
	$data['error']['sql']="Error in submission";
	$data['status']="error";
}
}

echo json_encode($data);
?>