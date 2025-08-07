<?php include('header.php'); ?>
<style type="text/css">
    .input-content-option {
        height: 35px;
        width: 600px;
        border-radius: 5px;
        border: solid gray 1px;
        float: left;
    }
</style>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Add Employee Attendance
                </h3>
            </div>

            <!-- <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">

                    </div>
                </div>
            </div> -->
        </div>
        <div class="clearfix"></div>

        <div class="row">


            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                    <div class="x_content">
                        <div class="container">

                            <form name="attensence_form" id="attensence_form" method="post">
                                <div class="container animated fadeInRight">
                                    <div class="">

                                        <div class="row top-section">
                                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                           <label class="">Attendance Date <b class="require">*</b></label>
                                           <input type="text" readonly name="attendance_date" id="attendance_date" placeholder="DD-MM-YYYY" class="form-control get_attendance" value="<?= date('d-m-Y'); ?>">
                                        </div>
                                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <label>Select Shift <b class="require">*</b></label>
                                            <select class="form-select form-control get_attendance" name="shift_name" id="shift_name">
                                                <option value="">Select shift</option>
                                                <?php if(!empty($shift_name)){ 
                                                    foreach($shift_name as $shift_name_result){?>
                                                    <option value="<?=$shift_name_result->id?>" <?php if(!empty($single) && $single->shift_name == $shift_name_result->id){?>selected="selected"<?php }?>><?=$shift_name_result->shift_name?></option>
                                                <?php }}?>
                                            </select>
                                        </div> 
                                            <div class="form-group">
                                            <!-- <a href="<?= base_url(); ?>salon-dashboard" class="btn btn-info">Back</a> -->
                                             </div>
                                        </div>

                                        <div class="attendence_inner" style="margin-top: 30px;">
                                            <ul class="list_heading">
                                                <li class="list_staff_name">STAFF NAME</li>
                                                <li class="list_action">ACTION</li>
                                            </ul>
                                            <div class="container">
                                                <ul id="staff_name_list" style="text-align:center;" class="staff_name_list">
                                                    <b>Please select shift</b>
                                                </ul>
                                            </div>    
                                        </div>
                                        <div class="row ff-tt" style="display: none">

                                        </div>
                                        <div class="large_screen_bottom_btn">
                                            <div class="submit_attendence">
                                                <button disabled class="btn btn-primary" id="submit_attendence" name="submit_attendence" value="submit attendence">Submit</button>
                                             </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div> 
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
		$(".alert").fadeTo(5000, 500).slideUp(500, function(){
			$(".alert").slideUp(500);
		});
</script>


<script>
		$("#attendance_date").datepicker({
			dateFormat:"dd-mm-yy",
			changeMonth:true,
			changeYear:true,
			maxDate:0,
			maxDate: "0",
			minDate: "-80Y",
			 
		});
		
		
		$(document).ready(function() {
			$("#attensence_form").validate({
                ignore: [],
                rules: {
                    attendance_date: "required",
                    shift_name: "required",
                    'staff_id_array[]': 'required',
                },
                messages: {
                    attendance_date: "Please select attendance date!",
                    shift_name: "Please select shift!",
                    'staff_id_array[]': "Atleast one employee required!",
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.input_error').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
		}); 
</script>


<script>
   $(".get_attendance").change(function () {
    if($("#shift_name").val() != "" && $("#attendance_date").val()){
        $("#staff_name_list").empty();
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>salon/Ajax_controller/get_emp_by_shift_name_ajx",
            data: { 'shift_name': $("#shift_name").val(),'date': $("#attendance_date").val() },
            success: function (employees) {
                var parsedData = JSON.parse(employees);
                console.log(parsedData);
                var staff_array = [];
                if (parsedData.length > 0) {
                    $('#submit_attendence').attr('disabled', false);
                    $("#staff_name_list").css('text-align','left');
                    $(".list_staff_name, .list_action").show();
                    var today_data = <?php echo json_encode($today_attendance)?>;                    
                    parsedData.forEach(function(record) {
                        if (record) {
                            if(record.attendence_type == '1'){
                                var present_selected = 'checked';
                                var absent_selected = '';
                                var half_day_selected = '';
                            }else if(record.attendence_type == '2'){
                                var present_selected = '';
                                var absent_selected = 'checked';
                                var half_day_selected = '';
                            }else if(record.attendence_type == '3'){
                                var present_selected = '';
                                var absent_selected = '';
                                var half_day_selected = 'checked';
                            }else{
                                var present_selected = '';
                                var absent_selected = '';
                                var half_day_selected = '';
                            }
                            if(record.is_salary_generated == '0'){
                                staff_array.push(record.id);
                                $("#staff_name_list").append('<div class=""row"><div class="col-md-6"><li class="staff_name_list"><b id="staff_name_' + record.id + '">' + record.full_name + '</b>\
                                    <input type="hidden" name="staff_id_' + record.id + '" class="staff_id" value="' + record.id + '"></li>\
                                    </div>\
                                    <div class="col-md-6">\
                                    <li class="action_button_list">\
                                        <button type="button" class="btn_choose_sent bg_btn_chose_1">\
                                            <input type="radio" name="attendence_' + record.id + '" value="1" ' + present_selected + '>Present\
                                        </button>\
                                        <button type="button" class="btn_choose_sent bg_btn_chose_2">\
                                            <input type="radio" name="attendence_' + record.id + '" value="2" ' + absent_selected + '>Absent\
                                        </button>\
                                        <button type="button" class="btn_choose_sent bg_btn_chose_3">\
                                            <input type="radio" name="attendence_' + record.id + '" value="3" ' + half_day_selected + '>Half Day\
                                        </button>\
                                    </li></div></div>');
                            }else{
                                $("#staff_name_list").append('<div class=""row"><div class="col-md-6"><li class="staff_name_list"><b id="staff_name_' + record.id + '">' + record.full_name + '</b>\
                                    <input type="hidden" name="staff_id_' + record.id + '" class="staff_id" value="' + record.id + '"></li>\
                                    </div>\
                                    <div class="col-md-6">\
                                    <li class="action_button_list">\
                                        Salary Generated\
                                    </li></div></div>');
                            }
                        } else {
                            $("#staff_name_list").html('<b>Staff not found</b>'); 
                        }
                        $(".ff-tt").html('<input type="text" name="staff_id" id="staff_id" value="'+ record.id +'">'); 
                    });                    
                } else {
                    $("#staff_name_list").html('<b>Staff not found</b>').css('text-align','center'); 
                    $('#submit_attendence').attr('disabled',true);
                }
                $(".ff-tt").html('<input type="text" name="staff_id_array[]" id="staff_id" value="'+ staff_array +'">');
            }
        });
    }
});
</script>

<script>
    $(document).ready(function() {
        $('#back-office .child_menu').show();
        $('#back-office').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.employee-setup').addClass('active_cc');
    });
</script>