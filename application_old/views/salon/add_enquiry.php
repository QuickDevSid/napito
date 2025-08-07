<?php include('header.php'); ?>
<style type="text/css">
    .list_radio {
        display: flex;
        gap: 10px;
        align-items: center;
        /* align-content: center; */
        justify-content: center;
    }

    input[type="radio"] {
        height: 15px;
        width: 15px;
        margin-top: -4px;
    }

    .WrapRow {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
        width: 95%;
        margin: 0 auto;
    }

    .add_enquiry_form .form-control {
        margin: 0px !important;
    }

    .add_enquiry_form {
        text-align: left !important;
    }

    .add_reminder_form .form-control {
        margin: 0px !important;
    }

    .add_reminder_form {
        text-align: left !important;
    }

    .error {
        color: red;
        float: left;
        /*    position: absolute;*/
    }

    .customer-info-by-phone {
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

    .customer-info-by-phone div {
        padding: 4px;
    }

    .customer-info-by-phone div:hover {
        background-color: #0f85d9;
        color: white;
    }
</style>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left" style="width:100%;">
                <h3>
                    Add Enquiry <a style="float:right;" class="btn btn-primary" href="<?= base_url(); ?>all-enquiries">All Enquiries</a>
                </h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="container">
                            <form id="add_enquiry_form" class="add_enquiry_form" name="add_enquiry_form" method="post" action="<?= base_url(); ?>add-enquiry" enctype="multipart/form-data" data-parsley-validate>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                        <label>Phone Number <b class="require">*</b></label>
                                        <input value="<?php if (!empty($single)) {
                                                            echo $single->customer_phone;
                                                        } ?>" maxlength="10" autocomplete="off" type="text" class="form-control" name="customer_phone" id="customer_phone" placeholder="Search customer by phone ">
                                        <input value="" type="hidden" class="form-control" name="id" id="id">
                                        <div class="customer-info-by-phone" style="display: none;" id="customer_div">
                                            <div></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12  form-group">
                                        <label>Customer Name <b class="require">*</b></label>
                                        <input value="<?php if (!empty($single)) {
                                                            echo $single->full_name;
                                                        } ?>" autocomplete="off" type="text" class="form-control" name="full_name" id="full_name" placeholder="Enter full name">
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12  form-group">
                                        <label>Select Gender<b class="require">*</b></label>
                                        <select class="form-select form-control chosen-select" name="gender" id="gender">
                                            <option value="">Select Gender</option>
                                            <option value="0">Male</option>
                                            <option value="1">Female</option>
                                        </select>
                                        <label for="gender" generated="true" class="error" style="display:none;">Please select gender!</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12  form-group" style="float:right">
                                        <label style="visibility:hidden;">Select Gender<b class="require">*</b></label>
                                        <div class="" style="text-align:end;"><a style="" id="show_more">Show More </a></div>
                                    </div>
                                </div>
                                <div class="row add-more-info" style="display: none;">
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12  form-group">
                                        <label>Email</label>
                                        <input value="" autocomplete="off" type="text" class="form-control" name="email" id="email" placeholder="Enter email">
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12  form-group">
                                        <label>Married Status</label>
                                        <select class="form-select form-control chosen-select" name="married_status" id="married_status">
                                            <option value="" class="">Select Status</option>
                                            <option value="0" class="">Married</option>
                                            <option value="1" class="">Unmarried</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12  form-group">
                                        <label>Date Of Anniversary</label>
                                        <input type="text" value="" autocomplete="off" class="form-control" name="doa" id="doa" placeholder="DD-MM-YY">
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12  form-group">
                                        <label>Date Of Birth</label>
                                        <input type="text" autocomplete="off" type="text" class="form-control" name="dob" id="dob" placeholder="DD-MM-YY">
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12  form-group">
                                        <label>State</label>
                                        <select class="form-select form-control chosen-select" name="state" id="state">
                                            <option value="" class="">Select State</option>
                                            <?php
                                            $state = $this->Salon_model->get_india_state();
                                            if (!empty($state)) {
                                                foreach ($state as $state_result) { ?>
                                                    <option value="<?= $state_result->id ?>"><?= $state_result->name ?></option>
                                            <?php }
                                            } ?>
                                        </select>
                                        <?php
                                        $city = array();
                                        $city = $this->Admin_model->get_selected_state_city(4008);
                                        ?>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12  form-group">
                                        <label>Select City</label>
                                        <div>
                                            <select class="form-select form-control chosen-select" name="city" id="city">
                                                <option value="">Select City</option>
                                                <?php if (!empty($city)) {
                                                    foreach ($city as $city_result) { ?>
                                                        <option value="<?= $city_result->id ?>"><?= $city_result->name ?></option>
                                                <?php }
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                        <label>Address</label>
                                        <input value="" autocomplete="off" type="text" class="form-control" name="address" id="address" placeholder="Ente address">
                                    </div>
                                </div>
                                <hr>
                                <div class="row flex_wrap">
                                    <!-- <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12  form-group">
                                        <label for="fullname">Select Service<b class="require">*</b></label>
                                        <select class="form-control choosen chosen-select" id="service" name="service">
                                        <option value="">Select Service</option>
                                        <?php
                                        $services = $this->Salon_model->get_all_salon_services();
                                        if (!empty($services)) {
                                            foreach ($services as $services_result) {
                                        ?>
                                        <option value="<?= $services_result->id; ?>"><?= $services_result->service_name . '|' . $services_result->service_name_marathi; ?></option>
                                        <?php }
                                        } ?>
                                        </select>
                                        <label for="service" style="display:none;" generated="true" class="error">Please select customer!</label>
                                    </div>   -->
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12  form-group">
                                        <label for="fullname">Enquiry Service Category<b class="require">*</b></label>
                                        <input type="text" class="form-control" placeholder="Enter Enquiry Service Category" name="enquiry_services" id="enquiry_services" value="">
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12  form-group">
                                        <label for="fullname">Enquiry Date<b class="require">*</b></label>
                                        <input type="text" readonly class="form-control inquiry_datepicker" placeholder="To Service Date" name="enquiry_date" id="enquiry_date" value="<?= date('d-m-Y'); ?>">
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12  form-group">
                                        <label for="fullname">Follow-Up Date<b class="require">*</b></label>
                                        <input type="text" readonly class="form-control inquiry_datepicker" placeholder="Select Follow-Up Date" name="date" id="date" value="">
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12  form-group">
                                        <label for="fullname">Follow-Up Time<b class="require">*</b></label>
                                        <input type="text" readonly class="form-control custom_time" placeholder="Select Follow-Up Time" name="time" id="time" value="<?= date('h:iA', strtotime('10:00:00')); ?>">
                                    </div>
                                    <!-- </div> -->
                                    <input type="hidden" name="redirect_to" id="redirect_to" value="1">
                                    <!-- <div class="row"> -->
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12  form-group">
                                        <label for="fullname">Assigned To<b class="require">*</b></label>
                                        <select class="form-control choosen chosen-select" id="employee" name="employee">
                                            <option value="">Select Employee</option>
                                            <?php
                                            $employees = $this->Salon_model->get_all_salon_employees();
                                            if (!empty($employees)) {
                                                foreach ($employees as $services_result) {
                                            ?>
                                                    <option value="<?= $services_result->id; ?>"><?= $services_result->full_name; ?></option>
                                            <?php }
                                            } ?>
                                        </select>
                                        <label for="employee" style="display:none;" generated="true" class="error">Please select customer!</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label for="fullname" style="margin-bottom: 15px;">Enquiry Type<b class="require">*</b></label>
                                        </div>
                                        <div class="WrapRow">
                                            <div class="list_radio">
                                                <label for="fullname">Not Interested</label>
                                                <input type="radio" style="height: 15px; width: 15px; margin: 0px;" class="form-control" name="type" id="not_interested" value="Not Interested">
                                            </div>
                                            <div class="list_radio">
                                                <label for="fullname">Hot</label>
                                                <input type="radio" style="height: 15px; width: 15px; margin: 0px;" class="form-control" name="type" id="hot" value="Hot">
                                            </div>
                                            <div class="list_radio">
                                                <label for="fullname">Cold</label>
                                                <input type="radio" style="height: 15px; width: 15px; margin: 0px;" class="form-control" name="type" id="cold" value="Cold">
                                            </div>
                                            <div class="list_radio">
                                                <label for="fullname">Warm</label>
                                                <input type="radio" style="height: 15px; width: 15px; margin: 0px;" class="form-control" name="type" id="warm" value="Warm">
                                            </div>

                                            <label for="type" style="display:none;" generated="true" class="error">Please select enquiry type!</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">

                                        <label for="fullname" style="margin-bottom: 15px;">Mode<b class="require">*</b></label>

                                        <div class="WrapRow">
                                            <div class="list_radio">
                                                <label for="fullname">Whastapp</label>
                                                <input type="radio" checked style="height: 15px; width: 15px; margin: 0px;" class="form-control" name="mode" id="sms" value="3">
                                            </div>
                                            <div class="list_radio">
                                                <label for="fullname">Phone</label>
                                                <input type="radio" style="height: 15px; width: 15px; margin: 0px;" class="form-control" name="mode" id="phone" value="2">
                                            </div>
                                            <div class="list_radio">
                                                <label for="fullname">Email</label>
                                                <input type="radio" style="height: 15px; width: 15px; margin: 0px;" class="form-control" name="mode" id="email" value="1">
                                            </div>
                                        </div>
                                        <label for="mode" style="display:none;" generated="true" class="error">Please select enquiry type!</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 form-group">
                                        <label for="fullname">Description<b class="require">*</b></label>
                                        <textarea class="form-control" placeholder="Enter Description" name="description" id="description"></textarea>
                                    </div>
                                </div>

                                <div class="error" id="status_error_new_2"></div>
                                <div class="row">
                                    <div class="col-md-2  col-sm-3 col-xs-12">
                                        <button type="submit" id="submit_enquiry_button" class="btn btn-success" style="margin-top:25px;">Submit</button>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <input type="hidden" name="selected_married_status" id="selected_married_status" value="">
                                <input type="hidden" name="selected_state" id="selected_state" value="">
                                <input type="hidden" name="selected_gender" id="selected_gender" value="">
                                <input type="hidden" name="selected_city" id="selected_city" value="">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="loader_div">
    <div class="loader-new"></div>
</div>
<?php include('footer.php'); ?>
<script>
    $(document).ready(function() {
        $("#dob").datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
            maxDate: "+0y",
            minDate: "-100y",
            yearRange: "-100:+0",
        });
        $("#doa").datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
            maxDate: "+0y",
            minDate: "-100y",
            yearRange: "-100:+0",
        });
        $(".inquiry_datepicker").datepicker({
            dateFormat: "dd-mm-yy",
            changeMonth: true,
            changeYear: true,
            maxDate: "+10Y", // Maximum date is 10 years from today
            minDate: "-100Y", // Minimum date is 100 years ago from today
            yearRange: "-100:+10" // Year range from 100 years ago to 10 years in the future
        });
        $(".chosen-option").chosen();
        $('#time').clockpicker({
            donetext: 'Done',
            twelvehour: true
        });
        $("#add_enquiry_form").validate({
            ignore: [],
            rules: {
                employee: "required",
                customer_phone: {
                    required: true,
                    minlength: 10,
                    maxlength: 10,
                    digits: true
                },
                gender: "required",
                full_name: "required",
                description: "required",
                type: "required",
                mode: "required",
                time: "required",
                date: "required",
                enquiry_date: "required",
                // service: "required",
                enquiry_services: "required",
            },
            messages: {
                employee: "Please select employee!",
                customer_phone: {
                    required: "Please select customer phone!",
                    minlength: "Phone number must be exactly 10 digits",
                    maxlength: "Phone number must be exactly 10 digits",
                    digits: "Phone number must contain only digits"
                },
                gender: "Please select gender!",
                full_name: "Please enter customer name!",
                description: "Please enter description!",
                type: "Please select enquiry type!",
                mode: "Please select mode!",
                time: "Please select follow-up time!",
                enquiry_date: "Please select enquiry date!",
                date: "Please select follow-up date!",
                // service: "Please select service!",
                enquiry_services: "Please enter services!",
            },
            submitHandler: function(form) {
                if (confirm("Do you want to submit the form?")) {
                    form.submit();
                }
            }
        });
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
                    console.log()
                    if (opts.length > 0) {
                        $('#customer_div').show();
                        $('#customer_div').html('');
                        $.each(opts, function(i, d) {
                            $('#customer_div').append('<div class="customers_search_results" onclick="get_customer_info(' + d.customer_phone + ',' + d.id + ')">' + d.full_name + '[' + d.customer_phone + ']</div>');
                        });
                    } else {
                        $('#customer_div').html('Customer Not Found! Please Fill Customer Detail.').css('color', 'red');
                    }
                },
            });
        } else {
            $('#customer_div').hide();
            $('#customer_div').html('');
        }
    });

    function get_customer_info(phone, id) {
        $("#gender").attr('disabled', false);
        $("#state").attr('disabled', false);
        $("#city").attr('disabled', false);
        $("#married_status").attr('disabled', false);
        $("#selected_state").val('');
        $("#selected_city").val('');
        $("#selected_gender").val('');
        $("#selected_married_status").val('');
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>salon/Ajax_controller/get_customer_membership_details_ajax",
            data: {
                'phone': phone,
                'customer': id,
            },
            success: function(data) {
                var parsedData = JSON.parse(data);
                var customer = parsedData.single;
                var is_member = parsedData.is_member;
                var membership_details = parsedData.membership_details;
                if (customer.customer_phone == phone) {
                    $('#customer_div').hide();
                    $('#id').val(customer.id);
                    $('#full_name').val(customer.full_name).attr('readonly', true);
                    $('#customer_phone').val(customer.customer_phone).attr('readonly', true);
                    $('#email').val(customer.email).attr('readonly', true);
                    customer.dob != "" && customer.dob != "0000-00-00" && customer.dob != "1970-01-01" ? $('#dob').val(customer.dob) : $('#dob').val('');
                    customer.doa != "" && customer.doa != "0000-00-00" && customer.doa != "1970-01-01" ? $('#doa').val(customer.doa) : $('#doa').val('');
                    $('#address').val(customer.address).attr('readonly', true);

                    var selected_state = customer.state;
                    if (selected_state != "") {
                        $("#state").attr('disabled', true);
                        $("#selected_state").val(selected_state);
                    }
                    $("#state").val(selected_state)
                    $("#state").trigger('chosen:updated');

                    var selected_city = customer.city;
                    if (selected_city != "") {
                        $("#city").attr('disabled', true);
                        $("#selected_city").val(selected_city);
                    }
                    $("#city").val(selected_city);
                    $("#city").trigger('chosen:updated');

                    var selected_gender = customer.gender;
                    if (selected_gender != "") {
                        $("#gender").attr('disabled', true);
                        $("#selected_gender").val(selected_gender);
                    }
                    $("#gender").val(selected_gender);
                    $("#gender").trigger('chosen:updated');

                    var selected_married_status = customer.married_status;
                    if (selected_married_status != "") {
                        $("#married_status").attr('disabled', true);
                        $("#selected_married_status").val(selected_married_status);
                    }
                    $("#married_status").val(selected_married_status);
                    $("#married_status").trigger('chosen:updated');

                    if (is_member == '1') {
                        $('.last_membership_box').show();
                        $('.last_membership_box').html('The current membership for ' + customer.full_name + ' is ' + membership_details.membership_name + '');
                        $('.last_membership_box').css('background-color', membership_details.bg_color);
                        $('#customer_button').attr('disabled', true);
                    } else {
                        $('#customer_button').attr('disabled', false);
                    }
                    $('.error').text('');
                    $('#customer_button').attr('disabled', false);
                }
            }
        });
    }
    $("#married_status").change(function() {
        var m_status = $("#married_status").val();
        if (m_status == 0) {
            $('.Anniversary-box').show();
        } else {
            $('.Anniversary-box').hide();
        }
    });
    $("#show_more").click(function() {
        $('.add-more-info').toggle();
        $(this).text(function(i, text) {
            return text === "Show More" ? "Show Less" : "Show More";
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#enquiry .child_menu').show();
        $('#enquiry').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.add_enquiry').addClass('active_cc');
    });
</script>