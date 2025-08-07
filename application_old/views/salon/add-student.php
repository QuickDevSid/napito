
<?php include('header.php');?>
<style type="text/css">
/* .error{
    color: red;
    float: left;

 } */
 

</style>
  <!-- page content -->
            <div class="right_col" role="main">
            <?php
        if($gst == ""){?>
        <div class="row"> 
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
                        <div class="title_left" >
                            <h3>
                                Add Student<a style="float:right;" href="<?=base_url();?>student-list" class="btn btn-primary">Student List</a>
                            </h3>
                        </div>

                        <!-- <div class="title_right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                <div class="input-group">
                                    
                                </div>
                            </div>
                        </div> -->
                    </div>
                    <!-- <div class="clearfix"></div> -->
                            <div class="x_panel">
                                <div class="x_content">
                                    <div class="container">
                                        <form method="post" name="customer_form" id="customer_form" enctype="multipart/form-data">
                                            <div class="row row_f">
                                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                    <label>WhatsApp Number <b class="require">*</b></label>
                                                    <input autocomplete="off" type="text" class="form-control" name="phone" id="phone" value="<?php if(!empty($single)) { echo $single->phone;} ?>" placeholder="Enter whatsapp number">
                                                    <span class="error" id="phone_error"></span>
                                                </div>
                                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                    <label>Student Name <b class="require">*</b></label>
                                                    <input autocomplete="off" type="text" class="form-control" name="student_name" id="student_name" value="<?php if(!empty($single)) { echo $single->student_name;} ?>" placeholder="Enter student name">
                                                    <input type="hidden" name="id" id="id" value="<?php if(!empty($single)){ echo $single->id;}?>">
                                                    <input type="hidden" name="old_student_id" id="old_student_id" value="<?php if(!empty($single)){ echo $single->id;}?>">
                                                </div>
                                                
                                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                    <label>Description </label>
                                                    <input autocomplete="off" type="text" class="form-control" name="description" id="description" value="<?php if(!empty($single)) { echo $single->description;} ?>" placeholder="Enter description">
                                                </div>
                                            <!-- </div>
                                            <div class="row"> -->
                                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                    <label>Address</label>
                                                    <input autocomplete="off" type="text" class="form-control" name="address" id="address" value="<?php if(!empty($single)) { echo $single->address;} ?>" placeholder="Enter address">

                                                </div>
                                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                    <label>Email ID </label>
                                                    <input autocomplete="off" type="text" class="form-control" name="email" id="email" value="<?php if(!empty($single)) { echo $single->email;} ?>" placeholder="Enter email id">
                                                </div>
                                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                    <label class="col-md-12 col-xs-12">Select Course Name <b class="require">*</b></label>
                                                    <select class="form-select form-control chosen-select" name="course_name" id="course_name">
                                                        <option value="">Select</option>
                                                        <?php if (!empty($course_name)) {
                                                            foreach ($course_name as $course_name_result) { ?>
                                                                <option value="<?= $course_name_result->id ?>" <?php if (!empty($single) && $single->payment_course_name == $course_name_result->id) { ?>selected="selected"<?php } ?>><?= $course_name_result->course_name ?></option>
                                                        <?php }
                                                        } ?>
                                                    </select>
                                                </div>
                                            <!-- </div>
                                            <div class="row">    -->
                                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                    <label>Fees Amount</label>
                                                    <input autocomplete="off" type="text" class="form-control" name="fees_amount" id="fees_amount" value="<?php if (!empty($single)) { echo $single->total_fees; } ?>" placeholder="Enter fees amount" readonly>
                                                </div>
                                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                    <label>Duration</label>
                                                    <input autocomplete="off" type="text" class="form-control" name="duration" id="duration" value="<?php if (!empty($single)) { echo $single->duration; } ?>" placeholder="Enter course duration" readonly>
                                                </div>
                                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                    <label>Date Of Birth</label>
                                                    <input autocomplete="off" type="text" class="form-control datepick " name="dob" id="dob" value="<?php if (!empty($single)) { echo $single->dob; } ?>" placeholder="DD/MM/YYYY">
                                                </div>
                                            <!-- </div>
                                            <div class="row"> -->
                                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                    <label>Admission Date <b class="require">*</b></label>
                                                    <input readonly autocomplete="off" type="text" class="form-control datepick " name="add_date" id="add_date" value="<?php if (!empty($single)) { echo $single->add_date; }else{ echo date('d/m/Y'); } ?>" placeholder="DD/MM/YYYY">
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                                    <label>Select Gender<b class="require">*</b></label>
                                                    <select class="form-select form-control chosen-select" name="gender" id="gender">
                                                        <option value="" class="">Select gender</option>
                                                        <?php if ($store_category->category == 0){?>
                                                            <option id="male" value="0" <?php if ((!empty($single) && $single->gender == 0)) echo 'selected="selected"'; ?>>Male</option>
                                                            <?php }?>
                                                            <?php if ($store_category->category == 1){?>
                                                            <option id="female" value="1" <?php if ((!empty($single) && $single->gender == 1)) echo 'selected="selected"'; ?>>Female</option>
                                                            <?php }?>
                                                            <?php if ($store_category->category == 2){?>
                                                            <option id="male" value="0" <?php if ((!empty($single) && $single->gender == 0)) echo 'selected="selected"'; ?>>Male</option>
                                                            <option id="female" value="1" <?php if ((!empty($single) && $single->gender == 1)) echo 'selected="selected"'; ?>>Female</option>
                                                            <!-- <option id="unisex" value="2" <?php if ((!empty($single) && $single->gender == 2)) echo 'selected="selected"'; ?>>unisex</option> -->
                                                            <?php }?>
                                                    </select>
                                               </div>
                                            </div>
                                                <div class="form-group col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px;margin-left:-10px;">
                                                    <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                        </form> 
                                    </div>  

                                </div>
                            </div>
                        </div>

                      </div>  

                    </div>
                    <?php }?>
                </div>
                <?php include('footer.php');
                    $id = 0;
                    if($this->uri->segment(2) !=""){
                        $id = $this->uri->segment(2);
                    }
                ?>
                <script>
        $(document).ready(function () {     
            $('#customer_form').validate({
                // ignore: "",
                ignore: ":hidden:not(select)",
                rules: {
                    student_name: 'required',
                    phone: {
						required: true,
						number: true,
						// mobile_no: true,
						minlength: 10,
						maxlength: 10,
					},
                    gender: 'required',
                    course_name: 'required',
                    add_date: 'required',
                },
                messages: {
                    student_name: 'Please enter student name!',
                    phone: {
						required: "Please enter whatsapp number!",
						number: "Only number allowed!",
						// mobile_no: "Please enter valid number!",
						minlength: "Minimum 10 digit required!",
						maxlength: "Maximum 10 digit allowed!",
					},
                    course_name: 'Please enter course name!',
                    gender: 'Please select gender!',
                    add_date: 'Please enter date of addmission!',
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
                },
            });
        });
  
        $('#course_name').on('change', function() {
            $('#course_name').valid();
        });

        $('#gender').on('change', function() {
            $('#gender').valid();
        });


</script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".chosen-select").chosen({
                
        });
    });
</script>
<script type="text/javascript">
    
    $("#course_name").change(function() {
        $.ajax({
            type: "POST",
            url: "<?=base_url();?>salon/Ajax_controller/get_course_detail",
            data: {'course_name_id': $('#course_name').val()},
            success: function(data) {
                data = JSON.parse(data);
                // console.log(data);
                $("#fees_amount").val(data.fees_amount);
                $("#duration").val(data.duration);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });
</script>
              
<script>
   $(".datepick").datepicker({
    dateFormat: "dd/mm/yy",
    changeMonth: true,
    changeYear: true,
    maxDate: "0",  
    minDate: "-100y", 
    yearRange: "-100:+0",  
});
</script>


<script>
   
$("#phone").keyup(function(){   
	$.ajax({ 
		type: "POST", 
		url: "<?=base_url()?>salon/Ajax_controller/get_student_data_ajax", 
		data:{'phone':$("#phone").val()},
		success: function(data){ 
			var opts = $.parseJSON(data);
			if(opts){
				console.log(opts);
				$("#student_name").val(opts.student_name);
				$("#description").val(opts.description); 
				$("#address").val(opts.address); 
				$("#email").val(opts.email); 
                $("#fees_amount").val(opts.fees_amount); 
				$("#duration").val(opts.duration);
                $("#dob").val(opts.dob); 
				$("#add_date").val(opts.add_date);
                $("#gender").val(opts.gender);
                $("#gender").trigger("chosen:updated");


                $("#old_student_id").val(opts.id);

                $("#course_name option").each(function() {
                    if ($(this).val() == opts.payment_course_name) {
                        // $(this).prop('selected', true);
                        $(this).prop('disabled', true);
                    } else {
                        $(this).prop('disabled', false);
                    }
                });
                // Trigger the chosen-select update (if using chosen-select)
                $("#course_name").trigger("chosen:updated");

			}else{
				$("#student_name").val('');
				$("#description").val(''); 
				$("#address").val(''); 
				$("#email").val(''); 
				$("#fees_amount").val(''); 
				$("#duration").val(''); 
				$("#dob").val(''); 
				$("#add_date").val('');
				$("#gender").val('');

                $("#old_student_id").val('');

                $("#course_name option").prop('selected', false);
                $("#course_name option").prop('disabled', false);
                // Trigger the chosen-select update (if using chosen-select)
                $("#course_name").trigger("chosen:updated");
			} 
		}, 
		error: function(jqXHR, textStatus, errorThrown) { 
		   console.log(textStatus, errorThrown); 
		}
	});	 
}); 
</script>
<script>
    $(document).ready(function() {
        $('#back-office .child_menu').show();
        $('#back-office').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.add_student').addClass('active_cc');
    });
</script>