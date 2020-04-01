<?php include_once("init.php");


$target_dir = "gallery/";
$gallery_id = $_POST['gallery_id'];
$uploadOk = 1;

$total_result = $dtb->query("select * from gallery where seller_id={$seller_id} and id={$gallery_id}");
$total_row =$dtb->num_rows($total_result);
if($total_row !=1){
    redirect_to("logout.php");
}

 while($result = $total_result->fetch_object()){
 	$image_string = $result->images;
 }
$new_uploaded_files['images']= array();
$new_uploaded_files['gallery_id']=$gallery_id;

$uploaded_files['images'] = array();
if($image_string!=''){
$uploaded_files['images'] = explode("|",$image_string);
}

for($x=0; $x<count($_FILES["fileToUpload"]["name"]); $x++){
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"][$x]);


$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

$target_file = date("Ymds").uniqid().".".$imageFileType;
$target_path = $target_dir.$target_file ;

	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$x], $target_path)) {

		array_push($uploaded_files['images'],$target_file);
		array_push($new_uploaded_files['images'],$target_file);
		
	        
	    } 
	else {
	        $uploadOk=0;
	    }
}
$image_string =  implode("|",$uploaded_files['images']);

$sql_image = "UPDATE `gallery` SET `images` = '{$image_string}' WHERE `gallery`.`id` = {$gallery_id} and seller_id={$seller_id}";

if($uploadOk=1){
	$dtb->query($sql_image);
}

//print_r($uploaded_files);
echo json_encode($new_uploaded_files);


?>

