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
  
    #shift_name_chosen{
        border: 0px !important;
    }

    
</style>


<div class="right_col salon_booking_area" role="main">
<?php
        if($gst == ""){?>
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
        <?php }else{?>
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
                                        <input autocomplete="off" maxlength="10" type="text" class="form-control" name="phone" id="phone" placeholder="Search by mobile number"><a class="search-icon" href="#"><i class="fa fa-search"></i></a>
                                        <div id="phone_not_found" style="display:none; color: red;"></div>
                                    </div>
                                    <div class="customer-info-by-search">
                                      <div></div>
                                    </div>
                                </div>
                            </div>
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
                                <div class="col-md-12 memebership_expiry" style="display: none;">
                                </div>
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
                        </div>
                    </div>
                </div>

                <!-- middel bar service info -->

                <div class="col-md-5 col-sm-12 col-xs-12 no_data_middle">
                    <div class="x_panel height-300"  >
                        <div class="x_content">
                            <div class="container">
                                <div class="third_bar">
                                    <img src="<?=base_url()?>admin_assets/images/no_data/no_data.png">
                                </div> 
                            </div> 
                        </div> 
                    </div> 
                </div>

                <div class="col-md-5 col-sm-12 col-xs-12 middle_bar" style="display: none;">
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
                                                                        <option value="<?= $category_result->id ?>" <?php if (!empty($single) && $single->sup_category == $category_result->id) { ?>selected="selected" <?php } ?>><?= $category_result->sup_category ?>/<?= $category_result->sup_category_marathi ?></option>
                                                                <?php }
                                                                } ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group row search_services_box" style="display: none;">
                                                            <input class="form-control" type="text" name="search_services" id="search_services" value="" placeholder="Search services by service name"><a class="service-search-icon" href="#"><i class="fa fa-search"></i></a>
                                                        </div>
                                                        <div class="row">
                                                            <div class="service_detail_content_box" style="display: none;">
                                                                <div class="col-md-8 col-sm-12 col-xs-12">
                                                                    <div class="title_c" id="category_name_t"></div>
                                                                </div>
                                                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                                    <div class="title_c">Product</div>
                                                                </div>
                                                               <div class="hr_l"></div>
                                                                <div class="">
                                                                    <div class="col-md-6 col-sm-12 col-xs-12" id="package_service_name">
                                                                      
                                                                    </div>
                                                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" id="service_price_t" class="service_price_t"></div>
                                                                    <div class="col-md-2 col-sm-12 col-xs-12" id="service_product_model"></div>
                                                                    <div class="clearfix"></div>
                                                                </div> 
                                                            </div>
                                                        </div><br>
                                                        <div class="row">
                                                            <div class="form-group col-md-12 col-sm-12 col-xs-12 service_detail_content" style="display: none;">
                                                               <div class="service_detail"></div>

                                                                  <div class="service_detail_name" style="display: none;">Selected Product</div>
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
                                                                        <option value="<?= $package_list_result->id ?>" <?php if (!empty($single) && $single->package_name == $package_list_result->id) { ?>selected="selected" <?php } ?>><?= $package_list_result->package_name ?></option>
                                                                <?php }
                                                                } ?>
                                                            </select>
                                                        </div>
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
                                                    <div class="row service_detail_content" style="display: none;">
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
                    <div class="x_panel height-300" >
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
                                <div class="row">
                                    <div class="col-md-7 col-sm-12 col-xs-12">
                                        <input type="hidden" id="m_discount">
                                        <input type="hidden" id="M_P_discount" placeholder="yyy">
                                        <input type="hidden" id="m_discount_type">
                                        <input type="hidden" id="gift_discount">
                                        <input type="hidden" id="gift_discount_type">
                                        <span class="span_title_side_bar">Payble Amount:<span id="ppp_aaa"></span></span>
                                    </div>
                                    <div class="col-md-5 col-sm-12 col-xs-12 total_service_time" style="display: none;">
                                        <input type="text" id="ttt-fff" readonly>
                                        <span class="span_title_side_bar">Duration:</span>
                                    </div>
                                </div>
                                <hr class="break_line">
                                <div class="row service-payment-title" style="display: none;">
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
                                <div class="row service_product_payment" style="display: none;">
                                   
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
                                        <span class="span_title_side_bar" id="total_service_amount_t">0.00</span>
                                    </div>
                                </div>
                                <div class="row t_p_a_title" style="display: none;">
                                    <div class="col-md-7 col-sm-12 col-xs-12">
                                        <span class="span_title_side_bar">Total Product Amount</span>
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
                                </div><hr class="break_line">
                                <div class="row total_payable_amount" style="display: block;">
                                    <div class="col-md-7 col-sm-12 col-xs-12">
                                      <span class="span_title_side_bar">Payable Amount</span> 
                                    </div>
                                    <div class="col-md-3 col-sm-12 col-xs-12"></div>
                                    <div class="col-md-2 col-sm-12 col-xs-12 payable_amount">
                                       <input type="text" id="payble_price" placeholder="0.00" readonly> 
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
                                    <input type="text" id="gst_amount" placeholder="0.00" readonly> 
                                    </div>
                                </div><hr class="break_line">
                                <div class="row amount_to_paid_title" style="display: none;">
                                    <div class="col-md-7 col-sm-12 col-xs-12">
                                      <span class="span_title_side_bar">Amount to Paid</span> 
                                    </div>
                                    <div class="col-md-3 col-sm-12 col-xs-12"></div>
                                    <div class="col-md-2 col-sm-12 col-xs-12 payable_amount">
                                       <input type="text" id="amount_to_paid" placeholder="0.00" readonly> 
                                    </div>
                                </div>
                                <form method="post" name="booking_form" id="booking_form" enctype="multipart/form-data">
                                <div class="row reminder_box_input" style="display: none;">
                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                        <textarea type="text" class="form-control" name="note" id="note" placeholder="Add Note"></textarea>
                                    </div>
                                </div><br>
                                <div class="row reminder_box"  style="display: none;">
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
                                            <input type="text" readonly id="customer_name" name="customer_name">    
                                            <input type="text" readonly id="service_category" name="service_category">    
                                            <input type="text" readonly name="services" id="services_id">
                                            <input type="text" readonly name="pacakge_id" id="pacakge_id">
                                            <input type="text" readonly name="products_id" id="products_id">
                                            <input type="text" readonly name="time_slot" id="time_slot">
                                            <input type="text" readonly name="stylist" id="stylist">
                                            <input type="text" readonly name="service_price" id="service_price">
                                            <input type="text" readonly name="product_price" id="product-price">
                                            <input type="text" readonly name="booking_date" id="booking_date">
                                            <input type="text" readonly name="selected_shift" id="selected_shift">
                                    </div>
                                    <div class="row confirm_btn_box"  style="display: none;">
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <button class="btn btn-info" style="width: 350px;" name="booking_button" value="booking_button">Confirm Booking</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


           <?php }?>
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
                     <input autocomplete="off" type="text" name="booking-date" id="booking-date" placeholder="dd/mm/yy">
                   </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 time-slot-date-row">
                <div class="time-slot-date">
                   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 5px">
                   <select onchange="gettime_by_shift()" class="form-select chosen-select" name="shift_name" id="shift_name">
                        <option value="" class="">Select Shift</option>
                            <?php if (!empty($shift_list)) {
                            foreach ($shift_list as $shift_list_result) { ?>
                                <option value="<?= $shift_list_result->id ?>" <?php if (!empty($single) && $single->shift_name == $shift_list_result->id) { ?>selected="selected" <?php } ?>><?= $shift_list_result->shift_name ?></option>
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
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 15px;"></div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div onclick="togglePopup()" class="close_time_slot_Model btn btn-primary">Save</div>
                <div onclick="togglePopup()" class="btn btn-danger">Close</div>
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
                            <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Enter full name">
                        </div>
                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <label>Phone Number <b class="require">*</b></label>
                            <input type="text" class="form-control" name="customer_phone" id="customer_phone" placeholder="Enter phone number">
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                            <label>Select Gender<b class="require">*</b></label>
                            <select class="form-select form-control" name="gender" id="gender">
                                <option value="" class="">Select Gender</option>
                                <option value="0" class="">Male</option>
                                <option value="1" class="">Female</option>
                            </select>
                        </div>
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
                            <input type="text" class="form-control" name="DOA" id="DOA" placeholder="DD/MM/YY">
                        </div>
                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <label>Date Of Brith</label>
                            <input type="text" class="form-control" name="dob" id="dob" placeholder="DD/MM/YY">
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                <label>State</label>
                                <select class="form-select form-control" name="state"
                                    id="state">
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
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <button onclick="get_customer_model()" class="btn btn-primary" type="submit" name="customer_button" value="customer_button">Save</button>
                        </div>
                        <div onclick="open_customer_model()" class="col-md-1 close_time_slot_Model btn btn-danger">Close</div>
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
                <div class="row package-product-detail-box">
                    <div class="col-md-2 col-sm-6 col-xs-12" name="product_price_name_id" id="product_price_name_id"></div>
                    <div class="col-md-5 col-sm-6 col-xs-12" name="product_name" id="product_name"></div>
                    <div class="col-md-5 col-sm-6 col-xs-12" name="product_price" id="product_price"></div>
                </div>
                <div class="row">
                        <div class="col-md-4 col-sm-6 col-xs-12" name="product_price_name_id" id="product_price_name_id" style="float: right;">
                            <label>Total Product Price</label>
                            <input type="text" placeholder="0.00" name="total_p_amount" id="total_p_amount" class="form-control ssff">
                        </div>
                    </div>
                <hr>
            <div class="row">
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
<script>
    $(document).ready(function () {
    var pageName = window.location.pathname.split('/').pop();
    var parts = pageName.split('/');
    var slot_time = parts[0];
    $("#time_slot").val(slot_time);
});
</script>

<script>
    function getstylistservices() {
        var stylist_service_data = <?php echo json_encode($stylist_services_list) ?>;
        $("#stylist").val(stylist_service_data.id);
        
        var currentDate = new Date();
        var formattedDate = currentDate.toLocaleDateString('en-GB', {
            day: 'numeric',
            month: 'numeric',
            year: 'numeric'
        });
        $("#booking_date").val(formattedDate);

        var ss_ll=stylist_service_data.service_name.length;
        var service_data = <?php echo json_encode($service_list) ?>;
        var service_l=service_data.length;
        $('#package_service_name').empty();
        $('.side_amount_bar').show();
        $('.no_data_side_amount').hide();
        $('#service_product_model').empty();
        $('.package_detail_content').show();
        $('.amount_to_paid_title').show();
        $('.total_service_time').show();
        $('.service-payment-title').show();
        // $('.total_final_amount_title').show();
        $('.reminder_box_input').show();
        $('.reminder_box').show();
        $('.confirm_btn_box').show();
        $('.t_s_a_title').show();
        $('.service-payment').show();
        $('.search_services_box').show();
        $('.service_detail_content_box').show();
        $('#service_price_t').empty();
        for(var j=0;j<ss_ll;j++){
            if(stylist_service_data.service_name[j] !== ','){
                for(var i=0;i<service_l;i++){
                    if(service_data[i].id==stylist_service_data.service_name[j]){
                        $('#package_service_name').append('<input onclick="showServiceDetail('+ service_data[i].id +');" class="service_name_check" type="checkbox" name="service_name_check" id="service_name_check_'+ service_data[i].id +'" value="" ><div class="service_name_t" id="service_name_t">'+  service_data[i].service_name +'</div>');
                        $('#service_product_model').append('<div class="product_model_a" onclick="toggleserviceproduct(' +
                        service_data[i].id + ')">2/10</div>');
                        $('#service_price_t').append('<div class="service_price_title">Rs.'+ service_data[i].final_price +'</div>');
                    }    
                }
            }
        }
    }
</script>

<script>
    $("#search_services").keyup(function() {
        var services=$("#search_services").val();
        var category=$("#sup_category").val();
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>salon/Ajax_controller/get_service_details_for_booking_ajax",
            data: {
                'sup_category': category,
            },
            success: function(data) {
                $('#service_category').val($('#sup_category').val());
                var parsedData = JSON.parse(data);
                if (parsedData.length > 0) {
                    parsedData.forEach(function(record) {
                        // length_service = record.service_name;
                        var p_count = 0;
                            for (var i = 0; i < record.product.length; i++) {
                                if (record.product[i] !== ',') {
                                    p_count++;
                                }
                            }
                        if(services === record.service_name){
                            console.log(record.service_name);
                            $('#package_service_name').empty();
                            $('#service_product_model').empty();
                            $('#service_price_t').empty();
                           
                            $('#package_service_name').append('<input onclick="showServiceDetail('+ record.id +');" class="service_name_check" type="checkbox" name="service_name_check" id="service_name_check_'+ record.id +'" value="" ><div class="service_name_t" id="service_name_t">'+  record.service_name +'</div>');
                            $('#service_product_model').append('<div class="product_model_a" onclick="toggleserviceproduct(' +
                            record.id + ')">' + p_count + '/10</div>');
                            $('#service_price_t').append('<div class="service_price_title">Rs.'+ record.final_price +'</div>');
                        }
                        // else{
                        //     $('#package_service_name').html('<div class="service_name_t" id="service_name_t">No services found</div>'); 
                        //     $('#service_product_model').empty();
                        //     $('#service_price_t').empty();
                        // }
                    });
                }
            }
        });
        
    });
    
</script>

<script type="text/javascript">
    function get_customer_model() { 
        $('.client_main_container').show();
        var last_id = <?php echo json_encode($last_id) ?>;
        $(".customer-info-by-search").hide(); 
        $("#customer_name_t").html(last_id.full_name); 
        $("#phone").html(last_id.customer_phone); 
        $('.memebership_expiry').show().css('background-color', 'green');
        $('.memebership_expiry').append('</span>Customer Resitration Succefully!</span>');
    } 

    function open_customer_model() { 
        $(".add-new-customer-main").toggle(); 
        $(".customer-info-by-search").hide(); 
    } 
</script>

<script>
   $("#show_more").click(function () {
          $('.add-more-info').toggle();
    });
</script>

<script>
   function closeserviceproduct() {
          $('.service-product-content-main').toggle();
    }
    
</script>

<script>
   $("#booking-date").change(function () {
        var Selected_Date = $("#booking-date").val();
        console.log(Selected_Date);
        $('#booking_date').val(Selected_Date);  
        var offers_data = <?php echo json_encode($offers_list) ?>;
        var offer_length =offers_data.length;
       
        for (var i = 0; i < offer_length; i++) {
            var dateString = offers_data[i].created_on;
            var offer_end = offers_data[i].duration;
            var offer_end_number = offer_end * 7;

            var end_date = new Date(dateString);
            end_date.setDate(end_date.getDate() + offer_end_number);
            var end = formatDate(end_date);
            console.log("End Date:", end);

            var start_date = new Date(dateString);
            var start = formatDate(start_date);
            console.log("Start Date:", start);

            if ((Selected_Date >= start) && (Selected_Date <= end)) {
                if(offers_data[i].discount_in == 0){
                    $('.offers_discount_box').append('<div class="col-md-7 col-sm-12 col-xs-12">\
                                                        <b>'+ offers_data[i].offers_name +' Offers (Rs.)</b>\
                                                    </div>\
                                                    <div class="col-md-3 col-sm-12 col-xs-12"></div>\
                                                    <div class="col-md-2 col-sm-12 col-xs-12">\
                                                        <b>Rs.'+ offers_data[i].discount +'</b>\
                                                    </div>');
                    total_amount=$('#tt_ff_aa').val();  
                    ff_amount=total_amount-offers_data[i].discount;                              
                    $('#tt_ff_aa').val(ff_amount);
                    }else{
                        $('.offers_discount_box').append(' <div class="col-md-7 col-sm-12 col-xs-12">\
                                                        <b>'+ offers_data[i].offers_name +' Offers (%)</b>\
                                                    </div>\
                                                    <div class="col-md-3 col-sm-12 col-xs-12"></div>\
                                                    <div class="col-md-2 col-sm-12 col-xs-12">\
                                                        <b>'+ offers_data[i].discount +'%</b>\
                                                    </div>'); 
                    total_amount=$('#tt_ff_aa').val();  
                    ff_amount= total_amount - (total_amount * (offers_data[i].discount / 100));                             
                    $('#tt_ff_aa').val(ff_amount);
                    }                                
            } else {
                console.log("Selected Date is outside the offer duration");
            }
        }
    });

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

<script>
   $("#married_status").change(function () {
    var m_status = $("#married_status").val();
       if(m_status == 0){
          $('.Anniversary-box').show();
       }
       else{
        $('.Anniversary-box').hide();
       }
    });
    
</script>

<script>
    $("#state").change(function () {
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>admin/Ajax_controller/get_city_ajax",
            data: { 'state': $("#state").val() },
            success: function (data) {
                $("#city_name").empty();  
                $('#city_name').append('<option value="">Select City</option>');
                var opts = $.parseJSON(data);
                $.each(opts, function (i, d) {
                    $('#city_name').append('<option value="' + d.id + '">' + d.name + '</option>');
                });
                $('#city_name').trigger('chosen:updated');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });
</script>


<!-- datepicker -->

<script>
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
    dateFormat: "dd-mm-yy",
    changeMonth: true,
    changeYear: true,
    maxDate: "0", 
     , 
    defaultDate: 0
    });

    $("#DOA").datepicker({
        dateFormat: "dd-mm-yy",
        changeMonth: true,
        changeYear: true,
        maxDate: "0", 
         , 
        defaultDate: 0
    });
</script>

<!-- validation script -->

<script>
    $('#value_check').change(function() {
        if ($('#value_check').val() == 'Yes') {
            $('.package-box').show();
        } else if ($('#value_check').val() == 'No') {
            $('.package-box').hide();
        }
    });
    jQuery.validator.addMethod("validate_email", function(value, element) {
        if (/^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/.test(value)) {
            return true;
        } else {
            return false;
        }
    }, "Please enter a valid Email!");
    $(document).ready(function() {
        $('#add_customer_form').validate({
            ignore: ":hidden",
            rules: {
              
                full_name: 'required',
                phone: {
                    required: true,
                    number: true,
                    mobile_no: true,
                    minlength: 10,
                    maxlength: 10,
                },
                email: {

                    required: true,
                    validate_email: true,
                    noHTMLtags: true,
                },
                address: 'required',
                dob: 'required',
                gender: 'required',
            },
            messages: {
                full_name: 'Please enter customer name!',
                phone: {
                    required: "Please enter mobile number!",
                    number: "Only number allowed!",
                    mobile_no: "Please enter valid number!",
                    minlength: "Minimum 10 digit required!",
                    maxlength: "Maximum 10 digit allowed!",
                },
                email: {
                    required: "Please enter email!",
                    validate_email: "Please enter valid email!",
                    noHTMLtags: "HTML tags not allowed!",
                },
                address: 'Please enter address!',
                dob: 'Please select date of birth!',
                gender: 'Please select gender!',
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
                    $('.customer-info-by-search div').html('<div onclick="get_customer_info('+ parsedData.customer_phone +')">'+ parsedData.full_name +'</div>');
                   
                } else {
                    $('.customer-info-by-search').show();
                    $('.customer-info-by-search div').html('Customer Not Found! Please Add New Customer.<b onclick="open_customer_model()" class="add-new-customer">Add Customer</b>');
                }
            },
        });
    });
    function get_customer_info(phone) {
        getstylistservices();

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
                    var booking_length=booking_list.length;
                    var baseUrl = '<?= base_url() ?>';
                    for(var x=0; x < booking_length; x++){
                        $('.customer-activity').empty();
                        $('.customer_note').empty();
                        $('.customer_payment').empty();
                        if(parsedData.id == booking_list[x].customer_name){
                            checkreminderservice(booking_list[x].services,booking_list[x].booking_date);
                            $('#phone').val(parsedData.full_name)
                            $('.customer-info-by-search').hide();
                            $('.customer-activity').append('<div class="acticity_timeline_circle"></div>\
                                                              <div class="cleint-activity">\
                                                                  <div class="ll_c">Date:'+ booking_list[x].booking_date+' Time:'+ booking_list[x].time_slot+'</div>\
                                                              </div>');
                            $('.customer_note').append('<div class="acticity_timeline_circle"></div>\
                                                           <div class="customer_note">\
                                                              <div class="ll_c">'+ booking_list[x].note +'</div>\
                                                           </div>');
                                                           break;
                        }else{
                            $('.customer-activity').append('<div class="cleint-activity no_data_activity">\
                                                        <img src="' + baseUrl + '/admin_assets/images/no_data/no_data.png">\
                                                        </div><div><b style="color: black;margin-left: 72px;">No Activity Found</b></div>');
                            $('.customer_note').append('<div class="cleint-activity no_data_activity">\
                                                            <img src="' + baseUrl + '/admin_assets/images/no_data/no_data.png">\
                                                        </div><div><b style="color: black;margin-left: 72px;">No Notes Found</b></div>');
                            $('.customer_payment').append('<div class="cleint-activity no_data_activity">\
                                                        <img src="' + baseUrl + '/admin_assets/images/no_data/no_data.png">\
                                                    </div><div><b style="color: black;margin-left: 72px;">No Payment Found</b></div>');
                        }
                    }
                    var m_length=membership_data.length
                    for(var i=0; i< m_length; i++){
                        if(parsedData.membership_id == membership_data[i].id){
                            $('#membership').append('<b>'+membership_data[i].membership_name+'</b>');
                            $('.membership-info').css('background-color', membership_data[i].bg_color);
                            if( membership_data[i].discount_in == 1){
                                $('.M_S_discount').append('<div class="col-md-7 col-sm-12 col-xs-12">\
                                                                <span class="span_title_side_bar">Membership Service Discount(Rs.'+membership_data[i].service_discount+')</span>\
                                                            </div>\
                                                            <div class="col-md-3 col-sm-12 col-xs-12">\
                                                                <div class="btn_apply" style="background-color: '+ membership_data[i].bg_color +'">'+membership_data[i].membership_name+'</div>\
                                                            </div>\
                                                            <div class="col-md-2 col-sm-12 col-xs-12 payable_amount">\
                                                               <input type="text" id="total_m_s_amount" placeholder="0.00" readonly> \
                                                            </div>');
                                $('.M_P_discount').append(' <div class="col-md-7 col-sm-12 col-xs-12">\
                                                              <span class="span_title_side_bar">Membership Product Discount (Rs.'+membership_data[i].product_discount+')</span>\
                                                            </div>\
                                                            <div class="col-md-3 col-sm-12 col-xs-12">\
                                                                <div class="btn_apply" style="background-color: '+ membership_data[i].bg_color +'">'+membership_data[i].membership_name+'</div>\
                                                            </div>\
                                                            <div class="col-md-2 col-sm-12 col-xs-12 payable_amount">\
                                                               <input type="text" id="total_m_p_amount" placeholder="0.00" readonly> \
                                                            </div>');
                               var m_discount =parseFloat(membership_data[i].service_discount);
                               $('#m_discount').val(m_discount); 
                               $('#m_discount_type').val(1); 

                               var M_P_discount =parseFloat(membership_data[i].product_discount);
                               $('#M_P_discount').val(M_P_discount); 

                            }else{
                                $('.M_S_discount').append('<div class="col-md-7 col-sm-12 col-xs-12">\
                                                                <span class="span_title_side_bar">Membership Service Discount('+membership_data[i].service_discount+'%)</span>\
                                                            </div>\
                                                            <div class="col-md-3 col-sm-12 col-xs-12">\
                                                                <div class="btn_apply" style="background-color: '+ membership_data[i].bg_color +'">'+membership_data[i].membership_name+'</div>\
                                                            </div>\
                                                            <div class="col-md-2 col-sm-12 col-xs-12 payable_amount">\
                                                               <input type="text" id="total_m_s_amount" placeholder="0.00" readonly> \
                                                            </div>');
                                $('.M_P_discount').append(' <div class="col-md-7 col-sm-12 col-xs-12">\
                                                              <span class="span_title_side_bar">Membership Product Discount ('+membership_data[i].product_discount+'%)</span>\
                                                            </div>\
                                                            <div class="col-md-3 col-sm-12 col-xs-12">\
                                                                <div class="btn_apply" style="background-color: '+ membership_data[i].bg_color +'">'+membership_data[i].membership_name+'</div>\
                                                            </div>\
                                                            <div class="col-md-2 col-sm-12 col-xs-12 payable_amount">\
                                                               <input type="text" id="total_m_p_amount" placeholder="0.00" readonly> \
                                                            </div>');
                                
                               var m_discount = parseFloat(membership_data[i].service_discount);
                               $('#m_discount').val(m_discount);
                               $('#m_discount_type').val(0);  

                               var M_P_discount =parseFloat(membership_data[i].product_discount);
                               $('#M_P_discount').val(M_P_discount); 
                            }
                            break;
                        }
                    }

                    $('#customer_name_t').html(parsedData.full_name);
                    $('#phone').val(parsedData.full_name)

                    var fullName = parsedData.full_name;
                    var initials = fullName.split(' ').map(word => word.charAt(0)).join('');
                    $('#profile_photo').append('<span class="name_head">'+ initials +'</span>');

                    var timestamp = parsedData.created_on;
                    var dateObject = new Date(timestamp);
                    var year = dateObject.getFullYear();
                    var month = (dateObject.getMonth() + 1).toString().padStart(2, '0'); 
                    var day = dateObject.getDate().toString().padStart(2, '0');
                    var formattedDate = day + '-' + month + '-' + year;

                    $('#add_date').html('Since:'+formattedDate);
                    $('.customer-info-by-search').hide();

                    if(parsedData.membership_id == 0){
                        $('#membership').append('Not a Member');
                        $('.membership-info').css('background-color', 'rgb(116 116 116)');
                    }


                    var gift_data= <?php echo json_encode($gift_card_list) ?>;
                    var gift_length=gift_data.length;
                    for(var i=0; i< gift_length; i++){
                        if(parsedData.gift_card_id == gift_data[i].id){
                            if(gift_data[i].discount_in == 1){
                                $('.gift_card_discount').append('<div class="col-md-7 col-sm-12 col-xs-12">\
                                                                    <span class="span_title_side_bar">Gift Card Discount(Rs.'+ gift_data[i].discount +')</span>\
                                                                    </div>\
                                                                    <div class="col-md-3 col-sm-12 col-xs-12">\
                                                                        <div class="btn_applied" style="background-color: '+ gift_data[i].bg_color +'">Applied</div>\
                                                                    </div>\
                                                                    <div class="col-md-2 col-sm-12 col-xs-12 payable_amount">\
                                                                    <input type="text" id="gift_card_amount">\
                                                                    </div>');
                               $('#gift_discount').val(gift_data[i].discount); 
                               $('#gift_discount_type').val(1);
                            }
                            else{
                                $('.gift_card_discount').append('<div class="col-md-7 col-sm-12 col-xs-12">\
                                                                    <span class="span_title_side_bar">Gift Card Discount('+ gift_data[i].discount +'%)</span>\
                                                                    </div>\
                                                                    <div class="col-md-3 col-sm-12 col-xs-12">\
                                                                        <div class="btn_applied" style="background-color: '+ gift_data[i].bg_color +'">'+ gift_data[i].gift_name +'</div>\
                                                                    </div>\
                                                                    <div class="col-md-2 col-sm-12 col-xs-12 payable_amount">\
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
                    var default_data = <?php echo json_encode($by_default) ?>;
                    var d_length=default_data.length;
                    for(var i=0; i< d_length; i++){
                        $('.service_detail_content_box').show();
                        $('.search_services_box').show();
                        $('#service_price_t').show();
                        $('#category_name_t').append(default_data[i].sup_category+'|'+default_data[i].sup_category_marathi+' & ');
                        $.ajax({
                            type: "POST",
                            url: "<?= base_url(); ?>salon/Ajax_controller/get_service_details_for_booking_ajax",
                            data: {
                                'sup_category':default_data[i].id,
                            },
                            success: function(data) {
                                var parsedData = JSON.parse(data);
                                if (parsedData.length > 0) {
                                    parsedData.forEach(function(record) {
                                        var p_count = 0;
                                        for (var i = 0; i < record.product.length; i++) {
                                            if (record.product[i] !== ',') {
                                                p_count++;
                                            }
                                        }
                                        $('#package_service_name').append('<input onclick="showServiceDetail('+ record.id +');" class="service_name_check" type="checkbox" name="service_name_check" id="service_name_check_'+ record.id +'" value="" ><div class="service_name_t" id="service_name_t">'+  record.service_name +'</div>');
                                        $('#service_product_model').append('<div class="product_model_a" onclick="toggleserviceproduct(' +
                                        record.id + ')">' + p_count + '/10</div>');
                                        $('#service_price_t').append('<div class="default_service_price_t">Rs.'+ record.final_price +'</div>');
                                    
                                    });
                                }

                            },
                        });
                    }
    }
</script>


<!-- check reminder service script -->

<script>
    function checkreminderservice(service_id,date) {
        var service_data= <?php echo json_encode($service_list) ?>;
        var service_length=service_data.length;
        for(var i=0; i< service_length; i++){
            if(service_id == service_data[i].id){
                // console.log(service_data[i].reminder_duration);
                // if(date == ){
                    $('.memebership_expiry').append('</span>'+ service_data[i].service_name +' needs to be done on this time</span>');
                    $('.memebership_expiry').show();
                // }
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
        $('.package_detail_content').show();
        $('.amount_to_paid_title').show();
        $('.total_service_time').show();
        $('.service-payment-title').show();
        // $('.total_final_amount_title').show();
        $('.reminder_box_input').show();
        $('.reminder_box').show();
        $('.confirm_btn_box').show();
        $('.t_s_a_title').show();
        $('.service-payment').show();
        $('.search_services_box').show();
        $('.service_detail_content_box').show();
        $('#service_price_t').empty();
    // *************************
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
        $('#total_final_amount').val(0);
        $('#total_m_s_amount').val(0);
        $('#payble_price').val(0.00);
        $('#gst_amount').val(0);
        $('#total-service-amount').val(0);
        $('#amount_to_paid').val(0);
        var category = <?php echo json_encode($category) ?>;
        var category_length = category.length;
        for(var z=0;z<category_length;z++){
            if(category[z].id== $('#sup_category').val()){
                $('#category_name_t').html(category[z].sup_category+'|'+category[z].sup_category_marathi);
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
                        var p_count = 0;
                        for (var i = 0; i < record.product.length; i++) {
                            if (record.product[i] !== ',') {
                                p_count++;
                            }
                        }
                        $('#package_service_name').append('<input onclick="showServiceDetail('+ record.id +');" class="service_name_check" type="checkbox" name="service_name_check" id="service_name_check_'+ record.id +'" value="" ><div class="service_name_t" id="service_name_t">'+  record.service_name +'</div>');
                        $('#service_product_model').append('<div class="product_model_a" onclick="toggleserviceproduct(' +
                        record.id + ')">' + p_count + '/10</div>');
                        $('#service_price_t').append('<div class="service_price_title">Rs.'+ record.final_price +'</div>');
                       
                    });
                }

            },
        });
    });
</script>

<!-- add services  -->


<script type="text/javascript">
    function toggleserviceproduct(service_id) { 
      $(".service-product-content-main").show(); 
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
                                $('#product_price_name_id').append('<input id="p_price_check_'+ service_id +'" type="checkbox" onclick="showtotalamount('+ record.product[i] +',' + service_id + ',' + productPrice + ',\'' + productName + '\')" class="product_price_name_id"><br>');
                                $('#product_name').append(productName + '<br>');
                                $('#product_price').append(productPrice + '<br>');
                            }
                        }
                    });
                }
            },
        });
    }
</script>


<!-- showServiceDetail -->

<script>
    function showServiceDetail(service_id) {
        $('.side_amount_bar').show();
        $('.no_data_side_amount').hide();
        $('.package_detail_content').show();
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
        var time_time=$("#time_slot").val();
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
                         cancelService(service_id,record.final_price,record.service_duration);
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
                                                            <div onclick="showstylistbycurrentshift(' + service_id + ')" class="service_detail_stylist_name col-md-7" id="stylist_name_t' + service_id + '"><i class="fa-solid fa-caret-down"></i>  Select Stylist</div>\
                                                            <div class="gettime_by_shift-box" id="time_slot_box_'+ service_id +'" style="display: none;"></div>\
                                                                <div class="cancel_service_btn col-md-1" id="cancel_service_btn_' + service_id + '"><i onclick="cancelService(' + service_id + ',' + record.final_price + ','+ record.service_duration +')" class="fa-solid fa-xmark"></i></div>\
                                                        </div></div>');
                            $('.service-payment').append('<div class="service_detail_payment_' + service_id + '"><div class="col-md-6 col-sm-12 col-xs-12">\
                                                                <span>' + record.service_name + '</span>\
                                                            </div>\
                                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"></div>\
                                                            <div class="col-md-2 col-sm-12 col-xs-12">\
                                                                <span>' + record.final_price + '</span>\
                                                            </div></div>');
                        });
                    }
                },
            });
        }
    }
</script>


<!-- show stlist by current shift -->

<script>
 function showstylistbycurrentshift(service_id){
    $('#time_slot_box_'+ service_id +'').show();
    $('#time_slot_box_'+ service_id +'').empty();
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
        var emp_service_l= emp_data[k].service_name.length;
        var service_emp_id = emp_data[k].service_name;
        var emp_shift_id = emp_data[k].shift_name;
        for (var n = 0; n < emp_service_l; n++) {
            if (service_emp_id[n]!== ',') {
                if(service_id == service_emp_id[n]){
                    for (var b = 0; b < shift_length; b++) {
                        if ((shift_data[b].shift_in_time <= currentTime) && (shift_data[b].shift_out_time >= currentTime)) {  
                            $('#selected_shift').val(shift_data[b].id);
                            if (shift_data[b].id == emp_data[k].shift_name) {
                                $('.gettime_by_shift-box').append('<div id="time_slot_box_'+ service_id +'">\
                                                                       <div onclick="show_stylist_in_feild(' + emp_data[k].id + ',' + service_id + ')" class="row stylist-after-dy">\
                                                                       <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">\
                                                                           <div class="emp-img-box " style="background-image:url(<?= base_url('admin_assets/images/employee_profile/')?>' + emp_data[k].profile_photo + ')"></div>\
                                                                        </div>\
                                                                         <div class="col-md-8 stylist_name_box">' + emp_data[k].full_name + '</div>\
                                                                    </div>');
                            }
                        }
                    }
                }
            }
        }
    }
 }
</script>

<!-- product model open script  -->

<script>
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
                                $('#product_price_name_id').append('<input value="1" id="p_price_check_'+ service_id +'" type="checkbox" onclick="showtotalamount('+ record.product[i] +',' + service_id + ',' + productPrice + ',\'' + productName + '\')" class="product_price_name_id"><br>');
                                $('#product_name').append(productName + '<br>');
                                $('#product_price').append(productPrice + '<br>');
                            }
                        }
                    });
                }
            },
        });
    }
</script>


<!-- get Product details script -->

<script type="text/javascript">
    function showtotalamount(p_id,service_id,p_price,p_name) {
        $('.service_product_payment_title').show();
        $('.M_P_discount').show();
        $('.service_product_payment').show();
        $('.total_product_amount_title').show();
        $('.t_p_a_title').show();

        var check_Box = ('#p_price_check_' + p_price).val();
        console.log(check_Box);
        if (check_Box.checked == true) {
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

                $('.service_product_and_price').append('<div class="product_detail_'+ p_id +' product_cc_ff"><div class="col-md-6">\
                                                           <div class="" id="product_detail_name_t">'+ p_name +'</div>\
                                                        </div>\
                                                        <div class="col-md-5">\
                                                          <div class="service_product_price" id="product_detail_price_t">Rs.'+ p_price +'</div>\
                                                        </div>\
                                                        <div class="col-md-1 cancel_product_btn">\
                                                           <i onclick="CancelProduct('+ p_price +','+ p_id +')" class="fa-solid fa-xmark"></i>\
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

                $('.service_product_payment').append('<div class="product_detail_'+ p_id +'">\
                                                        <div class="col-md-8 col-sm-12 col-xs-12">\
                                                            <span>'+ p_name +'</span>\
                                                        </div>\
                                                        <div class="col-md-2 col-sm-12 col-xs-12"></div>\
                                                        <div class="col-md-2 col-sm-12 col-xs-12">\
                                                            <span>'+ p_price +'</span>\
                                                        </div>\
                                                    </div>');


                $('.final-total-price-box').show();
                var ttt = parseFloat($('#final-total').val()) || 0;
                var parsedAmount = parseFloat(priceAsInt) || 0;
                var ttt_total = parsedAmount + ttt;
                $('#final-total').val(ttt_total);
            }
        }else{
            console.log("heyy");
                var priceAsInt = parseInt(p_price, 10);
                var currentTotal = parseInt($('#total_p_amount').val(), 10) || 0;
                var newTotal = currentTotal - priceAsInt;
                var total = newTotal.toFixed(2);
                $('#total_p_amount').val(newTotal.toFixed(2));
        }
    }
</script>


<!-- calculate membership product discount  -->


<script type="text/javascript">
    function calculate_product_discount() {
      
        var tt_ff_pp_price=parseInt($('#total_product_amount_t').val(), 10) || 0;
        var M_P_discount=$('#M_P_discount').val(); 
        var tt_service_amount=parseInt($('#total_final_amount').val());
        console.log(tt_ff_pp_price); 
        console.log(M_P_discount); 
        if (!isNaN(tt_service_amount)) {
        
        if ($('#m_discount_type').val() == 1) {

            aa_pp=(parseFloat(tt_ff_pp_price) - M_P_discount);
            wwww=(parseFloat(aa_pp) * (1 - 18 / 100));
            $('#total_m_p_amount').val(parseFloat(aa_pp - tt_ff_pp_price));
            $('#tt_pp_aa').val(parseFloat(aa_pp).toFixed(2));
            var jjj=parseFloat((aa_pp)+ parseFloat(tt_service_amount));
            $('#payble_price').val(parseFloat(aa_pp)+ parseFloat(tt_service_amount));
            $('#ppp_aaa').html(parseFloat(aa_pp)+ parseFloat(tt_service_amount));
            $('#amount_to_paid').val(parseFloat(jjj));
            calculate_gst_amount(jjj);

        } else if ($('#m_discount_type').val() == 0){

            aa_pp=(parseFloat(tt_ff_pp_price) * (1 - M_P_discount / 100));
            wwww=(parseFloat(aa_pp) * (1 - 18 / 100));
            $('#total_m_p_amount').val(parseFloat(aa_pp - tt_ff_pp_price));
            $('#tt_pp_aa').val(parseFloat(aa_pp).toFixed(2));
            var jjj=parseFloat((aa_pp)+ parseFloat(tt_service_amount));
            $('#payble_price').val(parseFloat(aa_pp)+ parseFloat(tt_service_amount));
            $('#ppp_aaa').html(parseFloat(aa_pp)+ parseFloat(tt_service_amount));
            $('#amount_to_paid').val(parseFloat(jjj));
            calculate_gst_amount(jjj);
            
        }   
        }   

    }
</script>

<!-- cancel product detail -->


<script type="text/javascript">
    function CancelProduct(p_price,p_id) {
      
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
    }
</script>


<!-- add time slot by Current shift script  -->

<script>
    function gettimeslotbycurrentshift(service_id) {
        $(".time-slot-box-model-row").empty();
        $(".gettime_by_shift-box").empty();
        $(".stylist_imge_t").empty();
        $("#time-slot").empty('');
        $("#dummy-services_id").val(service_id);
        $(".time-slot-content-main").show();
        // show_time_slot_by_shift_name(service_id);
          
            
                      
                        var shift_data = <?php echo json_encode($shift_list) ?>;
                        var rule_data = <?php echo json_encode($single_rules) ?>;
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
                            if ((shift_data[k].shift_in_time <= currentTime) && (shift_data[k].shift_out_time >= currentTime)) {
                                $('#selected_shift').val(shift_data[k].id);
                                var out_time = parseFloat(shift_data[k].shift_out_time);
                                for (var slot_hour = formattedHours; slot_hour < out_time; slot_hour++) {
                                    for (var slot_minute = 0; slot_minute < 60; slot_minute += session_duration) {
                                        const adjustedHour = slot_hour;
                                        const formattedHour = adjustedHour.toString().padStart(2, '0');
                                        const formattedMinute = slot_minute.toString().padStart(2, '0');
                                        const formattedTime = `${formattedHour}:${formattedMinute}`;
                                        if (currentTime < formattedTime) {
                                            $('.time-slot-box-model-row').append('<div onclick="show_time_slot_on_feild(\'' + formattedTime + '\',' + service_id + ')" class="col-md-2 col-sm-12 col-xs-12 time-slot-box-model"><b>' + formattedTime + '</b></div>');
                                        }
                                    }
                                }
                            }
                        }
                   

    }
</script>

<!-- Stylist according to selected  shift -->

<script>
     $(document).ready(function() {
        $("#stylist-feild-t").click(function() {
            $(".gettime_by_shift-box").toggle();
        });
    });
    function gettime_by_shift(){
        var selected_shift_id = $('#shift_name').val();
        var service_id =$("#dummy-services_id").val();
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
                        var shift_data = <?php echo json_encode($shift_list) ?>;
                        var emp_data = <?php echo json_encode($salon_employee_list) ?>;
                        var emp_length = emp_data.length;
                        var rule_data = <?php echo json_encode($single_rules) ?>;
                        var shift_length = shift_data.length;
                        var session_duration = parseFloat(rule_data.session_avg_duration);
                        var l_emp = record.emp_name.length;

                        var currentDate = new Date();
                        var hours = currentDate.getHours();
                        var minutes = currentDate.getMinutes();
                        var formattedHours = (hours < 10 ? "0" : "") + hours;
                        var formattedMinutes = (minutes < 10 ? "0" : "") + minutes;
                        var currentTime = formattedHours + ":" + formattedMinutes;
                        $("#time-slot").val(currentTime);

                            for (var k = 0; k < shift_length; k++) {
                                if(selected_shift_id == shift_data[k].id){
                                    $('#selected_shift').val(selected_shift_id);
                                    for (var i = 0; i < l_emp; i++) {
                                        if (record.emp_name[i] !== ',') {
                                            for (var j = 0; j < emp_length; j++) {
                                                if (emp_data[j].id == record.emp_name[i]) {
                                                    if (selected_shift_id == emp_data[j].shift_name) {
                                                        // $('.gettime_by_shift-box').append('<div onclick="show_stylist_in_feild('+ emp_data[j].id +','+ service_id +')" class="col-md-12 stylist-after-dy">'+ emp_data[j].full_name +'</div>');
                                                        $('.gettime_by_shift-box').append('<div onclick="show_stylist_in_feild(' + emp_data[j].id + ',' + service_id + ')" class="row stylist-after-dy">\
                                                                                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">\
                                                                                                <div class="emp-img-box " style="background-image:url(<?= base_url('admin_assets/images/employee_profile/')?>' + emp_data[j].profile_photo + ')"></div>\
                                                                                                </div>\
                                                                                                <div class="col-md-8 stylist_name_box">' + emp_data[j].full_name + '</div>\
                                                                                            </div>');
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }  
                            }      
                    });
                }
            }
        });
    }
</script>

<!-- Time slot according to selected  shift -->

<script>
    function show_time_slot_by_shift_name(){
        $("#shift_name").change(function() {
            var service_id =$("#dummy-services_id").val();
            $('.gettime_by_shift-box').empty();
            $('#stylist-feild-t').html('Select Stylist');
            $('.stylist_time_slot_'+ service_id +'').html('Time Slot');
            $('#stylist_name_t'+ service_id +'').html('Select Stylist');

            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>salon/Ajax_controller/get_time_slot_by_shift_ajax",
                data: {
                    'shift_name_id': $('#shift_name').val(),
                },
                success: function(data) {
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

                    for (var slot_hour = in_time; slot_hour < out_time; slot_hour++) {
                        for (var slot_minute = 0; slot_minute < 60; slot_minute += 10) {

                            const adjustedHour = slot_hour;
                            const formattedHour = adjustedHour.toString().padStart(2, '0');
                            const formattedMinute = slot_minute.toString().padStart(2, '0');
                            const formattedTime = `${formattedHour}:${formattedMinute}`;
                            if (formattedTime) {
                                $('.time-slot-box-model-row').append('<div onclick="show_time_slot_on_feild(\'' + formattedTime + '\',' + service_id + ')" class="col-md-2 col-sm-12 col-xs-12 time-slot-box-model"><b>' + formattedTime + '</b></div>');
                            }
                        }
                    }
                }
            });
        });
    }
</script>


<!-- show selecetd time and stylist Title -->


<script type="text/javascript">
        function show_time_slot_on_feild(selected_time_slot, service_id) {
        $('#time-slot').val(selected_time_slot);
        $('#time_slot').val(selected_time_slot);
        $('.stylist_time_slot_'+ service_id +'').empty();
        $('.stylist_time_slot_'+ service_id +'').append('<span>Time: '+ selected_time_slot +'</span>');
        // $('.hidden_time_box').append('<input type="text" name="hidden_time[' + selected_stylist + ']" id="hidden_time' + selected_stylist + '" value="' + selected_time_slot + '">');
        $('.time-slot-box-model').filter(':contains("' + selected_time_slot + '")').css({
            'background-color': 'red',
            'color': 'white'
            });
    }
    function show_stylist_in_feild(name,service_id){
      var emp_data = <?php echo json_encode($salon_employee_list) ?>;
      var emp_length = emp_data.length;
        for (var j = 0; j < emp_length; j++) {
            if (emp_data[j].id == name) {
                $('#stylist-feild-t').html(emp_data[j].full_name);
                $('#stylist_name_t'+ service_id +'').html(emp_data[j].full_name);
                $('#stylist').val(emp_data[j].id);
                $('.dummy_stylist_image').hide();
                $('.stylist-profile-imge').html('<img src="<?= base_url('admin_assets/images/employee_profile/')?>' +emp_data[j].profile_photo + '">');
            }
        }
      $('.gettime_by_shift-box').hide();
    }
</script>


<!-- calculate Gst amount -->
<script type="text/javascript">
    function calculate_gst_amount(price) {

        var store_data = <?php echo json_encode($store_profile) ?>;
        if(store_data.gst == 1){

            var gst_dd=(parseFloat(price) * (1 - 18 / 100).toFixed(2));
            $('#service_gst_amount').val(parseFloat(price - gst_dd).toFixed(2));
            var aaa=(parseFloat(price - gst_dd).toFixed(2));
            var pppp = parseFloat(price) + parseFloat(aaa);
            $('#gst_amount').val(parseFloat(price - gst_dd).toFixed(2)); 
            $('#amount_to_paid').val(pppp.toFixed(2));
        }
    }
</script>    

<!-- Total service amount -->


<script type="text/javascript">
    function totalserviceamount(amount) {
        var m_discount=$('#m_discount').val(); 
        var gift_discount=$('#gift_discount').val(); 

            var ttt_amount = $('#total-service-amount').val();
            var tt_pp_aa = $('#tt_pp_aa').val();
            var product_gst = parseFloat($('#product_gst_amount').val());
            $('#total-service-amount').val(parseFloat(amount) + parseFloat(ttt_amount));
            $('#total_service_amount_t').html(parseFloat(amount) + parseFloat(ttt_amount));
            $('#service_price').val(parseFloat(amount) + parseFloat(ttt_amount));
            $('#tt_ff_aa').val(parseFloat(amount) + parseFloat(ttt_amount));
            var pay_amount=$('#total-service-amount').val();
            var aa_pp=0;
            var ffff=0;
        if ($('#m_discount_type').val() == 1) {
            aa_pp=(parseFloat(pay_amount) - m_discount);
           
        } else if ($('#m_discount_type').val() == 0){
            aa_pp=(parseFloat(pay_amount) * (1 - m_discount / 100));
            
        }

        if ($('#gift_discount_type').val() == 1) {
            ffff=(parseFloat(pay_amount) - gift_discount);
           
        } else if ($('#gift_discount_type').val() == 0){
            ffff=(parseFloat(pay_amount) * (1 - gift_discount / 100));
           
        }
        $('#total_m_s_amount').val((aa_pp - pay_amount).toFixed(2));
        $('#gift_card_amount').val((ffff - pay_amount).toFixed(2));
        var hhhh=parseFloat((aa_pp+ffff)-pay_amount)
        var jjj=tt_pp_aa+hhhh;
        $('#payble_price').val(parseFloat(jjj).toFixed(2));
        $('#ppp_aaa').html(parseFloat(jjj).toFixed(2));
        $('#total_final_amount').val(parseFloat(jjj).toFixed(2));
        $('#amount_to_paid').val(parseFloat(jjj).toFixed(2));
        calculate_gst_amount(jjj);
    }
</script>


<!-- cancel service detail -->


<script type="text/javascript">
   function cancelService(service_id, amount,time) {
        $('.service_detail_' + service_id).hide();
        $('.service_detail_payment_' + service_id).hide();
        var mm_kk = $('#total_final_amount').val();
        var m_discount=$('#m_discount').val();
        var services_m_discount=$('#total_m_s_amount').val();
        var gift_discount=$('#gift_discount').val();
        var g_d=$('#gift_card_amount').val();
        var payble_amount=$('#payble_price').val();

        if ($('#m_discount_type').val() == 1) {
            aa_pp=(parseFloat(amount) - m_discount);
           
        } else if ($('#m_discount_type').val() == 0){
            aa_pp=(parseFloat(amount) * (1 - m_discount / 100));
            
        }
        var cccc=parseFloat(aa_pp)-parseFloat(amount);
        $('#total_m_s_amount').val((parseFloat(services_m_discount)-parseFloat(cccc)).toFixed(2));

        if ($('#gift_discount_type').val() == 1) {
            ffff=(parseFloat(amount) - gift_discount);
           
        } else if ($('#gift_discount_type').val() == 0){
            ffff=(parseFloat(amount) * (1 - gift_discount / 100));
        }

        var vvvv=parseFloat(ffff)-parseFloat(amount);
        var gggg=parseFloat(ffff)+parseFloat(aa_pp);
        var bbbb=parseFloat(gggg)-parseFloat(amount)
        var jjjj=parseFloat(mm_kk) - parseFloat(bbbb);
        $('#gift_card_amount').val((parseFloat(g_d)-parseFloat(vvvv)).toFixed(2));
        $('#payble_price').val((parseFloat(payble_amount)-parseFloat(bbbb)).toFixed(2));
        $('#ppp_aaa').html((parseFloat(payble_amount)-parseFloat(bbbb)).toFixed(2));
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
        $('#ttt-fff').val(final_ttt+"Min");
    } 
 }
</script>



<!-- get detail pacakge script -->

<script type="text/javascript">
    $("#package_name").change(function() {
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
        $('.service_detail_content').show();
        $('.service_detail_content_title').show();
        $('#ttt-fff').val(0);
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
        $('#total_final_amount').val(0);
        $('#total_m_s_amount').val(0);
        $('#payble_price').val(0.00);
        $('#gst_amount').val(0);
        $('#total-service-amount').val(0);
        $('#amount_to_paid').val(0);
       
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>salon/Ajax_controller/get_package_details_ajax",
            data: {
                'package_name_id': $('#package_name').val(),
            },
            success: function(data) {
                var parsedData = JSON.parse(data);
                console.log(parsedData);
                $('#total_service_amount_t').html(parsedData.amount);
              
                calculateFinaltotalamount(parsedData.amount);
                $('#tt_ff_aa').val(parsedData.amount);
                var product_data = <?php echo json_encode($product_list) ?>;
                var p_length = product_data.length;

                var service_data = <?php echo json_encode($service_list) ?>;
                var service_length = service_data.length;

                $('.pacakge-box-detail').show();
                $('#pacakage_name_t').html(parsedData.package_name);

                p_product_l=parsedData.product_name.length;
              
                service_P_l = parsedData.service_name.length;
                var count=0;

                for(var k=0; k<service_P_l; k++){
                    if(parsedData.service_name[k] != ','){
                        for(var l=0; l<service_length; l++){
                            if(service_data[l].id == parsedData.service_name[k]){
                                showpacakgeservices_auto(service_data[l].id,service_data[l]. final_price);
                                total_service_time(service_data[l].service_duration);
                            }
                        }
                    }
                }

                for(var j=0; j<p_product_l; j++){
                    if(parsedData.product_name[j] !== ','){

                        for(var i=0; i<p_length; i++){
                            if(product_data[i].id == parsedData.product_name[j]){
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
                                add_package_product(product_data[i].id,product_data[i].selling_price);
                                $('.package-product-detail-box').append('<div class="row"><div class="col-md-1 col-sm-6 col-xs-12" id="packageproduct_'+ product_data[i].id +
                                                                       '"><input class="PP_Product" onclick="add_package_product('+ product_data[i].id +',' + product_data[i].selling_price + ')" type="checkbox" id="packageproduct_check_'+ product_data[i].id +'" checked></div>\
                                                                        <div class="col-md-6 col-sm-6 col-xs-12" id="packageproduct_name_'+ product_data[i].id +'">'+ product_data[i].product_name +'</div>\
                                                                        </div>');
                                count++;
                            }
                        }
                    }
                }


                for(var k=0; k<service_P_l; k++){
                    if(parsedData.service_name[k] != ','){
                        for(var l=0; l<service_length; l++){
                            if(service_data[l].id == parsedData.service_name[k]){
                                $('.pacakge_detail_').append('<div class="">\
                                                                    <div class="col-md-6 col-sm-12 col-xs-12" id="package_service_name">\
                                                                        <div id="package_services"><input id="pacakge_service_check'+ service_data[l].id +'" onclick="showpacakgeservices('+ service_data[l].id +','+ service_data[l]. final_price +')" type="checkbox" checked> '+ service_data[l]. service_name +'</div>\
                                                                    </div>\
                                                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" id="package_service_price">\
                                                                        <p id="pacakge_price_t">Rs. '+ service_data[l]. final_price +'</p>\
                                                                    </div>\
                                                                    <div class="col-md-2 col-sm-12 col-xs-12" id="package_service_product"><p onclick="togglepackageproduct()"  class="package-product-model" onclick="">'+ count +'/10</P></div>\
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
    function calculateFinaltotalamount(amount){
        var m_discount=$('#m_discount').val(); 
        var gift_discount=$('#gift_discount').val(); 

            var ttt_amount = $('#total-service-amount').val();
            var product_gst = parseFloat($('#product_gst_amount').val());
            $('#total-service-amount').val(parseFloat(amount) + parseFloat(ttt_amount));
            // $('#total_service_amount_t').html(parseFloat(amount) + parseFloat(ttt_amount));
            $('#service_price').val(parseFloat(amount) + parseFloat(ttt_amount));
            $('#tt_ff_aa').val(parseFloat(amount) + parseFloat(ttt_amount));
            var pay_amount=$('#total-service-amount').val();
            var aa_pp=0;
            var ffff=0;
        if ($('#m_discount_type').val() == 1) {
            aa_pp=(parseFloat(pay_amount) - m_discount);
           
        } else if ($('#m_discount_type').val() == 0){
            aa_pp=(parseFloat(pay_amount) * (1 - m_discount / 100));
            
        }

        if ($('#gift_discount_type').val() == 1) {
            ffff=(parseFloat(pay_amount) - gift_discount);
           
        } else if ($('#gift_discount_type').val() == 0){
            ffff=(parseFloat(pay_amount) * (1 - gift_discount / 100));
           
        }
        $('#total_m_s_amount').val((aa_pp - pay_amount).toFixed(2));
        $('#gift_card_amount').val((ffff - pay_amount).toFixed(2));
        var hhhh=parseFloat((aa_pp+ffff)-pay_amount)
        $('#payble_price').val(parseFloat(hhhh).toFixed(2));
        $('#total_final_amount').val(parseFloat(hhhh).toFixed(2));
        $('#ppp_aaa').html(parseFloat(hhhh).toFixed(2));
        $('#amount_to_paid').val(parseFloat(hhhh).toFixed(2));
        calculate_gst_amount(hhhh); 
    }
</script>

<!-- add services auto  -->


<script>
    function showpacakgeservices_auto(service_id,price) {
            
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
                                // totalserviceamount(record.final_price);
                                // total_service_time(record.service_duration);
    
                                $('.pacakge_service_tittle').append('<div class="row pacakge-services-t'+ record.id +'">\
                                                                        <div class="service_detail_name">'+ record.service_name  +'</div>\
                                                                        <div class="service_detail_price">Rs.'+ record.final_price  +'</div>\
                                                                        </div>\
                                                                    <div class="row package_stylist_and_time package_stylist_and_time_'+ record.id +' ">\
                                                                       <div onclick="gettimeslotbycurrentshift(' + record.id + ')" class="pacakge_detail_time_slot col-md-5 stylist_time_slot_' + service_id + '"><i class="fa-solid fa-caret-down"></i> Time Slot</div>\
                                                                        <div class="service_detail_stylist_name col-md-5" id="stylist_name_t' + record.id + '">Select Stylist</div>\
                                                                        <div class="cancel_pacakage_service_btn  col-md-2"><i onclick="cancel_pacakge_service('+ record.id +','+ record.final_price  +','+ record.service_duration +')" class="fa-solid fa-xmark"></i></div>\
                                                                    </div>');
    
                                $('.service-payment').append('<div class="service_detail_' + service_id + '"><div class="col-md-6 col-sm-12 col-xs-12">\
                                                                    <p>' + record.service_name + '</p>\
                                                                </div>\
                                                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"></div>\
                                                                <div class="col-md-2 col-sm-12 col-xs-12">\
                                                                    <p>' + record.final_price + '</p>\
                                                                </div></div>');
    
                            });
                        }
                    },
                });
        }
     
</script>

<!-- add services by click on input -->

<script>
    function showpacakgeservices(service_id,price) {
            
       
        var checkBox = document.querySelector('#pacakge_service_check' + service_id + '');
       
        if (checkBox.checked == false) 
        {
            // console.log(checkBox);
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
                            cancel_pacakge_service(record.id, record.final_price,record.service_duration);
                        });
                    }
                },
            });
        }
         else
         {
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
                            // totalserviceamount(record.final_price);
                            total_service_time(record.service_duration);

                            $('.pacakge_service_tittle').append('<div class="row pacakge-services-t'+ record.id +'">\
                                                                    <div class="service_detail_name">'+ record.service_name  +'</div>\
                                                                    <div class="service_detail_price">Rs.'+ record.final_price  +'</div>\
                                                                    </div>\
                                                                <div class="row package_stylist_and_time package_stylist_and_time_'+ record.id +' ">\
                                                                   <div onclick="gettimeslotbycurrentshift(' + record.id + ')" class="pacakge_detail_time_slot col-md-5 stylist_time_slot_' + service_id + '"><i class="fa-solid fa-caret-down"></i> Time Slot</div>\
                                                                    <div class="service_detail_stylist_name col-md-5" id="stylist_name_t' + record.id + '">Select Stylist</div>\
                                                                    <div class="cancel_pacakage_service_btn  col-md-2"><i onclick="cancel_pacakge_service('+ record.id +','+ record.final_price  +','+ record.service_duration +')" class="fa-solid fa-xmark"></i></div>\
                                                                </div>');

                            $('.service-payment').append('<div class="service_detail_' + service_id + '"><div class="col-md-6 col-sm-12 col-xs-12">\
                                                                <p>' + record.service_name + '</p>\
                                                            </div>\
                                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"></div>\
                                                            <div class="col-md-2 col-sm-12 col-xs-12">\
                                                                <p>' + record.final_price + '</p>\
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
        $('#ttt-fff').val(final_ttt+"Min");
    } 
  }
</script>


<!-- pacakage product total amount -->

<script type="text/javascript">
    function add_package_product(p_id,price) { 
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
        for(var j=0; j<p_length; j++){
            if(p_id == product_data[j].id)
            {
                var p_name=product_data[j].product_name;
            }
        }
            $('.package_service_product_and_price').append('<div class="pacakge_product_detail_'+p_id+'"><div class="col-md-6">\
                                                        <div class="">'+ p_name +'</div>\
                                                    </div>\
                                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">\
                                                        <div class="service_product_price">'+ price +'</div>\
                                                    </div>\
                                                    <div class="col-md-2">\
                                                       <i onclick="CancelProduct('+ price +','+ p_id +')" class="fa-solid fa-xmark cancel-pacakge-product-btn"></i>\
                                                    </div>');

           $('.service_product_payment').append('<div class="product_detail_'+ p_id +'">\
                                                        <div class="col-md-8 col-sm-12 col-xs-12">\
                                                            <span>'+ p_name +'</span>\
                                                        </div>\
                                                        <div class="col-md-2 col-sm-12 col-xs-12"></div>\
                                                        <div class="col-md-2 col-sm-12 col-xs-12">\
                                                            <span>'+ price +'</span>\
                                                        </div>\
                                                    </div>');

    }
</script>

<!-- cancel pacakge service -->

<script type="text/javascript">
   function cancel_pacakge_service(service_id, amount,time) {
   
        $('.pacakge-services-t' + service_id).hide();
        $('.package_stylist_and_time_' + service_id).hide();
        $('.service_detail_' + service_id).hide();
        $('#pacakge_service_check' + service_id).prop("checked", false);

        var ttt_ddd = parseInt($('#ttt-fff').val(), 10) || 0;
        var parsedTime = parseInt(time, 10);
        if (!isNaN(parsedTime)) {
            var final_ttt = ttt_ddd - parsedTime;
            $('#ttt-fff').val(final_ttt+"Min");
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

