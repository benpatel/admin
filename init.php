<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('America/New_York');

require_once("../environment.php");
require_once("includes/functions.php");
require_once("includes/database.php");
require_once("includes/user.php");



$locked=false;

				if(isset($_SESSION['portal']['logged_in']) && $_SESSION['portal']['logged_in']=="YES" ){

					$seller=true;
					$logged_in_class='logged_in';
					$dealer = false;
					$login_disabled='';
					$seller_id = $_SESSION['seller_info']['id'];
					if($_SESSION['seller_info']['site_status']=='locked'){
						$locked=true;
					}

					
				}
				else{
					$logged_in=false;
					$dealer = false;
					$logged_in_class ="sign_in";
					$seller = false;
					$login_disabled='disabled';
				}
if(isset($_SESSION['admin']) && $_SESSION['admin'] =="YES")	{
	$admin = true;
}	
else{
	$admin = false;
}
$title="Website Manager";
?>