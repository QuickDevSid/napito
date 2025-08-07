<?php include('header.php'); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/clockpicker/dist/jquery-clockpicker.min.css">
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
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Add Customer
                </h3>
            </div>
<!-- 
            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">

                    </div>
                </div>
            </div> -->
        </div>
        <div class="clearfix"></div>

        <div class="row">


            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">

                    </div>
                    <div class="x_content">
                        <div class="container">
                            <form method="post" name="add_customer_form" id="add_customer_form" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Customer Name <b class="require">*</b></label>
                                        <input autocomplete="off" type="text" class="form-control" name="full_name" id="full_name" placeholder="Enter full name" value="<?php if(!empty($single)){ echo $single->full_name; }?>">
                                    </div>
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Phone Number <b class="require">*</b></label>
                                        <input type="hidden" name="id" id="id" value="<?php if(!empty($single)){ echo $single->id; }?>">
                                        <input type="hidden" name="added_from" id="added_from" value="<?php if(isset($_GET['source']) && $_GET['source'] == 'report'){ echo 'report';}else{ echo 'seperate'; } ?>">
                                        <input type="text" maxlength="10" class="form-control" name="customer_phone" id="customer_phone" placeholder="Enter phone number" onkeyup="validateUniqueMobile()" value="<?php if(!empty($single)){ echo $single->customer_phone; }?>">
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                        <label>Select Gender<b class="require">*</b></label>
                                        <select class="form-select form-control" name="gender" id="gender">
                                            <option value="">Select Gender</option>
                                            <option id="male" value="0" <?php if(!empty($single) && $single->gender == '0'){ echo 'selected'; }?>>Male</option>
                                            <option id="female" value="1" <?php if(!empty($single) && $single->gender == '1'){ echo 'selected'; }?>>Female</option>
                                            <!-- <option id="female" value="2" <?php if(!empty($single) && $single->gender == '2'){ echo 'selected'; }?>>Other</option> -->
                                        </select>
                                    </div>
                                </div>
                                <div class="add-more-info">
                                    <div class="row">
                                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <label>Email</label>
                                            <input type="text" class="form-control" name="email" id="email" placeholder="Enter email" value="<?php if(!empty($single)){ echo $single->email; }?>">
                                        </div>
                                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <label>Married Status</label>
                                            <select class="form-select form-control" name="married_status" id="married_status">
                                                <option value="" class="">Select Married Status</option>
                                                <option value="0" class="" <?php if(!empty($single) && $single->married_status == '0'){ echo 'selected'; }?>>Married</option>
                                                <option value="1" class="" <?php if(!empty($single) && $single->married_status == '1'){ echo 'selected'; }?>>Unmarried</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4 col-sm-6 col-xs-12 Anniversary-box" <?php if(!empty($single) && $single->married_status == '0'){?>style="display: block;"<?php }else{ ?>style="display: none;"<?php } ?>>
                                            <label>Date Of Anniversary</label>
                                            <input readonly maxlength="10" type="text" class="form-control" name="DOA" id="DOA" placeholder="Enter Date of Anniversary" value="<?=(!empty($single) && $single->doa != "" && $single->doa != null && $single->doa != "0000-00-00" && $single->doa != "1970-01-01") ? date('d-m-Y', strtotime($single->doa)) : ''?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <label>Date Of Birth</label>
                                            <input readonly maxlength="10" type="text" class="form-control" name="dob" id="dob" placeholder="Enter Date of Birth" value="<?=(!empty($single) && $single->dob != "" && $single->dob != null && $single->dob != "0000-00-00" && $single->dob != "1970-01-01") ? date('d-m-Y', strtotime($single->dob)) : ''?>">
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>State</label>
                                            <select class="form-select form-control" name="state" id="state">
                                                <option value="" class="">Select State</option>
                                                <?php if (!empty($state)) {
                                                    foreach ($state as $state_result) { ?>
                                                        <option value="<?= $state_result->id ?>" <?php if ((!empty($single) && $single->state == $state_result->id) || $state_result->id == '4008') { ?>selected="selected" <?php } ?>>
                                                            <?= $state_result->name ?>
                                                        </option>
                                                <?php }
                                                } ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Select City</label>
                                            <div>
                                                <select class="form-select form-control" name="city" id="city_name">
                                                    <option value="">Select City</option>
                                                    <?php 
                                                        if(!empty($single)){
                                                            if($single->state != "" && $single->state != null && $single->state != '0'){
                                                                $city = $this->Salon_model->get_selected_state_city($single->state);
                                                            }else{
                                                                $city = $this->Salon_model->get_selected_state_city('4008');
                                                            }
                                                            if (!empty($city)) {
                                                                foreach ($city as $city_result) { 
                                                    ?>
                                                    <option value="<?= $city_result->id ?>" <?php if (!empty($single) && $single->city == $city_result->id) { ?>selected="selected" <?php } ?>>
                                                        <?= $city_result->name ?>
                                                    </option>
                                                    <?php }}} ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <label>Address</label>
                                            <input type="text" class="form-control" name="address" id="address" placeholder="Ente address" value="<?php if(!empty($single)){ echo $single->address; }?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <label>Custom Note</label>
                                            <textarea class="form-control" name="custom_note" id="custom_note" placeholder="Enter Customer Note"><?php if(!empty($single)){ echo $single->custom_note; }?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <label class="error" id="mobile_error" style="display:none;">Please select reminder type!</label>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <button class="btn btn-primary" type="submit" name="customer_button" id="customer_button" value="customer_button">Save</button>
                                    </div>
                                </div>
                            </form>
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
<script src="https://cdn.jsdelivr.net/npm/clockpicker/dist/jquery-clockpicker.min.js"></script>
<script>    
    $(document).ready(function () { 
        $("#dob").datepicker({
            dateFormat: 'dd-mm-yy',
            maxDate: '<?php echo date('Y-d-m'); ?>',
            changeMonth: true,
            changeYear: true,
            minDate: "-100y", 
            yearRange: "-100:+0", 
            maxDate: 0
        });    
        $("#DOA").datepicker({
            dateFormat: 'dd-mm-yy',
            maxDate: '<?php echo date('Y-d-m'); ?>',
            changeMonth: true,
            changeYear: true,
            minDate: "-100y", 
            yearRange: "-100:+0", 
            maxDate: 0
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
                email: {
                    email: true,
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
                email: {
                    email: 'Please enter valid email!',
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
    });
    $("#married_status").change(function() {
        var m_status = $("#married_status").val();
        if (m_status == 0) {
            $('.Anniversary-box').show();
        } else {
            $('.Anniversary-box').hide();
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
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
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
</script>