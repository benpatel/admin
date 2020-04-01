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
            <h4 class="page-title">Add a Gallery</h4>
        </div>
    </div>
    <!-- end row -->



    <div class="row">
        <div class="col-md-12">
            <div class="card-box">

            	<form method="post" action="add_gallery_process.php" data-parsley-validate novalidate>
                    

                    <div class="form-group">
                        <label for="gallery_title">Gallery Title<span class="text-danger">*</span></label>
                        <input type="text" name="gallery_title" parsley-trigger="change" required
                               placeholder="Enter Gallery Title" class="form-control" id="gallery_title">
                    </div>
  


                    <div class="form-group">
                        <label for="page_title">Visibility</label>
                        <input type="checkbox" name="visibility" data-plugin="switchery" data-color="#ff5d48" data-secondary-color="#1bb99a" />
                                    
                    </div>

                    <div class="form-group">
                    	<label for="gallery_description">Description <em class="text-danger"> (Any color formating in this editror will reflect on site as is )</em></label>
            			<textarea name="gallery_description"></textarea>
            		</div>

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
							height : "280"

						});
</script>

<!-- Validation js (Parsleyjs) -->
<script type="text/javascript" src="assets/plugins/parsleyjs/parsley.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('form').parsley();
    });
</script>
<?php require 'includes/footer_end.php' ?>