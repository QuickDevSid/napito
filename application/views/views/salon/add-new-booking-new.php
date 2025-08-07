<?php include('header.php'); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/clockpicker/dist/jquery-clockpicker.min.css">
<style>
  
   
    .active-background-color {
        background-color: yellow;
    }
    .x_panel{
        border:1px solid #a1a1a1 !important
    }
    .page-title h3 a {
    float: right;
    margin-bottom: 10px;
    margin-right: -20px;
}
.page-title h3{
    width: 100%;
}

    .timeslot-loader {
        border: 5px solid #f3f3f3;
        border-top: 5px solid #3498db;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 2s linear infinite;
        margin: auto;
        margin-top: 50px;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .navtabs {
        display: flex;
        justify-content: left;
        margin-bottom: 20px;
        margin-top: -10px;
        background: white;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        /* border-radius: 8px; */
        padding: 2px 0px;
        position: relative;
    }

    .slot-tablinks {
        margin-bottom: 5px !important;
        padding: 2px 5px;
        cursor: pointer;
        color: #242427;
        margin: 0px 1px;
        transition: color 0.4s, background-color 0.4s, font-size 0.4s;
        border: none;
        font-size: 13px;
        background: white;
  
    }

    .slot-tablinks:hover {
        color: #242427;
        background-color: white;
        font-size: 13px;
    }

    .slot-tablinks.active {
        color: var(--hover);
        background-color: var(--white);
        font-size: 13px;
        border-bottom: 2px solid var(--hover);
    }

    .slot-tabcontent {
        display: none;
        max-width: 800px;
        text-align: center;
    }

    .slot-tabcontent.active {
        display: block;
    }



    .x_panel{
        border: unset !important;
    border: 1px solid #E6E9ED !important;
}


    .service_details_box {
        max-height: 250px;
        overflow: hidden;
        overflow-y: auto;
    }



    .customers_search_results:hover {
        background-color: rgb(33, 116, 249);
        color: white;
    }
    .right_col{
        min-height:auto;
    }

    .category_services_box {
        /* max-height: 250px; */
        overflow: hidden;
        overflow-y: auto;
    }

    

    .mem-tooltip {
        width: 280px;
        position: absolute;
        left: 0;
        background-color: #feefdc;
        display: none;
        /* border: 1px solid #ccc; */
        border-radius: 8px;
        z-index: 999;
        padding: 5px;
        overflow: hidden;
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    }

    .mem-tooltip p {
        margin-bottom: 0px;
        font-size: 12px;
    }

    #mem_details_info {
        cursor: pointer;
    }

    #mem_details_info:hover .mem-tooltip {
        display: block;
    }

    .discount-tooltip {
        width: 280px;
        position: absolute;
        left: 0;
        background-color: #feefdc;
        display: none;
        /* border: 1px solid #ccc; */
        border-radius: 8px;
        z-index: 999;
        padding: 5px;
        overflow: hidden;
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    }

    .discount-tooltip p {
        margin-bottom: 0px;
        font-size: 12px;
    }

    #discount_details_info {
        cursor: pointer;
    }

    #discount_details_info:hover .discount-tooltip {
        display: block;
    }

    /* Styles for the loader */
    .loader_div {
        display: none;
        position: fixed;
        width: 100%;
        height: 100% !important;
        background: #00000042;
        z-index: 999;
        left: 0;
        top: 0;
    }

    .loader-new {
        position: fixed;
        top: 50%;
        left: 50%;
        z-index: 9999;
        --d: 22px;
        width: 4px;
        height: 4px;
        border-radius: 50%;
        color: #0056d0;
        box-shadow:
            calc(1*var(--d)) calc(0*var(--d)) 0 0,
            calc(0.707*var(--d)) calc(0.707*var(--d)) 0 1px,
            calc(0*var(--d)) calc(1*var(--d)) 0 2px,
            calc(-0.707*var(--d)) calc(0.707*var(--d)) 0 3px,
            calc(-1*var(--d)) calc(0*var(--d)) 0 4px,
            calc(-0.707*var(--d)) calc(-0.707*var(--d))0 5px,
            calc(0*var(--d)) calc(-1*var(--d)) 0 6px;
        animation: l27 1s infinite steps(8);
    }

    @keyframes l27 {
        100% {
            transform: rotate(1turn)
        }
    }
</style>
<style type="text/css">
    .error {
        color: red;
        float: left;
        /*    position: absolute;*/
    }

    p#add_date{
        margin-top: 10px;
    }

    .input-content-option {
        height: 35px;
        width: 600px;
        border-radius: 5px;
        border: solid gray 1px;
    }

    .booked {
        color: red;
    }

    .lunch-break {
        color: green;
    }

    .modal-backdrop.fade {
        opacity: 1 !important;
    }

    .search-icon {
        position: absolute;
        top: 8px;
        right: 18px;
        font-size: 18px;
    }

    

    #shift_name_chosen {
        border: 0px !important;
    }

    .square-radio {
        width: 20px;
        height: 20px;
        border-radius: 5px;
        border: 1px solid #000;
    }

    .ui-menu .ui-menu-item-wrapper {
        padding: 9px !important;
    }

    .selected_service_name {
        font-size: 14px;
        margin-left: 20px;
    }

    

    




    .single_service_details_append {
        margin: 0px 0px;
        padding: 10px 12px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .package_div_row {
        margin-left: 0px;
        margin-right: 0px;
    }

    .all_services_div .row {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .all_services_div .row:first-child {
        margin-top: 15px;
    }

    .single_service_details_append .title_c {
        line-height: 35px;
        margin-bottom: 10px;
        font-weight: 900;
    }

    .single_service_details_append {
        position: static;
        top: 0;
        right: 18px;
        font-size: 16px;
        color: #979292;
        margin-bottom: 15px;
        /* background-color: #f6f8fb; */
    }

    .noserviceavl {
        text-align: center;
        float: none;
        display: block;
        padding: 10px 0px;
        background-color: #ff2b2b1a;
        /* border: 1px solid #f00; */
        border-radius: 8px;
    }

    .product_model_a {
        margin: 0px;
        background-color: transparent;
        border: none;
    }

    .single_service_details_append .form-control {
        width: 100% !important;
        border: 1px solid #ccc !important;
        margin: 0px;
        height: 42px;
    }

    .single_service_details_append .service-search-icon {
        top: 1px;
    }

    .cards-slider .slick-prev:before,
    .slick-next:before {
        color: #000 !important;
    }

    .page-title h3 {
        margin: 9px 0;
        align-items: center;
        font-size: 18px;
        font-weight: 800;
        color: var(--primary);
    }

    span.description-txt {
        font-size: 10px;
        color: #898989;
    }

    .cards-slider .card {
        /* border: 1px solid #0056d0; */
        border-radius: 8px;
        margin-bottom: 10px;
        margin-top: 10px;
        padding: 10px;
        background-color: #feefdc;
        min-height: 75px;
    }

    .cards-slider .card h4 {
        margin-top: 0px;
        margin-bottom: 0px;
        color: #d29b5f;
        font-size: 14px;
    }

    .cards-slider .card p {
        color: #646464;
        margin: 0px;
        font-size: 11px;
    }

    .cards-slider .slick-prev,
    .slick-next {
        top: 45%;
        display: none !important;
    }

    .cards-slider .slick-next {
        right: -20px;
    }

    .cards-slider .slick-prev {
        left: -20px;
    }

    .cards-slider .card .card_header {
        display: flex;
        justify-content: start;
        align-items: center;
    }

    .cards-slider .card .card_header span {
        color: #d29b5f;
        font-size: 14px;
        font-weight: 500;
    }

    .cards-slider .card .read_link {
        text-align: right;
    }

    /* (A) BUILD TOOLTIP USING BEFORE PSEUDO-CLASS */
    [data-tooltip]::before {
        content: attr(data-tooltip);
    }

    /* (B) POSITION TOOLTIP */
    [data-tooltip] {
        position: relative;
        display: block;
    }

    [data-tooltip]::before {
        position: absolute;
        z-index: 999;
    }

    [data-tooltip].top::before {
        bottom: 100%;
        margin-bottom: 10px;
    }

    [data-tooltip].bottom::before {
        top: 100%;
        margin-top: 10px;
    }

    [data-tooltip].left::before {
        right: 100%;
        margin-right: 10px;
    }

    [data-tooltip].right::before {
        left: 100%;
        margin-left: 10px;
    }

    /* (C) SHOW TOOLTIP ONLY ON HOVER */
    [data-tooltip]::before {
        visibility: hidden;
        opacity: 0;
        transition: opacity 0.5s;
    }

    [data-tooltip]:hover::before {
        visibility: visible;
        opacity: 1;
    }

    [data-tooltip]::before {
        background: #000;
        color: #fff;
        padding: 5px;
        min-width: 100px;
        text-align: center;
        bottom: 20px;
        right: 0;
        border-radius: 5px;
    }

    .coupon-tooltip {
        width: 280px;
        position: absolute;
        left: 0;
        background-color: #feefdc;
        display: none;
        /* border: 1px solid #ccc; */
        border-radius: 8px;
        z-index: 999;
        padding: 5px;
        overflow: hidden;
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    }

    .coupon-tooltip p {
        margin-bottom: 0px;
        font-size: 12px;
    }

    #coupon_details_info {
        cursor: pointer;
    }

    #coupon_details_info:hover .coupon-tooltip {
        display: block;
    }

    .timeslot_box {
        /* border: 1px solid #ccc; */
        margin: 5px;
        height: 145px;
        display: block;
        float: left;
        width: 100%;
    }
    .timeslot_box .tab{
        
    display: flex;
    justify-content: center;
    gap: 25px;

    }

    /* .book-left-section {
        position: sticky;
        top: 50px;
        z-index: 100;

    } */
</style>
<?php
if (!empty($close_setup)) {
    if (date('Y-m-d', strtotime($close_setup->to_date)) >= date('Y-m-d')) {
?>
<div style="margin-top: 10px;">
    <div class="row"> 
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel" style="background-color: #f443362e;color: red;border: 1px solid #f4433647 !important;">
                <div style="text-align: center;font-size: 15px;">
                Salon is closed from <?php echo date('d M, Y',strtotime($close_setup->from_date)) . ' To ' . date('d M, Y',strtotime($close_setup->to_date)); ?>. <a onclick="showDashboardDataPopup('6')" data-toggle="modal" data-target="#DashboardModal" style="cursor:pointer;color:black;text-decoration:underline;" class="store-profile">Update</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php }} ?>
<div class="right_col salon_booking_area" role="main" id="overlay">
    <div class="">
        <div class="page-title row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h3>
                    Add New Booking
                    <a class="<?php if(empty(array_intersect(['product-booking'], $feature_slugs))) { echo 'blurred '; }?>btn btn-primary" id="product_booking_anchor" style="float:right;" href="<?=base_url();?>product-booking">Product Booking</a>
                </h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <form method="post" name="booking_form" id="booking_form" enctype="multipart/form-data">
                <!-- side bar customer info -->
                <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 book-left-section">
                    <div class="x_panel">
                        <div class="x_content">
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12 mt-3" style="position: relative;">
                                    <input autocomplete="off" maxlength="10" type="text" class="form-control" name="phone" id="phone" placeholder="Add/Search Customer"><a class="search-icon" href="#"><i class="fa fa-search"></i></a>
                                    <div id="phone_not_found" style="display:none; color: red;"></div>
                                </div>
                                <div class="customer-info-by-search">
                                    <div id="customers"></div>
                                </div>
                            </div>
                            <div class="row" id="customer_info_div" style="display:none;">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12" id="not_member_div">

                                </div>
                                <div class="row custum_info"  style="text-align: start;">
                                    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-6 customer-profile-div">
                                        <div class="customer-profile-box text-center" name="profile_photo" id="profile_photo"></div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-6">
                                        <b id="customer_name_t"></b><br>
                                        <p id="add_date"></p>
                                        <p id="rewards_balance"></p>
                                        <p id="due_balance"></p>
                                        <p id="total_completed"></p>
                                        <p id="total_pending"></p>
                                        <p id="total_cancelled"></p>
                                        <p id="total_rescheduled"></p>
                                    </div>
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-md-12 memebership_expiry" style="display: none;"></div>
                                </div>
                                <div class="container">
                                    <div class="row row-history">
                                        <div class="client-history">
                                            <div id="exTab2" class="container">
                                                <ul class="nav nav-tabs message-tab">
                                                    <li id="tab_1" class="active">
                                                        <a href="#customer_activity" data-toggle="tab">Activity</a>
                                                    </li>
                                                    <li class="" id="tab_2">
                                                        <a href="#customer_notes" data-toggle="tab">Note</a>
                                                    </li>
                                                    <li id="tab_3">
                                                        <a href="#customer_payments" data-toggle="tab">Payment</a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content" style="padding: 5px;">
                                                    <div class="tab-pane active customer-activity" id="customer_activity">
                                                    </div>
                                                    <div class="tab-pane customer_note" id="customer_notes" style="color: #73879C;">
                                                    </div>
                                                    <div class="tab-pane customer_payment" id="customer_payments">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="customer_info_empty_div" style="display:block;">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12 no_data_img">
                                    <img src="<?= base_url(); ?>admin_assets/images/no_data/no_data.png">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- middel bar service info -->
                <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12" id="service_package_details_div" style="display:block;">
                    <div class="x_panel">
                        <div class="x_content">
                            <div class="container">
                                <div class="row">
                                    <ul class="nav nav-tabs service-tab">
                                        <li id="tab_4" class="service_tabbing service_tabbing_left active">
                                            <a href="#4" data-toggle="tab">Service</a>
                                        </li>
                                        <li class="service_tabbing service_tabbing_right" id="tab_5">
                                            <a href="#5" data-toggle="tab">Package</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" style="margin-top: 20px;">
                                        <!-- service section -->
                                        <div class="tab-pane active" id="4">
                                            <div class="">
                                                <div class="form-group row">
                                                    <select class="form-select form-control chosen-select" name="sup_category" id="sup_category">
                                                        <option class="option_placeholder" value="">Select Category</option>
                                                        <?php if (!empty($category)) {
                                                            foreach ($category as $category_result) { ?>
                                                                <option value="<?= $category_result->id ?>"><?= $category_result->sup_category ?>/<?= $category_result->sup_category_marathi ?></option>
                                                        <?php }
                                                        } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group row" id="services_div">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <!-- package section -->
                                        <div class="tab-pane" id="5">
                                            <div class="row pacakge-box" style="position: relative;">
                                                <div class="form-group">
                                                    <select class="form-select form-control chosen-select" name="package_name" id="package_name">
                                                        <option value="">Select Package</option>
                                                        <?php 
                                                            // if (!empty($package_list)) {
                                                            //     foreach ($package_list as $package_list_result) { 
                                                        ?>
                                                        <!-- <option value="<?= $package_list_result->id ?>"><?= $package_list_result->package_name ?></option> -->
                                                        <?php 
                                                        // }} 
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group row package_div_row" id="package_div">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12" id="service_package_details_empty_div" style="display:none;">
                    <div class="x_panel">
                        <div class="x_content">
                            <div class="container">
                                <div class="row">
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12 no_data_img">
                                        <img src="<?= base_url(); ?>admin_assets/images/no_data/no_data.png" >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- billing section -->
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12" id="pricing_details_div" style="display:block;">
                    <div class="x_panel">
                        <div class="x_content">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-7 col-sm-12 col-xs-12">
                                        <input type="hidden" id="m_discount">
                                        <input type="hidden" id="M_P_discount" placeholder="yyy">
                                        <input type="hidden" id="m_discount_type">
                                        <input type="hidden" id="gift_discount" name="gift_discount">
                                        <input type="hidden" id="gift_discount_type">
                                        <span class="span_title_side_bar">Amount:&nbsp;&nbsp;<span id="upper_payable">0.00</span>
                                    </div>
                                    <div class="col-md-5 col-sm-12 col-xs-12">
                                        <span class="span_title_side_bar">Duration:&nbsp;&nbsp;<span id="upper_duration">0 Min</span>
                                        <input type="hidden" name="total_service_duration" id="total_service_duration" value="">
                                    </div>
                                </div>
                                <hr class="break_line">
                                <div class="row service-payment-title hhh_ccc_span">
                                    <div class="form-group col-md-6 col-sm-12 col-xs-12">                                            
                                        <input readonly type="text" class="form-control" name="booking_date" id="booking_date" placeholder="Select Booking Date" onchange="fetchTimeSlots()">
                                    </div>  
                                    <div class="form-group col-md-6 col-sm-12 col-xs-12">                                            
                                        <input readonly type="text" class="form-control" name="booking_start" id="booking_start" placeholder="Start From Time Slot" onclick="fetchTimeSlots()">
                                    </div> 
                                    <input type="hidden" name="employee_selection_rule" id="employee_selection_rule" value="<?php if(!empty($booking_rules)){ echo $booking_rules->employee_selection; } ?>"> 
                                    <?php 
                                    if(!empty($booking_rules)){ 
                                        if($booking_rules->employee_selection == '2'){ 
                                    ?>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">               
                                        <select class="form-control chosen-select" id="employee" name="employee" onchange="fetchTimeSlots()">   
                                            <!-- <option value="">Select Stylist</option> -->
                                            <?php if(!empty($stylists)){ foreach($stylists as $employee_result){ ?>
                                                <option value="<?=$employee_result->id;?>" data-img-src="<?=base_url();?>admin_assets/images/employee_profile/<?=$employee_result->profile_photo;?>"><?=$employee_result->full_name;?></option>
                                            <?php }} ?>
                                        </select>
                                        <label for="employee" style="display:none;" generated="true" class="error">Please select stylist!</label> 
                                    </div>
                                    <?php }} ?>
                                    <input type="hidden" name="previous_start" id="previous_start" value=""> 
                                    <input type="hidden" name="previous_stylist" id="previous_stylist" value="<?php if(isset($_GET['stylist']) && $_GET['stylist'] != ""){ echo $_GET['stylist']; } ?>"> 
                                    <div class="timeslot_box">
                                        <div class="col-md-12 col-sm-12 col-xs-12" id="booking_timeslots" style="padding: 5px;"> 
                                        </div>   
                                        <div id="booking_timeslots_loader" style="display:none;">
                                            <div class="timeslot-loader"></div>
                                        </div>                               
                                    </div>                                  
                                </div>
                                <hr class="break_line">
                                <div class="row service-payment-title hhh_ccc_span">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <span style="font-size: 15px;">Services</span>
                                    </div>
                                    <div id="selected_services_empty">
                                        <div class="row single_added_service_details">
                                            <div class="col-md-12 col-sm-12 col-xs-12 selected-servicesbox">
                                                <label class="noserviceavl" style="background-color:transparent !important; font-size: 11px !important;color: #d75353 !important;">Service not selected</label>
                                                <div class="span-row">
                                                    <span class="bottom-span"></span>
                                                    <span class="bottom-span"></span>
                                                    <span class="bottom-span"></span>
                                                </div>
                                            </div> 
                                        </div>                           
                                    </div>
                                    <div id="selected_services">                         
                                    </div>
                                </div>
                                <div class="row service-payment"></div>
                                <div class="row service_product_payment_title">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <span style="font-size: 15px;">Products</span>
                                    </div>
                                    <div id="selected_products_empty"> 
                                        <div class="row single_added_service_details">
                                            <div class="col-md-12 col-sm-12 col-xs-12 selected-servicesbox">
                                                <label class="noserviceavl" style="background-color:transparent !important; font-size: 11px !important; color: #d75353 !important;">Product not selected</label>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            </div>
                                        </div>                         
                                    </div>
                                    <div id="selected_products">
                                    </div>
                                </div> 
                                <hr class="break_line">                                                              
                                <div class="row t_s_a_title">
                                    <div class="col-md-7 col-sm-12 col-xs-12">
                                        <span class="span_title_side_bar">Service Amount</span>
                                    </div>
                                    <div class="col-md-5 col-sm-12 col-xs-12 text-right">
                                        <input class="form-control" type="hidden" value="0.00" name="total-service-amount" id="total-service-amount" readonly>
                                        <input type="hidden" id="service-amount-discount" name="service-amount-discount" value="0.00">
                                        <input type="hidden" id="service_payable_hidden" name="service_payable_hidden" value="0.00">
                                        <div class="" id="total_service_amount_t">0.00</div>
                                    </div>
                                </div>
                                <div class="row t_p_a_title">
                                    <div class="col-md-7 col-sm-12 col-xs-12">
                                        <span class="span_title_side_bar">Product Amount</span>
                                        <input class="form-control" type="hidden" value="0.00" name="total-product-amount" id="total-product-amount" readonly>
                                        <input type="hidden" id="product-amount-discount" name="product-amount-discount" value="0.00">
                                        <input type="hidden" id="product_payable_hidden" name="product_payable_hidden" value="0.00">
                                    </div>
                                    <div class="col-md-5 col-sm-12 col-xs-12 text-right">
                                        <div class="" id="total_product_amount_t">0.00</div>
                                    </div>
                                </div>
                                <!-- <hr class="break_line">
                                <div class="row total_final_amount_title">
                                    <div class="col-md-7 col-sm-12 col-xs-12">
                                        <span class="span_title_side_bar">Payable Service Amount</span>
                                    </div>
                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                        <input type="hidden" id="service-amount-discount" name="service-amount-discount" value="0.00">
                                        <input type="hidden" id="service_payable_hidden" name="service_payable_hidden" value="0.00">
                                    </div>
                                    <div class="col-md-2 col-sm-12 col-xs-12">
                                        <span type="text" id="service_payable" class="total_product_amount_t">0.00</span>
                                    </div>
                                </div>
                                <div class="row total_product_amount_title">
                                    <div class="col-md-7 col-sm-12 col-xs-12">
                                        <span class="span_title_side_bar">Payable Product Amount</span>
                                    </div>
                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                        <input type="hidden" id="product-amount-discount" name="product-amount-discount" value="0.00">
                                        <input type="hidden" id="product_payable_hidden" name="product_payable_hidden" value="0.00">
                                    </div>
                                    <div class="col-md-2 col-sm-12 col-xs-12 payable_amount">
                                        <span type="text" id="product_payable" class="total_product_amount_t">0.00</span>
                                    </div>
                                </div> -->                                
                                <div id="membership_div" style="display:none;"></div> 
                                <div class="row total_payable_amount">
                                    <div class="col-md-7 col-sm-12 col-xs-12">
                                        <span class="span_title_side_bar">Package Amount</span>
                                    </div>
                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                        <input type="hidden" id="total-package-amount" name="total-package-amount" value="0.00">
                                        <input type="hidden" id="selected_package_id" name="selected_package_id" value="">
                                    </div>
                                    <div class="col-md-2 col-sm-12 col-xs-12 payable_amount text-right">
                                        <span type="text" id="total_package_amount_t" class="total_package_amount_t">0.00</span>
                                    </div>
                                </div>
                                <div class="row total_payable_amount">
                                    <div class="col-md-7 col-sm-12 col-xs-12">
                                        <span class="span_title_side_bar">Membership Amount</span>
                                    </div>
                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                        <input type="hidden" id="total-membership-amount" name="total-membership-amount" value="0.00">
                                    </div>
                                    <div class="col-md-2 col-sm-12 col-xs-12 payable_amount text-right">
                                        <span type="text" id="total_membership_amount_t" class="total_membership_amount_t">0.00</span>
                                    </div>
                                </div>
                                <hr class="break_line">
                                <input type="hidden" id="payable_hidden" name="payable_hidden" value="0.00">
                                <!-- <div class="row total_payable_amount">
                                    <div class="col-md-7 col-sm-12 col-xs-12">
                                        <span class="span_title_side_bar">Payable Amount</span>
                                    </div>
                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                    </div>
                                    <div class="col-md-2 col-sm-12 col-xs-12 payable_amount text-right">
                                        <span type="text" id="payable" class="total_product_amount_t">0.00</span>
                                    </div>
                                </div>
                                <hr class="break_line"> -->
                                <input type="hidden" id="coupon_discount_hidden" name="coupon_discount_hidden" value="0.00">
                                <input type="hidden" id="reward_discount_hidden" name="reward_discount_hidden" value="0.00">
                                <input type="hidden" id="used_rewards" name="used_rewards" value="0">
                                <input type="hidden" id="selected_coupon_id_hidden" name="selected_coupon_id_hidden" value="">
                                <div class="row total_payable_amount">
                                    <div class="col-md-7 col-sm-12 col-xs-12">
                                        <span class="span_title_side_bar">Discount</span>
                                        <div id="discount_details_div" style="position: relative;display:inline-block; width:auto;"></div>
                                    </div>
                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                        <input type="hidden" id="total_discount_hidden" name="total_discount_hidden" value="0.00">
                                    </div>
                                    <div class="col-md-2 col-sm-12 col-xs-12 payable_amount  text-right">
                                        <span type="text" id="total_discount_text" class="total_discount_text">0.00</span>
                                    </div>
                                </div>
                                <hr class="break_line">
                                <div class="row total_payable_amount">
                                    <div class="col-md-7 col-sm-12 col-xs-12">
                                        <span class="span_title_side_bar">Total Amount</span>
                                    </div>
                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                        <input type="hidden" id="booking_amount_hidden" name="booking_amount_hidden" value="0.00">
                                    </div>
                                    <div class="col-md-2 col-sm-12 col-xs-12 payable_amount text-right">
                                        <span type="text" id="booking_amount_text" class="booking_amount_text">0.00</span>
                                    </div>
                                </div>
                                <div class="row gst_info_box">
                                    <?php
                                        $is_gst_applicable = '0';
                                        $gst_no = '';
                                        $gst_rate = '0';
                                        if(!empty($store_profile)){
                                            if($store_profile->is_gst_applicable == '1'){
                                                $gst_no = $store_profile->gst_no;
                                                $is_gst_applicable = '1';
                                                if(!empty($setup)){
                                                    $gst_rate = $setup->gst_rate;
                                                }
                                            }
                                        }
                                    ?>
                                    <div class="col-md-7 col-sm-12 col-xs-12">
                                        <span class="span_title_side_bar">GST <?= $gst_rate != "" && $gst_rate != "0" ? '('.$gst_rate.'%)' : '';?></span>
                                    </div>
                                    <input type="hidden" name="is_gst_applicable" id="is_gst_applicable" value="<?=$is_gst_applicable;?>">
                                    <input type="hidden" name="salon_gst_no" id="salon_gst_no" value="<?=$gst_no;?>">
                                    <input type="hidden" name="salon_gst_rate" id="salon_gst_rate" value="<?=$gst_rate;?>">

                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                        <input type="hidden" id="gst_amount_hidden" name="gst_amount_hidden" value="0.00">
                                    </div>
                                    <div class="col-md-2 col-sm-12 col-xs-12 gst_amount text-right">
                                        <span type="text" id="gst_amount" class="total_product_amount_t">0.00</span>
                                    </div>
                                </div>
                                <hr class="break_line">
                                <div class="row amount_to_paid_title">
                                    <div class="col-md-7 col-sm-12 col-xs-12">
                                        <span class="span_title_side_bar">Amount to Paid</span>
                                    </div>
                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                        <input type="hidden" id="grand_total_hidden" name="grand_total_hidden" value="">
                                    </div>
                                    <div class="col-md-2 col-sm-12 col-xs-12 payable_amount text-right">
                                        <span type="text" id="grand_total" class="total_product_amount_t">0.00</span>
                                    </div>
                                </div>
                                <div class="row amount_to_paid_title service_details_box" style="height: 100px;display:none;">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <span class="span_title_side_bar">Apply Coupon</span>
                                    </div>
                                    <?php
                                    if(!empty($coupon_list)){ 
                                        foreach($coupon_list as $coupon_list_result){ 
                                    ?>
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <span class="span_title_side_bar">
                                            <?=$coupon_list_result->coupon_name;?>
                                            <div id="coupon_details_div_<?=$coupon_list_result->id?>" style="position: relative;display:inline-block; width:auto;">
                                                <div id="coupon_details_info"><i class="fas fa-info-circle" style="color:#0000ffb0;"></i>
                                                    <div class="coupon-tooltip">
                                                        <div style="margin-top:1px;">
                                                            <p>Minimum Amount: Rs. <?=$coupon_list_result->min_price;?></p>
                                                            <p>Discount: Rs. <?=$coupon_list_result->coupon_offers;?></p>
                                                            <p>Expiry: <?=($coupon_list_result->coupan_expiry != "" && $coupon_list_result->coupan_expiry != null && $coupon_list_result->coupan_expiry != '1970-01-01' && $coupon_list_result->coupan_expiry != "0000-00-00") ? date('d-m-Y',strtotime($coupon_list_result->coupan_expiry)) : 'NA';?></p>
                                                        </div>    
                                                    </div>
                                                </div>
                                            </div>
                                        </span>
                                    </div>
                                    <input type="hidden" name="coupon_id_<?=$coupon_list_result->id?>" id="coupon_id_<?=$coupon_list_result->id?>" value="<?=$coupon_list_result->id?>">
                                    <input type="hidden" name="coupon_expiry_<?=$coupon_list_result->id?>" id="coupon_expiry_<?=$coupon_list_result->id?>" value="<?=date('Y-m-d',strtotime($coupon_list_result->coupan_expiry));?>">
                                    <input type="hidden" name="coupon_min_price_<?=$coupon_list_result->id?>" id="coupon_min_price_<?=$coupon_list_result->id?>" value="<?=$coupon_list_result->min_price?>">
                                    <input type="hidden" name="coupon_offers_<?=$coupon_list_result->id?>" id="coupon_offers_<?=$coupon_list_result->id?>" value="<?=$coupon_list_result->coupon_offers?>">
                                    <div class="col-md-6 col-sm-12 col-xs-12" id="coupon_div_<?=$coupon_list_result->id?>" style="padding-right:0px; text-align:right;">
                                        <button class="btn btn-success" type="button" onclick="applyCoupon(<?=$coupon_list_result->id?>)" style="font-size:10px; padding:5px 12px;">Apply</button>
                                    </div>
                                    <label class="error" id="coupon_error_<?=$coupon_list_result->id?>"></label>
                                    <?php }}else{ ?>
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <span class="span_title_side_bar">Coupon not avaiable</span>
                                    </div>
                                    <?php } ?>
                                </div>
                                <div class="row amount_to_paid_title" style="display:none;">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <span class="span_title_side_bar">Apply Gift Card</span>
                                    </div>
                                    <div class="col-md-9 col-sm-12 col-xs-12">
                                        <input type="text" id="giftcard" name="giftcard" class="form-control" placeholder="Enter Gift Card No" style="height: 30px;">
                                    </div>
                                    <div class="col-md-3 col-sm-12 col-xs-12" style="text-align:right;padding-right:0px;">
                                        <button id="giftcard_button" class="btn btn-success" type="button" style="font-size:10px; padding:5px 12px;" onclick="applyGiftCard()">Apply</button>
                                        <!-- <button id="giftcard_remove_button" class="btn btn-warning" type="button" onclick="if(confirm('Are you sure you want to remove the gift card?')) removeGiftCard();" style="display:none;font-size:10px; padding:5px 12px;">Remove</button> -->
                                        <button id="giftcard_remove_button" class="btn btn-warning" type="button" onclick="openConfirmationDialog('Are you sure you want to remove the gift card?', function(confirmed) { if (confirmed) { removeGiftCard(); } })" style="display:none;font-size:10px; padding:5px 12px;">Remove</button>
                                    </div>
                                    <label id="giftcard_error" class="error" style="display:none;"></label>
                                    <input type="hidden" id="giftcard_discount" name="giftcard_discount" value="0.00">
                                    <input type="hidden" id="is_giftcard_applied" name="is_giftcard_applied" value="0">
                                    <input type="hidden" id="applied_giftcard_id" name="applied_giftcard_id" value="">
                                </div>
                                <div class="row amount_to_paid_title" id="customer_rewards_div" style="display:none;">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <span class="span_title_side_bar">Apply Rewards</span>
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <span class="span_title_side_bar" id="customer_rewards_text"></span>
                                        <div id="used_rewards_msg"></div>
                                        <input type="hidden" name="customer_reward_available" id="customer_reward_available" value="">
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xs-12" style="text-align:right;padding-right:0px;">
                                        <button id="rewards_button" class="btn btn-success" type="button" style="font-size:10px; padding:5px 12px;" onclick="applyRewards()">Apply</button>
                                        <!-- <button id="rewards_remove_button" class="btn btn-warning" type="button" onclick="if(confirm('Are you sure you want to remove the reward points?')) removeRewards();" style="display:none;font-size:10px; padding:5px 12px;">Remove</button> -->
                                        <button id="rewards_remove_button" class="btn btn-warning" type="button" onclick="openConfirmationDialog('Are you sure you want to remove the reward points?', function(confirmed) { if (confirmed) { removeRewards(); } })" style="display:none;font-size:10px; padding:5px 12px;">Remove</button>
                                    </div>
                                </div>
                                <div class="row reminder_box_input" style="display:none;">
                                    <!-- <h3>Active Offers</h3> -->
                                    <?php if(!empty($offers_list)){ ?>
                                    <div class="row cards-slider">
                                        <?php foreach($offers_list as $offers_list_result){
                                            $offer_services = $this->Salon_model->get_services(explode(',',$offers_list_result->service_name));
                                            $services_names = '';
                                            if (!empty($offer_services)) {
                                                $services_names = implode(', ', array_map(function ($service) {
                                                    return $service->service_name;
                                                }, $offer_services));
                                            }
                                            if($offers_list_result->discount_in == '0'){
                                                $off_text = $offers_list_result->discount.'% OFF';
                                            }else{
                                                $off_text = 'Flat Rs.'.$offers_list_result->discount.' OFF';
                                            }
                                        ?>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="card">
                                                <div class="card_header">
                                                <h4><?=$offers_list_result->offers_name;?> </h4>
                                                <span> - <?=$off_text;?></span>
                                                </div>
                                                <p>
                                                <?php if($services_names != ""){ echo $services_names; } ?>
                                                </p>
                                                <span class="description-txt"><?=$offers_list_result->description;?></span>
                                                <!-- <p class="read_link"><a href="">Read more..</a></p> -->
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <?php } ?>
                                </div>
                                <hr class="break_line">
                                <!-- <div class="row reminder_box_input">
                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                        <textarea type="text" class="form-control" name="note" id="note" placeholder="Add Note" autocomplete="off"></textarea>
                                    </div>
                                </div><br> -->
                                <div class="row reminder_box">
                                    <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <span class="span_title_side_bar">Select Payment Method <b class="require">*</b></b>
                                    </div><br><br>
                                    <div class="row reminder_box">
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <input type="radio" name="payment_method" id="pay_at_salon" value="1" checked>
                                            <label>Pay At Salon</label>
                                        </div>
                                        <label for="payment_method" generated="true" class="error" style="display:none;">Please select payment method!</label>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <span class="span_title_side_bar">Select Remainder Message type <b class="require">*</b></b>
                                    </div><br><br>
                                    <div class="row reminder_box">
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <input type="radio" name="reminder" id="sms" value="1" <?php if(!empty($booking_rules) && $booking_rules->booking_reminder_type == '1'){ echo 'checked'; }?>>
                                            <label>SMS</label>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <input type="radio" name="reminder" id="email_btn" value="2" <?php if(!empty($booking_rules) && $booking_rules->booking_reminder_type == '2'){ echo 'checked'; }?>>
                                            <label>Email</label>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <input type="radio" name="reminder" id="whatsapp" value="3" <?php if(!empty($booking_rules) && $booking_rules->booking_reminder_type == '3'){ echo 'checked'; }?>>
                                            <label>Whatapp</label>
                                        </div>
                                        <label class="error" id="customer_error" style="display:none;">Please select reminder type!</label>
                                        <label class="error" id="select_service_error" style="display:none;">Please select reminder type!</label>
                                        <label class="error" id="stylist_timeslot_error" style="display:none;"></label>
                                        <label for="reminder" generated="true" class="error" style="display:none;">Please select reminder type!</label>
                                    </div> -->
                                    <label class="error" id="customer_error" style="display:none;">Please select reminder type!</label>
                                    <label class="error" id="select_service_error" style="display:none;">Please select reminder type!</label>
                                    <label class="error" id="stylist_timeslot_error" style="display:none;"></label>
                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                        <input type="hidden" id="customer_name" name="customer_name" value="">
                                        <input type="hidden" id="customer_gender" name="customer_gender" value="">
                                        <input type="hidden" name="is_member" id="is_member" value="0">
                                        <input type="hidden" name="membership_id" id="membership_id" value="">
                                        <input type="hidden" name="membership_payment_status" id="membership_payment_status" value="">
                                        <input type="hidden" name="membership_discount_type" id="membership_discount_type" value="">
                                        <input type="hidden" name="membership_service_discount" id="membership_service_discount" value="">
                                        <input type="hidden" name="membership_product_discount" id="membership_product_discount" value="">
                                    </div>
                                    <div class="row confirm_btn_box">
                                        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                            <button type="submit" class="btn btn-info" style="width: 100%;" id="booking_button" name="booking_button" value="booking_button">Confirm Booking</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" id="pricing_details_empty_div" style="display:none;">
                    <div class="x_panel">
                        <div class="x_content">
                            <div class="container">
                                <div class="row">
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12 no_data_img">
                                        <img src="<?= base_url(); ?>admin_assets/images/no_data/no_data.png">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="loader_div">
<div  class="loader-new"></div>
</div>

    <!-- Add new customer model -->

    <div class="add-new-customer-main" style="display: none;">
        <div class="add-new-customer-content" >
            <form method="post" name="add_customer_form" id="add_customer_form" enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label>Customer Name <b class="require">*</b></label>
                        <input autocomplete="off" type="text" class="form-control" name="full_name" id="full_name" placeholder="Enter full name">
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label>Phone Number <b class="require">*</b></label>
                        <input type="text" maxlength="10" class="form-control" name="customer_phone" id="customer_phone" placeholder="Enter phone number" onkeyup="validateUniqueMobile()">
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                        <label>Select Gender<b class="require">*</b></label>
                        <select class="form-select form-control" name="gender" id="gender">
                            <?php if ($store_category->category == '0'){?>
                                <option id="male" value="0">Male</option>
                            <?php }?>
                            <?php if ($store_category->category == '1'){?>
                                <option id="female" value="1">Female</option>
                            <?php }?>
                            <?php if ($store_category->category == '2'){?>
                                <option id="male" value="0">Male</option>
                                <option id="female" value="1">Female</option>
                                <!-- <option id="female" value="2">Other</option> -->
                            <?php }?>
                        </select>
                    </div>
                </div>
                <div class="add-more-info" style="display: none;">
                    <div class="row">
                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email" id="email" placeholder="Enter email">
                        </div>
                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <label>Married Status</label>
                            <select class="form-select form-control" name="married_status" id="married_status">
                                <option value="" class="">Select Status</option>
                                <option value="0" class="">Married</option>
                                <option value="1" class="">Unmarried</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4 col-sm-6 col-xs-12 Anniversary-box" style="display: none">
                            <label>Date Of Anniversary</label>
                            <input readonly maxlength="10" type="text" class="form-control" name="DOA" id="DOA" placeholder="Enter Date of Anniversary">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <label>Date Of Birth</label>
                            <input readonly maxlength="10" type="text" class="form-control" name="dob" id="dob" placeholder="Enter Date of Birth">
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                            <label>State</label>
                            <select class="form-select form-control" name="state" id="state">
                                <option value="" class="">Select State</option>
                                <?php 
		                        $state = $this->Salon_model->get_india_state();
                                if (!empty($state)) {
                                    foreach ($state as $state_result) { ?>
                                        <option value="<?= $state_result->id ?>" <?php if ((!empty($single) && $single->state == $state_result->id) || $state_result->id == '4008') { ?>selected="selected" <?php } ?>>
                                            <?= $state_result->name ?>
                                        </option>
                                <?php }
                                } ?>
                            </select>

                            <?php
                            $city = array();
                            if (!empty($single)) {
                                $city = $this->Admin_model->get_selected_state_city($single->state);
                            }else{
                                $city = $this->Admin_model->get_selected_state_city(4008);
                            }
                            ?>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                            <label>Select City</label>
                            <div>
                                <select class="form-select form-control" name="city" id="city_name">
                                    <option value="">Select City</option>
                                    <?php if (!empty($city)) {
                                        foreach ($city as $city_result) { ?>
                                            <option value="<?= $city_result->id ?>" <?php if (!empty($single) && $single->city == $city_result->id) { ?>selected="selected" <?php } ?>>
                                                <?= $city_result->name ?>
                                            </option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <label>Address</label>
                            <input type="text" class="form-control" name="address" id="address" placeholder="Enter address">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <label>Custom Note</label>
                            <textarea class="form-control" name="custom_note" id="custom_note" placeholder="Enter Customer Note"></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                    <div class="show-more-box"><a href="#" id="show_more">Show More</a></div>
                    <div class="show-more-box"><a href="#" id="show_less" style="display: none;">Show less</a></div>
                </div>
                <label class="error" id="mobile_error" style="display:none;">Please select reminder type!</label>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <button class="btn btn-primary" type="submit" name="customer_button" id="customer_button" value="customer_button">Save</button>
                        <div style="float: left;" onclick="open_customer_model()" class="close_time_slot_Model btn btn-danger">Close</div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Add new customer note -->

    <div class="add-new-customer-note-main" style="display: none;">
        <div class="add-new-customer-content" >
            <div class="row">
                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                    <label>Custom Note</label>
                    <textarea class="form-control" name="add_custom_note" id="add_custom_note" placeholder="Enter Customer Note" value=""></textarea>
                    <input type="hidden" name="add_custom_note_for" id="add_custom_note_for" value="">
                </div>
                <label class="error" id="add_custom_note_error"></label>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <button class="btn btn-primary" type="button" onclick="validateCustomNote()" name="customer_note_button" id="customer_note_button" value="customer_note_button">Save</button>
                    <div style="float: left;" onclick="open_customer_note_model()" class="close_time_slot_Model btn btn-danger">Close</div>
                </div>
            </div>
        </div>
    </div>

<?php include('footer.php');
$tomorrow = date('Y-m-d', strtotime('+1 day'));
if(!empty($booking_rules)){
    $days_early_booking = $booking_rules->max_booking_range_day;
    $rules_employee_selection = $booking_rules->employee_selection;
    if($days_early_booking != ""){
        $max_date = date('d-m-Y', strtotime('+'.$days_early_booking.' day'));
    }else{
        $max_date = date('d-m-Y', strtotime('+0 day'));
    }
}else{
    $max_date = date('d-m-Y', strtotime('+0 day'));
    $rules_employee_selection = '1';
}
$today = date('d-m-Y');

if(isset($_GET['start']) && $_GET['start'] != ""){
    $start = $_GET['start'];
}else{
    $start = '';
}
if(isset($_GET['customer']) && $_GET['customer'] != ""){
    $customer = $_GET['customer'];
}else{
    $customer = '';
}
if(isset($_GET['stylist']) && $_GET['stylist'] != ""){
    $stylist = $_GET['stylist'];
}else{
    $stylist = '';
}
?>
<script src="https://cdn.jsdelivr.net/npm/clockpicker/dist/jquery-clockpicker.min.js"></script>
<script>
    var active_offers = <?php echo json_encode($offers_list); ?>;
    var rules_employee_selection = <?php echo $rules_employee_selection; ?>;
    var user_selected_service = [];
    var user_selected_products = [];
    
    var user_selected_package_service = [];
    var user_selected_package_products = [];
    var user_selected_single_service = [];
    var user_selected_single_products = [];
    var user_selected_regular_service = [];
    var user_selected_regular_products = [];

    var selected_slot_start = '<?php echo  ($start != "") ? date('Y-m-d H:i:s',strtotime($start)) : ''; ?>';
    var selected_slot_start_date = '<?php echo ($start != "") ? date('d-m-Y', strtotime($start)) : ''; ?>';
    var selected_slot_start_time = '<?php echo  ($start != "") ? date('H:i:s',strtotime($start)) : ''; ?>';
    var selected_stylist = '<?php echo $stylist; ?>';
    var selected_customer = '<?php echo $customer; ?>';
    var today_date = '<?php echo  ($today != "") ? date('d-m-Y',strtotime($today)) : ''; ?>';

    if(selected_slot_start_date != ""){
        var parts = selected_slot_start_date.split('-');
        var day = parts[0].trim();
        if (day.length === 1) {
            day = '0' + day; 
        }
        var selected_formattedDate = day + '-' + parts[1].trim() + '-' + parts[2].trim();
    } else {
        var selected_formattedDate = '';
    }

    $(document).ready(function () { 
        function formatStylist(option) {
            console.log('option:',option)
            if (!option.id) {
                return option.text;
            }
            var imgSrc = $(option.element).data('img-src');
            var imgHtml = imgSrc ? '<img src="' + imgSrc + '" style="width: 30px; height: 30px; border-radius: 50%; margin-right: 10px;" />' : '';
            return $(`
                <div style="display: flex; align-items: center;">
                    ${imgHtml}
                    <span>${option.text}</span>
                </div>
            `);
        }

        $("#employee").chosen({
            templateResult: formatStylist,
            templateSelection: formatStylist,
            escapeMarkup: function (markup) {
                return markup;
            }
        });
        $('#booking_management').addClass('nv active');
        if(selected_slot_start_date != "" && selected_slot_start_time != ""){
            $('#booking_date').val(selected_slot_start_date);
            fetchTimeSlots();
            
            var timeParts = selected_slot_start_time.split(":");
            var hours = parseInt(timeParts[0], 10);
            var minutes = parseInt(timeParts[1], 10);
            
            var ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            hours = hours ? hours : 12;
            
            minutes = minutes < 10 ? '0' + minutes : minutes;
            
            selectedValue = hours + ':' + minutes + ' ' + ampm;

            setBookingStart(selectedValue);
            
            // $('#booking_timeslots').hide();
        }else{
            $('#booking_date').val(today_date);
            fetchTimeSlots();
        }
        $("#booking_date").datepicker({
            dateFormat: 'dd-mm-yy',
            maxDate: '<?php echo $max_date; ?>',
            minDate: '<?php echo $today; ?>',
        });   
        $("#dob").datepicker({
            dateFormat: 'dd-mm-yy',
            maxDate: '<?php echo $today; ?>',
        });    
        $("#DOA").datepicker({
            dateFormat: 'dd-mm-yy',
            maxDate: '<?php echo $today; ?>',
        });    
        $('#add_customer_form').validate({
            rules: {
                customer_phone: {
                    required: true,
                    number: true,
                    minlength: 10,
                },
                full_name: {
                    required: true,
                },
                gender: {
                    required: true,
                },
                email: {
                    email: true,
                },
            },
            messages: {
                full_name: {
                    required:'Please enter customer name!',
                },
                customer_phone: {
                    required: "Please enter mobile number!",
                    number: "Only number allowed!",
                    minlength: "Minimum 10 digit required!",
                },
                gender: {
                    required: 'Please select gender!',
                },
                email: {
                    email: 'Please enter valid email!',
                },
            },
            
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });   
        $('#add_customer_note').validate({
            rules: {
                add_custom_note: {
                    required: true,
                },
            },
            messages: {
                add_custom_note: {
                    required:'Please enter custom note!',
                },
            },
            
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });

        if(selected_customer == ""){
            loadDefaultCategories();
        }else{
            get_customer_info(selected_customer);
        }
        
        $('#booking_form').validate({
            ignore : [],
            rules: {
                reminder: 'required',
                payment_method: 'required',
                booking_start: 'required',
                employee: {
                    required: function(element) {
                        return $('#employee_selection_rule').val() == '2';
                    },
                },
            },
            messages: {
                reminder: 'Please select reminder type!',           
                payment_method: 'Please select payment method!',           
                booking_start: 'Please select timeslot!',           
                employee: 'Please select stylist!',           
            },
            submitHandler: function(form) {
                $('#select_service_error').html('');
                $('#select_service_error').hide();
                $('#customer_error').html('');
                $('#customer_error').hide();
                if(user_selected_service.length == 0 && user_selected_products.length == 0){
                    $('#select_service_error').html('Please select atleast one service or product');
                    $('#select_service_error').show();
                }else{
                    if($('#customer_name').val() == ''){
                        $('#customer_error').html('Please select customer');
                        $('#customer_error').show();
                    }else{
                        var validation_flag = 1;
                        $(".service_executive").each(function () {
                            if ($(this).val() == "") {
                                validation_flag = 0;
                                return false;
                            }
                        });

                        if (validation_flag == 1) {
                            if (confirm("Are you sure you want to confirm booking?")) {
                            // openConfirmationDialog("Are you sure you want to confirm booking?", function (confirmed) {
                            // if (confirmed) {
                                $("#stylist_timeslot_error").hide('');
                                $("#stylist_timeslot_error").html('');

                                $('#select_service_error').html('');
                                $('#select_service_error').hide();
                                $('#customer_error').html('');
                                $('#customer_error').hide();

                                document.getElementById('booking_button').remove();
                                form.submit();
                            } else {
                                $('#select_service_error').html('');
                                $('#select_service_error').hide();
                                return false;
                            }
                            // });
                        } else {
                            $("#stylist_timeslot_error").show('');
                            $("#stylist_timeslot_error").html('Please select stylists for the selected service'); 
                        }
                    }
                }
            }
        });
    });
    function validateCustomNote(){
        $('.loader_div').show();
        if($('#add_custom_note').val() == ''){
            $('#add_custom_note_error').show();
            $('#add_custom_note_error').text('Please enter custom note');
        }else{
            $('#add_custom_note_error').hide();
            $('#add_custom_note_error').text('');

            setTimeout(function() {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url(); ?>salon/Ajax_controller/update_customer_note_ajx",
                    data: { 'customer': $('#add_custom_note_for').val(),'customer_note': $('#add_custom_note').val()},
                    success: function(data) {
                        $('#customer_note_activity').text($('#add_custom_note').val());
                        open_customer_note_model();
                        setCustomerNote($('#add_custom_note_for').val());
                    },
                });
            }, 2000);
        }
        $('.loader_div').hide();
    }
    function fetch_categories(){
        $.ajax({
			type: "POST",
			url: "<?= base_url(); ?>salon/Ajax_controller/fetch_categories_ajax",
			data: {	'gender': $("#customer_gender").val(), 'default_status': '0' },
			success: function(data) {
				$("#sup_category").empty();
				$('#sup_category').append('<option value="">Select Category</option>');
				var opts = $.parseJSON(data);
				$.each(opts, function(i, d) {
					$('#sup_category').append('<option value="' + d.id + '">' + d.sup_category + '|' + d.sup_category_marathi + '</option>');
				});
				$('#sup_category').trigger('chosen:updated');
                $('#sup_category').trigger('change');
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus, errorThrown);
			}
		});
    }
    function loadDefaultCategories() {  
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>salon/Ajax_controller/fetch_categories_ajax",
            data: {
                'gender': $("#customer_gender").val(),
                'default_status': '1'
            },
            success: function(data) {
                try {
                    // Parse the received data
                    var default_category = JSON.parse(data);
                    
                    // Call the sequential function with fetched categories
                    createServiceDivSequentially(default_category, 0, 'default', '');
                } catch (error) {
                    console.error("Error parsing default_category:", error);
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", error);
            }
        });

        // Function to create service divs sequentially
        function createServiceDivSequentially(categories, index, type, gender) {
            if (index < categories.length) {
                var id = categories[index].id;
                $('.loader_div').show();
                
                $("#sup_category option[value='" + id + "']").prop('disabled', true);
                $("#sup_category").val('').trigger("chosen:updated");

                setTimeout(function() {
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url(); ?>salon/Ajax_controller/create_services_div_ajx",
                        data: {
                            'category': id,
                            'type': type,
                            'active_offers': active_offers,
                            'gender': $('#customer_gender').val(),
                            'custID': $('#customer_name').val()
                        },
                        success: function(data) {
                            $('.loader_div').hide();
                            $("#services_div").append(data);
                            createServiceDivSequentially(categories, index + 1, type, gender);
                        },
                        error: function(xhr, status, error) {
                            console.error("AJAX Error:", error);
                        }
                    });
                }, 500);
            }
        }
    }
    $("#married_status").change(function() {
        var m_status = $("#married_status").val();
        if (m_status == 0) {
            $('.Anniversary-box').show();
        } else {
            $('.Anniversary-box').hide();
        }
    });
    $("#state").change(function() {
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>admin/Ajax_controller/get_city_ajax",
            data: {
                'state': $("#state").val()
            },
            success: function(data) {
                $("#city_name").empty();
                $('#city_name').append('<option value="">Select City</option>');
                var opts = $.parseJSON(data);
                $.each(opts, function(i, d) {
                    $('#city_name').append('<option value="' + d.id + '">' + d.name + '</option>');
                });
                $('#city_name').trigger('chosen:updated');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });

    $("#show_more").click(function() {
        $('.add-more-info').show();
        $("#show_more").hide();
        $("#show_less").show();
    });
    $("#show_less").click(function() {
        $('.add-more-info').hide();
        $("#show_less").hide();
        $("#show_more").show();
    });
    $("#sup_category").change(function() {
        var customer_name = $('#customer_name').val();
        var customer_gender = $('#customer_gender').val();
        var selectedCategoryId = $(this).val();
        if(customer_name != ""){
            create_service_div(selectedCategoryId,'manual',customer_gender,customer_name);
        }else{
            // alert('Please select customer first');
            openDialog('Please select customer first'); 
            $("#sup_category option[value='" + selectedCategoryId + "']").prop('disabled', false);
            $("#sup_category").val('').trigger("chosen:updated");
        }
    });
    $("#phone").keyup(function() {
        var keyword = $('#phone').val();
        if (keyword.length >= 3) {
            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>salon/Ajax_controller/get_customer_details_ajax",
                data: {
                    'keyword': keyword,
                },
                success: function(data) {
                    var opts = JSON.parse(data);
                    $('.customer-info-by-search').show();
                    if (opts.length > 0) {
                        $('#customers').html('');
                        $.each(opts, function(i, d) {
                            $('#customers').append('<div class="customers_search_results" onclick="get_customer_info(' + d.id + ',\'' + keyword + '\')">' + d.full_name + '[' + d.customer_phone + ']</div>');
                        });
                    }else{
                        $('#customers').html('Customer Not Found! Please Add New Customer.<b onclick="open_customer_model()" class="add-new-customer">Add Customer</b>');
                    }
                },
            }); 
        }else {
            $('.customer-info-by-search').hide();
        }
    });
    function selectTimeslotRadio(timeslot){
        $('#booking_start_time_slot_' + timeslot).prop('checked', true);
        setBookingStart('');
    }
    function setBookingStart(value) {
        if(value == ""){
            var selectedValue = $('input[name="booking_start_time_slot"]:checked').val();
        }else{
            var selectedValue = value;
        }
        if (selectedValue != "") {
            // $('#booking_timeslots').hide();
            $('#booking_start').val(selectedValue);

            fetchTimeSlots();
        }
    }
    function fetchTimeSlots(){
        var total_service_duration = $('#total_service_duration').val();
        var booking_date = $('#booking_date').val();
        var booking_start = $('#booking_start').val();
        var employee = $('#employee').val();
        var employee_selection_rule = $('#employee_selection_rule').val();
        if(booking_date != ""){
            if ($('#booking_timeslots').length > 0) {
                $('#booking_timeslots').html('');
            }
            if ($('#booking_timeslots_loader').length > 0) {
                $('#booking_timeslots_loader').show();
            }
            $.ajax({
                type: "POST",
                url: "<?=base_url();?>salon/Ajax_controller/get_day_timeslots_ajx",
                data:{
                    'booking_date':booking_date,
                    'selected_slot_start_time':selected_slot_start_time,
                    'booking_start':booking_start,
                    'total_service_duration':total_service_duration,
                    'employee': employee,
                    'employee_selection_rule': employee_selection_rule,
                    'user_selected_service': user_selected_service
                },
                success: function(data){
                    if ($('#booking_timeslots').length > 0) {
                        $('#booking_timeslots').html(data);
                        $('#booking_timeslots').show();
                    }
                    if($('#booking_start').val() != ""){
                        setServiceTimeSlots();
                    }else{                        
                        $('#booking_timeslots_loader').hide();
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            }); 
        }
    }
    function validateUniqueMobile(){
        var customer_phone = $('#customer_phone').val();
        $.ajax({
            type: "POST",
            url: "<?=base_url();?>salon/Ajax_controller/get_unique_customer_mobile",
            data:{'customer_phone':customer_phone},
            success: function(data){
                if(data == "0"){
                    $("#mobile_error").hide();
                    $("#mobile_error").html('');
                    $("#customer_button").show();
                }else{
                    $("#mobile_error").show();
                    $("#mobile_error").html('This mobile number is already added');
                    $("#customer_button").hide();
                }
                
            },
            error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
            }
        }); 
    }
    function open_customer_model() {
        $(".add-new-customer-main").toggle();
        $(".customer-info-by-search").hide();
        // $("#customer_phone").val($("#phone").val());
    }
    function open_customer_note_model() {
        $(".add-new-customer-note-main").toggle();
    }
    function get_customer_info(id,keyword) { 
        $('.loader_div').show();   
        setTimeout(function() {
            $('#customer_info_div').show();
            $('#customer_info_empty_div').hide();
            $('#service_package_details_div').show();
            $('#service_package_details_empty_div').hide();
            $('#pricing_details_div').show();
            $('#pricing_details_empty_div').hide();
            $('.customer-info-by-search').hide();                   
            $('#membership_div').html('');
            $('#customer_activity').html('');
            $('#customer_notes').html('');
            $('#customer_payments').html('');
            $('#customer_name_t').html('');
            $('#profile_photo').html('');
            $('#add_date').html('');
            $('#rewards_balance').html('');
            $('#discount_details_div').html('');
            // $('#services_div').html('');
            // $('#selected_services').html('');
            // $('#selected_products').html('');
            // $('#package_div').html('');       
            $('#not_member_div').html(''); 

            $("#services_div").html('');
            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>salon/Ajax_controller/get_customer_details_for_booking_ajax",
                data: { 'id': id,'order_type': '0' },
                success: function(data) {     
                    user_selected_service = [];
                    user_selected_products = [];
                    
                    user_selected_package_service = [];
                    user_selected_package_products = [];
                    user_selected_single_service = [];
                    user_selected_single_products = [];  

                    $('.loader_div').hide();

                    var parsedData = JSON.parse(data);
                    // console.log(parsedData.customer);
                    $('#customer_name').val(parsedData.customer.id);
                    $('#customer_gender').val(parsedData.customer.gender);
                    $('#phone').val('');

                    var currentHref = $('#product_booking_anchor').attr('href');
                    var newHref = currentHref + '?customer=' + parsedData.customer.id;
                    $('#product_booking_anchor').attr('href', newHref);

                    var booking_list = parsedData.order_history;
                    var order_service_history = parsedData.order_service_history;
                    var payments = parsedData.payments;
                    var counts = parsedData.counts;
                    var packages = parsedData.packages;

                    var baseUrl = '<?= base_url() ?>';

                    if(order_service_history.length > 0){
                        for (var x = 0; x < order_service_history.length && x < 5; x++) {
                            if (parsedData.customer.id == order_service_history[x].customer_name && order_service_history[x].service_date != null && order_service_history[x].service_date != "") {
                                var serviceFrom = moment(order_service_history[x].service_from).format('hh:mm A');
                                var serviceTo = moment(order_service_history[x].service_to).format('hh:mm A');
                                var serviceDate = moment(order_service_history[x].service_date).format('DD MMM YYYY');

                                if(order_service_history[x].service_status == "1"){
                                    style = 'style="background-color:#00800040"';
                                    text = 'Completed';
                                    label_class = 'success';
                                }else if(order_service_history[x].service_status == "2"){
                                    style = 'style="background-color:#ff000038"';
                                    text = 'Cancelled';
                                    label_class = 'danger';
                                }else if(order_service_history[x].service_status == "3"){
                                    style = 'style="background-color:#8000802e"';
                                    text = 'Lapsed';
                                    label_class = 'info';
                                } else {
                                    style = 'style="background-color:#ffa50045"';
                                    text = 'Pending';
                                    label_class = 'warning';
                                }
                                $('#customer_activity').append('<div class="acticity_timeline_circle"></div>' +
                                    '<div class="single_activity_box" ' + style + '><div class="cleint-activity activity_service_name"><p>' + order_service_history[x].service_name + ' | ' + order_service_history[x].service_name_marathi + '</p></div>' +
                                    '<div class="cleint-activity">' + serviceDate + ', ' + serviceFrom + ' to ' + serviceTo + '</div>' +
                                    '<div class="cleint-activity">' + order_service_history[x].full_name + '</div>' +
                                    '<div class="cleint-activity">' +
                                        '<label style="color:black;" class="label label-' + label_class + '">' + text + '</label>' +
                                        (order_service_history[x].receipt_no ? '<label style="float:right;color:#7a8a9c;font-size: 12px;">(ID: ' + order_service_history[x].receipt_no + ')</label>' : '') +
                                    '</div></div>'                                
                                );
                            }
                        }
                    }else{ 
                        $('#customer_activity').append('<img src="<?= base_url(); ?>admin_assets/images/no_data/no_data.png" >');
                    }

                    // if(booking_list.length > 0){
                    //     for (var x = 0; x < booking_list.length && x < 7; x++) {
                    //         if(booking_list[x].note != ""){
                    //             if (parsedData.customer.id == booking_list[x].customer_name && booking_list[x].booking_date != null && booking_list[x].booking_date != "") {
                    //                 var bookingDate = moment(booking_list[x].booking_date).format('DD MMM YYYY');

                    //                 $('#customer_notes').append('<div class="acticity_timeline_circle"></div>' +
                    //                     '<div class="single_activity_box"><div class="cleint-activity">' + bookingDate + '</div>' +
                    //                     '<div class="cleint-activity">Note: ' + booking_list[x].note + '</div></div>'
                    //                 );
                    //             }
                    //         }
                    //     }
                    // }else{
                    //     $('#customer_notes').append('<img src="<?= base_url(); ?>admin_assets/images/no_data/no_data.png" width="100%">');
                    // }

                    setCustomerNote(parsedData.customer.id);

                    if(payments.length > 0){
                        for (var x = 0; x < payments.length && x < 10; x++) {
                            if (booking_list[x].payment_date != null && booking_list[x].payment_date != "") {
                                var payment_date = moment(booking_list[x].payment_date).format('DD MMM YYYY');

                                $('#customer_payments').append('<div class="acticity_timeline_circle"></div>' +
                                    '<div class="single_activity_box"><div class="cleint-activity"><p style="margin: 0 0 0px;color:#7a8a9c;">ID: ' + payments[x].receipt_no + '</p><p style="margin: 0 0 0px;">' + payment_date + ' - Rs. ' + payments[x].paid_amount + '</p></div><div class="cleint-activity">' + 'Mode: ' + payments[x].payment_mode + '</div>'+
									'<a class="btn" style="float:right; margin-top: -32px;" target="_blank" href="<?php echo base_url(); ?>booking-print/' + btoa(payments[x].booking_id) + '/' + btoa(payments[x].booking_payment_id) + '" title="Receipt"><i class="fas fa-receipt"></i></a>'+
                                    '</div>'
                                );
                            }
                        }
                    }else{
                        $('#customer_payments').append('<img src="<?= base_url(); ?>admin_assets/images/no_data/no_data.png" >');
                    }

                    $('#customer_name_t').html(parsedData.customer.full_name);
                    $('#phone').val('')

                    var fullName = parsedData.customer.full_name;
                    var initials = fullName.split(' ').map(word => word.charAt(0)).join('');
                    $('#profile_photo').append('<span class="name_head">' + initials + '</span>');

                    var timestamp = parsedData.customer.created_on;
                    var dateObject = new Date(timestamp);
                    var year = dateObject.getFullYear();
                    var month = (dateObject.getMonth() + 1).toString().padStart(2, '0');
                    var day = dateObject.getDate().toString().padStart(2, '0');
                    var formattedDate = day + '-' + month + '-' + year;

                    $('#add_date').html('Since:' + formattedDate);
                    $('#rewards_balance').html('Reward Balance: ' + parsedData.customer.rewards_balance + ' Points');
                    $('#due_balance').html('Pending Amount: Rs. ' + parseFloat(parsedData.customer.current_pending_amount).toFixed(2) + '');

                    if(counts.pending > 0){
                        $('#total_pending').html('Total Pending Services: ' + counts.pending + '');
                    }
                    if(counts.rescheduled > 0){
                        $('#total_rescheduled').html('Total Reschedules: ' + counts.rescheduled + '');
                    }
                    if(counts.completed > 0){
                        $('#total_completed').html('Total Completed Services: ' + counts.completed + '');
                    }
                    if(counts.cancelled > 0){
                        $('#total_cancelled').html('Total Cancelled Services: ' + counts.cancelled + '');
                    }

                    if(parseInt(parsedData.customer.rewards_balance) > 0){
                        // $('#customer_rewards_div').show();
                        $('#customer_rewards_text').text('Balance: ' + parsedData.customer.rewards_balance);
                        $('#customer_reward_available').val(parsedData.customer.rewards_balance);
                    }

                    $('#is_member').val(parsedData.is_member);

                    if(parsedData.is_member == '1'){                       
                        $('#membership_id').val(parsedData.membership.membership_id);
                        $('#membership_payment_status').val(parsedData.membership.payment_status);
                        if(parsedData.membership.payment_status == '0'){
                            $('#total-membership-amount').val(parsedData.membership.membership_price);
                            $('#total_membership_amount_t').text(parseFloat(parsedData.membership.membership_price).toFixed(2));                            
                        }else{
                            $('#total-membership-amount').val('0.00');
                            $('#total_membership_amount_t').text('0.00');   
                        }
                        $('#membership_discount_type').val(parsedData.membership.discount_in);  //0=percentage,1=flat
                        $('#membership_service_discount').val(parsedData.membership.service_discount);
                        $('#membership_product_discount').val(parsedData.membership.product_discount);
                        if(parsedData.membership.discount_in == '0'){
                            membership_service_discount_text = parsedData.membership.service_discount+'%';
                            membership_product_discount_text = parsedData.membership.product_discount+'%';
                        }else{
                            membership_service_discount_text = 'Rs.'+parsedData.membership.service_discount;
                            membership_product_discount_text = 'Rs.'+parsedData.membership.product_discount;
                        }

                        membership_div =
                            // '<div class="row total_payable_amount text-right">'+
                            //     '<div class="col-lg-10 text-left">'+
                            //         '<span class="span_title_side_bar">Membership Service Discount ('+ membership_service_discount_text +')</span>'+
                            //     '</div>'+
                            //     '<div class="col-lg-2">'+
                            //         '<div id="membership_service_discount_amount"> 0.00</div>'+
                                    '<input type="hidden" name="membership_service_discount_amount_hidden" id="membership_service_discount_amount_hidden" value="0.00">'+
                            //     '</div>'+
                            // '</div>'+
                            // '<div class="row total_payable_amount text-right">'+
                            //     '<div class="col-lg-10 text-left">'+
                            //         '<span class="span_title_side_bar">Membership Product Discount ('+ membership_product_discount_text +')</span>'+
                            //     '</div>'+
                            //     '<div class="col-lg-2">'+
                            //         '<div id="membership_product_discount_amount"> 0.00</div>'+
                                    '<input type="hidden" name="membership_product_discount_amount_hidden" id="membership_product_discount_amount_hidden" value="0.00">';
                            //     '</div>'+
                            // '</div>';
                        $('#membership_div').append(membership_div);
                        $('#membership_div').show();
                        
                        $('#not_member_div').html(
                            '<div>' +
                                '<a class="btn btn-sm" style="float:right; background-color:' + parsedData.membership.bg_color + '; color:' + parsedData.membership.text_color + '">' + 
                                    parsedData.membership.membership_name + 
                                '</a>' +
                                '<div id="mem_details_info">' +
                                    '<i class="fas fa-info-circle" style="color:#0000ffb0;"></i>' +
                                    '<div class="mem-tooltip">' +
                                        '<p>Price' +
                                            '<span class="amount" style="float: right;">Rs. ' + parsedData.membership.membership_price + '</span>' +
                                        '</p>' +
                                        '<p>Service Discount' +
                                            '<span class="amount" style="float: right;">' + membership_service_discount_text + '</span>' +
                                        '</p>' +
                                        '<p>Product Discount' + 
                                            '<span class="amount" style="float: right;">' + membership_product_discount_text + '</span>' +
                                        '</p>' +
                                    '</div>' +
                                '</div>' +
                            '</div>'
                        );
                    }else{
                        membership_div =
                                    '<input type="hidden" name="membership_service_discount_amount_hidden" id="membership_service_discount_amount_hidden" value="0.00">'+
                                    '<input type="hidden" name="membership_product_discount_amount_hidden" id="membership_product_discount_amount_hidden" value="0.00">';
                        $('#membership_div').append(membership_div);
                        $('#membership_div').hide();

                        $('#not_member_div').html(
                            '<div class="membership_details"><a href="<?= base_url(); ?>asign-membership/'+ parsedData.customer.id +'" target="_blank">Not a Member</a></div>'                     
                        )
                    }
                    
                    if (packages.length > 0) {
                        $('#package_div').append('<a class="customer_packages_available" href="<?= base_url(); ?>asign-package?phone=' + parsedData.customer.customer_phone + '&customer=' + parsedData.customer.id + '" style="text-decoration:underline;" target="_blank">Assign New</a>');
                        $('#package_name').html('');
                        $('#package_name').append('<option value="">Select Package</option>');
                        $.each(packages, function(i, d) {
                            $('#package_name').append('<option value="' + d.id + '@@@' + d.package_id + '">' + d.package_name + '</option>');
                        });
                        $("#package_name").val('').trigger("chosen:updated");
                    }else{
                        $('#package_div').append('<div class="customer_packages_not_available">Packages not available. <a href="<?= base_url(); ?>asign-package?phone=' + parsedData.customer.customer_phone + '&customer=' + parsedData.customer.id + '" style="text-decoration:underline;" target="_blank">Assign New</a></div>');
                    }

                    fetch_categories();

                    loadDefaultCategories();

                    setPayableAmount();
                },
            });
        }, 1500);
    }
    function setCustomerNote(for_customer_id){
        $('#customer_notes').empty();
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>salon/Ajax_controller/get_customer_details_for_booking_ajax",
            data: { 'id': for_customer_id,'order_type': '0' },
            success: function(data) {     
                var parsedData = JSON.parse(data);
                $('#add_custom_note_for').val(for_customer_id);
                if(parsedData.customer.custom_note != "" && parsedData.customer.custom_note != null){
                    $('#customer_notes').append('<a onclick="open_customer_note_model()" style="padding: 6px 16px;background-color: #0056d1;border-radius: 6px;color: #fff;">Update</a>');
                    $('#customer_notes').append('<div class="single_activity_box" style="margin:0px auto;">' +
                                                    '<div class="cleint-activity" id="customer_note_activity">' + parsedData.customer.custom_note + '</div></div>'
                                                );
                    $('#add_custom_note').val(parsedData.customer.custom_note);
                }else{
                    $('#customer_notes').append('<a onclick="open_customer_note_model()" style="padding: 6px 16px;background-color: #0056d1;border-radius: 6px;color: #fff;">Add New</a>');
                    $('#customer_notes').append('<img src="<?= base_url(); ?>admin_assets/images/no_data/no_data.png" >');
                    $('#add_custom_note').val('');
                }
            }
        });
    }
    function create_service_div(id,type,gender,custID) {
        $('.loader_div').show();   
        setTimeout(function() {
            $("#sup_category option[value='" + id + "']").prop('disabled', true);
            $("#sup_category").val('').trigger("chosen:updated");

            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>salon/Ajax_controller/create_services_div_ajx",
                data: { 'category': id, 'type': type, 'active_offers': active_offers, 'gender': gender, 'custID': custID},
                success: function(data) {
                    $('.loader_div').hide();   
                    $("#services_div").append(data);
                },
            });
        }, 1500);
    }
    function search_service(category_id) {
        $('#all_services_div_' + category_id + ' .no-services').html('');
        var value = $('#search_services_' + category_id).val().toLowerCase();
        var found = false;
        $('#all_services_div_' + category_id + ' .service_name_t_' + category_id).filter(function() {
            var match = $(this).text().toLowerCase().indexOf(value) > -1;
            $(this).closest('.row').toggle(match);
            if (match) {
                found = true;
            }
        });

        if (!found) {
            $('#all_services_div_' + category_id).append('<div class="no-services" style="text-align: center;color: red;margin-top: 10px;font-size: 12px;">Service not found</div>');
        } else {
            $('#all_services_div_' + category_id + ' .no-services').remove();
        }
    }
    function removeCategory(category_id) {
        // if (confirm("Are you sure you want remove complete category?")) {
        openConfirmationDialog("Are you sure you want remove complete category?", function (confirmed) {
        if (confirmed) {
            $('.loader_div').show();   
            setTimeout(function() {            
                var current_total = parseFloat($('#total-service-amount').val());
                var current_product_total = parseFloat($('#total-product-amount').val());

                final_deduct_total = 0;
                final_deduct_product_total = 0;

                for(var k=0;k<user_selected_regular_service.length;k++){
                    var service_price = parseFloat($('#service_price_' + user_selected_regular_service[k]).val());

                    final_deduct_total = final_deduct_total + service_price;

                    $('#selected_service_details_' + user_selected_regular_service[k]).remove();

                    removeValue(user_selected_service, user_selected_regular_service[k]);
                    
                    var selected_product = parseInt($('#selected_product_'+user_selected_regular_service[k]).text());
                    selected_product_deduct = 0;
                    for(var l=0;l<user_selected_regular_products.length;l++){
                        var product_price = parseFloat($('#product_price_'+user_selected_regular_service[k]+'_'+user_selected_regular_products[l]).val());
                    
                        final_deduct_product_total = final_deduct_product_total + product_price;
                        selected_product_deduct = selected_product_deduct + 1;
                        
                        $('#selected_service_product_details_'+ user_selected_regular_products[l]).remove();

                        removeValue(user_selected_products, user_selected_regular_products[l]);
                    }
                    selected_product = selected_product - selected_product_deduct;
                    $('#selected_product_'+user_selected_regular_service[k]).text(parseInt(selected_product));
                    $('#service_name_check_' + user_selected_regular_service[k]).prop('checked', true).css('pointer-events', 'all');
                }
                user_selected_regular_service = []; 
                user_selected_regular_products = []; 

                final_total = current_total - final_deduct_total;
                final_product_total = current_product_total - final_deduct_product_total;

                $('#total-service-amount').val(parseFloat(final_total).toFixed(2));
                $('#total_service_amount_t').text(parseFloat(final_total).toFixed(2));            
                
                $('#total-product-amount').val(parseFloat(final_product_total).toFixed(2));
                $('#total_product_amount_t').text(parseFloat(final_product_total).toFixed(2));

                setPayableServiceAmount();
                
                setPayableServiceProductAmount(); 

                $('#single_service_details_append_' + category_id).remove();
                $("#sup_category option[value='" + category_id + "']").prop('disabled', false);
                $("#sup_category").trigger("chosen:updated"); 

                $('.loader_div').hide();   
            }, 1500);
        }
        });
    }

    function setServicePrice(serviceID){
        var service_price = parseFloat($('#service_price_' + serviceID).val());
        var service_duration = $('#service_duration_' + serviceID).val();
        var service_name = $('#service_name_' + serviceID).val();
        var service_rewards = $('#service_rewards_hidden_' + serviceID).val();
        var service_added_from = $('#service_added_from_' + serviceID).val();
        var current_total = parseFloat($('#total-service-amount').val());
        var customer_name = $('#customer_name').val();
        
        if(customer_name != ""){
            var booking_date = $('#booking_date').val();
            var booking_start = $('#booking_start').val();

            // if (booking_date !== "" && booking_start !== "") {
                if ($('#service_name_check_' + serviceID).is(':checked')) {
                    if(!user_selected_service.includes(serviceID)){
                        $(".product_checkbox_"+serviceID).attr('disabled', false);

                        current_total = current_total + service_price;

                        user_selected_service.push(serviceID);

                        createServiceDetailsDiv(serviceID,service_added_from,service_name,service_duration,service_rewards,' (Rs. '+service_price+')');

                        var tempArray = [];

                        $(".product_checkbox_"+serviceID).each(function() {
                            $(this).prop('checked', true); 
                            tempArray.push($(this).val());
                        });

                        for (var i = 0; i < tempArray.length; i++) {
                            setServiceProductPrice(serviceID,tempArray[i]);
                        }
                    }else{
                        // alert('Service already selected');
                        openDialog('Service already selected'); 
                        $('#service_name_check_' + serviceID).prop('checked', false);
                    }
                } else {
                    var selected_product = parseInt($('#selected_product_'+serviceID).text());
                    removeValue(user_selected_service, serviceID);
                    removeValue(user_selected_single_service, serviceID);
                    removeValue(user_selected_package_service, serviceID);

                    removeGiftCard();
                    $('.loader_div').show(); 

                    $(".product_checkbox_"+serviceID).attr('disabled', true);

                    current_total = current_total - service_price;

                    $('#selected_service_details_' + serviceID).remove();

                    $('#executive_for_service_button_' + serviceID).text('Select Stylist'); 

                    if(user_selected_service.length == 0){
                        $('#selected_services_empty').show();
                    }
                                        
                    var tempArray = [];
                    $(".product_checkbox_"+serviceID).each(function() {
                        if ($(this).prop('checked')) {
                            $(this).prop('checked', false); 
                            tempArray.push($(this).val());
                        }
                    });

                    for (var i = 0; i < tempArray.length; i++) {
                        setServiceProductPrice(serviceID,tempArray[i]);
                    }
                }

                calculateTotalServiceDuration();
                
                fetchTimeSlots();

                $('#total-service-amount').val(parseFloat(current_total).toFixed(2));
                $('#total_service_amount_t').text(parseFloat(current_total).toFixed(2));

                setPayableServiceAmount();
            // }else{
            //     alert('Please select booking date and timeslot first');
            //     openDialog('Please select booking date and timeslot first'); 
            //     $('#service_name_check_' + serviceID).prop('checked', false);
            // }
        }else{
            // alert('Please select customer first');
            openDialog('Please select customer first'); 
            $('#service_name_check_' + serviceID).prop('checked', false);
        }
    }
    function setServiceTimeSlots(){
        if(user_selected_service.length > 0){
            for(var i=0;i<user_selected_service.length;i++){
                var singleService = user_selected_service[i];            
                var service_duration = $('#service_duration_' + singleService).val();
                var service_rewards = $('#service_rewards_hidden_' + singleService).val();

                var booking_date = $('#booking_date').val();
                var previous_start = $('#previous_start').val();

                if(booking_date != "" && $('#booking_start').val() != ""){
                    if(i == 0){
                        var booking_start = $('#booking_start').val();
                    }else{
                        var booking_start = previous_start;
                    }
                    
                    var dateParts = booking_date.split("-");
                    var day = parseInt(dateParts[0], 10);
                    var month = parseInt(dateParts[1], 10);
                    var year = parseInt(dateParts[2], 10);

                    var timeParts = booking_start.split(":");
                    var hours = parseInt(timeParts[0], 10);
                    var minutes = parseInt(timeParts[1], 10);

                    if (booking_start.includes("PM") && hours !== 12) {
                        hours += 12;
                    } else if (booking_start.includes("AM") && hours === 12) {
                        hours = 0;
                    }
                    
                    selected_slot_start = new Date(year, month - 1, day, hours, minutes, 0);
                    var selected_slot_end = new Date(selected_slot_start.getTime() + (service_duration * 60000));

                    var formatted_slot_start_time = formatTime(selected_slot_start);
                    var formatted_slot_end_time = formatTime(selected_slot_end);

                    var formatted_slot_start_time_24hr = convertTo24HourFormat(formatted_slot_start_time);
                    var formatted_slot_end_time_24hr = convertTo24HourFormat(formatted_slot_end_time);
                    var formatted_booking_date_PHP = formatToOnlyDate_PHPFormat(selected_slot_start);
                    var timeslot_string = formatted_booking_date_PHP + ' ' + formatted_slot_start_time_24hr + '@@@' + formatted_booking_date_PHP + ' ' + formatted_slot_end_time_24hr;

                    $('#service_reward_points_'+ singleService +'').val(service_rewards);
                    $('#service_stylist_timeslot_hidden_'+ singleService +'').val(timeslot_string);
                    $('#service_stylist_timeslot_'+ singleService +'').text(formatted_slot_start_time + ' to ' + formatted_slot_end_time);
                                
                    getTimeStylist(booking_date,selected_slot_start,selected_slot_end,singleService,service_duration);

                    $('#previous_start').val(formatted_slot_end_time_24hr);
                }
            }
        }
        $('#booking_timeslots_loader').hide();
    }
    function formatTime(time) {
        var hours = time.getHours();
        var minutes = time.getMinutes();
        var ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12;
        hours = hours ? hours : 12; // the hour '0' should be '12'
        minutes = minutes < 10 ? '0' + minutes : minutes;

        return hours + ':' + minutes + ' ' + ampm;
    }
    function formatToOnlyDate(date) {
        var monthNames = [
            "Jan", "Feb", "Mar",
            "Apr", "May", "Jun", "Jul",
            "Aug", "Sep", "Oct",
            "Nov", "Dec"
        ];

        var day = date.getDate();
        var monthIndex = date.getMonth();
        var year = date.getFullYear();

        return day + ' ' + monthNames[monthIndex] + ' ' + year;
    }
    function formatToOnlyDate_PHPFormat(date) {
        var year = date.getFullYear();
        var month = ('0' + (date.getMonth() + 1)).slice(-2); // Adding leading zero if necessary
        var day = ('0' + date.getDate()).slice(-2); // Adding leading zero if necessary
        return year + '-' + month + '-' + day;
    }
    function createServiceDetailsDiv(serviceID,selected_from,service_name,service_duration,service_rewards,price){
        var stylists = <?php echo json_encode($salon_employee_list) ?>;

        if(selected_from == 'default'){
            var service_details_div_class = 'single_added_service_details';
            user_selected_single_service.push(serviceID);
        }else if(selected_from == 'manual'){
            var service_details_div_class = 'single_added_service_details';
            user_selected_regular_service.push(serviceID);
        }else{
            var service_details_div_class = 'package_added_service_details';
            user_selected_package_service.push(serviceID);
        }

        var tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);

        var tomorrowFormatted = tomorrow.toISOString().split('T')[0];
        var total_count = 0;
        var z = 0;

        service_details = 
            '<style>#service_stylist_id_' + serviceID + '_chosen{ pointer-events: none !important; background-color: #e9ecef; color: #6c757d; }</style>' +
            '<div class="row single_added_service_details ' + selected_from + '_added_service_details" id="selected_service_details_'+ serviceID +'">'+
                '<input type="hidden" id="service_added_from_'+ serviceID +'" value="'+ selected_from +'">'+
                '<div class="col-md-12 col-sm-12 col-xs-12 selected-servicesbox">'+
                    '<span class="left-span" style="font-size: 13px !important;">'+ service_name +''+ price +'</span>'+
                    '<div class="span-row">'+
                        '<span class="bottom-span">'+ service_duration +' Mins</span>'+
                        '<input type="hidden" id="service_reward_points_'+ serviceID +'" name="service_reward_points_'+ serviceID +'" value="">'+
                        '<span class="bottom-span" id="service_stylist_timeslot_' + serviceID + '"></span>' +
                        '<input type="hidden" class="service_stylist_timeslot_hidden" id="service_stylist_timeslot_hidden_'+ serviceID +'" name="service_stylist_timeslot_hidden_'+ serviceID +'" value="">'+
                        '<div class="col-lg-6" id="service_executive_div_' + serviceID + '" style="display:none;">'+
                            '<select class="form-control service_executive" name="service_stylist_id_' + serviceID + '" id="service_stylist_id_' + serviceID + '"></select>'+
                        '</div>'+
                    '</div>'+
                '</div>'+   
            '</div>';

        // $('#booking_timeslots').hide();
        $('#selected_services_empty').hide();
        $('#selected_services').append(service_details);
    }
    function convertTo24HourFormat(time) {
        var hours = parseInt(time.split(':')[0]);
        var minutes = parseInt(time.split(':')[1].split(' ')[0]);
        var ampm = time.split(' ')[1];

        if (ampm === 'PM' && hours < 12) {
            hours += 12;
        }
        if (ampm === 'AM' && hours === 12) {
            hours = 0;
        }

        var formattedTime = ('0' + hours).slice(-2) + ':' + ('0' + minutes).slice(-2) + ':00';
        return formattedTime;
    }
    function getTimeStylist(booking_date,selected_slot_start,selected_slot_end,serviceID,service_duration){
        var formatted_start = formatDate(selected_slot_start);
        var formatted_end = formatDate(selected_slot_end);

        if (formatted_start !== "" && typeof formatted_start !== "undefined" && formatted_end !== "" && typeof formatted_end !== "undefined") {
            selectedTimeSlot = formatted_start + '@@@' + formatted_end;
            $("#service_executive_div_"+serviceID).hide();
            $("#service_stylist_id_"+serviceID).html("");
            var employee_selection_rule = $('#employee_selection_rule').val();
            var selected_employee = $('#employee').val();
            var previous_stylist = $('#previous_stylist').val();
            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>salon/Ajax_controller/get_available_stylists_servicewise_ajx",
                data: { 'service':serviceID,'selectedTimeSlot': selectedTimeSlot, 'selected_employee': selected_employee, 'employee_selection_rule': employee_selection_rule, 'previous_stylist': previous_stylist },
                success: function(data) {
                    $("#service_stylist_id_"+serviceID).chosen();
                    $("#service_stylist_id_"+serviceID).val('');
                    var stylists = $.parseJSON(data);
                    $('#booking_timeslots_loader').hide();
                    if(stylists.length > 0){
                        $("#service_stylist_id_"+serviceID).empty();
                        // $("#service_stylist_id_"+serviceID).append('<option value="">Select Executive</option>');
                        var opts = $.parseJSON(data);
                        var count = 1;
                        $.each(opts, function(i, d) {
                            store_flag = d.store_flag;
                            is_service_available = d.is_service_available;
                            is_shift_available = d.is_shift_available;
                            is_booking_present = d.is_booking_present;
                            is_on_leave_flag = d.is_on_leave_flag;
                            is_on_break = d.is_on_break;
                            is_emergency_flag = d.is_emergency_flag;
                            
                            shift_id = d.shift_id;
                            shift_type = d.shift_type;

                            var emp_unique_id = d.stylist_details.id + '@@@' + shift_id + '@@@' + shift_type;

                            if(is_service_available == '1'){
                                if(store_flag == '1'){
                                    if(is_emergency_flag == '0'){
                                        if(is_on_leave_flag == '0'){
                                            if(is_shift_available == '1'){
                                                if(is_booking_present == '0'){
                                                    if(is_on_break == '0'){
                                                        var message = '';
                                                        var disabled = '';
                                                        var is_Allowed = 1;
                                                    }else{
                                                        var message = '- Stylist On Break';
                                                        var disabled = 'disabled';
                                                        var is_Allowed = 0;
                                                    }
                                                }else{
                                                    var message = '- Slot Already Booked';
                                                    var disabled = 'disabled';
                                                    var is_Allowed = 0;
                                                }
                                            }else{
                                                var message = '- Shift Not Available';
                                                var disabled = 'disabled';
                                                var is_Allowed = 0;
                                            }
                                        }else{
                                            var message = '- On Leave';
                                            var disabled = 'disabled';
                                            var is_Allowed = 0;
                                        }
                                    }else{
                                        var message = '- Store Emergency Closed';
                                        var disabled = 'disabled';
                                        var is_Allowed = 0;
                                    }
                                }else{
                                    var message = '- Exceed Salon Times';
                                    var disabled = 'disabled';
                                    var is_Allowed = 0;
                                }

                                var selected = '';
                                if(d.to_be_selected == '1'){
                                    selected = 'selected';
                                    $('#previous_stylist').val(d.stylist_details.id);
                                }

                                if(rules_employee_selection == '2'){
                                    selected = '';
                                }

                                // $("#service_stylist_id_"+serviceID).append('<option ' + disabled + ' ' + selected + ' value="' + d.stylist_details.id + '">' + d.stylist_details.full_name + ' ' + message + '</option>');
                                $("#service_stylist_id_"+serviceID).append('<option ' + disabled + ' ' + selected + ' value="' + emp_unique_id + '">' + d.stylist_details.full_name + ' ' + message + '</option>');
                            }else{
                                var disabled = 'disabled';
                                var message = '- Stylist Not Available';
                            }
                        });

                        $("#service_stylist_id_"+serviceID).trigger('chosen:updated');
                        $("#service_executive_div_"+serviceID).show();
                    }else{
                        $("#service_stylist_id_"+serviceID+"_chosen").hide();
                        $("#service_stylist_id_"+serviceID).hide();
                        $("#service_executive_div_"+serviceID).append('<label style="font-size:10px;" class="error">Please, first set Stylist designation employees.</label>');
                        $("#service_executive_div_"+serviceID).show();
                    }
                },
            });
        }
    }
    function calculateTotalServiceDuration(){
        total_duration = 0;

        for(var i=0;i<user_selected_single_service.length;i++){
            duration = $('#service_duration_' + user_selected_single_service[i]).val();
            total_duration = total_duration + parseFloat(duration);
        }

        for(var i=0;i<user_selected_regular_service.length;i++){
            duration = $('#service_duration_' + user_selected_regular_service[i]).val();
            total_duration = total_duration + parseFloat(duration);
        }

        var selected_package_id = $('#selected_package_id').val();
        if(selected_package_id != "" && selected_package_id != null){
            for(var i=0;i<user_selected_package_service.length;i++){
                duration = $('#package_service_duration_' + selected_package_id + '_' + user_selected_package_service[i]).val();
                total_duration = total_duration + parseFloat(duration);
            }
        }

        $('#upper_duration').text(parseInt(total_duration) + ' Mins');
        $('#total_service_duration').val(parseInt(total_duration));
    }
    function formatDate(date) {
        var year = date.getFullYear();
        var month = ('0' + (date.getMonth() + 1)).slice(-2);
        var day = ('0' + date.getDate()).slice(-2);
        var hours = ('0' + date.getHours()).slice(-2);
        var minutes = ('0' + date.getMinutes()).slice(-2);
        var seconds = ('0' + date.getSeconds()).slice(-2);

        return year + '-' + month + '-' + day + ' ' + hours + ':' + minutes + ':' + seconds;
    }    
    function setServiceProductPrice(serviceID,productID){  
        var product_price = parseFloat($('#product_price_'+serviceID+'_'+productID).val());
        var product_name = $('#product_name_'+serviceID+'_'+productID).val();
        var product_added_from = $('#product_added_from_'+serviceID+'_'+productID).val();
        var current_total = parseFloat($('#total-product-amount').val());
        var selected_product = parseInt($('#selected_product_'+serviceID).text());
        
        if ($('#product_checkbox_'+serviceID+'_'+productID).is(':checked')) {      
            current_total = current_total + product_price;
            selected_product = selected_product + 1;

            user_selected_products.push(productID);
            
            createServiceProductDetailsDiv(productID,product_added_from,product_name,serviceID,' (Rs. '+product_price+')');
        } else {
            removeValue(user_selected_products, productID);
            removeValue(user_selected_single_products, productID);
            removeValue(user_selected_package_products, productID);

            current_total = current_total - product_price;
            selected_product = selected_product - 1;

            $('#selected_service_product_details_'+ productID).remove();

            if(user_selected_products.length == 0){
                $('#selected_products_empty').show();
            }
        }

        $('#total-product-amount').val(parseFloat(current_total).toFixed(2));
        $('#total_product_amount_t').text(parseFloat(current_total).toFixed(2));
        $('#selected_product_'+serviceID).text(parseInt(selected_product));
        
        setPayableServiceProductAmount();
    }
    function createServiceProductDetailsDiv(productID,selected_from,product_name,serviceID,price){        
        if(selected_from == 'default'){
            var product_details_div_class = 'single_added_product_details';
            user_selected_single_products.push(productID);
        }else if(selected_from == 'manual'){
            var product_details_div_class = 'single_added_product_details';
            user_selected_regular_products.push(productID);
        }else{
            var product_details_div_class = 'package_added_product_details';
            user_selected_package_products.push(productID);
        }
        product_details = 
            '<div class="row single_added_service_details ' + selected_from + '_added_product_details ' + serviceID + '_service_products" id="selected_service_product_details_'+ productID +'">'+
                '<input type="hidden" id="product_added_from_'+ productID +'" value="'+ selected_from +'">'+
                '<div class="col-md-12 col-sm-12 col-xs-12 selected-servicesbox">'+
                    '<span>'+ product_name +''+price+'</span>'+
                '</div>'+
                '<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">'+
                    // '<span>Rs. '+ product_price +' </span>'+
                '</div>'+
            '</div>';
        $('#selected_products_empty').hide();
        $('#selected_products').append(product_details);
    }
    
    function setPayableServiceAmount(){
        giftcard_discount = parseFloat($('#giftcard_discount').val());
        service_discount = parseFloat($('#service-amount-discount').val());
        member_service_discount = $('#membership_service_discount').val();
        membership_discount_type = parseFloat($('#membership_discount_type').val());

        if (typeof member_service_discount === 'undefined' || member_service_discount === '') {
            member_service_discount = 0;
        }else{
            member_service_discount = parseFloat(member_service_discount);
        }

        total_service_amount = parseFloat($('#total-service-amount').val());

        if(membership_discount_type == '0'){
            discount = (total_service_amount * member_service_discount)/100;
        }else if(membership_discount_type == '1'){
            discount = member_service_discount;
        }else{
            discount = 0;
        }        

        if(member_service_discount == 0){
            discount = 0;
        }

        $('#membership_service_discount_amount').text(parseFloat(discount).toFixed(2));
        $('#membership_service_discount_amount_hidden').val(parseFloat(discount).toFixed(2));

        payable = total_service_amount - discount - giftcard_discount;

        $('#service_payable_hidden').val(parseFloat(payable).toFixed(2));
        $('#service_payable').text(parseFloat(payable).toFixed(2));

        if(total_service_amount == payable){
            $('#total_service_amount_t').text(parseFloat(total_service_amount).toFixed(2));
        }else{
            // $('#total_service_amount_t').html('<s>'+parseFloat(total_service_amount).toFixed(2)+'</s> '+parseFloat(payable).toFixed(2));
            $('#total_service_amount_t').html(parseFloat(total_service_amount).toFixed(2));
        }
        
        setPayableAmount();
    }   
    function calculateTotalDiscount(){
        $('#discount_details_div').html('');
        var membership_service_discount_amount = parseFloat($('#membership_service_discount_amount_hidden').val());
        var membership_product_discount_amount = parseFloat($('#membership_product_discount_amount_hidden').val());
        var coupon_discount_amount = parseFloat($('#coupon_discount_hidden').val());
        var giftcard_discount_amount = parseFloat($('#giftcard_discount').val());
        var reward_discount_amount = parseFloat($('#reward_discount_hidden').val());
        
        total_discount = membership_service_discount_amount + membership_product_discount_amount + coupon_discount_amount + giftcard_discount_amount + reward_discount_amount;
        $('#total_discount_text').text(parseFloat(total_discount).toFixed(2));
        $('#total_discount_hidden').val(parseFloat(total_discount).toFixed(2));

        var discount_details = '<div id="discount_details_info"><i class="fas fa-info-circle" style="color:#0000ffb0;"></i>';
        discount_details += '<div class="discount-tooltip">';
        if (membership_service_discount_amount > 0) {
            discount_details += '<p>Membership Service Discount <span class="amount" style="float: right;">' + membership_service_discount_amount.toFixed(2) + '</span></p>';
        }
        if (membership_product_discount_amount > 0) {
            discount_details += '<p>Membership Product Discount <span class="amount" style="float: right;">' + membership_product_discount_amount.toFixed(2) + '</span></p>';
        }
        if (coupon_discount_amount > 0) {
            discount_details += '<p>Coupon Discount <span class="amount" style="float: right;">' + coupon_discount_amount.toFixed(2) + '</span></p>';
        }
        if (giftcard_discount_amount > 0) {
            discount_details += '<p>Gift Card Discount <span class="amount" style="float: right;">' + giftcard_discount_amount.toFixed(2) + '</span></p>';
        }
        if (reward_discount_amount > 0) {
            discount_details += '<p>Reward Discount <span class="amount" style="float: right;">' + reward_discount_amount.toFixed(2) + '</span></p>';
        }
        discount_details += '<div style="border-top:1px solid #ccc;margin-top:1px;"><p>Total Discount <span class="amount" style="float: right;">' + total_discount.toFixed(2) + '</span></p></div>'; // Add total discount here
        discount_details += '</div></div>';
        if(total_discount > 0){
            $('#discount_details_div').html(discount_details);
        }
    } 

    function setPayableServiceProductAmount(){
        product_discount = parseFloat($('#product-amount-discount').val());
        member_product_discount = $('#membership_product_discount').val();
        membership_discount_type = parseFloat($('#membership_discount_type').val());

        if (typeof member_product_discount === 'undefined' || member_product_discount === '') {
            member_product_discount = 0;
        }else{
            member_product_discount = parseFloat(member_product_discount);
        }

        total_product_amount = parseFloat($('#total-product-amount').val());
        
        if(membership_discount_type == '0'){
            discount = (total_product_amount * member_product_discount)/100;
        }else if(membership_discount_type == '1'){
            discount = member_product_discount;
        }else{
            discount = 0;
        }

        if(total_product_amount == 0){
            discount = 0;
        }

        $('#membership_product_discount_amount').text(parseFloat(discount).toFixed(2));
        $('#membership_product_discount_amount_hidden').val(parseFloat(discount).toFixed(2));

        payable = total_product_amount - discount;

        $('#product_payable_hidden').val(parseFloat(payable).toFixed(2));
        $('#product_payable').text(parseFloat(payable).toFixed(2));        

        if(total_product_amount === payable){
            $('#total_product_amount_t').html(parseFloat(total_product_amount).toFixed(2));
        }else{
            // $('#total_product_amount_t').html('<s>'+parseFloat(total_product_amount).toFixed(2)+'</s> '+parseFloat(payable).toFixed(2));
            $('#total_product_amount_t').html(parseFloat(total_product_amount).toFixed(2));
        }

        setPayableAmount();
    }

    function setPayableAmount(){
        service_payable = parseFloat($('#service_payable_hidden').val());
        product_payable = parseFloat($('#product_payable_hidden').val());
        package_payable = parseFloat($('#total-package-amount').val());
        membership_payable = parseFloat($('#total-membership-amount').val());

        payable = service_payable + product_payable + package_payable + membership_payable;

        $('#payable_hidden').val(parseFloat(payable).toFixed(2));
        $('#payable').text(parseFloat(payable).toFixed(2));
        $('#upper_payable').text(parseFloat(payable).toFixed(2));

        setBookingAmount();
    }

    function setBookingAmount(){
        calculateTotalDiscount();
        
        coupon_discount = parseFloat($('#coupon_discount_hidden').val());
        reward_discount = parseFloat($('#reward_discount_hidden').val());
        payable = parseFloat($('#payable_hidden').val());

        booking = payable - coupon_discount - reward_discount;

        $('#booking_amount_hidden').val(parseFloat(booking).toFixed(2));
        $('#booking_amount_text').text(parseFloat(booking).toFixed(2));

        setGST();
    }

    function setGST(){
        rate = parseFloat($('#salon_gst_rate').val());
        booking_amount = parseFloat($('#booking_amount_hidden').val());

        gst_amount = (rate  * booking_amount) / 100;

        $('#gst_amount_hidden').val(parseFloat(gst_amount).toFixed(2));
        $('#gst_amount').text(parseFloat(gst_amount).toFixed(2));

        setGrandTotal();
    }

    function setGrandTotal(){
        booking_amount = parseFloat($('#booking_amount_hidden').val());
        gst_amount = parseFloat($('#gst_amount_hidden').val());
        
        total = booking_amount + gst_amount;

        $('#grand_total_hidden').val(parseFloat(total).toFixed(2));
        $('#grand_total').text(parseFloat(total).toFixed(2));
    }
    $("#package_name").change(function() {
        var selectedPackageId = ($(this).val()).split('@@@')[1];
        var selectedPackageAllocationId = ($(this).val()).split('@@@')[0];
        create_package_div(selectedPackageAllocationId,selectedPackageId,'manual');
    });    
    function create_package_div(allocation_id,id,type) {
        $('.loader_div').show();   
        setTimeout(function() {
            if($("#customer_name").val() != ""){
                // $("#package_name option[value='" + id + "']").prop('disabled', true);
                $("#package_name option").prop('disabled', true);
                $("#package_name").val('').trigger("chosen:updated");

                $.ajax({
                    type: "POST",
                    url: "<?= base_url(); ?>salon/Ajax_controller/create_package_div_ajx",
                    data: { 'allocation_id': allocation_id, 'package': id, 'type': type, 'customer': $("#customer_name").val() },
                    success: function(data) {
                        $('.loader_div').hide();   
                        $("#package_div").append(data);
                        setPackagePrice(id);
                    },
                });
            }else{
                $('.loader_div').hide(); 
                // alert('First select customer');
                openDialog('Please select customer first'); 
            }
        }, 1500); 
    }
    function removePackage(packageID) { 
        $('.loader_div').show();   
        setTimeout(function() {
            var package_price = parseFloat($('#package_price_hidden_' + packageID).val());
            var current_total = parseFloat($('#total-package-amount').val());

            current_total = current_total - package_price;

            $('#total-package-amount').val(parseFloat(current_total).toFixed(2));
            $('#total_package_amount_t').text(parseFloat(current_total).toFixed(2));
            $('#selected_package_id').val('');
            
            $('#single_package_details_append_' + packageID).remove();

            $('.package_added_service_details').remove();
            $('.package_added_product_details').remove();

            for(var k=0;k<user_selected_package_service.length;k++){
                removeValue(user_selected_service, user_selected_package_service[k]);
            }
            user_selected_package_service = []; 

            for(var k=0;k<user_selected_package_products.length;k++){
                removeValue(user_selected_products, user_selected_package_products[k]);
            }
            user_selected_package_products = []; 

            // $("#package_name option[value='" + packageID + "']").prop('disabled', false);
            $("#package_name option").prop('disabled', false);
            $("#package_name").trigger("chosen:updated");

            setPayableAmount();

            $('.loader_div').hide();  
            
            calculateTotalServiceDuration();
                
            fetchTimeSlots();
        }, 1500);
    }

    function setPackageService(packageID,serviceID){
        var service_duration = $('#package_service_duration_' + packageID + '_' + serviceID).val();
        var service_name = $('#package_service_name_hidden_' + packageID + '_' + serviceID).val();
        var service_rewards = $('#package_service_rewards_hidden_' + packageID + '_' + serviceID).val();

        if ($('#package_service_name_check_' + packageID + '_' + serviceID).is(':checked')) {
            if(!user_selected_service.includes(serviceID)){
                user_selected_service.push(serviceID);

                createServiceDetailsDiv(serviceID,'package',service_name,service_duration,service_rewards,'');
                
                $(".package_product_checkbox_"+packageID+"_"+serviceID).attr('disabled', false);
                var tempArray = [];
                $(".package_product_checkbox_"+packageID+"_"+serviceID).each(function() {
                    $(this).prop('checked', true); 
                    tempArray.push($(this).val());
                });

                for (var i = 0; i < tempArray.length; i++) {
                    setPackageServiceProduct(packageID,serviceID,tempArray[i]);
                }
            }else{
                // alert('Service already selected');
                openDialog('Service already selected'); 
                $('#package_service_name_check_' + packageID + '_' + serviceID).prop('checked', false);
            }
        } else {            
            removeValue(user_selected_service, serviceID);            
            removeValue(user_selected_single_service, serviceID);
            removeValue(user_selected_package_service, serviceID);

            $('#selected_service_details_' + serviceID).remove();

            if(user_selected_service.length == 0){
                $('#selected_services_empty').show();
            }
                        
            var tempArray = [];
            $(".package_product_checkbox_"+packageID+"_"+serviceID).attr('disabled', true);
            $(".package_product_checkbox_"+packageID+"_"+serviceID).each(function() {
                if ($(this).prop('checked')) {
                    $(this).prop('checked', false); 
                    tempArray.push($(this).val());
                }
            });

            for (var i = 0; i < tempArray.length; i++) {
                setPackageServiceProduct(packageID,serviceID,tempArray[i]);
            }
        }
        
        calculateTotalServiceDuration();

        fetchTimeSlots();
    }

    function setPackageServiceProduct(packageID,serviceID,productID){
        var product_name = $('#package_product_name_hidden_'+packageID+'_'+serviceID+'_'+productID).val();
        var selected_product = parseInt($('#selected_package_product_'+packageID+'_'+serviceID).text());

        if ($('#package_product_name_check_'+packageID+'_'+serviceID+'_'+productID).is(':checked')) { 
            selected_product = selected_product + 1;
            
            user_selected_products.push(productID);
            createServiceProductDetailsDiv(productID,'package',product_name,"",'');
        } else {
            selected_product = selected_product - 1;

            removeValue(user_selected_products, productID);            
            removeValue(user_selected_single_products, productID);
            removeValue(user_selected_package_products, productID);

            $('#selected_service_product_details_'+ productID).remove();
            
            if(user_selected_products.length == 0){
                $('#selected_products_empty').show();
            }
        }

        $('#selected_package_product_'+packageID+'_'+serviceID).text(parseInt(selected_product));
    }
    
    function setPackagePrice(packageID){
        var previousCouponId = $('#selected_coupon_id_hidden').val();
        if (previousCouponId !== '') {
            removeCoupon(previousCouponId,'new');
            $('.loader_div').show();   
        }
        var is_giftcard_applied = $('#is_giftcard_applied').val();
        if (is_giftcard_applied == '1') {
            removeGiftCard();
            $('.loader_div').show();   
        }
        var package_price = parseFloat($('#package_price_hidden_' + packageID).val());
        var package_name = $('#package_name_hidden_' + packageID).val();
        var current_total = parseFloat($('#total-package-amount').val());

        current_total = current_total + package_price;

        $('#total-package-amount').val(parseFloat(current_total).toFixed(2));
        $('#selected_package_id').val(packageID);
        $('#total_package_amount_t').text(parseFloat(current_total).toFixed(2));

        setPayableAmount();
    }

    function applyCoupon(couponId){
        var customer_name = $('#customer_name').val();
        if(customer_name != ""){
            // if (confirm("Are you sure you want apply coupon?")) {
            openConfirmationDialog("Are you sure you want apply coupon?", function (confirmed) {
            if (confirmed) {
                $('.loader_div').show();   
                setTimeout(function() {
                    $('#coupon_error_'+couponId).html('');
                    var coupon_expiry = $('#coupon_expiry_' + couponId).val();
                    var coupon_min_price = parseFloat($('#coupon_min_price_' + couponId).val());
                    var coupon_offers = parseFloat($('#coupon_offers_' + couponId).val());
                    var payable = parseFloat($('#payable_hidden').val());
                    var selected_package_id = $('#selected_package_id').val();
                    var is_giftcard_applied = $('#is_giftcard_applied').val();

                    if(selected_package_id == ""){
                        if(is_giftcard_applied == "0" || is_giftcard_applied == ""){
                            var currentDate = new Date();
                            var yyyy = currentDate.getFullYear();
                            var mm = String(currentDate.getMonth() + 1).padStart(2, '0');
                            var dd = String(currentDate.getDate()).padStart(2, '0');
                            var todayDate = yyyy + '-' + mm + '-' + dd;

                            if(todayDate <= coupon_expiry){
                                if(payable >= coupon_min_price){
                                    var previousCouponId = $('#selected_coupon_id_hidden').val();
                                    if (previousCouponId !== '') {
                                        removeCoupon(previousCouponId,'prev');
                                    }
                                    $('.loader_div').show();   

                                    $('#coupon_discount_hidden').val(parseFloat(coupon_offers).toFixed(2));
                                    $('#coupon_discount_text').text(parseFloat(coupon_offers).toFixed(2));
                                    $('#selected_coupon_id_hidden').val(couponId);

                                    coupon_div = $('#coupon_div_'+ couponId);

                                    coupon_div.html('');

                                    // new_coupon_div = '<button class="btn btn-warning" type="button" onclick="if(confirm(\'Are you sure you want to remove the coupon?\')) { removeCoupon(' + couponId + ',\'new\'); }" style="font-size:10px; padding:5px 12px;" data-toggle="tooltip" data-placement="top" title="Remove Coupon">Remove</button>';
                                    new_coupon_div = '<button class="btn btn-warning" type="button" onclick="openConfirmationDialog(\'Are you sure you want to remove the coupon?\', function(confirmed) { if (confirmed) { removeCoupon(' + couponId + ',\'new\'); } })" style="font-size:10px; padding:5px 12px;" data-toggle="tooltip" data-placement="top" title="Remove Coupon">Remove</button>';

                                    coupon_div.html(new_coupon_div);
                                    
                                    $('.loader_div').hide();   
                                }else{
                                    $('.loader_div').hide();  
                                    // alert('Coupon code not applicable. Minimum Payable amount require: Rs.'+coupon_min_price);
                                    openDialog('Coupon code not applicable. Minimum Payable amount require: Rs.'+coupon_min_price); 
                                }
                            }else{
                                $('.loader_div').hide();  
                                // alert('Coupon code is expired');
                                openDialog('Coupon code is expired'); 
                            }
                        }else{
                            $('.loader_div').hide();  
                            // alert('Coupon code not applicable on applied giftcard');
                            openDialog('Coupon code not applicable on applied giftcard'); 
                        }
                    }else{
                        $('.loader_div').hide();  
                        // alert('Coupon code not applicable on packages');
                        openDialog('Coupon code not applicable on packages'); 
                    }
                    setBookingAmount();
                    $('.loader_div').hide();  
                }, 1500);
            }
            });
        }else{            
            // alert('First select customer');
            openDialog('Please select customer first'); 
        }
    }
    function removeCoupon(couponId,type){
        $('.loader_div').show();   
        setTimeout(function() {
            $('#coupon_error_'+couponId).html('');
            $('#coupon_discount_hidden').val(parseFloat(0.00).toFixed(2));
            $('#coupon_discount_text').text(parseFloat(0.00).toFixed(2));
            if(type === 'new'){
                $('#selected_coupon_id_hidden').val('');
            }

            coupon_div = $('#coupon_div_'+ couponId);
            coupon_div.html('');
            new_coupon_div = 
                '<button class="btn btn-success" type="button" style="font-size:10px; padding:5px 12px;" onclick="applyCoupon('+ couponId +')">Apply</button>\
            ';
            coupon_div.html(new_coupon_div);
            
            setBookingAmount();

            $('.loader_div').hide();   
        }, 1500);
    }
    
    function applyRewards(){
        $('.loader_div').show();   
        setTimeout(function() {
            var customer_reward_available = parseInt($('#customer_reward_available').val());
            var customer_gender = $('#customer_gender').val();
            var total_value = 0;

            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>salon/Ajax_controller/get_reward_setup_ajx",
                data: { 'gender': customer_gender },
                success: function(data) {  
                    var opts = $.parseJSON(data);
                    if (!$.isEmptyObject(opts)) {
                        rs_per_reward = opts.rs_per_reward;
                        reward_point = opts.reward_point;
                        minimum_reward_required = parseInt(opts.minimum_reward_required);
                        maximum_reward_required = opts.maximum_reward_required;

                        payableHidden = parseFloat($('#payable_hidden').val());
                        // alert(customer_reward_available)
                        // alert(minimum_reward_required)
                        if(payableHidden > 0){
                            if(customer_reward_available >= minimum_reward_required){
                                if(customer_reward_available > maximum_reward_required){
                                    available_rewards = maximum_reward_required;
                                }else{
                                    available_rewards = customer_reward_available;
                                }

                                consider_rewards = available_rewards / reward_point;
                                total_value = consider_rewards * rs_per_reward;

                                $('#reward_discount_hidden').val(parseFloat(total_value).toFixed(2));
                                $('#used_rewards').val(available_rewards);
                                $('#customer_rewards_text').html('');
                                $('#customer_rewards_text').html('Balance: <s>'+customer_reward_available+'</s> '+(customer_reward_available-available_rewards)+'<br>Discount: Rs.'+parseFloat(total_value).toFixed(2));
                                $('#used_rewards_msg').html('<label style="color:green;font-size:10px;">'+available_rewards+' Rewards used</label>');

                                setBookingAmount();

                                $('#rewards_button').hide();
                                $('#rewards_remove_button').show();
                            }else{
                                // alert('Minimum reward points required are: '+ minimum_reward_required);
                                openDialog('Minimum reward points required are: '+ minimum_reward_required); 
                            }
                        }else{
                                // alert('Please first select services or products');
                                openDialog('Please first select services or products'); 
                            }

                        $('.loader_div').hide();  
                    }
                },
            });
        }, 1500);
    }
    function removeRewards(){
        $('.loader_div').show();   
        setTimeout(function() {
            var customer_reward_available = parseInt($('#customer_reward_available').val());
            $('#reward_discount_hidden').val(parseFloat(0).toFixed(2));
            $('#used_rewards').val(0);
            $('#customer_rewards_text').html('');
            $('#customer_rewards_text').html('Balance: '+customer_reward_available);
            $('#used_rewards_msg').html('');
            
            setBookingAmount();

            $('#rewards_button').show();
            $('#rewards_remove_button').hide();

            $('.loader_div').hide();   
        }, 1500);
    }

    function applyGiftCard(){
        var customer_name = $('#customer_name').val();
        if(customer_name != ""){
            // if (openConfirmationDialog("Are you sure you want to apply this gift card?")) {
            openConfirmationDialog("Are you sure you want to apply this gift card?", function (confirmed) {
            if (confirmed) {
                $('.loader_div').show();   
                setTimeout(function() {
                    $('#giftcard_error').hide();
                    var selected_package_id = $('#selected_package_id').val();
                    var selected_coupon_id = $('#selected_coupon_id_hidden').val();
                    var code = $('#giftcard').val();
                    var customer = $('#customer_name').val();
                    if (selected_package_id == "") {
                        if (selected_coupon_id == "") {
                            if (customer != "") {
                                if (code != "") {
                                    if (user_selected_service.length > 0) {
                                        $.ajax({
                                            type: "POST",
                                            url: "<?= base_url(); ?>salon/Ajax_controller/check_giftcard_ajx",
                                            data: { 'code': code, 'customer': customer, 'services': user_selected_service },
                                            success: function(data) {
                                                $('.loader_div').hide();   
                                                $('#is_giftcard_applied').val('0');
                                                $('#applied_giftcard_id').val();

                                                var opts = $.parseJSON(data);

                                                is_valid = opts.is_valid;
                                                is_customer_used = opts.is_customer_used;
                                                giftcard_services = opts.giftcard_services;
                                                custom_array = opts.custom_array;
                                                giftcard_id = opts.giftcard_id;
                                                                
                                                total_giftcard_discount = 0;

                                                if(is_valid == '1'){
                                                    if (checkArraysMatch(user_selected_service, giftcard_services)) {
                                                        if(is_customer_used == '0'){
                                                            if (!$.isEmptyObject(custom_array)) {
                                                                $('#giftcard_error').hide();
                                                                $('#giftcard_error').html('');

                                                                $('#giftcard_remove_button').show();
                                                                $('#giftcard_button').hide();
                                                                $('#giftcard').prop('disabled',true);

                                                                $.each(custom_array, function(i, d) {
                                                                    var service = parseInt(d.service, 10);
                                                                    if(user_selected_service.includes(service)){
                                                                        service_price = parseFloat($('#service_price_'+ d.service).val());
                                                                        discount = parseFloat(d.discount);
                                                                        if(d.discount_in == '0'){
                                                                            discount = discount * service_price;
                                                                        }

                                                                        total_giftcard_discount = total_giftcard_discount + discount;
                                                                    }
                                                                });
                                                                $('#giftcard_discount').val(parseFloat(total_giftcard_discount).toFixed(2));
                                                                $('#is_giftcard_applied').val('1');
                                                                $('#applied_giftcard_id').val(giftcard_id);
                                                                setPayableServiceAmount();
                                                            }else{
                                                                $('#giftcard_error').html('Invalid Giftcard no');
                                                                $('#giftcard_error').show();
                                                            }
                                                        }else{
                                                            $('#giftcard_error').html('Customer has used it before');
                                                            $('#giftcard_error').show();
                                                        }
                                                    }else{
                                                        $('#giftcard_error').html('Service is not selected for applied Gift Card');
                                                        $('#giftcard_error').show();
                                                    }
                                                }else{
                                                    $('#giftcard_error').html('Invalid Giftcard no');
                                                    $('#giftcard_error').show();
                                                }
                                            },
                                        });
                                    }else{
                                        $('.loader_div').hide();   
                                        // alert('Please select services');
                                        openDialog('Please select services'); 
                                    }
                                }else{
                                    $('.loader_div').hide();   
                                    // alert('Please enter giftcard no');
                                    openDialog('Please enter giftcard no'); 
                                }
                            }else{
                                $('.loader_div').hide();   
                                // alert('Please select customer');
                                openDialog('Please select customer first'); 
                            }
                        }else{
                            $('.loader_div').hide();   
                            // alert('Giftcard not applicable on applied coupon');
                            openDialog('Giftcard not applicable on applied coupon'); 
                        }
                    }else{
                        $('.loader_div').hide();   
                        // alert('Giftcard not applicable on packages');
                        openDialog('Giftcard not applicable on packages'); 
                    }
                }, 1500);
            }
            });
        }else{
            // alert('Select customer first');
            openDialog('Please select customer first'); 
        }
    }
    function removeGiftCard(){
        $('.loader_div').show();   
        setTimeout(function() {
            $('#giftcard_discount').val(parseFloat(0.00).toFixed(2));
            $('#is_giftcard_applied').val('0');
            $('#applied_giftcard_id').val('');
            $('#giftcard').val('');

            $('#giftcard_remove_button').hide();
            $('#giftcard_button').show();
            $('#giftcard').prop('disabled',false);
            setPayableServiceAmount();
            $('.loader_div').hide();  
        }, 1500);
    }
    function checkArraysMatch(array1, array2) {
        return $.grep(array1, function(value1) {
            return $.grep(array2, function(value2) {
                return value1 === value2;
            }).length > 0;
        }).length > 0;
    }

    function showPopup(id){
        var exampleModal = $('#'+id);
        exampleModal.css('display','block');
        exampleModal.css('opacity','1');
        $('.modal-open').css('overflow','auto').css('padding-right','0px'); 
        
    }
    function closePopup(id){
        var exampleModal = $('#'+id);

        exampleModal.css('display','none');
        exampleModal.css('opacity','0');
        $('.modal-open').css('overflow','auto').css('padding-right','0px');
    }
    function removeValue(arr, value) {
        var index = arr.indexOf(value);
        if (index !== -1) {
            arr.splice(index, 1);
        }
        return arr;
    }

    $('.cards-slider').slick({
        infinite: true,
        arrows: true,
        autoplay: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplaySpeed: 4000,
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 900,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }, {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }

        ]
    });
    
    function showLoader() {
    $('.loader_div').show();
        setTimeout(function() {
            hideLoader();
        }, 1500);
    }

    function hideLoader() {
        $('.loader_div').hide();
    }

    // $(document).on('click', function(event) {
    //     showLoader();
    // });
</script>