<?php 
include_once("init.php");
if(!$seller){ 
  redirect_to("login.php");
}
require 'includes/header_start.php'; 
 ?>


<?php require 'includes/header_end.php'; ?>


    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Add a Page</h4>
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
                        <div class="col-sm-12">
                            
                            <p class="btn btn-success"  id="uploadTrigger">Change Banner</p>
                        </div>
                     </div>
                     <input type="file" name="fileToUpload" class="hidden"  id="fileToUpload" style="visibility:hidden">
                </form>  



            	<form method="post" action="add_page_process.php" data-parsley-validate novalidate>
                    

                    <div class="form-group">
                        <label for="page_title">Page Title<span class="text-danger">*</span></label>
                        <input type="text" name="page_title" parsley-trigger="change" required
                               placeholder="Enter Page Title" class="form-control" id="page_title">
                               <input type="hidden" name="page_image" value="" required="" id="link_banner">
                    </div>
                    
                    <div class="form-group">
                        <label for="page_title">Page Sub Title<span class="text-danger"></span></label>
                        <input type="text" name="page_subtitle" parsley-trigger="change" 
                               placeholder="Enter Sub Title" class="form-control" id="page_subtitle">
                    </div>


                    <div class="form-group">
                        <label for="page_title">Visibility</label>
                        <input type="checkbox" name="visibility" data-plugin="switchery" data-color="#ff5d48" data-secondary-color="#1bb99a" />
                                    
                    </div>
                    <!--
                    <div class="form-group">
                    	<label for="page_title">Description <em class="text-danger"> (Any color formating in this editror will reflect on site as is )</em></label>
            			<textarea name="page_description"></textarea>
            		</div> -->

            		<div class="form-group text-right m-b-0">
                        <button class="btn btn-primary waves-effect waves-light" type="submit">
                            Add
                        </button>
                        <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                            Cancel
                        </button>
                    </div>        
            	</form>
            </div>
        </div><!-- end col-->

    </div>
    <!-- end row -->



<?php require 'includes/footer_start.php' ?>
<script src="assets/plugins/tinymce/tinymce.min.js"></script>
<script>

			 tinymce.init({ 
                            selector:'textarea',
                            content_css : "assets/css/tinymce_content.css", 
                            height : "280",
                             plugins: 'preview autolink directionality visualblocks visualchars  image link media table hr pagebreak nonbreaking anchor  insertdatetime advlist lists textcolor wordcount spellchecker  imagetools  colorpicker textpattern',
  toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat'

                        });
</script>

<!-- Validation js (Parsleyjs) -->
<script type="text/javascript" src="assets/plugins/parsleyjs/parsley.min.js"></script>
<script type="text/javascript" src="assets/js/banner-upload.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('form').parsley();
    });
</script>
<?php require 'includes/footer_end.php' ?>