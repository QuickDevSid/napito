<?php include('header.php'); ?>
<style type="text/css">
  .loader_div{
    display: none;
    position: fixed;
    width: 100%;
    height: 100% !important;
    background: #00000042;
    z-index: 999;
    left: 0;
    top: 0;
  }

  .loader-new {
    position: fixed;
    top: 50%;
    left: 50%;
    z-index: 9999;
  --d:22px;
  width: 4px;
  height: 4px;
  border-radius: 50%;
  color: #0056d0;
  box-shadow: 
    calc(1*var(--d))      calc(0*var(--d))     0 0,
    calc(0.707*var(--d))  calc(0.707*var(--d)) 0 1px,
    calc(0*var(--d))      calc(1*var(--d))     0 2px,
    calc(-0.707*var(--d)) calc(0.707*var(--d)) 0 3px,
    calc(-1*var(--d))     calc(0*var(--d))     0 4px,
    calc(-0.707*var(--d)) calc(-0.707*var(--d))0 5px,
    calc(0*var(--d))      calc(-1*var(--d))    0 6px;
  animation: l27 1s infinite steps(8);
}
@keyframes l27 {
  100% {transform: rotate(1turn)}
}
	.error {
		color: red;
		float: left;
		/*    position: absolute;*/
	}

	.input-content-option {
		height: 35px;
		width: 600px;
		border-radius: 5px;
		border: solid gray 1px;
	}
</style>
<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>
					Leave Management 
				</h3>
			</div>

		</div>
		<div class="clearfix"></div>
				<div class="x_panel">
					<div class="x_content">
						<div class="container">
							<form name="add_salary" id="add_salary" autocomplete="off" method="POST"
								enctype="multipart/form-data">
								<div class="row">
									<div class="form-group col-md-4 col-sm-6 col-xs-12">
										<label for="student_name">Employee <b class="require">*</b> </label>
										<select id="staff" name="staff" class="form-control info_input paid_date">
											<option value="">Select Employee</option>
											<?php if (!empty($employee)) {
                                                foreach ($employee as $employee_result) { ?>
                                                    <option value="<?= $employee_result->id ?>"><?= $employee_result->full_name?></option>
                                                <?php }
                                            } ?>
										</select>
									</div>
									<div class="form-group col-md-4 col-sm-6 col-xs-12">
										<label>From Date<b class="require">*</b></label>
										<input type="text" readonly name="from_date" id="from_date"
											class="form-control paid_date" placeholder="DD-MM-YYYY" value="">
									</div>
									<div class="form-group col-md-4 col-sm-6 col-xs-12">
										<label>To Date<b class="require">*</b></label>
										<input type="text" readonly name="to_date" id="to_date"
											class="form-control paid_date" placeholder="DD-MM-YYYY" value="">
									</div>
									<div class="form-group col-md-4 col-sm-6 col-xs-12">
										<label>Days</label>
										<input readonly type="text" readonly name="days" id="days"
											class="form-control" placeholder="" value="0">
									</div>
								</div>
								<span id="validate-error" style="display:none;" class="error invalid-feedback"></span>
								<div class="row">
									<div class="form-group col-md-12 col-sm-12 col-xs-12">
										<label>Reason<b class="require">*</b></label>
										<textarea name="reason" id="reason"
											class="form-control" placeholder="Enter Reason"></textarea>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-md-12 col-sm-12 col-xs-12">
										<button disabled style="margin-top: 20px;" id="submit_leave" name="submit_leave" value="submit_leave" class="form_submit btn btn-primary">Submit </button>
									</div>
								</div>
							</form>
						</div> <!----------end of container-------->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="loader_div">
	<div  class="loader-new"></div>
</div>
<?php include('footer.php');?>
<script type="text/javascript">
	$(document).ready(function () {
        var maxDate = '60';
        var minDate = '0';
        
        $("#from_date").datepicker({
            dateFormat: 'dd-mm-yy',
            maxDate: maxDate,
            minDate: minDate,
            onSelect: function (selectedDate) {
                var minDate = $(this).datepicker('getDate');
                $("#to_date").datepicker("option", "minDate", minDate);
				$('.paid_date').change();
            }
        });

		$("#to_date").datepicker({
			dateFormat: 'dd-mm-yy',
			maxDate: maxDate,
			minDate: minDate,
			onSelect: function (selectedDate) {
				var toDate = $(this).datepicker('getDate');
				$("#from_date").datepicker("option", "maxDate", toDate);
				$('.paid_date').change();
			}
		});

        $(".info_input").chosen();
		$('#add_salary').validate({
			ignore: "",
			rules: {
				staff:'required',
				from_date:'required',
				to_date:'required',
				reason:'required',
			},
			messages: {
				staff: "Please select employee!",
				from_date: "Please select from date!",
				to_date: "Please select to date!",
				reason: "Please enter reason!",
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
	$('.paid_date').change(function () {
		var staff_id = $('#staff').val();
		var from_date = $('#from_date').datepicker('getDate');
		var to_date = $('#to_date').datepicker('getDate');
		if (staff_id != "" && from_date && to_date && typeof from_date === 'object' && typeof to_date === 'object') {
			var timeDiff = Math.abs(to_date.getTime() - from_date.getTime());
			var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)) + 1;

			$('#days').val(diffDays);

			validateLeavePeriod(staff_id,from_date,to_date);
		}
	});
	function validateLeavePeriod(staff_id,from_date,to_date){
		var foramted_from_date = $('#from_date').val();
		var foramted_to_date = $('#to_date').val();
		$.ajax({
            type: "POST",
            url: "<?= base_url(); ?>salon/Ajax_controller/valdiate_staff_leave_for_period_ajx",
            data: { 'staff_id': staff_id, 'from_date': foramted_from_date, 'to_date': foramted_to_date },
            success: function (data) {
				if(data == '2'){
					$('#submit_leave').attr('disabled',true);
					$('#validate-error').show();
					$('#validate-error').html('Attendance already marked for one of the date in selected date range');
				}else{
					if(data == '1'){
						$('#submit_leave').attr('disabled',false);
						$('#validate-error').hide();
						$('#validate-error').html('');
					}else{
						$('#submit_leave').attr('disabled',true);
						$('#validate-error').show();
						$('#validate-error').html('Leave already applied for selected dates');
					}
				}
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
	}
</script>
<script>
    $(document).ready(function() {
        $('#attendance .child_menu').show();
        $('#attendance').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.add_weekly_off').addClass('active_cc');
    });
</script>