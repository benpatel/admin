<?php 
include_once("init.php");
if(!$seller){ 
  redirect_to("login.php");
}
if(isset($_GET['action'])){
$action = $_GET['action'];    
}else{
    $action ="profile";
}

switch ($action) {
    case 'profile':
            {
                
            }
        break;
    case 'rates':
            {
                
            }
        break;
    case 'images':
            {
                
            }
        break;
    default:
            {
              redirect_to("logout.php");  
            }
}


require 'includes/header_start.php'; 
 ?>
    <!--Form Wizard-->
    <link rel="stylesheet" type="text/css" href="assets/plugins/jquery.steps/demo/css/jquery.steps.css" />

<?php require 'includes/header_end.php'; ?>


    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Profile Set Up</h4>
        </div>
    </div>
    <!-- end row -->



    <div class="row">
        <div class="col-md-8">
            <div class="card-box">



                <div class="card m-b-20">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                                <li class="nav-item">
                                    <a class="nav-link <?php if($action=="profile") { echo 'active'; } ?>" href="add_profile.php?action=profile">Profile Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link  <?php if($action=="rates") { echo "active"; } ?>"  href="add_profile.php?action=rates">Rates</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link  <?php if($action=="images") { echo "active"; } ?>"  href="add_profile.php?action=images">Pictures</a>
                                </li>
                                
                            </ul>
                    </div>
                    <div class="card-body">

                        <?php
                            switch ($action) {
                                case 'profile':
                                        {
                                            include("profile/profile.php");
                                        }
                                    break;
                                case 'rates':
                                        {
                                            
                                        }
                                    break;
                                case 'images':
                                        {
                                            
                                        }
                                    break;
                                default:
                                        {
                                          redirect_to("logout.php");  
                                        }
                            }

                        ?>
                        
                    </div>
                </div>
                <!-- end row -->

            </div>
        </div><!-- end col-->

        <div class="col-md-4">
        </div>

    </div>
    <!-- end row -->



<?php require 'includes/footer_start.php' ?>


    <!-- Validation js (Parsleyjs) -->
    <script type="text/javascript" src="assets/plugins/parsleyjs/parsley.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('form').parsley();
        });
    </script>


<?php require 'includes/footer_end.php' ?>