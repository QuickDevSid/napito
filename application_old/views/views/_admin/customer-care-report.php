<?php include('header.php'); ?>
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
        margin-top: 20px;
        margin-left: 30px;
    }
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Add Customer Care Report
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
            <div class="x_panel">
                <div class="x_content">
                    <div class="container">
                        <form method="post" name="customer_form" id="customer_form" enctype="multipart/form-data">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Customer Name<b class="require">*</b></label>
                                    <input type="text" class="form-control" name="customer_name" id="customer_name"
                                        value="<?php if (!empty($single)) {
                                            echo $single->customer_name;
                                        } ?>" placeholder="Enter customer name">
                                    <input type="hidden" name="id" id="id" value="<?php if (!empty($single)) {
                                        echo $single->id;
                                    } ?>">
                                    <label style="display: none;" id="customer_name-error" class="error col-md-12"
                                        for="customer_name"></label>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Customer Mobile Number<b class="require">*</b></label>
                                    <input type="text" class="form-control" name="phone" id="phone" value="<?php if (!empty($single)) {
                                        echo $single->phone;
                                    } ?>" placeholder="Enter mobile number">
                                    <label style="display: none;" id="phone-error" class="error col-md-12"
                                        for="phone"></label>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Calling Employee Name <b class="require">*</b></label>
                                    <input type="text" class="form-control" name="emp_name" id="emp_name" value="<?php if (!empty($single)) {
                                        echo $single->emp_name;
                                    } ?>" placeholder="Enter employee name">
                                    <label style="display: none;" id="emp_name-error" class="error col-md-12"
                                        for="emp_name"></label>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Last Follow-up Date</label>
                                    <input readonly class="form-control" type="text" class="form-control" name="last_date"
                                        id="last_date" value="<?php if (!empty($single)) {
                                            echo $single->last_date;
                                        } ?>" placeholder="DD-MM-YYYY">
                                </div>


                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Report Status <b class="require">*</b></label>
                                    <input type="text" class="form-control" name="report_status" id="report_status" value="<?php if (!empty($single)) {
                                        echo $single->report_status;
                                    } ?>" placeholder="Enter report status">
                                    <label style="display: none;" id="report_status-error" class="error col-md-12"
                                        for="report_status"></label>


                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Remark <b class="require">*</b></label>
                                    <input type="text" class="form-control" name="remark" id="remark" value="<?php if (!empty($single)) {
                                        echo $single->remark;
                                    } ?>" placeholder="Enter remark">
                                    <label style="display: none;" id="remark-error" class="error col-md-12"
                                        for="remark"></label>


                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                <label>Upload Recording<b class="require">*</b></label>
                                <input accept=".mp3,.m4a,.wav" style="height: 50px;border: 0px;" type="file" class="form-control" name="audio_file" id="audio_file" value="<?php if(!empty($single)){ echo $single->audio_file; }?>">
                            </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group" style="margin-top: 30px">
                                  <a style="color: blue;font-weight: bold;" href="<?=base_url();?>view-calling-history">View History</a>
                                </div>
                            </div>
                            <div class="form-group col-md-12" style="margin-top: 30px">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div> <!------------end of form---->
                </div>
            </div> <!----------end of container-------->
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
    $("#last_date").datepicker({
			dateFormat:"dd-mm-yy",
			changeMonth:true,
			changeYear:true,
			maxDate:0,
			maxDate: "0",
			minDate: "-80Y",
			 
		});
    $(document).ready(function () {
        $('#customer_form').validate({
            rules: {
                customer_name: 'required',
                emp_name: 'required',
                audio_file: 'required',
                phone: 'required',
                remark: 'required',
                report_status: 'required',

            },
            messages: {
                customer_name: 'Please enter customer name',
                emp_name: 'Please enter employee name',
                audio_file: 'Please upload file',
                phone: 'Please enter  number',
                remark: 'Please enter remark',
                report_status: 'Please enter report status',

            },
            errorPlacement: function (error, element) {
                error.insertAfter(element);
            },
        });
    });


</script>