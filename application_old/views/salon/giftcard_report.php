<?php include('header.php'); ?>
<link rel="stylesheet" href="<?=base_url();?>salon_assets/css/jquery.comiseo.daterangepicker.css"> 
<style type="text/css">
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
  /* padding: 25px 0px 20px 0px; */
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
                    Giftcard Sale Report
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
                                <input class="form-control" id="daterange" name="daterange" value="<?php 
                                    if(isset($_GET['daterange']) && $_GET['daterange'] != ""){
                                        echo $_GET['daterange'];                
                                    }
                                ?>">                              
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                <button type="submit" id="submit_button" class="btn btn-primary" style="margin-top:25px;">Submit</button>
                                <?php if(isset($_GET['daterange']) && $_GET['daterange'] != ""){ ?>
                                    <a href="<?=base_url();?><?=$this->uri->segment(1);?>?daterange=&sale_report_filter_type=<?php if(isset($_GET['sale_report_filter_type'])){ echo $_GET['sale_report_filter_type']; }?>" class="btn btn-warning reset_btn" style="margin-top:25px;">Reset</a>
                                <?php } ?>
                            </div>
                        </div>
                        <input type="hidden" name="sale_report_filter_type" id="sale_report_filter_type" value="<?php if(isset($_GET['sale_report_filter_type'])){ echo $_GET['sale_report_filter_type']; }?>">
                    </form>
                    <div class="x_title">                        
                        <label style="font-size: 15px;color: #0000ff; width:100%;" id="report_text"></label>
                    </div>
                    <div class="new-content" id="profit_loss_report_content"> 
                        <table id="example" class="table table-striped responsive-utilities jambo_table" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Status</th>
                                    <th>Customer</th>
                                    <th>Mobile</th>
                                    <th>Giftcard</th>
                                    <th>Giftcard Code</th>
                                    <th>Gender</th>
                                    <th>Offer Price</th>
                                    <th>Balance</th>
                                    <th>Allocated On</th>
                                    <th>Sold By</th>
                                    <th>Purchased From</th>
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
if(isset($_GET['sale_report_filter_type']) && $_GET['sale_report_filter_type'] != ""){
    $sale_report_filter_type = $_GET['sale_report_filter_type'];
}else{
    $sale_report_filter_type = '1';
}

?>
<script src="<?=base_url();?>salon_assets/js/jquery.comiseo.daterangepicker.js"></script>
<script>
    var table;
    var start = '<?php echo $start; ?>';
    var end = '<?php echo $end; ?>';
    var sale_report_filter_type = '<?php echo $sale_report_filter_type; ?>';
    $(document).ready(function() {
        $(".chosen-select").chosen();
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
            dateFormat: 'dd-M, yy', // Adjusted to include the year
            rangeSplitter: ' To ',
            onSelect: function(dateText, start, end) {
                // Handle selection if needed
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
        fetchReportData(sale_report_filter_type);
    });
    function formatNumberInIndianFormat(num) {
        // Convert number to string
        num = num.toString();
        
        // Split integer and decimal parts
        let [integerPart, decimalPart] = num.split('.');

        // Add commas to the integer part
        let lastThree = integerPart.slice(-3);
        let otherNumbers = integerPart.slice(0, -3);
        
        if (otherNumbers !== '') {
            lastThree = ',' + lastThree;
        }
        
        integerPart = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ',') + lastThree;

        // Combine integer and decimal parts
        return decimalPart ? integerPart + '.' + decimalPart : integerPart;
    }
    function formatDate(date) {
        var day = ("0" + date.getDate()).slice(-2);
        var month = ("0" + (date.getMonth() + 1)).slice(-2);
        var year = date.getFullYear();
        return year + '-' + month + '-' + day;
    }
    function fetchReportData(customer_report_type){
        $('#report_filter_form').hide();
        $('#report_text').html('');
        var report_text = '';
        if(customer_report_type == '6'){
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
        if (table) {
            table.destroy();
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
                            columns: [0,1,2,3,4,5,6,7,8,9,10,11],
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
                    "url" : "<?=base_url();?>salon/Ajax_controller/get_giftcard_report_data_ajx",
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
    function showForm(){
        $('#daterange').daterangepicker(); 
        $('#report_filter_form').show();
        $('#example').hide();
        $('#report_text').html('');
                    
        $('.filter_navtab').removeClass('active');
        $('#navtab_6').addClass('active');
        $('#sale_report_filter_type').val('6');
    }
</script>
<script>
    $(document).ready(function() {
        $('#reports .child_menu').show();
        $('#reports').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.giftcard-report').addClass('active_cc');
    });
</script>
