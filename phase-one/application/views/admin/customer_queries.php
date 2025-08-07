<?php include('header.php');?> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<style>
    /* Add custom styles for fixed columns */
    .DTFC_LeftHeadWrapper {
        background-color: #ffffff; /* Set background color for fixed columns header */
    }
    .DTFC_LeftHeadWrapper th {
        position: sticky !important;
        z-index: 2;
    }
    .DTFC_LeftBodyWrapper {
        background-color: #ffffff; /* Set background color for fixed columns */
    }
    .DTFC_LeftBodyWrapper th, .DTFC_LeftBodyWrapper td {
        position: sticky !important;
        z-index: 1;
        background-color: #ffffff; /* Set background color for fixed column data */
    }
    
    /* Add custom styles for scrolling columns */
    .dataTables_scrollHead th:not(.DTFC_LeftHead) {
        background-color: #f5f5f5; /* Set background color for scrolling columns */
    }
    
    .dataTables_scrollBody th:not(.DTFC_LeftHead),
    .dataTables_scrollBody td:not(.DTFC_LeftBody) {
        background-color: #f5f5f5; /* Set background color for scrolling columns */
    }
	.dataTables_scrollBody td:first-child{
		padding-left:30px;
	}
	.dataTables_scrollBody td:nth-child(2){
		padding-left:20px;
	}
	.dataTables_scrollBody td:nth-child(4){
		padding-left:15px;
	}
	.dataTables_scrollBody td:nth-child(5){
		padding-left:20px;
	}
	.dataTables_scrollBody td:nth-child(6){
		padding-left:20px;
	}
	.dataTables_scrollBody td:nth-child(7){
		padding-left:20px;
	}

	.resolution-replays{
		border: 1px solid #ccc;
		padding: 5px;
		border-radius: 10px;
		margin: 0px !important;
		display: block !important;
		height: 500px !important;
		max-height: 250px;
		overflow: hidden;
		overflow-y: auto;
	}
	.single-replay{
		border: 1px solid #ccc;
		padding: 5px;
		border-radius: 10px;
		width:75%;
		margin: 5px;
	}
	.resolution-replays::-webkit-scrollbar-track {
    background: #f1f1f1;
}
.resolution-replays::-webkit-scrollbar-thumb {
    background: #0056d1;
}
.resolution-replays::-webkit-scrollbar {
    width: 8px;
}
</style>   
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">            
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-4 col-xs-12" style="margin:0px auto;">
                <div class="x_panel">
                  <div class="x_title">
                      <h2 style="float:none;">Customer Queries</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form id="make_form" name="make_form" method="get" enctype="multipart/form-data" data-parsley-validate>
						<div class="col-xs-3 form-group">
							<label for="fullname">Customer :</label>
                            <select class="form-control chosen-select" id="customer" name="customer">
                                <option value="">Select Customer</option>
                                <?php 
									if(!empty($customers)){
										foreach($customers as $customers_result){
								?>
								<option value="<?=$customers_result->id;?>" <?php if(isset($_GET['customer']) && ($_GET['customer'] == $customers_result->id)){?> selected <?php } ?>><?=$customers_result->full_name;?>, <?=$customers_result->customer_phone;?> [<?=$customers_result->branch_name;?>]</option>
                                <?php }} ?>
                            </select>
                        </div>
						<div class="col-xs-3 form-group">
							<label for="fullname">Ticket ID :</label>
                            <select class="form-control chosen-select" id="ticket" name="ticket">
                                <option value="">Select Ticket ID</option>
                                <?php 
									if(!empty($queries)){
										foreach($queries as $queries_result){
								?>
								<option value="<?=$queries_result->support_id;?>" <?php if(isset($_GET['ticket']) && ($_GET['ticket'] == $queries_result->support_id)){?> selected <?php } ?>><?=$queries_result->support_id;?></option>
                                <?php }} ?>
                            </select>
                        </div>
						<div class="col-xs-3 form-group">
							<label for="fullname">Subject :</label>
                            <select class="form-control chosen-select" id="category" name="category">
                                <option value="">Select Subject</option>
                                <?php 
									if(!empty($subjects)){
										foreach($subjects as $subjects_result){
								?>
								<option value="<?=$subjects_result->id;?>" <?php if(isset($_GET['category']) && ($_GET['category'] == $subjects_result->id)){?> selected <?php } ?>><?=$subjects_result->reason;?></option>
                                <?php }} ?>
                            </select>
                        </div>
						<div class="col-xs-3 form-group">
							<label for="fullname">Status :</label>
                            <select class="form-control chosen-select" id="status" name="status">
                                <option value="">Select Status</option>
                                <option value="0" <?php if(isset($_GET['status']) && ($_GET['status'] == '0')){?> selected <?php } ?>>Pending</option>
                                <option value="1" <?php if(isset($_GET['status']) && ($_GET['status'] == '1')){?> selected <?php } ?>>Completed</option>
								<option value="2" <?php if(isset($_GET['status']) && ($_GET['status'] == '2')){?> selected <?php } ?>>In Process</option>
							</select>
                        </div>
						<div class="col-xs-3 form-group">
							<label for="fullname">Salon :</label>
                            <select class="form-control chosen-select" id="salon" name="salon">
                                <option value="">Select Salon</option>
                                <?php 
									if(!empty($salons)){
										foreach($salons as $vendor_result){
								?>
								<option value="<?=$vendor_result->id;?>" <?php if(isset($_GET['salon']) && ($_GET['salon'] == $vendor_result->id)){?> selected <?php } ?>><?=$vendor_result->salon_name;?></option>
                            	<?php }} ?>
                            </select>
                        </div>
						<div class="col-xs-3 form-group">
							<label for="fullname">Branch :</label>
                            <select class="form-control chosen-select" id="branch" name="branch">
                                <option value="">Select Branch</option>
                                <?php 
									if(!empty($branches)){
										foreach($branches as $vendor_result){
								?>
								<option value="<?=$vendor_result->id;?>" <?php if(isset($_GET['branch']) && ($_GET['branch'] == $vendor_result->id)){?> selected <?php } ?>><?=$vendor_result->branch_name;?> [<?=$vendor_result->salon_name;?>]</option>
                            	<?php }} ?>
                            </select>
                        </div>
						<div class="clearfix"></div>
						<div class="col-md-3">
							<button type="submit" id="submit_button" class="btn btn-success">Search</button>
							<?php if(isset($_GET['salon']) || isset($_GET['branch']) || isset($_GET['customer']) || isset($_GET['status']) || isset($_GET['ticket']) || isset($_GET['category'])){?>
								<a id="reset_button" class="btn btn-warning" href="<?=base_url().$this->uri->segment(1);?>">Reset</a>
							<?php } ?>
						</div>	
						<div class="clearfix"></div>
                    </form> 
                  </div>
                </div>
            </div>
			<div class="col-md-12 col-sm-8 col-xs-12" style="margin:0px auto;">
                <div class="x_panel">
                    <table class="table table-striped responsive-utilities jambo_table"style="width: 100%;" id="example">
                        <thead>
                            <tr>
                                <th>Sr.No.</th>
                                <th>Action</th>
                                <th>Ticket Status</th>
                                <th>Ticket ID</th>
                                <th>Customer</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Salon</th>
                                <th>Description</th>
                                <th>Subject</th>
                                <th>Created On</th>
                                <th>Attachments</th>
                                <th>Final Remark</th>
                                <th>Final Remark Date</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                        </tbody>
					</table>
                </div> 
            </div> 
        </div>
	<div class="clearfix"></div>
	<div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h2 class="modal-title" id="myModalLabel">Give Final Resolution</h2>
				</div>
				<div class="modal-body py-5 px-5" id="response">
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="basicModal2" tabindex="-1" role="dialog" aria-labelledby="basicModal2" aria-hidden="true">
		<div class="modal-dialog" style="width: 700px;">
			<div class="modal-content" style="margin: 5% auto !important;">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h2 class="modal-title" id="myModalLabel2">Resolution History</h2>
				</div>
				<div class="modal-body py-5 px-5" id="response2">
				</div>
			</div>
		</div>
	</div>
    <?php include('footer.php');?>
<script>
		function click_popup(str,ticket){
            $.ajax({
                type: "POST",
                url: "<?=base_url();?>admin/Ajax_controller/get_final_remark_popup",
                data: {'id': str,'ticket': ticket},
                
                success: function(data) { 
                    $("#response").html(data);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }
		function click_popup_replay(str,ticket){
            $.ajax({
                type: "POST",
                url: "<?=base_url();?>admin/Ajax_controller/get_query_resolution_history_popup",
                data: {'id': str,'ticket': ticket},
                
                success: function(data) { 
                    $("#response2").html(data);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }
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
						exportOptions: {
							columns: [0,2,3,4,5,6,7,8,9,11,12,13],
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
					"url" : "<?=base_url();?>admin/Ajax_controller/get_customer_queries_ajx",
					"type": "POST",
					"data": function (d) {
						d.customer = '<?php echo isset($_GET['customer']) ? $_GET['customer'] : ''; ?>';
						d.ticket = '<?php echo isset($_GET['ticket']) ? $_GET['ticket'] : ''; ?>';
						d.category = '<?php echo isset($_GET['category']) ? $_GET['category'] : ''; ?>';
						d.status = '<?php echo isset($_GET['status']) ? $_GET['status'] : ''; ?>';
						d.salon = '<?php echo isset($_GET['salon']) ? $_GET['salon'] : ''; ?>';
						d.branch = '<?php echo isset($_GET['branch']) ? $_GET['branch'] : ''; ?>';
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
		$("#salon").change(function() {
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
					$.each(opts, function(i, d) {
						$('#branch').append('<option value="' + d.id + '">' + d.branch_name + ' [' + d.salon_name + ']</option>');
					});
					$('#branch').trigger('chosen:updated');
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(textStatus, errorThrown);
				}
			});
    	});
        $(".chosen-select").chosen({
             
        });
</script>
