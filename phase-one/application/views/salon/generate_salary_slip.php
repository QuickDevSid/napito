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
					Add Salary 
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
								<div class="row">
									<div class="form-group col-md-3 col-sm-6 col-xs-12">
										<label for="student_name">Staff Name <b class="require">*</b> </label>
										<select id="staff" name="staff" class="form-control info_input">
											<option value="">Select Staff</option>
											<?php if (!empty($employee)) {
                                                foreach ($employee as $employee_result) { ?>
                                                    <option value="<?= $employee_result->id ?>" <?php if (isset($_GET['staff']) && $_GET['staff'] == $employee_result->id) { ?>selected="selected" <?php } ?>><?= $employee_result->full_name?></option>
                                                <?php }
                                            } ?>
										</select>
									</div>
									<div class="form-group col-md-3 col-sm-6 col-xs-12">
										<label for="student_name">Month <b class="require">*</b> </label>
										<select id="salary_month" name="salary_month" class="form-control info_input">
											<option value="">Select Month</option>
											<?php
												for ($i = 1; $i <= 12; $i++) { 
													$month = date('F', mktime(0, 0, 0, $i, 1));
											?>
												<option value="<?= $i; ?>" <?php if (isset($_GET['month']) && $_GET['month'] == $i) { ?>selected="selected" <?php }else{ if($i == date('m')){ echo 'selected'; }} ?>>
													<?= $month; ?>
												</option>
											<?php 
												} 
											?>
										</select>
									</div>
									<div class="form-group col-md-3 col-sm-6 col-xs-12">
										<label for="salary_year">Year <b class="require">*</b> </label>
										<select id="salary_year" name="salary_year" class="form-control info_input">
											<option value="">Select Year</option>
											<?php 
											$current_year = date('Y');
											for ($i = $current_year; $i >= $current_year - 10; $i--) { 
												?>
												<option value="<?= $i; ?>" <?php if (isset($_GET['year']) && $_GET['year'] == $i) { ?>selected="selected" <?php }else{ if($i == date('Y')){ echo 'selected'; }} ?>>
													<?= $i; ?>
												</option>
												<?php 
											} 
											?>
										</select>
									</div>
									<div class="form-group col-md-3 col-sm-6 col-xs-12">
										<label>Fixed Salary</label>
										<input type="text" readonly name="salary" id="salary"
											class="form-control" placeholder="Enter Fixed Salary">
									</div>
								</div>
								<div class="row">
									<div class="form-group col-md-3 col-sm-6 col-xs-12">
										<label>Total Present Days<b class="require">*</b></label>
										<input type="text" readonly name="present_days" id="present_days"
											class="form-control" placeholder="Present Days" value="<?php if (!empty($single)) { echo $single->present_days; }else{ echo '0'; } ?>">
									</div>
									<div class="form-group col-md-3 col-sm-6 col-xs-12">
										<label>Total Half Days<b class="require">*</b></label>
										<input type="text" readonly name="half_days" id="half_days" class="form-control"
											placeholder="Half Days" value="<?php if (!empty($single)) { echo $single->half_days; }else{ echo '0'; } ?>">
									</div>
									<div class="form-group col-md-3 col-sm-6 col-xs-12">
										<label>Total Leave Days<b class="require">*</b></label>
										<input type="text" readonly name="leave_days" id="leave_days" class="form-control"
											placeholder="Leave Days" value="<?php if (!empty($single)) { echo $single->half_days; }else{ echo '0'; } ?>">
									</div>
									<div class="form-group col-md-3 col-sm-6 col-xs-12">
										<label>Total Absent Days<b class="require">*</b></label>
										<input type="text" readonly name="absent_days" id="absent_days"
											class="form-control" placeholder="Absent Days" value="<?php if (!empty($single)) { echo $single->absent_days; }else{ echo '0'; } ?>">
									</div>
								</div>
								<div class="row">
									<div class="form-group col-md-3 col-sm-6 col-xs-12">
										<label>Product Incentive</label>
										<input type="text" readonly name="product_incentive" id="product_incentive"
											class="form-control" placeholder="Enter Product Incentive">
									</div>
									<div class="form-group col-md-3 col-sm-6 col-xs-12">
										<label>Target Incentive</label>
										<input type="text" readonly name="target_incentive" id="target_incentive"
											class="form-control" placeholder="Enter Target Incentive">
									</div>
									<div class="form-group col-md-3 col-sm-6 col-xs-12">
										<label>Total Incentive</label>
										<input type="text" readonly name="total_incentive" id="total_incentive"
											class="form-control" placeholder="Enter Total Incentive" value="0.00">
									</div>
									<div class="form-group col-md-3 col-sm-6 col-xs-12">
										<label>Previous Pending Incentive</label>
										<input type="text" readonly name="prev_pending_incentive" id="prev_pending_incentive"
											class="form-control" placeholder="Enter Pending Incentive" value="0.00">
									</div>
								</div>
								<div class="row">
									<div class="form-group col-md-3 col-sm-6 col-xs-12">
										<label>Due Incentive</label>
										<input type="text" readonly name="due_incentive" id="due_incentive"
											class="form-control" placeholder="Enter Due Incentive" value="0.00">
									</div>
									<div class="form-group col-md-3 col-sm-6 col-xs-12">
										<label>Paid Incentive</label>
										<input onkeyup="calculatePendingIncentive()" type="text" name="paid_incentive" id="paid_incentive" readonly
											class="form-control" placeholder="Enter Paid Incentive" value="0.00">
									</div>
									<div class="form-group col-md-3 col-sm-6 col-xs-12">
										<label>Pending Incentive</label>
										<input readonly type="text" name="pending_incentive" id="pending_incentive"
											class="form-control" placeholder="Enter Paid Salary" value="0.00">
									</div>
									<div class="form-group col-md-3 col-sm-6 col-xs-12">
										<label>Paid Date<b class="require">*</b></label>
										<input type="text" readonly name="payed_date" id="payed_date"
											class="form-control paid_date" placeholder="DD-MM-YYYY" value="<?php if (!empty($single)) { echo $single->payed_date; } ?>">
									</div>
								</div>
								<input type="hidden" name="is_loan_active" id="is_loan_active" value="0">
								<input type="hidden" name="active_loan_details_ids" id="active_loan_details_ids" value="">
								<div class="row">
									<div class="form-group col-md-3 col-sm-6 col-xs-12 loan_deduction" style="display:none;">
										<label>Active Loan Due Amount</label>
										<input type="text" readonly name="loan_amount" id="loan_amount"
											class="form-control" placeholder="Active Loan Due Amount" value="">
									</div>
									<div class="form-group col-md-3 col-sm-6 col-xs-12 loan_deduction" style="display:none;">
										<label>Loan Deduct Amount<b class="require">*</b></label>
										<input type="text" name="deduct_loan_amt" id="deduct_loan_amt" class="form-control"
											placeholder="Enter Deduct Loan Amount" value="0.00">
									</div>
									<div class="form-group col-md-6 col-sm-6 col-xs-12">
										<label>Remark</label>
										<input type="text" name="remark" id="remark" class="form-control"
											placeholder="Remark" value="<?php if (!empty($single)) { echo $single->remark; } ?>">
									</div>
								</div>
								<label class="error" id="salary_error"></label>
								<div class="row">
									<div class="form-group col-md-12 col-sm-6 col-xs-12">
										<button style="margin-top: 20px;" id="btn_save" class="form_submit btn btn-primary">Submit </button>
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
<?php include('footer.php');
$id = 0;
if ($this->uri->segment(2) != "") {
	$id = $this->uri->segment(2);
}

if(isset($_GET['month']) && $_GET['month'] != ""){
    $month = $_GET['month'];
}else{
    $month = '';
}
if(isset($_GET['year']) && $_GET['year'] != ""){
    $year = $_GET['year'];
}else{
    $year = '2';
}
if(isset($_GET['staff']) && $_GET['staff'] != ""){
    $staff = $_GET['staff'];
}else{
    $staff = '';
}
?>
<script type="text/javascript">
	$(document).ready(function () {
        $("#payed_date").datepicker({
            dateFormat: 'dd-mm-yy',
            maxDate: '<?php echo date('d-m-Y'); ?>',
        }); 
        $(".info_input").chosen();
		$(".info_input").change();
		$('#add_salary').validate({
			ignore: "",
			rules: {
				staff:'required',
				salary_month:'required',
				salary_year:'required',
				payed_date:'required',
				deduct_loan_amt:{
					required: function() {
						return $('#is_loan_active').val() == '1';
					},
					number: true,
					min: 0,
				},
			},
			messages: {
				staff: "Please select staff!",
				salary_month: "Please select month!",
				salary_year: "Please select month!",
				payed_date: "Please select payed date!",
				deduct_loan_amt: {
					required: "Please enter loan deduct amount!",
					number: "Please enter numbers only!",
					min: "Minimum 0 value allowed"
				},
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
		$('#leave_days').val('');

		var staff_id = $('#staff').val();
		var salary_month = $('#salary_month').val();
		var salary_year = $('#salary_year').val();

		var from_date = $('#from_date').val();
		var to_date = $('#to_date').val();
		if (staff_id != "" && salary_month != "" && salary_year != "") {
			$('.loader_div').show();   
			$.ajax({
				type: "POST",
				url: "<?= base_url(); ?>salon/Ajax_controller/get_already_generated_field_exe_slip_ajx",
				data: { 'staff_id': staff_id, 'from_date': from_date, 'to_date': to_date, 'salary_month': salary_month, 'salary_year': salary_year },
				success: function (data) {
					console.log(data)
					if (data == 0) {
						$('#salary_error').hide();
						$('#salary_error').html('');
						$('#btn_save').attr('disabled', false);
						get_emp_salary(); 
					} else {
						$('#salary_error').show();
						$('#salary_error').html('Salary already generated for selected month.').css('color', 'red');
						$('#btn_save').attr('disabled', true);
					}
					$('.loader_div').hide();  
				},
				error: function (jqXHR, textStatus, errorThrown) {
					console.log(textStatus, errorThrown);
				}
			});
		}
	});
	function get_emp_salary(){
		$('.loan_deduction').hide();
		$('#is_loan_active').val('0');
		$('#loan_amount').val('');
		$('#deduct_loan_amt').removeAttr('max');

		var staff_id = $('#staff').val();
		var from_date = $('#from_date').val();
		var to_date = $('#to_date').val();
		var salary_month = $('#salary_month').val();
		var salary_year = $('#salary_year').val();
		if (staff_id != "" && salary_month != "" && salary_year != "") {
			$.ajax({
				type: "POST",
				url: "<?= base_url(); ?>salon/Ajax_controller/get_employee_salary_details_ajx",
				data: { 'staff_id': staff_id, 'from_date': from_date, 'to_date': to_date, 'salary_month': salary_month, 'salary_year': salary_year },
				success: function (data) {
					var salary_data = $.parseJSON(data);

					$('#salary').val(parseFloat(salary_data.salary).toFixed(2));
					$('#product_incentive').val(parseFloat(salary_data.product_incentive).toFixed(2));
					$('#target_incentive').val(parseFloat(salary_data.target_incentive).toFixed(2));

					total_incentive = parseFloat(salary_data.product_incentive) + parseFloat(salary_data.target_incentive);				
					$('#total_incentive').val(parseFloat(total_incentive).toFixed(2));

					$('#prev_pending_incentive').val(parseFloat(salary_data.prev_pending_incentive).toFixed(2));

					due_incentive = total_incentive + parseFloat(salary_data.prev_pending_incentive);
					
					$('#due_incentive').val(parseFloat(due_incentive).toFixed(2));

					$('#paid_incentive').val(parseFloat(due_incentive).toFixed(2)).attr('max',due_incentive);
					if(due_incentive == 0.00){
						$('#paid_incentive').attr('readonly',true);
					}else{
						$('#paid_incentive').attr('readonly',false);
					}
					
					var is_loan_active = salary_data.is_loan_active;
					var active_loan_details_ids = salary_data.active_loan_details_ids;
					var active_loan = salary_data.active_loan;
					$('#is_loan_active').val(is_loan_active);
					$('#active_loan_details_ids').val(active_loan_details_ids);

					if(is_loan_active == '1'){
						$('.loan_deduction').show();
						$('#loan_amount').val(parseFloat(active_loan).toFixed(2));
						$('#deduct_loan_amt').attr('max',parseFloat(active_loan).toFixed(2));
					}else{
						$('.loan_deduction').hide();
						$('#loan_amount').val('');
						$('#deduct_loan_amt').removeAttr('max');
					}

					calculatePendingIncentive();
					field_exe_attendance();
				},
				error: function (jqXHR, textStatus, errorThrown) {
					console.log(textStatus, errorThrown);
				}
			});
		}
	}
	function field_exe_attendance() {
		var staff_id = $('#staff').val();
		var from_date = $('#from_date').val();
		var to_date = $('#to_date').val();
		var salary_month = $('#salary_month').val();
		var salary_year = $('#salary_year').val();
		if (staff_id != "" && salary_month != "" && salary_year != "") {
			$.ajax({
				type: "POST",
				url: "<?= base_url(); ?>salon/Ajax_controller/get_employee_present_days_ajx",
				data: { 'staff_id': staff_id, 'from_date': from_date, 'to_date': to_date, 'salary_month': salary_month, 'salary_year': salary_year },
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
				data: { 'staff_id': staff_id, 'from_date': from_date, 'to_date': to_date, 'salary_month': salary_month, 'salary_year': salary_year },
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
				data: { 'staff_id': staff_id, 'from_date': from_date, 'to_date': to_date, 'salary_month': salary_month, 'salary_year': salary_year },
				success: function (data) {
					$('#absent_days').val(data);
				},
				error: function (jqXHR, textStatus, errorThrown) {
					console.log(textStatus, errorThrown);
				}
			});
			$.ajax({
				type: "POST",
				url: "<?= base_url(); ?>salon/Ajax_controller/get_employee_leave_days_ajx",
				data: { 'staff_id': staff_id, 'from_date': from_date, 'to_date': to_date, 'salary_month': salary_month, 'salary_year': salary_year },
				success: function (data) {
					$('#leave_days').val(data);
				},
				error: function (jqXHR, textStatus, errorThrown) {
					console.log(textStatus, errorThrown);
				}
			});
		}
	}
	function calculatePendingIncentive(){
		var due_incentive = $('#due_incentive').val();
		var paid_incentive = $('#paid_incentive').val();
		var pending_incentive = due_incentive - paid_incentive;

		$('#pending_incentive').val(parseFloat(pending_incentive).toFixed(2));
	}
</script>

<script>
    $(document).ready(function() {
        $('#back-office .child_menu').show();
        $('#back-office').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.cc_generate_salary_slip').addClass('active_cc');
    });
</script>