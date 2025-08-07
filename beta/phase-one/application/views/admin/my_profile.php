<?php include('header.php'); 
$single = $profile;
?>
<style type="text/css">
    input[type="file"] {
        height: 50px;
    }
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    My Profile
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
                        <form method="post" name="employee_form" id="employee_form" enctype="multipart/form-data">
                            <div class="col-md-12" style="margin-top: 20px;margin-bottom: 10px;color: back;">
                                <div class="form-group">
                                    <h3 style="color: black; font-weight: bold;">Personal Details</h3>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Full Name <b class="require">*</b></label>
                                    <input autocomplete="off" type="text" class="form-control" name="full_name" id="full_name" value="<?php if (!empty($single)) {
                                        echo $single->full_name;
                                    } ?>" placeholder="Enter full name">
                                    <input autocomplete="off" type="hidden" name="id" id="id" value="<?php if (!empty($single)) {
                                        echo $single->id;
                                    } ?>">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Phone <b class="require">*</b></label>
                                    <input autocomplete="off" type="text" class="form-control" name="phone" id="phone" value="<?php if (!empty($single)) {
                                        echo $single->phone;
                                    } ?>" placeholder="Enter employee phone number">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Family Phone</label>
                                    <input autocomplete="off" type="text" class="form-control" name="family_phone" id="family_phone" value="<?php if (!empty($single)) {
                                        echo $single->family_phone;
                                    } ?>" placeholder="Enter family phone number">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email <b class="require">*</b></label>
                                    <input autocomplete="off" type="text" class="form-control" name="email" id="email" value="<?php if (!empty($single)) {
                                        echo $single->email;
                                    } ?>" placeholder="Enter employee email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password <b class="require">*</b></label>
                                    <input autocomplete="off" type="text" class="form-control" name="password" id="Password" value="<?php if (!empty($single)) {
                                        echo $single->password;
                                    } ?>" placeholder="Enter Password">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Address <b class="require">*</b></label>
                                    <input autocomplete="off" type="text" class="form-control" name="address" id="address" value="<?php if (!empty($single)) {
                                        echo $single->address;
                                    } ?>" placeholder="Enter address">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date of Birth <b class="require">*</b></label>
                                    <input autocomplete="off" readonly type="text" class="form-control" name="date_of_birth" id="date_of_birth"
                                        value="<?php if (!empty($single)) {
                                            echo $single->date_of_birth;
                                        } ?>"   placeholder="DD-MM-YYYY">

                                </div>
                            </div>
                            <div class="col-md-12" style="margin-top: 20px;margin-bottom: 10px;color: back;">
                                <div class="form-group">
                                    <h3 style="color: black; font-weight: bold;">Documents</h3>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Aadhar Number <b class="require">*</b></label>
                                    <input autocomplete="off" type="text" class="form-control" name="aadhar_number" id="aadhar_number"
                                        value="<?php if (!empty($single)) {
                                            echo $single->aadhar_number;
                                        } ?>" placeholder="Enter employee aadhar number">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pan Card <b class="require">*</b></label>
                                    <input autocomplete="off" type="text" class="form-control" name="pan" id="pan" value="<?php if (!empty($single)) {
                                        echo $single->pan;
                                    } ?>" placeholder="Enter pan card number">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Upload Aadhar Front Side <b class="require">*</b> <?php if(!empty($single) && $single->aadhar_front !=""){?> <a href="<?=base_url()?>admin_assets/images/employee_aadhar/<?=$single->aadhar_front?>" target="_blank">View</a><?php }?></label>
                                    <input autocomplete="off" type="file" accept=".png, .jpg, .jpeg .pdf" class="form-control" name="aadhar_front" id="aadhar_front" value="<?php if (!empty($single)) {
                                        echo $single->aadhar_front;
                                    } ?>">
                                    <input type="hidden" name="old_aadhar_front" value="<?php if(!empty($single) && $single->aadhar_front !=""){ echo $single->aadhar_front; }?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Upload Aadhar Back Side <b class="require">*</b><?php if(!empty($single) && $single->aadhar_back !=""){?> <a href="<?=base_url()?>admin_assets/images/employee_aadhar/<?=$single->aadhar_back?>" target="_blank">View</a><?php }?></label>
                                    <input autocomplete="off" type="file" accept=".png, .jpg, .jpeg .pdf" class="form-control" name="aadhar_back" id="aadhar_back" value="<?php if (!empty($single)) {
                                        echo $single->aadhar_back;
                                    } ?>">
                                    <input type="hidden" name="old_aadhar_back" value="<?php if(!empty($single) && $single->aadhar_back !=""){ echo $single->aadhar_back; }?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Upload Pan Card <b class="require">*</b> <?php if(!empty($single) && $single->pan_file !=""){?> <a href="<?=base_url()?>admin_assets/images/employee_pancard/<?=$single->pan_file?>" target="_blank">View</a><?php }?></label>
                                    <input autocomplete="off" type="file" accept=".png, .jpg, .jpeg .pdf" class="form-control" name="pan_file" id="pan_file" value="<?php if (!empty($single)) {
                                        echo $single->pan_file;
                                    } ?>">
                                    <input type="hidden" name="old_pan_file" value="<?php if(!empty($single) && $single->pan_file !=""){ echo $single->pan_file; }?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Upload Profile Photo <b class="require">*</b> <?php if(!empty($single) && $single->profile_photo !=""){?> <a href="<?=base_url()?>admin_assets/images/employee_profile/<?=$single->profile_photo?>" target="_blank">View</a><?php }?></label>
                                    <input autocomplete="off" type="file" class="form-control" accept=".png, .jpg, .jpeg .pdf" name="profile_photo" id="profile_photo"
                                        value="<?php if (!empty($single)) {
                                            echo $single->profile_photo;
                                        } ?>">
                                    <input type="hidden" name="old_profile_photo" value="<?php if(!empty($single) && $single->profile_photo !=""){ echo $single->profile_photo; }?>">
                                </div>
                            </div>
                            <div class="col-md-12" style="margin-top: 20px;margin-bottom: 10px;color: back;">
                                <div class="form-group">
                                    <h3 style="color: black; font-weight: bold;">Eduction Details</h3>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Highest Education</label>
                                    <input autocomplete="off" type="text" class="form-control" name="education" id="education" value="<?php if (!empty($single)) {
                                        echo $single->education;
                                    } ?>" placeholder="Enter highest education">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>College Name / University Name</label>
                                    <input autocomplete="off" type="text" class="form-control" name="college_name" id="college_name" value="<?php if (!empty($single)) {
                                        echo $single->college_name;
                                    } ?>" placeholder="Enter college name or university name">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Passing Year</label>
                                    <input autocomplete="off" type="text" class="form-control" name="passing_year" id="passing_year" value="<?php if (!empty($single)) {
                                        echo $single->passing_year;
                                    } ?>" placeholder="Enter passing year">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Percentage / Grade</label>
                                    <input autocomplete="off" type="text" class="form-control" name="percentage" id="percentage" value="<?php if (!empty($single)) {
                                        echo $single->percentage;
                                    } ?>" placeholder="Enter percentage or grade">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" style="margin-top: 20px;">
                                    <button type="submit" class="btn btn-success">Submit</button>
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
        $("#date_of_birth").datepicker({
			dateFormat:"dd-mm-yy",
			changeMonth:true,
			changeYear:true,
			maxDate:0,
			maxDate: "0",
			minDate: "-80Y",
			 
		});


        jQuery.validator.addMethod("validateAadhaarNumber", function(value, element) {
        return /^\d{12}$/.test(value);
        }, "Please enter a valid aadhaar card number (12 digits).");

        jQuery.validator.addMethod("validatePAN", function(value, element) {
            var panPattern = /^[A-Z]{5}[0-9]{4}[A-Z]{1}$/;
            return this.optional(element) || (panPattern.test(value) && value.length >= 10);
        }, "Please enter a valid pan card number"); 


    $(document).ready(function () {
        $('#employee_form').validate({
            ignore: "",
            rules: {
                full_name: 'required',
                phone:{
                    number: true,
                    required: true,
                    minlength: 10, 
                    maxlength: 10,
                },
                email:{
                    required: true,
                    email: true,
                },
              
                password: 'required',
                desiganation: 'required',
                address: 'required',
                date_of_birth: 'required',
                profile_photo: {
                    required: function(element) {
                        return $('#old_profile_photo').val() == '';
                    },
                },
                aadhar_front: {
                    required: function(element) {
                        return $('#old_aadhar_front').val() == '';
                    },
                },
                aadhar_back: {
                    required: function(element) {
                        return $('#old_aadhar_back').val() == '';
                    },
                },
                pan: {
                    required: true,
                    // pan_no: true,
                    validatePAN:"true",
                },
                pan_file: {
                    required: function(element) {
                        return $('#old_pan_file').val() == '';
                    },
                },
                // college_name: 'required',
                // passing_year: 'required',
                // percentage: 'required',
                // education: 'required',
                salary: 'required',
                full_name: 'required',
                aadhar_number:{
                // number: true,
                required: true,
                // minlength: 12, 
                // maxlength: 12,
                validateAadhaarNumber:'true',
                },


            },
            messages: {
                full_name: "Please enter full name!",
                phone:{
                    required: "Please enter phone number!",
                    number: "Please enter number!",
                    minlength: "Enter valid contact number!!", 
                    maxlength: "Length of contact number is too large!",
                },
                email:{
                    required: "Please enter email!",
                    email: "Please enter valid email!",
                },
              
                password: "Please enter password!",
                desiganation: "Please enter designation!",
                address: "Please enter address!",
                aadhar_number:{
                    required: "Please enter aadhar number!",
                    validateAadhaarNumber:"Please enter valid aadhar card number!",
                },
                aadhar_front: "Please upload aadhar front side!",
                aadhar_back: "Please upload aadhar back side!",
                profile_photo: "Please upload profile photo!", 
                college_name: "Please enter collage name!",
                passing_year: "Please enter passing year!",
                desiganation: "Please enter designation!",
                percentage: "Please enter percentage!",
                education: "Please enter highest degree!",
                pan: {
						required: "Please enter pan number!",
						// pan_no: "Please enter valid pan number!",
                        validatePAN:"Please enter valid pancard number!",
					},
                pan_file: "Please upload pan card file!",
                date_of_birth: "Please enter date of birth!",
                salary: "Please enter salary amount!",
            },
            errorPlacement: function (error, element) {
                error.insertAfter(element);
            },
        });
    });

</script>