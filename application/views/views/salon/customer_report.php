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
a.btn.btn-sm{
    padding: 10px !important;
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
                    Customer Reports
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
                        <div class="<?php if(empty(array_intersect(['customer_all'], $feature_slugs))) { echo 'blurred '; }?>navtab active" id="navtab_1" data-target="all_customer" onclick="fetchReportData('1')">All Customers</div>
                        <div class="<?php if(empty(array_intersect(['new_customers'], $feature_slugs))) { echo 'blurred '; }?>navtab" id="navtab_2" data-target="new_customer" onclick="fetchReportData('2')">New Customers</div>
                        <div class="<?php if(empty(array_intersect(['recently_not_visited_customers'], $feature_slugs))) { echo 'blurred '; }?>navtab" id="navtab_3" data-target="recently_not_visited" onclick="fetchReportData('3')">Recently Not Visited</div>
                        <div class="<?php if(empty(array_intersect(['without_booking_customers'], $feature_slugs))) { echo 'blurred '; }?>navtab" id="navtab_4" data-target="without_booking" onclick="fetchReportData('4')">Without Booking</div>
                        <div class="<?php if(empty(array_intersect(['premium_customers'], $feature_slugs))) { echo 'blurred '; }?>navtab" id="navtab_5" data-target="premium_customer" onclick="fetchReportData('5')">Premium Customer</div>
                        <div class="<?php if(empty(array_intersect(['normal_customers'], $feature_slugs))) { echo 'blurred '; }?>navtab" id="navtab_6" data-target="normal_customer" onclick="fetchReportData('6')">Normal Customer</div>
                        <div class="<?php if(empty(array_intersect(['membership_customers'], $feature_slugs))) { echo 'blurred '; }?>navtab" id="navtab_7" data-target="membership_customer" onclick="fetchReportData('7')">Membership Customer</div>
                        <div class="<?php if(empty(array_intersect(['upcoming_birthday'], $feature_slugs))) { echo 'blurred '; }?>navtab" id="navtab_8" data-target="upcoming_birthday_customer" onclick="fetchReportData('8')">Upcoming Birthday</div>
                        <div class="<?php if(empty(array_intersect(['upcoming_anniversary'], $feature_slugs))) { echo 'blurred '; }?>navtab" id="navtab_9" data-target="upcoming_anniversary_customer" onclick="fetchReportData('9')">Upcoming Anniversary</div>
                    </div>
                    <!-- <form method="get" name="report_filter_form" id="report_filter_form" enctype="multipart/form-data">        
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
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
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                <button type="submit" id="submit_button" class="btn btn-primary" style="margin-top:25px;">Submit</button>
                                <?php if(isset($_GET['daterange'])){ ?>
                                    <a href="<?=base_url();?><?=$this->uri->segment(1);?>" class="btn btn-warning reset_btn" style="margin-top:25px;">Reset</a>
                                <?php } ?>
                            </div>
                        </div>
                        <input type="hidden" name="customer_report_type" id="customer_report_type" value="<?php if(isset($_GET['customer_report_type'])){ echo $_GET['customer_report_type']; }?>">
                    </form> -->
                    <div class="x_title" style="margin-bottom:0px;position:absolute;">                                                 
                        <?php 
                            if(isset($_GET['daterange']) && $_GET['daterange'] != ""){
                                $daterange = json_decode($_GET['daterange']);
                                $start = date('d-M, Y', strtotime($daterange->start));
                                $end = date('d-M, Y', strtotime($daterange->end));
                                if($daterange->start != "" && $daterange->end != ""){
                                    if($daterange->start == $daterange->end){
                                        if($start == date('d-m, Y') && $end == date('d-m, Y')){
                                            echo '<label style="background-color:#ccc;padding:10px;">Sales For Today</label>';  
                                        }else{
                                            echo '<label style="background-color:#ccc;padding:10px;">Sales For: ' . $start . '</label>'; 
                                        }
                                    }else{
                                        echo '<label style="background-color:#ccc;padding:10px;">Sales For: '.$start . ' To ' . $end.'</label>';  
                                    }
                                }          
                            }
                        ?> 
                    </div>
                    <div class="new-content">
                        <div class="x_title">                        
                            <label style="font-size: 15px;color: #0000ff; width:100%;" id="report_text"></label>
                        </div>
                        <table id="example" class="table table-striped responsive-utilities jambo_table" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Date of Birthday</th>
                                    <th>Date of Anniversary</th>
                                    <th>Total Bookings</th>
                                    <th>First Booking</th>
                                    <th>Last Booking</th>
                                    <th>Membership</th>
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
        fetchReportData('1');
    });
    
    
        function fetchReportData(customer_report_type){
            if (table) {
                table.destroy();
            }
            if(customer_report_type == '1'){
                var report_text = 'All Customers';
            }else if(customer_report_type == '2'){
                var report_text = 'New Customers <small style="float:right;color:black;">(Note: Customers registered in last 10 days)</small>';
            }else if(customer_report_type == '3'){
                var report_text = 'Recently Not Visited <small style="float:right;color:black;">(Note: Customers last booking received more than 10 days ago)</small>';
            }else if(customer_report_type == '4'){
                var report_text = 'Without Booking';
            }else if(customer_report_type == '5'){
                var report_text = 'Premium Customer <small style="float:right;color:black;">(Note: Customers with more than 10 bookings)</small>';
            }else if(customer_report_type == '6'){
                var report_text = 'Normal Customer <small style="float:right;color:black;">(Note: Customers with less than 10 bookings)</small>';
            }else if(customer_report_type == '7'){
                var report_text = 'Membership Customer';
            }else if(customer_report_type == '8'){
                var report_text = 'Upcoming Birthday';
            }else if(customer_report_type == '9'){
                var report_text = 'Upcoming Anniversary';
            }
            $('.loader_div').show();
            setTimeout(function() {
                $('#report_text').html(report_text);
                table = $('#example').DataTable({
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
                                columns: [0,1,2,3,4,5,6],
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
                        "url" : "<?=base_url();?>salon/Ajax_controller/get_customer_report_data_ajx",
                        "type": "POST",
                        "data": function (d) {
                            d.from_date = start;
                            d.customer_report_type = customer_report_type;
                            d.to_date = end;
                        }				
                    },
                    "complete": function() {
                        $('[data-toggle="tooltip"]').tooltip();			
                    }, 
                });
                $('.loader_div').hide();
            }, 1500)
            $('.navtab').removeClass('active');
            $('#navtab_' + customer_report_type).addClass('active');
            return false;
        }
</script>
<script>
    $(document).ready(function() {
        $('#reports .child_menu').show();
        $('#reports').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.customer-reports').addClass('active_cc');
    });
</script>
