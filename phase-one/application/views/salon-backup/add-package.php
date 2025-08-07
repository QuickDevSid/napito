<?php include('header.php'); ?>
<style type="text/css">
    .error {
        color: red;
        float: left;
        /*    position: absolute;*/
    }

    .input-content-option {
        height: 35px;
        width: 590px;

    }

    .chosen-choices {
        height: 33px !important;

    }
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Add Package
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

                    
                        


                        <form method="post" class="form-group" name="customer_form" id="customer_form" enctype="multipart/form-data">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Package Name <b class="require">*</b></label>
                                    <input type="text" class="form-control" name="package_name" id="package_name"
                                        value="<?php if (!empty($single)) {
                                            echo $single->package_name;
                                        } ?>"
                                        placeholder="Enter package name">
                                    <input type="hidden" name="id" id="id"
                                        value="<?php if (!empty($single)) {
                                            echo $single->id;
                                        } ?>">
                                   
                                </div>
                                 </div>
                             
                                 <div class="col-md-6 col-sm-6 col-xs-12">

                                <div class="form-group">
                                    <label>Select Service <b class="require">*</b></label>
                                    <select style="border: solid gray 1px;"
                                        class="form-select chosen-select form-control input-content-option "
                                        name="service_name[]" id="service_name" multiple>
                                        <option value="" class="">Select</option>
                                        <?php if (!empty($service_name)) {
                                            foreach ($service_name as $service_name_result) { ?>

                                                <option value="<?= $service_name_result->id ?>" <?php if (!empty($single) && $single->service_name == $service_name_result->id) { ?>selected="selected" <?php } ?>><?= $service_name_result->service ?></option>
                                            <?php }
                                        } ?>
                                    </select>
                                   
                                </div>
                                 </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">

                                <div class="form-group">
                                    <label>Actual Price <b class="require">*</b></label>
                                    <input type="text" class="form-control" name="actual_price" id="actual_price"
                                        value="<?php if (!empty($single)) {
                                            echo $single->actual_price;
                                        } ?>"
                                        placeholder="Enter actual price">
                                   
                                </div>
                                 </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Discount <b class="require">*</b></label>
                                    <input type="text" class="form-control" name="discount" id="discount"
                                        value="<?php if (!empty($single)) {
                                            echo $single->discount;
                                        } ?>"
                                        placeholder="Enter discount">
                                   
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Amount <b class="require">*</b></label>
                                    <input type="text" class="form-control" name="amount" id="amount"
                                        value="<?php if (!empty($single)) {
                                            echo $single->amount;
                                        } ?>"
                                        placeholder="Enter amount">
                                    
                                </div>
                                 </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Select Count Type<b class="require">*</b></label>
                                    <select
                                        class="form-select form-control input-content-option col-md-6 col-xs-12 chosen-select"
                                        name="count_type" id="count_type">
                                        <option name="count_type" value="" class="">Select</option>
                                        <option name="count_type" value="0" class="">Days</option>
                                        <option name="count_type" value="1" class="">Week</option>
                                        <option name="count_type" value="2" class="">Month</option>
                                        <option name="count_type" value="3" class="">Year</option>
                                    </select>
                                    
                                </div>
                                 </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label style="">Count Number <b class="require">*</b></label>
                                    <input type="number" class="form-control" name="count_value" id="count_value"
                                        value="<?php if (!empty($single)) {
                                            echo $single->count_value;
                                        } ?>"
                                        placeholder="Enter  count number">
                                   
                                </div>
                                 </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label style="">Reward Point <b class="require">*</b></label>
                                    <input type="text" class="form-control" name="reward_point" id="reward_point"
                                        value="<?php if (!empty($single)) {
                                            echo $single->reward_point;
                                        } ?>"
                                        placeholder="Enter reward point">
                                    
                                </div>

                                 </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group col-md-0 col-xs-12" style="margin-top: 40px;">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form> <!------------end of form---->
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
    $(document).ready(function () {
        $('#customer_form').validate({
            ignore:"",
            rules: {
                package_name: 'required',
                discount: 'required',
                amount: 'required',
                count_value: 'required',
                count_type: 'required',
                reward_point: 'required',
                actual_price: 'required',
                "service_name[]":{
                required: true
                },
            },
            messages: {
                package_name: 'Please enter package name',
                discount: 'Please enter discount',
                amount: 'Please enter amount',
                count_value: 'Please enter count value',
                count_type: 'Please select count type',
                reward_point: 'Please enter reward point',
                actual_price: 'Please enter actual price',
                "service_name[]": {
                    required: "Please select at least one value",
                },
            },
            errorPlacement: function (error, element) {
                error.insertAfter(element);
            },
        });
    });


</script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".chosen-select").chosen({
            max_selected_options: 5
        });
    });
</script>