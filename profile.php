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
                        id="add_faq">Add Details <span class="m-l-5"><i
                            class="fa fa-plus"></i></span></button>
            </div>

            <h4 class="page-title">Profile Manager</h4>
        </div>
    </div>
    <!-- end row -->



    <div class="row">
        <div class="col-md-12">
            <div class="card-box">


                <div  id="profile_spec" >
                <?php
                        $sql = "select * from profile where seller_id={$seller_id} order by pos desc";
                        $result_set=$dtb->query($sql);
                ?>
                        
                            <?php
                                    while($result = $result_set->fetch_object()){
                               ?>
                               <div class="profile_detail" data-profile="<?php echo $result->id; ?>" id="faq-id-<?php echo $result->id;?>">
                                    <table class="table table-hover">
                                        <tr> <td class="faqer">
                                        <h3 class="que"><?php echo ucfirst($result->que); ?></h3>
                                        <p class="ans"><?php echo ucfirst($result->ans); ?></p>
                                            
                                    </td>
                                    <td style=" width: 200px;">


                                        <div class="button-list">
                                            <button class="btn btn-sm waves-effect btn-warning btn-edit-faq" data-id="<?php echo $result->id; ?>"> <i class="fa  fa-edit"> Edit</i> </button>
                                             
                                             <button class="btn btn-sm waves-effect btn-danger btn-delete-faq" data-id="<?php echo $result->id; ?>">  <i class="fa fa-trash"> Delete</i> </button>
                                         
                                        </div>
                                    </td>
                                </tr>
                            </table>
                               </div>
                               <?php
                                  

                                    }
                            ?>
                        
                </div>
            </div>
        </div><!-- end col-->

    </div>
    <!-- end row -->



<div class="modal fade add-faq-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="faq_modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mySmallModalLabel"><i class="text-warning fa fa-lg fa-edit"> &nbsp;</i> <span style=""> Profile Spec</span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="alert alert-danger" id="error_box" role="alert" style="display:none">
                         Change a few things up and try submitting
                        again.
                    </div>
                <form method="post" id="faq_form">
                    
                    
                    <input type="hidden" id="faq_id" name="profile_id" value=""> 
                   
  
                    <div class="form-group">
                        <label for="faq_disclaimer">Question<span class="text-danger">*</span></label>
                        <input type="text" name="que" parsley-trigger="change"
                               placeholder="Faq Question" class="form-control" id="que">
                    </div>


                    <div class="form-group">
                        <label for="page_title">Answer</label>
                        <textarea name="ans" id="ans" class="form-control" ></textarea>
                    </div>
      
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="faq-add-btn" data-id="">Add</button>
                <button type="button" class="btn btn-primary" id="faq-edit-btn" data-id="">Update</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade delete-faq-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mySmallModalLabel"><i class="text-warning fa fa-lg fa-warning"></i> <span style="color:red">Profile Spec</span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Profile Spec will be deleted permanently</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="faq-delete-btn" data-id="">Delete</button>
            </div>
        </div>
    </div>
</div>

<?php require 'includes/footer_start.php' ?>

<script type="text/javascript">
    $("#add_faq").on("click",function(){
        $(".add-faq-modal").modal('show');
        $("#error_box").hide();
        $("#faq-edit-btn").hide();
        $("#faq-add-btn").show();
    })

    $(".btn-edit-faq").on("click",function(){
        var faq_id = $(this).data('id');
        $(".add-faq-modal").modal('show');
        $("#error_box").hide();

        $("#faq_id").val(faq_id);
        $("#ans").val($("#faq-id-"+faq_id+" .ans").text());
        $("#que").val($("#faq-id-"+faq_id+" .que").text());
        $("#faq-add-btn").hide();
        $("#faq-edit-btn").show();
    })

    $("#faq-add-btn").on("click",function(){

        if($("#faq_form").parsley().validate())
        {
         var data = $("#faq_form").serialize() ;

            $.ajax({
            url: "add_profile_process.php",
            method: "POST",
            data: data,
            dataType: "json",
            beforeSend:function(){

    
            }, 
            success: function(data){
                    if(data.status=='success'){
                        $('.add-faq-modal').modal('hide');
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

    $("#faq-edit-btn").on("click",function(){
         var data = $("#faq_form").serialize() ;
         if($("#faq_form").parsley().validate())
        {
            $.ajax({
            url: "edit_profile_process.php",
            method: "POST",
            data: data,
            dataType: "json",
            beforeSend:function(){

    
            }, 
            success: function(data){

                    if(data.status=='success'){
                        $('.add-faq-modal').modal('hide');
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

    $(".btn-delete-faq").on("click",function(){
        var faq_id = $(this).data('id');
        console.log(faq_id);
        $(".delete-faq-modal").modal('show');
        $("#faq-delete-btn").data('id',$(this).data('id'));

    })

    $("#faq-delete-btn").on("click",function(){
        var data ={
                        'seller_id':<?php echo $seller_id; ?>,
                        'profile_id':$(this).data('id')
                    }


            $.ajax({
            url: "delete_profile.php",
            method: "POST",
            data: data,
            dataType: "json",
            beforeSend:function(){

    
            }, 
            success: function(data){
                    if(data.status=='success'){
                        $('.delete-page-modal').modal('hide');
                        $("#faq-delete-btn").data('id','');
                        location.reload();
                    }   
            },
             error:function(){
              
              }
            });


    })
</script>

<!-- Validation js (Parsleyjs) -->
<script type="text/javascript" src="assets/plugins/jquery-ui/jquery-ui.js"></script>
<script type="text/javascript" src="assets/plugins/parsleyjs/parsley.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('form').parsley();

        $( "#profile_spec" ).sortable({


            update: function( event, ui ) {

                profile_order = [];

               $(".profile_detail").each(function(e){
                    

                    profile_order.push($(this).data("profile"));
               });
                
            var data = {profile_order: profile_order};
            
           
            $.ajax({
            url: "order_profile.php",
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