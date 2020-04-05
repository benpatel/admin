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
                <a class="btn btn-success btn-white-text waves-effect waves-light" href="add_page.php">
                                                   <span class="btn-label"><i class="fa fa-plus"></i>
                                                   </span>Add Page</a>
           

            </div>
            <h4 class="page-title">Manage Pages</h4>
        </div>
    </div>
    <!-- end row -->



    <div class="row">
        <div class="col-md-12">
            <div class="card-box">

        
                <table class="table table-hover">
                    <thead>
                        <tr>
                            
                            <th>Page Name </th>
                            <th style="width:150px;">Visibility</th>
                            <th  style="width:350px;" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
              

            	<?php
            			$sql = "select * from pages where seller_id={$seller_id}";
						$result_set=$dtb->query($sql);
				?>
						
							<?php
							        while($result = $result_set->fetch_object()){
							   ?>
							   <tr>
								   	<td><?php echo $result->page_title; ?> <i>(<?php echo $result->slug  ?></i>)</td>
								   	<td><?php echo ucfirst($result->visibility); ?></td>
								   	<td>


								   		<div class="button-list">
                                            <a class="btn btn-sm waves-effect btn-primary" href="sections.php?id=<?php echo $result->id; ?>"> <i class="fa  fa-edit">Manage content</i> </a>
					                        <a class="btn btn-sm waves-effect btn-warning" href="edit_page.php?id=<?php echo $result->id; ?>"> <i class="fa  fa-edit"> Edit</i> </a>
					                         <?php if($result->status=='unlocked'){ ?>
                                             <a class="btn btn-sm waves-effect btn-danger btn-delete-page" data-id="<?php echo $result->id; ?>">  <i class="fa fa-trash"> Delete</i> </a>
					                       <?php } else{
                                            ?>
                                                <a class="btn btn-sm waves-effect btn-secondary btn-warning-page" >  <i class="fa fa-lock"> Locked</i> </a>
                                            <?php
                                           }?>
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

                <div class="modal fade delete-page-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="mySmallModalLabel"><i class="text-warning fa fa-lg fa-warning"></i> <span style="color:red">Delete Page</span></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Page will be deleted permanently</p>
                                <p>All Sections belongs to this page will be deleted as well!</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary" id="page-delete-btn" data-id="">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>

            <div class="modal fade locked-page-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="mySmallModalLabel"><i class="text-warning fa fa-lg fa-warning"></i> <span style="color:red">Action Restricted</span></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>This page is an important part of the design, page can not be deleted!</p>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            
                            </div>
                        </div>
                    </div>
                </div>

<?php require 'includes/footer_start.php' ?>
<script type="text/javascript">

    $(".btn-warning-page").on("click",function(){
        $(".locked-page-modal").modal('show');
    
    })

	$(".btn-delete-page").on("click",function(){
		$(".delete-page-modal").modal('show');
		$("#page-delete-btn").data('id',$(this).data('id'));
	})

	$("#page-delete-btn").on("click",function(){
		var data ={
						'seller_id':<?php echo $seller_id; ?>,
						'page_id':$(this).data('id')
					}


			$.ajax({
		    url: "delete_page.php",
		    method: "POST",
		    data: data,
		    dataType: "json",
		    beforeSend:function(){

	
		    }, 
		    success: function(data){
					if(data.status=='success'){
						$('.delete-page-modal').modal('hide');
						$("#page-delete-btn").data('id','');
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