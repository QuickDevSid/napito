<?php
// echo "<pre>";print_r($single);exit;
include('header.php'); ?>
<style type="text/css">
    .error {
        color: red;
        float: left;
        /*    position: absolute;*/
    }

.page-title .title_left h3 {
    margin: 10px 3px;
    color: #323232;
    font-weight: 700;
    font-size: 20px;
    /* display: none; */
}

    input[type="file"] {
        height: 50px;
    }

    #viewButtonsContainer a {

        margin-left: 30px;
    }
    .table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
    padding: 11px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid ;
}
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                Branch Subscription Payment
                <a style="float:right;" href="<?=base_url();?>branch_payment_history" class="btn btn-primary">Payment History</a>
                </h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="x_panel">
                <div class="x_content">
                    <div class="container">
                        <form method="post" name="customer_form" id="customer_form" enctype="multipart/form-data">
                            <div class="row">
                                <input type="hidden" name="selected_salon" id="selected_salon" value="<?php if(isset($_GET['salon']) && $_GET['salon'] != ""){ echo $_GET['salon']; }?>">
                                <input type="hidden" name="selected_branch" id="selected_branch" value="<?php if(isset($_GET['branch']) && $_GET['branch'] != ""){ echo $_GET['branch']; }?>">
                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <label style="color: black;">Select Salon <b class="require">*</b></label>
                                    <select class="form-control chosen-select" <?php if(isset($_GET['salon']) && $_GET['salon'] != ""){ echo 'disabled'; }?> name="salon" id="salon" onchange="fetchbranch()">
                                        <option value="">Select Salon</option>
                                    </select>
                                    <label id="salon-error" class="error" style="display: none;" for="salon">Please select salon!</label>
                                </div>
                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <label style="color: black;">Select Branch <b class="require">*</b></label>
                                    <select class="form-control chosen-select" <?php if(isset($_GET['branch']) && $_GET['branch'] != ""){ echo 'disabled'; }?> name="branch" id="branch" onchange="fetchbranchPaymentDetails()">
                                        <option value="">Select Branch</option>
                                    </select>
                                    <label id="branch-error" class="error" style="display: none;" for="branch">Please select salon!</label>
                                </div>
                            </div>
                            <div class="row" style="margin-top:25px;">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="subs_details_div">
                                    <table id="payment_branch_table" class="table" border="1">
                                        <thead>
                                            <tr>
                                                <th>Active Subscription</th>
                                                <th>Subscription Price</th>
                                                <th>Previous Pending Amount</th>
                                                <th>Coin Balance</th>
                                                <th>Coin Balance (In INR)<small class="per_coin_value"></small></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>
                                                    <label id="subscription_name_text"></label>
                                                    <input type="hidden" name="subscription_name" id="subscription_name" value="">
                                                </th>
                                                <th>
                                                    <label id="subscription_price_text"></label>
                                                    <input type="hidden" name="subscription_price" id="subscription_price" value="">
                                                </th>
                                                <th>
                                                    <label id="previous_pending_amount_text"></label>
                                                    <input type="hidden" name="previous_pending_amount" id="previous_pending_amount" value="">
                                                    <input type="hidden" name="per_coin_in_rs" id="per_coin_in_rs" value="">
                                                </th>
                                                <th>
                                                    <label id="coin_balance_text"></label>
                                                    <input type="hidden" class="form-control" name="coin_balance" id="coin_balance" value="">
                                                </th>
                                                <th>
                                                    <label id="coin_balance_in_rs_text"></label>
                                                    <input type="hidden" class="form-control" name="coin_balance_in_rs" id="coin_balance_in_rs" value="">
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12" id="current_details_div">
                                    <table class="table" border="1">
                                        <tbody>
                                            <tr>
                                                <th>Coin Balance Used <b class="require">*</b></th>
                                                <td>
                                                    <input readonly placeholder="Enter Coin Balance To Be Used" onkeyup="calculateCoinBalance()" type="text" class="form-control" name="coin_balance_used" id="coin_balance_used" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Coin Balance Used (In INR)<br><small class="per_coin_value"></small></th>
                                                <td>
                                                    <label id="coin_balance_used_in_rs_text"></label>
                                                    <input readonly type="hidden" name="coin_balance_used_in_rs" id="coin_balance_used_in_rs" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Effective Pending Amount</th>
                                                <td>
                                                    <label id="effective_pending_amount_text"></label>
                                                    <input type="hidden" name="effective_pending_amount" id="effective_pending_amount" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Payment Amount <b class="require">*</b></th>
                                                <td>
                                                    <input placeholder="Enter Payment Amount" type="text" onkeyup="calculateCoinBalance()" class="form-control" name="now_payment" id="now_payment" value="">
                                                </td>
                                            </tr>
                                            <tr style="display:none;">
                                                <th>IGST Amount <b class="require">*</b> <small id="igst_rate_text"></small></th>
                                                <td>
                                                    <label id="igst_text"></label>
                                                    <input type="hidden" name="igst_hidden" id="igst_hidden" value="">
                                                    <input type="hidden" name="igst_rate" id="igst_rate" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>CGST Amount <b class="require">*</b> <small id="cgst_rate_text"></small></th>
                                                <td>
                                                    <label id="cgst_text"></label>
                                                    <input type="hidden" name="cgst_hidden" id="cgst_hidden" value="">
                                                    <input type="hidden" name="cgst_rate" id="cgst_rate" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>SGST Amount <b class="require">*</b> <small id="sgst_rate_text"></small></th>
                                                <td>
                                                    <label id="sgst_text"></label>
                                                    <input type="hidden" name="sgst_hidden" id="sgst_hidden" value="">
                                                    <input type="hidden" name="sgst_rate" id="sgst_rate" value="">
                                                </td>
                                            </tr>
                                            <tr style="display:none;">
                                                <th>GST Amount <b class="require">*</b> <small id="gst_rate_text"></small></th>
                                                <td>
                                                    <label id="gst_text"></label>
                                                    <input type="hidden" name="gst_hidden" id="gst_hidden" value="">
                                                    <input type="hidden" name="gst_rate" id="gst_rate" value="">
                                                    <input type="hidden" name="is_gst_applicable" id="is_gst_applicable" value="">
                                                    <input type="hidden" name="gst_no" id="gst_no" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Final Amount <b class="require">*</b></th>
                                                <td>
                                                    <label id="final_payment_text"></label>
                                                    <input type="hidden" name="final_payment_hidden" id="final_payment_hidden" value="">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12" id="new_details_div">
                                    <table class="table" border="1">
                                        <tbody>
                                            <tr>
                                                <th>New Coin Balance</th>
                                                <td>
                                                    <label id="new_coin_balance_text"></label>
                                                    <input type="hidden" name="new_coin_balance" id="new_coin_balance" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>New Pending Amount</th>
                                                <td>
                                                    <label id="pending_amount_text"></label>
                                                    <input type="hidden" name="pending_amount" id="pending_amount" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Payment Date <b class="require">*</b></th>
                                                <td>
                                                    <input placeholder="Select Payment Date" type="text" class="form-control" name="payment_date" id="payment_date" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Remark</th>
                                                <td>
                                                    <textarea placeholder="Enter Remark" class="form-control" name="payment_remark" id="payment_remark"></textarea>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <button type="submit" id="submit_button" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>
<script>
     

    $(document).ready(function () { 
        $("#payment_date").datepicker({
			dateFormat:"dd-mm-yy",
			changeMonth:true,
			changeYear:true,
			maxDate:0,
			maxDate: "0",
			minDate: "-5Y",			 
		});
        $(".chosen-select").chosen({});
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>admin/Ajax_controller/get_all_salon_ajx",
            data: {

            },
            success: function(data) {
                $("#salon").empty();
                $('#salon').append('<option value="">Select Salon</option>');
                var opts = $.parseJSON(data);
                selected_salon = $("#selected_salon").val();
                is_salon_selected = '0';
                $.each(opts, function(i, d) {
                    if(selected_salon == d.id){
                        is_salon_selected = '1';
                        $('#salon').append('<option selected value="' + d.id + '">' + d.salon_name + '</option>');
                    }else{
                        $('#salon').append('<option value="' + d.id + '">' + d.salon_name + '</option>');
                    }
                });
                $('#salon').trigger('chosen:updated');

                if(is_salon_selected == '1'){
                    fetchbranch();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });

        // $.validator.addMethod("noCommas", function(value, element) {
        //     return this.optional(element) || /^\d+$/.test(value); // Only digits allowed
        // }, "Please enter whole number.");
        $('#customer_form').validate({
            ignore:[],
            rules: {
                salon: 'required',
                branch: 'required',
                now_payment: {
                    required: true,
                    // noCommas: true,
                    number: true,
                    min: 1,
                },
                coin_balance_used: {
                    required: true,
                    // noCommas: true,
                    number: true,
                    min: 0,
                },
                payment_date: 'required'
            },
            messages: {
                salon: 'Please select salon!',
                branch: 'Please select branch!',
                now_payment: {
                    required: 'Please enter payment amount!',
                    number: 'Only numbers allowed!',
                    min: 'Minimum 1 value required!',
                },
                coin_balance_used: {
                    required: 'Please enter coin balance used amount!',
                    number: 'Only numbers allowed!',
                    min: 'Minimum 0 value required!',
                },
                payment_date: 'Please select payment date!'
            },
            submitHandler: function(form) {
                if (confirm("Are you sure you want to submit the form?")) {
                    form.submit();
                    document.getElementById('submit_button').remove();
                }
            }
        });
    });
    function fetchbranch(){
        if($("#salon").val() != ""){
            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>admin/Ajax_controller/get_all_salon_branch_ajx",
                data: {
                    'salon': $("#salon").val()
                },
                success: function(data) {
                    $("#branch").empty();
                    $('#branch').append('<option value="">Select Branch</option>');
                    var opts = $.parseJSON(data);
                    is_branch_selected = '0';
                    selected_branch = $("#selected_branch").val();
                    $.each(opts, function(i, d) {
                        if(selected_branch == d.id){
                            is_branch_selected = '1';
                            $('#branch').append('<option selected value="' + d.id + '">' + d.branch_name + '</option>');
                        }else{
                            $('#branch').append('<option value="' + d.id + '">' + d.branch_name + '</option>');
                        }
                    });
                    $('#branch').trigger('chosen:updated');
                    
                    if(is_branch_selected == '1'){
                        fetchbranchPaymentDetails();
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }
    }
    function fetchbranchPaymentDetails(){
        $('#subscription_name').val('');
        $('#subscription_name_text').text('Not Available').css('color','red');
        $('#subscription_price').val('');
        $('#subscription_price_text').text('-');
        $('#previous_pending_amount').val('');
        $('#previous_pending_amount_text').text('-');
        $('#coin_balance').val('');
        $('#coin_balance_text').text('-');
        $('#coin_balance_in_rs').val('');
        $('#coin_balance_in_rs_text').text('-');
        $('#coin_balance_used').val('').attr('readonly',true);
        $('#now_payment').val('').attr('readonly',true);
        $('#effective_pending_amount').val('');
        $('#effective_pending_amount_text').text('');
        if($("#branch").val() != ""){
            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>admin/Ajax_controller/get_branch_payment_details_ajx",
                data: {
                    'branch': $("#branch").val()
                },
                success: function(data) {
                    if(data != "0"){
                        var opts = $.parseJSON(data);
                        subscription_name = opts.subscription_name;
                        subscription_price = opts.subscription_price;
                        pending_amount = opts.pending_amount;
                        coin_balance = opts.coin_balance;
                        coin_balance_in_rs = opts.coin_balance_in_rs;
                        per_coin_in_rs = opts.per_coin_in_rs;

                        now_payment = pending_amount - coin_balance_in_rs;

                        $('#per_coin_in_rs').val(per_coin_in_rs);
                        $('.per_coin_value').text(' Rs.' + per_coin_in_rs + ' Per Coin');
                        $('#subscription_name').val(subscription_name);
                        $('#subscription_name_text').text(subscription_name).css('color','black');
                        $('#subscription_price').val(parseFloat(subscription_price).toFixed(2));
                        $('#subscription_price_text').text(parseFloat(subscription_price).toFixed(2));
                        $('#previous_pending_amount').val(parseFloat(pending_amount).toFixed(2));
                        $('#previous_pending_amount_text').text(parseFloat(pending_amount).toFixed(2));
                        $('#now_payment').val(parseFloat(now_payment).toFixed(2)).attr('max',parseFloat(now_payment).toFixed(2)).attr('readonly',false);
                        $('#coin_balance').val(parseInt(coin_balance));
                        $('#coin_balance_text').text(parseInt(coin_balance));
                        $('#coin_balance_in_rs').val(parseFloat(coin_balance_in_rs).toFixed(2));
                        $('#coin_balance_in_rs_text').text(parseFloat(coin_balance_in_rs).toFixed(2));
                        $('#is_gst_applicable').val(opts.is_gst_applicable);
                        $('#gst_no').val(opts.gst_no);
                        $('#gst_rate').val(parseFloat(opts.gst_rate).toFixed(2));
                        $('#igst_rate').val(parseFloat(opts.igst_rate).toFixed(2));
                        $('#cgst_rate').val(parseFloat(opts.cgst_rate).toFixed(2));
                        $('#sgst_rate').val(parseFloat(opts.sgst_rate).toFixed(2));
                        $('#gst_rate_text').text('(' + parseFloat(opts.gst_rate).toFixed(2) + '%)');
                        $('#igst_rate_text').text('(' + parseFloat(opts.igst_rate).toFixed(2) + '%)');
                        $('#cgst_rate_text').text('(' + parseFloat(opts.cgst_rate).toFixed(2) + '%)');
                        $('#sgst_rate_text').text('(' + parseFloat(opts.sgst_rate).toFixed(2) + '%)');

                        if(coin_balance > 0){
                            $('#coin_balance_used').val(parseInt(coin_balance)).attr('max',parseInt(coin_balance)).attr('readonly',false);
                        }else{
                            $('#coin_balance_used').val(parseInt(coin_balance)).attr('max',parseInt(coin_balance)).attr('readonly',true);
                        }
                    }
                    calculateCoinBalance();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }
    }
    function calculateCoinBalance(){
        var previous_pending_amount = $('#previous_pending_amount').val();
        var per_coin_in_rs = $('#per_coin_in_rs').val();
        var coin_balance_used = $('#coin_balance_used').val();
        var coin_balance = $('#coin_balance').val();

        coin_balance_used_in_rs = coin_balance_used * per_coin_in_rs;
        new_coin_balance = coin_balance - coin_balance_used;
        effective_pending_amount = previous_pending_amount - coin_balance_used_in_rs;

        $('#coin_balance_used_in_rs').val(parseFloat(coin_balance_used_in_rs).toFixed(2));
        $('#coin_balance_used_in_rs_text').text(parseFloat(coin_balance_used_in_rs).toFixed(2));
        $('#new_coin_balance').val(parseInt(new_coin_balance));
        $('#new_coin_balance_text').text(parseInt(new_coin_balance));
        $('#effective_pending_amount').val(parseFloat(effective_pending_amount).toFixed(2));
        $('#effective_pending_amount_text').text(parseFloat(effective_pending_amount).toFixed(2));

        calculatePending();
    }
    function calculatePending(){
        var now_payment = $('#now_payment').val();
        var effective_pending_amount = $('#effective_pending_amount').val();
        new_pending = effective_pending_amount - now_payment;
        $('#pending_amount').val(parseFloat(new_pending).toFixed(2));
        $('#pending_amount_text').text(parseFloat(new_pending).toFixed(2));

        calculateGST();
    }
    function calculateGST(){
        var now_payment = $('#now_payment').val() ?? 0;
        var is_gst_applicable = $('#is_gst_applicable').val() ?? '0';

        var igst_rate = is_gst_applicable == '1' ? ($('#igst_rate').val() ?? 0) : 0;
        var cgst_rate = is_gst_applicable == '1' ? ($('#cgst_rate').val() ?? 0) : 0;
        var sgst_rate = is_gst_applicable == '1' ? ($('#sgst_rate').val() ?? 0) : 0;
        var gst_rate = is_gst_applicable == '1' ? ($('#gst_rate').val() ?? 0) : 0;

        igst = (parseFloat(igst_rate) * parseFloat(now_payment))/100;
        cgst = (parseFloat(cgst_rate) * parseFloat(now_payment))/100;
        sgst = (parseFloat(sgst_rate) * parseFloat(now_payment))/100;
        gst = (parseFloat(gst_rate) * parseFloat(now_payment))/100;

        final_payment = parseFloat(gst) + parseFloat(now_payment);

        $('#igst_hidden').val(parseFloat(igst).toFixed(2));
        $('#cgst_hidden').val(parseFloat(cgst).toFixed(2));
        $('#sgst_hidden').val(parseFloat(sgst).toFixed(2));
        $('#igst_text').text(parseFloat(igst).toFixed(2));
        $('#cgst_text').text(parseFloat(cgst).toFixed(2));
        $('#sgst_text').text(parseFloat(sgst).toFixed(2));

        $('#gst_hidden').val(parseFloat(gst).toFixed(2));
        $('#gst_text').text(parseFloat(gst).toFixed(2));

        $('#final_payment_hidden').val(parseFloat(final_payment).toFixed(2));
        $('#final_payment_text').text(parseFloat(final_payment).toFixed(2));
    }
</script>