<?php include('header.php');
function get_row($row, $day)
{
    if ($day == 'Mon') {
        $number = 2;
    } else if ($day == 'Tue') {
        $number = 3;
    } else if ($day == 'Wed') {
        $number = 4;
    } else if ($day == 'Thu') {
        $number = 5;
    } else if ($day == 'Fri') {
        $number = 6;
    } else if ($day == 'Sat') {
        $number = 7;
    } else if ($day == 'Sun') {
        $number = 1;
    }
    if ($row == $number) {
        return 1;
    } else {
        return 0;
    }
}
?>
<style type="text/css">
    /* .attendance_div label:nth-child(2) {
        padding-left: 15px;
        font-size: 21px;
        line-height: 47px;
        font-weight: 600;
        color: #3a3a3a;
    } */

    .page-title {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .page-title a {
        all: unset !important;
    }

    .dashboard_list_btn {
        margin-top: -11px !important;
    }

    .input-content-option {
        height: 35px;
        width: 600px;
        border-radius: 5px;
        border: solid gray 1px;
        float: left;
    }

    .calendar_days .days_div {
        width: 14.28%;
        float: left;
        text-align: center;
        border-radius: 0px;
        border: 1px solid #dcdcdc;
        border-collapse: collapse;
        padding: 10px;
        color: #000;
        background: #eee;
    }

    .calender_cell {
        width: 14.28%;
        float: left;
        text-align: center;
        border-radius: 0px;
        border: 1px solid #dcdcdc;
        border-collapse: collapse;
        height: 60px;
        color: #000;
        font-size: 9px;
        padding: 10px 0px !important;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .chosen-container.chosen-with-drop .chosen-drop {
        position: relative !important;
        max-height: 100px;
    }

    .present_mark {
        color: #000 !important;
        font-size: 12px;
        /* padding-top: 5px !important; */
        /* cursor: pointer; */
        background: #cfe1b99e;
        font-weight: 600;
        /* width: 32px; */
    }

    .today_date_mark {
        color: #000 !important;
        font-size: 12px;
        /* padding-top: 5px !important; */
        /* cursor: pointer; */
        background: #3eb7a75c;
        font-weight: 600;
        /* width: 32px; */
    }

    .punch_out_missing_mark {
        color: #000 !important;
        font-size: 12px;
        /* padding-top: 5px !important; */
        /* cursor: pointer; */
        background: #f5d98570;
        font-weight: 600;
        /* width: 32px; */
    }

    .absent_mark {
        color: #000 !important;
        font-size: 12px;
        padding-top: 0px !important;
        padding-bottom: 0px !important;
        /* cursor: pointer; */
        background: #e5819375;
        font-weight: 600;
        /* width: 32px; */
    }

    .leave_mark {
        color: #000 !important;
        font-size: 12px;
        padding-top: 0px !important;
        padding-bottom: 0px !important;
        /* cursor: pointer; */
        background: #f762ac70;
        font-weight: 600;
        /* width: 32px; */
    }

    .half_day_mark {
        color: #000 !important;
        font-size: 12px;
        padding-top: 0px !important;
        padding-bottom: 0px !important;
        /* cursor: pointer; */
        background: #c0dcf3;
        font-weight: 600;
        /* width: 32px; */
    }


    .present_mark_label {
        color: #000 !important;
        font-size: 5px;
        padding-top: 0px !important;
        padding-bottom: 0px !important;
        /* cursor: pointer; */
        background: #cfe1b99e;
        font-weight: 600;
        width: 32px;
    }

    .today_date_mark_label {
        color: #000 !important;
        font-size: 5px;
        padding-top: 0px !important;
        padding-bottom: 0px !important;
        /* cursor: pointer; */
        background: #3eb7a75c;
        font-weight: 600;
        width: 32px;
    }

    .punch_out_missing_mark_label {
        color: #000 !important;
        font-size: 5px;
        padding-top: 0px !important;
        padding-bottom: 0px !important;
        /* cursor: pointer; */
        background: #f5d98570;
        font-weight: 600;
        width: 32px;
    }

    .absent_mark_label {
        color: #000 !important;
        font-size: 5px;
        padding-top: 0px !important;
        padding-bottom: 0px !important;
        /* cursor: pointer; */
        background: #e5819375;
        font-weight: 600;
        width: 32px;
    }

    .leave_mark_label {
        color: #000 !important;
        font-size: 5px;
        padding-top: 0px !important;
        padding-bottom: 0px !important;
        /* cursor: pointer; */
        background: #f762ac70;
        font-weight: 600;
        width: 32px;
    }

    .half_day_mark_label {
        color: #000 !important;
        font-size: 5px;
        padding-top: 0px !important;
        padding-bottom: 0px !important;
        /* cursor: pointer; */
        background: #c0dcf3;
        font-weight: 600;
        width: 32px;
    }

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

    .loader_div {
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
        --d: 22px;
        width: 4px;
        height: 4px;
        border-radius: 50%;
        color: #0056d0;
        box-shadow:
            calc(1*var(--d)) calc(0*var(--d)) 0 0,
            calc(0.707*var(--d)) calc(0.707*var(--d)) 0 1px,
            calc(0*var(--d)) calc(1*var(--d)) 0 2px,
            calc(-0.707*var(--d)) calc(0.707*var(--d)) 0 3px,
            calc(-1*var(--d)) calc(0*var(--d)) 0 4px,
            calc(-0.707*var(--d)) calc(-0.707*var(--d))0 5px,
            calc(0*var(--d)) calc(-1*var(--d)) 0 6px;
        animation: l27 1s infinite steps(8);
    }

    @keyframes l27 {
        100% {
            transform: rotate(1turn)
        }
    }

    .attendance {
        margin-top: 15px;
        padding: 0;
    }

    .attendance_div {
        /* background-color: #ededed; */
        border-radius: 6px;
        border: 1px solid;
        margin-bottom: 15px;
        height: 95px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .attendance_div label {
        padding-left: 15px;
    }

    .attendance_div label:first-child {
        font-weight: normal;
    }

    .employee_attendance_inner .attendance-shortname-list {
        text-align: left;
    }

    .attendance-shortname-list {
        padding: 0px;
        text-align: center;
    }

    .employee_attendance_inner .attendance-shortname-list li {
        padding: 13px 15px !important;
        font-size: 10px;

        display: block;
        width: auto;
        margin-bottom: 5px;
    }

    .attendance-shortname-list li {
        /* display: inline-block; */
        padding-left: 10px;
        padding-right: 10px;
        color: #405189;
        font-weight: 600;
    }
</style>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left" style="width:100%;">
                <h3>
                    Employee Attendance
                    <div style="float:right;" class="btn btn-primary dashboard_list_btn">
                        <a class="add_new_booking" href="<?= base_url(); ?>salon-attendance-list">List View</a>
                    </div>
                </h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="container">
                            <form name="staff_form" id="staff_form" method="get">
                                <div class="container animated fadeInRight">
                                    <div class="">
                                        <div class="row top-section">
                                            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <label>Select Employee <b class="require">*</b></label>
                                                <select class="form-control get_attendance" name="employee" id="employee">
                                                    <option value="">Select Employee</option>
                                                    <?php if(!empty($employee)){ 
                                                        foreach($employee as $employee_result){?>
                                                        <option value="<?=$employee_result->id?>" <?php if(isset($_GET['employee']) && $_GET['employee'] == $employee_result->id){?>selected="selected"<?php }?>><?=$employee_result->full_name?></option>
                                                    <?php }}?>
                                                </select>
                                                <label for="employee" style="display:none;" generated="true" class="error">Please select employee!</label>
                                            </div> 
                                            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <label for="month">Month <b class="require">*</b> </label>
                                                <select id="month" name="month" class="form-control info_input get_attendance">
                                                    <option value="">Select Month</option>
                                                    <?php
                                                        for ($i = 1; $i <= 12; $i++) { 
                                                            $month = date('F', mktime(0, 0, 0, $i, 1));
                                                    ?>
                                                            <option value="<?= $i; ?>" <?php if(isset($_GET['month'])){ if($_GET['month'] == $i){?>selected="selected"<?php }}else{ if($i == date('m')){ echo 'selected'; }} ?>>
                                                                <?= $month; ?>
                                                            </option>
                                                    <?php 
                                                        } 
                                                    ?>
                                                </select>
                                                <label for="month" style="display:none;" generated="true" class="error">Please select month!</label>
                                            </div>
                                            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <label for="year">Year <b class="require">*</b> </label>
                                                <select id="year" name="year" class="form-control info_input get_attendance">
                                                    <option value="">Select Year</option>
                                                    <?php 
                                                    $current_year = date('Y');
                                                    for ($i = $current_year; $i >= $current_year - 10; $i--) { 
                                                        ?>
                                                        <option value="<?= $i; ?>" <?php if(isset($_GET['year']) && $_GET['year'] == $i){ ?>selected="selected" <?php }else{ if($i == date('Y')){ echo 'selected'; }} ?>>
                                                            <?= $i; ?>
                                                        </option>
                                                        <?php 
                                                    } 
                                                    ?>
                                                </select>
                                                <label for="year" style="display:none;" generated="true" class="error">Please select year!</label>
                                            </div>
                                            <div class="submit_attendence form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <!-- <button style="padding: 10px 30px;margin-top: 2px;" class="btn btn-primary" id="search_staff">Submit</button> -->
                                                <?php if (isset($_GET['employee']) || isset($_GET['month']) || isset($_GET['year'])) { ?>
                                                    <a href="<?= base_url(); ?><?= $this->uri->segment(1); ?>" class="btn btn-warning" style="margin-top: 1px;">Reset</a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div> 
                        <?php
                            if(isset($_GET['employee']) && $_GET['employee'] != "" && isset($_GET['month']) && $_GET['month'] != "" && isset($_GET['year']) && $_GET['year'] != ""){
                                $employee_id = $_GET['employee'];
                                $month = $_GET['month'];
                                $year = $_GET['year'];
                                $emp_month_attendance = $this->Salon_model->get_employee_single_attendance_monthwise($employee_id,$month,$year);
                        ?>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">
                                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-xs-12 ">
                                        <div class="attendance_div">
                                            <label>Present</label>
                                            <label><?=$emp_month_attendance['present'];?></label>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                        <div class="attendance_div">
                                            <label>Half Day</label>
                                            <label><?=$emp_month_attendance['half_days'];?></label>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                        <div class="attendance_div">
                                            <label>Leave</label>
                                            <label><?=$emp_month_attendance['total_leave_days'];?></label>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                        <div class="attendance_div">
                                            <label>Month Sale <small>(In INR)</small></label>
                                            <label><?=number_format($emp_month_attendance['month_sale'], 2, '.', ',');?></label>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                        <div class="attendance_div">
                                            <label>Absent</label>
                                            <label><?=$emp_month_attendance['absent'];?></label>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                        <div class="attendance_div">
                                            <label>Overtime</label>
                                            <label><?=$emp_month_attendance['total_ot'];?></label>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                        <div class="attendance_div">
                                            <label>Target <small>(In INR)</small></label>
                                            <label><?=!empty($emp_month_attendance['month_target']) ? number_format($emp_month_attendance['month_target']->start_amount, 2, '.', ',').' to '.number_format($emp_month_attendance['month_target']->end_amount, 2, '.', ',') : '-';?></label>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                        <div class="attendance_div">
                                            <label>Daily Target <small>(In INR)</small></label>
                                            <label><?=!empty($emp_month_attendance['month_target']) ? number_format($emp_month_attendance['daily_target_min'], 2, '.', ',').' to '.number_format($emp_month_attendance['daily_target_max'], 2, '.', ',') : '-';?></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">
                                    <div class="employee_attendance_inner">
                                        <ul class="attendance-shortname-list">
											<li class="label present_mark_label">P - Present</li>
											<li class="label half_day_mark_label">HD - Half Day</li>
											<li class="label absent_mark_label">A - Absent</li>
											<li class="label leave_mark_label">L - Leave</li>
											<li class="label punch_out_missing_mark_label">P - Punch Out Missing</li>
									   </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 attendance">
                                <div class="" id="calendar">
                                    <div class="calendar_days" >
                                        <div class="days_div">
                                            Sun.
                                        </div>
                                        <div class="days_div">
                                            Mon.
                                        </div>
                                        <div class="days_div">
                                            Tue.
                                        </div>
                                        <div class="days_div">
                                            Wed.
                                        </div>
                                        <div class="days_div">
                                            Thu.
                                        </div>
                                        <div class="days_div">
                                            Fri.
                                        </div>
                                        <div class="days_div">
                                            Sat.
                                        </div>
                                    </div>
                                    <?php 
                                        $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                                        $a = 1;
                                        $date = $year.'/'.$month.'/'.$a; //format date
                                        $get_name = date('l', strtotime($date)); //get week day
                                        $day_name = substr($get_name, 0, 3);
                                        $check = get_row($a,$day_name);
                                        
                                        while($check == 0){                                            
                                            $a++;
                                            $check = get_row($a,$day_name);
                                        ?>
                                        <div class="calender_cell present_attendance" >
                                            <div class="date">
                                                &nbsp;
                                            </div>
                                            <div class="day">
                                                &nbsp;
                                            </div>
                                        </div> 
                                    <?php }?>
                                    <?php for($i = 1;$i <= $days;$i++){
                                            $single_date = $year.'/'.$month.'/'.$i; //format date
                                            $attendance = $this->Salon_model->get_employee_single_attendance_details($employee_id,$single_date); 
                                        ?>
                                            <div class="calender_cell present_attendance <?php
                                                                                        if(!empty($attendance['result'])){ 
                                                                                            if($attendance['result']->attendence_type == "0" || $attendance['result']->attendence_type == ""){
                                                                                                echo 'punch_out_missing_mark';
                                                                                            }elseif($attendance['result']->attendence_type == "1"){
                                                                                                if($attendance['result']->punch_out == "" || $attendance['result']->punch_out == null || $attendance['result']->punch_out == "00:00:00"){
                                                                                                    echo 'punch_out_missing_mark'; 
                                                                                                }else{
                                                                                                    echo 'present_mark'; 
                                                                                                }
                                                                                            }elseif($attendance['result']->attendence_type == "3" || $attendance['result']->attendence_type == "4"){ 
                                                                                                echo 'half_day_mark'; 
                                                                                            }
                                                                                        }else{ 
                                                                                            if($attendance['is_on_leave'] == '1'){
                                                                                                echo 'leave_mark'; 
                                                                                            }else{
                                                                                                if(date('Y-m-d',strtotime($single_date)) < date('Y-m-d')){
                                                                                                    echo 'absent_mark'; 
                                                                                                }elseif(date('Y-m-d',strtotime($single_date)) == date('Y-m-d')){
                                                                                                    echo 'today_date_mark';
                                                                                                }
                                                                                            }
                                                                                        } 
                                                                                    ?>" onclick="getAttendanceDetails('<?=$employee_id;?>','<?=$single_date;?>');">
                                                <div class="date">
                                                    <?=$i?>
                                                </div>
                                                <div class="late_mark">
                                                    <?php 
                                                        if(!empty($attendance['result'])){ 
                                                            if($attendance['result']->attendence_type == "0" || $attendance['result']->attendence_type == ""){
                                                                echo '-';
                                                                echo '<br><small class="shift_timer"></small>'; 
                                                            }elseif($attendance['result']->attendence_type == "1"){
                                                                echo 'P'; 
                                                                echo '<br><small class="shift_timer">'.$attendance['result']->working_hrs.'</small>'; 
                                                            }elseif($attendance['result']->attendence_type == "3"){
                                                                echo '1/HD'; 
                                                                echo '<br><small class="shift_timer">'.$attendance['result']->working_hrs.'</small>'; 
                                                            }elseif($attendance['result']->attendence_type == "4"){
                                                                echo '2/HD'; 
                                                                echo '<br><small class="shift_timer">'.$attendance['result']->working_hrs.'</small>'; 
                                                            }
                                                        }else{ 
                                                            if($attendance['is_on_leave'] == '1'){
                                                                echo 'L';
                                                                echo '<br><small class="shift_timer"></small>'; 
                                                            }else{
                                                                if(date('Y-m-d',strtotime($single_date)) < date('Y-m-d')){
                                                                    echo 'A';
                                                                    echo '<br><small class="shift_timer"></small>'; 
                                                                }else{
                                                                    echo '-';
                                                                    echo '<br><small class="shift_timer"></small>'; 
                                                                }
                                                            }
                                                        } 
                                                    ?>
                                                </div>
                                            </div> 
                                        <?php } ?>
                            </div>
                            <div class="clearfix"></div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="attendance_modal" tabindex="-1" aria-labelledby="EditModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">              
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;"  onclick="closePopup('attendance_modal')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="response"></div>
        </div>
    </div>
</div>
<div class="loader_div">
    <div  class="loader-new"></div>
</div>
<?php include('footer.php');?>
<script>		
    $(document).ready(function() {
        $("#staff_form").validate({
            ignore: [],
            rules: {
                employee: "required",
                month: "required",
                year: "required",
            },
            messages: {
                employee: "Please select employee!",
                month: "Please select month!",
                year: "Please select year!",
            },
        });
    }); 
    function getAttendanceDetails(emp,date){
        $('.loader_div').show();   
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>salon/Ajax_controller/get_employee_attendance_ajx",
            data: { 'staff_id': emp, 'date': date },
            success: function (data) {
                $('#response').html(data)
                showPopup('attendance_modal');
                $('.loader_div').hide();   
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
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
    function setPunchIn(staff,date,shift){
        $('.loader_div').show();   
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>salon/Ajax_controller/set_employee_punch_in_ajx",
            data: { 'staff_id': staff, 'date': date, 'shift': shift },
            success: function (data) {
                $('.loader_div').hide();  
                getAttendanceDetails(staff,date);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }
    function setPunchOut(staff,date,shift){
        $('.loader_div').show();   
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>salon/Ajax_controller/set_employee_punch_out_ajx",
            data: { 'staff_id': staff, 'date': date, 'shift': shift },
            success: function (data) {
                $('.loader_div').hide();  
                getAttendanceDetails(staff,date); 
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }
    var elements = document.getElementsByClassName('get_attendance');
    for (var i = 0; i < elements.length; i++) {
        elements[i].addEventListener('change', function() {
            document.getElementById('staff_form').submit();
        });
    }
</script>
<script>
    $(document).ready(function() {
        $('#attendance .child_menu').show();
        $('#attendance').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.staff_attendance').addClass('active_cc');
    });
</script>