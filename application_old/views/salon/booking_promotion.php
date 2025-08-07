<?php include('header.php'); ?>
<link rel="stylesheet" href="<?=base_url();?>salon_assets/css/jquery.comiseo.daterangepicker.css"> 
<style type="text/css">
    
    .custom_message_div{
        border: 1px solid #71467680;
        padding: 8px;
        border-radius: 8px;
        width: 96%;
        margin: 0 auto;
        float: none;
        background-color: #71467608;
        color: #4c4c4c !important;
    }
    form#add_message_form {
    margin-bottom: 40px;
}
.label-danger,.label-primary{
    display: block;
    padding: 12px 10px;
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



        .customer-box {
            height: 200px;
            width: 300px;
            border: 1px solid #ccc;
            overflow-y: auto;
            padding: 10px;
        }
        .customer-item {
            margin-bottom: 5px;
        }
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div>
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Easy Booking Promotion <button class="btn btn-primary" onclick="showTemplate()">Template</button>
                </h3>
            </div>
        </div>
        <div class="x_panel">
            <div class="x_content">   
                <div class="container">      
                    <div class="navtabs">
                        <div class="navtab" id="navtab_7" data-target="all_messages" onclick="sendPromotionMessages()">Send Messages</div>
                        <div class="navtab" id="navtab_1" data-target="all_customer" onclick="fetchReportData('1')">Today</div>
                        <div class="navtab" id="navtab_2" data-target="new_customer" onclick="fetchReportData('2')">Yesterday</div>
                        <div class="navtab" id="navtab_3" data-target="recently_not_visited" onclick="fetchReportData('3')">This Week</div>
                        <div class="navtab" id="navtab_4" data-target="without_booking" onclick="fetchReportData('4')">This Month</div>
                        <div class="navtab" id="navtab_5" data-target="premium_customer" onclick="fetchReportData('5')">Last Month</div>
                        <div class="navtab" id="navtab_6" data-target="normal_customer" onclick="showForm()">Custom</div>
                    </div>
                    <form method="get" name="report_filter_form" id="report_filter_form" enctype="multipart/form-data" style="display:none;">        
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
                                    <a href="<?=base_url();?><?=$this->uri->segment(1);?>?customer_report_type=6" class="btn btn-warning reset_btn" style="margin-top:25px;">Reset</a>
                                <?php } ?>
                            </div>
                        </div>
                        <input type="hidden" name="customer_report_type" id="customer_report_type" value="6">
                    </form>
                    <div class="new-content" id="sent_messages_div">
                        <div class="x_title">                        
                            <label style="font-size: 15px;color: #0000ff; width:100%;" id="report_text"></label>
                        </div>
                        <table id="example" class="table table-striped responsive-utilities jambo_table" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Client Name</th>
                                    <th>Message Date</th>
                                    <th>Message</th>
                                    <th>Contact</th>
                                    <th>Sent On</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="new-content all-messages" id="all_messages_div" style="display:none;">   
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="x_title">             

                                </div>    
                                <form method="post" name="add_message_form" id="add_message_form" enctype="multipart/form-data" action="<?=base_url();?>promo-message">    
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                            <label for="customers">Select Customers<b class="require">*</b></label>
                                            <!-- <label>
                                                <input type="checkbox" id="checkAll"> Check All
                                            </label>
                                            <div class="customer-box" id="customerList"> -->
                                                <?php 
                                                    // $customer = $this->Salon_model->get_all_salon_customer();
                                                    // if(!empty($customer)){
                                                    // foreach($customer as $customer_result){
                                                ?>
                                                <!-- <div class="customer-item">
                                                    <input type="checkbox" id="customers" name="customers[]" class="customer-checkbox" value="<?=$customer_result->id;?>"> <?=$customer_result->full_name.' ('.$customer_result->customer_phone.')';?>
                                                </div> -->
                                                <?php 
                                            // }} 
                                            ?>
                                            <!-- </div> -->

                                            <select class="form-control choosen" id="customers" name="customers[]" multiple>
                                            <?php 
                                                $customer = $this->Salon_model->get_all_salon_customer();
                                                if(!empty($customer)){
                                                foreach($customer as $customer_result){
                                            ?>
                                            <option value="<?=$customer_result->id;?>"><?=$customer_result->full_name.' ('.$customer_result->customer_phone.')';?></option>
                                            <?php 
                                        }} 
                                        ?>
                                            </select>   
                                            <label for="customers[]" generated="true" class="error" style="display:none;">Please select customer!</label>  
                                        </div>
                                    </div> 
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group"> 
                                            <button type="submit" id="submit_message_button" class="btn btn-primary" style="margin-top:25px;">Submit</button>
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
</div>
</div>
</div>
<div class="modal fade" id="templateModal" tabindex="-1" aria-labelledby="templateModalLabel" aria-hidden="true" >
    <div class="modal-dialog" style="">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="templateModalLabel" style="display: flex; justify-content: space-between; align-items: center;">
                    <span>Template</span>
                </h5>                
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;"  onclick="closePopup('templateModal')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="template_response">
                
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true" >
    <div class="modal-dialog" >
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
    $customer_report_type = '7';
}

?>
<script src="<?=base_url();?>salon_assets/js/jquery.comiseo.daterangepicker.js"></script>
<script>
    var table;
    var messages_table;
    var start = '<?php echo $start; ?>';
    var end = '<?php echo $end; ?>';
    var customer_report_type = '<?php echo $customer_report_type; ?>';
    var monthNames = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];
    $(document).ready(function() {
        $(".choosen").chosen({
            no_results_text: "Oops, nothing found!"
        });
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
        if(customer_report_type != '7'){
            fetchReportData(customer_report_type);
        }else{
            sendPromotionMessages();
        }
    });
    
    
    function formatDateIndia(date) {
        if (!(date instanceof Date)) {
            date = new Date(date);
        }
        const day = String(date.getDate()).padStart(2, '0');
        const monthShort = date.toLocaleString('en-US', { month: 'short' });
        const year = date.getFullYear();
        return `${day}-${monthShort}, ${year}`;
    }
    function fetchReportData(customer_report_type){
        $('#report_text').html('');
        $('#report_filter_form').hide();
        $('#all_messages_div').hide();
        $('#sent_messages_div').show();
        $('#example').show();
        if (table) {
            table.destroy();
        }
        var from_date = '';
        var to_date = '';
        var today = new Date();
        var firstDayOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
        var lastDayOfMonth = new Date(today.getFullYear(), today.getMonth() + 1, 0);
        var firstDayOfWeek = new Date(today);
        var lastDayOfWeek = new Date(today);
        var yesterday = new Date();
        yesterday.setDate(today.getDate() - 1);
        firstDayOfWeek.setDate(today.getDate() - today.getDay() + (today.getDay() === 0 ? -6 : 1));
        lastDayOfWeek.setDate(today.getDate() - today.getDay() + (today.getDay() === 0 ? 0 : 7));
        var lastMonthDate = new Date(today.getFullYear(), today.getMonth() - 1, 1);

        if(customer_report_type == '1'){
            var report_text = 'Today';
            var report_text = 'Date: ' + formatDateIndia(new Date());
        }else if(customer_report_type == '2'){
            var report_text = 'Yesterday';
            var report_text = 'Date: ' + formatDateIndia(yesterday);
        }else if(customer_report_type == '3'){
            var report_text = 'This Week';
            var report_text = 'Date: ' + formatDateIndia(firstDayOfWeek) + ' to ' + formatDateIndia(lastDayOfWeek);
        }else if(customer_report_type == '4'){
            var report_text = 'This Month';
            var report_text = 'Month: ' + monthNames[today.getMonth()];
        }else if(customer_report_type == '5'){
            var report_text = 'Last Month';
            var report_text = 'Month: ' + monthNames[lastMonthDate.getMonth()];
        }else if(customer_report_type == '6'){
            $('#daterange').daterangepicker(); 
            $('#report_filter_form').show();
            from_date = start;
            to_date = end;
            if(from_date != "" && to_date != ""){
                var report_text = 'Custom Date: ' + formatDateIndia(start) + ' to ' + formatDateIndia(end);
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
                    "url" : "<?=base_url();?>salon/Ajax_controller/get_marketing_booking_promotion_data_ajx",
                    "type": "POST",
                    "data": function (d) {
                        d.from_date = from_date;
                        d.to_date = to_date;
                        d.customer_report_type = customer_report_type;
                        d.marketing_type = '24';
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
        $('#sent_messages_div').show();
        $('#all_messages_div').hide();
        $('#daterange').daterangepicker(); 
        $('#report_filter_form').show();
        $('#example').hide();
        $('#report_text').html('');
                    
        $('.navtab').removeClass('active');
        $('#navtab_6').addClass('active');
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
    function sendPromotionMessages(){
        $('.navtab').removeClass('active');
        $('#navtab_7').addClass('active');
        $('#sent_messages_div').hide();
        $('#all_messages_div').show();
        $('#report_filter_form').hide();
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
    $('#add_message_form').validate({
        ignore: [],
        rules: {
            'customers[]': {
                required: true
            }
        },
        messages: {
            'customers[]': "Please select customers!"
        },
        submitHandler: function(form) {
            if (confirm("Are you sure you want to send message?")) {
                form.submit();
            }
        }
    });
</script>
<script>
    function showTemplate() {
        const salonName = "{{Salon Name}}";
        const storeCode = "{{Store Code}}";
        const contactInfo = "{{Contact No.}}";

        const message = `
            <p>No more waiting! Booking an appointment at ${salonName} is now super easy!</p>
            <p>No need to call – just book through the Napito App and enjoy exclusive offers and discounts!</p>
            <p>Download the Napito App Now:<br><a href="https://napito.page.link/download" target="_blank">https://napito.page.link/download</a></p>
            <p>How to register?<br>
            1️⃣ Enter your mobile number and verify with OTP<br>
            2️⃣ Fill in your details:<br>
            – Gender<br>
            – Name<br>
            – Birthday<br>
            – Anniversary</p>
            <p>Scan the QR code or enter this Store Code: ${storeCode}</p>
            <p>For more info, contact: ${contactInfo}</p>
        `;

        document.getElementById("template_response").innerHTML = message;

        showPopup('templateModal');
    }
</script>
<script>
    $(document).ready(function() {
        $('#marketing .child_menu').show();
        $('#marketing').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.booking-promotion').addClass('active_cc');
    });
</script>
<script>
$(document).ready(function() {
    $('#checkAll').change(function() {
        $('.customer-checkbox').prop('checked', this.checked);
    });
});
</script>


