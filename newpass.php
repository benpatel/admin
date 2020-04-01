<?php 
include_once("init.php"); 
		$password = md5($_POST['password']);
		$email = $dtb->escape_value(trim($_POST['email']));	
		$code = $dtb->escape_value(trim($_POST['code']));	
		if($code!='' && $code !='NULL' && $code!=0){
		$sql = "UPDATE `seller` SET `password` = '{$password}', code='' WHERE `email` = '{$email}' and code='{$code}'";
		if($dtb->query($sql)){
			unset($_SESSION['portal']['message']);
			redirect_to("signin.php");
		}
	  }	
?>
