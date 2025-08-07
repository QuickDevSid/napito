<?php include('header.php'); ?>
<link rel="stylesheet" href="<?=base_url();?>salon_assets/css/jquery.comiseo.daterangepicker.css"> 
<style type="text/css">
    td{
        text-align: left !important;
    }
    /* #ui-datepicker-div{
        height:60px !important;
    }
.ui-datepicker-buttonpane .ui-datepicker-current {
        display: none;
    }
    .ui-datepicker-buttonpane .ui-datepicker-close {
        display: none;
    } */
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
    .form-control-option {
        height: 35px;
        width: 590px;
        float: left;
    }
    
   @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap');
   
.content {
  display: none;
  padding: 25px 0px 20px 0px;
  /* max-width: 800px; */
  text-align: center;
}
.content.active {
  display: block;
}
div.dataTables_wrapper div.dataTables_info{
    text-align: left !important;
}
div.dataTables_wrapper div.dataTables_paginate{
    margin-top: 15px !important;
}
.dataTables_length{
    text-align: left !important;
}
.x_title label{
    font-size: 15px;
    color: #0000ff;
    width: 100%;
    display: flex;
    justify-content: center;
    flex-direction: column;
    margin-bottom: 20px;

}
.navtabs{
    margin-bottom: 20px !important;
}
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div>
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Employee Reports
                </h3>
            </div>

            <!-- <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">           
                </div>
            </div> -->
        </div>
        <!-- <div class="clearfix"></div> -->
        <div class="x_panel">
            <div class="x_content">   
                <div class="container">      
                    <div class="navtabs">
                        <div class="<?php if(empty(array_intersect(['employee_salary'], $feature_slugs))) { echo 'blurred '; }?>navtab" id="navtab_1" data-target="salary" onclick="fetchReportData('1')">Salary</div>
                        <div class="<?php if(empty(array_intersect(['employee_attendance'], $feature_slugs))) { echo 'blurred '; }?>navtab" id="navtab_2" data-target="attendance" onclick="fetchReportData('2')">Attendance</div>
                        <div class="<?php if(empty(array_intersect(['employee_performance'], $feature_slugs))) { echo 'blurred '; }?>navtab" id="navtab_3" data-target="performance" onclick="fetchReportData('3')">Performance</div>
                        <div class="<?php if(empty(array_intersect(['employee_target'], $feature_slugs))) { echo 'blurred '; }?>navtab" id="navtab_4" data-target="target" onclick="fetchReportData('4')">Target</div>
                    </div>
                    <form method="get" name="report_filter_form" id="report_filter_form" enctype="multipart/form-data">        
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                <label style="display:block;">Select Month</label>                   
                                <input readonly placeholder="Select Month" class="form-control" id="daterange" name="daterange" value="<?php 
                                    if(isset($_GET['daterange']) && $_GET['daterange'] != ""){
                                        $daterange = $_GET['daterange'];
                                        echo $daterange;                
                                    }else{
                                        echo date('M, Y');                
                                    }
                                ?>">                              
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                <label style="display:block;">Select Employee</label>                   
                                <select class="form-control chosen-select" id="employee" name="employee">   
                                    <option value="">Select Employee</option>
                                    <?php if(!empty($stylists)){ foreach($stylists as $employee_result){ ?>
                                        <option value="<?=$employee_result->id;?>" <?php if(isset($_GET['employee']) && $_GET['employee'] == $employee_result->id){ echo 'selected'; } ?>><?=$employee_result->full_name;?></option>
                                    <?php }} ?>
                                </select>                           
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                <button type="submit" id="submit_button" class="btn btn-primary" style="margin-top:25px;">Submit</button>
                                <?php if(isset($_GET['daterange'])){ ?>
                                    <a href="<?=base_url();?><?=$this->uri->segment(1);?>" class="btn btn-warning reset_btn" style="margin-top:25px;">Reset</a>
                                <?php } ?>
                            </div>
                        </div>
                        <input type="hidden" name="employee_report_type" id="employee_report_type" value="<?php if(isset($_GET['employee_report_type'])){ echo $_GET['employee_report_type']; }?>">
                    </form>
                    <div class="x_title" style="margin-bottom:0px;position:absolute;">                                                 
                        <?php 
                            if(isset($_GET['daterange']) && $_GET['daterange'] != ""){
                                $daterange = $_GET['daterange'];
                                echo '<label style="background-color:#ccc;padding:10px;">Month: '.$daterange.'</label>';  
                                          
                            }
                        ?> 
                    </div>
                    <div class="content navtab_content new-content" id="1_content">  
                        <div class="x_title"> 
                            <label style="font-size: 15px;color: #0000ff; width:100%;">Salary <small>(In INR)</small><small class="error" style="font-size:10px;float:right;">(Note: Select month to get Product and Target Incentive Amounts)</small></label>    
                        </div>
                        <table  id="1_table" class="table table-striped responsive-utilities jambo_table" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Designation</th>
                                    <th>Fixed Payment</th>
                                    <th>Target Incentive</th>
                                    <th>Product Incentive</th>
                                    <th>Total Payment</th>
                                    <th>Salary Slip</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="content navtab_content new-content" id="2_content">  
                        <div class="x_title"> 
                            <label style="font-size: 15px;color: #0000ff; width:100%;">Attendance</label>    
                        </div>
                        <table  id="2_table" class="table table-striped responsive-utilities jambo_table" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Designation</th>
                                    <th>Present</th>
                                    <th>Half Day</th>
                                    <th>Absent</th>
                                    <th>Overtime</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="content navtab_content new-content" id="3_content">  
                        <div class="x_title"> 
                            <label style="font-size: 15px;color: #0000ff; width:100%;">Performance <small>(In INR)</small></label>   
                        </div>
                        <table  id="3_table" class="table table-striped responsive-utilities jambo_table" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Designation</th>
                                    <th>Services Booking <small><i title="Including Service Products" style="font-size: 12px;margin-top: 5px;margin-left: 5px;cursor:pointer;color:#0000ffb0;" class="fas fa-info-circle"></i></small></th>
                                    <th>Products Booking</th>
                                    <th>Memberships Sale</th>
                                    <th>Packages Sale</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="content navtab_content new-content" id="4_content">  
                        <div class="x_title"> 
                            <label style="font-size: 15px;color: #0000ff; width:100%;">Target <small>(In INR)</small><small style="font-size: 11px;float:right;color:black;">(Note: Product booking sale incentive is not considered here)</small></label>    
                        </div>
                        <table  id="4_table" class="table table-striped responsive-utilities jambo_table" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Designation</th>
                                    <th>Start Amount</th>
                                    <th>End Amount</th>
                                    <th>Sale</th>
                                    <th>Target Achieved</th>
                                    <th>Earned Incentive</th>
                                </tr>
                            </thead>
                            <tbody>
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
<div class="loader_div">
<div  class="loader-new"></div>
</div>
<?php include('footer.php');
$id = 0;
if ($this->uri->segment(2) != "") {
    $id = $this->uri->segment(2);
}
if(isset($_GET['daterange']) && $_GET['daterange'] != ""){
    $daterange = $_GET['daterange'];
    $date_parts = explode(', ', $daterange);
    $month = date_parse($date_parts[0])['month'];  // Convert month name to month number
    $year = $date_parts[1];

    $start = date('d-M, Y', strtotime("first day of $date_parts[0] $year"));
    $end = date('d-M, Y', strtotime("last day of $date_parts[0] $year"));
}else{
    $month = date('n');
    $year = date('Y');
    $start = date('d-M, Y', strtotime("first day of $month $year"));
    $end = date('d-M, Y', strtotime("last day of $month $year"));
}
if(isset($_GET['employee_report_type']) && $_GET['employee_report_type'] != ""){
    $employee_report_type = $_GET['employee_report_type'];
}else{
    $employee_report_type = '1';
}
if(isset($_GET['employee']) && $_GET['employee'] != ""){
    $selected_employee = $_GET['employee'];
}else{
    $selected_employee = '';
}

?>
<script src="<?=base_url();?>salon_assets/js/jquery.comiseo.daterangepicker.js"></script>
<script>
    var table;
    var start = '<?php echo $start; ?>';
    var month = '<?php echo $month; ?>';
    var year = '<?php echo $year; ?>';
    var end = '<?php echo $end; ?>';
    var employee_report_type = '<?php echo $employee_report_type; ?>';
    var selected_employee = '<?php echo $selected_employee; ?>';
    $(document).ready(function() {
        $(".chosen-select").chosen();
        $('#report_filter_form').validate({
            ignore: [],
            rules: {
                // employee: 'required',
                daterange: 'required',
            },
            messages: {
                // employee: 'Please select employee!',
                daterange: 'Please select month!',
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
        $("#daterange").datepicker({
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            dateFormat: 'MM, yy',
            maxDate: new Date(),
            onClose: function(dateText, inst) {
                var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                $(this).val($.datepicker.formatDate('MM, yy', new Date(year, month, 1)));
            }
        });

        $("#daterange").focus(function () {
            $(".ui-datepicker-calendar").hide();
            $("#ui-datepicker-div").position({
                my: "center top",
                at: "center bottom",
                of: $(this)
            });
        });
        if(selected_employee != "" || start != "" || end != ""){
            fetchReportData(employee_report_type);
        }
    });
    
    
        function fetchReportData(employee_report_type){
            if (table) {
                table.destroy();
            }
            if(employee_report_type == '1'){
                var report_text = 'Salary';
                var excel_column = [0,1,2,3,4,5,6,7,8];

            $('#redemption_report_content').hide();
            $('#total_sales_report_content').show();
            $('#finance_report_content').hide();
            $('#profit_loss_report_content').hide();
            }else if(employee_report_type == '2'){
                var report_text = 'Attendance';
                var excel_column = [0,1,2,3,4,5,6,7];
            }else if(employee_report_type == '3'){
                var report_text = 'Performance';
                var excel_column = [0,1,2,3,4,5,6,7];
            }else if(employee_report_type == '4'){
                var report_text = 'Target';
                var excel_column = [0,1,2,3,4,5,6,7,8];
            }
            $('#employee_report_type').val(employee_report_type);
            
            $('.navtab').removeClass('active');
            $('#navtab_' + employee_report_type).addClass('active');
            
            $('.navtab_content').removeClass('active');
            $('#' + employee_report_type + '_content').addClass('active');
            $('#' + employee_report_type + '_content').show();

            $('.loader_div').show();
            setTimeout(function() {
                $('#report_text').html(report_text);
                table = $('#'+ employee_report_type + '_table').DataTable({
                    "lengthChange": true, 
                    "lengthMenu": [10, 25, 50, 100, 200],
                    'searching': true,
                    "processing": true,
                    "serverSide": true,
                    "responsive": true,
                    "cache": false,
                    "order": [],
                    "columnDefs": [
                        { "orderable": false, "targets": "_all" }
                    ],
                    buttons:[
                        {
                            extend: "excelHtml5",
                            messageBottom: '',
                            exportOptions: {
                                columns: excel_column,
                                modifier: {
                                    search: 'applied',
                                    order: 'applied'
                                },
                            },
                        }
                    ],
                    dom: "Blfrtip",
                    scrollX: true, // Enable horizontal scrolling
                    scrollCollapse: true,
                    "ajax":{
                        "url" : "<?=base_url();?>salon/Ajax_controller/get_employee_report_data_ajx",
                        "type": "POST",
                        "data": function (d) {
                            d.from_date = start;
                            d.employee_report_type = employee_report_type;
                            d.to_date = end;
                            d.selected_employee = selected_employee;
                            d.selected_month = month;
                            d.selected_year = year;
                        }				
                    },
                    "complete": function() {
                        $('[data-toggle="tooltip"]').tooltip();			
                    }, 
                });
                $('.loader_div').hide();
            }, 1500)
            return false;
        }
</script>
<script>
    $(document).ready(function() {
        $('#reports .child_menu').show();
        $('#reports').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.employee-report').addClass('active_cc');
    });
</script>
