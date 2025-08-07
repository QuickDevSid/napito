<?php
// echo "<pre>";print_r($single);exit;
include('header.php'); ?>
<style type="text/css">
    .error {
        color: red;
        float: left;
        /*    position: absolute;*/
    }

    input[type="file"] {
        height: 50px;
    }

    #viewButtonsContainer a {

        margin-left: 30px;
    }
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left" style="width:100%;">
                <h3>
                    Branch Money Back Payment
                    <small style="float:right;font-size: 50%;color:red;">(Please not that, data related to Subscription, Branch Due Payments, etc will be cleared)</small>
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
                                <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                    <label >Active Subscription</label>
                                    <input readonly placeholder="Active Subscription" type="text" class="form-control" name="subscription_name" id="subscription_name" value="">
                                </div>
                                <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                    <label >Active Subscription Price</label>
                                    <input readonly placeholder="Active Subscription Price" type="text" class="form-control" name="subscription_price" id="subscription_price" value="">
                                </div>
                                <div class="form-group col-md-3 col-sm-3 col-xs-3">
                                    <label >Paid Amount</label>
                                    <input readonly placeholder="Previous Paid Amount" type="text" class="form-control" name="paid_amount" id="paid_amount" value="">
                                </div>
                                <div class="form-group col-md-3 col-sm-3 col-xs-3">
                                    <label >Pending Amount</label>
                                    <input readonly placeholder="Previous Pending Amount" type="text" class="form-control" name="previous_pending_amount" id="previous_pending_amount" value="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3 col-sm-3 col-xs-3">
                                    <label >Money Back Remark</label>
                                    <textarea placeholder="Enter Money Back Remark" type="text" class="form-control" name="remark" id="remark" value=""></textarea>
                                </div>
                                <div class="form-group col-md-3 col-sm-3 col-xs-3">
                                    <label >Money Back Amount<b class="require">*</b></label>
                                    <input readonly placeholder="Enter Payment Amount" type="text" class="form-control" name="money_back_amount" id="money_back_amount" value="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
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
        fetchbranchPaymentDetails();
        $('#customer_form').validate({
            ignore:[],
            rules: {
                // remark: 'required',
                money_back_amount: {
                    required: true,
                    number: true,
                    min: 1,
                },
            },
            messages: {
                // remark: 'Please enter money back remark!',
                money_back_amount: {
                    required: 'Please enter money back amount!',
                    number: 'Only numbers allowed!',
                    min: 'Minimum 1 value required!',
                },
            },
            submitHandler: function(form) {
                if (confirm("Are you sure you want to submit the form as this action can not be reverted back?")) {
                    form.submit();
                    document.getElementById('submit_button').remove();
                }
            }
        });
    });
    function fetchbranchPaymentDetails(){
        $('#subscription_name').val('');
        $('#subscription_price').val('');
        $('#paid_amount').val('');
        $('#previous_pending_amount').val('');
        $('#money_back_amount').val('').attr('readonly',true);
        if($("#selected_branch").val() != ""){
            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>admin/Ajax_controller/get_branch_payment_details_ajx",
                data: {
                    'branch': $("#selected_branch").val()
                },
                success: function(data) {
                    if(data != "0"){
                        var opts = $.parseJSON(data);
                        subscription_name = opts.subscription_name;
                        subscription_price = opts.subscription_price;
                        paid_amount = opts.paid_amount;
                        pending_amount = opts.pending_amount;

                        $('#subscription_name').val(subscription_name);
                        $('#subscription_price').val(parseFloat(subscription_price).toFixed(2));
                        $('#paid_amount').val(parseFloat(paid_amount).toFixed(2));
                        $('#previous_pending_amount').val(parseFloat(pending_amount).toFixed(2));
                        $('#money_back_amount').val(parseFloat(paid_amount).toFixed(2)).attr('max',parseFloat(paid_amount).toFixed(2)).attr('readonly',false);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }
    }
</script>