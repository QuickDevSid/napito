<?php include('header.php'); ?>
<style>
    
 
.timeslot-loader {
    border: 5px solid #f3f3f3;
    border-top: 5px solid #3498db;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 2s linear infinite;
    margin: auto;
    margin-top: 25px;
}


.table_span{
    line-height:normal;
    font-size:12px;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
    .timeslot_box{
        padding: 5px;
        border: 1px solid #ccc;
        height: 115px;        
        display: block;
        float: left;
        width:100%;
        margin-bottom: 2px;
    }
<?php if(isset($_GET['status']) && $_GET['status'] != ""){?>
#status_chosen .chosen-single{
    color: black !important;
    background-color: #607d8b38 !important;
}
#status_chosen .chosen-container-single .chosen-single span{
    color: #000 !important;
}
<?php } ?>
<?php if(isset($_GET['from_date']) && $_GET['from_date'] != ""){?>
#from_date_chosen .chosen-single{
    color: black !important;
    background-color: #607d8b38 !important;
}
#from_date_chosen .chosen-container-single .chosen-single span{
    color: #000 !important;
}
<?php } ?>
<?php if(isset($_GET['to_date']) && $_GET['to_date'] != ""){?>
#to_date_chosen .chosen-single{
    color: black !important;
    background-color: #607d8b38 !important;
}
#to_date_chosen .chosen-container-single .chosen-single span{
    color: #000 !important;
}
<?php } ?>
<?php if(isset($_GET['customer']) && $_GET['customer'] != ""){?>
#customer_chosen .chosen-single{
    color: black !important;
    background-color: #607d8b38 !important;
}
#customer_chosen .chosen-container-single .chosen-single span{
    color: #000 !important;
}
<?php } ?>
<?php if(isset($_GET['id']) && $_GET['id'] != ""){?>
#id_chosen .chosen-single{
    color: black !important;
    background-color: #607d8b38 !important;
}
#id_chosen .chosen-container-single .chosen-single span{
    color: #000 !important;
}
<?php } ?>
<?php if(isset($_GET['service']) && $_GET['service'] != ""){?>
#service_chosen .chosen-single{
    color: black !important;
    background-color: #607d8b38 !important;
}
#service_chosen .chosen-container-single .chosen-single span{
    color: #000 !important;
}
<?php } ?>
<?php if(isset($_GET['stylist']) && $_GET['stylist'] != ""){?>
#stylist_chosen .chosen-single{
    color: black !important;
    background-color: #607d8b38 !important;
}
#stylist_chosen .chosen-container-single .chosen-single span{
    color: #000 !important;
}
<?php } ?>

    
.slot-tablinks {
    margin-bottom: 5px !important;
    padding: 2px 5px;    
    cursor: pointer;
    color: #333;
    margin: 0px 1px;
    transition: color 0.4s, background-color 0.4s, font-size 0.4s;
    font-size: 12px;
    border: 0.5px solid #0000ff33;
}
.calender_booking_details tr th{
    /* color:white; */
}
.calender_booking_details table th{
    text-align:start;
}
.slot-tablinks:hover {
  color: #0000ff;
}
.slot-tablinks.active {
    color: #ffffff;
    background-color: blue;
    font-size: 13px;
}
.slot-tabcontent {
  display: none;
  max-width: 800px;
  text-align: center;
}
.slot-tabcontent.active {
  display: block;
}

.resc_service_timeslots::-webkit-scrollbar {
    width: 8px;
}

.resc_service_timeslots::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.resc_service_timeslots::-webkit-scrollbar-thumb {
    background: #0056d1; /* Changed color to #0056d1 */
}

.resc_service_timeslots::-webkit-scrollbar-thumb:hover {
    background: #003f87; /* Adjusted hover color if needed */
}

.service_details_box{
        max-height: 250px;
        overflow: hidden;
        overflow-y: auto;
    }
   
.service_details_box::-webkit-scrollbar {
    width: 8px;
}

.service_details_box::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.service_details_box::-webkit-scrollbar-thumb {
    background: #0056d1; /* Changed color to #0056d1 */
}

.service_details_box::-webkit-scrollbar-thumb:hover {
    background: #003f87; /* Adjusted hover color if needed */
}

    .offer-tooltip{
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
    .offer-tooltip p{
        margin-bottom: 0px;
        font-size: 12px;
    }
    #offer_details_info{
        cursor: pointer;
    }
    #offer_details_info:hover .offer-tooltip{
       display: block;
    }

    .coupon-tooltip{
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
    .coupon-tooltip p{
        margin-bottom: 0px;
        font-size: 12px;
    }
    #coupon_details_info{
        cursor: pointer;
    }
    #coupon_details_info:hover .coupon-tooltip{
       display: block;
    }

    .discount-tooltip{
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
    .discount-tooltip p{
        margin-bottom: 0px;
        font-size: 12px;
    }
    #discount_details_info{
        cursor: pointer;
    }
    #discount_details_info:hover .discount-tooltip{
       display: block;
    }
.loading-skeleton {
    height: 70px;
    background-color: #d7d7d7; /* Background color of skeleton */
    border-radius: 4px; /* Rounded corners */
    padding: 20px; /* Padding around the skeleton */
    margin-bottom: 20px; /* Margin at the bottom */
}

.loading-project {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px; /* Margin between project details */
}

.loading-project-details {
    flex: 1;
}

.loading-project-details1 {
    flex: 0 0 30%; /* Fixed width for this section */
}

.loading-line {
    height: 10px; /* Height of each skeleton line */
    background-color: #ffffff; /* Background color of each skeleton line */
    margin-bottom: 5px; /* Margin between lines */
}
.modal-backdrop.in{
    opacity: 0 !important;
}

.loader {
  display: inline-block;
  position: relative;
  width: 80px;
  height: 80px;
}
.loader div {
  position: absolute;
  width: 16px;
  height: 16px;
  border-radius: 50%;
  background: #000;
  animation: loader 1.2s linear infinite;
}
.loader div:nth-child(1) {
  animation-delay: 0s;
  top: 32px;
  left: 32px;
}
.loader div:nth-child(2) {
  animation-delay: -0.4s;
  top: 0;
  left: 32px;
}
.loader div:nth-child(3) {
  animation-delay: -0.8s;
  top: 0;
  left: 0;
}
.loader div:nth-child(4) {
  animation-delay: -1.2s;
  top: 32px;
  left: 0;
}
.loader div:nth-child(5) {
  animation-delay: -1.6s;
  top: 64px;
  left: 32px;
}
@keyframes loader {
  0% {
    transform: scale(0);
  }
  100% {
    transform: scale(1);
    opacity: 0;
  }
}
.loader_container{
    position: fixed;
    background-color: #ffffffb5;
    z-index: 999;
    height: 100%;
    width: 100%;
    top: 0;
    left: 0;
}
.loader_container .loader{
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
}

.arrow_btn:active{
    box-shadow:none;
}



.loader_div{
    display: none;
    position: fixed;
    width: 100%;
    height: 100% !important;
    background: #00000042;
    z-index: 999999;
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


.service_details_div table tr td{
    padding: 5px !important;
}
.service_details_div table tr th{
    padding: 5px !important;
}
.booking_pricing_div table tr th{
    padding: 9px !important;
}
.coupon_details_div table tr td{
    padding: 5px !important;
}
.coupon_details_div table tr th{
    padding: 5px !important;
}
.giftcard_details_div table tr td{
    padding: 5px !important;
}
.giftcard_details_div table tr th{
    padding: 5px !important;
}
.rewards_details_div table tr td{
    padding: 5px !important;
}
.rewards_details_div table tr th{
    padding: 5px !important;
}
.product_details_div table tr td{
    padding: 5px !important;
}
.product_details_div table tr th{
    padding: 5px !important;
}


.extra-service-discount-tooltip{
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
    .extra-service-discount-tooltip p{
        margin-bottom: 0px;
        font-size: 12px;
    }
    #extra_service_discount_details_info{
        cursor: pointer;
    }
    #extra_service_discount_details_info:hover .extra-service-discount-tooltip{
       display: block;
    }

    .extra_service_price_table table tr th{
        padding: 5px !important;
    }
    .extra_service_products table tr th{
        padding: 5px !important;
    }
    .extra_service_products table tr td{
        padding: 5px !important;
    }
    .single_added_extra_service_details{    
        margin-left: 0px;
        margin-right: 0px;
    }
</style>
<?php
$booking_rules = $this->Salon_model->get_booking_rules();
$coupon_list = $this->Salon_model->get_all_coupon_list();
$all_stylist = $this->Salon_model->get_salon_all_stylists();
$store_profile = $this->Salon_model->get_all_salon_profile_single();
$setup = $this->Master_model->get_backend_setups();	
if(!empty($booking_rules)){
    $booking_id = base64_decode($this->uri->segment(2));
    $this->db->select('tbl_new_booking.*,tbl_salon_customer.current_pending_amount, tbl_salon_customer.full_name as customer_name,tbl_salon_customer.customer_phone,tbl_salon_customer.id as customer_id,tbl_salon_customer.gender as customer_gender,tbl_salon_customer.rewards_balance');
    $this->db->join('tbl_salon_customer','tbl_salon_customer.id = tbl_new_booking.customer_name');
    $this->db->where('tbl_new_booking.id',$booking_id);
    $this->db->where('tbl_new_booking.is_deleted','0');
    $this->db->where('tbl_new_booking.booking_type','0');
    $booking = $this->db->get('tbl_new_booking')->row();

    $this->db->select('tbl_booking_services_details.*,tbl_new_booking.amount_to_paid,tbl_salon_employee.full_name as stylist_name, tbl_salon_customer.full_name as customer_name,tbl_salon_customer.customer_phone, tbl_salon_emp_service.service_name,tbl_salon_emp_service.service_name_marathi');
    $this->db->join('tbl_salon_emp_service','tbl_salon_emp_service.id = tbl_booking_services_details.service_id');
    $this->db->join('tbl_salon_customer','tbl_salon_customer.id = tbl_booking_services_details.customer_name');
    $this->db->join('tbl_new_booking','tbl_new_booking.id = tbl_booking_services_details.booking_id');
    $this->db->join('tbl_salon_employee','tbl_salon_employee.id = tbl_booking_services_details.stylist_id');
    $this->db->where('tbl_booking_services_details.booking_id',$booking_id);
    $this->db->where('tbl_booking_services_details.is_deleted','0');
    // $this->db->where('tbl_booking_services_details.service_status','0');
    $booking_services = $this->db->get('tbl_booking_services_details')->result();

        // echo '<pre>'; print_r($booking_services);exit;
    if(!empty($booking)){
        if($booking->payment_status != "1"){
            $package_details = $this->Salon_model->get_package_details($booking->pacakge_id);
            $giftcard_details = $this->Salon_model->get_giftcard_details($booking->applied_giftcard_id);
            $giftcard_redemption_details = $this->Salon_model->get_giftcard_redemption_details($booking->giftcard_redemption_id);
            $all_service_details_ids = array();
            $customer_membership = $this->Salon_model->get_customer_membership_details($booking->customer_id);

            $is_member = $customer_membership['is_member'];
            $membership_details = $customer_membership['membership'];
?>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <h3><b>Generate Bill</b></h3>
            <div class="title_left">            
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin:0px auto;">
            <div class="x_panel">
                <div class="x_content">
                    <div class="calender_booking_details" style="background-color: #f7f7ff;">
                        <table style="width:100%;">
                            <thead>
                                <tr style="background: linear-gradient(271deg, #800080, #ff69b4);border-bottom: 0.5px solid #afafaf;border-top: 0.5px solid #afafaf;">
                                    <th>Customer</th>
                                    <th>Booking Date</th>
                                    <th>Booking Amt</th>
                                    <th>Previous Pending Amount</th>
                                    <th>Membership</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="border-bottom: 0.5px solid #afafaf;">
                                    <td style="color:black;">
                                        <?=$booking->customer_name;?>, <?=$booking->customer_phone;?>
                                    </td>
                                    <td style="color:black;"><?=date('d M, Y',strtotime($booking->booking_date));?></td>
                                    <td style="color:black;"><?=($booking->amount_to_paid != "") ? 'Rs. '.$booking->amount_to_paid : 'Rs. 0.00';?></td>
                                    <td style="color:black;"><?=($booking->current_pending_amount != "" && $booking->current_pending_amount != null) ? 'Rs. '.number_format($booking->current_pending_amount,2) : 'Rs. 0.00';?></td>
                                    <td style="color:black;">
                                        <?php 
                                            if($is_member == "1"){
                                                echo !empty($membership_details) ? '<a class="btn btn-sm" style="background-color:'.$membership_details->bg_color.'; color:'.$membership_details->text_color.'">'.$membership_details->membership_name.'</a>' : '-';
                                            }else{
                                                echo '<a class="btn" style="text-decoration:underline;" target="_blank" href="' . base_url() . 'asign-membership/' . $booking->customer_id . '" title="Assign Membership">Assign Membership</a>';
                                            }
                                        ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="calender_booking_details">
                        <form method="post" name="payment_form_<?=$booking->id;?>" id="payment_form_<?=$booking->id;?>" action="<?=base_url();?>generate-bill/<?=base64_encode($booking->id);?>">
                            <div class="row">
                                <div class="col-lg-9 col_resp">
                                    <div class="calender_booking_details service_details_div service_details_box" style="background-color: #f7f7ff;height: 500px; overflow-y: scroll; border: 0.5px solid #afafaf;">
                                        <table style="width:100%;">
                                            <thead>
                                                <tr style="background:linear-gradient(271deg, #800080, #ff69b4);border-bottom: 0.5px solid #afafaf;">
                                                    <th style="width:3%;">Sr. No.</th>
                                                    <th style="width:26%;">Service</th>
                                                    <th style="width:10%;">Products</th>
                                                    <th style="width:12%;">Service Date</th>
                                                    <th style="width:12%;">Amount</th>
                                                    <th style="width:25%;">Stylist</th>
                                                    <th style="width:12%;">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $service_single_count = 1;
                                                    if(!empty($booking_services)){
                                                        foreach($booking_services as $booking_services_result){
                                                            // if($booking_services_result->payment_status != '1'){
                                                                if($booking_services_result->is_extra_service == '1'){
                                                                    $row_style = "background-color:#0000ff21;";
                                                                }else{
                                                                    $row_style = "";
                                                                }
                                                            // }else{
                                                            //     $row_style = "background-color:#8bc34a61;";
                                                            // }
                                                            $products = explode(',',$booking_services_result->product_ids);
                                                            $product_details_str = '';
                                                            if (empty($products)) {
                                                                $product_details_str = '-';
                                                            } else {
                                                                for ($k = 0; $k < count($products); $k++) {
                                                                    $product_details = $this->Salon_model->get_product_details($products[$k]);
                                                                    if (!empty($product_details)) {
                                                                        $product_details_str .= $product_details->product_name;
                                                                        if ($k < count($products) - 1) {
                                                                            $product_details_str .= ', ';
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                            
                                                            if($booking_services_result->service_status != '2'){
                                                                if($booking_services_result->payment_status == '0'){
                                                                    $all_service_details_ids[] = $booking_services_result->id;
                                                                }
                                                            }

                                                            $this->db->select('tbl_booking_services_products_details.*,tbl_product.discount_in, tbl_product.selling_price, tbl_product.discount, tbl_product.product_name, tbl_new_booking.amount_to_paid, tbl_salon_customer.full_name as customer_name,tbl_salon_customer.customer_phone, tbl_salon_emp_service.service_name,tbl_salon_emp_service.service_name_marathi');
                                                            $this->db->join('tbl_salon_emp_service','tbl_salon_emp_service.id = tbl_booking_services_products_details.service_id');
                                                            $this->db->join('tbl_product','tbl_product.id = tbl_booking_services_products_details.product_id');
                                                            $this->db->join('tbl_salon_customer','tbl_salon_customer.id = tbl_booking_services_products_details.customer_name');
                                                            $this->db->join('tbl_new_booking','tbl_new_booking.id = tbl_booking_services_products_details.booking_id');
                                                            $this->db->where('tbl_booking_services_products_details.booking_service_details_id',$booking_services_result->id);
                                                            $this->db->where('tbl_booking_services_products_details.is_deleted','0');
                                                            $booking_products = $this->db->get('tbl_booking_services_products_details')->result();
                                                ?>
                                                <tr style="<?=$row_style;?>">                                                
                                                    <td style="color:black;text-align:center;">
                                                        <?=$service_single_count++;?>
                                                        <input <?php if($booking_services_result->service_status == '2'){ echo 'disabled'; }else{ if($booking_services_result->payment_status == '0'){ echo 'checked style="display:none; pointer-events: none;"'; }else{ echo 'disabled style="display:none;"'; }}?> type="checkbox" class="booking_services_<?=$booking->id;?>" name="service_checkbox_<?=$booking->id;?>[]" id="service_checkbox_<?=$booking_services_result->id;?>" value="<?=$booking_services_result->id;?>" onclick="setServicePrice(<?=$booking_services_result->id;?>,<?=$booking->id;?>)">
                                                    </td>                                                    
                                                    <td style="color:black;">
                                                        <?=$booking_services_result->service_name;?>|<?=$booking_services_result->service_name_marathi;?>
                                                        <?php if($booking_services_result->service_added_from == '1'){ ?>
                                                            <?php if(!empty($package_details)){ ?>
                                                                <br><small>(Package: <?=$package_details->package_name; ?>)</small>
                                                            <?php }else{ ?>
                                                                <br><small>(Package Service)</small>
                                                            <?php } ?>
                                                        <?php if($booking->package_amount == '0' ||  $booking->package_amount == '' || $booking->package_amount == null || $booking->package_amount == '0.00'){ ?>
                                                            <small> (Active)</small>
                                                        <?php } ?>
                                                        <?php } ?>
                                                        <label class="error" style="display:none;font-size: 10px;" id="stock_selection_service_error_<?=$booking_services_result->id;?>_<?=$booking->id;?>">Please enter payment amount!</label>
                                                    </td>
                                                    <td style="color:black;">
                                                        <?php if($product_details_str != ""){ ?>
                                                            <a style="text-decoration:underline;cursor:pointer;" type="button" id="service_products_button_<?=$booking_services_result->id;?>" data-toggle="modal" data-target="#ServiceProductModal_<?=$booking_services_result->id;?>" onclick="showPopup('ServiceProductModal_<?=$booking_services_result->id;?>')">
                                                                <span id="selected_product_<?=$booking_services_result->id;?>">0</span>/<?=count($booking_products);?>
                                                            </a>
                                                            
                                                            <div class="modal fade" id="ServiceProductModal_<?=$booking_services_result->id;?>" tabindex="-1" aria-labelledby="ServiceProductLabel_<?=$booking_services_result->id;?>" aria-hidden="true" >
                                                                <div class="modal-dialog" style="margin-top:100px;width:600px;position:fixed;left:30%;">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="ServiceProductLabel_<?=$booking_services_result->id;?>"><?php echo $booking_services_result->service_name; ?> Products</h5>
                                                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;"  onclick="closePopup('ServiceProductModal_<?=$booking_services_result->id;?>')">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body" id="booking_service_product_response_<?=$booking_services_result->id;?>">
                                                                            <div class="calender_booking_details product_details_div">
                                                                                <table style="width:100%; border: 0.5px solid #afafaf;">
                                                                                    <thead>
                                                                                        <tr style="border-bottom: 0.5px solid #afafaf;">
                                                                                            <th>Select</th>
                                                                                            <th>Product</th>
                                                                                            <th>Select Product</th>
                                                                                            <th>Price<br><small>(In INR)</small></th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <?php
                                                                                            if(!empty($booking_products)){
                                                                                                foreach($booking_products as $booking_products_result){
                                                                                                    $product_stock = $this->Salon_model->get_product_stock_items($booking_products_result->product_id);  
                                                                                                    
                                                                                                    $product_original_price = $booking_products_result->product_original_price;
                                                                                                    $selling_price = $booking_products_result->product_price;
                                                                                        ?>
                                                                                        <tr>
                                                                                            <!-- <td><input <?php if($booking_services_result->service_status == '2'){ echo 'disabled'; }else{ if($booking_services_result->payment_status == '0'){ echo 'checked style="pointer-events: none;"'; }else{ echo 'disabled'; }}?> type="checkbox" class="product_checkbox_<?=$booking_services_result->id;?>" name="service_products_checkbox_<?=$booking_services_result->id;?>[]" id="service_products_checkbox_<?=$booking_services_result->id;?>_<?=$booking_products_result->id;?>" value="<?=$booking_products_result->id;?>" onclick="setServiceProductPrice(<?=$booking_services_result->id;?>,<?=$booking_products_result->id;?>,<?=$booking->id;?>)"></td> -->
                                                                                            <td style="color:black;"><input <?php if($booking_services_result->service_status == '2'){ echo 'disabled'; }else{ if($booking_services_result->payment_status == '0'){ echo ''; }else{ echo 'disabled'; }}?> type="checkbox" class="product_checkbox_<?=$booking_services_result->id;?>" name="service_products_checkbox_<?=$booking_services_result->id;?>[]" id="service_products_checkbox_<?=$booking_services_result->id;?>_<?=$booking_products_result->id;?>" value="<?=$booking_products_result->id;?>" onclick="setServiceProductPrice(<?=$booking_services_result->id;?>,<?=$booking_products_result->id;?>,<?=$booking->id;?>)"></td>
                                                                                            <td style="color:black;"><?=$booking_products_result->product_name;?></td>
                                                                                            <td style="color:black;">   
                                                                                                <?php 
                                                                                                    if($booking_services_result->service_status == '2'){
                                                                                                        echo '-'; 
                                                                                                    }else{ 
                                                                                                        if($booking_services_result->payment_status == '0'){ 
                                                                                                ?>                                                                                             
                                                                                                <select data-product-details="<?=$booking_products_result->id;?>" data-service-details="<?=$booking_services_result->id;?>" class="form-control chosen-select all_selected_stocks_<?=$booking->id;?> single_booking_product_barcodes_<?=$booking_products_result->id;?>" id="used_product_barcodes_<?=$booking_services_result->id;?>_<?=$booking_products_result->id;?>"  name="used_product_barcodes_<?=$booking_services_result->id;?>_<?=$booking_products_result->id;?>">
                                                                                                    <?php if(!empty($product_stock)){ ?>
                                                                                                        <option value="">Select Used Product</option>
                                                                                                        <?php foreach($product_stock as $product_stock_result){ ?>
                                                                                                    <option value="<?=$product_stock_result->id;?>">
                                                                                                        <?=$product_stock_result->barcode_id; ?> <?php if($product_stock_result->exp_date != "" && $product_stock_result->exp_date != "1970-01-01" && $product_stock_result->exp_date != "0000-00-00"){ ?> - Exp. : <?=date('d-m-Y',strtotime($product_stock_result->exp_date)); ?> <?php } ?>
                                                                                                    </option>
                                                                                                    <?php }}else{ ?>
                                                                                                    <option value="">Stock not available</option>
                                                                                                    <?php } ?>
                                                                                                </select>
                                                                                                <?php }else{ echo '-'; }} ?>
                                                                                            </td>
                                                                                            <td style="color:black;">
                                                                                                <?php
                                                                                                    if($selling_price != ""){
                                                                                                        if($selling_price < $product_original_price){
                                                                                                            echo '<div class="service_price_title"  title="Offer Price"><b><s>'.$product_original_price.'</s> '.$selling_price.'</b></div>';
                                                                                                        }else{
                                                                                                            echo '<div class="service_price_title"  title="Offer Price"><b>'.$selling_price.'</b></div>';
                                                                                                        }
                                                                                                    }else{
                                                                                                        echo '<div class="service_price_title"  title="Offer Price"><b>0.00</b></div>';
                                                                                                    }
                                                                                                ?>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <input type="hidden" name="single_service_product_id_<?=$booking_services_result->id;?>_<?=$booking_products_result->id;?>" id="single_service_product_id_<?=$booking_services_result->id;?>_<?=$booking_products_result->id;?>" value="<?=$booking_products_result->product_id;?>">
                                                                                        <input type="hidden" name="single_service_product_price_<?=$booking_services_result->id;?>_<?=$booking_products_result->id;?>" id="single_service_product_price_<?=$booking_services_result->id;?>_<?=$booking_products_result->id;?>" value="<?=($selling_price != "" && $selling_price != "" && $selling_price != "0" && $selling_price != "0.00") ? $selling_price : '0.00';?>">
                                                                                        <?php }} ?>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>	
                                                        <?php }else{ ?>
                                                            -
                                                        <?php } ?>
                                                    </td>
                                                    <td style="color:black;"><?=date('d M, y',strtotime($booking_services_result->service_date));?></td>
                                                    <td style="color:black;">
                                                        <div class="service_price_title"> <b>
                                                        <?php
                                                        if($booking_services_result->service_price != ""){
                                                            if($booking_services_result->service_price < $booking_services_result->original_service_price){
                                                                echo '<s>'.$booking_services_result->original_service_price.'</s> '.$booking_services_result->service_price.'';
                                                            }else{
                                                                echo $booking_services_result->service_price;
                                                            }
                                                        }else{
                                                            echo '0.00';
                                                        }
                                                        ?>
                                                        </b></div>
                                                    </td>
                                                    <td style="color:black;">
                                                        <select class="form-control chosen-select single_booking_stylists_<?=$booking->id;?>" id="new_stylist_<?=$booking_services_result->id;?>"  name="new_stylist_<?=$booking_services_result->id;?>">
                                                            <option value="">Select Stylist</option>
                                                            <?php if(!empty($all_stylist)){ foreach($all_stylist as $all_stylist_result){ ?>
                                                            <option value="<?=$all_stylist_result->id;?>" <?php if($all_stylist_result->id == $booking_services_result->stylist_id){ echo 'selected'; }?>>
                                                                <?=$all_stylist_result->full_name; ?>
                                                            </option>
                                                            <?php }} ?>
                                                        </select>
                                                    </td>
                                                    <td style="color:black;">
                                                        <?php 
                                                            if($booking_services_result->service_status == '0'){
                                                                echo '<label style="color:black;" class="label label-warning">Pending</label>';
                                                            }elseif($booking_services_result->service_status == '1'){
                                                                echo '<label style="color:black;" class="label label-success">Completed</label>';
                                                                echo '<span class="table_span">On: '.date('d-m-Y',strtotime($booking_services_result->completed_on)).'</span>';
                                                            }elseif($booking_services_result->service_status == '2'){
                                                                echo '<label style="color:black;" class="label label-danger">Cancelled</label>';
                                                            }elseif($booking_services_result->service_status == '3'){
                                                                echo '<label style="color:black;" class="label label-default">Lapsed</label>';
                                                            }else{
                                                                echo 'NA';
                                                            }
                                                        ?>
                                                    </td>
                                                </tr>                                
                                                <input type="hidden" name="old_stylist_<?=$booking_services_result->id;?>" id="old_stylist_<?=$booking_services_result->id;?>" value="<?=$booking_services_result->stylist_id;?>">
                                                <input type="hidden" name="single_service_id_<?=$booking_services_result->id;?>" id="single_service_id_<?=$booking_services_result->id;?>" value="<?=$booking_services_result->service_id;?>">
                                                <input type="hidden" name="single_service_price_<?=$booking_services_result->id;?>" id="single_service_price_<?=$booking_services_result->id;?>" value="<?=($booking_services_result->service_price != "" && $booking_services_result->service_price != "" && $booking_services_result->service_price != "0" && $booking_services_result->service_price != "0.00") ? $booking_services_result->service_price : '0.00';?>">
                                                <input type="hidden" class="is_service_offer_applied" name="is_service_offer_applied_<?=$booking_services_result->id;?>" id="is_service_offer_applied_<?=$booking_services_result->id;?>" value="">
                                                <input type="hidden" class="applied_offer_id" name="applied_offer_id_<?=$booking_services_result->id;?>" id="applied_offer_id_<?=$booking_services_result->id;?>" value="">
                                                <input type="hidden" class="service_offer_discount" name="service_offer_discount_<?=$booking_services_result->id;?>" id="service_offer_discount_<?=$booking_services_result->id;?>" value="">
                                                <input type="hidden" class="service_offer_discount_type" name="service_offer_discount_type_<?=$booking_services_result->id;?>" id="service_offer_discount_type_<?=$booking_services_result->id;?>" value="">
                                                <input type="hidden" class="service_offer_discount_amount" name="service_offer_discount_amount_<?=$booking_services_result->id;?>" id="service_offer_discount_amount_<?=$booking_services_result->id;?>" value="">
                                                <?php }}else{ ?>
                                                <tr>
                                                    <td colspan="7">Services Not Available</td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>                                        
                                        <label for="service_checkbox_<?=$booking->id;?>[]" generated="true" class="error" style="display:none;">Please select at least one service!</label>
                                    </div>
                                </div>
                                <input type="hidden" name="customer_id_<?=$booking->id;?>" id="customer_id_<?=$booking->id;?>" value="<?=$booking->customer_id;?>">
                                <input type="hidden" name="customer_pending_amount_<?=$booking->id;?>" id="customer_pending_amount_<?=$booking->id;?>" value="<?=($booking->current_pending_amount != "" && $booking->current_pending_amount != null) ? $booking->current_pending_amount : '0.00';?>">
                                
                                <input type="hidden" name="is_package_included_<?=$booking->id;?>" id="is_package_included_<?=$booking->id;?>" value="<?=$booking->is_package_included;?>">
                                <input type="hidden" name="used_package_type_<?=$booking->id;?>" id="used_package_type_<?=$booking->id;?>" value="<?=$booking->used_package_type;?>">
                                <input type="hidden" name="package_rewards_<?=$booking->id;?>" id="package_rewards_<?=$booking->id;?>" value="<?=$booking->package_rewards;?>">
                                <input type="hidden" name="package_allocation_id_<?=$booking->id;?>" id="package_allocation_id_<?=$booking->id;?>" value="<?=$booking->package_allocation_id;?>">
                                <input type="hidden" name="package_id_<?=$booking->id;?>" id="package_id_<?=$booking->id;?>" value="<?=$booking->pacakge_id;?>">
                                <input type="hidden" name="package_amount_<?=$booking->id;?>" id="package_amount_<?=$booking->id;?>" value="<?=$booking->package_amount;?>">

                                <input type="hidden" name="selected_coupon_id_<?=$booking->id;?>" id="selected_coupon_id_<?=$booking->id;?>" value="<?=($booking->selected_coupon_id != "" && $booking->selected_coupon_id != null && $booking->selected_coupon_id != "0") ? $booking->selected_coupon_id : '';?>">
                                <input type="hidden" name="selected_coupon_type_<?=$booking->id;?>" id="selected_coupon_type_<?=$booking->id;?>" value="">
                                
                                <input type="hidden" name="is_membership_payment_included_<?=$booking->id;?>" id="is_membership_payment_included_<?=$booking->id;?>" value="<?= $is_member == '1' && !empty($membership_details) && $membership_details->payment_status == '0' ? $booking->is_membership_payment_included : '0';?>">
                                <input type="hidden" name="membership_payment_amount_<?=$booking->id;?>" id="membership_payment_amount_<?=$booking->id;?>" value="<?= $booking->is_membership_booking == "1" && $booking->is_membership_payment_included == "1" && $is_member == "1" && !empty($membership_details) && $membership_details->payment_status == '0' ? $booking->membership_amount : '0.00';?>">
                                <input type="hidden" name="membership_payment_status_<?=$booking->id;?>" id="membership_payment_status_<?=$booking->id;?>" value="<?=$is_member == '1' && !empty($membership_details) ?  $membership_details->payment_status : '0';?>">
                                
                                <input type="hidden" name="is_membership_booking_<?=$booking->id;?>" id="is_membership_booking_<?=$booking->id;?>" value="<?=$is_member;?>">
                                <input type="hidden" name="membership_id_<?=$booking->id;?>" id="membership_id_<?=$booking->id;?>" value="<?=($is_member == '1' && !empty($membership_details)) ? $membership_details->membership_id : '';?>">
                                <input type="hidden" name="membership_history_id_<?=$booking->id;?>" id="membership_history_id_<?=$booking->id;?>" value="<?=($is_member == '1' && !empty($membership_details)) ? $membership_details->id : '';?>">
                                <input type="hidden" name="membership_discount_type_<?=$booking->id;?>" id="membership_discount_type_<?=$booking->id;?>" value="<?=($is_member == '1' && !empty($membership_details)) ? $membership_details->discount_in : '';?>">
                                <input type="hidden" name="m_service_discount_<?=$booking->id;?>" id="m_service_discount_<?=$booking->id;?>" value="<?=($is_member == '1' && !empty($membership_details)) ? $membership_details->service_discount : '0';?>">
                                <input type="hidden" name="m_product_discount_<?=$booking->id;?>" id="m_product_discount_<?=$booking->id;?>" value="<?=($is_member == '1' && !empty($membership_details)) ? $membership_details->product_discount : '0';?>">
                                <input type="hidden" name="is_giftcard_applied_<?=$booking->id;?>" id="is_giftcard_applied_<?=$booking->id;?>" value="<?=$booking->is_giftcard_applied;?>">
                                <input type="hidden" name="is_offer_applied_to_booking_<?=$booking->id;?>" id="is_offer_applied_to_booking_<?=$booking->id;?>" value="<?=$booking->is_offer_booking;?>">
                                <input type="hidden" name="offer_applied_to_booking_<?=$booking->id;?>" id="offer_applied_to_booking_<?=$booking->id;?>" value="<?=$booking->applied_offer_id;?>">
                                <input type="hidden" name="is_new_giftcard_applied_<?=$booking->id;?>" id="is_new_giftcard_applied_<?=$booking->id;?>" value="">
                                <input type="hidden" name="applied_giftcard_id_<?=$booking->id;?>" id="applied_giftcard_id_<?=$booking->id;?>" value="<?=$booking->applied_giftcard_id;?>">
                                <input type="hidden" name="applied_giftcard_owner_id_<?=$booking->id;?>" id="applied_giftcard_owner_id_<?=$booking->id;?>" value="<?=$booking->applied_giftcard_owner_id;?>">
                                <input type="hidden" name="giftcard_redemption_id_<?=$booking->id;?>" id="giftcard_redemption_id_<?=$booking->id;?>" value="<?=$booking->giftcard_redemption_id;?>">
                                
                                <input type="hidden" name="total_service_amount_<?=$booking->id;?>" id="total_service_amount_<?=$booking->id;?>" value="0.00">
                                <input type="hidden" name="total_product_amount_<?=$booking->id;?>" id="total_product_amount_<?=$booking->id;?>" value="0.00">
                                <input type="hidden" name="coupon_discount_amount_<?=$booking->id;?>" id="coupon_discount_amount_<?=$booking->id;?>" value="0.00">
                                <input type="hidden" name="offer_discount_amount_<?=$booking->id;?>" id="offer_discount_amount_<?=$booking->id;?>" value="0.00">
                                <input type="hidden" name="reward_discount_amount_<?=$booking->id;?>" id="reward_discount_amount_<?=$booking->id;?>" value="0.00">    
                                <input type="hidden" name="used_rewards_<?=$booking->id;?>" id="used_rewards_<?=$booking->id;?>" value="0">    
                                <input type="hidden" name="gift_discount_<?=$booking->id;?>" id="gift_discount_<?=$booking->id;?>" value="0.00">
                                <input type="hidden" name="m_service_discount_amount_<?=$booking->id;?>" id="m_service_discount_amount_<?=$booking->id;?>" value="0.00">
                                <input type="hidden" name="m_product_discount_amount_<?=$booking->id;?>" id="m_product_discount_amount_<?=$booking->id;?>" value="0.00">
                                
                                <input type="hidden" name="service_payable_hidden_<?=$booking->id;?>" id="service_payable_hidden_<?=$booking->id;?>" value="0.00">
                                <input type="hidden" name="product_payable_hidden_<?=$booking->id;?>" id="product_payable_hidden_<?=$booking->id;?>" value="0.00">
                                <input type="hidden" name="payable_hidden_<?=$booking->id;?>" id="payable_hidden_<?=$booking->id;?>" value="0.00">
                                <input type="hidden" name="total_discount_hidden_<?=$booking->id;?>" id="total_discount_hidden_<?=$booking->id;?>" value="0.00">
                                <input type="hidden" name="booking_amount_hidden_<?=$booking->id;?>" id="booking_amount_hidden_<?=$booking->id;?>" value="0.00">
                                <input type="hidden" name="gst_amount_hidden_<?=$booking->id;?>" id="gst_amount_hidden_<?=$booking->id;?>" value="0.00">
                                <input type="hidden" name="grand_total_hidden_<?=$booking->id;?>" id="grand_total_hidden_<?=$booking->id;?>" value="0.00">
                                <div class="col-xl-2 col-lg-3 col-md-12 col-sm-12">
                                    <div class="calender_booking_details booking_pricing_div" style="background-color: #f7f7ff;border: 0.5px solid #afafaf;">
                                        <table style="width:100%;">
                                            <thead>
                                                <tr>
                                                    <th>Service Price</th>
                                                    <th id="total_service_amount_text_<?=$booking->id;?>">0.00</th>
                                                </tr>
                                                <tr>
                                                    <th>Products Price</th>
                                                    <th id="total_product_amount_text_<?=$booking->id;?>">0.00</th>
                                                </tr>
                                                <?php if($booking->pacakge_id != "" && $booking->package_amount != "" && $booking->package_amount != "0.00"){ ?>
                                                <tr>
                                                    <th>Package Price <?php if(!empty($package_details)){ ?><small>(<?=$package_details->package_name;?>)</small><?php } ?></th>
                                                    <th id="package_price_<?=$booking->id;?>"><?=$booking->package_amount;?></th>
                                                </tr>
                                                <?php } ?>
                                                <?php if($booking->is_membership_booking == "1" && $booking->is_membership_payment_included == "1" && $is_member == "1" && !empty($membership_details) && $membership_details->payment_status == '0'){ ?>
                                                <tr>
                                                    <th>Membership Price <?php if(!empty($membership_details)){ ?><small>(<?=$membership_details->membership_name;?>)</small><?php } ?></th>
                                                    <th id="membership_price_<?=$booking->id;?>"><?= number_format($booking->membership_amount, 2); ?></th>
                                                </tr>
                                                <?php } ?>
                                                <tr>
                                                    <th>
                                                        Discount                                        
                                                        <div id="discount_details_div_<?=$booking->id;?>" style="position: relative;display:inline-block; width:auto;"></div>
                                                    </th>
                                                    <th id="discount_amount_<?=$booking->id;?>">0.00</th>
                                                </tr>
                                                <tr style="border-top: 0.5px solid #afafaf;">
                                                    <th>Total Amount</th>
                                                    <th id="booking_amount_<?=$booking->id;?>">0.00</th>
                                                </tr>
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
                                                <input type="hidden" name="is_gst_applicable_<?=$booking->id;?>" id="is_gst_applicable_<?=$booking->id;?>" value="<?=$is_gst_applicable;?>">
                                                <input type="hidden" name="salon_gst_no_<?=$booking->id;?>" id="salon_gst_no_<?=$booking->id;?>" value="<?=$gst_no;?>">
                                                <input type="hidden" name="salon_gst_rate_<?=$booking->id;?>" id="salon_gst_rate_<?=$booking->id;?>" value="<?=$gst_rate;?>">

                                                <tr>
                                                    <th>GST <small><?= $gst_rate != "" && $gst_rate != "0" ? '('.$gst_rate.'%)' : '';?></small></th>
                                                    <th id="gst_amount_<?=$booking->id;?>">0.00</th>
                                                </tr>
                                                <tr style="border-top: 0.5px solid #afafaf;">
                                                    <th>Grand Total</th>
                                                    <th id="grand_total_<?=$booking->id;?>">0.00</th>
                                                </tr>
                                                <tr style="border-top: 0.5px solid #afafaf;">
                                                    <th>Total Due<small><i title="Including Previous Due <?=($booking->current_pending_amount != "" && $booking->current_pending_amount != null) ? 'of Rs. '.$booking->current_pending_amount : '';?>" style="font-size: 12px;margin-top: 5px;margin-left: 5px;cursor:pointer;color:#0000ffb0;" class="fas fa-info-circle"></i></small></th>
                                                    <th id="total_due_<?=$booking->id;?>">0.00</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                            <div class="calender_booking_details service_details_box coupon_details_div" style="background-color: #f7f7ff;height: 175px;border: 0.5px solid #afafaf;margin-top:10px;">
                                                <div class="calender_booking_details">
                                                    <span><h6 style="margin-left: 6px;color:black;"><b>Apply Offer</b></h6></span>
                                                    <hr style="margin: 0; border: none; border-top: 0.5px solid #afafaf;">
                                                </div>
                                                <table style="width:100%;">
                                                    <thead>
                                                        <?php 
                                                        $offers_list = $this->Salon_model->get_all_active_offers();
                                                        $total_offers = 0;
                                                        if(!empty($offers_list)){ 
                                                            foreach($offers_list as $offers_list_result){ 
                                                                $services = explode(',',$offers_list_result->service_name);
                                                                $services_text = '';
                                                                $services_array = [];
                                                                if(count($services) > 0){
                                                                    for($i=0;$i<count($services);$i++){
                                                                        $this->db->where('id',$services[$i]);
                                                                        $this->db->where('branch_id',$this->session->userdata('branch_id'));
                                                                        $this->db->where('salon_id',$this->session->userdata('salon_id'));
                                                                        $this->db->where('is_deleted','0');
                                                                        $service_details = $this->db->get('tbl_salon_emp_service')->row();
                                                                        if (!empty($service_details)) {
                                                                            $services_text .= $service_details->service_name;
                                                                            
                                                                            if ($i < count($services) - 1) {
                                                                                $services_text .= ', ';
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                                
                                                                if($offers_list_result->discount_in == '0'){
                                                                    $offer_text = $offers_list_result->discount.'% Off';
                                                                }elseif($offers_list_result->discount_in == '1'){
                                                                    $offer_text = 'Flat Rs.'.$offers_list_result->discount.' Off';
                                                                }else{
                                                                    $offer_text = 'NA';
                                                                }

                                                                $total_offers++;
                                                        ?>
                                                        <tr>
                                                            <th>
                                                                <?=$offers_list_result->offers_name; ?>
                                                                <div id="offer_details_div_<?=$booking->id;?>_<?=$offers_list_result->id?>" style="position: relative;display:inline-block; width:auto;">
                                                                    <div id="offer_details_info"><i class="fas fa-info-circle" style="color:#0000ffb0;"></i>
                                                                        <div class="offer-tooltip">
                                                                            <div style="margin-top:1px;">
                                                                                <p>Services: <?=$services_text != "" ? $services_text : 'NA';?></p>
                                                                                <p>Discount: <?=$offer_text;?></p>
                                                                            </div>    
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <label class="error" id="offer_error_<?=$booking->id;?>_<?=$offers_list_result->id?>"></label>
                                                                <label id="offer_success_<?=$booking->id;?>" class="" style="color:green;font-size:10px;display:none;"></label>
                                                            </th>
                                                            <th id="offer_button_<?=$booking->id;?>_<?=$offers_list_result->id?>" style="text-align: right;">
                                                                <button class="btn btn-success" type="button" style="font-size:10px; padding:5px 12px;" onclick="applyOffer(<?=$booking->id; ?>,<?= $offers_list_result->id ?>,'new')">Apply</button>
                                                            </th>
                                                        </tr>
                                                        <input type="hidden" id="offer_discount_in_<?=$booking->id;?>_<?=$offers_list_result->id;?>" name="offer_discount_in_<?=$booking->id;?>_<?=$offers_list_result->id;?>" value="<?=$offers_list_result->discount_in; ?>">
                                                        <input type="hidden" id="offer_discount_<?=$booking->id;?>_<?=$offers_list_result->id;?>" name="offer_discount_<?=$booking->id;?>_<?=$offers_list_result->id;?>" value="<?=$offers_list_result->discount; ?>">
                                                        <input type="hidden" id="offer_services_<?=$booking->id;?>_<?=$offers_list_result->id;?>" name="offer_services_<?=$booking->id;?>_<?=$offers_list_result->id;?>" value="<?=$offers_list_result->service_name; ?>">
                                                        <input type="hidden" id="offer_name_<?=$booking->id;?>_<?=$offers_list_result->id;?>" name="coupon_name_<?=$booking->id;?>_<?=$offers_list_result->id;?>" value="<?=$offers_list_result->offers_name; ?>">
                                                        <?php }} ?>
                                                        <?php if($total_offers == 0){ ?>
                                                            <tr>
                                                                <th colspan=2 style="text-align:center;font-size:11px;" class="error">Offers not available</th>
                                                            </tr>
                                                        <?php } ?>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                            <div class="calender_booking_details service_details_box coupon_details_div" style="background-color: #f7f7ff;height: 175px;border: 0.5px solid #afafaf;margin-top:10px;">
                                                <div class="calender_booking_details">
                                                    <span><h6 style="margin-left: 6px;color:black;"><b>Apply Coupon</b></h6></span>
                                                    <hr style="margin: 0; border: none; border-top: 0.5px solid #afafaf;">
                                                </div>
                                                <table style="width:100%;">
                                                    <thead>
                                                        <?php 
                                                        $total_coupons = 0;
                                                        if(!empty($coupon_list)){ 
                                                            foreach($coupon_list as $coupon_list_result){ 
                                                                if(date('Y-m-d') <= date('Y-m-d',strtotime($coupon_list_result->coupan_expiry))){
                                                                    $total_coupons++;
                                                        ?>
                                                        <tr>
                                                            <th>
                                                                <?=$coupon_list_result->coupon_name; ?>
                                                                <div id="coupon_details_div_<?=$booking->id;?>_<?=$coupon_list_result->id?>" style="position: relative;display:inline-block; width:auto;">
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
                                                            </th>
                                                            <th id="coupon_button_<?=$booking->id;?>_<?=$coupon_list_result->id?>" style="text-align: right;">
                                                                <!-- <button class="btn btn-success" type="button" style="font-size:10px; padding:5px 12px;" onclick="if(confirm('Are you sure you want to apply the coupon?')) applyCoupon(<?=$booking->id; ?>,<?= $coupon_list_result->id ?>,'new');">Apply</button> -->
                                                                <button class="btn btn-success" type="button" style="font-size:10px; padding:5px 12px;" onclick="applyCoupon(<?=$booking->id; ?>,<?= $coupon_list_result->id ?>,'new')">Apply</button>
                                                                <!-- <button class="btn btn-success" type="button" style="font-size:10px; padding:5px 12px;" onclick="openConfirmationDialog('Are you sure you want to apply the coupon?', function(confirmed) { if (confirmed) { applyCoupon(<?=$booking->id; ?>,<?= $coupon_list_result->id ?>,'new'); } })">Apply</button> -->
                                                                <label class="error" id="coupon_error_<?=$booking->id;?>_<?=$coupon_list_result->id?>"></label>
                                                            </th>
                                                        </tr>
                                                        <input type="hidden" id="coupon_expiry_<?=$booking->id;?>_<?=$coupon_list_result->id;?>" name="coupon_expiry_<?=$booking->id;?>_<?=$coupon_list_result->id;?>" value="<?=($coupon_list_result->coupan_expiry != "" && $coupon_list_result->coupan_expiry != null && $coupon_list_result->coupan_expiry != '1970-01-01' && $coupon_list_result->coupan_expiry != "0000-00-00") ? date('Y-m-d',strtotime($coupon_list_result->coupan_expiry)) : '';?>">
                                                        <input type="hidden" id="coupon_name_<?=$booking->id;?>_<?=$coupon_list_result->id;?>" name="coupon_name_<?=$booking->id;?>_<?=$coupon_list_result->id;?>" value="<?=$coupon_list_result->coupon_name; ?>">
                                                        <input type="hidden" id="coupon_min_price_<?=$booking->id;?>_<?=$coupon_list_result->id;?>" name="coupon_min_price_<?=$booking->id;?>_<?=$coupon_list_result->id;?>" value="<?=$coupon_list_result->min_price;?>">
                                                        <input type="hidden" id="coupon_offers_<?=$booking->id;?>_<?=$coupon_list_result->id;?>" name="coupon_offers_<?=$booking->id;?>_<?=$coupon_list_result->id;?>" value="<?=$coupon_list_result->coupon_offers;?>">
                                                        <input type="hidden" id="coupon_gender_<?=$booking->id;?>_<?=$coupon_list_result->id;?>" name="coupon_gender_<?=$booking->id;?>_<?=$coupon_list_result->id;?>" value="<?=$coupon_list_result->gender;?>">
                                                        <?php }}} ?>
                                                        <?php if($total_coupons == 0){ ?>
                                                            <tr>
                                                                <th colspan=2 style="text-align:center;font-size:11px;" class="error">Coupons not available</th>
                                                            </tr>
                                                        <?php } ?>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                            <div class="calender_booking_details rewards_details_div" style="align-items: center;justify-content: center;display: flex;height: 54.1px;background-color: #f7f7ff;border: 0.5px solid #afafaf;margin-top:10px;">
                                                <table style="width:100%;">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                <span id="customer_rewards_text_<?=$booking->id;?>">Rewards Balance: <?=$booking->rewards_balance != "" && (int)$booking->rewards_balance >= 0 ? (int)$booking->rewards_balance : 0;?></span>
                                                                <div id="used_rewards_msg_<?=$booking->id;?>"></div>
                                                                <input type="hidden" name="customer_booking_reward_is_applied_<?=$booking->id;?>" id="customer_booking_reward_is_applied_<?=$booking->id;?>" value="<?=$booking->is_reward_applied; ?>">
                                                                <input type="hidden" name="customer_booking_reward_used_<?=$booking->id;?>" id="customer_booking_reward_used_<?=$booking->id;?>" value="<?=$booking->used_rewards; ?>">
                                                                <input type="hidden" name="customer_booking_reward_discount_received_<?=$booking->id;?>" id="customer_booking_reward_discount_received_<?=$booking->id;?>" value="<?=$booking->reward_discount_amount; ?>">
                                                                <input type="hidden" name="customer_reward_available_<?=$booking->id;?>" id="customer_reward_available_<?=$booking->id;?>" value="<?=$booking->rewards_balance != "" && (int)$booking->rewards_balance >= 0 ? (int)$booking->rewards_balance : 0; ?>">
                                                                <input type="hidden" name="customer_gender_<?=$booking->id;?>" id="customer_gender_<?=$booking->id;?>" value="<?=$booking->customer_gender;?>">
                                                            </th>
                                                            <th style="text-align: right;">
                                                                <button id="rewards_button_<?=$booking->id;?>" class="btn btn-success" type="button" style="font-size:10px; padding:5px 12px;" onclick="applyRewards(<?=$booking->id;?>)">Apply</button>
                                                                <!-- <button id="rewards_remove_button_<?=$booking->id;?>" class="btn btn-warning" type="button" onclick="if(confirm('Are you sure you want to remove the reward points?')) removeRewards(<?=$booking->id;?>);" style="display:none;font-size:10px; padding:5px 12px;">Remove</button> -->
                                                                <button id="rewards_remove_button_<?=$booking->id;?>" class="btn btn-warning" type="button" onclick="openConfirmationDialog('re you sure you want to remove the reward points?', function(confirmed) { if (confirmed) { removeRewards(<?=$booking->id;?>); } })" style="display:none;font-size:10px; padding:5px 12px;">Remove</button>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                            <div class="calender_booking_details giftcard_details_div" style="background-color: #f7f7ff;border: 0.5px solid #afafaf;margin-top:10px;">
                                                <table style="width:100%;">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                <input style="width: 100%;" type="text" name="giftcard_no_<?=$booking->id;?>" id="giftcard_no_<?=$booking->id;?>" value="<?php if($booking->is_giftcard_applied == '1' && !empty($giftcard_redemption_details)){ echo $giftcard_redemption_details->giftcard_customer_uid; } ?>" placeholder="Enter Giftcard No">
                                                                <br>
                                                                <label id="giftcard_error_<?=$booking->id;?>" class="error" style="display:none;"></label>
                                                                <label id="giftcard_success_<?=$booking->id;?>" class="" style="color:green;font-size:10px;display:none;"></label>
                                                            </th>
                                                            <th style="text-align: right;">
                                                                <!-- <button id="giftcard_button_<?=$booking->id;?>" class="btn btn-success" type="button" style="font-size:10px; padding:5px 12px;" onclick="if(confirm('Are you sure you want to apply the gift card?')) applyGiftCard(<?=$booking->id; ?>,'new');">Apply</button>
                                                                <button id="giftcard_remove_button_<?=$booking->id;?>" class="btn btn-warning" type="button" onclick="if(confirm('Are you sure you want to remove the gift card?')) removeGiftCard(<?=$booking->id; ?>);" style="display:none;font-size:10px; padding:5px 12px;">Remove</button> -->

                                                                <button id="giftcard_button_<?=$booking->id;?>" class="btn btn-success" type="button" style="font-size:10px; padding:5px 12px;" onclick="applyGiftCard(<?=$booking->id; ?>,'new')">Apply</button>
                                                                <!-- <button id="giftcard_button_<?=$booking->id;?>" class="btn btn-success" type="button" style="font-size:10px; padding:5px 12px;" onclick="openConfirmationDialog('Are you sure you want to apply the gift card?', function(confirmed) { if (confirmed) { applyGiftCard(<?=$booking->id; ?>,'new'); } })">Apply</button> -->
                                                                <!-- <button id="giftcard_remove_button_<?=$booking->id;?>" class="btn btn-warning" type="button" onclick="openConfirmationDialog('Are you sure you want to remove the gift card?', function(confirmed) { if (confirmed) { removeGiftCard(<?=$booking->id; ?>); } })" style="display:none;font-size:10px; padding:5px 12px;">Remove</button> -->
                                                                <button id="giftcard_remove_button_<?=$booking->id;?>" class="btn btn-warning" type="button" onclick="removeGiftCard(<?=$booking->id; ?>)" style="display:none;font-size:10px; padding:5px 12px;">Remove</button>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="row bill_in">
                                        <div class="form-group col-md-4 col-xs-12">
                                            <label>Payment Amount<b class="require">*</b></label>
                                            <input type="number" class="form-control" name="paid_amount_<?=$booking->id;?>" id="paid_amount_<?=$booking->id;?>" placeholder="Enter Paid Amount" value="" onkeyup="calculatePendingAmount(<?=$booking->id;?>)" <?php if($booking->booking_generated_from == '1'){ echo 'readonly title="Complete Payment needed for Mobile Bookings"'; }?>>
                                            <label for="paid_amount_<?=$booking->id;?>" generated="true" class="error" style="display:none;float:left; width:100%;">Please enter payment amount!</label>
                                        </div>
                                        <div class="form-group col-md-4 col-xs-12">
                                            <label>Pending Amount<b class="require"></b></label>
                                            <input readonly type="number" class="form-control" name="pending_amount_<?=$booking->id;?>" id="pending_amount_<?=$booking->id;?>" placeholder="Enter Pending Amount" value="">
                                            <label for="pending_amount_<?=$booking->id;?>" generated="true" class="error" style="display:none;float:left; width:100%;">Please enter payment amount!</label>
                                        </div>
                                        <div class="form-group col-md-4 col-xs-12">
                                            <label>Payment Mode<b class="require">*</b></label>
                                            <select class="form-control form-select" name="payment_mode_<?=$booking->id;?>" id="payment_mode_<?=$booking->id;?>" onchange="setTransactionID('<?=$booking->id;?>')">
                                                <option value="">Select Payment Mode</option>
                                                <?php if(!empty($payment_modes)){ for($i=0;$i<count($payment_modes); $i++){ ?>
                                                    <option value="<?=$payment_modes[$i];?>"><?=$payment_modes[$i];?></option>
                                                <?php }}else{ ?>
                                                    <option value="UPI">UPI</option>
                                                    <option value="Cash">Cash</option>
                                                    <!-- <option value="Cheque">Cheque</option> -->
                                                    <option value="Card">Card</option>
                                                    <option value="Online">Online</option>
                                                <?php } ?>
                                            </select>
                                            <label for="payment_mode_<?=$booking->id;?>" generated="true" class="error" style="display:none;float:left; width:100%;">Please enter payment amount!</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4 col-xs-12">
                                            <label>Transaction ID</label>
                                            <input readonly type="text" placeholder="Enter Transaction ID" class="form-control" name="transaction_id_<?=$booking->id;?>" id="transaction_id_<?=$booking->id;?>" value="">
                                        </div>
                                        <div class="form-group col-md-4 col-xs-12">
                                            <label>Payment Date<b class="require">*</b></label>
                                            <input readonly type="date" class="form-control" name="payment_date_<?=$booking->id;?>" id="payment_date_<?=$booking->id;?>" value="<?php echo date("Y-m-d"); ?>">
                                            <label for="payment_date_<?=$booking->id;?>" generated="true" class="error" style="display:none;float:left; width:100%;">Please enter payment amount!</label>
                                        </div>
                                        <div class="form-group col-md-4 col-xs-12" id="message_type_div_<?=$booking->id;?>" style="display:none;">
                                            <label>Select Message Type<b class="require">*</b></label>
                                            <select class="form-control form-select" name="message_type_<?=$booking->id;?>" id="message_type_<?=$booking->id;?>">
                                                <option value="">Select Option</option>
                                                <option value="1" <?php if(!empty($booking_rules) && $booking_rules->booking_reminder_type == '1'){ echo 'selected'; }?>>SMS</option>
                                                <option value="2" <?php if(!empty($booking_rules) && $booking_rules->booking_reminder_type == '2'){ echo 'selected'; }?>>Email</option>
                                                <option value="3" <?php if(!empty($booking_rules) && $booking_rules->booking_reminder_type == '3'){ echo 'selected'; }?>>Whatsapp</option>
                                            </select>
                                            <label for="message_type_<?=$booking->id;?>" generated="true" class="error" style="display:none;float:left; width:100%;">Please enter payment amount!</label>
                                        </div>
                                        <label class="error" style="display:none;" id="stock_selection_error_<?=$booking->id;?>">Please enter payment amount!</label>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4 col-xs-12" style="display:none;">
                                            <label>Send Appointments Details<b class="require">*</b></label>
                                            <select class="form-control form-select" name="send_appointment_details_<?=$booking->id;?>" id="send_appointment_details_<?=$booking->id;?>" onchange="toggleMessageType(<?=$booking->id;?>)">
                                                <option value="">Select Option</option>
                                                <option value="1" selected>Yes</option>
                                                <option value="2">No</option>
                                            </select>
                                            <label for="send_appointment_details_<?=$booking->id;?>" generated="true" class="error" style="display:none;float:left; width:100%;">Please enter payment amount!</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12 col-xs-12" style="text-align:right;">
                                            <button style="font-size:12px;" type="submit" class="btn btn-info" id="save_payment_btn_<?=$booking->id;?>" name="payment_btn_<?=$booking->id;?>" value="save">Save Bill</button>
                                            <button style="padding:8px 12px" type="submit" class="btn btn-primary" id="payment_btn_<?=$booking->id;?>" name="payment_btn_<?=$booking->id;?>" value="generate">Generate Bill & Share with Customer</button>
                                        </div>
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
<div class="loader_div">
    <div  class="loader-new"></div>
</div>
        <?php include('footer.php'); ?>          
        <script>
            function setTransactionID(id){
                payment_mode = $('#payment_mode_' + id).val();
                if(payment_mode == 'Cash'){
                    $('#transaction_id_' + id).attr('readonly', true);
                }else{
                    $('#transaction_id_' + id).attr('readonly', false);
                }
            }
            $(document).ready(function () {                        
                $(".chosen-select").chosen();
                var selected_service_details = <?php echo json_encode($all_service_details_ids); ?>;
                var bookingID = <?php echo $booking->id; ?>;
                $('.loader_div').show();   
                setTimeout(function() {
                    for(k=0;k<selected_service_details.length;k++){
                        setServicePrice(selected_service_details[k],bookingID);
                    }
                    $('.loader_div').hide(); 
                }, 1500);

                toggleMessageType(bookingID);

                var selected_coupon_id = $('#selected_coupon_id_' + bookingID).val();
                var is_giftcard_applied = $('#is_giftcard_applied_' + bookingID).val();
                var is_offer_applied_to_booking = $('#is_offer_applied_to_booking_' + bookingID).val();
                var applied_offerID = $('#offer_applied_to_booking_' + bookingID).val();
                
                var customer_booking_reward_discount_received = parseInt($('#customer_booking_reward_discount_received_' + bookingID).val());
                var customer_booking_reward_used = parseInt($('#customer_booking_reward_used_' + bookingID).val());
                var customer_booking_reward_is_applied = parseInt($('#customer_booking_reward_is_applied_' + bookingID).val());
                if(selected_coupon_id != "" && selected_coupon_id != '0'){
                    applyCoupon(bookingID,selected_coupon_id,'previous');
                }else if(is_giftcard_applied == '1'){
                    applyGiftCard(bookingID,'previous');
                }else if(is_offer_applied_to_booking == '1'){
                    applyOffer(bookingID,applied_offerID,'previous');
                }

                if(customer_booking_reward_is_applied == '1'){
                    applyRewards(bookingID);
                }

                $('#payment_form_<?=$booking->id;?>').validate({
                    ignore:[],
                    rules: {
                        'service_checkbox_<?=$booking->id;?>[]': {
                            required: true,
                        },
                        'payment_date_<?=$booking->id;?>': {
                            required: true,
                        },
                        'payment_mode_<?=$booking->id;?>': {
                            required: true,
                        },
                        'paid_amount_<?=$booking->id;?>': {
                            required: true,
                            number: true,
                            min: 0,
                        },
                        'send_appointment_details_<?=$booking->id;?>': {
                            required: true,
                        },
                        'message_type_<?=$booking->id;?>': {
                            required: function(element) {
                                return $('#send_appointment_details_<?=$booking->id;?>').val() == '1';
                            },
                        },
                        <?php if(!empty($booking_services)){
                            foreach($booking_services as $booking_services_result){ ?>
                                'new_stylist_<?=$booking_services_result->id;?>': {
                                    required: true,
                                },
                        <?php }} ?>
                    },
                    messages: {
                        'service_checkbox_<?=$booking->id;?>[]': {
                            required: "Please select at least one service!",
                        },
                        'payment_date_<?=$booking->id;?>': {
                            required: "Please select payment date!",
                        },
                        'payment_mode_<?=$booking->id;?>': {
                            required: "Please select payment mode!",
                        },
                        'paid_amount_<?=$booking->id;?>': {
                            required: "Please enter payment amount!",
                            number: "Please enter number only!",
                            min: "Minimum amount 0 is allowed!",
                        },
                        'send_appointment_details_<?=$booking->id;?>': {
                            required: "Please select option!",
                        },
                        'message_type_<?=$booking->id;?>': {
                            required: "Please select option!",
                        },
                        <?php if(!empty($booking_services)){
                            foreach($booking_services as $booking_services_result){ ?>
                                'new_stylist_<?=$booking_services_result->id;?>': {
                                    required: "Please select stylist!",
                                },
                        <?php }} ?>
                    },
                    submitHandler: function(form) {
                        var isValid = true;

                        $('.all_selected_stocks_<?=$booking->id;?>').each(function() {
                            var selectedValue = $(this).val();
                            var selectedService = $(this).attr('data-service-details');
                            var selectedProduct = $(this).attr('data-product-details');
                            
                            var productCheckbox = $('#service_products_checkbox_' + selectedService + '_' + selectedProduct);
                            if (productCheckbox.is(':checked')) {
                                if (selectedValue === "") {
                                    $('#stock_selection_service_error_' + selectedService + '_<?=$booking->id;?>').html('Please select stock products for this service');
                                    $('#stock_selection_service_error_' + selectedService + '_<?=$booking->id;?>').show();
                                    
                                    $('#stock_selection_error_<?=$booking->id;?>').html('Please select stock product for all booking services');
                                    $('#stock_selection_error_<?=$booking->id;?>').show();
                                    // alert("Please select a value for all selected stocks.");
                                    isValid = false;
                                }else{
                                    $('#stock_selection_service_error_' + selectedService + '_<?=$booking->id;?>').html('');
                                    $('#stock_selection_service_error_' + selectedService + '_<?=$booking->id;?>').hide();
                                }
                            }
                        });
                        // if (isValid && confirm("Are you sure to generate bill?")) {
                        if (isValid) {
                            $('#stock_selection_error_<?=$booking->id;?>').html('');
                            $('#stock_selection_error_<?=$booking->id;?>').hide();
                            $('#stock_selection_service_error_' + selectedService + '_<?=$booking->id;?>').html('');
                            $('#stock_selection_service_error_' + selectedService + '_<?=$booking->id;?>').hide();

                            document.getElementById('save_payment_btn_<?=$booking->id;?>').remove();
                            document.getElementById('payment_btn_<?=$booking->id;?>').remove();
                            form.submit();
                        } else {
                            return false;
                        }
                        // if(confirm("Are you sure to generate bill?")) {
                        // // openConfirmationDialog("Are you sure to generate bill?", function (confirmed) {
                        // // if (confirmed) {
                        //     form.submit();
                        // } else {
                        //     return false;
                        // }
                        // // });
                    }
                });
            });
            var today = new Date();
            var tenYearsAgo = new Date(today.getFullYear() - 10, today.getMonth(), today.getDate());

            $('#payment_date_<?=$booking->id;?>').datepicker({
                dateFormat: 'yy-mm-dd',
                minDate: tenYearsAgo, // Allow dates from 10 years ago
                maxDate: today,       // Disable future dates
            });
            function toggleMessageType(bookingID){
                if($('#send_appointment_details_' + bookingID).val() == '1'){
                    $('#message_type_div_' + bookingID).show();
                }else{
                    $('#message_type_div_' + bookingID).hide();
                }
            }
            
            function setServicePrice(serviceDetailsID,bookingID){
                var service_price = parseFloat($('#single_service_price_' + serviceDetailsID).val());
                var service_rewards = $('#service_rewards_hidden_' + serviceDetailsID).val();
                var current_total = parseFloat($('#total_service_amount_' + bookingID).val());
                var selected_coupon_id = parseFloat($('#selected_coupon_id_' + bookingID).val());
                var selected_coupon_type = $('#selected_coupon_type_' + bookingID).val();
                var is_giftcard_applied = parseFloat($('#is_giftcard_applied_' + bookingID).val());
                var applied_giftcard_id = parseFloat($('#applied_giftcard_id_' + bookingID).val());

                if ($('#service_checkbox_' + serviceDetailsID).is(':checked')) {
                    $(".product_checkbox_"+serviceDetailsID).attr('disabled', false);

                    current_total = current_total + service_price;

                    var tempArray = [];

                    $(".product_checkbox_"+serviceDetailsID).each(function() {
                        $(this).prop('checked', true); 
                        tempArray.push($(this).val());
                    });

                    for (var i = 0; i < tempArray.length; i++) {
                        setServiceProductPrice(serviceDetailsID,tempArray[i],bookingID);
                    }
                } else {
                    $(".product_checkbox_"+serviceDetailsID).attr('disabled', true);

                    current_total = current_total - service_price;
                                        
                    var tempArray = [];
                    $(".product_checkbox_"+serviceDetailsID).each(function() {
                        if ($(this).prop('checked')) {
                            $(this).prop('checked', false); 
                            tempArray.push($(this).val());
                        }
                    });

                    for (var i = 0; i < tempArray.length; i++) {
                        setServiceProductPrice(serviceDetailsID,tempArray[i],bookingID);
                    }

                    if(selected_coupon_id != '' && selected_coupon_id != "0"){  
                        if(selected_coupon_type != 'previous'){   
                            removeCoupon(bookingID,selected_coupon_id,'prev');
                        }
                    }

                    if(is_giftcard_applied == '1' && applied_giftcard_id != '' && applied_giftcard_id != "0"){            
                        removeGiftCard(bookingID);
                    }
                }
                $('#total_service_amount_' + bookingID).val(parseFloat(current_total).toFixed(2));
                $('#total_service_amount_text_' + bookingID).text(parseFloat(current_total).toFixed(2));

                setPayableServiceAmount(bookingID);
            }

            function setServiceProductPrice(serviceDetailsID,productDetailsID,bookingID){  
                var product_price = parseFloat($('#single_service_product_price_'+serviceDetailsID+'_'+productDetailsID).val());
                var current_total = parseFloat($('#total_product_amount_' + bookingID).val());
                var selected_product = parseInt($('#selected_product_'+serviceDetailsID).text());
                var selected_coupon_id = parseFloat($('#selected_coupon_id_' + bookingID).val());
                var selected_coupon_type = $('#selected_coupon_type_' + bookingID).val();
                var is_giftcard_applied = parseFloat($('#is_giftcard_applied_' + bookingID).val());
                var applied_giftcard_id = parseFloat($('#applied_giftcard_id_' + bookingID).val());

                if ($('#service_products_checkbox_'+serviceDetailsID+'_'+productDetailsID).is(':checked')) {      
                    current_total = current_total + product_price;
                    selected_product = selected_product + 1;
                } else {
                    current_total = current_total - product_price;
                    selected_product = selected_product - 1;

                    if(selected_coupon_id != '' && selected_coupon_id != "0"){       
                        if(selected_coupon_type != 'previous'){   
                            removeCoupon(bookingID,selected_coupon_id,'prev');
                        }
                    }

                    if(is_giftcard_applied == '1' && applied_giftcard_id != '' && applied_giftcard_id != "0"){            
                        removeGiftCard(bookingID);
                    }
                }
                $('#total_product_amount_' + bookingID).val(parseFloat(current_total).toFixed(2));
                $('#total_product_amount_text_' + bookingID).text(parseFloat(current_total).toFixed(2));
                $('#selected_product_'+serviceDetailsID).text(parseInt(selected_product));
                
                setPayableServiceProductAmount(bookingID);
            }

            function setPayableServiceAmount(bookingID){
                giftcard_discount = parseFloat($('#gift_discount_' + bookingID).val());
                member_service_discount = $('#m_service_discount_' + bookingID).val();
                membership_discount_type = parseFloat($('#membership_discount_type_' + bookingID).val());

                if (typeof member_service_discount === 'undefined' || member_service_discount === '') {
                    member_service_discount = 0;
                }else{
                    member_service_discount = parseFloat(member_service_discount);
                }

                total_service_amount = parseFloat($('#total_service_amount_' + bookingID).val());

                if(membership_discount_type == '0'){
                    discount = (total_service_amount * member_service_discount)/100;
                }else if(membership_discount_type == '1'){
                    discount = member_service_discount;
                }else{
                    discount = 0;
                }        

                if(total_service_amount == 0){
                    discount = 0;
                }

                $('#m_service_discount_amount_' + bookingID).val(parseFloat(discount).toFixed(2));

                payable = total_service_amount - discount - giftcard_discount;

                $('#service_payable_hidden_' + bookingID).val(parseFloat(payable).toFixed(2));

                $('#service_payable_text_' + bookingID).text(parseFloat(payable).toFixed(2));
                
                setPayableAmount(bookingID);
            } 

            function setPayableServiceProductAmount(bookingID){
                member_product_discount = $('#m_product_discount_' + bookingID).val();
                membership_discount_type = parseFloat($('#membership_discount_type_' + bookingID).val());

                if (typeof member_product_discount === 'undefined' || member_product_discount === '') {
                    member_product_discount = 0;
                }else{
                    member_product_discount = parseFloat(member_product_discount);
                }

                total_product_amount = parseFloat($('#total_product_amount_' + bookingID).val());
                
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

                $('#m_product_discount_amount_' + bookingID).val(parseFloat(discount).toFixed(2));

                payable = total_product_amount - discount;

                $('#product_payable_hidden_' + bookingID).val(parseFloat(payable).toFixed(2));

                $('#product_payable_text_' + bookingID).html(parseFloat(payable).toFixed(2));

                setPayableAmount(bookingID);
            }

            function setPayableAmount(bookingID){
                service_payable = parseFloat($('#service_payable_hidden_' + bookingID).val());
                product_payable = parseFloat($('#product_payable_hidden_' + bookingID).val());
                package_payable = parseFloat($('#package_amount_' + bookingID).val());
                membership_payable = parseFloat($('#membership_payment_amount_' + bookingID).val());

                payable = service_payable + product_payable + package_payable + membership_payable;

                $('#payable_hidden_' + bookingID).val(parseFloat(payable).toFixed(2));

                setBookingAmount(bookingID);
            }


            function setBookingAmount(bookingID){
                calculateTotalDiscount(bookingID);
                
                coupon_discount = parseFloat($('#coupon_discount_amount_' + bookingID).val());
                offer_discount_amount_ = parseFloat($('#offer_discount_amount_' + bookingID).val());
                reward_discount = parseFloat($('#reward_discount_amount_' + bookingID).val());
                payable = parseFloat($('#payable_hidden_' + bookingID).val());

                booking = payable - coupon_discount - reward_discount - offer_discount_amount_;

                $('#booking_amount_hidden_' + bookingID).val(parseFloat(booking).toFixed(2));
                $('#booking_amount_' + bookingID).text(parseFloat(booking).toFixed(2));

                setGST(bookingID);
            }

            function setGST(bookingID){
                rate = parseFloat($('#salon_gst_rate_' + bookingID).val());
                booking_amount = parseFloat($('#booking_amount_hidden_' + bookingID).val());

                gst_amount = (rate  * booking_amount) / 100;

                $('#gst_amount_hidden_' + bookingID).val(parseFloat(gst_amount).toFixed(2));
                $('#gst_amount_' + bookingID).text(parseFloat(gst_amount).toFixed(2));

                setGrandTotal_bill(bookingID);
            }

            function setGrandTotal_bill(bookingID){
                booking_amount_single = parseFloat($('#booking_amount_hidden_' + bookingID).val());
                gst_amount_single = parseFloat($('#gst_amount_hidden_' + bookingID).val());
                customer_pending_amount = parseFloat($('#customer_pending_amount_' + bookingID).val());
                
                grand_total_single = booking_amount_single + gst_amount_single;

                allowed_max = grand_total_single + customer_pending_amount;
                $('#total_due_' + bookingID).text(parseFloat(allowed_max).toFixed(2));
                
                $('#paid_amount_' + bookingID).val(parseFloat(allowed_max).toFixed(2)).attr('max', parseFloat(allowed_max).toFixed(2));
                $('#grand_total_hidden_' + bookingID).val(parseFloat(grand_total_single).toFixed(2));
                $('#grand_total_' + bookingID).text(parseFloat(grand_total_single).toFixed(2));

                calculatePendingAmount(bookingID);
            }

            function calculatePendingAmount(bookingID){
                grand_total = parseFloat($('#grand_total_hidden_' + bookingID).val()) || 0;
                paid_amount = parseFloat($('#paid_amount_' + bookingID).val()) || 0;
                customer_pending_amount = parseFloat($('#customer_pending_amount_' + bookingID).val()) || 0;
                
                pending_now = (grand_total + customer_pending_amount) - paid_amount;

                $('#pending_amount_' + bookingID).val(parseFloat(pending_now).toFixed(2));
            }
            
            function calculateTotalDiscount(bookingID){
                $('#discount_details_div_' + bookingID).html('');
                var membership_service_discount_amount = parseFloat($('#m_service_discount_amount_' + bookingID).val());
                var membership_product_discount_amount = parseFloat($('#m_product_discount_amount_' + bookingID).val());
                var coupon_discount_amount = parseFloat($('#coupon_discount_amount_' + bookingID).val());
                var giftcard_discount_amount = parseFloat($('#gift_discount_' + bookingID).val());
                var offer_discount_amount = parseFloat($('#offer_discount_amount_' + bookingID).val());
                var reward_discount_amount = parseFloat($('#reward_discount_amount_' + bookingID).val());
                 
                total_discount = membership_service_discount_amount + membership_product_discount_amount + offer_discount_amount + coupon_discount_amount + giftcard_discount_amount + reward_discount_amount;
                $('#discount_amount_' + bookingID).text(parseFloat(total_discount).toFixed(2));
                $('#total_discount_hidden_' + bookingID).val(parseFloat(total_discount).toFixed(2));

                var discount_details = '<div id="discount_details_info"><i class="fas fa-info-circle" style="color:#0000ffb0;"></i>';
                discount_details += '<div class="discount-tooltip">';
                if (membership_service_discount_amount > 0) {
                    discount_details += '<p>Membership Service Discount <span class="amount" style="float: right;">' + membership_service_discount_amount.toFixed(2) + '</span></p>';
                }
                if (membership_product_discount_amount > 0) {
                    discount_details += '<p>Membership Product Discount <span class="amount" style="float: right;">' + membership_product_discount_amount.toFixed(2) + '</span></p>';
                }
                if (offer_discount_amount > 0) {
                    discount_details += '<p>Offer Discount <span class="amount" style="float: right;">' + offer_discount_amount.toFixed(2) + '</span></p>';
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
                    $('#discount_details_div_' + bookingID).html(discount_details);
                }
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
            function applyCoupon(bookingID, couponId, type){
                $('.loader_div').show();   
                setTimeout(function() {
                    $('#coupon_error_' + bookingID + '_' + couponId).html('');
                    var coupon_expiry = $('#coupon_expiry_' + bookingID + '_' + couponId).val();
                    var coupon_min_price = parseFloat($('#coupon_min_price_' + bookingID + '_' + couponId).val());
                    var coupon_offers = parseFloat($('#coupon_offers_' + bookingID + '_' + couponId).val());
                    var coupon_name = $('#coupon_name_' + bookingID + '_' + couponId).val();
                    var coupon_gender = $('#coupon_gender_' + bookingID + '_' + couponId).val();

                    var payable = parseFloat($('#payable_hidden_' + bookingID).val());
                    var selected_package_id = $('#package_id_' + bookingID).val();
                    var is_giftcard_applied = $('#is_giftcard_applied_' + bookingID).val();
                    var is_offer_applied_to_booking = $('#is_offer_applied_to_booking_' + bookingID).val();
                    var customer_gender = $('#customer_gender_' + bookingID).val();
                    var used_rewards = $('#used_rewards_' + bookingID).val();

                    if(selected_package_id == ""){
                        if(is_offer_applied_to_booking == "" || is_offer_applied_to_booking == "0"){
                            if(is_giftcard_applied == "0" || is_giftcard_applied == ""){
                                if (used_rewards == "" || parseInt(used_rewards) <= 0) {
                                    if(customer_gender == coupon_gender){
                                        var currentDate = new Date();
                                        var yyyy = currentDate.getFullYear();
                                        var mm = String(currentDate.getMonth() + 1).padStart(2, '0');
                                        var dd = String(currentDate.getDate()).padStart(2, '0');
                                        var todayDate = yyyy + '-' + mm + '-' + dd;

                                        if(payable >= coupon_min_price){
                                            if(todayDate <= coupon_expiry){
                                                expiry_flag = 0;
                                            }else{
                                                if(type == 'previous'){
                                                    expiry_flag = 0;
                                                }else{
                                                    expiry_flag = 1;
                                                }
                                            }
                                            $('#selected_coupon_type_' + bookingID).val(type);
                                            var selected_coupon_type = $('#selected_coupon_type_' + bookingID).val();
                                            if(expiry_flag == 0){
                                                var previousCouponId = $('#selected_coupon_id_' + bookingID).val();
                                                if (previousCouponId != '') {         
                                                    if(selected_coupon_type != "previous"){
                                                        removeCoupon(bookingID,previousCouponId,'prev');
                                                    }
                                                }  
                                                $('.loader_div').show();  

                                                $('#coupon_discount_amount_' + bookingID).val(parseFloat(coupon_offers).toFixed(2));
                                                $('#selected_coupon_id_' + bookingID).val(couponId);

                                                coupon_div = $('#coupon_button_' + bookingID + '_'+ couponId);

                                                coupon_div.html('');

                                                // new_coupon_div = '<button class="btn btn-warning" type="button" onclick="if(confirm(\'Are you sure you want to remove the coupon?\')) { removeCoupon(' + bookingID + ',' + couponId + ',\'new\'); }" style="font-size:10px; padding:5px 12px;" data-toggle="tooltip" data-placement="top" title="Remove Coupon">Remove</button>';
                                                new_coupon_div = '<button class="btn btn-warning" type="button" onclick="openConfirmationDialog(\'Are you sure you want to remove the coupon?\', function(confirmed) { if (confirmed) { removeCoupon(' + bookingID + ',' + couponId + ',\'new\'); } })" style="font-size:10px; padding:5px 12px;" data-toggle="tooltip" data-placement="top" title="Remove Coupon">Remove</button>';

                                                coupon_div.html(new_coupon_div);
                                                    
                                                $('.loader_div').hide(); 
                                            }else{ 
                                                if(type == 'previous'){
                                                    $('#coupon_error_' + bookingID + '_' + couponId).html('');
                                                    $('#coupon_discount_amount_' + bookingID).val(parseFloat(0.00).toFixed(2));
                                                    $('#selected_coupon_id_' + bookingID).val('');
                                                }
                                                $('.loader_div').hide();                                        
                                                // alert('Coupon code is expired');
                                                openDialog('Coupon code is expired'); 
                                            }
                                        }else{ 
                                            $('.loader_div').hide(); 
                                            if(type == 'previous'){
                                                $('#coupon_error_' + bookingID + '_' + couponId).html('');
                                                $('#coupon_discount_amount_' + bookingID).val(parseFloat(0.00).toFixed(2));
                                                $('#selected_coupon_id_' + bookingID).val('');
                                                // alert('Previously applied coupon ' + coupon_name + ' not applicable now as Minimum Payable amount require: Rs.'+coupon_min_price);
                                                openDialog('Previously applied coupon ' + coupon_name + ' not applicable now as Minimum Payable amount require: Rs.'+coupon_min_price); 
                                            }else{                            
                                                // alert('Coupon ' + coupon_name + ' not applicable. Minimum Payable amount require: Rs.'+coupon_min_price);
                                                openDialog('Coupon ' + coupon_name + ' not applicable. Minimum Payable amount require: Rs.'+coupon_min_price); 
                                            }
                                        }
                                    }else{  
                                        $('.loader_div').hide(); 
                                        // alert('Coupon code not applicable on applied giftcard');
                                        openDialog('Coupon code not valid for customer gender'); 
                                    }
                                }else{  
                                    $('.loader_div').hide(); 
                                    // alert('Coupon code not applicable on applied giftcard');
                                    openDialog('Coupon code not applicable on applied rewards'); 
                                }
                            }else{  
                                $('.loader_div').hide(); 
                                // alert('Coupon code not applicable on applied giftcard');
                                openDialog('Coupon code not applicable on applied giftcard'); 
                            }
                        }else{ 
                            $('.loader_div').hide(); 
                            // alert('Coupon code not applicable if package is selected');
                            openDialog('Coupon code not applicable if offer is applied'); 
                        }
                    }else{ 
                        $('.loader_div').hide(); 
                        // alert('Coupon code not applicable if package is selected');
                        openDialog('Coupon code not applicable if package is selected'); 
                    }
                    setBookingAmount(bookingID);
                }, 1500);
            }

            function removeCoupon(bookingID, couponId,type){
                $('.loader_div').show();   
                setTimeout(function() {
                    $('#coupon_error_' + bookingID + '_' + couponId).html('');
                    $('#coupon_discount_amount_' + bookingID).val(parseFloat(0.00).toFixed(2));
                    if(type === 'new'){
                        $('#selected_coupon_id_' + bookingID).val('');
                    }

                    coupon_div = $('#coupon_button_' + bookingID + '_'+ couponId);
                    coupon_div.html('');
                    new_coupon_div = 
                        '<button class="btn btn-success" type="button" style="font-size:10px; padding:5px 12px;" onclick="applyCoupon(' + bookingID + ','+ couponId +')">Apply</button>\
                    ';
                    coupon_div.html(new_coupon_div);
                    
                    if(type === 'new'){
                        setBookingAmount(bookingID);
                    }

                    $('.loader_div').hide(); 
                }, 100);
            }   
            function applyGiftCard(bookingID,type){
                $('.loader_div').show();   
                setTimeout(function() {
                    $('#giftcard_error_' + bookingID).hide();
                    var selected_package_id = $('#package_id_' + bookingID).val();
                    var selected_coupon_id = $('#selected_coupon_id_' + bookingID).val();
                    var used_rewards = $('#used_rewards_' + bookingID).val();
                    var customer = $('#customer_id_' + bookingID).val();
                    
                    var booking_services = [];

                    $('.booking_services_' + bookingID + ':checked').each(function() {
                        var selected_service_id = $('#single_service_id_' + $(this).val()).val();
                        var details_id = $(this).val();

                        var serviceDetails = {
                            service_id: selected_service_id,
                            details_id: details_id
                        };

                        booking_services.push(serviceDetails);
                    });
                    var code = $('#giftcard_no_' + bookingID).val();
                    if (selected_package_id == "") {
                        var is_offer_applied_to_booking = $('#is_offer_applied_to_booking_' + bookingID).val();
                        if(is_offer_applied_to_booking == "" || is_offer_applied_to_booking == "0"){
                            if (selected_coupon_id == "") {
                                if (used_rewards == "" || parseInt(used_rewards) <= 0) {
                                    if (code != "") {
                                        if (booking_services.length > 0) {
                                            $.ajax({
                                                type: "POST",
                                                url: "<?= base_url(); ?>salon/Ajax_controller/check_giftcard_ajx",
                                                data: { 'code': code, 'customer': customer },
                                                success: function(data) {
                                                    console.log(data);
                                                    $('.loader_div').hide();  
                                                    $('#is_giftcard_applied_' + bookingID).val('0');
                                                    $('#is_new_giftcard_applied_' + bookingID).val('');
                                                    $('#applied_giftcard_id_' + bookingID).val('');
                                                    $('#giftcard_redemption_id_' + bookingID).val('');
                                                    var opts = $.parseJSON(data);
                                                    is_valid = opts.is_valid;
                                                    is_customer_used = opts.is_customer_used;
                                                    giftcard_id = opts.giftcard_id;
                                                    giftcard_min_amount = opts.giftcard_min_amount;
                                                    giftcard_discount_amount = opts.giftcard_discount_amount;
                                                    giftcard_redemption_id = opts.giftcard_redemption_id;
                                                    giftcard_owner_id = opts.giftcard_owner_id;
                                                                
                                                    total_giftcard_discount = 0;

                                                    if(is_valid == '1'){
                                                        if(is_customer_used == '0'){
                                                            var payable = parseFloat($('#payable_hidden_' + bookingID).val());
                                                            // if(payable >= giftcard_min_amount){
                                                                if(giftcard_discount_amount >= payable){
                                                                    var discount_consider = payable;                                                        
                                                                }else{
                                                                    var discount_consider = giftcard_discount_amount;       
                                                                }

                                                                $('#giftcard_error_' + bookingID).hide();
                                                                $('#giftcard_error_' + bookingID).html('');

                                                                $('#giftcard_remove_button_' + bookingID).show();
                                                                $('#giftcard_button_' + bookingID).hide();
                                                                $('#giftcard_no_' + bookingID).prop('disabled',true);

                                                                $('#gift_discount_' + bookingID).val(parseFloat(discount_consider).toFixed(2));
                                                                $('#is_giftcard_applied_' + bookingID).val('1');
                                                                $('#is_new_giftcard_applied_' + bookingID).val(is_customer_used);
                                                                $('#giftcard_redemption_id_' + bookingID).val(giftcard_redemption_id);
                                                                $('#applied_giftcard_id_' + bookingID).val(giftcard_id);
                                                                $('#applied_giftcard_owner_id_' + bookingID).val(giftcard_owner_id);
                                                                
                                                                $('#giftcard_success_' + bookingID).html('Giftcard applied successfully');
                                                                $('#giftcard_success_' + bookingID).show();

                                                                setPayableServiceAmount(bookingID);
                                                            // }else{
                                                            //     $('#giftcard_error_' + bookingID).html('Giftcard not applicable. Minimum Payable amount require: Rs.'+parseFloat(giftcard_min_amount).toFixed(2));
                                                            //     $('#giftcard_error_' + bookingID).show();
                                                            //     $('#giftcard_success_' + bookingID).html('');
                                                            //     $('#giftcard_success_' + bookingID).hide();
                                                            //     $('#giftcard_no_' + bookingID).val('');

                                                            //     setTimeout(function() {
                                                            //         $('#giftcard_error_' + bookingID).hide();
                                                            //     }, 4000);
                                                            // }
                                                        }else{
                                                            $('#giftcard_error_' + bookingID).html('Giftcard not valid for this customer. Please buy it first.');
                                                            $('#giftcard_error_' + bookingID).show();
                                                            $('#giftcard_success_' + bookingID).html('');
                                                            $('#giftcard_success_' + bookingID).hide();
                                                            $('#giftcard_no_' + bookingID).val('');

                                                            setTimeout(function() {
                                                                $('#giftcard_error_' + bookingID).hide();
                                                            }, 4000);
                                                        }
                                                    }else{
                                                        $('#giftcard_error_' + bookingID).html('Invalid Giftcard no');
                                                        $('#giftcard_error_' + bookingID).show();
                                                        $('#giftcard_success_' + bookingID).html('');
                                                        $('#giftcard_success_' + bookingID).hide();
                                                        $('#giftcard_no_' + bookingID).val('');

                                                        setTimeout(function() {
                                                            $('#giftcard_error_' + bookingID).hide();
                                                        }, 4000);
                                                    }
                                                },
                                            });
                                        }else{  
                                            $('.loader_div').hide();
                                            // alert('Please select services');
                                            openDialog('Please select services'); 
                                            $('#giftcard_no_' + bookingID).val('');
                                        }
                                    }else{
                                        $('.loader_div').hide();  
                                        // alert('Please enter giftcard no');
                                        openDialog('Please enter giftcard no'); 
                                        $('#giftcard_no_' + bookingID).val('');
                                    }
                                }else{
                                    $('.loader_div').hide();
                                    // alert('Giftcard not applicable on applied coupon');
                                    openDialog('Giftcard not applicable on applied rewards'); 
                                    $('#giftcard_no_' + bookingID).val('');
                                }
                            }else{ 
                                $('.loader_div').hide();
                                // alert('Giftcard not applicable on applied coupon');
                                openDialog('Giftcard not applicable on applied coupon'); 
                                $('#giftcard_no_' + bookingID).val('');
                            }
                        }else{ 
                            $('.loader_div').hide();
                            // alert('Giftcard not applicable on applied coupon');
                            openDialog('Giftcard not applicable on applied offer'); 
                            $('#giftcard_no_' + bookingID).val('');
                        }
                    }else{
                        $('.loader_div').hide();
                        // alert('Giftcard not applicable on packages');
                        openDialog('Giftcard not applicable on packages'); 
                        $('#giftcard_no_' + bookingID).val('');
                    }
                }, 1500);
            }
            function removeGiftCard(bookingID){
                $('.loader_div').show();   
                setTimeout(function() {
                    $('#giftcard_error_' + bookingID).html('');
                    $('#giftcard_error_' + bookingID).hide();                                    
                    $('#giftcard_success_' + bookingID).html('');
                    $('#giftcard_success_' + bookingID).hide();
                    
                    $('#gift_discount_' + bookingID).val(parseFloat(0.00).toFixed(2));
                    $('#is_giftcard_applied_' + bookingID).val('0');
                    $('#is_new_giftcard_applied_' + bookingID).val('');
                    $('#applied_giftcard_id_' + bookingID).val('');
                    $('#giftcard_redemption_id_' + bookingID).val('');
                    $('#giftcard_no_' + bookingID).val('');

                    $('#giftcard_remove_button_' + bookingID).hide();
                    $('#giftcard_button_' + bookingID).show();
                    $('#giftcard_no_' + bookingID).prop('disabled',false);
                    setPayableServiceAmount(bookingID);
                    $('.loader_div').hide();  
                }, 1500);
            }

            
            function applyOffer(bookingID,offerID,type){
                $('.loader_div').show();   
                setTimeout(function() {
                    $('#offer_error_' + bookingID).hide();
                    var selected_package_id = $('#package_id_' + bookingID).val();
                    var selected_coupon_id = $('#selected_coupon_id_' + bookingID).val();
                    var used_rewards = $('#used_rewards_' + bookingID).val();
                    var customer = $('#customer_id_' + bookingID).val();
                    
                    var booking_services = [];

                    $('.booking_services_' + bookingID + ':checked').each(function() {
                        var selected_service_id = $('#single_service_id_' + $(this).val()).val();
                        var details_id = $(this).val();

                        var serviceDetails = {
                            service_id: selected_service_id,
                            details_id: details_id
                        };

                        booking_services.push(serviceDetails);
                    });
                    var total_offer_discount = 0;
                    if (selected_package_id == "") {
                        if (selected_coupon_id == "") {
                            if (used_rewards == "" || parseInt(used_rewards) <= 0) {
                                if (offerID != "") {
                                    if (booking_services.length > 0) {
                                        var is_offer_applied_to_booking = $('#is_offer_applied_to_booking_' + bookingID).val();
                                        var offer_applied_to_booking = $('#offer_applied_to_booking_' + bookingID).val();
                                        if (is_offer_applied_to_booking == '1' && offer_applied_to_booking != '') {  
                                            removeCoupon(bookingID,offer_applied_to_booking,'prev');
                                        }  
                                        var any_service_selected = '0';
                                        var offer_applied_to_booking = '';
                                        var offer_servicesString = $('#offer_services_' + bookingID + '_' + offerID).val();
                                        var offer_discount = $('#offer_discount_' + bookingID + '_' + offerID).val();
                                        var offer_discount_in = $('#offer_discount_in_' + bookingID + '_' + offerID).val();
                                        var offer_servicesArray = offer_servicesString.split(',');
                                        offer_servicesArray = offer_servicesArray.map(service => service.trim());
                                        for(j=0;j<booking_services.length;j++){
                                            selected_service = booking_services[j]['service_id'];
                                            selected_service_details = booking_services[j]['details_id'];

                                            if(offer_servicesArray.includes(selected_service)){
                                                any_service_selected = '1';
                                                offer_applied_to_booking = offerID;
                                                service_price = parseFloat($('#single_service_price_'+ selected_service_details).val());
                                                discount = parseFloat(offer_discount);
                                                if(offer_discount_in == '0'){
                                                    discount = (discount * service_price) / 100;
                                                }

                                                $('#is_service_offer_applied_'+ selected_service_details).val('1');
                                                $('#applied_offer_id_'+ selected_service_details).val(offerID);
                                                $('#service_offer_discount_'+ selected_service_details).val(offer_discount);
                                                $('#service_offer_discount_type_'+ selected_service_details).val(offer_discount_in);
                                                $('#service_offer_discount_amount_'+ selected_service_details).val(discount);
                                                
                                                total_offer_discount = total_offer_discount + discount;
                                            }
                                        }

                                        if(any_service_selected == '1'){
                                            $('#offer_success_' + bookingID).html('');
                                            $('#offer_success_' + bookingID).hide();
                                            $('#is_offer_applied_to_booking_' + bookingID).val('1');
                                            $('#offer_applied_to_booking_' + bookingID).val(offer_applied_to_booking);
                                            $('#offer_discount_amount_' + bookingID).val(parseFloat(total_offer_discount).toFixed(2));

                                            offer_div = $('#offer_button_' + bookingID + '_'+ offerID);

                                            offer_div.html('');

                                            new_offer_div = '<button class="btn btn-warning" type="button" onclick="openConfirmationDialog(\'Are you sure you want to remove the offer?\', function(confirmed) { if (confirmed) { removeOffer(' + bookingID + ',' + offerID + ',\'new\'); } })" style="font-size:10px; padding:5px 12px;" data-toggle="tooltip" data-placement="top" title="Remove Offer">Remove</button>';

                                            offer_div.html(new_offer_div);
                                            
                                            $('#offer_success_' + bookingID).html('Offer applied successfully');
                                            $('#offer_success_' + bookingID).show();
                                            $('.loader_div').hide();
                                        }else{
                                            $('.loader_div').hide();
                                            // alert('Please select services');
                                            openDialog('Selected Services not allowed for applied Offer'); 
                                        }
                                    }else{  
                                        $('.loader_div').hide();
                                        // alert('Please select services');
                                        openDialog('Please select services'); 
                                        $('#is_offer_applied_to_booking_' + bookingID).val('');
                                        $('#offer_applied_to_booking_' + bookingID).val('');
                                    }
                                }else{
                                    $('.loader_div').hide();  
                                    // alert('Please enter giftcard no');
                                    openDialog('Please select offer'); 
                                    $('#is_offer_applied_to_booking_' + bookingID).val('');
                                    $('#offer_applied_to_booking_' + bookingID).val('');
                                }
                            }else{  
                                $('.loader_div').hide();
                                // alert('Please select services');
                                openDialog('Offers not applicable on applied rewards'); 
                                $('#is_offer_applied_to_booking_' + bookingID).val('');
                                $('#offer_applied_to_booking_' + bookingID).val('');
                            }
                        }else{ 
                            $('.loader_div').hide();
                            // alert('Giftcard not applicable on applied coupon');
                            openDialog('Offers not applicable on applied coupon'); 
                            $('#is_offer_applied_to_booking_' + bookingID).val('');
                            $('#offer_applied_to_booking_' + bookingID).val('');
                        }
                    }else{
                        $('.loader_div').hide();
                        // alert('Giftcard not applicable on packages');
                        openDialog('Offers not applicable on packages'); 
                        $('#is_offer_applied_to_booking_' + bookingID).val('');
                        $('#offer_applied_to_booking_' + bookingID).val('');
                    }                    
                    setBookingAmount(bookingID);
                }, 1500);
            }
            function removeOffer(bookingID, offerId,type){
                $('.loader_div').show();   
                setTimeout(function() {
                    $('#offer_error_' + bookingID + '_' + offerId).html('');
                    $('#offer_discount_amount_' + bookingID).val(parseFloat(0.00).toFixed(2));
                    if(type === 'new'){
                        $('.is_service_offer_applied').val('0');
                        $('.applied_offer_id').val('');
                        $('.service_offer_discount').val('');
                        $('.service_offer_discount_amount').val('0.00');
                        $('.service_offer_discount_type').val('');
                    }

                    $('#offer_success_' + bookingID).html('');
                    $('#offer_success_' + bookingID).hide();
                    $('#is_offer_applied_to_booking_' + bookingID).val('');
                    offer_div = $('#offer_button_' + bookingID + '_'+ offerId);
                    offer_div.html('');
                    new_offer_div = 
                    '<button class="btn btn-success" type="button" style="font-size:10px; padding:5px 12px;" onclick="applyOffer(' + bookingID + ', ' + offerId + ', \'' + type + '\')">Apply</button>';
                    offer_div.html(new_offer_div);
                    
                    setBookingAmount(bookingID);

                    $('.loader_div').hide(); 
                }, 1500);
            }   


            function applyRewards(bookingID){
                var selected_coupon_id = $('#selected_coupon_id_' + bookingID).val();
                var is_offer_applied_to_booking = $('#is_offer_applied_to_booking_' + bookingID).val();
                var is_giftcard_applied = $('#is_giftcard_applied_' + bookingID).val();
                if (selected_coupon_id == "") {
                    if(is_giftcard_applied == "0" || is_giftcard_applied == ""){
                        if(is_offer_applied_to_booking == "" || is_offer_applied_to_booking == "0"){
                            $('.loader_div').show();   
                            setTimeout(function() {
                                var customer_reward_available = parseInt($('#customer_reward_available_' + bookingID).val());
                                var customer_gender = $('#customer_gender_' + bookingID).val();
                                var total_value = 0;

                                $.ajax({
                                    type: "POST",
                                    url: "<?= base_url(); ?>salon/Ajax_controller/get_reward_setup_ajx",
                                    data: { 'gender': customer_gender, 'bookingID':bookingID },
                                    success: function(data) {  
                                        var opts = $.parseJSON(data);
                                        if (!$.isEmptyObject(opts)) {
                                            rs_per_reward = opts.rs_per_reward;
                                            reward_point = opts.reward_point;
                                            minimum_reward_required = parseInt(opts.minimum_reward_required);
                                            maximum_reward_required = opts.maximum_reward_required;

                                            payableHidden = parseFloat($('#payable_hidden_' + bookingID).val());

                                            if(payableHidden > 0){
                                                if(customer_reward_available >= minimum_reward_required){
                                                    if(customer_reward_available > maximum_reward_required){
                                                        available_rewards = maximum_reward_required;
                                                    }else{
                                                        available_rewards = customer_reward_available;
                                                    }

                                                    consider_rewards = available_rewards / reward_point;
                                                    total_value = consider_rewards * rs_per_reward;

                                                    $('#reward_discount_amount_' + bookingID).val(parseFloat(total_value).toFixed(2));
                                                    $('#used_rewards_' + bookingID).val(available_rewards);
                                                    $('#customer_rewards_text_' + bookingID).html('');
                                                    $('#customer_rewards_text_' + bookingID).html('Rewards Balance: <s>'+customer_reward_available+'</s> '+(customer_reward_available-available_rewards)+'<br>Discount: Rs.'+parseFloat(total_value).toFixed(2));
                                                    $('#used_rewards_msg_' + bookingID).html('<label style="color:green;font-size:10px;">'+available_rewards+' Rewards used</label>');

                                                    setBookingAmount(bookingID);

                                                    $('#rewards_button_' + bookingID).hide();
                                                    $('#rewards_remove_button_' + bookingID).show();
                                                }else{
                                                    // alert('Minimum reward points required are: '+ minimum_reward_required);
                                                    openDialog('Minimum reward points required are: '+ minimum_reward_required); 
                                                }
                                            }else{
                                                // alert('Total amount is not valid.');
                                                openDialog('Total amount is not valid.'); 
                                            } 
                                        }else{
                                            // alert('Reward point setup not available');
                                            openDialog('Reward point setup not available'); 
                                        }
                                        $('.loader_div').hide();  
                                    },
                                });
                            }, 1500);
                        }else{
                            $('.loader_div').hide(); 
                            // alert('Coupon code not applicable on applied giftcard');
                            openDialog('Rewards not applicable on applied giftcard'); 
                        }
                    }else{
                        $('.loader_div').hide(); 
                        // alert('Coupon code not applicable on applied giftcard');
                        openDialog('Rewards not applicable on applied giftcard'); 
                    }
                }else{
                    $('.loader_div').hide();
                    // alert('Giftcard not applicable on applied coupon');
                    openDialog('Rewards not applicable on applied coupon'); 
                }
            }
            function removeRewards(bookingID){
                $('.loader_div').show();   
                setTimeout(function() {
                    var customer_reward_available = parseInt($('#customer_reward_available_' + bookingID).val());
                    $('#reward_discount_amount_' + bookingID).val(parseFloat(0).toFixed(2));
                    $('#used_rewards_' + bookingID).val(0);
                    $('#customer_rewards_text_' + bookingID).html('');
                    $('#customer_rewards_text_' + bookingID).html('Rewards Balance: '+customer_reward_available);
                    $('#used_rewards_msg_' + bookingID).html('');
                    
                    setBookingAmount(bookingID);

                    $('#rewards_button_' + bookingID).show();
                    $('#rewards_remove_button_' + bookingID).hide();
                    
                    $('.loader_div').hide();   
                }, 1500);
            }
        </script>
    <?php }else{ ?>
        <div style="text-align:center;">
            <label class="error">Bill already generated</label>
        </div>
    <?php }}else{ ?>
        <div style="text-align:center;">
            <label class="error">Booking details not found</label>
        </div>
    <?php }}else{ ?>
        <div style="text-align:center;">
            <label class="error">Booking rules not available</label>
        </div>
    <?php } ?>