<!-- Navigation Bar-->
<header id="topnav">
    <div class="topbar-main">
        <div class="container">

            <!-- LOGO -->
            <div class="topbar-left">
                <a href="index.php" class="logo">
                    <i class="zmdi zmdi-group-work icon-c-logo"></i>
                    <span>Website Manager</span>
                </a>
            </div>
            <!-- End Logo container-->


            <div class="menu-extras navbar-topbar">

                <ul class="list-inline float-right mb-0">

                    <li class="list-inline-item">
                        <!-- Mobile menu toggle-->
                        <a class="navbar-toggle">
                            <div class="lines">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </a>
                        <!-- End mobile menu toggle-->
                    </li>


                    <li class="list-inline-item dropdown notification-list">
                        <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                           aria-haspopup="false" aria-expanded="false">
                            
                            <img src="assets/images/users/avatar-3.jpg" alt="user" class="rounded-circle">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview">
                            <!-- item-->
                            <div class="dropdown-item noti-title">
                                <h5 class="text-overflow"><small>Welcome ! <?php echo $_SESSION['seller_info']['fname']; ?></small> </h5>
                            </div>

                            <!-- item-->
                            <a href="profile.php" class="dropdown-item notify-item">
                                <i class="zmdi zmdi-account-circle"></i> <span>Profile</span>
                            </a>
                            <a href="fun.php" class="dropdown-item notify-item">
                                <i class="zmdi zmdi-account-circle"></i> <span>Fun Fact</span>
                            </a>

                            <!-- item-->
                            <a href="settings.php" class="dropdown-item notify-item">
                                <i class="zmdi zmdi-settings"></i> <span>Settings</span>
                            </a>

                            <!-- item-->
                            <a href="logout.php" class="dropdown-item notify-item">
                                <i class="zmdi zmdi-power"></i> <span>Logout</span>
                            </a>

                        </div>
                    </li>

                </ul>

            </div> <!-- end menu-extras -->
            <div class="clearfix"></div>

        </div> <!-- end container -->
    </div>
    <!-- end topbar-main -->


    <div class="navbar-custom">
        <div class="container">
            <div id="navigation">
                <!-- Navigation Menu-->
                <ul class="navigation-menu">
                    
                    <li class="has-submenu">
                        <a href="pages.php"><i class="zmdi zmdi-collection-text"></i> <span> Pages </span> </a>
                    </li>
                     <li class="has-submenu">
                        <a href="gallery.php"><i class="zmdi zmdi-collection-image"></i> <span> Gallery </span> </a>
                    </li>
                    <li class="has-submenu">
                        <a href="rates.php"><i class="fa fa-dollar"></i> <span> Rates </span> </a>
                    </li>
                     <li class="has-submenu">
                        <a href="tours.php"><i class="fa fa-plane"></i> <span> Tour Rates </span> </a>
                    </li>
                     <li class="has-submenu">
                        <a href="friends.php"><i class="fa fa-plane"></i> <span> Friends </span> </a>
                    </li>
                    <li class="has-submenu">
                        <a href="reviews.php"><i class="fa fa-edit"></i> <span> Reviews </span> </a>
                    </li>
                    <li class="has-submenu">
                        <a href="calender.php"><i class="fa fa-calendar"></i> <span> Calender </span> </a>
                    </li>
                    <li class="has-submenu">
                        <a href="faq.php"><i class="fa fa-question"></i> <span> Faq </span> </a>
                    </li>
                    <li class="has-submenu">
                        <a href="settings.php"><i class="fa fa-gear"></i> <span> Settings </span> </a>
                    </li>

                </ul>
                <!-- End navigation menu  -->
            </div>
        </div>
    </div>
</header>
<!-- End Navigation Bar-->


<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->

<div class="wrapper">
    <div class="container">
