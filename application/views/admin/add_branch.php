<?php include('header.php'); ?>
<style type="text/css">
    .type-title {
        margin-left: 20px;
        color: red;
    }



    .section-title {
        color: black;
        font-weight: bold;
    }

    .error {
        font-weight: bold;
    }

    .chosen-container a {
        background-color: white !important;
        height: 34px !important;
    }

    input[type="file"] {
        height: 50px;
    }

	#state_chosen{
		width: 100% !important;
	}
	#subscription_chosen{
		width: 100% !important;
	}
	#city_name_chosen{
		width: 100% !important;
	}
	#referred_by_chosen{
		width: 100% !important;
	}
	.chosen-container-single{
		width: 100% !important;
	}
	.chosen-container-multi{
		width: 100% !important;
	}
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                     Branch Setup for <?php if(!empty($salon_name)){ echo $salon_name->salon_name;}?>
                </h3>
            </div>

            <div class="tabs" id="exTab2">
				<ul class="nav nav-tabs message-tab">
				<?php if(!empty($salon_name) && $salon_name->is_branch_available == '1'){ ?>
                    <li class="<?php if($this->uri->segment(3) != ""){ echo 'active';} ?>" id="tab_1">
                        <a href="#1" data-toggle="tab"><?php if($this->uri->segment(3) != ""){ echo 'Update'; }else{ echo 'Add'; } ?> Branch</a>
                    </li>
				<?php } ?>
					 <li class="<?php if($this->uri->segment(3) != ""){ echo '';}else{ echo 'active'; } ?>" id="tab_2">
                        <a href="#2" data-toggle="tab">Branch List</a>
                    </li> 
                </ul><br>
            </div>
            <div class="tab-content">
        </div>
        <div class="clearfix"></div> 
       <div class="tab-content"> 
			<div class="tab-pane <?php if($this->uri->segment(3) != ""){ echo 'active';} ?>" id="1">
				<div class="x_panel">
					<div class="x_content">
						<div class="container">
							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12">
									<form method="post" name="branch_form" id="branch_form" enctype="multipart/form-data">
										<input type="hidden" name="is_payment_gateway" id="is_payment_gateway" value="<?=!empty($salon_name) && $salon_name->is_payment_gateway == '1' ? '1' : '0'; ?>">
										<div class="row">  
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="form-group">
													<hr>
													<h3 style="color: black; font-weight: bold;">Branch Details</h3>
													<p>Please provide branch details.</p>
													<hr>
												</div>
											</div>
										</div>
										<div class="form-section" style="border:1px solid #ccc; border-radius:10px; padding:15px;">
											<div class="row">
												<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
													<div class="form-group">
														<label>Branch Name <b class="require">*</b></label>
														<input autocomplete="off" type="text" class="form-control branch_name" name="branch_name_0" id="branch_name_0" value="" placeholder="Enter branch name">
														<input type="hidden" name="salon_id_0" id="salon_id_0" value="<?php echo $this->uri->segment(2); ?>">
														<input type="hidden" name="indices[]" id="indices_0" value="0">
													</div>
												</div>
												<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
													<div class="form-group">
														<label>Salon Mobile<b class="require">*</b></label>
														<input maxlength="10" autocomplete="off" type="text" class="form-control salon_number" name="salon_number_0" id="salon_number_0" value="" placeholder="Enter salon number">
													</div>
												</div>
												<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
													<div class="form-group">
														<label>Email <b class="require">*</b></label>
														<input autocomplete="off" type="text" class="form-control email" name="email_0" id="email_0" value="" placeholder="Enter salon email" onInput="checkUniqueEmail(0)">
														<label id="email_error_label_0" style="display:none;" class="email_error_label error invalid-feedback">Please select category</label>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
													<div class="form-group">
														<label>Password <b class="require">*</b></label>
														<input autocomplete="off" type="text" class="form-control password" name="password_0" id="password_0" value="" placeholder="Enter salon password">
													</div>
												</div>
												<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
													<div class="form-group">
														<label>Salon Address <b class="require">*</b></label>
														<input autocomplete="off" type="text" class="form-control salon_address" name="salon_address_0" id="salon_address_0" value="" placeholder="Enter address">
													</div>
												</div>
												<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
													<div class="form-group">
														<label>State<b class="require">*</b></label>
														<select class="form-control form-select state chosen-select" data-index="0" name="state_0" id="state_0" onchange="fetchCities(0)">
															<option value="" class="">Select State</option>
															<?php if (!empty($state)) {
																foreach ($state as $state_result) { ?>
																	<option value="<?= $state_result->id ?>">
																		<?= $state_result->name ?>
																	</option>
															<?php }
															} ?>
														</select>
													</div> 
												</div>
											</div>
											<div class="row">
												<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
													<div class="form-group">
														<label>Select City<b class="require">*</b></label>
														<div>
															<select class="form-control form-select city_name chosen-select" data-index="0" name="city_0" id="city_name_0">
																<option value="">Select City</option>
																<?php if (!empty($city)) {
																	foreach ($city as $city_result) { ?>
																		<option value="<?= $city_result->id ?>">
																			<?= $city_result->name ?>
																		</option>
																<?php }
																} ?>
															</select>
														</div>
													</div>
												</div>
												<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
													<div class="form-group">
														<label>Pin Code</label>
														<input autocomplete="off" type="text" class="form-control pincode" data-index="0" name="pincode_0" id="pincode_0" value="" placeholder="Enter pincode">
													</div>
												</div>
												<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
													<div class="form-group">
														<label>Upload Shopact <b class="require">*</b></label>
														<input autocomplete="off" type="file" class="form-control shopact" name="shopact_0" id="shopact_0">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"> 
													<div class="form-group">
														<label>Salon Category<b class="require">*</b></label><br> 
														<input autocomplete="off" type="radio" id="male_0" class="category selected_category" name="category_0" value="0">
														<label for="male">Male</label>&nbsp&nbsp 
														<input autocomplete="off" type="radio" id="female_0" class="category selected_category" name="category_0" value="1">
														<label for="female">Female</label>&nbsp&nbsp 
														<input autocomplete="off" type="radio" id="unisex_0" class="category selected_category" name="category_0" value="2">
														<label for="unisex">Unisex</label> 
													</div>
													<span id="category_0-error" style="display:none;" class="error invalid-feedback">Please select category</span>
												</div>
												<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
													<div class="form-group">
														<label>Subscription<b class="require">*</b></label>
														<select class="form-select chosen-select form-control subscription" name="subscription_0" id="subscription_0">
															<option value="">Select Subscription</option>
														</select>
													</div>
												</div>
												<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
													<div class="form-group">
														<label>Referred By</label>
														<select class="form-select chosen-select form-control referred_by" name="referred_by_0" id="referred_by_0">
															<option value="">Select Referred By Branch</option>
															<?php if(!empty($branches)){ foreach($branches as $branches_result){ ?>
																<option value="<?=$branches_result->id;?>"><?=$branches_result->branch_name;?>, <?=$branches_result->salon_name;?></option>
															<?php }} ?>
														</select>
													</div>
												</div>
											</div>
											<div class="row">  
												<div class="col-md-4">
													<div class="form-group">
														<label>Payment Option<b class="require">*</b></label><br> 
														<select class="form-control form-select chosen-select payment_options" name="payment_options_0[]" id="payment_options_0" multiple>
															<option value="UPI">UPI</option>
															<!-- <option value="Net Banking">Net Banking</option> -->
															<option value="Cash">Cash</option>
															<option value="Card">Card</option>
															<option value="Cheque">Cheque</option>
														</select>
														<label id="payment_options_0-error" style="display:block;" class="error" for="payment_options_0"></label>
													</div>
												</div>
											</div>
											<div class="row">  
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
													<div class="form-group">
														<hr>
														<h3 style="color: black; font-weight: bold;">Bank Details</h3>
														<p>Please provide branch account details.</p>
														<hr>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label>Account Holder Name <?=!empty($salon_name) && $salon_name->is_payment_gateway == '1' ? '<b class="require">*</b>' : ''; ?></label>
														<input autocomplete="off" type="text" class="form-control account_holder_name" name="account_holder_name_0" id="account_holder_name_0" value="" placeholder="Enter account holder name">
													</div>
												</div>
												<div class="col-md-6"> 
													<div class="form-group">
														<label>Account Number <?=!empty($salon_name) && $salon_name->is_payment_gateway == '1' ? '<b class="require">*</b>' : ''; ?></label>
														<input autocomplete="off" type="text" class="form-control account_number" name="account_number_0" id="account_number_0" value="" placeholder="Enter account number">
													</div>
												</div>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<div class="form-group">
														<label>Account Type <?=!empty($salon_name) && $salon_name->is_payment_gateway == '1' ? '<b class="require">*</b>' : ''; ?></label>
														<select class="form-control account_type chosen-select" name="account_type_0" id="account_type_0">
															<option value="">Select account type</option>
															<option value="1">For business</option>
															<option value="2">Business saving</option>
															<option value="3">Business Credit</option>
														</select>
													</div>
												</div> 
												<div class="col-md-6">
													<div class="form-group">
														<label>Bank Name <?=!empty($salon_name) && $salon_name->is_payment_gateway == '1' ? '<b class="require">*</b>' : ''; ?></label>
														<input autocomplete="off" type="text" class="form-control bank_branch_name" name="bank_branch_name_0" id="bank_branch_name_0" value="" placeholder="Enter bank name">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label>IFSC Code <?=!empty($salon_name) && $salon_name->is_payment_gateway == '1' ? '<b class="require">*</b>' : ''; ?></label>
														<input autocomplete="off" type="text" class="form-control ifsc" data-index="0" name="ifsc_0" id="ifsc_0" value="" placeholder="SBIN0011513" onInput="capitaliseifsc(0)">
													</div>
												</div>
											</div>
											<!-- <div class="row">
												<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"> 
													<div class="form-group">
														<input type="checkbox" name="agree_terms_0" id="agree_terms_0" value="Yes">
														<label>Agree Terms & Conditions <a target="_blank" href="<?php echo base_url(); ?>terms" style="text-decoration:underline;"><small>View</small></a></label>
													</div>
													<label id="agree_terms_0-error" class="error" for="agree_terms_0" style="display:none;">Please accept terms & conditions</label>
												</div>
											</div> -->
										</div>
										<div id="add_more_div"></div>
										<div class="row">
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align:right;">
												<button type="button" id="add-more" class="btn btn-success" style="margin-top: 20px;">Add More</button>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="form-group">
													<button type="submit" id="submit_form" disabled value="submit" name="submit_form" class="btn btn-primary" style="margin-top: 30px;">Submit</button>
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
			<div class="tab-pane <?php if($this->uri->segment(3) != ""){ echo '';}else{ echo 'active'; } ?>" id="2">
				<div class="x_panel">
					<div class="x_content">
						<div class="container">
							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12">
									<table id="example" class="table table-striped responsive-utilities jambo_table" style="width:100%;">
										<thead>
											<tr class="headings">
												<th>
													Sr. No.
												</th>
												<th>Booking Rule Setup</th>
												<th>Branch Name</th>
												<th>Subscription</th>
												<th>Whatsapp Coin Balance</th>
												<th>Coin Balance</th>
												<th>Current Due Payment</th>
												<th>Referred By</th>
												<th>Branch Number</th>
												<th>Branch Email</th>
												<th>Booking Rule Type</th>
												<th>GST</th>
												<th>Address</th>
												<th>Payments</th>
												<th>Gallary</th>
												<th class=" no-link last"><span class="nobr">Actions</span>
												</th>
											</tr>
										</thead> 
										<tbody>
											<?php if (!empty($branch_list)) {
												$i = 1;
												foreach ($branch_list as $gbranch_list_result) {
													$saloon_type = $this->Admin_model->get_salon_type($gbranch_list_result->salon_type);
													$subscription = $this->Admin_model->get_subscription_details($gbranch_list_result->subscription_id);
													$subscription_allocation = $this->Admin_model->get_subscription_allocation_details($gbranch_list_result->subscription_allocation_id);
													$referred_by = $this->Admin_model->get_branch_details($gbranch_list_result->referred_by);
													$is_money_back = $this->Admin_model->get_is_money_back_applicable($gbranch_list_result->id);
													if(!empty($subscription_allocation)){
														if($subscription_allocation->allocation_status == '0'){
															$subscription_status = '<label class="label label-warning">Inactive</label>';
														}elseif($subscription_allocation->allocation_status == '1'){
															$subscription_status = '<label class="label label-success">Active</label>';
														}elseif($subscription_allocation->allocation_status == '2'){
															$subscription_status = '<label class="label label-primary">Expired</label>';
														}elseif($subscription_allocation->allocation_status == '3'){
															$subscription_status = '<label class="label label-info">Cancelled</label>';
														}elseif($subscription_allocation->allocation_status == '4'){
															$subscription_status = '<label class="label label-danger">Money Back & Closed</label>';
														}elseif($subscription_allocation->allocation_status == '5'){
															$subscription_status = '<label class="label label-primary">Hold</label>';
														}else{
															$subscription_status = '';
														}
													}else{
														$subscription_status = '';
													}
											?>
													<tr>
														<td scope="row">
															<?= $i++ ?>
														</td>
														<td>															
															<?php if($gbranch_list_result->booking_rule_setup_status == '0'){
																$text = '';
																if($gbranch_list_result->last_booking_rule_setup_block != ""){
																	$date = new DateTime($gbranch_list_result->last_booking_rule_setup_block);
																	$date->modify('+1 day');
																	$activate_from = $date->format('d-m-Y h:i A');
																	$text = '<br><label>On: ' . date('d-m-Y h:i A',strtotime($gbranch_list_result->last_booking_rule_setup_block)) . '<br><small>(It will automatically active after  ' . $activate_from . ')</small></label>';
																}
															?>
																<a onclick="return confirm('Are you sure you want to activate booking rules setup for branch?');" href="<?=base_url();?>activate_booking_rule_setup/<?=$gbranch_list_result->id;?>" title="Active Booking Rule Setup"><i class="fa-solid fa-toggle-off" style="cursor: pointer;"></i></a>
																<?=$text;?>
															<?php }else{ ?>
																<a onclick="return confirm('Are you sure you want to inactivate booking rules setup for branch?');" href="<?=base_url();?>inactivate_booking_rule_setup/<?=$gbranch_list_result->id;?>" title="Inactive Booking Rule Setup"><i style="color: green;" class="fa-solid fa-toggle-on" style="cursor: pointer;"></i></a>
															<?php } ?>
														</td>
														<td>
															<?= $gbranch_list_result->branch_name ?>
														</td>
														<td>
															<?php echo $subscription_status; ?>
															<?= !empty($subscription_allocation) ? '<p style="margin: 0px 0 0px;font-size: 14px;"><b style="color:#4c4c4c;">'.$subscription_allocation->subscription_name.'</b></p>' : ''; ?>
															<?= $gbranch_list_result->subscription_price != "" ? '<p style="font-size: 13px;margin: 0px 0 0px;"><b style="color:#4c4c4c;">Price: </b><span style="font-size: 12px;">Rs. '.$gbranch_list_result->subscription_price.'</span></p>' : ''; ?>
															<?= $gbranch_list_result->subscription_start != "" && $gbranch_list_result->subscription_end != "" && $gbranch_list_result->subscription_end != "0000-00-00 00:00:00" && $gbranch_list_result->subscription_start != "0000-00-00 00:00:00" ? '<p style="font-size: 13px;margin: 0px 0 0px;"><b style="color:#4c4c4c;">Validity: </b><span style="font-size: 12px;">'.date('d M, Y h:i A',strtotime($gbranch_list_result->subscription_start)) .' To '.date('d M, Y h:i A',strtotime($gbranch_list_result->subscription_end)).'</span></p>' : ''; ?>
														</td>
														<td>
															<?= $gbranch_list_result->include_wp != '1' ? 'NA' : ($gbranch_list_result->current_wp_coins_balance != "" ? '<a title="Branch Whatsapp Coin History" style="text-decoration:underline;" href="'.base_url().'branch_wp_coin_history?branch='.$gbranch_list_result->id.'" target="_blank">'.(int)$gbranch_list_result->current_wp_coins_balance.'</a>' : '-'); ?>
															<!-- <?= $gbranch_list_result->include_wp != '1' ? 'NA' : ($gbranch_list_result->current_wp_coins_balance != "" ? (int)$gbranch_list_result->current_wp_coins_balance : '-'); ?> -->
														</td>
														<td>
															<?= $gbranch_list_result->coin_balance != "" ? '<a title="Branch Coin History" style="text-decoration:underline;" href="'.base_url().'branch_coin_history?branch='.$gbranch_list_result->id.'" target="_blank">'.(int)$gbranch_list_result->coin_balance.'</a>' : '-'; ?>
														</td>
														<td>
															<?= $gbranch_list_result->pending_due_amount != "" ? $gbranch_list_result->pending_due_amount : '0.00'; ?>
														</td>
														<td>
															<?php if(!empty($referred_by)){ echo $referred_by->branch_name.', '.$referred_by->salon_name; }else{ echo '-'; }?>
														</td>
														<td>
															<?= $gbranch_list_result->salon_number ?>
														</td>
														<td>
															<?= $gbranch_list_result->email ?>
														</td>
														<td>
															<?php if(!empty($saloon_type)){ echo $saloon_type->type; }else{ echo '-'; }?>
														</td>
														<td>
															<?php
																if($gbranch_list_result->is_gst_applicable == '1'){
																	echo $gbranch_list_result->gst_no;
																	if(!empty($setup)){
																		echo '<br>Rate: '.$setup->gst_rate.'%';
																	}
																}else{
																	echo 'Not Applicable';
																}
															?>
														</td>
														<td>
															<?= $gbranch_list_result->salon_address ?>
														</td>
														<td><a style="color: blue;" href="<?= base_url(); ?>branch_payment_history?branch=<?= $gbranch_list_result->id?>">Payments</a></td>
														<td><a style="color: blue;" href="<?= base_url(); ?>branch-gallary/<?= $gbranch_list_result->id?>">Add Gallary</a></td>
														<td> 
															<a title="Branch Timeline" class="btn btn-info" href="<?=base_url()?>branch_timeline?branch=<?= $gbranch_list_result->id ?>"><i class="fa-solid fa-history"></i></a> 
															<a title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?=base_url()?>admin_delete/<?= $gbranch_list_result->id ?>/tbl_branch"><i class="fa-solid fa-trash"></i></a> 
															<a title="Edit" class="btn btn-success" href="<?= base_url() ?>add-branch/<?= $this->uri->segment(2) ?>/<?= $gbranch_list_result->id ?>"><i class="fa-solid fa-pen-to-square"></i></a> 
															<?php if($is_money_back){ ?>
																<a title="Money Back" class="btn btn-warning" href="<?= base_url() ?>money-back?branch=<?= $gbranch_list_result->id ?>"><i class="fa-solid fa-dollar-sign"></i></a> 
															<?php } ?>
														</td>
													</tr>
											<?php }
											} ?> 
										</tbody> 
									</table>
								</div>
							</div>
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
	var is_payment_gateway = '<?php if(!empty($salon_name) && $salon_name->is_payment_gateway == '1'){ echo '1'; }else{ echo '0'; }; ?>';
	var i = 1;
	function createAddMoreFields() {
		let appedData = `<div class="form-section" style="border:1px solid #ccc; border-radius:10px; padding:15px;margin-top:10px;">
							<div class="row">
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
									<div class="form-group">
										<label>Branch Name <b class="require">*</b></label>
										<input autocomplete="off" type="text" class="form-control branch_name" name="branch_name_${i}" id="branch_name_${i}" value="" placeholder="Enter branch name">
										<input type="hidden" name="salon_id_${i}" id="salon_id_${i}" value="<?php echo $this->uri->segment(2); ?>">
										<input type="hidden" name="indices[]" id="indices_${i}" value="${i}">
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
									<div class="form-group">
										<label>Salon Mobile<b class="require">*</b></label>
										<input maxlength="10" autocomplete="off" type="text" class="form-control salon_number" name="salon_number_${i}" id="salon_number_${i}" value="" placeholder="Enter salon number">
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
									<div class="form-group">
										<label>Email <b class="require">*</b></label>
										<input autocomplete="off" type="text" class="form-control email" data-index="${i}" name="email_${i}" id="email_${i}" value="" placeholder="Enter salon email" onInput="checkUniqueEmail(${i})">
										<label id="email_error_label_${i}" style="display:none;" class="email_error_label error invalid-feedback">Please select category</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
									<div class="form-group">
										<label>Password <b class="require">*</b></label>
										<input autocomplete="off" type="text" class="form-control password" name="password_${i}" id="password_${i}" value="" placeholder="Enter salon password">
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
									<div class="form-group">
										<label>Salon Address <b class="require">*</b></label>
										<input autocomplete="off" type="text" class="form-control salon_address" name="salon_address_${i}" id="salon_address_${i}" value="" placeholder="Enter address">
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
									<div class="form-group">
										<label>State<b class="require">*</b></label>
										<select class="form-control form-select chosen-select state" data-index="${i}" name="state_${i}" id="state_${i}" onchange="fetchCities(${i})">
											<option value="" class="">Select State</option>
											<?php if (!empty($state)) {
												foreach ($state as $state_result) { ?>
													<option value="<?= $state_result->id ?>">
														<?= $state_result->name ?>
													</option>
											<?php }
											} ?>
										</select>
									</div> 
								</div>
							</div>
							<div class="row">
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
									<div class="form-group">
										<label>Select City<b class="require">*</b></label>
										<div>
											<select class="form-control form-select  chosen-select city_name" data-index="${i}" name="city_${i}" id="city_name_${i}">
												<option value="">Select City</option>
												<?php if (!empty($city)) {
													foreach ($city as $city_result) { ?>
														<option value="<?= $city_result->id ?>">
															<?= $city_result->name ?>
														</option>
												<?php }
												} ?>
											</select>
										</div>
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
									<div class="form-group">
										<label>Pin Code</label>
										<input autocomplete="off" type="text" class="form-control pincode_" name="pincode_${i}" id="pincode_${i}" value="" placeholder="Enter pincode">
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
									<div class="form-group">
										<label>Upload Shopact <b class="require">*</b></label>
										<input autocomplete="off" type="file" class="form-control shopact" name="shopact_${i}" id="shopact_${i}">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"> 
									<div class="form-group">
										<label>Salon Category<b class="require">*</b></label><br> 
										<input autocomplete="off" type="radio" id="male_${i}" class="category selected_category" name="category_${i}" value="0">
										<label for="male">Male</label>&nbsp&nbsp 
										<input autocomplete="off" type="radio" id="female_${i}" class="category selected_category" name="category_${i}" value="1">
										<label for="female">Female</label>&nbsp&nbsp 
										<input autocomplete="off" type="radio" id="unisex_${i}" class="category selected_category" name="category_${i}" value="2">
										<label for="unisex">Unisex</label> 
										<span id="category-error" class="error invalid-feedback" style="display:none;"></span>
									</div>
									<span id="category_${i}-error" style="display:none;" class="error invalid-feedback">Please select category</span>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
									<div class="form-group">
										<label>Subscription<b class="require">*</b></label>
										<select class="form-select chosen-select form-control subscription" name="subscription_${i}" id="subscription_${i}">
											<option value="">Select Subscription</option>
										</select>
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
									<div class="form-group">
										<label>Referred By</label>
										<select class="form-select chosen-select form-control referred_by" name="referred_by_${i}" id="referred_by_${i}">
											<option value="">Select Referred By Branch</option>
											<?php if(!empty($branches)){ foreach($branches as $branches_result){ ?>
												<option value="<?=$branches_result->id;?>"><?=$branches_result->branch_name;?>, <?=$branches_result->salon_name;?></option>
											<?php }} ?>
										</select>
									</div>
								</div>
							</div>
							<div class="row">  
								<div class="col-md-4">
									<div class="form-group">
										<label>Payment Option<b class="require">*</b></label><br> 
										<select class="form-control form-select chosen-select payment_options" name="payment_options_${i}[]" id="payment_options_${i}" multiple>
											<option value="UPI">UPI</option>
											<option value="Net Banking">Net Banking</option>
											<option value="Cash">Cash</option>
											<option value="Card">Card</option>
											<option value="Cheque">Cheque</option>
										</select>
										<label id="payment_options_${i}-error" style="display:block;" class="error" for="payment_options_${i}"></label>
									</div>
								</div>
							</div>
							<div class="row">  
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div class="form-group">
										<hr>
										<h3 style="color: black; font-weight: bold;">Bank Details</h3>
										<p>Please provide branch account details.</p>
										<hr>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Account Holder Name ` + (is_payment_gateway == '1' ? '<b class="require">*</b>' : '') + `</label>
										<input autocomplete="off" type="text" class="form-control account_holder_name" name="account_holder_name_${i}" id="account_holder_name_${i}" value="" placeholder="Enter account holder name">
									</div>
								</div>
								<div class="col-md-6"> 
									<div class="form-group">
										<label>Account Number ` + (is_payment_gateway == '1' ? '<b class="require">*</b>' : '') + `</label>
										<input autocomplete="off" type="text" class="form-control account_number" name="account_number_${i}" id="account_number_${i}" value="" placeholder="Enter account number">
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="form-group">
										<label>Account Type ` + (is_payment_gateway == '1' ? '<b class="require">*</b>' : '') + `</label>
										<select class="form-control account_type chosen-select" name="account_type_${i}" id="account_type_${i}">
											<option value="">Select account type</option>
											<option value="1">For business</option>
											<option value="2">Business saving</option>
											<option value="3">Business Credit</option>
										</select>
									</div>
								</div> 
								<div class="col-md-6">
									<div class="form-group">
										<label>Bank Name ` + (is_payment_gateway == '1' ? '<b class="require">*</b>' : '') + `</label>
										<input autocomplete="off" type="text" class="form-control bank_branch_name" name="bank_branch_name_${i}" id="bank_branch_name_${i}" value="" placeholder="Enter bank name">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>IFSC Code ` + (is_payment_gateway == '1' ? '<b class="require">*</b>' : '') + `</label>
										<input autocomplete="off" type="text" class="form-control ifsc" data-index="${i}" name="ifsc_${i}" id="ifsc_${i}" value="" placeholder="SBIN0011513" onInput="capitaliseifsc(${i})">
									</div>
								</div>	
								<div class="form-group col-lg-2" style="text-align: center;">
									<span style="cursor:pointer;" onclick="removeRow(this)" title="Remove It" class="delete_area"><i class="fa fa-trash" style="color:red;margin-top:35px;" aria-hidden="true"></i></span>
								</div>
							</div>
						</div>`;
							// <div class="row">								
							// 	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"> 
							// 		<div class="form-group">
							// 			<input type="checkbox" name="agree_terms_${i}" id="agree_terms_${i}" value="Yes" class="agree_terms">
							// 			<label>Agree Terms & Conditions <b class="require">*</b> <a target="_blank" href="<?php echo base_url(); ?>terms" style="text-decoration:underline;"><small>View</small></a></label>
							// 		</div>
							// 		<label id="agree_terms_${i}-error" class="error" for="agree_terms_${i}" style="display:none;">Please accept terms & conditions</label>
							// 	</div>
							// </div>
		$('#add_more_div').append(appedData);
		$(".chosen-select").chosen();
		fetchSubscriptions(i);
		i++;
		initializeValidationForFields();
	}
	function removeRow(arg) {
		$(arg).parent().parent().remove();
		initializeValidationForFields();
	}   
	function initializeValidationForFields() {
		$(".branch_name").each(function () {
			$(this).rules("add", {
				required: true,
				messages: {
					required: "Please enter branch name",
				},
			});
		});
		$(".salon_number").each(function () {
			$(this).rules("add", {
				required: true,
				number: true,
				minlength: 10,
				maxlength: 10,
				messages: {
                    required: "Please enter branch owner number!",
                    number: "Please enter number!",
                    minlength: "Enter valid contact number!",
                    maxlength: "Length of contact number is too large!",
				},
			});
		});
		$(".agree_terms").each(function () {
			$(this).rules("add", {            
				required:true,
				messages: {
                    required: "Please accept terms & conditions!",
				},
			});
		});
		$(".pincode").each(function () {
			$(this).rules("add", {            
				number:true,
				maxlength: 6,
				minlength: 6,
				messages: {
                    number: "Please enter numbers only!",
                    minlength: "Enter valid pincode!",
                    maxlength: "Enter valid pincode!",
				},
			});
		});
		$(".email").each(function () {
			$(this).rules("add", {
				required: true,
				email:true,
				messages: {
					required: "Please enter email",
					email: "Enter valid email",
				},
			});
		});
		$(".password").each(function () {
			$(this).rules("add", {
				required: true,
				messages: {
					required: "Please enter password",
				},
			});
		});
		$(".salon_address").each(function () {
			$(this).rules("add", {
				required: true,
				messages: {
					required: "Please enter branch address",
				},
			});
		});
		$(".state").each(function () {
			$(this).rules("add", {
				required: true,
				messages: {
					required: "Please select state",
				},
			});
		});
		$(".city_name").each(function () {
			$(this).rules("add", {
				required: true,
				messages: {
					required: "Please select city",
				},
			});
		});
		$(".subscription").each(function () {
			$(this).rules("add", {
				required: true,
				messages: {
					required: "Please select subscription",
				},
			});
		});
		$(".selected_category").each(function () {
			$(this).rules("add", {
				required: true,
				messages: {
					required: "Please select category",
				},
			});
		});
		$(".account_number").each(function () {
			$(this).rules("add", {
				required: function(element) {
					return $('#is_payment_gateway').val() == '1';
				},
				number: true,
				messages: {
					required: "Please enter account number",
					number: "Enter numbers only",
				},
			});
		});
		$(".account_type").each(function () {
			$(this).rules("add", {
				required: function(element) {
					return $('#is_payment_gateway').val() == '1';
				},
				messages: {
					required: "Please select account type",
				},
			});
		});
		$(".ifsc").each(function () {
			$(this).rules("add", {
				required: function(element) {
					return $('#is_payment_gateway').val() == '1';
				},
				maxlength: 11,
				minlength: 11,
				messages: {
					required: "Please enter IFSC Code",
					maxlength: "Maximum 11 characters required",
					minlength: "Minimum 11 characters required",
				},
			});
		});
		$(".bank_branch_name").each(function () {
			$(this).rules("add", {
				required: function(element) {
					return $('#is_payment_gateway').val() == '1';
				},
				messages: {
					required: "Please enter bank name",
				},
			});
		});
		$(".account_holder_name").each(function () {
			$(this).rules("add", {
				required: function(element) {
					return $('#is_payment_gateway').val() == '1';
				},
				messages: {
					required: "Please enter account holder name",
				},
			});
		});
		$(".payment_options").each(function () {
			$(this).rules("add", {
				required: true,
				messages: {
					required: "Please select atleast one option",
				},
			});
		});
	}
    $(document).ready(function() { 
		$('#add-more').click(function () {
            createAddMoreFields();
        });
        $('#branch_form').validate({
			ignore:[],
            rules: {
                branch_name_0: 'required',
                salon_number_0: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 10,
                },
                shopact_0: {
                    required: function(element) {
                        return $('#old_shopact').val() == '';
                    },
				},
                salon_address_0: 'required',
                account_holder_name_0: {
                    required: function(element) {
                        return $('#is_payment_gateway').val() == '1';
                    },
				},
                account_number_0: {
                    required: function(element) {
                        return $('#is_payment_gateway').val() == '1';
                    },
                    number: true,
                },
                account_type_0: {
                    required: function(element) {
                        return $('#is_payment_gateway').val() == '1';
                    },
				},
                bank_branch_name_0: {
                    required: function(element) {
                        return $('#is_payment_gateway').val() == '1';
                    },
				},
                ifsc_0: {
                    required: function(element) {
                        return $('#is_payment_gateway').val() == '1';
                    },
                    maxlength: 11,
                    minlength: 11,
                },
                password_0: 'required',
                email_0: {                       
                       required: true, 
                       email:true,
                   },
                agree_terms_0: 'required',
                category_0: 'required',
                'payment_options_0[]': 'required',
                state_0: 'required',
                city_0: 'required',
                subscription_0: 'required',
                pincode_0: {                       
						number:true,
						maxlength: 6,
						minlength: 6,
                   },
            },
            messages: {
                email_0: {
                        required: "Please enter email!", 
                        email: "Please enter valid email!",
                    },
                branch_name_0: 'Please enter salon name!',
                salon_number_0: {
                    required: "Please enter salon owner number!",
                    number: "Please enter number!",
                    minlength: "Enter valid contact number!",
                    maxlength: "Length of contact number is too large!",
                },
                shopact_0: 'Please upload salon shopact file!',
                salon_address_0: 'Please enter salon address!',
                account_holder_name_0: 'Please enter account holder name!',
                account_number_0: 'Please enter account number!',
                account_number_0: {
                    required: 'Please enter account number!',
                    number: 'Please enter valid account number!',
                },
                account_type_0: 'Please enter account type!',
                bank_branch_name_0: 'Please enter bank name!',
                ifsc_0: {
                        required: "Please enter IFSC code!", 
                        maxlength: "Please enter valid IFSC Code!",
                        minlength: "Please enter valid IFSC Code!",
                        noHTMLtags: "HTML tags not allowed!",
                    },
                password_0: 'Please enter password!',
                agree_terms_0: 'Please accept terms & conditions!',
                category_0: 'Please select salon category!',
                'payment_options_0[]': 'Please select atleast one option!',
                state_0: 'Please select state!',
                city_0: 'Please select city!',
                subscription_0: 'Please select subscription!',
				pincode_0: {
					number: "Please enter numbers only!",
					maxlength: "Please enter valid pincode!",
					minlength: "Please enter valid pincode!",
				},
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
		
		$('#example').DataTable({ 
			responsive: true,
            dom: 'Blfrtip',
            lengthMenu: [ [10, 25, 50, 100], [10, 25, 50, 100] ],
			buttons: [				
				{
					extend: 'excel',
					filename: 'branch-list',
					exportOptions: {
						columns: [0,1,2,3,4,5,6,7,8,9,10] 
					}
				},	
			], 
        });
    });
	function capitaliseifsc(index){
        var currentValue = $('#ifsc_' + index).val();
        $('#ifsc_' + index).val(currentValue.toUpperCase());
	}

	function fetchCities(index){
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>admin/Ajax_controller/get_city_ajax",
            data: {
                'state': $("#state_" + index).val()
            },
            success: function(data) {
                $("#city_name_" + index).empty();
                $("#city_name_" + index).append('<option value="">Select City</option>');
                var opts = $.parseJSON(data);
                $.each(opts, function(i, d) {
                    $("#city_name_" + index).append('<option value="' + d.id + '">' + d.name + '</option>');
                });
                $("#city_name_" + index).trigger('chosen:updated');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
	}
	function fetchSubscriptions(index){
		$.ajax({
			type: "POST",
			url: "<?= base_url(); ?>admin/Ajax_controller/get_subscription_typewise_ajx",
			data: {	},
			success: function(data) {
				$("#subscription_" + index).empty();
				$("#subscription_" + index).append('<option value="">Select Subscription</option>');
				var opts = $.parseJSON(data);
				$.each(opts, function(i, d) {
					$("#subscription_" + index).append('<option value="' + d.id + '">' + d.subscription_name + '</option>');
				});
				$("#subscription_" + index).trigger('chosen:updated');
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus, errorThrown);
			}
		});
	}
	function checkInForm(index) {
		var emailToCheck = $("#email_" + index).val();
		var isEmailFound = false;

		$(".email").each(function () {
			var single_value = $(this).val();
			
			if (single_value == emailToCheck && $(this).attr('id') !== "email_" + index) {
				isEmailFound = true;
				return false;
			}
		});
		
		return isEmailFound;
	}
	function checkUniqueEmail(index){
		$('.email_error_label').text('').hide();
		$('#email_error_label_' + index).text('').hide();
		$('#submit_form').attr('disabled',false);

		if (checkInForm(index)) {
			$('#email_error_label_' + index).text('This email address already added in the form').show();
			$('#submit_form').attr('disabled',true);
			return false;
		}

		$.ajax({
			type: "POST",
			url: "<?= base_url(); ?>admin/Ajax_controller/check_unique_email_ajax",
			data: {	
                'email': $("#email_" + index).val()
			},
			success: function(data) {
				if(data === '0'){
					console.log(data);
					$('#email_error_label_' + index).text('This email address already exist').show();
					$('#submit_form').attr('disabled',true);
				}else{
					$('#email_error_label_' + index).text('').hide();
					$('#submit_form').attr('disabled',false);
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus, errorThrown);
			}
		});
	}
	
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".chosen-select").chosen({});
		fetchSubscriptions(0);
    });
</script>