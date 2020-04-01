<?php 
include_once("init.php");
if(!$seller){ 
  redirect_to("signin.php");
}
require 'includes/header_start.php'; 
 ?>


<?php require 'includes/header_end.php'; ?>


    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Subscribers</h4>
            <p>Unsubscribe Link : <?php echo SITE_BASE; ?>unsubscribe.php</p>
        </div>
    </div>
    <!-- end row -->



    <div class="row">
        <div class="col-md-12">
            <div class="card-box">


               <?php
                        $sql = "select * from subscriber where seller_id={$seller_id}";
                        $result_set=$dtb->query($sql);
            
                                    while($result = $result_set->fetch_object()){
                    ?>
                    <p><?php echo $result->email; ?>,</p>
                    <?php
                                    }
                               ?>


            </div>
        </div><!-- end col-->

    </div>
    <!-- end row -->



<?php require 'includes/footer_start.php' ?>

<?php require 'includes/footer_end.php' ?>