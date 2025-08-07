<?php
$this->Salon_model->set_store_booking_rules($this->session->userdata('branch_id'), $this->session->userdata('salon_id'));
$profile = $this->Salon_model->get_user_profile();
$low_stock_products = $this->Salon_model->get_low_stock_products();
?>
<?php
$store_category = $this->Salon_model->get_store_category_new();
$salon_service_genders = [];
if (!empty($store_category)) {
    if ($store_category->category == '2') {
        $salon_service_genders = ['0', '1'];
    } else {
        $salon_service_genders = [$store_category->category];
    }
}
$gst = $this->Salon_model->get_store_category();
$branch_list = $this->Salon_model->get_store_category();
$staff_count = $this->Salon_model->get_salon_all_staff();
$feature_slugs = explode(',', $this->session->userdata('subscription_feature_slugs'));

$profile_name = '';
$footer_onboarding_status = '';
$payment_modes = [];
if (!empty($profile)) {
    $footer_onboarding_status = $profile->onboarding_status;
    $profile_name = $profile->branch_name;
    $payment_modes = $profile->payment_options != "" ? explode(',', $profile->payment_options) : [];
}


$req_customers = '';
$current_wp_coins_balance = 0;
$is_emergency_bill_allowed = false;
$emergency_bill_count = 0;
$wp_ticker = '0';
if (!empty($profile) && $profile->subscription_name != "") {
    $current_wp_coins_balance = $profile->current_wp_coins_balance;
    $feature_slugs = $this->Salon_model->get_subscription_slugs($profile->subscription_id);
    $setup = $this->Master_model->get_backend_setups();
    if (!empty($setup) && $setup->emergency_bill_count != "") {
        $emergency_bill_count = $setup->emergency_bill_count;
    }
    if ($profile->include_wp == "1") {
        if (!empty($setup) && $setup->wp_low_qty_value != "") {
            $wp_low_qty_value = $setup->wp_low_qty_value;
        } else {
            $wp_low_qty_value = 25;
        }
        $wp_coins_qty = $profile->wp_coins_qty != "" ? (int)$profile->wp_coins_qty : 0;
        $wp_low_qty_value = ($wp_low_qty_value * $wp_coins_qty) / 100;
        $wp_ticker = $wp_low_qty_value >= $current_wp_coins_balance ? '1' : '0';
    }
    if (!empty(array_intersect(['money-back-1000'], $feature_slugs))) {
        $req_customers = 1000;
        if (!empty($setup) && $setup->money_back_1000_value != "") {
            $req_customers = (int)$setup->money_back_1000_value;
        }
    } elseif (!empty(array_intersect(['money-back-1500'], $feature_slugs))) {
        $req_customers = 1500;
        if (!empty($setup) && $setup->money_back_1500_value != "") {
            $req_customers = (int)$setup->money_back_1500_value;
        }
    } elseif (!empty(array_intersect(['money-back-2000'], $feature_slugs))) {
        $req_customers = 2000;
        if (!empty($setup) && $setup->money_back_2000_value != "") {
            $req_customers = (int)$setup->money_back_2000_value;
        }
    } elseif (!empty(array_intersect(['money-back-2500'], $feature_slugs))) {
        $req_customers = 2500;
        if (!empty($setup) && $setup->money_back_2500_value != "") {
            $req_customers = (int)$setup->money_back_2500_value;
        }
    }
}

$current_total_emergency_bills = $this->Salon_model->get_current_total_emergency_bills();
if ($current_total_emergency_bills < $emergency_bill_count) {
    $is_emergency_bill_allowed = true;
}

$redirect = '';
if ($footer_onboarding_status == '16') {
    $redirect = '?redirect=complete-profile';
}

$steps = [
    ["flag" => "0", "name" => "Registration", "link" => base_url() . "complete-profile", "next_link" => "store-profile", "check_array" => []],
    ["flag" => "1", "name" => "Store Profile", "link" => base_url() . "store-profile", "next_link" => "working-hours", "check_array" => ['store-profile']],
    ["flag" => "2", "name" => "Working Hours", "link" => base_url() . "working-hours", "next_link" => "salon-bank-details", "check_array" => ['working-hours']],
    ["flag" => "3", "name" => "Bank Details", "link" => base_url() . "salon-bank-details", "next_link" => "salon-location", "check_array" => ['salon-bank-details']],
    ["flag" => "4", "name" => "Store Location", "link" => base_url() . "salon-location", "next_link" => "add-salon-facility", "check_array" => ['salon-location']],
    ["flag" => "5", "name" => "Store Facilities", "link" => base_url() . "add-salon-facility", "next_link" => "working-hours?active=add_shifts_page", "check_array" => ['add-salon-facility']],
    ["flag" => "6", "name" => "Shifts", "link" => base_url() . "working-hours?active=add_shifts_page", "next_link" => "add-product", "check_array" => ['working-hours']],
    ["flag" => "7", "name" => "Products", "link" => base_url() . "add-product", "next_link" => "add-salon-services", "check_array" => ['add-product', 'product-list', 'use_ready_product_sub_cat', 'use_ready_product_cat']],
    ["flag" => "8", "name" => "Services", "link" => base_url() . "add-salon-services", "next_link" => "add-membership", "check_array" => ['add-salon-services', 'salon-services-list', 'ready-sub-category', 'ready-services']],
    ["flag" => "9", "name" => "Memberships", "link" => base_url() . "add-membership", "next_link" => "add-package", "check_array" => ['add-membership']],
    ["flag" => "10", "name" => "Packages", "link" => base_url() . "add-package", "next_link" => "add-coupon-code", "check_array" => ['add-package']],
    ["flag" => "11", "name" => "Coupons", "link" => base_url() . "add-coupon-code", "next_link" => "add-offers", "check_array" => ['add-coupon-code']],
    ["flag" => "12", "name" => "Offers", "link" => base_url() . "add-offers", "next_link" => "add-gift-card", "check_array" => ['add-offers']],
    ["flag" => "13", "name" => "Giftcard", "link" => base_url() . "add-gift-card", "next_link" => "add-reward-point", "check_array" => ['add-gift-card']],
    ["flag" => "14", "name" => "Rewards", "link" => base_url() . "add-reward-point", "next_link" => "add_automated_marketing?type=all", "check_array" => ['add-reward-point']],
    ["flag" => "15", "name" => "Automated Marketing", "link" => base_url() . "add_automated_marketing?type=all", "next_link" => "employee_incentive_master", "check_array" => ['add_automated_marketing']],
    ["flag" => "16", "name" => "Employee Incentives", "link" => base_url() . "employee_incentive_master", "next_link" => "add_employee", "check_array" => ['employee_incentive_master']],
    ["flag" => "17", "name" => "Employees", "link" => base_url() . "add_employee" . $redirect, "next_link" => "add-course", "check_array" => ['add_employee', 'add_employee_list']],
    ["flag" => "18", "name" => "Academy Courses", "link" => base_url() . "add-course", "next_link" => "complete-profile?loader=true", "check_array" => ['add-course']]
];
$all_flags = array_column($steps, 'flag');

$next_status_flag = (int)$footer_onboarding_status + 1;
$next_status_index = array_search($next_status_flag, $all_flags);
if ($next_status_index !== false) {
    $skip_link = $steps[$next_status_index]['next_link'];
    $next_status_name = $steps[$next_status_index]['name'] . ' Setup';
} else {
    $skip_link = 'complete-profile';
    $next_status_name = ' Current Step';
}
?>
<!DOCTYPE html>
<html lang="en">



<head>
    <style>
        textarea {
            resize: none;
        }

        .hide_body {
            position: fixed;
            width: 100%;
            height: 100% !important;
            background: #00000042;
            z-index: 999;
            left: 0;
            top: 0;
        }

        .bill-dropdown {
            margin-top: 6px;
            position: fixed;
            z-index: 999;
            left: 135px;
            top: -5px;
            /* border: 1px solid; */
            /* background: #b0b0b000; */
        }

        .header_sticky .bill-dropdown a {
            color: #fff !important;
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

        .nav.side-menu>li>a,
        .nav.child_menu>li>a {
            color: white !important;
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
            top: 50px;
            right: 20px;
            transform: translateX(-15%);
            height: 50px;
            width: auto;
            display: flex;

            background-color: transparent;
        }

        .child_menu {
            display: block;
            height: 100vh;
            overflow: unset;
            overflow-y: scroll;
        }

        .chosen-container .chosen-results li.highlighted {
            background-image: none !important;
            background: #2c2b2b !important;
            color: white !important;



        }

        #skipButton {
            position: fixed;
            bottom: 10px;
            right: 30px;
        }

        li.blurred , li>a.blurred {
            position: relative;
            display: inline;
         
            overflow: hidden;
          
            pointer-events: unset !important;
        }

        li.blurred:hover , li>a.blurred:hover {
            backdrop-filter: blur(2px);
            background-color: rgba(255, 255, 255, 0.6);
        }

        li.blurred:hover::after {
            content: '\1F513 \A Upgrade Plan';
            position: absolute;
            top: 0;
            left: 0;
            text-align: center;
            width: 100%;
            height: 100%;
            white-space: pre;
            gap: 0.5em;

            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            z-index: 1050;
          
            pointer-events: auto;             

            background: #FF075E54;
            color: black;
            padding: 6px 14px;
            border-radius: 5px;
            font-size: 12px;
            font-weight: bold;
         
        }
        li>a.blurred:hover::after {
            content: '\1F513\00a0Upgrade Plan';
            position: absolute;
            top: 0;
            left: 0;
            text-align: center;
            width: 100%;
            height: 100%;
            white-space: pre;
            gap: 0.5em;

            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            z-index: 1050;
          
            pointer-events: auto;              

            /* background: black; */
            background: linear-gradient(271deg, #800080, #ff69b4) !important;
            color: black;
            padding: 6px 14px;
            border-radius: 5px;
            font-size: 12px;
            font-weight: bold;
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
    <link href="<?= base_url('assets/css/jquery-ui.css'); ?>" rel="stylesheet">
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
    <link href="https://cdn.jsdelivr.net/npm/jquery.filer@1.3.0/assets/fonts/jquery.filer-icons/jquery-filer.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/air-datepicker/dist/css/datepicker.min.css">
    <script src="<?= base_url() ?>salon_assets/js/jquery.min.js"></script>

    <script type="text/javascript" src="<?= base_url() ?>salon_assets/js/pdfmake.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>salon_assets/js/vfs_fonts.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>salon_assets/js/datatables.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tippy.js/6.3.1/tippy.css">
    <link rel="stylesheet" href="<?= base_url("salon_assets/css/responsive.css") ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
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
            z-index: 10000;
        }

        .blurred-wrapper {
            position: relative;
            display: inline-block;
        }

        .blurred-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            backdrop-filter: blur(2px);
            background-color: rgba(255, 255, 255, 0.6);
            display: flex;
            justify-content: center;
            align-items: center;
            pointer-events: auto;
            text-align: center;
            z-index: 10;
            transition: opacity 0.3s;
            opacity: 0;
        }

        .blurred-wrapper:hover .blurred-overlay {
            opacity: 1;
        }

        .blurred-overlay a {
            background: #FF075E54;
            color: black !important;
            padding: 6px 14px;
            border-radius: 5px;
            font-size: 12px;
            font-weight: bold;
            text-decoration: none;
        }

        .blurred {
            filter: blur(1px);
            pointer-events: none;
            position: relative;
            cursor: pointer;
        }

        .blurred-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: black !important;
            text-shadow: 2px 2px #ffffff;
            font-weight: bold;
            font-size: 12px;
            z-index: 99;
            width: 100%;
            text-align: center;
        }

        .div.dataTables_wrapper div.dataTables_paginate {
            margin-top: 10px !important;
        }

        .dataTables_paginate a {
            background-color: #fafafa !important;
            color: #93289b;
            border: 1px solid;
        }

        .dataTables_paginate span a.paginate_button.current {

            color: var(--white) !important;
            background: linear-gradient(271deg, #800080, #ff69b4) !important;
        }

        a#example_previous,
        a#example_next {
            background: #d8d8d8 !important;
        }

        table.dataTable {
            margin-bottom: 15px !important;
        }
    </style>

</head>


<body>
    <div class="container body">


        <div class="main_container">
            <?php if ($footer_onboarding_status >= '18' && $this->uri->segment(1) != "complete-profile") { ?>

                <div class="left_col">
                    <div class="left_col scroll-view" style="">


                        <div class="clearfix"></div>


                        <!-- sidebar menu -->
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                            <div class="menu_section">

                                <ul class="nav side-menu">
                                    <div class="side_logo">
                                        <img style="width: 100%;" src="<?= base_url(); ?>assets/images/napito_logo.jpg">
                                    </div>
                                    <li id="dashboard" class="<?php if (empty(array_intersect(['salon-dashboard-new'], $feature_slugs))) {
                                                                    echo 'blurred ';
                                                                } ?>"><a href="<?= base_url(); ?>salon-dashboard-new"><i class="fa fa-dashboard"></i><b>Dashboard</b></a></li>
                                    <!-- <li id="services">
                                    <a><i class="fa-brands fa-servicestack nav-icon"></i><b class="nav-title">Services
                                      </b><span class="fa fa-chevron-down down-icon"></span></a>
                                    <ul class="nav child_menu" style="display: none">
										<h4>Services</h4>
                                        <li><a class="add_special_service" href="<?= base_url(); ?>add-special-service">Add Special Service</a></li>
                                        <li><a class="add-sup-catagory" href="<?= base_url(); ?>add-sup-category">Add Services Category</a></li>
                                          <li><a class="add_service_sub_category" href="<?= base_url(); ?>add_service_sub_category">Add Services Sub Category</a></li>
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

                                    <li id="booking_management" class="<?php if (empty(array_intersect(['add-new-booking-new'], $feature_slugs))) {
                                                                            echo 'blurred ';
                                                                        } ?>active"><a class="add_new_booking" href="<?= base_url(); ?>add-new-booking-new"><i class="fa-solid fa-calendar-days nav-icon"></i><b class="nav-title">Bookings</b><span class="fa fa-chevron-down down-icon"></span></a></li>
                                    <!-- <li id="product_booking_management" class="<?php if (empty(array_intersect(['product-booking'], $feature_slugs))) {
                                                                                        echo 'blurred ';
                                                                                    } ?>active"><a class="add_new_product_booking" href="<?= base_url(); ?>product-booking"><i class="fa-solid fa-shopping-cart nav-icon"></i><b class="nav-title">Purchase Products</b><span class="fa fa-chevron-down down-icon"></span></a></li> -->
                                    <?php $check_array = ['bill-generation']; ?>
                                    <li id="generate_bill" class="<?php if (empty(array_intersect($check_array, $feature_slugs))) {
                                                                        echo 'blurred ';
                                                                    } ?>"><a><i class="fa-brands fa-servicestack nav-icon"></i><b class="nav-title">Billing</b><span class="fa fa-chevron-down down-icon"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <h4>Generate Bill <i style="float:right;cursor:pointer;" class="fas fa-angle-left"></i></h4>
                                            <li><a class="<?php if (empty(array_intersect(['bill-generation'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>generate_bill" href="<?= base_url(); ?>bill-generation">Generate Bill</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['bill-list'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>bill_list" href="<?= base_url(); ?>bill-list">Bills List</a></li>
                                        </ul>
                                    </li>
                                    <!-- <?php $check_array = ['asign-membership', 'asign-membership-list', 'asign-package', 'asign-package-list', 'asign-giftcard-list']; ?>
                                    <li id="asign_membership" class="<?php if (empty(array_intersect($check_array, $feature_slugs))) {
                                                                            echo 'blurred ';
                                                                        } ?>"><a><i class="fa-brands fa-servicestack nav-icon"></i><b class="nav-title">Assign Membership & Packages </b><span class="fa fa-chevron-down down-icon"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <h4>Assign Membership</h4>
                                            <li><a class="<?php if (empty(array_intersect(['asign-membership'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>asign_membership" href="<?= base_url(); ?>asign-membership">Assign Membership</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['asign-membership-list'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>asign_membership_list" href="<?= base_url(); ?>asign-membership-list">Assign Membership List</a></li>
                                            <h4>Assign Package</h4>
                                            <li><a class="<?php if (empty(array_intersect(['asign-package'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>asign_package" href="<?= base_url(); ?>asign-package">Assign Package</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['asign-package-list'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>asign_package_list" href="<?= base_url(); ?>asign-package-list">Assign Package List</a></li>
                                            <h4>Assign Giftcard</h4>
                                            <li><a class="<?php if (empty(array_intersect(['asign-giftcard'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>asign_giftcard" href="<?= base_url(); ?>asign-giftcard">Assign Giftcard</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['asign-giftcard-list'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>asign_giftcard_list" href="<?= base_url(); ?>asign-giftcard-list">Assign Giftcard List</a></li>
                                        </ul>
                                    </li> -->





                                    <?php $check_array = ['add-salon-expense', 'salon-expense-list']; ?>
                                    <li class="<?php if (empty(array_intersect($check_array, $feature_slugs))) {
                                                    echo 'blurred ';
                                                } ?>" id="expenses"><a><i class="fa-solid fa-podcast nav-icon"></i><b class="nav-title">Expenses </b><span class="fa fa-chevron-down down-icon"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <h4>Expenses <i style="float:right;cursor:pointer;" class="fas fa-angle-left"></i></h4>
                                            <li><a class="<?php if (empty(array_intersect(['add-salon-expense'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>add_salon_expense" href="<?= base_url(); ?>add-salon-expense">Add Expense</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['salon-expense-list'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>salon-expense-list" href="<?= base_url(); ?>salon-expense-list">Expense List</a></li>
                                        </ul>
                                    </li>
                                    <?php $check_array = ['add-enquiry-form', 'all-enquiries']; ?>
                                    <li id="enquiry" class="<?php if (empty(array_intersect($check_array, $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>"><a><i class="fa-solid fa-question-circle nav-icon"></i><b class="nav-title">Enquiries
                                            </b><span class="fa fa-chevron-down down-icon"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <h4>Enquiries <i style="float:right;cursor:pointer;" class="fas fa-angle-left"></i></h4>
                                            <li><a class="<?php if (empty(array_intersect(['add-enquiry-form'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>add_enquiry" href="<?= base_url(); ?>add-enquiry-form">Add Enquiry</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['all-enquiries'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>all_enquiry" href="<?= base_url(); ?>all-enquiries">All Enquiries</a></li>
                                        </ul>
                                    </li>
                                    <?php $check_array = ['low_stock_products', 'add-product-stock', 'add-product-consumption', 'product-stock-list', 'product-barcode', 'supplier-management']; ?>
                                    <li id="inventory" class="<?php if (empty(array_intersect($check_array, $feature_slugs))) {
                                                                    echo 'blurred ';
                                                                } ?>"><a><i class="fa-solid fa-warehouse nav-icon"></i><b class="nav-title">Product Inventory
                                            </b><span class="fa fa-chevron-down down-icon"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <h4>Product Inventory <i style="float:right;cursor:pointer;" class="fas fa-angle-left"></i></h4>
                                            <li><a class="<?php if (empty(array_intersect(['add-product-stock'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>product-inward" href="<?= base_url(); ?>add-product-stock">Product Inward</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['add-product-consumption'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>product-consumption" href="<?= base_url(); ?>add-product-consumption">Product Consumption</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['product-stock-list'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>product-stock-entries" href="<?= base_url(); ?>product-stock-list">Product Stock Entries</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['product-barcode'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>product-stock" href="<?= base_url(); ?>product-barcode">Product Stock Ledger</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['supplier-management'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>product-suppliers" href="<?= base_url(); ?>supplier-management">Supplier Management</a></li>
                                        </ul>
                                    </li>
                                    <?php $check_array = ['employee-attendance', 'add_staff_attendance', 'salon-leaves-list', 'add_staff_leave']; ?>
                                    <li id="attendance" class="<?php if (empty(array_intersect($check_array, $feature_slugs))) {
                                                                    echo 'blurred ';
                                                                } ?>"><a><i class="fa-solid fa-calendar-check nav-icon"></i><b class="nav-title">Attendance
                                            </b><span class="fa fa-chevron-down down-icon"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <h4>Attendance <i style="float:right;cursor:pointer;" class="fas fa-angle-left"></i></h4>
                                            <li><a class="<?php if (empty(array_intersect(['employee-attendance'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>staff_attendance" href="<?= base_url(); ?>employee-attendance">Attendance</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['add_staff_attendance'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>attendance_list" href="<?= base_url(); ?>add_staff_attendance">Add Attendance</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['add_staff_leave'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>add_weekly_off" href="<?= base_url(); ?>add_staff_leave">Apply Leave</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['salon-leaves-list'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>weekly_off_list" href="<?= base_url(); ?>salon-leaves-list">All Leaves</a></li>
                                        </ul>
                                    </li>
                                    <?php $check_array = ['booking-promotion', 'trying-booking', 'giftcards', 'coupons', 'birthday', 'anniversary', 'store-reviews-list', 'coin_history', 'salon-mobile-banner', 'add-catlogue-salon', 'store-images', 'cancel_appointment', 'service_repeat', 'lost_customer', 'offer', 'customize_message']; ?>
                                    <li id="marketing" class="<?php if (empty(array_intersect($check_array, $feature_slugs))) {
                                                                    echo 'blurred ';
                                                                } ?>"><a><i class="fa-solid fa-chart-simple"></i><b class="nav-title">Marketing </b><span class="fa fa-chevron-down down-icon"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <h4>Store <i style="float:right;cursor:pointer;" class="fas fa-angle-left"></i></h4>
                                            <li><a class="<?php if (empty(array_intersect(['store-reviews-list'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>store-reviews" href="<?= base_url(); ?>store-reviews-list">Store Reviews</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['store-images'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>store-images" href="<?= base_url(); ?>store-images">Store Gallary</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['salon-mobile-banner'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>app-banner" href="<?= base_url(); ?>salon-mobile-banner">Mobile App Banner</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['add-catlogue-salon'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>add-catlogue-salon" href="<?= base_url(); ?>add-catlogue-salon">Mobile App Catlogue</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['coin_history'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>coin_history" href="<?= base_url(); ?>coin_history">Store Coins</a></li>

                                            <h4>Client <i style="float:right;cursor:pointer;" class="fas fa-angle-left"></i></h4>
                                            <h4>Automated</h4>
                                            <li><a class="<?php if (empty(array_intersect(['birthday'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>birthday-setup" href="<?= base_url(); ?>birthday">Birthday</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['anniversary'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>anniversary-setup" href="<?= base_url(); ?>anniversary">Anniversary</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['lost_customer'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>lost-customer-setup" href="<?= base_url(); ?>lost_customer">Lost Customer</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['service_repeat'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>service-repeat-setup" href="<?= base_url(); ?>service_repeat">Service Repeat</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['cancel_appointment'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>cancel-appointment-setup" href="<?= base_url(); ?>cancel_appointment">Yesterday Cancel Appointment</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['trying-booking'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>trying-booking" href="<?= base_url(); ?>trying-booking">Trying For Booking</a></li>
                                            <h4>Manual</h4>
                                            <li><a class="<?php if (empty(array_intersect(['coupons'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>coupons-setup" href="<?= base_url(); ?>coupons">Coupons</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['giftcards'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>giftcards-setup" href="<?= base_url(); ?>giftcards">Gift Cards</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['offer'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>offer-setup" href="<?= base_url(); ?>offer">Offer</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['booking-promotion'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>booking-promotion" href="<?= base_url(); ?>booking-promotion">Easy Booking Promotion</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['customize_message'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>customize-message-setup" href="<?= base_url(); ?>customize_message">Customize Message</a></li>
                                        </ul>
                                    </li>

                                    <?php $check_array = [
                                        'booking-list',
                                        'transfer-bookings',
                                        'product-booking-list',
                                        'customer-list',
                                        'add-payment',
                                        'employee_loan',
                                        'generate_salary_slip',
                                        'salon-salary-list',
                                        'petty-cash',
                                        'subscription-report',
                                        'sales-report',
                                        'membership-report',
                                        'giftcard-report',
                                        'package-report',
                                        'employee-report',
                                        'customer-report',
                                        'trying-booking-list',
                                        'consent-form'
                                    ]; ?>
                                    <li id="reports" class="<?php if (empty(array_intersect($check_array, $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>"><a><i class="fa-solid fa-file-invoice nav-icon"></i><b class="nav-title">Reports
                                            </b><span class="fa fa-chevron-down down-icon"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <h4>Reports <i style="float:right;cursor:pointer;" class="fas fa-angle-left"></i></h4>
                                            <h4>Finance <i style="float:right;cursor:pointer;" class="fas fa-angle-left"></i></h4>
                                            <li><a class="<?php if (empty(array_intersect(['sales-report'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>sales-report" href="<?= base_url(); ?>sales-report">Finance Report</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['petty-cash'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>petty-cash" href="<?= base_url(); ?>petty-cash">Petty Cash</a></li>

                                            <h4>Employee <i style="float:right;cursor:pointer;" class="fas fa-angle-left"></i></h4>
                                            <li><a class="<?php if (empty(array_intersect(['employee-report'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>employee-report" href="<?= base_url(); ?>employee-report">Employee Report</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['employee_loan'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>employee-loan" href="<?= base_url(); ?>employee_loan">Loan Management</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['generate_salary_slip'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>cc_generate_salary_slip" href="<?= base_url(); ?>generate_salary_slip">Generate Salary</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['salon-salary-list'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>cc_salon_salary_list" href="<?= base_url(); ?>salon-salary-list">Salary Slips</a></li>

                                            <h4>Customer <i style="float:right;cursor:pointer;" class="fas fa-angle-left"></i></h4>
                                            <li><a class="<?php if (empty(array_intersect(['customer-report'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>customer-reports" href="<?= base_url(); ?>customer-report">Customer</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['membership-report'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>membership-report" href="<?= base_url(); ?>membership-report">Memberships Sale</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['package-report'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>package-report" href="<?= base_url(); ?>package-report">Packages Sale</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['giftcard-report'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>giftcard-report" href="<?= base_url(); ?>giftcard-report">Giftcards Sale</a></li>

                                            <h4>Subscription <i style="float:right;cursor:pointer;" class="fas fa-angle-left"></i></h4>
                                            <li><a class="<?php if (empty(array_intersect(['subscription-report'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>subscription-reports" href="<?= base_url(); ?>subscription-report">Subscription Report</a></li>

                                            <h4>Whatsapp <i style="float:right;cursor:pointer;" class="fas fa-angle-left"></i></h4>
                                            <li><a class="<?php if ($profile->include_wp != '1') {
                                                                echo 'blurred ';
                                                            } ?>whatsapp-reports" href="<?= base_url(); ?>whatsapp-report">Whatsapp Report</a></li>

                                            <h4>Bookings <i style="float:right;cursor:pointer;" class="fas fa-angle-left"></i></h4>
                                            <li><a class="<?php if (empty(array_intersect(['booking-list'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>booking-lists" href="<?= base_url(); ?>booking-list">All Bookings</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['transfer-bookings'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>transfer-bookings" href="<?= base_url(); ?>transfer-bookings">Tranfer Bookings</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['product-booking-list'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>product-booking-lists" href="<?= base_url(); ?>product-booking-list">Purchase Product Orders</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['trying-booking-list'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>trying-booking-list" href="<?= base_url(); ?>trying-booking-list">Trying For Booking List</a></li>

                                            <h4>Customers <i style="float:right;cursor:pointer;" class="fas fa-angle-left"></i></h4>
                                            <li><a class="<?php if (empty(array_intersect(['customer-list'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>customer-list" href="<?= base_url(); ?>customer-list">All Customers</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['customer-list'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>shop_customer-list" href="<?= base_url(); ?>customer-list?shop_customer">Shop Customers</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['customer-list'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>app_customer-list" href="<?= base_url(); ?>customer-list?app_customer">Mobile App Customers</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['add-payment'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>add-payment" href="<?= base_url(); ?>add-payment">Add Payment</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['consent-form'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>consent-form" href="<?= base_url(); ?>consent-form">Consent Forms</a></li>
                                        </ul>
                                    </li>

                                    <?php $check_array = [
                                        'add_automated_marketing',
                                        'automated-product-marketing',
                                        'automated-new-customers',
                                        'automated-anniversary-customers',
                                        'automated-birthday-customers',
                                        'automated-regular-customers',
                                        'automated-lost-customers',
                                        'add-salon-services',
                                        'add-product',
                                        'add-package',
                                        'add-membership',
                                        'add-gift-card',
                                        'add-offers',
                                        'add-reward-point',
                                        'add-coupon-code',
                                        'add_employee',
                                        'add-designation',
                                        'add-reminder-form',
                                        'add-course',
                                        'course-list',
                                        'add-student',
                                        'student-list',
                                        'payment-history',
                                        'payment-entry',
                                        'store-profile',
                                        'store-booking-rules',
                                        'working-hours',
                                        'salon-bank-details',
                                        'salon-location',
                                        'add-salon-facility',
                                        'store-images',
                                        'store-reviews-list',
                                        'salon-mobile-banner',
                                        'coin_history',
                                        'add-catlogue-salon'
                                    ]; ?>
                                    <li id="back-office" class="<?php if (empty(array_intersect($check_array, $feature_slugs))) {
                                                                    echo 'blurred ';
                                                                } ?>"><a><i class="fa-solid fa-building nav-icon"></i><b class="nav-title">Back Office</b><span class="fa fa-chevron-down down-icon"></span></a>
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
                                            <h4>Master <i style="float:right;cursor:pointer;" class="fas fa-angle-left"></i></h4>
                                            <li><a class="<?php if (empty(array_intersect(['add-salon-services'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>service-setup" href="<?= base_url(); ?>add-salon-services">Service Setup</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['add-product'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>product-setup" href="<?= base_url(); ?>add-product">Product Setup</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['add-membership'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>membership-setup" href="<?= base_url(); ?>add-membership">Membership</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['add-package'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>package-setup" href="<?= base_url(); ?>add-package">Package</a></li>

                                            <h4>Marketing <i style="float:right;cursor:pointer;" class="fas fa-angle-left"></i></h4>
                                            <h4>Manual Marketing</h4>
                                            <li><a class="<?php if (empty(array_intersect(['add-coupon-code'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>coupon-setup" href="<?= base_url(); ?>add-coupon-code">Coupons</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['add-offers'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>offers-setup" href="<?= base_url(); ?>add-offers">Offers</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['add-gift-card'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>gift-setup" href="<?= base_url(); ?>add-gift-card">Gift Cards</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['add-reward-point'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>reward-setup" href="<?= base_url(); ?>add-reward-point">Reward Points</a></li>
                                            <h4>Automated Marketing</h4>
                                            <li><a class="<?php if (empty(array_intersect(['automated-new-customers'], $feature_slugs)) || empty(array_intersect(['add_automated_marketing'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>add_new_automated_marketing" href="<?= base_url(); ?>add_automated_marketing?type=new">New Client</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['automated-regular-customers'], $feature_slugs)) || empty(array_intersect(['add_automated_marketing'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>add_regular_automated_marketing" href="<?= base_url(); ?>add_automated_marketing?type=regular">Regular Client</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['automated-lost-customers'], $feature_slugs)) || empty(array_intersect(['add_automated_marketing'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>add_lost_automated_marketing" href="<?= base_url(); ?>add_automated_marketing?type=lost">Lost Client</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['automated-birthday-customers'], $feature_slugs)) || empty(array_intersect(['add_automated_marketing'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>add_birthday_automated_marketing" href="<?= base_url(); ?>add_automated_marketing?type=birthday">Birthday</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['automated-anniversary-customers'], $feature_slugs)) || empty(array_intersect(['add_automated_marketing'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>add_anniversary_automated_marketing" href="<?= base_url(); ?>add_automated_marketing?type=anniversary">Anniversary</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['automated-product-marketing'], $feature_slugs)) || empty(array_intersect(['add_automated_marketing'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>add_product_marketing_automated_marketing" href="<?= base_url(); ?>add_automated_marketing?type=product_marketing">Products</a></li>



                                            <h4>Employee <i style="float:right;cursor:pointer;" class="fas fa-angle-left"></i></h4>
                                            <li><a class="<?php if (empty(array_intersect(['add_employee'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>employee-setup" href="<?= base_url(); ?>add_employee">Manage Employee</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['add-designation'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>add_designation" href="<?= base_url(); ?>add-designation">Designations</a></li>

                                            <h4>General Reminder <i style="float:right;cursor:pointer;" class="fas fa-angle-left"></i></h4>
                                            <li><a class="<?php if (empty(array_intersect(['add-reminder-form'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>reminder-setup" href="<?= base_url(); ?>add-reminder-form">General Reminders</a></li>
                                            <!-- <li><a  class="service-setup" href="<?= base_url(); ?>all-reminders">All Reminders</a></li> -->

                                            <h4>Academy <i style="float:right;cursor:pointer;" class="fas fa-angle-left"></i></h4>
                                            <li><a class="<?php if (empty(array_intersect(['add-course'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>add_course" href="<?= base_url(); ?>add-course">Add Course</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['course-list'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>course_list" href="<?= base_url(); ?>course-list">Course List</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['add-student'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>add_student" href="<?= base_url(); ?>add-student">Add Student</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['student-list'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>student_list" href="<?= base_url(); ?>student-list">Student List</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['payment-history'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>payment-history" href="<?= base_url(); ?>payment-history">Allocated Courses</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['payment-entry'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>payment_entry" href="<?= base_url(); ?>payment-entry">Make Payment</a></li>
                                            <!-- <li><a  class="fees-history" href="<?= base_url(); ?>fees-history">Fees List</a></li> -->

                                            <h4>Store Setting <i style="float:right;cursor:pointer;" class="fas fa-angle-left"></i></h4>
                                            <!-- <li><a  class="<?php if (empty(array_intersect(['store-reviews-list'], $feature_slugs))) {
                                                                    echo 'blurred ';
                                                                } ?>store-reviews" href="<?= base_url(); ?>store-reviews-list">Store Reviews</a></li> 
                                        <li><a  class="<?php if (empty(array_intersect(['store-images'], $feature_slugs))) {
                                                            echo 'blurred ';
                                                        } ?>store-images" href="<?= base_url(); ?>store-images">Store Gallary</a></li>   
                                        <li><a  class="<?php if (empty(array_intersect(['add-catlogue-salon'], $feature_slugs))) {
                                                            echo 'blurred ';
                                                        } ?>add-catlogue-salon" href="<?= base_url(); ?>add-catlogue-salon">Mobile App Catlogue</a></li> 
                                        <li><a  class="<?php if (empty(array_intersect(['salon-mobile-banner'], $feature_slugs))) {
                                                            echo 'blurred ';
                                                        } ?>app-banner" href="<?= base_url(); ?>salon-mobile-banner">Mobile App Banner</a></li> 
                                        <li><a  class="<?php if (empty(array_intersect(['coin_history'], $feature_slugs))) {
                                                            echo 'blurred ';
                                                        } ?>coin_history" href="<?= base_url(); ?>coin_history">Store Coins</a></li>  -->
                                            <li><a class="<?php if (empty(array_intersect(['store-profile'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>store-profile" href="<?= base_url(); ?>store-profile">Store Profile</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['working-hours'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>working-hours" href="<?= base_url(); ?>working-hours">Working Hours</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['salon-bank-details'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>salon-bank-details" href="<?= base_url(); ?>salon-bank-details">Bank Details</a></li>
                                            <?php if ($profile->booking_rule_setup_status == '1' || date('Y-m-d H:i:s', strtotime($profile->last_booking_rule_setup_block . ' + 1 Day')) <= date('Y-m-d H:i:s')) { ?>
                                                <li><a class="<?php if (empty(array_intersect(['store-booking-rules'], $feature_slugs))) {
                                                                    echo 'blurred ';
                                                                } ?>store-booking-rules" href="<?= base_url(); ?>store-booking-rules">Booking Rules</a></li>
                                            <?php } else { ?>
                                                <li><a class="blurred store-booking-rules" href="<?= base_url(); ?>store-booking-rules">Booking Rules</a></li>
                                            <?php } ?>
                                            <li><a class="<?php if (empty(array_intersect(['salon-location'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>salon-location" href="<?= base_url(); ?>salon-location">Location</a></li>
                                            <li><a class="<?php if (empty(array_intersect(['add-salon-facility'], $feature_slugs))) {
                                                                echo 'blurred ';
                                                            } ?>add-salon-facility" href="<?= base_url(); ?>add-salon-facility">Store Facilities</a></li>

                                        </ul>
                                    </li>

                                    <li id="salon_logout" class="<?php if (empty(array_intersect(['salon_do_logout'], $feature_slugs))) {
                                                                        echo 'blurred ';
                                                                    } ?>"><a href="<?= base_url(); ?>salon_do_logout"><i class="fa fa-sign-out"></i><b> Log Out</b></a>
                                    </li>
                                </ul>
                            </div>


                        </div>
                        <!-- /sidebar menu -->



                    </div>
                </div>
                <div class="header_sticky">
                    <div class="top-btn-btn profile-dropdown">
                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <?php if (!empty($branch_list) && $branch_list->store_logo != "") { ?>
                                <img style="width: 30px;border-radius: 25px;" src="<?= base_url() ?>admin_assets/images/store_logo/<?php echo $branch_list->store_logo; ?>" alt="Store Logo">
                            <?php } else { ?>
                                <img style="width: 30px;border-radius: 25px;" src="<?= base_url() ?>admin_assets/images/store_logo/dummy.jpg" alt="Dummy Logo">
                            <?php } ?>
                            <?= $profile_name; ?>
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu top-menu" aria-labelledby="dropdownMenu1">
                            <li><a class="" href="<?= base_url(); ?>store-profile">Store Profile</a></li>
                            <li><a class="" href="<?= base_url(); ?>salon_do_logout">Log Out</a></li>

                        </ul>
                    </div>
                    <?php
                    $marquee_elements = [];
                    if (!empty(array_intersect(['low_stock_marquee'], $feature_slugs))) {
                        if (!empty($low_stock_products)) {
                            foreach ($low_stock_products as $low_stock_products_result) {
                                $marquee_elements[] = $low_stock_products_result->product_name . ' stock is under low stock <a style="font-size:12px;color:#0000ff;text-decoration:underline;" href="' . base_url() . 'add-product-stock?product=' . $low_stock_products_result->id . '">Inward</a>';
                            }
                        }
                    }
                    if ($wp_ticker == '1') {
                        $marquee_elements[] = 'Whatsapp Coin balance is low. Please raise Add On Request. <a style="font-size:12px;color:#0000ff;text-decoration:underline;" onclick="showDashboardDataPopup(\'9\')">Click Here</a>';
                    }
                    ?>
                    <?php if (!empty($marquee_elements)) { ?>
                        <marquee onmouseover="this.stop();" onmouseout="this.start();" style="background-color: #ffbfbf;padding: 5px; color:black;">
                            <?php
                            $first = true;
                            for ($i = 0; $i < count($marquee_elements); $i++) {
                                if (!$first) {
                                    echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                                }
                                echo $marquee_elements[$i];
                                $first = false;
                            }
                            ?>
                        </marquee>
                    <?php } ?>
                </div>
            <?php } ?>