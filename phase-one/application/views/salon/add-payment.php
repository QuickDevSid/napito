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
                    Add Customer Payment
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


            <div class="col-md-12 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">

                    </div>
                    <div class="x_content">
                        <div class="container">
                            <form method="post" name="add_customer_form" id="add_customer_form" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-3 form-group">
                                        <label>Select Customer <b class="require">*</b></label>
                                        <select class="form-select form-control" name="customer" id="customer">
                                            <option value="" class="">Select Customer</option>
                                            <?php if (!empty($customers)) {
                                                foreach ($customers as $customers_result) { ?>
                                                    <option value="<?= $customers_result->id ?>" <?php if ((!empty($single) && $single->customer_id == $customers_result->id)) { ?>selected="selected" <?php } ?>>
                                                        <?= $customers_result->full_name.' ['.$customers_result->customer_phone.']'; ?>
                                                    </option>
                                            <?php }
                                            } ?>
                                        </select>
                                        <label for="customer" generated="true" class="error" style="display:none;float:left; width:100%;">Please enter payment amount!</label>
                                    </div>
                                    <input type="hidden" name="old_paid_amount" id="old_paid_amount" value="<?php if(!empty($single)){ echo $single->paid_amount; }?>">
                                    <input type="hidden" name="id" id="id" value="<?php if(!empty($single)){ echo $single->id; }?>">
                                    <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                        <label>Total Booking Amount</label>
                                        <input readonly type="text" class="form-control" name="booking" id="booking" value="<?php if(!empty($single)){ echo $single->total_bill_amount; }else{ echo '0.00'; }?>">
                                    </div>
                                    <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                        <label>Total Paid Amount</label>
                                        <input readonly type="text" class="form-control" name="paid" id="paid" value="<?php if(!empty($single)){ echo $single->total_paid_amount; }else{ echo '0.00'; }?>">
                                    </div>
                                    <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                        <label>Pending Amount</label>
                                        <input readonly type="text" class="form-control" name="pending" id="pending" value="<?php if(!empty($single)){ echo $single->opening_pending_amount; }else{ echo '0.00'; }?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                        <label>Paid Amount <b class="require">*</b></label>
                                        <input type="number" class="form-control" placeholder="Enter Paid Amount" name="now_paid" id="now_paid" value="<?php if(!empty($single)){ echo $single->paid_amount; }?>" onkeyup="calculateNewPendingAmount()">
                                    </div>
                                    <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                        <label>New Pending Amount</label>
                                        <input readonly type="text" class="form-control" name="new_pending" id="new_pending" value="<?php if(!empty($single)){ echo $single->closing_pending_amount; }else{ echo '0.00'; }?>">
                                    </div>
                                    <div class="form-group col-md-3 col-xs-12">
                                        <label>Payment Mode<b class="require">*</b></label>
                                        <select class="form-control form-select" name="payment_mode" id="payment_mode" onchange="setTransactionID()">
                                            <option value="">Select Payment Mode</option>
                                            <option value="UPI">UPI</option>
                                            <option value="Cash">Cash</option>
                                            <!-- <option value="Cheque">Cheque</option> -->
                                            <option value="Online">Online</option>
                                        </select>
                                        <label for="payment_mode" generated="true" class="error" style="display:none;float:left; width:100%;">Please enter payment amount!</label>
                                    </div>
                                    <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                        <label>Transaction ID</label>
                                        <input readonly type="text" placeholder="Enter Transaction ID" class="form-control" name="transaction_id" id="transaction_id" value="">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-3 col-xs-12">
                                        <label>Payment Date<b class="require">*</b></label>
                                        <input readonly type="text" class="form-control" placeholder="Enter Payment Date" name="payment_date" id="payment_date" value="<?php if(!empty($single)){ echo date('d-m-Y',strtotime($single->payment_date)); }else{ echo date('d-m-Y'); }?>">
                                        <label for="payment_date" generated="true" class="error" style="display:none;float:left; width:100%;">Please enter payment amount!</label>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Remark <b class="require">*</b></label>
                                        <textarea class="form-control" placeholder="Enter Remark" name="remark" id="remark"><?php if(!empty($single)){ echo $single->remark; }?></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
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
    function setTransactionID(){
        payment_mode = $('#payment_mode').val();
        if(payment_mode == 'Cash'){
            $('#transaction_id').attr('readonly', true);
        }else{
            $('#transaction_id').attr('readonly', false);
        }
    }   
    $(document).ready(function () { 
        $("#customer").chosen();
        $("#payment_mode").chosen();
        $("#payment_date").datepicker({
            dateFormat: 'dd-mm-yy',
            maxDate: '<?php echo date('Y-d-m'); ?>',
        });  
        $('#add_customer_form').validate({
            ignore: [],
            rules: {
                customer: {
                    required: true,
                },
                now_paid: {
                    required: true,
                    number: true,
                    min: 0,
                    max: function() {
                        return parseFloat($('#pending').val()) || 0;
                    },
                },
                payment_date: {
                    required: true,
                },
                payment_mode: {
                    required: true,
                },
                remark: {
                    required: true,
                },
            },
            messages: {
                customer: {
                    required:'Please select customer!',
                },
                now_paid: {
                    required: "Please enter paid amount!",
                    number: "Only number allowed!",
                    min: "Minimum 0 amount allowed!",
                    max: function() {
                        return "Maximum " + parseFloat($('#pending').val()).toFixed(2) + " amount allowed!";
                    },
                },
                payment_date: {
                    required: 'Please select payment date!',
                },
                payment_mode: {
                    required: 'Please select payment mode!',
                },
                remark: {
                    required: 'Please enter remark!',
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
            },
            submitHandler: function(form) {
                if(confirm("Are you sure to add payment as this action can not be reverted back?")) {
                    form.submit();
                } else {
                    return false;
                }
            }
        }); 
    });
    $("#customer").change(function() {
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>salon/Ajax_controller/get_customer_all_details_ajax",
            data: {
                'customer': $("#customer").val()
            },
            success: function(data) {
                var opts = $.parseJSON(data);
                if (opts && Object.keys(opts).length > 0) {
                    var total_bill_amount = opts.total_bill_amount;
                    var total_paid_amount = opts.total_paid_amount;
                    var current_pending_amount = opts.current_pending_amount;
                    
                    $('#booking').val(parseFloat(total_bill_amount).toFixed(2));
                    $('#pending').val(parseFloat(current_pending_amount).toFixed(2));
                    $('#paid').val(parseFloat(total_paid_amount).toFixed(2));
                    $('#now_paid').val('');

                    calculateNewPendingAmount();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });

    function calculateNewPendingAmount() {
        var paid_amount = parseFloat($('#now_paid').val()) || 0;
        var pending_amount = parseFloat($('#pending').val()) || 0;

        var new_pending = pending_amount - paid_amount;

        $('#new_pending').val(parseFloat(new_pending).toFixed(2));
    }

</script>
<script>
    $(document).ready(function() {
        $('#reports .child_menu').show();
        $('#reports').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.add_payment').addClass('active_cc');
    });
</script>