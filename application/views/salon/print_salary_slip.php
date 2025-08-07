<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Print Salary Slip</title>
	<link href="<?=base_url('assets/admin/css/bootstrap.min.css');?>" rel="stylesheet">
    <link href="<?=base_url('assets/admin/font-awesome/css/font-awesome.css');?>" rel="stylesheet">
	<style>
		.print_btn_inner{
			position: absolute;
			top: 28px;
			right: 22%;
		}
		.print_btn_inner .btn{
			padding: 6px 30px ;
		}
		.parent_table{
			margin: 90px auto 0px !important;
		}
	</style>
</head>

<body>
	<div class="print_btn_inner">
		<button type="button" id="sudo" onclick="print('.print_div')" class="btn btn-info print_btn">Print</button>
		<a href="<?=base_url();?>generate_salary_slip" style="background:#000;border-color:#000;" class="btn btn-primary print_btn">Back</a>
	</div>
	<div class="print_div">
		<table style="border: 1px solid #000;margin: 30px auto 0px; width:55%" class="parent_table">
			<tr style="border: 1px solid #000;text-align: center;">
				<td colspan="4" style="padding: 10px 15px;">
					<h4 style="font-size: 30px;font-weight: 600;"><?=$single_profile->branch_name?></h4>
					<p style="margin: 0px auto;width: 450px;font-size: 14px;"><?=$single_profile->salon_address?> - <?=$single_profile->pincode?></p>
				</td>
			</tr>
			<tr style="border: 1px solid #000;text-align: center;">
				<?php $month_name = '';
					if(!empty($slip)){
						if($slip->salaried_month == '01'){
							$month_name = 'Jan';
						}else if($slip->salaried_month == '02'){
							$month_name = 'Feb';
						}else if($slip->salaried_month == '03'){
							$month_name = 'Mar';
						}else if($slip->salaried_month == '04'){
							$month_name = 'Apr';
						}else if($slip->salaried_month == '05'){
							$month_name = 'May';
						}else if($slip->salaried_month == '06'){
							$month_name = 'Jun';
						}else if($slip->salaried_month == '07'){
							$month_name = 'Jul';
						}else if($slip->salaried_month == '08'){
							$month_name = 'Aug';
						}else if($slip->salaried_month == '09'){
							$month_name = 'Sept';
						}else if($slip->salaried_month == '10'){
							$month_name = 'Oct';
						}else if($slip->salaried_month == '11'){
							$month_name = 'Nov';
						}else if($slip->salaried_month == '12'){
							$month_name = 'Dec';
						}
					}	
					
					$total_payble_days = 0;
					$leave_deduct_amt = 0;
					if(!empty($slip)){ 
						$full_days = $slip->present_days;
						$half_days = $slip->half_days;
						$half_day_converted = $half_days*0.5;
						$total_payble_days = $full_days+$half_day_converted;						
						
						$loan_deduction_amount = $slip->is_loan_deduction == '1' ? $slip->loan_deduction_amount : 0.00;
						$basic_pay = $slip->basic_pay;
						$per_day_amt = $slip->basic_pay/$slip->total_months_days;
						$total_full_days_amt = $per_day_amt*$full_days;
						$total_half_days_amt = ($per_day_amt/2)*$half_days;
						$paid_amt = $total_full_days_amt + $total_half_days_amt - $loan_deduction_amount;
						$leave_deduct_amt = $basic_pay - $paid_amt;
					}					
				?>
				<td colspan="4" style="padding: 6px;">
					<p style="font-size: 16px;font-weight: 600;margin-bottom: 0px;">Pay Slip <?php if(!empty($slip)){ echo $month_name . '-' . $slip->salaried_year;}?></p>
				</td>
			</tr>
			<tr style="border: 1px solid #000;text-align: center;">
				<td colspan="4" style="padding: 6px;">
					<p style="font-size: 14px;font-weight: 600;margin-bottom: 0px;">All amount in INR </p>
				</td>
			</tr>
			<tr style="border: 1px solid #000;">
				<td colspan="2" style="vertical-align: baseline;border: 1px solid #000; padding: 5px 10px;">
					<table style="width:100%">
						<tr>
							<th style="width: 35%;">Name </th>
							<td style="width: 15%; text-align:center;">:</td>
							<td style="width: 50%;"><?php if(!empty($slip)){ echo $slip->full_name;}?></td>
						</tr>
						<tr>
							<th style="width: 35%;">DOB</th>
							<td style="width: 15%; text-align:center;">:</td>
							<td style="width: 50%;"><?php if(!empty($slip) && $slip->dob != "" && $slip->dob != null && $slip->dob != "1970-01-01"){ echo date("d/m/Y",strtotime($slip->dob));}?></td>
						</tr>
						<tr>
							<th style="width: 35%;">Paid Date</th>
							<td style="width: 15%; text-align:center;">:</td>
							<td style="width: 50%;"><?=date('d/m/Y',strtotime($slip->payed_date));?></td>
						</tr>
					</table>
				</td>
				<td colspan="2" style="vertical-align: baseline;border: 1px solid #000; padding: 5px 10px;">
					<table style="width:100%">
						<tr>
							<th style="width: 35%;">Bank Name</th>
							<td style="width: 15%; text-align:center;">:</td>
							<td style="width: 50%;"><?php if(!empty($slip)){ echo $slip->bank_name;}?></td>
						</tr>
						<tr>
							<th style="width: 35%;">IFSC Code</th>
							<td style="width: 15%; text-align:center;">:</td>
							<td style="width: 50%;"><?php if(!empty($slip)){ echo $slip->ifsc;}?></td>
						</tr>
						<tr>
							<th style="width: 35%;">Bank A/c No.</th>
							<td style="width: 15%; text-align:center;">:</td>
							<td style="width: 50%;"><?php if(!empty($slip)){ echo $slip->account_number;}?></td>
						</tr>
						<tr>
							<th style="width: 35%;">Payble Days</th>
							<td style="width: 15%; text-align:center;">:</td>
							<td style="width: 50%;"><?php echo $total_payble_days;?> (Full Days: <?php if(!empty($slip)){ echo $slip->present_days;}else{ echo '0'; }?>, Half Days: <?php if(!empty($slip)){ echo $slip->half_days;}else{ echo '0'; }?>)</td>
						</tr>
						<tr>
							<th style="width: 35%;">Unpaid Days</th>
							<td style="width: 15%; text-align:center;">:</td>
							<td style="width: 50%;"><?php if(!empty($slip)){ echo $slip->absent_days + $slip->leave_days;}?>  (Absent: <?php if(!empty($slip)){ echo $slip->absent_days;}else{ echo '0'; }?>, Leave: <?php if(!empty($slip)){ echo $slip->leave_days;}else{ echo '0'; }?>)</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<!-- <td colspan="2" style="text-align: center;border: 1px solid #000;padding: 3px 10px;font-weight: 700;">Earnings</td>
				<td colspan="2" style="text-align: center;border: 1px solid #000;padding: 3px 10px;font-weight: 700;">Deductions</td> -->
				<td colspan="4" style="text-align: center;border: 1px solid #000;padding: 3px 10px;font-weight: 700;">Salary Amount Details</td>
			</tr>
			<tr>
				<td colspan="4" style="border: 1px solid #000;">
					<table style="width: 100%;">
						<thead>
							<tr style="border-bottom: 1px solid #000;">
								<th style="padding: 0px 10px;">Description</th>
								<th style="padding: 0px 10px;text-align: right;">Amount</th>
							</tr>
						</thead>
						<tbody style="border-bottom: 1px solid #000;">
							<tr>
								<td style="padding: 0px 10px;">Salary</td>
								<td style="padding: 0px 10px;text-align: right;">₹<?php if(!empty($slip)){ echo number_format(floatval($slip->basic_pay),2);}?></td>
							</tr>
							<tr>
								<td style="padding: 0px 10px;">Incentive </td>
								<td style="padding: 0px 10px;text-align: right;"> ₹<?php if(!empty($slip)){ echo number_format(floatval($slip->paid_incentive),2);}?> </td>
							</tr>
							<tr>
								<td style="padding: 0px 10px;">Leave Deduction </td>
								<td style="padding: 0px 10px;text-align: right;">- ₹<?php echo number_format(floatval($leave_deduct_amt),2);?> </td>
							</tr>
							<?php if(!empty($slip) && $slip->is_loan_deduction == '1' && $slip->loan_deduction_amount != '0'){?>
								<tr>
									<td style="padding: 0px 10px;">Loan Amount</td>
									<td style="padding: 0px 10px;text-align: right;">- ₹<?php echo number_format(floatval($slip->loan_deduction_amount),2);?></td>
								</tr>
							<?php }else{?>
							<?php }?>
						</tbody>
						<tfoot>
							<tr>
								<td style="padding: 0px 10px;font-weight: 700;">Total Paid Amount</td>
								<td style="padding: 0px 10px;text-align: right;font-weight: 700;">₹<?php if(!empty($slip)){ echo number_format(floatval($slip->paid_amt),2);}?></td>
							</tr>
						</tfoot>
					</table>
				</td>
				<!-- <td colspan="2" style="border: 1px solid #000;">
					<table style="width: 100%;">
						<thead>
							<tr style="border-bottom: 1px solid #000;">
								<th style="padding: 0px 10px;">Description</th>
								<th style="padding: 0px 10px;text-align: right;">Amount</th>
							</tr>
						</thead>
						<tbody style="border-bottom: 1px solid #000;">
							<tr>
								<td style="padding: 0px 10px;">Salary</td>
								<td style="padding: 0px 10px;text-align: right;">₹<?php if(!empty($slip)){ echo number_format($slip->basic_pay,2);}?></td>
							</tr>
							<tr>
								<td style="padding: 0px 10px;">&nbsp </td>
								<td style="padding: 0px 10px;">&nbsp </td>
							</tr>
							<tr>
								<td style="padding: 0px 10px;">&nbsp </td>
								<td style="padding: 0px 10px;">&nbsp </td>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<td style="padding: 0px 10px;font-weight: 700;">Gross Earnings</td>
								<td style="padding: 0px 10px;text-align: right;font-weight: 700;">₹<?php if(!empty($slip)){ echo number_format($slip->paid_amt,2);}?></td>
							</tr>
						</tfoot>
					</table>
				</td>
				<td colspan="2" style="border: 1px solid #000;">
					<table style="width: 100%;">
						<thead>
							<tr style="border-bottom: 1px solid #000;">
								<th style="padding: 0px 10px;">Description</th>
								<th style="padding: 0px 10px;text-align: right;">Amount</th>
							</tr>
						</thead>
						<tbody style="border-bottom: 1px solid #000;">
							<tr>
								<td style="padding: 0px 10px;">Leave</td>
								<td style="padding: 0px 10px;text-align: right;">₹<?php echo number_format($leave_deduct_amt,2);?></td>
							</tr>
							<?php if(!empty($slip) && $slip->loan_deduction_amount != '0'){?>
								<tr>
									<td style="padding: 0px 10px;">Loan Amount</td>
									<td style="padding: 0px 10px;text-align: right;">₹<?php echo number_format($slip->loan_deduction_amount,2);?></td>
								</tr>
							<?php }else{?>
								<tr>
									<td style="padding: 0px 10px;">&nbsp </td>
									<td style="padding: 0px 10px;">&nbsp </td>
								</tr>
							<?php }?>
							<tr>
								<td style="padding: 0px 10px;">&nbsp </td>
								<td style="padding: 0px 10px;">&nbsp </td>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<td style="padding: 0px 10px;font-weight: 700;">Gross Deductions</td>
								<td style="padding: 0px 10px;text-align: right;font-weight: 700;">₹<?php if(!empty($slip)){ echo number_format($slip->basic_pay-$slip->paid_amt,2);}?></td>
							</tr>
						</tfoot>
					</table>
				</td> -->
			</tr>
			<!--<tr>
				<td colspan="4" style="font-weight: 700;padding: 5px 10px;">
					Net Pay: ₹<?php if(!empty($slip)){ echo number_format($slip->paid_amt,2);}?>/-
				</td>
			</tr>-->
			<tr>
				<td colspan="4" style="font-weight: 700;padding: 5px 10px;"></td>
			</tr>
			<tr>
				<td colspan="4" style="font-weight: 700;padding: 5px 10px;"></td>
			</tr>
			<tr>
				<td colspan="4" style="font-weight: 700;padding: 5px 10px;"></td>
			</tr>
			<tr>
				<td colspan="4" style="font-weight: 700;padding: 5px 10px;"></td>
			</tr>
			<tr>
				<td colspan="4" style="font-weight: 700;padding: 5px 10px;"></td>
			</tr>
			<tr>
				<td colspan="4" style="font-weight: 700;padding: 5px 15px;text-align:right;">Signature</td>
			</tr>
		</table>
	</div>
	<script src="<?=base_url('assets/js/jquery-3.3.1.js');?>"></script>
	<script>
		function print(elem){
			 Popup($(elem).html());
		}
		function Popup(data) {
			console.log(data);
			var mywindow = window.open('', 'my div');
			mywindow.document.write('<!DOCTYPE html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Print Salary Slip</title><link href="<?=base_url();?>assets/admin/css/bootstrap.min.css" rel="stylesheet"><link href="<?=base_url();?>assets/admin/font-awesome/css/font-awesome.css" rel="stylesheet"><style> @media print {.parent_table{width:85% !important;}}</style></head><body>');
			mywindow.document.write(data);
			mywindow.document.write('</body></html>');
			mywindow.document.close();
			mywindow.print();                      
		}
	</script>
</body>
</html>