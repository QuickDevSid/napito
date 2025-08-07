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
	input[class="dashboardToggle"] {
		position: relative;
		appearance: none;
		width: 50px;
		height: 25px;
		background: #ccc;
		border-radius: 50px;
		box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.2);
		cursor: pointer;
		transition: 0.4s;
	}

	input:checked[class="dashboardToggle"] {
		background: #7da6ff;
	}

	input[class="dashboardToggle"]::after {
		position: absolute;
		content: "";
		width: 25px;
		height: 25px;
		top: 0;
		left: 0;
		background: #fff;
		border-radius: 50%;
		box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
		transform: scale(1.1);
		transition: 0.4s;
	}

	input:checked[class="dashboardToggle"]::after {
		left: 50%;
	}
</style>
<!-- page content -->
<div class="right_col" role="main">
    <?php
        if($gst == ""){?>
        <div class="row"> 
            <div class="col-md-12 col-sm-12 col-xs-12">
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
            <div class="title_left">
                <h3>
                    Add Expenses
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
       


                    <div class="x_panel">
                        <div class="x_content">
                            <div class="container">
                                <form name="add_student" id="add_student" autocomplete="off" method="POST"
                                    enctype="multipart/form-data">
                                        <div class="row">                                             
                                                <input type="hidden" id="id" name="id" value="<?php if (!empty($single)) { echo $single->id; } ?>">
                                                <input type="hidden" id="branch_name" name="branch_name" value="<?php echo $this->session->userdata('branch_name'); ?>">
                                                <input type="hidden" class="form-control" value="<?php echo $this->session->userdata('branch_name'); ?>" readonly>
                                            
                                            <div class="col-md-6 col-sm-6 col-xs-12 form-group ">
                                                <label>Select Category <b class="require">*</b></label>
                                                <select class="form-select form-control input-content-option chosen-select"
                                                    name="expense_type" id="expense_type">
                                                    <option value="" class="">Select Category </option>
                                                    <?php if (!empty($expense_name)) {
                                                        foreach ($expense_name as $expense_name_result) { ?>
                                                            <option value="<?= $expense_name_result->id ?>" <?php if (!empty($single) && $single->expense_type == $expense_name_result->id) { ?>selected="selected"
                                                                <?php } ?>>
                                                                <?= $expense_name_result->expenses_name ?>
                                                            </option>
                                                        <?php }
                                                    } ?>
                                                    <div class="error" id="expense_type_error"></div>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <label>Select Payment Mode <b class="require">*</b></label>
                                                <select class="form-select form-control chosen-select" name="payment_mode" id="payment_mode">
                                                    <option value="">Ex.Cash ,Upi </option>
                                                    <option value="UPI" <?php if(!empty($single) && $single->payment_mode == "UPI") echo 'selected="selected"'; ?>>UPI</option>
                                                    <option value="Cash" <?php if(!empty($single) && $single->payment_mode == "Cash") echo 'selected="selected"'; ?>>Cash</option>
                                                    <option value="Cheque" <?php if(!empty($single) && $single->payment_mode == "Cheque") echo 'selected="selected"'; ?>>Cheque</option>
                                                    <option value="Online" <?php if(!empty($single) && $single->payment_mode == "Online") echo 'selected="selected"'; ?>>Online</option>
                                                    <option value="card" <?php if(!empty($single) && $single->payment_mode == "card") echo 'selected="selected"'; ?>>Card</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                                <label for="parents_name">Given To</label>
                                                <input autocomplete="off" id="given_to" name="given_to" type="text" class="form-control" placeholder="Given To" value="<?php if (!empty($single)) { echo $single->given_to; } ?>">
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                                <label for="parents_name">Expense Date <b class="require">*</b></label>
                                                <input autocomplete="off" readonly id="expense_date" name="expense_date" type="text" class="form-control" placeholder="DD/MM/YYYY" value="<?php if (!empty($single) && $single->expense_date != '') { echo date("d-m-Y", strtotime($single->expense_date));}else{ echo date("d-m-Y"); } ?>">
                                            </div>
                                        </div>
                                        <div class="row">
											<div class="col-lg-4">
												<label>Add Items ? </label>
												<input style="height: 25px !important; display:block;margin-bottom: 15px;" type="checkbox" name="add_items" id="add_items" class="dashboardToggle" <?php if (!empty($single) && $single->add_items == '1') { echo 'checked';} ?>>
											</div>
										</div>
										<div class="row optionBox" id="items_div" <?php if (!empty($single) && $single->add_items == '1') { echo 'style="display:block;"';}else{ echo 'style="display:none;"'; } ?>> 
												<div class="col-md-12 block">
													<div class="row">
														<div class="col-md-2">
															<label class="control-label" for="message">Item Name</label>
														</div>
														<div class="col-md-4">
															<label class="control-label" for="message">Quantity</label>
														</div> 
														<div class="col-md-2">
															<label class="control-label" for="message">Rate</label>
														 </div> 
														<div class="col-md-2"> 
															<label class="control-label" for="message">Total Amount</label>
														</div> 
														<div class="col-md-2"> 
															<label class="control-label" for="message">Remove</label>
														</div>  
													</div>
												</div>
												<?php 
												$total = 0;
												$i = 0;
												if(!empty($expsense_details)){
													foreach($expsense_details as $expsense_details_result){
														$total += $expsense_details_result->total_amount != "" ? (float)$expsense_details_result->total_amount : 0.00;	
												?>	
													<div class="col-md-12 block">
														<div class="row">
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" placeholder="Ex. Water" id="item_name" name="item_name[]" value="<?=$expsense_details_result->item_name?>"> 
																</div>
															</div>
															<div class="col-md-4">
																<div class="form-group">
																	<input type="text" class="form-control calculate calculate_qty" placeholder="Ex. 1" id="quantity_<?=$i;?>" name="quantity[]" value="<?=$expsense_details_result->quantity?>" onkeyup="calculateRow('<?=$i++;?>')">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control calculate calculate_rate" placeholder="₹" id="rate_<?=$i;?>" name="rate[]" value="<?=$expsense_details_result->rate?>" onkeyup="calculateRow('<?=$i++;?>')">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" placeholder="₹" class="amount form-control single_total" readonly id="total_amount_<?=$i++;?>" name="total_amount[]" value="<?=$expsense_details_result->total_amount?>">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<a href="javascript:void(0)" class="btn btn-danger remove"><i class="fa fa-trash"></i></a>
																</div>
															</div>
														</div>
													</div>
												<?php }}else{?>
												<div class="col-md-12 block">
														<div class="row">
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control" placeholder="Ex. Water" id="item_name" name="item_name[]" value=""> 
																</div>
															</div>
															<div class="col-md-4">
																<div class="form-group">
																	<input type="text" class="form-control calculate calculate_qty" placeholder="Ex. 1" id="quantity_<?=$i;?>" name="quantity[]" value="" onkeyup="calculateRow('0')">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" class="form-control calculate calculate_rate" placeholder="₹" id="rate_<?=$i;?>" name="rate[]" value="" onkeyup="calculateRow('0')">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<input type="text" placeholder="₹" class="amount form-control single_total" readonly id="total_amount_<?=$i++;?>" name="total_amount[]" value="0.00">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<a class="btn btn-danger remove" href="javascript:void(0)"><i class="fa fa-trash"></i></a>
																</div>
															</div>
														</div>
													</div>
												<?php }?>
												<div class="col-md-12 block">
													<a href="javascript:void(0)" class="btn btn-success add">Add More</a>
												</div>
										</div>
                                        <div class="row" style="margin-top:10px;">
                                            <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                                <label for="expense_remark">Note(Optional)</label> 
                                                <input autocomplete="off" id="expense_remark" name="expense_remark" type="text" class="form-control" placeholder="Enter Notes" value="<?php if (!empty($single)) { echo $single->expense_remark; } ?>">
                                            </div>
                                         
											<div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                                <label for="parents_name">Expense Amount (In Rupees)<b class="require">*</b></label>
                                                <input autocomplete="off" id="expense_amount" name="expense_amount" type="text" class="form-control total_amount" placeholder="Enter expense Amount" value="<?php if (!empty($single)) { echo $single->expense_amount;} ?>">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                                <button class="form_submit btn btn-primary">Submit </button>
                                            </div>
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
if ($this->uri->segment(2) != "") {
    $id = $this->uri->segment(2);
}
?>
<script>
var i = '<?php echo $i; ?>';
$("#expense_date").datepicker({
    dateFormat: "dd/mm/yy",
    changeMonth: true,
    changeYear: true,
    maxDate: "0",  
    minDate: "-100y", 
    yearRange: "-100:+0",  
});
 var validator; 
$(document).ready(function () { 
	document.getElementById('add_items').addEventListener('change', function() {
		var isChecked = this.checked;
		if(isChecked){
			calculateTotalAmount();
			$('#expense_amount').attr('readonly',true);
			$('#items_div').show();
		}else{
			$('#expense_amount').val('').attr('readonly',false);
			$('#items_div').hide();
		}
	});

	validator = $('#add_student').validate({
		// ignore: [],
		ignore: ":hidden:not(select)",
		rules: {
			branch_name: 'required',
			expense_type: 'required',
			expense_date: 'required',
			payment_mode: 'required',
			expense_amount: {
				required: true,
				number: true,
			},
			'item_name[]': 'required',
			'quantity[]': 'required',
			'rate[]': 'required',
			'total_amount[]': 'required',
		},
		messages: {
			branch_name: 'Please enter branch name!',
			expense_type: 'Please select expense type!',
			expense_amount: {
				required: 'Please enter payment amount!',
				number: "Only number allowed!",
			},
			expense_date: 'Please select date!',
			payment_mode: 'Please select payment mode!', 
			'item_name[]': 'Please enter item!', 
			'quantity[]': 'Please enter quantity!', 
			'rate[]': 'Please enter rate!', 
			'total_amount[]': 'Please enter amount!', 
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
 
	$('#expenses .child_menu').show();
	$('#expenses').addClass('nv active');
	$('.right_col').addClass('active_right');
	$('.add_salon_expense').addClass('active_cc');


	$('#branch_name').on('change', function() {
    	$('#branch_name').valid();
	});

	$('#payment_mode').on('change', function() {
    	$('#payment_mode').valid();
	});
});
 
$('#example').DataTable({ 
dom: 'Bfrtip',
responsive: false,
lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ], 
	buttons: [ 
		{
			extend: 'excel',
			filename: 'add-salon-expense',
			exportOptions: {
				columns: [0,1,2] 
			}
		}
	 
		
	], 
});

$('.add').click(function() {
    $('.block:last').before('<div class="col-md-12 block"><div class="row"><div class="col-md-2"><div class="form-group"><input type="text" class="form-control" placeholder="Ex. Water" id="item_name" name="item_name[]"> </div></div><div class="col-md-4"><div class="form-group"><input type="text" class="form-control calculate calculate_qty" placeholder="Ex. 1" id="quantity_'+i+'" name="quantity[]" onkeyup="calculateRow('+i+')"></div></div><div class="col-md-2"><div class="form-group"><input type="text" class="form-control calculate calculate_rate" placeholder="₹" id="rate_'+i+'" name="rate[]" onkeyup="calculateRow('+i+')"></div></div><div class="col-md-2"><div class="form-group"><input type="text" placeholder="₹" class="amount single_total form-control" readonly id="total_amount_'+i+'" name="total_amount[]" value="0.00"></div></div><div class="col-md-2"><div class="form-group"><a href="javascript:void(0)" class="btn btn-danger remove"><i class="fa fa-trash"></i></a></div></div></div></div>');
	 validator.resetForm(); // Reset the form validation state
        validator.settings.ignore = ''; // Make sure dynamically added fields are not ignored
        console.log("Validation reinitialized"); // Debugging
        validator.form();
		i++;
		
// 	$('.optionBox').on('input', '.calculate', function() {
//     var row = $(this).closest('.block');
//     var quantity = parseFloat(row.find('.form-control.calculate_qty').val()) || 0;
//     var rate = parseFloat(row.find('.form-control.calculate_rate').val()) || 0;
//     var totalAmount = quantity * rate;
//     row.find('.form-control.amount').val(totalAmount.toFixed(2));
	
// 	calculateTotalAmount();
	 
// });
});
$('.optionBox').on('click','.remove',function() {
    $(this).closest('.block').remove();
	calculateTotalAmount();
});
function calculateRow(index){
	var qty = $('#quantity_'+index).val() || 0;
	var rate = $('#rate_'+index).val() || 0;
	$('#total_amount_'+index).val(parseFloat(qty * rate).toFixed(2));
	calculateTotalAmount();
}
function calculateTotalAmount() {
    var total = 0;
    $('.single_total').each(function() {
        var amount = parseFloat($(this).val()) || 0;
        total += amount;
    });
    $('.total_amount').val(total.toFixed(2));
}
</script>