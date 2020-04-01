<?php 
include_once("init.php");
if($seller){ 
  redirect_to("index.php");
}

$email = $_POST['email'];
$password = md5($_POST['password']);
$user_sql="select * from seller where email='{$email}' and password='{$password}' and status='approved'";
$user_result_set  =$dtb->query($user_sql);

	if($dtb->num_rows($user_result_set) == 0 ){
		$_SESSION['portal']['message']='Invalid email or password';
		redirect_to("signin.php");
	}
else{

	while ($user_result = $user_result_set->fetch_object()) {
		
					$_SESSION['portal']['logged_in']="YES";
					$_SESSION['seller_info']['id']=$user_result->id;
					$_SESSION['seller_info']['fname']=$user_result->fname;
					$_SESSION['seller_info']['lname']=$user_result->lname;
					$_SESSION['seller_info']['email']=$user_result->email;
					$_SESSION['seller_info']['phone']=$user_result->phone;

					$_SESSION['seller_info']['company']=$user_result->company;
					$_SESSION['seller_info']['phone']=$user_result->phone;
					$_SESSION['seller_info']['site_status']=$user_result->site_status;
					$seller_email = $user_result->email;
					$seller_id = $user_result->id;
					$seller = true;

					unset($_SESSION['portal']['message']);
					unset($_SESSION['error']);
					
					
			}


}



redirect_to("index.php");
?>