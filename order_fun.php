<?php

include_once("init.php");
if(!$seller){ 
  redirect_to("logout.php");
}

// print_array($_POST);
$profile_array = array_reverse($_POST['profile_order']);
foreach ($profile_array as $key => $value) {


	$sql="UPDATE `profile` SET `pos` = '{$key}' WHERE `profile`.`id` = {$value}";
	$dtb->query($sql);
	
}
?>