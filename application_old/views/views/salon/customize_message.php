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
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div>
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Customize Message
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
                        <div class="navtab" id="navtab_7" data-target="all_messages" onclick="getCustomizeMessages()">Manage Messages</div>
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
                                    <label style="font-size: 15px;color: #0000ff; width:100%;">Add Custom Message<i style="float:right;cursor:pointer;" onclick="showPopup('customMessageGuideModal')" class="fas fa-info-circle"></i></label>
                                </div>    
                                <form method="post" name="add_message_form" id="add_message_form" enctype="multipart/form-data" action="<?=base_url();?>add-message">        
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                            <label style="display:block;">Enter Message*<small style="float:right;">(Note: In Required Whatsapp Format <i style="cursor:pointer;" onclick="showPopup('customMessageGuideModal')" class="fas fa-info-circle"></i>)</small></label>                   
                                            <textarea style="height:150px;" class="form-control" id="message" name="message"><?php if(!empty($single)){ echo $single->message; } ?></textarea>  
                                            <input type="hidden" id="hidden_id" name="hidden_id" value="<?php if(!empty($single)){ echo $single->id; } ?>">                             
                                        </div>
                                        <label for="message" generated="true" class="error" style="display:none;">Please enter message!</label>
                                    </div>   
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                            <label style="display:block;">Enter Remark <small>(If Any)</small></label>                   
                                            <input class="form-control" id="remark" name="remark" value="<?php if(!empty($single)){ echo $single->remark; } ?>">  
                                        </div>
                                    </div> 
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group"> 
                                            <button type="submit" id="submit_message_button" class="btn btn-primary" style="margin-top:25px;">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="x_title">                        
                                    <label style="font-size: 15px;color: #0000ff; width:100%;">All Custom Messages</label>
                                </div>    
                                <table id="all_messages_example" class="table table-striped responsive-utilities jambo_table" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Send</th>
                                            <th>Message</th>
                                            <th>Added On</th>
                                            <th>Approval Status</th>
                                            <th>Action</th>
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
</div>
</div>
<div class="modal fade" id="customMessageGuideModal" tabindex="-1" aria-labelledby="customMessageGuideModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="customMessageGuideModalLabel" style="display: flex; justify-content: space-between; align-items: center;">
                    <span>Custom Message Guide</span>
                </h5>                
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;"  onclick="closePopup('customMessageGuideModal')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="customMessageGuideModalResponse">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="text-align:center;">Use</th>
                            <th>Use For</th>
                            <th>Example</th>
                            <th>Output</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th style="text-align:center;">%0a</th>
                            <td>For New Line</td>
                            <td>Hello,%0aTushar</td>
                            <td>Hello,<br>Tushar</td>
                        </tr>
                        <tr>
                            <th style="text-align:center;">*</th>
                            <td>For Bold Text</td>
                            <td>*Hello*</td>
                            <td><b>Hello</b></td>
                        </tr>
                        <tr>
                            <th style="text-align:center;">_</th>
                            <td>For Italic Text</td>
                            <td>_Hello_</td>
                            <td><em>Hello</em></td>
                        </tr>
                        <tr>
                            <th style="text-align:center;">~</th>
                            <td>For Strikethrough Text</td>
                            <td>~Hello~</td>
                            <td><s>Hello</s></td>
                        </tr>
                        <tr>
                            <th style="text-align:center;">`</th>
                            <td>For Monospace Text</td>
                            <td>`Hello`</td>
                            <td><tt>Hello</tt></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="sendCustomMessageModal" tabindex="-1" aria-labelledby="sendCustomMessageModalLabel" aria-hidden="true" >
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sendCustomMessageModalLabel" style="display: flex; justify-content: space-between; align-items: center;">
                    <span>Send Message</span>
                </h5>                
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;"  onclick="closePopup('sendCustomMessageModal')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="sendCustomMessageModalResponse"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="MessageRemarkModal" tabindex="-1" aria-labelledby="MessageRemarkModalLabel" aria-hidden="true" >
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="MessageRemarkModalLabel" style="display: flex; justify-content: space-between; align-items: center;">
                    <span id="response_text_heading"></span>
                </h5>                
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;"  onclick="closePopup('MessageRemarkModal')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="MessageRemarkModalResponse"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="customMessageModal" tabindex="-1" aria-labelledby="customMessageModalLabel" aria-hidden="true" >
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="customMessageModalLabel" style="display: flex; justify-content: space-between; align-items: center;">
                    <span>Message</span>
                </h5>                
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;"  onclick="closePopup('customMessageModal')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="customMessageModalResponse"></div>
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
        if(customer_report_type != '7'){
            fetchReportData(customer_report_type);
        }else{
            getCustomizeMessages();
        }
    });
    
    
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
                        "url" : "<?=base_url();?>salon/Ajax_controller/get_marketing_customize_message_data_ajx",
                        "type": "POST",
                        "data": function (d) {
                            d.from_date = from_date;
                            d.to_date = to_date;
                            d.customer_report_type = customer_report_type;
                            d.marketing_type = '10';
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
        function showMessage(content,on){
            content = decodeURIComponent(content);
            content = content.replace(/\n/g, '<br>');
            $('#message_show_here').html(content);
            $('#message_sent_on').html('Sent on: ' + on);
            showPopup('messageModal');
        }
        function showCustomizeMessage(id){
            $.ajax({
                url: "<?= base_url(); ?>salon/Ajax_controller/get_customize_message_ajx",
                method: 'POST',
                data: { id: id },
                success: function(response) {
                    $('#customMessageModalResponse').html(response)
                    showPopup('customMessageModal');
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching booking details:', error);
                    alert("Error fetching booking details");
                }
            });
        }
        function showRemarkMessage(id,type){
            if(type == '1'){
                $('#response_text_heading').text('Approval Remark');
            }else if(type == '2'){
                $('#response_text_heading').text('Reject Remark');
            }else if(type == '0'){
                $('#response_text_heading').text('Request Remark');
            }else if(type == '3'){
                $('#response_text_heading').text('Cancelled Remark');
            }
            $.ajax({
                url: "<?= base_url(); ?>salon/Ajax_controller/get_customize_message_remark_ajx",
                method: 'POST',
                data: { id: id, type: type },
                success: function(response) {
                    $('#MessageRemarkModalResponse').html(response)
                    showPopup('MessageRemarkModal');
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching details:', error);
                    alert("Error fetching details");
                }
            });
        }
        function sendCustomMessage(id){
            $.ajax({
                url: "<?= base_url(); ?>salon/Ajax_controller/get_send_customize_message_form_ajx",
                method: 'POST',
                data: { id: id },
                success: function(response) {
                    $('#sendCustomMessageModalResponse').html(response)
                    showPopup('sendCustomMessageModal');
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching details:', error);
                    alert("Error fetching details");
                }
            });
        }
        function getCustomizeMessages(){
            $('.navtab').removeClass('active');
            $('#navtab_7').addClass('active');
            $('#sent_messages_div').hide();
            $('#all_messages_div').show();
            $('#report_filter_form').hide();
              
            if (messages_table) {
                messages_table.destroy();
            }

            messages_table = $('#all_messages_example').DataTable({
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
                    "url" : "<?=base_url();?>salon/Ajax_controller/get_all_customize_messages_ajx",
                    "type": "POST",
                    "data": function (d) {

                    }				
                },
                "complete": function() {
                    $('[data-toggle="tooltip"]').tooltip();		
                }, 
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

<script src="https://cdn.jsdelivr.net/npm/tinymce@5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea.full-featured-non-premium',
        plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
        imagetools_cors_hosts: ['picsum.photos'],
        // menubar: 'file edit view insert format tools table help',
        menubar: false,
        toolbar: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
        toolbar_sticky: true,
        autosave_ask_before_unload: true,
        autosave_interval: "30s",
        autosave_prefix: "{path}{query}-{id}-",
        autosave_restore_when_empty: false,
        autosave_retention: "2m",
        image_advtab: true,
        content_css: '//www.tiny.cloud/css/codepen.min.css',
        link_list: [
            { title: 'My page 1', value: 'http://www.tinymce.com' },
            { title: 'My page 2', value: 'http://www.moxiecode.com' }
        ],
        image_list: [
            { title: 'My page 1', value: 'http://www.tinymce.com' },
            { title: 'My page 2', value: 'http://www.moxiecode.com' }
        ],
        image_class_list: [
            { title: 'None', value: '' },
            { title: 'Some class', value: 'class-name' }
        ],
        importcss_append: true,
        file_picker_callback: function (callback, value, meta) {
        
            if (meta.filetype === 'file') {
                callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
            }
        
            if (meta.filetype === 'image') {
                callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
            }
        
            if (meta.filetype === 'media') {
                callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
            }
        },
        templates: [
            { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
            { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
            { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
        ],
        template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
        template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
        height: 400,
        image_caption: true,
        quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
        noneditable_noneditable_class: "mceNonEditable",
        toolbar_mode: 'sliding',
        contextmenu: "link image imagetools table",
    });
    $.validator.addMethod("tinymceRequired", function(value, element) {
        return tinyMCE.get(element.id).getContent().trim().length !== 0;
    }, "Please enter message!");

    $('#add_message_form').validate({
        ignore: [],
        rules: {
            message: {
                required: true
                // tinymceRequired: true
            }
        },
        messages: {
            message: "Please enter message!"
        },
        submitHandler: function(form) {
            if (confirm("Are you sure you want to add message?")) {
                form.submit();
            }
        }
    });
</script>
<script>
    $(document).ready(function() {
        $('#marketing .child_menu').show();
        $('#marketing').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.customize-message-setup').addClass('active_cc');
    });
</script>
