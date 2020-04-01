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
            <div class="pull-right m-t-15">
                <a class="btn btn-success btn-white-text waves-effect waves-light" href="add_friend.php">
                                                   <span class="btn-label"><i class="fa fa-plus"></i>
                                                   </span>Add Friend</a>
           

            </div>
            <h4 class="page-title">Manage Friends</h4>
        </div>
    </div>
    <!-- end row -->



    <div class="row">
        <div class="col-md-12">
            <div class="card-box" id="uploaded_banner_box">

        
              

            	<?php
            			$sql = "select * from friends where seller_id={$seller_id} order by sort desc";
						$result_set=$dtb->query($sql);
				?>
						
							<?php
                                $x=1;
							        while($result = $result_set->fetch_object()){
							   ?>
							   <div class="banner_image" style="text-align: left;border:solid 1px #ccc; padding:5px;">
                                <p><?php echo $result->name; ?></p>
                                <img class="ban-images" data-id="<?php echo $result->id; ?>" src="<?php echo SITE_BASE.'admin/banners/'.$result->banner;?> " style="padding:5px; ">
                                <p><a href="edit_friend.php?id=<?php echo $result->id; ?>" class="btn btn-secondary">Edit</a> <span  class="btn btn-danger btn-delete-banner" data-id="<?php echo $result->id; ?>">Delete</span></p>
                               </div>
							   <?php
							      $x++;

							        }
			        		?>
      
         


            </div>
        </div><!-- end col-->

    </div>

                <div class="modal fade delete-banner-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="mySmallModalLabel"><i class="text-warning fa fa-lg fa-warning"></i> <span style="color:red">Delete Banner</span></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Banner will be deleted permanently</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary" id="banner-delete-btn" data-id="">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>

<?php require 'includes/footer_start.php' ?>
<script type="text/javascript" src="assets/plugins/jquery-ui/jquery-ui.js"></script>
<script type="text/javascript">
    $(".btn-delete-banner").on("click",function(){
        $(".delete-banner-modal").modal('show');
        $("#banner-delete-btn").data('id',$(this).data('id'));
    })

    $("#banner-delete-btn").on("click",function(){
        var data ={
                        
                        'banner_id':$(this).data('id')
                    }


            $.ajax({
            url: "delete_friend.php",
            method: "POST",
            data: data,
            dataType: "json",
            beforeSend:function(){

    
            }, 
            success: function(data){
                    if(data.status=='success'){
                        $('.delete-banner-modal').modal('hide');
                        $("#banner-delete-btn").data('id','');
                        location.reload();
                    }   
            },
             error:function(){
              
              }
            });
        console.log(data);
    })

    $( "#uploaded_banner_box" ).sortable({
            update: function( event, ui ) {

            var banner_data='';
            var x=1;
            var total = $(".ban-images").length;
            $(".ban-images").each(function(e){

                // banner_id = $(this).data("id");
                // data[x] = banner_id;
                // x--;
               
                 if(x==total){
                    banner_data=$(this).data('id')+banner_data;
                 }else{
                    banner_data='|'+$(this).data('id')+banner_data;
                }

                 x++;
            })

           
            
            var data = {
                        'banner_order':banner_data,
                        
                    };
            
           
            $.ajax({
            url: "sort_friends.php",
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

</script>

<?php require 'includes/footer_end.php' ?>