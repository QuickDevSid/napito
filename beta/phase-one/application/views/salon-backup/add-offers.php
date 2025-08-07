<?php include('header.php'); ?>
<style type="text/css">
    .error {
        color: red;
        float: left;
        /*    position: absolute;*/
    }

    
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Add Offers
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
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label>Offers Name<b class="require">*</b></label>
                                    <input type="text" class="form-control" name="offers_name" id="offers_name"
                                        value="<?php if (!empty($single)) {
                                            echo $single->offers_name;
                                        } ?>"
                                        placeholder="Enter package name">
                                    <input type="hidden" name="id" id="id"
                                        value="<?php if (!empty($single)) {
                                            echo $single->id;
                                        } ?>">
                                    
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label style="">Offers Duration <b class="require">*</b></label>
                                    <input type="text" class="form-control" name="duration" id="duration"
                                        value="<?php if (!empty($single)) {
                                            echo $single->duration;
                                        } ?>"
                                        placeholder="Enter reward point">
                                   
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label>Select Gender<b class="require">*</b></label>
                                    <select
                                        class="form-select form-control chosen-select"
                                        name="gender" id="gender">
                                        <option value="" class="">Select</option>
                                        <option id="male" value="0" class="">Male</option>
                                        <option id="female" value="1" class="">Female</option>
                                    </select>
                                   
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label>Select Function<b class="require">*</b></label>
                                    <select
                                        class="form-select form-control chosen-select"
                                        name="function" id="function">
                                        <option value="" class="">Select</option>
                                        <option id="Anniversary" value="0" class=""> Anniversary</option>
                                        <option id="Birthday" value="1" class="">Birthday</option>
                                        <option id="Marrige" value="2" class="">Marrige</option>
                                    </select>
                                   
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label>Discount <b class="require">*</b></label>
                                    <input type="number" class="form-control" name="discount" id="discount"
                                        value="<?php if (!empty($single)) {
                                            echo $single->discount;
                                        } ?>"
                                        placeholder="Enter discount (e.g., 10%)" step="0.01">
                                    
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label>Select Service <b class="require">*</b></label>
                                    <select 
                                        class="form-select form-control chosen-select"
                                        name="service_name" id="service_name">
                                        <option value="" class="">Select Service </option>
                                        <?php if (!empty($service_name)) {
                                            foreach ($service_name as $service_name_result) { ?>

                                                <option value="<?= $service_name_result->id ?>" <?php if (!empty($single) && $single->service_name == $service_name_result->id) { ?>selected="selected" <?php } ?>><?= $service_name_result->service ?></option>
                                            <?php }
                                        } ?>
                                    </select>
                                   
                                </div>
                                
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label style="">Description </label>
                                    <input type="text" class="form-control" name="description" id="description"
                                        value="<?php if (!empty($single)) {
                                            echo $single->description;
                                        } ?>"
                                        placeholder="Enter reward point">
                                    
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label style="">Reward Point <b class="require">*</b></label>
                                    <input type="text" class="form-control" name="reward_point" id="reward_point"
                                        value="<?php if (!empty($single)) {
                                            echo $single->reward_point;
                                        } ?>"
                                        placeholder="Enter reward point">
                                 
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12" style="margin-top: 40px;">
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
            ignore: "",
            rules: {
                offers_name: 'required',
                discount: 'required',
                service_name: 'required',
                reward_point: 'required',
                gender: 'required',
                function: 'required',
                duration: 'required',
            },
            messages: {
                offers_name: 'Please enter offers name',
                discount: 'Please enter discount',
                reward_point: 'Please enter reward point',
                service_name: 'Please select service name',
                gender: 'Please select gender',
                function: 'Please select funtion',
                duration: 'Please enter duration',
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
<script type="text/javascript">
    $(document).ready(function () {
        $(".chosen-select").chosen({
            max_selected_options: 5
        });
    });
</script>