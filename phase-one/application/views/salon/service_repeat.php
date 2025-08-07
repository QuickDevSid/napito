<?php include('header.php'); ?>
<link rel="stylesheet" href="<?=base_url();?>salon_assets/css/jquery.comiseo.daterangepicker.css"> 
<style type="text/css">
    
div.dataTables_wrapper div.dataTables_info{
    text-align: left !important;
}
div.dataTables_wrapper div.dataTables_paginate{
    margin-top: 15px !important;
}
.dataTables_length{
    text-align: left !important;
}
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

.navtabs {
    display: flex;
    justify-content: left;
    margin-bottom: 20px;
    margin-top: -10px;
    background: white;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    /* border-radius: 8px; */
    padding: 2px 0px;
    position: relative;
}
.navtab {
    padding: 7px 15px;    
    cursor: pointer;
    color: #333;
    margin: 0px 1px;
    transition: color 0.4s, background-color 0.4s, font-size 0.4s;
    font-size: 12px;
    border: 0.5px solid #0000ff33;
}
.navtab:hover {
  color: #0000ff;
}
.navtab.active {
    color: #ffffff;
    background-color: blue;
    font-size: 15px;
}
.content {
  display: none;
  padding: 25px 0px 20px 0px;
  /* max-width: 800px; */
  text-align: center;
}
.content.active {
  display: block;
}
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div>
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Service Repeat
                </h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">           
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="x_panel">
            <div class="x_content">   
                <div class="container">      
                    <div class="navtabs">
                        <div class="navtab active" id="navtab_1" data-target="all_customer" onclick="fetchReportData('1')">Today</div>
                        <div class="navtab" id="navtab_2" data-target="new_customer" onclick="fetchReportData('2')">Yesterday</div>
                        <div class="navtab" id="navtab_3" data-target="recently_not_visited" onclick="fetchReportData('3')">This Week</div>
                        <div class="navtab" id="navtab_4" data-target="without_booking" onclick="fetchReportData('4')">This Month</div>
                        <div class="navtab" id="navtab_5" data-target="premium_customer" onclick="fetchReportData('5')">Last Month</div>
                        <div class="navtab" id="navtab_6" data-target="normal_customer" onclick="showForm()">Custom</div>
                    </div>
                    <form method="get" name="report_filter_form" id="report_filter_form" enctype="multipart/form-data" style="display:none;">        
                        <div class="row">
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <label style="display:block;">Select Date</label>                   
                                <input class="form-control" id="daterange" name="daterange" value="<?php 
                                    if(isset($_GET['daterange']) && $_GET['daterange'] != ""){
                                        $daterange = json_decode($_GET['daterange']);
                                        $start = date('d-M, Y', strtotime($daterange->start));
                                        $end = date('d-M, Y', strtotime($daterange->end));
                                        echo $start . ' To ' . $end;                
                                    }
                                ?>">                              
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                <button type="submit" id="submit_button" class="btn btn-primary" style="margin-top:25px;">Submit</button>
                                <?php if(isset($_GET['daterange'])){ ?>
                                    <a href="<?=base_url();?><?=$this->uri->segment(1);?>?customer_report_type=6" class="btn btn-info" style="margin-top:25px;">Reset</a>
                                <?php } ?>
                            </div>
                        </div>
                        <input type="hidden" name="customer_report_type" id="customer_report_type" value="6">
                    </form>
                    <div class="new-content">
                        <div class="x_title">                        
                            <label style="font-size: 15px;color: #0000ff; width:100%;" id="report_text"></label>
                        </div>
                        <table id="example" class="table table-striped responsive-utilities jambo_table" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Client Name</th>
                                    <th>Last Booking Date</th>
                                    <th>Visit<br><small>(After Message Sent)</small></th>
                                    <th>Message</th>
                                    <th>Contact</th>
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
<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.62);z-index: 1025 !important;">
    <div class="modal-dialog" style="margin-top:165px;width:500px;">
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
<div class="loader_div">
<div  class="loader-new"></div>
</div>
<?php include('footer.php');
$id = 0;
if ($this->uri->segment(2) != "") {
    $id = $this->uri->segment(2);
}
if(isset($_GET['daterange']) && $_GET['daterange'] != ""){
    $daterange = json_decode($_GET['daterange']);
    $start = date('d-M, Y', strtotime($daterange->start));
    $end = date('d-M, Y', strtotime($daterange->end));
}else{
    $start = '';
    $end = '';
}
if(isset($_GET['customer_report_type']) && $_GET['customer_report_type'] != ""){
    $customer_report_type = $_GET['customer_report_type'];
}else{
    $customer_report_type = '1';
}

?>
<script src="<?=base_url();?>salon_assets/js/jquery.comiseo.daterangepicker.js"></script>
<script>
    var table;
    var start = '<?php echo $start; ?>';
    var end = '<?php echo $end; ?>';
    var customer_report_type = '<?php echo $customer_report_type; ?>';
    $(document).ready(function() {
        $("#daterange").daterangepicker({
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
            dateFormat: 'dd-M, yy',
            rangeSplitter: ' To ',
            onSelect: function(dateText, start, end) {
                console.log('Selected range: ' + start.format('DD-MM-YYYY') + ' to ' + end.format('DD-MM-YYYY'));
            }
        });
        $('#report_filter_form').validate({
            rules: {
                daterange: 'required',
            },
            messages: {
                daterange: "Please select date!",              
            },
        });  
        fetchReportData(customer_report_type);
    });
    
    
        function fetchReportData(customer_report_type){
            $('#report_text').html('');
            $('#report_filter_form').hide();
            $('#example').show();
            if (table) {
                table.destroy();
            }
            var from_date = '';
            var to_date = '';
            if(customer_report_type == '1'){
                var report_text = 'Today';
            }else if(customer_report_type == '2'){
                var report_text = 'Yesterday';
            }else if(customer_report_type == '3'){
                var report_text = 'This Week';
            }else if(customer_report_type == '4'){
                var report_text = 'This Month';
            }else if(customer_report_type == '5'){
                var report_text = 'Last Month';
            }else if(customer_report_type == '6'){
                $('#daterange').daterangepicker(); 
                $('#report_filter_form').show();
                from_date = start;
                to_date = end;
                if(from_date != "" && to_date != ""){
                    var report_text = 'Custom Date: ' + from_date + ' to ' + to_date;
                }else{
                    var report_text = '';
                }
            }
            
            $('.navtab').removeClass('active');
            $('#navtab_' + customer_report_type).addClass('active');

            $('.loader_div').show();
            setTimeout(function() {
                $('#report_text').html(report_text);                       
                table = $('#example').DataTable({
                    "lengthChange": true, 
                    "lengthMenu": [10, 25, 50, 100, 200],
                    'searching': true,
                    "processing": true,
                    "serverSide": true,
                    // "responsive": true,
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
                                columns: [0,1,2,3,4,5],
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
                        "url" : "<?=base_url();?>salon/Ajax_controller/get_marketing_service_repeat_data_ajx",
                        "type": "POST",
                        "data": function (d) {
                            d.from_date = from_date;
                            d.to_date = to_date;
                            d.customer_report_type = customer_report_type;
                            d.marketing_type = '3';
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
            $('#daterange').daterangepicker(); 
            $('#report_filter_form').show();
            $('#example').hide();
            $('#report_text').html('');
                        
            $('.navtab').removeClass('active');
            $('#navtab_6').addClass('active');
        }
        function showMessage(content,on){
            content = decodeURIComponent(content);
            content = content.replace(/\n/g, '<br>');
            $('#message_show_here').html(content);
            $('#message_sent_on').html('Sent on: ' + on);
            showPopup('messageModal');
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
        $('#marketing .child_menu').show();
        $('#marketing').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.service-repeat-setup').addClass('active_cc');
    });
</script>
