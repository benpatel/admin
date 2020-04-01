<?php 
include_once("init.php");
if(!$seller || !isset($_GET['id'])){ 
  redirect_to("logout.php");
}

$id = $_GET['id'];

$total_result = $dtb->query("select * from banners where seller_id={$seller_id} and id={$id}");
$total_row =$dtb->num_rows($total_result);
if($total_row !=1){
    redirect_to("logout.php");
}

 while($result = $total_result->fetch_object()){
    $banner_data = $result;
 }

require 'includes/header_start.php'; 
 ?>


<?php require 'includes/header_end.php'; ?>


    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Edit Banner</h4>
        </div>
    </div>
    <!-- end row -->



    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
            <div class="banner_image">
                <img src="<?php echo SITE_BASE.'admin/banners/'.$banner_data->banner;?> " style="padding:5px; ">
            </div>
<form  action="banner-upload.php" method="post" id="file_upload" enctype="multipart/form-data">
<div class="form-group row">
    <div class="col-sm-2">
        <input type="file" name="fileToUpload" class="hidden"  id="fileToUpload" style="visibility:hidden">
    </div>
    <div class="col-sm-10">
      <p class="btn btn-success"  id="uploadTrigger">Change Banner</p>
    </div>
  </div>
</form> 

<form method="post" action="edit_banner_process.php"   data-parsley-validate novalidate>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">URL( Link )</label>
    <div class="col-sm-10">
      <input type="url" name="url" required class="form-control" id="url" placeholder="URL" value="<?php echo $banner_data->url; ?>">
      <input type="hidden" name="banner_id" value="<?php echo $banner_data->id; ?>" id="">
      <input type="hidden" name="banner" value="<?php echo $banner_data->banner; ?>" id="link_banner">
    </div>
  </div>
  


  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary">Update</button>
    </div>
  </div>
</form>
               

            </div>
        </div><!-- end col-->

    </div>
    <!-- end row -->



<?php require 'includes/footer_start.php' ?>
<script type="text/javascript" src="assets/plugins/jquery-ui/jquery-ui.js"></script>
<script type="text/javascript" src="assets/js/banner-upload.js"></script>
<!-- Validation js (Parsleyjs) -->
<script type="text/javascript" src="assets/plugins/parsleyjs/parsley.min.js"></script><script type="text/javascript">
    $(document).ready(function() {
        $('form').parsley();
    });
</script>
<?php require 'includes/footer_end.php' ?>