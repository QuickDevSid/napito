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
                    Subscription Report
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
                        <div class="navtab" id="active_report" data-target="active_report" onclick="setReport('0')">Active Subscription</div>
                        <div class="navtab" id="payments_report" data-target="payments_report" onclick="setReport('1')">Payments</div>
                        <div class="navtab" id="prev_report" data-target="prev_report" onclick="setReport('2')">Previous Subscriptions</div>
                        <div class="navtab" id="app_report" data-target="app_report" onclick="setReport('4')">App Customers</div>
                        <div class="navtab" id="coins_report" data-target="coins_report" onclick="setReport('3')">Coins</div>
                    </div>
                    <div class="content new-content" id="app_report_content"> 
                        <div class="x_title"> 
                            <label style="font-size: 15px;color: #0000ff; width:100%;">App Customers</label>    
                        </div> 
                        <table  id="app_report_table" class="table table-striped responsive-utilities jambo_table">
                            <thead>
                                <tr>
                                    <th style="text-align:center;">Target </small>(As per Subscription)</small></th>
                                    <th style="text-align:center;">Achieved Target</th>
                                    <th style="text-align:center;">App Customers</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th style="text-align:center;"><?=$req_customers != "" ? $req_customers : 0; ?></th>
                                    <th style="text-align:center;"><?=$app_customers; ?></th>
                                    <th style="text-align:center;"><a href="<?=base_url();?>customer-list?app_customer" target="_blank" style="text-decoration:underline;">View</a></th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="content new-content" id="active_report_content"> 
                        <div class="x_title"> 
                            <label style="font-size: 15px;color: #0000ff; width:100%;">Active Subscription</label>    
                        </div> 
                        <table  id="active_report_table" class="table table-striped responsive-utilities jambo_table">
                            <thead>
                                <tr>
                                    <th style="text-align:center;">Name</th>
                                    <th style="text-align:center;">Price</th>
                                    <th style="text-align:center;">Validity</th>
                                    <th style="text-align:center;">Purchased On</th>
                                    <th style="text-align:center;">Expire On</th>
                                    <th style="text-align:center;">Due Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th style="text-align:center;"><?=!empty($profile) && $profile->subscription_name != "" ? $profile->subscription_name : '-';?></th>
                                    <th style="text-align:center;"><?=!empty($profile) && $profile->subscription_name != "" ? 'Rs. ' . $profile->subscription_price : '-';?></th>
                                    <th style="text-align:center;"><?=!empty($profile) && $profile->subscription_name != "" ? $profile->subscription_validity . ' Days' : '-';?></th>
                                    <th style="text-align:center;"><?=!empty($profile) && $profile->subscription_name != "" ? date('d M, Y h:i A', strtotime($profile->subscription_start)) : '-';?></th>
                                    <th style="text-align:center;"><?=!empty($profile) && $profile->subscription_name != "" ? date('d M, Y h:i A', strtotime($profile->subscription_end)) : '-';?></th>
                                    <th style="text-align:center;"><?=!empty($profile) && $profile->subscription_name != "" ? ($profile->pending_due_amount != "" ? 'Rs. ' . $profile->pending_due_amount . '' : 'Rs. 0') : '-';?></th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="content new-content" id="payments_report_content">  
                        <div class="x_title"> 
                            <label style="font-size: 15px;color: #0000ff; width:100%;">Payments</label>    
                        </div> 
                        <table  id="total_sales_report_table" style="width: 100%;" class="table table-striped responsive-utilities jambo_table">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Subscription</th>
                                    <th>Coin Used</th>
                                    <th>Coin Used<br><small>(In INR)</small></th>
                                    <th>Opening Due<br><small>(In INR)</small></th>
                                    <th>Paid Amount<br><small>(In INR)</small></th>
                                    <th>Closing Due<br><small>(In INR)</small></th>
                                    <th>GST Amount<br><small>(In INR)</small></th>
                                    <th>Final Amount<br><small>(In INR)</small></th>
                                    <th>Payment Date</th>
                                    <th>Payment Entry On</th>
                                    <th>Receipt</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="content new-content" id="prev_report_content">  
                        <div class="x_title"> 
                            <label style="font-size: 15px;color: #0000ff; width:100%;">Previous Subscriptions</label>    
                        </div> 
                        <table id="prev_report_table" class="table table-striped responsive-utilities jambo_table">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Status</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Validity</th>
                                    <th>Purchased From</th>
                                    <th>Expire On</th>
                                    <th>Paid Amount</th>
                                    <th>Due Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i=1; 
                                if(!empty($branch_subscription_history)){ 
                                    foreach($branch_subscription_history as $branch_coin_history_result){ 
                                        if($branch_coin_history_result->allocation_status == '0'){
                                            $subscription_status = '<label class="label label-warning">Inactive</label>';
                                        }elseif($branch_coin_history_result->allocation_status == '1'){
                                            $subscription_status = '<label class="label label-success">Active</label>';
                                        }elseif($branch_coin_history_result->allocation_status == '2'){
                                            $subscription_status = '<label class="label label-primary">Expired</label>';
                                        }elseif($branch_coin_history_result->allocation_status == '3'){
                                            $subscription_status = '<label class="label label-info">Cancelled</label>';
                                        }elseif($branch_coin_history_result->allocation_status == '4'){
                                            $subscription_status = '<label class="label label-danger">Money Back & Closed</label>';
                                        }elseif($branch_coin_history_result->allocation_status == '5'){
                                            $subscription_status = '<label class="label label-primary">Hold</label>';
                                        }else{
                                            $subscription_status = '-';
                                        }
                                ?>
                                <tr>
                                    <td><?=$i++;?></td>
                                    <td><?=$subscription_status;?></td>
                                    <td><?=$branch_coin_history_result->subscription_name;?></td>
                                    <td><?=$branch_coin_history_result->subscription_price;?></td>
                                    <td><?=$branch_coin_history_result->subscription_validity . ' Days';?></td>
                                    <td><?=date('d M, Y h:i A',strtotime($branch_coin_history_result->subscription_start));?></td>
                                    <td><?=date('d M, Y h:i A',strtotime($branch_coin_history_result->subscription_end));?></td>
                                    <td><?=$branch_coin_history_result->paid_amount;?></td>
                                    <td><?=$branch_coin_history_result->due_amount;?></td>
                                </tr>
                                <?php }} ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="content navtab_content new-content" id="coins_report_content">
                        <div class="x_title"> 
                            <div class="row coin_sec_header"> 
                                <div class="col-lg-4 col-md-4 col-sm-8 col-xs-12  des_div"> 
                                    <label class="page-title " style="font-size: 15px;color: #0000ff; width:100%;float:left;">
                                        <small style="font-size: 75%;">Earn <?=coin_earn_on_every_download;?> Coins on every Customer App download</small>
                                        <br><small style="font-size: 75%;">Earn <?=coin_earn_on_every_referral;?> Coins on every Salon Referral</small>
                                    </label>     
                                </div>    
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 coin_div"> 
                                    <label class="page-title " style="font-size: 15px;color: #0000ff; width:100%;">
                                        Coins
                                    </label>    
                                </div>    
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 float_div">    
                                    <label class="page-title " style="font-size: 15px;color: #0000ff;">
                                        <button type="button"  class="btn btn-primary floating_btn">Current Balance: <?=$profile->coin_balance != "" ? (int)$profile->coin_balance : 0;?></button> 
                                    </label>  
                                </div> 
                            </div> 
                        </div> 
                        <table  id="coins_report_table" class="table table-striped responsive-utilities jambo_table">
                            <thead>
                                <tr>
                                    <th>Entry On</th>
                                    <th>Entry Type</th>
                                    <th>Opening Balance</th>
                                    <th>Coin Amount</th>
                                    <th>Closing Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i=1; 
                                if(!empty($branch_coin_history)){ 
                                    foreach($branch_coin_history as $branch_coin_history_result){ 
                                        $entry_type = '';
                                        $entry_description = '';
                                        if($branch_coin_history_result->entry_type == '0'){
                                            if($branch_coin_history_result->debit_type == '0'){
                                                $entry_type = 'Used In Subscription Payment';
                                            }elseif($branch_coin_history_result->debit_type == '1'){
                                                $entry_type = 'Subscription Due Amount Payment while Mobile App Customer Registration';
                                                $entry_description = !empty($customer) ? '<small>Customer: ' . $customer->full_name . ', ' . $customer->customer_phone . '</small>' : '';
                                            }
                                            $style="background-color:#f3616147;";
                                        }elseif($branch_coin_history_result->entry_type == '1'){
                                            if($branch_coin_history_result->credit_type == '0'){
                                                $entry_type = 'Mobile App Customer Registration';
                                                $customer = $this->Salon_model->get_customer_info($branch_coin_history_result->customer_id);
                                                $entry_description = !empty($customer) ? '<small>Customer: ' . $customer->full_name . ', ' . $customer->customer_phone . '</small>' : '';
                                            }elseif($branch_coin_history_result->credit_type == '1'){
                                                $entry_type = 'Branch Referral Earning';
                                                $branch = $this->Salon_model->get_branch_info($branch_coin_history_result->refer_to_branch_id);
                                                $entry_description = !empty($branch) ? '<small>Branch: ' . $branch->branch_name . ' [' . $branch->salon_name . ']</small>' : '';
                                            }
                                            $style="background-color:#0080002e;";
                                        }
                                ?>
                                <tr style="<?=$style;?>">
                                    <td><?=date('d M, Y h:i A',strtotime($branch_coin_history_result->created_on));?></td>
                                    <td><?=$entry_type != "" ? $entry_type : '-';?><?=$entry_description != "" ? '<br>' . $entry_description : '';?></td>
                                    <td><?=$branch_coin_history_result->opening_balance;?></td>
                                    <td><?=$branch_coin_history_result->coin_amount;?></td>
                                    <td><?=$branch_coin_history_result->closing_balance;?></td>
                                </tr>
                                <?php }} ?>
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
<?php include('footer.php'); ?>
<script>
    var sale_report_type = '0';
    $(document).ready(function() {
        setReport(sale_report_type);
        
        $('#prev_report_table').DataTable({ 
            responsive:true,
            dom: 'Blfrtip',
            lengthMenu: [ [10, 25, 50, 100], [10, 25, 50, 100] ],
            buttons: [				
                {
                    extend: 'excel',
                    filename: 'branch-list',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8] 
                    }
                },	
            ], 
        });
        
        $('#coins_report_table').DataTable({ 
            responsive:true,
            dom: 'Blfrtip',
            lengthMenu: [ [10, 25, 50, 100], [10, 25, 50, 100] ],
            order: [],
            buttons: [				
                {
                    extend: 'excel',
                    filename: 'branch-list',
                    exportOptions: {
                        columns: [0,1,2,3,4] 
                    }
                },	
            ], 
        });
        
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
        var table = $('#total_sales_report_table').DataTable({
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
            buttons:[
                {
                    extend: "excelHtml5",
                    messageBottom: '',
                    filename: 'Customer-list',
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
            "ajax":{
                "url" : "<?=base_url();?>admin/Ajax_controller/get_branch_payments_ajx",
                "type": "POST",
                "data": function (d) {
                    d.branch = '<?php echo $this->session->userdata('branch_id'); ?>';
                    d.salon = '<?php echo $this->session->userdata('salon_id'); ?>';
                    d.payment_type = '0';
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
    function setReport(report_type){
        $('.loader_div').show();
        setTimeout(function() { 
            if(report_type == '0'){
                $('#active_report').addClass('active');
                $('#payments_report').removeClass('active');
                $('#prev_report').removeClass('active');
                $('#coins_report').removeClass('active');
                $('#app_report').removeClass('active');

                $('#active_report_content').show();
                $('#payments_report_content').hide();
                $('#prev_report_content').hide();
                $('#coins_report_content').hide();
                $('#app_report_content').hide();
            }else if(report_type == '1'){
                $('#active_report').removeClass('active');
                $('#payments_report').addClass('active');
                $('#prev_report').removeClass('active');
                $('#coins_report').removeClass('active');
                $('#app_report').removeClass('active');

                $('#active_report_content').hide();
                $('#payments_report_content').show();
                $('#prev_report_content').hide();
                $('#coins_report_content').hide();
                $('#app_report_content').hide();
            }else if(report_type == '2'){
                $('#active_report').removeClass('active');
                $('#payments_report').removeClass('active');
                $('#prev_report').addClass('active');
                $('#coins_report').removeClass('active');
                $('#app_report').removeClass('active');

                $('#active_report_content').hide();
                $('#payments_report_content').hide();
                $('#prev_report_content').show();
                $('#coins_report_content').hide();
                $('#app_report_content').hide();
            }else if(report_type == '3'){
                $('#active_report').removeClass('active');
                $('#payments_report').removeClass('active');
                $('#prev_report').removeClass('active');
                $('#coins_report').addClass('active');
                $('#app_report').removeClass('active');

                $('#active_report_content').hide();
                $('#payments_report_content').hide();
                $('#prev_report_content').hide();
                $('#coins_report_content').show();
                $('#app_report_content').hide();
            }else if(report_type == '4'){
                $('#active_report').removeClass('active');
                $('#payments_report').removeClass('active');
                $('#prev_report').removeClass('active');
                $('#coins_report').removeClass('active');
                $('#app_report').addClass('active');

                $('#active_report_content').hide();
                $('#payments_report_content').hide();
                $('#prev_report_content').hide();
                $('#coins_report_content').hide();
                $('#app_report_content').show();
            }
            $('.loader_div').hide();
        }, 1500);
    }
</script>
<script>
    $(document).ready(function() {
        $('#reports .child_menu').show();
        $('#reports').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.subscription-reports').addClass('active_cc');
    });
</script>
