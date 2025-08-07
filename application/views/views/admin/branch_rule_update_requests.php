<?php include('header.php');?>
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <?php
                if(isset($_GET['status'])){
                    if($_GET['status'] == '0'){
                        $status_text = 'Pending';
                    }elseif($_GET['status'] == '1'){
                        $status_text = 'Approved';
                    }elseif($_GET['status'] == '2'){
                        $status_text = 'Rejected';
                    }else{
                        $status_text = ''; 
                    }
                }else{
                    $status_text = '';
                }
            ?>
        <p><h4 ><?=$status_text;?> Booking Rules Update Requests</h4></p>
        <label >Salon: <?= !empty($branch) ? $branch->branch_name.', '.$branch->salon_name.' ' : ""; ?></label>
        </div>
        <!-- <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search"></div>
        </div> -->
    </div>
    <!-- <div class="clearfix"></div> -->
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
                                <th>Rule Type</th>
                                <th>Description</th>
                                <th>Submitted On</th>
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
<div class="modal fade" id="basicModal_claim_request_response" tabindex="-1" role="dialog" aria-labelledby="remark_response_text_heading" aria-hidden="true">
  <div class="modal-dialog" role="document" id="update_form_div" style="width: 1000px !important;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="remark_response_text_heading"></h5>
        <button type="button" style="margin-top: -22px;" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body" id="response_claim_request_response" >
            
        </div>
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

        var branchValue = "<?php echo isset($_GET['branch']) ? $_GET['branch'] : ''; ?>";
        var statusValue = "<?php echo isset($_GET['status']) ? $_GET['status'] : ''; ?>";

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
            Responsive:true,
            buttons:[
                {
                    extend: "excelHtml5",
                    messageBottom: '',
                    filename: 'Customer-list',
                    exportOptions: {
                        columns: [0,1,2,4],
                        modifier: {
                            search: 'applied',
                            order: 'applied'
                        },
                    },
                }
            ],
            dom: "Blfrtip",
            "ajax":{
                "url" : "<?=base_url();?>admin/Ajax_controller/get_saloon_branch_rule_update_requests_ajx",
                "type": "POST",
                "data": function (d) {
                    d.branch = branchValue;
                    d.status = statusValue;
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
    function setResponse(id, type, branch){
        if(type == '1'){
            $('#remark_response_text_heading').text('Approve Booking Rule Update Request');
        }else if(type == '2'){
            $('#remark_response_text_heading').text('Reject Booking Rule Update Request');
        }
        $.ajax({
            url: '<?=base_url()?>admin/Ajax_controller/get_request_response_form',
            method: 'POST',
            data: {
                id: id, type: type, branch: branch
            },
            success: function(data) {
                $('#response_claim_request_response').html(data);
                showPopup('basicModal_claim_request_response');
            },
        });
    }
</script>