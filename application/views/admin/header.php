<?php
$profile = $this->Admin_model->get_user_profile();
if(empty($profile)){
    redirect('admin_do-logout');
}
$previlege = $profile->allowed_links != "" ? explode(',',$profile->allowed_links) : [];
?> 
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        textarea{
            resize: none;
        }
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
    <title>Napito - Admin Panel</title>  
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
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>admin_assets/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>admin_assets/css/datatables.min.css" />
    <script src="<?=base_url()?>admin_assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script> 
    <script type="text/javascript" src="<?=base_url()?>admin_assets/js/datatables.min.js"></script>
    <style>
        .error {
            color: red;
        }
       
	
    </style>


</head>


<body class="nav-md">

    <div class="container body">


        <div class="main_container">

            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    <div class="side_logo">
                        <a href="<?= base_url(); ?>admin-dashboard">
                            <img src="<?= base_url(); ?>assets/images/napito_logo.jpg">
                        </a>
                    </div>
                    <div class="clearfix"></div>

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                        <div class="menu_section">
                            <ul class="nav side-menu">
                                <li><a href="<?= base_url(); ?>admin-dashboard"><i class="fa fa-home" style="margin-right:15px"></i>Dashboard</a></li>
                                <?php if ($this->session->userdata('user_type') == '0' || in_array('addon-requests', $previlege) || in_array('add-salon', $previlege) || in_array('salon-list', $previlege) || in_array('branch_payment', $previlege) || in_array('customize-messages', $previlege) || in_array('rule-update-requests', $previlege)) { ?>
                                    <li><a><i class="fa-solid fa-spa"></i><b class="nav-title">Salon Management</b><span class="fa fa-chevron-down down-icon"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <?php if ($this->session->userdata('user_type') == '0' || in_array('add-salon', $previlege)) { ?>
                                                <li><a href="<?= base_url(); ?>add-salon">Add Salon</a></li>
                                            <?php } ?>
                                            <?php if ($this->session->userdata('user_type') == '0' || in_array('salon-list', $previlege)) { ?>
                                                <li><a href="<?= base_url(); ?>salon-list">Salon List</a></li>
                                            <?php } ?>
                                            <?php if ($this->session->userdata('user_type') == '0' || in_array('branch_payment', $previlege)) { ?>
                                                <li><a href="<?= base_url(); ?>branch_payment">Branch Subscription Payment</a></li>
                                            <?php } ?>
                                            <!-- <li><a href="<?= base_url(); ?>category-type">Salon Category</a></li> -->
                                            <!-- <li><a href="<?= base_url(); ?>add-branch">Add Branch</a></li> -->
                                            <?php if ($this->session->userdata('user_type') == '0' || in_array('rule-update-requests', $previlege)) { ?>
                                                <li><a href="<?= base_url(); ?>rule-update-requests">Booking Rules Update Requests</a></li>
                                            <?php } ?>
                                            <?php if ($this->session->userdata('user_type') == '0' || in_array('customize-messages', $previlege)) { ?>
                                                <li><a href="<?= base_url(); ?>customize-messages">Customize Message Requests</a></li>
                                            <?php } ?>
                                            <?php if ($this->session->userdata('user_type') == '0' || in_array('addon-requests', $previlege)) { ?>
                                                <li><a href="<?= base_url(); ?>addon-requests">Whatsapp Add On Requests</a></li>
                                            <?php } ?>
                                        </ul>
                                    </li>
                                <?php } ?>
                                <?php if ($this->session->userdata('user_type') == '0' || in_array('admin_attendance', $previlege) || in_array('admin-salary-list', $previlege) || in_array('add-employee', $previlege) || in_array('employee-list', $previlege) || in_array('add_admin_attendance', $previlege) || in_array('generate_admin_salary', $previlege)) { ?>
                                    <li><a><i class="fa-solid fa-users nav-icon"></i><b class="nav-title">Employee Management</b><span class="fa fa-chevron-down down-icon"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <?php if ($this->session->userdata('user_type') == '0' || in_array('add-employee', $previlege)) { ?>
                                                <li><a href="<?= base_url(); ?>add-employee">Add Employee</a></li>
                                            <?php } ?>
                                            <?php if ($this->session->userdata('user_type') == '0' || in_array('employee-list', $previlege)) { ?>
                                                <li><a href="<?= base_url(); ?>employee-list">Employee List</a></li>
                                            <?php } ?>
                                            <?php if ($this->session->userdata('user_type') == '0' || in_array('add_admin_attendance', $previlege)) { ?>
                                                <li><a target="_blank" href="<?= base_url(); ?>add_admin_attendance">Add Attendance</a></li>
                                            <?php } ?>
                                            <?php if ($this->session->userdata('user_type') == '0' || in_array('admin_attendance', $previlege)) { ?>
                                                <li><a target="_blank" href="<?= base_url(); ?>admin_attendance">Attendance List</a></li>
                                            <?php } ?>
                                            <?php if ($this->session->userdata('user_type') == '0' || in_array('generate_admin_salary', $previlege)) { ?>
                                                <li><a href="<?= base_url(); ?>generate_admin_salary">Add Salary</a></li>
                                            <?php } ?>
                                            <?php if ($this->session->userdata('user_type') == '0' || in_array('admin-salary-list', $previlege)) { ?>
                                                <li><a href="<?= base_url(); ?>admin-salary-list">Salary List</a></li>
                                            <?php } ?>
                                        </ul>
                                    </li>
                                <?php } ?>
                                <?php if ($this->session->userdata('user_type') == '0' || in_array('admin_booking_rules', $previlege) || in_array('add-expense-category', $previlege) || in_array('admin_package_list', $previlege) || in_array('admin_product_category', $previlege) || in_array('admin_product_subcategory', $previlege) || in_array('admin_product_list', $previlege) || in_array('pending_salon_product', $previlege) || in_array('admin_giftcard_list', $previlege) || in_array('admin_offer_list', $previlege) || in_array('reward_point_management', $previlege) || in_array('admin_list_coupon', $previlege) || in_array('admin_membership_list', $previlege) || in_array('add-admin-sup-category', $previlege) || in_array('add-admin-sub-category', $previlege) || in_array('add-admin-service', $previlege) || in_array('pending-salon-service', $previlege)) { ?>
                                    <li>
                                        <a><i class="fa fa-home"></i><b class="nav-title">Backoffice Setup</b><span class="fa fa-chevron-down down-icon"></span></a>
                                        <ul class="nav child_menu" id="back_drop" style="display: none">
                                            <?php if ($this->session->userdata('user_type') == '0' || in_array('add-admin-sup-category', $previlege) || in_array('add-admin-sub-category', $previlege) || in_array('add-admin-service', $previlege) || in_array('pending-salon-service', $previlege)) { ?>
                                                <li>
                                                    <a class="services_menu">Services <i class="fa fa-chevron-up down_icon"></i></a>
                                                    <ul class="nav " id='service_drop' style="display: none">
                                                        <?php if ($this->session->userdata('user_type') == '0' || in_array('add-admin-sup-category', $previlege)) { ?>
                                                            <li><a href="<?= base_url(); ?>add-admin-sup-category">Add Category</a></li>
                                                        <?php } ?>
                                                        <?php if ($this->session->userdata('user_type') == '0' || in_array('add-admin-sub-category', $previlege)) { ?>
                                                            <li><a href="<?= base_url(); ?>add-admin-sub-category">Add Sub Category</a></li>
                                                        <?php } ?>
                                                        <?php if ($this->session->userdata('user_type') == '0' || in_array('add-admin-service', $previlege)) { ?>
                                                            <li><a href="<?= base_url(); ?>add-admin-service">Add Service</a></li>
                                                        <?php } ?>
                                                        <?php if ($this->session->userdata('user_type') == '0' || in_array('pending-salon-service', $previlege)) { ?>
                                                            <li><a href="<?= base_url(); ?>pending-salon-service">Pending Service</a></li>
                                                        <?php } ?>
                                                    </ul>
                                                </li>
                                            <?php } ?>
                                            <?php if ($this->session->userdata('user_type') == '0' || in_array('admin_membership_list', $previlege)) { ?>
                                                <li><a href="<?= base_url(); ?>admin_membership_list">Membership</a></li>
                                            <?php } ?>
                                            <?php if ($this->session->userdata('user_type') == '0' || in_array('admin_list_coupon', $previlege)) { ?>
                                                <li><a href="<?= base_url(); ?>admin_list_coupon">Coupon</a></li>
                                            <?php } ?>
                                            <?php if ($this->session->userdata('user_type') == '0' || in_array('reward_point_management', $previlege)) { ?>
                                                <li><a href="<?= base_url(); ?>reward_point_management">Reward Point</a></li>
                                            <?php } ?>
                                            <?php if ($this->session->userdata('user_type') == '0' || in_array('admin_offer_list', $previlege)) { ?>
                                                <li><a href="<?= base_url(); ?>admin_offer_list">Offer</a></li>
                                            <?php } ?>
                                            <?php if ($this->session->userdata('user_type') == '0' || in_array('admin_giftcard_list', $previlege)) { ?>
                                                <li><a href="<?= base_url(); ?>admin_giftcard_list">Gift Card</a></li>
                                            <?php } ?>
                                            <!-- <li><a href="<?= base_url(); ?>admin_add_booking_status">Booking Status</a></li>   -->

                                            <?php if ($this->session->userdata('user_type') == '0' || in_array('admin_product_category', $previlege) || in_array('admin_product_subcategory', $previlege) || in_array('admin_product_list', $previlege) || in_array('pending_salon_product', $previlege)) { ?>
                                                <li>
                                                    <a class="product_menu" >Products <i class="fa fa-chevron-up product_icon"></i></a>
                                                    <ul class="nav " id='product_drop' style="display: none">
                                                        <?php if ($this->session->userdata('user_type') == '0' || in_array('admin_product_category', $previlege)) { ?>
                                                            <li><a href="<?= base_url(); ?>admin_product_category">Product Category</a></li>
                                                        <?php } ?>
                                                        <?php if ($this->session->userdata('user_type') == '0' || in_array('admin_product_subcategory', $previlege)) { ?>
                                                            <li><a href="<?= base_url(); ?>admin_product_subcategory">Sub-Category</a></li>
                                                        <?php } ?>
                                                        <?php if ($this->session->userdata('user_type') == '0' || in_array('admin_product_list', $previlege)) { ?>
                                                            <li><a href="<?= base_url(); ?>admin_product_list">Products</a></li>
                                                        <?php } ?>
                                                        <?php if ($this->session->userdata('user_type') == '0' || in_array('pending_salon_product', $previlege)) { ?>
                                                            <li><a href="<?= base_url(); ?>pending_salon_product">Pending Products</a></li>
                                                        <?php } ?>
                                                    </ul>
                                                </li>
                                            <?php } ?>
                                            <?php if ($this->session->userdata('user_type') == '0' || in_array('admin_package_list', $previlege)) { ?>
                                                <li><a href="<?= base_url(); ?>admin_package_list">Packages</a></li>
                                            <?php } ?>
                                            <?php if ($this->session->userdata('user_type') == '0' || in_array('add-expense-category', $previlege)) { ?>
                                                <li><a class="add-expense-category" href="<?= base_url(); ?>add-expense-category">Add Expense category</a></li>
                                                <!--<li><a class="add-booking-status" href="<?= base_url(); ?>add-booking-status">Add Booking Status</a></li>-->
                                            <?php } ?>
                                            <?php if ($this->session->userdata('user_type') == '0' || in_array('admin_booking_rules', $previlege)) { ?>
                                                <li><a href="<?= base_url(); ?>admin_booking_rules">Booking Rules</a></li>
                                            <?php } ?>
                                        </ul>
                                    </li>
                                <?php } ?>
                                <!-- <li><a><i class="fa-solid fa-user-nurse nav-icon"></i><b class="nav-title">Customer Care</b><span class="fa fa-chevron-down down-icon"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?= base_url(); ?>add-customer-care">Add Customer Care</a></li>
                                        <li><a href="<?= base_url(); ?>customer-care-list">Customer Care List</a></li>
                                        <li><a href="<?= base_url(); ?>salon-customer-list">Salon Customer List</a></li>
                                        <li><a href="<?= base_url(); ?>customer-care-report-list">Customer Care Report List</a></li>
                                    </ul>
                                </li> -->
                                <?php if($this->session->userdata('user_type') == '0' || in_array('salon-customer-list',$previlege) || in_array('customer-tickets',$previlege) || in_array('add-ticket-category',$previlege)){ ?>
                                <li><a><i class="fa-solid fa-user-nurse nav-icon"></i><b class="nav-title">Customer Support</b><span class="fa fa-chevron-down down-icon"></span></a>
                                    <ul class="nav child_menu" style="display: none">
											<?php if($this->session->userdata('user_type') == '0' || in_array('salon-customer-list',$previlege)){?>
                                        <li><a href="<?= base_url(); ?>salon-customer-list">Salon Customer List</a></li>
											<?php }?>
											<?php if($this->session->userdata('user_type') == '0' || in_array('customer-tickets',$previlege)){?>
                                        <li><a href="<?= base_url(); ?>customer-tickets">Customer Query List</a></li>
											<?php }?>
											<?php if($this->session->userdata('user_type') == '0' || in_array('add-ticket-category',$previlege)){?>
                                        <li><a href="<?= base_url(); ?>add-ticket-category">Manage Query Category</a></li>
											<?php }?>
                                    </ul>
                                </li>
                                <?php }?>
                                <?php if($this->session->userdata('user_type') == '0' || in_array('add-location',$previlege) || in_array('survey',$previlege) || in_array('survey-list',$previlege)){ ?>
                                <li><a><i class="fa-solid fa-clipboard-list nav-icon survey-icon"></i><b class="nav-title">Survey Management</b><span class="fa fa-chevron-down down-icon"></span></a>
                                    <ul class="nav child_menu" style="display: none">
											<?php if($this->session->userdata('user_type') == '0' || in_array('survey',$previlege)){?>
                                        <li><a href="<?= base_url(); ?>survey" target="_blank">Add Salon Survey</a></li>
											<?php }?>
											<?php if($this->session->userdata('user_type') == '0' || in_array('survey-list',$previlege)){?>
                                        <li><a href="<?= base_url(); ?>survey-list">Salon Survey List</a></li>
											<?php }?>
											<?php if($this->session->userdata('user_type') == '0' || in_array('add-location',$previlege)){?>                                       
                                        <li><a href="<?= base_url(); ?>add-location">Location Master</a></li>  
											<?php }?>
                                    </ul>
                                </li>  
                                <?php }?> 
                                <!-- <?php if($this->session->userdata('user_type') == '0' || in_array('crm-status-master',$previlege) || in_array('add-lead',$previlege) || in_array('lead-list',$previlege)){ ?>
                                <li><a><i class="fa-solid fa-people-arrows nav-icon"></i><b class="nav-title">CRM</b><span class="fa fa-chevron-down down-icon"></span></a>
                                    <ul class="nav child_menu" style="display: none">
											<?php if($this->session->userdata('user_type') == '0' || in_array('crm-status-master',$previlege)){?>
                                        <li><a href="<?= base_url(); ?>crm-status-master">Status Master</a></li>
											<?php }?>
											<?php if($this->session->userdata('user_type') == '0' || in_array('add-lead',$previlege)){?>
                                        <li><a href="<?= base_url(); ?>add-lead">Add Lead</a></li>
											<?php }?>
											<?php if($this->session->userdata('user_type') == '0' || in_array('lead-list',$previlege)){?>
                                        <li><a href="<?= base_url(); ?>lead-list">Lead List</a></li>
											<?php }?>
                                    </ul>
                                </li>
                                <?php }?> -->
                                <?php if($this->session->userdata('user_type') == '0' || in_array('whatsapp-addon-plans',$previlege) || in_array('subscription-features',$previlege) || in_array('subscription-features-slugs',$previlege) || in_array('add-subscription',$previlege) || in_array('subscription-list',$previlege)){ ?>
                                <li><a><i class="fa-solid fa-bell nav-icon"></i><b class="nav-title">Subscription Master</b><span class="fa fa-chevron-down down-icon"></span></a>
                                    <ul class="nav child_menu" style="display: none">
											<!-- <?php if($this->session->userdata('user_type') == '0' || in_array('subscription-features',$previlege)){?>
                                        <li><a href="<?= base_url(); ?>subscription-features">Subscription Features</a></li>
											<?php }?>
											<?php if($this->session->userdata('user_type') == '0' || in_array('subscription-features-slugs',$previlege)){?>
                                        <li><a href="<?= base_url(); ?>subscription-features-slugs">Subscription Feature Slugs</a></li>
											<?php }?> -->
											<?php if($this->session->userdata('user_type') == '0' || in_array('add-subscription',$previlege)){?>
                                        <li><a href="<?= base_url(); ?>add-subscription">Add Subscription</a></li>
											<?php }?>
											<?php if($this->session->userdata('user_type') == '0' || in_array('subscription-list',$previlege)){?>
                                        <li><a href="<?= base_url(); ?>subscription-list">Subscription List</a></li>
											<?php }?>
                                    </ul>
                                </li> 
                                <?php }?>  
                                <?php if($this->session->userdata('user_type') == '0' || in_array('add-catlogue',$previlege) || in_array('add-facility',$previlege) || in_array('salon-close-reason',$previlege) || in_array('add-tips',$previlege) || in_array('mobile-banner',$previlege) || in_array('privacy-policy',$previlege) || in_array('app-support',$previlege) || in_array('terms-conditions',$previlege) || in_array('salon-marketing',$previlege) || in_array('add-gst-rate',$previlege)){ ?>
                                <li><a><i class="fas fa-cogs nav-icon"></i><b class="nav-title">Common Masters</b><span class="fa fa-chevron-down down-icon"></span></a>
                                    <ul class="nav child_menu" style="display: none">
											<?php if($this->session->userdata('user_type') == '0' || in_array('add-facility',$previlege)){?>
                                        <li><a href="<?= base_url(); ?>add-facility">Salon Facility</a></li>
											<?php }?>
											<!-- <?php if($this->session->userdata('user_type') == '0' || in_array('salon-close-reason',$previlege)){?>
                                        <li><a href="<?= base_url(); ?>salon-close-reason">Salon Close Reason</a></li>
											<?php }?> -->
											<?php if($this->session->userdata('user_type') == '0' || in_array('add-tips',$previlege)){?>
                                        <li><a href="<?= base_url(); ?>add-tips">Health Tips</a></li>
											<?php }?>
											<?php if($this->session->userdata('user_type') == '0' || in_array('mobile-banner',$previlege)){?>
                                        <li><a href="<?= base_url(); ?>mobile-banner">Mobile App Banner</a></li>
											<?php }?>
											<?php if($this->session->userdata('user_type') == '0' || in_array('add-catlogue',$previlege)){?>
                                        <li><a href="<?= base_url(); ?>add-catlogue">Mobile App Catlogue</a></li>
											<?php }?>

                                        <?php if($this->session->userdata('user_type') == '0' || in_array('app-users',$previlege)){?>                                     
                                        <li><a href="<?= base_url(); ?>app-help-management">FAQ Management</a></li>  
                                        <?php }?>
											<?php if($this->session->userdata('user_type') == '0' || in_array('privacy-policy',$previlege)){?>
                                        <li><a href="<?= base_url(); ?>privacy-policy">Privacy Policy</a></li>
											<?php }?>                                            
											<?php if($this->session->userdata('user_type') == '0' || in_array('app-support',$previlege)){?>
                                        <li><a href="<?= base_url(); ?>app-support">Mobile App Support </a></li>
											<?php }?>
											<?php if($this->session->userdata('user_type') == '0' || in_array('terms-conditions',$previlege)){?>
                                        <li><a href="<?= base_url(); ?>terms-conditions">Terms & Conditions</a></li>   
											<?php }?>
											<?php if($this->session->userdata('user_type') == '0' || in_array('salon-marketing',$previlege)){?>            
                                        <li><a href="<?= base_url(); ?>salon-marketing">Marketing Module Setup</a></li>    
											<?php }?>
											<?php if($this->session->userdata('user_type') == '0' || in_array('add-gst-rate',$previlege)){?>                                     
                                        <li><a href="<?= base_url(); ?>add-gst-rate">GST Rate Master</a></li>  
											<?php }?>
											<?php if($this->session->userdata('user_type') == '0' || in_array('app-users',$previlege)){?>                                     
                                        <li><a href="<?= base_url(); ?>app-users">App Users</a></li>  
											<?php }?>
                                    </ul>
                                </li>  
                                <?php }?>


                                <?php if($this->session->userdata('user_type') == '0' || in_array('website-contact-us',$previlege) || in_array('business-contact-us',$previlege)){ ?>
                                <li><a><i class="fas fa-cogs nav-icon"></i><b class="nav-title">Enquires</b><span class="fa fa-chevron-down down-icon"></span></a>
                                    <ul class="nav child_menu" style="display: none">
											<?php if($this->session->userdata('user_type') == '0' || in_array('website-contact-us',$previlege)){?>
                                        <li><a href="<?= base_url(); ?>website-contact-us">Website Contact List</a></li>
											<?php }?>
											
											<?php if($this->session->userdata('user_type') == '0' || in_array('business-contact-us',$previlege)){?>
                                        <li><a href="<?= base_url(); ?>business-contact-us">Business Contact List</a></li>
											<?php }?>
                                    </ul>
                                </li>  
                                <?php }?>


                                <?php if($this->session->userdata('user_type') == '0' || in_array('cron-reports',$previlege)){ ?>
                                <li><a><i class="fas fa-cogs nav-icon"></i><b class="nav-title">CRON Reports</b><span class="fa fa-chevron-down down-icon"></span></a>
                                    <ul class="nav child_menu" style="display: none">
											<?php if($this->session->userdata('user_type') == '0' || in_array('cron-reports',$previlege)){?>
                                        <li><a href="<?= base_url(); ?>cron-reports?type=0">Lost Customers</a></li>
											<?php }?>
											
											<?php if($this->session->userdata('user_type') == '0' || in_array('cron-reports',$previlege)){?>
                                        <li><a href="<?= base_url(); ?>cron-reports?type=1">Birthday Wishes</a></li>
											<?php }?>

											<?php if($this->session->userdata('user_type') == '0' || in_array('cron-reports',$previlege)){?>
                                        <li><a href="<?= base_url(); ?>cron-reports?type=2">Anniversary Wishes</a></li>
											<?php }?>
											
											<?php if($this->session->userdata('user_type') == '0' || in_array('cron-reports',$previlege)){?>
                                        <li><a href="<?= base_url(); ?>cron-reports?type=3">Service Repeat</a></li>
											<?php }?>
											
											<?php if($this->session->userdata('user_type') == '0' || in_array('cron-reports',$previlege)){?>
                                        <li><a href="<?= base_url(); ?>cron-reports?type=4">Yesterday Cancel Appointments</a></li>
											<?php }?>
											
											<?php if($this->session->userdata('user_type') == '0' || in_array('cron-reports',$previlege)){?>
                                        <li><a href="<?= base_url(); ?>cron-reports?type=5">Tomorrow Booking Reminders</a></li>
											<?php }?>
											
											<?php if($this->session->userdata('user_type') == '0' || in_array('cron-reports',$previlege)){?>
                                        <li><a href="<?= base_url(); ?>cron-reports?type=6">Today Booking Reminders</a></li>
											<?php }?>
                                    </ul>
                                </li>  
                                <?php }?>
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
                                    <li><a href="<?= base_url(); ?>update-profile"> Profile</a>
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