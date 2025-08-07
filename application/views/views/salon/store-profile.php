<?php include('header.php'); ?>
<style>
    .cards {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 15px;
    }

    .card.mid {
        /* background: #444; */
        /* color: #f1c40f; */
        border-radius: 10px;
        /* padding: 15px 20px; */
        text-align: center;
        /* box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); */
        width: 240px;
        font-size: 14px;
    }

    .card.mid label {
        font-size: 18px;
        font-weight: bold;
    }

    .card.mid img {
        margin: 10px 0;
        /* border: 2px solid #f1c40f; */
        border-radius: 5px;
    }

    .qr-download-button {
        display: inline-block;
        background:linear-gradient(271deg, #800080, #ff69b4);
        color: var(--white);
        padding: 8px 15px;
        border-radius: 5px;
        font-size: 14px;
        text-decoration: none;
        margin-top: 10px;
        font-weight: bold;
        transition: background 0.3s ease;
    }

    .qr-download-button:hover {
        background: var(--white);
        color: var(--hover);
        border-color: var(--hover);
    }

    .blurred-text {
        color: #888;
        font-size: 16px;
        text-align: center;
        font-style: italic;
        margin-bottom: 10px;
    }

    .cards.blurred {
        filter: blur(5px);
        pointer-events: none;
        opacity: 0.7;
    }


    /* Panel Styling */
    .x_panel {
        /* background: #222; */
        color: #444444;
        padding: 20px;
        border-radius: 10px;
        /* box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); */
        margin-bottom: 30px;
    }

    /* Subscription Details */
    .branch_subscription_details p {
        margin: 0 0 10px;
        font-size: 16px;
    }

    .branch_subscription_details b {
        color: #444444;
    }

    #preview img{
        max-width: 35%;
    }

    /* Preview Section */
    /* #preview img {
        border: 3px solid #444444;
        border-radius: 10px;
        margin: 20px 0;
    } */

    /* Timeline */
    .timeline {
        /* background: #333; */
        /* padding: 20px; */
        /* border-radius: 10px; */
    }

    .timeline .box {
        padding-top: 0px;

    }

    .timeline .lines {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin: 20px 0;
        position: relative;
    }

    .timeline .dot {
        height: 15px;
        width: 15px;
        background-color: white;
        ;
        border: 1px solid black;
        border-radius: 50%;
        position: relative;
        z-index: 10;
        box-shadow: 0 0 10px rgba(241, 196, 15, 0.8);
    }

    .timeline .line {
        flex-grow: 1;
        height: 3px;
        background-color: #444;
    }

    .timeline .cards {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }

    .timeline .card {
        background: #444;
        color: white;
        border-radius: 10px;
        padding: 10px 20px;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        width: 18%;
        font-size: 14px;
    }

    .timeline .card b {
        display: block;
        margin-top: 10px;
        color: white;
    }

    /* Heading Styles */
    .x_title h3 {
        color: black;
        text-transform: uppercase;
        font-size: 20px;
        margin: 0;
        padding-bottom: 10px;
        /* border-bottom: 2px solid #444; */
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .timeline .cards {
            flex-wrap: wrap;
            gap: 10px;
        }

        .timeline .card {
            width: 48%;
        }

        .timeline .lines {
            flex-wrap: wrap;
        }
    }
</style>
<style type="text/css">
    .upper {
        display: flex;
        flex-direction: row-reverse;
        justify-content: space-between;
    }

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
        opacity: 0.5;
        /* Makes the button look disabled */
        cursor: not-allowed;
        /* Change cursor to indicate disabled state */
    }

    .error {
        color: red;
        float: left;
        /*    position: absolute;*/
    }

    /* .qr-download-button {
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
    } */

    .qr-download-button:hover {
        text-decoration: none;
    }

    .qr-download-button i {
        margin-right: 5px;
    }

    .branch_subscription_details p {
        font-size: 18px;
        color: black;
        margin: 0 0 0px;
    }
    .upper > div {
    width: 33.33%;
    /* text-align: center; */
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

    .branch_subscription_details p span {
        font-size: 15px;
        color: #393737;
    }
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">




        <div class="row" style="display: flex;flex-direction:column-reverse;">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="page-title">
                        <div class="title_left">
                            <h3 style="margin-left: 0px;">
                                Add Store Profile
                            </h3>
                        </div>


                    </div>
                    <div class="x_content">
                        <div class="container">
                            <form method="post" name="customer_form" id="customer_form" enctype="multipart/form-data">
                                <div class="row flex_wrap">
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Business Name<b class="require">*</b></label>
                                        <input autocomplete="off" readonly type="text" class="form-control" name="branch_name" id="branch_name" value="<?php if (!empty($single_profile)) {echo $single_profile->branch_name; } ?>" placeholder="Enter salon name">
                                        <input autocomplete="off" readonly type="hidden" name="id" id="id" value="<?php if (!empty($single_logo)) {echo $single_logo->id;} ?>">
                                        <input autocomplete="off" readonly type="hidden" name="branch_id" id="branch_id" value="<?php if (!empty($single_profile)) {echo $single_profile->id;} ?>">
                                    </div>
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Email<b class="require">*</b></label>
                                        <input  autocomplete="off" readonly type="text" class="form-control" name="email" id="email" value="<?php if (!empty($single_profile)) { echo $single_profile->email;} ?>" placeholder="Enter email">
                                    </div>
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Category <b class="require">*</b></label>
                                        <select class="form-control" name="category" id="category" disabled>
                                            <option value="">Category</option>
                                            <option value="0" <?php if (!empty($single_profile) && $single_profile->category == '0') echo 'selected'; ?>>Male</option>
                                            <option value="1" <?php if (!empty($single_profile) && $single_profile->category == '1') echo 'selected'; ?>>Female</option>
                                            <option value="2" <?php if (!empty($single_profile) && $single_profile->category == '2') echo 'selected'; ?>>Unisex</option>
                                        </select>
                                    </div> 
                                <!-- </div>
                                <div class="row"> -->
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Phone Number<b class="require">*</b></label>
                                        <input  autocomplete="off" maxlength="10" type="text" class="form-control" name="salon_number" id="salon_number" value="<?php if (!empty($single_profile)) {echo $single_profile->salon_number;} ?>" placeholder="Enter phone number">
                                    </div>
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Customer Support Number</label>
                                        <input  autocomplete="off" maxlength="10" type="text" class="form-control" name="customer_support_phone" id="customer_support_phone" value="<?php if (!empty($single_logo)) {echo $single_logo->customer_support_phone;} ?>" placeholder="Enter customer support number">
                                    </div>  
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Upload Shopact <b class="require">*</b>
                                                <?php if(!empty($single_logo) && $single_logo->shopact != ""){ ?>
                                                    <a target="_blank" href="<?=base_url();?>admin_assets/images/shopact-image/<?=$single_logo->shopact;?>" style="text-decoration:underline;"> View</a>
                                                <?php } ?>
                                        </label>
                                        <input autocomplete="off" type="file" accept=".png,.jpg,.jpeg,.pdf" class="form-control" name="shopact" id="shopact">
                                        <input type="hidden" class="form-control" name="old_shopact" id="old_shopact" value="<?php if (!empty($single_logo)) {echo $single_logo->shopact;} ?>">
                                    </div>
                                <!-- </div> -->
                                    <!-- <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Add Website</label>
                                        <input autocomplete="off" type="text" class="form-control" name="website_link" id="website_link" placeholder="Enter website link" value="<?php if (!empty($single_logo)) {echo $single_logo->website_link;} ?>">
                                    </div>                                 -->
                                  <!-- <div class="row"> -->
                                    <?php if (!empty($single_profile) && $single_profile->is_gst_applicable == '1'){ ?>
                                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12" >
                                            <label>GST No.</label>
                                            <input readonly maxlength="15" value="<?php echo $single_profile->gst_no; ?>" autocomplete="off" type="text" class="form-control" name="gst_number" id="gst_number" placeholder="eg. 22AAAAA0000A1Z5">
                                        </div>
                                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12" >
                                            <label>GST Rate <small>(In %)</small></label>
                                            <input readonly value="<?= !empty($setup) ? $setup->gst_rate : ''; ?>" type="text" class="form-control" name="gst_rate" id="gst_rate" placeholder="Enter GST Rate">
                                        </div>
                                    <?php } ?>
                                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <label>Pan Card</label>
                                            <input maxlength="10" autocomplete="off" type="text" class="form-control" name="pan" id="pan" placeholder="Enter Pan Card Number" value="<?php if (!empty($single_logo)) {echo $single_logo->pan;} ?>">
                                        </div>
                                 <!-- </div>
                                <div class="row"> -->
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Add Instagram Account</label>
                                        <input autocomplete="off" type="text" class="form-control" name="instagram_link" id="instagram_link" placeholder="Enter instagram account link" value="<?php if (!empty($single_logo)) {echo $single_logo->instagram_link;} ?>">
                                    </div>
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Add Facebook Account</label>
                                        <input autocomplete="off" type="text" class="form-control" name="facebook_link" id="facebook_link" placeholder="Enter facebook account link" value="<?php if (!empty($single_logo)) {echo $single_logo->facebook_link;} ?>">
                                    </div>
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Add Youtube Channel</label>
                                        <input autocomplete="off" type="text" class="form-control" name="youtube_link" id="youtube_link" placeholder="Enter youtube channel account link" value="<?php if (!empty($single_logo)) {echo $single_logo->youtube_link;} ?>">
                                    </div>                                    
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
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
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"> 
                                        <div class="form-group">
                                            <input type="checkbox" name="agree_terms" id="agree_terms" value="Yes" checked>
                                            <label>Agree Terms & Conditions <b class="require">*</b> <a target="_blank" href="<?php echo base_url(); ?>terms?type=1" style="text-decoration:underline;"><small>View</small></a></label>
                                        </div>
                                        <span for="agree_terms" style="display:none;" generated="true" class="error invalid-feedback">Please accept terms &amp; conditions!</span>                                    
                                    </div>
                                </div>
                               
                                <div class="row">
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <!-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet"> -->
            <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="x_panel">
                    <div class="upper">
                        <div class="container" style="position: relative;width:auto;">
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
                        <?php if (!empty($profile) && $profile->subscription_name != "") { ?>
                            <div class="branch_subscription_details">
                                <p><b><?= $profile->subscription_name; ?></b></p>
                                <p>
                                    <span>
                                        <b>Price:</b>
                                        <label>
                                            Rs. <?= $profile->subscription_price; ?>
                                            <?php if ($profile->pending_due_amount != "") { ?>
                                                &nbsp;&nbsp;&nbsp;
                                                <small>(Rs. <?= $profile->pending_due_amount; ?> Due)</small>
                                            <?php } ?>
                                        </label>
                                    </span>
                                </p>
                                <p>
                                    <span><b>Started On:</b>
                                        <label><?= date('d M, Y h:i A', strtotime($profile->subscription_start)); ?></label>
                                    </span>
                                </p>
                                <p>
                                    <span><b>Expire On:</b>
                                        <label><?= date('d M, Y h:i A', strtotime($profile->subscription_end)); ?></label>
                                    </span>
                                </p>
                            </div>
                        <?php } ?>

                        <div id="preview">
                            <?php if (!empty($single_logo)) { ?>
                                <img src="<?= base_url() ?>admin_assets/images/store_logo/<?php echo $single_logo->store_logo; ?>" alt="Store Logo">
                            <?php } else { ?>
                                <img src="<?= base_url() ?>admin_assets/images/store_logo/dummy.jpg" alt="Dummy Logo">
                            <?php } ?>

                            <div class="row">
                                    <?php if (!empty($single_logo->instagram_link)) { ?>

                                        <a href="<?php echo $single_logo->instagram_link ?>" target="_blank">
                                            <div class="btn ">
                                                <i style="font-size: 26px;" class="fa-brands fa-instagram"></i>
                                            </div>
                                        </a>

                                    <?php } ?>
                                    <?php if (!empty($single_logo->facebook_link)) { ?>

                                        <a href="<?php echo $single_logo->facebook_link ?>" target="_blank">
                                            <div class="btn ">
                                                <i style="font-size: 26px;" class="fa-brands fa-facebook"></i>
                                            </div>
                                        </a>

                                    <?php } ?>
                                    <?php if (!empty($single_logo->youtube_link)) { ?>

                                        <a href="<?php echo $single_logo->youtube_link ?>" target="_blank">
                                            <div class="btn ">
                                                <i style="font-size: 26px;" class="fa-brands fa-youtube"></i>
                                            </div>
                                        </a>

                                    <?php } ?>
                                    <?php if (!empty($single_logo->website_link)) { ?>

                                        <a href="<?php echo $single_logo->website_link ?>" target="_blank">
                                            <div class="btn ">
                                                <i style="font-size: 26px;" class="fa-solid fa-earth-americas"></i>
                                            </div>
                                        </a>

                                    <?php } ?>
                                </div>
                        </div>
                    </div>
                    <!-- <div class="x_content">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                               Store Status
                            </h3>
                        </div>


                    </div>

                        <div class="timeline">
                            <div class="box timeline_box">
                                <div class="lines">
                                    <div class="dot"></div>
                                    <div class="line"></div>
                                    <div class="dot"></div>
                                    <div class="line"></div>
                                    <div class="dot"></div>
                                    <div class="line"></div>
                                    <div class="dot"></div>
                                    <div class="line"></div>
                                    <div class="dot"></div>
                                </div>
                                <div class="cards">
                                    <div class="card">
                                        <h4>0 % complete</h4>
                                        <b>Store Profile</b>
                                    </div>
                                    <div class="card">
                                        <h4>0 % complete</h4>
                                        <b>Working Hours</b>
                                    </div>
                                    <div class="card">
                                        <h4>0 % complete</h4>
                                        <b>Stylists</b>
                                    </div>
                                    <div class="card">
                                        <h4>0 % complete</h4>
                                        <b>Location</b>
                                    </div>
                                    <div class="card">
                                        <h4>0 % complete</h4>
                                        <b>Bank Details</b>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div> -->
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
            <?php if (!empty($single_profile) && $single_profile->shopact =="") {?>
            shopact: {
                required:true,
            },
          <?php }else if (empty($single_profile)){?>
            
            shopact: {
                required:true,
            },
            <?php }?>
          
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
            agree_terms: {
                required:true,
            },
        },
        messages: {
            salon_name: 'Please enter salon name!',
            category: 'Please select category!',
            // gst: 'Please select GST option!',
          
            store_logo: 'Please upload store logo!',
            
            <?php if (!empty($single_profile) && $single_profile->shopact =="") {?>
            shopact: {
                required:'Please upload shopact copy!',
            },
            <?php }else if (empty($single_profile)){?>
            
            shopact: {
                required:'Please upload shopact copy!',
            },
            <?php }?>
          
             
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
            agree_terms: {
                required: "Please accept terms & conditions!",
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