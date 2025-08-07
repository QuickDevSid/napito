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
                    Whatsapp Notifications Reports
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
                        <div class="<?php if(empty(array_intersect(['employee_salary'], $feature_slugs))) { echo 'blurred '; }?>navtab" id="coins_report" data-target="coins" onclick="setReport('1')">Coins Usage</div>
                        <div class="<?php if(empty(array_intersect(['employee_attendance'], $feature_slugs))) { echo 'blurred '; }?>navtab" id="payments_report" data-target="payments" onclick="setReport('2')">Payments</div>
                    </div>
                    <div class="navtabs">
                        <div class="navtab filter_navtab active" id="navtab_1" data-target="all_customer" onclick="fetchReportData('1')">Today</div>
                        <div class="navtab filter_navtab" id="navtab_2" data-target="new_customer" onclick="fetchReportData('2')">Yesterday</div>
                        <div class="navtab filter_navtab" id="navtab_3" data-target="recently_not_visited" onclick="fetchReportData('3')">This Week</div>
                        <div class="navtab filter_navtab" id="navtab_4" data-target="without_booking" onclick="fetchReportData('4')">This Month</div>
                        <div class="navtab filter_navtab" id="navtab_5" data-target="premium_customer" onclick="fetchReportData('5')">Last Month</div>
                        <div class="navtab filter_navtab" id="navtab_6" data-target="normal_customer" onclick="showForm()">Custom</div>
                    </div>
                    <form method="get" name="report_filter_form" id="report_filter_form" enctype="multipart/form-data" style="display:none;">        
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                <label style="display:block;">Select Date</label>                   
                                <input class="form-control" id="custom_daterange" name="custom_daterange" value="<?php 
                                    if(isset($_GET['custom_daterange']) && $_GET['custom_daterange'] != ""){
                                        echo $_GET['custom_daterange'];                
                                    }
                                ?>">                              
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                <button type="submit" id="submit_button" class="btn btn-primary" style="margin-top:25px;">Submit</button>
                                <?php if(isset($_GET['custom_daterange'])){ ?>
                                    <a href="<?=base_url();?><?=$this->uri->segment(1);?>" class="btn btn-warning reset_btn" style="margin-top:25px;">Reset</a>
                                <?php } ?>
                            </div>
                        </div>
                        <input type="hidden" name="whatsapp_report_type" id="whatsapp_report_type" value="<?php if(isset($_GET['whatsapp_report_type'])){ echo $_GET['whatsapp_report_type']; }?>">
                        <input type="hidden" name="whatsapp_report_filter_type" id="whatsapp_report_filter_type" value="<?php if(isset($_GET['whatsapp_report_filter_type'])){ echo $_GET['whatsapp_report_filter_type']; }?>">
                    </form>
                    <div>
                        <label id="custom_date_label"></label>
                    </div>
                    <div class="content navtab_content new-content" id="coins_report_content">  
                        <div class="x_title"> 
                            <div class="row coin_sec_header"> 
                                <div class="col-lg-4 col-md-4 col-sm-8 col-xs-12  des_div"> 
                                    <label class="page-title " style="font-size: 15px;color: #0000ff; width:100%;float:left;">

                                    </label>     
                                </div>    
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 coin_div"> 
                                    <label class="page-title " style="font-size: 15px;color: #0000ff; width:100%;">
                                        Coins Usage History
                                    </label>    
                                </div>    
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 float_div">    
                                    <label class="page-title d-block ms-auto" style="font-size: 15px;color: #0000ff; width:max-content;">
                                        <button type="button"  class="btn btn-primary floating_btn">Current Balance: <?=$profile->current_wp_coins_balance != "" ? (int)$profile->current_wp_coins_balance : 0;?></button> 
                                    </label>  
                                </div> 
                            </div> 
                        </div>
                        <table id="1_table" class="table table-striped responsive-utilities jambo_table" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Message Type</th>
                                    <th>Customer</th>
                                    <th>Message</th>
                                    <th>Sent On</th>
                                    <th>Coins Opening<br>Balance</th>
                                    <th>Coins Used</th>
                                    <th>Coins Closing<br>Balance</th>
                                    <th>Message Delivery<br>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="content navtab_content new-content" id="payments_report_content">  
                        <div class="x_title"> 
                            <label style="font-size: 15px;color: #0000ff; width:100%;">Payments</label>    
                        </div>
                        <table id="2_table" class="table table-striped responsive-utilities jambo_table" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Details</th>
                                    <th>Amount</th>
                                    <th>Payment Date</th>
                                    <th>Receipt</th>
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
<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true" >
    <div class="modal-dialog" style="">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="messageModalLabel" style="display: flex; justify-content: space-between; align-items: center;">
                    <span>Message</span>
                </h5>                
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;"  onclick="closePopup('messageModal')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="message_response">
                <p id="message_show_here"></p>
                <label style="color:#73879C; font-size: 11px;margin-top: 10px;font-weight: unset;" id="message_sent_on"></label>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="responseModal" tabindex="-1" aria-labelledby="responseModalLabel" aria-hidden="true" >
    <div class="modal-dialog" style="">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="responseModalLabel" style="display: flex; justify-content: space-between; align-items: center;">
                    <span>Gateway Response</span>
                </h5>                
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;"  onclick="closePopup('responseModal')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="gateway_response">
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

if(isset($_GET['custom_daterange']) && $_GET['custom_daterange'] != ""){
    $daterange = json_decode($_GET['custom_daterange']);
    $start = date('d-M, Y', strtotime($daterange->start));
    $end = date('d-M, Y', strtotime($daterange->end));
}else{
    $start = '';
    $end = '';
}
if(isset($_GET['whatsapp_report_type']) && $_GET['whatsapp_report_type'] != ""){
    $whatsapp_report_type = $_GET['whatsapp_report_type'];
}else{
    $whatsapp_report_type = '1';
}
if(isset($_GET['whatsapp_report_filter_type']) && $_GET['whatsapp_report_filter_type'] != ""){
    $whatsapp_report_filter_type = $_GET['whatsapp_report_filter_type'];
}else{
    $whatsapp_report_filter_type = '1';
}
?>
<script src="<?=base_url();?>salon_assets/js/jquery.comiseo.daterangepicker.js"></script>
<script>
    var table;
    var start = '<?php echo $start; ?>';
    var end = '<?php echo $end; ?>';
    var whatsapp_report_type = '<?php echo $whatsapp_report_type; ?>';
    var whatsapp_report_filter_type = '<?php echo $whatsapp_report_filter_type; ?>';
    var monthNames = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];
    $(document).ready(function() {
        $(".chosen-select").chosen();
        $("#custom_daterange").daterangepicker({
            presets: [{
                label: 'Today',
                start: moment().startOf('day'),
                end: moment().endOf('day')
            }, {
                label: 'Tomorrow',
                start: moment().add(1, 'day').startOf('day'),
                end: moment().add(1, 'day').endOf('day')
            }, {
                label: 'This Week',
                start: moment().startOf('week'),
                end: moment().endOf('week')
            }, {
                label: 'Last Week',
                start: moment().subtract(1, 'week').startOf('week'),
                end: moment().subtract(1, 'week').endOf('week')
            }, {
                label: 'Last Month',
                start: moment().subtract(1, 'month').startOf('month'),
                end: moment().subtract(1, 'month').endOf('month')
            }],
            applyOnMenuSelect: false,
            dateFormat: 'dd-M, yy', // Adjusted to include the year
            rangeSplitter: ' To ',
            onSelect: function(dateText, start, end) {
                // Handle selection if needed
                console.log('Selected range: ' + start.format('DD-MM-YYYY') + ' to ' + end.format('DD-MM-YYYY'));
            }
        });
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
        
        setReport(whatsapp_report_type);
    });
    
        function setReport(report_type){
            if(report_type == '1'){
                $('#coins_report').addClass('active');
                $('#payments_report').removeClass('active');

                $('#coins_report_content').show();
                $('#payments_report_content').hide();
            }else if(report_type == '2'){
                $('#coins_report').removeClass('active');
                $('#payments_report').addClass('active');

                $('#coins_report_content').hide();
                $('#payments_report_content').show();
            }

            $('#whatsapp_report_type').val(report_type);
            
            fetchReportData(whatsapp_report_filter_type);
        }
        function formatDate(date) {
            var day = ("0" + date.getDate()).slice(-2);
            var month = ("0" + (date.getMonth() + 1)).slice(-2);
            var year = date.getFullYear();
            return year + '-' + month + '-' + day;
        }

        function formatDateIndia(date) {
            if (!(date instanceof Date)) {
                date = new Date(date);
            }
            const day = String(date.getDate()).padStart(2, '0');
            const monthShort = date.toLocaleString('en-US', { month: 'short' });
            const year = date.getFullYear();
            return `${day}-${monthShort}, ${year}`;
        }
    
        function fetchReportData(selected_filter_type = ''){
            $('#report_filter_form').hide();
            $('#custom_date_label').text('');

            if(selected_filter_type == ''){
                selected_filter_type = $('#whatsapp_report_filter_type').val();
            }

            var selected_whatsapp_report_type = $('#whatsapp_report_type').val();

            var today = new Date();
            var firstDayOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
            var lastDayOfMonth = new Date(today.getFullYear(), today.getMonth() + 1, 0);
            var firstDayOfWeek = new Date(today);
            var lastDayOfWeek = new Date(today);

            firstDayOfWeek.setDate(today.getDate() - today.getDay() + (today.getDay() === 0 ? -6 : 1));
            lastDayOfWeek.setDate(today.getDate() - today.getDay() + (today.getDay() === 0 ? 0 : 7));

            if(selected_filter_type == '1'){
                start = formatDate(new Date());
                end = formatDate(new Date());
                var report_type_text = 'Date: ' + formatDateIndia(new Date());
            }else if(selected_filter_type == '2'){
                var yesterday = new Date();
                yesterday.setDate(today.getDate() - 1);
                start = formatDate(yesterday);
                end = formatDate(yesterday);
                var report_type_text = 'Date: ' + formatDateIndia(yesterday);
            }else if(selected_filter_type == '3'){
                start = formatDate(firstDayOfWeek);
                end = formatDate(lastDayOfWeek);
                var report_type_text = 'Date: ' + formatDateIndia(firstDayOfWeek) + ' to ' + formatDateIndia(lastDayOfWeek);
            }else if(selected_filter_type == '4'){
                start = formatDate(firstDayOfMonth);
                end = formatDate(lastDayOfMonth);
                var report_type_text = 'Month: ' + monthNames[today.getMonth()];
            }else if(selected_filter_type == '5'){
                var lastMonth = new Date(today.getFullYear(), today.getMonth() - 1, 1);
                var lastMonthFirstDay = new Date(lastMonth.getFullYear(), lastMonth.getMonth(), 1);
                var lastMonthLastDay = new Date(lastMonth.getFullYear(), lastMonth.getMonth() + 1, 0);
                start = formatDate(lastMonthFirstDay);
                end = formatDate(lastMonthLastDay);
                var lastMonthDate = new Date(today.getFullYear(), today.getMonth() - 1, 1);
                var report_type_text = 'Month: ' + monthNames[lastMonthDate.getMonth()];
            }else if(selected_filter_type == '6'){
                $('#custom_daterange').daterangepicker(); 
                $('#report_filter_form').show();
                if(start != "" && end != ""){
                    var report_type_text = 'Custom Date: ' + formatDateIndia(start) + ' to ' + formatDateIndia(end);
                }else{
                    var report_type_text = '';
                }
            }

            $('.filter_navtab').removeClass('active');
            $('#navtab_' + selected_filter_type).addClass('active');
            
            if (table) {
                table.destroy();
            }
            if(selected_whatsapp_report_type == '1'){
                var report_text = 'Coins';
                var excel_column = [0,1,2,3,4,5,6,7,8];
            }else if(selected_whatsapp_report_type == '2'){
                var report_text = 'Payments';
                var excel_column = [0,1,2,3];
            }

            $('#whatsapp_report_type').val(selected_whatsapp_report_type);

            $('.loader_div').show();
            setTimeout(function() {
                $('#report_text').html(report_text);
                $('#custom_date_label').html(report_type_text);
                table = $('#'+ selected_whatsapp_report_type + '_table').DataTable({
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
                        "url" : "<?=base_url();?>salon/Ajax_controller/get_whatsapp_report_data_ajx",
                        "type": "POST",
                        "data": function (d) {
                            d.from_date = start;
                            d.branch = '<?=$this->session->userdata('branch_id'); ?>';
                            d.payment_type = '1';
                            d.whatsapp_report_type = selected_whatsapp_report_type;
                            d.to_date = end;
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
        
        function showForm(){
            $('#custom_daterange').daterangepicker(); 
            $('#report_text').html('');
            $('#report_filter_form').show();
                        
            $('.filter_navtab').removeClass('active');
            $('#navtab_6').addClass('active');
            $('#whatsapp_report_filter_type').val('6');
            
            if(start != "" && end != ""){
                var report_type_text = 'Custom Date: ' + formatDateIndia(start) + ' to ' + formatDateIndia(end);
            }else{
                var report_type_text = '';
            }
            report_type_text = '';
            $('#custom_date_label').html(report_type_text);
        }
        function showGatewayResponse(id){
            $.ajax({
                url: "<?= base_url(); ?>salon/Ajax_controller/get_message_gateway_response_ajx",
                method: 'POST',
                data: { id: id },
                success: function(response) {
                    $('#gateway_response').html(response)
                    showPopup('responseModal');
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching booking details:', error);
                    alert("Error fetching booking details");
                }
            });
        }
        function showMessage(id){
            $.ajax({
                url: "<?= base_url(); ?>salon/Ajax_controller/get_message_content_ajx",
                method: 'POST',
                data: { id: id },
                success: function(response) {
                    $('#message_response').html(response)
                    showPopup('messageModal');
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching booking details:', error);
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
        $('.whatsapp-report').addClass('active_cc');
    });
</script>
