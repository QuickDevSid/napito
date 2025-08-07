<?php include('header.php');?>
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3 style="font-size: 20px;">
                Whatsapp Message History
            </h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">                    
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form method="get" name="customer_form" id="customer_form" enctype="multipart/form-data">
                        <input type="hidden" name="selected_salon" id="selected_salon" value="<?php if(isset($_GET['salon']) && $_GET['salon'] != ""){ echo $_GET['salon']; }?>">
                        <input type="hidden" name="selected_branch" id="selected_branch" value="<?php if(isset($_GET['branch']) && $_GET['branch'] != ""){ echo $_GET['branch']; }?>">
                        <input type="hidden" name="cron_id" id="cron_id" value="<?php if(isset($_GET['cron_id']) && $_GET['cron_id'] != ""){ echo $_GET['cron_id']; }?>">
                        <input type="hidden" name="ids" id="ids" value="<?php if(isset($_GET['ids']) && $_GET['ids'] != ""){ echo $_GET['ids']; }?>">
                        <div class="row">
                            <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <label style="color: black;">Select Salon</label>
                                <select class="form-control chosen-select" name="salon" id="salon" onchange="fetchbranch()">
                                    <option value="">All Salon</option>
                                </select>
                                <label id="salon-error" class="error" style="display: none;" for="salon">Please select salon!</label>
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <label style="color: black;">Select Branch</label>
                                <select class="form-control chosen-select" name="branch" id="branch">
                                    <option value="">All Branch</option>
                                </select>
                                <label id="branch-error" class="error" style="display: none;" for="branch">Please select salon!</label>
                            </div>
                            <?php
                                $message_types = [
                                    // '0'  => 'Login OTP',
                                    '1'  => 'Birthday',
                                    '2'  => 'Anniversary',
                                    '3'  => 'Service Repeat',
                                    '4'  => 'Lost Customer',
                                    // '5'  => 'Booking Confirmed',
                                    // '6'  => 'Booking Rescheduled',
                                    // '7'  => 'Service Cancelled',
                                    // '8'  => 'Payment Done',
                                    // '9'  => 'Booking Reminder',
                                    // '10' => 'Customize Message',
                                    '11' => 'Offer Message',
                                    // '12' => 'Consent Form Share',
                                    // '13' => 'Branch Registration Email',
                                    '14' => 'Coupon Message',
                                    '15' => 'Giftcard Message',
                                    // '16' => 'Support Query Raised',
                                    // '17' => 'Query Replay By Customer',
                                    // '18' => 'Query Replay By Admin',
                                    // '19' => 'Query Resolved',
                                    // '20' => 'Membership Purchase',
                                    // '21' => 'Package Purchase',
                                    // '22' => 'Giftcard Purchase',
                                    '23' => 'Trying for Booking',
                                    '24' => 'Easy Booking Promotion',
                                    '25' => 'Yesterday Appointment Cancelled',
                                ];
                                $selected_type = isset($_GET['type']) ? $_GET['type'] : '';
                            ?>
                            <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <label style="color: black;">Select Message Type</label>
                                <select class="form-control chosen-select" name="type" id="type">
                                    <option value="">All Message Type</option>
                                    <?php foreach ($message_types as $key => $label){ ?>
                                        <option value="<?= $key ?>" <?= ($key == $selected_type) ? 'selected' : '' ?>>
                                            <?= $label ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <label id="branch-error" class="error" style="display: none;" for="branch">Please select salon!</label>
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <label style="color: black;">Select From Date</label>
                                <input class="form-control datepicker" readonly name="from_date" id="from_date" placeholder="Select From Date" type="text" value="<?php if(isset($_GET['from_date']) && $_GET['from_date'] != ""){ echo date('d-m-Y',strtotime($_GET['from_date'])); }?>">
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <label style="color: black;">Select To Date</label>
                                <input class="form-control datepicker" readonly name="to_date" id="to_date" placeholder="Select To Date" type="text" value="<?php if(isset($_GET['to_date']) && $_GET['to_date'] != ""){ echo date('d-m-Y',strtotime($_GET['to_date'])); }?>">
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-top: 25px;">
                                <button type="submit" class="btn btn-primary">Search</button>
                                <?php if(isset($_GET['salon']) || isset($_GET['branch']) || isset($_GET['cron_id']) || isset($_GET['type']) || isset($_GET['from_date']) || isset($_GET['to_date']) || isset($_GET['ids'])){ ?>
                                    <a href="<?=base_url();?>whatsapp-message-report" class="btn btn-warning">Reset</a>
                                <?php } ?>
                            </div>
                        </div>
                    <table class="table table-striped responsive-utilities jambo_table"style="width: 100%;" id="example">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Branch</th>
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
<?php include('footer.php');?>
<script>
    var branch = '<?php if(isset($_GET['branch']) && $_GET['branch'] != ""){ echo $_GET['branch']; }else{ echo ''; } ?>';
    $(document).ready(function() {
        var oldExportAction = function (self, e, dt, button, config) {
            if (button[0].className.indexOf('buttons-excel') >= 0) {
                if ($.fn.dataTable.ext.buttons.excelHtml5.available(dt, config)) {
                    $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config);
                }
                else {
                    $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
                }
            } else if (button[0].className.indexOf('buttons-print') >= 0) {
                $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
            }
        };
        var newExportAction = function (e, dt, button, config) {
            var self = this;
            var oldStart = dt.settings()[0]._iDisplayStart;
            dt.one('preXhr', function (e, s, data) {
                data.start = 0;
                data.length = 2147483647;
                dt.one('preDraw', function (e, settings) {
                    oldExportAction(self, e, dt, button, config);
                    dt.one('preXhr', function (e, s, data) {
                        settings._iDisplayStart = oldStart;
                        data.start = oldStart;
                    });
                    setTimeout(dt.ajax.reload, 0);
                    return false;
                });
            });
            dt.ajax.reload();
        };
        var table = $('#example').DataTable({
            "lengthChange": true, 
            "responsive":true,
            "lengthMenu": [10, 25, 50, 100, 200],
            'searching': true,
            "processing": true,
            "serverSide": true,
            "cache": false,
            "order": [],
            "columnDefs": [
                { "orderable": false, "targets": "_all" }
            ],
            // scrollX:300,
            buttons:[
                {
                    extend: "excelHtml5",
                    messageBottom: '',
                    filename: 'CRON-list',
                    exportOptions: {
                        columns: [0,1,3,4],
                        modifier: {
                            search: 'applied',
                            order: 'applied'
                        },
                    },
                }
            ],
            dom: "Blfrtip",
            // scrollX: true,
            // scrollCollapse: true,
            "ajax":{
                "url" : "<?=base_url();?>salon/Ajax_controller/get_whatsapp_report_data_ajx",
                "type": "POST",
                "data": function (d) {
                    d.cron_id = '<?php if(isset($_GET['cron_id'])){ echo $_GET['cron_id']; } ?>';
                    d.from_date = '<?php if(isset($_GET['from_date'])){ echo $_GET['from_date']; } ?>';
                    d.branch = '<?php if(isset($_GET['branch'])){ echo $_GET['branch']; } ?>';
                    d.salon = '<?php if(isset($_GET['salon'])){ echo $_GET['salon']; } ?>';
                    d.type = '<?php if(isset($_GET['type'])){ echo $_GET['type']; } ?>';
                    d.ids = '<?php if(isset($_GET['ids'])){ echo $_GET['ids']; } ?>';
                    d.whatsapp_report_type = '1';
                    d.source = 'admin_panel';
                    d.to_date = '<?php if(isset($_GET['to_date'])){ echo $_GET['to_date']; } ?>';
                }				
            },
            "complete": function() {
                $('[data-toggle="tooltip"]').tooltip();			
            }, 
        });
        $('.navbar-nav.ml-auto .dropdown-menu').dropdown({
            container: '.navbar-nav.ml-auto'
        });
    });  

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
        
    function fetchbranch(){
        if($("#salon").val() != ""){
            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>admin/Ajax_controller/get_all_salon_branch_ajx",
                data: {
                    'salon': $("#salon").val()
                },
                success: function(data) {
                    $("#branch").empty();
                    $('#branch').append('<option value="">Select Branch</option>');
                    var opts = $.parseJSON(data);
                    is_branch_selected = '0';
                    selected_branch = $("#selected_branch").val();
                    $.each(opts, function(i, d) {
                        if(selected_branch == d.id){
                            is_branch_selected = '1';
                            $('#branch').append('<option selected value="' + d.id + '">' + d.branch_name + '</option>');
                        }else{
                            $('#branch').append('<option value="' + d.id + '">' + d.branch_name + '</option>');
                        }
                    });
                    $('#branch').trigger('chosen:updated');
                    
                    if(is_branch_selected == '1'){
                        fetchbranchPaymentDetails();
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }
    }
    

    $(document).ready(function () {
        $(".datepicker").datepicker({
			dateFormat:"dd-mm-yy",
			changeMonth:true,
			changeYear:true,
			maxDate:0,
			maxDate: "0",
			minDate: "-5Y",			 
		});
        $(".chosen-select").chosen({});
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>admin/Ajax_controller/get_all_salon_ajx",
            data: {

            },
            success: function(data) {
                $("#salon").empty();
                $('#salon').append('<option value="">Select Salon</option>');
                var opts = $.parseJSON(data);
                selected_salon = $("#selected_salon").val();
                is_salon_selected = '0';
                $.each(opts, function(i, d) {
                    if(selected_salon == d.id){
                        is_salon_selected = '1';
                        $('#salon').append('<option selected value="' + d.id + '">' + d.salon_name + '</option>');
                    }else{
                        $('#salon').append('<option value="' + d.id + '">' + d.salon_name + '</option>');
                    }
                });
                $('#salon').trigger('chosen:updated');

                if(is_salon_selected == '1'){
                    fetchbranch();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });
</script>