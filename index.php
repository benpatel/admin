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
            <h4 class="page-title">Dashboard</h4>
        </div>
    </div>
    <!-- end row -->



    <div class="row">
        <div class="col-md-12">
            <div class="card-box">


                <p class="text-center">Pages, Gallery and rates are avaialbe to change, more changes are coming Soon.....</p>


            </div>
        </div><!-- end col-->

    </div>
    <!-- end row -->



<?php require 'includes/footer_start.php' ?>

<?php require 'includes/footer_end.php' ?>