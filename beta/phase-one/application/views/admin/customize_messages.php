<?php include('header.php');?>
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3>Customize Message Requests</h3>
        </div>
        <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search"></div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">                    
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table class="table table-striped responsive-utilities jambo_table"style="width: 100%;" id="example">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Salon</th>
                                <th>Branch</th>
                                <th>Message</th>
                                <th>Added On</th>
                                <th>Status</th>
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
<div class="modal fade" id="MessageRemarkModal" tabindex="-1" aria-labelledby="MessageRemarkModalLabel" aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.62);z-index: 1025 !important;">
    <div class="modal-dialog" style="width:500px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="MessageRemarkModalLabel" style="display: flex; justify-content: space-between; align-items: center;">
                    <span id="remark_response_text_heading"></span>
                </h5>                
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;"  onclick="closePopup('MessageRemarkModal')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="MessageRemarkModalResponse"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="MessageResponseModal" tabindex="-1" aria-labelledby="MessageResponseModalLabel" aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.62);z-index: 1025 !important;">
    <div class="modal-dialog" style="width:500px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="MessageResponseModalLabel" style="display: flex; justify-content: space-between; align-items: center;">
                    <span id="response_text_heading"></span>
                </h5>                
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;"  onclick="closePopup('MessageResponseModal')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="MessageResponseModalResponse"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="customMessageModal" tabindex="-1" aria-labelledby="customMessageModalLabel" aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.62);z-index: 1025 !important;">
    <div class="modal-dialog" style="width:500px;">
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
<?php include('footer.php');?>
<script>
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
                        columns: [0,1,2,4,5],
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
                "url" : "<?=base_url();?>admin/Ajax_controller/get_saloon_customize_messages_ajx",
                "type": "POST",
                "data": function (d) {

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
    function showPopup(id){
        var exampleModal = $('#'+id);
        exampleModal.modal('show');
    }
    function closePopup(id){
        var exampleModal = $('#'+id);
        exampleModal.modal('hide');
    }
    function showCustomizeMessage(id){
        $.ajax({
            url: "<?= base_url(); ?>admin/Ajax_controller/get_customize_message_ajx",
            method: 'POST',
            data: { id: id },
            success: function(response) {
                $('#customMessageModalResponse').html(response)
                // showPopup('customMessageModal');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching details:', error);
                alert("Error fetching details");
            }
        });
    }
    function showRemarkMessage(id,type){
        if(type == '1'){
            $('#remark_response_text_heading').text('Approval Remark');
        }else if(type == '2'){
            $('#remark_response_text_heading').text('Reject Remark');
        }else if(type == '0'){
            $('#remark_response_text_heading').text('Request Remark');
        }else if(type == '3'){
            $('#remark_response_text_heading').text('Cancelled Remark');
        }
        $.ajax({
            url: "<?= base_url(); ?>admin/Ajax_controller/get_customize_message_remark_ajx",
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
    function showResponse(id,type){
        if(type == '1'){
            $('#response_text_heading').text('Approve Request');
        }else if(type == '2'){
            $('#response_text_heading').text('Reject Request');
        }
        $.ajax({
            url: "<?= base_url(); ?>admin/Ajax_controller/get_customize_message_response_form_ajx",
            method: 'POST',
            data: { id: id, type: type },
            success: function(response) {
                $('#MessageResponseModalResponse').html(response)
                showPopup('MessageResponseModal');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching details:', error);
                alert("Error fetching details");
            }
        });
    }
</script>