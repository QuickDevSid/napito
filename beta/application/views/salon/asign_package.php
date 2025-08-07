<?php include('header.php'); ?>
<style type="text/css">
    .error {
        color: red;
        float: left;
        /*    position: absolute;*/
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
        <div class="page-title">
                        <div class="title_left">
                            <h3>
                            Assign Package
                            </h3>
                        </div>
                    </div>
            <div class="x_panel">
                <div class="x_content">
                    <div class="container">
                        <form method="post" name="add_customer_form" id="add_customer_form" enctype="multipart/form-data">
                            <div class="row">
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
                                    <input <?php if(!empty($single)) { echo 'readonly';} ?> value="<?php if(!empty($single)) { echo $single->full_name;} ?>" autocomplete="off" type="text" class="customer-info form-control" name="full_name" id="full_name" placeholder="Enter full name">
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label>Select Gender<b class="require">*</b></label>
                                    <select class="form-select form-control chosen-select customer-info" onchange="get_packages()" name="gender" id="gender">
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
                                <div class="form-group col-md-4 col-sm-6 col-xs-12" id="package_div" style="display:none;">
                                    <label>Select Package <b class="require">*</b></label>
                                    <select class="form-select form-control chosen-select" name="package_id" id="package_id">
                                    <option value="" class="">Select Package</option>
                                        <?php if (!empty($package_list)) {
                                            foreach ($package_list as $membership_list_result) { ?>
                                            <option value="<?=$membership_list_result->id?>"><?= $membership_list_result->package_name ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <label>Package Price<b class="require">*</b></label>
                                    <input onkeyup="setGST()" value="<?php if(!empty($single)) { echo $single->membership_price;} ?>" autocomplete="off" type="text" class="form-control" name="price" id="price" placeholder="Enter price">
                                </div>
                                <?php if(!empty($single_profile) && $single_profile->is_gst_applicable == '1'){ ?>
                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <label>GST Amount <small><?php if(!empty($setup)) { echo '('.$setup->gst_rate.'%)';} ?></small></label>
                                    <input readonly value="" autocomplete="off" type="number" class="form-control" name="gst_amount" id="gst_amount" placeholder="Enter GST Amount">
                                    <input value="<?php if(!empty($setup)) { echo $setup->gst_rate;} ?>" type="hidden" name="gst_rate" id="gst_rate">
                                </div>
                                <?php } ?>
                            
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
                            </div>
							<hr>
                            <div class="row add-more-info" style="display: none;">
                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <label>Email</label>
                                    <input value="" autocomplete="off" type="text" class="form-control customer-info" name="email" id="email" placeholder="Enter email">
                                </div>
                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <label>Married Status</label>
                                    <select class="form-select form-control chosen-select customer-info" name="married_status" id="married_status">
                                        <option value="" class="">Select Status</option>
                                        <option value="0" class="">Married</option>
                                        <option value="1" class="">Unmarried</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4 col-sm-6 col-xs-12" id="anniversary_box" style="display: none">
                                    <label>Date Of Anniversary</label>
                                    <input type="text" value="" autocomplete="off" class="form-control customer-info datepicker_show" name="doa" id="doa" placeholder="DD-MM-YY">
                                </div>
                                <div class="form-group col-md-4 col-sm-6 col-xs-12" id="birth_box">
                                    <label>Date Of Birth</label>
                                    <input type="text" autocomplete="off" type="text" class="form-control customer-info datepicker_show" name="dob" id="dob" placeholder="DD-MM-YY">
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label>State</label>
                                    <select class="form-select form-control chosen-select customer-info" name="state" id="state">
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
                                        <select class="form-select form-control chosen-select customer-info" name="city" id="city">
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
                                    <input value="" autocomplete="off" type="text" class="form-control customer-info" name="address" id="address" placeholder="Ente address">
                                </div>
                            </div>
                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                <div class="show-more-box"><a href="#" id="show_more">Show More</a></div>
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
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="last_membership_box" style="border: 1px solid #ccc;background-color: white;max-width:500px; width:auto;"></div>
            </div>
        </div>
    <?php }?>
</div>


<?php include('footer.php');
$id = 0;
if ($this->uri->segment(2) != "") {
    $id = $this->uri->segment(2);
}
if(isset($_GET['phone'])){
    $selected_customer_phone = $_GET['phone'];
}else{
    $selected_customer_phone = '';
}
if(isset($_GET['customer'])){
    $selected_customer = $_GET['customer'];
}else{
    $selected_customer = '';
}
?>

<script>
var selected_customer = '<?php echo $selected_customer; ?>';
var selected_customer_phone = '<?php echo $selected_customer_phone; ?>';
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
			package_id: 'required',
			employee: 'required',
		},
		messages: {
			full_name: 'Please enter customer name!',
			employee: 'Please select employee!',
			package_id: 'Please select package!',
			customer_phone: {
				required: "Please enter phone number!",
				number: "Only number allowed!",
				// mobile_no: "Please enter valid number!",
				minlength: "Minimum 10 digit required!",
				maxlength: "Maximum 10 digit allowed!",
			},
			price: {
				required: "Please enter package price!",
				number: "Only number allowed!",
			},
			gender: 'Please select gender!',
			employee: 'Please select employee!',
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

    $('#package_id').on('change', function() {
        $('#package_id').valid();
    });

    if(selected_customer != "" && selected_customer_phone != ""){
        get_customer_info(selected_customer_phone,selected_customer);
    }
}); 
$("#show_more").click(function () {
	$('.add-more-info').toggle();
	$(this).text(function(i, text){
		return text === "Show More" ? "Show Less" : "Show More";
	});
});
    $("#customer_phone").keyup(function() {
        $('#package_id option').each(function() {
            $(this).prop('disabled', false);
        });
        $('#package_id').trigger('chosen:updated');
        $('#package_div').show(); 

        $('.last_membership_box').hide(); 
        $('.last_membership_box').html(''); 
        $('.customer-info').val(''); 
        $("#gender").trigger('chosen:updated');
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
        $('.last_membership_box').hide(); 
        $('.last_membership_box').html(''); 
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>salon/Ajax_controller/get_customer_package_details_ajax",
            data: {
                'phone':phone,
                'customer':id,
            },
            success: function(data) {
                var parsedData = JSON.parse(data);

                var customer = parsedData.single;
                var is_package = parsedData.is_package;
                var package_details = parsedData.package_details;
                var available_package_details = parsedData.available_package_details;
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

                    $("#package_id").empty();
                    $('#package_id').append('<option value="">Select Package</option>');
                    $.each(available_package_details, function(k, single_package) {
                        $('#package_id').append('<option value="' + single_package.id + '">' + single_package.package_name + '</option>');
                    });
                    $('#package_id').trigger('chosen:updated');   

                    var packages = '';
                    if(is_package == '1'){
                        $.each(package_details, function(i, d) {
                            $('#package_id option').each(function() {
                                if ($(this).val() == d.package_id) {
                                    $(this).prop('disabled', true);
                                }
                            });
                            packages += '<button class="btn btn-sm" style="float:left; background-color: ' + d.bg_color + '; color:' + d.text_color + ';">' + d.package_name + '</button>';
                        });
                        $('#package_id').trigger('chosen:updated');
                        $('.last_membership_box').show(); 
                        $('.last_membership_box').html('<p style="color:black;">The current active packages of '+ customer.full_name +':</p>');
                        $('.last_membership_box').append(packages);
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
                    
                    $.each(package_details, function(i, d) {
                        $('#package_id option').each(function() {
                            $(this).prop('disabled', false);
                        });
                        packages += '<button class="btn btn-sm" style="float:left; background-color: ' + d.bg_color + '; color:' + d.text_color + ';">' + d.package_name + '</button>';
                    }); 
                    $('#package_id').trigger('chosen:updated');
                    $('.last_membership_box').html('');
                }    
                $('#package_div').show();
                $('.error').text('');
                $('#customer_button').attr('disabled',false);
            }
        });
    } 
    $("#package_id").change(function() {
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>salon/Ajax_controller/get_package_info_ajax",
            data: {
                'package_id': $('#package_id').val(),
            },
            success: function(data) {
                var parsedData = JSON.parse(data);
                $('#price').val(parsedData.amount);

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
    function get_packages() {
        var gender = $('#gender').val();
        if(gender != ""){
            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>salon/Ajax_controller/get_salon_packages_ajx",
                data: {
                    'gender':gender,
                },
                success: function(data) {
                    $("#package_id").empty();
                    $('#package_id').append('<option value="">Select Package</option>');
                    var opts = $.parseJSON(data);
                    $.each(opts, function(i, d) {
                        $('#package_id').append('<option value="' + d.id + '">' + d.package_name + '</option>');
                    });
                    $('#package_id').trigger('chosen:updated');   
                }
            });
        }
    }
    $(document).ready(function() {
        $('#asign_membership .child_menu').show();
        $('#asign_membership').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.asign_package').addClass('active_cc');
    });
</script>
 