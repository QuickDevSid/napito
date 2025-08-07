<?php include('header.php'); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/clockpicker/dist/jquery-clockpicker.min.css">
<style>
    .dialog-header {
        background: linear-gradient(271deg, #800080, #ff69b4) !important;
    }

    .dialog-footer {
        background-color: white;
    }

   

    a#service_booking_anchor {
        margin-right: -70px;
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

    .category_services_box {
 
        overflow: hidden;
       
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


    .x_panel {
        border: 1px solid #E6E9ED !important;
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
        font-size: 20px;
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
        background-color: #f6f8fb;
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
        height: 30px;
    }

    .single_service_details_append .service-search-icon {
        top: -4px;
    }

    .cards-slider .slick-prev:before,
    .slick-next:before {
        color: #000 !important;
    }

    .page-title h3 {
        margin: 9px 0;
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



    .customer-profile-box {
        margin: 10px 0;
    }
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
                            Salon is closed from <?php echo date('d M, Y', strtotime($close_setup->from_date)) . ' To ' . date('d M, Y', strtotime($close_setup->to_date)); ?>. <a onclick="showDashboardDataPopup('6')" data-toggle="modal" data-target="#DashboardModal" style="cursor:pointer;color:black;text-decoration:underline;" class="store-profile">Update</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php }
} ?>
<div class="right_col salon_booking_area" role="main" id="overlay">
    <div class="">
        <div class="page-title row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h3>
                    Product Booking
                    <a id="service_booking_anchor" style="float:right;" href="<?= base_url(); ?>add-new-booking-new" class="btn btn-primary">Services Booking</a>
                </h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <form method="post" name="booking_form" id="booking_form" enctype="multipart/form-data">
                <!-- side bar customer info -->
                <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12" style="position: relative;">
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
                                <div class="row custum_info" style="text-align: start;">
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
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <img src="<?= base_url(); ?>admin_assets/images/no_data/no_data.png" width="100%">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- middel bar product info -->
                <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12" id="service_package_details_div" style="display:block;">
                    <div class="x_panel">
                        <div class="x_content">
                            <div class="container">
                                <div class="row">
                                    <ul class="nav nav-tabs service-tab">
                                        <li id="tab_4" class="service_tabbing service_tabbing_left active">
                                            <a href="#4" data-toggle="tab">Products</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" style="margin-top: 20px;">
                                        <!-- product section -->
                                        <div class="tab-pane active" id="4">
                                            <div class="">
                                                <div class="form-group row">
                                                    <select class="form-select form-control chosen-select" name="sup_category" id="sup_category">
                                                        <option class="option_placeholder" value="">Select Category</option>
                                                        <?php if (!empty($category)) {
                                                            foreach ($category as $category_result) { ?>
                                                                <option value="<?= $category_result->id ?>"><?= $category_result->product_category ?>/<?= $category_result->product_category_marathi ?></option>
                                                        <?php }
                                                        } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group row" id="services_div">

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
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <img src="<?= base_url(); ?>admin_assets/images/no_data/no_data.png" width="100%">
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
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <select class="form-control chosen-select" id="employee" name="employee">
                                            <option value="">Select Stylist</option>
                                            <?php if (!empty($stylists)) {
                                                foreach ($stylists as $employee_result) { ?>
                                                    <option value="<?= $employee_result->id; ?>" <?php if (!empty($single_booking) && $single_booking->stylist_id == $employee_result->id) {
                                                                                                    echo 'selected';
                                                                                                } else {
                                                                                                    if (isset($_GET['stylist']) && $_GET['stylist'] == $employee_result->id) {
                                                                                                        echo 'selected';
                                                                                                    }
                                                                                                } ?>><?= $employee_result->full_name; ?></option>
                                            <?php }
                                            } ?>
                                        </select>
                                        <label for="employee" style="display:none;" generated="true" class="error">Please select stylist!</label>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <input readonly type="text" class="form-control" name="booking_date" id="booking_date" placeholder="Select Booking Date" value="<?php if (!empty($single_booking) && $single_booking->booking_date != '') {
                                                                                                                                                                            echo date('d-m-Y', strtotime($single_booking->booking_date));
                                                                                                                                                                        } else {
                                                                                                                                                                            echo date('d-m-Y');
                                                                                                                                                                        } ?>" onchange="validateEmergency()">
                                        <input type="hidden" name="hidden_id" id="hidden_id" value="<?php if (!empty($single_booking)) {
                                                                                                        echo $single_booking->id;
                                                                                                    } ?>">
                                    </div>
                                    <label style="display:none;margin-top:5px;" id="booking_date_error" generated="true" class="error">Please select stylist!</label>
                                </div>
                                <div class="row service_product_payment_title" style="border: 1px solid #cccc;border-radius: 10px;margin-left: 0px;margin-right: 0px;margin-bottom: 10px;margin-top: 10px;">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <span style="font-size: 15px;">Products</span>
                                    </div>
                                    <div id="selected_products_empty">
                                        <div class="row single_added_service_details">
                                            <div class="col-md-12 col-sm-12 col-xs-12 selected-servicesbox" style="border:none;">
                                                <label class="noserviceavl" style="background-color:transparent !important; font-size: 11px !important; color: #4c4c4c !important;">Product not selected</label>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            </div>
                                        </div>
                                    </div>
                                    <div id="selected_products">
                                    </div>
                                </div>
                                <label for="service_name_check[]" style="display:none;" generated="true" class="error">Please select atleast one product!</label>
                                <hr class="break_line">
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
                                <div id="membership_div" style="display:none;"></div>
                                <hr class="break_line">
                                <input type="hidden" id="payable_hidden" name="payable_hidden" value="0.00">
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
                                <?php
                                $is_gst_applicable = '0';
                                $gst_no = '';
                                $gst_rate = '0';
                                if (!empty($store_profile)) {
                                    if ($store_profile->is_gst_applicable == '1') {
                                        $gst_no = $store_profile->gst_no;
                                        $is_gst_applicable = '1';
                                        if (!empty($setup)) {
                                            $gst_rate = $setup->gst_rate;
                                        }
                                    }
                                }
                                ?>
                                <div class="row gst_info_box">
                                    <div class="col-md-7 col-sm-12 col-xs-12">
                                        <span class="span_title_side_bar">GST <?= $gst_rate != "" && $gst_rate != "0" ? '(' . $gst_rate . '%)' : ''; ?></span>
                                    </div>
                                    <input type="hidden" name="is_gst_applicable" id="is_gst_applicable" value="<?= $is_gst_applicable; ?>">
                                    <input type="hidden" name="salon_gst_no" id="salon_gst_no" value="<?= $gst_no; ?>">
                                    <input type="hidden" name="salon_gst_rate" id="salon_gst_rate" value="<?= $gst_rate; ?>">

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
                                <hr class="break_line">
                                <div class="row reminder_box_input">
                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                        <textarea type="text" class="form-control" name="note" id="note" placeholder="Add Note" autocomplete="off"></textarea>
                                    </div>
                                </div>
                                <hr class="break_line">
                                <!-- <div class="row reminder_box">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <span class="span_title_side_bar">Select Payment Method <b class="require">*</b></b>
                                    </div><br><br>
                                    <div class="row reminder_box">
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <input type="radio" checked name="payment_method" id="pay_at_salon" value="1">
                                            <label>Pay At Salon</label>
                                        </div>
                                        <label for="payment_method" generated="true" class="error" style="display:none;">Please select payment method!</label>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <span class="span_title_side_bar">Select Remainder Message type <b class="require">*</b></b>
                                    </div><br><br>
                                    <div class="row reminder_box">
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <input type="radio" name="reminder" id="sms" value="1" <?php if (!empty($booking_rules) && $booking_rules->booking_reminder_type == '1') {
                                                                                                        echo 'checked';
                                                                                                    } ?>>
                                            <label>SMS</label>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <input type="radio" name="reminder" id="email_btn" value="2" <?php if (!empty($booking_rules) && $booking_rules->booking_reminder_type == '2') {
                                                                                                                echo 'checked';
                                                                                                            } ?>>
                                            <label>Email</label>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <input type="radio" name="reminder" id="whatsapp" value="3" <?php if (!empty($booking_rules) && $booking_rules->booking_reminder_type == '3') {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                                            <label>Whatapp</label>
                                        </div>
                                        <label class="error" id="customer_error" style="display:none;">Please select reminder type!</label>
                                        <label class="error" id="select_service_error" style="display:none;">Please select reminder type!</label>
                                        <label class="error" id="stylist_timeslot_error" style="display:none;"></label>
                                        <label for="reminder" generated="true" class="error" style="display:none;">Please select reminder type!</label>
                                    </div>
                                </div> -->
                                <input type="hidden" id="customer_name" name="customer_name" value="">
                                <input type="hidden" id="customer_gender" name="customer_gender" value="">
                                <input type="hidden" name="is_member" id="is_member" value="0">
                                <input type="hidden" name="membership_id" id="membership_id" value="">
                                <input type="hidden" name="membership_discount_type" id="membership_discount_type" value="">
                                <input type="hidden" name="membership_product_discount" id="membership_product_discount" value="">
                                <div class="row confirm_btn_box">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                        <button type="submit" class="btn btn-info" style="width: 100%;" id="booking_button" name="booking_button" value="booking_button">Confirm Booking</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12" id="pricing_details_empty_div" style="display:none;">
            <div class="x_panel">
                <div class="x_content">
                    <div class="container">
                        <div class="row">
                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                <img src="<?= base_url(); ?>admin_assets/images/no_data/no_data.png" width="100%">
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
    <div class="loader-new"></div>
</div>

<!-- Add new customer model -->

<div class="add-new-customer-main" style="display: none;">
    <div class="add-new-customer-content">
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
                        <?php if ($store_category->category == 0) { ?>
                            <option id="male" value="0">Male</option>
                        <?php } ?>
                        <?php if ($store_category->category == 1) { ?>
                            <option id="female" value="1">Female</option>
                        <?php } ?>
                        <?php if ($store_category->category == 2) { ?>
                            <option id="male" value="0">Male</option>
                            <option id="female" value="1">Female</option>
                            <option id="female" value="2">Other</option>
                        <?php } ?>
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
                        } else {
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
if (!empty($booking_rules)) {
    $days_early_booking = $booking_rules->max_booking_range_day;
    if ($days_early_booking != "") {
        $max_date = date('d-m-Y', strtotime('+' . $days_early_booking . ' day'));
    } else {
        $max_date = date('d-m-Y', strtotime('+0 day'));
    }
} else {
    $max_date = date('d-m-Y', strtotime('+0 day'));
}
$today = date('d-m-Y');

if (isset($_GET['customer']) && $_GET['customer'] != "") {
    $customer = $_GET['customer'];
} else {
    $customer = '';
}
if (isset($_GET['booking_id']) && $_GET['booking_id'] != "") {
    $booking_id = $_GET['booking_id'];
} else {
    $booking_id = '';
}
?>
<script src="https://cdn.jsdelivr.net/npm/clockpicker/dist/jquery-clockpicker.min.js"></script>
<script>
    var user_selected_products = [];
    var selected_customer = '<?php echo $customer; ?>';
    var selected_booking = '<?php echo $booking_id; ?>';

    $(document).ready(function() {
        $('#booking_management').addClass('nv active');
        $("#dob").datepicker({
            dateFormat: 'dd-mm-yy',
            maxDate: '<?php echo $today; ?>',
        });
        $("#booking_date").datepicker({
            dateFormat: 'dd-mm-yy',
            maxDate: '<?php echo $max_date; ?>',
            minDate: '<?php echo $today; ?>',
        });
        $("#DOA").datepicker({
            dateFormat: 'dd-mm-yy',
            maxDate: '<?php echo $today; ?>',
        });
        validateEmergency();
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
                    required: 'Please enter customer name!',
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
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });

        if (selected_customer != "") {
            get_customer_info(selected_customer);
        } else {
            var default_category = <?php echo json_encode($category) ?>;
            $('#services_div').empty();
            createProductDivSequentially(default_category, 0, 'default');

            function createProductDivSequentially(categories, index, type) {
                if (index < categories.length) {
                    var id = categories[index].id;
                    $('.loader_div').show();

                    $("#sup_category option[value='" + id + "']").prop('disabled', true);
                    $("#sup_category").val('').trigger("chosen:updated");

                    setTimeout(function() {
                        $.ajax({
                            type: "POST",
                            url: "<?= base_url(); ?>salon/Ajax_controller/create_product_div_ajx",
                            data: {
                                'category': id,
                                'type': type,
                                'selected_booking': selected_booking,
                                'customer_id': $('#customer_name').val()
                            },
                            success: function(data) {
                                $('.loader_div').hide();
                                $("#services_div").append(data);
                                createProductDivSequentially(categories, index + 1, type);
                            },
                        });
                    }, 500);
                }
            }
        }
        $('#booking_form').validate({
            ignore: [],
            rules: {
                reminder: 'required',
                booking_date: 'required',
                employee: 'required',
                'service_name_check[]': 'required',
                payment_method: 'required',
            },
            messages: {
                reminder: 'Please select reminder type!',
                booking_date: 'Please select booking date!',
                employee: 'Please select stylist!',
                'service_name_check[]': 'Please select atleast one product!',
                payment_method: 'Please select payment method!',
            },
            submitHandler: function(form) {
                if (confirm("Are you sure you want to confirm booking?")) {
                    form.submit();
                }
            }
        });
    });

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
        var selectedCategoryId = $(this).val();
        if (customer_name != "") {
            create_product_div(selectedCategoryId, 'manual');
        } else {
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
                    } else {
                        $('#customers').html('Customer Not Found! Please Add New Customer.<b onclick="open_customer_model()" class="add-new-customer">Add Customer</b>');
                    }
                },
            });
        } else {
            $('.customer-info-by-search').hide();
        }
    });

    function validateUniqueMobile() {
        var customer_phone = $('#customer_phone').val();
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>salon/Ajax_controller/get_unique_customer_mobile",
            data: {
                'customer_phone': customer_phone
            },
            success: function(data) {
                if (data == "0") {
                    $("#mobile_error").hide();
                    $("#mobile_error").html('');
                    $("#customer_button").show();
                } else {
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

    function open_customer_note_model() {
        $(".add-new-customer-note-main").toggle();
    }

    function open_customer_model() {
        $(".add-new-customer-main").toggle();
        $(".customer-info-by-search").hide();
        // $("#customer_phone").val($("#phone").val());
    }

    function get_customer_info(id, keyword) {
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
            $('#not_member_div').html('');

            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>salon/Ajax_controller/get_customer_details_for_booking_ajax",
                data: {
                    'id': id,
                    'order_type': '1'
                },
                success: function(data) {
                    user_selected_products = [];

                    $('.loader_div').hide();

                    var parsedData = JSON.parse(data);
                    $('#customer_name').val(parsedData.customer.id);
                    $('#customer_gender').val(parsedData.customer.gender);
                    $('#phone').val('');

                    var currentHref = $('#service_booking_anchor').attr('href');
                    var newHref = currentHref + '?customer=' + parsedData.customer.id;
                    $('#service_booking_anchor').attr('href', newHref);

                    var booking_list = parsedData.order_history;
                    var order_service_history = parsedData.order_service_history;
                    var order_product_history = parsedData.order_product_history;
                    var payments = parsedData.product_payments;
                    var counts = parsedData.counts;
                    var baseUrl = '<?= base_url() ?>';

                    // console.log(payments); 

                    if (order_product_history.length > 0) {
                        for (var x = 0; x < order_product_history.length && x < 5; x++) {
                            if (parsedData.customer.id == order_product_history[x].customer_name && order_product_history[x].booking_date != null && order_product_history[x].booking_date != "") {
                                var booking_date = moment(order_product_history[x].booking_date).format('DD MMM YYYY');

                                $('#customer_activity').append('<div class="acticity_timeline_circle"></div>' +
                                    '<div class="single_activity_box"><div class="cleint-activity activity_service_name">' + order_product_history[x].product_name + '</div>' +
                                    '<div class="cleint-activity">' + booking_date + '</div>'
                                );
                            }
                        }
                    } else {
                        $('#customer_activity').append('<img src="<?= base_url(); ?>admin_assets/images/no_data/no_data.png" width="100%">');
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

                    if (payments.length > 0) {
                        for (var x = 0; x < payments.length && x < 10; x++) {
                            if (payments[x].payment_date != null && payments[x].payment_date != "") {
                                var payment_date = moment(payments[x].payment_date).format('DD MMM YYYY');

                                $('#customer_payments').append('<div class="acticity_timeline_circle"></div>' +
                                    '<div class="single_activity_box"><div class="cleint-activity">' + payment_date + ' - Rs. ' + payments[x].amount_to_paid + '</div><div class="cleint-activity">' + 'Mode: ' + payments[x].payment_mode + '</div>' +
                                    '<a class="btn" style="float:right; margin-top: -32px;" target="_blank" href="<?php echo base_url(); ?>product-booking-print/' + btoa(payments[x].booking_id) + '/' + btoa(payments[x].id) + '" title="Receipt"><i class="fas fa-receipt"></i></a>' +
                                    '</div>'
                                );
                            }
                        }
                    } else {
                        $('#customer_payments').append('<img src="<?= base_url(); ?>admin_assets/images/no_data/no_data.png" width="100%">');
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
                    $('#due_balance').html('Pending Amount: Rs. ' + parsedData.customer.current_pending_amount + '');

                    // if(counts.pending > 0){
                    //     $('#total_pending').html('Total Pending Services: ' + counts.pending + '');
                    // }
                    // if(counts.rescheduled > 0){
                    //     $('#total_rescheduled').html('Total Reschedules: ' + counts.rescheduled + '');
                    // }
                    // if(counts.completed > 0){
                    //     $('#total_completed').html('Total Completed Services: ' + counts.completed + '');
                    // }
                    // if(counts.cancelled > 0){
                    //     $('#total_cancelled').html('Total Cancelled Services: ' + counts.cancelled + '');
                    // }

                    if (parseInt(parsedData.customer.rewards_balance) > 0) {
                        // $('#customer_rewards_div').show();
                        $('#customer_rewards_text').text('Balance: ' + parsedData.customer.rewards_balance);
                        $('#customer_reward_available').val(parsedData.customer.rewards_balance);
                    }

                    $('#is_member').val(parsedData.is_member);

                    if (parsedData.is_member == '1') {
                        $('#membership_id').val(parsedData.membership.membership_id);
                        $('#membership_discount_type').val(parsedData.membership.discount_in); //0=percentage,1=flat
                        $('#membership_service_discount').val(parsedData.membership.service_discount);
                        $('#membership_product_discount').val(parsedData.membership.product_discount);
                        if (parsedData.membership.discount_in == '0') {
                            membership_service_discount_text = parsedData.membership.service_discount + '%';
                            membership_product_discount_text = parsedData.membership.product_discount + '%';
                        } else {
                            membership_service_discount_text = 'Rs.' + parsedData.membership.service_discount;
                            membership_product_discount_text = 'Rs.' + parsedData.membership.product_discount;
                        }

                        membership_div =
                            // '<div class="row total_payable_amount text-right">'+
                            //     '<div class="col-lg-10 text-left">'+
                            //         '<span class="span_title_side_bar">Membership Service Discount ('+ membership_service_discount_text +')</span>'+
                            //     '</div>'+
                            //     '<div class="col-lg-2">'+
                            //         '<div id="membership_service_discount_amount"> 0.00</div>'+
                            '<input type="hidden" name="membership_service_discount_amount_hidden" id="membership_service_discount_amount_hidden" value="0.00">' +
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
                    } else {
                        membership_div =
                            '<input type="hidden" name="membership_service_discount_amount_hidden" id="membership_service_discount_amount_hidden" value="0.00">' +
                            '<input type="hidden" name="membership_product_discount_amount_hidden" id="membership_product_discount_amount_hidden" value="0.00">';
                        $('#membership_div').append(membership_div);
                        $('#membership_div').hide();

                        $('#not_member_div').html(
                            '<div class="membership_details"><a href="<?= base_url(); ?>asign-membership/' + parsedData.customer.id + '" target="_blank">Not a Member</a></div>'
                        )
                    }

                    var default_category = <?php echo json_encode($category) ?>;
                    $('#services_div').empty();
                    createProductDivSequentially(default_category, 0, 'default');

                    function createProductDivSequentially(categories, index, type) {
                        if (index < categories.length) {
                            var id = categories[index].id;
                            $('.loader_div').show();

                            $("#sup_category option[value='" + id + "']").prop('disabled', true);
                            $("#sup_category").val('').trigger("chosen:updated");

                            setTimeout(function() {
                                $.ajax({
                                    type: "POST",
                                    url: "<?= base_url(); ?>salon/Ajax_controller/create_product_div_ajx",
                                    data: {
                                        'category': id,
                                        'type': type,
                                        'selected_booking': selected_booking,
                                        'customer_id': $('#customer_name').val()
                                    },
                                    success: function(data) {
                                        $('.loader_div').hide();
                                        $("#services_div").append(data);
                                        createProductDivSequentially(categories, index + 1, type);
                                    },
                                });
                            }, 500);
                        }
                    }
                },
            });
        }, 1500);
    }

    function validateCustomNote() {
        $('.loader_div').show();
        if ($('#add_custom_note').val() == '') {
            $('#add_custom_note_error').show();
            $('#add_custom_note_error').text('Please enter custom note');
        } else {
            $('#add_custom_note_error').hide();
            $('#add_custom_note_error').text('');

            // setTimeout(function() {
            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>salon/Ajax_controller/update_customer_note_ajx",
                data: {
                    'customer': $('#add_custom_note_for').val(),
                    'customer_note': $('#add_custom_note').val()
                },
                success: function(data) {
                    $('#customer_note_activity').text($('#add_custom_note').val());
                    open_customer_note_model();
                    setCustomerNote($('#add_custom_note_for').val());
                },
            });
            // }, 2000);
        }
        $('.loader_div').hide();
    }

    function setCustomerNote(for_customer_id) {
        $('#customer_notes').empty();
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>salon/Ajax_controller/get_customer_details_for_booking_ajax",
            data: {
                'id': for_customer_id,
                'order_type': '1'
            },
            success: function(data) {
                var parsedData = JSON.parse(data);
                $('#add_custom_note_for').val(for_customer_id);
                if (parsedData.customer.custom_note != "" && parsedData.customer.custom_note != null) {
                    $('#customer_notes').append('<a onclick="open_customer_note_model()" style="padding: 6px 16px;background-color: #0056d1;border-radius: 6px;color: #fff;">Update</a>');
                    $('#customer_notes').append('<div class="single_activity_box" style="margin:0px auto;">' +
                        '<div class="cleint-activity" id="customer_note_activity">' + parsedData.customer.custom_note + '</div></div>'
                    );
                    $('#add_custom_note').val(parsedData.customer.custom_note);
                } else {
                    $('#customer_notes').append('<a onclick="open_customer_note_model()"  style="padding: 6px 16px;background-color: #0056d1;border-radius: 6px;color: #fff;">Add New</a>');
                    $('#customer_notes').append('<img src="<?= base_url(); ?>admin_assets/images/no_data/no_data.png" width="100%">');
                    $('#add_custom_note').val('');
                }
            }
        });
    }

    function create_product_div(id, type) {
        $('.loader_div').show();
        setTimeout(function() {
            $("#sup_category option[value='" + id + "']").prop('disabled', true);
            $("#sup_category").val('').trigger("chosen:updated");

            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>salon/Ajax_controller/create_product_div_ajx",
                data: {
                    'category': id,
                    'customer_id': $('#customer_name').val()
                },
                success: function(data) {
                    $('.loader_div').hide();
                    $("#services_div").append(data);
                },
            });
        }, 1500);
    }

    function search_product(category_id) {
        var value = $('#search_services_' + category_id).val().toLowerCase();
        $('#all_services_div_' + category_id + ' .service_name_t_' + category_id).filter(function() {
            $(this).closest('.row').toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
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

    function formatDate(date) {
        var year = date.getFullYear();
        var month = ('0' + (date.getMonth() + 1)).slice(-2);
        var day = ('0' + date.getDate()).slice(-2);
        var hours = ('0' + date.getHours()).slice(-2);
        var minutes = ('0' + date.getMinutes()).slice(-2);
        var seconds = ('0' + date.getSeconds()).slice(-2);

        return year + '-' + month + '-' + day + ' ' + hours + ':' + minutes + ':' + seconds;
    }

    function setProductDetails(categoryID, productID) {
        var customer_name = $('#customer_name').val();
        if (customer_name != "") {
            var product_name = $('#product_name_' + productID).val();

            if ($('#service_name_check_' + productID).is(':checked')) {
                user_selected_products.push(categoryID + '@@@' + productID);
                createServiceProductDetailsDiv(productID, product_name);
            } else {
                removeValue(user_selected_products, categoryID + '@@@' + productID);
                $('#selected_service_product_details_' + productID).remove();

                if (user_selected_products.length == 0) {
                    $('#selected_products_empty').show();
                }
            }

            setProductPrice();
        } else {
            openDialog('Please select customer first');
            $('#service_name_check_' + productID).prop('checked', false);
        }
    }

    function createServiceProductDetailsDiv(productID, product_name) {
        var product_stock = $('#product_stock_' + productID).val();
        product_details =
            '<div class="row single_added_service_details added_product_details service_products" id="selected_service_product_details_' + productID + '">' +

            '<div class="col-md-6 col-sm-12 col-xs-12">' +
            '<span>' + product_name + '<br><small>(Stock: ' + product_stock + ')</small></span>' +
            '</div>' +
            '<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">' +
            '<div class="input-group" style="margin-top: 0px;">' +
            '<span class="input-group-btn">' +
            '<button style="background-color: #ff000029;border: none;margin-right: 2px !important;padding: 3px;margin: 0px;height: 30px;" type="button" class="btn btn-default btn-number" data-type="minus" onclick="decrementQuantity(' + productID + ')" data-field="product_quantity_' + productID + '">' +
            '<span style="line-height:0px;color: red;" class="glyphicon glyphicon-minus"></span>' +
            '</button>' +
            '</span>' +
            '<input style="padding: 3px;line-height: 4px;height: 35px;text-align: center;" type="number" class="form-control input-number" min="1" max="' + product_stock + '" id="product_quantity_' + productID + '" name="product_quantity_' + productID + '" onkeyup="setProductPrice()" value="1">' +
            '<span class="input-group-btn">' +
            '<button style="background-color: #0080004a;border: none;margin-left: 2px !important; padding: 3px;margin: 0px;height: 30px;" type="button" class="btn btn-default btn-number" data-type="plus" onclick="incrementQuantity(' + productID + ')" data-field="product_quantity_' + productID + '">' +
            '<span style="line-height:0px;color: green;" class="glyphicon glyphicon-plus"></span>' +
            '</button>' +
            '</span>' +
            '</div>' +
            '</div>' +
            '<div class="col-md-2 col-sm-12 col-xs-12" style="padding:0px;">' +
            '<span id="single_product_total_' + productID + '"></span>' +
            '</div>' +
            '<label style="margin-left:10px;" class="error" id="stock_error_' + productID + '"></label>' +
            '<input type="hidden" id="single_product_total_hidden_' + productID + '" name="single_product_total_hidden_' + productID + '" value="">' +

            '</div>';
        $('#selected_products_empty').hide();
        $('#selected_products').append(product_details);
    }

    function incrementQuantity(productID) {
        var input = $('#product_quantity_' + productID);
        var product_stock = parseInt($('#product_stock_' + productID).val(), 10);
        var currentValue = parseInt(input.val(), 10);
        var newValue = currentValue + 1;

        if (newValue > product_stock) {
            $('#stock_error_' + productID).text('Cannot exceed available stock');
            return;
        }
        $('#stock_error_' + productID).text('');

        input.val(newValue);
        setProductPrice();
    }

    function decrementQuantity(productID) {
        $('#stock_error_' + productID).text('');
        var input = $('#product_quantity_' + productID);
        var newValue = parseInt(input.val(), 10) - 1;
        if (newValue >= 1) {
            input.val(newValue);
            setProductPrice();
        }
    }

    function removeCategory(category_id) {
        // if (confirm("Are you sure you want remove complete category?")) {
        openConfirmationDialog("Are you sure you want to remove category?", function(confirmed) {
            if (confirmed) {
                $('.loader_div').show();
                setTimeout(function() {
                    var filteredProducts = user_selected_products.filter(function(product) {
                        var productDetails = product.split('@@@');
                        var selectedCategoryId = productDetails[0];
                        var productid = productDetails[1];

                        if (category_id == selectedCategoryId) {
                            $('#selected_service_product_details_' + productid).remove();
                            return false;
                        }
                        return true;
                    });

                    user_selected_products = filteredProducts;

                    $('#single_product_details_append_' + category_id).remove();
                    $("#sup_category option[value='" + category_id + "']").prop('disabled', false);
                    $("#sup_category").trigger("chosen:updated");

                    setProductPrice();
                    $('.loader_div').hide();
                }, 1500);
            }
        });
    }

    function setProductPrice() {
        var current_total = 0.00;
        for (var y = 0; y < user_selected_products.length; y++) {
            var productid = user_selected_products[y].split('@@@')[1];
            var product_price = parseFloat($('#product_price_' + productid).val());
            var product_quantity = $('#product_quantity_' + productid).val();
            if (product_quantity == '' || isNaN(product_quantity) || typeof product_quantity === 'undefined') {
                product_quantity = 0;
            } else {
                product_quantity = parseInt(product_quantity);
            }

            var single_product_total = product_price * product_quantity;

            $('#single_product_total_' + productid).text(parseFloat(single_product_total).toFixed(2));
            $('#single_product_total_hidden_' + productid).val(parseFloat(single_product_total).toFixed(2));

            current_total = current_total + single_product_total;
        }

        $('#total-product-amount').val(parseFloat(current_total).toFixed(2));
        $('#total_product_amount_t').text(parseFloat(current_total).toFixed(2));

        setPayableServiceProductAmount();
    }

    function calculateTotalDiscount() {
        $('#discount_details_div').html('');
        var membership_service_discount_amount = parseFloat($('#membership_service_discount_amount_hidden').val());
        var membership_product_discount_amount = parseFloat($('#membership_product_discount_amount_hidden').val());

        total_discount = membership_service_discount_amount + membership_product_discount_amount;
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
        discount_details += '<div style="border-top:1px solid #ccc;margin-top:1px;"><p>Total Discount <span class="amount" style="float: right;">' + total_discount.toFixed(2) + '</span></p></div>'; // Add total discount here
        discount_details += '</div></div>';
        if (total_discount > 0) {
            $('#discount_details_div').html(discount_details);
        }
    }

    function setPayableServiceProductAmount() {
        product_discount = parseFloat($('#product-amount-discount').val());
        member_product_discount = $('#membership_product_discount').val();
        membership_discount_type = parseFloat($('#membership_discount_type').val());

        if (typeof member_product_discount === 'undefined' || member_product_discount === '') {
            member_product_discount = 0;
        } else {
            member_product_discount = parseFloat(member_product_discount);
        }

        total_product_amount = parseFloat($('#total-product-amount').val());

        if (membership_discount_type == '0') {
            discount = (total_product_amount * member_product_discount) / 100;
        } else if (membership_discount_type == '1') {
            discount = member_product_discount;
        } else {
            discount = 0;
        }

        if (total_product_amount == 0) {
            discount = 0;
        }

        $('#membership_product_discount_amount').text(parseFloat(discount).toFixed(2));
        $('#membership_product_discount_amount_hidden').val(parseFloat(discount).toFixed(2));

        payable = total_product_amount - discount;

        $('#product_payable_hidden').val(parseFloat(payable).toFixed(2));
        $('#product_payable').text(parseFloat(payable).toFixed(2));

        if (total_product_amount === payable) {
            $('#total_product_amount_t').html(parseFloat(total_product_amount).toFixed(2));
        } else {
            // $('#total_product_amount_t').html('<s>'+parseFloat(total_product_amount).toFixed(2)+'</s> '+parseFloat(payable).toFixed(2));
            $('#total_product_amount_t').html(parseFloat(total_product_amount).toFixed(2));
        }

        setPayableAmount();
    }

    function setPayableAmount() {
        product_payable = parseFloat($('#product_payable_hidden').val());

        payable = product_payable;

        $('#payable_hidden').val(parseFloat(payable).toFixed(2));
        $('#payable').text(parseFloat(payable).toFixed(2));
        $('#upper_payable').text(parseFloat(payable).toFixed(2));

        setBookingAmount();
    }

    function setBookingAmount() {
        calculateTotalDiscount();

        payable = parseFloat($('#payable_hidden').val());

        booking = payable;
        if (booking < 0) {
            booking = 0;
        }

        $('#booking_amount_hidden').val(parseFloat(booking).toFixed(2));
        $('#booking_amount_text').text(parseFloat(booking).toFixed(2));

        setGST();
    }

    function setGST() {
        rate = parseFloat($('#salon_gst_rate').val());
        booking_amount = parseFloat($('#booking_amount_hidden').val());

        gst_amount = (rate * booking_amount) / 100;

        $('#gst_amount_hidden').val(parseFloat(gst_amount).toFixed(2));
        $('#gst_amount').text(parseFloat(gst_amount).toFixed(2));

        setGrandTotal();
    }

    function setGrandTotal() {
        booking_amount = parseFloat($('#booking_amount_hidden').val());
        gst_amount = parseFloat($('#gst_amount_hidden').val());

        total = booking_amount + gst_amount;

        $('#grand_total_hidden').val(parseFloat(total).toFixed(2));
        $('#grand_total').text(parseFloat(total).toFixed(2));
    }

    function checkArraysMatch(array1, array2) {
        return $.grep(array1, function(value1) {
            return $.grep(array2, function(value2) {
                return value1 === value2;
            }).length > 0;
        }).length > 0;
    }

    function showPopup(id) {
        var exampleModal = $('#' + id);
        exampleModal.css('display', 'block');
        exampleModal.css('opacity', '1');
        $('.modal-open').css('overflow', 'auto').css('padding-right', '0px');

    }

    function closePopup(id) {
        var exampleModal = $('#' + id);

        exampleModal.css('display', 'none');
        exampleModal.css('opacity', '0');
        $('.modal-open').css('overflow', 'auto').css('padding-right', '0px');
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

    function validateEmergency() {
        var booking_date = $('#booking_date').val();
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>salon/Ajax_controller/check_is_salon_close_for_period_setup_datewise_ajx",
            data: {
                'booking_date': booking_date
            },
            success: function(data) {
                if (data == '1') {
                    $('#booking_date_error').text('Store is closed because of emergency');
                    $('#booking_date_error').show();
                    $('#booking_button').hide();
                } else {
                    $('#booking_date_error').text('');
                    $('#booking_date_error').hide();
                    $('#booking_button').show();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }
</script>