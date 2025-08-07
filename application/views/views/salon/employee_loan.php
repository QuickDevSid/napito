<?php include('header.php'); ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<style>            
			input[class="dashboardToggle"] {
				position: relative;
				appearance: none;
				width: 50px;
				height: 25px;
				background: #ff000085;
				border-radius: 50px;
				box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.2);
				cursor: pointer;
				transition: 0.4s;
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
            input:checked[class="dashboardToggle"] {
                background: #1aab00b3;
            }

        </style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left" style="width:100%;">
                <h3>
                    Employee Loan Management</a>
                </h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="container">
                            <form id="add_enquiry_form" class="add_enquiry_form" name="add_enquiry_form" method="post" enctype="multipart/form-data" data-parsley-validate>                                
                                <div class="row flex_wrap">
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                        <label>Employee <b class="require">*</b></label>
                                        <select class="form-select form-control chosen-option" name="emp" id="emp">
                                            <option value="" class="">Select Employee</option>
                                            <?php 
                                            if (!empty($salon_employee_list)) {
                                                foreach ($salon_employee_list as $result) { ?>
                                                    <option value="<?= $result->id ?>" <?php if(!empty($single) && $single->employee_id == $result->id){ echo 'selected'; } ?>><?=$result->full_name?></option>
                                            <?php }
                                            } ?>
                                        </select>
                                        <label for="emp" generated="true" style="display:none;" class="error">Please select employee!</label>
                                        <label id="exist_loan_error" generated="true" class="error"></label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                        <label>Loan Amount <b class="require">*</b></label>
                                        <input value="<?php if(!empty($single)){ echo $single->id; } ?>" type="hidden" name="hidden_id" id="hidden_id">
                                        <input value="<?php if(!empty($single)){ echo $single->amount; } ?>" autocomplete="off" type="text" class="form-control" name="amount" id="amount" placeholder="Enter Loan Amount">
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                        <label>Loan Deduction Start From <b class="require">*</b></label>
                                        <input value="<?php if(!empty($single)){ echo date('d-m-Y',strtotime($single->start_deduction_from)); } ?>" autocomplete="off" type="text" class="form-control" name="start_deduction_from" id="start_deduction_from" placeholder="Enter Loan Deduction Start From">
                                    </div>
                                <!-- </div> 
                                <div class="row"> -->
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                        <label style="display:block;">Loan Deduct From Salary? <b class="require">*</b></label>
                                        <input style="height: 25px !important;" type="checkbox" <?php if(!empty($single) && $single->is_deduct_from_salary == '1'){ echo 'checked'; } ?> name="is_deduct_from_salary" id="is_deduct_from_salary" class="dashboardToggle">
                                    </div>
                                    <div class="col-lg-12 col-md-12  col-sm-12 col-xs-12">
                                        <button type="submit" id="submit_enquiry_button" class="btn btn-success" style="margin-top:25px;">Submit</button>
                                    </div>	
                                </div>  
                                <div class="clearfix"></div>
                            </form>
                        </div> 
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="container">
                            <table style="width:100%" id="example" class="table table-striped responsive-utilities jambo_table" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Status</th>
                                        <th>Employee</th>
                                        <th>Loan Amount</th> 
                                        <th>Paid Amount</th> 
                                        <th>Remaining Amount</th> 
                                        <th>Deduction Start From</th> 
                                        <th>Is Deduct From Salary</th> 
                                        <th>Loan Added On</th> 
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                <?php 
                                if(!empty($all_loans)){
                                    $i=1;
                                    foreach($all_loans as $all_loans_result){
                                ?>
                                    <tr>
                                        <td><?=$i++?></td>
                                        <td>
                                            <?php
                                                if($all_loans_result->loan_status == '0'){
                                                    echo '<label class="label label-warning">Active</label>';
                                                }elseif($all_loans_result->loan_status == '1'){
                                                    echo '<label class="label label-danger">Cancelled</label>';
                                                }elseif($all_loans_result->loan_status == '2'){
                                                    echo '<label class="label label-success">Completely Paid (Closed)</label>';
                                                }else{
                                                    echo '-';
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?=$all_loans_result->full_name?>
                                            <br><?=$all_loans_result->whatsapp_number?>
                                            <br><?=$all_loans_result->designation_name?>
                                        </td>
                                        <td><?=$all_loans_result->amount?></td>
                                        <td><?=$all_loans_result->loan_paid_amount?></td>
                                        <td><?=$all_loans_result->loan_remaning_amount?></td>
                                        <td><?= date('d-m-Y',strtotime($all_loans_result->start_deduction_from))?></td>
                                        <td>
                                            <?php
                                                if($all_loans_result->is_deduct_from_salary == '1'){
                                                    echo 'Yes';
                                                }else{
                                                    echo 'No';
                                                }
                                            ?>
                                        </td>
                                        <td><?= date('d M Y h:i A',strtotime($all_loans_result->created_on))?></td>
                                        <td>
                                            <button title="Loan Payments" type="button" onclick="showLoanPaymentsPopup(<?=$all_loans_result->id;?>)" class="btn btn-primary">
                                                <i class="fas fa-receipt"></i>
                                            </button>
                                            <?php if(date('Y-m-d') < date('Y-m-d',strtotime($all_loans_result->start_deduction_from))){ ?>
                                                <a title="Edit" class="btn btn-info" href="<?=base_url()?>employee_loan/<?=$all_loans_result->id;?>"><i class="fas fa-edit"></i></a>
                                            <?php }else{ ?>
                                                <button title="Settle Loan" type="button" onclick="showLoanSettlePopup(<?=$all_loans_result->id;?>)" class="btn btn-success">
                                                    <i class="fas fa-money-bill-wave"></i>
                                                </button>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php }}?>
                                </tbody>
                            </table>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="bookingNoteModal"  tabindex="-1" aria-labelledby="noteModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="margin-top:125px;width:800px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="noteModalLabel" style="display: flex; justify-content: space-between; align-items: center;">
                    <span>Settle Loan</span>
                </h5> 
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;"  onclick="closePopup('bookingNoteModal')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="booking_note_response"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="loanPaymentsModal"  tabindex="-1" aria-labelledby="noteModalPaymentsLabel" aria-hidden="true">
    <div class="modal-dialog" style="margin-top:125px;width:1000px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="noteModalPaymentsLabel" style="display: flex; justify-content: space-between; align-items: center;">
                    <span>Loan Payments</span>
                </h5> 
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;"  onclick="closePopup('loanPaymentsModal')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="emp_loan_payments_response"></div>
        </div>
    </div>
</div>
<div class="loader_div">
    <div  class="loader-new"></div>
</div>
<?php include('footer.php');?>
<script>		
    $(document).ready(function() {
        $("#start_deduction_from").datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
            maxDate: "+1y", 
            minDate: "-0", 
            yearRange: "-0:+1", 
        }); 
        $(".chosen-option").chosen();
        $("#add_enquiry_form").validate({
            ignore: [],
            rules: {
                emp: "required",
                amount: {
                    required: true,
                    number: true,
                    min: 1,
                },
                start_deduction_from: "required"
            },
            messages: {
                emp: "Please select employee!",
                amount: {
                    required: "Please enter loan amount!",
                    number: "Only numbers allowed",
                    min: "Minimum 1 value allowed",
                },
                start_deduction_from: "Please select deduction start date!",
            },
            submitHandler: function(form) {
                if (confirm("Do you want to submit the form?")) {
                    form.submit();
                }
            }
        });
        $('#example').DataTable({ 
            dom: 'Blfrtip',
            responsive: true,
            lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                    
            buttons: [
                            
                {
                    extend: 'excel',
                    filename: 'Employee Loans',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9,10,11] 
                    },
                    customize: function (xlsx) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];
                        $('row c[r^="K"]', sheet).attr('s', '2');
                    }
                }
            ], 
        });
    }); 
    $("#emp").change(function() {
        var emp = $('#emp').val();
        $('#submit_enquiry_button').attr('disabled',false);
        $('#exist_loan_error').text('').hide();
        if (emp != "") {
            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>salon/Ajax_controller/get_customer_exist_loan_ajax",
                data: {
                    'emp': emp, 'id': $('#hidden_id').val()
                },
                success: function(data) {
                    if(data > 0){
                        $('#submit_enquiry_button').attr('disabled',true);
                        $('#exist_loan_error').text('An active loan already exists for the selected employee').show();
                    }else{
                        $('#submit_enquiry_button').attr('disabled',false);
                        $('#exist_loan_error').text('').hide();
                    }                    
                },
            });
        }
    });
    function showLoanSettlePopup(id){
        $.ajax({
            url: "<?= base_url(); ?>salon/Ajax_controller/get_settle_loan_form_ajx",
            method: 'POST',
            data: { loan_id: id },
            success: function(response) {
                $('#booking_note_response').html(response)
                showPopup('bookingNoteModal');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching loan details:', error);
                alert("Error fetching booking details");
            }
        });
    }
    function showLoanPaymentsPopup(id){
        $.ajax({
            url: "<?= base_url(); ?>salon/Ajax_controller/get_loan_payment_ajx",
            method: 'POST',
            data: { loan_id: id },
            success: function(response) {
                $('#emp_loan_payments_response').html(response)
                showPopup('loanPaymentsModal');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching loan details:', error);
                alert("Error fetching booking details");
            }
        });
    }
    function showPopup(id){
        var exampleModal = $('#'+id);
        exampleModal.css('display','block');
        exampleModal.css('opacity','1');
        $('.modal-open').css('overflow','auto').css('padding-right','0px'); 
    }
    function closePopup(id){
        var exampleModal = $('#'+id);

        exampleModal.css('display','none');
        exampleModal.css('opacity','0');
        $('.modal-open').css('overflow','auto').css('padding-right','0px');
    }
</script>
<script>
    $(document).ready(function() {
        $('#reports .child_menu').show();
        $('#reports').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.employee-loan').addClass('active_cc');
    });
</script>