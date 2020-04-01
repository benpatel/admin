<?php include_once("init.php");


$target_dir = "banners/";
$uploadOk = 1;

$data = array();
$data['status']='error';

$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);


$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

$target_file = date("Ymds").uniqid().".".$imageFileType;
$target_path = $target_dir.$target_file ;

	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_path)) {

		$data['img']=$target_file;
		
	        
	    } 
	else {
	        $uploadOk=0;
	    }




if($uploadOk=1){
	$data['status']='success';

	echo json_encode($data);
}
?>

