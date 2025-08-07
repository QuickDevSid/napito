<?php include('header.php');?>
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3 style="font-size: 20px;">
                Branch Whatsapp Coin History
                <a style="float:right;" class="btn btn-primary">Current Balance: <?=!empty($branch_details) && $branch_details->current_wp_coins_balance != "" ? (int)$branch_details->current_wp_coins_balance : 0;?></a> 
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
                <div class="x_content">
                    <table class="table table-striped responsive-utilities jambo_table"style="width: 100%;" id="example">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Meesage Type</th>
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
    $(document).ready(function() {
        var excel_column = [0,1,2,3,4,5,6,7,8];
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
                        columns: excel_column,
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
                "url" : "<?=base_url();?>salon/Ajax_controller/get_whatsapp_report_data_ajx",
                "type": "POST",
                "data": function (d) {
                    d.from_date = '';
                    d.branch = '<?=$branch_details->id; ?>';
                    d.payment_type = '1';
                    d.whatsapp_report_type = '1';
                    d.to_date = '';
                    d.admin_panel = '1';
                }				
            },
            "complete": function() {
                $('[data-toggle="tooltip"]').tooltip();			
            }, 
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
</script>