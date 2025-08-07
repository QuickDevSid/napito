
<?php include('header.php');?>
<style type="text/css">
.error{
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
                                Add Student
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
                            <div class="x_panel">
                                <div class="x_content">
                                    <div class="container">
                                    <form method="post" name="customer_form" id="customer_form" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6 col-xs-12 form-group ">
                                                        <label>Student Name <b class="require">*</b></label>
                                                        <input type="text" class="form-control" name="student_name" id="student_name" value="<?php if(!empty($single)) { echo $single->student_name;} ?>" placeholder="Enter student name">
                                                        <input type="hidden" name="id" id="id" value="<?php if(!empty($single)){ echo $single->id;}?>">
                                                    </div>
                                                <div class="col-md-6 col-sm-6 col-xs-12 form-group ">
                                                    <label>WhatsApp Number <b class="require">*</b></label>
                                                    <input type="text" class="form-control" name="phone" id="phone" value="<?php if(!empty($single)) { echo $single->phone;} ?>" placeholder="Enter whatsapp number">
                                                </div>
                                                </div>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6 col-xs-12 form-group ">
                                                    <label style="">Description </label>
                                                    <input type="text" class="form-control" name="description" id="description" value="<?php if(!empty($single)) { echo $single->description;} ?>" placeholder="Enter description">
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-12 form-group ">
                                                    <label style="">Address</label>
                                                    <input type="text" class="form-control" name="address" id="address" value="<?php if(!empty($single)) { echo $single->address;} ?>" placeholder="Enter address">

                                                </div>
                                                </div>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6 col-xs-12 form-group ">
                                                    <label style="">Email ID </label>
                                                    <input type="text" class="form-control" name="email" id="email" value="<?php if(!empty($single)) { echo $single->email;} ?>" placeholder="Enter email id">
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-12 form-group ">
                                                    <label class="col-md-12 col-xs-12">Select Course Name <b class="require">*</b></label>
                                                    <select class="form-select form-control chosen-select" name="course_name" id="course_name">
                                                        <option value="">Select</option>
                                                        <?php if (!empty($course_name)) {
                                                            foreach ($course_name as $course_name_result) { ?>
                                                                <option value="<?= $course_name_result->id ?>" <?php if (!empty($single) && $single->course_name == $course_name_result->id) { ?>selected="selected"<?php } ?>><?= $course_name_result->course_name ?></option>
                                                        <?php }
                                                        } ?>
                                                    </select>
                                                </div>
                                                </div>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6 col-xs-12 form-group ">
                                                    <label style="">Fees Amount</label>
                                                    <input type="text" class="form-control" name="fees_amount" id="fees_amount" value="<?php if (!empty($single)) { echo $single->fees_amount; } ?>" placeholder="" readonly>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-12 form-group ">
                                                    <label style="">Duration</label>
                                                    <input type="text" class="form-control" name="duration" id="duration" value="<?php if (!empty($single)) { echo $single->duration; } ?>" placeholder="" readonly>
                                                </div>
                                                </div>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6 col-xs-12 form-group ">
                                                    <label style="">Date-Of-Birth <b class="require">*</b></label>
                                                    <input type="text" class="form-control" name="dob" id="dob" value="<?php if (!empty($single)) { echo $single->dob; } ?>" placeholder="">
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-12 form-group ">
                                                    <label class="col-md-0 col-xs-12">Please select Gender  <b class="require">*</b></label>
                                                    <div style="float: left;">
                                                        
                                                    <input type="radio" id="male" name="gender" value="0">Male
                                                    <!-- <label for="male">Male</label>&nbsp&nbsp -->
            
                                                    <input type="radio" id="female" name="gender" value="1">Female
                                                    <!-- <label for="female">Female</label>&nbsp&nbsp -->
                                                    
                                                    </div>
                                                </div>
                                                </div>
                                                <pre></pre>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6 col-xs-12 form-group " >
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                                </div>
                                           </div>    
                                        </form>  <!------------end of form---->  <!------------end of form---->
                                    </div>  <!----------end of container-------->

                                </div>
                            </div>
                        </div>

                      </div>  

                    </div>
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
                ignore: "",
                rules: {
                    student_name: 'required',
                    phone: 'required',
                    gender: 'required',
                    course_name: 'required',
                    dob: 'required',
                },
                messages: {
                    student_name: 'Please enter student name',
                    phone: 'Please enter phone number',
                    course_name: 'Please enter course name',
                    gender: 'Please select gender',
                    dob: 'Please enter date of birth',
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
                    <script type="text/javascript">
                        
                        $("#course_name").change(function(){ 
                            
                            $.ajax({
                                type: "POST",
                                url: "<?=base_url();?>salon/Ajax_controller/get_course_detail",
                                data:{'course_name_id':$('#course_name').val()},
                                success: function(data){
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
                   





