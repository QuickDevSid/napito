<?php include('header.php');?>
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3 style="font-size: 20px;">
                <?php
                    if(isset($_GET['type'])){
                        if($_GET['type'] == '0'){
                            echo 'Lost Customers ';
                        }elseif($_GET['type'] == '1'){
                            echo 'Birthday Wishes ';
                        }elseif($_GET['type'] == '2'){
                            echo 'Anniversary Wishes ';
                        }elseif($_GET['type'] == '3'){
                            echo 'Service Repeat ';
                        }elseif($_GET['type'] == '4'){
                            echo 'Yesterday Cancel Appointments ';
                        }elseif($_GET['type'] == '5'){
                            echo 'Tomorrow Booking Reminders ';
                        }elseif($_GET['type'] == '6'){
                            echo 'Today Booking Reminders ';
                        }
                    }
                ?>
                CRON History
                <!-- <a style="float:right;" href="<?=base_url();?>branch_payment" class="btn btn-primary">Add Subscription Payment</a> -->
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
                    <table class="table table-striped responsive-utilities jambo_table"style="width: 100%;" id="example">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Executed On</th>
                                <th>Messages</th>
                                <th>Description</th>
                                <th>Response</th>
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
                "url" : "<?=base_url();?>admin/Ajax_controller/get_cron_report_ajx",
                "type": "POST",
                "data": function (d) {
                    d.type = '<?php if(isset($_GET['type'])){ echo $_GET['type']; }?>'
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