<?php
// echo "<pre>";print_r($single);exit;
include('header.php'); ?>
<style type="text/css">
    .error {
        color: red;
        float: left;
        /*    position: absolute;*/
    }

    input[type="file"] {
        height: 50px;
    }

    #viewButtonsContainer a {

        margin-left: 30px;
    }
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

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">

                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="x_panel">
                <div class="x_title">
                    <h2><b>Add Salon</b></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="container">
                        <form method="post" name="customer_form" id="customer_form" enctype="multipart/form-data" onsubmit="disableSubmitButton()">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Salon Name <b class="require">*</b></label>
                                        <input autocomplete="off" type="text" class="form-control" name="salon_name" id="salon_name" value="<?php if (!empty($single)) {
                                            echo $single->salon_name;
                                        } ?>" placeholder="Enter salon name">
                                        <input autocomplete="off" type="hidden" name="id" id="id" value="<?php if (!empty($single)) {
                                            echo $single->id;
                                        } ?>">
                                        <label style="display: none;" id="salon_name-error" class="error col-md-12"
                                            for="salon_name"></label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Salon Owner Name <b class="require">*</b></label>
                                        <input autocomplete="off" type="text" class="form-control" name="salon_owner_name"
                                            id="salon_owner_name" value="<?php if (!empty($single)) {
                                                echo $single->salon_owner_name;
                                            } ?>" placeholder="Enter salon owner name">
                                        <label style="display: none;" id="salon_owner_name-error" class="error col-md-12"
                                            for="salon_owner_name"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Salon Owner Number <b class="require">*</b></label>
                                        <input autocomplete="off" type="text" class="form-control" name="salon_owner_number"
                                            id="salon_owner_number" value="<?php if (!empty($single)) {
                                                echo $single->salon_owner_number;
                                            } ?>" placeholder="Enter salon owner number">
                                        <!-- <label style="display: none;" id="salon_owner_number-error" class="error col-md-12"
                                            for="salon_owner_number"></label> -->
                                        <label style="display: none; color:red" id="salon_owner_number-error2" class=""
                                            for="salon_owner_number"></label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Email <b class="require">*</b></label>
                                        <input autocomplete="off" type="text" class="form-control" name="email" id="email" value="<?php if (!empty($single)) {
                                            echo $single->email;
                                        } ?>" placeholder="Enter salon email">
                                        <!-- <label style="display: none;" id="salon_owner_email-error" class="error col-md-12"
                                            for="email"></label> -->
                                        <label style="display: none; color:red" id="salon_owner_email-error2" class=""
                                            for="email"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label >Aadhaar Number</label>
                                        <input maxlength="12" autocomplete="off" type="text" class="form-control" name="aadhar_number" id="aadhar_number"
                                            value="<?php if (!empty($single)) {
                                                echo $single->aadhar_number;
                                            } ?>" placeholder="Enter salon owner Aadhaar number">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
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
                                        <!-- <div id="viewButtonsContainer"></div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12">
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
                                        <!-- <div id="viewButtonsContainer"></div> -->
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12" style="display:none">
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
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label >Is GST Applicable? <b class="require">*</b></label>
                                        <select class="form-control" name="is_gst_applicable" id="is_gst_applicable">
                                            <option value="">Select Option</option>
                                            <option value="0" <?php if(!empty($single) && $single->is_gst_applicable == "0"){ echo 'selected'; }?>>No</option>
                                            <option value="1" <?php if(!empty($single) && $single->is_gst_applicable == "1"){ echo 'selected'; }?>>Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="fullname" id="gst_no_label">GST No.</label>
                                        <input readonly placeholder="Enter GST No" type="text" name="gst_no" id="gst_no" class="form-control" value="<?php if(!empty($single)){ echo $single->gst_no;}?>">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="is_unique_salon_owner_number" id="is_unique_salon_owner_number" value="">
                            <input type="hidden" name="is_unique_salon_owner_email" id="is_unique_salon_owner_email" value="">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group col-md-0 col-xs-12" style="margin-top: 20px;">
                                    <button type="submit" id="submit_button" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form> <!------------end of form---->
                    </div> <!----------end of container-------->

                </div>
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
    var id = '<?php echo $edit_id; ?>';
    $(document).ready(function () { 
jQuery.validator.addMethod("gstFormat", function(value, element) {
    return this.optional(element) || /^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[A-Z0-9]{1}[Z]{1}[A-Z0-9]{1}$/.test(value);
}, "Please enter a valid GST number in the correct format (e.g., 22AAAAA0000A1Z5).");
$.validator.addMethod("alphanumeric", function(value, element) {
    return this.optional(element) || /^[a-zA-Z0-9]+$/.test(value);
}, "Only letters and numbers are allowed (no special characters).");
        $('#customer_form').validate({
            rules: {
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
            },
            messages: {
                is_gst_applicable: 'Please select option',
                gst_no:{
                    required: "Please enter GST No.",
                    maxlength: "Please enter max 15 digits",
                    minlength: "Please enter min 15 digits",
                    alphanumeric: "Please enter valid GST no",
                    gstFormat: "Please enter valid GST no(e.g. 22AAAAA0000A1Z5)",
                },
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
    // function disableSubmitButton() {
    //     document.getElementById('submit_button').disabled = true;
    // }

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
                    var viewButton = $('<a class="btn btn-info" target="_blank" href="' + e.target.result + '">View</a>');
                    viewButtonsContainer.append(viewButton);
                };
            })(files[i]);

            reader.readAsDataURL(files[i]);
        }
    }

    $('#aadhar_front, #aadhar_back, #salon_photo').on('change', function () {
        generateViewButton(this.id);
    });
</script>