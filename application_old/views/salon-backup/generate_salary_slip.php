<?php include('header.php'); ?>
<style type="text/css">
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
					Add Salary Slip
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
							<form name="add_salary" id="add_salary" autocomplete="off" method="POST"
								enctype="multipart/form-data">
								<!-- <div class="row"> -->
									<div class="form-group col-md-6 col-sm-6 col-xs-12">
										<label for="student_name">Staff Name <b class="require">*</b> </label>
										<select id="staff" name="staff" class="form-control info_input">
											<option value="">Please Select Staff</option>
											<?php if (!empty($employee)) {
												foreach ($employee as $employee_result) { ?>
													<option value="<?= $employee_result->id; ?>"><?= $employee_result->full_name; ?>
													</option>
												<?php }
											} ?>
										</select>
									</div>
									<div class="form-group col-md-6 col-sm-6 col-xs-12">
										<label>From Date<b class="require">*</b></label>
										<input type="text" readonly name="from_date" id="from_date"
											placeholder="DD-MM-YYYY" class="form-control info_input paid_date">
									</div>
									<div class="form-group col-md-6 col-sm-6 col-xs-12">
										<label>To Date<b class="require">*</b></label>
										<input type="text" readonly name="to_date" id="to_date" placeholder="DD-MM-YYYY"
											class="form-control info_input paid_date">
									</div>
									<div class="form-group col-md-6 col-sm-6 col-xs-12">
										<label>Total Full Days<b class="require">*</b></label>
										<input type="text" readonly name="present_days" id="present_days"
											class="form-control" placeholder="Present Days">
									</div>
									<div class="form-group col-md-6 col-sm-6 col-xs-12">
										<label>Total Half Days<b class="require">*</b></label>
										<input type="text" readonly name="half_days" id="half_days" class="form-control"
											placeholder="Half Days">
									</div>
									<div class="form-group col-md-6 col-sm-6 col-xs-12">
										<label>Total Absent Days<b class="require">*</b></label>
										<input type="text" readonly name="absent_days" id="absent_days"
											class="form-control" placeholder="Absent Days">
									</div>
									<div class="form-group col-md-6 col-sm-6 col-xs-12">
										<label>Paid Date<b class="require">*</b></label>
										<input type="text" readonly name="payed_date" id="payed_date"
											class="form-control paid_date" placeholder="DD-MM-YYYY">
									</div>
									<div class="form-group col-md-6 col-sm-6 col-xs-12">
										<label>Remark</label>
										<input type="text" name="remark" id="remark" class="form-control"
											placeholder="Remark">
									</div>
									<!-- <div class="row loan_deduction" style="display:none;">
										<div class="form-group col-md-6 col-sm-6 col-xs-12">
											<label>Loan Amount</label>
											<input type="text" readonly name="loan_amount" id="loan_amount"
												class="form-control" placeholder="Loan Amount" value="">
										</div>
										<div class="form-group col-md-6 col-sm-6 col-xs-12">
											<label>Loan Deduct From Salary<b class="require">*</b></label>
											<select name="loan_deduct" id="loan_deduct" class="form-control">
												<option value="">Please Select Yes or No</option>
												<option value="Yes">Yes</option>
												<option value="No">No</option>
											</select>
										</div>
										<div class="form-group col-md-6 col-sm-6 col-xs-12 deduct_amt_input" style="display:none;">
											<label>Deduct Amount</label>
											<input type="text" name="deduct_amt" id="deduct_amt" class="form-control"
												placeholder="Deduct Amount" value="">
										</div>
									</div> -->
									<div class="row">
										<div class="form-group col-md-6 col-sm-6 col-xs-12">
											<button style="margin-top: 20px;" class="form_submit btn btn-success">Submit </button>
										</div>
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
<?php include('footer.php');
$id = 0;
if ($this->uri->segment(2) != "") {
	$id = $this->uri->segment(2);
}
?>


<!-- <script src="<?= base_url('assets/js/jquery-3.3.1.js'); ?>"></script>
<script src="<?= base_url('assets/js/jquery.validate.min.js'); ?>"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script> -->
<script type="text/javascript">
	$(".paid_date").datepicker({
		dateFormat: "dd-mm-yy",
		changeMonth: true,
		changeYear: true,
		maxDate: 0,
		maxDate: "0",
		minDate: "-80Y",
		yearRange: "-100:+0"
	});
	$(document).ready(function () {
		$('#add_salary').validate({
			ignore: "",
			rules: {
				staff:'required',
				from_date:'required',
				to_date:'required',
				present_days:'required',
				absent_days:'required',
				payed_date:'required',
				deduct_amt:'number',
				loan_deduct:'required',
			},
			messages: {
				staff: "Please select staff.",
				from_date: "Please select from date.",
				to_date: "Please select to date.",
				present_days: "Please enter present year.",
				absent_days: "Please enter absent year.",
				payed_date: "Please select payed date.",
				deduct_amt: "Please enter deduct amount.",
				loan_deduct: "Please select yes or no.",
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


	$('.info_input').change(function () {
		$('#present_days').val('');
		$('#basic_pay').val('');
		$('#half_days').val('');
		$('#absent_days').val('');

		var staff_id = $('#staff').val();
		var from_date = $('#from_date').val();
		var to_date = $('#to_date').val();
		var total_month_day = 30;
		if (staff_id != "" && from_date != "" && to_date != "") {
			$.ajax({
				type: "POST",
				url: "<?= base_url(); ?>salon/Ajax_controller/get_already_generated_field_exe_slip_ajx",
				data: { 'staff_id': staff_id, 'from_date': from_date, 'to_date': to_date },
				success: function (data) {
					if (data == 0) {
						$('.salary_error').html('');
						$('#btn_save').attr('disabled', false);
						field_exe_attendance();
					} else {
						$('.salary_error').html('Salary already generated this date.').css('color', 'red');
						$('#btn_save').attr('disabled', true);
					}
				},
				error: function (jqXHR, textStatus, errorThrown) {
					console.log(textStatus, errorThrown);
				}
			});
		}
	});

	function field_exe_attendance() {
		var staff_id = $('#staff').val();
		var from_date = $('#from_date').val();
		var to_date = $('#to_date').val();
		var total_month_day = 30;
		$.ajax({
			type: "POST",
			url: "<?= base_url(); ?>salon/Ajax_controller/get_employee_present_days_ajx",
			data: { 'staff_id': staff_id, 'from_date': from_date, 'to_date': to_date },
			success: function (data) {

				$('#present_days').val(data);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.log(textStatus, errorThrown);
			}
		});
		$.ajax({
			type: "POST",
			url: "<?= base_url(); ?>salon/Ajax_controller/get_employee_half_days_ajx",
			data: { 'staff_id': staff_id, 'from_date': from_date, 'to_date': to_date },
			success: function (data) {
				$('#half_days').val(data);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.log(textStatus, errorThrown);
			}
		});
		$.ajax({
			type: "POST",
			url: "<?= base_url(); ?>salon/Ajax_controller/get_employee_absent_days_ajx",
			data: { 'staff_id': staff_id, 'from_date': from_date, 'to_date': to_date },
			success: function (data) {
				$('#absent_days').val(data);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.log(textStatus, errorThrown);
			}
		});
	}
	$('#staff').change(function () {
		var staff_id = $('#staff').val();
		$.ajax({
			type: "POST",
			url: "<?= base_url(); ?>salon/Ajax_controller/get_employee_total_loan_ajx",
			data: { 'staff_id': staff_id },
			success: function (data) {
				$('#loan_amount').val(data);
				if (data == 0) {
					$('.loan_deduction').hide();
					$("#loan_deduct").val("No").change();
				} else {
					$('.loan_deduction').show();
				}


			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.log(textStatus, errorThrown);
			}
		});
	});
	$('#loan_deduct').change(function () {
		if ($('#loan_deduct').val() == 'Yes') {
			$('.deduct_amt_input').show();
			$('#deduct_amt').attr('required', true);
		} else if ($('#loan_deduct').val() == 'No') {
			$('.deduct_amt_input').hide();
			$('#deduct_amt').attr('required', false);
		}
	});
</script>