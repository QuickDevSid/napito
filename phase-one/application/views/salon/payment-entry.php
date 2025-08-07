<?php include('header.php'); ?>
<style type="text/css">
    .input-content-option {
        height: 35px;
        width: 590px;

    }
</style>
<!-- page content -->
    <div class="right_col" role="main">
        <div class="title_left">
            <h3>Make Payment</h3>
        </div>
        <div class="clearfix"></div>
        <div class="x_panel">
            <div class="x_content">
                <div class="container">
                    <form method="post" name="employee_form" id="employee_form" enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                <label>Select Student <b class="require">*</b></label>
                                <div class="select-wrapper">
                                    <select class="form-select form-control chosen-select" name="student_name" id="student_name">
                                        <option value="">Select</option>
                                        <?php if (!empty($student_list)) {
                                            foreach ($student_list as $student_list_result) { ?>
                                                <option value="<?= $student_list_result->id ?>" <?php if (!empty($single) && $single->student_name == $student_list_result->id) { ?>selected="selected" <?php } ?>>
                                                    <?= $student_list_result->student_name?> - <?= $student_list_result->phone?>
                                                </option>
                                        <?php }
                                        } ?>
                                        <input type="hidden" class="form-control" name="id" id="id" value="<?php if (!empty($single)) {echo $single->id;} ?>" placeholder="Enter course name">
                                        <input type="hidden" class="form-control" name="payment_id" id="payment_id" value="<?php if (!empty($single)) {echo $single->id;} ?>" placeholder="Enter course name">
                                        
                                    </select>
                                    <div class="arrow-down"></div>
                                </div>
                            </div>
                        

                            
                            <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                <label class="col-md-12 col-xs-12">Select Course Name <b class="require">*</b></label>
                                <select class="form-select form-control chosen-select" name="course_name" id="course_name">
                                    <option value="">Select</option>
                                    <?php 
                                    if (!empty($course_name)) {
                                        foreach ($course_name as $course_name_result) { 
                                    ?>
                                    <option value="<?= $course_name_result->id ?>">
                                        <?= $course_name_result->course_name ?>
                                    </option>
                                    <?php }}?>
                                </select>
                                <!-- <input type="hidden" id="payment_entry_id" name="payment_entry_id"> -->
                            </div>

                            <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                <label>Total Fees<b class="require">*</b></label>
                                <input type="text" class="form-control" readonly name="total_fees" id="total_fees" value="<?php if (!empty($single)) { echo $single->total_fees; } ?>" placeholder="Enter total paid fees">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4 col-sm-6 col-xs-12" style="margin-top: 5px;">
                                <label>Total Paid Fees <b class="require">*</b></label>
                                <input type="text" class="form-control" readonly name="total_paid_fees" id="total_paid_fees" value="<?php if (!empty($single)) { echo $single->total_paid_fees; }else{ echo "0";} ?>" placeholder="Enter total paid fees">
                                <input type="hidden" class="form-control" readonly name="old_total_paid_fees" id="old_total_paid_fees" value="<?php if (!empty($single)) { echo $single->total_paid_fees; }else{ echo "0";} ?>" placeholder="Enter total paid fees">
                            </div>
                            <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                <label>Total Pending Fees <b class="require">*</b></label>
                                <input type="text" class="form-control" readonly name="total_pending_fees" id="total_pending_fees" value="<?php if (!empty($single)) { echo $single->total_pending_fees;}else{ echo "0";} ?>" placeholder="Enter total pending fees">
                                <input type="hidden" class="form-control" readonly name="old_total_pending_fees" id="old_total_pending_fees" value="<?php if (!empty($single)) { echo $single->total_pending_fees;} ?>">
                            </div>
                            <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                <label>Amount to Paid <b class="require">*</b></label>
                                <input type="text" class="form-control" name="amount_to_paid" id="amount_to_paid" value="" placeholder="Enter amount to paid">
                                <div class="error" id="amount_to_paid_error"></div>
                                <div class="error" id="greater_amount_paid_error"></div>
                            </div>
                        </div>
                        <div class="row">   
                            <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                <label>Payment Date <b class="require">*</b></label>
                                <input type="text" readonly class="form-control" name="date" id="date" value="<?php if (!empty($single)) {echo $single->date;} ?>" placeholder="DD-MM-YYYY">
                            </div>
                            <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                <label>Select Payment Mode <b class="require">*</b></label>
                                <select class="form-select form-control chosen-select" name="payment_mode" id="payment_mode" onchange="setTransactionID()">
                                    <option value="">Select Payment Mode</option>
                                    <option value="1" <?php if ((!empty($single) && $single->payment_mode == 1)) echo 'selected="selected"'; ?>>UPI</option>
                                    <option value="2" <?php if ((!empty($single) && $single->payment_mode == 2)) echo 'selected="selected"'; ?>>Cash</option>
                                    <option value="3" <?php if ((!empty($single) && $single->payment_mode == 3)) echo 'selected="selected"'; ?>>Cheque</option>
                                    <option value="4" <?php if ((!empty($single) && $single->payment_mode == 4)) echo 'selected="selected"'; ?>>Online</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                <label>Transaction ID</label>
                                <input readonly type="text" placeholder="Enter Transaction ID" class="form-control" name="transaction_id" id="transaction_id" value="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                <label>Attachment File</label>
                                <input type="file" class="form-control" name="attachment_file" id="attachment_file" value="<?php if (!empty($single)) {echo $single->attachment_file;} ?>" placeholder="Enter attachment_file code">
                            </div>
                            <div class="form-group col-md-8 col-sm-6 col-xs-12">
                                <label>Remark </label>
                                <input type="text" class="form-control" name="remark" id="remark" value="<?php if (!empty($single)) {echo $single->remark;} ?>" placeholder="Enter Remark">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4 col-sm-6 col-xs-12" style="float: left; margin-top: 50px;">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form> 
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
            function setTransactionID(){
                payment_mode = $('#payment_mode').val();
                if(payment_mode == '2'){
                    $('#transaction_id').attr('readonly', true);
                }else{
                    $('#transaction_id').attr('readonly', false);
                }
            }
    $("#date").datepicker({
        dateFormat: "dd-mm-yy",
        changeMonth: true,
        changeYear: true,
        minDate: "-80Y",
        beforeShowDay: function(date) {
            var today = new Date();
            today.setHours(0, 0, 0, 0); // Ensure the time part is zero for accurate comparison
            return [date.getTime() === today.getTime(), "", date.getTime() === today.getTime() ? "Today" : ""];
        }
    });
    $(document).ready(function() {
        $.validator.addMethod("positiveNumber", function(value, element) {
            return this.optional(element) || (parseFloat(value) >= 0);
        }, "Please enter a positive number.");

        $('#employee_form').validate({
            // ignore: "",
            ignore: ":hidden:not(select)",
            rules: {
                student_name: 'required',
                course_name: 'required',
                total_fees:{
                    required:true,
                    positiveNumber:true,
                },
                // total_paid_fees: {
                //     required:true,
                //     positiveNumber:true,
                // },
                total_pending_fees: {
                    required:true,
                    positiveNumber:true,
                },
                amount_to_paid: {
                    required:true,
                    positiveNumber:true,
                },
                date: 'required',
                payment_mode: 'required',
                // remark: 'required',
                // attachment_file: 'required',


            },
            messages: {
                student_name: "Please enter student name!",
                course_name: "Please enter course name!",
                total_fees: {
                    required:"Please enter total fees!",
                    positiveNumber:"Please enter positive total fees!",
                },
                // total_paid_fees: {
                //     required:"Please enter total paid fees!",
                //     positiveNumber:"Please enter positive total paid fees!",
                // }, 
                total_pending_fees:{
                    required:'Please enter pending fees!',
                    positiveNumber:"Please enter positive pending fees!",
                }, 
                amount_to_paid: {
                    required:'Please enter amount to paid!',
                    positiveNumber:"Please enter positive paid amount!",
                },
                date: 'Please enter date!',
                payment_mode: 'Please enter payment mode!',
                // remark: 'Please enter remark!',
                // attachment_file: 'Please upload file',
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
    });

    $('#student_name').on('change', function() {
        $('#student_name').valid();
    });

    $('#payment_mode').on('change', function() {
        $('#payment_mode').valid();
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $(".chosen-select").chosen({
             
        });
    });
</script>



<script>
//    $("#amount_to_paid").keyup(function() {
//     alert($('#amount_to_paid').val());
//     var total_fees = parseFloat($('#total_fees').val());
//     var total_pending_fees = parseFloat($('#total_pending_fees').val());
//     var amount_to_paid = parseFloat($('#amount_to_paid').val());
//     if (isNaN(total_fees) || isNaN(amount_to_paid)) {
//         return;
//     }
//     if (amount_to_paid > total_fees) {
//         // alert();
//         $("#amount_to_paid_error").html('Amount should not be greater than total fees');
//     } else {
//         $('#total_pending_fees').val(total_pending_fees - amount_to_paid);
//         $('#total_paid_fees').val(amount_to_paid);
//         $("#amount_to_paid_error").html('');
//     }
// });


$(document).ready(function() {
    $("#amount_to_paid").keyup(function() {
        var total_fees = parseFloat($('#total_fees').val());
        var total_pending_fees = parseFloat($('#old_total_pending_fees').val());
        var total_paid_fees = parseFloat($('#old_total_paid_fees').val());
        var amount_to_paid = parseFloat($('#amount_to_paid').val());
        if (isNaN(amount_to_paid)) {
            amount_to_paid = 0; // Default to 0 if input is blank
        }

        // if (isNaN(total_fees) || isNaN(amount_to_paid) || amount_to_paid < '0') {
        //     $("#amount_to_paid_error").html('Please enter a valid amount');
        //     return;
        // }
        if(amount_to_paid > total_fees) {
            $("#amount_to_paid_error").html('Amount should not be greater than total fees');
        }else if(total_pending_fees != "" && amount_to_paid > total_pending_fees){
            $("#amount_to_paid_error").html('Amount should not be greater than total pending fees');
        }else {
            if(total_pending_fees != '' || total_pending_fees != '0'){
                var pending_fee = total_pending_fees - amount_to_paid;
                var new_pending_fees = pending_fee;
              
            }else{
                var pending_fee = total_fees - amount_to_paid;
                var new_pending_fees = pending_fee;
            }
    
            var new_paid_fees = amount_to_paid;
            // console.log(new_pending_fees);
            
        // alert(new_paid_fees);
            $('#total_pending_fees').val(new_pending_fees);
            // $('#total_paid_fees').val(new_paid_fees);
            $("#amount_to_paid_error").html('');
        }
    });
});


    $("#student_name").change(function() {
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>salon/Ajax_controller/get_course_fees",
            data: {
                'course_name_id': $('#student_name').val(),
                'student_name':<?=$id?>
            },
            success: function(res) {
                console.log(res);
               
                $('#course_name').empty();
                $('#course_name').append('<option value="">Select</option>');
                data = JSON.parse(res);
                var uniqueValues = {};
                $.each(data, function(i, d) {
                    if (!uniqueValues[d.master_course_name]) {
                            uniqueValues[d.master_course_name] = true;
                    $('#course_name').append('<option value="' + d.course_name+'@@@'+d.id + '">' + d.master_course_name + '</option>');
                    }
                });
                $('#course_name').trigger('chosen:updated');

                // $("#total_fees").val(data.fees_amount);
                // $("#course_name").val(data.course_name);
                // $("#payment_entry_id").val(data.payment_entry_id);
                // if (data.total_paid_fees == null && data.total_pending_fees == null) {
                //     $("#total_paid_fees").val('0');
                //     $("#total_pending_fees").val(data.fees_amount);
                // } else {
                //     $("#total_paid_fees").val('');
                //     $("#total_pending_fees").val('');
                // }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });

        $("#course_name").change(function() {
            $.ajax({
                type: "POST",
                url: "<?=base_url();?>salon/Ajax_controller/get_total_fees_ajax",
                data: { 'course_name_id': $('#course_name').val() },
                success: function(data) {
                    // console.log(data);
                    var parsedData = JSON.parse(data);
                  
                    $("#total_fees").val(parsedData.total_fees);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        
                var courseValue = $('#course_name').val();
                var courseId = courseValue.split('@@@')[0]; 
                var studentId = $('#student_name').val();
            $.ajax({
                type: "POST",
                url: "<?=base_url();?>salon/Ajax_controller/get_fees_data_ajax",
                data: { 'course_name_id': courseId,
                        'student_id' :studentId,
                },
                success: function(data) {
                    console.log(data);
                    var parsedData = JSON.parse(data);
                    // $("#total_fees").val(parsedData.total_fees);
                    $("#total_paid_fees").val(parsedData.total_paid_fees);
                    $("#old_total_paid_fees").val(parsedData.total_paid_fees);
                    $("#total_pending_fees").val(parsedData.total_pending_fees);  
                    $("#old_total_pending_fees").val(parsedData.total_pending_fees);   
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });

    });
</script>
<script>
    $(document).ready(function() {
        $('#back-office .child_menu').show();
        $('#back-office').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.payment_entry').addClass('active_cc');
    });
</script>
<script>
    $(document).ready(function() {
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); 
        var yyyy = today.getFullYear();
        today = dd + '-' + mm + '-' + yyyy;
        $('#date').val(today);
    });
</script>

<script>
    $("#student_name").keyup(function(){   
	$.ajax({ 
		type: "POST", 
		url: "<?=base_url()?>salon/Ajax_controller/get_student_payment_ajax", 
		data:{'student_name':$("#student_name").val()},
		success: function(data){ 
			var opts = $.parseJSON(data);
			if(opts){
				console.log(opts);
                $("#payment_id").val(opts.id);
			}else{
                $("#payment_id").val('');
			} 
		}, 
		error: function(jqXHR, textStatus, errorThrown) { 
		   console.log(textStatus, errorThrown); 
		}
	});	 
}); 
</script>