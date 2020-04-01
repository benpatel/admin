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

            <div class="btn-group pull-right m-t-15">
                <button type="button" class="btn btn-success waves-effect waves-light"
                        id="add_review">Add Review <span class="m-l-5"><i
                            class="fa fa-plus"></i></span></button>

            </div>

            <h4 class="page-title">Reviews</h4>
        </div>
    </div>
    <!-- end row -->



    <div class="row">
        <div class="col-md-12">
            <div class="card-box">



                <table class="table table-hover">
                    <thead>
                        <tr>
                            
                            <th style="width:200px;">Rewiewer</th>
                            <th >Review Site</th>
                            <th  style="width:250px;">Review</th>
                            <th style="width:250px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        
              

                <?php
                        $sql = "select * from reviews where seller_id={$seller_id} order by id asc";
                        $result_set=$dtb->query($sql);
                ?>
                        
                            <?php
                                    while($result = $result_set->fetch_object()){
                               ?>
                               <tr id="review-id-<?php echo $result->id;?>">
                                    <td class="reviewer"><?php echo ucfirst($result->reviewer); ?></td>
                                    <td class="site"><?php echo ucfirst($result->site); ?></td>
                                    <td class="review_description"><?php echo $result->review_description; ?></td>
                                    <td>


                                        <div class="button-list">
                                            <button class="btn btn-sm waves-effect btn-warning btn-edit-review" data-id="<?php echo $result->id; ?>"> <i class="fa  fa-edit"> Edit</i> </a>
                                             
                                             <button class="btn btn-sm waves-effect btn-danger btn-delete-review" data-id="<?php echo $result->id; ?>">  <i class="fa fa-trash"> Delete</i> </a>
                                         
                                        </div>
                                    </td>
                               </tr>
                               <?php
                                  

                                    }
                            ?>
                        
                    </tbody>
                </table>


            </div>
        </div><!-- end col-->

    </div>
    <!-- end row -->



<div class="modal fade add-review-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="review_modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mySmallModalLabel"><i class="text-warning fa fa-lg fa-edit"> &nbsp;</i> <span style=""> Add Review</span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="alert alert-danger" id="error_box" role="alert" style="display:none">
                         Change a few things up and try submitting
                        again.
                    </div>
                <form method="post" id="review_form">
                    
                    
                    <input type="hidden" id="review_id" name="review_id" value=""> 
                    <div class="form-group">
                        <label for="reviewer">Reviewer<span class="text-danger">*</span></label>
                        <input type="text" name="reviewer" parsley-trigger="change" required
                               placeholder="Enter Reviewer Name" class="form-control" id="reviewer">
                    </div>
  
                    <div class="form-group">
                        <label for="review_disclaimer">Rewiew Site<span class="text-danger">*</span></label>
                        <input type="text" name="site" parsley-trigger="change"
                               placeholder="Fine detail abour review" class="form-control" id="site">
                    </div>


                    <div class="form-group">
                        <label for="page_title">Description</label>
                        <textarea name="review_description" id="review_description" class="form-control" ></textarea>
                    </div>
      
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="review-add-btn" data-id="">Add</button>
                <button type="button" class="btn btn-primary" id="review-edit-btn" data-id="">Update</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade delete-review-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mySmallModalLabel"><i class="text-warning fa fa-lg fa-warning"></i> <span style="color:red">Delete review</span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>review will be deleted permanently</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="review-delete-btn" data-id="">Delete</button>
            </div>
        </div>
    </div>
</div>

<?php require 'includes/footer_start.php' ?>

<script type="text/javascript">
    $("#add_review").on("click",function(){
        $(".add-review-modal").modal('show');
        $("#error_box").hide();
        $("#review-edit-btn").hide();
        $("#review-add-btn").show();
    })

    $(".btn-edit-review").on("click",function(){
        var review_id = $(this).data('id');
        $(".add-review-modal").modal('show');
        $("#error_box").hide();

        $("#review_id").val(review_id);
        $("#site").val($("#review-id-"+review_id+" .site").text());
        $("#reviewer").val($("#review-id-"+review_id+" .reviewer").text());
        $("#review_description").val($("#review-id-"+review_id+" .review_description").text());
        $("#review-add-btn").hide();
        $("#review-edit-btn").show();
    })

    $("#review-add-btn").on("click",function(){

        if($("#review_form").parsley().validate())
        {
         var data = $("#review_form").serialize() ;

            $.ajax({
            url: "add_review_process.php",
            method: "POST",
            data: data,
            dataType: "json",
            beforeSend:function(){

    
            }, 
            success: function(data){
                    if(data.status=='success'){
                        $('.add-review-modal').modal('hide');
                        location.reload();
                    }  
                    if(data.status=='error'){
                        $("#error_box").show();
                        $("#error_box").text(data.error);
                    } 
            },
             error:function(){
              
              }
            });
      }
    })

    $("#review-edit-btn").on("click",function(){
         var data = $("#review_form").serialize() ;
         if($("#review_form").parsley().validate())
        {
            $.ajax({
            url: "edit_review_process.php",
            method: "POST",
            data: data,
            dataType: "json",
            beforeSend:function(){

    
            }, 
            success: function(data){

                    if(data.status=='success'){
                        $('.add-review-modal').modal('hide');
                        location.reload();
                    }
                    if(data.status=='error'){
                        $("#error_box").show();
                        $("#error_box").text(data.error);
                    }   
            },
             error:function(){
              
              }
            });
        }
    })

    $(".btn-delete-review").on("click",function(){
        var review_id = $(this).data('id');
        console.log(review_id);
        $(".delete-review-modal").modal('show');
        $("#review-delete-btn").data('id',$(this).data('id'));

    })

    $("#review-delete-btn").on("click",function(){
        var data ={
                        'seller_id':<?php echo $seller_id; ?>,
                        'review_id':$(this).data('id')
                    }


            $.ajax({
            url: "delete_review.php",
            method: "POST",
            data: data,
            dataType: "json",
            beforeSend:function(){

    
            }, 
            success: function(data){
                    if(data.status=='success'){
                        $('.delete-page-modal').modal('hide');
                        $("#review-delete-btn").data('id','');
                        location.reload();
                    }   
            },
             error:function(){
              
              }
            });
    })
</script>

<!-- Validation js (Parsleyjs) -->
<script type="text/javascript" src="assets/plugins/parsleyjs/parsley.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('form').parsley();
    });
</script>

<?php require 'includes/footer_end.php' ?>