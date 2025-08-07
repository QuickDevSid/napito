<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Survey</title>  
        <link href="<?= base_url() ?>admin_assets/css/bootstrap.min.css" rel="stylesheet">	
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/fontawesome.min.css"
            integrity="sha512-siarrzI1u3pCqFG2LEzi87McrBmq6Tp7juVsdmGY1Dr8Saw+ZBAzDzrGwX3vgxX1NkioYNCFOVC0GpDPss10zQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="<?= base_url() ?>admin_assets/fonts/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?= base_url() ?>admin_assets/css/animate.min.css" rel="stylesheet">
        <link href="<?= base_url() ?>admin_assets/css/salon-style.css" rel="stylesheet">
        <link href="<?= base_url('assets/css/jquery-ui.css'); ?>" rel="stylesheet">
        <!-- Custom styling plus plugins -->
        <link href="<?= base_url() ?>admin_assets/css/custom.css" rel="stylesheet">
        <link href="<?= base_url() ?>admin_assets/css/jquery.timesetter.css" rel="stylesheet">
        <link href="<?= base_url() ?>admin_assets/css/chosen.css" rel="stylesheet">
        <link href="<?= base_url() ?>admin_assets/css/chosen.min.css" rel="stylesheet">
        <link rel="<?= base_url() ?>admin_assets/stylesheet" type="text/css" href="css/maps/jquery-jvectormap-2.0.1.css" />
        <link href="<?= base_url() ?>admin_assets/css/floatexamples.css" rel="stylesheet" type="text/css" />
        <script src="<?=base_url()?>admin_assets/js/jquery.min.js"></script>
    </head>
    <style>   
        #my_camera video{
            width: 260px;
            height: 150px;
        } 
        .error {
            font-size: 11px;
            color: red;
        }
        .img-preview {
            height: 200px; 
            width: 200px; 
            margin: auto;
        }
        div.row.applicant {
            display: flex;
            align-items: center;
        }
        .formrow-div{
            margin-left: 0px;
            margin-right: 0px;
            padding: 10px 10px 25px 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-bottom: 15px;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 6px -1px, rgba(0, 0, 0, 0.06) 0px 2px 4px -1px;        
        }
        .form-label-head{
            margin-bottom: 12px;
            color: #2a3f54;
            font-size: 17px;
        }
       
        /* label{
            color: #000000c2;;
        }
        .chosen-container-single .chosen-single span{
            color: #000000c2;
        } */

        .datatable table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        .datatable table, .datatable th, .datatable td {
            border: 1px solid #ccc;
        }
        .datatable th, .datatable td {
            padding: 8px;
            text-align: left;
        }
    </style>

   
    <div class="container body">
        <div class="main_container">
            <div class="container" >
                <div class="x_panel">
                    <div class="x_title">
                        <h2 style="color:black;">Salon Survey</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="container body">	
                            <div class="row formrow-div">
                                <div class="col-lg-12">
                                <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                                    <div class="tab-pane fade <?php if($this->uri->segment(3) == 'nav-basic' || $this->uri->segment(3) == ""){ ?>active in<?php }?>" id="nav-basic" role="tabpanel" aria-labelledby="nav-basic-tab">
                                        
                                    <h5 class="form-label-head">Basic Info</h5>

                                        <form class="" method="post" name="basic_info_form" id="basic_info_form" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                    <label for="fullname">Salon Name <b class="require">*</b></label>
                                                    <input type="text" placeholder="Enter Salon Name" id="salon_name" class="form-control" name="salon_name" value="<?php if(!empty($single)){ echo  $single->salon_name; }?>">
                                                </div>
                                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                    <label for="fullname">Salon Owner Name <b class="require">*</b></label>
                                                    <input type="text" placeholder="Enter Salon  Owner Name" id="salon_owner_name" class="form-control" name="salon_owner_name" value="<?php if(!empty($single)){ echo  $single->salon_owner_name; }?>">
                                                </div>
                                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                    <label for="fullname">How Many People Work In Salon? <b class="require">*</b></label>
                                                    <input  placeholder="Enter No. of People" type="text" id="no_of_people" class="form-control" name="no_of_people" value="<?php if(!empty($single)){ echo  $single->no_of_people; }?>">                                      
                                                    <input type="hidden" id="id" class="form-control" name="id" value="<?php if(!empty($single)){ echo  $single->id; }?>">
                                                </div>
                                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                    <?php                                         
                                                        $salon_type = (!empty($single)) ? $single->salon_type : '';
                                                    ?>
                                                    <label for="fullname">Salon Type <b class="require">*</b></label>
                                                    <select id="salon_type" class="form-control" name="salon_type" onchange="updateTable()">
                                                        <option value="">Select Salon Type</option>
                                                        <option value="0" <?php echo ($salon_type == '0') ? 'selected' : ''; ?>>Male</option>
                                                        <option value="1" <?php echo ($salon_type == '1') ? 'selected' : ''; ?>>Female</option>
                                                        <option value="2" <?php echo ($salon_type == '2') ? 'selected' : ''; ?>>Unisex</option>
                                                    </select>
                                                    <label id="salon_type-error" class="error" for="salon_type" style="display:none;">Please select a salon type</label>
                                                </div>
                                            <!-- </div>
                                            <div class="row"> -->
                                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                    <label for="fullname">How Many Chairs Salon Have? <b class="require">*</b></label>
                                                    <input placeholder="Enter No. of Chairs" type="text" id="no_of_chairs" class="form-control" name="no_of_chairs" value="<?php if(!empty($single)){ echo  $single->no_of_chairs; }?>">
                                                </div>
                                                <?php if(isset($_GET['edit'])){ ?>
                                                    <input type="hidden" id="redirect_1" name="redirect_1" value="survey-list?id=<?=$this->uri->segment(2)?>">
                                                <?php } ?>
                                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                    <?php $billing_counter = (!empty($single)) ? $single->billing_counter : ''; ?>
                                                    <label for="fullname">Billing Counter <b class="require">*</b></label>
                                                    <select id="billing_counter" class="form-control" name="billing_counter">
                                                        <option value="">Select Billing Counter</option>
                                                        <option value="Yes" <?php echo ($billing_counter == 'Yes') ? 'selected' : ''; ?>>Yes</option>
                                                        <option value="No" <?php echo ($billing_counter == 'No') ? 'selected' : ''; ?>>No</option>
                                                    </select>
                                                    <label id="billing_counter-error" class="error" for="billing_counter" style="display:none;">Please select a salon type</label>
                                                </div>

                                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                    <?php                                         
                                                        $receptionist_available = (!empty($single)) ? $single->receptionist_available : '';
                                                    ?>
                                                    <label for="fullname">Receptionist Available? <b class="require">*</b></label>
                                                    <select id="receptionist_available" class="form-control" name="receptionist_available">
                                                        <option value="">Select Receptionist Available?</option>
                                                        <option value="Yes" <?php echo ($receptionist_available == 'Yes') ? 'selected' : ''; ?>>Yes</option>
                                                        <option value="No" <?php echo ($receptionist_available == 'No') ? 'selected' : ''; ?>>No</option>
                                                    </select>
                                                    <label id="receptionist_available-error" class="error" for="receptionist_available" style="display:none;">Please select a salon type</label>
                                                </div>
                                            </div>
                                                    <div class="datatable">
                                                        <table style="width:50%;">
                                                            <thead>
                                                                <tr id="table_head">
                                                                    <th>Service</th>
                                                                    <th>Rate</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>                                                        
                                                                <tr id="row_haircut">
                                                                    <td>HAIRCUT</td>
                                                                    <td><input type="number" class="form-control" id="rate_haircut" name="rate_haircut" value="<?php if(!empty($single)){ echo  $single->rate_haircut; }?>"></td>
                                                                </tr>
                                                                <tr id="row_beard">
                                                                    <td>Beard</td>
                                                                    <td><input type="number" class="form-control" id="rate_beard" name="rate_beard" value="<?php if(!empty($single)){ echo  $single->rate_beard; }?>"></td>
                                                                </tr>
                                                                <tr id="row_wax">
                                                                    <td>Wax</td>
                                                                    <td><input type="number" class="form-control" id="rate_wax" name="rate_wax" value="<?php if(!empty($single)){ echo  $single->rate_wax; }?>"></td>
                                                                </tr>
                                                                <tr id="row_eyebrows">
                                                                    <td>Eyebrows</td>
                                                                    <td><input type="number" class="form-control" id="rate_eyebrows" name="rate_eyebrows" value="<?php if(!empty($single)){ echo  $single->rate_eyebrows; }?>"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                            <!-- <div class="clearfix"></div>
                                            <div class="row"> -->
                                                <div class="col-md-12 col-sm-12 col-xs-12 form-group bottom-btn-row" style="margin-top: 23px;">
                                                    <button class="btn btn-primary Next-next-btn" id="basic_info_submit_button" name="submit_basic_info" value="submit_basic_info">Next</button>
                                                    <?php if(isset($_GET['edit'])){ ?>
                                                        <a class="btn btn-warning Cancel-cancel-btn" href="<?=base_url();?>survey-list">Cancel</a>
                                                    <?php }else{ ?>
                                                        <a class="btn btn-warning Cancel-cancel-btn" href="<?=base_url();?>survey">Cancel</a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </form>
                                    </div>

                                    <div class="tab-pane fade <?php if($this->uri->segment(3) == 'nav-other'){?>active in<?php }?>" id="nav-other" role="tabpanel" aria-labelledby="nav-other-tab">
                                        
                                    <h5 class="form-label-head">Other Info</h5>
                                        <form class="" method="post" name="other_info_form" id="other_info_form" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <?php                                         
                                                    $service_provide_type = (!empty($single)) ? $single->service_provide_type : '';
                                                ?>
                                                <label for="fullname">Service Provide Type <b class="require">*</b></label>
                                                <select id="service_provide_type" class="form-control" name="service_provide_type">
                                                    <option value="">Select Service Provide Type</option>
                                                    <option value="Waiting" <?php echo ($service_provide_type == 'Waiting') ? 'selected' : ''; ?>>Waiting</option>
                                                    <option value="Register" <?php echo ($service_provide_type == 'Register') ? 'selected' : ''; ?>>Register</option>
                                                    <option value="Vendor App" <?php echo ($service_provide_type == 'Vendor App') ? 'selected' : ''; ?>>Vendor App</option>
                                                    <option value="Customer App" <?php echo ($service_provide_type == 'Customer App') ? 'selected' : ''; ?>>Customer App</option>
                                                </select>
                                                <label id="service_provide_type-error" class="error" for="service_provide_type" style="display:none;">Please select a salon type</label>
                                            </div>
                                            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <label for="fullname">Salon Owner Contact No. <b class="require">*</b></label>
                                                <input type="text" placeholder="Enter Salon Owner Contact No." id="salon_owner_contact" class="form-control" name="salon_owner_contact" value="<?php if(!empty($single)){ echo  $single->salon_owner_contact; }?>">
                                            </div>
                                            <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <label for="salon_address">Select Salon Address <b class="require">*</b></label>
                                                <select id="address_dropdown" name="salon_address" class="form-control" style="margin-top: 10px;">
                                                    <option value="">Select Salon Address</option>
                                                </select>
                                                <label id="address_dropdown-error" style="display:none;" class="error" for="address_dropdown">Please enter salon address</label>
                                                <input type="hidden" id="id" class="form-control" name="id" value="<?php if(!empty($single)){ echo  $single->id; }?>">
                                                <input type="hidden" name="last_id" value="<?php echo $this->session->userdata('last_id'); ?>">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <label for="street_name">Salon Street <b class="require">*</b></label>
                                                <input placeholder="Enter Salon Street" type="text" id="street_name" class="form-control" name="street_name" value="<?php if(!empty($single)){ echo  $single->street_name; }?>">
                                            </div>
                                            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <label>Area <b class="require">*</b></label>
                                                <input  placeholder="Enter Area" type="text" id="area" class="form-control" name="area" value="<?php if(!empty($single)){ echo  $single->area; }?>">                                            
                                            </div>
                                            <input type="hidden" id="latitude" name="latitude" value="<?php if(!empty($single)){ echo  $single->latitude; }?>">
                                            <input type="hidden" id="longitude" name="longitude" value="<?php if(!empty($single)){ echo  $single->longitude; }?>">
                                            <?php if(isset($_GET['edit'])){ ?>
                                                <input type="hidden" id="redirect_2" name="redirect_2" value="survey-list?id=<?=$this->uri->segment(2)?>">
                                            <?php } ?>
                                            <div class="form-group col-lg-2">
                                                <label>State <b class="require">*</b></label>
                                                <select class="form-control" name="state" id="state">
                                                    <option value="" class="">Select State</option>
                                                    <?php 
                                                    $state = $this->Admin_model->get_state_list();
                                                    if (!empty($state)) {
                                                        foreach ($state as $state_result) { ?>                                       
                                                            <option <?php if(!empty($single) && $single->state == $state_result->id){ echo "selected"; }else{ if($state_result->id == '4008'){ echo 'selected'; }} ?> value="<?= $state_result->id?>"><?=$state_result->name?></option>
                                                    <?php
                                                    }} 
                                                    ?>
                                                </select>
                                                <label id="state-error" class="error" for="state" style="display:none;">Please select a salon type</label>
                                            </div>
                                            <div class="form-group col-lg-2">
                                                <label>City <b class="require">*</b></label>
                                                <select class="form-control" name="city" id="city_name">
                                                    <option value="">Select City</option>
                                                    <?php
                                                        if(!empty($single) && $single->state !=''){
                                                            $city =$this->Survey_model->get_respective_state_city($single->state);
                                                            if(!empty($city)){
                                                                foreach($city as $cities){?>
                                                                <option value="<?=$cities->id?>" <?php if(!empty($single) && $single->city == $cities->id) { echo 'selected'; }else{ if($cities->id == '4008'){ echo 'selected'; }}?> ><?=$cities->name?></option>
                                                    <?php }}}else{
                                                        $city =$this->Survey_model->get_respective_state_city('4008');
                                                            if(!empty($city)){
                                                                foreach($city as $cities){
                                                    ?>
                                                                <option value="<?=$cities->id?>" <?php if(!empty($single) && $single->city == $cities->id) { echo 'selected'; }else{ if($cities->id == '57765'){ echo 'selected'; }}?> ><?=$cities->name?></option>
                                                    <?php }}} ?>
                                                </select>
                                                <label id="city_name-error" class="error" for="city_name" style="display:none;">Please select a salon type</label>
                                            </div>
                                            <div class="form-group col-lg-2">
                                                <label>Location <b class="require">*</b></label>
                                                <select class="form-control" name="location" id="location">
                                                    <option value="">Select Location</option>
                                                    <?php
                                                        if(!empty($single) && $single->city !=''){
                                                            $location =$this->Survey_model->get_respective_location($single->city);
                                                            if(!empty($location)){
                                                                foreach($location as $location_result){?>
                                                                <option value="<?=$location_result->id?>" <?php if(!empty($single) && $single->location == $location_result->id) { echo 'selected'; }?> ><?=$location_result->name?></option>
                                                    <?php }}}?>
                                                </select>
                                                <label id="location-error" class="error" for="location" style="display:none;">Please select a salon type</label>
                                            </div>
                                        </div>                                   
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Pincode <b class="require">*</b></label>
                                                <input placeholder="Enter Pincode" type="number" id="pincode" class="form-control" name="pincode" value="<?php if(!empty($single)){ echo  $single->pincode; }?>">                                            
                                            </div>
                                        </div>                                   
                                        <div class="row">
                                            <!-- <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <label for="fullname">Salon Board Photo <b class="require">*</b></label>
                                                <?php if (!empty($single) && $single->selfie != '') { ?>
                                                    <a target="_blank" title="View" href="<?= base_url() ?>admin_assets/images/survey/<?= $single->selfie; ?>" id="view_btn" style="margin: 5px;">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a target="_blank" title="Download" href="<?= base_url() ?>admin_assets/images/survey/<?= $single->selfie; ?>" style="margin: 5px;" id="download_btn" download>
                                                        <i class="fa fa-download"></i>
                                                    </a>
                                                <?php } ?>
                                                <input type="file" accept=".jpg,.jpeg,.png" id="salon_owner_selfie" class="form-control" name="salon_owner_selfie">
                                                <input type="hidden" id="old_salon_owner_selfie" class="form-control" name="old_salon_owner_selfie" value="<?php if (!empty($single)) { echo $single->selfie; } ?>">
                                            </div> -->
                                            <input type="hidden" id="old_salon_owner_selfie" class="form-control" name="old_salon_owner_selfie" value="<?php if (!empty($single)) { echo $single->selfie; } ?>">
                                            <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12" id="webcam_empty_div" style="display:none;">
                                                <label for="fullname">Salon Board Selfie <b class="require">*</b>                                            
                                                    <?php if (!empty($single) && $single->selfie != '') { ?>
                                                        <a target="_blank" title="View" href="<?= base_url() ?>admin_assets/images/survey/<?= $single->selfie; ?>" id="view_btn" style="margin: 5px;">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <a target="_blank" title="Download" href="<?= base_url() ?>admin_assets/images/survey/<?= $single->selfie; ?>" style="margin: 5px;" id="download_btn" download>
                                                            <i class="fa fa-download"></i>
                                                        </a>
                                                    <?php } ?>
                                                </label> 
                                                <label style="display:block;" class="error">No webcam detected. Please connect a webcam to capture photo</label>
                                            </div>
                                            <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12" id="webcam_div" style="display:none;">
                                                <label for="fullname">Salon Board Selfie <b class="require">*</b>                                            
                                                    <?php if (!empty($single) && $single->selfie != '') { ?>
                                                        <a target="_blank" title="View" href="<?= base_url() ?>admin_assets/images/survey/<?= $single->selfie; ?>" id="view_btn" style="margin: 5px;">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <a target="_blank" title="Download" href="<?= base_url() ?>admin_assets/images/survey/<?= $single->selfie; ?>" style="margin: 5px;" id="download_btn" download>
                                                            <i class="fa fa-download"></i>
                                                        </a>
                                                    <?php } ?>
                                                </label> 
                                                <div id="my_camera"></div>
                                                <br/>
                                                <input type="button" class="btn btn-secondary take_photo" value="Click to take photo" onClick="take_snapshot()">
                                                <input type="button" class="btn btn-warning unfreez_photo" style="display:none;" value="Click to Retake photo" onClick="unfreez_snapshot()">
                                                <input type="hidden" name="image" class="image-tag">
                                            </div>

                                            <!-- <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <label for="fullname">Salon Owner Free Day <b class="require">*</b></label>
                                                <input type="text" placeholder="Enter Week Days" id="salon_owner_free_on" class="form-control" name="salon_owner_free_on" value="">
                                            </div> -->
                                        </div>
                                  
                                    <div class="clearfix"></div>
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12 form-group bottom-btn-row" style="margin-top: 23px;">
                                                <a class="btn btn-warning nav-item nav-link Previous-previous-btn" data-toggle="tab"  id="nav-basic-ids" href="#nav-basic" role="tab" aria-controls="nav-basic">Previous</a>	
                                                <button class="btn btn-primary Next-next-btn" id="submit_button" name="submit_other_info" value="submit_other_info">Submit</button>
                                            </div>
                                        </div>
                                    <div class="clearfix"></div>
                                        </form>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <script src="<?=base_url()?>admin_assets/js/jquery-ui.js"></script>
    <script src="<?=base_url()?>admin_assets/js/bootstrap.min.js"></script>
    <!-- bootstrap progress js -->
    <script src="<?=base_url()?>admin_assets/js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="<?=base_url()?>admin_assets/js/nicescroll/jquery.nicescroll.min.js"></script>
    <!-- daterangepicker -->
    <script type="text/javascript" src="<?=base_url()?>admin_assets/js/moment.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>admin_assets/js/datepicker/daterangepicker.js"></script>
    <script src="<?=base_url()?>admin_assets/js/custom.js"></script>
    <!-- flot js -->
    <script type="text/javascript" src="<?=base_url()?>admin_assets/js/flot/jquery.flot.js"></script>
    <script type="text/javascript" src="<?=base_url()?>admin_assets/js/flot/jquery.flot.pie.js"></script>
    <script type="text/javascript" src="<?=base_url()?>admin_assets/js/flot/jquery.flot.orderBars.js"></script>
    <script type="text/javascript" src="<?=base_url()?>admin_assets/js/flot/jquery.flot.time.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>admin_assets/js/flot/date.js"></script>
    <script type="text/javascript" src="<?=base_url()?>admin_assets/js/flot/jquery.flot.spline.js"></script>
    <script type="text/javascript" src="<?=base_url()?>admin_assets/js/flot/jquery.flot.stack.js"></script>
    <script type="text/javascript" src="<?=base_url()?>admin_assets/js/flot/curvedLines.js"></script>
    <script type="text/javascript" src="<?=base_url()?>admin_assets/js/flot/jquery.flot.resize.js"></script>
    <script type="text/javascript" src="<?=base_url()?>admin_assets/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>admin_assets/js/chosen.jquery.js"></script>
    <script type="text/javascript" src="<?=base_url()?>admin_assets/js/chosen.jquery.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>admin_assets/js/chosen.proto.js"></script>
    <script type="text/javascript" src="<?=base_url()?>admin_assets/js/chosen.proto.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCyjKElRlcYeCAQQ2TVb4sRxFGcYDFVvYk&libraries=places"></script>
    <script>
        function toggleReceptionistAvailable() {
            var billingCounterValue = $("#billing_counter").val();
            
            if (billingCounterValue === "Yes") {
                $("#receptionist_available").closest(".form-group").show();
            } else {
                $("#receptionist_available").closest(".form-group").hide();
            }
        }
        $(document).ready(function() {
            toggleReceptionistAvailable();

            $("#billing_counter").change(function() {
                toggleReceptionistAvailable();
            });

            updateAddButtonText();

            $("select").chosen({
                width: "100%"
            });




            $("#basic_info_form").validate({
                ignore: ":hidden:not(select)",
                rules: {
                    receptionist_available: {
                        required: {
                            depends: function(element) {
                                return $("#billing_counter").val() === "Yes";
                            }
                        }
                    },
                    salon_name: {
                        required: true,
                        minlength: 3
                    },
                    salon_type: {
                        required: true
                    },
                    billing_counter: {
                        required: true
                    },
                    salon_owner_name: {
                        required: true,
                        minlength: 3
                    },
                    no_of_people: {
                        required: true,
                        number: true,
                        min: 1
                    },
                    no_of_chairs: {
                        required: true,
                        number: true,
                        min: 1
                    },
                    rate_haircut: {
                        required: true,
                    },
                    rate_beard: {
                        required: true,
                    },
                    rate_wax: {
                        required: true,
                    },
                    rate_eyebrows: {
                        required: true,
                    },
                },
                messages: {
                    salon_type: {
                        required: "Please select a salon type"
                    },
                    billing_counter: {
                        required: "Please select a billing counter option"
                    },
                    receptionist_available: {
                        required: "Please select if receptionist is available"
                    },
                    salon_name: {
                        required: "Please enter salon name",
                        minlength: "Salon name must be at least 3 characters long"
                    },
                    salon_owner_name: {
                        required: "Please enter salon owner name",
                        minlength: "Salon owner name must be at least 3 characters long"
                    },
                    no_of_people: {
                        required: "Please enter number of people working here",
                        number: "Please enter a valid number",
                        min: "Number of people must be at least 1"
                    },
                    no_of_chairs: {
                        required: "Please enter number of salon chairs",
                        number: "Please enter a valid number",
                        min: "Number of people must be at least 1"
                    },
                    rate_haircut: {
                        required: "Please enter haircut rate",
                    },
                    rate_beard: {
                        required: "Please enter beard rate",
                    },

                    rate_wax: {
                        required: "Please enter wax rate",
                    },

                    rate_eyebrows: {
                        required: "Please enter eyebrows rate",
                    },
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });

            $('#billing_counter').on('change', function() {
                $('#billing_counter').valid();
            });
            $('#receptionist_available').on('change', function() {
                $('#receptionist_available').valid();
            });
            $('#salon_type').on('change', function() {
                $('#salon_type').valid();
            });

            $("#other_info_form").validate({
                ignore: ":hidden:not(select)",
                rules: {
                    state: {
                        required: true
                    },
                    city: {
                        required: true
                    },
                    location: {
                        required: true
                    },
                    area: {
                        required: true
                    },
                    service_provide_type: {
                        required: true
                    },
                    salon_address: {
                        required: true,
                    },
                    street_name: {
                        required: true,
                    },
                    locality: {
                        required: true,
                    },
                    salon_owner_contact: {
                        required: true,
                        number: true,
                        minlength: 10,
                        maxlength: 10
                    },
                    salon_owner_free_on: {
                        required: true,
                        minlength: 3
                    },
                    salon_owner_selfie: {
                        required: {
                            depends: function(element) {
                                return $("#old_salon_owner_selfie").val() == "";
                            }
                        }
                    },
                    pincode:{
                        required: true,
                        maxlength:6,
                        minlength:6,
                    },
                    lead:{
                        required: true,
                    },
                },
                messages: {
                    location: {
                        required: "Please select location"
                    },
                    area: {
                        required: "Please enter area"
                    },
                    state: {
                        required: "Please select state"
                    },
                    city: {
                        required: "Please select city"
                    },
                    service_provide_type: {
                        required: "Please select a service provide type"
                    },
                    salon_address: {
                        required: "Please select salon address",
                    },
                    street_name: {
                        required: "Please enter salon street",
                    },
                    locality: {
                        required: "Please enter salon locality",
                    },
                    salon_owner_contact: {
                        required: "Please enter salon owner contact number",
                        number: "Please enter a valid contact number",
                        minlength: "Contact number must be at least 10 digits",
                        maxlength: "Contact number cannot exceed 10 digits"
                    },
                    salon_owner_free_on: {
                        required: "Please enter salon owner free day",
                        minlength: "Free day must be at least 3 characters long"
                    },                  
                    salon_owner_selfie: {
                        required: "Please upload salon board selfie"
                    },
                    celebrities: {

                    },
                    pincode:{
                        required: "Please enter pincode",
                        maxlength:"Please enter 6 digit pincode",
                        minlength:"Please enter 6 digit pincode",
                    },
                    lead:{
                        required: "Please select lead",
                    },
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });

            $('#service_provide_type').on('change', function() {
                $('#service_provide_type').valid();
            });
            $('#state').on('change', function() {
                $('#state').valid();
            });
            $('#city_name').on('change', function() {
                $('#city_name').valid();
            });
            $('#location').on('change', function() {
                $('#location').valid();
            });


            $('#lead').on('change', function() {
                $('#lead').valid();
            });

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                alert("Geolocation is not supported by this browser.");
            }

            $('#get_location').click(function() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition, showError);
                } else {
                    alert("Geolocation is not supported by this browser.");
                }
            });

            $('#populate_dropdown').click(function() {
                if ($('#address_dropdown option').length === 1) { // Check if the dropdown is not already populated
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(showPosition, showError);
                    } else {
                        alert("Geolocation is not supported by this browser.");
                    }
                }
            });

            function showPosition(position) {
                var lat = position.coords.latitude;
                var lng = position.coords.longitude;

                // Initialize the Geocoder
                var geocoder = new google.maps.Geocoder();

                // Create LatLng object
                var latlng = new google.maps.LatLng(lat, lng);

                // Geocode the LatLng object
                geocoder.geocode({'location': latlng}, function(results, status) {
                    if (status === google.maps.GeocoderStatus.OK) {
                        if (results.length > 0) {
                            // Clear existing options and update Chosen
                            $('#address_dropdown').empty().append('<option value="">Select Salon Address</option>');

                            // Populate dropdown with results
                            results.forEach(function(result, index) {
                                var addressComponents = result.address_components;
                                var streetNumber = '';
                                var streetName = '';
                                var locality = '';
                                var pincode = '';
                                var city = '';
                                var state = '';

                                // console.log(addressComponents)
                                addressComponents.forEach(function(component) {
                                    if (component.types.includes('route') || component.types.includes("sublocality")) {
                                        streetName = component.long_name;
                                    }
                                    if (component.types.includes("sublocality_level_1") || component.types.includes("sublocality") || component.types.includes('locality')) {
                                        locality = component.long_name;
                                    }
                                    if (component.types.includes('postal_code')) {
                                        pincode = component.long_name;
                                    }
                                    if (component.types.includes("administrative_area_level_3")) {
                                        city = component.long_name;
                                    }
                                    if (component.types.includes("administrative_area_level_1")) {
                                        state = component.long_name;
                                    }
                                });

                                // Add option to dropdown
                                $('#address_dropdown').append(
                                    `<option value="${result.formatted_address}" data-state="${state}" data-city="${city}" data-lat="${lat}" data-lng="${lng}" data-street="${streetName}" data-locality="${locality}" data-pincode="${pincode}">
                                        ${result.formatted_address}
                                    </option>`
                                );
                            });

                            // Update Chosen dropdown
                            $('#address_dropdown').chosen('destroy').chosen();
                            
                            // Handle dropdown selection
                            $('#address_dropdown').change(function() {
                                var selectedOption = $(this).find('option:selected');
                                
                                if(selectedOption.val() != ""){
                                    // Get values from selected option
                                    var salonAddress = selectedOption.val();
                                    var streetName = selectedOption.data('street');
                                    var locality = selectedOption.data('locality');
                                    var pincode = selectedOption.data('pincode');
                                    var lat = selectedOption.data('lat');
                                    var lng = selectedOption.data('lng');
                                    var city = selectedOption.data('city');
                                    var state = selectedOption.data('state');
                                    
                                    // Set values to input fields
                                    $('#salon_address').val(salonAddress);
                                    $('#street_name').val(streetName);
                                    $('#area').val(locality);
                                    $('#pincode').val(pincode);
                                    $('#latitude').val(lat);
                                    $('#longitude').val(lng);
                                    
                                    // Make input fields read-only if any value is present, else set them as editable
                                    $('#street_name').prop('readonly', streetName !== '');
                                    $('#area').prop('readonly', locality !== '');
                                    $('#pincode').prop('readonly', pincode !== '');
                                    $('#latitude').prop('readonly', lat !== '');
                                    $('#longitude').prop('readonly', lng !== '');
                                    findCity(city,state);
                                }else{
                                    $('#street_name').val('').prop('readonly', false);
                                    $('#area').val('').prop('readonly', false);
                                    $('#pincode').val('').prop('readonly', false);
                                    $('#latitude').val('').prop('readonly', false);
                                    $('#longitude').val('').prop('readonly', false);
                                    findCity('','');
                                }
                            });
                        } else {
                            alert('No results found');
                        }
                    } else {
                        alert('Geocoder failed due to: ' + status);
                    }
                });
            }

            function showError(error) {
                switch (error.code) {
                    case error.PERMISSION_DENIED:
                        alert("User denied the request for Geolocation.");
                        break;
                    case error.POSITION_UNAVAILABLE:
                        alert("Location information is unavailable.");
                        break;
                    case error.TIMEOUT:
                        alert("The request to get user location timed out.");
                        break;
                    case error.UNKNOWN_ERROR:
                        alert("An unknown error occurred.");
                        break;
                }
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

                    var selectedCityId = $('#city_name').data('selected-city-id');
                    if (selectedCityId) {
                        $('#city_name').val(selectedCityId).trigger('chosen:updated').trigger('change');
                    }                    
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });
        function findCity(term, state_term){
            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>admin/Ajax_controller/get_selected_city_ajax",
                data: {
                    'term': term, 'state_term': state_term
                },
                success: function(data) {
                    var opts = $.parseJSON(data);
                    // console.log(opts);
                    if (opts.id) {
                        $('#city_name').data('selected-city-id', opts.id);
                    }
                    if (opts.state_id) {
                        $('#state').val(opts.state_id).trigger('chosen:updated').trigger('change');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }

        $("#city_name").change(function() {
            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>admin/Ajax_controller/get_city_location_ajax",
                data: {
                    'city_name': $("#city_name").val()
                },
                success: function(data) {
                    $("#location").empty();
                    $('#location').append('<option value="">Select Location</option>');
                    var opts = $.parseJSON(data);
                    $.each(opts, function(i, d) {
                        $('#location').append('<option value="' + d.id + '">' + d.name + '</option>');
                    });
                    $('#location').trigger('chosen:updated');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });
        var i=0;
        
        function updateAddButtonText() {
            const rowsCount = $('#add_more_div .row').length;
            const button = $('#add_service_rate');
            const add_more_div = $('#add_more_button_div');
            
            if (rowsCount > 0) {
                button.text('Add More');
                add_more_div.css('text-align','right');
            } else {
                button.text('Add Service Rate');
                add_more_div.css('text-align','center');
            }
        }

        function fetchServices(index){
            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>admin/Ajax_controller/get_services_ajax",
                data: {
                    'salon_type': $("#salon_type").val()
                },
                success: function(data) {
                    $("#service_" + index).empty();
                    $("#service_" + index).append('<option value="">Select Service</option>');
                    var opts = $.parseJSON(data);
                    $.each(opts, function(i, d) {
                        $("#service_" + index).append('<option value="' + d.id + '">' + d.service_name + ' [' + d.service_name_marathi + ']</option>');
                    });
                    $("#service_" + index).chosen({
                        width: '100%'
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }
        function createAddMoreFields(){
            if($("#salon_type").val() != ""){
                $('#salon_type-error').html('').hide();
                let appedData = `<div class="row">
                                    <input type="hidden" value="${i}" name="indices[]">
                                    <div class="form-group col-lg-5">
                                        <label>Service <b class="require">*</b></label>
                                        <select class="form-control chosen-select service" name="service_${i}" id="service_${i}">
                                            <option value="">Select Service</option>
                                        </select>  
                                        <label id="service_${i}-error" class="error" style="display:none;" for="service_${i}">Please select service</label>                       
                                    </div>
                                    <div class="form-group col-lg-5">
                                        <label>Rate <b class="require">*</b> <small>(In INR)</small></label>
                                        <input type="text" placeholder="Enter Rate" name="rate_${i}" id="rate_${i}" class="form-control rate">
                                    </div>
                                    <div class="form-group col-lg-2 "  style="margin-top:25px;">
                                        <button onclick="removeRow(this)" class="btn btn-danger"><i class="fa fa-trash" style="color:white;" aria-hidden="true"></i></button>
                                    </div>
                                </div>`;
                $('#add_more_div').append(appedData);
                $('.chosen-select').trigger('updated');
                fetchServices(i);
                i++;
                initializeValidationForFields();
                updateAddButtonText();
            }else{
                $('#salon_service_type-error').html('Please select the salon type first').show();
            }
        }
        function removeRow(arg) {
            $(arg).parent().parent().remove();
        }   
        function initializeValidationForFields() {
            $(".service").each(function () {
                $(this).rules("add", {            
                    required: true,         
                    messages: {
                        required: "Please select service",
                    },
                });
            });

            $(".rate").each(function () {
                $(this).rules("add", {  
                    required: true,
                    number: true,
                    min: 0,
                    messages: {
                        required: "Please enter rate",
                        number: "Only numbers allowed",
                        min: "Minimum value 0 is allowed",
                    },
                });
            });
        }
        
        function clearError(){
            $('#salon_service_type-error').html('').hide();
        }
</script>

<script>   
    function updateTable() {
        var salonType = document.getElementById('salon_type').value;
        
        document.getElementById('table_head').style.display = 'none';
        document.getElementById('row_haircut').style.display = 'none';
        document.getElementById('row_beard').style.display = 'none';
        document.getElementById('row_wax').style.display = 'none';
        document.getElementById('row_eyebrows').style.display = 'none';
        
        // Show rows based on salon type
        if(salonType == '0') { // Male
        document.getElementById('table_head').style.display = '';
            document.getElementById('row_haircut').style.display = '';
            document.getElementById('row_beard').style.display = '';
        } else if (salonType == '1') { // Female
        document.getElementById('table_head').style.display = '';
            document.getElementById('row_wax').style.display = '';
            document.getElementById('row_eyebrows').style.display = '';
        } else if (salonType == '2') { // Unisex
        document.getElementById('table_head').style.display = '';
            document.getElementById('row_haircut').style.display = '';
            document.getElementById('row_eyebrows').style.display = '';
        }
    }

    document.getElementById('salon_type').addEventListener('change', updateTable);












    
    $(".nav-link").click(function() {
        $(".nav-link").removeClass("active");
        $(this).addClass("active");
    });

    $("#nav-basic-ids").click(function(){
        $("#nav-basic-tab").addClass('active');
    }); 

    window.onload = function() {
        updateTable();
        setWebCam();
    };

    function setWebCam(){
        navigator.mediaDevices.enumerateDevices().then(devices => {
            const hasWebcam = devices.some(device => device.kind === 'videoinput');

            if (!hasWebcam) {
                console.log('No webcam detected');
                $('#webcam_empty_div').show();
                return;
            }

            $('#webcam_div').show();
            $('#webcam_empty_div').hide();
            
            Webcam.set({
                width: 295,
                height: 250,
                image_format: 'jpeg',
                jpeg_quality: 90
            });

            const cameraElement = document.querySelector('#my_camera');
            
            if (!cameraElement) {
                console.error('Camera element not found');
                return;
            }

            console.log('Attaching webcam to the element');
            
            Webcam.attach(cameraElement);
        }).catch(error => {
            console.error('Error enumerating devices:', error);
        });		
    }
    function take_snapshot() {
		Webcam.snap( function(data_uri) {
			$(".image-tag").val(data_uri);
		});
		Webcam.freeze();
		$('.unfreez_photo').show();
		$('.take_photo').hide();
	}
	function unfreez_snapshot(){
		$(".image-tag").val('');
		Webcam.unfreeze();
		$('.unfreez_photo').hide();
		$('.take_photo').show();
	}
    </script>

</html>