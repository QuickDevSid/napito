<?php include('header.php'); ?>
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
.booked {
        color: red;
    }
    .lunch-break{
        color: green;
    }

    .modal-backdrop.fade{
        opacity: 1 !important;
    }
    #myModal {
    background-color: white !important;
    display: none;
}
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Add New Booking
                </h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <form method="post" name="customer_form" id="customer_form" enctype="multipart/form-data">
            <div class="row">

                 <!-- customer details box -->

                <div class="col-md-3 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <div class="container">
                                <div class="row">
                                    <div class="x_title">
                                        <h3>Customer Details</h3>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <label>Phone<b class="require">*</b></label>
                                        <input type="text" class="form-control" name="phone" id="phone" placeholder="Search by mobile number">
                                        <div id="phone_not_found" style="display:none; color: red;"></div>
                                    </div>
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12 customer-btn"  style="display: none;">
                                    <div class="add-customer-btn col-md-12">Add New Customer</div>
                                </div>
                                <div class="row" style="text-align: center;"> 
                                    <div class="col-md-12 col-sm-12 col-xs-12 customer-profile-box" name="profile_photo" id="profile_photo"></div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <b name="customer_name_1" id="customer_name_1"></b>
                                    </div>
                                </div> 
                                <div class="row"> 
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                    </div>
                                </div>    
                            </div>
                        </div>
                    </div>
                </div>

                 <!-- add service details box -->

                <div class="col-md-5 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <div class="container">
                                    <div class="row">
                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <div class="x_title">
                                                <h3>Add Services</h3>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <label>Select Category<b class="require">*</b></label>
                                            <select class="form-select form-control chosen-select" name="sup_category" id="sup_category">
                                                <option>Select category</option>
                                                <?php if (!empty($category)) {
                                                    foreach ($category as $category_result) { ?>

                                                <option value="<?= $category_result->id ?>"
                                                    <?php if (!empty($single) && $single->sup_category == $category_result->id) { ?>selected="selected"
                                                    <?php } ?>><?= $category_result->sup_category?>/<?= $category_result->sup_category_marathi?></option>
                                                <?php }
                                                } ?>
                                            </select>
                                        </div>    
                                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <label>Select Package Name</label>
                                            <select class="form-select form-control chosen-select" name="package_name" id="package_name">
                                                <option value="">Select package name</option>
                                                    <?php if (!empty($package_list)) {
                                                        foreach ($package_list as $package_list_result) { ?>
                                                        <option value="<?= $package_list_result->id ?>"
                                                            <?php if (!empty($single) && $single->package_name == $package_list_result->id) { ?>selected="selected"
                                                            <?php } ?>><?= $package_list_result->package_name?></option>
                                                        <?php }
                                                    } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <div class="dropdown form-control-model col-md-12 col-sm-12 col-xs-12">
                                                <b class="btn btn-secondary dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Select Service
                                                </b>
                                                <div class="dropdown-menu form-control" aria-labelledby="dropdownMenuButton" style="list-style: none; transform: translate3d(0px, 0px, 0px);">
                                                    <div  class="service-option" name="service_name[]" id="service_name">
                                                    <!-- <div class="btn btn-primary">Save</div> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row pacakge-box" style="display: none;">
                                        <div class=" form-group col-md-6 col-sm-6 col-xs-12">
                                            <label>Actual Price<b class="require">*</b></label>
                                            <input type="text" name="actual_price" id="actual_price" class="form-control" placeholder="Select duration of service">
                                        </div>
                                        <div class=" form-group col-md-6 col-sm-6 col-xs-12">
                                            <label>Final Price<b class="require">*</b></label>
                                            <input type="text" name="amount" id="amount" class="form-control" placeholder="Select duration of service">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12 col-sm-12 col-xs-12" style="margin-top: 40px;">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>

                 <!-- service details box -->

                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <div class="container">
                                <h3 name="customer_name_2" id="customer_name_2"></h3>


                                <div class="row service_detail_box">
                                    <div class="add-service-box">
                                    </div>
                                </div>


                                <div class="row product_detail_box" style="display: none;">
                                    <div class="x_title">
                                        <h3>Product Details</h3>
                                    </div>
                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                       <div name="product_detail" id="product_detail"  class="form-group col-md-12 col-sm-12 col-xs-12"></div>
                                       <div name="total_product_amount" id="total_product_amount"  class="form-group col-md-12 col-sm-12 col-xs-12"></div>
                                    </div>
                                </div>


                                <div class="row pacakge_detail_box" style="display: none;">
                                    <div class="x_title col-md-12 col-sm-12 col-xs-12">
                                        <h3>Package Details</h3>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                          <div class="col-md-8 col-sm-6 col-xs-12"><b>Actual Pacakage Price</b></div>
                                          <div class="col-md-4 col-sm-6 col-xs-12" name="actual_price_detail" id="actual_price_detail"></div>
                                       </div>
                                       <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                          <div class="col-md-8 col-sm-6 col-xs-12"><b>After Discount Price</b></div>
                                          <div class="col-md-4 col-sm-6 col-xs-12" name="amount_detail" id="amount_detail"></div>
                                       </div>
                                    </div>
                                </div>


                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </form>    
    </div>

        <!-- product model************ -->

    <div class="product-modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                    <h4 class="modal-title" id="myModalLabel">Select Suggested Product</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-2 col-sm-6 col-xs-12" name="product_price_name_id" id="product_price_name_id"></div>
                        <div class="col-md-5 col-sm-6 col-xs-12" name="product_name" id="product_name"></div>
                        <div class="col-md-5 col-sm-6 col-xs-12" name="product_price" id="product_price"></div>
                    </div><hr>
                    <div class="row">
                    <div class="col-md-4 col-sm-6 col-xs-12"></div>
                    <div class="col-md-4 col-sm-6 col-xs-12"></div>
                       <div class="col-md-4 col-sm-6 col-xs-12" name="product_price_name_id" id="product_price_name_id">
                            <label>Total Product Price</label>
                            <input type="text" name="total_p_amount" id="total_p_amount" class="form-control ssff">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button style="margin-bottom: 5px;" type="button" class="btn btn-info" data-dismiss="modal">Save</button>
                    <button style="margin-bottom: 5px;" type="button" class="btn btn-default" data-dismiss="modal">close</button>
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


<!-- cancel product detail -->


<script type="text/javascript">
    function cancelproduct(p_price) {
        var totalProductAmount = parseFloat($("#total_p_amount").val()) || 0;
        console.log(totalProductAmount);
        console.log(p_price);
        $('#product_detail').find('[data-product-price="' + p_price + '"]').remove();
        $('#total_product_amount').html((totalProductAmount - p_price).toFixed(2));
    }
</script>



<!-- get product amount script -->

<script type="text/javascript">
    function showtotalamount(p_price, p_name) {
        var priceAsInt = parseInt(p_price, 10);
        if (!isNaN(priceAsInt)) {
            var currentTotal = parseInt($('#total_p_amount').val(), 10) || 0;
            var newTotal = currentTotal + priceAsInt;
            var total = newTotal.toFixed(2);
            $('#total_p_amount').val(newTotal.toFixed(2));
            $('#total_product_amount').html(newTotal.toFixed(2));
            var existingContent = $('#product_detail').html();
            $('#product_detail').html(existingContent + '<div data-product-price="' + p_price + '">' +
             p_name + ' --- ' + p_price + '<b onclick="cancelproduct(' + p_price + ')"><i class="fa-solid fa-xmark booked"></i></b></div>');
        }
    }
</script>


<!-- product and stylist model open script  -->

<script>
        function showProductModal(product_id,sub_category) {
            
            $(".product-modal").modal('show');
            $('.product_detail_box').show();
            $('#product_name').empty();
            $('#product_price').empty();
            $('#product_price_name_id').empty();
            // $('#stylist').empty();
            $('#product_detail').empty();
            $('#total_product_amount').val('');
            $('#total_p_amount').val('');
            $('#dropdownMenuButton').html(sub_category);

            $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>salon/Ajax_controller/get_product_details_for_booking_ajax",
            data: {
                'product_id': product_id,
            },
            success: function(data) {

            var parsedData = JSON.parse(data);
            
            if (parsedData.length > 0) {
                parsedData.forEach(function(record) {
                    var product_l = record.product.length;
                    var product_data = <?php echo json_encode($product_list)?>;
                    var product_length = product_data.length;
                  

                   
                        for (var i = 0; i < record.product.length; i++) {
                            var productId = record.product[i];
                            var productIndex = product_data.findIndex(product => product.id == productId);
                            if (productIndex !== -1) {
                                var productName = product_data[productIndex].product_name;
                                var productPrice = product_data[productIndex].selling_price;
                                $('#product_price_name_id').append('<input type="checkbox" onclick="showtotalamount(' + productPrice + ',\'' + productName + '\')" class="product_price_name_id"><br>');
                                $('#product_name').append(productName + '<br>');
                                $('#product_price').append(productPrice + '<br>');
                            }
                        }
                });
            }
           },

        });


        }
</script>


<!-- select service according to category script --> 

<script type="text/javascript">
    $("#sup_category").change(function() {
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>salon/Ajax_controller/get_service_details_for_booking_ajax",
            data: {
                'sup_category': $('#sup_category').val(),
            },
            success: function(data) {
                var parsedData = JSON.parse(data);
               
                if (parsedData.length > 0) {
                    parsedData.forEach(function(record) {
                        var p_count=0;
                        for (var i = 0; i < record.product.length; i++) {
                            if(record.product[i] !==  ','){
                               p_count++;
                            }    
                        }
                            $('#service_name').append('<div><input class="add-service-btn-check_'+ record.id +'"  onclick="showservicename(' +
                            record.id + ', \'' + record.sub_category + '|' + record.sub_category_marathi + '\')" type="checkbox" value=" '+ record.id +'">   ' +
                            record.sub_category + '|' + record.sub_category_marathi +
                            '<span><a href="" class="p-o-btn" data-toggle="modal" data-target="#myModal" onclick="showProductModal(' +
                            record.id + ', \'' + record.sub_category + '|' + record.sub_category_marathi + '\')">Suggeted Product('+ p_count +') </a></span></div>');
                    });
                }
                
            },
        });
    });
</script>


<!-- slot selection from list script -->

<script>
    $(document).ready(function () {
        $('.time-slot-box').on('click', 'li.time_slot_container', function () {
            var selectedTime = $(this).text();
            $('#time_slot').val(selectedTime);
            $(".time-slot-box").hide();
        });
    });
</script>

<!-- toggle buttons script -->

<script>
    $(document).ready(function() {
        $(".add-customer-btn").click(function() {
            $(".customer-info-box").toggle();
        });
    });
    $(document).ready(function() {
        $(".time_slot").click(function() {
            $(".time-slot-box").toggle();
        });
    });
</script>

<!-- stylist selection script -->

<!-- <script>
    $(document).ready(function() {
        var emp_selection = parseInt(<?=$single_rules_result->emp_selection?>);
        if (emp_selection === 1) {
            $(".stylist-box").show(); 
        } else {
            $(".stylist-box").hide(); 
        }
    });
</script> -->

<!-- get pacakge script -->

<script type="text/javascript">
    $("#package_name").change(function() {
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>salon/Ajax_controller/get_package_details_ajax",
            data: {'package_name_id': $('#package_name').val(),},
            success: function(data) {
                var parsedData = JSON.parse(data);
                console.log(parsedData.amount);
                $('.pacakge-box').show();
                $('.pacakge_detail_box').show();
                $('#amount').val(parsedData.amount);
                $('#actual_price').val(parsedData.actual_price);
                $('#actual_price_detail').html(parsedData.actual_price);
                $('#amount_detail').html(+parsedData.amount);

            },
        });
    });
</script>

<!-- validation script -->

<script>
    $('#value_check').change(function () {
		if ($('#value_check').val() == 'Yes') {
			$('.package-box').show();
		} else if ($('#value_check').val() == 'No') {
			$('.package-box').hide();
		}
	});
   $("#attendance_date").datepicker({
    dateFormat: "dd-mm-yy",
    changeMonth: true,
    changeYear: true,
    minDate: "+1D", 
    maxDate: "5",
     
   });

    jQuery.validator.addMethod("validate_email", function(value, element) {
                if (/^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/.test(value)) {
                    return true;
                }else {
                    return false;
                }
            }, "Please enter a valid Email!");  
  $(document).ready(function() {
    $('#customer_form').validate({
        ignore: " " ,
        rules: {
            "service_name[]": 'required',
            "price[]": 'required',
            "time_slot[]": 'required',
            customer_name: 'required',
            phone: {
						required: true,
						number: true,
						mobile_no: true,
						minlength: 10,
						maxlength: 10,
					},
            email: {
                       
                       required: true, 
                       validate_email:true,
                       noHTMLtags: true,
                   },
            address: 'required',
            // package_name: 'required',
            package_price: 'required',
        },
        messages: {
            "service_name[]": 'Please select service name!',
            "price[]": 'Please enter price!',
            "time_slot[]": 'Please select time slot!',
            customer_name: 'Please enter customer name!',
            phone:  {
						required: "Please enter mobile number!",
						number: "Only number allowed!",
						mobile_no: "Please enter valid number!",
						minlength: "Minimum 10 digit required!",
						maxlength: "Maximum 10 digit allowed!",
					},
           email: {
                        required: "Please enter email!", 
                        validate_email: "Please enter valid email!",
                        noHTMLtags: "HTML tags not allowed!",
                    },
            address: 'Please enter address!',
            // package_name: 'Please enter package name!',
            package_price: 'Please enter package price!',
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
    function initializeValidationForFields(index) {
        $("#service_name" + index).rules("add", {
            required: true,
            messages: {
                required: "Please select service name",
            },
        });
        $("#time_slot" + index).rules("add", {
            required: true,
            messages: {
                required: "Please select time slot",
            },
        });
        $("#price" + index).rules("add", {
            required: true,
            messages: {
                required: "Please select price",
            },
        });

    }
</script>

<!-- get stylist and product details script -->

<!-- <script type="text/javascript">
    $("#service_name").change(function() {
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>salon/Ajax_controller/get_stylistdetails_ajax",
            data: {
                'service_name_id': $('#service_name').val(),
            },
            success: function(data) {
                var parsedData = JSON.parse(data);

                if (parsedData.product) {
                    $('#product_div').show();
                    $("#product_select").empty();
                    $('#product_select').append('<option value="">Select product</option>');
                    $('#product_select').append('<option value="' + parsedData.id + '">' + parsedData.product + '</option>');
                } else {
                    $('#product_div').hide();
                }

                $('#price').val(parsedData.sub_category_price);

                $("#stylist").empty();
                $('#stylist').append('<option value="0">Select stylist</option>');
                $('#stylist').append('<option value="' + parsedData.id + '">' + parsedData.full_name + '</option>');
            },
        });
    }); -->
</script>

<!-- get customer details from phone script -->

<script type="text/javascript">
    $("#phone").keyup(function() {
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>salon/Ajax_controller/get_customer_details_ajax",
            data: {
                'phone': $('#phone').val(),
            },
            success: function(data) {
                var parsedData = JSON.parse(data);
                console.log(parsedData.phone);
                if(parsedData.phone){
                    $(".customer-info-box").show();
                    $(".customer-btn").hide();
                    $("#phone_1").val(parsedData.phone);
                    $('#email').val(parsedData.email);
                    $('#address').val(parsedData.address);
                    $('#customer_name_1').text(parsedData.customer_name);  
                    $('#customer_name_2').text(parsedData.customer_name);  
                } else{
                    $('#phone_not_found').text('Customer Not Found! Please Add New Customer.').show();
                    $(".customer-info-box").hide();
                    $(".customer-btn").show();
                }
            },
        });
    });
</script>

<!-- nav bar active script -->

<script>
    $(document).ready(function () {
		$('#booking_management .child_menu').hide();
		$('#booking_management').addClass('nv active');
		// $('.right_col').addClass('active_right');
		$('.add_new_booking').addClass('active_cc');
	});
</script>

<!-- add more services script -->

<script>
 function showservicename(product_id,english, marathi) {
    var checkBox = document.querySelector('.add-service-btn-check_' + product_id);
    if(checkBox.checked == false){
		$('#add_service_' + product_id).remove();
    } else {   
            $('#services_name').html(english + '|' + marathi+'<br>');
            $('.add-service-box').append('<div id="add_service_'+ product_id +'"><div class="row service_detail_box">\
                                            <div class="x_title">\
                                                <h3>Services Details</h3>\
                                            </div>\
                                            <div name="services_name" id="services_name"  class="form-group col-md-12 col-sm-12 col-xs-12">'+ english + '|' + marathi +'</div>\
                                            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">\
                                                <select class="form-select form-control" name="stylist[' + product_id + ']" id="stylist' + product_id + '">\
                                                    <option value="">Select Stylist</option>\
                                                </select>\
                                            </div>\
                                            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">\
                                                <select class="form-select form-control" id="time_slot_' + product_id + '" name="time_slot[' + product_id + ']">\
                                                    <option value="0">Select time slot</option>\
                                                </select>\
                                            </div>\
                                            <div class=" form-group col-md-6 col-sm-6 col-xs-12">\
                                                <input type="text" name="service_amount[' + product_id + ']" id="service_amount' + product_id + '" class="form-control" placeholder="Select service price">\
                                            </div>\
                                            <div class="form-group col-md-1 col-sm-6 col-xs-12">\
                                            <b class="service_delete" id="cancel-sercvice-btn"><i class="fa-solid fa-xmark booked"></i></b>\
                                            </div>\
                                        </div>\
                                            </div>');

                                            // initializeValidationForFields(x);

                                        $.ajax({
                                        type: "POST",
                                        url: "<?= base_url(); ?>salon/Ajax_controller/get_product_details_for_booking_ajax",
                                        data: {
                                            'product_id': product_id,
                                        },
                                        success: function(data) {

                                        var parsedData = JSON.parse(data);
                                        // console.log(parsedData);
                                        if (parsedData.length > 0) {
                                            parsedData.forEach(function(record) {
                                        
                                                var emp_data = <?php echo json_encode($salon_employee_list)?>;
                                                var emp_length = emp_data.length;
                                                var emp_name_length = record.emp_name.length;

                                                $('#service_amount' + product_id + '').val(record.sub_category_price);
                                                for (var k = 0; k < emp_name_length; k++) {
                                                    if( record.emp_name[k] !==  ','){
                                                        for (var n = 0; n < emp_length; n++) {
                                                            if(emp_data[n].id == record.emp_name[k]){
                                                                // console.log(emp_data[n].id );
                                                                $('#stylist' + product_id).append('<option value="' + emp_data[n].id + '">' + emp_data[n].full_name + '</option>');
                                                                $('#stylist' + product_id).on('change', function() {
                                                                    get_stylist_times_lot($(this).val());
                                                                });
                                                            }
                                                        }   
                                                    }  
                                                }
                                                    
                                            });
                                        }
                                    },

                                    });
           }
                                        
                                        
                                    
    }
</script>


<!-- Get Time slot  -->

<script>
    function get_stylist_times_lot(product_id) {
        var stylistId = product_id; 
       
        $.ajax({
            type: 'POST',
            url: "<?=base_url();?>salon/Ajax_controller/get_shift_name_for_employee", 
            data: { 'stylist_id': stylistId },
            success: function (response) {
                function formatTime(slot_hour, slot_minute) {
                    const formattedHour = String(slot_hour).padStart(2, '0');
                    const formattedMinute = String(slot_minute).padStart(2, '0');
                    const formattedTime = `${formattedHour}:${formattedMinute}`;
                    return formattedTime;
                }
                if(stylistId == '0'){
                    
                    var startTime =  <?=$single_rules_result->salon_start_time?>;
                    var endTime =<?=$single_rules_result->salon_end_time?>;
                    var duration = <?=$single_rules_result->session_avg_duration?>;
                    var offset = <?=$single_rules_result->offset_session_time?>;
                    var offset_btn = <?=$single_rules_result->on_off_btn?>;

                    const currentTime = new Date();
                    const currentHour = currentTime.getHours();
                    const currentMinute = currentTime.getMinutes();

                    let startTimeAdjusted = startTime;
                    if (currentHour > startTime || (currentHour === startTime && currentMinute > 0)) {
                        startTimeAdjusted = currentHour;
                    }
                    const adjustedHour = startTimeAdjusted % 12 || 12;

                    const formattedHour = adjustedHour.toString().padStart(2, '0');
                    const formattedMinute = currentMinute.toString().padStart(2, '0');

                    const currentSlot = `${formattedHour}:${formattedMinute}`;
                   


                    if (offset_btn == 1) {  
                        duration += offset;
                    }
                   
                    for (var slot_hour = formattedHour; slot_hour < endTime; slot_hour++) {
                        if((lunch_start !== slot_hour) && (stylistId !== stylist) ){
                            for (var slot_minute = 0; slot_minute < 60; slot_minute += duration) {
                               
                                const formattedTime = formatTime(slot_hour, slot_minute);
                                var isBooked = false;
                                if (book_time_slot === formattedTime) {
                                        isBooked = true;
                                }
                                    
                                if (isBooked) {
                                    $('#time_slot' + product_id + '').append('<li class="booked" disabled>This time slot is already booked!</li>');
                                }
                                else {
                                    if(formattedTime > currentSlot){
                                       $('#time_slot' + product_id + '').append('<option value="' + formattedTime + '">' + formattedTime + '</option>');
                                    }
                                }
                            }
                        }
                        else{
                                $('#time_slot' + product_id + '').append('<li class="lunch-break" disabled> Now stylist is on lunch Break!</li>');
                        }
                    }
                }else{
                    var parsedData = JSON.parse(response);
                    var salon_start_time = parseInt(parsedData.shift_in_time);
                    var salon_end_time = parsedData.shift_out_time;
                    var duration = parseInt(parsedData.session_avg_duration);
                    var offset = parseInt(parsedData.offset_session_time);
                    var offset_btn = parseInt(parsedData.on_off_btn);
                    var book_time_slot =  parsedData.time_slot;
                    var lunch_start =  parseInt(parsedData.lunch_start_time);
                    var stylistArray = parsedData.stylist;

                    const currentTime = new Date();
                    const currentHour = currentTime.getHours();
                    const currentMinute = currentTime.getMinutes();

                    let startTimeAdjusted = salon_start_time;
                    if (currentHour > salon_start_time || (currentHour === salon_start_time && currentMinute > 0)) {
                        startTimeAdjusted = currentHour;
                    }
                    const adjustedHour = startTimeAdjusted % 12 || 12;

                    const formattedHour = adjustedHour.toString().padStart(2, '0');
                    const formattedMinute = currentMinute.toString().padStart(2, '0');

                    const currentSlot = `${formattedHour}:${formattedMinute}`;
                
                    if (offset_btn == 1) {  
                        duration += offset;
                    }
                   
                    if(salon_end_time < currentSlot){
                        $('#time_slot' + product_id + '').append('<li class="lunch-break" disabled> This Stylist is not Available Now!</li>');          
                    }

                    for (var slot_hour = 1; slot_hour < 6; slot_hour++) {
                        if((lunch_start !== slot_hour) && (stylistId !== stylist) ){
                            for (var slot_minute = 0; slot_minute < 60; slot_minute += duration) {
                               
                                const formattedTime = formatTime(slot_hour, slot_minute);
                                var isBooked = false;
                                if (book_time_slot === formattedTime) {
                                        isBooked = true;
                                }
                                    
                                if (isBooked) {
                                    $('#time_slot' + product_id + '').append('<li class="booked" disabled>This time slot is already booked!</li>');
                                }
                                else {
                                    if(formattedTime) {
                                        console.log(formattedTime);
                                        console.log('time_slot_'+product_id);
                                        $('#time_slot' + product_id + '').append('<option value="' + formattedTime + '">' + formattedTime + '</option>');
                                        $('#time').append('<option value="' + formattedTime + '">' + formattedTime + '</option>');
                                   }
                                }
                            }
                        }
                        else{
                                $('#time_slot' + product_id + '').append('<li class="lunch-break" disabled> Now stylist is on lunch Break!</li>');
                        }
                    }
                }
            },
        });
}
</script> 
