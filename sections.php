<?php 
include_once("init.php");
if(!$seller){ 
  redirect_to("signin.php");
}

$page_id = $_GET['id'];

$total_result = $dtb->query("select * from pages where seller_id={$seller_id} and id={$page_id}");
$total_row =$dtb->num_rows($total_result);
if($total_row !=1){
    redirect_to("logout.php");
}

$sql = "select * from pages where seller_id={$seller_id} and id={$page_id}";
                        $result_set=$dtb->query($sql);

while($result = $result_set->fetch_object()){
    $page_title = $result->page_title;
    $page_description = $result->page_description;
    $visibility = $result->visibility;
    $page_image = $result->page_image;
    $page_subtitle = $result->page_subtitle;
    $checked='';
    $status = $result->status;

    if($visibility=='private'){
        $checked = " checked ";
    }
}
require 'includes/header_start.php'; 
 ?>


<?php require 'includes/header_end.php'; ?>


    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="pull-right m-t-15">

                <a class="btn btn-success btn-white-text waves-effect waves-light" href="add_section.php?id=<?php echo $page_id; ?>">
                                                   <span class="btn-label"><i class="fa fa-plus"></i>
                                                   </span>Add Section</a>

                <a class="btn btn-warning btn-white-text waves-effect waves-light" href="pages.php">
                                                   <span class="btn-label"><i class="fa fa-arrow-left"></i>
                                                   </span>Back To Pages</a>
           

            </div>
            <h4 class="page-title">Page : <?php echo $page_title; ?>  </h4>

        </div>
    </div>
    <!-- end row -->



    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <div class="sections_box">


                <?php
                        $sql = "select * from sections where seller_id={$seller_id} and page_id={$page_id}";
                        $result_set=$dtb->query($sql);
                        while($result = $result_set->fetch_object()){
                ?>

                    <div class="section_title">
                        <h4><?php echo $result->section_title; ?> <i>(<?php echo $result->id; ?>)</i></h4>
                        <p><?php echo $result->section_subtitle; ?></p>

                        <div class="section_control">
                            <a href="edit_section.php?id=<?php echo $page_id; ?>&section=<?php echo $result->id; ?>" class="btn btn-warning">Edit</a>
                            <button  class="btn-delete-section btn btn-danger" data-id="<?php echo $result->id; ?>">Delete</button>
                        </div>
                    </div>
                    <div class="section_single">
                        <div class="section_image">

                    <?php 
$result->section_image !='' ? $section_image = SITE_ADMIN."banners/".$section_image= $result->section_image : $section_image = SITE_ADMIN."assets/images/section_image.jpg"; 
                    ?>
                          <img src="<?php echo SITE_ADMIN; ?>scripts/image.php?width=340&cropratio=1:0.6&image=<?php echo $section_image; ?>" /> 
                        </div>
                        <div class="section_data">
                        
                            <p><?php echo $result->section_description; ?></p>
                        </div>
                        
                    </div>

                <?php
                        }
                ?>
                </div>

            </div>
        </div><!-- end col-->

    </div>
    <!-- end row -->

<div class="modal fade delete-section-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="mySmallModalLabel"><i class="text-warning fa fa-lg fa-warning"></i> <span style="color:red">Delete Page</span></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>This section will be deleted permanently</p>
                               
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary" id="section-delete-btn" data-id="">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>

<?php require 'includes/footer_start.php' ?>

<script type="text/javascript">


    $(".btn-delete-section").on("click",function(){
        console.log($(this).data('id'));
        $(".delete-section-modal").modal('show');
        $("#section-delete-btn").data('id',$(this).data('id'));
    })

    $("#section-delete-btn").on("click",function(){
        var data ={
                        'seller_id':<?php echo $seller_id; ?>,
                        'page_id':<?php echo $page_id; ?>,
                        'section_id':$(this).data('id'),

                    }


            $.ajax({
            url: "delete_section.php",
            method: "POST",
            data: data,
            dataType: "json",
            beforeSend:function(){

    
            }, 
            success: function(data){
                    if(data.status=='success'){
                        $('.delete-section-modal').modal('hide');
                        $("#section-delete-btn").data('id','');
                        location.reload();
                    }   
            },
             error:function(){
              
              }
            });
        console.log(data);
    })
</script>
<?php require 'includes/footer_end.php' ?>