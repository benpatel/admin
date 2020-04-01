<?php 
include_once("init.php");
if($seller){ 
  redirect_to("index.php");
}
?>
<?php require 'includes/header_account.php'; ?>

    <div class="account-pages"></div>
    <div class="clearfix"></div>
    <div class="wrapper-page">

        <div class="account-bg">
            <div class="card-box mb-0">
                <div class="text-center m-t-20">
                    <a href="index.php" class="logo">
                        
                        <span>Admin Panel</span>
                    </a>
                </div>
                <div class="m-t-10 p-20">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h6 class="text-muted text-uppercase m-b-0 m-t-0">Sign In</h6>
                        </div>
                    </div>
                    <form class="m-t-20" action="login.php" method="post">

                        <div class="form-group row">
                            <div class="col-12">
                                
                                 <input type="email" name="email" placeholder="test@example.com" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                            
                                <input type="password" name="password" id="inputPassword" placeholder="Password" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <div class="checkbox checkbox-custom">
                                    <input id="checkbox-signup" type="checkbox">
                                    <label for="checkbox-signup">
                                        Remember me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-center row m-t-10">
                            <div class="col-12">
                                <button class="btn btn-success btn-block waves-effect waves-light" type="submit">Log In</button>
             
                            </div>
                        </div>

                        <div class="form-group row m-t-30 mb-0">
                            <div class="col-12">
                                <a href="forget_password.php" class="text-muted"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>
                            </div>
                        </div>


                    </form>

                </div>

                <div class="clearfix"></div>
            </div>
        </div>
        <!-- end card-box-->

    

    </div>
    <!-- end wrapper page -->



<?php require 'includes/footer_account.php'; ?>
