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

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">

                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">


            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">

                    </div>
                    <div class="x_content">
                        <div class="container">
                            <form method="post" name="customer_form" id="customer_form" enctype="multipart/form-data">
                            <div class="row">
                            <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                       <h3>Customer Details</h3>
                                    </div>
                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Customer Name<b class="require">*</b></label>
                                        <input type="text" class="form-control" name="customer_name" id="customer_name" value="<?php if (!empty($single)) {
                                                echo $single->customer_name;
                                            } ?>" placeholder="Enter coupan code ">
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Phone<b class="require">*</b></label>
                                        <input type="text" class="form-control" name="phone" id="phone" value="<?php if (!empty($single)) {
                                                echo $single->phone;
                                            } ?>" placeholder="Enter coupan code ">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Email<b class="require">*</b></label>
                                        <input type="text" class="form-control" name="email" id="email" value="<?php if (!empty($single)) {
                                                echo $single->email;
                                            } ?>" placeholder="Enter coupan code ">
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label style="">Address<b class="require">*</b></label>
                                        <input type="text" class="form-control" name="address" id="address" value="<?php if (!empty($single)) {
                                                echo $single->address;
                                            } ?>" placeholder="Enter coupon offer">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                       <h3>Services Details</h3>
                                    </div>
                                    <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                        <label>Select Service Name<b class="require">*</b></label>
                                        <select class="form-select form-control chosen-select" name="service_name[]"
                                            id="service_name">
                                            <option value="" class="">Select Service Name</option>
                                            <?php if (!empty($service_booking)) {
                                                foreach ($service_booking as $service_booking_result) { ?>

                                            <option value="<?= $service_booking_result->id ?>"
                                                <?php if (!empty($single) && $single->service_name == $service_booking_result->id) { ?>selected="selected"
                                                <?php } ?>><?= $service_booking_result->sup_category?>/<?= $service_booking_result->sub_category_marathi?></option>
                                            <?php }
                                            } ?>
                                        </select>
                                        <input type="hidden" name="id" id="id"
                                            value="<?php if (!empty($single)) { echo $single->id; } ?>">
                                    </div>
                                    <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                        <label>Select Stylist<b class="require">*</b></label>
                                        <select class="form-select form-control" name="stylist[]" id="stylist">
                                            <option value="">Select Stylist</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                        <label>Price<b class="require">*</b></label>
                                        <input type="text" class="form-control" name="price[]" id="price" value="<?php if (!empty($single)) {
                                                echo $single->price;
                                            } ?>" placeholder="Enter coupan code ">
                                    </div>
                                    <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                        <label>Select Time Slot<b class="require">*</b></label>
                                        <select class="form-control" name="time_slot[]" id="time_slot" placeholder="Select Time Slot">
                                            <option></option>
                                            <?php
                                                if (!empty($shift_list)) {
                                                    foreach ($shift_list as $shift_list_result) {

                                                        $startTime = $shift_list_result->start_time;
                                                        $endTime = $shift_list_result->end_time;
                                                        $duration = $shift_list_result->session_avg_duration;
                                                        $offset = $shift_list_result->offset_session_time;
                                                        $offset_btn = $shift_list_result->on_off_btn;
                                                        
                                                        if ($offset_btn == '1') {
                                                            $duration =$duration + $offset;
                                                        }
                                                         
                                                        for ($hour = $startTime; $hour <= $endTime; $hour++) {
                                                            for ($minute = 0; $minute < 60; $minute += $duration) {

                                                                $time = sprintf('%02d:%02d', $hour, $minute);

                                                                $isBooked = false;

                                                                if (!empty($booking_list)) {
                                                                    foreach ($booking_list as $booking_list_result) {
                                                                        if ($booking_list_result->time_slot == $time) {
                                                                            $isBooked = true;
                                                                            break;
                                                                        }
                                                                    }
                                                                }

                                                                if ($isBooked) {
                                                                    echo '<option class="booked">This time slot is already booked!</option>';
                                                                } else {
                                                                    echo '<option value="' . $time . '" class="' . $class . '">' . $time . '</option>';
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                                ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="row add-service-box">
                                </div>    
                                <div class="row">
                                    <div class="form-group col-md-12 col-sm-6 col-xs-12" style="margin-top: 40px;">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                                        <b class="btn btn-info" id="add-sercvice-btn">Add Service <i class="fa-solid fa-plus"></i></b>
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
    jQuery.validator.addMethod("validate_email", function(value, element) {
                if (/^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/.test(value)) {
                    return true;
                }else {
                    return false;
                }
            }, "Please enter a valid Email.");  
$(document).ready(function() {
    $('#customer_form').validate({
        ignore: " ",
        rules: {
            "service_name[]": 'required',
            "price[]": 'required',
            "time_slot[]": 'required',
            "stylist[]": 'required',
            customer_name: 'required',
            phone: 'required',
            email: {
                       
                       required: true, 
                       validate_email:true,
                       noHTMLtags: true,
                   },
            address: 'required',
        },
        messages: {
            "service_name[]": 'Please select service name',
            "price[]": 'Please enter price',
            "time_slot[]": 'Please select time slot',
            "stylist[]": 'Please select stylist',
            customer_name: 'Please enter customer name',
            phone: 'Please enter phone number',
           email: {
                        required: "Please enter email", 
                        validate_email: "Please enter valid email",
                        noHTMLtags: "HTML tags not allowed!",
                    },
            address: 'Please enter address',
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
<script type="text/javascript">
$("#service_name").change(function() {
   
    $.ajax({
        type: "POST",
        url: "<?= base_url(); ?>salon/Ajax_controller/get_stylist_details_ajax",
        data: {
            'service_name_id': $('#service_name').val(),
        },
        success: function(data) {
                var parsedData = JSON.parse(data);
                $("#stylist").empty();
			    $('#stylist').append('<option value="">Select Stylist</option>');
                 $('#stylist').append('<option value="' + parsedData.id + '">' + parsedData.full_name + '</option>');
                
        },
    });
});


</script>

<script>
      $(document).ready(function () {
			$('#booking_management .child_menu').show();
			$('#booking_management').addClass('nv active');
			$('.right_col').addClass('active_right');
			$('.add_new_booking').addClass('active_cc');
		});
</script>
<script>
    var max_fields = 5000;
    var x = 0;

    $('#add-sercvice-btn').click(function (e) {
    e.preventDefault();
    if (x < max_fields) {
        x++;
        $('.add-service-box').append('<div class="row now"><div class="form-group col-md-3 col-sm-6 col-xs-12">\
                                        <label>Select Service Name<b class="require">*</b></label>\
                                        <select class="form-select form-control chosen-select" name="service_name[' + x + ']" id="service_name' + x + '">\
                                            <option value="" class="">Select Service Name</option>\
                                            <?php if (!empty($service_booking)) {  foreach ($service_booking as $service_booking_result) { ?>  <option value="<?= $service_booking_result->id ?>"<?php if (!empty($single) && $single->service_name == $service_booking_result->id) { ?>selected="selected"<?php } ?>><?= $service_booking_result->sup_category?>/<?= $service_booking_result->sub_category_marathi?></option><?php }} ?>\
                                        </select>\
                                        <input type="hidden" name="id" id="id" value="<?php if (!empty($single)) { echo $single->id; } ?>">\
                                    </div>\
                                    <div class="form-group col-md-3 col-sm-6 col-xs-12">\
                                        <label>Select Stylist<b class="require">*</b></label>\
                                        <select class="form-select form-control" name="stylist[' + x + ']" id="stylist' + x + '">\
                                            <option value="">Select Stylist</option>\
                                        </select>\
                                    </div>\
                                    <div class="form-group col-md-3 col-sm-6 col-xs-12">\
                                        <label>Price<b class="require">*</b></label>\
                                        <input type="text" class="form-control" name="price[' + x + ']" id="price' + x + '" value="<?php if (!empty($single)) { echo $single->price;} ?>" placeholder="Enter coupan code ">\
                                    </div>\
                                    <div class="form-group col-md-3 col-sm-6 col-xs-12">\
                                    <b style="margin-top: 30px;" class="btn btn-danger service_delete" id="cancel-sercvice-btn"><i class="fa-solid fa-trash"></i></b>\
                                    </div>\
                                    </div>');


								
								$('.service_delete').on('click', function() {
									$(this).closest('.now').remove();
								});
    }
});

</script>
<script>
    $(document).ready(function () {
    $('#stylist').on('change', function () {
        var stylistId = $(this).val();
        $.ajax({
            type: 'POST',
            url: "<?=base_url();?>salon/Ajax_controller/get_shift_name_for_employee", 
            data: { 'stylist_id': stylistId },
            success: function (response) {
                console.log(response);
            //     var shiftName = response.shift_name;
            //     $('#shiftNameDisplay').text(shiftName);
             },
            error: function (error) {
                console.log(error);
            }
        });
    });
});
</script>

