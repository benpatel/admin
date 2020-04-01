<?php 
include_once("init.php");
if(!$seller || !isset($_POST['image_name'])){ 
  redirect_to("logout.php");
}
$data = array();
$data['status']='error';

$gallery_id = $_POST['gallery_id'];
$image_name = $_POST['image_name'];


$total_result = $dtb->query("select * from gallery where seller_id={$seller_id} and id={$gallery_id}");
$total_row =$dtb->num_rows($total_result);
if($total_row !=1){
    redirect_to("logout.php");
}

 while($result = $total_result->fetch_object()){
 	$image_string = $result->images;
 	$deleted_image_string = $result->deleted_images;
 }

$deletd_images['images'] = array();
$uploaded_files['images'] = array();
$old_deletd_images['images']= array();

$deletd_images['images'][0] = $image_name;



if($image_string!=''){
	$uploaded_files['images'] = explode("|",$image_string);
}
if($deleted_image_string!=''){
	$old_deletd_images['images'] = explode("|",$deleted_image_string);
}


$uploaded_files['images']=array_diff($uploaded_files['images'],$deletd_images['images']);
array_push($old_deletd_images['images'],$image_name);


$image_string =  implode("|",$uploaded_files['images']);
$deleted_image_string = implode("|",$old_deletd_images['images']);

$sql = "UPDATE `gallery` SET `images` = '{$image_string}', `deleted_images`='{$deleted_image_string}' WHERE `gallery`.`id` = {$gallery_id} and seller_id ={$seller_id}";
//print_r($uploaded_files);
//print_r($_POST);

if($dtb->query($sql)){
	$data['status']='success';	
}

echo json_encode($data);
?>
