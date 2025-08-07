<?php include('header.php'); ?>
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

    #myModal {
        background-color: white !important;
        display: none;
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
.ui-menu .ui-menu-item-wrapper{
    padding: 9px !important;
}  

</style>


<div class="right_col salon_booking_area" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Add New Booking
                </h3>
            </div>
        </div>
        <div class="clearfix"></div>
    <div class="row">

            <!-- side bar customer info -->

            <div class="col-md-3 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="">
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12" style="position: relative;">
                                    <input autocomplete="off" maxlength="10" type="text" value="<?php if (!empty($single)) {echo $single->customer_phone;} ?>" class="form-control" name="phone" id="phone" placeholder="Search by mobile number"><a class="search-icon" href="#"><i class="fa fa-search"></i></a>
                                    <div id="phone_not_found" style="display:none; color: red;"></div>
                                </div>
                                <div class="customer-info-by-search">
                                    <div></div>
                                </div>
                            </div>
                        </div>
                           <?php if (!empty($single)){?>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <div class="membership_details"><a href="<?= base_url(); ?>asign-membership/<?php if (!empty($single)) {echo $single->id;} ?>" >Not a Member</a></div>
                                </div>
                                <div class="row" style="text-align: center;">
                                    <div class="col-md-12 col-sm-12 col-xs-12 customer-profile-box" name="profile_photo" id="profile_photo">
                                        <p>
                                            <?php
                                                $fullName = $single->full_name;
                                                $initials = '';
                                                $words = explode(' ', $fullName);
                                                foreach ($words as $word) {
                                                    $initials .= strtoupper(substr($word, 0, 1));
                                                }
                                                echo $initials;
                                            ?>
                                        </p>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <b><?= $single->full_name ?></b><br>
                                        <p>Since:
                                        <?php
                                            $createdOn = $single->created_on;
                                            $dateObj = new DateTime($createdOn);
                                            $formattedDate = $dateObj->format('d/m/Y');
                                            echo $formattedDate;
                                            ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-md-12 client_resiter_success"><?php if (!empty($store_profile)) {echo $store_profile->branch_name;} ?> Add <?= $single->full_name ?>
                                                            on <?php
                                                                $createdOn = $single->created_on;
                                                                $dateObj = new DateTime($createdOn);
                                                                $formattedDate = $dateObj->format('d/m/Y');
                                                                echo $formattedDate;
                                                                ?> Succefully</div>
                                </div>
                                    <div class="container">
                                        <div class="row row-history">
                                            <div class="client-history">
                                                <div id="exTab2" class="container">
                                                    <ul class="nav nav-tabs message-tab">
                                                        <li id="tab_1" class="active">
                                                            <a href="#1" data-toggle="tab">Activity</a>
                                                        </li>
                                                        <li class="" id="tab_2">
                                                            <a href="#2" data-toggle="tab">Notes</a>
                                                        </li>
                                                        <li id="tab_3">
                                                            <a href="#3" data-toggle="tab">Payment</a>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content" style="padding: 5px;">
                                                        <div class="tab-pane active customer-activity" id="1">
                                                           <img src="<?= base_url(); ?>admin_assets/images/no_data/no_data.png" width="100%">
                                                        </div>
                                                        <div class="tab-pane customer_note" id="2" style="color: #73879C;">
                                                           <img src="<?= base_url(); ?>admin_assets/images/no_data/no_data.png" width="100%">
                                                        </div>
                                                        <div class="tab-pane customer_payment" id="3">
                                                           <img src="<?= base_url(); ?>admin_assets/images/no_data/no_data.png" width="100%">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php }else{?>
                                <div class="">
                                    <div class="customer_bar">
                                        <img src="<?=base_url()?>admin_assets/images/no_data/no_data.png">
                                    </div>
                                </div>
                                <div class="client_main_container" style="display: none;">
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <div class="membership-info" id="membership" style="display: block;"></div>
                                    </div>
                                    <div class="row" style="text-align: center;">
                                        <div class="col-md-12 col-sm-12 col-xs-12 customer-profile-box" name="profile_photo" id="profile_photo"></div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <b id="customer_name_t"></b><br>
                                            <p id="add_date"></p>
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
                                                            <a href="#1" data-toggle="tab">Activity</a>
                                                        </li>
                                                        <li class="" id="tab_2">
                                                            <a href="#2" data-toggle="tab">Notes</a>
                                                        </li>
                                                        <li id="tab_3">
                                                            <a href="#3" data-toggle="tab">Payment</a>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content" style="padding: 5px;">
                                                        <div class="tab-pane active customer-activity" id="1">

                                                        </div>
                                                        <div class="tab-pane customer_note" id="2" style="color: #73879C;">

                                                        </div>
                                                        <div class="tab-pane customer_payment" id="3">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }?>
                    </div>
                </div>
            </div>

            <!-- middel bar service info -->

            <div class="col-md-5 col-sm-12 col-xs-12 no_data_middle" <?php if (!empty($single)) {?>style="display: none;"<?php }?>>
                <div class="x_panel" style="height: 300px;">
                    <div class="x_content">
                        <div class="container">
                            <div class="third_bar">
                                <img src="<?=base_url()?>admin_assets/images/no_data/no_data.png">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-5 col-sm-12 col-xs-12 middle_bar" <?php if (!empty($single)) {?>style="display: block;"<?php }?>>
                <div class="x_panel new_x_panel">
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

                                    <div class="tab-pane active" id="4">
                                        <div class="">
                                            <div class="form-group row">
                                                <select class="form-select form-control chosen-select" name="sup_category" id="sup_category">
                                                    <option class="option_placeholder" value="">Select category</option>
                                                    <?php if (!empty($category)) {
                                                        foreach ($category as $category_result) { ?>
                                                            <option value="<?= $category_result->id ?>"><?= $category_result->sup_category ?>/<?= $category_result->sup_category_marathi ?></option>
                                                    <?php }
                                                    } ?>
                                                </select>
                                            </div>
                                            <div class="form-group row search_services_box" style="display: none;">
                                                <!-- <input class="form-control" type="text" name="search_services" id="search_services" value="" placeholder="Search services by service name"><a class="service-search-icon" href="#"><i class="fa fa-search"></i></a> -->
                                            </div>
                                            <div class="row a_s_d_g">
                                                <div class="service_detail_content_box" style="display: none;">
                                                    <div class="row">
                                                        <input type="hidden" id="search_array">
                                                       <input autocomplete="off" class="form-control ss-search" type="text" name="search_services" id="search_services" value="" placeholder="Search services by service name"><a class="service-search-icon" href="#"><i class="fa fa-search"></i></a>
                                                    </div>
                                                    <div class="col-md-8 col-sm-12 col-xs-12">
                                                        <div class="title_c" id="category_name_t"></div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="title_c_product">Product</div>
                                                    </div>
                                                    <div class="hr_l"></div>
                                                    <div id="service_sss">
                                                        <!-- <div class="col-md-6 col-sm-12 col-xs-12" id="package_service_name"></div>
                                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" id="service_price_t" class="service_price_t"></div>
                                                        <div class="col-md-2 col-sm-12 col-xs-12" id="service_product_model"></div>
                                                        <div class="clearfix"></div> -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row service_validation error">
                                                <div>Please select atleast one service</div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12 col-sm-12 col-xs-12 service_detail_content" style="display: none;">
                                                    <div class="service_detail"></div>

                                                    <div class="product_detail_name_title" style="display: none;">Selected Product</div>
                                                    <div class="form-group col-md-12 col-sm-12 col-xs-12 service_product_and_price" style="display: none;">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="tab-pane" id="5">
                                        <div class="row pacakge-box">
                                            <div class="form-group">
                                                <select class="form-select form-control chosen-select" name="package_name" id="package_name">
                                                    <option value="">Select package name</option>
                                                    <?php if (!empty($package_list)) {
                                                        foreach ($package_list as $package_list_result) { ?>
                                                            <option value="<?= $package_list_result->id ?>"><?= $package_list_result->package_name ?></option>
                                                    <?php }
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row pacakge_validation error">
                                                <div>Please select pacakge</div>
                                            </div>
                                        <div class="row">
                                            <div class="package_detail_content" style="display: none;">
                                                <div class="col-md-8 col-sm-12 col-xs-12">
                                                    <b id="pacakage_name_t">Package Name</b>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                    <b id="pacakage_product_t">Product</b>
                                                </div>

                                                <div class="row pacakge_detail_">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row service_detail_content_title" style="display: none;"><br>
                                            <b>Selected Services & Product</b>
                                        </div>
                                        <div class="row packageservice_detail_content" style="display: none;">
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <div class="pacakge_service_tittle">

                                                </div>
                                                <div class="row product_detail_name" style="display: none;">
                                                    <div class="service_detail_name">Selected Product</div>
                                                </div>
                                                <div class="row package_service_product_and_price" style="display: none;">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 no_data_side_amount">
                <div class="x_panel" style="height: 300px;">
                    <div class="x_content">
                        <div class="container">
                            <div class="third_bar">
                                <img src="<?=base_url()?>admin_assets/images/no_data/no_data.png">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 side_amount_bar" style="display: none;">
            <div class="x_panel">
                <div class="x_content">
                    <div class="container">
                        <form method="post" name="booking_form" id="booking_form" enctype="multipart/form-data">
                            <div class="row">
                                 <div class="col-md-7 col-sm-12 col-xs-12">
                                    <input type="hidden" id="m_discount">
                                    <input type="hidden" id="M_P_discount" placeholder="yyy">
                                    <input type="hidden" id="m_discount_type">
                                    <input type="hidden" id="gift_discount" name="gift_discount">
                                    <input type="hidden" id="gift_discount_type">
                                    <span class="span_title_side_bar">Payble Amount:<span id="ppp_aaa"></span></span>
                                </div>
                                <div class="col-md-5 col-sm-12 col-xs-12 total_service_time" style="display: none;">
                                    <input type="text" id="ttt-fff" readonly>
                                    <span class="span_title_side_bar">Duration:</span>
                                </div>
                            </div>
                            <hr class="break_line">
                            <div class="row service-payment-title hhh_ccc_span" style="display: none;">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <span>Services</span>
                                </div>
                            </div>
                            <div class="row service-payment" style="display: none;">

                            </div>
                            <div class="row service_product_payment_title" style="display: none;">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <span>Products</span>
                                </div>
                            </div>
                            <div class="row service_product_payment hhh_ccc_span" style="display: none;">

                            </div>
                            <hr class="break_line">
                            <div class="row t_s_a_title" style="display: none;">
                                <div class="col-md-7 col-sm-12 col-xs-12">
                                    <span class="span_title_side_bar">Total Service Amount</span>
                                </div>
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <input class="form-control" type="hidden" value="0" name="total-service-amount" id="total-service-amount" readonly>
                                </div>
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <span class="lll_ccc_span" id="total_service_amount_t">0.00</span>
                                </div>
                            </div>
                            <div class="row t_p_a_title" style="display: none;">
                                <div class="col-md-7 col-sm-12 col-xs-12">
                                    <span class="zzz-xxx">Total Product Amount</span>
                                </div>
                                <div class="col-md-3 col-sm-12 col-xs-12"></div>
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <input type="text" value="0.00" id="total_product_amount_t" class="total_product_amount_t" readonly>
                                </div>
                            </div>
                            <div class="row offers_discount_box">

                            </div>
                            <div class="row M_S_discount">

                            </div>
                            <div class="row M_P_discount" style="display: none;">

                            </div>
                            <div class="row gift_card_discount">

                            </div>
                            <div class="row total_final_amount_title" style="display: none;">
                                <div class="col-md-7 col-sm-12 col-xs-12">
                                    <span class="span_title_side_bar">Payable Service Amount</span>
                                </div>
                                <div class="col-md-3 col-sm-12 col-xs-12"></div>
                                <div class="col-md-2 col-sm-12 col-xs-12 payable_amount">
                                    <input type="text" id="total_final_amount" placeholder="0.00" readonly>
                                </div>
                            </div>
                            <div class="row total_product_amount_title" style="display: none;">
                                <div class="col-md-7 col-sm-12 col-xs-12">
                                    <span class="span_title_side_bar">Payable Product Amount</span>
                                </div>
                                <div class="col-md-3 col-sm-12 col-xs-12"></div>
                                <div class="col-md-2 col-sm-12 col-xs-12 payable_amount">
                                    <input type="text" id="tt_pp_aa" placeholder="0.00" readonly>
                                </div>
                            </div>
                            <hr class="break_line">
                            <div class="row total_payable_amount" style="display: block;">
                                <div class="col-md-7 col-sm-12 col-xs-12">
                                    <span class="span_title_side_bar">Payable Amount</span>
                                </div>
                                <div class="col-md-3 col-sm-12 col-xs-12"></div>
                                <div class="col-md-2 col-sm-12 col-xs-12 payable_amount">
                                    <input type="text" id="payble_price" name="payble_price" placeholder="0.00" readonly>
                                </div>
                            </div>
                            <div class="row gst_info_box" style="display: none;">
                                <div class="col-md-7 col-sm-12 col-xs-12">
                                    <span class="span_title_side_bar">GST (18%)</span>
                                </div>
                                <div class="col-md-3 col-sm-12 col-xs-12"></div>
                                <div class="col-md-2 col-sm-12 col-xs-12 gst_amount">
                                    <input type="hidden" id="service_gst_amount" placeholder="0.00" readonly>
                                    <input type="hidden" id="product_gst_amount" placeholder="0.00" readonly>
                                    <input type="text" id="gst_amount" name="gst_amount" placeholder="0.00" readonly>
                                </div>
                            </div>
                            <hr class="break_line">
                            <div class="row amount_to_paid_title" style="display: none;">
                                <div class="col-md-7 col-sm-12 col-xs-12">
                                    <span class="span_title_side_bar">Amount to Paid</span>
                                </div>
                                <div class="col-md-3 col-sm-12 col-xs-12"></div>
                                <div class="col-md-2 col-sm-12 col-xs-12 payable_amount">
                                    <input type="text" id="amount_to_paid" name="amount_to_paid" placeholder="0.00" readonly>
                                </div>
                            </div>
                            <div class="row reminder_box_input" style="display: none;">
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                    <textarea type="text" class="form-control" name="note" id="note" placeholder="Add Note"></textarea>
                                </div>
                            </div><br>
                            <div class="row reminder_box" style="display: none;">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <span class="span_title_side_bar">Select Remainder Message type <b class="require">*</b></b>
                                </div><br><br>
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                    <input type="radio" name="reminder" id="sms" value="1" placeholder="Add Note">
                                    <label>SMS</label>
                                    <input type="radio" name="reminder" id="email_btn" value="2" placeholder="Add Note">
                                    <label>Email</label>
                                    <input type="radio" name="reminder" id="whatsapp" value="3" placeholder="Add Note">
                                    <label>Whatapp</label>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group" style="display: none;">
                                    <input type="text" id="customer_name" name="customer_name" value="<?php if (!empty($single)) {echo $single->id;} ?>">
                                    <input type="text" id="service_category" name="service_category">
                                    <input type="text" name="services" id="services_id">
                                    <input type="text" name="pacakge_id" id="pacakge_id">
                                    <input type="text" name="products_id" id="products_id">
                                    <input type="text" name="time_slot" id="time_slot">
                                    <input type="text" name="stylist" id="stylist">
                                    <input type="text" name="service_price" id="service_price">
                                    <input type="text" name="product_price" id="product-price">
                                    <input type="text" name="booking_date" id="booking_date">
                                    <input type="text" name="selected_shift" id="selected_shift">
                                    <input type="text" name="offer_discount" id="offer_discount">
                                    
                                </div>
                                <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="validation_message"></div>
                                </div> -->
                                <div class="row confirm_btn_box" style="display: none;">
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                        <button onclick="check_valiation()" class="btn btn-info" style="width: 350px;" id="booking_button" name="booking_button" value="booking_button">Confirm Booking</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


        </div>
    </div>

    <!-- time slot model -->

    <div class="time-slot-content-main" style="display: none;">
        <div class="time-slot-content">
            <div class="row">
                <div class="title_left_time_slot">
                    <h4>
                        Select Time Slot
                    </h4>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 time-slot-date-row">
                    <div class="time-slot-date">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
                            <small><b>Date</b></small>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <input class="form-control" type="hidden" id="dummy-services_id" placeholder="YYY">
                            <input autocomplete="off" onchange="check_festival_offers(0)" type="text" name="booking-date" id="booking-date" placeholder="dd/mm/yy" value="<?php $currentDate = date("d/m/Y");
                                                                                                                                        echo $currentDate; ?>">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 time-slot-date-row">
                    <div class="time-slot-date">
                        <div class="col-md-12 shift_box_sss">
                            <select onchange="gettime_by_shift()" class="form-select" name="shift_name" id="shift_name">
                                <option value="" class="selected_shift">Select Shift</option>
                                <?php if (!empty($shift_list)) {
                                    foreach ($shift_list as $shift_list_result) { ?>
                                        <option value="<?= $shift_list_result->id ?>"><?= $shift_list_result->shift_name ?></option>
                                <?php }
                                } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 time-slot-time-row">
                    <div class="time-slot-time">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
                            <small><b>Time</b></small>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <input type="text" name="time-slot" id="time-slot" placeholder="12:30">
                        </div>
                    </div>
                </div>
            </div>
           
            <div class="row time-slot-box-model-row" style="padding: 5px;">

            </div>
            <div class="time_error error"></div>
            <hr>
            <div class="row yyy_zzzz" style="display: none;">
                <div class="col-md-6">
                    <input onclick="open_service_stylist_list()" autocomplete="off" type="text" name="staff_id" id="staff_id" placeholder="Select Stylist">
                    <input type="hidden" name="original_staff_id" id="original_staff_id" placeholder="Select Stylist">
                </div>
                <div class="service_stylist_list"></div>
            </div>
            <div class="stylist_error error"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 15px;"></div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div onclick="return time_validation()" class="close_time_slot_Model btn btn-primary" style="float: left;">Save</div>
                    <div onclick="togglePopup()" class="btn btn-danger" style="float: left;">Close</div>
                </div>
            </div>
        </div>
    </div>

    <!-- package product model -->

    <div class="package-product-content-main" style="display: none;">
        <div class="package-product-content">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h4>Select Suggested Product</h4>
                </div>
                <div class="package-product-detail-box">
                    <div class="col-md-2 col-sm-6 col-xs-12" id="packageproduct_price_name_id"></div>
                    <div class="col-md-5 col-sm-6 col-xs-12" id="packageproduct_name"></div>
                    <div class="col-md-5 col-sm-6 col-xs-12" id="packageproduct_price"></div>
                </div>
                <div class="">
                    <div class="col-md-2 col-sm-6 col-xs-12"></div>
                    <div class="col-md-5 col-sm-6 col-xs-12"></div>
                    <!-- <div class="col-md-2 col-sm-6 col-xs-12" id="packageproduct_price">
                        <input type="text" id="total-package-product-amount" placeholder="yyy">
                    </div> -->
                </div>
                <hr>
            </div>
            <div class="row">
                <div class="col-md-10 col-sm-12 col-xs-12"></div>
                <div class="col-md-2 col-sm-12 col-xs-12">
                    <div onclick="togglepackageproduct()" class="close_time_slot_Model btn btn-primary">Save</div>
                </div>
            </div>
        </div>
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
                        <input type="text" maxlength="10" class="form-control" name="customer_phone" id="customer_phone" placeholder="Enter phone number">
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                        <label>Select Gender<b class="require">*</b></label>
                        <select class="form-select form-control" name="gender" id="gender">
                            <?php if ($store_category->category == 0){?>
                                <option id="male" value="0">Male</option>
                            <?php }?>
                            <?php if ($store_category->category == 1){?>
                                <option id="female" value="1">Female</option>
                            <?php }?>
                            <?php if ($store_category->category == 2){?>
                                <option id="male" value="0">Male</option>
                                <option id="female" value="1">Female</option>
                                <option id="female" value="2">Other</option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="add-more-info" style="display: none;">
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
                            <input readonly maxlength="10" type="text" class="form-control" name="DOA" id="DOA" placeholder="DD/MM/YY">
                        </div>
                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <label>Date Of Brith</label>
                            <input readonly maxlength="10" type="text" class="form-control" name="dob" id="dob" placeholder="DD/MM/YY">
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                            <label>State</label>
                            <select class="form-select form-control" name="state" id="state">
                                <option value="" class="">Select State</option>
                                <?php if (!empty($state)) {
                                    foreach ($state as $state_result) { ?>
                                        <option value="<?= $state_result->id ?>" <?php if (!empty($single) && $single->state == $state_result->id) { ?>selected="selected" <?php } ?>>
                                            <?= $state_result->name ?>
                                        </option>
                                <?php }
                                } ?>
                            </select>

                            <?php
                            $city = array();
                            if (!empty($single)) {
                                $city = $this->Admin_model->get_selected_state_city($single->state);
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
                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <label>Address</label>
                            <input type="text" class="form-control" name="address" id="address" placeholder="Ente address">
                        </div>
                    </div>
                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <div class="show-more-box"><a href="#" id="show_more">Show More</a></div>
                        <div class="show-more-box"><a href="#" id="show_less" style="display: none;">Show less</a></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <button class="btn btn-primary" type="submit" name="customer_button" id="customer_button" value="customer_button">Save</button>
                        <div style="float: left;" onclick="open_customer_model()" class="close_time_slot_Model btn btn-danger">Close</div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Service product model -->

    <div class="service-product-content-main" style="display: none;">
        <div class="service-product-content">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h4>Select service Suggested Product</h4>
                </div>
            </div>
            <div class="row pp_head_title_row">
                <div class="col-md-6 pp_head_title">Product Name</div>
                <div class="col-md-6 pp_head_title">Product Price</div>
            </div>
            <div class="package-product-detail-box">
                <div class="row product_ss_row">
                    <div class="col-md-1 col-sm-6 col-xs-12" id="product_price_name_id"></div>
                    <div class="col-md-6 col-sm-6 col-xs-12 name_pp_ss" id="product_name"></div>
                    <div class="col-md-5 col-sm-6 col-xs-12 name_pp_ss" id="product_price"></div>
                </div>
            </div>
            <div class="row hh-jj-kk">
                <div class="col-md-7 col-sm-6 col-xs-12">Total Product Price</div>
                <div class="col-md-5 col-sm-6 col-xs-12">
                    <input readonly type="text" placeholder="0.00" name="total_p_amount" id="total_p_amount" class="form-control ssff">
                </div>
            </div>
            <div class="row" style="margin-top: 10px;">
                <div class="col-md-10 col-sm-12 col-xs-12"></div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <button style="margin-bottom: 5px;" type="button" class="btn btn-primary" onclick="closeserviceproduct()">Save</button>
                    <div style="margin-bottom: 5px;" class="btn btn-default" onclick="closeserviceproduct()">close</div>
                </div>
            </div>
        </div>
    </div>



    <?php include('footer.php');
    $id = 0;
    if ($this->uri->segment(2) != "") {
        $id = $this->uri->segment(2);
    }
    ?>

     <!-- search stylist -->


     <script>
        $(document).ready(function(){
            $("#staff_id").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $(".service_stylist_list .stylist_time_name_box").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
    </script>

    <!-- search services -->


    <script>
        $(document).ready(function(){
            $("#search_services").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#service_sss .row").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
    </script>

    <!-- search default category services -->

    <script>
        function search_service(category_id) {
            $('#search_services_' + category_id).on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $('#service_sss_' + category_id + ' .row').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        }
    </script>
 

    <!-- Customer Resitration Succefully -->

    <script type="text/javascript">
        // function get_customer_model() {
        //     $('.client_main_container').show();
        //     var last_id = <?php echo json_encode($last_id) ?>;
        //     $(".customer-info-by-search").hide();
        //     $("#customer_name_t").html(last_id.full_name);
        //     $("#phone").html(last_id.customer_phone);
        //     $('.memebership_expiry').show().css('background-color', 'green');
        //     $('.memebership_expiry').append('</span>Customer Resitration Succefully</span>');
        // }

        function open_customer_model() {
            $(".add-new-customer-main").toggle();
            $(".customer-info-by-search").hide();
            $("#customer_phone").val($("#phone").val());
        }
    </script>

    <!-- show_more customer info -->

    <script>
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
    </script>

    <!-- service-product-content-main -->

    <script>
        function closeserviceproduct() {
            $('.service-product-content-main').toggle();
        }
    </script>

    <!-- married_status -->

    <script>
        $("#married_status").change(function() {
            var m_status = $("#married_status").val();
            if (m_status == 0) {
                $('.Anniversary-box').show();
            } else {
                $('.Anniversary-box').hide();
            }
        });
    </script>

    <!-- city and state -->

    <script>
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
    </script>


    <!-- datepicker -->

    <script>
        // $(document).ready(function(){
        $("#booking-date").datepicker({
            dateFormat: "dd/mm/yy",
            changeMonth: true,
            changeYear: true,
            minDate: "+1D",
            maxDate: "5",
             ,
            defaultDate: 0
        });
      

        $("#dob").datepicker({
            dateFormat: "dd/mm/yy",
            changeMonth: true,
            changeYear: true,
            maxDate: "0",
             ,
            defaultDate: 0
        });

        $("#DOA").datepicker({
            dateFormat: "dd/mm/yy",
            changeMonth: true,
            changeYear: true,
            maxDate: "0",
             ,
            defaultDate: 0
        });
    // });
        
    </script>

    <!-- customer allerady selected -->

    <script>
        $(window).on('load', function() {
        var phone = $('#phone').val();
        if((phone !=="") && (phone.length == 10)){
            get_customer_info(phone)
        } 
    });
    </script>

<!-- custom validation -->

    <script>
        function check_valiation(){
            var pacakge_id=$('#pacakge_id').val();
            var staff=$("#services_id").val();
            var d_staff = staff.split(',');
            var val_status=0;
            if(pacakge_id == ""){
                for (var s = 0; s < d_staff.length; s++) {
                    if($('#dummy_staff_'+d_staff[s]).val() == ""){
                        $('#validation_message_'+d_staff[s]+'').html('Please Select stylist!');
                        $('#booking_button').hide();
                        val_status=1;
                    }
                }
                for (var s = 0; s < d_staff.length; s++) {
                    if($('#dummy_staff_'+d_staff[s]).val() !== ""){
                        $('#validation_message_'+d_staff[s]+'').hide();
                    }
                }
                if(val_status == 0){
                    $('#booking_button').show();
                }
                if(staff == ""){
                    $('.service_validation').show();
                    $('#booking_button').hide();
                }
                if(pacakge_id == "" && staff == ""){
                    $('.pacakge_validation').show();
                    $('#booking_button').hide();
                }
            }else{
               
                for (var s = 0; s < d_staff.length; s++) {
                    if($('#dummy_staff_'+d_staff[s]+'_'+pacakge_id+'').val() == ""){
                        // $('#validation_message_'+d_staff[s]+'_'+pacakge_id+'').show();
                        $('#validation_message_'+d_staff[s]+'_'+pacakge_id+'').html('Please select time slot & stylist!');
                        $('#booking_button').hide();
                        val_status=1;
                    }
                }
                for (var s = 0; s < d_staff.length; s++) {
                    if($('#dummy_staff_'+d_staff[s]+'_'+pacakge_id+'').val() !== ""){
                        $('#validation_message_'+d_staff[s]+'_'+pacakge_id+'').hide();
                    }
                }
                if(val_status == 0){
                    $('#booking_button').show();
                }
            }
        }
    </script>

    <!-- validation script -->

    <script>
        $(document).ready(function () {
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
       });
    </script>
    <script>
         function time_validation(){
            var validation = 0;
            if ($('.slot_time_disabled').length === 0) {
                $(".time_error").html('Please select at least one time slot');
                validation = 1; 
            }else{
                $(".time_error").html(''); 
            } 
            if($("#staff_id").val() == ""){                
                $(".stylist_error").html('Please select stylist');
                validation = 1;
            }
            if(validation == 0){
                $(".stylist_error").hide();
                togglePopup();
            }
        }
        $('#value_check').change(function() {
            if ($('#value_check').val() == 'Yes') {
                $('.package-box').show();
            } else if ($('#value_check').val() == 'No') {
                $('.package-box').hide();
            }
        });
        $(document).ready(function() {
            $('#booking_form').validate({
                rules: {
                    // note: 'required',
                    reminder: 'required',
                    time_slot: 'required',
                },
                messages: {
                    // note: 'Please enter note!',
                    reminder: 'Please select reminder type!',
                    time_slot: 'Please select time slot!',
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
        });
    </script>

    <!-- get customer details from phone script -->

    <script type="text/javascript">
        $("#phone").keyup(function() {
           
            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>salon/Ajax_controller/get_customer_details_ajax",
                data: {
                    'phone': $('#phone').val(),
                },
                success: function(data) {
                    var parsedData = JSON.parse(data);
                    if (parsedData.customer_phone) {
                        $('.customer-info-by-search').show();
                        $('.customer-info-by-search div').html('<div onclick="get_customer_info(' + parsedData.customer_phone + ')">' + parsedData.full_name + '</div>');

                    } else {
                        $('.customer-info-by-search').show();
                        $('.customer-info-by-search div').html('Customer Not Found! Please Add New Customer.<b onclick="open_customer_model()" class="add-new-customer">Add Customer</b>');
                    }
                },
            });
        });

        function get_customer_info(phone) {
            $('.client_main_container').show();
            $('.middle_bar').show();
            $('.no_data_middle').hide();
            $('.customer_bar').hide();
            $('.gst_info_box').show();
            $('.memebership_expiry').hide();
            $('.M_S_discount').empty();
            $('.M_P_discount').empty();
            $('.gift_card_discount').empty();
            $('#membership').empty();
            $('#profile_photo').empty();
            $('.customer-activity').empty();
            $('.customer_note').empty();
            $('.customer_payment').empty();
            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>salon/Ajax_controller/get_customer_details_ajax",
                data: {
                    'phone': phone,
                },
                success: function(data) {
                    var parsedData = JSON.parse(data);

                    $('#customer_name').val(parsedData.id);
                    var membership_data = <?php echo json_encode($membership_list) ?>;
                    var booking_list = <?php echo json_encode($booking_list) ?>;
                    var booking_length = booking_list.length;
                    var baseUrl = '<?= base_url() ?>';

                    var flag = 0;
                    if (booking_list && booking_length > 0) {
                        for (var x = 0; x < booking_length && x < 5; x++) {
                            if (parsedData.id == booking_list[x].customer_name && booking_list[x].booking_date != null && booking_list[x].time_slot != null && booking_list[x].booking_date != "" && booking_list[x].time_slot != "") {
                                console.log(booking_list[x])
                                if(x == 0){
                                    checkreminderservice(booking_list[x].services, booking_list[x].booking_date);
                                }
                                $('#phone').val(parsedData.full_name)
                                $('.customer-info-by-search').hide();
                                $('.customer-activity').append('<div class="acticity_timeline_circle"></div>\
                                                                    <div class="cleint-activity">Date:' + booking_list[x].booking_date + ' Time:' + booking_list[x].time_slot + ' </div>');
                                $('.customer_note').append(booking_list[x].note);
                                flag = 1;
                            }
                        }
                    }
                    
                    if(flag === 0){
                        $('.customer-activity').append('<div><b style="color: black;margin-left: 72px;">No Activity Found</b></div>');
                        $('.customer_note').append('<div><b style="color: black;margin-left: 72px;">No Notes Found</b></div>');
                        $('.customer_payment').append('<div><b style="color: black;margin-left: 72px;">No Payment Found</b></div>');
                    }
                    
                    var m_length = membership_data.length
                    for (var i = 0; i < m_length; i++) {
                        if (parsedData.membership_id == membership_data[i].id) {
                            $('#membership').append('<b>' + membership_data[i].membership_name + '</b>');
                            $('.membership-info').css('background-color', membership_data[i].bg_color);
                            if (membership_data[i].discount_in == 1) {
                                $('.M_S_discount').append('<div class="col-md-7 col-sm-12 col-xs-12">\
                                                                <span class="span_title_side_bar">Membership Service Discount(Rs.' + membership_data[i].service_discount + ')</span>\
                                                            </div>\
                                                            <div class="col-md-3 col-sm-12 col-xs-12">\
                                                                <div class="btn_apply" style="background-color: ' + membership_data[i].bg_color + '">' + membership_data[i].membership_name + '</div>\
                                                            </div>\
                                                            <div class="col-md-2 col-sm-12 col-xs-12 discount_amount_box">\
                                                               <input type="text" name="m_service_discount" id="total_m_s_amount" placeholder="0.00" readonly> \
                                                            </div>');
                                $('.M_P_discount').append(' <div class="col-md-7 col-sm-12 col-xs-12">\
                                                              <span class="span_title_side_bar">Membership Product Discount (Rs.' + membership_data[i].product_discount + ')</span>\
                                                            </div>\
                                                            <div class="col-md-3 col-sm-12 col-xs-12">\
                                                                <div class="btn_apply" style="background-color: ' + membership_data[i].bg_color + '">' + membership_data[i].membership_name + '</div>\
                                                            </div>\
                                                            <div class="col-md-2 col-sm-12 col-xs-12 discount_amount_box">\
                                                               <input type="text" name="m_product_discount" id="total_m_p_amount" placeholder="0.00" readonly> \
                                                            </div>');
                                var m_discount = parseFloat(membership_data[i].service_discount);
                                $('#m_discount').val(m_discount);
                                $('#m_discount_type').val(1);

                                var M_P_discount = parseFloat(membership_data[i].product_discount);
                                $('#M_P_discount').val(M_P_discount);

                            } else {
                                $('.M_S_discount').append('<div class="col-md-7 col-sm-12 col-xs-12">\
                                                                <span class="span_title_side_bar">Membership Service Discount(' + membership_data[i].service_discount + '%)</span>\
                                                            </div>\
                                                            <div class="col-md-3 col-sm-12 col-xs-12">\
                                                                <div class="btn_apply" style="background-color: ' + membership_data[i].bg_color + '">' + membership_data[i].membership_name + '</div>\
                                                            </div>\
                                                            <div class="col-md-2 col-sm-12 col-xs-12 discount_amount_box">\
                                                               <input type="text" name="m_service_discount" id="total_m_s_amount" placeholder="0.00" readonly> \
                                                            </div>');
                                $('.M_P_discount').append(' <div class="col-md-7 col-sm-12 col-xs-12">\
                                                              <span class="span_title_side_bar">Membership Product Discount (' + membership_data[i].product_discount + '%)</span>\
                                                            </div>\
                                                            <div class="col-md-3 col-sm-12 col-xs-12">\
                                                                <div class="btn_apply" style="background-color: ' + membership_data[i].bg_color + '">' + membership_data[i].membership_name + '</div>\
                                                            </div>\
                                                            <div class="col-md-2 col-sm-12 col-xs-12 discount_amount_box">\
                                                               <input type="text" name="m_product_discount" id="total_m_p_amount" placeholder="0.00" readonly> \
                                                            </div>');

                                var m_discount = parseFloat(membership_data[i].service_discount);
                                $('#m_discount').val(m_discount);
                                $('#m_discount_type').val(0);

                                var M_P_discount = parseFloat(membership_data[i].product_discount);
                                $('#M_P_discount').val(M_P_discount);
                            }
                            break;
                        }
                    }

                    $('#customer_name_t').html(parsedData.full_name);
                    $('#phone').val(parsedData.full_name)

                    var fullName = parsedData.full_name;
                    var initials = fullName.split(' ').map(word => word.charAt(0)).join('');
                    $('#profile_photo').append('<span class="name_head">' + initials + '</span>');

                    var timestamp = parsedData.created_on;
                    var dateObject = new Date(timestamp);
                    var year = dateObject.getFullYear();
                    var month = (dateObject.getMonth() + 1).toString().padStart(2, '0');
                    var day = dateObject.getDate().toString().padStart(2, '0');
                    var formattedDate = day + '-' + month + '-' + year;

                    $('#add_date').html('Since: ' + formattedDate);
                    $('.customer-info-by-search').hide();

                    if (parsedData.membership_id == 0) {
                        $('#membership').append('<a href="<?= base_url(); ?>asign-membership/' + parsedData.id + '" style="color: white">Not a Member</a>');
                        $('.membership-info').css('background-color', 'rgb(116 116 116)');
                    }

                 
                    var gift_data = <?php echo json_encode($gift_card_list) ?>;
                    var gift_length = gift_data.length;
                    for (var i = 0; i < gift_length; i++) {
                        if (parsedData.gift_card_id == gift_data[i].id) {
                            if (gift_data[i].discount_in == 1) {
                                $('.gift_card_discount').append('<div class="col-md-7 col-sm-12 col-xs-12">\
                                                                    <span class="span_title_side_bar">Gift Card Discount(Rs.' + gift_data[i].discount + ')</span>\
                                                                    </div>\
                                                                    <div class="col-md-3 col-sm-12 col-xs-12">\
                                                                        <div class="btn_applied" style="background-color: ' + gift_data[i].bg_color + '">Applied</div>\
                                                                    </div>\
                                                                    <div class="col-md-2 col-sm-12 col-xs-12 discount_amount_box">\
                                                                    <input type="text" id="gift_card_amount">\
                                                                    </div>');
                                $('#gift_discount').val(gift_data[i].discount);
                                $('#gift_discount_type').val(1);
                            } else {
                                $('.gift_card_discount').append('<div class="col-md-7 col-sm-12 col-xs-12">\
                                                                    <span class="span_title_side_bar">Gift Card Discount(' + gift_data[i].discount + '%)</span>\
                                                                    </div>\
                                                                    <div class="col-md-3 col-sm-12 col-xs-12">\
                                                                        <div class="btn_applied" style="background-color: ' + gift_data[i].bg_color + '">' + gift_data[i].gift_name + '</div>\
                                                                    </div>\
                                                                    <div class="col-md-2 col-sm-12 col-xs-12 discount_amount_box">\
                                                                    <input type="text" id="gift_card_amount">\
                                                                    </div>');
                                $('#gift_discount').val(gift_data[i].discount);
                                $('#gift_discount_type').val(0);
                            }
                            break;
                        }
                    }

                },
            });

            showdefaultservice();
        }
    </script>

    <!-- show default services -->

    <script>
        function showdefaultservice() {
            var default_category = <?php echo json_encode($default_category) ?>;
            var default_service = <?php echo json_encode($default_service) ?>;
            var d_length = default_category.length;
            var service_length = default_service.length;
            var default_category_ids = [];
            for (var i = 0; i < d_length; i++) {
                default_category_ids.push(default_category[i].id);

                var category_id = default_category[i].id;
                $('.a_s_d_g').append('<div class="default_service_detail_content_box default_service_' + category_id + '"><div class="row">\
                                            <input autocomplete="off" onclick="search_service('+ category_id +')" class="form-control ss-search" type="text" name="search_services" id="search_services_'+ category_id +'" value="" placeholder="Search services by service name"><a class="service-search-icon" href="#"><i class="fa fa-search"></i></a>\
                                        </div>\
                                        <div class="col-md-8 col-sm-12 col-xs-12">\
                                            <div class="title_c" id="category_name_t">' + default_category[i].sup_category + ' | ' + default_category[i].sup_category_marathi + '</div>\
                                        </div>\
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">\
                                            <div class="title_c_product">Product</div>\
                                        </div>\
                                        <div class="hr_l"></div>\
                                        <div id="service_sss_' + category_id + '">\
                                                <div class="col-md-6 col-sm-12 col-xs-12" id="package_service_name_' + category_id + '"></div>\
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" id="service_price_t_' + category_id + '" class="service_price_t"></div>\
                                                <div class="col-md-2 col-sm-12 col-xs-12" id="service_product_model_' + category_id + '"></div>\
                                                <div class="clearfix"></div>\
                                        </div></div>');

                // $('.service_detail_content_box').show();
                $('.search_services_box').show();
                $('#service_price_t').show();
                $.ajax({
                    type: "POST",
                    url: "<?= base_url(); ?>salon/Ajax_controller/get_default_services_ajax",
                    data: {
                        'category': category_id,
                    },
                    success: function(data) {
                        // alert(category_id);
                        var parsedData = JSON.parse(data);
                        if (parsedData.length > 0) {
                            parsedData.forEach(function(record) {
                                var p_count = 0;
                                for (var k = 0; k < record.product.length; k++) {
                                    if (record.product[k] !== ',') {
                                        p_count++;
                                    }
                                }
                                var flag = 0;
                                if (record.default_status == 1) {
                                    flag = 1;
                                }
                                if (flag == 1) {
                                    $('#service_sss_' + record.category + '').append('<div class="row"> <div class="col-md-6 col-sm-12 col-xs-12" id="package_service_name"><input checked onclick="showServiceDetail(' + record.id + ');" class="service_name_check" type="checkbox" name="service_name_check" id="service_name_check_' + record.id + '" value="" ><div class="service_name_t" id="service_name_t">' + record.service_name + '</div></div>\
                                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" id="service_price_t" class="service_price_t"><div class="service_price_title">Rs.' + record.final_price + '</div></div>\
                                                        <div class="col-md-2 col-sm-12 col-xs-12" id="service_product_model"><div class="product_model_a" onclick="toggleserviceproduct(' +record.id + ')"><span id="select_p_' + record.id + '">0</span>/' + p_count + '</div></div><div>');

                                    showServiceDetail(record.id);

                                } else {
                                    $('#service_sss_' + record.category + '').append('<div class="row"> <div class="col-md-6 col-sm-12 col-xs-12" id="package_service_name"><input onclick="showServiceDetail(' + record.id + ');" class="service_name_check" type="checkbox" name="service_name_check" id="service_name_check_' + record.id + '" value="" ><div class="service_name_t" id="service_name_t">' + record.service_name + '</div></div>\
                                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" id="service_price_t" class="service_price_t"><div class="service_price_title">Rs.' + record.final_price + '</div></div>\
                                                        <div class="col-md-2 col-sm-12 col-xs-12" id="service_product_model"><div class="product_model_a" onclick="toggleserviceproduct(' +record.id + ')"><span id="select_p_' + record.id + '">0</span>/' + p_count + '</div></div><div>');

                                    
                                }
                            });
                        }
                    },
                });
            }
            var selectElement = document.getElementById("sup_category");
            for (var j = 0; j < selectElement.options.length; j++) {
                var optionValue = selectElement.options[j].value;
                if (default_category_ids.includes(optionValue)) {
                    selectElement.options[j].disabled = true;
                }
            }

            $("#sup_category").trigger("chosen:updated");
        }
    </script>

    <!-- check reminder service script -->

    <script>
        function checkreminderservice(service_id, date) {
            var service_data = <?php echo json_encode($service_list) ?>;
            var service_length = service_data.length;
            for (var i = 0; i < service_length; i++) {
                if (service_id == service_data[i].id) {
                    $('.memebership_expiry').append('</span>' + service_data[i].service_name + ' needs to be done on this time</span>');
                    $('.memebership_expiry').show();
                }

            }
        }
    </script>

    <!-- toggle add customer btn script -->

    <script>
        $(document).ready(function() {
            $(".add-customer-btn").click(function() {
                $(".customer-info-box").toggle();
            });
        });
        $(document).ready(function() {
            $(".time_slot").click(function() {
                $(".time-slot-box").toggle();
            });
        });
    </script>

    <!-- select service according to category script -->

    <script type="text/javascript">
        $("#sup_category").change(function() {
            $('#package_service_name').empty();
            $('.side_amount_bar').show();
            $('.no_data_side_amount').hide();
            $('#service_product_model').empty();
            // $('.package_detail_content').show();
            $('.amount_to_paid_title').show();
            $('.total_service_time').show();
            $('.service-payment-title').show();
            // $('.service_detail').empty();
            $('.reminder_box_input').show();
            $('.reminder_box').show();
            $('.confirm_btn_box').show();
            $('.t_s_a_title').show();
            $('.service-payment').show();
            $('.search_services_box').show();
            $('.service_detail_content_box').show();
            $('.default_service_detail_content_box').hide();
            $('#service_price_t').empty();
            // *************************
            $('#package_services').empty();
            $('.pacakge_detail_').empty();
            $('#pacakge_price_t').empty();
            $('#package_service_product').empty();
            $('.pacakge_service_tittle').empty();
            // $('.package-product-detail-box').html(" ");
            // $('.package_service_product_and_price').html(" ");
            // $('.service_product_payment').empty();
            
            var selected_services_id = $('#services_id').val();
            var category = <?php echo json_encode($category) ?>;
            var category_length = category.length;
            for (var z = 0; z < category_length; z++) {
                if (category[z].id == $('#sup_category').val()) {
                    $('#category_name_t').html(category[z].sup_category + '|' + category[z].sup_category_marathi);
                }
            }
            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>salon/Ajax_controller/get_service_details_for_booking_ajax",
                data: {
                    'sup_category': $('#sup_category').val(),
                },
                success: function(data) {
                    $('#service_category').val($('#sup_category').val());
                    var parsedData = JSON.parse(data);
                    if (parsedData.length > 0) {
                        parsedData.forEach(function(record) {

                            var currentValues = $('#search_array').val() || '';
                            currentValues += (currentValues.length > 0 ? ',' : '') + record.service_name;
                            $('#search_array').val(currentValues);

                            var p_count = 0;
                            for (var i = 0; i < record.product.length; i++) {
                                if (record.product[i] !== ',') {
                                    p_count++;
                                }
                            }
                            var flag = 0;
                            var ll_ss = selected_services_id.length;
                            for (var j = 0; j < ll_ss; j++) {
                                if (selected_services_id[j] !== ',') {
                                    var s_id = selected_services_id[j];
                                    if (s_id == record.id) {
                                        $("#service_sss").append('<div class="row"> <div class="col-md-6 col-sm-12 col-xs-12" id="package_service_name"><input checked onclick="showServiceDetail(' + record.id + ');" class="service_name_check" type="checkbox" name="service_name_check" id="service_name_check_' + record.id + '" value="" ><div class="service_name_t" id="service_name_t">' + record.service_name + '</div></div>\
                                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" id="service_price_t" class="service_price_t"><div class="service_price_title">Rs.' + record.final_price + '</div></div>\
                                                        <div class="col-md-2 col-sm-12 col-xs-12" id="service_product_model"><div class="product_model_a" onclick="toggleserviceproduct(' +record.id + ')"><span id="select_p_' + record.id + '">0</span>/' + p_count + '</div></div><div>');
                                        flag = 1;
                                    }
                                }
                            }
                            if (flag == 0) {
                                
                                $("#service_sss").append('<div class="row"> <div class="col-md-6 col-sm-12 col-xs-12" id="package_service_name"><input onclick="showServiceDetail(' + record.id + ');" class="service_name_check" type="checkbox" name="service_name_check" id="service_name_check_' + record.id + '" value="" ><div class="service_name_t" id="service_name_t">' + record.service_name + '</div></div>\
                                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" id="service_price_t" class="service_price_t"><div class="service_price_title">Rs.' + record.final_price + '</div></div>\
                                                        <div class="col-md-2 col-sm-12 col-xs-12" id="service_product_model"><div class="product_model_a" onclick="toggleserviceproduct(' +record.id + ')"><span id="select_p_' + record.id + '">0</span>/' + p_count + '</div></div></div>');
                            }
                        });
                    }

                },
            });
        });
    </script>

    <!-- add Product from chechbox  -->


    <script type="text/javascript">
        function toggleserviceproduct(service_id) {
            
            $(".service-product-content-main").show();
            $(".product-modal").modal('show');
            $('.product_detail_box').show();
            $('.package-product-detail-box').show();
            $('#product_name').empty();
            $('#product_price').empty();
            // $('#stylist').empty();
            $('#product_detail').empty();
            $('#product_price_name_id').empty();
            $('#product_price_name_id').empty();
            $('#total_product_amount').val('');
            $('#total_p_amount').val('');

            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>salon/Ajax_controller/get_product_details_for_booking_ajax",
                data: {
                    'service_id': service_id,
                },
                success: function(data) {
                    // $('.package-product-detail-box').empty();
                    var parsedData = JSON.parse(data);
                    if (parsedData.length > 0) {
                        parsedData.forEach(function(record) {
                            var product_l = record.product.length;
                            var product_data = <?php echo json_encode($product_list) ?>;
                            var product_length = product_data.length;

                            for (var i = 0; i < record.product.length; i++) {
                                for (var j = 0; j < product_length; j++) {
                                    if (record.product[i] !== ',') {
                                        if (record.product[i] == product_data[j].id) {
                                            var checked_id=0;

                                            var pp_ids=$('#products_id').val();
                                            var pp_ids_id = pp_ids.split(',');
                                            for (var p = 0; p < pp_ids.length; p++) {
                                                if(pp_ids_id[p] == product_data[j].id){
                                                    $('#product_price_name_id').append('<input checked id="p_price_check_' + record.product[i] + '" type="checkbox" onclick="showtotalamount(' + record.product[i] + ',' + service_id + ',' + product_data[j].selling_price + ',\'' + product_data[j].product_name + '\')" class="product_price_name_id"><br>');
                                                    $('#product_name').append(product_data[j].product_name + '<br>');
                                                    $('#product_price').append(product_data[j].selling_price + '<br>');
                                                    checked_id=1;
                                                }
                                                
                                            }

                                            if(checked_id==0){
                                                    $('#product_price_name_id').append('<input id="p_price_check_' + record.product[i] + '" type="checkbox" onclick="showtotalamount(' + record.product[i] + ',' + service_id + ',' + product_data[j].selling_price + ',\'' + product_data[j].product_name + '\')" class="product_price_name_id"><br>');
                                                    $('#product_name').append(product_data[j].product_name + '<br>');
                                                    $('#product_price').append(product_data[j].selling_price + '<br>');
                                                }
                                           
                                        }
                                    }
                                }
                            }
                        });
                    }
                },
            });
        }
    </script>


    <script>
        function open_service_stylist_list() {
           $('.service_stylist_list').toggle();
        }
    </script>

    <!-- showServiceDetail -->

    <script>
        function showServiceDetail(service_id) {
            $('.side_amount_bar').show();
            $('.service_detail_content').show();
            $('.service_detail').show();
            $('.no_data_side_amount').hide();
            // $('.package_detail_content').show();
            $('.amount_to_paid_title').show();
            $('.total_service_time').show();
            $('.service-payment-title').show();
            $('.reminder_box_input').show();
            $('.reminder_box').show();
            $('.confirm_btn_box').show();
            $('.t_s_a_title').show();
            $('.service-payment').show();
            // $('.search_services_box').show();
            $('.service_detail_content').show();
            var checkBox = document.querySelector('#service_name_check_' + service_id + '');

            if (checkBox.checked == false) {
                var currentValues = $('#services_id').val().split(',');
                var indexToRemove = currentValues.indexOf(service_id.toString());
                if (indexToRemove !== -1) {
                    currentValues.splice(indexToRemove, 1);
                }
                $('#services_id').val(currentValues.join(','));

                $('.service_detail_' + service_id).hide();
                $('#service_name_check_' + service_id).prop("checked", false);
                $.ajax({
                    type: "POST",
                    url: "<?= base_url(); ?>salon/Ajax_controller/get_product_details_for_booking_ajax",
                    data: {
                        'service_id': service_id,
                    },
                    success: function(data) {
                        var parsedData = JSON.parse(data);
                        if (parsedData.length > 0) {
                            parsedData.forEach(function(record) {
                                cancelService(service_id, record.final_price, record.service_duration);
                            });
                        }
                    }
                });
            } else {
                var currentValues = $('#services_id').val() || '';
                currentValues += (currentValues.length > 0 ? ',' : '') + service_id;
                $('#services_id').val(currentValues);
                $.ajax({
                    type: "POST",
                    url: "<?= base_url(); ?>salon/Ajax_controller/get_product_details_for_booking_ajax",
                    data: {
                        'service_id': service_id,
                    },
                    success: function(data) {
                        var parsedData = JSON.parse(data);
                        if (parsedData.length > 0) {
                            parsedData.forEach(function(record) {
                                totalserviceamount(record.final_price);
                                total_service_time(record.service_duration);
                                $('.service_detail').append('<div class="service_detail_' + service_id + '">\
                                                            <div class="service_detail_name" id="service_name_' + service_id + '">' + record.service_name + '</div>\
                                                            <div class="service_detail_price" id="service_price_t">Rs.' + record.final_price + '</div>\
                                                            <div class="form-group col-md-11 col-sm-6 col-xs-12 service_stylist_and_time">\
                                                            <div onclick="gettimeslotbycurrentshift(' + service_id + ')" class="service_detail_time_slot col-md-4 stylist_time_slot_' + service_id + '" id="stylist_time_slot_' + service_id + '"><i class="fa-solid fa-caret-down"></i> Time Slot</div>\
                                                            <input type="hidden" id="dummy_time_' + service_id + '">\
                                                            <input type="hidden" id="dummy_staff_' + service_id + '">\
                                                            <input type="hidden" id="dummy_date_' + service_id + '">\
                                                            <div class="service_detail_stylist_name col-md-7" id="stylist_name_t' + service_id + '">No Stylist Asign</div>\
                                                            <div class="gettime_by_shift-box" id="time_slot_box_' + service_id + '" style="display: none;"></div>\
                                                                <div class="cancel_service_btn col-md-1" id="cancel_service_btn_' + service_id + '"><i onclick="cancelService(' + service_id + ',' + record.final_price + ',' + record.service_duration + ')" class="fa-solid fa-xmark"></i></div>\
                                                        </div><div class="validation_message col-md-12" id="validation_message_'+service_id+'"></div></div>');

                                $('.service-payment').append('<div class="service_detail_payment_' + service_id + '"><div class="col-md-6 col-sm-12 col-xs-12">\
                                                                <span>' + record.service_name + '</span>\
                                                            </div>\
                                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"></div>\
                                                            <div class="col-md-2 col-sm-12 col-xs-12">\
                                                                <span class="ss_dd_ff">' + record.final_price + '.00</span>\
                                                            </div></div>');

                                var stylish_id = "<?php if(isset($_GET['staff_id'])){ echo $_GET['staff_id'];}?>"
                                var time_slot = "<?php if(isset($_GET['Time'])){ echo $_GET['Time'];}?>"
                                if(stylish_id !== "" && time_slot !==""){
                                    if($("#time_slot").val()==""){
                                        show_time_slot_on_feild(time_slot,service_id);
                                    }
                                    show_stylist_in_feild(stylish_id,service_id);
                                    $('.time-slot-content-main').hide();
                                }
                            });
                        }
                    },
                });
                $('.service_validation').hide();
                $('#booking_button').show();
            }
        }
    </script>

<input type="hidden" id="current_service_id">
<input type="hidden" id="current_time"> 

    <!-- show stylist by current shift -->

        <script>
                function showstylistbycurrentshift(service_id, time) {
                    $("#current_service_id").val(service_id);
                    $("#current_time").val(time);
                
                
                    $('#time_slot_box_' + service_id + '').empty();
                    $('.service_stylist_list').empty();
                    var book_date=$("#booking_date").val();
                    var shift_id=$("#selected_shift").val();
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url(); ?>salon/Ajax_controller/get_booking_by_time_and_date_ajax",
                        data: {
                            'date': book_date,
                            'time': time
                        },
                        success: function(data) {
                        
                            var parsedData = JSON.parse(data);
                            if (parsedData.length === 0) {
                                alert("Hello");
                                $('#staff_id').empty();
                                var emp_data = <?php echo json_encode($salon_employee_list) ?>;
                                var emp_length = emp_data.length;
                                var shift_data = <?php echo json_encode($shift_list) ?>;
                                var shift_length = shift_data.length;

                                var currentDate = new Date();
                                var hours = currentDate.getHours();
                                var minutes = currentDate.getMinutes();
                                var formattedHours = (hours < 10 ? "0" : "") + hours;
                                var formattedMinutes = (minutes < 10 ? "0" : "") + minutes;
                                var currentTime = formattedHours + ":" + formattedMinutes;
                                $("#time-slot").val(currentTime);

                                for (var k = 0; k < emp_length; k++) {
                                    var emp_service_l = emp_data[k].service_name.length;
                                    var service_emp_id = emp_data[k].service_name;
                                    var emp_shift_id = emp_data[k].shift_name;
                                    for (var n = 0; n < emp_service_l; n++) {
                                        if (service_emp_id[n] !== ',') {
                                            if (service_id == service_emp_id[n]) {
                                                for (var b = 0; b < shift_length; b++) {
                                                    if ((shift_data[b].shift_in_time <= currentTime) && (shift_data[b].shift_out_time >= currentTime)) {
                                                        $('#selected_shift').val(shift_data[b].id);
                                                        if (shift_data[b].id == emp_data[k].shift_name) {
                                                            alert(emp_data[k].shift_name);
                                                            $('.service_stylist_list').append('<div id="time_slot_box_' + service_id + '" onclick="show_stylist_in_feild(' + emp_data[k].id + ',' + service_id + ')" class="stylist_time_name_box">\
                                                                                            <div class="stylist_profile" style="background-image:url(<?= base_url('admin_assets/images/employee_profile/') ?>' + emp_data[k].profile_photo + ')"></div>\
                                                                                            <div class="stylist_full_name">' + emp_data[k].full_name + '</div>\
                                                                                        </div>');
                                                                
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            } 
                            else {
                                // if (parsedData.length > 0) {
                                    // parsedData.forEach(function(record) {
                                        // console.log(record);
                                        $('#staff_id').val("Select Stylist");
                                        $('#staff_id').empty();
                                        $('.service_stylist_list').empty();
                                        var emp_data = <?php echo json_encode($salon_employee_list) ?>;
                                        var emp_length = emp_data.length;
                                        var shift_data = <?php echo json_encode($shift_list) ?>;
                                        var shift_length = shift_data.length;

                                        var currentDate = new Date();
                                        var hours = currentDate.getHours();
                                        var minutes = currentDate.getMinutes();
                                        var formattedHours = (hours < 10 ? "0" : "") + hours;
                                        var formattedMinutes = (minutes < 10 ? "0" : "") + minutes;
                                        var currentTime = formattedHours + ":" + formattedMinutes;
                                        $("#time-slot").val(currentTime);

                                        for (var k = 0; k < emp_length; k++) {
                                         
                                            // if(record.time_slot == time){
                                            // var book_stylist_id=record.stylist;
                                            // console.log(book_stylist_id);
                                            // }
                                            var emp_service_l = emp_data[k].service_name.length;
                                            var service_emp_id = emp_data[k].service_name;
                                            var emp_shift_id = emp_data[k].shift_name;
                                            for (var n = 0; n < emp_service_l; n++) {
                                                if (service_emp_id[n] !== ',') {
                                                    if (service_id == service_emp_id[n]) {
                                                        if (shift_id == emp_data[k].shift_name) {
                                                           
                                                            $('.service_stylist_list').append('<div id="time_slot_box_' + service_id + '" onclick="show_stylist_in_feild(' + emp_data[k].id + ',' + service_id + ')" class="stylist_time_name_box">\
                                                                                                    <div class="stylist_profile" style="background-image:url(<?= base_url('admin_assets/images/employee_profile/') ?>' + emp_data[k].profile_photo + ')"></div>\
                                                                                                    <div class="stylist_full_name">' + emp_data[k].full_name + '</div>\
                                                                                                </div>');
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    // });
                                // }
                            }
                        }
                    });
                }
     </script>

        <!-- time slot  by dates -->
        <script> 
                $("#booking-date").change(function () {
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url(); ?>salon/Ajax_controller/get_booking_by_date_ajax",
                        data: {
                            'date': $('#booking-date').val(),
                        },
                        success: function(data) {
                            var parsedData = JSON.parse(data);
                            var tttt=0;
                            if (parsedData.length > 0) {
                                parsedData.forEach(function(record) {
                                    var service_id=$("#dummy-services_id").val();
                                    gettimeslotbycurrentshift(service_id);
                                });
                            } 
                        },
                    });
                });
        </script>

    <!-- get Product details script -->

    <script type="text/javascript">
        function showtotalamount(p_id, service_id, p_price, p_name) {
            $('.service_product_payment_title').show();
            $('.product_detail_name_title').show();
            $('.M_P_discount').show();
            $('.service_product_payment').show();
            // $('.total_product_amount_title').show();
            $('.t_p_a_title').show();

            var checkBox = document.querySelector('#p_price_check_' + p_id);

            if(checkBox.checked == true){

                var count_select = $('#select_p_' + service_id).html();
                count_select = parseInt(count_select, 10); 
                $('#select_p_' + service_id).html(count_select + 1);

                var priceAsInt = parseInt(p_price, 10);
                if (!isNaN(priceAsInt)) {
                    var currentTotal = parseInt($('#total_p_amount').val(), 10) || 0;
                    var newTotal = currentTotal + priceAsInt;
                    var total = newTotal.toFixed(2);
                    $('#total_p_amount').val(newTotal.toFixed(2));
                    $('#total_product_amount').val(newTotal.toFixed(2));
                    $('#total_product_amount_t').val(total);
                    $('#product-price').val(newTotal.toFixed(2));

                    calculate_product_discount();

                    $('.service_detail_name').show();
                    $('.service_product_and_price').show();

                    $('.service_product_and_price').append('<div class="product_detail_' + p_id + ' product_cc_ff"><div class="col-md-6">\
                                                           <div class="" id="product_detail_name_t">' + p_name + '</div>\
                                                        </div>\
                                                        <div class="col-md-5">\
                                                          <div class="service_product_price" id="product_detail_price_t">Rs.' + p_price + '</div>\
                                                        </div>\
                                                        <div class="col-md-1 cancel_product_btn">\
                                                           <i onclick="CancelProduct(' + p_price + ',' + p_id + ')" class="fa-solid fa-xmark"></i>\
                                                        </div></div>');
                    var current_p_id = $('#products_id').val();
                    var p_id_array;

                    if (current_p_id !== "") {
                        p_id_array = current_p_id.split(',');
                    } else {
                        p_id_array = [];
                    }

                    p_id_array.push(p_id);
                    var updated_p_id = p_id_array.join(',');
                    $('#products_id').val(updated_p_id);

                    $('.service_product_payment').append('<div class="product_detail_' + p_id + '">\
                                                        <div class="col-md-8 col-sm-12 col-xs-12">\
                                                            <span>' + p_name + '</span>\
                                                        </div>\
                                                        <div class="col-md-2 col-sm-12 col-xs-12"></div>\
                                                        <div class="col-md-2 col-sm-12 col-xs-12">\
                                                            <span class="fff-jjj-lll">' + p_price + '.00</span>\
                                                        </div>\
                                                    </div>');


                    $('.final-total-price-box').show();
                    var ttt = parseFloat($('#final-total').val()) || 0;
                    var parsedAmount = parseFloat(priceAsInt) || 0;
                    var ttt_total = parsedAmount + ttt;
                    $('#final-total').val(ttt_total);
                }
            } else {

                var count_select = $('#select_p_' + service_id).html();
                count_select = parseInt(count_select, 10); 
                $('#select_p_' + service_id).html(count_select -1);

                var priceAsInt = parseInt(p_price, 10);
                var currentTotal = parseInt($('#total_p_amount').val(), 10) || 0;
                var newTotal = currentTotal - priceAsInt;
                var total = newTotal.toFixed(2);
                $('#total_p_amount').val(newTotal.toFixed(2));
                CancelProduct(p_price,p_id)
            }
        }
    </script>


    <!-- calculate membership product discount  -->


    <script type="text/javascript">
        function calculate_product_discount() {

            var tt_ff_pp_price = parseInt($('#total_product_amount_t').val(), 10) || 0;
            var M_P_discount = $('#M_P_discount').val();
            var tt_service_amount = parseInt($('#total_final_amount').val());
            // console.log(tt_ff_pp_price);
            // console.log(M_P_discount);
            if (!isNaN(tt_service_amount)) {

                if ($('#m_discount_type').val() == 1) {

                    aa_pp = (parseFloat(tt_ff_pp_price) - M_P_discount);
                    wwww = (parseFloat(aa_pp) * (1 - 18 / 100));
                    $('#total_m_p_amount').val(parseFloat(aa_pp - tt_ff_pp_price).toFixed(2));
                    $('#tt_pp_aa').val(parseFloat(aa_pp).toFixed(2));
                    var jjj = parseFloat((aa_pp) + parseFloat(tt_service_amount));
                    $('#payble_price').val(parseFloat(aa_pp) + parseFloat(tt_service_amount).toFixed(2));
                    $('#ppp_aaa').html(parseFloat(aa_pp + tt_service_amount).toFixed(2));
                    $('#amount_to_paid').val(parseFloat(jjj));
                    calculate_gst_amount(jjj);

                } else if ($('#m_discount_type').val() == 0) {

                    aa_pp = (parseFloat(tt_ff_pp_price) * (1 - M_P_discount / 100));
                    wwww = (parseFloat(aa_pp) * (1 - 18 / 100));
                    $('#total_m_p_amount').val(parseFloat(aa_pp - tt_ff_pp_price).toFixed(2));
                    $('#tt_pp_aa').val(parseFloat(aa_pp).toFixed(2));
                    var jjj = parseFloat((aa_pp) + parseFloat(tt_service_amount));
                    $('#payble_price').val(parseFloat(aa_pp + tt_service_amount).toFixed(2));
                    $('#ppp_aaa').html(parseFloat(aa_pp+tt_service_amount).toFixed(2));
                    $('#amount_to_paid').val(parseFloat(jjj));
                    calculate_gst_amount(jjj);

                }
            }

        }
    </script>

    <!-- cancel product detail -->


    <script type="text/javascript">
        function CancelProduct(p_price, p_id) {

            var currentValues = $('#products_id').val().split(',');
            var indexToRemove = currentValues.indexOf(p_id.toString());
            if (indexToRemove !== -1) {
                currentValues.splice(indexToRemove, 1);
            }
            $('#products_id').val(currentValues.join(','));

            $('.product_detail_' + p_id).hide();
            $('.pacakge_product_detail_' + p_id).hide();
            $('#service_name_check_' + p_id).prop("checked", false);
            $('#packageproduct_check_' + p_id).prop("checked", false);

            var ttt_amount = parseFloat($('#total_product_amount_t').val());
            var newTotal = ttt_amount - parseFloat(p_price);

            $('#total_p_amount').val(newTotal.toFixed(2));
            $('#total_product_amount_t').val(newTotal.toFixed(2));
            $('#product-price').html(newTotal.toFixed(2));
            calculate_product_discount();

            if($('#products_id').val() == ''){
                $('.package_service_product_and_price').hide()
                $('.service_product_and_price').hide()
                $('.product_detail_name_title').hide()
                $('.product_detail_name').hide()
            }
        }
    </script>


    <!-- add time slot by Current shift script  -->

    <script>
        function gettimeslotbycurrentshift(service_id) {
            if(service_id == 0){
                $("#shift_name").prop('selectedIndex', 0);
                $(".time-slot-box-model-row").html('');
            }
            if(service_id !== 0){
                $(".time-slot-box-model-row").empty();
                $(".gettime_by_shift-box").empty();
                $(".stylist_imge_t").empty();
                $(".stylist_time_name_box").empty();
                $(".service_stylist_list").append(" ");
                $("#staff_id").val("");
                $("#time-slot").empty('');
                $("#dummy-services_id").val(service_id);
                $(".time-slot-content-main").show();
                $(".yyy-zzzz").hide(); 
               

                

                var shift_data = <?php echo json_encode($shift_list) ?>;
                var booking_data = <?php echo json_encode($booking_list) ?>;
                var booking_length = booking_data.length;
                var rule_data = <?php echo json_encode($single_rules) ?>;
                var shift_length = shift_data.length;
                var session_duration = parseFloat(rule_data.session_avg_duration);
                var session_stylist = parseFloat(rule_data.per_session_stylist);

                var book_date=$("#booking_date").val();

                var currentDate = new Date();
                var hours = currentDate.getHours();
                var minutes = currentDate.getMinutes();
                var formattedHours = (hours < 10 ? "0" : "") + hours;
                var formattedMinutes = (minutes < 10 ? "0" : "") + minutes;
                var currentTime = formattedHours + ":" + formattedMinutes;
                $("#time-slot").val(currentTime);

                    if($('#dummy_staff_'+service_id+'').val()!==""){
                        // $('#dummy_staff_'+service_id+'').val("");  
                        // $('#dummy_time_'+service_id+'').val("");  
                        $('#stylist_name_t'+service_id+'').html("No Stylist Asign");  
                        $('#stylist_time_slot_'+service_id+' span').html("Time:");  
                        cancel_time_and_stylist(service_id);
                    } 

                var s_time = $("#time_slot").val();
                var timeSlots = s_time.split(','); 

                var pacakge_id=$('#pacakge_id').val();
                if(pacakge_id== ""){
                    var selected_dummy_time=$('#dummy_time_'+ service_id +'').val();
                }
                else{
                var selected_dummy_time=$('#dummy_time_'+service_id+'_'+pacakge_id+'').val();
                }

                for (var k = 0; k < shift_length; k++) {
                    if(currentTime + session_duration <= shift_data[k].shift_out_time){
                        if ((shift_data[k].shift_in_time <= currentTime) && (shift_data[k].shift_out_time >= currentTime)) {
                            $('#selected_shift').val(shift_data[k].id);
                            $('.selected_shift').text(shift_data[k].shift_name);
                            var out_time = parseFloat(shift_data[k].shift_out_time);
                            var next_shift=0;
                            for (var slot_hour = formattedHours; slot_hour < out_time; slot_hour++) {
                                for (var slot_minute = 0; slot_minute < 60; slot_minute += session_duration) {
                                    const adjustedHour = slot_hour;
                                    const formattedHour = adjustedHour.toString().padStart(2, '0');
                                    const formattedMinute = slot_minute.toString().padStart(2, '0');
                                    const formattedTime = `${formattedHour}:${formattedMinute}`;
                                    var chair = 0;
                                    for (var p = 0; p < booking_length; p++) {
                                        if( booking_data[p].booking_date == book_date){
                                            if (formattedTime == booking_data[p].time_slot) {
                                            chair++;
                                            }
                                        }
                                    }
                                    if (currentTime < formattedTime) {
                                        next_shift=1;
                                        if (chair == session_stylist){
                                            $('.time-slot-box-model-row').append('<div class="col-md-2 col-sm-12 col-xs-12 time-slot-box-model slot_time_disabled"><b>' + formattedTime + '</b></div>');
                                        }
                                        else{
                                            var select=0;
                                            for (var t = 0; t < timeSlots.length; t++) {
                                                if(timeSlots[t] == formattedTime){
                                                    $('.time-slot-box-model-row').append('<div class="col-md-2 col-sm-12 col-xs-12 time-slot-box-model slot_time_disabled"><b>' + formattedTime + '</b></div>');
                                                        select=1;
                                                }
                                            }
                                            if(select==0){
                                                var findValue = ':'; 
                                                var replaceValue = '888888';
                                                var modifiedString = formattedTime.replace(findValue, replaceValue);
                                                modifiedString = $.trim(modifiedString);

                                                if(selected_dummy_time == formattedTime){
                                                    $('.time-slot-box-model-row').append('<div onclick="show_time_slot_on_feild('+modifiedString + ',' + service_id + ','+ shift_data[k].id +')" class="col-md-2 col-sm-12 col-xs-12 time-slot-box-model slot_time_disabled"><b>' + formattedTime + '</b>');
                                                }else{
                                                    $('.time-slot-box-model-row').append('<div onclick="show_time_slot_on_feild( '+modifiedString + ',' + service_id + ','+ shift_data[k].id +')" class="col-md-2 col-sm-12 col-xs-12 time-slot-box-model"><b>' + formattedTime + '</b>');
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                            if(next_shift == 0){
                                show_time_slot_next_shift_name(shift_data[k+1].id,service_id)
                            }
                        }
                    }
                }
            }
        }
    </script>


    <script>
            function show_time_slot_next_shift_name(shift_id,service_id) {
                    $(".time-slot-box-model-row").empty();
                    $(".gettime_by_shift-box").empty();
                    $(".stylist_imge_t").empty();
                    $(".stylist_time_name_box").empty();
                    $(".service_stylist_list").append(" ");
                    $("#staff_id").val("");
                    $("#time-slot").empty('');
                    $("#dummy-services_id").val(service_id);
                    $(".time-slot-content-main").show();
                    $(".yyy-zzzz").hide(); 

                    var s_time = $("#time_slot").val();
                    var timeSlots = s_time.split(',');

                    var booking_data = <?php echo json_encode($booking_list) ?>;
                    var booking_length = booking_data.length;
                    var rule_data = <?php echo json_encode($single_rules) ?>;
                    var session_duration = parseFloat(rule_data.session_avg_duration);
                    var session_stylist = parseFloat(rule_data.per_session_stylist);
                    var book_date=$("#booking_date").val();

                    var currentDate = new Date();
                    var hours = currentDate.getHours();
                    var minutes = currentDate.getMinutes();
                    var formattedHours = (hours < 10 ? "0" : "") + hours;
                    var formattedMinutes = (minutes < 10 ? "0" : "") + minutes;
                    var currentTime = formattedHours + ":" + formattedMinutes;
                    $("#time-slot").val(currentTime);
                    var pacakge_id=$('#pacakge_id').val();
                    if(pacakge_id== ""){
                        var selected_dummy_time=$('#dummy_time_'+ service_id +'').val(); 
                    }
                    else{
                    var selected_dummy_time=$('#dummy_time_'+service_id+'_'+pacakge_id+'').val();
                    }
                
                                $.ajax({
                                    type: "POST",
                                    url: "<?= base_url(); ?>salon/Ajax_controller/get_time_slot_by_shift_ajax",
                                    data: {
                                        'shift_name_id': shift_id,
                                    },
                                    
                                    success: function(data) { 
                                        var parsedData = JSON.parse(data);
                                        $('#selected_shift').val(parsedData.id);
                                        $('.selected_shift').text(parsedData.shift_name);
                                        var out_time = parseFloat(parsedData.shift_out_time);
                                        for (var slot_hour = formattedHours; slot_hour < out_time; slot_hour++) {
                                            for (var slot_minute = 0; slot_minute < 60; slot_minute += session_duration) {
                                                const adjustedHour = slot_hour;
                                                const formattedHour = adjustedHour.toString().padStart(2, '0');
                                                const formattedMinute = slot_minute.toString().padStart(2, '0');
                                                const formattedTime = `${formattedHour}:${formattedMinute}`;
                                                var chair = 0;
                                                for (var p = 0; p < booking_length; p++) {
                                                    if( booking_data[p].booking_date == book_date){
                                                        if (formattedTime == booking_data[p].time_slot) {
                                                        chair++;
                                                        }
                                                    }
                                                }
                                                if (currentTime < formattedTime) {
                                                    if (chair == session_stylist){
                                                        $('.time-slot-box-model-row').append('<div class="col-md-2 col-sm-12 col-xs-12 time-slot-box-model slot_time_disabled"><b>' + formattedTime + '</b></div>');
                                                    }
                                                    else{
                                                        var select=0;
                                                        for (var t = 0; t < timeSlots.length; t++) {
                                                            if(timeSlots[t] == formattedTime){
                                                                $('.time-slot-box-model-row').append('<div class="col-md-2 col-sm-12 col-xs-12 time-slot-box-model slot_time_disabled"><b>' + formattedTime + '</b></div>');
                                                                    select=1;
                                                            }
                                                        }
                                                        if(select==0){
                                                            var findValue = ':'; 
                                                            var replaceValue = '888888';
                                                            var modifiedString = formattedTime.replace(findValue, replaceValue);
                                                            modifiedString = $.trim(modifiedString);

                                                            if(selected_dummy_time == formattedTime){
                                                                $('.time-slot-box-model-row').append('<div onclick="show_time_slot_on_feild('+modifiedString + ',' + service_id + ','+ parsedData.id +')" class="col-md-2 col-sm-12 col-xs-12 time-slot-box-model slot_time_disabled"><b>' + formattedTime + '</b>');
                                                            }else{
                                                                $('.time-slot-box-model-row').append('<div onclick="show_time_slot_on_feild( '+modifiedString + ',' + service_id + ','+ parsedData.id +')" class="col-md-2 col-sm-12 col-xs-12 time-slot-box-model"><b>' + formattedTime + '</b>');
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                });
                        }
    </script>

    <!-- Stylist according to selected  shift -->

    <script>
        $(document).ready(function() {
            $("#stylist-feild-t").click(function() {
                $(".gettime_by_shift-box").toggle();
            });
        });

        function gettime_by_shift() {
            var selected_shift_id = $('#shift_name').val();
            var service_id = $("#dummy-services_id").val();
        $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>salon/Ajax_controller/get_service_selected_shift_ajax",
                data: {
                    'service_id': service_id,
                },
                success: function(data) {
                    var parsedData = JSON.parse(data);

                    var shift_data = <?php echo json_encode($shift_list) ?>;
                    var emp_data = <?php echo json_encode($salon_employee_list) ?>;
                    var rule_data = <?php echo json_encode($single_rules) ?>;

                    var emp_length = emp_data.length;
                    var shift_length = shift_data.length;
                    var session_duration = parseFloat(rule_data.session_avg_duration);


                    var currentDate = new Date();
                    var hours = currentDate.getHours();
                    var minutes = currentDate.getMinutes();
                    var formattedHours = (hours < 10 ? "0" : "") + hours;
                    var formattedMinutes = (minutes < 10 ? "0" : "") + minutes;
                    var currentTime = formattedHours + ":" + formattedMinutes;
                    $("#time-slot").val(currentTime);

                    for (var k = 0; k < shift_length; k++) {
                        if (selected_shift_id == shift_data[k].id) {
                            $('#selected_shift').val(selected_shift_id);
                            for (var j = 0; j < emp_length; j++) {
                                var l_service = emp_data[j].service_name.length;
                                for (var h = 0; h < l_service; h++) {
                                    if (emp_data[j].service_name[h] !== ',') {
                                        if (emp_data[j].service_name[h] == parsedData.id) {
                                            if (selected_shift_id == emp_data[j].shift_name) {
                                               
                                                $('.service_stylist_list').append('<div  onclick="show_stylist_in_feild(' + emp_data[j].id + ',' + service_id + ')" id="time_slot_box_' + service_id + ' stylist-after-dy">\
                                                                                    <div class="col-md-3">\
                                                                                    <div class="emp-img-box " style="background-image:url(<?= base_url('admin_assets/images/employee_profile/') ?>' + emp_data[j].profile_photo + ')"></div>\
                                                                                    </div>\
                                                                                <div class="col-md-8 stylist_name_box">' + emp_data[j].full_name + '</div>');
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }


                }
        });
        }
    </script>

    <!-- Time slot according to selected  shift -->

    <script>
        // function show_time_slot_by_shift_name(){
        $("#shift_name").change(function() {
            var currentDate = new Date();
            var day = currentDate.getDate();
            var month = currentDate.getMonth() + 1; 
            var year = currentDate.getFullYear();
            if (day < 10) {
                day = '0' + day;
            }
            if (month < 10) {
                month = '0' + month;
            }
            var formattedDate = day + '/' + month + '/' + year;

            var service_id = $("#dummy-services_id").val();
            
            $('.gettime_by_shift-box').empty();
            $('.service_stylist_list').empty();
            $('.service_stylist_list').hide();
            $("#staff_id").val("");
            $('#stylist-feild-t').html('No Stylist Asign');
            $('.stylist_time_slot_' + service_id + '').html('Time Slot');
            $('#stylist_name_t' + service_id + '').html('No Stylist Asign');

            var s_time = $("#time_slot").val();
            var timeSlots = s_time.split(',');

           

            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>salon/Ajax_controller/get_time_slot_by_shift_ajax",
                data: {
                    'shift_name_id': $('#shift_name').val(),
                },
                success: function(data) {
                    var booking_data = <?php echo json_encode($booking_list) ?>;
                    var booking_length = booking_data.length;
                    var rule_data = <?php echo json_encode($single_rules) ?>;
                    var session_duration = parseFloat(rule_data.session_avg_duration);
                    var session_stylist = parseFloat(rule_data.per_session_stylist);

                    $('#selected_shift').val($('#shift_name').val());
                    var parsedData = JSON.parse(data);
                    $('.time-slot-box-model-row').empty();
                    var currentDate = new Date();
                    var hours = currentDate.getHours();
                    var minutes = currentDate.getMinutes();
                    var formattedHours = (hours < 10 ? "0" : "") + hours;
                    var formattedMinutes = (minutes < 10 ? "0" : "") + minutes;
                    var currentTime = formattedHours + ":" + formattedMinutes;
                    var out_time = parseFloat(parsedData.shift_out_time);
                    var in_time = parseFloat(parsedData.shift_in_time);
                    var book_date=$("#booking_date").val();

                    for (var slot_hour = in_time; slot_hour < out_time; slot_hour++) {
                        for (var slot_minute = 0; slot_minute < 60; slot_minute += session_duration) {

                            const adjustedHour = slot_hour;
                            const formattedHour = adjustedHour.toString().padStart(2, '0');
                            const formattedMinute = slot_minute.toString().padStart(2, '0');
                            const formattedTime = `${formattedHour}:${formattedMinute}`;
                            var chair = 0;
                            for (var p = 0; p < booking_length; p++) {
                                if( booking_data[p].booking_date == book_date){
                                    if (formattedTime == booking_data[p].time_slot) {
                                    chair++;
                                    }
                                }
                            }

                            if(book_date !== formattedDate){
                                    if (chair == session_stylist){
                                        $('.time-slot-box-model-row').append('<div class="col-md-2 col-sm-12 col-xs-12 time-slot-box-model slot_time_disabled"><b>' + formattedTime + '</b></div>');
                                    }
                                    else{
                                        var select=0;
                                        for (var t = 0; t < timeSlots.length; t++) {
                                            if(timeSlots[t] == formattedTime){
                                                $('.time-slot-box-model-row').append('<div class="col-md-2 col-sm-12 col-xs-12 time-slot-box-model slot_time_disabled"><b>' + formattedTime + '</b></div>');
                                                select=1;
                                            }
                                        }
                                        if(select==0){
                                            var findValue = ':'; 
                                            var replaceValue = '888888';
                                            var modifiedString = formattedTime.replace(findValue, replaceValue);
                                            modifiedString = $.trim(modifiedString);
                                            $('.time-slot-box-model-row').append('<div onclick="show_time_slot_on_feild('+ modifiedString + ',' + service_id + ')" class="col-md-2 col-sm-12 col-xs-12 time-slot-box-model"><b>' + formattedTime + '</b></div>');
                                        }
                                    }
                            }
                            else{
                                if (currentTime < formattedTime) {
                                    if (chair == session_stylist){
                                        $('.time-slot-box-model-row').append('<div class="col-md-2 col-sm-12 col-xs-12 time-slot-box-model slot_time_disabled"><b>' + formattedTime + '</b></div>');
                                    }
                                    else{
                                        var select=0;
                                        for (var t = 0; t < timeSlots.length; t++) {
                                            if(timeSlots[t] == formattedTime){
                                                $('.time-slot-box-model-row').append('<div class="col-md-2 col-sm-12 col-xs-12 time-slot-box-model slot_time_disabled"><b>' + formattedTime + '</b></div>');
                                                select=1;
                                            }
                                        }
                                        if(select==0){
                                            var findValue = ':'; 
                                            var replaceValue = '888888';
                                            var modifiedString = formattedTime.replace(findValue, replaceValue);
                                            modifiedString = $.trim(modifiedString);
                                            $('.time-slot-box-model-row').append('<div onclick="show_time_slot_on_feild('+ modifiedString + ',' + service_id + ')" class="col-md-2 col-sm-12 col-xs-12 time-slot-box-model"><b>' + formattedTime + '</b></div>');
                                        }
                                    }
                                }
                            }
                        }
                    }
                    $('.time-slot-box-model-row').append('<input type="hidden" id="d_time_'+ service_id +'">')
                }
            });
        });
        // }
    </script>


    <!-- show selecetd time and stylist Title -->


    <script type="text/javascript">
        function show_time_slot_on_feild(selected_time_slot, service_id,shift_id) {
      
            var pacakge_id=$('#pacakge_id').val();
            if(pacakge_id == ""){
              
                selected_time_slot = String(selected_time_slot);
                var findValue = '888888'; 
                var replaceValue = ':';
                var modifiedString = selected_time_slot.replace(findValue, replaceValue);
                selected_time_slot = modifiedString;
            
                submittimefordatabase(service_id);
                $('#dummy_time_'+ service_id +'').val(selected_time_slot);

                if($('#dummy_time_'+ service_id +'').val() !==""){
                    show_time_slot_next_shift_name(shift_id,service_id); 
                }
            
                $('.yyy_zzzz').show();
                showstylistbycurrentshift(service_id, selected_time_slot);

                $('.stylist_time_slot_' + service_id + '').empty();
                $('.stylist_time_slot_' + service_id + '').append('<span>Time: ' + selected_time_slot + '</span>');
                $('.time-slot-box-model').filter(':contains("' + selected_time_slot + '")').css({
                    'background-color': 'red',
                    'color': 'white'
                });

                var time_slot_input = $('#time_slot');
                var current_value = time_slot_input.val();
                if (current_value.trim() !== "") {
                    current_value += ',';
                }
                time_slot_input.val(current_value + selected_time_slot);
            }else{

                selected_time_slot = String(selected_time_slot);alert(selected_time_slot);
                var findValue = '888888'; 
                var replaceValue = ':';
                var modifiedString = selected_time_slot.replace(findValue, replaceValue);
                selected_time_slot = modifiedString;
            
                submittimefordatabase(service_id);
                $('#dummy_time_'+service_id+'_'+pacakge_id+'').val(selected_time_slot);

                if($('#dummy_time_'+service_id+'_'+pacakge_id+'').val() !==""){
                    gettimeslotbycurrentshift(service_id);  
                }
            
                $('.yyy_zzzz').show();
                showstylistbycurrentshift(service_id, selected_time_slot);

                $('.stylist_time_slot_'+service_id+'_'+pacakge_id+'').empty();
                $('.stylist_time_slot_'+service_id+'_'+pacakge_id+'').append('<span>Time: ' + selected_time_slot + '</span>');
                $('.time-slot-box-model').filter(':contains("' + selected_time_slot + '")').css({
                    'background-color': 'red',
                    'color': 'white'
                });

                var time_slot_input = $('#time_slot');
                var current_value = time_slot_input.val();
                if (current_value.trim() !== "") {
                    current_value += ',';
                }
                time_slot_input.val(current_value + selected_time_slot);
            }

        }


        function show_stylist_in_feild(s_id, service_id) {  

            $('#dummy_date_'+service_id+'').val($("#booking-date").val());

            var book_date = $("#booking_date").val();
            var additionalDate = $("#booking-date").val();
            var concatenatedValue;
            if (book_date.trim() === "") {
                concatenatedValue = additionalDate;
            } else {
                concatenatedValue = book_date + "," + additionalDate;
            }
            $("#booking_date").val(concatenatedValue);

               

            var pacakge_id=$('#pacakge_id').val();
            if(pacakge_id == ""){
                $('#dummy_staff_'+ service_id +'').val(s_id);
                var emp_data = <?php echo json_encode($salon_employee_list) ?>;
                var emp_length = emp_data.length;
                for (var j = 0; j < emp_length; j++) {
                    if (emp_data[j].id == s_id) {
                        console.log(emp_data[j].full_name);
                        $('#stylist-feild-t').html(emp_data[j].full_name);
                        $('#staff_id').val(emp_data[j].full_name);
                        $('#stylist_name_t' + service_id + '').html('<img src="<?= base_url('admin_assets/images/employee_profile/') ?>' + emp_data[j].profile_photo + '">' + emp_data[j].full_name);
                        var ee_ss = $('#stylist').val();
                        $('#stylist').val(ee_ss + (ee_ss.length > 0 ? ',' : '') + emp_data[j].id);
                        $('.dummy_stylist_image').hide();
                        $('.stylist-profile-imge').html('<img src="<?= base_url('admin_assets/images/employee_profile/') ?>' + emp_data[j].profile_photo + '">');
                    }
                }
                $('.gettime_by_shift-box').hide();
                $('.service_stylist_list').hide();
                check_valiation()
            }else{
                $('#dummy_staff_'+service_id+'_'+pacakge_id+'').val(s_id);
                var emp_data = <?php echo json_encode($salon_employee_list) ?>;
                var emp_length = emp_data.length;
                for (var j = 0; j < emp_length; j++) {
                    if (emp_data[j].id == s_id) {
                        $('#stylist-feild-t').html(emp_data[j].full_name);
                        $('#staff_id').val(emp_data[j].full_name);
                        $('#stylist_name_t'+service_id+'_'+pacakge_id+'').html('<img src="<?= base_url('admin_assets/images/employee_profile/') ?>' + emp_data[j].profile_photo + '">' + emp_data[j].full_name);
                        var ee_ss = $('#stylist').val();
                        $('#stylist').val(ee_ss + (ee_ss.length > 0 ? ',' : '') + emp_data[j].id);
                        $('.stylist-profile-imge').html('<img src="<?= base_url('admin_assets/images/employee_profile/') ?>' + emp_data[j].profile_photo + '">');
                    }
                }
                $('.gettime_by_shift-box').hide();
                $('.service_stylist_list').hide();
                check_valiation()
            }    
        }

    </script>


    <!-- save time slot in input feild -->

    <script>
        function submittimefordatabase(service_id){

                var dummy_time=$('#dummy_time_'+ service_id +'').val();
                var time_slot=$("#time_slot").val();
                var timeSlots = time_slot.split(',');
                for (var t = 0; t < timeSlots.length; t++) {
                    if(timeSlots[t] == dummy_time){
                        timeSlots.splice(t, 1);
                        $("#time_slot").val(timeSlots.join(','));   
                        break;
                    }
                }
            
        }    
    </script>


    <!-- calculate Gst amount -->


    <script type="text/javascript">
        function calculate_gst_amount(price) {

            var store_data = <?php echo json_encode($store_profile) ?>;
            if(store_data !== null){
                for(var i=0;store_data.length;i++){
                    if (store_data[i].gst == 1) {
                        var gst_dd = (parseFloat(price) * (1 - 18 / 100).toFixed(2));
                        $('#service_gst_amount').val(parseFloat(price - gst_dd).toFixed(2));
                        var aaa = (parseFloat(price - gst_dd).toFixed(2));
                        var pppp = parseFloat(price) + parseFloat(aaa);
                        $('#gst_amount').val(parseFloat(price - gst_dd).toFixed(2));
                        $('#amount_to_paid').val(pppp.toFixed(2));
                    }
                }
            }
        }
    </script>

    <!-- Total service amount -->


    <script type="text/javascript">
        function totalserviceamount(amount) {
            var m_discount = $('#m_discount').val();
            var gift_discount = $('#gift_discount').val();

            var ttt_amount = $('#total-service-amount').val();
            var tt_pp_aa = $('#tt_pp_aa').val();
            var product_gst = parseFloat($('#product_gst_amount').val());
            $('#total-service-amount').val(parseFloat(amount) + parseFloat(ttt_amount));
            $('#total_service_amount_t').html((parseFloat(amount) + parseFloat(ttt_amount)).toFixed(2));
            $('#service_price').val(parseFloat(amount) + parseFloat(ttt_amount));
            $('#tt_ff_aa').val(parseFloat(amount) + parseFloat(ttt_amount));
            var pay_amount = $('#total-service-amount').val();
            var aa_pp = 0;
            var ffff = 0;
            if ($('#m_discount_type').val() == 1) {
                aa_pp = (parseFloat(pay_amount) - m_discount);

            } else if ($('#m_discount_type').val() == 0) {
                aa_pp = (parseFloat(pay_amount) * (1 - m_discount / 100));

            }

            if ($('#gift_discount_type').val() == 1) {
                ffff = (parseFloat(pay_amount) - gift_discount);

            } else if ($('#gift_discount_type').val() == 0) {
                ffff = (parseFloat(pay_amount) * (1 - gift_discount / 100));

            }
            $('#total_m_s_amount').val((aa_pp - pay_amount).toFixed(2));
            $('#gift_card_amount').val((ffff - pay_amount).toFixed(2));
            var hhhh = parseFloat((aa_pp + ffff) - pay_amount)
            var jjj = tt_pp_aa + hhhh;
            $('#payble_price').val(parseFloat(jjj).toFixed(2));
            $('#ppp_aaa').html(parseFloat(jjj).toFixed(2));
            $('#total_final_amount').val(parseFloat(jjj).toFixed(2));
            $('#amount_to_paid').val(parseFloat(jjj).toFixed(2));
            check_festival_offers(amount);
            calculate_gst_amount(jjj);
        }
    </script>


    <!-- cancel service detail -->


    <script type="text/javascript">
        function cancelService(service_id, amount, time) {

            var currentValues = $('#services_id').val().split(',');
            var indexToRemove = currentValues.indexOf(service_id.toString());
            if (indexToRemove !== -1) {
                currentValues.splice(indexToRemove, 1);
            }
            $('#services_id').val(currentValues.join(','));

            $('.service_detail_' + service_id).hide();
            $('.service_detail_payment_' + service_id).hide();
            var mm_kk = $('#total_final_amount').val();
            var m_discount = $('#m_discount').val();
            var services_m_discount = $('#total_m_s_amount').val();
            var gift_discount = $('#gift_discount').val();
            var g_d = $('#gift_card_amount').val();
            var payble_amount = $('#payble_price').val();

            if ($('#m_discount_type').val() == 1) {
                aa_pp = (parseFloat(amount) - m_discount);

            } else if ($('#m_discount_type').val() == 0) {
                aa_pp = (parseFloat(amount) * (1 - m_discount / 100));

            }
            var cccc = parseFloat(aa_pp) - parseFloat(amount);
            $('#total_m_s_amount').val((parseFloat(services_m_discount) - parseFloat(cccc)).toFixed(2));

            if ($('#gift_discount_type').val() == 1) {
                ffff = (parseFloat(amount) - gift_discount);

            } else if ($('#gift_discount_type').val() == 0) {
                ffff = (parseFloat(amount) * (1 - gift_discount / 100));
            }

            var vvvv = parseFloat(ffff) - parseFloat(amount);
            var gggg = parseFloat(ffff) + parseFloat(aa_pp);
            var bbbb = parseFloat(gggg) - parseFloat(amount)
            var jjjj = parseFloat(mm_kk) - parseFloat(bbbb);
            $('#gift_card_amount').val((parseFloat(g_d) - parseFloat(vvvv)).toFixed(2));
            $('#payble_price').val(parseFloat(payble_amount - (bbbb)).toFixed(2));
            $('#ppp_aaa').html(parseFloat(payble_amount- (bbbb)).toFixed(2));
            $('#total_final_amount').val(parseFloat(jjjj).toFixed(2));

            calculate_gst_amount(jjjj);

            $('#service_name_check_' + service_id).prop("checked", false);

            var ttt_amount = parseFloat($('#total-service-amount').val());
            var newTotal = ttt_amount - parseFloat(amount);

            $('#total-service-amount').val(newTotal.toFixed(2));
            $('#total_service_amount_t').html(newTotal.toFixed(2));
            $('#service_price').val(newTotal.toFixed(2));
            $('#tt_ff_aa').val(newTotal.toFixed(2));

            var ttt_ddd = parseInt($('#ttt-fff').val(), 10) || 0;
            var parsedTime = parseInt(time, 10);
            if (!isNaN(parsedTime)) {
                var final_ttt = ttt_ddd - parsedTime;
                $('#ttt-fff').val(final_ttt + "Min");
            }
            if($('#services_id').val() == ''){
                $('.service_detail_content').hide()
            }
            cancel_time_and_stylista(service_id);
           
         


        }
    </script>

 <!-- // time slot and stylist cancel -->

    <script>
        function cancel_time_and_stylist(service_id){
            var dummy_staff=$('#dummy_staff_'+ service_id +'').val();
            $('#dummy_staff_'+ service_id +'').val("");
            var staff=$("#stylist").val();
            var d_staff = staff.split(',');
            for (var s = 0; s < d_staff.length; s++) {
                if(d_staff[s] == dummy_staff){
                    d_staff.splice(s, 1);
                    $("#stylist").val(d_staff.join(','));   
                    break;
                }
            }

            var dummy_time=$('#dummy_time_'+ service_id +'').val();
            $('#dummy_time_'+ service_id +'').val("")
            var time_slot=$("#time_slot").val();
            var timeSlots = time_slot.split(',');
            for (var t = 0; t < timeSlots.length; t++) {
                if(timeSlots[t] == dummy_time){
                    timeSlots.splice(t, 1);
                    $("#time_slot").val(timeSlots.join(','));   
                    break;
                }
            }

            var dummy_date=$('#dummy_date_'+ service_id +'').val();
            $('#dummy_date_'+ service_id +'').val("");
            var date=$("#booking_date").val();
            var c_date = date.split(',');
            for (var d = 0; d < c_date.length; d++) {
                if(c_date[d] == dummy_date){
                    c_date.splice(d, 1);
                    $("#booking_date").val(c_date.join(','));   
                    break;
                }
            }
        }
    </script>



    <!-- get detail pacakge script -->

    <script type="text/javascript">
        $("#package_name").change(function() {
            $('.pacakge_validation').hide();
            $('#pacakge_id').val($('#package_name').val());
            $('.side_amount_bar').show();
            $('.reminder_box_input').show();
            $('.amount_to_paid_title').show();
            $('.confirm_btn_box').show();
            $('.reminder_box').show();
            $('.t_s_a_title').show();
            $('.total_service_time').show();
            $('.service_product_payment_title').show();
            $('.service-payment').show();
            $('.service-payment-title').show();
            $('.no_data_side_amount').hide();
            $('.package_detail_content').show();
            $('.packageservice_detail_content').show();
            $('.service_detail_content_title').show();
            $('#ttt-fff').val(0.00);
            $('#package_services').empty();
            $('.pacakge_detail_').empty();
            $('#pacakge_price_t').empty();
            $('#package_service_product').empty();
            $('.pacakge_service_tittle').empty();
            $('.package-product-detail-box').html(" ");
            $('.package_service_product_and_price').html(" ");
            $('.service_product_payment').empty();
            $('.service-payment').empty();
            $('#total_product_amount_t').empty();
            $('#total_service_amount_t').html(' ');
            $('#total_final_amount').val(0.00);
            $('#total_m_s_amount').val(0.00);
            $('#payble_price').val(0.00);
            $('#gst_amount').val(0.00);
            $('#total-service-amount').val(0.00);
            $('#amount_to_paid').val(0.00);

            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>salon/Ajax_controller/get_package_details_ajax",
                data: {
                    'package_name_id': $('#package_name').val(),
                },
                success: function(data) {
                    var parsedData = JSON.parse(data);
                    $('#total_service_amount_t').html(parsedData.amount);

                    calculateFinaltotalamount(parsedData.amount);
                    $('#tt_ff_aa').val(parsedData.amount);
                    var product_data = <?php echo json_encode($product_list) ?>;
                    var p_length = product_data.length;

                    var service_data = <?php echo json_encode($service_list) ?>;
                    var service_length = service_data.length;

                    $('.pacakge-box-detail').show();
                    $('#pacakage_name_t').html(parsedData.package_name);

                    p_product_l = parsedData.product_name.length;

                    service_P_l = parsedData.service_name.length;
                    var count = 0;

                    for (var k = 0; k < service_P_l; k++) {
                        if (parsedData.service_name[k] != ',') {
                            for (var l = 0; l < service_length; l++) {
                                if (service_data[l].id == parsedData.service_name[k]) {
                                    showpacakgeservices_auto(service_data[l].id, service_data[l].final_price);
                                    total_service_time(service_data[l].service_duration);
                                }
                            }
                        }
                    }

                    for (var j = 0; j < p_product_l; j++) {
                        if (parsedData.product_name[j] !== ',') {

                            for (var i = 0; i < p_length; i++) {
                                if (product_data[i].id == parsedData.product_name[j]) {
                                    // showtotalamount(product_data[i].id,service_id,product_data[i].selling_price ,product_data[i].product_name);
                                    var priceAsInt = parseInt(product_data[i].selling_price, 10);
                                    if (!isNaN(priceAsInt)) {
                                        var currentTotal = parseInt($('#total_p_amount').val(), 10) || 0;
                                        var newTotal = currentTotal + priceAsInt;
                                        var total = newTotal.toFixed(2);
                                        $('#total_p_amount').val(newTotal.toFixed(2));
                                        $('#total_product_amount').val(newTotal.toFixed(2));
                                        $('#total_product_amount_t').val(total);
                                        $('#product-price').val(newTotal.toFixed(2));

                                        // calculate_product_discount();
                                    }
                                    $('.package-product-detail-box').append('<div class="row"><div class="col-md-1 col-sm-6 col-xs-12" id="packageproduct_' + product_data[i].id +
                                        '"><input class="PP_Product" onclick="add_package_product(' + product_data[i].id + ',' + product_data[i].selling_price + ')" type="checkbox" id="packageproduct_check_' + product_data[i].id + '" checked></div>\
                                                                        <div class="col-md-6 col-sm-6 col-xs-12" id="packageproduct_name_' + product_data[i].id + '">' + product_data[i].product_name + '</div>\
                                                                        </div>');
                                    count++;
                                    add_package_product(product_data[i].id, product_data[i].selling_price);

                                }
                            }
                        }
                    }


                    for (var k = 0; k < service_P_l; k++) {
                        if (parsedData.service_name[k] != ',') {
                            for (var l = 0; l < service_length; l++) {
                                if (service_data[l].id == parsedData.service_name[k]) {
                                    $('.pacakge_detail_').append('<div class="">\
                                                                    <div class="col-md-6 col-sm-12 col-xs-12" id="package_service_name">\
                                                                        <div id="package_services"><input id="pacakge_service_check' + service_data[l].id + '" onclick="showpacakgeservices(' + service_data[l].id + ',' + service_data[l].final_price + ')" type="checkbox" checked> ' + service_data[l].service_name + '</div>\
                                                                    </div>\
                                                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" id="package_service_price">\
                                                                        <p id="pacakge_price_t">Rs. ' + service_data[l].final_price + '</p>\
                                                                    </div>\
                                                                    <div class="col-md-2 col-sm-12 col-xs-12" id="package_service_product"><p onclick="togglepackageproduct()"  class="package-product-model" onclick="">' + count + '/10</P></div>\
                                                                </div>');
                                }
                            }
                        }
                    }



                },
            });
        });
    </script>

    <script>
        function calculateFinaltotalamount(amount) {
            var m_discount = $('#m_discount').val();
            var gift_discount = $('#gift_discount').val();

            var ttt_amount = $('#total-service-amount').val();
            var product_gst = parseFloat($('#product_gst_amount').val());
            $('#total-service-amount').val(parseFloat(amount) + parseFloat(ttt_amount));
            // $('#total_service_amount_t').html(parseFloat(amount) + parseFloat(ttt_amount));
            $('#service_price').val(parseFloat(amount) + parseFloat(ttt_amount));
            $('#tt_ff_aa').val(parseFloat(amount) + parseFloat(ttt_amount));
            var pay_amount = $('#total-service-amount').val();
            var aa_pp = 0;
            var ffff = 0;
            if ($('#m_discount_type').val() == 1) {
                aa_pp = (parseFloat(pay_amount) - m_discount);

            } else if ($('#m_discount_type').val() == 0) {
                aa_pp = (parseFloat(pay_amount) * (1 - m_discount / 100));

            }

            if ($('#gift_discount_type').val() == 1) {
                ffff = (parseFloat(pay_amount) - gift_discount);

            } else if ($('#gift_discount_type').val() == 0) {
                ffff = (parseFloat(pay_amount) * (1 - gift_discount / 100));

            }
            $('#total_m_s_amount').val((aa_pp - pay_amount).toFixed(2));
            $('#gift_card_amount').val((ffff - pay_amount).toFixed(2));
            var hhhh = parseFloat((aa_pp + ffff) - pay_amount)
            $('#payble_price').val(parseFloat(hhhh).toFixed(2));
            $('#total_final_amount').val(parseFloat(hhhh).toFixed(2));
            $('#ppp_aaa').html(parseFloat(hhhh).toFixed(2));
            $('#amount_to_paid').val(parseFloat(hhhh).toFixed(2));
            calculate_gst_amount(hhhh);
        }
    </script>

    <!-- add services auto  -->


    <script>
        function showpacakgeservices_auto(service_id, price) {

            var current_p_id = $('#services_id').val();
            var S_id_array;
            if (current_p_id !== "") {
                S_id_array = current_p_id.split(',');
            } else {
                S_id_array = [];
            }
            S_id_array.push(service_id);
            var updated_p_id = S_id_array.join(',');
            $('#services_id').val(updated_p_id);
            $('.service_validation').hide();
            $('#booking_button').show();
            var pacakge_id=$('#pacakge_id').val();

            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>salon/Ajax_controller/get_product_details_for_booking_ajax",
                data: {
                    'service_id': service_id,
                },
                success: function(data) {
                    var parsedData = JSON.parse(data);
                    if (parsedData.length > 0) {
                        parsedData.forEach(function(record) {

                            $('.pacakge_service_tittle').append('<div class="row pacakge-services-t_' + record.id + '">\
                                                                        <div class="service_detail_name">' + record.service_name + '</div>\
                                                                        <div class="service_detail_price">Rs.' + record.final_price + '</div>\
                                                                        </div>\
                                                                    <div class="row package_stylist_and_time package_stylist_and_time_' + record.id + ' ">\
                                                                       <div onclick="gettimeslotbycurrentshift(' + record.id + ')" class="pacakge_detail_time_slot col-md-5 stylist_time_slot_'+service_id+'_'+pacakge_id+'"><i class="fa-solid fa-caret-down"></i> Time Slot</div>\
                                                                        <div class="service_detail_stylist_name col-md-5" id="stylist_name_t'+record.id+'_'+pacakge_id+'">No Stylist Asign</div>\
                                                                        <input type="hidden" id="dummy_staff_'+record.id+'_'+pacakge_id+'">\
                                                                        <input type="hidden" id="dummy_time_'+record.id+'_'+pacakge_id+'">\
                                                                        <div class="gettime_by_shift-box" id="time_slot_box_' + record.id + '" style="display: none;"></div>\
                                                                        <div class="cancel_pacakage_service_btn  col-md-2"><i onclick="cancel_pacakge_service(' + record.id + ')" class="fa-solid fa-xmark"></i></div>\
                                                                        <div class="col-md-12 error" id="validation_message_'+record.id+'_'+pacakge_id+'"></div></div>');

                            $('.service-payment').append('<div class="service_detail_' + service_id + '"><div class="col-md-8 col-sm-12 col-xs-12">\
                                                                    <p>' + record.service_name + '</p>\
                                                                </div>\
                                                                <div class="col-md-2 col-sm-12 col-xs-12"></div>\
                                                                <div class="col-md-2 col-sm-12 col-xs-12">\
                                                                    <span class="ss_dd_ff">' + record.final_price + '</span>\
                                                                </div></div>');

                        });
                    }
                },
            });
        }
    </script>

    <!-- add services by click on input -->

    <script>
        function showpacakgeservices(service_id, price) {

            var pacakge_id=$('#pacakge_id').val();
            var checkBox = document.querySelector('#pacakge_service_check' + service_id + '');

            if (checkBox.checked == false) {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url(); ?>salon/Ajax_controller/get_product_details_for_booking_ajax",
                    data: {
                        'service_id': service_id,
                    },
                    success: function(data) {
                        var parsedData = JSON.parse(data);
                        if (parsedData.length > 0) {
                            parsedData.forEach(function(record) {
                                cancel_pacakge_service(record.id, record.final_price, record.service_duration);
                            });
                        }
                    },
                });
            } else {
                $('.packageservice_detail_content').show();
                $('.service_detail_content_title').show();
                var current_p_id = $('#services_id').val();
                var S_id_array;
                if (current_p_id !== "") {
                    S_id_array = current_p_id.split(',');
                } else {
                    S_id_array = [];
                }
                S_id_array.push(service_id);
                var updated_p_id = S_id_array.join(',');
                $('#services_id').val(updated_p_id);

                $.ajax({
                    type: "POST",
                    url: "<?= base_url(); ?>salon/Ajax_controller/get_product_details_for_booking_ajax",
                    data: {
                        'service_id': service_id,
                    },
                    success: function(data) {
                        var parsedData = JSON.parse(data);
                        if (parsedData.length > 0) {
                            parsedData.forEach(function(record) {
                                total_service_time(record.service_duration);

                                $('.pacakge_service_tittle').append('<div class="row pacakge-services-t_' + record.id + '">\
                                                                    <div class="service_detail_name">' + record.service_name + '</div>\
                                                                    <div class="service_detail_price">Rs.' + record.final_price + '</div>\
                                                                    </div>\
                                                                <div class="row package_stylist_and_time package_stylist_and_time_' + record.id + ' ">\
                                                                   <div onclick="gettimeslotbycurrentshift(' + record.id + ')" class="pacakge_detail_time_slot col-md-5 stylist_time_slot_'+service_id+'_'+pacakge_id+'"><i class="fa-solid fa-caret-down"></i> Time Slot</div>\
                                                                    <div class="service_detail_stylist_name col-md-5" id="stylist_name_t'+record.id+'_'+pacakge_id+'">No Stylist Asign</div>\
                                                                    <input type="hidden" id="dummy_staff_'+record.id+'_'+pacakge_id+'">\
                                                                        <input type="hidden" id="dummy_time_'+record.id+'_'+pacakge_id+'">\
                                                                    <div class="cancel_pacakage_service_btn  col-md-2"><i onclick="cancel_pacakge_service(' + record.id + ')" class="fa-solid fa-xmark"></i></div>\
                                                                    <div class="col-md-12 error" id="validation_message_'+record.id+'_'+pacakge_id+'"></div></div>');

                                $('.service-payment').append('<div class="service_detail_' + service_id + '"><div class="col-md-6 col-sm-12 col-xs-12">\
                                                                <p>' + record.service_name + '</p>\
                                                            </div>\
                                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"></div>\
                                                            <div class="col-md-2 col-sm-12 col-xs-12">\
                                                                <span class="ss_dd_ff">' + record.final_price + '</span>\
                                                            </div></div>');

                            });
                        }
                    },
                });
            }
        }

        function total_service_time(time) {
            var ttt_ddd = parseInt($('#ttt-fff').val(), 10) || 0;
            var parsedTime = parseInt(time, 10);
            if (!isNaN(parsedTime)) {
                var final_ttt = ttt_ddd + parsedTime;
                $('#ttt-fff').val(final_ttt + "Min");
            }
        }
    </script>


    <!-- pacakage product total amount -->

    <script type="text/javascript">
        function add_package_product(p_id, price) {
            var checkBox = document.querySelector('#packageproduct_check_' + p_id + '');
            
            if (checkBox.checked == true) {
                $('.service_product_payment').show();
                var current_p_id = $('#products_id').val();
                var p_id_array;
                if (current_p_id !== "") {
                    p_id_array = current_p_id.split(',');
                } else {
                    p_id_array = [];
                }
                p_id_array.push(p_id);
                var updated_p_id = p_id_array.join(',');
                $('#products_id').val(updated_p_id);

                $(".product_detail_name").show()
                $(".package_service_product_and_price").show()
                var ttt = $('#total-package-product-amount').val();
                ttt = isNaN(parseFloat(ttt)) ? 0 : parseFloat(ttt);

                var product_data = <?php echo json_encode($product_list) ?>;
                var p_length = product_data.length;
                for (var j = 0; j < p_length; j++) {
                    if (p_id == product_data[j].id) {
                        var p_name = product_data[j].product_name;
                    }
                }
                $('.package_service_product_and_price').append('<div class="pacakge_product_detail_' + p_id + '"><div class="col-md-6">\
                                                        <div class="">' + p_name + '</div>\
                                                    </div>\
                                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">\
                                                        <div class="service_product_price">' + price + '</div>\
                                                    </div>\
                                                    <div class="col-md-2">\
                                                       <i onclick="cancel_pacakge_product(' + price + ',' + p_id + ')" class="fa-solid fa-xmark cancel-pacakge-product-btn"></i>\
                                                    </div>');

                $('.service_product_payment').append('<div class="product_detail_' + p_id + '">\
                                                        <div class="col-md-8 col-sm-12 col-xs-12">\
                                                            <span>' + p_name + '</span>\
                                                        </div>\
                                                        <div class="col-md-2 col-sm-12 col-xs-12"></div>\
                                                        <div class="col-md-2 col-sm-12 col-xs-12">\
                                                            <span class="fff-jjj-lll">' + price + '</span>\
                                                        </div>\
                                                    </div>');

            }else{
                cancel_pacakge_service(price,p_id);
            }
        }
    </script>

    <!-- cancel pacakge service -->

    <script type="text/javascript">
        function cancel_pacakge_product(p_price, p_id) {
            var currentValues = $('#products_id').val().split(',');
            var indexToRemove = currentValues.indexOf(p_id.toString());
            if (indexToRemove !== -1) {
                currentValues.splice(indexToRemove, 1);
            }
            $('#products_id').val(currentValues.join(','));

            $('.product_detail_' + p_id).hide();
            $('.product_detail_' + p_id).hide();
            $('.pacakge_product_detail_' + p_id).hide();
            $('#packageproduct_check_' + p_id).prop("checked", false);

            if($('#products_id').val() == ''){
                $('.package_service_product_and_price').hide()
                $('.product_detail_name').hide()
            }
            // if(($('#services_id').val() == '') && ($('#products_id').val() == '')){
            //     $('.packageservice_detail_content').hide()
            //     $('.service_detail_content_title').hide()
            // }
            
          
        }
    </script>

    
    <script type="text/javascript">
        function cancel_pacakge_service(service_id) {
            var currentValues = $('#services_id').val().split(',');
            var indexToRemove = currentValues.indexOf(service_id.toString());
            if (indexToRemove !== -1) {
                currentValues.splice(indexToRemove, 1);
            }
            $('#services_id').val(currentValues.join(','));

            $('.pacakge-services-t_'+service_id).hide();
            $('.package_stylist_and_time_'+service_id).hide();
            $('#pacakge_service_check'+service_id).prop("checked", false);

            if($('#services_id').val() == ''){
                $('.hhh_ccc_span').hide()
                $('.packageservice_detail_content').hide()
                $('.service_detail_content_title').hide()
            }
          
            
          
        }
    </script>

    <!-- nav bar active script -->

    <script>
        $(document).ready(function() {
            $('#booking_management .child_menu').hide();
            $('#booking_management').addClass('nv active');
            // $('.right_col').addClass('active_right');
            $('.add_new_booking').addClass('active_cc');
        });
    </script>

    <!-- time slot model toggle cancel -->


    <script type="text/javascript">
        function togglePopup() {
            $(".time-slot-content-main").toggle();
        }
    </script>

    <script type="text/javascript">
        function togglepackageproduct() {
            $(".package-product-content-main").toggle();
        }
    </script>

 <!-- Selected Date get  offer duration -->

<script>
        function check_festival_offers(amount) {
            $(".time-slot-box-model-row").html('');
            var book_date = $("#booking-date").val();
            var offers_data = <?php echo json_encode($offers_list) ?>;
            var offer_length = offers_data.length;

            for (var i = 0; i < offer_length; i++) {
                var dateString = offers_data[i].created_on;
                var offer_end = offers_data[i].duration;
                var offer_end_number = offer_end * 7;

                var end_date = new Date(dateString);
                end_date.setDate(end_date.getDate() + offer_end_number);
                var end = formatDate(end_date);

                var start_date = new Date(dateString);
                var start = formatDate(start_date);

                if ((book_date >= start) && (book_date <= end)) {
                    if (offers_data[i].discount_in == 0) {
                        $('.offers_discount_box').html('<div class="col-md-7 col-sm-12 col-xs-12">\
                                                        <span class="span_title_side_bar">' + offers_data[i].offers_name + ' Offers (Rs.'+offers_data[i].discount +')</span>\
                                                    </div>\
                                                    <div class="col-md-3 col-sm-12 col-xs-12"></div>\
                                                    <div class="col-md-2 col-sm-12 col-xs-12 payable_amount">\
                                                        <p style="margin-left: -10px;">-<span class="offer_discount"></span></p>\
                                                    </div>');
                      
                        var tt_ff_price=$('#total_final_amount').val();
                        var total_amount = $('#total-service-amount').val();
                        var  ff_amount = total_amount - offers_data[i].discount;
                        $('.offer_discount').text(parseFloat(total_amount)-parseFloat(ff_amount).toFixed(2));
                        $('#offer_discount').val(parseFloat(total_amount)-parseFloat(ff_amount).toFixed(2));
                        var offer_d = parseFloat(total_amount)-parseFloat(ff_amount).toFixed(2);
                        $('#payble_price').val(parseFloat(ff_amount-offer_d).toFixed(2));
                    } else {
                        $('.offers_discount_box').html(' <div class="col-md-7 col-sm-12 col-xs-12">\
                                                        <span class="span_title_side_bar">' + offers_data[i].offers_name + ' Offers ('+offers_data[i].discount +'%)</span>\
                                                    </div>\
                                                    <div class="col-md-3 col-sm-12 col-xs-12"></div>\
                                                    <div class="col-md-2 col-sm-12 col-xs-12 payable_amount">\
                                                       <p style="margin-left: -10px;">-<span class="offer_discount"></span></p>\
                                                    </div>');
                        var tt_ff_price=$('#total_final_amount').val();
                        var total_amount = $('#total-service-amount').val();
                        var ff_amount = total_amount - (total_amount * (offers_data[i].discount / 100));
                        $('.offer_discount').text(parseFloat(total_amount-ff_amount).toFixed(2));
                        $('#offer_discount').val(parseFloat(total_amount-ff_amount).toFixed(2));
                        var offer_d = parseFloat(total_amount)-parseFloat(ff_amount).toFixed(2);
                        $('#payble_price').val(parseFloat(ff_amount-offer_d).toFixed(2));

                    }
                } 
            }
            $("#ui-datepicker-div").hide();
        }

        function formatDate(date) {
            if (!(date instanceof Date) || isNaN(date)) {
                console.error('Invalid date:', date);
                return 'Invalid Date';
            }
            var day = date.getDate();
            var month = date.getMonth() + 1;
            var year = date.getFullYear();
            if (day < 10) {
                day = '0' + day;
            }

            if (month < 10) {
                month = '0' + month;
            }

            return day + '/' + month + '/' + year;
        }
</script>

       <!-- product model open script  -->

    <!-- <script>
        function showProductModal(service_id) {
            $(".product-modal").modal('show');
            $('.product_detail_box').show();
            $('#product_name').empty();
            $('#product_price').empty();
            // $('#stylist').empty();
            $('#product_detail').empty();
            $('#total_product_amount').val('');
            $('#total_p_amount').val('');


            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>salon/Ajax_controller/get_product_details_for_booking_ajax",
                data: {
                    'service_id': service_id,
                },
                success: function(data) {
                    $('#product_price_name_id').empty();
                    var parsedData = JSON.parse(data);
                    // console.log(parsedData);
                    if (parsedData.length > 0) {
                        parsedData.forEach(function(record) {
                            var product_l = record.product.length;
                            var product_data = <?php echo json_encode($product_list) ?>;
                            var product_length = product_data.length;

                            for (var i = 0; i < record.product.length; i++) {
                                var productId = record.product[i];
                                var productIndex = product_data.findIndex(product => product.id == productId);
                                if (productIndex !== -1) {
                                    var productName = product_data[productIndex].product_name;
                                    var productPrice = product_data[productIndex].selling_price;
                                    $('#product_price_name_id').append('<input id="p_price_check_' + service_id + '" type="checkbox" onclick="showtotalamount(' + record.product[i] + ',' + service_id + ',' + productPrice + ',\'' + productName + '\')" class="product_price_name_id"><br>');
                                    $('#product_name').append(productName + '<br>');
                                    $('#product_price').append(productPrice + '<br>');
                                }
                            }
                        });
                    }
                },
            });
        }
    </script> -->