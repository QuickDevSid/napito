<?php include('header.php'); ?>
<style type="text/css">
    .error {
        color: red;
        float: left;
        /*    position: absolute;*/
    }
    .page-title .title_left h3 {
    margin: 8px 0px;
    margin-left: 13px;
    font-size: 18px;
    font-weight: 800;
    color: var(--primary);
}

.customer-info-by-phone{
    width: 377px;
    height: auto;
    background-color: rgb(251 250 250);
    position: absolute;
    top: 70px;
    left: 11px;
    border-radius: 3px;
    z-index: 999;
    border: 1px solid gray;
    }
    .customer-info-by-phone div{
        padding: 4px;
    }
.customer-info-by-phone div:hover{
    background-color: #0f85d9;
    color: white;
    }

    input#gst_amount,input#transaction_id,input#dob{
        margin-top: 2px;
    }
    input#dob{
        margin-top: 0px;
    }
</style>
<div class="right_col" role="main">
<?php
        if($gst == ""){?>
        <div class="row"> 
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title" style="text-align: center;">
                        <img src="<?= base_url(); ?>\admin_assets\images\no_data\c_store.jpg">
                    </div>
                    <div style="text-align: center;font-size: 15px;">
                    Click to complete store profile <a style="color:blue;" class="store-profile" href="<?= base_url(); ?>store-profile">Store Profile</a>
                    </div>
                </div>
            </div>
        </div>
        <?php }else{?>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                            Assign Membership
                            </h3>
                        </div>
                    </div>
                
            </div>
            <div class="x_panel">
                <div class="x_content">
                    <div class="container">
                        <form method="post" name="add_customer_form" id="add_customer_form" enctype="multipart/form-data">
                            <div class="row flex_wrap">
                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <label>Phone Number <b class="require">*</b></label>
                                    <input value="<?php if(!empty($single)) { echo $single->customer_phone;} ?>" <?php if(!empty($single)) { echo 'readonly';} ?> maxlength="10" autocomplete="off" type="text" class="form-control" name="customer_phone" id="customer_phone" placeholder="Search customer by phone ">
                                    <input type="hidden" class="form-control" name="id" id="id" value="<?php if(!empty($single)) { echo $single->id;} ?>">
                                    <div class="customer-info-by-phone" style="display: none;" id="customer_div">
										<div></div>
                                    </div>
                                </div>
                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <label>Customer Name <b class="require">*</b></label>
                                    <input <?php if(!empty($single)) { echo 'readonly';} ?> value="<?php if(!empty($single)) { echo $single->full_name;} ?>" autocomplete="off" type="text" class="form-control" name="full_name" id="full_name" placeholder="Enter full name">
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label>Select Gender<b class="require">*</b></label>
                                    <select class="form-select form-control chosen-select"  onchange="get_memberships()" <?php if(!empty($single)) { echo 'disabled';} ?> name="gender" id="gender">
                                        <option value="">Select Gender</option>
                                        <?php if ($store_category->category == '0'){?>
                                            <option id="male" value="0" <?php if(!empty($single) && $single->gender == '0') { echo 'selected';} ?>>Male</option>
                                        <?php }?>
                                        <?php if ($store_category->category == '1'){?>
                                            <option id="female" value="1" <?php if(!empty($single) && $single->gender == '1') { echo 'selected';} ?>>Female</option>
                                        <?php }?>
                                        <?php if ($store_category->category == '2'){?>
                                            <option id="male" value="0" <?php if(!empty($single) && $single->gender == '0') { echo 'selected';} ?>>Male</option>
                                            <option id="female" value="1" <?php if(!empty($single) && $single->gender == '1') { echo 'selected';} ?>>Female</option>
                                        <?php }?>
                                    </select>
                                </div>
                            <!-- </div>
                            <div class="row"> -->
                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
									<label>Select Membership <b class="require">*</b></label>
									<select class="form-select form-control chosen-select" name="membership_id" id="membership_id">
									<option value="" class="">Select Membership</option>
										<?php if (!empty($membership_list)) {
											foreach ($membership_list as $membership_list_result) { ?>
											<option value="<?=$membership_list_result->id?>"><?= $membership_list_result->membership_name ?></option>
										<?php }
										} ?>
									</select>
								</div>
                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <label>Membership Price<b class="require">*</b></label>
                                    <input onkeyup="setGST()" value="<?php if(!empty($single)) { echo $single->membership_price;} ?>" autocomplete="off" type="text" class="form-control" name="price" id="price" placeholder="Enter price">
                                </div>
                                <?php if(!empty($single_profile) && $single_profile->is_gst_applicable == '1'){ ?>
                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <label>GST Amount <small><?php if(!empty($setup)) { echo '('.$setup->gst_rate.'%)';} ?></small></label>
                                    <input readonly value="" autocomplete="off" type="number" class="form-control" name="gst_amount" id="gst_amount" placeholder="Enter GST Amount">
                                    <input value="<?php if(!empty($setup)) { echo $setup->gst_rate;} ?>" type="hidden" name="gst_rate" id="gst_rate">
                                </div>
                                <?php } ?>
                            <!-- </div>
                            <div class="row"> -->
                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
									<label>Select Payment Mode <b class="require">*</b></label>
									<select class="form-select form-control chosen-select" name="payment_mode" id="payment_mode" onchange="setTransactionID()">
										<option value="">Select Payment Mode</option>
										<option value="UPI">UPI</option>
										<option value="Cash">Cash</option>
										<!-- <option value="Cheque">Cheque</option> -->
										<option value="Online">Online</option>
									</select>
								</div>
                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <label>Transaction ID</label>
                                    <input readonly type="text" placeholder="Enter Transaction ID" class="form-control" name="transaction_id" id="transaction_id" value="">
                                </div>
                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
									<label>Select Employee <b class="require">*</b></label>
                                    <select class="form-control chosen-select" id="employee" name="employee">   
                                        <option value="">Select Employee</option>
                                        <?php if(!empty($stylists)){ foreach($stylists as $employee_result){ ?>
                                            <option value="<?=$employee_result->id;?>"><?=$employee_result->full_name;?></option>
                                        <?php }} ?>
                                    </select>
                                    <label for="employee" style="display:none;" generated="true" class="error">Please select stylist!</label> 
								</div>
								<div class="form-group col-md-4 col-sm-6 col-xs-12">
                                    <label>Upload Payment Receipt<b class="require"></b></label>
                                    <input type="file" class="form-control" name="receipt" id="receipt">
                                    <input type="hidden" value="" class="form-control" name="old_file" id="old_file">
                                </div>
                            </div>
                            <div class="row">
								<div class="form-group col-md-8 col-sm-8 col-xs-12"></div>
								<hr>
                                <div class="add-more-info" style="display: none;">
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Email</label>
                                        <input value="" autocomplete="off" type="text" class="form-control" name="email" id="email" placeholder="Enter email">
                                    </div>
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Married Status</label>
                                        <select class="form-select form-control chosen-select" name="married_status" id="married_status">
                                            <option value="" class="">Select Status</option>
                                            <option value="0" class="">Married</option>
                                            <option value="1" class="">Unmarried</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12" id="anniversary_box" style="display: none">
                                        <label>Date Of Anniversary</label>
                                        <input type="text" value="" autocomplete="off" class="form-control datepicker_show" name="doa" id="doa" placeholder="DD-MM-YY">
                                    </div>
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12" id="birth_box">
                                        <label>Date Of Birth</label>
                                        <input type="text" autocomplete="off" type="text" class="form-control datepicker_show" name="dob" id="dob" placeholder="DD-MM-YY">
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                        <label>State</label>
                                        <select class="form-select form-control chosen-select" name="state" id="state">
                                            <option value="" class="">Select State</option>
                                            <?php 
		                                    $state = $this->Salon_model->get_india_state();
                                            if (!empty($state)) {
                                                foreach ($state as $state_result) { ?>
                                                    <option value="<?= $state_result->id ?>"><?=$state_result->name?></option>
                                            <?php }
                                            } ?>
                                        </select>

                                        <?php
                                        $city = array(); 
                                            // $city = $this->Admin_model->get_selected_state_city(4008); 
                                        ?>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                        <label>Select City</label>
                                        <div>
                                            <select class="form-select form-control chosen-select" name="city" id="city">
                                                <option value="">Select City</option>
                                                <?php if (!empty($city)) {
                                                    foreach ($city as $city_result) { ?>
                                                        <option value="<?=$city_result->id?>"><?=$city_result->name?></option>
                                                <?php }
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label>Address</label>
                                        <input value="" autocomplete="off" type="text" class="form-control" name="address" id="address" placeholder="Ente address">
                                    </div>
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <div class="show-more-box"><a href="#" id="show_more">Show More</a></div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-2">
                                    <button class="btn btn-primary" type="submit" id="customer_button" name="customer_button" value="customer_button">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php }?>
</div>


<?php include('footer.php');
$id = 0;
if ($this->uri->segment(2) != "") {
    $id = $this->uri->segment(2);
}
?>

<script>
            function setTransactionID(){
                payment_mode = $('#payment_mode').val();
                if(payment_mode == 'Cash'){
                    $('#transaction_id').attr('readonly', true);
                }else{
                    $('#transaction_id').attr('readonly', false);
                }
            }
$("#married_status").change(function () {
    var m_status = $("#married_status").val();  
	if(m_status == '0'){
		$("#anniversary_box").show();
		$("#birth_box").hide();
	}else{
		$("#birth_box").show();
		$("#anniversary_box").hide();
	}
});
$("#state").change(function(){  
    $.ajax({
        type: "POST",
        url: "<?=base_url()?>salon/Ajax_controller/get_city_ajax",
        data:{'state':$("#state").val()},
        success: function(data){ 
            console.log(data);
            $("#city").empty();
            $('#city').append('<option value="">Select City</option>');
            var opts = $.parseJSON(data);
            $.each(opts, function(i, d) {
                $('#city').append('<option value="' + d.id + '">' + d.name + '</option>');
            });
            $("#city").trigger("chosen:updated");;
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    }); 
});
jQuery.validator.addMethod("validate_email", function(value, element) {
	if (/^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/.test(value)) {
		return true;
	} else {
		return false;
	}
}, "Please enter a valid Email!");
$(document).ready(function() {
	$('#add_customer_form').validate({
		// ignore: ":hidden",
        ignore: ":hidden:not(select)",
		rules: { 
			full_name: 'required',
			employee: 'required',
			customer_phone: {
				required: true,
				number: true,
				// mobile_no: true,
				minlength: 10,
				maxlength: 10,
			},
			price: {
				required: true,
				number: true,
			},
			gender: 'required',
			membership_id: 'required',
			payment_mode: 'required',
		},
		messages: {
			full_name: 'Please enter customer name!',
			employee: 'Please select employee!',
			membership_id: 'Please select membership name!',
			customer_phone: {
				required: "Please enter phone number!",
				number: "Only number allowed!",
				// mobile_no: "Please enter valid number!",
				minlength: "Minimum 10 digit required!",
				maxlength: "Maximum 10 digit allowed!",
			},
			price: {
				required: "Please enter Membership price!",
				number: "Only number allowed!",
			},
			gender: 'Please select gender!',
			payment_mode: 'Please select payment mode!',
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


    $('#gender').on('change', function() {
        $('#gender').valid();
    });


    $('#payment_mode').on('change', function() {
        $('#payment_mode').valid();
    });

    $('#membership_id').on('change', function() {
        $('#membership_id').valid();
    });



}); 
$("#show_more").click(function () {
	$('.add-more-info').toggle();
	$(this).text(function(i, text){
		return text === "Show More" ? "Show Less" : "Show More";
	});
});
    $(document).ready(function() {
        $('#asign_membership .child_menu').show();
        $('#asign_membership').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.asign_membership').addClass('active_cc');
    }); 
    $("#customer_phone").keyup(function() {
        var keyword = $('#customer_phone').val();
        if (keyword.length >= 3) {
            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>salon/Ajax_controller/get_customer_details_ajax",
                data: {
                    'keyword': keyword,
                },
                success: function(data) {
                    var opts = JSON.parse(data);
                    if (opts.length > 0) {
                        $('#customer_div').show();
                        $('#customer_div').html('');
                        $.each(opts, function(i, d) {
                            $('#customer_div').append('<div class="customers_search_results" onclick="get_customer_info(' + d.customer_phone + ',' + d.id + ')">' + d.full_name + '[' + d.customer_phone + ']</div>');
                        });
                    }else{
                        $('#customer_div').html('Customer Not Found! Please Fill Customer Detail.').css('color', 'red');
                    }
                },
            });
        }else{
            $('#customer_div').hide();
            $('#customer_div').html('');
        }
    });
    function get_customer_info(phone,id) {
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>salon/Ajax_controller/get_customer_membership_details_ajax",
            data: {
                'phone':phone,
                'customer':id,
            },
            success: function(data) {
                var parsedData = JSON.parse(data);
                var customer = parsedData.single;
                var is_member = parsedData.is_member;
                var membership_details = parsedData.membership_details;
                if (customer.customer_phone == phone) {
                    $('#customer_div').hide();  
                    $('#id').val(customer.id);
                    $('#full_name').val(customer.full_name).attr('readonly',true);
                    $('#customer_phone').val(customer.customer_phone).attr('readonly',true);
                    $('#email').val(customer.email);
                    $('#dob').val(customer.dob); 
					$('#doa').val(customer.doa); 
                    $('#address').val(customer.address);
					
					var selected_state = customer.state; 
					$("#state").val(selected_state); 
					$("#state").trigger('chosen:updated');
					
					var selected_city = customer.city; 
					$("#city").val(selected_city); 
					$("#city").trigger('chosen:updated');  
					
					var selected_gender = customer.gender; 
					$("#gender").val(selected_gender); 
                    $("#gender").prop('disabled', true);
					$("#gender").trigger('chosen:updated');
				 	
					var selected_married_status = customer.married_status; 
					$("#married_status").val(selected_married_status); 
					$("#married_status").trigger('chosen:updated');

                    if(is_member == '1'){
                        // console.log(parsedData);
                        $('.last_membership_box').show(); 
                        $('.last_membership_box').html('The current membership for '+ customer.full_name +' is '+ membership_details.membership_name +'');
                        $('.last_membership_box').css('background-color', membership_details.bg_color);
                        $('#customer_button').attr('disabled',true);
                    }else{                        
                        $('#customer_button').attr('disabled',false);
                    }                
                }else{                    
                    $('#id').val('');
                    $('#full_name').val('').removeAttr('readonly',true);
                    $('#customer_phone').val('').removeAttr('readonly',true);
                    $('#email').val('');
                    $('#dob').val(''); 
					$('#doa').val(''); 
                    $('#address').val('');
					
					var selected_state = customer.state; 
					$("#state").val(''); 
					$("#state").trigger('chosen:updated');
					
					var selected_city = customer.city; 
					$("#city").val(''); 
					$("#city").trigger('chosen:updated');  
					
					var selected_gender = customer.gender; 
					$("#gender").val(''); 
                    $("#gender").prop('disabled', false);
					$("#gender").trigger('chosen:updated');
				 	
					var selected_married_status = customer.married_status; 
					$("#married_status").val(''); 
					$("#married_status").trigger('chosen:updated');
                    
                    $('.last_membership_box').html('');
                    $('#customer_button').attr('disabled',false);    
                }
                get_memberships();
                $('.error').text('');
                $('#customer_button').attr('disabled',false);
            }
        });
    } 
    $("#membership_id").change(function() {
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>salon/Ajax_controller/get_membership_info_ajax",
            data: {
                'membership_id': $('#membership_id').val(),
            },
            success: function(data) {
                var parsedData = JSON.parse(data);
                $('#price').val(parsedData.membership_price);

                setGST();
            },
        });
    });
    function setGST(){
        var rate = $('#gst_rate').val();
        if(rate == ""){
            rate = 0.00;
        }else{
            rate = parseFloat(rate);
        }
        var price = $('#price').val();
        if(price == ""){
            price = 0.00;
        }else{
            price = parseFloat(price);
        }
        gst_amount = price * (rate / 100);
        $('#gst_amount').val(parseFloat(gst_amount).toFixed(2));
    }
    function get_memberships() {
        var gender = $('#gender').val();
        if(gender != ""){
            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>salon/Ajax_controller/get_salon_memberships_ajx",
                data: {
                    'gender':gender,
                },
                success: function(data) {
                    $("#membership_id").empty();
                    $('#membership_id').append('<option value="">Select Membership</option>');
                    var opts = $.parseJSON(data);
                    $.each(opts, function(i, d) {
                        $('#membership_id').append('<option value="' + d.id + '">' + d.membership_name + '</option>');
                    });
                    $('#membership_id').trigger('chosen:updated');   
                }
            });
        }
    }
</script>
 