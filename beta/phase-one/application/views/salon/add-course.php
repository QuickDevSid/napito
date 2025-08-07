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
<?php
        if($gst == ""){?>
        <div class="row"> 
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title" style="text-align: center;">
                        <img src="<?= base_url(); ?>\admin_assets\images\no_data\c_store.jpg">
                    </div>
                    <div style="text-align: center;font-size: 15px;">
                    Click to complete store profile <a style="color:blue;" class="store-profile" href="<?= base_url(); ?>store-profile">Store Profile</a>
                    </div>
                </div>
            </div>
        </div>
        <?php }else{?>
        <div class="page-title">
            <div class="title_left" style="width:100%;">
                <h3>
                    Add Course <a style="float:right;" href="<?=base_url();?>course-list" class="btn btn-primary">Course List</a>
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
                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                    <label>Course Name<b class="require">*</b></label>
                                    <input autocomplete="off" type="text" class="form-control" name="course_name" id="course_name" value="<?php if (!empty($single)) {
                                        echo $single->course_name;
                                    } ?>" placeholder="Enter course name">
                                    <input type="hidden" name="id" id="id" value="<?php if (!empty($single)) {
                                        echo $single->id;
                                    } ?>">
                                </div>
                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                    <label>Fee Amount<b class="require">*</b></label>
                                    <input autocomplete="off" type="text" class="form-control" name="fees_amount" id="fees_amount" value="<?php if (!empty($single)) {
                                        echo $single->fees_amount;
                                    } ?>" placeholder="Enter fees amount">
                                </div>
                                <!-- <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                    <label>Time in hours<b class="require">*</b></label>
                                    <input type="text" class="form-control" name="time" id="time" value="<?php if (!empty($single)) {
                                        echo $single->time;
                                    } ?>" placeholder="Enter work time">
                                </div> -->
                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                    <label>Duration in month<b class="require">*</b></label>
                                    <input autocomplete="off" type="text" class="form-control" name="duration" id="duration" value="<?php if (!empty($single)) {
                                        echo $single->duration;
                                    } ?>" placeholder="Enter course duration">
                                </div>
                            </div>
                            <div class="row">
								<?php 
									$holiday = array();
									if(!empty($single)){
										$holiday = explode(",",$single->holiday);
									} 
									
								?>
                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                    <label class="">Select Holiday <b class="require">*</b></label>
                                    <select class="form-control form-select chosen-select" name="holiday[]" id="holiday" multiple>
                                        <option value="">Select</option>
                                        <option value="Monday" <?php if (!empty($single) && in_array("Monday",$holiday)){?>selected="selected"<?php }?>>Monday</option>
                                        <option value="Tuesday" <?php if (!empty($single) && in_array("Tuesday",$holiday)){?>selected="selected"<?php }?>>Tuesday</option>
                                        <option value="Wednesday" <?php if (!empty($single) && in_array("Wednesday",$holiday)){?>selected="selected"<?php }?>>Wednesday</option>
                                        <option value="Thursday" <?php if (!empty($single) && in_array("Thursday",$holiday)){?>selected="selected"<?php }?>>Thursday</option>
                                        <option value="Friday" <?php if (!empty($single) && in_array("Friday",$holiday)){?>selected="selected"<?php }?>>Friday</option>
                                        <option value="Saturday" <?php if (!empty($single) && in_array("Saturday",$holiday)){?>selected="selected"<?php }?>>Saturday</option>
                                        <option value="Sunday" <?php if (!empty($single) && in_array("Sunday",$holiday)){?>selected="selected"<?php }?>>Sunday</option>
                                    </select>
                                </div>
								<?php 
									$service_arr = array();
									if(!empty($single)){
										$service_arr = explode(",",$single->service);
									} 
									
								?>
                                <!-- <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                    <label>Select Service <b class="require">*</b></label>
                                    <select class="form-control form-select chosen-select" name="service[]" id="service" multiple>
                                         <option value="">Select service</option>
                                         <?php if (!empty($service_name)) {
                                            $service_exp = [];
                                            if (!empty($single)){
                                                $service_exp = explode(",",$single->service);
                                            }
                                            foreach ($service_name as $service_name) { ?>
                                                <option value="<?= $service_name->id ?>" <?php if (in_array($service_name->id,$service_exp)){?>selected="selected"<?php }?>><?= $service_name->service_name ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div> -->
                                <div class="form-group col-md-8 col-sm-6 col-xs-12">
                                    <label>Course Details<b class="require">*</b></label>
                                    <input autocomplete="off" type="text" class="form-control" name="course_details" id="course_details" value="<?php if (!empty($single)) {
                                        echo $single->course_details;
                                    } ?>" placeholder="Enter course details">
                                </div>
                            </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12" style="margin-top: 40px;">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                        </form> 
                    </div> 
                </div>
            </div>

        </div>
<?php }?>
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
            ignore: ":hidden:not(select)",
            rules: {
                course_name: 'required',
                course_details: 'required',
                fees_amount: {
                    required: true,
                    number: true,
                },
                duration: {
                    required: true,
                    number: true,
                },
                time: {
                    required: true,
                    number: true,
                },
                "holiday[]": {
                    required:true,
                }
            },
            messages: {
                course_name: 'Please enter course name!',
                course_details: 'Please enter course details!',
                fees_amount: {
                    required: 'Please enter fees amount!',
                    number: "Only number allowed!",
                },
                duration: {
                    required:'Please enter course duration!',
                    number: "Only number allowed!",
                },
                time: {
                    required:'Please enter course time!',
                    number: "Only number allowed!",
                },
                "holiday[]": {
                    required:"Please select holiday!",
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

    $('#holiday').on('change', function() {
        $('#holiday').valid();
    });
    $('#service').on('change', function() {
        $('#service').valid();
    });
</script>

<script>
    $(document).ready(function() {
        $('#back-office .child_menu').show();
        $('#back-office').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.add_course').addClass('active_cc');
    });
</script>