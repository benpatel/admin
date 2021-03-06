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
                <a class="btn btn-success btn-white-text waves-effect waves-light" href="add_gallery.php">
                                                   <span class="btn-label"><i class="fa fa-plus"></i>
                                                   </span>Add Gallery</a>
           

            </div>
            <h4 class="page-title">Manage Gallery</h4>
        </div>
    </div>
    <!-- end row -->



    <div class="row">
        <div class="col-md-12">
            <div class="card-box">

        
                <table class="table table-hover">
                    <thead>
                        <tr>
                            
                            <th>Gallery Name</th>
                            <th style="width:150px;">Visibility</th>
                            <th  style="width:350px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
              

            	<?php
            			$sql = "select * from gallery where seller_id={$seller_id}";
						$result_set=$dtb->query($sql);
				?>
						
							<?php
							        while($result = $result_set->fetch_object()){
							   ?>
							   <tr>
								   	<td><?php echo $result->gallery_title; ?></td>
								   	<td><?php echo ucfirst($result->visibility); ?></td>
								   	<td>


								   		<div class="button-list">
                                            <a class="btn btn-sm waves-effect btn-primary" href="upload_gallery.php?id=<?php echo $result->id; ?>"> <i> Manage Images</i> </a>
					                        <a class="btn btn-sm waves-effect btn-warning" href="edit_gallery.php?id=<?php echo $result->id; ?>"> <i class="fa  fa-edit"> Edit</i> </a>
					                         <a class="btn btn-sm waves-effect btn-danger btn-delete-gallery" data-id="<?php echo $result->id; ?>">  <i class="fa fa-trash"> Delete</i> </a>
					                       
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

                <div class="modal fade delete-gallery-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="mySmallModalLabel"><i class="text-warning fa fa-lg fa-warning"></i> <span style="color:red">Delete gallery</span></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>gallery will be deleted permanently</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary" id="gallery-delete-btn" data-id="">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>

<?php require 'includes/footer_start.php' ?>
<script type="text/javascript">
    $(".btn-delete-gallery").on("click",function(){
        $(".delete-gallery-modal").modal('show');
        $("#gallery-delete-btn").data('id',$(this).data('id'));
    })

    $("#gallery-delete-btn").on("click",function(){
        var data ={
                        'seller_id':<?php echo $seller_id; ?>,
                        'gallery_id':$(this).data('id')
                    }


            $.ajax({
            url: "delete_gallery.php",
            method: "POST",
            data: data,
            dataType: "json",
            beforeSend:function(){

    
            }, 
            success: function(data){
                    if(data.status=='success'){
                        $('.delete-gallery-modal').modal('hide');
                        $("#gallery-delete-btn").data('id','');
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