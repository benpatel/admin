<?php
include_once("init.php");
$_SESSION['portal']['logged_in']="NO";
$_SESSION['seller_info']=array();
unset($_SESSION['admin']);
redirect_to("signin.php");

?>