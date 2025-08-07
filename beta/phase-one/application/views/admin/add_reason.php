<?php include('header.php');?>    
<style>
	table.table-bordered.dataTable tbody th, table.table-bordered.dataTable tbody td:first-child{
		padding-left:30px;
	}
	table.table-bordered.dataTable tbody th, table.table-bordered.dataTable tbody td:nth-child(3){
		padding-left:20px;
	}
	table.table-bordered.dataTable tbody th, table.table-bordered.dataTable tbody td:nth-child(4){
		padding-left:20px;
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
              <div class="col-md-4 col-sm-4 col-xs-12" style="margin:0px auto;">
                <div class="x_panel">
                  <div class="x_title">
                      <h2 style="float:none;">Add Query Category</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form id="make_form" name="make_form" method="post" enctype="multipart/form-data" data-parsley-validate>
						<div class="col-xs-12 form-group">
							<label for="fullname">Category * :</label>
							<input type="text" placeholder="Enter Category" autocomplete="off" type="text" id="reason" class="form-control" name="reason" required value="<?php if(!empty($single)){ echo $single->reason;}?>">
							<div class="error" id="status_error"></div>
							<input type="hidden" id="id" class="form-control" name="id" value="<?php if(!empty($single)){ echo $single->id;}?>"/>
						</div>
						<div class="clearfix"></div>
						<div class="clearfix"></div>
						<div class="col-md-3  col-sm-3 col-xs-12">
							<button type="submit" id="submit_button" class="btn btn-success">Save</button>
						</div>	
						<div class="clearfix"></div>
                    </form> 
                  </div>
                </div>
            </div>
			<div class="col-md-8 col-sm-8 col-xs-12" style="margin:0px auto;">
                <div class="x_panel">
					<div class="x_title">
						<h2 style="float:none;">Query Category List</h2>
						<div class="clearfix"></div>
					</div>
                    <table id="example" class="table  table-bordered dt-responsive nowrap example list_table"  style="width:100%">
							<thead>
								<tr>
									<th>Sr.No</th>
									<th>Category</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							
							</tbody>
						</table>
                </div> 
              </div> 
        </div>
	<div class="clearfix"></div>
    <?php include('footer.php');
	if($this->uri->segment(2) == ""){
			$id = 0;
		}else{
			$id = $this->uri->segment(2);
		}
   ?>
<script>
	$("#make_form").validate({	
		rules: {
			reason: "required",
		},
		messages: {
			reason: "Please enter query category!",				
		}, 
		submitHandler: function(form){
			if (confirm("Are you sure to submit the form?")) {
            	form.submit();
			}		
		} 
	});
    $("#reason").keyup(function(){
		$.ajax({
			type: "POST",
			url: "<?=base_url();?>admin/Ajax_controller/get_unique_name_ajax",
			data:{'name':$("#reason").val(),'label':"reason",'table_name':"tbl_complaint_reason",'id':'<?=$id;?>'},
			success: function(data){
				var res = $.trim(data);
				if (res == '0') {
					$("#status_error").html("");
					$("#submit_button").attr('disabled', false);
				}else{
					$("#status_error").html("Category is already added");
					$("#submit_button").attr('disabled', true);
				}
			},
			 error: function(jqXHR, textStatus, errorThrown) {
			   console.log(textStatus, errorThrown);
			}
		});	
	});
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
			var table = $('.example').DataTable({
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
							columns: [0,1],
							modifier: {
								search: 'applied',
								order: 'applied'
							},
						},
					}
				],
				dom: "Blfrtip",
				"ajax":{
					"url" : "<?=base_url();?>admin/ajax_controller/get_all_complaint_reason_ajx",
					"type": "POST",
				},
				"complete": function() {
					$('[data-toggle="tooltip"]').tooltip();			
				}, 
			});
        });
</script>