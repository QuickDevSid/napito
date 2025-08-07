<?php include('header.php'); ?>
<style type="text/css">
    .error {}

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

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">

                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">


            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                    <div class="x_content">
                        <div class="container">

                            <form name="attensence_form" id="attensence_form" method="post">
                                <div class="container animated fadeInRight">
                                    <div class="">

                                        <div class="row top-section">
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                           <label class="">Attendance Date <b class="require">*</b></label>
                                           <input type="text" readonly name="attendance_date" id="attendance_date" placeholder="DD-MM-YYYY" class="form-control" value="<?= date('d-m-Y'); ?>">
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label>Select Shift <b class="require">*</b></label>
                                            <select class="form-select form-control" name="shift_name" id="shift_name">
                                                <option value="" class="">Select</option>
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
                                                    <ul>
                                                        <li class="list_staff_name">
                                                            <input type="hidden" name="staff_id[]" id="staff_id<?= $employee_result->id; ?>" value="<?= $employee_result->id; ?>">
                                                        </li>
                                                        <li class="list_action">
                                                            <button type="button" class="btn_choose_sent bg_btn_chose_1">
                                                                <input type="radio" name="attendence_<?= $employee_result->id; ?>"
                                                                    value="1" <?php if (!empty($today_attendance) && $today_attendance->attendence_type == '1') { ?>checked<?php } ?> />Present
                                                            </button>
                                                            <button type="button" class="btn_choose_sent bg_btn_chose_2">
                                                                <input type="radio" name="attendence_<?= $employee_result->id; ?>"
                                                                    value="2" <?php if (!empty($today_attendance) && $today_attendance->attendence_type == '2') { ?>checked<?php } ?> />Absent
                                                            </button>
                                                            <button type="button" class="btn_choose_sent bg_btn_chose_3">
                                                                <input type="radio" name="attendence_<?= $employee_result->id; ?>"
                                                                    value="3" <?php if (!empty($today_attendance) && $today_attendance->attendence_type == '3') { ?>checked<?php } ?> />Half Day
                                                            </button>
                                                        </li>
                                                    </ul>
                                               
                                                <ul>
                                                    <li class="list_staff_name" style="width:100%; text-align:center;">
                                                        No staff found...
                                                    </li>
                                                </ul>
                                           
                                        </div>
                                        <div class="large_screen_bottom_btn">
                                            <?php if (!empty($employee)) { ?>
                                                <div class="submit_attendence">
                                                    <button class="btn btn-success" name="submit_attendence"
                                                        value="submit attendence">Submit</button>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="mobile_bottom_btn">
                                    <div class="submit_attendence">
                                        <button class="btn btn-success" name="submit_attendence"
                                            value="submit attendence">Submit</button>
                                    </div>
                                    <div class="back-btn two hidden-lg">
                                        <a href="<?= base_url(); ?>dashboard_index" class="btn btn-info">Back</a>
                                    </div>
                                </div> -->
                            </form>
                            <!------------end of form---->
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
				// ignore: "";
				rules: {
					attendance_date: {
						required: true,
					},
                    shift_name: {
						required: true,
					},
				},
				messages: {
					attendance_date: {
						required: "Please select attendance date.",
					},
                    shift_name: {
						required: "Please select shift .",
					},
				},
				// errorElement: 'span',
				// errorPlacement: function(error, element) {
				// 	error.addClass('invalid-feedback');
				// 	element.closest('.input_error').append(error);
				// },
				// highlight: function(element, errorClass, validClass) {
				// 	$(element).addClass('is-invalid');
				// },
				// unhighlight: function(element, errorClass, validClass) {
				// 	$(element).removeClass('is-invalid');
				// }
			});
		}); 
		$('#attendance_date').change(function(){
			var attendance_date = $('#attendance_date').val();
			$.ajax({
				type: "POST",
				beforeSend: function(){
					$('.ajax_loader').css("visibility", "visible");
				},
				url: "<?=base_url();?>salon/Ajax_controller/get_datewise_emp_attendance_ajx",
				data:{'attendance_date':attendance_date},
				success: function(data){
					$('.attendence_inner').html('');
					$('.attendence_inner').html(data);
				},
				complete: function(){
					setTimeout(function() {
						$('.ajax_loader').css("visibility", "hidden");
					}, 1000);
					
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(textStatus, errorThrown);
				}
			});
		});
	</script>
<script>
$("#shift_name").change(function() {alert();
    $.ajax({
        type: "POST",
        url: "<?= base_url(); ?>salon/Ajax_controller/get_employees_by_shift_id",
        data: {
            'shift_name_id': $('#shift_name').val(),
        },
        success: function(data) {  
            var parsedData = JSON.parse(data);
            console.log(parsedData);

            $("#staff_id").empty();
            $('#staff_id').append('<option value="0">Select staff_id</option>');

            $.each(parsedData, function(index, employee) {
                $('#staff_id').append('<option value="' + employee.id + '">' + employee.full_name + '</option>');
            });
        },
    });
});

</script>


<script>
      $(document).ready(function () {
			$('#employee .child_menu').show();
			$('#employee').addClass('nv active');
			$('.right_col').addClass('active_right');
			$('.cc_add_staff_attendance').addClass('active_cc');
		});
</script>