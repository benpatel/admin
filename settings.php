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
            <h4 class="page-title">Site Settings</h4>
        </div>
    </div>
    <!-- end row -->



    <div class="row">
      
                
    <div class="row">
    <div class="col-sm-4 col-xs-12">
        <div class="card m-b-20 card-body">
            <h5 class="card-title">Private Password</h5>
            <p class="card-text">This password is used to gain access to private pages and gallery</p>
            <button class="btn btn-primary" id="update_pass">Change Password</button>
        </div>
    </div>


    <div class="col-sm-4 col-xs-12">
        <div class="card m-b-20 card-body text-xs-center">
            <h5 class="card-title">Lock site</h5>
            <p class="card-text">This will lock the entire site for everybody, you can reactivate from admin pannel</p>
            <button class="btn btn-primary waves-effect waves-light" id="sa-warning"><?php if($locked){
                echo "Unlock Now";
            }else{
                echo "Lock Now";
            }?></button>
        </div>
    </div>

    <div class="col-sm-4 col-xs-12">
        <div class="card m-b-20 card-body text-xs-right">
            <h5 class="card-title">Subscribers</h5>
            <p class="card-text">Get emails of all subscribers.</p>
            <a href="subscribers.php" class="btn btn-primary">Get List</a>
        </div>
    </div>



    <div class="col-sm-4 col-xs-12">
        <div class="card m-b-20 card-body text-xs-right">
            <h5 class="card-title">Banners</h5>
            <p class="card-text">Manage Banners.</p>
            <a href="<?php echo SITE_BASE; ?>admin/banners.php" class="btn btn-primary">Manage Banners</a>
        </div>
    </div>
    
     <div class="col-sm-4 col-xs-12">
        <div class="card m-b-20 card-body text-xs-right">
            <h5 class="card-title">Update Account Details</h5>
            <p class="card-text">Change password and update email.</p>
            <button href="#" class="btn btn-primary">Update</button>
        </div>
    </div>
    

    </div>

  

    </div>
    <!-- end row -->

<div class="modal fade update_pass" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="rate_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mySmallModalLabel"><i class="text-warning fa fa-lg fa-warning"> &nbsp;</i> <span style=""> Change Password</span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="alert alert-danger" id="error_box" role="alert" style="display:none">
                         Change a few things up and try submitting
                        again.
                    </div>
                <form method="post" id="private_passs_form" data-parsley-validate novalidate>


                    <div class="form-group">
                        <label for="page_title">New Password</label>
                        <input type="text" name="private_password" id="private_passs" class="form-control" />
                    </div>
      
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="pass-edit-btn" data-id="">Update</button>
            </div>
        </div>
    </div>
</div>

<?php require 'includes/footer_start.php' ?>
<script type="text/javascript">

$("#update_pass").on("click",function(){
        $(".update_pass").modal('show');
    })
$("#pass-edit-btn").on("click",function(){
     var data = $("#private_passs_form").serialize() ;


            $.ajax({
            url: "edit_private_pass.php",
            method: "POST",
            data: data,
            dataType: "json",
            beforeSend:function(){

    
            }, 
            success: function(data){
                    if(data.status=='success'){
                        $('.update_pass').modal('hide');
                    }   
            },
             error:function(){
              
              }
            });
})
</script>
<?php require 'includes/footer_end.php' ?>