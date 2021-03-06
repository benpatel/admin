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
                        id="add_rates">Add Donation <span class="m-l-5"><i
                            class="fa fa-plus"></i></span></button>

            </div>

            <h4 class="page-title">Donation</h4>
        </div>
    </div>
    <!-- end row -->
<?php
$sqlc="select `city` from rates where city !='Home City' and seller_id={$seller_id} GROUP by city";
$result_setc=$dtb->query($sqlc);

while($resultc = $result_setc->fetch_object()){

     $curr_city = $resultc->city;
?>

    <div class="row">
        <div class="col-md-12">
            <div class="card-box">


                <h3 class="text-center"><?php echo $curr_city; ?></h3>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            
                            <th style="width:200px;">Duration</th>
                            <th >Short Note</th>
                            <th  style="width:250px;">Rate</th>
                            <th style="width:250px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        
              

                <?php
           
                   
                        $sql = "select * from rates where seller_id={$seller_id} and city ='{$curr_city}' order by city, duration asc";

                      
                        $result_set=$dtb->query($sql);
                ?>
                        
                            <?php
                                    while($result = $result_set->fetch_object()){
                               ?>
                               <tr id="rate-id-<?php echo $result->id;?>">
                                    
                                    <td>
                                        <div style="visibility:hidden;height:0px; width:0px;">
                                            <p class="rate_amount"><?php echo $result->amount; ?></p>
                                            <p class="rate_duration"><?php echo $result->duration; ?></p>
                                            <p class="rate_disclaimer"><?php echo $result->disclaimer; ?></p>
                                            <p class="city_name"><?php echo $result->city; ?></p>
                                            <p class="rate_description"><?php echo $result->description; ?></p>
                                            <p></p>
                                        </div>
                                        <?php echo $result->duration; ?> Hour</td>
                                    <td><?php echo ucfirst($result->disclaimer); ?></td>
                                    <td><?php echo $result->amount; ?></td>
                                    <td>


                                        <div class="button-list">
                                            <button class="btn btn-sm waves-effect btn-warning btn-edit-rate" data-id="<?php echo $result->id; ?>"> <i class="fa  fa-edit"> Edit</i> </a>
                                             
                                             <button class="btn btn-sm waves-effect btn-danger btn-delete-rate" data-id="<?php echo $result->id; ?>">  <i class="fa fa-trash"> Delete</i> </a>
                                         
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
<?php
}
?>


<div class="modal fade add-rate-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="rate_modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mySmallModalLabel"><i class="text-warning fa fa-lg fa-money"> &nbsp;</i> <span style=""> Add Donation</span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="alert alert-danger" id="error_box" role="alert" style="display:none">
                         Change a few things up and try submitting
                        again.
                    </div>
                <form method="post" id="rate_form" data-parsley-validate novalidate>
                    
                    <div class="form-group">
                        <label for="city_name">City<span class="text-danger">*</span></label>
                        <input type="text" name="city_name" required parsley-trigger="change"
                               placeholder="City Name" class="form-control" id="city_name">
                    </div>

                    <div class="form-group">
                        <label for="rate_duration">Duration</label>
                        <select class="form-control" name="rate_duration" id="rate_duration">
                            <option value="1">1 Hour</option>
                            <option value="1.5">1.5 Hours</option>
                            <option value="2">2 Hours</option>
                            <option value="3">3 Hours</option>
                            <option value="4">4 Hours</option>
                            <option value="6">6 Hours</option>
                            <option value="8">8 Hours</option>
                            <option value="12">12 Hours</option>
                            <option value="24">24 Hurs</option>
                            <option value="48">Weekend Gateway</option>
                        </select>
                    </div>
                    <input type="hidden" id="rate_id" name="rate_id" val=""> 
                    <div class="form-group">
                        <label for="amount">Amount<span class="text-danger">*</span></label>
                        <input type="text" name="amount" parsley-trigger="change" required
                               placeholder="Enter amount" class="form-control" id="amount">
                    </div>
  
                    <div class="form-group">
                        <label for="rate_disclaimer">Short Note<span class="text-danger">*</span></label>
                        <input type="text" name="rate_disclaimer" parsley-trigger="change"
                               placeholder="Fine detail about rate" class="form-control" id="rate_disclaimer">
                    </div>


                    <div class="form-group">
                        <label for="page_title">Description</label>
                        <textarea name="rate_description" id="rate_description" class="form-control" ></textarea>
                    </div>
      
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="rate-add-btn" data-id="">Add</button>
                <button type="button" class="btn btn-primary" id="rate-edit-btn" data-id="">Update</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade delete-rate-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mySmallModalLabel"><i class="text-warning fa fa-lg fa-warning"></i> <span style="color:red">Delete Rate</span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Rate will be deleted permanently</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="rate-delete-btn" data-id="">Delete</button>
            </div>
        </div>
    </div>
</div>

<?php require 'includes/footer_start.php' ?>

<script type="text/javascript">
    $("#add_rates").on("click",function(){
        $(".add-rate-modal").modal('show');
        $("#error_box").hide();
        $("#rate-edit-btn").hide();
        $('#rate_form').trigger("reset");
        $("#rate-add-btn").show();
    })

    $(".btn-edit-rate").on("click",function(){
        var rate_id = $(this).data('id');
        $(".add-rate-modal").modal('show');
        $("#error_box").hide();

        $("#amount").val($("#rate-id-"+rate_id+" .rate_amount").text());
        $("#rate_id").val(rate_id);
        $("#rate_duration").val($("#rate-id-"+rate_id+" .rate_duration").text());
        $("#rate_disclaimer").val($("#rate-id-"+rate_id+" .rate_disclaimer").text());
        $("#city_name").val($("#rate-id-"+rate_id+" .city_name").text());
        $("#rate_description").val($("#rate-id-"+rate_id+" .rate_description").text());
        $("#rate-add-btn").hide();
        $("#rate-edit-btn").show();
    })

    $("#rate-add-btn").on("click",function(){

        if($("#rate_form").parsley().validate())
        {
         var data = $("#rate_form").serialize() ;

            $.ajax({
            url: "add_rate_process.php",
            method: "POST",
            data: data,
            dataType: "json",
            beforeSend:function(){

    
            }, 
            success: function(data){
                    if(data.status=='success'){
                        $('.add-rate-modal').modal('hide');
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

    $("#rate-edit-btn").on("click",function(){
         var data = $("#rate_form").serialize() ;
         if($("#rate_form").parsley().validate())
        {
            $.ajax({
            url: "edit_rate_process.php",
            method: "POST",
            data: data,
            dataType: "json",
            beforeSend:function(){

    
            }, 
            success: function(data){

                    if(data.status=='success'){
                        $('.add-rate-modal').modal('hide');
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

    $(".btn-delete-rate").on("click",function(){
        var rate_id = $(this).data('id');
        console.log(rate_id);
        $(".delete-rate-modal").modal('show');
        $("#rate-delete-btn").data('id',$(this).data('id'));

    })

    $("#rate-delete-btn").on("click",function(){
        var data ={
                        'seller_id':<?php echo $seller_id; ?>,
                        'rate_id':$(this).data('id')
                    }


            $.ajax({
            url: "delete_rate.php",
            method: "POST",
            data: data,
            dataType: "json",
            beforeSend:function(){

    
            }, 
            success: function(data){
                    if(data.status=='success'){
                        $('.delete-page-modal').modal('hide');
                        $("#rate-delete-btn").data('id','');
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