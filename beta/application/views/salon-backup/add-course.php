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
                    Add Course
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
                                    <label>Course Name<b class="require">*</b></label>
                                    <input type="text" class="form-control" name="course_name" id="course_name" value="<?php if (!empty($single)) {
                                        echo $single->course_name;
                                    } ?>" placeholder="Enter course name">
                                    <input type="hidden" name="id" id="id" value="<?php if (!empty($single)) {
                                        echo $single->id;
                                    } ?>">
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label style="">Fee Amount<b class="require">*</b></label>
                                    <input type="text" class="form-control" name="fees_amount" id="fees_amount" value="<?php if (!empty($single)) {
                                        echo $single->fees_amount;
                                    } ?>" placeholder="Enter fees amount">
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label style="">Time<b class="require">*</b></label>
                                    <input type="text" class="form-control" name="time" id="time" value="<?php if (!empty($single)) {
                                        echo $single->time;
                                    } ?>" placeholder="Enter work time">
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label style="">Duration<b class="require">*</b></label>
                                    <input type="text" class="form-control" name="duration" id="duration" value="<?php if (!empty($single)) {
                                        echo $single->duration;
                                    } ?>" placeholder="Enter course duration">
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label class="">Select Holiday <b class="require">*</b></label>
                                    <select class="form-control form-select chosen-select" name="holiday[]" id="holiday" multiple>
                                        <option value="">Select</option>
                                        <option value="Monday">Monday</option>
                                        <option value="Tuesday">Tuesday</option>
                                        <option value="Wednesday">Wednesday</option>
                                        <option value="Thursday">Thursday</option>
                                        <option value="Friday">Friday</option>
                                        <option value="Saturday">Saturday</option>
                                        <option value="Sunday">Sunday</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label>Select Service <b class="require">*</b></label>
                                    <select class="form-control form-select chosen-select" name="service" id="service">
                                        <option value="" class="">Select</option>
                                        <?php if (!empty($service_name)) {
                                            foreach ($service_name as $service_name_result) { ?>

                                                <option value="<?= $service_name_result->id ?>" <?php if (!empty($single) && $single->service_name == $service_name_result->id) { ?>selected="selected" <?php } ?>><?= $service_name_result->service?></option>
                                            <?php }
                                        } ?>
                                    </select>
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
                course_name: 'required',
                service: 'required',
                time: 'required',
                fees_amount: 'required',
                duration: 'required',
                "holiday[]": {
                    required:true,
                }
            },
            messages: {
                course_name: 'Please enter course name',
                service: 'Please enter service name',
                fees_amount: 'Please enter fees amount',
                time: 'Please enter course timeing',
                duration: 'Please enter course duration',
                "holiday[]": {
                    required:"Please enter holiday",
                }
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