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
                <h3>Marketing Module Setup</h3>
            </div>
            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group"></div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <form method="post" name="master_service_form" id="master_service_form" enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                    <label>Service Reminder In <b class="require">*</b> <small>(Days)</small></label>
                                    <input type="text" class="form-control" name="service_reminder" id="service_reminder" value="<?php if(!empty($setup)){ echo $setup->service_repeat; }?>" placeholder="Enter Service Reminder In Days">
                                    <input type="hidden" class="form-control" name="service_reminder_hidden_id" id="service_reminder_hidden_id" value="<?php if(!empty($setup)){ echo $setup->id; }?>">
                                </div>
                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                    <button style="margin-top: 27px;" type="submit" name="service_remindner_button" value="service_remindner_button" id="service_remindner_button" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form> 
                    </div>  
                </div>
            </div>
            <div class="col-md-12 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <form method="post" name="master_lost_customer_form" id="master_lost_customer_form" enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                    <label>Lost Customer Reminder In <b class="require">*</b> <small>(Days)</small></label>
                                    <input type="text" class="form-control" name="lost_customer" id="lost_customer" value="<?php if(!empty($setup)){ echo $setup->lost_customer_criteria; }?>" placeholder="Enter Lost Customer Reminder In Days">
                                    <input type="hidden" class="form-control" name="lost_customer_hidden_id" id="lost_customer_hidden_id" value="<?php if(!empty($setup)){ echo $setup->id; }?>">
                                </div>
                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
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
    });
</script>




