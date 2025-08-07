<?php include('header.php'); ?>
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
                    Add Employee
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
                                    <label>Email</label>
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
                                    <label>Desiganation <b class="require">*</b></label>
                                    <input autocomplete="off" type="text" class="form-control" name="desiganation" id="desiganation" value="<?php if (!empty($single)) {
                                        echo $single->desiganation;
                                    } ?>" placeholder="Enter desiganation">

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
                                    <label>Date-Of-Birth <b class="require">*</b></label>
                                    <input autocomplete="off" readonly type="text" class="form-control" name="date_of_birth" id="date_of_birth"
                                        value="<?php if (!empty($single)) {
                                            echo $single->date_of_birth;
                                        } ?>"   placeholder="DD-MM-YYYY">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Salary<b class="require">*</b></label>
                                    <input autocomplete="off" type="text" class="form-control" name="salary" id="salary"
                                        value="<?php if (!empty($single)) {
                                            echo $single->salary;
                                        } ?>"   placeholder="Enter employee salary">

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
                                    <label>Upload Aadhar Front Side <b class="require">*</b></label>
                                    <input autocomplete="off" type="file" class="form-control" name="aadhar_front" id="aadhar_front" value="<?php if (!empty($single)) {
                                        echo $single->aadhar_front;
                                    } ?>">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Upload Aadhar Back Side <b class="require">*</b></label>
                                    <input autocomplete="off" type="file" class="form-control" name="aadhar_back" id="aadhar_back" value="<?php if (!empty($single)) {
                                        echo $single->aadhar_back;
                                    } ?>">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Upload Pan Card <b class="require">*</b></label>
                                    <input autocomplete="off" type="file" class="form-control" name="pan_file" id="pan_file" value="<?php if (!empty($single)) {
                                        echo $single->pan_file;
                                    } ?>">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Upload Profile Photo <b class="require">*</b></label>
                                    <input autocomplete="off" type="file" class="form-control" name="profile_photo" id="profile_photo"
                                        value="<?php if (!empty($single)) {
                                            echo $single->profile_photo;
                                        } ?>">

                                </div>
                            </div>
                            <div class="col-md-12" style="margin-top: 20px;margin-bottom: 10px;color: back;">
                                <div class="form-group">
                                    <h3 style="color: black; font-weight: bold;">Eduction Details</h3>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Highest Education <b class="require">*</b></label>
                                    <input autocomplete="off" type="text" class="form-control" name="education" id="education" value="<?php if (!empty($single)) {
                                        echo $single->education;
                                    } ?>" placeholder="Enter highest education">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>College Name / University Name <b class="require">*</b></label>
                                    <input autocomplete="off" type="text" class="form-control" name="college_name" id="college_name" value="<?php if (!empty($single)) {
                                        echo $single->college_name;
                                    } ?>" placeholder="Enter college name or university name">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Passing Year <b class="require">*</b></label>
                                    <input autocomplete="off" type="text" class="form-control" name="passing_year" id="passing_year" value="<?php if (!empty($single)) {
                                        echo $single->passing_year;
                                    } ?>" placeholder="Enter passing year">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Percentage / Grade <b class="require">*</b></label>
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
              
                password: 'required',
                desiganation: 'required',
                address: 'required',
                date_of_birth: 'required',
                    profile_photo: 'required',
                    aadhar_front: 'required', 
                    aadhar_back: 'required', 
                    pan: {
						required: true,
						pan_no: true,
					},
                    pan_file: 'required',
                college_name: 'required',
                passing_year: 'required',
                percentage: 'required',
                education: 'required',
                salary: 'required',
                full_name: 'required',
                aadhar_number:{
                number: true,
                required: true,
                minlength: 12, 
                maxlength: 12,
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
              
                password: "Please enter password!",
                desiganation: "Please enter desiganation!",
                address: "Please enter address!",
                aadhar_number: "Please enter aadhar number!",
                aadhar_front: "Please upload aadhar front side!",
                aadhar_back: "Please upload aadhar back side!",
                profile_photo: "Please upload profile photo!", 
                college_name: "Please enter collage name!",
                passing_year: "Please enter passing year!",
                desiganation: "Please enter desiganation!",
                percentage: "Please enter percentage!",
                education: "Please enter highest degree!",
                pan: {
						required: "Please enter pan number!",
						pan_no: "Please enter valid pan number!",
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