<?php include('header.php');?> 
<div class="right_col" role="main">
       
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Add Gift Card
					<a href="<?=base_url();?>admin_giftcard_list" class="btn btn-primary pull-right">Go to List</a>
                </h3>
            </div>

            <!-- <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">

                    </div>
                </div>
            </div> -->
        </div>
        <!-- <div class="clearfix"></div> -->

        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="container"> 
                                <form method="post" name="gift_form" id="gift_form" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class=" col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Gift Card Name<b class="require">*</b></label>
                                            <input autocomplete="off" type="text" class="form-control" name="gift_name" id="gift_name" value="<?php if (!empty($single)) { echo $single->gift_name;} ?>" placeholder="Enter gift card name">
                                            <input autocomplete="off" type="hidden" name="id" id="id" value="<?php if (!empty($single)) {echo $single->id;} ?>">
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Select Gender<b class="require">*</b></label>
                                            <select class="form-select form-control" name="gender" id="gender">
												<option value="" class="">Ex. Male/Female</option>
												<option id="male" value="0" <?php if ((!empty($single) && $single->gender == 0)) echo 'selected="selected"'; ?>>Male</option>
												<option id="female" value="1" <?php if ((!empty($single) && $single->gender == 1)) echo 'selected="selected"'; ?>>Female</option> 
                                            </select> 
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Gift Card Purchase Price<b class="require">*</b></label>
                                            <div id="price_div">
                                            <input autocomplete="off" type="text" class="form-control" name="regular_price" id="regular_price" value="<?php if (!empty($single)) {echo $single->regular_price;} ?>" placeholder="Gift Card Purchase Price">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">    
                                        <!--   <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <label>Discount In<small></small><b class="require">*</b></label>
                                            <select name="discount_in" id="discount_in" class="form-control">
                                                <option value="" >Ex. Percentage/Flat</option>
                                                <option value="0" <?php if ((!empty($single) && $single->discount_in == 0)) echo 'selected="selected"'; ?>>Percentage</option>
                                                <option value="1" <?php if ((!empty($single) && $single->discount_in == 1)) echo 'selected="selected"'; ?>>Flat</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Discount <b class="require">*</b></label>
                                            <input autocomplete="off" type="text" class="form-control" name="discount" id="discount" value="<?php if (!empty($single)) {echo $single->discount;} ?>" placeholder="Enter discount">
                                            <div class="discount_validation error" style="display: none;"></div> 
                                        </div>  -->
                                      <!-- <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Gift Card Worth Price<b class="require">*</b></label>
                                            <input autocomplete="off" type="text" class="form-control" name="gift_price" id="gift_price" value="<?php if (!empty($single)) {echo $single->gift_price;} ?>" placeholder="Gift Card Worth price">
                                        </div>  
                                       <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Minimum Booking Price<b class="require">*</b></label>
                                            <input autocomplete="off" type="text" class="form-control" name="min_booking_amt" id="min_booking_amt" value="<?php if (!empty($single)) {echo $single->min_booking_amt;} ?>" placeholder="Minimum Booking Price">
                                        </div> -->
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                            <label>Gift Card Code<b class="require">*</b></label>
                                            <div id="price_div">
                                                <input autocomplete="off" type="text" class="form-control" name="gift_card_code" id="gift_card_code" value="<?php if (!empty($single)) {echo $single->gift_card_code;} ?>" placeholder="Enter gift card code">
                                                <div class="gift_card_code_unique error"></div>
                                            </div>                                  
                                        </div>
                                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <div class="custom_fields_data">
                                                <label for="department_master">Button Background Color <b class="require">*</b></label>
                                                <input autocomplete="off" type="text" class="color_value_input" name="bg_color_input" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="<?php if(!empty($single)){echo $single->bg_color;}else{ echo '#bada55';} ?>" id="hexcolor"></input>
                                                <input autocomplete="off" type="color" id="colorpicker" class="color_input" name="bg_color" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="<?php if(!empty($single)){echo $single->bg_color;}else{ echo '#bada55';} ?>"> 
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <div class="custom_fields_data">
                                                <label for="department_master">Button Text Color <b class="require">*</b></label>
                                                <input autocomplete="off" type="text" class="button_text_color_input" name="text_color_input" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="<?php if(!empty($single)){echo $single->text_color;}else{ echo '#000000';} ?>" id="texthexcolor"></input>
                                                <input autocomplete="off" type="color" id="textcolorpicker" class="text_color_input" name="text_color" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="<?php if(!empty($single)){echo $single->text_color;}else{ echo '#000000';} ?>"> 
                                            </div>
                                        </div>
                                    </div>
                                    <pre></pre>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                            <button type="submit" id="submit" class="btn btn-primary">Submit</button>
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

</div>
</div>
<?php include('footer.php');
$id = 0;
if ($this->uri->segment(2) != "") {
    $id = $this->uri->segment(2);
}
?>


<script> 
    $(document).ready(function() {
        $.validator.addMethod('alphanumeric', function(value, element) {
            return this.optional(element) || /^[a-zA-Z0-9]+$/.test(value);
        }, 'Please enter only letters and numbers.');
        $('#gift_form').validate({
            ignore: ":hidden:not(select)",
            rules: {
                gift_name: 'required',
                gift_card_code: {
                    required: true,
                    alphanumeric: true,
                },
                gender: 'required',
                bg_color_input: 'required',
                text_color_input: 'required',
                regular_price: 'required',
                // gift_price: 'required',
                // min_booking_amt: 'required',
            },
            messages: {
                gift_name: 'Please enter gift name!',
                bg_color_input: 'Please select gift background color!',
                text_color_input: 'Please select gift color!',
                gift_card_code: {
                    required: "Please enter gift card code!",
                    alphanumeric: "Please enter a valid gift card code!",
                },
                gender: 'Please select gender!',
                regular_price: 'Please enter gift card purchase price!',
                // gift_price: 'Please enter gift card worth price',
                // min_booking_amt: 'Please enter minimum booking amount!',
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
            },
            submitHandler: function(form) {
                $('#invalid-feedback').hide();
                // Custom validation logic
                // var minBookingAmt = parseFloat($('#min_booking_amt').val());
                var regularPrice = parseFloat($('#regular_price').val());

                if (minBookingAmt <= regularPrice) {
                    // Custom error message
                    // $('#min_booking_amt').addClass('is-invalid');
                    $('<label class="error invalid-feedback" id="invalid-feedback">Minimum booking amount must be greater than regular price.</label>')
                        .insertAfter('#min_booking_amt');
                        $('#invalid-feedback').show();
                } else {
                    // If the custom validation passes, submit the form
                    form.submit();
                }
            }
        });
    });  

$("#gift_card_code").keyup(function () {
    var inputField = document.getElementById('gift_card_code');

    inputField.addEventListener('input', function() {
        this.value = this.value.toUpperCase();
    });
    $.ajax({
        type: "POST",
        url: "<?=base_url();?>admin/Ajax_controller/get_uinique_gift_code_ajax",
        data:{'gift_card_code':$("#gift_card_code").val(),'id':'<?=$id?>'},
        success: function(data) {
            if(data == "0"){
				$(".gift_card_code_unique").html('');
				$("#submit").show();
			}else{
				$(".gift_card_code_unique").html('This code is already generate!');
				$("#submit").hide();
			}
        },
    });
}); 

$(document).ready(function() {
        $(".chosen-select").chosen({
             
        });
    });
    $("#discount").keyup(function() {
        var discount = parseFloat($("#discount").val());
        var regular_price = parseFloat($('#regular_price').val());

        if(!isNaN(regular_price)){
            if($("#discount_in").val() !== ""){
                if(!isNaN($("#discount").val())){
                    if (discount > regular_price) {
                        $('.discount_validation').show();
                        $('.discount_validation').html("Discount can not be greater than regular price!");
                        // $('#gift_price').val(0);
                    }
                    else{
                        $('.discount_validation').hide();
                        if($('#discount_in').val() == 0){
                            if(100 < discount){
                                $('.discount_validation').show();
                                $('.discount_validation').html("Discount percantage can not be greater than 100!");
                                // $('#gift_price').val(0);
                            }else{
                                $('.discount_validation').hide();
                                var discounted_amount = regular_price - (regular_price * (discount / 100));
                                // $('#gift_price').val(discounted_amount);
                            }
                        }
                        else{
                            var discounted_amount = regular_price - discount;
                            // $('#gift_price').val(discounted_amount);
                        }
                    }
                }
                else{
                    // $('#gift_price').val(0); 
                }
            }
        }
       
        if($("#discount").val() == ""){
            // $('#gift_price').val(0); 
        }
        
    });
    $("#discount_in").change(function () {

        var regular_price=$('#regular_price').val(); 
        var discount=$('#discount').val(); 
       
         if(regular_price !== ""){
            if($('#discount').val() <= regular_price){
                if($('#discount_in').val() == 0){
                    if(100 < discount){
                        $('.discount_validation').show();
                        $('.discount_validation').html("Discount percantage can not be greater than 100!");
                        // $('#gift_price').val(0);
                    }else{
                        $('.discount_validation').hide();
                        var discounted_amount = regular_price - (regular_price * (discount / 100));
                        // $('#gift_price').val(discounted_amount);
                    }
                }
                else{
                    if(discount > regular_price){
                        $('.discount_validation').show();
                        $('.discount_validation').html("Discount can not be greater than regular price!");
                        // $('#gift_price').val(0);
                    }
                    else{
                        $('.discount_validation').hide();
                        var discounted_amount = regular_price - discount;
                        // $('#gift_price').val(discounted_amount);
                    }
                }
            }
            else{
                $('.discount_validation').show();
                $('.discount_validation').html("Discount can not be greater than regular price!");
                // $('#gift_price').val(0);
            }
        }
        if($("#discount").val() == ""){
            // $('#gift_price').val(0); 
        }

        
    });
    $("#service_name").change(function () {

        if($("#service_name").val()==null){
            $('#regular_price').val("0");
            // $('#gift_price').val("0");
        } 
    var total_service_price = parseFloat($('#regular_price').val());
    if (isNaN(total_service_price)) {
        total_service_price = 0; 
    }

    $.ajax({
        type: "POST",
        url: "<?=base_url();?>admin/Ajax_controller/get_service_price_details_ajax",
        data: {
            'service_name_id': $('#service_name').val(),
        },
        success: function(data) {
            var parsedData = JSON.parse(data);
            var tttt=0;
            if (parsedData.length > 0) {
                parsedData.forEach(function(record) {
                    tttt = tttt + parseFloat(record.final_price);
                });
            } 
            $('#regular_price').val(tttt);  

            var regular_price=$('#regular_price').val(); 
            var discount=$('#discount').val(); 
       
         if($('#discount').val() <= regular_price){
            if($('#discount_in').val() == 0){
                if(100 < discount){
                    $('.discount_validation').show();
                    $('.discount_validation').html("Discount percantage can not be greater than 100!");
                    // $('#gift_price').val(0);
                }else{
                    $('.discount_validation').hide();
                    var discounted_amount = regular_price - (regular_price * (discount / 100));
                    // $('#gift_price').val(discounted_amount);
                }
            }
            else{
                if(discount > regular_price){
                    $('.discount_validation').show();
                    $('.discount_validation').html("Discount can not be greater than regular price!");
                    // $('#gift_price').val(0);
                }
                else{
                    $('.discount_validation').hide();
                    var discounted_amount = regular_price - discount;
                    // $('#gift_price').val(discounted_amount);
                }
            }
        }
        else{
            $('.discount_validation').show();
            $('.discount_validation').html("Discount can not be greater than regular price!");
            // $('#gift_price').val(0);
        }
        if($("#discount").val() == ""){
            // $('#gift_price').val(0); 
        }
        },
    });
});

  $(document).ready(function() {
        $('#back-office .child_menu').show();
        $('#back-office').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.gift-setup').addClass('active_cc');
    }); 
</script>