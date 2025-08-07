<?php include('header.php'); ?>
<style type="text/css">
    .punch_details {
        background: #eee;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 15px 15px;
        margin: 0 0 20px;
    }
    .punch-info {
        margin: 0 0 20px;
    }
    .punch-btn-section {
        text-align: center;
        margin: 0 0 20px;
    }
    .statistics {
        height: 130px;
    }
    .punch_details h3 {
        color: #727272;
        font-size: 14px;
        margin: 0;
    }

    .shift_name_heading {
        margin-top: 8px !important;
        color: #000 !important;
    }
    

    .punch-info .punch-hours {
        background-color: #f9f9f9;
        border: 5px solid var(--hover);
        font-size: 18px;
        height: 120px;
        width: 120px;
        margin: 0 auto;
        border-radius: 50%;
        padding: 40px 10px;
        text-align: center;
    }
    .spend_hours {
        color: #405189;
    }
    .punch-btn-section .punch-btn {
        font-size: 18px;
        font-weight: 600;
        max-width: 100%;
        padding: 8px 40px;
        border-radius: 50px;
    }
    .stats-box {
        background-color: #f9f9f9;
        border: 1px solid #e3e3e3;
        margin: 0 0 15px;
        padding: 5px;
        color: black;
    }
    
    .loader_div{
        display: none;
        position: fixed;
        width: 100%;
        height: 100% !important;
        background: #00000042;
        z-index: 999999;
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
</style>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left" style="width:100%;">
                <h3>
                    Mark Employee Attendance 
                </h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="container">
                            <form name="staff_form" id="staff_form" method="post" action="<?=base_url();?>set-attendance">
                                <div class="container animated fadeInRight">
                                    <div class="">
                                        <div class="row top-section">
                                            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <label>Select Employee <b class="require">*</b></label>
                                                <select class="form-control chosen-option" name="staff_id" id="staff_id" onchange="getPunchInOutForm()">
                                                    <option value="">Select Employee</option>
                                                    <?php if(!empty($employee)){ 
                                                        foreach($employee as $employee_result){?>
                                                        <option value="<?=$employee_result->id?>"><?=$employee_result->full_name?> <?=$employee_result->designation_name != "" ? ' [' . $employee_result->designation_name . ']' : ''; ?></option>
                                                    <?php }}?>
                                                </select>
                                                <label for="employee" style="display:none;" generated="true" class="error">Please select employee!</label>
                                            </div>                     
                                            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <label for="fullname">Date <b class="require">*</b></label>
                                                <input type="text" readonly class="form-control custom_date" placeholder="Select Date" name="date" id="date" value="<?php echo date('d-m-Y'); ?>">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="response">

                                            </div>
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
</div>
<div class="loader_div">
    <div  class="loader-new"></div>
</div>
<?php include('footer.php');?>
<script>		
    $(document).ready(function() {
        $(".chosen-option").chosen();
        $( ".custom_date" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "dd-mm-yy",
            minDate: 0,
            maxDate: 0
        });
        $("#staff_form").validate({
            ignore: [],
            rules: {
                staff_id: "required",
                date: "required",
            },
            messages: {
                staff_id: "Please select employee!",
                date: "Please select date!",
            },
            submitHandler: function(form) {
                if (confirm("Do you want to submit the form?")) {
                    form.submit();
                }
            }
        });
    }); 
    function getPunchInOutForm(){
        var emp = $('#staff_id').val();
        var date = $('#date').val();
        $('#response').html('');
        if(emp != "" && date != ""){
            $('.loader_div').show();
            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>salon/Ajax_controller/get_employee_attendance_form_ajx",
                data: { 'staff_id': emp, 'date': date },
                success: function (data) {
                    $('#response').html(data);
                    $('.loader_div').hide();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }
    }
</script>
<script>
    $(document).ready(function() {
        $('#attendance .child_menu').show();
        $('#attendance').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.attendance_list').addClass('active_cc');
    });
</script>