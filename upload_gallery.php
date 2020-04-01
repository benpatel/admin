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

 while($result = $total_result->fetch_object()){
    $image_string = $result->images;
 }
$uploaded_files['images'] = array();
if($image_string!=''){
$uploaded_files['images'] = explode("|",$image_string);
}

$uploaded_files['images'] = array_reverse($uploaded_files['images']);

require 'includes/header_start.php'; 
 ?>


<?php require 'includes/header_end.php'; ?>


    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Add Photos to gallery</h4>
        </div>
    </div>
    <!-- end row -->



    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                    <button class="btn btn-success" id="uploadTrigger">Upload Photo</button>
                <form  action="upload.php" method="post" id="file_upload" enctype="multipart/form-data" data-parsley-validate novalidate>
                    
                    
                    <input type="hidden" value="<?php echo $gallery_id; ?>" name="gallery_id">
                    <input type="file" name="fileToUpload[]" class="hidden" multiple id="fileToUpload" style="visibility:hidden">

                    <div class="form-group">
                        <label for="page_title">Images</label>
                        <div id="uploaded_image_box">
                            <?php 
                            for($x=0; $x<count($uploaded_files['images']); $x++){
                            ?>

                           <div class="uploaded_image" data-img="<?php echo $uploaded_files['images'][$x] ?>" data-gallery="<?php echo $gallery_id; ?>"><p class="image_no"><?php echo $x; ?></p><img data-img="<?php echo $uploaded_files['images'][$x] ?>" src="scripts/image.php?width=300&amp;height:300&amp;cropratio=1:1&amp;image=<?php echo SITE_ADMIN; ?>gallery/<?php echo $uploaded_files['images'][$x] ?>" class="prd_images"><p class="delate_image"><span>Delete</span></p></div>

                           <?php } ?>

                             <div style="clear:both"></div>
                        </div>      
                    </div>
                    
                
                </form>

               

            </div>
        </div><!-- end col-->

    </div>
    <!-- end row -->



<?php require 'includes/footer_start.php' ?>
<script type="text/javascript" src="assets/plugins/jquery-ui/jquery-ui.js"></script>
<script type="text/javascript" src="assets/js/pic-upload.js"></script>
<!-- Validation js (Parsleyjs) -->
<script type="text/javascript" src="assets/plugins/parsleyjs/parsley.min.js"></script>
<script type="text/javascript">

    $("#uploaded_image_box").on("click",'.delate_image',function(){

        var gallery_id = $(this).parent('.uploaded_image').data("gallery");
        var image_name = $(this).parent('.uploaded_image').data("img");

        var data ={
                        'gallery_id':gallery_id,
                        'image_name':image_name,
                        'seller_id':<?php echo $seller_id; ?>
                    }


            $.ajax({
            url: "delete_image.php",
            method: "POST",
            data: data,
            dataType: "json",
            beforeSend:function(){

    
            }, 
            success: function(data){
                    if(data.status=='success'){
                        location.reload();
                    }   
            },
             error:function(){
              
              }
            });
      

    })
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('form').parsley();
        $( "#uploaded_image_box" ).sortable({
            update: function( event, ui ) {

            var image_data='';
            var x=1;
            var total = $(".prd_images").length;
            $(".prd_images").each(function(e){

                // banner_id = $(this).data("id");
                // data[x] = banner_id;
                // x--;
               
                 if(x==total){
                    image_data=$(this).data('img')+image_data;
                 }else{
                    image_data='|'+$(this).data('img')+image_data;
                }

                 x++;
            })

           
            
            var data = {
                        'image_order':image_data,
                        'gallery_id':<?php echo $gallery_id; ?>
                        
                    };
            
           
            $.ajax({
            url: "sort_pics.php",
            method: "POST",
            data: data,
            beforeSend:function(){

    
            }, 
            success: function(data){
                      
            },
             error:function(){
                    //location.reload();
              }
            });
                }
  });

    });
</script>
<?php require 'includes/footer_end.php' ?>