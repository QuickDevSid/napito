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
                <h3>Salon GST Rate Setup</h3>
            </div>
            <!-- <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group"></div>
                </div>
            </div> -->
        </div>
        <!-- <div class="clearfix"></div> -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <form method="post" name="master_service_form" id="master_service_form" enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <label>GST Rate <b class="require">*</b> <small>(In %)</small></label>
                                    <input type="text" class="form-control" name="gst_rate" id="gst_rate" value="<?php if(!empty($setup)){ echo $setup->gst_rate; }?>" placeholder="Enter GST Rate">
                                    <input type="hidden" class="form-control" name="hidden_id" id="hidden_id" value="<?php if(!empty($setup)){ echo $setup->id; }?>">
                                </div>
                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <button style="margin-top: 27px;" type="submit" name="service_remindner_button" value="service_remindner_button" id="service_remindner_button" class="btn btn-success">Submit</button>
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
                gst_rate: {
                    required: true, 
                    number: true, 
                    min: 1, 
                },
            },
            messages: {
                gst_rate: {
                    required: "Please Enter GST Rate!", 
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
    });
</script>




