<?php include('header.php'); 
$tomorrow = date('Y-m-d', strtotime('+1 day'));
if(!empty($booking_rules)){
    $days_early_booking = $booking_rules->max_booking_range_day;
    if($days_early_booking != ""){
        $max_date = date('d-m-Y', strtotime('+'.$days_early_booking.' day'));
    }else{
        $max_date = date('d-m-Y', strtotime('+0 day'));
    }
}else{
    $max_date = date('d-m-Y', strtotime('+0 day'));
}
$today = date('d-m-Y');

if(isset($_GET['start']) && $_GET['start'] != ""){
    $start = $_GET['start'];
    $start_date = date('d-m-Y',strtotime($_GET['start']));
    $start_time = date('H:i:s',strtotime($_GET['start']));
}else{
    $start = '';
    $start_date = '';
    $start_time = '';
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/clockpicker/dist/jquery-clockpicker.min.css">
<style>
  /* Styles for the loader */
  .loader_div{
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
  --d:22px;
  width: 4px;
  height: 4px;
  border-radius: 50%;
  color: #0056d0;
  box-shadow: 
    calc(1*var(--d))      calc(0*var(--d))     0 0,
    calc(0.707*var(--d))  calc(0.707*var(--d)) 0 1px,
    calc(0*var(--d))      calc(1*var(--d))     0 2px,
    calc(-0.707*var(--d)) calc(0.707*var(--d)) 0 3px,
    calc(-1*var(--d))     calc(0*var(--d))     0 4px,
    calc(-0.707*var(--d)) calc(-0.707*var(--d))0 5px,
    calc(0*var(--d))      calc(-1*var(--d))    0 6px;
  animation: l27 1s infinite steps(8);
}
@keyframes l27 {
  100% {transform: rotate(1turn)}
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
.ui-menu .ui-menu-item-wrapper{
    padding: 9px !important;
}  
.selected_service_name{
    font-size: 14px;
    margin-left: 20px;
}

.single_service_details_append {
      margin: 0px 0px;
      padding: 10px 12px;
      border: 1px solid #ccc;
      border-radius: 5px;
  }
  .package_div_row{
    margin-left: 0px;
    margin-right: 0px;
  }
  .all_services_div .row{
    display: flex;
    align-items: center;
    margin-bottom: 15px;
  }
  .all_services_div .row:first-child{
    margin-top: 15px;
  }
  .single_service_details_append .title_c{
      line-height: 35px;
      margin-bottom: 10px;
      font-weight: 900;
  }
  .single_service_details_append{
      position: static;
      top: 0;
      right: 18px;
      font-size: 16px;
      color: #979292;
      margin-bottom: 15px;
      background-color: #f6f8fb;
  }
  .noserviceavl{
    text-align: center;
    float: none;
    display: block;
    padding: 15px 0px;
    background-color: #ff2b2b1a;
    /* border: 1px solid #f00; */
    border-radius: 8px;
  }
  .product_model_a{
    margin: 0px;
    background-color: transparent;
    border: none;
  }
  .single_service_details_append .form-control{
      width: 100% !important;
      border: 1px solid #ccc !important;
      margin: 0px;
  }
  .single_service_details_append .service-search-icon{
    top: 0;
  }
  .cards-slider .slick-prev:before, .slick-next:before{
    color: #000 !important;
  }
  .page-title h3{
    margin: 9px 0;
    font-size: 18px;
    font-weight: 800;
    color: #0056d0;
  }
  span.description-txt{
    font-size: 10px;
    color: #898989;
  }
  .cards-slider .card{
    /* border: 1px solid #0056d0; */
    border-radius: 8px;
    margin-bottom: 10px;
    margin-top: 10px;
    padding: 10px;
    background-color: #feefdc;
    min-height: 75px;
  }
  .cards-slider .card h4{
    margin-top: 0px;
    margin-bottom: 0px;
    color: #d29b5f;
    font-size: 14px;
  }
  .cards-slider .card p{
    color: #646464;
    margin: 0px;
    font-size: 11px;
  }
 .cards-slider .slick-prev, .slick-next{
    top: 45%;
    display: none !important    ;
  }
  .cards-slider .slick-next {
    right: -20px;
}
.cards-slider .slick-prev {
    left: -20px;
}
.cards-slider .card .card_header{
    display: flex;
    justify-content: start;
    align-items: center;
}
.cards-slider .card .card_header span{
    color: #d29b5f;
    font-size: 14px;
    font-weight: 500;
}
.cards-slider .card .read_link{
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




</style>
<div class="right_col salon_booking_area" role="main" id="overlay">
    <div class="">
        <div class="page-title row">
            <div class=" col-lg-8">
                <h3>
                    Add New Booking
                </h3>
            </div>
            <!-- <div class=" col-lg-4">
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
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card_header">
                            <h4><?=$offers_list_result->offers_name;?></h4>
                            <span><?=$off_text;?></span>
                            </div>
                          
                            <p><?=$offers_list_result->description;?></p>
                            <p <?php if($services_names != ""){ ?>data-tooltip="<?=$services_names;?>"<?php } ?> class="read_link"><a href="">Read more..</a></p>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <?php } ?>
            </div> -->
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <form method="post" name="booking_form" id="booking_form" enctype="multipart/form-data">
            <!-- side bar customer info -->
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12" style="position: relative;">
                                    <input autocomplete="off" maxlength="10" type="text" class="form-control" name="phone" id="phone" placeholder="Search by mobile number"><a class="search-icon" href="#"><i class="fa fa-search"></i></a>
                                    <div id="phone_not_found" style="display:none; color: red;"></div>
                                </div>
                                <div class="customer-info-by-search">
                                    <div></div>
                                </div>
                            </div>
                            <div class="row" id="customer_info_div" style="display:none;">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12" id="not_member_div">

                                </div>
                                <div class="row" style="text-align: center;">
                                    <div class="col-md-12 col-sm-12 col-xs-12 customer-profile-box" name="profile_photo" id="profile_photo"></div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <b id="customer_name_t"></b><br>
                                        <p id="add_date"></p>
                                        <p id="rewards_balance"></p>
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
                                                        <a href="#customer_notes" data-toggle="tab">Notes</a>
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
                <!-- middel bar service info -->
                <div class="col-md-5 col-sm-12 col-xs-12" id="service_package_details_div" style="display:block;">
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
                                                        <option class="option_placeholder" value="">Select category</option>
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
                                            <div class="row pacakge-box">
                                                <div class="form-group">
                                                    <select class="form-select form-control chosen-select" name="package_name" id="package_name">
                                                        <option value="">Select Package</option>
                                                        <?php 
                                                            if (!empty($package_list)) {
                                                                foreach ($package_list as $package_list_result) { 
                                                        ?>
                                                        <option value="<?= $package_list_result->id ?>"><?= $package_list_result->package_name ?></option>
                                                        <?php }} ?>
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
                <div class="col-md-5 col-sm-12 col-xs-12" id="service_package_details_empty_div" style="display:none;">
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
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" id="pricing_details_div" style="display:block;">
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
                                    </div>
                                </div>
                                <hr class="break_line">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <!-- <label for="service_date">Select Service Date</label> -->
                                        <input type="text" class="form-control" placeholder="Select Service Date" name="service_date" id="service_date" value="<?php echo $start_date; ?>">
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <!-- <label for="service_date">Select Slot Hr</label> -->
                                        <input type="text" class="form-control" placeholder="Select Service Date" name="service_date" id="service_date" value="<?php echo $start_date; ?>">
                                    </div>
                                </div>
                                <div class="row service-payment-title hhh_ccc_span">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <span style="font-size: 15px;">Services</span>
                                    </div>
                                    <div id="selected_services_empty">
                                        <div class="row single_added_service_details">
                                            <div class="col-md-12 col-sm-12 col-xs-12 selected-servicesbox">
                                                <label class="noserviceavl" style="background-color:transparent !important; font-size: 11px !important;color: #4c4c4c !important;">Service not selected</label>
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
                                                <label class="noserviceavl" style="background-color:transparent !important; font-size: 11px !important; color: #4c4c4c !important;">Product not selected</label>
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
                                <input type="hidden" id="used_rewards" name="used_rewards" value="0.00">
                                <input type="hidden" id="selected_coupon_id_hidden" name="selected_coupon_id_hidden" value="">
                                <!-- <div class="row total_payable_amount">
                                    <div class="col-md-7 col-sm-12 col-xs-12">
                                        <span class="span_title_side_bar">Coupon Discount</span>
                                    </div>
                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                    </div>
                                    <div class="col-md-2 col-sm-12 col-xs-12 payable_amount  text-right">
                                        <span type="text" id="coupon_discount_text" class="total_product_amount_t">0.00</span>
                                    </div>
                                </div>
                                <hr class="break_line"> -->
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
                                    <div class="col-md-7 col-sm-12 col-xs-12">
                                        <span class="span_title_side_bar">GST (18%)</span>
                                    </div>
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
                                <div class="row amount_to_paid_title">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <span class="span_title_side_bar">Apply Coupon</span>
                                    </div>
                                    <?php
                                    if(!empty($coupon_list)){ 
                                        foreach($coupon_list as $coupon_list_result){ 
                                    ?>
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <span class="span_title_side_bar"><?=$coupon_list_result->coupon_name;?></span>
                                    </div>
                                    <input type="hidden" name="coupon_id_<?=$coupon_list_result->id?>" id="coupon_id_<?=$coupon_list_result->id?>" value="<?=$coupon_list_result->id?>">
                                    <input type="hidden" name="coupon_expiry_<?=$coupon_list_result->id?>" id="coupon_expiry_<?=$coupon_list_result->id?>" value="<?=$coupon_list_result->coupan_expiry?>">
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
                                <hr class="break_line">
                                <div class="row amount_to_paid_title">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <span class="span_title_side_bar">Apply Gift Card</span>
                                    </div>
                                    <div class="col-md-9 col-sm-12 col-xs-12">
                                        <input type="text" id="giftcard" name="giftcard" class="form-control" placeholder="Enter Gift Card No" style="height: 30px;">
                                    </div>
                                    <div class="col-md-3 col-sm-12 col-xs-12" style="text-align:right;padding-right:0px;">
                                        <button id="giftcard_button" class="btn btn-success" type="button" style="font-size:10px; padding:5px 12px;" onclick="applyGiftCard()">Apply</button>
                                        <button id="giftcard_remove_button" class="btn btn-warning" type="button" onclick="if(confirm('Are you sure you want to remove the gift card?')) removeGiftCard();" style="display:none;font-size:10px; padding:5px 12px;">Remove</button>
                                    </div>
                                    <label id="giftcard_error" class="error" style="display:none;"></label>
                                    <input type="hidden" id="giftcard_discount" name="giftcard_discount" value="0.00">
                                    <input type="hidden" id="is_giftcard_applied" name="is_giftcard_applied" value="0">
                                    <input type="hidden" id="applied_giftcard_id" name="applied_giftcard_id" value="">
                                </div>
                                <hr class="break_line">
                                <div class="row amount_to_paid_title" id="customer_rewards_div" style="display:none;">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <span class="span_title_side_bar">Apply Rewards</span>
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <span class="span_title_side_bar" id="customer_rewards_text"></span>
                                        <input type="hidden" name="customer_reward_available" id="customer_reward_available" value="">
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xs-12" style="text-align:right;padding-right:0px;">
                                        <button id="rewards_button" class="btn btn-success" type="button" style="font-size:10px; padding:5px 12px;" onclick="applyRewards()">Apply</button>
                                        <button id="rewards_remove_button" class="btn btn-warning" type="button" onclick="if(confirm('Are you sure you want to remove the reward points?')) removeRewards();" style="display:none;font-size:10px; padding:5px 12px;">Remove</button>
                                    </div>
                                </div>
                                <div class="row reminder_box_input">
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
                                        <div class="col-lg-12">
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
                                <div class="row reminder_box_input">
                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                        <textarea type="text" class="form-control" name="note" id="note" placeholder="Add Note"></textarea>
                                    </div>
                                </div><br>
                                <hr class="break_line">
                                <div class="row reminder_box">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <span class="span_title_side_bar">Select Remainder Message type <b class="require">*</b></b>
                                    </div><br><br>
                                    <div class="row reminder_box">
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <input type="radio" name="reminder" id="sms" value="1" placeholder="Add Note">
                                            <label>SMS</label>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <input type="radio" name="reminder" id="email_btn" value="2" placeholder="Add Note">
                                            <label>Email</label>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <input type="radio" name="reminder" id="whatsapp" value="3" placeholder="Add Note">
                                            <label>Whatapp</label>
                                        </div>
                                        <label class="error" id="customer_error" style="display:none;">Please select reminder type!</label>
                                        <label class="error" id="select_service_error" style="display:none;">Please select reminder type!</label>
                                        <label class="error" id="stylist_timeslot_error" style="display:none;"></label>
                                        <label for="reminder" generated="true" class="error" style="display:none;">Please select reminder type!</label>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                        <input type="hidden" id="customer_name" name="customer_name" value="">
                                        <input type="hidden" id="customer_gender" name="customer_gender" value="">
                                        <input type="hidden" name="is_member" id="is_member" value="0">
                                        <input type="hidden" name="membership_id" id="membership_id" value="">
                                        <input type="hidden" name="membership_discount_type" id="membership_discount_type" value="">
                                        <input type="hidden" name="membership_service_discount" id="membership_service_discount" value="">
                                        <input type="hidden" name="membership_product_discount" id="membership_product_discount" value="">
                                    </div>
                                    <div class="row confirm_btn_box">
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <button class="btn btn-info" style="width: 350px;" id="booking_button" name="booking_button" value="booking_button">Confirm Booking</button>
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
<div  class="loader-new"></div>
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
                    <label class="error" id="mobile_error" style="display:none;">Please select reminder type!</label>
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

<?php include('footer.php');?>
<script src="https://cdn.jsdelivr.net/npm/clockpicker/dist/jquery-clockpicker.min.js"></script>
<script>
    var active_offers = <?php echo json_encode($offers_list) ?>;
    var user_selected_service = [];
    var user_selected_products = [];
    
    var user_selected_package_service = [];
    var user_selected_package_products = [];
    var user_selected_single_service = [];
    var user_selected_single_products = [];
    var user_selected_regular_service = [];
    var user_selected_regular_products = [];

    var user_selected_stylist_timeslots = [];
    var selected_slot_start = '<?php echo  ($start != "") ? date('Y-m-d H:i:s',strtotime($start)) : ''; ?>';
    var selected_slot_start_date = '<?php echo ($start != "") ? date('d-m-Y', strtotime($start)) : ''; ?>';
    var selected_slot_start_time = '<?php echo  ($start != "") ? date('H:i:s',strtotime($start)) : ''; ?>';
    var selected_stylist = '<?php echo $stylist; ?>';
    var selected_customer = '<?php echo $customer; ?>';

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
        $("#service_date").datepicker({
            dateFormat: 'dd-mm-yy',
            maxDate: '<?php echo $max_date; ?>',
            minDate: '<?php echo $today; ?>',
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

        var default_category = <?php echo json_encode($default_category) ?>;
        for (var i = 0; i < default_category.length; i++) {
            create_service_div(default_category[i].id,'default');
        }

        if(selected_customer != ""){
            get_customer_info(selected_customer);
        }
        
        $('#booking_form').validate({
            rules: {
                reminder: 'required',
            },
            messages: {
                reminder: 'Please select reminder type!',           
            },
            submitHandler: function(form) {
                $('#select_service_error').html('');
                $('#select_service_error').hide();
                $('#customer_error').html('');
                $('#customer_error').hide();
                if($('#grand_total_hidden').val() == '0.00' || $('#grand_total_hidden').val() == '' || $('#grand_total_hidden').val() == '0'){
                    $('#select_service_error').html('Please select atleast one service');
                    $('#select_service_error').show();
                }else{
                    if($('#customer_name').val() == ''){
                        $('#customer_error').html('Please select customer');
                        $('#customer_error').show();
                    }else{
                        var validation_flag = 1;
                        $(".service_stylist_timeslot_hidden").each(function () {
                            if ($(this).val() == "") {
                                validation_flag = 0;
                                return false;
                            }
                        });

                        if (validation_flag == 1) {
                            if (confirm("Are you sure you want to confirm booking?")) {
                                $("#stylist_timeslot_error").hide('');
                                $("#stylist_timeslot_error").html('');

                                $('#select_service_error').html('');
                                $('#select_service_error').hide();
                                $('#customer_error').html('');
                                $('#customer_error').hide();

                                form.submit();
                            } else {
                                $('#select_service_error').html('');
                                $('#select_service_error').hide();
                                return false;
                            }
                        } else {
                            $("#stylist_timeslot_error").show('');
                            $("#stylist_timeslot_error").html('Please select stylists for the selected service'); 
                        }
                    }
                }
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
        var selectedCategoryId = $(this).val();
        create_service_div(selectedCategoryId,'manual');
    });
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
                    $('.customer-info-by-search div').html('<div onclick="get_customer_info(' + parsedData.id + ')">' + parsedData.full_name + '</div>');
                } else {
                    $('.customer-info-by-search').show();
                    $('.customer-info-by-search div').html('Customer Not Found! Please Add New Customer.<b onclick="open_customer_model()" class="add-new-customer">Add Customer</b>');
                }
            },
        });
    });
    function validateUniqueMobile(){
        var customer_phone = $('#customer_phone').val();
        $.ajax({
        type: "POST",
        url: "<?=base_url();?>salon/Ajax_controller/get_unique_customer_mobile",
        data:{'customer_phone':customer_phone},
        success: function(data){console.log(data);
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
        $("#customer_phone").val($("#phone").val());
    }
    function get_customer_info(id) { 
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
            // $('#services_div').html('');
            // $('#selected_services').html('');
            // $('#selected_products').html('');
            // $('#package_div').html('');       
            $('#not_member_div').html(''); 

            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>salon/Ajax_controller/get_customer_details_for_booking_ajax",
                data: { 'id': id },
                success: function(data) {     
                    user_selected_service = [];
                    user_selected_products = [];
                    
                    user_selected_package_service = [];
                    user_selected_package_products = [];
                    user_selected_single_service = [];
                    user_selected_single_products = [];  

                    $('.loader_div').hide();

                    var parsedData = JSON.parse(data);

                    $('#customer_name').val(parsedData.customer.id);
                    $('#customer_gender').val(parsedData.customer.gender);
                    $('#phone').val(parsedData.customer.full_name);

                    var booking_list = parsedData.order_history;
                    var order_service_history = parsedData.order_service_history;
                    var baseUrl = '<?= base_url() ?>';

                    if(order_service_history.length > 0){
                        for (var x = 0; x < order_service_history.length && x < 5; x++) {
                            if (parsedData.customer.id == order_service_history[x].customer_name && order_service_history[x].service_date != null && order_service_history[x].service_date != "") {
                                var serviceFrom = moment(order_service_history[x].service_from).format('hh:mm A');
                                var serviceTo = moment(order_service_history[x].service_to).format('hh:mm A');
                                var serviceDate = moment(order_service_history[x].service_date).format('DD MMM YYYY');

                                $('#customer_activity').append('<div class="acticity_timeline_circle"></div>' +
                                    '<div class="single_activity_box"><div class="cleint-activity activity_service_name">' + order_service_history[x].service_name + ' | ' + order_service_history[x].service_name_marathi + '</div>' +
                                    '<div class="cleint-activity">' + serviceDate + ', ' + serviceFrom + ' to ' + serviceTo + '</div>' +
                                    '<div class="cleint-activity">' + order_service_history[x].full_name + '</div></div>'
                                );
                            }
                        }
                    }else{ 
                        $('#customer_activity').append('<img src="<?= base_url(); ?>admin_assets/images/no_data/no_data.png" width="100%">');
                    }

                    if(booking_list.length > 0){
                        for (var x = 0; x < booking_list.length && x < 7; x++) {
                            if (parsedData.customer.id == booking_list[x].customer_name && booking_list[x].booking_date != null && booking_list[x].booking_date != "") {
                                var bookingDate = moment(booking_list[x].booking_date).format('DD MMM YYYY');

                                $('#customer_notes').append('<div class="acticity_timeline_circle"></div>' +
                                    '<div class="single_activity_box"><div class="cleint-activity">' + bookingDate + '</div>' +
                                    '<div class="cleint-activity">Note: ' + booking_list[x].note + '</div></div>'
                                );
                            }
                        }
                    }else{
                        $('#customer_notes').append('<img src="<?= base_url(); ?>admin_assets/images/no_data/no_data.png" width="100%">');
                    }

                    if(booking_list.length > 0){
                        for (var x = 0; x < booking_list.length && x < 10; x++) {
                            if (parsedData.customer.id == booking_list[x].customer_name && booking_list[x].booking_date != null && booking_list[x].booking_date != "") {
                                var bookingDate = moment(booking_list[x].booking_date).format('DD MMM YYYY');

                                $('#customer_payments').append('<div class="acticity_timeline_circle"></div>' +
                                    '<div class="single_activity_box"><div class="cleint-activity">' + bookingDate + ' - Rs. ' + booking_list[x].amount_to_paid + '</div></div>'
                                );
                            }
                        }
                    }else{
                        $('#customer_payments').append('<img src="<?= base_url(); ?>admin_assets/images/no_data/no_data.png" width="100%">');
                    }

                    $('#customer_name_t').html(parsedData.customer.full_name);
                    $('#phone').val(parsedData.customer.full_name)

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
                    if(parseInt(parsedData.customer.rewards_balance) > 0){
                        $('#customer_rewards_div').show();
                        $('#customer_rewards_text').text('Balance: ' + parsedData.customer.rewards_balance);
                        $('#customer_reward_available').val(parsedData.customer.rewards_balance);
                    }

                    $('#is_member').val(parsedData.is_member);

                    if(parsedData.is_member == '1'){                       
                        $('#membership_id').val(parsedData.membership.membership_id);
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
                            '<div class="row total_payable_amount text-right">'+
                                '<div class="col-lg-10 text-left">'+
                                    '<span class="span_title_side_bar">Membership Service Discount ('+ membership_service_discount_text +')</span>'+
                                '</div>'+
                                // '<div class="col-log-4">'+
                                //     '<button type="button" class="btn btn-sm" style="background-color:'+parsedData.membership.bg_color+'; color:'+parsedData.membership.text_color+'">'+parsedData.membership.membership_name+'</button>'+
                                // '</div>'+
                                '<div class="col-lg-2">'+
                                    '<div id="membership_service_discount_amount"> 0.00</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="row total_payable_amount text-right">'+
                                '<div class="col-lg-10 text-left">'+
                                    '<span class="span_title_side_bar">Membership Product Discount ('+ membership_product_discount_text +')</span>'+
                                '</div>'+
                                // '<div class="col-log-4">'+
                                //     '<button type="button" class="btn btn-sm" style="background-color:'+parsedData.membership.bg_color+'; color:'+parsedData.membership.text_color+'">'+parsedData.membership.membership_name+'</button>'+
                                // '</div>'+
                                '<div class="col-lg-2">'+
                                    '<div id="membership_product_discount_amount"> 0.00</div>'+
                                '</div>'+
                            '</div>';
                        $('#membership_div').append(membership_div);
                        $('#membership_div').show();
                        
                        $('#not_member_div').html(
                            '<div><a class="btn btn-sm" style="float:right; background-color:'+parsedData.membership.bg_color+'; color:'+parsedData.membership.text_color+'">'+parsedData.membership.membership_name+'</a></div>'                
                        )
                    }else{
                        $('#membership_div').hide();

                        $('#not_member_div').html(
                            '<div class="membership_details"><a href="<?= base_url(); ?>asign-membership/'+ parsedData.customer.id +'" target="_blank">Not a Member</a></div>'                     
                        )
                    }
                },
            });
        }, 1500);
    }
    function create_service_div(id,type) {
        $('.loader_div').show();   
        setTimeout(function() {
            $("#sup_category option[value='" + id + "']").prop('disabled', true);
            $("#sup_category").val('').trigger("chosen:updated");

            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>salon/Ajax_controller/create_services_div_ajx",
                data: { 'category': id, 'type': type, 'active_offers': active_offers},
                success: function(data) {
                    $('.loader_div').hide();   
                    $("#services_div").prepend(data);
                },
            });
        }, 1500);
    }
    function search_service(category_id) {
        var value = $('#search_services_' + category_id).val().toLowerCase();
        $('#all_services_div_' + category_id + ' .service_name_t_' + category_id).filter(function() {
            $(this).closest('.row').toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    }
    function removeCategory(category_id) {
        if (confirm("Are you sure you want remove complete category?")) {
            $('.loader_div').show();   
            setTimeout(function() {            
                var current_total = parseFloat($('#total-service-amount').val());
                var current_product_total = parseFloat($('#total-product-amount').val());

                final_deduct_total = 0;
                final_deduct_product_total = 0;

                for(var k=0;k<user_selected_regular_service.length;k++){
                    var service_price = parseFloat($('#service_price_' + user_selected_regular_service[k]).val());

                    final_deduct_total = final_deduct_total + service_price;

                    removeServiceStylistTimeSlots(user_selected_regular_service[k]);

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
                $('#total_service_amount_t').html(parseFloat(final_total).toFixed(2));            
                
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
    }

    function setServicePrice(serviceID){
        var service_price = parseFloat($('#service_price_' + serviceID).val());
        var service_duration = $('#service_duration_' + serviceID).val();
        var service_name = $('#service_name_' + serviceID).val();
        var service_rewards = $('#service_rewards_hidden_' + serviceID).val();
        var service_added_from = $('#service_added_from_' + serviceID).val();
        var current_total = parseFloat($('#total-service-amount').val());
        
        if ($('#service_name_check_' + serviceID).is(':checked')) {
            if(!user_selected_service.includes(serviceID)){
                $("#product_modal_button_"+serviceID).attr('disabled', false).css('background-color', 'transparent');

                final_total = current_total + service_price;

                user_selected_service.push(serviceID);

                createServiceDetailsDiv(serviceID,service_added_from,service_name,service_duration,service_rewards);
            }else{
                alert('Service already selected');
                $('#service_name_check_' + serviceID).prop('checked', false);
            }
        } else {
            var selected_product = parseInt($('#selected_product_'+serviceID).text());
            if(selected_product <= 0){
                removeValue(user_selected_service, serviceID);
                removeValue(user_selected_single_service, serviceID);
                removeValue(user_selected_package_service, serviceID);

                removeGiftCard();
                $('.loader_div').show(); 

                removeServiceStylistTimeSlots(serviceID);

                $("#product_modal_button_"+serviceID).attr('disabled', true).css('background-color', 'transparent');

                final_total = current_total - service_price;

                $('#selected_service_details_' + serviceID).remove();

                $('#executive_for_service_button_' + serviceID).text('Select Stylist'); 

                if(user_selected_service.length == 0){
                    $('#selected_services_empty').show();
                }
                
                // $('.' + serviceID + '_service_products').remove();
            }else{
                alert('First remove is products before removing service');
                $('#service_name_check_' + serviceID).prop('checked', true);
            }
        }
        
        calculateTotalServiceDuration();

        $('#total-service-amount').val(parseFloat(final_total).toFixed(2));
        $('#total_service_amount_t').html(parseFloat(final_total).toFixed(2));

        setPayableServiceAmount();
    }
    function createServiceDetailsDiv(serviceID,selected_from,service_name,service_duration,service_rewards){
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

        service_details = 
            '<div class="row single_added_service_details ' + selected_from + '_added_service_details" id="selected_service_details_'+ serviceID +'">'+
                '<input type="hidden" id="service_added_from_'+ serviceID +'" value="'+ selected_from +'">'+
                '<div class="col-md-12 col-sm-12 col-xs-12 selected-servicesbox">'+
                    '<span class="left-span">'+ service_name +'</span>'+
                    '<button type="button" id="executive_for_service_button_' + serviceID + '" class="btn  modalbtn" onclick="showPopup(\'ServiceExecutiveModal_' + serviceID + '\')" data-toggle="modal" data-target="#ServiceExecutiveModal_' + serviceID + '">Select Stylist</button>'+
                    '<div class="modal fade" style="background-color: #00000080;" id="ServiceExecutiveModal_'+ serviceID +'" tabindex="-1" role="dialog" aria-labelledby="ServiceExecutiveModalLabel_'+ serviceID +'" aria-hidden="true">'+
                        '<div class="modal-dialog" role="document" style="margin-top:175px;width:1090px;">'+
                            '<div class="modal-content">'+
                                '<div class="modal-header">'+
                                    '<h4 class="modal-title" id="ServiceExecutiveModalLabel_'+ serviceID +'">'+ service_name +' Service Stylist Details:</h4>'+
                                    '<h5 class="modal-title">Service Duration: '+ service_duration +' Mins</h5>'+
                                    '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;"  onclick="closePopup(\'ServiceExecutiveModal_'+ serviceID + '\')">'+
                                        '<span aria-hidden="true">&times;</span>'+
                                    '</button>'+
                                '</div>'+
                                '<div class="modal-body">'+
                                    '<div class="row">'+
                                        '<input type="hidden"name="service_rewards_' + serviceID + '" id="service_rewards_' + serviceID + '" value="' + service_rewards + '">'+
                                        '<div class="col-lg-6">'+
                                            '<label for="service_date_' + serviceID + '">Select Date</label>'+
                                            // '<input type="date" max="<?php echo $max_date; ?>" min="<?php echo $today; ?>" class="form-control service_date" name="service_date_' + serviceID + '" id="service_date_' + serviceID + '" onchange="appendSlotsDiv(\'' + selected_slot_start + '\',' + serviceID + ',\'stylist_time_slots_' + serviceID + '\',\'regular\','+ service_duration +')"' + (selected_slot_start_date ? ' value="' + selected_formattedDate + '" readonly' : '') + '>'+
                                            '<input type="text" class="form-control service_date" placeholder="Select Service Date" name="service_date_' + serviceID + '" id="service_date_' + serviceID + '" onchange="appendSlotsDiv(\'' + selected_slot_start + '\',' + serviceID + ',\'stylist_time_slots_' + serviceID + '\',\'regular\','+ service_duration +')"' + (selected_slot_start_date ? ' value="' + selected_formattedDate + '" readonly' : '') + '>'+
                                        '</div>'+
                                        '<div class="col-lg-6">'+
                                            '<label for="service_executive_' + serviceID + '">Select Stylist</label>'+
                                            '<select class="form-control service_executive" name="service_executive_' + serviceID + '" id="service_executive_' + serviceID + '" onchange="appendSlotsDiv(\'' + selected_slot_start + '\',' + serviceID + ',\'stylist_time_slots_' + serviceID + '\',\'regular\','+ service_duration +')">'+
                                                '<option value="">Select Executive</option>';
                                                for(var i=0;i<stylists.length;i++){
                                                    var services_array = stylists[i].service_name.split(',');
                                                    if (services_array.includes(serviceID.toString())) {
                                                        if(selected_stylist != ""){
                                                            if(stylists[i].id == selected_stylist){
                                                                service_details += '<option value="'+ stylists[i].id +'">'+ stylists[i].full_name +'</option>';
                                                            }
                                                        }else{
                                                            service_details += '<option value="'+ stylists[i].id +'">'+ stylists[i].full_name +'</option>';
                                                        }
                                                    }}
                                                service_details += '</select>'+
                                        '</div>'+
                                        '<div class="col-lg-12">'+
                                            '<label>Select Timeslot</label>'+    
                                            '<div class="col-lg-12" id="stylist_time_slots_' + serviceID + '"></div>'+
                                        '</div>'+
                                        '<div class="col-lg-12">'+
                                            '<button disabled type="button" id="save_service_stylist_timeslots_' + serviceID + '" class="btn btn-primary" onclick="saveStylist(' + serviceID + ')">Save</button>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                    '<div class="span-row">'+
                    '<span class="bottom-span">'+ service_duration +' Mins</span>'+
                    '<span class="bottom-span" id="service_stylist_name_'+ serviceID +'"></span>'+
                    '<input type="hidden" id="service_stylist_id_'+ serviceID +'" name="service_stylist_id_'+ serviceID +'" value="">'+
                    '<input type="hidden" id="service_reward_points_'+ serviceID +'" name="service_reward_points_'+ serviceID +'" value="">'+
                    '<span class="bottom-span" id="service_stylist_timeslot_'+ serviceID +'"></span>'+
                    '<input type="hidden" class="service_stylist_timeslot_hidden" id="service_stylist_timeslot_hidden_'+ serviceID +'" name="service_stylist_timeslot_hidden_'+ serviceID +'" value="">'+
                    '</div>'+
                    '</div>'+
             
           
            '</div>';
        $('#selected_services_empty').hide();
        $('#selected_services').append(service_details);
        $("#service_date_" + serviceID).datepicker({
            dateFormat: 'dd-mm-yy',
            maxDate: '<?php echo $max_date; ?>',
            minDate: '<?php echo $today; ?>',
        });
    }
    function removeServiceStylistTimeSlots(serviceID){
        for (var i = 0; i < user_selected_stylist_timeslots.length; i++) {
            var entry = user_selected_stylist_timeslots[i];
            var entryParts = entry.split('###');
            if (entryParts[0] === serviceID.toString()) {
                user_selected_stylist_timeslots.splice(i, 1);
                i--;
            }
        }
    }
    function insertStylistTimeslotSelection(serviceID, stylistID, selectedDate, selectedSlot) {
        removeServiceStylistTimeSlots(serviceID);
        
        var stylistStr = serviceID + '###' + stylistID + '###' + selectedDate + '###' + selectedSlot;
        user_selected_stylist_timeslots.push(stylistStr);
    }
    function validateStylistTimeslot(serviceID, stylistID, selectedDate, selectedSlot) {
        var overlap_flag = 1;
        for (var j = 0; j < user_selected_stylist_timeslots.length; j++) {
            var singleArray = user_selected_stylist_timeslots[j].split('###');

            var singleSelectedService = singleArray[0];
            var singleSelectedStylist = singleArray[1];
            var singleSelectedDate = singleArray[2];
            var singleSelectedSlotFrom = singleArray[3].split(' to ')[0];
            var singleSelectedSlotTo = singleArray[3].split(' to ')[1];

            // if(stylistID == singleSelectedStylist){
                var selectedSlotFrom = selectedSlot.split(' to ')[0];
                var selectedSlotTo = selectedSlot.split(' to ')[1];

                var selectedSlotFromParts = selectedSlotFrom.split(':');
                var selectedSlotToParts = selectedSlotTo.split(':');
                var singleSelectedSlotFromParts = singleSelectedSlotFrom.split(':');
                var singleSelectedSlotToParts = singleSelectedSlotTo.split(':');

                var selectedSlotFromDate = new Date(selectedDate);
                selectedSlotFromDate.setHours(parseInt(selectedSlotFromParts[0], 10), parseInt(selectedSlotFromParts[1], 10), 0, 0);

                var selectedSlotToDate = new Date(selectedDate);
                selectedSlotToDate.setHours(parseInt(selectedSlotToParts[0], 10), parseInt(selectedSlotToParts[1], 10), 0, 0);

                var singleSelectedSlotFromDate = new Date(singleSelectedDate);
                singleSelectedSlotFromDate.setHours(parseInt(singleSelectedSlotFromParts[0], 10), parseInt(singleSelectedSlotFromParts[1], 10), 0, 0);

                var singleSelectedSlotToDate = new Date(singleSelectedDate);
                singleSelectedSlotToDate.setHours(parseInt(singleSelectedSlotToParts[0], 10), parseInt(singleSelectedSlotToParts[1], 10), 0, 0);

                if((selectedSlotFromDate.getTime() >= singleSelectedSlotFromDate.getTime() && selectedSlotFromDate.getTime() <= singleSelectedSlotToDate.getTime()) || (selectedSlotToDate.getTime() >= singleSelectedSlotFromDate.getTime() && selectedSlotToDate.getTime() <= singleSelectedSlotToDate.getTime())){
                    if(selectedSlotFromDate.getTime() === singleSelectedSlotFromDate.getTime() && selectedSlotToDate.getTime() === singleSelectedSlotToDate.getTime() && stylistID === singleSelectedStylist && singleSelectedService == serviceID){
                        overlap_flag = 1;
                        break;
                    }else{
                        overlap_flag = 0;
                    }
                }
            // }
        }
        
        if(overlap_flag == 1){
            return true;
        }else{
            return false;
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
    }
    function saveStylist(serviceID){   
        $("#stylist_timeslot_error").hide('');
        $("#stylist_timeslot_error").html('');
        var selectedSlot =  $('input[name^="service_stylist_time_slots_' + serviceID + '"]:checked').val();
        var selectedDate = $('#service_date_' + serviceID).val();
        if(selectedSlot != null && selectedSlot != undefined && selectedSlot !== ""){
            $('.loader_div').show();
            setTimeout(function() {
                var exampleModal = $('#ServiceExecutiveModal_'+serviceID);

                selectedSlot = selectedSlot.replace('@@@', ' to ');

                var dateParts = selectedDate.split("-");
                var newSelectedDate = new Date(dateParts[2], dateParts[1] - 1, dateParts[0]);

                var options = { day: 'numeric', month: 'short', year: 'numeric' };
                var formattedDate = newSelectedDate.toLocaleDateString('en-GB', options);

                var stylistName = $('#service_executive_' + serviceID + ' option:selected').text();
                var stylistID = $('#service_executive_' + serviceID + ' option:selected').val();
                var serviceRewards = $('#service_rewards_' + serviceID).val();

                isAllowed = validateStylistTimeslot(serviceID,stylistID,selectedDate,selectedSlot);

                if(isAllowed){
                    $('#service_stylist_timeslot_' + serviceID).text('| ' + formattedDate + ',' + selectedSlot);
                    $('#service_stylist_timeslot_hidden_' + serviceID).val(formattedDate + ',' + selectedSlot);

                    $('#service_stylist_name_' + serviceID).text('| ' + stylistName);  
                    $('#service_stylist_id_' + serviceID).val(stylistID);  
                    $('#service_reward_points_' + serviceID).val(serviceRewards);  
                    $('#executive_for_service_button_' + serviceID).text('Change Details');  

                    insertStylistTimeslotSelection(serviceID,stylistID,selectedDate,selectedSlot);

                    exampleModal.css('display','none');
                    exampleModal.css('opacity','0');
                    $('.modal-open').css('overflow','auto').css('padding-right','0px');
                    $('.loader_div').hide(); 
                }else{
                    $('.loader_div').hide(); 
                    alert('Stylist not available for selected timeslot');
                }  
            }, 1500);
        }else{
            alert('Please select Stylist Timeslot');
        }
    }
    function appendSlotsDiv(selected_start,service_id,append_to_ID,service_from,duration){
        if(service_from === 'regular'){
            var date = $('#service_date_'+service_id).val();
            var exe = $('#service_executive_'+service_id).val();
            
            $("#service_executive_"+service_id+" option[value='" + exe + "']").prop('disabled', false);

            $('#save_service_stylist_timeslots_' + service_id).prop('disabled', false);
        }else{

        }

        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>salon/Ajax_controller/get_stylist_timeslots",
            data: { 'date': date, 'exe': exe, 'duration': duration, 'service_id': service_id, 'selected_start': selected_start },
            success: function(data) {
                $("#"+append_to_ID).html('');
                $("#"+append_to_ID).append(data);
            },
        });
    }
    function setServiceProductPrice(serviceID,productID){  
        var product_price = parseFloat($('#product_price_'+serviceID+'_'+productID).val());
        var product_name = $('#product_name_'+serviceID+'_'+productID).val();
        var product_added_from = $('#product_added_from_'+serviceID+'_'+productID).val();
        var current_total = parseFloat($('#total-product-amount').val());
        var selected_product = parseInt($('#selected_product_'+serviceID).text());

        if ($('#product_checkbox_'+serviceID+'_'+productID).is(':checked')) {      
            if(!user_selected_products.includes(productID)){
                final_total = current_total + product_price;
                selected_product = selected_product + 1;

                user_selected_products.push(productID);
                
                createServiceProductDetailsDiv(productID,product_added_from,product_name,serviceID);
            }else{
                alert('Product already selected');
                $('#product_checkbox_' + serviceID+'_'+productID).prop('checked', false);
            }
        } else {
            removeValue(user_selected_products, productID);
            removeValue(user_selected_single_products, productID);
            removeValue(user_selected_package_products, productID);

            final_total = current_total - product_price;
            selected_product = selected_product - 1;

            $('#selected_service_product_details_'+ productID).remove();

            if(user_selected_products.length == 0){
                $('#selected_products_empty').show();
            }
        }

        if(selected_product > 0){
            $('#service_name_check_' + serviceID).prop('checked', true).css('pointer-events', 'all');
        }else{
            $('#service_name_check_' + serviceID).prop('checked', true).css('pointer-events', 'all');
        }

        $('#total-product-amount').val(parseFloat(final_total).toFixed(2));
        $('#total_product_amount_t').text(parseFloat(final_total).toFixed(2));
        $('#selected_product_'+serviceID).text(parseInt(selected_product));
        
        setPayableServiceProductAmount();
    }
    function createServiceProductDetailsDiv(productID,selected_from,product_name,serviceID){        
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
                    '<span>'+ product_name +'</span>'+
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
        }else{
            discount = member_service_discount;
        }

        $('#membership_service_discount_amount').text(parseFloat(discount).toFixed(2));

        payable = total_service_amount - discount - giftcard_discount;

        $('#service_payable_hidden').val(parseFloat(payable).toFixed(2));
        $('#service_payable').text(parseFloat(payable).toFixed(2));

        if(total_service_amount == payable){
            $('#total_service_amount_t').html(parseFloat(total_service_amount).toFixed(2));
        }else{
            $('#total_service_amount_t').html('<s>'+parseFloat(total_service_amount).toFixed(2)+'</s> '+parseFloat(payable).toFixed(2));
        }
        
        setPayableAmount();
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
        }else{
            discount = member_product_discount;
        }

        $('#membership_product_discount_amount').text(parseFloat(discount).toFixed(2));

        payable = total_product_amount - discount;

        $('#product_payable_hidden').val(parseFloat(payable).toFixed(2));
        $('#product_payable').text(parseFloat(payable).toFixed(2));        

        if(total_product_amount === payable){
            $('#total_product_amount_t').html(parseFloat(total_product_amount).toFixed(2));
        }else{
            $('#total_product_amount_t').html('<s>'+parseFloat(total_product_amount).toFixed(2)+'</s> '+parseFloat(payable).toFixed(2));
        }

        setPayableAmount();
    }

    function setPayableAmount(){
        service_payable = parseFloat($('#service_payable_hidden').val());
        product_payable = parseFloat($('#product_payable_hidden').val());
        package_payable = parseFloat($('#total-package-amount').val());

        payable = service_payable + product_payable + package_payable;

        $('#payable_hidden').val(parseFloat(payable).toFixed(2));
        $('#payable').text(parseFloat(payable).toFixed(2));
        $('#upper_payable').text(parseFloat(payable).toFixed(2));

        setBookingAmount();
    }

    function setBookingAmount(){
        coupon_discount = parseFloat($('#coupon_discount_hidden').val());
        reward_discount = parseFloat($('#reward_discount_hidden').val());
        payable = parseFloat($('#payable_hidden').val());

        booking = payable - coupon_discount - reward_discount;

        $('#booking_amount_hidden').val(parseFloat(booking).toFixed(2));
        $('#booking_amount_text').text(parseFloat(booking).toFixed(2));

        setGST();
    }

    function setGST(){
        rate = 18;
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
        var selectedPackageId = $(this).val();
        create_package_div(selectedPackageId,'manual');
    });    
    function create_package_div(id,type) {
        $('.loader_div').show();   
        setTimeout(function() {
            if($("#customer_name").val() != ""){
                // $("#package_name option[value='" + id + "']").prop('disabled', true);
                $("#package_name option").prop('disabled', true);
                $("#package_name").val('').trigger("chosen:updated");

                $.ajax({
                    type: "POST",
                    url: "<?= base_url(); ?>salon/Ajax_controller/create_package_div_ajx",
                    data: { 'package': id, 'type': type, 'customer': $("#customer_name").val() },
                    success: function(data) {
                        $('.loader_div').hide();   
                        $("#package_div").append(data);
                        setPackagePrice(id);
                    },
                });
            }else{
                $('.loader_div').hide(); 
                alert('First select customer')
            }
        }, 1500); 
    }
    function removePackage(packageID) { 
        $('.loader_div').show();   
        setTimeout(function() {
            var package_price = parseFloat($('#package_price_hidden_' + packageID).val());
            var current_total = parseFloat($('#total-package-amount').val());

            final_total = current_total - package_price;

            $('#total-package-amount').val(parseFloat(final_total).toFixed(2));
            $('#total_package_amount_t').text(parseFloat(final_total).toFixed(2));
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
        }, 1500);
    }

    function setPackageService(packageID,serviceID){
        var service_duration = $('#package_service_duration_' + packageID + '_' + serviceID).val();
        var service_name = $('#package_service_name_hidden_' + packageID + '_' + serviceID).val();
        var service_rewards = $('#package_service_rewards_hidden_' + packageID + '_' + serviceID).val();

        if ($('#package_service_name_check_' + packageID + '_' + serviceID).is(':checked')) {
            if(!user_selected_service.includes(serviceID)){
                user_selected_service.push(serviceID);

                createServiceDetailsDiv(serviceID,'package',service_name,service_duration,service_rewards);
            }else{
                alert('Service already selected');
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
        }
        
        calculateTotalServiceDuration();
    }

    function setPackageServiceProduct(packageID,productID){
        var product_name = $('#package_product_name_hidden_'+packageID+'_'+productID).val();

        if ($('#package_product_name_check_'+packageID+'_'+productID).is(':checked')) {   
            if(!user_selected_products.includes(productID)){
                user_selected_products.push(productID);

                createServiceProductDetailsDiv(productID,'package',product_name,"");
            }else{
                alert('Product already selected');
                $('#package_product_name_check_'+packageID+'_'+productID).prop('checked', false);
            }
        } else {
            removeValue(user_selected_products, productID);            
            removeValue(user_selected_single_products, productID);
            removeValue(user_selected_package_products, productID);

            $('#selected_service_product_details_'+ productID).remove();
            
            if(user_selected_products.length == 0){
                $('#selected_products_empty').show();
            }
        }
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

        final_total = current_total + package_price;

        $('#total-package-amount').val(parseFloat(final_total).toFixed(2));
        $('#selected_package_id').val(packageID);
        $('#total_package_amount_t').text(parseFloat(final_total).toFixed(2));

        setPayableAmount();
    }

    function applyCoupon(couponId){
        if (confirm("Are you sure you want apply coupon?")) {
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

                            new_coupon_div = '<button class="btn btn-warning" type="button" onclick="if(confirm(\'Are you sure you want to remove the coupon?\')) { removeCoupon(' + couponId + ',\'new\'); }" style="font-size:10px; padding:5px 12px;" data-toggle="tooltip" data-placement="top" title="Remove Coupon">Remove</button>';

                            coupon_div.html(new_coupon_div);
                            
                            $('.loader_div').hide();   
                        }else{
                            $('.loader_div').hide();  
                            alert('Coupon code not applicable. Minimum Payable amount require: Rs.'+coupon_min_price);
                        }
                    }else{
                        $('.loader_div').hide();  
                        alert('Coupon code not applicable on applied giftcard');
                    }
                }else{
                    $('.loader_div').hide();  
                    alert('Coupon code not applicable on packages');
                }
                setBookingAmount();
                $('.loader_div').hide();  
            }, 1500);
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
            var customer_reward_available = $('#customer_reward_available').val();
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
                        minimum_reward_required = opts.minimum_reward_required;
                        maximum_reward_required = opts.maximum_reward_required;

                        consider_rewards = customer_reward_available / reward_point;
                        total_value = consider_rewards * rs_per_reward;

                        if(total_value > maximum_reward_required){
                            total_value = maximum_reward_required;
                        }
                        $('#reward_discount_hidden').val(parseFloat(total_value).toFixed(2));
                        $('#used_rewards').val(customer_reward_available);

                        setBookingAmount();

                        $('#rewards_button').hide();
                        $('#rewards_remove_button').show();

                        $('.loader_div').hide();  
                    }
                },
            });
        }, 1500);
    }
    function removeRewards(){
        $('.loader_div').show();   
        setTimeout(function() {
            $('#reward_discount_hidden').val(parseFloat(0).toFixed(2));
            
            setBookingAmount();

            $('#rewards_button').show();
            $('#rewards_remove_button').hide();

            $('.loader_div').hide();   
        }, 1500);
    }

    function applyGiftCard(){
        if (confirm("Are you sure you want apply giftcard?")) {
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
                                                        }else{
                                                            $('#giftcard_error').html('Invalid Giftcard no');
                                                            $('#giftcard_error').show();
                                                        }
                                                    }else{
                                                        $('#giftcard_error').html('Customer has used it before');
                                                        $('#giftcard_error').show();
                                                    }
                                                }else{
                                                    $('#giftcard_error').html('Allowed giftservices not selected');
                                                    $('#giftcard_error').show();
                                                }
                                            }else{
                                                $('#giftcard_error').html('Invalid Giftcard no');
                                                $('#giftcard_error').show();
                                            }

                                            $('#giftcard_discount').val(parseFloat(total_giftcard_discount).toFixed(2));
                                            $('#is_giftcard_applied').val('1');
                                            $('#applied_giftcard_id').val(giftcard_id);
                                            setPayableServiceAmount();
                                        },
                                    });
                                }else{
                                    $('.loader_div').hide();   
                                    alert('Please select services');
                                }
                            }else{
                                $('.loader_div').hide();   
                                alert('Please enter giftcard no');
                            }
                        }else{
                            $('.loader_div').hide();   
                            alert('Please select customer');
                        }
                    }else{
                        $('.loader_div').hide();   
                        alert('Giftcard not applicable on applied coupon');
                    }
                }else{
                    $('.loader_div').hide();   
                    alert('Giftcard not applicable on packages');
                }
            }, 1500);
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
    function getSlotTimes(){
        var date = $('#service_date').val();
        if(date != ""){
            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>salon/Ajax_controller/get_saloon_working_hrs_slots",
                data: { 'date': date },
                success: function(data) {  
                    var opts = $.parseJSON(data);

                },
            });
        }
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
</script>