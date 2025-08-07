<?php
// echo "<pre>";print_r($single);exit;
include('header.php'); ?>
<style type="text/css">
    .error {
        color: red;
        float: left;
        /*    position: absolute;*/
    }
    .chosen-container{
        width: 100% !important;
    }
    .page-title .title_left h3 {
    margin: 10px 0px;
    color: #323232;
    font-weight: 700;
    font-size: 20px;
    /* display: none; */
}
    input[type="file"] {
        height: 50px;
    }

    #viewButtonsContainer a {

        margin-left: 30px;
    }
	<?php if(!empty($single) && $single->subscription_id != "" && $single->subscription_id != "0"){ ?>
	#subscription_chosen {
		background-color: #e9ecef;
		pointer-events: none;
		cursor: not-allowed;
	}
	<?php } ?>
	<?php if(!empty($single) && !empty($self_branch) && $self_branch->referred_by != ""){ ?>
        #branch_referred_by_chosen {
            background-color: #e9ecef;
            pointer-events: none;
            cursor: not-allowed;
        }
	<?php } ?>
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Add Salon
                </h3>
            </div>

        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="x_panel">
                <div class="x_content">
                    <div class="container">
                        <form method="post" name="customer_form" id="customer_form" enctype="multipart/form-data">                    
                            <div id="step1" class="form-step">
                                <div class="row">
                                    <!-- <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Referred By</label>
                                            <select <?php if(!empty($single) && $single->referred_by != ""){ echo 'readonly'; } ?> class="form-select chosen-select form-control" name="referred_by" id="referred_by">
                                                <option value="">Select Referred By Salon</option>
                                                <?php if(!empty($salons)){ foreach($salons as $branches_result){ ?>
                                                    <option value="<?=$branches_result->id;?>" <?php if(!empty($single) && $single->referred_by == $branches_result->id){ echo 'selected'; }?>><?=$branches_result->salon_name;?></option>
                                                <?php }} ?>
                                            </select>
                                        </div>
                                    </div> -->
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Salon Name <b class="require">*</b></label>
                                            <input autocomplete="off" required type="text" class="form-control" name="salon_name" id="salon_name" value="<?php if (!empty($single)) {
                                                echo $single->salon_name;
                                            } ?>" placeholder="Enter salon name">
                                            <input autocomplete="off" type="hidden" name="id" id="id" value="<?php if (!empty($single)) {
                                                echo $single->id;
                                            } ?>">
                                            <label style="display: none;" id="salon_name-error" class="error col-md-12"
                                                for="salon_name"></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Salon Owner Name <b class="require">*</b></label>
                                            <input autocomplete="off" required type="text" class="form-control" name="salon_owner_name"
                                                id="salon_owner_name" value="<?php if (!empty($single)) {
                                                    echo $single->salon_owner_name;
                                                } ?>" placeholder="Enter salon owner name">
                                            <label style="display: none;" id="salon_owner_name-error" class="error col-md-12"
                                                for="salon_owner_name"></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Salon Owner Number <b class="require">*</b></label>
                                            <input autocomplete="off" required type="text" class="form-control" name="salon_owner_number"
                                                id="salon_owner_number" value="<?php if (!empty($single)) {
                                                    echo $single->salon_owner_number;
                                                } ?>" placeholder="Enter salon owner number">
                                            <label style="display: none; color:red" id="salon_owner_number-error2" class=""
                                                for="salon_owner_number"></label>
                                        </div>
                                    </div>
                              
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Email <b class="require">*</b></label>
                                            <input autocomplete="off" required type="text" class="form-control" name="email" id="email" value="<?php if (!empty($single)) {
                                                echo $single->email;
                                            } ?>" placeholder="Enter salon email">
                                            <label style="display: none; color:red" id="salon_owner_email-error2" class=""
                                                for="email"></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Is GST Applicable? <b class="require">*</b></label>
                                            <select class="form-control chosen-select" required name="is_gst_applicable" id="is_gst_applicable">
                                                <option value="">Select Option</option>
                                                <option value="0" <?php if (!empty($single) && $single->is_gst_applicable == "0") {
                                                                        echo 'selected';
                                                                    } ?>>No</option>
                                                <option value="1" <?php if (!empty($single) && $single->is_gst_applicable == "1") {
                                                                        echo 'selected';
                                                                    } ?>>Yes</option>
                                            </select>
                                            <label id="is_gst_applicable-error"  class="error" style="display:block;" for="is_gst_applicable"></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="fullname" id="gst_no_label">GST No.</label>
                                            <input readonly placeholder="Enter GST No" type="text" name="gst_no" id="gst_no" class="form-control" value="<?php if (!empty($single)) {
                                                                                                                                                                echo $single->gst_no;
                                                                                                                                                            } ?>">
                                        </div>
                                    </div>
                               
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label >Aadhaar Number</label>
                                            <input maxlength="12" autocomplete="off" type="text" class="form-control" name="aadhar_number" id="aadhar_number"
                                                value="<?php if (!empty($single)) {
                                                    echo $single->aadhar_number;
                                                } ?>" placeholder="Enter salon owner Aadhaar number">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Upload Aadhaar Front Side 
                                            <?php if (!empty($single && $single->aadhar_front != "")) { ?>
                                                <a style="color: blue; float: right; margin-left: 40px;" target="_blank" href="<?= base_url(); ?>admin_assets/images/owner_aadhar/<?= $single->aadhar_front ?>">View</a> 
                                            <?php } ?>                                   
                                            </label>
                                            <input type="hidden" name="old_aadhar_front" id="old_aadhar_front" value="<?php if (!empty($single)) {
                                                echo $single->aadhar_front;
                                            } ?>">
                                            <input autocomplete="off" type="file" accept=".png, .jpg, .jpeg, .pdf" class="form-control"
                                                name="aadhar_front" id="aadhar_front" value="<?php if (!empty($single)) {
                                                    echo $single->aadhar_front;
                                                } ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Upload Aadhaar Back Side
                                            <?php if(!empty($single && $single->aadhar_back != "")){ ?>
                                                <a style="color: blue;float: right;margin-left:40px;" target="_blank" href="<?= base_url(); ?>admin_assets/images/owner_aadhar/<?=$single->aadhar_back ?>">View</a> 
                                            <?php } ?>        
                                            </label>
                                            <input type="hidden" name="old_aadhar_back" id="old_aadhar_back" value="<?php if (!empty($single)) {
                                                echo $single->aadhar_back;
                                            } ?>">
                                            <input autocomplete="off" type="file" accept=".png, .jpg, .jpeg, .pdf" class="form-control"
                                                name="aadhar_back" id="aadhar_back" value="<?php if (!empty($single)) {
                                                    echo $single->aadhar_back;
                                                } ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="display:none">
                                        <div class="form-group">
                                            <label>Upload Salon Photo <b class="require">*</b></label>
                                            <input type="hidden" name="old_salon_photo" id="old_salon_photo" value="<?php if (!empty($single)) {
                                                echo $single->salon_photo;
                                            } ?>">
                                            <input autocomplete="off" type="file" accept=".png, .jpg, .jpeg" class="form-control"
                                                name="salon_photo" id="salon_photo" value="<?php if (!empty($single)) {
                                                    echo $single->salon_photo;
                                                } ?>" multiple>
                                            <label style="display: none;" id="salon_photo-error" class="error col-md-12"
                                                for="salon_photo"></label>
                                        </div>
                                    </div>
                              
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Payment Gateway <b class="require">*</b></label>
                                            <select class="form-control chosen-select" name="is_payment_gateway" id="is_payment_gateway" onchange="setValidation()">
                                                <option value="1" <?php if (!empty($single) && $single->is_payment_gateway == "1") {
                                                                        echo 'selected';
                                                                    } ?>>Yes</option>
                                                <option value="0" <?php if (!empty($single) && $single->is_payment_gateway == "0") {
                                                                        echo 'selected';
                                                                    } ?>>No</option>
                                            </select>
                                        </div>
                                    </div> 
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label>PAN Card Copy <b id="pan_card_label"></b>
                                            <?php if (!empty($single && $single->pancard_copy != "")) { ?>
                                                <a style="color: blue; float: right; margin-left: 40px;" target="_blank" href="<?= base_url(); ?>admin_assets/images/owner_aadhar/<?= $single->pancard_copy ?>">View</a> 
                                            <?php } ?>                                   
                                            </label>
                                            <input type="hidden" name="old_pancard_copy" id="old_pancard_copy" value="<?php if (!empty($single)) {
                                                echo $single->pancard_copy;
                                            } ?>">
                                            <input autocomplete="off" type="file" accept=".png, .jpg, .jpeg, .pdf" class="form-control"
                                                name="pancard_copy" id="pancard_copy" value="<?php if (!empty($single)) {
                                                    echo $single->pancard_copy;
                                                } ?>">
                                        </div>
                                    </div>
                                    <input type="hidden" name="is_unique_salon_owner_number" id="is_unique_salon_owner_number" value="">
                                    <input type="hidden" name="is_unique_salon_owner_email" id="is_unique_salon_owner_email" value="">
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Does Salon have Branch? <b class="require">*</b></label>
                                            <select class="form-control" <?php if(!empty($single)){ echo 'disabled'; } ?> required name="is_branch_available" id="is_branch_available">
                                                <option value="">Select Option</option>
                                                <option value="0" <?php if (!empty($single) && $single->is_branch_available == "0") {
                                                                        echo 'selected';
                                                                    } ?>>No</option>
                                                <option value="1" <?php if (!empty($single) && $single->is_branch_available == "1") {
                                                                        echo 'selected';
                                                                    } ?>>Yes</option>
                                            </select>
                                            <label id="is_branch_available-error" style="display:block;" class="error" for="is_branch_available"></label>
                                        </div>
                                    </div>
                                    <input type="hidden" name="old_is_branch_available" id="old_is_branch_available" value="<?php if (!empty($single)) {echo $single->is_branch_available;} ?>">                               
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="button" id="next_to_step2" class="btn btn-primary" style="display: none;">Next</button>
                                        <button type="submit" id="submit_button_step1" class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </div>
                            <div id="step2" class="form-step single_branch_details_div" style="display: none;">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <hr>
                                        <h3 style="color: black; font-weight: bold;">Branch Details</h3>
                                        <hr>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Email <b class="require">*</b></label>
                                            <input autocomplete="off" type="text" class="form-control" name="branch_email" id="branch_email" value="<?php if (!empty($single) && !empty($self_branch)) { echo $self_branch->email; } ?>" placeholder="Enter branch email">
                                        </div>
                                    </div> -->
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Password <b class="require">*</b></label>
                                            <input autocomplete="off" type="text" class="form-control" name="password" id="password" value="<?php if (!empty($single) && !empty($self_branch)) {echo $self_branch->password; } ?>" placeholder="Enter salon password">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Salon Address <b class="require">*</b></label>
                                            <input autocomplete="off" type="text" class="form-control" name="salon_address" id="salon_address" value="<?php if (!empty($single) && !empty($self_branch)) {echo $self_branch->salon_address; } ?>" placeholder="Enter address">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Pin Code <b class="require">*</b></label>
                                            <input autocomplete="off" type="text" class="form-control" name="pincode" id="pincode" value="<?php if (!empty($single) && !empty($self_branch)) {echo $self_branch->pincode;} ?>" placeholder="Enter pincode">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label>State<b class="require">*</b></label>
                                            <select class="form-control form-select chosen-select" name="state" id="state">
                                                <option value="" class="">Select State</option>
                                                <?php 
                                                $state = $this->Admin_model->get_state_list();
                                                if (!empty($state)) {
                                                    foreach ($state as $state_result) { ?>
                                                        <option value="<?= $state_result->id ?>" <?php if (!empty($single) && !empty($self_branch) && $self_branch->state == $state_result->id) { ?>selected="selected" <?php } ?>>
                                                            <?= $state_result->name ?>
                                                        </option>
                                                <?php }
                                                } ?>
                                            </select>
                                            <label id="state-error" style="display:block;" class="error" for="state"></label>
                                        </div> 
                                        <?php
                                        $city = array();
                                        $payment_options = [];
                                        if (!empty($single) && !empty($self_branch)) {
                                            $city = $this->Admin_model->get_selected_state_city($self_branch->state);
                                            $payment_options = $self_branch->payment_options != "" ? explode(',',$self_branch->payment_options) : [];
                                        }
                                        ?>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Select City<b class="require">*</b></label>
                                            <div>
                                                <select class="form-control form-select chosen-select" name="city" id="city_name">
                                                    <option value="">Select City</option>
                                                    <?php if (!empty($city)) {
                                                        foreach ($city as $city_result) { ?>
                                                            <option value="<?= $city_result->id ?>" <?php if (!empty($single) && !empty($self_branch) && $self_branch->city == $city_result->id) { ?>selected="selected" <?php } ?>>
                                                                <?= $city_result->name ?>
                                                            </option>
                                                    <?php }
                                                    } ?>
                                                </select>
                                                <label id="city_name-error" style="display:block;" class="error" for="city_name"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Upload Shopact <b class="require">*</b>
                                                    <?php if(!empty($single) && !empty($self_branch) && $self_branch->shopact != ""){ ?>
                                                        <a target="_blank" href="<?=base_url();?>admin_assets/images/shopact-image/<?=$self_branch->shopact;?>" style="text-decoration:underline;"> View</a>
                                                    <?php } ?>
                                            </label>
                                            <input autocomplete="off" type="file" class="form-control" name="shopact" id="shopact">
                                            <input type="hidden" class="form-control" name="old_shopact" id="old_shopact" value="<?php if (!empty($single) && !empty($self_branch)) {echo $self_branch->shopact;} ?>">
                                            <input type="hidden" class="form-control" name="hidden_self_branch_id" id="hidden_self_branch_id" value="<?php if (!empty($single) && !empty($self_branch)) {echo $self_branch->id;} ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"> 
                                        <div class="form-group">
                                            <label>Payment Option<b class="require">*</b></label><br> 
                                            <select class="form-control form-select chosen-select" name="payment_options[]" id="payment_options" multiple>
                                                <option value="UPI" <?php if (!empty($single) && !empty($self_branch) && in_array('UPI',$payment_options)) {
                                                                        echo 'selected';
                                                                    } ?>>UPI</option>
                                                <option value="Net Banking" <?php if (!empty($single) && !empty($self_branch) && in_array('Net Banking',$payment_options)) {
                                                                        echo 'selected';
                                                                    } ?>>Net Banking</option>
                                                <option value="Cash" <?php if (!empty($single) && !empty($self_branch) && in_array('Cash',$payment_options)) {
                                                                        echo 'selected';
                                                                    } ?>>Cash</option>
                                            </select>
                                            <label id="payment_options-error" style="display:block;" class="error" for="payment_options"></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"> 
                                        <div class="form-group">
                                            <label>Salon Category<b class="require">*</b></label><br> 
                                            <input autocomplete="off" type="radio" id="male" class="category" name="category" value="0" <?= ($single && !empty($self_branch) && $self_branch->category == '0') ? 'checked' : ''; ?>>
                                            <label for="male">Male</label>&nbsp&nbsp 
                                            <input autocomplete="off" type="radio" id="female" class="category" name="category" value="1" <?= ($single && !empty($self_branch) && $self_branch->category == '1') ? 'checked' : ''; ?>>
                                            <label for="female">Female</label>&nbsp&nbsp 
                                            <input autocomplete="off" type="radio" id="unisex" class="category" name="category" value="2" <?= ($single && !empty($self_branch) && $self_branch->category == '2') ? 'checked' : ''; ?>>
                                            <label for="unisex">Unisex</label>                                       
                                        </div>
                                        <label id="category-error" class="error" style="display:none;" for="category"></label>  
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Subscription<b class="require">*</b></label>
                                            <select <?php if(!empty($single) && !empty($self_branch) && $self_branch->subscription_id != "" && $self_branch->subscription_id != "0"){ echo 'readonly'; } ?> class="form-select chosen-select form-control" name="subscription" id="subscription">
                                                <option value="">Select Subscription</option>
                                            </select>
                                            <label id="subscription-error" style="display:none;" class="error" for="subscription">Please select subscription!</label>                                        
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <input type="hidden" name="old_subscription" id="old_subscription" value="<?php if (!empty($single) && !empty($self_branch)) {echo $self_branch->subscription_id;} ?>">
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Referred By</label>
                                            <select <?php if(!empty($single) && !empty($self_branch) && $self_branch->referred_by != ""){ echo 'readonly'; } ?> class="form-select chosen-select form-control" name="branch_referred_by" id="branch_referred_by">
                                                <option value="">Select Referred By Branch</option>
                                                <?php 
                                                $branches = $this->Admin_model->get_all_salon_branch_list();
                                                if(!empty($branches)){ foreach($branches as $branches_result){ ?>
                                                    <option value="<?=$branches_result->id;?>" <?php if(!empty($single) && !empty($self_branch) && $self_branch->referred_by == $branches_result->id){ echo 'selected'; }?>><?=$branches_result->branch_name;?>, <?=$branches_result->salon_name;?></option>
                                                <?php }} ?>
                                            </select>
                                        </div>
                                    </div>
                                    <input type="hidden" name="old_branch_referred_by" id="old_branch_referred_by" value="<?php if (!empty($single) && !empty($self_branch)) {echo $self_branch->referred_by;} ?>">
                                </div>
                                <!-- <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"> 
                                        <div class="form-group">
                                            <input type="checkbox" name="agree_terms" value="Yes">
                                            <label>Agree Terms & Conditions <a target="_blank" href="<?=base_url();?>terms" style="text-decoration:underline;"><small>View</small></a> <b class="require">*</b></label>
                                        </div>
                                        <label id="agree_terms-error" class="error" for="agree_terms" style="display:none;">Please accept terms & conditions</label>
                                    </div>
                                </div> -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="button" id="back_to_step1" class="btn btn-secondary">Back</button>
                                        <button type="submit" id="submit_button_step2" class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form> <!------------end of form---->
                    </div> <!----------end of container-------->

                </div>
            </div>
        </div>

    </div>

</div>

<?php include('footer.php');
$edit_id = 0;
if ($this->uri->segment(2) != "") {
    $edit_id = $this->uri->segment(2);
}
?>
<script>
    function setValidation(){
        if($('#is_payment_gateway').val() == '1'){
            $('#pan_card_label').addClass('require').text('*');
        }else{
            $('#pan_card_label').removeClass('require').text('');
        }
    }
    var id = '<?php echo $edit_id; ?>';
    $(document).ready(function () { 
        setValidation();
        fetchSubscriptions();
        $(".chosen-select").chosen({});
        jQuery.validator.addMethod("gstFormat", function(value, element) {
            return this.optional(element) || /^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[A-Z0-9]{1}[Z]{1}[A-Z0-9]{1}$/.test(value);
        }, "Please enter a valid GST number in the correct format (e.g., 22AAAAA0000A1Z5).");
        $.validator.addMethod("alphanumeric", function(value, element) {
            return this.optional(element) || /^[a-zA-Z0-9]+$/.test(value);
        }, "Only letters and numbers are allowed (no special characters).");
        $('#customer_form').validate({
            ignore:[],
            rules: {
                is_branch_available: 'required',
                is_gst_applicable: 'required',
                gst_no: {
                    required: function(element) {
                        return $('#is_gst_applicable').val() === '1';
                    },
                    maxlength: 15,
                    minlength: 15,
                    alphanumeric: true,
                    gstFormat: true,
                },
                pancard_copy: {
                    required: function(element) {
                        return ($('#is_payment_gateway').val() === '1' && $('#old_pancard_copy').val() == '');
                    },
                },
                salon_name: 'required',
                salon_owner_name: 'required',
                salon_owner_number:{
                    required: true,
                    minlength: 10, 
                    maxlength: 10,
                    number: true,
                },
                email: {                    
                    required: true, 
                    email:true,
                },
                aadhar_number:{
                    number: true,
                    minlength: 12, 
                    maxlength: 12,
                },
                shopact: {
                    required: function(element) {
                        return $('#old_shopact').val() == '' && $('#is_branch_available').val() == '0';
                    },
				},
                salon_address: {
                    required: function(element) {
                        return $('#is_branch_available').val() == '0';
                    },
				},
                password: {
                    required: function(element) {
                        return $('#is_branch_available').val() == '0';
                    },
				},
                //branch_email: {         
                //    required: function(element) {
                //        return $('#is_branch_available').val() == '0';
                //    },
                //    email:true,
                //},
                agree_terms: {
                    required: function(element) {
                        return $('#is_branch_available').val() == '0';
                    },
				},
                category: {
                    required: function(element) {
                        return $('#is_branch_available').val() == '0';
                    },
				},
                state: {
                    required: function(element) {
                        return $('#is_branch_available').val() == '0';
                    },
				},
                city: {
                    required: function(element) {
                        return $('#is_branch_available').val() == '0';
                    },
				},
                subscription: {
                    required: function(element) {
                        return $('#is_branch_available').val() == '0';
                    },
				},
                'payment_options[]': {
                    required: function(element) {
                        return $('#is_branch_available').val() == '0';
                    },
				},
                pincode: {       
                    required: function(element) {
                        return $('#is_branch_available').val() == '0';
                    },                
                    number:true,
                    maxlength: 6,
                    minlength: 6,
                },
            },
            messages: {
                agree_terms: 'Please accept terms & conditions',
                is_branch_available: 'Please select option',
                is_gst_applicable: 'Please select option',
                gst_no:{
                    required: "Please enter GST No.",
                    maxlength: "Please enter max 15 digits",
                    minlength: "Please enter min 15 digits",
                    alphanumeric: "Please enter valid GST no",
                    gstFormat: "Please enter valid GST no(e.g. 22AAAAA0000A1Z5)",
                },
                pancard_copy: 'Please upload PAN card copy!',
                salon_name: 'Please enter salon name!',
                salon_owner_name: 'Please enter salon owner name!',
                salon_owner_number:{
                    required: "Please enter contact number!",
                    number: "Please enter number!",
                    minlength: "Enter valid contact number!", 
                    maxlength: "Length of contact number is too large!",
                },
                email: {
                    required: "Please enter email!", 
                    email: "Please enter valid email!",
                },
                aadhar_number:{
                    number: "Please enter number only!",
                    minlength: "Minimum 12 digits are required!", 
                    maxlength: "Maximum 12 digits are required!",
                },
                shopact: 'Please upload salon shopact file!',
                salon_address: 'Please enter salon address!',
                password: 'Please enter password!',
                category: 'Please select salon category!',
                state: 'Please select state!',
                city: 'Please select city!',
                subscription: 'Please select subscription!',
                'payment_options[]': 'Please select atleast one payment option!',
				pincode: {
                    required: "Please enter pincode!", 
					number: "Please enter numbers only!",
					maxlength: "Please enter valid pincode!",
					minlength: "Please enter valid pincode!",
				},
                //branch_email: {
                //    required: "Please enter email!", 
                //    email: "Please enter valid email!",
                //}
            },
            errorPlacement: function (error, element) {
                error.insertAfter(element);
            },
            submitHandler: function(form) {
                document.getElementById('submit_button').remove();
                form.submit();
            }
        });
    });
</script>
<script>
    $('#gst_no').on('input', function() {
        $(this).val($(this).val().toUpperCase());
    });
    $("#is_gst_applicable").change(function() {
        if($("#is_gst_applicable").val() == '1'){
            $('#gst_no').attr('readonly',false);
            $('#gst_no_label').html('GST No. <b class="require">*</b>');
        }else{
            $('#gst_no').attr('readonly',true).val('');
            $('#gst_no_label').html('GST No.');
        }
    });
    $("#salon_owner_number").keyup(function() {
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>admin/Ajax_controller/check_unique_salon_number_ajx",
            data: {
                'salon_owner_number': $("#salon_owner_number").val(),
                'id': id
            },
            success: function(data) {
                if(data > 0){
                    $('#salon_owner_number-error2').show();
                    $('#is_unique_salon_owner_number').val('0');
                    $('#salon_owner_number-error2').html('This mobile number already exist');
                }else{
                    $('#salon_owner_number-error2').hide();
                    $('#salon_owner_number-error2').html('');
                    $('#is_unique_salon_owner_number').val('1');
                }
                setSubmitButton();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });
    function setSubmitButton(){
        var is_unique_salon_owner_number = $('#is_unique_salon_owner_number').val();
        var is_unique_salon_owner_email = $('#is_unique_salon_owner_email').val();
        if(is_unique_salon_owner_email == '1' && is_unique_salon_owner_number == '1'){
            $('#submit_button').attr('disabled', false);
        }else{
            $('#submit_button').attr('disabled', true);
        }
    }
    $("#email").keyup(function() {
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>admin/Ajax_controller/check_unique_salon_email_ajx",
            data: {
                'email': $("#email").val(),
                'id': id
            },
            success: function(data) {
                if(data > 0){
                    $('#salon_owner_email-error2').show();
                    $('#salon_owner_email-error2').html('This email already exist');
                    $('#is_unique_salon_owner_email').val('0');
                }else{
                    $('#salon_owner_email-error2').hide();
                    $('#salon_owner_email-error2').html('');
                    $('#is_unique_salon_owner_email').val('1');
                }
                setSubmitButton();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });
    function generateViewButton(fileInputId) {
        var files = document.getElementById(fileInputId).files;
        var viewButtonsContainer = $('#viewButtonsContainer');

        for (var i = 0; i < files.length; i++) {
            var reader = new FileReader();
            reader.onload = (function (file) {
                return function (e) {
                    var viewButton = $('<a class="btn btn-primary" target="_blank" href="' + e.target.result + '">View</a>');
                    viewButtonsContainer.append(viewButton);
                };
            })(files[i]);

            reader.readAsDataURL(files[i]);
        }
    }

    $('#aadhar_front, #aadhar_back, #salon_photo').on('change', function () {
        generateViewButton(this.id);
    });

    
    $('#ifsc').on('input', function() {
        var currentValue = $(this).val();
        $(this).val(currentValue.toUpperCase());
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
	function fetchSubscriptions(){
		$.ajax({
			type: "POST",
			url: "<?= base_url(); ?>admin/Ajax_controller/get_subscription_typewise_ajx",
			data: {	},
			success: function(data) {
				$("#subscription").empty();
				$('#subscription').append('<option value="">Select Subscription</option>');
				var opts = $.parseJSON(data);
				$.each(opts, function(i, d) {
					if(d.id == $('#old_subscription').val()){
						$('#subscription').append('<option selected value="' + d.id + '">' + d.subscription_name + '</option>');
					}else{
						$('#subscription').append('<option value="' + d.id + '">' + d.subscription_name + '</option>');
					}
				});
				$('#subscription').trigger('chosen:updated');
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus, errorThrown);
			}
		});
	}

    $(document).ready(function () {
        $("#is_branch_available").change(function () {
            const value = $(this).val();
            if (value === "0") {
                $("#next_to_step2").show();
                $("#submit_button_step1").hide(); // Hide the "Submit" button in Step 1
            } else {
                $("#next_to_step2").hide(); // Hide the "Next" button
                $("#submit_button_step1").show(); // Show the "Submit" button in Step 1
            }
        });
        $('#is_branch_available').trigger('change');

        // Handle the "Next" button click event
        $("#next_to_step2").click(function () {
            if (validateStep1()) {
                $("#step1").hide(); // Hide Step 1
                $("#step2").show(); // Show Step 2
            }
        });

        // Handle the "Back" button click event
        $("#back_to_step1").click(function () {
            $("#step2").hide(); // Hide Step 2
            $("#step1").show(); // Show Step 1
        });

        function validateStep1() {
            let isValid = true;
            // Loop through required fields in Step 1
            $("#step1 .form-group input, #step1 .form-group select").each(function () {
                if ($(this).prop("required") && $(this).val() === "") {
                    isValid = false;
                    $(this).addClass("is-invalid"); // Add Bootstrap error class
                    $(this).closest(".form-group").find(".error-message").remove(); // Remove existing error messages
                    $(this).closest(".form-group").append("<span class='error-message' style='color: red;'>This field is required</span>");
                } else {
                    $(this).removeClass("is-invalid"); // Remove error class if valid
                    $(this).closest(".form-group").find(".error-message").remove(); // Remove error messages
                }
            });

            return isValid;
        }

        // Remove error styling on input
        $(document).on("input change", "#step1 .form-group input, #step1 .form-group select", function () {
            $(this).removeClass("is-invalid");
            $(this).closest(".form-group").find(".error-message").remove();
        });
    });
</script>