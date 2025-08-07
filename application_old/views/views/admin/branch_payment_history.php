<?php include('header.php');?>
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3 style="font-size: 20px;">
                Branch Payment History
                <?php 
                if(!empty($branch_details)){ 
                    $subscription_allocation = $this->Admin_model->get_subscription_allocation_details($branch_details->subscription_allocation_id);
                    if(!empty($subscription_allocation)){
                        if($subscription_allocation->allocation_status == '1' || $subscription_allocation->allocation_status == '0'){
                ?>
                    <a style="float:right;" href="<?=base_url();?>branch_payment<?php if(!empty($branch_details)){ echo '?salon='.$branch_details->salon_id.'&branch='.$branch_details->id; } ?>" class="btn btn-primary">Add Subscription Payment</a>
                <?php }}} ?>
            </h3>
        </div>
        <?php if(!empty($branch_details)){ ?>
        <div class="title_left">
        <h4 style="color:#383838; text-align:center;"><?=$branch_details->branch_name;?>, <?=$branch_details->salon_name;?></h4>
        </div>
        <?php } ?>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">                    
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table class="table table-striped responsive-utilities jambo_table"style="width: 100%;" id="example">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <?php if(empty($branch_details)){ ?>
                                    <th>Salon</th>
                                    <th>Branch</th>
                                <?php } ?>
                                <th>Payment Type</th>
                                <th>Opening Due</th>
                                <th>Amount</th>
                                <th>Closing Due</th>
                                <th>Coin Used</th>
                                <th>Coin Used In INR</th>
                                <th>Payment Date</th>
                                <th>Payment By</th>
                                <th>Payment Entry On</th>
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
                    filename: 'Customer-list',
                    exportOptions: {
                        columns: [0,1,2,4,5,6,7,8,9,10],
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
                "url" : "<?=base_url();?>admin/Ajax_controller/get_branch_payments_ajx",
                "type": "POST",
                "data": function (d) {
                    d.branch = branch
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
</script>