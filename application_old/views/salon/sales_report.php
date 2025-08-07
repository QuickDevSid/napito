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
                Finance Reports
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
                        <div class="<?php if(empty(array_intersect(['sales_profit_loss'], $feature_slugs))) { echo 'blurred '; }?>navtab" id="profit_loss_report" data-target="profit_loss_report" onclick="setReport('0')">Profit/Loss</div>
                        <div class="<?php if(empty(array_intersect(['sales_details'], $feature_slugs))) { echo 'blurred '; }?>navtab" id="total_sales_report" data-target="total_sales_report" onclick="setReport('1')">Sales Details</div>
                        <div class="<?php if(empty(array_intersect(['sales_redemption'], $feature_slugs))) { echo 'blurred '; }?>navtab" id="redemption_report" data-target="redemption_report" onclick="setReport('2')">Redemptions</div>
                        <div class="<?php if(empty(array_intersect(['sales_finance'], $feature_slugs))) { echo 'blurred '; }?>navtab" id="finance_report" data-target="finance_report" onclick="setReport('3')">Finance</div>
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
                                <input class="form-control" id="daterange" name="daterange" value="<?php 
                                    if(isset($_GET['daterange']) && $_GET['daterange'] != ""){
                                        echo $_GET['daterange'];                
                                    }
                                ?>">                              
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                <button type="submit" id="submit_button" class="btn btn-primary" style="margin-top:25px;">Submit</button>
                                <?php if(isset($_GET['daterange']) && $_GET['daterange'] != ""){ ?>
                                    <a href="<?=base_url();?><?=$this->uri->segment(1);?>?daterange=&sale_report_type=<?php if(isset($_GET['sale_report_type'])){ echo $_GET['sale_report_type']; }?>&sale_report_filter_type=<?php if(isset($_GET['sale_report_filter_type'])){ echo $_GET['sale_report_filter_type']; }?>" class="btn btn-warning reset_btn" style="margin-top:25px;">Reset</a>
                                <?php } ?>
                            </div>
                        </div>
                        <input type="hidden" name="sale_report_type" id="sale_report_type" value="<?php if(isset($_GET['sale_report_type'])){ echo $_GET['sale_report_type']; }?>">
                        <input type="hidden" name="sale_report_filter_type" id="sale_report_filter_type" value="<?php if(isset($_GET['sale_report_filter_type'])){ echo $_GET['sale_report_filter_type']; }?>">
                    </form>
                    <div class="x_title">                        
                        <label style="font-size: 15px;color: #0000ff; width:100%;" id="report_text"></label>
                    </div>
                    <div class="content new-content" id="profit_loss_report_content"> 
                        <div class="x_title"> 
                            <label style="font-size: 15px;color: #0000ff; width:100%;">Profit/Loss <small>(In INR)</small></label>    
                        </div> 
                        <table  id="profit_loss_report_table" class="table table-striped responsive-utilities jambo_table">
                            <thead>
                                <tr>
                                    <th style="text-align:center;">Total Sales</th>
                                    <th style="text-align:center;">Expenses</th>
                                    <th style="text-align:center;" id="profit_loss_text">Net Profit/Loss</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th style="text-align:center;" class="total_sales"></th>
                                    <th style="text-align:center;" class="total_expenses"></th>
                                    <th style="text-align:center;" id="total_net_profit_loss"></th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="content new-content" id="total_sales_report_content">  
                        <div class="x_title">                        
                            <label style="font-size: 15px;color: #0000ff; width:100%;">All Sales <small>(In INR)</small></label>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                                <select class="form-control chosen-select" id="is_counter" name="is_counter" onchange="fetchReportData()">
                                    <option value="">All Sales</option>
                                    <option value="Yes">Counter Sales</option>
                                    <option value="No">Employee Sales</option>
                                </select>                       
                            </div>
                        </div>
                        <table id="total_sales_report_table" class="table table-striped responsive-utilities jambo_table">
                            <thead>
                                <tr>
                                    <th style="text-align:center;">Total Sales</th>
                                    <th style="text-align:center;">Services <i title="Including Service Products" style="cursor:pointer;color:#0000ffb0;" class="fas fa-info-circle"></i></th>
                                    <th style="text-align:center;">Products</th>
                                    <!-- <th style="text-align:center;">Counter Products</th> -->
                                    <th style="text-align:center;">Expenses</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th style="text-align:center;" class="total_sales"></th>
                                    <th style="text-align:center;" id="total_service_sales"></th>
                                    <th style="text-align:center;" id="total_product_sales"></th>
                                    <!-- <th style="text-align:center;" id="total_counter_product_sales"></th> -->
                                    <th style="text-align:center;" class="total_expenses"></th>
                                </tr>
                            </tbody>
                        </table>
                        <div class="x_title">                        
                            <label style="font-size: 15px;color: #0000ff; width:100%;">Other Sales <small>(In INR)</small></label>
                        </div>
                        <table  id="total_other_sales_report_table" class="table table-striped responsive-utilities jambo_table">
                            <thead>
                                <tr>
                                    <th style="text-align:center;">Membership</th>
                                    <th style="text-align:center;">Package</th>
                                    <th style="text-align:center;">Gift Card</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th style="text-align:center;" id="total_membership_sales"></th>
                                    <th style="text-align:center;" id="total_package_sales"></th>
                                    <th style="text-align:center;" id="total_giftcard_sales"></th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="content new-content" id="redemption_report_content">
                        <div class="x_title">                        
                            <label style="font-size: 15px;color: #0000ff; width:100%;">Redemptions <small>(In INR)</small></label>
                        </div>
                        <table  id="redemption_report_table" class="table table-striped responsive-utilities jambo_table" style="margin: 0 auto;width:50%;">
                            <thead>
                                <tr>
                                    <th style="text-align:center;">Package</th>
                                    <th style="text-align:center;">Gift Card</th>
                                    <th style="text-align:center;">Reward Points</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th style="text-align:center;" id="total_package_redemption_sales"></th>
                                    <th style="text-align:center;" id="total_giftcard_redemption_sales"></th>
                                    <th style="text-align:center;" id="total_reward_redemption_sales"></th>
                                </tr>
                            </tbody>
                        </table>
                        <div class="x_title" style="margin-top: 35px;">                        
                            <label style="font-size: 15px;color: #0000ff; width:100%;">Package Redemption Details</label>
                        </div>
                        <table id="redemption_report_package_table" class="table table-striped responsive-utilities jambo_table" style="margin: 0 auto;width:50%;">
                            <thead>
                                <tr>
                                    <th style="text-align:center;">Sr. No.</th>
                                    <th style="text-align:center;">Customer</th>
                                    <th style="text-align:center;">Package</th>
                                    <th style="text-align:center;">Category</th>
                                    <th style="text-align:center;">Service</th>
                                    <th style="text-align:center;">Booking</th>
                                    <th style="text-align:center;">Stylist</th>
                                    <th style="text-align:center;">Service Date</th>
                                    <th style="text-align:center;">Duration</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="content new-content" id="finance_report_content">
                        <div class="x_title">                        
                            <label style="font-size: 15px;color: #0000ff; width:100%;">Finance <small>(In INR)</small></label>
                        </div>
                        <table  id="finance_report_table" class="table table-striped responsive-utilities jambo_table">
                            <thead>
                                <tr>
                                    <th style="text-align:center;">Cash</th>
                                    <th style="text-align:center;">UPI</th>
                                    <th style="text-align:center;">Card</th>
                                    <th style="text-align:center;">Cheque</th>
                                    <th style="text-align:center;">Due</th>
                                    <th style="text-align:center;">Petty Cash</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th style="text-align:center;" id="total_cash_sales"></th>
                                    <th style="text-align:center;" id="total_upi_sales"></th>
                                    <th style="text-align:center;" id="total_card_sales"></th>
                                    <th style="text-align:center;" id="total_cheque_sales"></th>
                                    <th style="text-align:center;" id="total_due_sales"></th>
                                    <th style="text-align:center;" id="total_petty_cash"></th>
                                </tr>
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
if(isset($_GET['sale_report_type']) && $_GET['sale_report_type'] != ""){
    $sale_report_type = $_GET['sale_report_type'];
}else{
    $sale_report_type = '0';
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
    var sale_report_type = '<?php echo $sale_report_type; ?>';
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
        setReport(sale_report_type);
    });
    function setReport(report_type){
        if(report_type == '1'){
            $('#finance_report').removeClass('active');
            $('#redemption_report').removeClass('active');
            $('#total_sales_report').addClass('active');
            $('#profit_loss_report').removeClass('active');

            $('#redemption_report_content').hide();
            $('#total_sales_report_content').show();
            $('#finance_report_content').hide();
            $('#profit_loss_report_content').hide();

            $('#sale_report_type').val('1');
        }else if(report_type == '2'){
            $('#finance_report').removeClass('active');
            $('#total_sales_report').removeClass('active');
            $('#redemption_report').addClass('active');
            $('#profit_loss_report').removeClass('active');

            $('#redemption_report_content').show();
            $('#total_sales_report_content').hide();
            $('#finance_report_content').hide();
            $('#profit_loss_report_content').hide();

            $('#sale_report_type').val('2');
        }else if(report_type == '3'){
            $('#redemption_report').removeClass('active');
            $('#total_sales_report').removeClass('active');
            $('#finance_report').addClass('active');
            $('#profit_loss_report').removeClass('active');

            $('#redemption_report_content').hide();
            $('#total_sales_report_content').hide();
            $('#finance_report_content').show();
            $('#profit_loss_report_content').hide();

            $('#sale_report_type').val('3');
        }else if(report_type == '0'){
            $('#redemption_report').removeClass('active');
            $('#total_sales_report').removeClass('active');
            $('#finance_report').removeClass('active');
            $('#profit_loss_report').addClass('active');

            $('#redemption_report_content').hide();
            $('#total_sales_report_content').hide();
            $('#finance_report_content').hide();
            $('#profit_loss_report_content').show();

            $('#sale_report_type').val('0');
        }
        fetchReportData(sale_report_filter_type);
    }
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
    function fetchReportData(selected_filter_type = ''){
        if(selected_filter_type == ''){
            selected_filter_type = $('#sale_report_filter_type').val();
        }

        $('#report_filter_form').hide();
        from_date = '';
        to_date = '';

        var today = new Date();
        var firstDayOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
        var lastDayOfMonth = new Date(today.getFullYear(), today.getMonth() + 1, 0);
        var firstDayOfWeek = new Date(today);
        var lastDayOfWeek = new Date(today);

        firstDayOfWeek.setDate(today.getDate() - today.getDay() + (today.getDay() === 0 ? -6 : 1));
        lastDayOfWeek.setDate(today.getDate() - today.getDay() + (today.getDay() === 0 ? 0 : 7));

        if(selected_filter_type == '1'){
            var report_text = 'Today';
            from_date = formatDate(new Date());
            to_date = formatDate(new Date());
        }else if(selected_filter_type == '2'){
            var report_text = 'Yesterday';
            var yesterday = new Date();
            yesterday.setDate(today.getDate() - 1);
            from_date = formatDate(yesterday);
            to_date = formatDate(yesterday);
        }else if(selected_filter_type == '3'){
            var report_text = 'This Week';
            from_date = formatDate(firstDayOfWeek);
            to_date = formatDate(lastDayOfWeek);
        }else if(selected_filter_type == '4'){
            var report_text = 'This Month';
            from_date = formatDate(firstDayOfMonth);
            to_date = formatDate(lastDayOfMonth);
        }else if(selected_filter_type == '5'){
            var report_text = 'Last Month';
            var lastMonth = new Date(today.getFullYear(), today.getMonth() - 1, 1);
            var lastMonthFirstDay = new Date(lastMonth.getFullYear(), lastMonth.getMonth(), 1);
            var lastMonthLastDay = new Date(lastMonth.getFullYear(), lastMonth.getMonth() + 1, 0);
            from_date = formatDate(lastMonthFirstDay);
            to_date = formatDate(lastMonthLastDay);
        }else if(selected_filter_type == '6'){
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
        $('.filter_navtab').removeClass('active');
        $('#navtab_' + selected_filter_type).addClass('active');

        var type = $('#sale_report_type').val();
        $('#sale_report_filter_type').val(selected_filter_type);

        // console.log('from_date',from_date)
        // console.log('to_date',to_date)

        $('.loader_div').show();
        setTimeout(function() {
            $('#report_text').html(report_text);   
            if(type == '1' || type == '0'){
                $.ajax({
                    url: "<?= base_url(); ?>salon/Ajax_controller/fetch_total_sales_report_data_ajx",
                    method: 'POST',
                    data: { from_date: from_date, to_date: to_date, selected_filter_type: selected_filter_type, is_counter: $('#is_counter').val() },
                    success: function(data) {
                        var response = JSON.parse(data);
                        $('.total_sales').text(formatNumberInIndianFormat(parseFloat(response.total_sales).toFixed(2)));
                        $('#total_service_sales').text(formatNumberInIndianFormat(parseFloat(response.total_service_sales + response.total_service_product_sale).toFixed(2)));
                        // $('#total_product_sales').html(formatNumberInIndianFormat(parseFloat(response.total_only_product_sale).toFixed(2)) + '<br><small>(Counter Sale: Rs. ' + formatNumberInIndianFormat(parseFloat(response.total_counter_product_sales).toFixed(2)) + ')</small>');
                        $('#total_product_sales').html(formatNumberInIndianFormat(parseFloat(response.total_only_product_sale).toFixed(2)));
                        $('.total_expenses').text(formatNumberInIndianFormat(parseFloat(response.total_expenses).toFixed(2)));
                        $('#total_net_profit_loss').text(formatNumberInIndianFormat(parseFloat(response.total_sales - response.total_expenses).toFixed(2)));
                        
                        if(response.total_sales - response.total_expenses >= 0){
                            $('#profit_loss_text').text('Net Profit');
                            $('#total_net_profit_loss').css('background-color','#96d1967a');
                        }else{
                            $('#profit_loss_text').text('Net Loss');
                            $('#total_net_profit_loss').css('background-color','#ffbfbf');
                        }
                        $('#total_membership_sales').text(formatNumberInIndianFormat(parseFloat(response.total_membership_sales).toFixed(2)));
                        $('#total_package_sales').text(formatNumberInIndianFormat(parseFloat(response.total_package_sales).toFixed(2)));
                        $('#total_giftcard_sales').text(formatNumberInIndianFormat(parseFloat(response.total_giftcard_sales).toFixed(2)));
                    },
                    error: function() {
                        $('.loader_div').hide();
                        alert("Error fetching service details");
                    }
                });
            }else if(type == '2'){
                fetchPackageRedemptionData(from_date,to_date,selected_filter_type,'1');
                $.ajax({
                    url: "<?= base_url(); ?>salon/Ajax_controller/fetch_redemption_report_data_ajx",
                    method: 'POST',
                    data: { from_date: from_date, to_date: to_date, selected_filter_type: selected_filter_type },
                    success: function(data) {
                        var response = JSON.parse(data);                    
                        $('#total_package_redemption_sales').text(formatNumberInIndianFormat(parseFloat(response.total_package_redemption_sales).toFixed(2)));
                        $('#total_giftcard_redemption_sales').text(formatNumberInIndianFormat(parseFloat(response.total_giftcard_redemption_sales).toFixed(2)));
                        $('#total_reward_redemption_sales').text(formatNumberInIndianFormat(parseFloat(response.total_reward_redemption_sales).toFixed(2)));
                    },
                    error: function() {
                        $('.loader_div').hide();
                        alert("Error fetching service details");
                    }
                });
            }else if(type == '3'){
                $.ajax({
                    url: "<?= base_url(); ?>salon/Ajax_controller/fetch_finance_report_data_ajx",
                    method: 'POST',
                    data: { from_date: from_date, to_date: to_date, selected_filter_type: selected_filter_type },
                    success: function(data) {
                        var response = JSON.parse(data);
                        $('#total_cash_sales').text(formatNumberInIndianFormat(parseFloat(response.total_cash_sales).toFixed(2)));
                        $('#total_upi_sales').text(formatNumberInIndianFormat(parseFloat(response.total_upi_sales).toFixed(2)));
                        $('#total_card_sales').text(formatNumberInIndianFormat(parseFloat(response.total_card_sales).toFixed(2)));
                        $('#total_cheque_sales').text(formatNumberInIndianFormat(parseFloat(response.total_cheque_sales).toFixed(2)));
                        $('#total_due_sales').text(formatNumberInIndianFormat(parseFloat(response.total_due_sales).toFixed(2)));
                        $('#total_petty_cash').text(formatNumberInIndianFormat(parseFloat(response.total_petty_cash).toFixed(2)));
                    },
                    error: function() {
                        $('.loader_div').hide();
                        alert("Error fetching service details");
                    }
                });
            }
            $('.loader_div').hide();
        }, 1500);
    }
    function fetchPackageRedemptionData(selected_from_date,selected_to_date,selected_selected_filter_type,selected_payment_status){
        if (table) {
            table.destroy();
        }
        $('.loader_div').show();
        setTimeout(function() {
            table = $('#redemption_report_package_table').DataTable({
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
                            columns: [0,1,2,3,4,5,6,7,8],
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
                    "url" : "<?=base_url();?>salon/Ajax_controller/get_customer_package_redemption_report_data_ajx",
                    "type": "POST",
                    "data": function (d) {
                        d.from_date = selected_from_date;
                        d.selected_filter_type = selected_selected_filter_type;
                        d.to_date = selected_to_date;
                        d.payment_status = selected_payment_status;
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
        $('.sales-report').addClass('active_cc');
    });
</script>
