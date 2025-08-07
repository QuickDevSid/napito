<?php include('header.php');?>
<style>
 
div.dataTables_wrapper div.dataTables_filter{
    top: 0;
}




input[class="dashboardToggle"] {
        position: relative;
        appearance: none;
        width: 50px;
        height: 25px;
        background: #ccc;
        margin-right: 25px;
        margin-top: 5px;
        border-radius: 50px;
        box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.2);
        cursor: pointer;
        transition: 0.4s;
        display: block;
    }

    input:checked[class="dashboardToggle"] {
        background: #7da6ff;
    }

    input[class="dashboardToggle"]::after {
        position: absolute;
        content: "";
        width: 25px;
        height: 25px;
        top: 0;
        left: 0;
        background: #fff;
        border-radius: 50%;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        transform: scale(1.1);
        transition: 0.4s;
    }

    input:checked[class="dashboardToggle"]::after {
        left: 50%;
    }
</style>
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left" style="width:100%;">
            <h3>
                <?php if(isset($_GET['app_customer'])){ ?>
                    App 
                <?php }elseif(isset($_GET['shop_customer'])){ ?>
                    Shop
                <?php }else{ ?>
                    All 
                <?php } ?>
                Customers
                <?php if(!isset($_GET['app_customer'])){ ?>
                    <button style="float:right;" onclick="open_customer_model()" class="btn btn-primary">Add Customer</button>
                <?php } ?>
            </h3>
        </div>
        <div class="title_left" style="width:100%;">
            <label style="float:right;">
                <?php if(isset($_GET['app_customer'])){
                        if($req_customers != ""){
                ?>
                    App Customer Target: <?=$req_customers;?> Customers
                <?php }} ?>
            </label>
        </div>
        <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search"></div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">                    
                    <div class="clearfix"></div>
                </div>
                <!-- <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                    <label for="fullname">Show Mobile App Customers</label>
                    <input style="height: 25px !important;" <?php if(isset($_GET['app_customer'])){ echo 'checked'; } ?> type="checkbox" name="is_app" id="is_app" class="dashboardToggle">                               
                </div>     -->
                <div class="x_content">
                    <table class="table table-striped responsive-utilities jambo_table"style="width: 100%;" id="example">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <?php if(isset($_GET['app_customer'])){ ?>
                                    <th>Login Status</th>
                                <?php } ?>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Date of Birth</th>
                                <th>Membership</th>
                                <th>Custom Note</th>
                                <th>Pending Amount</th>
                                <th>Reward Balance</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="add-new-customer-main" style="display: none;">
        <div class="add-new-customer-content" >
            <form method="post" name="add_customer_form" id="add_customer_form" enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label>Customer Name <b class="require">*</b></label>
                        <input autocomplete="off" type="text" class="form-control" name="full_name" id="full_name" placeholder="Enter full name">
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label>Phone Number <b class="require">*</b></label>
                        <input type="text" maxlength="10" class="form-control" name="customer_phone" id="customer_phone" placeholder="Enter phone number" onkeyup="validateUniqueMobile()">
                        <input type="hidden" name="added_from" id="added_from" value="customer_list">
                        <label class="error" id="unique_exist_error"></label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                        <label>Select Gender<b class="require">*</b></label>
                        <select class="form-select form-control" name="gender" id="gender">
                            <?php if ($store_category->category == '0'){?>
                                <option id="male" value="0">Male</option>
                            <?php }?>
                            <?php if ($store_category->category == '1'){?>
                                <option id="female" value="1">Female</option>
                            <?php }?>
                            <?php if ($store_category->category == '2'){?>
                                <option id="male" value="0">Male</option>
                                <option id="female" value="1">Female</option>
                                <!-- <option id="female" value="2">Other</option> -->
                            <?php }?>
                        </select>
                    </div>
                </div>
                <div class="add-more-info" style="display: none;">
                    <div class="row">
                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email" id="email" placeholder="Enter email">
                        </div>
                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <label>Married Status</label>
                            <select class="form-select form-control" name="married_status" id="married_status">
                                <option value="" class="">Select Status</option>
                                <option value="0" class="">Married</option>
                                <option value="1" class="">Unmarried</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4 col-sm-6 col-xs-12 Anniversary-box" style="display: none">
                            <label>Date Of Anniversary</label>
                            <input readonly maxlength="10" type="text" class="form-control" name="DOA" id="DOA" placeholder="Enter Date of Anniversary">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <label>Date Of Birth</label>
                            <input readonly maxlength="10" type="text" class="form-control" name="dob" id="dob" placeholder="Enter Date of Birth">
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                            <label>State</label>
                            <select class="form-select form-control" name="state" id="state">
                                <option value="" class="">Select State</option>
                                <?php 
		                        $state = $this->Salon_model->get_india_state();
                                if (!empty($state)) {
                                    foreach ($state as $state_result) { ?>
                                        <option value="<?= $state_result->id ?>" <?php if ((!empty($single) && $single->state == $state_result->id) || $state_result->id == '4008') { ?>selected="selected" <?php } ?>>
                                            <?= $state_result->name ?>
                                        </option>
                                <?php }
                                } ?>
                            </select>

                            <?php
                            $city = array();
                            if (!empty($single)) {
                                $city = $this->Admin_model->get_selected_state_city($single->state);
                            }else{
                                $city = $this->Admin_model->get_selected_state_city(4008);
                            }
                            ?>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
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
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <label>Address</label>
                            <input type="text" class="form-control" name="address" id="address" placeholder="Ente address">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <label>Custom Note</label>
                            <textarea class="form-control" name="custom_note" id="custom_note" placeholder="Enter Customer Note"></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                    <div class="show-more-box"><a href="#" id="show_more">Show More</a></div>
                    <div class="show-more-box"><a href="#" id="show_less" style="display: none;">Show less</a></div>
                </div>
                <label class="error" id="mobile_error" style="display:none;">Please select reminder type!</label>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <button class="btn btn-primary" type="submit" name="customer_button" id="customer_button" value="customer_button">Save</button>
                        <div style="float: left;" onclick="open_customer_model()" class="close_time_slot_Model btn btn-danger">Close</div>
                    </div>
                </div>
            </form>
        </div>
    </div>
<div class="modal fade" id="CustomerAddPaymentsModal" tabindex="-1" aria-labelledby="CustomerAddPaymentsModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="CustomerAddPaymentsModalLabel">Add Customer Payment</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;"  onclick="closePopup('CustomerAddPaymentsModal')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="add_payment_response"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="CustomerPaymentsModal" tabindex="-1" aria-labelledby="CustomerPaymentsModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="CustomerPaymentsModalLabel">Customer Payments</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;"  onclick="closePopup('CustomerPaymentsModal')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modal_code" id="payments_response"></div>
        </div>
    </div>
</div>
<?php include('footer.php');?>
<script>
    $(document).ready(function() {
        $('#is_app').change(function () {
            let url = new URL(window.location.href);
            if ($(this).is(':checked')) {
                url.searchParams.set('app_customer', '1');
            } else {
                url.searchParams.delete('app_customer');
            }
            window.location.href = url;
        });
        var oldExportAction = function (self, e, dt, button, config) {
            if (button[0].className.indexOf('buttons-excel') >= 0) {
                if ($.fn.dataTable.ext.buttons.excelHtml5.available(dt, config)) {
                    $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config);
                }
                else {
                    $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
                }
            } else if (button[0].className.indexOf('buttons-print') >= 0) {
                $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
            }
        };
        var newExportAction = function (e, dt, button, config) {
            var self = this;
            var oldStart = dt.settings()[0]._iDisplayStart;
            dt.one('preXhr', function (e, s, data) {
                data.start = 0;
                data.length = 2147483647;
                dt.one('preDraw', function (e, settings) {
                    oldExportAction(self, e, dt, button, config);
                    dt.one('preXhr', function (e, s, data) {
                        settings._iDisplayStart = oldStart;
                        data.start = oldStart;
                    });
                    setTimeout(dt.ajax.reload, 0);
                    return false;
                });
            });
            dt.ajax.reload();
        };
        var table = $('#example').DataTable({
            "lengthChange": true, 
            "lengthMenu": [10, 25, 50, 100, 200],
            'searching': true,
            'responsive':true,
            "processing": true,
            "serverSide": true,
            "cache": false,
            "order": [],
            "columnDefs": [
                { "orderable": false, "targets": "_all" }
            ],
            // scrollX:300,
            buttons:[
                {
                    extend: "excelHtml5",
                    messageBottom: '',
                    filename: 'Customer-list',
                    exportOptions: {
                        <?php if(isset($_GET['app_customer'])){ ?>
                            columns: [0,1,2,3,4,5,6,7,9,10],
                        <?php }else{ ?>
                            columns: [0,1,2,3,4,5,6,8,9],
                        <?php } ?>
                        modifier: {
                            search: 'applied',
                            order: 'applied'
                        },
                    },
                }
            ],
            dom: "Blfrtip",
            // scrollX: true,
            // scrollCollapse: true,
            "ajax":{
                "url" : "<?=base_url();?>salon/Ajax_controller/get_saloon_customers_ajx",
                "type": "POST",
                "data": function (d) {
                    d.customer = '<?php echo isset($_GET['customer']) ? $_GET['customer'] : ''; ?>';
                    d.is_app_customers = '<?php echo isset($_GET['app_customer']) ? '1' : ''; ?>';
                    d.is_shop_customers = '<?php echo isset($_GET['shop_customer']) ? '1' : ''; ?>';
                }				
            },
            "complete": function() {
                $('[data-toggle="tooltip"]').tooltip();			
            }, 
        });
        $('.navbar-nav.ml-auto .dropdown-menu').dropdown({
            container: '.navbar-nav.ml-auto'
        });
    });  
    function calculatePendingAmount(id) {
        var paid_amount = parseFloat($('#paid_amount_' + id).val());
        var pending_amount = parseFloat($('#pending_amount_' + id).val());

        if (isNaN(paid_amount)) {
            paid_amount = 0;
        }

        if (isNaN(pending_amount)) {
            pending_amount = 0;
        }

        var new_pending_amount = pending_amount - paid_amount;

        $('#new_pending_amount_' + id).val(parseFloat(new_pending_amount).toFixed(2));
    }   
    function showAddCustomerPaymentForm(id) {
        $.ajax({
            url: "<?= base_url(); ?>salon/Ajax_controller/add_customer_payment_ajx",
            method: 'POST',
            data: { customer: id },
            success: function(response) {
                $('#add_payment_response').html(response)
                showPopup('CustomerAddPaymentsModal');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching details:', error);
                alert("Error fetching details");
            }
        });
    }   
    function showCustomerPayments(id) {
        $.ajax({
            url: "<?= base_url(); ?>salon/Ajax_controller/get_customer_payments_ajx",
            method: 'POST',
            data: { customer: id },
            success: function(response) {
                $('#payments_response').html(response)
                showPopup('CustomerPaymentsModal');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching details:', error);
                alert("Error fetching details");
            }
        });
    }  
    $("#state").change(function() {
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>salon/Ajax_controller/get_city_ajax",
            data: {
                'state': $('#state').val(),
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
        });
    });
    $("#customer_phone").keyup(function() {
        $('#customer_button').attr('disabled',false);
        $('#unique_exist_error').text('');
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>salon/Ajax_controller/get_unique_customer_mobile",
            data: {
                'customer_phone': $('#customer_phone').val(),
            },
            success: function(data) {
                if(data > 0){
                    $('#customer_button').attr('disabled',true);
                    $('#unique_exist_error').text('This mobile no already exist');
                }else{
                    $('#unique_exist_error').text('');
                    $('#customer_button').attr('disabled',false);
                }
            },
        });
    });
    function showPopup(id){
        var exampleModal = $('#'+id);
        exampleModal.css('display','block');
        exampleModal.css('opacity','1');
        $('.modal-open').css('overflow','auto').css('padding-right','0px'); 
    }
    function closePopup(id){
        var exampleModal = $('#'+id);

        exampleModal.css('display','none');
        exampleModal.css('opacity','0');
        $('.modal-open').css('overflow','auto').css('padding-right','0px');
    }
    
    function open_customer_model() {
        $(".add-new-customer-main").toggle();
        $(".customer-info-by-search").hide();
        // $("#customer_phone").val($("#phone").val());
    }
    
        $("#dob").datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
            maxDate: 0
        });    
        $("#DOA").datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
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
        
    $("#married_status").change(function() {
        var m_status = $("#married_status").val();
        if (m_status == 0) {
            $('.Anniversary-box').show();
        } else {
            $('.Anniversary-box').hide();
        }
    });
    $("#show_more").click(function() {
        $('.add-more-info').show();
        $("#show_more").hide();
        $("#show_less").show();
    });
    $("#show_less").click(function() {
        $('.add-more-info').hide();
        $("#show_less").hide();
        $("#show_more").show();
    });
</script>
<script>
    $(document).ready(function() {
        $('#reports .child_menu').show();
        $('#reports').addClass('nv active');
        $('.right_col').addClass('active_right');
        <?php if(isset($_GET['app_customer'])){ ?>
            $('.app_customer-list').addClass('active_cc');
        <?php }elseif(isset($_GET['shop_customer'])){ ?>
            $('.shop_customer-list').addClass('active_cc');
        <?php }else{ ?>
            $('.customer-list').addClass('active_cc');
        <?php } ?>
    });
</script>