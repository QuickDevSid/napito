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
	<?php if(!empty($single) && $single->subscription_id != "" && $single->subscription_id != "0"){ ?>
	#subscription_chosen {
		background-color: #e9ecef;
		pointer-events: none;
		cursor: not-allowed;
	}
	<?php } ?>

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
	<?php if(!empty($single) && $single->referred_by != ""){ ?>
	#referred_by_chosen {
		background-color: #e9ecef;
		pointer-events: none;
		cursor: not-allowed;
	}
	<?php } ?>
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
										<div class="row">
											<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
												<div class="form-group">
													<label>Branch Name <b class="require">*</b></label>
													<input autocomplete="off" type="text" class="form-control" name="branch_name" id="branch_name" value="<?php if (!empty($single)) {echo $single->branch_name; } ?>" placeholder="Enter branch name">
													<input autocomplete="off" type="hidden" name="id" id="id" value="<?php if (!empty($single)) {echo $single->id; } ?>">
													<input autocomplete="off" type="hidden" class="form-control" name="salon_id" id="salon_id" value="<?php echo $this->uri->segment(2); ?>">
												</div>
											</div>
											<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
												<div class="form-group">
													<label>Salon Mobile<b class="require">*</b></label>
													<input maxlength="10" autocomplete="off" type="text" class="form-control" name="salon_number" id="salon_number" value="<?php if (!empty($single)) { echo $single->salon_number;} ?>" placeholder="Enter salon number">
												</div>
											</div>
											<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
												<div class="form-group">
													<label>Email <b class="require">*</b></label>
													<input autocomplete="off" type="text" class="form-control" name="email" id="email" value="<?php if (!empty($single)) { echo $single->email; } ?>" placeholder="Enter salon email">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
												<div class="form-group">
													<label>Password <b class="require">*</b></label>
													<input autocomplete="off" type="text" class="form-control" name="password" id="password" value="<?php if (!empty($single)) {echo $single->password; } ?>" placeholder="Enter salon password">
												</div>
											</div>
											<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
												<div class="form-group">
													<label>Salon Address <b class="require">*</b></label>
													<input autocomplete="off" type="text" class="form-control" name="salon_address" id="salon_address" value="<?php if (!empty($single)) {echo $single->salon_address; } ?>" placeholder="Enter address">
												</div>
											</div>
											<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
												<div class="form-group">
													<label>State<b class="require">*</b></label>
													<select class="form-control form-select  chosen-select" name="state" id="state">
														<option value="" class="">Select State</option>
														<?php if (!empty($state)) {
															foreach ($state as $state_result) { ?>
																<option value="<?= $state_result->id ?>" <?php if (!empty($single) && $single->state == $state_result->id) { ?>selected="selected" <?php } ?>>
																	<?= $state_result->name ?>
																</option>
														<?php }
														} ?>
													</select>
												</div> 
												<?php
												$city = array();
												$payment_options = [];
												if (!empty($single)) {
													$city = $this->Admin_model->get_selected_state_city($single->state);
													$payment_options = $single->payment_options != "" ? explode(',',$single->payment_options) : [];
												}
												?>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
												<div class="form-group">
													<label>Select City<b class="require">*</b></label>
													<div>
														<select class="form-control form-select  chosen-select" name="city" id="city_name">
															<option value="">Select City</option>
															<?php if (!empty($city)) {
																foreach ($city as $city_result) { ?>
																	<option value="<?= $city_result->id ?>" <?php if (!empty($single) && $single->city == $city_result->id) { ?>selected="selected" <?php } ?>>
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
													<input autocomplete="off" type="text" class="form-control" name="pincode" id="pincode" value="<?php if (!empty($single)) {echo $single->pincode;} ?>" placeholder="Enter pincode">
												</div>
											</div>
											<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
												<div class="form-group">
													<label>Upload Shopact <b class="require">*</b>
															<?php if(!empty($single) && $single->shopact != ""){ ?>
																<a target="_blank" href="<?=base_url();?>admin_assets/images/shopact-image/<?=$single->shopact;?>" style="text-decoration:underline;"> View</a>
															<?php } ?>
													</label>
													<input autocomplete="off" type="file" class="form-control" name="shopact" id="shopact">
													<input type="hidden" class="form-control" name="old_shopact" id="old_shopact" value="<?php if (!empty($single)) {echo $single->shopact;} ?>">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"> 
												<div class="form-group">
													<label>Salon Category<b class="require">*</b></label><br> 
													<input autocomplete="off" type="radio" id="male" class="category" name="category" value="0" <?= ($single && $single->category == 0) ? 'checked' : ''; ?>>
													<label for="male">Male</label>&nbsp&nbsp 
													<input autocomplete="off" type="radio" id="female" class="category" name="category" value="1" <?= ($single && $single->category == 1) ? 'checked' : ''; ?>>
													<label for="female">Female</label>&nbsp&nbsp 
													<input autocomplete="off" type="radio" id="unisex" class="category" name="category" value="2" <?= ($single && $single->category == 2) ? 'checked' : ''; ?>>
													<label for="unisex">Unisex</label> 
													<span id="category-error" class="error invalid-feedback" style="display:none;"></span>
												</div>
											</div>
											<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
												<div class="form-group">
													<label>Subscription<b class="require">*</b></label>
													<select <?php if(!empty($single) && $single->subscription_id != "" && $single->subscription_id != "0"){ echo 'readonly'; } ?> class="form-select chosen-select form-control" name="subscription" id="subscription">
														<option value="">Select Subscription</option>
													</select>
												</div>
											</div>
											<input type="hidden" name="old_subscription" id="old_subscription" value="<?php if (!empty($single)) {echo $single->subscription_id;} ?>">
											<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
												<div class="form-group">
													<label>Referred By</label>
													<select <?php if(!empty($single) && $single->referred_by != ""){ echo 'readonly'; } ?> class="form-select chosen-select form-control" name="referred_by" id="referred_by">
														<option value="">Select Referred By Branch</option>
														<?php if(!empty($branches)){ foreach($branches as $branches_result){ ?>
															<option value="<?=$branches_result->id;?>" <?php if(!empty($single) && $single->referred_by == $branches_result->id){ echo 'selected'; }?>><?=$branches_result->branch_name;?>, <?=$branches_result->salon_name;?></option>
														<?php }} ?>
													</select>
												</div>
											</div>
										</div>
										<div class="row">
											<input type="hidden" name="old_referred_by" id="old_referred_by" value="<?php if (!empty($single)) {echo $single->referred_by;} ?>">
											<div class="col-md-4">
												<div class="form-group">
													<label>Payment Option<b class="require">*</b></label><br> 
													<select class="form-control form-select chosen-select" name="payment_options[]" id="payment_options" multiple>
														<option value="UPI" <?php if (!empty($single) && in_array('UPI',$payment_options)) {
																				echo 'selected';
																			} ?>>UPI</option>
														<option value="Net Banking" <?php if (!empty($single) && in_array('Net Banking',$payment_options)) {
																				echo 'selected';
																			} ?>>Net Banking</option>
														<option value="Cash" <?php if (!empty($single) && in_array('Cash',$payment_options)) {
																				echo 'selected';
																			} ?>>Cash</option>
													</select>
													<label id="payment_options-error" style="display:block;" class="error" for="payment_options"></label>
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
													<label>Account Holder Name <b class="require">*</b></label>
													<input autocomplete="off" type="text" class="form-control" name="account_holder_name" id="account_holder_name" value="<?php if (!empty($single)) {echo $single->account_holder_name; } ?>" placeholder="Enter account holder name">
												</div>
											</div>
											<div class="col-md-6"> 
												<div class="form-group">
													<label>Account Number <b class="require">*</b></label>
													<input autocomplete="off" type="text" class="form-control" name="account_number" id="account_number" value="<?php if (!empty($single)) {echo $single->account_number;} ?>" placeholder="Enter account number">
												</div>
											</div>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<label>Account Type<b class="require">*</b></label>
													<select class="form-control" name="account_type" id="account_type">
														<option value="">Select account type</option>
														<option value="1" <?php if (!empty($single) && $single->account_type == 1) echo 'selected="selected"'; ?>>For business</option>
														<option value="2" <?php if (!empty($single) && $single->account_type == 2) echo 'selected="selected"'; ?>>Business saving</option>
														<option value="3" <?php if (!empty($single) && $single->account_type == 3) echo 'selected="selected"'; ?>>Business Credit</option>
													</select>
												</div>
											</div> 
											<div class="col-md-6">
												<div class="form-group">
													<label>Branch Name <b class="require">*</b></label>
													<input autocomplete="off" type="text" class="form-control" name="bank_branch_name" id="bank_branch_name" value="<?php if (!empty($single)) {echo $single->bank_branch_name; } ?>" placeholder="Enter branch name">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>IFSC Code <b class="require">*</b></label>
													<input autocomplete="off" type="text" class="form-control" name="ifsc" id="ifsc" value="<?php if (!empty($single)) {  echo $single->ifsc; } ?>" placeholder="SBIN0011513">
												</div>
											</div>
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="form-group">
													<button type="submit" value="submit" name="submit_form" class="btn btn-primary" style="margin-top: 30px;">Submit</button>
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
												<th>Branch Name</th>
												<th>Subscription</th>
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
														<th scope="row">
															<?= $i++ ?>
														</th>
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
															<?= $gbranch_list_result->coin_balance != "" ? '<a title="Branch Coin History" style="text-decoration:underline;" href="'.base_url().'branch_coin_history?branch='.$gbranch_list_result->id.'" target="_blank">'.(int)$gbranch_list_result->coin_balance.'</a>' : '0'; ?>
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
    $(document).ready(function() {
        $('#branch_form').validate({
			ignore:[],
            rules: {
                branch_name: 'required',
                salon_number: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 10,
                },
                shopact: {
                    required: function(element) {
                        return $('#old_shopact').val() == '';
                    },
				},
                salon_address: 'required',
                account_holder_name: 'required',
                account_number: {
                    required: true,
                    number: true,
                },
                account_type: 'required',
                bank_branch_name: 'required',
                ifsc: {
                    required: true,
                    maxlength: 11,
                    minlength: 11,
                },
                password: 'required',
                email: {
                       
                       required: true, 
                       email:true,
                   },
                'payment_options[]': 'required',
                category: 'required',
                state: 'required',
                city: 'required',
                subscription: 'required',
                pincode: {                       
						number:true,
						maxlength: 6,
						minlength: 6,
                   },
            },
            messages: {
                email: {
                        required: "Please enter email!", 
                        email: "Please enter valid email!",
                    },
                branch_name: 'Please enter salon name!',
                salon_number: {
                    required: "Please enter salon owner number!",
                    number: "Please enter number!",
                    minlength: "Enter valid contact number!",
                    maxlength: "Length of contact number is too large!",
                },
                shopact: 'Please upload salon shopact file!',
                salon_address: 'Please enter salon address!',
                account_holder_name: 'Please enter account holder name!',
                account_number: 'Please enter account number!',
                account_number: {
                    required: 'Please enter account number!',
                    number: 'Please enter valid account number!',
                },
                account_type: 'Please enter account type!',
                bank_branch_name: 'Please enter bank branch name!',
                ifsc: {
                        required: "Please enter IFSC code!", 
                        maxlength: "Please enter valid IFSC Code!",
                        minlength: "Please enter valid IFSC Code!",
                        noHTMLtags: "HTML tags not allowed!",
                    },
                password: 'Please enter password!',
                'payment_options[]': 'Please select atleast one option!',
                category: 'Please select salon category!',
                state: 'Please select state!',
                city: 'Please select city!',
                subscription: 'Please select subscription!',
				pincode: {
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
            dom: 'Blfrtip',
			responsive:true,
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
    $('#ifsc').on('input', function() {
        var currentValue = $(this).val();
        $(this).val(currentValue.toUpperCase());
    });

    $("#state").change(function() {
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>admin/Ajax_controller/get_city_ajax",
            data: {
                'state': $("#state").val()
            },
            success: function(data) {
                $("#city_name").empty();
                $('#city_name').append('<option value="">Select City</option>');
                var opts = $.parseJSON(data);
                $.each(opts, function(i, d) {
                    $('#city_name').append('<option value="' + d.id + '">' + d.name + '</option>');
                });
                $('#city_name').trigger('chosen:updated');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });
	function fetchSubscriptions(){
		$.ajax({
			type: "POST",
			url: "<?= base_url(); ?>admin/Ajax_controller/get_subscription_typewise_ajx",
			data: {	},
			success: function(data) {
				$("#subscription").empty();
				$('#subscription').append('<option value="">Select Subscription</option>');
				var opts = $.parseJSON(data);
				$.each(opts, function(i, d) {
					if(d.id == $('#old_subscription').val()){
						$('#subscription').append('<option selected value="' + d.id + '">' + d.subscription_name + '</option>');
					}else{
						$('#subscription').append('<option value="' + d.id + '">' + d.subscription_name + '</option>');
					}
				});
				$('#subscription').trigger('chosen:updated');
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
		fetchSubscriptions();
    });
</script>