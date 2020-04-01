<?php 
include_once("init.php");
if(!$seller){ 
  redirect_to("logout.php");
}


require 'includes/header_start.php'; 
 ?>


<?php require 'includes/header_end.php'; ?>


    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Add Banner</h4>
        </div>
    </div>
    <!-- end row -->



    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
            <div class="banner_image">
                
            </div>
<form  action="banner-upload.php" method="post" id="file_upload" enctype="multipart/form-data">
<div class="form-group row">
    <div class="col-sm-2">
        <input type="file" name="fileToUpload" class="hidden"  id="fileToUpload" style="visibility:hidden">
    </div>
    <div class="col-sm-10">
      <p class="btn btn-success"  id="uploadTrigger">Upload Banner</p>
    </div>
  </div>
</form> 

<form method="post" action="add_banner_process.php"   data-parsley-validate novalidate>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">URL( Link )</label>
    <div class="col-sm-10">
      <input type="url" name="url" required class="form-control" id="url" placeholder="URL">
      <input type="hidden" name="banner" value="" id="link_banner">
    </div>
  </div>
  


  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary">Add</button>
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