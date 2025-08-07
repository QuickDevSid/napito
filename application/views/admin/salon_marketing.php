<?php include('header.php');?>
<style type="text/css">
.input-content-option{
    height: 33px;
    width: 570px;
   
}
</style>

  <!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Marketing and Subscription Module Setup</h3>
            </div>
            <!-- <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group"></div>
                </div>
            </div> -->
        </div>
        <!-- <div class="clearfix"></div> -->
        <div class="row">
            <?php 
            // $money_back_features = [1000,1500,2000,2500];
            $money_back_features = [
                array(
                    'value' =>  1000,
                    'label' =>  '1'
                ),
                array(
                    'value' =>  1500,
                    'label' =>  '2'
                ),
                array(
                    'value' =>  2000,
                    'label' =>  '3'
                ),
                array(
                    'value' =>  2500,
                    'label' =>  '4'
                ),
            ];
            for($i=0;$i<count($money_back_features);$i++){ 
                $column_name = 'money_back_' . $money_back_features[$i]['value'] . '_value';
            ?>
            <div class=" col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <form method="post" name="set_money_back_<?=$money_back_features[$i]['value'];?>_value_form" id="set_money_back_<?=$money_back_features[$i]['value'];?>_value_form" enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-8 col-sm-6 col-xs-12">
                                    <label>
                                        Money Back Guarentee Feature Customer Count<b class="require">*</b>
                                        <br><small>for <?=$money_back_features[$i]['label'];?> Customers Feature</small>
                                    </label>
                                    <input type="text" class="form-control" name="money_back_<?=$money_back_features[$i]['value'];?>_value" id="money_back_<?=$money_back_features[$i]['value'];?>_value" value="<?php if(!empty($setup)){ echo $setup->$column_name; }?>" placeholder="Enter Customer Count">
                                    <input type="hidden" class="form-control" name="money_back_<?=$money_back_features[$i]['value'];?>_value_hidden_value" id="money_back_<?=$money_back_features[$i]['value'];?>_value_hidden_value" value="<?php if(!empty($setup)){ echo $setup->id; }?>">
                                </div>
                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <br>
                                    <button style="margin-top: 27px;" type="submit" name="set_money_back_<?=$money_back_features[$i]['value'];?>_value" value="set_money_back_<?=$money_back_features[$i]['value'];?>_value" id="set_money_back_<?=$money_back_features[$i]['value'];?>_value" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form> 
                    </div>  
                </div>
            </div>
            <?php } ?>
            <div class=" col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <form method="post" name="master_emergency_bill_form" id="master_emergency_bill_form" enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-8 col-sm-6 col-xs-12">
                                    <label>Maximum Emergency Bills Count <b class="require">*</b> <small>(Per Day)</small></label>
                                    <input type="text" class="form-control" name="emergency_bill_count" id="emergency_bill_count" value="<?php if(!empty($setup)){ echo $setup->emergency_bill_count; }?>" placeholder="Enter Max Emergency Bills Count (Per Day)">
                                    <input type="hidden" class="form-control" name="emergency_bill_count_hidden_id" id="emergency_bill_count_hidden_id" value="<?php if(!empty($setup)){ echo $setup->id; }?>">
                                </div>
                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <button style="margin-top: 27px;" type="submit" name="emergency_bill_count_button" value="emergency_bill_count_button" id="emergency_bill_count_button" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form> 
                    </div>  
                </div>
            </div>
            <div class=" col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <form method="post" name="master_service_form" id="master_service_form" enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-8 col-sm-6 col-xs-12">
                                    <label>Service Reminder In <b class="require">*</b> <small>(Days)</small></label>
                                    <input type="text" class="form-control" name="service_reminder" id="service_reminder" value="<?php if(!empty($setup)){ echo $setup->service_repeat; }?>" placeholder="Enter Service Reminder In Days">
                                    <input type="hidden" class="form-control" name="service_reminder_hidden_id" id="service_reminder_hidden_id" value="<?php if(!empty($setup)){ echo $setup->id; }?>">
                                </div>
                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <button style="margin-top: 27px;" type="submit" name="service_remindner_button" value="service_remindner_button" id="service_remindner_button" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form> 
                    </div>  
                </div>
            </div>
            <div class=" col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <form method="post" name="master_lost_customer_form" id="master_lost_customer_form" enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-8 col-sm-6 col-xs-12">
                                    <label>Lost Customer Reminder In <b class="require">*</b> <small>(Days)</small></label>
                                    <input type="text" class="form-control" name="lost_customer" id="lost_customer" value="<?php if(!empty($setup)){ echo $setup->lost_customer_criteria; }?>" placeholder="Enter Lost Customer Reminder In Days">
                                    <input type="hidden" class="form-control" name="lost_customer_hidden_id" id="lost_customer_hidden_id" value="<?php if(!empty($setup)){ echo $setup->id; }?>">
                                </div>
                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <button style="margin-top: 27px;" type="submit" name="lost_customer_button" value="lost_customer_button" id="lost_customer_button" class="btn btn-success">Submit</button>
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
        $('#master_emergency_bill_form').validate({
            rules: {
                emergency_bill_count: {
                    required: true, 
                    number: true, 
                    min: 0, 
                },
            },
            messages: {
                emergency_bill_count: {
                    required: "Please Enter count!", 
                    number: "Enter numbers only!", 
                    min: "Minimum 0 required!", 
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
        $('#master_service_form').validate({
            rules: {
                service_reminder: {
                    required: true, 
                    number: true, 
                    min: 1, 
                },
            },
            messages: {
                service_reminder: {
                    required: "Please Enter Days!", 
                    number: "Enter numbers only!", 
                    min: "Minimum 1 day required!", 
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
        $('#master_lost_customer_form').validate({
            rules: {
                lost_customer: {
                    required: true, 
                    number: true, 
                    min: 1, 
                },
            },
            messages: {
                lost_customer: {
                    required: "Please Enter Days!", 
                    number: "Enter numbers only!", 
                    min: "Minimum 1 day required!", 
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
        
        <?php for($i=0;$i<count($money_back_features);$i++){ ?>
            $('#set_money_back_<?=$money_back_features[$i]['value'];?>_value_form').validate({
                rules: {
                    'money_back_<?=$money_back_features[$i]['value'];?>_value': {
                        required: true, 
                        number: true, 
                        min: 1, 
                    },
                },
                messages: {
                    'money_back_<?=$money_back_features[$i]['value'];?>_value': {
                        required: "Please Enter customer count!", 
                        number: "Enter numbers only!", 
                        min: "Minimum 1 value required!", 
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
        <?php } ?>
    });
</script>




