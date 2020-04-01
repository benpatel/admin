<?php 
include_once("init.php");
if(!$seller){ 
  redirect_to("index.php");
}

$email = $_POST['email'];
$msg = $_POST['message'];
$data = array();


	$message = '<h2  style="text-align:center">Account Update</h2>';
		$message.='<p><b>Message : </b>'.$msg.'</p>';

sendEmail($email,"Account Update : Liquidatevape.com",$message);
$data['status']="success";
echo json_encode($data);
?>