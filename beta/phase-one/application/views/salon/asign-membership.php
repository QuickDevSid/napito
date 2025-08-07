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
            <div class="col-md-12 col-sm-12 col-xs-12">
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
            <div class="col-md-12">
                <div class="last_membership_box"></div>
            </div>
            <div class="x_panel">
                <div class="x_content">
                    <div class="container">
                        <form method="post" name="add_customer_form" id="add_customer_form" enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                    <label>Phone Number <b class="require">*</b></label>
                                    <input value="<?php if(!empty($single)) { echo $single->customer_phone;} ?>" maxlength="10" autocomplete="off" type="text" class="form-control" name="customer_phone" id="customer_phone" placeholder="Search customer by phone ">
                                    <input value="<?php if(!empty($single)) { echo $single->id;} ?>" type="hidden" class="form-control" name="id" id="id">
                                    <div class="customer-info-by-phone" style="display: none;">
                                      <div></div>
                                    </div>
                                </div>
                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                    <label>Customer Name <b class="require">*</b></label>
                                    <input value="<?php if(!empty($single)) { echo $single->full_name;} ?>" autocomplete="off" type="text" class="form-control" name="full_name" id="full_name" placeholder="Enter full name">
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                    <label>Select Gender<b class="require">*</b></label>
                                    <select class="form-select form-control" name="gender" id="gender" onchange="get_memberships()">
                                        <option value="">Select Gender</option>
                                        <option value="0" <?php if ((!empty($single) && $single->gender == 0)) echo 'selected="selected"'; ?>>Male</option>
                                        <option value="1" <?php if ((!empty($single) && $single->gender == 1)) echo 'selected="selected"'; ?>>Female</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                            <label>Select Membership <b class="require">*</b></label>
                                            <select class="form-select form-control" name="membership_id" id="membership_id">
                                            <option value="" class="">Select Membership</option>
                                                <?php if (!empty($membership_list)) {
                                                    foreach ($membership_list as $membership_list_result) { ?>
                                                    <option value="<?= $membership_list_result->id ?>" <?php if (!empty($single) && $single->membership_id == $membership_list_result->id) { ?>selected="selected" <?php } ?>><?= $membership_list_result->membership_name ?></option>
                                                <?php }
                                                } ?>
                                            </select>
                                        </div>
                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                    <label>Membership Price<b class="require">*</b></label>
                                    <input value="<?php if(!empty($single)) { echo $single->membership_price;} ?>" autocomplete="off" type="text" class="form-control" name="price" id="price" placeholder="Enter price">
                                </div>
                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                <label>Select Payment Mode <b class="require">*</b></label>
                                <select class="form-select form-control" name="membership_mode" id="membership_mode">
                                    <option value="">Select Payment Mode</option>
                                    <option value="UPI" <?php if ((!empty($single) && $single->membership_mode == "UPI")) echo 'selected="selected"'; ?>>UPI</option>
                                    <option value="Cash" <?php if ((!empty($single) && $single->membership_mode == "Cash")) echo 'selected="selected"'; ?>>Cash</option>
                                    <option value="Cheque" <?php if ((!empty($single) && $single->membership_mode == "Cheque")) echo 'selected="selected"'; ?>>Cheque</option>
                                    <option value="Online" <?php if ((!empty($single) && $single->membership_mode == "Online")) echo 'selected="selected"'; ?>>Online</option>
                                </select>
                            </div>
                                <div class="add-more-info" style="display: none;">
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        <label>Email</label>
                                        <input value="<?php if(!empty($single)) { echo $single->email;} ?>" autocomplete="off" type="text" class="form-control" name="email" id="email" placeholder="Enter email">
                                    </div>
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        <label>Married Status</label>
                                        <select class="form-select form-control" name="married_status" id="married_status">
                                            <option value="" class="">Select Status</option>
                                            <option value="0" class="">Married</option>
                                            <option value="1" class="">Unmarried</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12 Anniversary-box" style="display: none">
                                        <label>Date Of Anniversary</label>
                                        <input value="<?php if(!empty($single)) { echo $single->DOA;} ?>" autocomplete="off" type="text" class="form-control" name="DOA" id="DOA" placeholder="DD/MM/YY">
                                    </div>
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        <label>Date Of Birth</label>
                                        <input value="<?php if(!empty($single)) { echo $single->dob;} ?>" autocomplete="off" type="text" class="form-control" name="dob" id="dob" placeholder="DD/MM/YY">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label>State</label>
                                        <select class="form-select form-control" name="state" id="state">
                                            <option value="" class="">Select State</option>
                                            <?php if (!empty($state)) {
                                                foreach ($state as $state_result) { ?>
                                                    <option value="<?= $state_result->id ?>" <?php if (!empty($single) && $single->state == $state_result->id) { ?>selected="selected" <?php } ?>>
                                                        <?= $state_result->name ?>
                                                    </option>
                                            <?php }
                                            } ?>
                                        </select>

                                        <?php
                                        $city = array();
                                        if (!empty($single)) {
                                            $city = $this->Admin_model->get_selected_state_city($single->state);
                                        }
                                        ?>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label>Select City</label>
                                        <div>
                                            <select class="form-select form-control" name="city" id="city_name">
                                                <option value="">Select City</option>
                                                <?php if (!empty($city)) {
                                                    foreach ($city as $city_result) { ?>
                                                        <option value="<?= $city_result->id ?>" <?php if (!empty($single) && $single->city == $city_result->id) { ?>selected="selected" <?php } ?>>
                                                            <?= $city_result->name ?>
                                                        </option>
                                                <?php }
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        <label>Address</label>
                                        <input value="<?php if(!empty($single)) { echo $single->address;} ?>" autocomplete="off" type="text" class="form-control" name="address" id="address" placeholder="Ente address">
                                    </div>
                                </div>
                                <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                    <div class="show-more-box"><a href="#" id="show_more">Show More</a></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <button class="btn btn-primary" type="submit" name="customer_button" value="customer_button">Submit</button>
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
    jQuery.validator.addMethod("validate_email", function(value, element) {
        if (/^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/.test(value)) {
            return true;
        } else {
            return false;
        }
    }, "Please enter a valid Email!");
    $(document).ready(function() {
        $('#add_customer_form').validate({
            ignore: ":hidden",
            rules: {
              
                full_name: 'required',
                customer_phone: {
                    required: true,
                    number: true,
                    mobile_no: true,
                    minlength: 10,
                    maxlength: 10,
                },
                price: {
                    required: true,
                    number: true,
                },
                gender: 'required',
                membership_id: 'required',
                membership_mode: 'required',
            },
            messages: {
                full_name: 'Please enter customer name!',
                membership_id: 'Please select membership name!',
                customer_phone: {
                    required: "Please enter mobile number!",
                    number: "Only number allowed!",
                    mobile_no: "Please enter valid number!",
                    minlength: "Minimum 10 digit required!",
                    maxlength: "Maximum 10 digit allowed!",
                },
                price: {
                    required: "Please enter Membership price!",
                    number: "Only number allowed!",
                },
                gender: 'Please select gender!',
                membership_mode: 'Please select payment mode!',
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
  $("#dob").datepicker({
    dateFormat: "dd-mm-yy",
    changeMonth: true,
    changeYear: true,
    maxDate: "0", 
    defaultDate: 0
    });

    $("#DOA").datepicker({
        dateFormat: "dd-mm-yy",
        changeMonth: true,
        changeYear: true,
        maxDate: "0", 
        defaultDate: 0
    });
</script>

<script>
   $("#show_more").click(function () {
          $('.add-more-info').toggle();
    });
</script>

<script>
    $(document).ready(function() {
        $('#asign_membership .child_menu').show();
        $('#asign_membership').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.asign_membership').addClass('active_cc');
    });
</script>


<script>
    $("#customer_phone").keyup(function() {
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>salon/Ajax_controller/get_customer_details_ajax",
            data: {
                'phone': $('#customer_phone').val(),
            },
            success: function(data) {
                var parsedData = JSON.parse(data);
                console.log(parsedData);
                if (parsedData.customer_phone) {
                    $('.customer-info-by-phone').show();
                    $('.customer-info-by-phone div').html('<div onclick="get_customer_info('+ parsedData.customer_phone +')">'+ parsedData.full_name +'</div>');
                   
                } else {
                    $('.customer-info-by-phone').show();
                    $('.customer-info-by-phone div').html('Customer Not Found! Please Fill Customer Detail.').css('color', 'red');
                }
            },
        });
    });
    function get_customer_info(phone) {
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>salon/Ajax_controller/get_customer_details_ajax",
            data: {
                'phone':phone,
            },
            success: function(data) {
                var parsedData = JSON.parse(data);
                if (parsedData.customer_phone == phone) {
                    $('.customer-info-by-phone').hide();
                    // $('.add-more-info').show();
                    $('.last_membership_box').show();
                    // $('.Anniversary-box').show();
                    $('#full_name').val(parsedData.full_name);
                    $('#customer_phone').val(parsedData.customer_phone);
                    $('#email').val(parsedData.email);
                    $('#dob').val(parsedData.dob);
                    // $('#DOA').val(parsedData.DOA);
                    $('#gender').val(parsedData.gender);
                    $('#address').val(parsedData.address);
                    $('#city').val(parsedData.city);
                    $('#state').val(parsedData.state);

                    var membership_data = <?php echo json_encode($membership_list) ?>;
                    var m_length=membership_data.length;
                    for(var i=0; i<m_length; i++){
                        if(membership_data[i].id == parsedData.membership_id){
                            $('.last_membership_box').html('The last membership for '+ parsedData.full_name +' is '+ membership_data[i].membership_name +'');
                            $('.last_membership_box').css('background-color', membership_data[i].bg_color);
                        }
                    }
                }
                get_memberships();
            }
        });
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
                    $('#membership_id').trigger('change');
                    $('#membership_id').trigger('chosen:updated');   
                }
            });
        }
    }
</script>

<script>
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
            },
        });
    });
</script>

<script>
   $("#married_status").change(function () {
    var m_status = $("#married_status").val();
       if(m_status == 0){
          $('.Anniversary-box').show();
       }
       else{
        $('.Anniversary-box').hide();
       }
    });
    
</script>