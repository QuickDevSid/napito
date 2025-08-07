<?php include('header.php'); ?>
<style type="text/css">
    .blurred {
        filter: blur(1px);
        pointer-events: none;
        position: relative;
    }
    .blurred-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: red;
        text-shadow: 2px 2px #ffffff;
        font-weight: bold;
        font-size: 14px;
        z-index: 99;
        width: 100%;
        text-align: center;
    }

    .qr-download-button[disabled] {
        opacity: 0.5; /* Makes the button look disabled */
        cursor: not-allowed; /* Change cursor to indicate disabled state */
    }
    
    .error {
        color: red;
        float: left;
        /*    position: absolute;*/
    }
    .qr-download-button {
        display: inline-block;
        padding: 5px 20px;
        font-size: 16px;
        color: #fff;
        background-color: #007bff;
        border-radius: 5px;
        text-decoration: none;
        transition: background-color 0.3s ease;
        border: 1px solid transparent;
        margin-top: 10px;
    }

    .qr-download-button:hover {
        text-decoration: none;
    }

    .qr-download-button i {
        margin-right: 5px;
    }

    .branch_subscription_details p{
        font-size: 20px;
        color: blue;
        margin: 0 0 0px;
    }
    .branch_subscription_details p span {
        font-size: 15px;
        color: #393737;
    }
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Add Store Profile
                </h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">

                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-8 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                    </div>
                    <div class="x_content">
                        <div class="container">
                            <form method="post" name="customer_form" id="customer_form" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Business Name<b class="require">*</b></label>
                                        <input autocomplete="off" readonly type="text" class="form-control" name="branch_name" id="branch_name" value="<?php if (!empty($single_profile)) {echo $single_profile->branch_name; } ?>" placeholder="Enter salon name">
                                        <input autocomplete="off" readonly type="hidden" name="id" id="id" value="<?php if (!empty($single_logo)) {echo $single_logo->id;} ?>">
                                        <input autocomplete="off" readonly type="hidden" name="branch_id" id="branch_id" value="<?php if (!empty($single_profile)) {echo $single_profile->id;} ?>">
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Email<b class="require">*</b></label>
                                        <input  autocomplete="off" readonly type="text" class="form-control" name="email" id="email" value="<?php if (!empty($single_profile)) { echo $single_profile->email;} ?>" placeholder="Enter email">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Category <b class="require">*</b></label>
                                        <select class="form-control" name="category" id="category" disabled>
                                            <option value="">Category</option>
                                            <option value="0" <?php if (!empty($single_profile) && $single_profile->category == '0') echo 'selected'; ?>>Male</option>
                                            <option value="1" <?php if (!empty($single_profile) && $single_profile->category == '1') echo 'selected'; ?>>Female</option>
                                            <option value="2" <?php if (!empty($single_profile) && $single_profile->category == '2') echo 'selected'; ?>>Unisex</option>
                                        </select>
                                    </div> 
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Phone Number<b class="require">*</b></label>
                                        <input  autocomplete="off" maxlength="10" type="text" class="form-control" name="salon_number" id="salon_number" value="<?php if (!empty($single_profile)) {echo $single_profile->salon_number;} ?>" placeholder="Enter phone number">
                                    </div>
                                </div>
                                <div class="row"> 
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Customer Support Number</label>
                                        <input  autocomplete="off" maxlength="10" type="text" class="form-control" name="customer_support_phone" id="customer_support_phone" value="<?php if (!empty($single_logo)) {echo $single_logo->customer_support_phone;} ?>" placeholder="Enter customer support number">
                                    </div>  
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Add Website</label>
                                        <input autocomplete="off" type="text" class="form-control" name="website_link" id="website_link" placeholder="Enter website link" value="<?php if (!empty($single_logo)) {echo $single_logo->website_link;} ?>">
                                    </div>                                
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Add Instagram Account</label>
                                        <input autocomplete="off" type="text" class="form-control" name="instagram_link" id="instagram_link" placeholder="Enter instagram account link" value="<?php if (!empty($single_logo)) {echo $single_logo->instagram_link;} ?>">
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Add Facebook Account</label>
                                        <input autocomplete="off" type="text" class="form-control" name="facebook_link" id="facebook_link" placeholder="Enter facebook account link" value="<?php if (!empty($single_logo)) {echo $single_logo->facebook_link;} ?>">
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Add Youtube Channel</label>
                                        <input autocomplete="off" type="text" class="form-control" name="youtube_link" id="youtube_link" placeholder="Enter youtube channel account link" value="<?php if (!empty($single_logo)) {echo $single_logo->youtube_link;} ?>">
                                    </div>
                                    
                                </div>
                                  <div class="row">
                                    <?php if (!empty($single_profile) && $single_profile->is_gst_applicable == '1'){ ?>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12" >
                                            <label>GST No.</label>
                                            <input readonly maxlength="15" value="<?php echo $single_profile->gst_no; ?>" autocomplete="off" type="text" class="form-control" name="gst_number" id="gst_number" placeholder="eg. 22AAAAA0000A1Z5">
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12" >
                                            <label>GST Rate <small>(In %)</small></label>
                                            <input readonly value="<?= !empty($setup) ? $setup->gst_rate : ''; ?>" type="text" class="form-control" name="gst_rate" id="gst_rate" placeholder="Enter GST Rate">
                                        </div>
                                    <?php } ?>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label>Pan Card</label>
                                            <input maxlength="10" autocomplete="off" type="text" class="form-control" name="pan" id="pan" placeholder="Enter Pan Card Number" value="<?php if (!empty($single_logo)) {echo $single_logo->pan;} ?>">
                                        </div>
                                 </div>
                                <div class="row">
                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                        <label>Short Description</label>
                                        <textarea style="overflow-x: hidden;max-width:100% !important;" type="text" class="form-control" name="description" id="description" placeholder="Enter description"><?php if (!empty($single_logo)) {echo $single_logo->description;} ?></textarea>
                                    </div>
                                </div>
                              
                                <div class="row">
                                   <div class="col-md-6">
                                        <div class="uploadOuter form-group">
                                            <span class="dragBox" >
                                            <i class="fa-solid fa-images" style="font-size: 30px;"></i>
                                            <input style="height: 100px !important" type="file" name="store_logo" onChange="dragNdrop(event)" ondragover="drag()" ondrop="drop()" id="store_logo">
                                            <input type="hidden" name="old_store_logo" id="old_store_logo" value="<?php if (!empty($single_logo)) {echo $single_logo->store_logo;} ?>">
                                            </span><br>
                                            <p>Choose a Store logo or drag it here <b class="require">*</b></p><br>
                                            <div id="errorMessage" class="error" style="color: red;"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                       <label>Salon Shopact File<b class="require">*</b></label><br>
                                       <div class="btn btn-info"><a style="color: white;" href="<?= base_url() ?>admin_assets/images/shopact-image/<?php if (!empty($single_profile)) {echo $single_profile->shopact;} ?>" target="_blank">View</a></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <?php if (!empty($single_logo->instagram_link)) { ?>
                                        <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                        <a href="<?php echo $single_logo->instagram_link?>"  target="_blank">
                                                <div class="btn btn-danger">
                                                    <i  style="font-size: 30px;" class="fa-brands fa-instagram"></i>
                                                </div>
                                        </a>
                                        </div>
                                    <?php }?>
                                    <?php if (!empty($single_logo->facebook_link)) { ?>
                                        <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                            <a href="<?php echo $single_logo->facebook_link?>"  target="_blank">
                                                <div class="btn btn-primary">
                                                <i  style="font-size: 30px;" class="fa-brands fa-facebook"></i>
                                                </div>
                                            </a>
                                        </div>
                                        <?php }?>
                                    <?php if (!empty($single_logo->youtube_link)) { ?>
                                        <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                            <a href="<?php echo $single_logo->youtube_link?>" target="_blank">
                                                <div class="btn btn-danger">
                                                    <i  style="font-size: 30px;" class="fa-brands fa-youtube"></i>
                                                </div>
                                            </a>
                                        </div>
                                    <?php }?>
                                    <?php if (!empty($single_logo->website_link)) { ?>
                                        <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                            <a href="<?php echo $single_logo->website_link?>"  target="_blank"> 
                                                <div class="btn btn-info">
                                                    <i  style="font-size: 30px;" class="fa-solid fa-earth-americas"></i>
                                            </div>
                                            </a>
                                        </div>
                                    <?php }?>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12" style="margin-top: 40px;">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <?php if(!empty($profile) && $profile->subscription_name != ""){ ?>
                    <div class="branch_subscription_details">
                        <p><b><?=$profile->subscription_name;?></b></p>
                        <p>
                            <span>
                                <b>Price:</b> 
                                <label>
                                    Rs. <?=$profile->subscription_price;?>
                                    <?php if($profile->pending_due_amount != ""){ ?>
                                        &nbsp;&nbsp;&nbsp;
                                        <small>(Rs. <?=$profile->pending_due_amount;?> Due)</small>
                                    <?php } ?>
                                </label>
                            </span>
                        </p>
                        <p>
                            <span><b>Started On:</b>
                                <label><?=date('d M, Y h:i A',strtotime($profile->subscription_start));?></label>
                            </span>
                        </p>
                        <p>
                            <span><b>Expire On:</b> 
                                <label><?=date('d M, Y h:i A',strtotime($profile->subscription_end));?></label>
                            </span>
                        </p>
                    </div>
                    <?php } ?>
                    <div class="x_content">
                        <div class="x_title">
                        </div>
                            <div id="preview">
                               <?php
                                    if (!empty($single_logo)) { 
                                ?>
                                        <img style="max-width: 60%;max-height: 30%;" src="<?= base_url() ?>admin_assets/images/store_logo/<?php echo $single_logo->store_logo;?>">
                                    <?php }else{?>
                                        <img style="max-width: 60%; max-height: 30%;" src="<?= base_url() ?>admin_assets/images/store_logo/dummy.jpg">
                                <?php }?> 
                            </div>
                            <div class="timeline">
								<div class="box timeline_box">
                                    <div class="x_title">
                                        <h3  id="store_status"></h3>
                                    </div><br>
									<div class="container">
										<div class="lines">
											<div class="dot" id="dot_1"></div><div class="line"></div>
											<div class="dot" id="dot_2"></div><div class="line"></div>
											<div class="dot" id="dot_3"></div><div class="line"></div>
											<div class="dot" id="dot_4"></div><div class="line"></div>	
											<div class="dot" id="dot_5"></div><div></div>							
										</div>
										<div class="cards">
											<div class="card mid">
                                                <h4 id="store_profile_1">0 % complete</h4>
                                                <h4 id="store_profile"></h4>
                                                <b>Store Profile</b>
											</div>	
											<div class="card mid">
                                                <h4 id="working_hours_1">0 % complete</h4>
                                                <h4 id="working_hours"></h4>
                                                <b>Working Hours</b>
											</div>
                                            <div class="card mid">
                                                <h4 id="stylists_1">0 % complete</h4>
                                                <h4 id="stylists"></h4>
                                                <b>Stylists</b>
											</div>	
                                            <div class="card mid">
                                                <h4 id="location_1">0 % complete</h4>
                                                <h4 id="location"></h4>
                                                <b>Location</b>
											</div>	
											<div class="card mid">
                                                <h4 id="bank_details_1">0 % complete</h4>
                                                <h4 id="bank_details"></h4>
                                                <b>Bank Details</b>
											</div>					
										</div>
									</div>
								</div>
                            </div>
                                <div class="container" style="position: relative;">
                            <?php
                                if(in_array('store-qr',explode(',',$this->session->userdata('subscription_feature_slugs')))){
                                    if(!empty($single_profile)){
                                        if($single_profile->branch_unique_code != ""){
                            ?>
                                <div class="cards">
                                    <div class="card mid" style="text-align:center;">
                                        <label><?=$single_profile->branch_unique_code;?></label>
                                        <br>
                                        <?php $generated_qr = $this->Salon_model->generate_qrcode_data($single_profile->branch_unique_code); ?>
                                        <img style="width: 100px !important;" src="<?=$generated_qr;?>" />
                                        <br>
                                        <a href="<?=$generated_qr;?>" download="qrcode.png" class="qr-download-button">
                                            <i class="fa fa-download"></i> Download
                                        </a>
                                    </div>
                                </div>
                            <?php }}}else{ ?>
                                <p class="blurred-text">Feature not available</p>
                                <div class="cards blurred">
                                    <div class="card mid" style="text-align:center;">
                                        <?php $generated_qr = $this->Salon_model->generate_qrcode_data('PLEASE UPGRADE'); ?>
                                        <img style="width: 100px !important;" src="<?=$generated_qr;?>" />
                                        <br>
                                        <a class="qr-download-button">
                                            <i class="fa fa-download"></i> Download
                                        </a>
                                    </div>
                                </div>
                            <?php } ?>
                            </div>
                    </div>
                </div>
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

<!-- <script type="text/javascript">
  function check_validation(){
    if($("#store_logo").val() !== ""){
        $("#store_logo").removeClass('is-invalid'); 
    }
    
  }
</script> -->

<script>
     $(".gst-checkbox").change(function() {
        if ($("#gst_yes").is(":checked")) {
            $(".gst_number_inner").show();
            $('#gst_number').attr('required',true);
            $("#gst_no").prop("checked", false);
        } else if ($("#gst_no").is(":checked")) {
            $(".gst_number_inner").hide();
            $("#gst_number").empty();
            
            $('#gst_number').attr('required',false);
            $("#gst_yes").prop("checked", false);
        } else {
            
            $('#gst_number').attr('required',false);
            $(".gst_number_inner").hide();
        }
    });
    $("#coupan_expiry").datepicker({
        dateFormat: "dd-mm-yy",
        changeMonth: true,
        changeYear: true,
        
        minDate: "-80Y",
         
    });
    $(document).ready(function() {
        jQuery.validator.addMethod("validate_email", function(value, element) {
            if (/^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/.test(value)) {
                return true;
            } else {
                return false;
            }
        }, "Please enter a valid Email.");

        $.validator.addMethod("pan", function(value, element) {
				return this.optional(element) || /^[a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}$/.test(value);
		});
            jQuery.validator.addMethod("validateGST", function(value, element) {
            var gstPattern = /^\d{2}[A-Z]{5}\d{4}[A-Z]{1}\d{1}[Z]{1}[A-Z\d]{1}$/;
            return this.optional(element) || (gstPattern.test(value) && value.length == 15);
        }, "Please enter a valid GST number!");   

    jQuery.validator.setDefaults({
        success: "valid"
        });
       
           
    $('#customer_form').validate({
        rules: {
         instagram_link: {
            url: true
            },
            facebook_link: {
            url: true
            },
        youtube_link: {
            url: true
            },
        website_link: {
            url: true
            },
            salon_name: 'required',
            category: 'required',
            // gst: 'required',
            <?php if (empty($single_logo->store_logo)) {?>
              store_logo: 'required',
            <?php }?>
            salon_number: {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 10,
            },
          
            customer_support_phone: {
                number: true,
                minlength: 10,
                maxlength: 10,
            },
            pan: {
                // required: true,
                pan: true,
            },
            gst_number: {
                // required:true,
                // validateGST: true,
            },
        },
        messages: {
            salon_name: 'Please enter salon name!',
            category: 'Please select category!',
            // gst: 'Please select GST option!',
          
            store_logo: 'Please upload store logo!',
            salon_number: {
                required: "Please enter salon mobile number!",
                number: "Please enter a valid mobile number!",
                minlength: "Minimum 10 digits required!",
                maxlength: "Maximum 10 digits allowed!",
            },
            customer_support_phone: {
                number: "Please enter a valid number!",
                minlength: "Minimum 10 digits required!",
                maxlength: "Maximum 10 digits allowed!",
            },
            pan: {
                pan: "Please enter a valid PAN number!",
                // required: "Please enter a valid pan number!",
            },
            gst_number: {
                required: "Please enter a GST number!",
                validateGST: "Please enter valid GST number!",
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
});
</script>
<script>
    "use strict";

    function dragNdrop(event) {
        var fileName = URL.createObjectURL(event.target.files[0]);
        var preview = document.getElementById("preview");
        var previewImg = document.createElement("img");
        previewImg.setAttribute("src", fileName);
        preview.innerHTML = "";
        preview.appendChild(previewImg);
    }

    function drag() {
        document.getElementById('store_logo').parentNode.className = 'draging dragBox';
    }

    function drop() {
        document.getElementById('store_logo').parentNode.className = 'dragBox';
    }
</script>

<script>
    $(document).ready(function() {
        $('#back-office .child_menu').show();
        $('#back-office').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.store-profile').addClass('active_cc');
    });
</script>

<script>
    $(document).ready(function(){ 
            $('#pan').keyup(function() { 
                this.value = this.value.toLocaleUpperCase(); 
            }); 
        });
        $(document).ready(function(){ 
            $('#gst_number').keyup(function() { 
                this.value = this.value.toLocaleUpperCase(); 
            }); 
        });
        
  $(window).load(function() {
        var shift = <?php echo json_encode($shift_list)?>;
        var work_status = <?php echo json_encode($work_list)?>;

        var booking_rules_data = <?php echo json_encode($notification)?>;

        var salon_status_data = <?php echo json_encode($single_rules)?>;
        if(salon_status_data !== null){
            var salon_status= salon_status_data.salon_status_profile;
        }

        var profile_status_data = <?php echo json_encode($single_logo); ?>;
        var stylists_emps = <?php echo count($stylists_emps); ?>;
        var profile_status= profile_status_data.is_gst_applicable == '1' ? (profile_status_data.gst_no != "" ? '1' : '0') : '1';
        var bank_status= profile_status_data.bank_status;
        var location_status= profile_status_data.location;
        
        var shift_count = shift.length;
        var count=0;
        var store_profile=0;
        
        if(stylists_emps > 0){
            $('#stylists_1').hide();
            $('#dot_5').css('background-color', 'green');
            $('#stylists').append("100 % completed");
            store_profile+=20;
        }

        if (profile_status == '1') {
            $('#store_profile_1').hide();
            $('#dot_1').css('background-color', 'green');
            $('#store_profile').append("100 % completed");
            store_profile+=20;
        }

        if (shift_count > 2) {
             count = 1;
        }
        if (profile_status == '1' && shift_count > 2) {
            count = 2;
        }
        if (salon_status == 1 && shift_count > 2) {
            count = 3;
        }

        if (count == 1) {
            $('#working_hours_1').hide();
            $('#working_hours').append("33 % Completed");
            store_profile+=10;
        }else if (count == 2) {
            $('#working_hours_1').hide();
            $('#working_hours').append("66 % Completed");
            store_profile+=15;
        }else if (count == 3) {
            $('#working_hours_1').hide();
            $('#working_hours').append("100 %Completed");
            $('#dot_2').css('background-color', 'green');
            store_profile+=20;
        }

        if (bank_status == 1) {
            $('#bank_details_1').hide();
            $('#bank_details').append("100 % Completed");
            $('#dot_3').css('background-color', 'green');
            store_profile+=20;
        }

        if (location_status) {
            $('#location_1').hide();
            $('#location').append("100 % Completed");
            $('#dot_4').css('background-color', 'green');
            store_profile+=20;
        }
        
        $('#store_status').append('Store Status ' + store_profile + ' % Completed');
        if(store_profile == 100){
            $('.line').css('background-color', 'green'); 
        }

    });
</script>