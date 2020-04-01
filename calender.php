<?php 
include_once("init.php");
require 'includes/header_start.php'; ?>

    <!--calendar css-->
    <link href="assets/plugins/fullcalendar/css/fullcalendar.min.css" rel="stylesheet" />

<?php require 'includes/header_end.php'; ?>


    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="btn-group pull-right m-t-15">
                <button type="button" class="btn btn-custom dropdown-toggle waves-effect waves-light"
                        data-toggle="dropdown" aria-expanded="false">Settings <span class="m-l-5"><i
                            class="fa fa-cog"></i></span></button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Separated link</a>
                </div>

            </div>
            <h4 class="page-title">Calendar</h4>
        </div>
    </div>
    <!-- end row -->


    <div class="row">
        <div class="col-12">

            <div class="card-box">
                <div class="row">
                    
                    <div class="col-md-12">
                        <div id="calendar"></div>
                    </div> <!-- end col -->
                </div>  <!-- end row -->
            </div>

            <!-- BEGIN MODAL -->
            <div class="modal fade none-border" id="event-modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Tour City</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body p-20"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success save-event waves-effect waves-light">Create event</button>
                            <button type="button" class="btn btn-danger delete-event waves-effect waves-light" data-dismiss="modal">Delete</button>
                        </div>
                    </div>
                </div>
            </div>

    
        </div>
        <!-- end col-12 -->
    </div> <!-- end row -->



<?php require 'includes/footer_start.php' ?>

    <!-- Jquery-Ui -->
    <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- BEGIN PAGE SCRIPTS -->
    <script src="assets/plugins/moment/moment.js"></script>
    <script src='assets/plugins/fullcalendar/js/fullcalendar.min.js'></script>
    <script src="assets/pages/new_calender.js"></script>


<?php require 'includes/footer_end.php' ?>