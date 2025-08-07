<?php include('header.php'); ?>
<style type="text/css">    
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
    .chosen-container .chosen-drop{
        position:  relative !important;
        display: none;
    }
    .chosen-container.chosen-with-drop.chosen-container-active .chosen-drop{
        display: block !important;
    }
</style>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left" style="width:100%;">
                <h3>
                    Transfer Upcoming Bookings 
                    <small style="float:right;color:red;">(Note: All future bookings from now on are considered for transfer)</small>
                </h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="container">
                            <form name="staff_form" id="staff_form" method="get">
                                <div class="container animated fadeInRight">
                                    <div class="">
                                        <div class="row top-section">
                                            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <label>Select Stylist <b class="require">*</b></label>
                                                <select class="form-control chosen-option" name="stylist" id="stylist" onchange="hideDetails()">
                                                    <option value="">Select Stylist</option>
                                                    <?php if(!empty($employee)){ 
                                                        foreach($employee as $employee_result){?>
                                                        <option value="<?=$employee_result->id?>" <?php if(isset($_GET['stylist']) && $_GET['stylist'] == $employee_result->id){ echo 'selected'; }?>><?=$employee_result->full_name?></option>
                                                    <?php }}?>
                                                </select>
                                                <label for="stylist" style="display:none;" generated="true" class="error">Please select employee!</label>
                                            </div>  
                                            <div class="col-md-4  col-sm-3 col-xs-12">
                                                <button type="submit" id="submit_button" class="btn btn-success" style="margin-top:30px;">Search</button>
                                                <?php if(!isset($_GET['stylist'])){ ?>

                                                <?php }else{ ?>
                                                <a href="<?=base_url();?><?=$this->uri->segment(1);?>" class="btn btn-info" style="margin-top:30px;">Reset</a>
                                                <?php } ?>
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
        <?php 
            if(isset($_GET['stylist']) && $_GET['stylist'] != ""){ 
                if(!empty($upcoming_appointments)){ 
                    $booking_rules = $this->Salon_model->get_booking_rules();
                    if(!empty($booking_rules)){
                        // $booking_rescheduling = $booking_rules->booking_rescheduling;
                        // $cancellation = $booking_rules->cancellation;
                        
                        $cancellation = 0;
                        $booking_rescheduling = 0;
                    }else{
                        $cancellation = 0;
                        $booking_rescheduling = 0;
                    }
        ?>
        <div class="row" id="booking_details_div">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="container">
                            <form name="transfer_form" id="transfer_form" method="post">
                                <input type="hidden" name="transfer_from" id="transfer_from" value="<?=$_GET['stylist'];?>">
                            <?php 
                            foreach($upcoming_appointments as $data){ 
                                $booking_payments = $this->Salon_model->get_all_bookings_payments($data->id);
                    
                                $services = explode(',',$data->services);
                                $services_str = '';
                                if (empty($services)) {
                                    $services_str = '-';
                                } else {
                                    for ($k = 0; $k < count($services); $k++) {
                                        $service_details = $this->Salon_model->get_service_details($services[$k]);
                                        if (!empty($service_details)) {
                                            $booking_service_details = $this->Salon_model->get_booking_single_service_details_stylist($data->id,$services[$k],$_GET['stylist']);
                                            $single_html = '';
                                            if(!empty($booking_service_details)){
                                                if($booking_service_details->service_status == '1'){
                                                    $single_html = '<button style="background: rgb(144, 238, 144);color: #414141; margin-bottom: 5px; border: 1px solid;border-radius: 20px;font-size: 10px;padding: 5px 8px;" title="'.$service_details->service_name_marathi.'" type="button" class="btn btn-info" id="service_details_button">'.$service_details->service_name.'</button>';
                                                }elseif($booking_service_details->service_status == '0'){
                                                    $single_html = '<button style="background: rgb(255, 213, 128);color: #414141; margin-bottom: 5px; border: 1px solid;border-radius: 20px;font-size: 10px;padding: 5px 8px;" title="'.$service_details->service_name_marathi.'" type="button" class="btn btn-info" id="service_details_button">'.$service_details->service_name.'</button>';
                                                }elseif($booking_service_details->service_status == '2'){
                                                    $single_html = '<button style="background: #ffd8d8;color: #414141; margin-bottom: 5px; border: 1px solid;border-radius: 20px;font-size: 10px;padding: 5px 8px;" title="'.$service_details->service_name_marathi.'" type="button" class="btn btn-info" id="service_details_button">'.$service_details->service_name.'</button>';
                                                }else{
                                                    $single_html = '<button style="background: white;color: #414141; margin-bottom: 5px; border: 1px solid;border-radius: 20px;font-size: 10px;padding: 5px 8px;" title="'.$service_details->service_name_marathi.'" type="button" class="btn btn-info" id="service_details_button">'.$service_details->service_name.'</button>';
                                                }
                                            }
                                            $services_str .= $single_html;
                                            if ($k < count($services) - 1) {
                                                $services_str .= '';
                                            }
                                        }
                                    }
                                }
                                $booking_services = $this->Salon_model->get_salon_employee_single_booking_services($data->id,$_GET['stylist']);

                                $package_background_color = '';
                                $package_text = '';
                                if($data->is_package_included == '1'){
                                    $package_details = $this->Salon_model->get_package_details($data->pacakge_id);
                                    if(!empty($package_details)){
                                        $package_text = '<button class="btn btn-sm" style="float:left; background-color: '. $package_details->bg_color .'; color:' . $package_details->text_color . ';">' . $package_details->package_name . '</button>';
                                        $package_background_color = $this->Salon_model->lightenColor($package_details->bg_color, 60);                                                
                                    }
                                }
                    
                                $background_color = '';
                                if($data->booking_generated_from == '1'){
                                    $background_color = 'background-color:#e5fff9;';
                                }
                            ?>
                                <input type="hidden" name="booking_ids[]" id="booking_ids" value="<?=$data->id;?>">
                                <div class="accordion" id="accordion_<?=$data->id;?>">
                                    <div class="panel">
                                        <div class="panel-heading" style="<?=$background_color;?>padding: 10px !important;">
                                            <h4 class="panel-title">
                                                <a style="color:black;" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion_<?=$data->id;?>" href="#collapse_<?=$data->id;?>" onclick="changeCSS(<?=$data->id;?>)">
                                                    <div class="row" style="display:flex;justify-content:space-between; align-items:center;">
                                                        <div class="col-lg-1 text-left">	
                                                            <button class="btn arrow_btn" style="outline: none;background: #fff0;" onclick="changeCSS(<?=$data->id;?>)"><i class="fas fa-chevron-right" id="arrow_<?=$data->id;?>"></i></button>
                                                            <span style="padding: 8px;font-size: 15px;font-weight: 700;"></span>
                                                        </div>
                                                </a>
                                                    <div class="col-lg-11">	
                                                        <div class="row" >
                                                            <div class="col-lg-4">
                                                                <p style="font-size: 15px;color: #2b2b2b;"><b>Customer: <?=$data->full_name;?></b></p>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <p style="font-size: 13px;color: #414141;"><b>Booking Date: <?= date('d M, Y',strtotime($data->service_start_date));?></b></p>
                                                            </div>
                                                            <div class="col-lg-5">
                                                                <p style="font-size: 13px;color: #414141;"><b>Booking Time: <?= date('h:i A',strtotime($data->service_start_time)).' to '.date('h:i A',strtotime($data->service_end_time));?></b></p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <p style="font-size: 15px;color: #414141;margin: 0px;"><b>Mobile: <?=$data->customer_phone;?></b></p>
                                                            </div>
                                                            <div class="col-lg-8">
                                                                <?=$services_str;?>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <p style="font-size: 11px;color: #414141;margin: 0px;"><b>Booking ID: <?=$data->receipt_no != "" ? $data->receipt_no : '-';?></b></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </h4>
                                        </div>
                                        <div id="collapse_<?=$data->id;?>" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <table id="example" class="table table-bordered dt-responsive nowrap example list_table"  style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Sr. No.</th>
                                                            <!-- <th>Status</th> -->
                                                            <th>Service</th>
                                                            <th>Products</th>
                                                            <!-- <th>Date</th> -->
                                                            <th>Duration</th>
                                                            <th>Current Stylist</th>
                                                            <th>Transfer To<b class="require">*</b></th>
                                                        <tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                        if(!empty($booking_services)){
                                                            $z = 1;
                                                            foreach($booking_services as $booking_services_result){
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

                                                                if($booking_services_result->service_added_from == '1'){
                                                                    $background_color = 'background-color:'.$package_background_color.';';
                                                                }else{
                                                                    if($booking_services_result->is_extra_service == '1'){
                                                                        $background_color = 'background-color:#0000ff21;';
                                                                    }else{
                                                                        $background_color = '';
                                                                    }
                                                                }
                                                                if($booking_services_result->service_status == '2'){
                                                                    $background_color = 'background-color:#ffd8d8;';
                                                                }
                                                    ?>
                                                        <input type="hidden" name="booking_service_details_ids_<?=$data->id;?>[]" id="booking_service_details_ids_<?=$data->id;?>" value="<?=$booking_services_result->id;?>">
                                                        <tr style="<?=$background_color;?>">
                                                            <td><?=$z++; ?></td>
                                                            <!-- <td> -->
                                                                <?php 
                                                                    // if($booking_services_result->service_status == '0'){
                                                                    //     echo '<label class="label label-warning">Pending</label>';
                                                                    // }elseif($booking_services_result->service_status == '1'){
                                                                    //     echo '<label class="label label-success">Completed</label>';
                                                                    //     echo '<br>On: '.date('d-m-Y',strtotime($booking_services_result->completed_on));
                                                                    // }elseif($booking_services_result->service_status == '2'){
                                                                    //     echo '<label class="label label-danger">Cancelled</label>';
                                                                    // }elseif($booking_services_result->service_status == '3'){
                                                                    //     echo '<label class="label label-default">Lapsed</label>';
                                                                    // }else{
                                                                    //     echo 'NA';
                                                                    // }
                                                                ?>
                                                            <!-- </td> -->
                                                            <td><?=$booking_services_result->service_name;?><br><?=$booking_services_result->service_name_marathi;?></td>
                                                            <td><?=($product_details_str != "") ? $product_details_str : '-';?></td>
                                                            <!-- <td><?= date('d M, Y',strtotime($booking_services_result->service_date));?></td> -->
                                                            <td><?= date('h:i A',strtotime($booking_services_result->service_from)).' to '.date('h:i A',strtotime($booking_services_result->service_to));?></td>
                                                            <td><?=$booking_services_result->stylist_name;?></td>
                                                            <td>
                                                                <select class="form-control chosen-select services-details" id="transfer_to_<?=$data->id;?>_<?=$booking_services_result->id;?>" name="transfer_to_<?=$data->id;?>_<?=$booking_services_result->id;?>">
                                                                    <option value="">Select Stylist</option>
                                                                    <?php 
                                                                    if(!empty($booking_services_result->stylists)){
                                                                        foreach($booking_services_result->stylists as $stylist_result){
                                                                            if($stylist_result['stylist_details']->id != $booking_services_result->stylist_id){
                                                                                if(!empty($stylist_result['stylist_details'])){
                                                                                    $store_flag = $stylist_result['store_flag'];
                                                                                    $is_service_available = $stylist_result['is_service_available'];
                                                                                    $is_shift_available = $stylist_result['is_shift_available'];
                                                                                    $is_booking_present = $stylist_result['is_booking_present'];
                                                                                    $is_on_leave_flag = $stylist_result['is_on_leave_flag'];
                                                                                    $is_on_break = $stylist_result['is_on_break'];
                                                                                    $is_emergency_flag = $stylist_result['is_emergency_flag'];
                                                        
                                                                                    if($is_service_available == '1'){
                                                                                        if($store_flag == '1'){
                                                                                            if($is_emergency_flag == '0'){
                                                                                                if($is_on_leave_flag == '0'){
                                                                                                    if($is_shift_available == '1'){
                                                                                                        if($is_booking_present == '0'){
                                                                                                            if($is_on_break == '0'){
                                                                                                                $message = '';
                                                                                                                $disabled = '';
                                                                                                                $is_Allowed = 1;
                                                                                                            }else{
                                                                                                                $message = '- Stylist On Break';
                                                                                                                $disabled = 'disabled';
                                                                                                                $is_Allowed = 0;
                                                                                                            }
                                                                                                        }else{
                                                                                                            $message = '- Slot Already Booked';
                                                                                                            $disabled = 'disabled';
                                                                                                            $is_Allowed = 0;
                                                                                                        }
                                                                                                    }else{
                                                                                                        $message = '- Shift Not Available';
                                                                                                        $disabled = 'disabled';
                                                                                                        $is_Allowed = 0;
                                                                                                    }
                                                                                                }else{
                                                                                                    $message = '- On Leave';
                                                                                                    $disabled = 'disabled';
                                                                                                    $is_Allowed = 0;
                                                                                                }
                                                                                            }else{
                                                                                                $message = '- Store Emergency Closed';
                                                                                                $disabled = 'disabled';
                                                                                                $is_Allowed = 0;
                                                                                            }
                                                                                        }else{
                                                                                            $message = '- Exceed Salon Times';
                                                                                            $disabled = 'disabled';
                                                                                            $is_Allowed = 0;
                                                                                        }

                                                                                        $selected = '';
                                                                                        if($stylist_result['to_be_selected'] == '1'){
                                                                                            $selected = 'selected';
                                                                                        }
                                            
                                                                    ?>
                                                                        <option value="<?=$stylist_result['stylist_details']->id;?>" <?= $selected; ?> <?= $disabled; ?>><?=$stylist_result['stylist_details']->full_name.' '.$message;?></option>
                                                                    <?php
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                    } 
                                                                    ?>
                                                                </select>
                                                                <label style="display:none;" for="transfer_to_<?=$data->id;?>_<?=$booking_services_result->id;?>" generated="true" class="error">Please select stylist!</label>
                                                            </td>
                                                        </tr>
                                                        <?php 
                                                            }} 
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="col-md-12 col-sm-3 col-xs-12">
                                    <button type="submit" id="submit_transfer_button" name="submit_transfer_button" value="submit_transfer_button" class="btn btn-primary" style="margin-top:30px; float:right;">Submit</button>
                                </div>	
                            </form> 
                        </div> 
                    </div>
                </div>
            </div>
        </div>
        <?php }else{ ?>
        <div class="row" id="booking_details_div">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="container">
                            <label style="color:red;">Booking not available.</label>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php } ?>
    </div>
</div>
<div class="loader_div">
    <div  class="loader-new"></div>
</div>
<?php include('footer.php');?>
<script>		
    $(document).ready(function() {
        $()
        $(".chosen-option").chosen();
        $( ".custom_date" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "dd-mm-yy",
            minDate: 0,
            maxDate: 0
        });
        $("#staff_form").validate({
            ignore: [],
            rules: {
                stylist: "required",
            },
            messages: {
                stylist: "Please select stylist!",
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
        $("#transfer_form").validate({
            ignore: [],
            rules: {
                'booking_ids[]': "required",
                <?php 
                if(isset($_GET['stylist']) && $_GET['stylist'] != ""){ 
                    if(!empty($upcoming_appointments)){
                        foreach($upcoming_appointments as $data){ 
                            $booking_services = $this->Salon_model->get_salon_employee_single_booking_services($data->id,$_GET['stylist']);
                            if(!empty($booking_services)){
                                foreach($booking_services as $result){ 
                ?>
                                    'transfer_to_<?=$data->id;?>_<?=$result->id;?>': {
                                        required: true,
                                    },
                <?php 
                                }
                            } 
                        }
                    }
                }
                ?>
            },
            messages: {
                'booking_ids[]': "Atleast 1 booking is required!",
                <?php 
                if(isset($_GET['stylist']) && $_GET['stylist'] != ""){ 
                    if(!empty($upcoming_appointments)){
                        foreach($upcoming_appointments as $data){ 
                            $booking_services = $this->Salon_model->get_salon_employee_single_booking_services($data->id,$_GET['stylist']);
                            if(!empty($booking_services)){
                                foreach($booking_services as $result){ 
                ?>
                                    'transfer_to_<?=$data->id;?>_<?=$result->id;?>': {
                                        required: "Please select stylist!",
                                    },
                <?php 
                                }
                            } 
                        }
                    }
                }
                ?>
            },
            submitHandler: function(form) {
                if (confirm("Do you want to submit the form?")) {
                    form.submit();
                }
            }
        });
    }); 
    function hideDetails(){
        $('#booking_details_div').hide();
    }
</script>
<script>
    $(document).ready(function() {
        $('#reports .child_menu').show();
        $('#reports').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.transfer-bookings').addClass('active_cc');
    });
</script>