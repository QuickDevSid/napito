<?php
$profile = $this->Admin_model->get_user_profile();
?> 
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .nav-icon {
            font-size: 15px;
        }

        .nav-title {
            margin-left: 15px;
            margin-top: 5px;
            font-size: 12px;
        }

        .down-icon {
            margin-top: 5px;
        }

        .login_hide_show {
            position: fixed;
            bottom: 0;
            right: 20px;
        }
        .alert{
            margin-bottom: 0px !important;
            padding: 15px 20px 10px !important;
        }
		.title_left{
			width:100% !important;
		}

	
    </style>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <title>Admin! | </title>  
    <link href="<?= base_url() ?>admin_assets/css/bootstrap.min.css" rel="stylesheet">
	
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/fontawesome.min.css"
        integrity="sha512-siarrzI1u3pCqFG2LEzi87McrBmq6Tp7juVsdmGY1Dr8Saw+ZBAzDzrGwX3vgxX1NkioYNCFOVC0GpDPss10zQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="<?= base_url() ?>admin_assets/fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>admin_assets/css/animate.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>admin_assets/css/salon-style.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/jquery-ui.css'); ?>" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <!-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
    <link href="<?= base_url() ?>admin_assets/css/custom.css" rel="stylesheet">
    <link href="<?= base_url() ?>admin_assets/css/jquery.timesetter.css" rel="stylesheet">
    <link href="<?= base_url() ?>admin_assets/css/chosen.css" rel="stylesheet">
    <link href="<?= base_url() ?>admin_assets/css/chosen.min.css" rel="stylesheet">
    <link rel="<?= base_url() ?>admin_assets/stylesheet" type="text/css" href="css/maps/jquery-jvectormap-2.0.1.css" />
    <link href="<?= base_url() ?>admin_assets/css/icheck/flat/green.css" rel="stylesheet" />
    <link href="<?= base_url() ?>admin_assets/css/floatexamples.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>admin_assets/css/icheck/flat/green.css" rel="stylesheet">
    <link href="<?= base_url() ?>admin_assets/css/datatables/tools/css/dataTables.tableTools.css" rel="stylesheet">
    <link href="<?= base_url() ?>admin_assets/css/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet">
    <link href="<?=base_url()?>admin_assets/css/summernote.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>admin_assets/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>admin_assets/css/datatables.min.css" />
    <script src="<?=base_url()?>admin_assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>admin_assets/js/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script> 
    <script type="text/javascript" src="<?=base_url()?>admin_assets/js/datatables.min.js"></script>
    <style>
        .error {
            color: red;
        }
        .nav .active a {
        font-weight: bold;
    }
	
    </style>


</head>


<body class="nav-md">

    <div class="container body">


        <div class="main_container">

            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    <div class="navbar nav_title">
                        <a  href="<?= base_url(); ?>admin-dashboard" class="site_title"><i class="fa fa-paw"></i> <span>Admin!</span></a>
                    </div>
                    <div class="clearfix"></div>


                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                        <div class="menu_section">
                            <ul class="nav side-menu">
                                <li><a href="<?=base_url();?>admin-dashboard"><i class="fa fa-home"></i>Dashboard</a></li>

                                <li><a><i class="fa-solid fa-spa"></i><b class="nav-title">Salon Management</b><span class="fa fa-chevron-down down-icon"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?= base_url(); ?>add-salon">Add Salon</a></li>
                                        <li><a href="<?= base_url(); ?>salon-list">Salon List</a></li>
                                        <li><a href="<?= base_url(); ?>branch_payment">Branch Subscription Payment</a></li>
                                        <!-- <li><a href="<?= base_url(); ?>category-type">Salon Category</a></li> -->
                                        <!-- <li><a href="<?= base_url(); ?>add-branch">Add Branch</a></li> -->
                                        <li><a href="<?= base_url(); ?>rule-update-requests">Booking Rules Update Requests</a></li>
                                        <li><a href="<?= base_url(); ?>customize-messages">Customize Message Requests</a></li>
                                    </ul>
                                </li>
                               
                                <li><a><i class="fa-solid fa-users nav-icon"></i><b class="nav-title">Employee Management</b><span class="fa fa-chevron-down down-icon"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?= base_url(); ?>add-employee">Add Employee</a></li>
                                        <li><a href="<?= base_url(); ?>employee-list">Employee List</a></li>
                                        <li><a target="_blank" href="<?= base_url(); ?>add_admin_attendance">Add Attendance</a></li>
                                        <li><a href="<?= base_url(); ?>generate_admin_salary">Add Salary</a></li>
                                    </ul>
                                </li>    
                                   
                               
								<li>
									<a><i class="fa fa-home"></i><b class="nav-title">Backoffice Setup</b><span class="fa fa-chevron-down down-icon"></span></a>
									<ul class="nav child_menu" style="display: none">
										
										<li>
											<a class="services_menu" href="javascript:void(0)">Services <span class="fa fa-chevron-right"></span></a>
											<ul class="nav child_menu_new" style="display: none">
												<li><a href="<?= base_url(); ?>add-admin-sup-category">Add Category</a></li>
												<li><a href="<?= base_url(); ?>add-admin-sub-category">Add Sub Category</a></li>
												<li><a href="<?= base_url(); ?>add-admin-service">Add Service</a></li>
												<li><a href="<?= base_url(); ?>pending-salon-service">Pending Service</a></li>
											</ul>
										</li>
										<li><a href="<?= base_url(); ?>admin_membership_list">Membership</a></li> 
										<li><a href="<?= base_url(); ?>admin_list_coupon">Coupon</a></li> 
										<li><a href="<?= base_url(); ?>reward_point_management">Reward Point</a></li>
										<li><a href="<?= base_url(); ?>admin_offer_list">Offer</a></li>  
										<li><a href="<?= base_url(); ?>admin_giftcard_list">Gift Cart</a></li>
										<!-- <li><a href="<?= base_url(); ?>admin_add_booking_status">Booking Status</a></li>   -->
										<li>
											<a class="services_menu" href="javascript:void(0)">Products <span class="fa fa-chevron-right"></span></a>
											<ul class="nav child_menu_new" style="display: none">
												<li><a href="<?=base_url();?>admin_product_category">Product Category</a></li> 
												<li><a href="<?=base_url();?>admin_product_subcategory">Sub-Category</a></li> 
												<li><a href="<?=base_url();?>admin_product_list">Products</a></li> 
												<li><a href="<?=base_url();?>pending_salon_product">Pending Products</a></li>
											</ul>
										</li>
										<li><a href="<?= base_url(); ?>admin_package_list">Packages</a></li>
										<li><a class="add-expense-category" href="<?=base_url();?>add-expense-category">Add Expense category</a></li>
										<!--<li><a class="add-booking-status" href="<?=base_url();?>add-booking-status">Add Booking Status</a></li>-->
										<li><a href="<?= base_url(); ?>admin_booking_rules">Booking Rules</a></li>
									</ul>
								</li>
		
                                <!-- <li><a><i class="fa-solid fa-user-nurse nav-icon"></i><b class="nav-title">Customer Care</b><span class="fa fa-chevron-down down-icon"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?= base_url(); ?>add-customer-care">Add Customer Care</a></li>
                                        <li><a href="<?= base_url(); ?>customer-care-list">Customer Care List</a></li>
                                        <li><a href="<?= base_url(); ?>salon-customer-list">Salon Customer List</a></li>
                                        <li><a href="<?= base_url(); ?>customer-care-report-list">Customer Care Report List</a></li>
                                    </ul>
                                </li> -->
                                <li><a><i class="fa-solid fa-user-nurse nav-icon"></i><b class="nav-title">Customer Support</b><span class="fa fa-chevron-down down-icon"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?= base_url(); ?>salon-customer-list">Salon Customer List</a></li>
                                        <li><a href="<?= base_url(); ?>customer-tickets">Customer Query List</a></li>
                                        <li><a href="<?= base_url(); ?>add-ticket-category">Manage Query Category</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa-solid fa-clipboard-list nav-icon survey-icon"></i><b class="nav-title">Survey Management</b><span class="fa fa-chevron-down down-icon"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?= base_url(); ?>survey" target="_blank">Add Salon Survey</a></li>
                                        <li><a href="<?= base_url(); ?>survey-list">Salon Survey List</a></li>
                                    </ul>
                                </li>   
                                <li><a><i class="fa-solid fa-people-arrows nav-icon"></i><b class="nav-title">CRM</b><span class="fa fa-chevron-down down-icon"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?= base_url(); ?>crm-status-master">Status Master</a></li>
                                        <li><a href="<?= base_url(); ?>add-lead">Add Lead</a></li>
                                        <li><a href="<?= base_url(); ?>lead-list">Lead List</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa-solid fa-bell nav-icon"></i><b class="nav-title">Subscription Master</b><span class="fa fa-chevron-down down-icon"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <!--<li><a href="<?= base_url(); ?>subscription-features">Subscription Features</a></li>-->
                                        <!--<li><a href="<?= base_url(); ?>subscription-features-slugs">Subscription Feature Slugs</a></li>-->
                                        <li><a href="<?= base_url(); ?>add-subscription">Add Subscription</a></li>
                                        <li><a href="<?= base_url(); ?>subscription-list">Subscription List</a></li>
                                    </ul>
                                </li>   
                                <li><a><i class="fas fa-cogs nav-icon"></i><b class="nav-title">Common Masters</b><span class="fa fa-chevron-down down-icon"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?= base_url(); ?>add-facility">Salon Facility</a></li>
                                        <li><a href="<?= base_url(); ?>salon-close-reason">Salon Close Reason</a></li>
                                        <li><a href="<?= base_url(); ?>add-tips">Health Tips</a></li>
                                        <li><a href="<?= base_url(); ?>mobile-banner">Mobile App Banner</a></li>
                                        <li><a href="<?= base_url(); ?>privacy-policy">Privacy Policy</a></li>
                                        <li><a href="<?= base_url(); ?>terms-conditions">Terms & Conditions</a></li>                                       
                                        <li><a href="<?= base_url(); ?>salon-marketing">Marketing Module Setup</a></li>                                       
                                        <li><a href="<?= base_url(); ?>add-location">Location Master</a></li>                                       
                                        <li><a href="<?= base_url(); ?>add-gst-rate">GST Rate Master</a></li>                                       
                                    </ul>
                                </li>  
                            </ul>
                        </div>


                    </div>
                    <!-- /sidebar menu -->


                    <!-- /menu footer buttons -->
                    
                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">

                <div class="nav_menu">
                    <nav class="" role="navigation">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                                    aria-expanded="false">
                                    <img src="<?= base_url() ?>\admin_assets\images\employee_profile/<?php if (!empty($profile)) {
                                          echo $profile->profile_photo;
                                      } ?>"
                                        alt="">
                                    <?php if (!empty($profile)) {
                                        echo $profile->full_name;
                                    } ?>
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                    <li><a href="javascript:;"> Profile</a>
                                    </li>
                                    <li><a href="<?= base_url(); ?>admin_do-logout"><i
                                                class="fa fa-sign-out pull-right"></i> Log Out</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>


                <!-- /top navigation -->