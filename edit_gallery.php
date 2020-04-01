<?php 
include_once("init.php");
if(!$seller || !isset($_GET['id'])){ 
  redirect_to("logout.php");
}
$gallery_id = $_GET['id'];

$total_result = $dtb->query("select * from gallery where seller_id={$seller_id} and id={$gallery_id}");
$total_row =$dtb->num_rows($total_result);
if($total_row !=1){
    redirect_to("logout.php");
}
require 'includes/header_start.php'; 


                        $sql = "select * from gallery where seller_id={$seller_id} and id={$gallery_id}";
                        $result_set=$dtb->query($sql);
            
                        while($result = $result_set->fetch_object()){
                            $gallery_title = $result->gallery_title;
                            $gallery_description = $result->gallery_description;
                            $visibility = $result->visibility;
                            $checked='';

                            if($visibility=='private'){
                                $checked = " checked ";
                            }
                        }
 ?>


<?php require 'includes/header_end.php'; ?>


    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Edit a Page</h4>
        </div>
    </div>
    <!-- end row -->



    <div class="row">
        <div class="col-md-12">
            <div class="card-box">

                <form method="post" action="edit_gallery_process.php" data-parsley-validate novalidate>
                    
                    <input type="hidden" name="gallery_id" value="<?php echo $gallery_id; ?>">
                    <div class="form-group">
                        <label for="page_title">Page Title<span class="text-danger">*</span></label>
                        <input type="text" name="gallery_title" parsley-trigger="change" required
                               placeholder="Enter Page Title" class="form-control" id="gallery_title" value="<?php echo $gallery_title; ?>">
                    </div>
  


                    <div class="form-group">
                        <label for="page_title">Visibility</label>
                        <input type="checkbox" <?php echo $checked; ?> name="visibility" data-plugin="switchery" data-color="#ff5d48" data-secondary-color="#1bb99a" />
                                    
                    </div>

                    <div class="form-group">
                        <label for="gallery_description">Description <em class="text-danger"> (Any color formating in this editror will reflect on site as is )</em></label>
                        <textarea name="gallery_description">
                            <?php echo $gallery_description; ?>
                        </textarea>
                    </div>

                    <div class="form-group text-right m-b-0">
                        <button class="btn btn-primary waves-effect waves-light" type="submit">
                            Save
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