<?php
$this->Salon_model->set_store_booking_rules($this->session->userdata('branch_id'),$this->session->userdata('salon_id'));
$profile = $this->Salon_model->get_user_profile();
$low_stock_products = $this->Salon_model->get_low_stock_products();
?>
<?php
$store_category = $this->Salon_model->get_store_category_new();
$gst = $this->Salon_model->get_store_category();
$branch_list = $this->Salon_model->get_store_category();
$staff_count = $this->Salon_model->get_salon_all_staff();
$stylists_emps = $this->Salon_model->get_stylist_emps();
$working_hrs = $this->Salon_model->get_salon_working_hrs();
$salon_shifts = $this->Salon_model->get_salon_shifts();
$salon_incentives = $this->Salon_model->get_salon_employee_incentives();
$salon_set_services = $this->Salon_model->get_salon_services();
if(empty($gst)){
    if($this->uri->segment(1) != 'store-profile' && $this->uri->segment(1) != 'complete-profile'){
        redirect('complete-profile');
    }
}elseif(!$working_hrs){
    if($this->uri->segment(1) != 'store-profile' && $this->uri->segment(1) != 'working-hours'){
        $this->session->set_flashdata('message','Please add working hours first');
        redirect('working-hours');
    }
}elseif(empty($salon_shifts)){
    if($this->uri->segment(1) != 'store-profile' && $this->uri->segment(1) != 'working-hours'){
        $this->session->set_flashdata('message','Please add shifts first');
        redirect('working-hours');
    }
}elseif(empty($salon_set_services)){
    if($this->uri->segment(1) != 'store-profile' && $this->uri->segment(1) != 'add-salon-services' && $this->uri->segment(1) != "ready-sub-category" && $this->uri->segment(1) != "ready-services"){
        $this->session->set_flashdata('message','Please add services first');
        redirect('add-salon-services');
    }
}elseif(empty($salon_incentives)){
    if($this->uri->segment(1) != 'store-profile' && $this->uri->segment(1) != 'employee_incentive_master'){
        $this->session->set_flashdata('message','Please add employee incentives first');
        redirect('employee_incentive_master');
    }
}elseif(empty($stylists_emps)){
    if($this->uri->segment(1) != 'store-profile' && $this->uri->segment(1) != 'add_employee'){
        $this->session->set_flashdata('message','Please add stylists first');
        redirect('add_employee');
    }
}
$feature_slugs = explode(',', $this->session->userdata('subscription_feature_slugs'));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        textarea{
            resize: none;
        }
        .hide_body{
            position: fixed;
            width: 100%;
            height: 100% !important;
            background: #00000042;
            z-index: 999;
            left: 0;
            top: 0;
        }
    .feedback-form {
        position: absolute;
        top: 20%;
        right: 0px;
        z-index: 9999;
        height: 100%;
    }
    .feedback-form-btn {
        position: absolute;
        right: 100%;
        color: black !important;
        transform: rotate(90deg);
        top: 40%;
        border: none;
        border-radius: 0px 0px 8px 8px;
        margin-right: -10px !important;
        width: 110px;
        font-size: 15px !important;    
        background-color: #ffb799 !important;    
    }
    .feedback_form_area {
        position: relative;
        display: none;
        overflow: hidden;
        padding: 10px;
        padding-top: 10px;
        background: white !important;
        border-radius: 8px 0px 0px 8px;
        bottom: 12px;
        width: 900px;
        height: 100%;
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    }
    .feedback_form_area_inner {
        color: #000;
        padding: 15px;
    }

        .nav-icon {
            font-size: 18px;
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
            top: 3px;
            right: 40%;
            transform: translateX(-15%);
            height: 50px;
            width: auto;
            display: flex;
        
            background-color: transparent;
        }
        .child_menu{
            display: block;
            height: 100vh;
            overflow: scroll;
        }
    </style>
<!-- for salary and attendece  -->





    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> <?php echo $this->session->userdata('branch_name'); ?> | Napito </title>
    <link rel="icon" type="image/x-icon">

    <!-- Bootstrap core CSS -->

    <link href="<?= base_url() ?>salon_assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

	<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600;700&display=swap" rel="stylesheet">
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.3.7/dist/apexcharts.min.css"> -->
    <link href="<?= base_url() ?>salon_assets/fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>salon_assets/css/animate.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>admin_assets/css/salon-style.css" rel="stylesheet">
    <link href="<?=base_url('assets/css/jquery-ui.css');?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/clockpicker/dist/jquery-clockpicker.min.css">

    <!-- Custom styling plus plugins -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.css">

    <link href="<?= base_url() ?>salon_assets/css/custom-front.css" rel="stylesheet">
    <!-- <link href="admin_assets/css/jquery.timesetter.css" rel="stylesheet"> -->
    <!-- <link href="admin_assets/css/jquery.timesetter" rel="stylesheet"> -->
    <!-- <link href="admin_assets/css/jquery.timesetter.min" rel="stylesheet"> -->
    <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>admin_assets/css/chosen.css" rel="stylesheet">
    <link href="<?= base_url() ?>admin_assets/css/custom_calender.css" rel="stylesheet">
    <link href="<?= base_url() ?>admin_assets/css/chosen.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/css/slick.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/css/slick-theme.css" rel="stylesheet">
    <link rel="<?= base_url() ?>salon_assets/stylesheet" type="text/css" href="css/maps/jquery-jvectormap-2.0.1.css" />
    <link href="<?= base_url() ?>salon_assets/css/icheck/flat/green.css" rel="stylesheet" />
    <link href="<?= base_url() ?>salon_assets/css/floatexamples.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>salon_assets/css/icheck/flat/green.css" rel="stylesheet">
    <link href="<?= base_url() ?>salon_assets/css/datatables/tools/css/dataTables.tableTools.css" rel="stylesheet">
    <link href="<?= base_url() ?>salon_assets/css/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>salon_assets/css/datatables.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/jquery.filer@1.3.0/assets/fonts/jquery.filer-icons/jquery-filer.min.css"rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/air-datepicker/dist/css/datepicker.min.css">
    <script src="<?= base_url() ?>salon_assets/js/jquery.min.js"></script>

    <script type="text/javascript" src="<?= base_url() ?>salon_assets/js/pdfmake.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>salon_assets/js/vfs_fonts.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>salon_assets/js/datatables.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tippy.js/6.3.1/tippy.css">

    <style>
        .error {
            color: red;
        }
        
    #alert-box {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            border-radius: 5px;
            display: none;
        }

        .blurred {
            filter: blur(1px);
            pointer-events: none;
            position: relative;
            cursor: not-allowed;
        }
        .blurred-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: red;
            text-shadow: 2px 2px #ffffff;
            font-weight: bold;
            font-size: 14px;
            z-index: 99;
            width: 100%;
            text-align: center;
        }
    </style>

</head>


<body>
    <div class="container body">


        <div class="main_container">

            <div class="left_col">
                <div class="left_col scroll-view" style="">

                   
                    <div class="clearfix"></div>


                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                        <div class="menu_section">

                            <ul class="nav side-menu">
                                <div style="padding: 5px;">
                                    <img style="width: 100%;" src="<?=base_url();?>assets/images/napito_logo.jpg">
                                </div>
                                <li id="dashboard" class="<?php if(empty(array_intersect(['salon-dashboard-new'], $feature_slugs))) { echo 'blurred '; }?>"><a href="<?= base_url(); ?>salon-dashboard-new"><i class="fa fa-dashboard"></i><b>Dashboard</b></a></li>   
                                <!-- <li id="services">
                                    <a><i class="fa-brands fa-servicestack nav-icon"></i><b class="nav-title">Services
                                      </b><span class="fa fa-chevron-down down-icon"></span></a>
                                    <ul class="nav child_menu" style="display: none">
										<h4>Services</h4>
                                        <li><a class="add_special_service" href="<?= base_url(); ?>add-special-service">Add Special Service</a></li>
                                        <li><a class="add-sup-catagory" href="<?= base_url(); ?>add-sup-category">Add Services Category</a></li>
                                          <li><a class="add_service_sub_category" href="<?=base_url();?>add_service_sub_category">Add Services Sub Category</a></li>
                                          <li><a class="add-sub-category" href="<?= base_url(); ?>add-sub-category"> Add Services</a></li>
                                        <li><a class="add_package" href="<?= base_url(); ?>add-package">Add Package</a></li>
                                       <li><a class="package_list" href="<?= base_url(); ?>package-list">Package List</a></li>
										  <li><a class="add_coupon_code" href="<?= base_url(); ?>add-coupon-code">Add Coupon Code</a></li>
										  <li><a class="add_reward_point" href="<?= base_url(); ?>add-reward-point">Add Reward Points</a></li>
                                    </ul>
                                </li> -->
                                <!-- <li id="employee">
                                    <a><i class="fa-solid fa-users nav-icon"></i><b class="nav-title">Employee</b><span class="fa fa-chevron-down down-icon"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <h4 class="headings">Setting</h4>
                                            <li><a class="add_shift" href="<?= base_url(); ?>add-shift">Manage Employee Shift </a></li>
                                            <li><a class="add_designation" href="<?= base_url(); ?>add-designation">Add Designation</a></li>
                                            <li><a class="add_facilities" href="<?= base_url(); ?>add-facilities">Add Facilities</a></li>
                                            <li><a class="add-customer-discount" href="<?= base_url(); ?>add-customer-discount">Add Customer Discount</a></li>
                                    </ul>
                                </li> -->
                                
                                <li id="booking_management" class="<?php if(empty(array_intersect(['add-new-booking-new'], $feature_slugs))) { echo 'blurred '; }?>active"><a  class="add_new_booking" href="<?= base_url(); ?>add-new-booking-new"><i class="fa-solid fa-calendar-days nav-icon"></i><b class="nav-title">Booking</b><span class="fa fa-chevron-down down-icon"></span></a></li>
                                <?php $check_array = ['asign-membership','asign-membership-list','asign-package','asign-package-list','asign-giftcard-list']; ?>
                                <li id="asign_membership" class="<?php if(empty(array_intersect($check_array, $feature_slugs))) { echo 'blurred '; }?>"><a><i class="fa-brands fa-servicestack nav-icon"></i><b class="nav-title">Assign Membership & Package </b><span class="fa fa-chevron-down down-icon"></span></a>
                                <ul class="nav child_menu" style="display: none">
                                        <h4>Assign Membership</h4>
                                        <li><a class="<?php if(empty(array_intersect(['asign-membership'], $feature_slugs))) { echo 'blurred '; }?>asign_membership" href="<?= base_url(); ?>asign-membership">Assign Membership</a></li>
                                        <li><a class="<?php if(empty(array_intersect(['asign-membership-list'], $feature_slugs))) { echo 'blurred '; }?>asign_membership_list" href="<?= base_url(); ?>asign-membership-list">Assign Membership List</a></li>
                                        <h4>Assign Package</h4>
                                        <li><a class="<?php if(empty(array_intersect(['asign-package'], $feature_slugs))) { echo 'blurred '; }?>asign_package" href="<?= base_url(); ?>asign-package">Assign Package</a></li>
                                        <li><a class="<?php if(empty(array_intersect(['asign-package-list'], $feature_slugs))) { echo 'blurred '; }?>asign_package_list" href="<?= base_url(); ?>asign-package-list">Assign Package List</a></li>
                                        <h4>Assign Giftcard</h4>
                                        <li><a class="<?php if(empty(array_intersect(['asign-giftcard-list'], $feature_slugs))) { echo 'blurred '; }?>asign_giftcard" href="<?= base_url(); ?>asign-giftcard-list">Assign Giftcard List</a></li>
                                    </ul>
                                </li> 


                               


                                <?php $check_array = ['add-salon-expense','salon-expense-list']; ?>
                                <li class="<?php if(empty(array_intersect($check_array, $feature_slugs))) { echo 'blurred '; }?>" id="expenses"><a><i class="fa-solid fa-podcast nav-icon"></i><b class="nav-title">Expense </b><span class="fa fa-chevron-down down-icon"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <h4>Expense</h4>
                                        <li><a class="<?php if(empty(array_intersect(['add-salon-expense'], $feature_slugs))) { echo 'blurred '; }?>add_salon_expense" href="<?= base_url(); ?>add-salon-expense">Add Expense</a></li>
                                        <li><a class="<?php if(empty(array_intersect(['salon-expense-list'], $feature_slugs))) { echo 'blurred '; }?>salon-expense-list" href="<?= base_url(); ?>salon-expense-list">Expense List</a></li>
                                    </ul>
                                </li> 
                                <?php $check_array = ['add-enquiry-form','all-enquiries']; ?>
                                <li id="enquiry" class="<?php if(empty(array_intersect($check_array, $feature_slugs))) { echo 'blurred '; }?>"><a><i class="fa-solid fa-question-circle nav-icon"></i><b class="nav-title">Enquiry
                                            </b><span class="fa fa-chevron-down down-icon"></span></a>
                                    <ul class="nav child_menu" style="display: none">
									<h4>Enquiry</h4>
                                        <li><a class="<?php if(empty(array_intersect(['add-enquiry-form'], $feature_slugs))) { echo 'blurred '; }?>add_enquiry" href="<?= base_url(); ?>add-enquiry-form">Add Enquiry</a></li>
                                        <li><a class="<?php if(empty(array_intersect(['all-enquiries'], $feature_slugs))) { echo 'blurred '; }?>all_enquiry" href="<?= base_url(); ?>all-enquiries">All Enquiries</a></li>
                                    </ul>
                                </li>
                                <?php $check_array = ['employee-attendance','add_staff_attendance','salon-leaves-list','add_staff_leave']; ?>
                                <li id="attendance" class="<?php if(empty(array_intersect($check_array, $feature_slugs))) { echo 'blurred '; }?>"><a><i class="fa-solid fa-calendar-check nav-icon"></i><b class="nav-title">Attendance
                                            </b><span class="fa fa-chevron-down down-icon"></span></a>
                                    <ul class="nav child_menu" style="display: none">
									<h4>Attendance</h4>
                                        <li><a class="<?php if(empty(array_intersect(['employee-attendance'], $feature_slugs))) { echo 'blurred '; }?>staff_attendance"  href="<?= base_url(); ?>employee-attendance">Attendance</a></li>
                                        <li><a class="<?php if(empty(array_intersect(['add_staff_attendance'], $feature_slugs))) { echo 'blurred '; }?>attendance_list"  href="<?= base_url(); ?>add_staff_attendance">Add Attendance</a></li>
                                        <li><a class="<?php if(empty(array_intersect(['add_staff_leave'], $feature_slugs))) { echo 'blurred '; }?>add_weekly_off"  href="<?= base_url(); ?>add_staff_leave">Apply Leave</a></li>
                                        <li><a class="<?php if(empty(array_intersect(['salon-leaves-list'], $feature_slugs))) { echo 'blurred '; }?>weekly_off_list"  href="<?= base_url(); ?>salon-leaves-list">All Leaves</a></li>
                                    </ul>
                                </li>
                                <?php $check_array = ['birthday','anniversary','cancel_appointment','service_repeat','lost_customer','offer','customize_message']; ?>
                                <li id="marketing" class="<?php if(empty(array_intersect($check_array, $feature_slugs))) { echo 'blurred '; }?>"><a><i class="fa-solid fa-chart-simple"></i><b class="nav-title">Marketing </b><span class="fa fa-chevron-down down-icon"></span></a>
                                    <ul class="nav child_menu" style="display: none">
									<h4>Customer</h4>
                                    <li><a  class="<?php if(empty(array_intersect(['birthday'], $feature_slugs))) { echo 'blurred '; }?>birthday-setup" href="<?= base_url(); ?>birthday">Birthday</a></li>
                                    <li><a  class="<?php if(empty(array_intersect(['anniversary'], $feature_slugs))) { echo 'blurred '; }?>anniversary-setup" href="<?= base_url(); ?>anniversary">Anniversary</a></li>
                                    <li><a  class="<?php if(empty(array_intersect(['service_repeat'], $feature_slugs))) { echo 'blurred '; }?>service-repeat-setup" href="<?= base_url(); ?>service_repeat">Service Repeat</a></li>
                                    <li><a  class="<?php if(empty(array_intersect(['cancel_appointment'], $feature_slugs))) { echo 'blurred '; }?>cancel-appointment-setup" href="<?= base_url(); ?>cancel_appointment">Cancel Appointment</a></li>
                                    <li><a  class="<?php if(empty(array_intersect(['lost_customer'], $feature_slugs))) { echo 'blurred '; }?>lost-customer-setup" href="<?= base_url(); ?>lost_customer">Lost Customer</a></li>
                                    <li><a  class="<?php if(empty(array_intersect(['offer'], $feature_slugs))) { echo 'blurred '; }?>offer-setup" href="<?=base_url(); ?>offer">Offer</a></li>
                                    <li><a  class="<?php if(empty(array_intersect(['customize_message'], $feature_slugs))) { echo 'blurred '; }?>customize-message-setup" href="<?= base_url(); ?>customize_message">Customize Message</a></li>
                                    </ul>
                                </li> 
                                <?php $check_array = ['low_stock_products','add-product-stock','add-product-consumption','product-stock-list','product-barcode','supplier-management']; ?>
                                <li id="inventory" class="<?php if(empty(array_intersect($check_array, $feature_slugs))) { echo 'blurred '; }?>"><a><i class="fa-solid fa-warehouse nav-icon"></i><b class="nav-title">Product Inventory
                                            </b><span class="fa fa-chevron-down down-icon"></span></a>
                                    <ul class="nav child_menu" style="display: none">
									<h4>Product Inventory</h4>
                                        <li><a  class="<?php if(empty(array_intersect(['add-product-stock'], $feature_slugs))) { echo 'blurred '; }?>product-inward" href="<?= base_url(); ?>add-product-stock">Product Inward</a></li>
                                        <li><a  class="<?php if(empty(array_intersect(['add-product-consumption'], $feature_slugs))) { echo 'blurred '; }?>product-consumption" href="<?= base_url(); ?>add-product-consumption">Product Consumption</a></li>  
                                        <li><a  class="<?php if(empty(array_intersect(['product-stock-list'], $feature_slugs))) { echo 'blurred '; }?>product-stock-entries" href="<?= base_url(); ?>product-stock-list">Product Stock Entries</a></li>
                                        <li><a  class="<?php if(empty(array_intersect(['product-barcode'], $feature_slugs))) { echo 'blurred '; }?>product-stock" href="<?= base_url(); ?>product-barcode">Product Stock Ledger</a></li>  
                                        <li><a  class="<?php if(empty(array_intersect(['supplier-management'], $feature_slugs))) { echo 'blurred '; }?>product-suppliers" href="<?= base_url(); ?>supplier-management">Supplier Management</a></li>
                                    </ul>
                                </li>
                                <?php $check_array = [
                                    'booking-list','transfer-bookings','product-booking-list','customer-list','add-payment',
                                    'petty-cash','sales-report','employee-report','customer-report','consent-form'
                                ]; ?>
                                <li id="reports" class="<?php if(empty(array_intersect($check_array, $feature_slugs))) { echo 'blurred '; }?>"><a><i class="fa-solid fa-file-invoice nav-icon"></i><b class="nav-title">Reports
                                            </b><span class="fa fa-chevron-down down-icon"></span></a>
                                    <ul class="nav child_menu" style="display: none">
									<h4>Reports</h4>
                                        <li><a  class="<?php if(empty(array_intersect(['petty-cash'], $feature_slugs))) { echo 'blurred '; }?>petty-cash" href="<?= base_url(); ?>petty-cash">Petty Cash</a></li>
                                        <li><a  class="<?php if(empty(array_intersect(['sales-report'], $feature_slugs))) { echo 'blurred '; }?>sales-report" href="<?= base_url(); ?>sales-report">Sales</a></li>
                                        <li><a  class="<?php if(empty(array_intersect(['employee-report'], $feature_slugs))) { echo 'blurred '; }?>employee-report" href="<?= base_url(); ?>employee-report">Employee</a></li>
                                        <li><a  class="<?php if(empty(array_intersect(['customer-report'], $feature_slugs))) { echo 'blurred '; }?>customer-reports" href="<?= base_url(); ?>customer-report">Customer</a></li>                             
                                        
                                        <h4>Bookings</h4>
                                        <li><a  class="<?php if(empty(array_intersect(['booking-list'], $feature_slugs))) { echo 'blurred '; }?>booking-lists" href="<?= base_url(); ?>booking-list">All Bookings</a></li>
                                        <li><a  class="<?php if(empty(array_intersect(['transfer-bookings'], $feature_slugs))) { echo 'blurred '; }?>transfer-bookings" href="<?= base_url(); ?>transfer-bookings">Tranfer Bookings</a></li>
                                        <li><a  class="<?php if(empty(array_intersect(['product-booking-list'], $feature_slugs))) { echo 'blurred '; }?>product-booking-lists" href="<?= base_url(); ?>product-booking-list">All Product Bookings</a></li>
                                        <li><a  class="<?php if(empty(array_intersect(['customer-list'], $feature_slugs))) { echo 'blurred '; }?>customer-list" href="<?= base_url(); ?>customer-list">All Customers</a></li>
                                        <li><a  class="<?php if(empty(array_intersect(['add-payment'], $feature_slugs))) { echo 'blurred '; }?>add-payment" href="<?= base_url(); ?>add-payment">Add Payment</a></li>   
                                        <li><a  class="<?php if(empty(array_intersect(['consent-form'], $feature_slugs))) { echo 'blurred '; }?>consent-form" href="<?= base_url(); ?>consent-form">Consent Forms</a></li>   
                                    </ul>

                                </li>
                                <!-- <li id="Membership"><a><i class="fa-solid fa-globe nav-icon"></i><b class="nav-title">Membership</b><span class="fa fa-chevron-down down-icon"></span></a>
                                    <ul class="nav child_menu" style="display: none">
									<h4>Membership</h4>
                                    <li><a  class="add_membership" href="<?= base_url(); ?>add-membership">Add Membership</a></li>
                                    <li><a  class="membership_list" href="<?= base_url(); ?>membership-list">Membership List</a></li>
                                    </ul>
                                </li>
                                <li id="gift"><a><i class="fa-solid fa-gift nav-icon"></i><b class="nav-title">Gift Card</b><span class="fa fa-chevron-down down-icon"></span></a>
                                    <ul class="nav child_menu" style="display: none">
									<h4>Gift Card</h4>
                                    <li><a  class="add_gift_card" href="<?= base_url(); ?>add-gift-card">Add Gift Card</a></li>
                                    <li><a  class="gift_card_list" href="<?= base_url(); ?>gift-card-list">Gift Card List</a></li>
                                    </ul>
                                </li>                                                                                                      
                                <li id="offers-mngt"><a><i class="fa-solid fa-bomb nav-icon"></i><b class="nav-title">Offer</b><span class="fa fa-chevron-down down-icon"></span></a>
                                    <ul class="nav child_menu" style="display: none">
									<h4>Offer</h4>
                                    <li><a class="add_offers" href="<?= base_url(); ?>add-offers">Add Offer</a></li>
										  <li><a class="offers_list" href="<?= base_url(); ?>offers-list">Offers List</a></li>
                                    </ul>
                                </li> -->

                                <?php $check_array = [
                                    'add-salon-services','add-product','add-package','add-membership','add-gift-card','add-offers','add-reward-point','add-coupon-code',
                                    'add_employee','employee_loan','generate_salary_slip','salon-salary-list','add-designation','add-reminder-form','add-course','course-list','add-student',
                                    'student-list','payment-history','payment-entry','store-profile','store-booking-rules','working-hours','salon-bank-details','salon-location',
                                    'add-salon-facility', 'store-images','store-reviews-list','salon-mobile-banner','coin_history','add-catlogue-salon'
                                ]; ?>
                                <li id="back-office" class="<?php if(empty(array_intersect($check_array, $feature_slugs))) { echo 'blurred '; }?>"><a><i class="fa-solid fa-building nav-icon"></i><b class="nav-title">Back Office</b><span class="fa fa-chevron-down down-icon"></span></a>
                                    <!-- <ul class="nav child_menu" style="display: none"> -->
									<!-- <h4>Master</h4> -->
                                                            <!-- <li><h5 style="margin-left:20px;">Marketing</h5></li> -->
                                    <!-- <li><a  class="service-setup" href="<?= base_url(); ?>add-salon-services">Service Setup</a></li>
                                    <li><a  class="product-setup" href="<?= base_url(); ?>add-product">Product Setup</a></li>
                                    <li><a  class="package-setup" href="<?= base_url(); ?>add-package">Package</a></li>   -->
                                                            <!--<li><a  class="membership-setup" href="<?= base_url(); ?>add-membership">Membership</a></li>  -->
                                    <!-- <li><a  class="gift-setup" href="<?= base_url(); ?>add-gift-card">Gift Card</a></li>  
                                    <li><a  class="offers-setup" href="<?= base_url(); ?>add-offers">Offers</a></li>  
                                    <li><a  class="reward-setup" href="<?= base_url(); ?>add-reward-point">Reward Point</a></li>  
                                    <li><a  class="coupon-setup" href="<?= base_url(); ?>add-coupon-code">Coupon</a></li>  
                                    <li><a  class="membership-setup" href="<?= base_url(); ?>add-membership">Membership</a></li>   -->

                                                            <!--<li><a  class="add-booking-status" href="<?= base_url(); ?>set-booking-status">Add Booking Status</a></li>-->  
                                                            <!-- <li><a  class="expense-setup" href="<?= base_url(); ?>add-salon-expense">Expense</a></li>   -->
                                    <!-- <h4>Customer Billing</h4>
                                    <li><a  class="employee-setup" href="<?= base_url(); ?>booking-list">All Bookings</a></li>
                                    <li><a  class="product-setup" href="<?= base_url(); ?>customer-list">All Customers</a></li>
                                    <li><a  class="product-setup" href="<?= base_url(); ?>add-payment">Add Payment</a></li> -->
                                                            <!-- <li><a  class="package-setup" href="<?= base_url(); ?>add-customer">Add Customer</a></li>   -->
                                    <!-- <h4>Employee Setup</h4>
                                    <li><a  class="employee-setup" href="<?= base_url(); ?>add_employee_list">Manage Employee</a></li> -->
                                                            <!-- <li><a  class="product-setup" href="<?= base_url(); ?>add-product">Manage Customer</a></li> -->
                                                            <!-- <li><a  class="package-setup" href="<?= base_url(); ?>add-package">Store Setting</a></li>   -->
                                    <!-- <h4>Store Setting</h4>
                                    <li><a  class="store-profile" href="<?= base_url(); ?>store-profile">Store Profile</a></li>
                                    <li><a  class="working-hours" href="<?= base_url(); ?>working-hours">Working Hours</a></li>
                                    <li><a  class="salon-bank-details" href="<?= base_url(); ?>salon-bank-details">Bank Details</a></li>
                                    <li><a  class="salon-location" href="<?= base_url(); ?>salon-location">Location</a></li> -->
                                                            <!--<li><a  class="booking-rules" href="<?= base_url(); ?>booking-rules">Booking Rules</a></li>-->

                                    <!-- </ul> -->


                                    <ul class="nav child_menu" style="display: none">
                                        <h4>Master</h4>                                  
                                        <li><a  class="<?php if(empty(array_intersect(['add-salon-services'], $feature_slugs))) { echo 'blurred '; }?>service-setup" href="<?= base_url(); ?>add-salon-services">Service Setup</a></li>
                                        <li><a  class="<?php if(empty(array_intersect(['add-product'], $feature_slugs))) { echo 'blurred '; }?>product-setup" href="<?= base_url(); ?>add-product">Product Setup</a></li>
                                        <li><a  class="<?php if(empty(array_intersect(['add-package'], $feature_slugs))) { echo 'blurred '; }?>package-setup" href="<?= base_url(); ?>add-package">Package</a></li>  
                                        <li><a  class="<?php if(empty(array_intersect(['add-membership'], $feature_slugs))) { echo 'blurred '; }?>membership-setup" href="<?= base_url(); ?>add-membership">Membership</a></li>    
                                    
                                        <h4>Marketing</h4>
                                        <li><a  class="<?php if(empty(array_intersect(['add-gift-card'], $feature_slugs))) { echo 'blurred '; }?>gift-setup" href="<?= base_url(); ?>add-gift-card">Gift Card</a></li>  
                                        <li><a  class="<?php if(empty(array_intersect(['add-offers'], $feature_slugs))) { echo 'blurred '; }?>offers-setup" href="<?= base_url(); ?>add-offers">Offers</a></li>  
                                        <li><a  class="<?php if(empty(array_intersect(['add-reward-point'], $feature_slugs))) { echo 'blurred '; }?>reward-setup" href="<?= base_url(); ?>add-reward-point">Reward Point</a></li>  
                                        <li><a  class="<?php if(empty(array_intersect(['add-coupon-code'], $feature_slugs))) { echo 'blurred '; }?>coupon-setup" href="<?= base_url(); ?>add-coupon-code">Coupon</a></li>      

                                        <h4>Employee</h4>
                                        <li><a class="<?php if(empty(array_intersect(['add_employee'], $feature_slugs))) { echo 'blurred '; }?>employee-setup" href="<?= base_url(); ?>add_employee">Manage Employee</a></li>
                                        <li><a class="<?php if(empty(array_intersect(['employee_loan'], $feature_slugs))) { echo 'blurred '; }?>employee-loan" href="<?= base_url(); ?>employee_loan">Loan Management</a></li>
                                        <li><a class="<?php if(empty(array_intersect(['generate_salary_slip'], $feature_slugs))) { echo 'blurred '; }?>cc_generate_salary_slip" href="<?= base_url(); ?>generate_salary_slip">Generate Salary</a></li>
                                        <li><a class="<?php if(empty(array_intersect(['salon-salary-list'], $feature_slugs))) { echo 'blurred '; }?>cc_salon_salary_list" href="<?= base_url(); ?>salon-salary-list">Salary Slips</a></li>
                                        <li><a class="<?php if(empty(array_intersect(['add-designation'], $feature_slugs))) { echo 'blurred '; }?>add_designation" href="<?= base_url(); ?>add-designation">Designations</a></li>  

                                        <h4>General Reminder</h4>
                                        <li><a  class="<?php if(empty(array_intersect(['add-reminder-form'], $feature_slugs))) { echo 'blurred '; }?>reminder-setup" href="<?= base_url(); ?>add-reminder-form">General Reminders</a></li>
                                        <!-- <li><a  class="service-setup" href="<?= base_url(); ?>all-reminders">All Reminders</a></li> -->   

                                        <h4>Course</h4>
                                        <li><a  class="<?php if(empty(array_intersect(['add-course'], $feature_slugs))) { echo 'blurred '; }?>add_course" href="<?= base_url(); ?>add-course">Add Course</a></li>
                                        <li><a  class="<?php if(empty(array_intersect(['course-list'], $feature_slugs))) { echo 'blurred '; }?>course_list" href="<?= base_url(); ?>course-list">Course List</a></li>
										<li><a  class="<?php if(empty(array_intersect(['add-student'], $feature_slugs))) { echo 'blurred '; }?>add_student" href="<?= base_url(); ?>add-student">Add Student</a></li>
                                        <li><a  class="<?php if(empty(array_intersect(['student-list'], $feature_slugs))) { echo 'blurred '; }?>student_list" href="<?= base_url(); ?>student-list">Student List</a></li>
                                        <li><a  class="<?php if(empty(array_intersect(['payment-history'], $feature_slugs))) { echo 'blurred '; }?>payment-history" href="<?= base_url(); ?>payment-history">Allocated Courses</a></li>  
                                        <li><a  class="<?php if(empty(array_intersect(['payment-entry'], $feature_slugs))) { echo 'blurred '; }?>payment_entry" href="<?= base_url(); ?>payment-entry">Make Payment</a></li>
                                        <!-- <li><a  class="fees-history" href="<?= base_url(); ?>fees-history">Fees List</a></li> -->  

                                        <h4>Store Setting</h4>
                                        <li><a  class="<?php if(empty(array_intersect(['store-profile'], $feature_slugs))) { echo 'blurred '; }?>store-profile" href="<?= base_url(); ?>store-profile">Store Profile</a></li>
                                        <li><a  class="<?php if(empty(array_intersect(['store-booking-rules'], $feature_slugs))) { echo 'blurred '; }?>store-booking-rules" href="<?= base_url(); ?>store-booking-rules">Booking Rules</a></li>
                                        <li><a  class="<?php if(empty(array_intersect(['working-hours'], $feature_slugs))) { echo 'blurred '; }?>working-hours" href="<?= base_url(); ?>working-hours">Working Hours</a></li>
                                        <li><a  class="<?php if(empty(array_intersect(['salon-bank-details'], $feature_slugs))) { echo 'blurred '; }?>salon-bank-details" href="<?= base_url(); ?>salon-bank-details">Bank Details</a></li>
                                        <li><a  class="<?php if(empty(array_intersect(['salon-location'], $feature_slugs))) { echo 'blurred '; }?>salon-location" href="<?= base_url(); ?>salon-location">Location</a></li>     
                                        <li><a  class="<?php if(empty(array_intersect(['store-images'], $feature_slugs))) { echo 'blurred '; }?>store-images" href="<?= base_url(); ?>store-images">Store Gallary</a></li>   
                                        <li><a  class="<?php if(empty(array_intersect(['add-salon-facility'], $feature_slugs))) { echo 'blurred '; }?>add-salon-facility" href="<?= base_url(); ?>add-salon-facility">Store Facilities</a></li>   
                                        <li><a  class="<?php if(empty(array_intersect(['store-reviews-list'], $feature_slugs))) { echo 'blurred '; }?>store-reviews" href="<?= base_url(); ?>store-reviews-list">Store Reviews</a></li> 
                                        <li><a  class="<?php if(empty(array_intersect(['coin_history'], $feature_slugs))) { echo 'blurred '; }?>coin_history" href="<?= base_url(); ?>coin_history">Store Coins</a></li> 
                                        <li><a  class="<?php if(empty(array_intersect(['salon-mobile-banner'], $feature_slugs))) { echo 'blurred '; }?>app-banner" href="<?= base_url(); ?>salon-mobile-banner">Mobile App Banner</a></li> 
                                        <li><a  class="<?php if(empty(array_intersect(['add-catlogue-salon'], $feature_slugs))) { echo 'blurred '; }?>add-catlogue-salon" href="<?= base_url(); ?>add-catlogue-salon">Mobile App Catlogue</a></li> 
                                                
                                    </ul>
                                </li>
                                
                                <li id="salon_logout" class="<?php if(empty(array_intersect(['salon_do_logout'], $feature_slugs))) { echo 'blurred '; }?>"><a href="<?= base_url(); ?>salon_do_logout"><i class="fa fa-sign-out"></i><b> Log Out</b></a>
                                </li>
                            </ul>  
                        </div>


                    </div>
                    <!-- /sidebar menu -->


                    
                </div>
            </div>
            <?php if(!empty(array_intersect(['low_stock_marquee'], $feature_slugs))) { ?>
            <?php if(!empty($low_stock_products)){ ?>
			<div class="header_sticky">
				<marquee onmouseover="this.stop();" onmouseout="this.start();" style="background-color: #ffbfbf;padding: 5px; color:black;">
                    <?php  
                    $first = true;
                    foreach($low_stock_products as $low_stock_products_result){
                        if (!$first) {
                            echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                        }
                        echo $low_stock_products_result->product_name . ' stock is under low stock <a style="font-size:12px;color:#0000ff;text-decoration:underline;" href="'.base_url().'add-product-stock?product='.$low_stock_products_result->id.'">Inward</a>';
                        $first = false;
                    }
                    ?>    
                </marquee>
			</div>
            <?php }} ?>    

  

