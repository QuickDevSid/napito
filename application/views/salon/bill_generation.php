<?php include('header.php'); ?>
<style type="text/css">
    .x_panel {
        border: unset !important;
        border: 1px solid #E6E9ED !important;
    }
    .payment-row{
        width: 100%;
    }
    .mem-tooltip {
        width: 280px;
        position: absolute;
        left: 0;
        background-color: #feefdc;
        display: none;
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
    .navtabs {
        display: flex;
        justify-content: left;
        margin-bottom: 20px;
        margin-top: -10px;
        background: white;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 2px 0px;
        position: relative;
    }
    .error {
        color: red;
        float: left;
    }
    .page-title .title_left h3 {
        margin: 8px 0px;
        margin-left: 13px;
        font-size: 18px;
        font-weight: 800;
        color: var(--primary);
    }
    .customer-info-by-phone {
        width: 377px;
        height: auto;
        background-color: rgb(251 250 250);
        position: absolute;
        top: 70px;
        left: 11px;
        border-radius: 3px;
        z-index: 999;
        border: 1px solid gray;
    }
    .customer-info-by-phone div {
        padding: 4px;
    }
    .customer-info-by-phone div:hover {
        background-color: #0f85d9;
        color: white;
    }
    input#gst_amount,
    input#transaction_id,
    input#dob {
        margin-top: 2px;
    }
    input#dob {
        margin-top: 0px;
    }
    .chosen-container-multi .chosen-choices li.search-choice {
        background: #f3f3f3;
        border: 1px solid #ccc;
        padding: 10px;
        padding-right: 25px;
    }
    .chosen-container-multi .chosen-choices {
        border-radius: 4px;
        font-size: 13px;
        font-weight: 600;
        color: #a1a2b2;
        padding-left: 10px;
    }
    #services_id_chosen .chosen-container-multi .chosen-choices li.search-choice .search-choice-close {
        top: 10px;
    }
    .chosen-container-multi .chosen-choices {
        padding: 10px;
    }
    .selected-servicesbox {
        padding: 7px 10px;
    }
    .left-span {
        margin-bottom: 10px;
    }
    #services_details>.row {
        margin: 0;
    }
    .search-icon {
        position: absolute;
        top: 8px;
        right: 18px;
        font-size: 18px;
    }
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

    input[class="dashboardToggle"] {
        position: relative;
        appearance: none;
        width: 50px;
        height: 25px;
        background: #ff000085;
        border-radius: 50px;
        box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.2);
        cursor: pointer;
        transition: 0.4s;
    }



    input[class="dashboardToggle"]::after {
        position: absolute;
        content: "";
        width: 25px;
        height: 25px;
        top: 0;
        left: 0;
        background: #fff;
        border-radius: 50%;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        transform: scale(1.1);
        transition: 0.4s;
    }

    input:checked[class="dashboardToggle"] {
        background: #1aab00b3;
    }
</style>
<div class="right_col salon_booking_area" role="main">
    <?php
    if ($gst == "") { ?>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title" style="text-align: center;">
                        <img src="<?= base_url(); ?>\admin_assets\images\no_data\c_store.jpg">
                    </div>
                    <div style="text-align: center;font-size: 15px;">
                        Click to complete store profile <a style="color:blue;" class="store-profile" href="<?= base_url(); ?>store-profile">Store Profile</a>
                    </div>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <div class="page-title">
                    <div class="title_left">
                        <h3>
                            Generate Bill <?php if ($emergency_bill_count > 0) { ?><small style="color:red;display:none;" id="note_label"><b>(Note: Only <?= $emergency_bill_count; ?> Service Bills are allowed daily. Today Service Bill Count: <?= $current_total_emergency_bills; ?>)</b></small><?php } ?>
                        </h3>
                    </div>
                </div>

            </div>
            <div class="x_panel new_panel">
                <div class="x_content">
                    <div class="container">
                        <form method="post" name="add_customer_form" id="add_customer_form" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 book-left-section">
                                    <div class="x_panel new_panel">
                                        <div class="x_content">
                                            <div class="row">
                                                <div class="form-group col-md-11 col-sm-11 col-xs-11 mt-3" style="position: relative;">
                                                    <input autocomplete="off" maxlength="10" type="text" class="form-control" name="phone" id="phone" placeholder="Search Customer"><a class="search-icon" href="#"><i class="fa fa-search"></i></a>
                                                    <div id="phone_not_found" style="display:none; color: red;"></div>
                                                </div>
                                                <div class="form-group col-md-1 col-sm-1 col-xs-1 mt-3">
                                                    <button style="margin-left:-10px;margin-top:2px;" class="btn btn-primary" onclick="open_customer_model('outer')" title="Add New Customer"><i class="fa fa-plus"></i></button>
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
                                                <div class="form-group col-md-12 col-sm-12 col-xs-12 no_data_img">
                                                    <img src="<?= base_url(); ?>admin_assets/images/no_data/no_data.png">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-9 col-md-6 col-sm-12 col-xs-12 book-right-section" style="display:none;">
                                    <div class="x_panel new_panel">
                                        <div class="x_content">
                                            <div class="row flex_wrap align-items-baseline">
                                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12" style="display:none;">
                                                    <label>Search by Phone Number/Name <b class="require">*</b></label>
                                                    <input value="<?php if (!empty($single)) {
                                                                        echo $single->customer_phone;
                                                                    } ?>" maxlength="10" autocomplete="off" type="text" class="form-control" name="selected_customer_phone" id="selected_customer_phone" placeholder="Search customer by phone/name ">
                                                    
                                                    <div class="customer-info-by-phone" style="display: none;" id="customer_div">
                                                        <div></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                                    <label>Bill For<b class="require">*</b></label>
                                                    <select class="form-select form-control chosen-select" onchange="set_bill_form()" name="bill_for" id="bill_for">
                                                        <?php
                                                        $booking_check_array = ['add-new-booking-new', 'counter-bill'];
                                                        if (!empty(array_intersect($booking_check_array, $feature_slugs))) {
                                                            if ($is_emergency_bill_allowed) {
                                                        ?>
                                                                <option value="5" <?php if(isset($_GET['bill_for']) && $_GET['bill_for'] == '5'){ echo 'selected'; } ?>>Services & Products</option>
                                                            <?php
                                                            }
                                                        }
                                                        $booking_check_array = ['product-booking', 'counter-bill'];
                                                        if (!empty(array_intersect($booking_check_array, $feature_slugs))) {
                                                            // if ($is_emergency_bill_allowed) {
                                                            ?>
                                                                <option value="6" <?php if(isset($_GET['bill_for']) && $_GET['bill_for'] == '6'){ echo 'selected'; } ?>>Products</option>
                                                            <?php
                                                            // }
                                                        }
                                                        $booking_check_array = ['add-new-booking-new', 'bill-setup'];
                                                        if (!empty(array_intersect($booking_check_array, $feature_slugs))) {
                                                            ?>
                                                            <option value="2" <?php if(isset($_GET['bill_for']) && $_GET['bill_for'] == '2'){ echo 'selected'; } ?>>Bookings</option>
                                                        <?php
                                                        }
                                                        $product_check_array = ['product-booking'];
                                                        if (!empty(array_intersect($product_check_array, $feature_slugs))) {
                                                        ?>
                                                            <!-- <option value="3" <?php if(isset($_GET['bill_for']) && $_GET['bill_for'] == '3'){ echo 'selected'; } ?>>Product Purchase</option> -->
                                                        <?php
                                                        }
                                                        $membership_check_array = ['asign-membership', 'asign-membership-list'];
                                                        if (!empty(array_intersect($membership_check_array, $feature_slugs))) {
                                                        ?>
                                                            <option value="0" <?php if(isset($_GET['bill_for']) && $_GET['bill_for'] == '0'){ echo 'selected'; } ?>>Memberships</option>
                                                        <?php
                                                        }
                                                        $package_check_array = ['asign-package', 'asign-package-list'];
                                                        if (!empty(array_intersect($package_check_array, $feature_slugs))) {
                                                        ?>
                                                            <option value="1" <?php if(isset($_GET['bill_for']) && $_GET['bill_for'] == '1'){ echo 'selected'; } ?>>Packages</option>
                                                        <?php
                                                        }
                                                        $giftcard_check_array = ['asign-giftcard', 'asign-giftcard-list'];
                                                        if (!empty(array_intersect($giftcard_check_array, $feature_slugs))) {
                                                        ?>
                                                            <option value="4" <?php if(isset($_GET['bill_for']) && $_GET['bill_for'] == '4'){ echo 'selected'; } ?>>Gift Cards</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12" style="display:none;">
                                                    <label>Customer Name <b class="require">*</b></label>
                                                    <input <?php if (!empty($single)) {
                                                                echo 'readonly';
                                                            } ?> value="<?php if (!empty($single)) {
                                                                            echo $single->full_name;
                                                                        } ?>" readonly autocomplete="off" type="text" class="form-control" name="selected_full_name" id="selected_full_name" placeholder="Enter full name">
                                                </div>
                                                <div class="form-group booking_field col-lg-4 col-md-4 col-sm-6 col-xs-12" style="display:none;">
                                                    <label>Select Booking ID <b class="require">*</b></label>
                                                    <select class="form-select form-control chosen-select" name="booking_id" id="booking_id">
                                                        <option value="" class="">Select Booking ID</option>
                                                    </select>
                                                </div>
                                                <div class="form-group giftcard_field col-lg-4 col-md-4 col-sm-6 col-xs-12" style="display:none;">
                                                    <label>Select Giftcard <b class="require">*</b></label>
                                                    <select class="form-select form-control chosen-select" name="giftcard_id" id="giftcard_id">
                                                        <option value="" class="">Select Membership</option>
                                                        <?php if (!empty($membership_list)) {
                                                            foreach ($membership_list as $membership_list_result) { ?>
                                                                <option value="<?= $membership_list_result->id ?>"><?= $membership_list_result->membership_name ?></option>
                                                        <?php }
                                                        } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group membership_field col-lg-4 col-md-4 col-sm-6 col-xs-12" style="display:none;">
                                                    <label>Select Membership <b class="require">*</b></label>
                                                    <select class="form-select form-control chosen-select" name="membership_id" id="membership_id">
                                                        <option value="" class="">Select Membership</option>
                                                        <?php if (!empty($membership_list)) {
                                                            foreach ($membership_list as $membership_list_result) { ?>
                                                                <option value="<?= $membership_list_result->id ?>"><?= $membership_list_result->membership_name ?></option>
                                                        <?php }
                                                        } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group package_field col-lg-4 col-md-4 col-sm-6 col-xs-12" style="display:none;">
                                                    <label>Select Package <b class="require">*</b></label>
                                                    <select class="form-select form-control chosen-select" name="package_id" id="package_id">
                                                        <option value="" class="">Select Package</option>
                                                        <?php if (!empty($package_list)) {
                                                            foreach ($package_list as $membership_list_result) { ?>
                                                                <option value="<?= $membership_list_result->id ?>"><?= $membership_list_result->package_name ?></option>
                                                        <?php }
                                                        } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group transaction_fields col-lg-4 col-md-4 col-sm-6 col-xs-12" style="display:none;">
                                                    <label id="stylist_label">Select Stylist</label>
                                                    <select class="form-control chosen-select" id="employee" name="employee">
                                                        <option value="">Select Stylist</option>
                                                        <?php if (!empty($stylists)) {
                                                            foreach ($stylists as $employee_result) { ?>
                                                                <option value="<?= $employee_result->id; ?>"><?= $employee_result->full_name; ?></option>
                                                        <?php }
                                                        } ?>
                                                    </select>
                                                    <label for="employee" style="display:none;" generated="true" class="error">Please select stylist!</label>
                                                </div>
                                                <div class="form-group transaction_fields col-lg-4 col-md-4 col-sm-6 col-xs-12" style="display:none;">
                                                    <label id="date_label">Payment Date<b class="require">*</b></label>
                                                    <input readonly autocomplete="off" class="form-control" type="text" name="service_date" id="service_date" value="<?= date('d-m-Y'); ?>" placeholder="Select Date">
                                                </div>
                                                <div class="form-group services_field col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:none;">
                                                    <label>Select Services <b class="require">*</b></label>
                                                    <select class="form-select form-control chosen-select" name="services_id[]" id="services_id" multiple></select>
                                                </div>
                                                <div class="form-group services_field col-lg-12 col-md-12 col-sm-12 col-xs-12" id="services_details" style="display:none;"></div>
                                                <div class="form-group products_field col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:none;">
                                                    <label id="products_label">Select Products</label>
                                                    <select class="form-select form-control chosen-select" name="selected_product_id[]" id="selected_product_id" multiple></select>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row flex_wrap">
                                                <div class="form-group services_field col-lg-3 col-md-4 col-sm-6 col-xs-12" style="display:none;">
                                                    <label>Service Price<b class="require">*</b></label>
                                                    <input readonly onkeyup="setGST()" value="0.00" autocomplete="off" type="text" class="form-control" name="service_price" id="service_price" placeholder="Enter service price">
                                                </div>
                                                <div class="form-group services_field col-lg-3 col-md-4 col-sm-6 col-xs-12" style="display:none;">
                                                    <label>Product Price<b class="require">*</b></label>
                                                    <input readonly onkeyup="setGST()" value="0" autocomplete="off" type="text" class="form-control" name="product_price" id="product_price" placeholder="Enter product price">
                                                </div>
                                                <div class="form-group transaction_fields fixed_transaction_fields col-lg-3 col-md-4 col-sm-6 col-xs-12" style="display:none;">
                                                    <label>Price<b class="require">*</b></label>
                                                    <input readonly onkeyup="setGST()" value="<?php if (!empty($single)) {
                                                                                                    echo $single->membership_price;
                                                                                                } ?>" autocomplete="off" type="text" class="form-control" name="price" id="price" placeholder="Enter price">
                                                </div>
                                                <div class="form-group transaction_fields fixed_transaction_fields col-lg-3 col-md-4 col-sm-6 col-xs-12" style="display:none;">
                                                    <label>Extra Discount<b class="require">*</b><small>(In %)</small></label>
                                                    <input value="0" autocomplete="off" type="text" class="form-control" name="discount_in_per" id="discount_in_per" placeholder="Enter discount in %" onkeyup="setFlatDiscount()">
                                                </div>
                                                <div class="form-group transaction_fields fixed_transaction_fields col-lg-3 col-md-4 col-sm-6 col-xs-12" style="display:none;">
                                                    <label>Extra Discount<b class="require">*</b><small>(In INR)</small></label>
                                                    <input value="0.00" autocomplete="off" type="text" class="form-control" name="discount_in_rs" id="discount_in_rs" placeholder="Enter discount in INR" onkeyup="setPerDiscount()">
                                                </div>
                                                <div class="form-group transaction_fields fixed_transaction_fields col-lg-3 col-md-4 col-sm-6 col-xs-12" style="display:none;">
                                                    <label>Payable Amount<b class="require">*</b></label>
                                                    <input readonly value="" autocomplete="off" type="text" class="form-control" name="booking_amount" id="booking_amount" placeholder="Enter payable amount">
                                                </div>
                                                <?php if (!empty($single_profile)) { ?>
                                                    <div class="form-group transaction_fields fixed_transaction_fields col-lg-3 col-md-4 col-sm-6 col-xs-12" style="display:none;">
                                                        <label>GST Amount <small><?php if (!empty($setup) && $single_profile->is_gst_applicable == '1') {
                                                                                        echo '(' . $setup->gst_rate . '%)';
                                                                                    } ?></small></label>
                                                        <input readonly value="" autocomplete="off" type="number" class="form-control" name="gst_amount" id="gst_amount" placeholder="Enter GST Amount">
                                                        <input value="<?php if (!empty($setup) && $single_profile->is_gst_applicable == '1') {
                                                                            echo $setup->gst_rate;
                                                                        } ?>" type="hidden" name="gst_rate" id="gst_rate">
                                                    </div>
                                                <?php } ?>
                                                <div class="form-group transaction_fields fixed_transaction_fields col-lg-3 col-md-4 col-sm-6 col-xs-12" style="display:none;">
                                                    <label>Grand Total<b class="require">*</b></label>
                                                    <input readonly value="<?php if (!empty($single)) {
                                                                                echo $single->membership_price;
                                                                            } ?>" autocomplete="off" type="text" class="form-control" name="total_amount" id="total_amount" placeholder="Enter total amount">
                                                </div>
                                                <div class="form-group transaction_fields fixed_transaction_fields col-lg-3 col-md-4 col-sm-6 col-xs-12" style="display:none;">
                                                    <label>Adjust Amount</label>
                                                    <input type="number" class="form-control" name="adjust_amount" id="adjust_amount" placeholder="Enter Adjust Amount" value="0.00" onkeyup="calculateActualPaidAmount()">
                                                    <label for="adjust_amount" generated="true" class="error" style="display:none;float:left; width:100%;">Please enter payment amount!</label>
                                                </div>
                                                <div class="form-group transaction_fields fixed_transaction_fields col-lg-3 col-md-4 col-sm-6 col-xs-12" style="display:none;">
                                                    <label>Amount Round Type</label>
                                                    <select class="form-control form-select" name="amount_round_type" id="amount_round_type" onchange="calculateActualPaidAmount()">
                                                        <option value="Up">Up</option>
                                                        <option value="Down">Down</option>
                                                    </select>
                                                    <label for="amount_round_type" generated="true" class="error" style="display:none;float:left; width:100%;">Please enter payment amount!</label>
                                                </div>
                                                <div class="form-group transaction_fields fixed_transaction_fields col-lg-3 col-md-4 col-sm-6 col-xs-12" style="display:none;">
                                                    <label>Round Bill Amount</label>
                                                    <input type="number" class="form-control" name="rounded_bill_amount" id="rounded_bill_amount" placeholder="Enter Round Bill Amount" value="0.00" readonly>
                                                    <label for="rounded_bill_amount" generated="true" class="error" style="display:none;float:left; width:100%;">Please enter payment amount!</label>
                                                </div>
                                                <div class="form-group transaction_fields fixed_transaction_fields col-lg-3 col-md-4 col-sm-6 col-xs-12" style="display:none;">
                                                    <label>Previous Pending Amount<b class="require">*</b></label>
                                                    <input readonly value="" autocomplete="off" type="text" class="form-control" name="previous_due_amount" id="previous_due_amount" placeholder="Enter previous due amount">
                                                </div>
                                                <div class="form-group transaction_fields fixed_transaction_fields col-lg-3 col-md-4 col-sm-6 col-xs-12" style="display:none;">
                                                    <label>Total Due Amount<b class="require">*</b></label>
                                                    <input readonly value="" autocomplete="off" type="text" class="form-control" name="total_due_amount" id="total_due_amount" placeholder="Enter Total due amount">
                                                </div>
                                                <div class="form-group transaction_fields fixed_transaction_fields col-lg-3 col-md-4 col-sm-6 col-xs-12" style="display:none;">
                                                    <label>Actual Paid Amount<b class="require">*</b></label>
                                                    <input value="" autocomplete="off" min="0" type="text" class="form-control" name="actual_paid_amount" id="actual_paid_amount" placeholder="Enter actual paid amount" onkeyup="calculateDue()">
                                                </div>
                                                <div class="form-group transaction_fields fixed_transaction_fields col-lg-3 col-md-4 col-sm-6 col-xs-12" style="display:none;">
                                                    <label>Current Pending Amount<b class="require">*</b></label>
                                                    <input readonly value="" autocomplete="off" type="text" class="form-control" name="new_due_amount" id="new_due_amount" placeholder="Enter new due amount">
                                                </div>
                                                <div class="form-group transaction_fields col-lg-9 col-md-9 col-sm-6 col-xs-12" style="display:none;">
                                                    <label>Adjust Amount Remark</label>
                                                    <input type="text" class="form-control" name="adjust_amount_remark" id="adjust_amount_remark" placeholder="Enter Adjust Amount Remark" value="">
                                                    <label for="adjust_amount_remark" generated="true" class="error" style="display:none;float:left; width:100%;">Please enter payment amount!</label>
                                                </div>
                                                <input type="hidden" name="is_gst_applicable" id="is_gst_applicable" value="<?php if (!empty($single_profile) && $single_profile->is_gst_applicable == '1') {
                                                                                                                                echo '1';
                                                                                                                            } else {
                                                                                                                                echo '0';
                                                                                                                            } ?>">
                                                <input type="hidden" name="salon_gst_no" id="salon_gst_no" value="<?php if (!empty($single_profile) && $single_profile->is_gst_applicable == '1') {
                                                                                                                        echo $single_profile->gst_no;
                                                                                                                    } else {
                                                                                                                        echo '';
                                                                                                                    } ?>">
                                            </div>
                                            <div class="row transaction_fields">
                                                <div class="flex_wrap">
                                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                        <label>Payment Mode<b class="require">*</b></label>
                                                        <select class="form-control form-select payment_mode" name="payment_mode[]" id="payment_mode_0" data-id="0">
                                                            <option value="">Select Payment Mode</option>
                                                            <?php if (!empty($payment_modes)) {
                                                                for ($i = 0; $i < count($payment_modes); $i++) { ?>
                                                                    <option value="<?= $payment_modes[$i]; ?>"><?= $payment_modes[$i]; ?></option>
                                                                <?php }
                                                            } else { ?>
                                                                <option value="UPI">UPI</option>
                                                                <option value="Cash">Cash</option>
                                                                <option value="Card">Card</option>
                                                                <option value="Online">Online</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                        <label>Amount<b class="require">*</b></label>
                                                        <input type="text" min="0" class="form-control mode_amount" name="mode_amount[]" id="mode_amount_0" value="" placeholder="Enter Payment Mode Amount">
                                                    </div>
                                                    <div class="form-group col-lg-3 col-md-2 col-sm-6 col-xs-12">
                                                        <label>Transaction ID</label>
                                                        <input readonly type="text" placeholder="Enter Transaction ID" class="form-control" name="transaction_id[]" id="transaction_id_0" value="">
                                                    </div>
                                                    <div class="form-group col-lg-1 col-md-1 col-sm-6 col-xs-12">
                                                        <button type="button" title="Add More" style="margin-top:25px;" class="btn btn-primary add-payment-mode" onclick="createPaymentModeDiv()"><i class="fa fa-plus"></i></button>
                                                    </div>
                                                </div>
                                                <div class="flex_wrap" id="more_payment_modes"></div>
                                                <label class="error" style="display:none;" id="stock_selection_error">Please enter payment amount!</label>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12" style="width:auto;float:right;">
                                                    <!-- <button class="btn btn-primary" type="submit" id="customer_button" name="customer_button" value="customer_button">Save Bill</button> -->
                                                    <button style="font-size:12px;" type="submit" class="btn btn-info submit_bill_button" id="save_payment_btn" name="payment_btn" value="save">Save Bill</button>
                                                    <button style="padding:8px 12px" type="submit" class="btn btn-primary submit_bill_button" id="payment_btn" name="payment_btn" value="generate">Generate Bill & Share with Customer</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="customer_name" name="customer_name" value="">
                            <input type="hidden" id="customer_gender" name="customer_gender" value="">
                            <input type="hidden" name="is_member" id="is_member" value="0">
                            <input type="hidden" name="customer_membership_id" id="customer_membership_id" value="">
                            <input type="hidden" name="membership_payment_status" id="membership_payment_status" value="">
                            <input type="hidden" name="membership_discount_type" id="membership_discount_type" value="">
                            <input type="hidden" name="membership_service_discount" id="membership_service_discount" value="">
                            <input type="hidden" name="membership_product_discount" id="membership_product_discount" value="">
                            <input type="hidden" name="separate_product_price" id="separate_product_price" value="0">                                
                            
                            <div class="modal fade" id="ServiceConfirmationModal" tabindex="-1" aria-labelledby="exampleModal" aria-hidden="true" >
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModal">Confirm Counter Sale</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;" onclick="closePopup('ServiceConfirmationModal')">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <label for="is_counter">Is Counter Sale?</label>
                                            <select id="is_counter" name="is_counter" class="form-control form-select">
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" id="confirmNextBtn" class="btn btn-primary">Confirm</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<!-- Add new customer model -->
<div class="add-new-customer-main" style="display: none;">
    <div class="add-new-customer-content">
        <form method="post" name="add_customer_modal_form" id="add_customer_modal_form" enctype="multipart/form-data">
            <div class="row">
                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12" id="is_guest_toggle" style="display:none;">
                    <label for="fullname">Register as Guest?</label><br>
                    <input style="height: 25px !important;" type="checkbox" name="is_guest" id="is_guest" class="dashboardToggle" onchange="getGuestCount(this)">
                </div>
                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>First Name <b class="require">*</b></label>
                    <input autocomplete="off" type="text" class="form-control" name="f_name" id="f_name" placeholder="Enter first name">
                </div>
                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Last Name <b class="require">*</b></label>
                    <input autocomplete="off" type="text" class="form-control" name="l_name" id="l_name" placeholder="Enter last name">
                </div>
                <input type="hidden" name="added_from" id="added_from" value="bill-generation">
                <!-- <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Full Name <b class="require">*</b></label>
                    <input autocomplete="off" type="text" class="form-control" name="full_name" id="full_name" placeholder="Enter full name">
                </div> -->
                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Phone Number <b class="require">*</b></label>
                    <input type="text" maxlength="10" class="form-control" name="customer_phone" id="customer_phone" placeholder="Enter phone number" onkeyup="validateUniqueMobile()">
                </div>
                <input type="hidden" name="guest_to_parmanant" id="guest_to_parmanant" value="0">
                <input type="hidden" name="id" id="id" value="">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                    <label>Select Gender<b class="require">*</b></label>
                    <select class="form-select form-control" name="gender" id="gender">
                        <?php if ($store_category->category == '0') { ?>
                            <option id="male" value="0">Male</option>
                        <?php } ?>
                        <?php if ($store_category->category == '1') { ?>
                            <option id="female" value="1">Female</option>
                        <?php } ?>
                        <?php if ($store_category->category == '2') { ?>
                            <option id="male" value="0">Male</option>
                            <option id="female" value="1">Female</option>
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
                    <button class="btn btn-primary" type="submit" name="customer_modal_button" id="customer_modal_button" value="customer_modal_button">Save</button>
                    <div style="float: left;" onclick="open_customer_model()" class="close_time_slot_Model btn btn-danger">Close</div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Add new customer note -->
<div class="add-new-customer-note-main" style="display: none;">
    <div class="add-new-customer-content">
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
<div class="loader_div">
    <div class="loader-new"></div>
</div>
<?php include('footer.php');
    $id = 0;
    if ($this->uri->segment(2) != "") {
        $id = $this->uri->segment(2);
    }
$today = date('d-m-Y');
?>
<script>
    var selected_id = '<?php if (isset($_GET['customer'])) {
                            echo $_GET['customer'];
                        } ?>';
    let selectedServices = [];
    var selectedProducts = {};
    var selectedStylists = {};

    function setTransactionID() {
        payment_mode = $('#membership_mode').val();
        if (payment_mode == 'Cash') {
            $('#transaction_id').attr('readonly', true);
        } else {
            $('#transaction_id').attr('readonly', false);
        }
    }

    function getGuestCount(checkbox){
        $('#full_name').val('').attr('readonly',false);
        $('#f_name').val('').attr('readonly',false);
        $('#l_name').val('').attr('readonly',false);
        $('#customer_phone').attr('readonly',false);
        if ($(checkbox).is(':checked')) {
            $.ajax({
                url: '<?=base_url(); ?>salon/Ajax_controller/fetch_guest_count_ajax',
                type: 'POST',
                data: {
                    guest: true
                },
                success: function(response) {
                    let nameParts = response.trim().split(" ");
                    $('#full_name').val(response).attr('readonly',true);
                    $('#f_name').val(nameParts[0] || '').attr('readonly', true);
                    $('#l_name').val(nameParts[1] || '').attr('readonly', true);
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", error);
                }
            });
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
    jQuery.validator.addMethod("validate_email", function(value, element) {
        if (/^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/.test(value)) {
            return true;
        } else {
            return false;
        }
    }, "Please enter a valid Email!");
    $(document).ready(function() {
        $("#service_date").datepicker({
            dateFormat: 'dd-mm-yy',
            maxDate: 0,
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
            ignore: ":hidden:not(select)",
            rules: {
                bill_for: 'required',
                service_date: 'required',
                full_name: 'required',
                employee: {
                    required: function() {
                        // return $('#bill_for').val() == '5';
                        return false;
                    }
                },
                selected_customer_phone: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 10,
                },
                service_price: {
                    required: function() {
                        return $('#bill_for').val() == '5';
                    },
                    number: true,
                },
                product_price: {
                    required: function() {
                        return $('#bill_for').val() == '5';
                    },
                    number: true,
                },
                price: {
                    required: function() {
                        return $('#bill_for').val() == '0' || $('#bill_for').val() == '1' || $('#bill_for').val() == '5';
                    },
                    number: true,
                },
                giftcard_id: {
                    required: function() {
                        return $('#bill_for').val() == '4';
                    }
                },
                membership_id: {
                    required: function() {
                        return $('#bill_for').val() == '0';
                    }
                },
                membership_mode: {
                    required: function() {
                        return $('#bill_for').val() == '0' || $('#bill_for').val() == '1' || $('#bill_for').val() == '5';
                    }
                },
                package_id: {
                    required: function() {
                        return $('#bill_for').val() == '1';
                    }
                },
                booking_id: {
                    required: function() {
                        return $('#bill_for').val() == '2' || $('#bill_for').val() == '3';
                    }
                },
                'services_id[]': {
                    required: function() {
                        return $('#bill_for').val() == '5';
                    }
                },
                'selected_product_id[]': {
                    required: function() {
                        return $('#bill_for').val() == '6';
                    }
                }
            },
            messages: {
                bill_for: 'Please select bill for!',
                service_date: 'Please select service date!',
                full_name: 'Please enter full name!',
                employee: 'Please select stylist!',
                membership_id: 'Please select membership name!',
                selected_customer_phone: {
                    required: "Please enter phone number!",
                    number: "Only number allowed!",
                    minlength: "Minimum 10 digit required!",
                    maxlength: "Maximum 10 digit allowed!",
                },
                service_price: {
                    required: "Please enter product price!",
                    number: "Only number allowed!",
                },
                product_price: {
                    required: "Please enter product price!",
                    number: "Only number allowed!",
                },
                price: {
                    required: "Please enter price!",
                    number: "Only number allowed!",
                },
                membership_mode: 'Please select payment mode!',
                package_id: 'Please select package!',
                booking_id: 'Please select booking ID!',
                giftcard_id: 'Please select giftcard!',
                'services_id[]': 'Please select atleast one service!',
                'selected_product_id[]': 'Please select atleast one product!',
            },
            submitHandler: function(form) {
                let current_remaining = calculateRemainingAmount();
                if (current_remaining <= 0) {
                    $('#stock_selection_error').html('').hide();

                    if($('#employee').val() == ""){
                        if($('#bill_for').val() == "5"){
                            if ($('#selected_product_id').val()?.length) {
                                showPopup('ServiceConfirmationModal');
                                $('#confirmNextBtn').off('click').on('click', function () {
                                    form.submit();
                                });
                            }else{
                                form.submit();
                            }
                        }else{
                            showPopup('ServiceConfirmationModal');
                            $('#confirmNextBtn').off('click').on('click', function () {
                                form.submit();
                            });
                        }
                    }else{
                        form.submit();
                    }
                } else {
                    $('.loader_div').hide();
                    $('#stock_selection_error')
                        .html('Please ensure that the total paid amount matches the required amount before proceeding.')
                        .show();
                }
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
        $('#add_customer_modal_form').validate({
            rules: {
                customer_phone: {
                    required: function(element) {
                        return !$('#is_guest').is(':checked');
                    },
                    number: true,
                    minlength: 10,
                },
                f_name: 'required',
                l_name: 'required',
                // full_name: {
                //     required: true,
                // },
                gender: {
                    required: true,
                },
                email: {
                    email: true,
                },
            },
            messages: {
                f_name: 'Please enter first name!',
                l_name: 'Please enter last name!',
                // full_name: {
                //     required: 'Please enter full name!',
                // },
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
        $('#add_customer_note').validate({
            rules: {
                add_custom_note: {
                    required: true,
                },
            },
            messages: {
                add_custom_note: {
                    required: 'Please enter custom note!',
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


        $('#membership_mode').on('change', function() {
            $('#membership_mode').valid();
        });

        $('#membership_id').on('change', function() {
            $('#membership_id').valid();
        });


        if (selected_id != "") {
            get_customer_info(selected_id, '');
        }

    });
    $("#show_more").click(function() {
        $('.add-more-info').toggle();
        $(this).text(function(i, text) {
            return text === "Show More" ? "Show Less" : "Show More";
        });
    });
    $(document).ready(function() {
        $('#generate_bill .child_menu').show();
        $('#generate_bill').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.generate_bill').addClass('active_cc');
    });

    function get_services() {
        var gender = $('#customer_gender').val();
        if (gender != "") {
            $('.loader_div').show();
            setTimeout(function() {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url(); ?>salon/Ajax_controller/get_salon_services_ajx",
                    data: {
                        'gender': gender,
                    },
                    success: function(data) {
                        $("#services_id").empty();
                        var opts = $.parseJSON(data);
                        $.each(opts, function(i, d) {
                            if (d.gender == '0') {
                                var gender = ' - Male';
                            } else {
                                var gender = ' - Female';
                            }
                            $('#services_id').append('<option value="' + d.id + '">' + d.sub_cat_name + ' -> ' + d.service_name + ' | ' + d.service_name_marathi + '' + gender + ' (Rs. ' + d.final_price + ')</option>');
                        });
                        $('#services_id').trigger('chosen:updated');
                        $('.services_field').show();
                        $('.products_field').show();
                        $('.gender_field').hide();
                        $('.giftcard_field').hide();
                        $('.membership_field').hide();
                        $('.transaction_fields').show();
                        $('.booking_field').hide();
                        $('.package_field').hide();

                        $('.loader_div').hide();
                    }
                });
            }, 1000);
        }
    }

    function get_products() {
        var gender = $('#customer_gender').val();
        if (gender != "") {
            $('.loader_div').show();
            setTimeout(function() {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url(); ?>salon/Ajax_controller/get_salon_products_ajx",
                    data: {
                        'gender': gender,
                    },
                    success: function(data) {
                        $("#selected_product_id").empty();
                        var opts = $.parseJSON(data);
                        $.each(opts, function(i, d) {
                            $('#selected_product_id').append('<option value="' + d.id + '">' + d.product_sub_category_name + ' -> ' + d.product_name + ' (Rs. ' + d.selling_price + ')</option>');
                        });
                        $('#selected_product_id').trigger('chosen:updated');
                        $('.products_field').show();
                        if($('#bill_for').val() == '5'){
                            $('.services_field').show();
                        }else{
                            $('.services_field').hide();
                        }
                        $('.gender_field').hide();
                        $('.giftcard_field').hide();
                        $('.membership_field').hide();
                        $('.transaction_fields').show();
                        $('.booking_field').hide();
                        $('.package_field').hide();

                        $('.loader_div').hide();
                    }
                });
            }, 1000);
        }
    }

    function get_giftcards() {
        var gender = $('#customer_gender').val();
        if (gender != "") {
            $('.loader_div').show();
            setTimeout(function() {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url(); ?>salon/Ajax_controller/get_salon_giftcards_ajx",
                    data: {
                        'gender': gender,
                    },
                    success: function(data) {
                        $("#giftcard_id").empty();
                        $('#giftcard_id').append('<option value="">Select Giftcard</option>');
                        var opts = $.parseJSON(data);
                        $.each(opts, function(i, d) {
                            $('#giftcard_id').append('<option value="' + d.id + '">' + d.gift_name + '</option>');
                        });
                        $('#giftcard_id').trigger('chosen:updated');
                        $('.products_field').hide();
                        $('.giftcard_field').show();
                        $('.gender_field').show();
                        $('.services_field').hide();
                        $('.membership_field').hide();
                        $('.transaction_fields').show();
                        $('.booking_field').hide();
                        $('.package_field').hide();

                        $('.loader_div').hide();
                    }
                });
            }, 1000);
        }
    }
    $("#giftcard_id").change(function() {
        $('.loader_div').show();
        setTimeout(function() {
            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>salon/Ajax_controller/get_giftcard_info_ajax",
                data: {
                    'giftcard_id': $('#giftcard_id').val(),
                },
                success: function(data) {
                    var parsedData = JSON.parse(data);
                    $('#price').val(parsedData.regular_price);
                    setDiscount();
                },
            });
        }, 1000);
    });
    $("#selected_product_id").change(function() {
        $('.loader_div').show();
        setTimeout(function() {
            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>salon/Ajax_controller/get_products_info_ajax",
                data: {
                    'selected_product_id': $('#selected_product_id').val(),
                },
                success: function(data) {
                    var bill_for = $('#bill_for').val();
                    if(bill_for == '6'){
                        $('#price').val(data);
                        setDiscount();
                    }else{
                        $('#separate_product_price').val(data);
                        setProductPrice();
                    }
                },
            });
        }, 1000);
    });
    $("#membership_id").change(function() {
        $('.loader_div').show();
        setTimeout(function() {
            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>salon/Ajax_controller/get_membership_info_ajax",
                data: {
                    'membership_id': $('#membership_id').val(),
                },
                success: function(data) {
                    var parsedData = JSON.parse(data);
                    $('#price').val(parsedData.membership_price);
                    setDiscount();
                },
            });
        }, 1000);
    });

    function setGST() {
        var rate = $('#gst_rate').val();
        if (rate == "") {
            rate = 0.00;
        } else {
            rate = parseFloat(rate);
        }
        var booking_amount = $('#booking_amount').val();
        if (booking_amount == "") {
            booking_amount = 0.00;
        } else {
            booking_amount = parseFloat(booking_amount);
        }
        gst_amount = booking_amount * (rate / 100);
        $('#gst_amount').val(parseFloat(gst_amount).toFixed(2));
        setTotal();
    }

    function setDiscount(){
        var discount_in_rs = $('#discount_in_rs').val();
        var price = $('#price').val();
        $('#booking_amount').val(parseFloat(price - discount_in_rs).toFixed(2));
        setGST();
    }

    function setTotal() {
        var booking_amount = $('#booking_amount').val();
        var previous_due_amount = $('#previous_due_amount').val();
        var gst_amount = $('#gst_amount').val();
        if (previous_due_amount && previous_due_amount == "") {
            previous_due_amount = 0.00;
        } else {
            previous_due_amount = parseFloat(previous_due_amount);
        }
        if (gst_amount && gst_amount == "") {
            gst_amount = 0.00;
        } else {
            gst_amount = parseFloat(gst_amount);
        }
        if (booking_amount == "") {
            booking_amount = 0.00;
        } else {
            booking_amount = parseFloat(booking_amount);
        }
        var total = booking_amount + gst_amount;
        total_due_amt = total + previous_due_amount;
        $('#total_amount').val(parseFloat(total).toFixed(2));
        $('#actual_paid_amount').val(parseFloat(total_due_amt).toFixed(2));        
        $('#total_due_amount').val(parseFloat(total_due_amt).toFixed(2));
        $('.loader_div').hide();

        calculateActualPaidAmount();
    }

    function calculateDue(){
        // var total_amount = $('#total_amount').val();
        var total_amount = $('#rounded_bill_amount').val();
        var actual_paid_amount = $('#actual_paid_amount').val();
        var previous_due_amount = $('#previous_due_amount').val();

        if (total_amount && total_amount == "") {
            total_amount = 0.00;
        } else {
            total_amount = parseFloat(total_amount);
        }

        if (previous_due_amount && previous_due_amount == "") {
            previous_due_amount = 0.00;
        } else {
            previous_due_amount = parseFloat(previous_due_amount);
        }

        if (actual_paid_amount == "") {
            actual_paid_amount = 0.00;
        } else {
            actual_paid_amount = parseFloat(actual_paid_amount);
        }
        var new_due_amount = (total_amount + previous_due_amount) - actual_paid_amount;
        $('#new_due_amount').val(parseFloat(new_due_amount).toFixed(2));
        
        $('#mode_amount_0').val(parseFloat(actual_paid_amount).toFixed(2));
        $(`#more_payment_modes`).empty('');
    }

    function setFlatDiscount(){
        var price = $('#price').val();
        var discount_in_per = $('#discount_in_per').val();
        var discount_in_rs = 0;

        discount_in_rs = (price * discount_in_per) / 100;
        $('#discount_in_rs').val(parseFloat(discount_in_rs).toFixed(2));
        setDiscount();
    }
    function setPerDiscount(){
        var price = $('#price').val();
        var discount_in_rs = $('#discount_in_rs').val();
        var discount_in_per = 0;

        discount_in_per = (100 * discount_in_rs) / price;
        $('#discount_in_per').val(parseFloat(discount_in_per).toFixed(2));
        setDiscount();
    }
    function get_memberships() {
        var gender = $('#customer_gender').val();
        if (gender != "") {
            $('.loader_div').show();
            setTimeout(function() {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url(); ?>salon/Ajax_controller/get_salon_memberships_ajx",
                    data: {
                        'gender': gender,
                    },
                    success: function(data) {
                        $("#membership_id").empty();
                        $('#membership_id').append('<option value="">Select Membership</option>');
                        var opts = $.parseJSON(data);
                        $.each(opts, function(i, d) {
                            $('#membership_id').append('<option value="' + d.id + '">' + d.membership_name + '</option>');
                        });
                        $('#membership_id').trigger('chosen:updated');
                        $('.products_field').hide();
                        $('.membership_field').show();
                        $('.gender_field').show();
                        $('.services_field').hide();
                        $('.transaction_fields').show();
                        $('.booking_field').hide();
                        $('.package_field').hide();
                        $('.giftcard_field').hide();

                        $('.loader_div').hide();
                    }
                });
            }, 1000);
        }
    }

    function get_packages() {
        var gender = $('#customer_gender').val();
        if (gender != "") {
            $('.loader_div').show();
            setTimeout(function() {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url(); ?>salon/Ajax_controller/get_salon_packages_ajx",
                    data: {
                        'gender': gender,
                    },
                    success: function(data) {
                        $("#package_id").empty();
                        $('#package_id').append('<option value="">Select Package</option>');
                        var opts = $.parseJSON(data);
                        $.each(opts, function(i, d) {
                            $('#package_id').append('<option value="' + d.id + '">' + d.package_name + '</option>');
                        });
                        $('#package_id').trigger('chosen:updated');
                        $('.products_field').hide();
                        $('.membership_field').hide();
                        $('.gender_field').show();
                        $('.services_field').hide();
                        $('.transaction_fields').show();
                        $('.booking_field').hide();
                        $('.package_field').show();
                        $('.giftcard_field').hide();

                        $('.loader_div').hide();
                    }
                });
            }, 1000);
        }
    }
    $("#package_id").change(function() {
        $('.loader_div').show();
        setTimeout(function() {
            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>salon/Ajax_controller/get_package_info_ajax",
                data: {
                    'package_id': $('#package_id').val(),
                },
                success: function(data) {
                    var parsedData = JSON.parse(data);
                    $('#price').val(parsedData.amount);
                    setDiscount();
                },
            });
        }, 1000);
    });
    function setProductsSelections(serviceId){
        var selectedValues = $('#service_products_id_' + serviceId).val() || [];
        selectedProducts[serviceId] = selectedValues;
        setProductPrice();
    }
    function setStylistsSelections(serviceId){
        var selectedValues = $('#service_stylists_id_' + serviceId).val() || '';
        selectedStylists[serviceId] = selectedValues;
    }
    $("#services_id").change(function() {
        $('.loader_div').show();
        setTimeout(function() {
            var selectedServices = $('#services_id').val() || [];
            Object.keys(selectedStylists).forEach(function(serviceId) {
                if (!selectedServices.includes(serviceId)) {
                    delete selectedStylists[serviceId];
                }
            });
            Object.keys(selectedProducts).forEach(function(serviceId) {
                if (!selectedServices.includes(serviceId)) {
                    delete selectedProducts[serviceId];
                }
            });
            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>salon/Ajax_controller/get_services_info_ajax",
                data: {
                    'services_id': $('#services_id').val(),
                    'selected_products': selectedProducts,
                    'selected_stylists': selectedStylists
                },
                success: function(parsedData) {
                    $('#price').val(parsedData.service_price + parsedData.product_price);
                    $('#service_price').val(parsedData.service_price);
                    $('#product_price').val(parsedData.product_price);
                    $('#services_details').html(parsedData.services_details);

                    $(".chosen-select").chosen();

                    setProductPrice();
                },
            });
        }, 1500);
    });

    function setProductPrice() {
        var product_price = 0;
        var separate_product_price = parseFloat($('#separate_product_price').val());
        var bill_for = $('#bill_for').val();
        if(bill_for == '5'){
            Object.keys(selectedProducts).forEach(function(service_id) {
                selectedProducts[service_id].forEach(function(product_id) {
                    var priceElement = $('#service_product_price_' + service_id + '_' + product_id);

                    if (priceElement.length) {
                        product_price += parseFloat(priceElement.val()) || 0;
                    }
                });
            });
        }

        total_product_sale = product_price + separate_product_price;

        $('#product_price').val(total_product_sale);

        var service_price = parseFloat($('#service_price').val());
        var total = service_price + total_product_sale;
        $('#price').val(parseFloat(total));
        setDiscount();
    }

    function set_bill_form() {
        $('#stylist_label').html('Select Stylist');
        $('#products_label').html('Select Products');
        var date_label = 'Select Payment Date';
        $('#note_label').show();
        $('#services_details').empty();
        $('#customer_phone').attr('readonly', false);
        $('#price').val('');
        $('#total_amount').val('');
        $('#mode_amount_0').val('');
        $('#service_price').val('0.00');
        $('#product_price').val('0.00');


        $('.products_field').hide();
        $('.services_field').hide();
        $('.gender_field').hide();
        $('.giftcard_field').hide();
        $('.membership_field').hide();
        $('.transaction_fields').hide();
        $('.booking_field').hide();
        $('.package_field').hide();
        var bill_for = $('#bill_for').val();
        if (bill_for == '0') {
            get_memberships();
            $('.fixed_transaction_fields').removeClass('col-lg-3 col-md-4');
            $('.fixed_transaction_fields').addClass('col-lg-3 col-md-4');
        } else if (bill_for == '1') {
            get_packages();
            $('.fixed_transaction_fields').removeClass('col-lg-3 col-md-4');
            $('.fixed_transaction_fields').addClass('col-lg-3 col-md-4');
        } else if (bill_for == '2') {
            get_bookings();
        } else if (bill_for == '3') {
            get_product_bookings();
        } else if (bill_for == '4') {
            get_giftcards();
            $('.fixed_transaction_fields').removeClass('col-lg-3 col-md-4');
            $('.fixed_transaction_fields').addClass('col-lg-3 col-md-4');
        } else if (bill_for == '5') {
            get_services();
            get_products();
            $('.fixed_transaction_fields').removeClass('col-lg-3 col-md-4');
            $('.fixed_transaction_fields').addClass('col-lg-3 col-md-4');
            $('#stylist_label').html('Select Stylist <small>(For Products Sell)</small>');
            date_label = 'Select Service & Payment Date';
        } else if (bill_for == '6') {
            get_products();
            $('.fixed_transaction_fields').removeClass('col-lg-3 col-md-4');
            $('.fixed_transaction_fields').addClass('col-lg-3 col-md-4');
            $('#products_label').html('Select Products<b class="require">*</b>');
        }

        date_label += ' <b class="require">*</b>';

        $('#date_label').html(date_label);
        
        setDiscount();
    }

    function get_bookings() {
        var id = $('#customer_name').val();
        if (id != "") {
            $('.loader_div').show();
            setTimeout(function() {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url(); ?>salon/Ajax_controller/get_customer_completed_bookings_ajx",
                    data: {
                        'customer': id,
                    },
                    success: function(data) {
                        $("#booking_id").empty();
                        $('#booking_id').append('<option value="">Select Booking ID</option>');
                        var opts = $.parseJSON(data);
                        $.each(opts, function(i, d) {
                            let bookingDate = new Date(d.booking_date);
                            let formattedDate = ('0' + bookingDate.getDate()).slice(-2) + '-' +
                                ('0' + (bookingDate.getMonth() + 1)).slice(-2) + '-' +
                                bookingDate.getFullYear();

                            let date = new Date('1970-01-01T' + d.service_start_time + 'Z');
                            let formattedTime = date.toLocaleTimeString('en-IN', {
                                hour: '2-digit',
                                minute: '2-digit',
                                hour12: true
                            });
                            $('#booking_id').append('<option value="' + d.id + '">' + d.receipt_no + ' (' + formattedDate + ' - ' + formattedTime + ')</option>');
                        });
                        $('#booking_id').trigger('chosen:updated');
                        $('.booking_field').show();
                        $('.products_field').hide();
                        $('.gender_field').hide();
                        $('.transaction_fields').hide();
                        $('.services_field').hide();
                        $('.membership_field').hide();
                        $('.package_field').hide();
                        $('.giftcard_field').hide();

                        $('.loader_div').hide();
                    }
                });
            }, 1000);
        }
    }

    function get_product_bookings() {
        var id = $('#customer_name').val();
        if (id != "") {
            $('.loader_div').show();
            setTimeout(function() {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url(); ?>salon/Ajax_controller/get_customer_completed_product_bookings_ajx",
                    data: {
                        'customer': id,
                    },
                    success: function(data) {
                        $("#booking_id").empty();
                        $('#booking_id').append('<option value="">Select Booking ID</option>');
                        var opts = $.parseJSON(data);
                        $.each(opts, function(i, d) {
                            let bookingDate = new Date(d.booking_date);
                            let formattedDate = ('0' + bookingDate.getDate()).slice(-2) + '-' +
                                ('0' + (bookingDate.getMonth() + 1)).slice(-2) + '-' +
                                bookingDate.getFullYear();
                            $('#booking_id').append('<option value="' + d.id + '">' + d.receipt_no + ' (' + formattedDate + ')</option>');
                        });
                        $('#booking_id').trigger('chosen:updated');
                        $('.booking_field').show();
                        $('.products_field').hide();
                        $('.gender_field').hide();
                        $('.transaction_fields').hide();
                        $('.membership_field').hide();
                        $('.services_field').hide();
                        $('.package_field').hide();
                        $('.giftcard_field').hide();

                        $('.loader_div').hide();
                    }
                });
            }, 1000);
        }
    }




    var paymentOptions = `<?php
                            if (!empty($payment_modes)) {
                                for ($i = 0; $i < count($payment_modes); $i++) {
                                    echo '<option value="' . $payment_modes[$i] . '">' . $payment_modes[$i] . '</option>';
                                }
                            } else {
                                echo '<option value="UPI">UPI</option>';
                                echo '<option value="Cash">Cash</option>';
                                echo '<option value="Card">Card</option>';
                                echo '<option value="Online">Online</option>';
                            }
                            ?>`;

    function calculateRemainingAmount() {
        let totalAmount = parseFloat($('#actual_paid_amount').val()) || 0;
        let totalEntered = 0;

        $(`#more_payment_modes .mode_amount, #mode_amount_0`).each(function() {
            let amount = parseFloat($(this).val()) || 0;
            totalEntered += amount;
        });

        let remaining = totalAmount - totalEntered;
        return remaining > 0 ? remaining : 0;
    }

    function createPaymentModeDiv() {
        let uniqueId = new Date().getTime();
        let current_remaining = calculateRemainingAmount();
        $('#stock_selection_error').html('');
        $('#stock_selection_error').hide();
        if (current_remaining > 0.00) {
            let newRow = `
                <div class="payment-row" id="payment_row_${uniqueId}">
                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label>Payment Mode<b class="require">*</b></label>
                        <select class="form-control form-select chosen-select payment_mode" name="payment_mode[]" id="payment_mode_${uniqueId}" data-id="${uniqueId}">
                            ${paymentOptions}
                        </select>
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label>Amount<b class="require">*</b></label>
                        <input type="text" min="0" class="form-control mode_amount" name="mode_amount[]" id="mode_amount_${uniqueId}" placeholder="Enter Payment Mode Amount" value="${current_remaining}" max="${current_remaining}">
                    </div>
                    <div class="form-group col-lg-3 col-md-2 col-sm-6 col-xs-12">
                        <label>Transaction ID</label>
                        <input readonly type="text" placeholder="Enter Transaction ID" class="form-control" name="transaction_id[]" id="transaction_id_${uniqueId}">
                    </div>
                    <div class="form-group col-lg-1 col-md-1 col-sm-6 col-xs-12">
                        <button type="button" style="margin-top:25px;" class="btn btn-primary remove-payment" title="Remove" data-id="${uniqueId}"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
            `;
            $(`#more_payment_modes`).append(newRow);
            $(`#payment_row_${uniqueId} .chosen-select`).chosen();
            $(`#payment_row_${uniqueId} .payment_mode`).trigger('change');
        } else {
            $('#stock_selection_error').html('You cannot add more payments as the total actual paid price is reached.');
            $('#stock_selection_error').show();
        }
    }
    $(document).ready(function() {
        $('.chosen-select').chosen();
        $(document).on('click', '.remove-payment', function() {
            let rowId = $(this).data('id');
            $(`#payment_row_${rowId}`).remove();
        });

        $(document).on('change', '.payment_mode', function() {
            let uniqueId = $(this).data('id');
            let selectedValue = $(this).val();
            let transactionField = $(`#transaction_id_${uniqueId}`);

            if (selectedValue == "Cash") {
                transactionField.prop('readonly', true).val("").attr("placeholder", "N/A for Cash");
            } else {
                transactionField.prop('readonly', false).attr("placeholder", "Enter Transaction ID");
            }
        });
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
                            var is_guest = '';
                            if(d.is_guest == '1'){
                                var is_guest = ' - (Guest)';
                            }

                            var phone = '';
                            if(d.customer_phone != ""){
                                var phone = '[' + d.customer_phone + '] ';
                            }

                            $('#customers').append('<div class="customers_search_results" onclick="get_customer_info(' + d.id + ',\'' + keyword + '\')">' + d.full_name + '' + phone + '' + is_guest + '</div>');
                        });
                    } else {
                        // $('#customers').html('Customer Not Found! Please Add New Customer.<b onclick="open_customer_model()" class="add-new-customer">Add Customer</b>');
                        $('#customers').html('Customer Not Found ! <b onclick="open_customer_model(\'outer\')" style="cursor:pointer;" class="add-new-customer">Add Customer</b>');
                    }
                },
            });
        } else {
            $('.customer-info-by-search').hide();
        }
    });

    function validateUniqueMobile(){
        var customer_phone = $('#customer_phone').val();
        if(customer_phone != ""){
            $.ajax({
                type: "POST",
                url: "<?=base_url();?>salon/Ajax_controller/get_unique_customer_mobile",
                data:{'customer_phone':customer_phone},
                success: function(data){
                    if(data == "0"){
                        $("#mobile_error").hide();
                        $("#mobile_error").html('');
                        $("#customer_modal_button").show();
                    }else{
                        $("#mobile_error").show();
                        $("#mobile_error").html('This mobile number is already added');
                        $("#customer_modal_button").hide();
                    }
                    
                },
                error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
                }
            }); 
        }
    }

    function open_customer_model(source = '') {
        var phone = $('#phone').val();

        if(source != 'guest_to_parmanant'){
            // if (/^\d{10}$/.test(phone)) {
            if (/^\d+$/.test(phone)) {
                $('#customer_phone').val(phone).focus();
            } else {
                $('#customer_phone').val('');
            }
            $('#id').val('');
            $('#f_name').val('');
            $('#l_name').val('');
        } else {
            $('#customer_phone').val('');
        }

        $('#is_guest_toggle').show();
        if(source == 'guest_to_parmanant'){
            var guest_to_parmanant = '1';
            $('#is_guest_toggle').hide();
        }else{
            var guest_to_parmanant = '0';
        }

        $('#guest_to_parmanant').val(guest_to_parmanant);

        $(".add-new-customer-main").toggle();
        $(".customer-info-by-search").hide();
    }

    function open_customer_note_model() {
        $(".add-new-customer-note-main").toggle();
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
            $('#discount_details_div').html('');
            $('#not_member_div').html('');

            $("#services_div").html('');
            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>salon/Ajax_controller/get_customer_details_for_booking_ajax",
                data: {
                    'id': id,
                    'order_type': '0'
                },
                success: function(data) {
                    user_selected_service = [];
                    user_selected_products = [];

                    user_selected_package_service = [];
                    user_selected_package_products = [];
                    user_selected_single_service = [];
                    user_selected_single_products = [];

                    $('.loader_div').hide();
                    $('.book-right-section').show();

                    var parsedData = JSON.parse(data);

                    $('#customer_name').val(parsedData.customer.id);
                    $('#full_name').val(parsedData.customer.full_name);
                    $('#f_name').val(parsedData.customer.f_name);
                    $('#l_name').val(parsedData.customer.l_name);
                    $('#customer_phone').val(parsedData.customer.customer_phone);
                    $('#previous_due_amount').val(parsedData.customer.current_pending_amount);
                    $('#id').val(parsedData.customer.id);
                    $('#selected_full_name').val(parsedData.customer.full_name);
                    $('#customer_gender').val(parsedData.customer.gender);
                    $('#selected_customer_phone').val(parsedData.customer.customer_phone);
                    $('#phone').val('');

                    var booking_list = parsedData.order_history;
                    var order_service_history = parsedData.order_service_history;
                    var payments = parsedData.payments;
                    var counts = parsedData.counts;
                    var packages = parsedData.packages;

                    var baseUrl = '<?= base_url() ?>';

                    if (order_service_history.length > 0) {
                        for (var x = 0; x < order_service_history.length && x < 5; x++) {
                            if (parsedData.customer.id == order_service_history[x].customer_name && order_service_history[x].service_date != null && order_service_history[x].service_date != "") {
                                var is_direct_billing = order_service_history[x].is_direct_billing;
                                var serviceFrom = moment(order_service_history[x].service_from).format('hh:mm A');
                                var serviceTo = moment(order_service_history[x].service_to).format('hh:mm A');
                                var serviceDate = moment(order_service_history[x].service_date).format('DD MMM YYYY');

                                if (is_direct_billing == '1') {
                                    style = 'style="background-color:#fff9e5"';
                                    text = 'Completed';
                                    label_class = 'success';
                                } else {
                                    if (order_service_history[x].service_status == "1") {
                                        style = 'style="background-color:#00800040"';
                                        text = 'Completed';
                                        label_class = 'success';
                                    } else if (order_service_history[x].service_status == "2") {
                                        style = 'style="background-color:#ff000038"';
                                        text = 'Cancelled';
                                        label_class = 'danger';
                                    } else if (order_service_history[x].service_status == "3") {
                                        style = 'style="background-color:#8000802e"';
                                        text = 'Lapsed';
                                        label_class = 'info';
                                    } else {
                                        style = 'style="background-color:#ffa50045"';
                                        text = 'Pending';
                                        label_class = 'warning';
                                    }
                                }
                                $('#customer_activity').append('<div class="acticity_timeline_circle"></div>' +
                                    '<div class="single_activity_box" ' + style + '><div class="cleint-activity activity_service_name"><p>' + order_service_history[x].service_name + ' | ' + order_service_history[x].service_name_marathi + '</p></div>' +
                                    '<div class="cleint-activity">' + serviceDate + ', ' + (is_direct_billing == '0' ? serviceFrom + ' to ' + serviceTo : '') + '</div>' +
                                    '<div class="cleint-activity">' + order_service_history[x].full_name + '</div>' +
                                    '<div class="cleint-activity">' +
                                    '<label style="color:black;" class="label label-' + label_class + '">' + text + '</label>' +
                                    (order_service_history[x].receipt_no ? '<label style="float:right;color:#7a8a9c;font-size: 12px;">(ID: ' + order_service_history[x].receipt_no + ')</label>' : '') +
                                    '</div></div>'
                                );
                            }
                        }
                    } else {
                        $('#customer_activity').append('<img src="<?= base_url(); ?>admin_assets/images/no_data/no_data.png" >');
                    }

                    setCustomerNote(parsedData.customer.id);

                    if (payments.length > 0) {
                        for (var x = 0; x < payments.length && x < 10; x++) {
                            if (booking_list[x].payment_date != null && booking_list[x].payment_date != "") {
                                var payment_date = moment(booking_list[x].payment_date).format('DD MMM YYYY');

                                $('#customer_payments').append('<div class="acticity_timeline_circle"></div>' +
                                    '<div class="single_activity_box"><div class="cleint-activity"><p style="margin: 0 0 0px;color:#7a8a9c;">ID: ' + payments[x].receipt_no + '</p><p style="margin: 0 0 0px;">' + payment_date + ' - Rs. ' + payments[x].paid_amount + '</p></div><div class="cleint-activity">' + 'Mode: ' + payments[x].payment_mode + '</div>' +
                                    '<a class="btn" style="float:right; margin-top: -32px;" target="_blank" href="<?php echo base_url(); ?>booking-print/' + btoa(payments[x].booking_id) + '/' + btoa(payments[x].booking_payment_id) + '" title="Receipt"><i class="fas fa-receipt"></i></a>' +
                                    '</div>'
                                );
                            }
                        }
                    } else {
                        $('#customer_payments').append('<img src="<?= base_url(); ?>admin_assets/images/no_data/no_data.png" >');
                    }

                    if(parsedData.customer.is_guest == '0'){
                        $('#customer_name_t').html(parsedData.customer.full_name + '<a style="float: right;" title="Edit" href="<?= base_url(); ?>add-customer/' + parsedData.customer.id + '" target="_blank"><i class="fa-solid fa-pen-to-square"></i></a>');
                    }else{
                        $('#customer_name_t').html(parsedData.customer.full_name + '<a style="float: right;" title="Add as Regular Customer" onclick="open_customer_model(\'guest_to_parmanant\')"><i style="color:green;font-size: 15px;" class="fa-solid fa-plus"></i></a>');
                    }

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
                    
                    $('#due_balance').html('Outstanding Amount: Rs. ' + parseFloat(parsedData.customer.current_pending_amount).toFixed(2) + '');

                    if (counts.pending > 0) {
                        $('#total_pending').html('Total Pending Services: ' + counts.pending + '');
                    }
                    if (counts.rescheduled > 0) {
                        $('#total_rescheduled').html('Total Reschedules: ' + counts.rescheduled + '');
                    }
                    if (counts.completed > 0) {
                        $('#total_completed').html('Total Completed Services: ' + counts.completed + '');
                    }
                    if (counts.cancelled > 0) {
                        $('#total_cancelled').html('Total Cancelled Services: ' + counts.cancelled + '');
                    }

                    if (parseInt(parsedData.customer.rewards_balance) > 0) {
                        // $('#customer_rewards_div').show();
                        $('#customer_rewards_text').text('Balance: ' + parsedData.customer.rewards_balance);
                        $('#customer_reward_available').val(parsedData.customer.rewards_balance);
                    }

                    $('#is_member').val(parsedData.is_member);

                    if (parsedData.is_member == '1') {
                        $('#customer_membership_id').val(parsedData.membership.membership_id);
                        $('#membership_payment_status').val(parsedData.membership.payment_status);
                        if (parsedData.membership.payment_status == '0') {
                            $('#total-membership-amount').val(parsedData.membership.membership_price);
                            $('#total_membership_amount_t').text(parseFloat(parsedData.membership.membership_price).toFixed(2));
                        } else {
                            $('#total-membership-amount').val('0.00');
                            $('#total_membership_amount_t').text('0.00');
                        }
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

                        membership_div = '<input type="hidden" name="membership_service_discount_amount_hidden" id="membership_service_discount_amount_hidden" value="0.00">' +
                            '<input type="hidden" name="membership_product_discount_amount_hidden" id="membership_product_discount_amount_hidden" value="0.00">';
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
                            '<div class="membership_details"><a href="<?= base_url(); ?>bill-generation?customer=' + parsedData.customer.id + '&bill_for=0" target="_blank">Not a Member</a></div>'
                        )
                    }

                    if (packages.length > 0) {
                        $('#package_name').html('');
                        $('#package_name').append('<option value="">Select Package</option>');
                        $.each(packages, function(i, d) {
                            $('#package_name').append('<option value="' + d.id + '@@@' + d.package_id + '">' + d.package_name + '</option>');
                        });
                        $("#package_name").val('').trigger("chosen:updated");
                    } else {

                    }

                    set_bill_form();
                },
            });
        }, 1500);
    }

    function setCustomerNote(for_customer_id) {
        $('#customer_notes').empty();
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>salon/Ajax_controller/get_customer_details_for_booking_ajax",
            data: {
                'id': for_customer_id,
                'order_type': '0'
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
                    $('#customer_notes').append('<a onclick="open_customer_note_model()" style="padding: 6px 16px;background-color: #0056d1;border-radius: 6px;color: #fff;">Add New</a>');
                    $('#customer_notes').append('<img src="<?= base_url(); ?>admin_assets/images/no_data/no_data.png" >');
                    $('#add_custom_note').val('');
                }
            }
        });
    }

    function calculateActualPaidAmount(){
        grand_total = parseFloat($('#total_amount').val()) || 0;
        adjust_amount = parseFloat($('#adjust_amount').val()) || 0;
        previous_due_amount = parseFloat($('#previous_due_amount').val()) || 0;
        amount_round_type = $('#amount_round_type').val();
        
        if(amount_round_type == 'Down'){
            actual_paid_amount = grand_total - adjust_amount;
        }else{
            actual_paid_amount = grand_total + adjust_amount;
        }

        $('#rounded_bill_amount').val(parseFloat(actual_paid_amount).toFixed(2));
        $('#actual_paid_amount').val(parseFloat(actual_paid_amount + previous_due_amount).toFixed(2));

        calculateDue();
    }
    function validateCustomNote() {
        $('.loader_div').show();
        if ($('#add_custom_note').val() == '') {
            $('#add_custom_note_error').show();
            $('#add_custom_note_error').text('Please enter custom note');
        } else {
            $('#add_custom_note_error').hide();
            $('#add_custom_note_error').text('');

            setTimeout(function() {
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
            }, 2000);
        }
        $('.loader_div').hide();
    }
</script>