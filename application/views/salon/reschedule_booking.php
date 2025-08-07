<?php include('header.php'); ?>
<style>
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
    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
    .timeslot_box {
        padding: 5px;
        border: 1px solid #ccc;
        height: auto;
        display: block;
        float: left;
        min-width: 100%;
      margin-bottom: 8px;
    border-radius: 5px;
    min-height:150px;

    }
    .left-span{
        line-height:40px;
    }
    .slot-tabcontent{
        width:100%;
    }
</style>
<?php
    $setup = $this->Master_model->get_backend_setups();
    $store_profile = $this->Salon_model->get_all_salon_profile_single();		
    $booking_rules = $this->Salon_model->get_booking_rules();
    $stylists = $this->Salon_model->get_salon_all_stylists();
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

    $booking_id = base64_decode($this->uri->segment(2));

    $this->db->select('tbl_new_booking.*,tbl_salon_customer.gender as customer_gender, tbl_salon_customer.membership_pkey,tbl_salon_customer.id as customer_id,tbl_salon_customer.full_name as customer_name,tbl_salon_customer.customer_phone');
    $this->db->join('tbl_salon_customer','tbl_salon_customer.id = tbl_new_booking.customer_name');
    $this->db->where('tbl_new_booking.id',$booking_id);
    $this->db->where('tbl_new_booking.is_deleted','0');
    $this->db->where('tbl_new_booking.booking_type','0');
    $bookings = $this->db->get('tbl_new_booking')->row();
    
    $this->db->select('tbl_booking_services_details.*,tbl_admin_sub_category.sub_category_marathi,tbl_admin_sub_category.sub_category as sub_category_name,tbl_admin_service_category.sup_category, tbl_admin_service_category.sup_category_marathi,tbl_package.package_name, tbl_salon_customer.membership_pkey,tbl_salon_customer.id as customer_id, tbl_new_booking.amount_to_paid,tbl_new_booking.payment_status,tbl_new_booking.is_membership_booking,tbl_new_booking.membership_id,tbl_new_booking.membership_discount_type,tbl_new_booking.m_service_discount,tbl_new_booking.m_product_discount,tbl_new_booking.payment_date,tbl_salon_employee.full_name as stylist_name, tbl_salon_customer.full_name as customer_name,tbl_salon_customer.customer_phone, tbl_salon_emp_service.service_name,tbl_salon_emp_service.service_name_marathi,tbl_salon_emp_service.service_duration,tbl_salon_emp_service.reward_point,tbl_salon_emp_service.product as all_service_prducts');
    $this->db->join('tbl_salon_emp_service','tbl_salon_emp_service.id = tbl_booking_services_details.service_id');
    $this->db->join('tbl_salon_customer','tbl_salon_customer.id = tbl_booking_services_details.customer_name');
    $this->db->join('tbl_new_booking','tbl_new_booking.id = tbl_booking_services_details.booking_id');
    $this->db->join('tbl_salon_employee','tbl_salon_employee.id = tbl_booking_services_details.stylist_id');
    $this->db->join('tbl_package','tbl_package.id = tbl_booking_services_details.package_id','left');
    $this->db->join('tbl_admin_sub_category', 'tbl_salon_emp_service.sub_category = tbl_admin_sub_category.id');
    $this->db->join('tbl_admin_service_category', 'tbl_salon_emp_service.category = tbl_admin_service_category.id');
    $this->db->where('tbl_booking_services_details.booking_id',$booking_id);
    $this->db->where('tbl_booking_services_details.is_deleted','0');
    $this->db->where('tbl_booking_services_details.service_status','0');
    $this->db->order_by('tbl_booking_services_details.service_from','asc');
    $booking_services = $this->db->get('tbl_booking_services_details')->result();
    
    $this->db->select('tbl_booking_services_details.*,tbl_package.package_name, tbl_salon_customer.membership_pkey,tbl_salon_customer.id as customer_id, tbl_new_booking.amount_to_paid,tbl_new_booking.payment_status,tbl_new_booking.is_membership_booking,tbl_new_booking.membership_id,tbl_new_booking.membership_discount_type,tbl_new_booking.m_service_discount,tbl_new_booking.m_product_discount,tbl_new_booking.payment_date,tbl_salon_employee.full_name as stylist_name, tbl_salon_customer.full_name as customer_name,tbl_salon_customer.customer_phone, tbl_salon_emp_service.service_name,tbl_salon_emp_service.service_name_marathi,tbl_salon_emp_service.service_duration,tbl_salon_emp_service.reward_point,tbl_salon_emp_service.product as all_service_prducts');
    $this->db->join('tbl_salon_emp_service','tbl_salon_emp_service.id = tbl_booking_services_details.service_id');
    $this->db->join('tbl_salon_customer','tbl_salon_customer.id = tbl_booking_services_details.customer_name');
    $this->db->join('tbl_new_booking','tbl_new_booking.id = tbl_booking_services_details.booking_id');
    $this->db->join('tbl_salon_employee','tbl_salon_employee.id = tbl_booking_services_details.stylist_id');
    $this->db->join('tbl_package','tbl_package.id = tbl_booking_services_details.package_id','left');
    $this->db->where('tbl_booking_services_details.booking_id',$booking_id);
    $this->db->where('tbl_booking_services_details.is_deleted','0');
    $this->db->where('tbl_booking_services_details.service_status','0');
    $this->db->order_by('tbl_booking_services_details.service_from','asc');
    $this->db->limit(1);
    $first_booking_services = $this->db->get('tbl_booking_services_details')->row();

    if(!empty($bookings)){
        $products = $this->Salon_model->get_all_active_product_new($bookings->customer_id);
        $category = $this->Salon_model->get_all_sup_category_gender($bookings->customer_gender);
        $is_member = '0';
        $membership_id = '';
        $membership_discount_type = '';
        $membership_service_discount = '0.00';
        $membership_product_discount = '0.00';
        $membership_button = '';

        $membership_details = $this->Salon_model->get_membership_details($bookings->membership_pkey,$bookings->customer_id);
        $package_details = $this->Salon_model->get_package_details($bookings->pacakge_id);
        if(!empty($membership_details)){
            $is_member = '1';
            $membership_id = $membership_details->membership_id;
            $membership_discount_type = $membership_details->discount_in;
            $membership_service_discount = $membership_details->service_discount;
            $membership_product_discount = $membership_details->product_discount;
            $membership_text_color = $membership_details->text_color;
            $membership_bg_color = $membership_details->bg_color;
            $membership_name = $membership_details->membership_name;
            $membership_button = '<a class="btn btn-sm" style="margin-top: -5px;float:right; background-color:'.$membership_bg_color.'; color:'.$membership_text_color.'">'.$membership_name.'</a>';
        }   

        $slot_thresholds = [
            'morning'   => ['start' => '05:00:00', 'end' => '12:00:00'],
            'afternoon' => ['start' => '12:00:01', 'end' => '17:00:00'],
            'evening'   => ['start' => '17:00:01', 'end' => '23:00:00'],
        ];

        $service_time = $bookings->service_start_time;
        $slot_type = '';

        foreach ($slot_thresholds as $slot => $range) {
            if ($service_time >= $range['start'] && $service_time <= $range['end']) {
                $slot_type = $slot;
                break;
            }
        }

        if ($slot_type === '') {
            $slot_type = 'morning';
        }
?>
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <h3><b>Reschedule Booking</b></h3>
                    <div class="title_left"></div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin:0px auto;">
                    <div class="x_panel">
                        <div class="x_content">
                            <h5 style="margin-bottom: 0px;margin-left: 10px;margin-top:0px;"><b style="font-weight: 600;">Customer: <?=$bookings->customer_name.' ['.$bookings->customer_phone.']';?></b><?=$membership_button; ?></h5>
                            <hr>
                            <form style="margin-top:-10px;" method="post" name="payment_form_<?=$bookings->id;?>" id="payment_form_<?=$bookings->id;?>" action="<?=base_url();?>update_service/<?=base64_encode($bookings->id);?>">
                                <input type="hidden" name="employee_selection_rule_<?=$bookings->id;?>" id="employee_selection_rule_<?=$bookings->id;?>" value="<?php if(!empty($booking_rules)){ echo $booking_rules->employee_selection; } ?>">     
                                <div id="selected_service_details_<?=$bookings->id;?>"></div>
                                <div class="row">     
                                    <div class="form-group custom_label col-md-2 col-xs-12">
                                        <label>Service Date<b class="require">*</b></label>
                                        <input readonly type="text" class="form-control" name="booking_date_<?=$bookings->id;?>" id="booking_date_<?=$bookings->id;?>" placeholder="Select Booking Date" onchange="fetchTimeSlots(<?=$bookings->id;?>,'','manual')" value="<?=date('d-m-Y',strtotime($bookings->service_start_date));?>">
                                    </div>
                                    <div class="form-group custom_label col-md-2 col-xs-12">
                                        <label>Service Start<b class="require">*</b></label>
                                        <input readonly type="text" class="form-control" name="booking_start_<?=$bookings->id;?>" id="booking_start_<?=$bookings->id;?>" placeholder="Start From Time Slot" value="<?=date('H:i:s',strtotime($bookings->service_start_time));?>">
                                    </div>               
                                    <?php 
                                    if(!empty($booking_rules)){ 
                                        if($booking_rules->employee_selection == '2'){ 
                                    ?>
                                    <div class="form-group custom_label col-md-2 col-xs-12">
                                        <label>Stylist<b class="require">*</b></label>
                                        <select class="form-control chosen-select" id="employee_<?=$bookings->id;?>" name="employee_<?=$bookings->id;?>" onchange="fetchTimeSlots(<?=$bookings->id;?>,'','manual')">   
                                            <!-- <option value="">Select Stylist</option> -->
                                            <?php if(!empty($stylists)){ foreach($stylists as $employee_result){ ?>
                                                <option value="<?=$employee_result->id;?>" <?php if($bookings->stylist_id == $employee_result->id){ echo 'selected'; }?> data-img-src="<?=base_url();?>admin_assets/images/employee_profile/<?=$employee_result->profile_photo;?>"><?=$employee_result->full_name;?></option>
                                            <?php }} ?>
                                        </select>
                                        <label for="employee_<?=$bookings->id;?>" style="display:none;" generated="true" class="error">Please select stylist!</label> 
                                    </div>
                                    <?php }} ?>
                                    <div class="form-group custom_label col-md-2 col-xs-12">
                                        <label>Category<b class="require">*</b></label>
                                        <select id="category_<?=$bookings->id;?>" name="category_<?=$bookings->id;?>" class="form-control">
                                            <option value="">Select Category</option>
                                            <?php
                                                if(!empty($category)){
                                                    foreach($category as $category_result){
                                                        if($category_result->gender == '0'){
                                                            $gender = ' - [Male]';
                                                        }else if($category_result->gender == '1'){
                                                            $gender = ' - [Female]';
                                                        }else{
                                                            $gender = '';
                                                        }
                                            ?>
                                            <option value="<?=$category_result->id; ?>"><?=$category_result->sup_category; ?>|<?=$category_result->sup_category_marathi; ?> <?=$gender; ?></option>
                                            <?php }} ?>
                                        </select>
                                        <label for="category_<?=$bookings->id;?>" generated="true" class="error" style="display:none;width:100%;text-align:left;">Please select category!</label>
                                    </div>
                                    <div class="form-group custom_label col-md-2 col-xs-12">
                                        <label>Sub Category</label>
                                        <select id="sub_category_<?=$bookings->id;?>" name="sub_category_<?=$bookings->id;?>" class="form-control">
                                            <option value="">Select Sub Category</option>
                                        </select>
                                        <label for="sub_category_<?=$bookings->id;?>" generated="true" class="error" style="display:none;width:100%;text-align:left;">Please select sub category!</label>
                                    </div>
                                    <div class="form-group custom_label col-md-2 col-xs-12">
                                        <label>Service<b class="require">*</b></label>
                                        <select id="service_<?=$bookings->id;?>" name="service_<?=$bookings->id;?>" class="form-control">
                                            <option value="">Select Service</option>
                                        </select>
                                        <label for="selected_add_service_<?=$bookings->id;?>" generated="true" class="error" style="display:none;width:100%;text-align:left;">Please select service!</label>
                                        <div id="old_service_details_<?=$bookings->id;?>"></div>
                                    </div> 
                                </div>
                                <div class="row">
                                    <div class="col-lg-8 col-md-6 col-sm-12  col-xs-12">
                                        <input type="hidden" name="customer_gender_<?=$bookings->id;?>" id="customer_gender_<?=$bookings->id;?>" value="<?=$bookings->customer_gender;?>">
                                        <input type="hidden" name="previous_start_<?=$bookings->id;?>" id="previous_start_<?=$bookings->id;?>" value="">
                                        <input type="hidden" name="previous_stylist_<?=$bookings->id;?>" id="previous_stylist_<?=$bookings->id;?>" value="<?php if(!empty($first_booking_services)){ echo $first_booking_services->stylist_id; } ?>">
                                        <input type="hidden" name="slot_start_time_<?=$bookings->id;?>" id="slot_start_time_<?=$bookings->id;?>" value="<?=date('H:i:s',strtotime($bookings->service_start_time));?>">
                                        
                                        <input type="hidden" id="slot_type_<?=$bookings->id;?>" value="<?=$slot_type; ?>">
                                        <div class="timeslot_box row ">
                                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="booking_timeslots_<?=$bookings->id;?>">

                                            </div>  
                                            <div id="booking_timeslots_loader_<?=$bookings->id;?>" style="display:none;">
                                                <div class="timeslot-loader"></div>
                                            </div>  
                                        </div>  
                                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="selected_services_empty_<?=$bookings->id;?>">
                                            <div class="row single_added_extra_service_details">
                                                <div class="col-md-12 col-sm-12 col-xs-12 selected-servicesbox" style="height:60px; padding-top: 9px; padding-left:0px;">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align:center;">
                                                        <label class="noserviceavl" style="margin-top: 10px;background-color:transparent !important; font-size: 11px !important;color: #4c4c4c !important;">Service not selected</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group p_L_0 col-md-12 col-xs-12" id="selected_services_<?=$bookings->id;?>" style="display:none;"></div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 extra_service_price_table">
                                        <table style="width:100%;" class="">
                                            <thead>
                                                <tr style="background-color: white;">
                                                    <th>Service Price</th>
                                                    <th id="total_add_service_price_text_<?=$bookings->id;?>">0.00</th>
                                                </tr>
                                                <tr style="background-color: white;">
                                                    <th>Products Price</th>
                                                    <th id="total_add_service_product_price_text_<?=$bookings->id;?>">0.00</th>
                                                </tr>
                                                <tr style="background-color: white;">
                                                    <th>Package Price<small id="add_service_package_name_<?=$bookings->id;?>"></small></th>
                                                    <th id="total_add_service_package_price_text_<?=$bookings->id;?>"><?=($bookings->pacakge_id != "" && $bookings->pacakge_id != null && $bookings->package_amount != "" && $bookings->package_amount != null) ? $bookings->package_amount : '0.00';?></th>
                                                </tr>
                                                <tr style="background-color: white;border-top: 1px solid #ccc;">
                                                    <th>
                                                        Discount
                                                        <div id="add_service_discount_details_div_<?=$bookings->id;?>" style="position: relative;display:inline-block; width:auto;"></div>
                                                    </th>
                                                    <th id="add_service_total_discount_amount_text_<?=$bookings->id;?>">0.00</th>
                                                </tr>
                                                <tr style="background-color: white;border-top: 0.5px solid #afafaf;">
                                                    <th>Payable Amount</th>
                                                    <th id="add_service_final_payable_text_<?=$bookings->id;?>">0.00</th>
                                                </tr>
                                                <tr style="background-color: white;">
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
                                                    <input type="hidden" name="is_gst_applicable_<?=$bookings->id;?>" id="is_gst_applicable_<?=$bookings->id;?>" value="<?=$is_gst_applicable;?>">
                                                    <input type="hidden" name="salon_gst_no_<?=$bookings->id;?>" id="salon_gst_no_<?=$bookings->id;?>" value="<?=$gst_no;?>">
                                                    <input type="hidden" name="salon_gst_rate_<?=$bookings->id;?>" id="salon_gst_rate_<?=$bookings->id;?>" value="<?=$gst_rate;?>">
                                                    
                                                    <th>GST Amount <small><?= $gst_rate != "" && $gst_rate != "0" ? '('.$gst_rate.'%)' : '';?></small></th>
                                                    <th id="add_service_final_gst_text_<?=$bookings->id;?>">0.00</th>
                                                </tr>
                                                <tr style="border-top: 0.5px solid #afafaf;">
                                                    <th>Total Amount</th>
                                                    <th id="add_service_final_total_text_<?=$bookings->id;?>">0.00</th>
                                                </tr>
                                            </thead>
                                        </table>
                                        <input type="hidden" name="add_service_is_membership_<?=$bookings->id;?>" id="add_service_is_membership_<?=$bookings->id;?>" value="<?=$is_member;?>">
                                        <input type="hidden" name="add_service_membership_id_<?=$bookings->id;?>" id="add_service_membership_id_<?=$bookings->id;?>" value="<?=$membership_id;?>">
                                        <input type="hidden" name="add_service_membership_discount_type_<?=$bookings->id;?>" id="add_service_membership_discount_type_<?=$bookings->id;?>" value="<?=$membership_discount_type;?>">
                                        <input type="hidden" name="add_service_membership_service_discount_<?=$bookings->id;?>" id="add_service_membership_service_discount_<?=$bookings->id;?>" value="<?=$membership_service_discount;?>">
                                        <input type="hidden" name="add_service_membership_product_discount_<?=$bookings->id;?>" id="add_service_membership_product_discount_<?=$bookings->id;?>" value="<?=$membership_product_discount;?>">
                                        
                                        <input type="hidden" name="add_service_membership_service_discount_amount_<?=$bookings->id;?>" id="add_service_membership_service_discount_amount_<?=$bookings->id;?>" value="0.00">
                                        <input type="hidden" name="add_service_membership_product_discount_amount_<?=$bookings->id;?>" id="add_service_membership_product_discount_amount_<?=$bookings->id;?>" value="0.00">
                                        <input type="hidden" name="add_service_total_discount_amount_<?=$bookings->id;?>" id="add_service_total_discount_amount_<?=$bookings->id;?>" value="">

                                        <input type="hidden" name="total_add_service_price_<?=$bookings->id;?>" id="total_add_service_price_<?=$bookings->id;?>" value="0.00">
                                        <input type="hidden" name="add_service_payable_hidden_<?=$bookings->id;?>" id="add_service_payable_hidden_<?=$bookings->id;?>" value="0.00">
                                        <input type="hidden" name="add_service_product_payable_hidden_<?=$bookings->id;?>" id="add_service_product_payable_hidden_<?=$bookings->id;?>" value="0.00">
                                        
                                        <input type="hidden" name="is_package_applicable_<?=$bookings->id;?>" id="is_package_applicable_<?=$bookings->id;?>" value="<?= $bookings->is_package_included; ?>">
                                        <input type="hidden" name="package_allocation_id_<?=$bookings->id;?>" id="package_allocation_id_<?=$bookings->id;?>" value="<?= ($bookings->package_allocation_id == '' || $bookings->package_allocation_id == null) ? '0' : $bookings->package_allocation_id; ?>">
                                        <input type="hidden" name="add_service_selected_package_id_<?=$bookings->id;?>" id="add_service_selected_package_id_<?=$bookings->id;?>" value="<?= $bookings->pacakge_id; ?>">
                                        <input type="hidden" name="included_package_type_<?=$bookings->id;?>" id="included_package_type_<?=$bookings->id;?>" value="<?= $bookings->used_package_type; ?>">
                                        <input type="hidden" name="booking_add_service_package_price_<?=$bookings->id;?>" id="booking_add_service_package_price_<?=$bookings->id;?>" value="<?php if($bookings->pacakge_id != "" && $bookings->pacakge_id != null && $bookings->package_amount != "" && $bookings->package_amount != null){ echo $bookings->package_amount; } ?>">  
                                        <input type="hidden" name="total_add_service_package_price_<?=$bookings->id;?>" id="total_add_service_package_price_<?=$bookings->id;?>" value="<?php if($bookings->pacakge_id != "" && $bookings->pacakge_id != null && $bookings->package_amount != "" && $bookings->package_amount != null){ echo $bookings->package_amount; } ?>">  
                                        <input type="hidden" name="add_service_package_name_hidden_<?=$bookings->id;?>" id="add_service_package_name_hidden_<?=$bookings->id;?>" value="<?php if($bookings->pacakge_id != "" && $bookings->pacakge_id != null && $bookings->package_amount != "" && $bookings->package_amount != null && !empty($package_details)){ echo $package_details->package_name; } ?>">  
                                        
                                        <input type="hidden" name="total_add_service_product_price_<?=$bookings->id;?>" id="total_add_service_product_price_<?=$bookings->id;?>" value="0.00">
                                        <input type="hidden" name="add_service_final_payable_hidden_<?=$bookings->id;?>" id="add_service_final_payable_hidden_<?=$bookings->id;?>" value="0.00">
                                        <input type="hidden" name="add_service_final_gst_hidden_<?=$bookings->id;?>" id="add_service_final_gst_hidden_<?=$bookings->id;?>" value="0.00">
                                        <input type="hidden" name="add_service_final_total_hidden_<?=$bookings->id;?>" id="add_service_final_total_hidden_<?=$bookings->id;?>" value="0.00">
                                        <input type="hidden" name="selected_add_service_<?=$bookings->id;?>" id="selected_add_service_<?=$bookings->id;?>" value="">
                                        <input type="hidden" name="selected_sub_category_<?=$bookings->id;?>" id="selected_sub_category_<?=$bookings->id;?>" value="">

                                        <label class="error" id="stylist_timeslot_error_<?=$bookings->id;?>" style="display:none;margin-top:5px;"></label>
                                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px;margin-left: -10px;">
                                            <button type="submit" class="btn btn-primary" id="payment_btn" value="payment_btn">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> 
            </div>
        </div>  
        <div class="loader_div">
            <div class="loader-new"></div>
        </div>
        <?php include('footer.php'); ?>        
        <script>
            var firstAutoRun = true;
            var user_services_selected = [];
            var user_selected_add_service = [];
            var user_selected_add_service_product = [];
            var user_selected_timeslots_add_service = [];
            var user_selected_stylist_timeslots_add_service = [];

            var selected_slot_start = '<?php echo  ($bookings->service_start_date != "") ? date('Y-m-d H:i:s',strtotime($bookings->service_start_date. ' ' . $bookings->service_start_time)) : ''; ?>';
            var selected_slot_start_date = '<?php echo ($bookings->service_start_date != "") ? date('d-m-Y', strtotime($bookings->service_start_date)) : ''; ?>';
            var selected_slot_start_time = '<?php echo  ($bookings->service_start_time != "") ? date('H:i:s',strtotime($bookings->service_start_time)) : ''; ?>';

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
                $('.loader_div').show();   
                if(selected_slot_start_date != "" && selected_slot_start_time != ""){
                    var all_products = <?= json_encode($products); ?>;
                    $('#booking_date_<?=$bookings->id;?>').val(selected_slot_start_date);  

                    var selectedServices = <?php echo json_encode($booking_services); ?>;

                    var booking_details_id = '<?php echo $bookings->id; ?>';
                    for(var k=0;k<selectedServices.length;k++){
                        if (selectedServices[k].service_added_from == '1') {
                            var value_text_selected = selectedServices[k].service_id + '_' +
                                            selectedServices[k].service_added_from + '_' + 
                                            selectedServices[k].is_service_offer_applied + '_' + 
                                            (selectedServices[k].package_allocation_id == null || selectedServices[k].package_allocation_id === '' ? '0' : selectedServices[k].package_allocation_id);
                        }else{
                            var value_text_selected = selectedServices[k].service_id + '_' +
                                            selectedServices[k].service_added_from + '_' + 
                                            selectedServices[k].is_service_offer_applied + '_' + 
                                            '0';
                        }

                        $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_price_' + booking_details_id + '_' + value_text_selected + '" id="service_price_' + booking_details_id + '_' + value_text_selected + '" value="' + (selectedServices[k].service_price != null && selectedServices[k].service_price != "" ? parseFloat(selectedServices[k].service_price).toFixed(2) : '0.00') + '">');
                        $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_original_price_' + booking_details_id + '_' + value_text_selected + '" id="service_original_price_' + booking_details_id + '_' + value_text_selected + '" value="' + (selectedServices[k].original_service_price != null && selectedServices[k].original_service_price != "" ? parseFloat(selectedServices[k].original_service_price).toFixed(2) : '0.00') + '">');
                        $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_marathi_name_' + booking_details_id + '_' + value_text_selected + '" id="service_marathi_name_' + booking_details_id + '_' + value_text_selected + '" value="' + selectedServices[k].service_name_marathi + '">');
                        $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_name_' + booking_details_id + '_' + value_text_selected + '" id="service_name_' + booking_details_id + '_' + value_text_selected + '" value="' + selectedServices[k].service_name + '">');
                        $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_sub_cat_marathi_name_' + booking_details_id + '_' + value_text_selected + '" id="service_sub_cat_marathi_name_' + booking_details_id + '_' + value_text_selected + '" value="' + selectedServices[k].sub_category_marathi + '">');
                        $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_sub_cat_name_' + booking_details_id + '_' + value_text_selected + '" id="service_sub_cat_name_' + booking_details_id + '_' + value_text_selected + '" value="' + selectedServices[k].sub_category_name + '">');
                        $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_duration_' + booking_details_id + '_' + value_text_selected + '" id="service_duration_' + booking_details_id + '_' + value_text_selected + '" value="' + selectedServices[k].service_duration + '">');
                        $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_rewards_' + booking_details_id + '_' + value_text_selected + '" id="service_rewards_' + booking_details_id + '_' + value_text_selected + '" value="' + selectedServices[k].reward_point + '">');
                        $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_products_' + booking_details_id + '_' + value_text_selected + '" id="service_products_' + booking_details_id + '_' + value_text_selected + '" value="' + selectedServices[k].all_service_prducts + '">');
                        
                        $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="is_offer_applied_' + booking_details_id + '_' + value_text_selected + '" id="is_offer_applied_' + booking_details_id + '_' + value_text_selected + '" value="' + selectedServices[k].is_service_offer_applied + '">');
                        $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="applied_offer_id_' + booking_details_id + '_' + value_text_selected + '" id="applied_offer_id_' + booking_details_id + '_' + value_text_selected + '" value="' + selectedServices[k].applied_offer_id + '">');
                        $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_offer_discount_' + booking_details_id + '_' + value_text_selected + '" id="service_offer_discount_' + booking_details_id + '_' + value_text_selected + '" value="' + selectedServices[k].service_offer_discount + '">');
                        $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_offer_discount_type_' + booking_details_id + '_' + value_text_selected + '" id="service_offer_discount_type_' + booking_details_id + '_' + value_text_selected + '" value="' + selectedServices[k].service_offer_discount_type + '">');
                        $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_offer_discount_amount_' + booking_details_id + '_' + value_text_selected + '" id="service_offer_discount_amount_' + booking_details_id + '_' + value_text_selected + '" value="' + selectedServices[k].service_offer_discount_amount + '">');
                        $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="prev_stylist_' + booking_details_id + '_' + value_text_selected + '" id="prev_stylist_' + booking_details_id + '_' + value_text_selected + '" value="' + selectedServices[k].stylist_id + '">');
                        $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_added_from_' + booking_details_id + '_' + value_text_selected + '" id="service_added_from_' + booking_details_id + '_' + value_text_selected + '" value="' + selectedServices[k].service_added_from + '">');
                        $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_booking_details_id_' + booking_details_id + '_' + value_text_selected + '" id="service_booking_details_id_' + booking_details_id + '_' + value_text_selected + '" value="' + selectedServices[k].id + '">');

                        $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_package_id_' + booking_details_id + '_' + value_text_selected + '" id="service_package_id_' + booking_details_id + '_' + value_text_selected + '" value="' + selectedServices[k].package_id + '">');
                        $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_package_allocation_id_' + booking_details_id + '_' + value_text_selected + '" id="service_package_allocation_id_' + booking_details_id + '_' + value_text_selected + '" value="' + selectedServices[k].package_allocation_id + '">');
                        $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_package_allocation_details_id_' + booking_details_id + '_' + value_text_selected + '" id="service_package_allocation_details_id_' + booking_details_id + '_' + value_text_selected + '" value="' + selectedServices[k].package_allocation_status_id + '">');
                        $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_package_name_' + booking_details_id + '_' + value_text_selected + '" id="service_package_name_' + booking_details_id + '_' + value_text_selected + '" value="' + selectedServices[k].package_name + '">');

                        $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_discount_in_' + booking_details_id + '_' + value_text_selected + '" id="service_discount_in_' + booking_details_id + '_' + value_text_selected + '" value="' + selectedServices[k].discount_in + '">');
                        $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_discount_type_' + booking_details_id + '_' + value_text_selected + '" id="service_discount_type_' + booking_details_id + '_' + value_text_selected + '" value="' + selectedServices[k].discount_type + '">');
                        $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_discount_value_' + booking_details_id + '_' + value_text_selected + '" id="service_discount_value_' + booking_details_id + '_' + value_text_selected + '" value="' + selectedServices[k].discount_value + '">');
                        $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_discount_slab_min_' + booking_details_id + '_' + value_text_selected + '" id="service_discount_slab_min_' + booking_details_id + '_' + value_text_selected + '" value="' + selectedServices[k].discount_slab_min + '">');
                        $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_discount_slab_max_' + booking_details_id + '_' + value_text_selected + '" id="service_discount_slab_max_' + booking_details_id + '_' + value_text_selected + '" value="' + selectedServices[k].discount_slab_max + '">');
                        $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_slab_increment_' + booking_details_id + '_' + value_text_selected + '" id="service_slab_increment_' + booking_details_id + '_' + value_text_selected + '" value="' + selectedServices[k].slab_increment + '">');
                        $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_applied_flexible_slab_' + booking_details_id + '_' + value_text_selected + '" id="service_applied_flexible_slab_' + booking_details_id + '_' + value_text_selected + '" value="' + selectedServices[k].applied_flexible_slab + '">');
                        $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_received_discount_' + booking_details_id + '_' + value_text_selected + '" id="service_received_discount_' + booking_details_id + '_' + value_text_selected + '" value="' + selectedServices[k].received_discount + '">');

                        $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="is_service_discount_applied_' + booking_details_id + '_' + value_text_selected + '" id="is_service_discount_applied_' + booking_details_id + '_' + value_text_selected + '" value="' + selectedServices[k].is_service_discount_applied + '">');
                        $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_marketing_discount_type_' + booking_details_id + '_' + value_text_selected + '" id="service_marketing_discount_type_' + booking_details_id + '_' + value_text_selected + '" value="' + selectedServices[k].service_marketing_discount_type + '">');
                        $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_discount_customer_criteria_' + booking_details_id + '_' + value_text_selected + '" id="service_discount_customer_criteria_' + booking_details_id + '_' + value_text_selected + '" value="' + selectedServices[k].service_discount_customer_criteria + '">');
                        $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_discount_row_id_' + booking_details_id + '_' + value_text_selected + '" id="service_discount_row_id_' + booking_details_id + '_' + value_text_selected + '" value="' + selectedServices[k].service_discount_row_id + '">');
                        $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="rewards_discount_slab_min_' + booking_details_id + '_' + value_text_selected + '" id="rewards_discount_slab_min_' + booking_details_id + '_' + value_text_selected + '" value="' + selectedServices[k].rewards_discount_slab_min + '">');
                        $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="rewards_discount_slab_max_' + booking_details_id + '_' + value_text_selected + '" id="rewards_discount_slab_max_' + booking_details_id + '_' + value_text_selected + '" value="' + selectedServices[k].rewards_discount_slab_max + '">');
                        $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="rewards_slab_increment_' + booking_details_id + '_' + value_text_selected + '" id="rewards_slab_increment_' + booking_details_id + '_' + value_text_selected + '" value="' + selectedServices[k].rewards_slab_increment + '">');
                        $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="rewards_applied_flexible_slab_' + booking_details_id + '_' + value_text_selected + '" id="rewards_applied_flexible_slab_' + booking_details_id + '_' + value_text_selected + '" value="' + selectedServices[k].rewards_applied_flexible_slab + '">');
                        $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="rewards_received_discount_' + booking_details_id + '_' + value_text_selected + '" id="rewards_received_discount_' + booking_details_id + '_' + value_text_selected + '" value="' + selectedServices[k].rewards_received_discount + '">');

                        var service_duration = selectedServices[k].service_duration;
                        var service_name = selectedServices[k].service_name;
                        var service_marathi_name = selectedServices[k].service_name_marathi;
                        var service_sub_cat_name = selectedServices[k].sub_category_name;
                        var service_sub_cat_marathi_name = selectedServices[k].sub_category_marathi;
                        var service_rewards = selectedServices[k].reward_point;
                        var final_price = selectedServices[k].service_price != "" && selectedServices[k].service_price != null ? selectedServices[k].service_price : '0';
                        var service_original_price = selectedServices[k].original_service_price;
                        var service_products = selectedServices[k].all_service_prducts;
                        var service_id = selectedServices[k].service_id;
                        var service_added_from = selectedServices[k].service_added_from;
                        
                        createServiceDiv(value_text_selected,'<?=$bookings->id;?>',service_added_from,service_id,all_products,'pre_selected_service',service_duration,service_name,service_marathi_name,service_rewards,final_price,service_original_price,service_products,service_sub_cat_marathi_name,service_sub_cat_name,'auto');
                    }
                    
                    var timeParts = selected_slot_start_time.split(":");
                    var hours = parseInt(timeParts[0], 10);
                    var minutes = parseInt(timeParts[1], 10);
                    
                    var ampm = hours >= 12 ? 'PM' : 'AM';
                    hours = hours % 12;
                    hours = hours ? hours : 12;
                    
                    minutes = minutes < 10 ? '0' + minutes : minutes;
                    
                    selectedValue = hours + ':' + minutes + ' ' + ampm;

                    setBookingStartEdit(selectedValue,<?=$bookings->id;?>,'auto');
                }
                $("#booking_date_<?=$bookings->id;?>").datepicker({
                    dateFormat: 'dd-mm-yy',
                    maxDate: '<?php echo $max_date; ?>',
                    minDate: '<?php echo $today; ?>',
                });  
                var today_date = '<?php echo  ($today != "") ? date('d-m-Y',strtotime($today)) : ''; ?>';

                $("#category_<?=$bookings->id;?>").chosen(); 
                $("#sub_category_<?=$bookings->id;?>").chosen(); 
                $("#employee_<?=$bookings->id;?>").chosen(); 
                $("#service_<?=$bookings->id;?>").chosen(); 

                $('#payment_form_<?=$bookings->id;?>').validate({
                    ignore:[],
                    rules: {
                        // 'category_<?=$bookings->id;?>': {
                        //     required: true,
                        // },
                        'selected_add_service_<?=$bookings->id;?>': {
                            required: true,
                        },
                    },
                    messages: {
                        // 'category_<?=$bookings->id;?>': {
                        //     required: "Please select category!",
                        // },
                        'selected_add_service_<?=$bookings->id;?>': {
                            required: "Please select atleast one service!",
                        },
                    },
                    submitHandler: function(form) {
                        var validation_flag = 1;
                        $(".service_executive_<?=$bookings->id;?>").each(function () {
                            if ($(this).val() == "") {
                                validation_flag = 0;
                                return false;
                            }
                        });
                        if (validation_flag == 1) {
                            if (confirm("Are you sure you want to edit booking?")) {
                            // openConfirmationDialog("Are you sure you want to add service?", function (confirmed) {
                            // if (confirmed) {
                                $("#stylist_timeslot_error_<?=$bookings->id;?>").hide('');
                                $("#stylist_timeslot_error_<?=$bookings->id;?>").html('');

                                form.submit();
                            } else {
                                $("#stylist_timeslot_error_<?=$bookings->id;?>").hide('');
                                $("#stylist_timeslot_error_<?=$bookings->id;?>").html('');
                                return false;
                            }
                            // });
                        } else {
                            $("#stylist_timeslot_error_<?=$bookings->id;?>").show('');
                            $("#stylist_timeslot_error_<?=$bookings->id;?>").html('Please select stylists for the selected service'); 
                        }
                    }
                });

                $('#category_<?=$bookings->id;?>').change(function() {
                    $('.loader_div').show();   
                    // setTimeout(function() {
                        var booking_details_id = '<?= $bookings->id; ?>';
                        var booking_customer_id = '<?= $bookings->customer_name; ?>';
                        var category = $('#category_' + booking_details_id).val();
                        var sub_category = $('#sub_category_' + booking_details_id).val();
                        if (category !== "" && typeof category !== "undefined") {
                            $.ajax({
                                type: "POST",
                                url: "<?= base_url(); ?>salon/Ajax_controller/get_category_sub_categories",
                                data: { 'category': category, 'customer_id': booking_customer_id },
                                success: function(data) {                                        
                                    $("#sub_category_"+booking_details_id).empty();
                                    $("#sub_category_"+booking_details_id).append('<option value="">Select Sub Category</option>');
                                    var opts = $.parseJSON(data);
                                    $.each(opts, function(i, d) {
                                        if(d.gender == '0'){
                                            var gender = ' - [Male]';
                                        }else if(d.gender == '1'){
                                            var gender = ' - [Female]';
                                        }else{
                                            var gender = '';
                                        }
                                        if(d.id == $('#selected_sub_category_'+booking_details_id).val()){
                                            $("#sub_category_"+booking_details_id).append('<option selected value="' + d.id + '">' + d.sub_category + '|' + d.sub_category_marathi + '' + gender + '</option>');
                                        }else{
                                            $("#sub_category_"+booking_details_id).append('<option value="' + d.id + '">' + d.sub_category + '|' + d.sub_category_marathi + '' + gender + '</option>');
                                        }
                                    });
                                    $("#sub_category_"+booking_details_id).trigger('chosen:updated');
                                    $("#sub_category_"+booking_details_id).chosen();
                                }
                            });

                            $.ajax({
                                type: "POST",
                                url: "<?= base_url(); ?>salon/Ajax_controller/get_booking_category_services",
                                data: { 'sub_category': sub_category, 'category': category, 'booking_details_id': booking_details_id, 'booking_customer_id': booking_customer_id },
                                success: function(data) {
                                    $('.loader_div').hide(); 
                    
                                    $("#service_"+booking_details_id).empty();
                                    $("#service_"+booking_details_id).append('<option value="">Select Service</option>');
                                    var stylists = $.parseJSON(data);
                                    if (stylists.length > 0) {
                                        var opts = $.parseJSON(data);

                                        $.each(opts, function(i, d) {
                                            if (d.service_added_from == '1') {
                                                var value_text = d.id + '_' +
                                                                d.service_added_from + '_' + 
                                                                d.is_offer_applied + '_' + 
                                                                (d.package_allocation_id == null || d.package_allocation_id === '' ? '0' : d.package_allocation_id);
                                            } else {
                                                var value_text = d.id + '_' +
                                                                d.service_added_from + '_' + 
                                                                d.is_offer_applied + '_' + 
                                                                '0';
                                            }
                                            //rohit
                                            if(d.is_package_service == '1'){
                                                $("#service_" + booking_details_id).append('<option value="' + value_text + '">'+ d.service_name + '|' + d.service_name_marathi + ' - ' + d.package_name + ' [' + d.sub_category + '] Package Service</option>');
                                            }else{
                                                $("#service_" + booking_details_id).append('<option value="' + value_text + '">'+ d.service_name + '|' + d.service_name_marathi + ' [' + d.sub_category + '] </option>');
                                            }

                                            $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_price_' + booking_details_id + '_' + value_text + '" id="service_price_' + booking_details_id + '_' + value_text + '" value="' + (d.service_price != null && d.service_price != "" ? parseFloat(d.service_price).toFixed(2) : '0.00') + '">');
                                            $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_original_price_' + booking_details_id + '_' + value_text + '" id="service_original_price_' + booking_details_id + '_' + value_text + '" value="' + (d.service_original_price != null && d.service_original_price != "" ? parseFloat(d.service_original_price).toFixed(2) : '0.00') + '">');
                                            $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_marathi_name_' + booking_details_id + '_' + value_text + '" id="service_marathi_name_' + booking_details_id + '_' + value_text + '" value="' + d.service_name_marathi + '">');
                                            $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_name_' + booking_details_id + '_' + value_text + '" id="service_name_' + booking_details_id + '_' + value_text + '" value="' + d.service_name + '">');
                                            $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_sub_cat_marathi_name_' + booking_details_id + '_' + value_text + '" id="service_sub_cat_marathi_name_' + booking_details_id + '_' + value_text + '" value="' + d.sub_category_marathi + '">');
                                            $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_sub_cat_name_' + booking_details_id + '_' + value_text + '" id="service_sub_cat_name_' + booking_details_id + '_' + value_text + '" value="' + d.sub_category + '">');
                                            $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_duration_' + booking_details_id + '_' + value_text + '" id="service_duration_' + booking_details_id + '_' + value_text + '" value="' + d.service_duration + '">');
                                            $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_rewards_' + booking_details_id + '_' + value_text + '" id="service_rewards_' + booking_details_id + '_' + value_text + '" value="' + d.reward_point + '">');
                                            $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_products_' + booking_details_id + '_' + value_text + '" id="service_products_' + booking_details_id + '_' + value_text + '" value="' + d.product + '">');
                                            
                                            $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="prev_stylist_' + booking_details_id + '_' + value_text + '" id="prev_stylist_' + booking_details_id + '_' + value_text + '" value="">');
                                            $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="is_offer_applied_' + booking_details_id + '_' + value_text + '" id="is_offer_applied_' + booking_details_id + '_' + value_text + '" value="' + d.is_offer_applied + '">');
                                            $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="applied_offer_id_' + booking_details_id + '_' + value_text + '" id="applied_offer_id_' + booking_details_id + '_' + value_text + '" value="' + d.applied_offer_id + '">');
                                            $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_offer_discount_' + booking_details_id + '_' + value_text + '" id="service_offer_discount_' + booking_details_id + '_' + value_text + '" value="' + d.service_offer_discount + '">');
                                            $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_offer_discount_type_' + booking_details_id + '_' + value_text + '" id="service_offer_discount_type_' + booking_details_id + '_' + value_text + '" value="' + d.service_offer_discount_type + '">');
                                            $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_offer_discount_amount_' + booking_details_id + '_' + value_text + '" id="service_offer_discount_amount_' + booking_details_id + '_' + value_text + '" value="' + d.service_offer_discount_amount + '">');
                                            $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_added_from_' + booking_details_id + '_' + value_text + '" id="service_added_from_' + booking_details_id + '_' + value_text + '" value="' + d.service_added_from + '">');
                                            $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_booking_details_id_' + booking_details_id + '_' + value_text + '" id="service_booking_details_id_' + booking_details_id + '_' + value_text + '" value="">');
                                            
                                            $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_package_id_' + booking_details_id + '_' + value_text + '" id="service_package_id_' + booking_details_id + '_' + value_text + '" value="' + d.package_id + '">');
                                            $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_package_allocation_id_' + booking_details_id + '_' + value_text + '" id="service_package_allocation_id_' + booking_details_id + '_' + value_text + '" value="' + d.package_allocation_id + '">');
                                            $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_package_allocation_details_id_' + booking_details_id + '_' + value_text + '" id="service_package_allocation_details_id_' + booking_details_id + '_' + value_text + '" value="' + d.package_allocation_details_id + '">');
                                            $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_package_name_' + booking_details_id + '_' + value_text + '" id="service_package_name_' + booking_details_id + '_' + value_text + '" value="' + d.package_name + '">');
                                        
                                            $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_discount_in_' + booking_details_id + '_' + value_text + '" id="service_discount_in_' + booking_details_id + '_' + value_text + '" value="' + d.discount_in + '">');
                                            $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_discount_type_' + booking_details_id + '_' + value_text + '" id="service_discount_type_' + booking_details_id + '_' + value_text + '" value="' + d.discount_type + '">');
                                            $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_discount_value_' + booking_details_id + '_' + value_text + '" id="service_discount_value_' + booking_details_id + '_' + value_text + '" value="' + d.discount_value + '">');
                                            $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_discount_slab_min_' + booking_details_id + '_' + value_text + '" id="service_discount_slab_min_' + booking_details_id + '_' + value_text + '" value="' + d.discount_slab_min + '">');
                                            $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_discount_slab_max_' + booking_details_id + '_' + value_text + '" id="service_discount_slab_max_' + booking_details_id + '_' + value_text + '" value="' + d.discount_slab_max + '">');
                                            $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_slab_increment_' + booking_details_id + '_' + value_text + '" id="service_slab_increment_' + booking_details_id + '_' + value_text + '" value="' + d.slab_increment + '">');
                                            $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_applied_flexible_slab_' + booking_details_id + '_' + value_text + '" id="service_applied_flexible_slab_' + booking_details_id + '_' + value_text + '" value="' + d.applied_flexible_slab + '">');
                                            $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_received_discount_' + booking_details_id + '_' + value_text + '" id="service_received_discount_' + booking_details_id + '_' + value_text + '" value="' + d.received_discount + '">');

                                            $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="is_service_discount_applied_' + booking_details_id + '_' + value_text + '" id="is_service_discount_applied_' + booking_details_id + '_' + value_text + '" value="' + d.is_service_discount_applied + '">');
                                            $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_marketing_discount_type_' + booking_details_id + '_' + value_text + '" id="service_marketing_discount_type_' + booking_details_id + '_' + value_text + '" value="' + d.service_marketing_discount_type + '">');
                                            $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_discount_customer_criteria_' + booking_details_id + '_' + value_text + '" id="service_discount_customer_criteria_' + booking_details_id + '_' + value_text + '" value="' + d.service_discount_customer_criteria + '">');
                                            $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="service_discount_row_id_' + booking_details_id + '_' + value_text + '" id="service_discount_row_id_' + booking_details_id + '_' + value_text + '" value="' + d.service_discount_row_id + '">');
                                            $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="rewards_discount_slab_min_' + booking_details_id + '_' + value_text + '" id="rewards_discount_slab_min_' + booking_details_id + '_' + value_text + '" value="' + d.rewards_discount_slab_min + '">');
                                            $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="rewards_discount_slab_max_' + booking_details_id + '_' + value_text + '" id="rewards_discount_slab_max_' + booking_details_id + '_' + value_text + '" value="' + d.rewards_discount_slab_max + '">');
                                            $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="rewards_slab_increment_' + booking_details_id + '_' + value_text + '" id="rewards_slab_increment_' + booking_details_id + '_' + value_text + '" value="' + d.rewards_slab_increment + '">');
                                            $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="rewards_applied_flexible_slab_' + booking_details_id + '_' + value_text + '" id="rewards_applied_flexible_slab_' + booking_details_id + '_' + value_text + '" value="' + d.rewards_applied_flexible_slab + '">');
                                            $("#selected_service_details_" + booking_details_id).append('<input type="hidden" name="rewards_received_discount_' + booking_details_id + '_' + value_text + '" id="rewards_received_discount_' + booking_details_id + '_' + value_text + '" value="' + d.rewards_received_discount + '">');
                                        });
                                    }
                                    $("#service_"+booking_details_id).trigger('chosen:updated');
                                    $("#service_"+booking_details_id).chosen();
                                }
                            });
                        }
                    // }, 1500);
                });

                $('#sub_category_<?=$bookings->id;?>').change(function() {
                    $('#selected_sub_category_<?=$bookings->id;?>').val($(this).val());
                    $('#category_<?=$bookings->id;?>').trigger('change');
                });

                $('#service_<?=$bookings->id;?>').change(function() {
                    var booking_details_id = <?= $bookings->id; ?>;
                    var all_products = <?= json_encode($products); ?>;
                    var selected_from = 'extra_service_add';
                    var category = $('#category_' + booking_details_id).val();
                    var serviceValue = $('#service_' + booking_details_id).val();
                    var parts = serviceValue.split('_');

                    var serviceID = parts[0];
                    var service_added_from = parts[1];
                    var is_offer_applied = parts[2];
                    
                    $("#stylist_timeslot_error_" + booking_details_id).hide('');
                    $("#stylist_timeslot_error_" + booking_details_id).html('');
                    
                    if(!user_selected_add_service.includes(serviceID)){   
                        // $('#booking_timeslots_' + booking_details_id).hide();                
                        var booking_date = $('#booking_date_' + booking_details_id).val();
                        var booking_start = $('#booking_start_' + booking_details_id).val();
                        if (booking_date !== "" && booking_start !== "") {
                            var service_duration = $('#service_duration_' + booking_details_id + '_' + serviceValue).val();
                            var service_name = $('#service_name_' + booking_details_id + '_' + serviceValue).val();
                            var service_marathi_name = $('#service_marathi_name_' + booking_details_id + '_' + serviceValue).val();
                            var service_sub_cat_name = $('#service_sub_cat_name_' + booking_details_id + '_' + serviceValue).val();
                            var service_sub_cat_marathi_name = $('#service_sub_cat_marathi_name_' + booking_details_id + '_' + serviceValue).val();
                            var service_rewards = $('#service_rewards_' + booking_details_id + '_' + serviceValue).val();
                            var final_price = $('#service_price_' + booking_details_id + '_' + serviceValue).val();
                            var service_original_price = $('#service_original_price_' + booking_details_id + '_' + serviceValue).val();
                            var service_products = $('#service_products_' + booking_details_id + '_' + serviceValue).val();
                            var service_added_from = $('#service_added_from_' + booking_details_id + '_' + serviceValue).val();
                            createServiceDiv(serviceValue,booking_details_id,service_added_from,serviceID,all_products,selected_from,service_duration,service_name,service_marathi_name,service_rewards,final_price,service_original_price,service_products,service_sub_cat_marathi_name,service_sub_cat_name,'manual');
                        }else{
                            // alert('Please select booking date and timeslot first');
                            openDialog('Please select booking date and timeslot first'); 
                            $('#service_' + booking_details_id).val('');
                        }
                    }else{
                        $('.loader_div').hide(); 
                        // alert('Service already selected');
                        openDialog('Service already selected'); 
                    }                        
                    $('#service_' + booking_details_id).val('');
                    $('#service_' + booking_details_id).trigger("chosen:updated");
                });
            });

            function createServiceDiv(serviceValue,booking_details_id,service_added_from,serviceID,all_products,selected_from,service_duration,service_name,service_marathi_name,service_rewards,final_price,service_original_price,service_products,service_sub_cat_marathi_name,service_sub_cat_name,timeslotTrigger){
                if (!user_selected_add_service.some(entry => entry.split('_')[0] === serviceID)) {
                    // $('.loader_div').show();   
                    // setTimeout(function() {
                        var productsArray = [];
                        productsArray = service_products.split(',');
                        if(parseFloat(final_price) < parseFloat(service_original_price)){
                            price = '<s>'+parseFloat(service_original_price).toFixed(2)+'</s> '+parseFloat(final_price).toFixed(2)+'';
                        }else{
                            price = final_price;
                        }

                        var tomorrow = new Date();
                        tomorrow.setDate(tomorrow.getDate() + 1);

                        var tomorrowFormatted = tomorrow.toISOString().split('T')[0];
                        var total_count = 0;
                        var z = 0;
                        var product_count = 0;

                        if(service_added_from == '1'){
                            var details_div_color = '#c0e1ff';
                        }else{
                            var details_div_color = '';
                        }
                        service_details = 
                            '<style>#service_stylist_id_' + booking_details_id + '_' + serviceID + '_chosen{ pointer-events: none !important; background-color: #e9ecef; color: #6c757d; }</style>' +
                            '<div class="row single_added_extra_service_details" id="selected_service_booking_details_'+ booking_details_id +'_'+ serviceID +'">'+
                                '<input type="hidden" id="service_added_from_'+ booking_details_id +'_'+ serviceID +'" value="'+ selected_from +'">'+
                                '<div class="col-md-12 col-sm-12 col-xs-12 selected-servicesbox" style="background-color:'+details_div_color+'; height: auto; padding-top: 9px; padding-left:0px;">'+
                                    '<div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">'+
                                        '<span class="left-span" style="font-size: 13px !important;">'+ service_sub_cat_name +'|'+service_sub_cat_marathi_name+' -> <b>'+ service_name +'|'+service_marathi_name+'</b> <span style="margin-left:15px;">'+ price +'</span></span>'+
                                        '<div class="span-row">'+
                                            '<span class="bottom-span">'+ service_duration +' Mins</span>'+
                                            '<input type="hidden" id="service_reward_points_'+ booking_details_id +'_'+ serviceID +'" name="service_reward_points_'+ booking_details_id +'_'+ serviceID +'" value="">'+
                                            '<span class="bottom-span" id="service_stylist_timeslot_'+ booking_details_id +'_'+ serviceID +'"></span>'+
                                            '<div class="col-lg-6" id="service_executive_div_'+ booking_details_id +'_' + serviceID + '" style="display:none;">'+
                                                '<select class="form-control service_executive_'+ booking_details_id +'" name="service_stylist_id_'+ booking_details_id +'_' + serviceID + '" id="service_stylist_id_'+ booking_details_id +'_' + serviceID + '"></select>'+
                                            '</div>'+
                                            '<input type="hidden" class="service_stylist_timeslot_validation_'+ booking_details_id +'" id="service_stylist_timeslot_hidden_'+ booking_details_id +'_'+ serviceID +'" name="service_stylist_timeslot_hidden_'+ booking_details_id +'_'+ serviceID +'" value="">'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">'+
                                        '<button style="display: block;position: static; margin-top:5px;" type="button" id="product_for_service_button_'+ booking_details_id +'_' + serviceID + '" class="btn  modalbtn" onclick="showPopup(\'ServiceProductModal_'+ booking_details_id +'_' + serviceID + '\')" data-toggle="modal" data-target="#ServiceProductModal_'+ booking_details_id +'_' + serviceID + '"><span id="selected_service_product_'+ booking_details_id +'_' + serviceID + '">0</span>/<span id="total_service_product_'+ booking_details_id +'_' + serviceID + '">0</span></button>'+
                                        '<div class="modal fade" style="background-color: #00000080; overflow-x:visible !important; overflow-y:visible !important;" id="ServiceProductModal_'+ booking_details_id +'_'+ serviceID +'" tabindex="-1" role="dialog" aria-labelledby="ServiceProductModalLabel_'+ booking_details_id +'_'+ serviceID +'" aria-hidden="true">'+
                                            '<div class="modal-dialog" role="document" style="width:500px;">'+
                                                '<div class="modal-content">'+
                                                    '<div class="modal-header">'+
                                                        '<h5 class="modal-title" id="ServiceProductModalLabel_'+ booking_details_id +'_'+ serviceID +'">'+ service_name +' Service Products</h5>'+
                                                        '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;"  onclick="closePopup(\'ServiceProductModal_'+ booking_details_id +'_'+ serviceID + '\')">'+
                                                            '<span aria-hidden="true">&times;</span>'+
                                                        '</button>'+
                                                    '</div>'+
                                                    '<div class="modal-body extra_service_products">'+
                                                        '<table style="width:100%;">'+
                                                            '<thead>'+
                                                                '<tr>'+
                                                                    '<th>Select</th>'+
                                                                    '<th>Product</th>'+
                                                                    '<th>Price</th>'+
                                                                '</tr>'+
                                                            '</thead>'+
                                                            '<tbody>';
                                        all_products.forEach(function(product) {
                                            if (productsArray.includes(product.id)) {
                                                product_count++;
                                                if(service_added_from == '1'){
                                                    var product_price = '0.00';
                                                    var product_price_text = '<div class="service_price_title" ><b>Rs. 0.00</b></div>';
                                                }else{
                                                    if(product.original_product_price != product.service_product_price_consider){
                                                        var product_price_text = '<div class="service_price_title"  title="Offer Price"><b>Rs. <s>' + product.original_product_price + '</s> ' + product.service_product_price_consider + '</b></div>';
                                                    }else{
                                                        var product_price_text = '<div class="service_price_title" ><b>Rs. ' + product.original_product_price + '</b></div>';
                                                    }
                                                    var product_price = product.service_product_price_consider;
                                                }                                                                                               
                                            service_details += '<input type="hidden" name="product_discount_in_'+ booking_details_id +'_'+ serviceID +'_'+ product.id +'" id="product_discount_in_'+ booking_details_id +'_'+ serviceID +'_'+ product.id +'" value="' + product.product_discount_in + '">' + 
                                                                '<input type="hidden" name="product_discount_type_'+ booking_details_id +'_'+ serviceID +'_'+ product.id +'" id="product_discount_type_'+ booking_details_id +'_'+ serviceID +'_'+ product.id +'" value="' + product.product_discount_type + '">' + 
                                                                '<input type="hidden" name="product_discount_value_'+ booking_details_id +'_'+ serviceID +'_'+ product.id +'" id="product_discount_value_'+ booking_details_id +'_'+ serviceID +'_'+ product.id +'" value="' + product.product_discount_amount_value + '">' + 
                                                                '<input type="hidden" name="is_product_discount_applied_'+ booking_details_id +'_'+ serviceID +'_'+ product.id +'" id="is_product_discount_applied_'+ booking_details_id +'_'+ serviceID +'_'+ product.id +'" value="' + product.is_product_discount_applied + '">' + 
                                                                '<input type="hidden" name="product_discount_row_id_'+ booking_details_id +'_'+ serviceID +'_'+ product.id +'" id="product_discount_row_id_'+ booking_details_id +'_'+ serviceID +'_'+ product.id +'" value="' + product.product_discount_row_id + '">' + 
                                                                '<input type="hidden" name="product_discount_slab_min_'+ booking_details_id +'_'+ serviceID +'_'+ product.id +'" id="product_discount_slab_min_'+ booking_details_id +'_'+ serviceID +'_'+ product.id +'" value="' + product.product_min_slab + '">' + 
                                                                '<input type="hidden" name="product_discount_slab_max_'+ booking_details_id +'_'+ serviceID +'_'+ product.id +'" id="product_discount_slab_max_'+ booking_details_id +'_'+ serviceID +'_'+ product.id +'" value="' + product.product_max_slab + '">' + 
                                                                '<input type="hidden" name="product_slab_increment_'+ booking_details_id +'_'+ serviceID +'_'+ product.id +'" id="product_slab_increment_'+ booking_details_id +'_'+ serviceID +'_'+ product.id +'" value="' + product.product_slab_increment + '">' + 
                                                                '<input type="hidden" name="product_applied_flexible_slab_'+ booking_details_id +'_'+ serviceID +'_'+ product.id +'" id="product_applied_flexible_slab_'+ booking_details_id +'_'+ serviceID +'_'+ product.id +'" value="' + product.product_slab_consider + '">' + 
                                                                '<input type="hidden" name="product_received_discount_'+ booking_details_id +'_'+ serviceID +'_'+ product.id +'" id="product_received_discount_'+ booking_details_id +'_'+ serviceID +'_'+ product.id +'" value="' + product.product_discount_amount + '">' + 
                                                                '<input type="hidden" name="product_original_price_'+ booking_details_id +'_'+ serviceID +'_'+ product.id +'" id="product_original_price_'+ booking_details_id +'_'+ serviceID +'_'+ product.id +'" value="' + product.original_product_price + '">';

                                            service_details += '<tr>' +
                                                                    '<td><input type="checkbox" class="product-checkbox add_service_product_checkbox_'+ booking_details_id +'_'+ serviceID +'" name="add_service_product_checkbox_'+ booking_details_id +'_'+ serviceID +'[]" id="add_service_product_checkbox_'+ booking_details_id +'_'+ serviceID +'_' + product.id + '" value="' + product.id + '" onclick="setAddServiceProductPrice('+ booking_details_id +',' + serviceID + ',' + product.id + ')"></td>' +
                                                                    '<td>' + product.product_name + '' + product.product_discount_text + '</td>' +
                                                                    '<td>' + product_price_text + '</td>' +
                                                                '</tr>' +
                                                                '<input type="hidden" id="service_product_price_'+ booking_details_id +'_'+ serviceID +'_'+ product.id +'" name="service_product_price_'+ booking_details_id +'_'+ serviceID +'_'+ product.id +'" value="'+ product_price +'">';
                                            }
                                        });
                                        if(product_count == 0){
                                            service_details += '<tr>' +
                                                                    '<td colspan="3" style="text-align:center;">Products not available</td>' +
                                                                '</tr>';
                                        }
                                        service_details += '</tbody>'+
                                                        '</table>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>';
                                        // if(service_added_from == '0'){
                                            service_details += '<button class="ser_model_X" style="display: block;position: absolute;background: white;border: none;outline: none;box-shadow: none;padding: 0px;margin: 0px;right: 0px;top: 0px; margin-top:2px;" type="button" id="remove_add_service_button_'+ booking_details_id +'_' + serviceID + '" class="btn" onclick="removeAddService(' + booking_details_id + ',' + serviceID + ',\'' + serviceValue + '\')"><span style="color: red;font-size: 15px;padding: 2px 6px;border-radius: 100%;"><i class="fa fa-times"></i></span></button>';
                                        // }
                                    service_details += '</div>'+
                                '</div>'+   
                            '</div>';
                        $('#selected_services_empty_'+booking_details_id).hide();
                        $('#selected_services_' + booking_details_id).append(service_details);
                        $('#selected_services_' + booking_details_id).show();
                        $('#total_service_product_' + booking_details_id + '_' + serviceID).text(product_count);

                        // $('.loader_div').hide();   
                        setAddServicePrice(serviceValue,booking_details_id,serviceID,service_duration,service_rewards,final_price,timeslotTrigger);
                    // }, 1500);
                }else{
                    openDialog('Service already selected'); 
                }
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
            function fetchTimeSlots(booking_details_id, slot_type = '', triggeredBy = 'auto'){
                if (triggeredBy === 'auto' && !firstAutoRun) {
                    // Block duplicate auto-runs
                    return;
                }

                if (triggeredBy === 'auto') {
                    firstAutoRun = false; // Only block future auto-runs
                    // console.log('fetchTimeSlots - auto run');
                } else {
                    // console.log('fetchTimeSlots - triggered manually or via DOM');
                }

                var booking_date = $('#booking_date_'+booking_details_id).val();
                var booking_start = $('#booking_start_'+booking_details_id).val();
                var slot_start_time = $('#slot_start_time_'+booking_details_id).val();
                var employee = $('#employee_'+booking_details_id).val();
                var employee_selection_rule = $('#employee_selection_rule_'+booking_details_id).val();
                if(booking_date != ""){
                    if(slot_type == ''){
                        slot_type = $('#slot_type_'+booking_details_id).val();
                    }
                    
                    $('#slot_type_'+booking_details_id).val(slot_type);

                    $('#booking_timeslots_'+booking_details_id).html('');
                    $('#booking_timeslots_loader_'+booking_details_id).show();
                    $('.loader_div').show();   
                    $.ajax({
                        type: "POST",
                        url: "<?=base_url();?>salon/Ajax_controller/get_day_timeslots_edit_service_ajx",
                        data:{
                            'source':'vendor_panel',
                            'booking_id':booking_details_id,
                            'booking_date':booking_date,
                            'selected_slot_start_time':slot_start_time,
                            'booking_start':booking_start,
                            'employee':employee,
                            'employee_selection_rule':employee_selection_rule,
                            'user_selected_service': user_selected_add_service,
                            'slot_type': slot_type
                        },
                        success: function(data){
                            $('.loader_div').hide();   
                            $('#booking_timeslots_'+booking_details_id).show();
                            $('#booking_timeslots_'+booking_details_id).html(data);

                            if($('#booking_start_'+booking_details_id).val() != ""){
                                setServiceTimeSlots(booking_details_id);
                            } else {                        
                                $('#booking_timeslots_loader_'+booking_details_id).hide();
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                        }
                    }); 
                }
            }                
            
            function selectTimeslotRadioEdit(timeslot,original_timeslot,booking_details_id){
                $('#booking_start_time_slot_'+booking_details_id+'_' + original_timeslot).prop('checked', true);
                setBookingStartEdit(timeslot,booking_details_id,'manual');
            }

            function setBookingStartEdit(value,booking_details_id,timeslotTrigger) {
                if(value == ""){
                    var selectedValue = $('input[name="booking_start_time_slot_'+booking_details_id+'"]:checked').val();
                }else{
                    var selectedValue = value;
                }
                if (selectedValue != "") {
                    // $('#booking_timeslots').hide();
                    $('#booking_start_'+booking_details_id).val(selectedValue);
                    $('.loader_div').show();
                    fetchTimeSlots(booking_details_id,'',timeslotTrigger);
                    $('.loader_div').hide();
                }
            }
            
            function setServiceTimeSlots(booking_details_id){
                for(var i=0;i<user_selected_add_service.length;i++){
                    var singleService = user_selected_add_service[i];     
                    var singleServiceID = singleService.split('_')[0];   
                    var service_duration = $('#service_duration_' + booking_details_id + '_' + singleService).val();
                    var service_rewards = $('#service_rewards_' + booking_details_id + '_' + singleService).val();

                    var booking_date = $('#booking_date_'+booking_details_id).val();
                    var previous_start = $('#previous_start_'+booking_details_id).val();

                    if(booking_date != "" && $('#booking_start_'+booking_details_id).val() != ""){
                        if(i == 0){
                            var booking_start = $('#booking_start_'+booking_details_id).val();
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
                    
                        $('#service_reward_points_' + booking_details_id + '_' + singleServiceID).val(service_rewards);
                        $('#service_stylist_timeslot_hidden_' + booking_details_id + '_' + singleServiceID).val(timeslot_string);
                        $('#service_stylist_timeslot_' + booking_details_id + '_' + singleServiceID).text(formatted_slot_start_time + ' to ' + formatted_slot_end_time);
                                    
                        getTimeStylist(booking_details_id,booking_date,selected_slot_start,selected_slot_end,singleServiceID,service_duration);

                        $('#previous_start_'+booking_details_id).val(formatted_slot_end_time_24hr);
                    }
                }  
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
            function getTimeStylist(booking_details_id,booking_date,selected_slot_start,selected_slot_end,singleService,service_duration){
                var formatted_start = formatDate(selected_slot_start);
                var formatted_end = formatDate(selected_slot_end);

                if (formatted_start !== "" && typeof formatted_start !== "undefined" && formatted_end !== "" && typeof formatted_end !== "undefined") {
                    selectedTimeSlot = formatted_start + '@@@' + formatted_end;
                    $('#service_executive_div_' + booking_details_id + '_' + singleService).hide();
                    $('#service_stylist_id_' + booking_details_id + '_' + singleService).html("");
                    var previous_stylist = $('#previous_stylist_' + booking_details_id).val();
                    var selected_employee = $('#employee_'+booking_details_id).val();
                    var employee_selection_rule = $('#employee_selection_rule_'+booking_details_id).val();
                    $('.loader_div').show();   
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url(); ?>salon/Ajax_controller/get_available_stylists_edit_servicewise_ajx",
                        data: { 'service':singleService,'selectedTimeSlot': selectedTimeSlot,'booking_details_id': booking_details_id, 'selected_employee': selected_employee, 'employee_selection_rule': employee_selection_rule, 'previous_stylist': previous_stylist },
                        success: function(data) {
                            $('.loader_div').hide();   
                            $('#service_stylist_id_' + booking_details_id + '_' + singleService).chosen();
                            $('#service_stylist_id_' + booking_details_id + '_' + singleService).val('');
                            $('#booking_timeslots_loader_' + booking_details_id).hide();

                            var prev_selected_stylist = $('#prev_stylist_' + booking_details_id + '_' + singleService).val();
                            
                            var stylists = $.parseJSON(data);
                            if(stylists.length > 0){
                                $('#service_stylist_id_' + booking_details_id + '_' + singleService).empty();
                                // $('#service_stylist_id_' + booking_details_id + '_' + singleService).append('<option value="">Select Executive</option>');
                                var opts = $.parseJSON(data);
                                var count = 1;
                                $.each(opts, function(i, d) {
                                    store_flag = d.store_flag;
                                    short_break_flag = d.short_break_flag;
                                    is_service_available = d.is_service_available;
                                    is_shift_available = d.is_shift_available;
                                    is_booking_present = d.is_booking_present;
                                    is_on_break = d.is_on_break;
                                    is_on_leave_flag = d.is_on_leave_flag;
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
                                                                if(short_break_flag == '1'){
                                                                    var message = '';
                                                                    var disabled = '';
                                                                    var is_Allowed = 1;
                                                                }else{
                                                                    var message = '- Stylist On Short Break';
                                                                    var disabled = 'disabled';
                                                                    var is_Allowed = 0;
                                                                }
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
                                        if(prev_selected_stylist == d.stylist_details.id){
                                            selected = 'selected';
                                            $('#previous_stylist_' + booking_details_id).val(d.stylist_details.id);
                                        }else{
                                            if(d.to_be_selected == '1'){
                                                selected = 'selected';
                                                $('#previous_stylist_' + booking_details_id).val(d.stylist_details.id);
                                            }
                                        }

                                        // $('#service_stylist_id_' + booking_details_id + '_' + singleService).append('<option ' + disabled + ' ' + selected + ' value="' + d.stylist_details.id + '">' + d.stylist_details.full_name + ' ' + message + '</option>');
                                        $('#service_stylist_id_' + booking_details_id + '_' + singleService).append('<option ' + disabled + ' ' + selected + ' value="' + emp_unique_id + '">' + d.stylist_details.full_name + ' ' + message + '</option>');
                                    }else{
                                        var disabled = 'disabled';
                                        var message = '- Stylist Not Available';
                                    }
                                });
                                $('#service_stylist_id_' + booking_details_id + '_' + singleService).trigger('chosen:updated');
                                $('#service_executive_div_' + booking_details_id + '_' + singleService).show();
                            }else{
                                if (!user_services_selected.includes(singleService)) {
                                    user_services_selected.push(singleService);
                                    $('#service_stylist_id_' + booking_details_id + '_' + singleService+"_chosen").hide();
                                    $('#service_stylist_id_' + booking_details_id + '_' + singleService).hide();
                                    $('#service_executive_div_' + booking_details_id + '_' + singleService).append('<label style="font-size:10px;" class="error">Please, first set Stylist designation employees.</label>');
                                    $('#service_executive_div_' + booking_details_id + '_' + singleService).show();
                                }
                            }
                        },
                    });
                }
            }
            function removeAddService(booking_details_id,serviceID,serviceValue){
                if(confirm('Are you sure you want to remove service?')){ 
                // openConfirmationDialog("Are you sure you want to remove service?", function (confirmed) {
                // if (confirmed) {
                    // $('.loader_div').show();   
                    // setTimeout(function() {
                        var current_total_service = parseFloat($("#total_add_service_price_" + booking_details_id).val());                      
                        var selected_product = parseInt($('#selected_service_product_' + booking_details_id + '_'+serviceID).text());
                        var service_price = $('#service_price_' + booking_details_id + '_' + serviceValue).val();

                        var index = user_selected_add_service.findIndex(function(id) {
                            return id === serviceValue.toString();
                        });

                        if (index !== -1) {
                            user_selected_add_service.splice(index, 1);
                            var updatedValue = user_selected_add_service.join(',');
                            $("#selected_add_service_" + booking_details_id).val(updatedValue);
                        }

                        $(".add_service_product_checkbox_"+booking_details_id+"_"+serviceID).attr('disabled', true);

                        current_total_service = current_total_service - service_price;

                        $('#executive_for_service_button_'+booking_details_id+'_'+serviceID).text('Select Stylist'); 
                            
                        if(user_selected_add_service.length == 0){
                            $('#selected_services_empty_'+booking_details_id).show();
                            $('#selected_services_'+booking_details_id).hide();
                        }

                        var tempArray = [];
                        $(".add_service_product_checkbox_"+booking_details_id+"_"+serviceID).each(function() {
                            if ($(this).prop('checked')) {
                                $(this).prop('checked', false); 
                                tempArray.push($(this).val());
                            }
                        });

                        for (var i = 0; i < tempArray.length; i++) {
                            setAddServiceProductPrice(booking_details_id,serviceID,tempArray[i]);
                        }

                        calculateTotalAddServiceDuration(booking_details_id,serviceID);
            
                        fetchTimeSlots(booking_details_id,'','manual');

                        $('#total_add_service_price_' + booking_details_id).val(parseFloat(current_total_service).toFixed(2));
                        $('#total_add_service_price_text_' + booking_details_id).text(parseFloat(current_total_service).toFixed(2));

                        setPayableAddServiceAmount(booking_details_id,serviceID);

                        $("#selected_service_booking_details_"+booking_details_id+"_"+serviceID).remove();
                        
                        $('#booking_timeslots_loader_'+booking_details_id).hide();

                    //     $('.loader_div').hide();   
                    // }, 3000);
                }
                // });
            }
            function setAddServicePrice(serviceValue,booking_details_id,serviceID,service_duration,service_rewards,service_price,timeslotTrigger){ 
                var current_total = parseFloat($("#total_add_service_price_" + booking_details_id).val());
                if (!user_selected_add_service.some(entry => entry.split('_')[0] === serviceID)) {
                    var booking_date = $('#booking_date_' + booking_details_id).val();
                    var booking_start = $('#booking_start_' + booking_details_id).val();

                    if (booking_date !== "" && booking_start !== "") {
                        $(".add_service_product_checkbox_"+booking_details_id+"_"+serviceID).attr('disabled', false);

                        current_total = current_total + parseFloat(service_price);

                        user_selected_add_service.push(serviceValue);

                        var currentValue = $("#selected_add_service_" + booking_details_id).val(); 
                        if (currentValue === '') {
                            $("#selected_add_service_" + booking_details_id).val(serviceValue); 
                        } else {
                            $("#selected_add_service_" + booking_details_id).val(currentValue + ',' + serviceValue);
                        }

                        var tempArray = [];

                        $(".add_service_product_checkbox_"+booking_details_id+"_"+serviceID).each(function() {
                            $(this).prop('checked', true); 
                            tempArray.push($(this).val());
                        });

                        for (var i = 0; i < tempArray.length; i++) {
                            setAddServiceProductPrice(booking_details_id,serviceID,tempArray[i]);
                        }
                    }else{
                        // alert('Please select booking date and timeslot first');
                        openDialog('Please select booking date and timeslot first'); 
                        $('#service_' + booking_details_id).val('');
                    }
                }else{
                    // alert('Service already selected');
                    openDialog('Service already selected'); 
                }
                
                calculateTotalAddServiceDuration(booking_details_id,serviceID);
                fetchTimeSlots(booking_details_id,'',timeslotTrigger);

                $('#total_add_service_price_' + booking_details_id).val(parseFloat(current_total).toFixed(2));
                $('#total_add_service_price_text_' + booking_details_id).text(parseFloat(current_total).toFixed(2));

                setPayableAddServiceAmount(booking_details_id,serviceID);
            }

            function setAddServiceProductPrice(booking_details_id,serviceID,productID){
                var product_price = parseFloat($('#service_product_price_' + booking_details_id + '_'+serviceID+'_'+productID).val());
                var current_total_product = parseFloat($('#total_add_service_product_price_' + booking_details_id).val());
                var selected_product = parseInt($('#selected_service_product_' + booking_details_id + '_'+serviceID).text());
                if (isNaN(product_price) || typeof product_price === 'undefined') {
                    product_price = 0;
                }
                if (isNaN(selected_product) || typeof selected_product === 'undefined') {
                    selected_product = 0;
                }

                if ($('#add_service_product_checkbox_' + booking_details_id + '_'+serviceID+'_'+productID).is(':checked')) {      
                    current_total_product = current_total_product + product_price;
                    selected_product = selected_product + 1;

                    user_selected_add_service_product.push(productID);
                } else {
                    addServiceRemoveValue(user_selected_add_service_product, productID);

                    current_total_product = current_total_product - product_price;
                    selected_product = selected_product - 1;
                }

                $('#total_add_service_product_price_' + booking_details_id).val(parseFloat(current_total_product).toFixed(2));
                $('#total_add_service_product_price_text_' + booking_details_id).text(parseFloat(current_total_product).toFixed(2));
                $('#selected_service_product_' + booking_details_id + '_'+serviceID).text(parseInt(selected_product));
                
                setPayableAddServiceProductAmount(booking_details_id,serviceID);
            }
            function addServiceRemoveValue(arr, value) {
                var index = arr.indexOf(value);
                if (index !== -1) {
                    arr.splice(index, 1);
                }
                return arr;
            }
            
            function setPayableAddServiceProductAmount(booking_details_id,serviceID){
                total_product_amount = parseFloat($('#total_add_service_product_price_' + booking_details_id).val());

                member_product_discount = $('#add_service_membership_product_discount_' + booking_details_id).val();
                membership_discount_type = $('#add_service_membership_discount_type_' + booking_details_id).val();

                if (typeof member_product_discount === 'undefined' || member_product_discount === '') {
                    member_product_discount = 0;
                }else{
                    member_product_discount = parseFloat(member_product_discount);
                }
                
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

                $('#add_service_membership_product_discount_amount_' + booking_details_id).val(parseFloat(discount).toFixed(2));

                payable = total_product_amount - discount;
                
                $('#add_service_product_payable_hidden_' + booking_details_id).val(parseFloat(payable).toFixed(2));
                $('#add_service_product_payable_text_' + booking_details_id).text(parseFloat(payable).toFixed(2));

                setPayableAddServiceAmount(booking_details_id,serviceID);
            }
            
            function setPayableAddServiceAmount(booking_details_id,serviceID){
                total_service_amount = parseFloat($('#total_add_service_price_' + booking_details_id).val());   
                
                member_service_discount = $('#add_service_membership_service_discount_' + booking_details_id).val();
                membership_discount_type = $('#add_service_membership_discount_type_' + booking_details_id).val();

                if (typeof member_service_discount === 'undefined' || member_service_discount === '') {
                    member_service_discount = 0;
                }else{
                    member_service_discount = parseFloat(member_service_discount);
                }
                
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

                $('#add_service_membership_service_discount_amount_' + booking_details_id).val(parseFloat(discount).toFixed(2));

                payable = total_service_amount - discount;

                $('#add_service_payable_hidden_' + booking_details_id).val(parseFloat(payable).toFixed(2));    
                $('#add_service_payable_text_' + booking_details_id).text(parseFloat(payable).toFixed(2));    

                setAddServicePayableAmount(booking_details_id,serviceID);
            } 
            function setPackagePrice(booking_details_id){ 
                // alert($('#total_add_service_package_price_' + booking_details_id).val());                      
                var package_allocation_id = $('#package_allocation_id_' + booking_details_id).val();
                if (user_selected_add_service.some(entry => entry.split('_')[1] === '1')) {
                    if (user_selected_add_service.some(entry => entry.split('_')[3] === package_allocation_id)) {
                        var package_amt = parseFloat($('#booking_add_service_package_price_' + booking_details_id).val());
                        var package_name= ' (' + $('#add_service_package_name_hidden_' + booking_details_id).val() + ')';
                        var is_package_applicable = '1';
                    }else{
                        var package_amt = '0.00';
                        var package_name = '';
                        var is_package_applicable = '0';
                    }
                }else{
                    var package_amt = '0.00';
                    var package_name = '';
                    var is_package_applicable = '0';
                }
                $('#is_package_applicable_' + booking_details_id).val(is_package_applicable);
                $('#total_add_service_package_price_' + booking_details_id).val(parseFloat(package_amt).toFixed(2));
                $('#total_add_service_package_price_text_' + booking_details_id).text(parseFloat(package_amt).toFixed(2));
                $('#add_service_package_name_' + booking_details_id).text(package_name);
            }
            function setAddServicePayableAmount(booking_details_id,serviceID){
                calculateAddServiceTotalDiscount(booking_details_id,serviceID);
                
                setPackagePrice(booking_details_id);

                service_payable = parseFloat($('#add_service_payable_hidden_' + booking_details_id).val());
                product_payable = parseFloat($('#add_service_product_payable_hidden_' + booking_details_id).val());
                package_payable = parseFloat($('#total_add_service_package_price_' + booking_details_id).val());

                payable = service_payable + product_payable + package_payable;

                $('#add_service_final_payable_hidden_' + booking_details_id).val(parseFloat(payable).toFixed(2));
                $('#add_service_final_payable_text_' + booking_details_id).text(parseFloat(payable).toFixed(2));

                calculateGSTAmount(booking_details_id);
            }

            function calculateGSTAmount(booking_details_id){
                rate = parseFloat($('#salon_gst_rate_' + booking_details_id).val());
                booking_amount = parseFloat($('#add_service_final_payable_hidden_' + booking_details_id).val());

                gst_amount = (rate  * booking_amount) / 100;

                $('#add_service_final_gst_hidden_' + booking_details_id).val(parseFloat(gst_amount).toFixed(2));
                $('#add_service_final_gst_text_' + booking_details_id).text(parseFloat(gst_amount).toFixed(2));

                setGrandTotal(booking_details_id);
            }
            function setGrandTotal(booking_details_id){
                booking_amount = parseFloat($('#add_service_final_payable_hidden_' + booking_details_id).val());
                gst_amount = parseFloat($('#add_service_final_gst_hidden_' + booking_details_id).val());
                
                total = booking_amount + gst_amount;

                $('#add_service_final_total_hidden_' + booking_details_id).val(parseFloat(total).toFixed(2));
                $('#add_service_final_total_text_' + booking_details_id).text(parseFloat(total).toFixed(2));
            }
            function calculateAddServiceTotalDiscount(booking_details_id,serviceID){
                $('#add_service_discount_details_div_' + booking_details_id).html('');
                var membership_service_discount_amount = parseFloat($('#add_service_membership_service_discount_amount_' + booking_details_id).val());
                var membership_product_discount_amount = parseFloat($('#add_service_membership_product_discount_amount_' + booking_details_id).val());

                total_discount = membership_service_discount_amount + membership_product_discount_amount;
                $('#add_service_total_discount_amount_text_' + booking_details_id).text(parseFloat(total_discount).toFixed(2));
                $('#add_service_total_discount_amount_' + booking_details_id).val(parseFloat(total_discount).toFixed(2));

                var discount_details = '<div id="extra_service_discount_details_info"><i class="fas fa-info-circle" style="color:#0000ffb0;"></i>';
                discount_details += '<div class="extra-service-discount-tooltip">';
                if (membership_service_discount_amount > 0) {
                    discount_details += '<p>Membership Service Discount <span class="amount" style="float: right;">' + membership_service_discount_amount.toFixed(2) + '</span></p>';
                }
                if (membership_product_discount_amount > 0) {
                    discount_details += '<p>Membership Product Discount <span class="amount" style="float: right;">' + membership_product_discount_amount.toFixed(2) + '</span></p>';
                }
                discount_details += '<div style="border-top:1px solid #ccc;margin-top:1px;"><p>Total Discount <span class="amount" style="float: right;">' + total_discount.toFixed(2) + '</span></p></div>';
                discount_details += '</div></div>';
                if(total_discount > 0){
                    $('#add_service_discount_details_div_' + booking_details_id).html(discount_details);
                }
            } 

            function calculateTotalAddServiceDuration(booking_details_id,serviceID){
                total_duration = 0;

                for(var i=0;i<user_selected_add_service.length;i++){
                    duration = $('#service_duration_' + booking_details_id + '_' + serviceID).val();
                    total_duration = total_duration + parseFloat(duration);
                }

                $('#upper_duration').text(parseInt(total_duration) + ' Mins');
            }
        </script>
    <?php }else{ ?>
        <div style="text-align:center;">
            <label class="error">Booking details not available</label>
        </div>
    <?php } ?>