<?php include('header.php');?>
<style>
	.note-insert{
		display:none;
	}
	
	
	/*.fullDayClass:checked {
	  background-color: green!important;
	}*/
	.custom-checkbox > .custom-checkbox-input:not(:checked) + label:before{
		content: '';
		position: absolute;
		left:0; 
		top: 50%;
		margin-top:-10px;
		width: 17px; 
		height: 17px;
		border: 1px solid #a7a7a7;
		background: #fff;
		border-radius: 2px;
	}
	.custom-checkbox > .custom-checkbox-input:not(:checked) + label:after {
		font: normal normal normal 12px/1 'Glyphicons Halflings';
		content: '\e013';
		position: absolute;
		top: 50%;
		margin-top:-7px;
		left: 2px;
		color: #ffffff;
		xtransition: all .2s;
	}
	
	
	.custom-checkbox > .custom-checkbox-input,
	.custom-checkbox > label{
		margin-bottom:0px !important;
		-webkit-touch-callout: none;
		-webkit-user-select: none;
		-khtml-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
	}
	.custom-checkbox > .custom-checkbox-input:not(:checked),
	.custom-checkbox > .custom-checkbox-input:checked {
		position: absolute;
	}
	.custom-checkbox > .custom-checkbox-input:not(:checked) + label,
	.custom-checkbox > .custom-checkbox-input:checked + label {
		position: relative;
		padding-left: 22px;
		cursor: pointer;
	}
	
	.custom-checkbox > .custom-checkbox-input:not(:checked) + label:before{
		content: '';
		position: absolute;
		left:0; 
		top: 50%;
		margin-top:-10px;
		width: 17px; 
		height: 17px;
		border: 1px solid #a7a7a7;
		background: #fff;
		border-radius: 2px;
	}
	.custom-checkbox > .custom-checkbox-input:not(:checked) + label:after {
		font: normal normal normal 12px/1 'Glyphicons Halflings';
		content: '\e013';
		position: absolute;
		top: 50%;
		margin-top:-7px;
		left: 2px;
		color: #ffffff;
		xtransition: all .2s;
	}
	.custom-checkbox > .custom-checkbox-input:checked + label:before {
		content: '';
		position: absolute;
		left:0; 
		top: 50%;
		margin-top:-10px;
		width: 17px; 
		height: 17px;
		border: 1px solid #ff0000;
		background: #ff0000;
		border-radius: 2px;
	}
	.custom-checkbox > .custom-checkbox-input:checked + label:after {
		font: normal normal normal 12px/1 'Glyphicons Halflings';
		content: '\e013';
		position: absolute;
		top: 50%;
		margin-top:-7px;
		left: 2px;
		color: #ffffff;
		xtransition: all .2s;
	}
	
	.custom-checkbox > .custom-checkbox-input:not(:checked) + label:after {
		opacity: 0;
		transform: scale(0);
	}
	.custom-checkbox > .custom-checkbox-input:checked + label:after {
		opacity: 1;
		transform: scale(1);
	}
	
	.custom-checkbox > .custom-checkbox-input[data-indeterminate] + label:after,
	.custom-checkbox > .custom-checkbox-input[data-indeterminate] + label:after {
		content: '\2212';
		left: 2px;
		opacity: 1;
		transform: scale(1);
	}
	
	.custom-checkbox > .custom-checkbox-input:disabled:not(:checked) + label:before,
	.custom-checkbox > .custom-checkbox-input:disabled:checked + label:before {
	  	box-shadow: none;
	  	background-color: #eeeeee;
		border-color: #eeeeee;
		cursor: not-allowed;
		opacity: 1;
		color: #dadada;
	}
	
	
	
	.custom-checkbox > .fullDayClass,
	.custom-checkbox > label{
		margin-bottom:0px !important;
		-webkit-touch-callout: none;
		-webkit-user-select: none;
		-khtml-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
	}
	.custom-checkbox > .fullDayClass:not(:checked),
	.custom-checkbox > .fullDayClass:checked {
		position: absolute;
	}
	.custom-checkbox > .fullDayClass:not(:checked) + label,
	.custom-checkbox > .fullDayClass:checked + label {
		position: relative;
		padding-left: 22px;
		cursor: pointer;
	}
	
	.custom-checkbox > .fullDayClass:not(:checked) + label:before{
		content: '';
		position: absolute;
		left:0; 
		top: 50%;
		margin-top:-10px;
		width: 17px; 
		height: 17px;
		border: 1px solid #a7a7a7;
		background: #fff;
		border-radius: 2px;
	}
	.custom-checkbox > .fullDayClass:not(:checked) + label:after {
		font: normal normal normal 12px/1 'Glyphicons Halflings';
		content: '\e013';
		position: absolute;
		top: 50%;
		margin-top:-7px;
		left: 2px;
		color: #ffffff;
		xtransition: all .2s;
	}
	.custom-checkbox > .fullDayClass:checked + label:before {
		content: '';
		position: absolute;
		left:0; 
		top: 50%;
		margin-top:-10px;
		width: 17px; 
		height: 17px;
		border: 1px solid #4caf50;
		background: #4caf50;
		border-radius: 2px;
	}
	.custom-checkbox > .fullDayClass:checked + label:after {
		font: normal normal normal 12px/1 'Glyphicons Halflings';
		content: '\e013';
		position: absolute;
		top: 50%;
		margin-top:-7px;
		left: 2px;
		color: #ffffff;
		xtransition: all .2s;
	}
	
	.custom-checkbox > .fullDayClass:not(:checked) + label:after {
		opacity: 0;
		transform: scale(0);
	}
	.custom-checkbox > .fullDayClass:checked + label:after {
		opacity: 1;
		transform: scale(1);
	}
	
	.custom-checkbox > .fullDayClass[data-indeterminate] + label:after,
	.custom-checkbox > .fullDayClass[data-indeterminate] + label:after {
		content: '\2212';
		left: 2px;
		opacity: 1;
		transform: scale(1);
	}
	
	.custom-checkbox > .fullDayClass:disabled:not(:checked) + label:before,
	.custom-checkbox > .fullDayClass:disabled:checked + label:before {
	  	box-shadow: none;
	  	background-color: #eeeeee;
		border-color: #eeeeee;
		cursor: not-allowed;
		opacity: 1;
		color: #dadada;
	}
	
	.custom-checkbox > .halfDayClass,
	.custom-checkbox > label{
		margin-bottom:0px !important;
		-webkit-touch-callout: none;
		-webkit-user-select: none;
		-khtml-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
	}
	.custom-checkbox > .halfDayClass:not(:checked),
	.custom-checkbox > .halfDayClass:checked {
		position: absolute;
	}
	.custom-checkbox > .halfDayClass:not(:checked) + label,
	.custom-checkbox > .halfDayClass:checked + label {
		position: relative;
		padding-left: 22px;
		cursor: pointer;
	}
	
	.custom-checkbox > .halfDayClass:not(:checked) + label:before{
		content: '';
		position: absolute;
		left:0; 
		top: 50%;
		margin-top:-10px;
		width: 17px; 
		height: 17px;
		border: 1px solid #a7a7a7;
		background: #fff;
		border-radius: 2px;
	}
	.custom-checkbox > .halfDayClass:not(:checked) + label:after {
		font: normal normal normal 12px/1 'Glyphicons Halflings';
		content: '\e013';
		position: absolute;
		top: 50%;
		margin-top:-7px;
		left: 2px;
		color: #ffffff;
		xtransition: all .2s;
	}
	
	.custom-checkbox > .halfDayClass:checked + label:before {
		content: '';
		position: absolute;
		left:0; 
		top: 50%;
		margin-top:-10px;
		width: 17px; 
		height: 17px;
		border: 1px solid #ffc107;
		background: #ffc107;
		border-radius: 2px;
	}
	
	.custom-checkbox > .halfDayClass:checked + label:after {
		font: normal normal normal 12px/1 'Glyphicons Halflings';
		content: '\e013';
		position: absolute;
		top: 50%;
		margin-top:-7px;
		left: 2px;
		color: #ffffff;
		xtransition: all .2s;
	}
	
	.custom-checkbox > .halfDayClass:not(:checked) + label:after {
		opacity: 0;
		transform: scale(0);
	}
	.custom-checkbox > .halfDayClass:checked + label:after {
		opacity: 1;
		transform: scale(1);
	}
	
	.custom-checkbox > .halfDayClass[data-indeterminate] + label:after,
	.custom-checkbox > .halfDayClass[data-indeterminate] + label:after {
		content: '\2212';
		left: 2px;
		opacity: 1;
		transform: scale(1);
	}
	
	.custom-checkbox > .halfDayClass:disabled:not(:checked) + label:before,
	.custom-checkbox > .halfDayClass:disabled:checked + label:before {
	  	box-shadow: none;
	  	background-color: #eeeeee;
		border-color: #eeeeee;
		cursor: not-allowed;
		opacity: 1;
		color: #dadada;
	}
	
	.custom-checkbox > .weekendDayClass,
	.custom-checkbox > label{
		margin-bottom:0px !important;
		-webkit-touch-callout: none;
		-webkit-user-select: none;
		-khtml-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
	}
	.custom-checkbox > .weekendDayClass:not(:checked),
	.custom-checkbox > .weekendDayClass:checked {
		position: absolute;
	}
	.custom-checkbox > .weekendDayClass:not(:checked) + label,
	.custom-checkbox > .weekendDayClass:checked + label {
		position: relative;
		padding-left: 22px;
		cursor: pointer;
	}
	
	.custom-checkbox > .weekendDayClass:not(:checked) + label:before{
		content: '';
		position: absolute;
		left:0; 
		top: 50%;
		margin-top:-10px;
		width: 17px; 
		height: 17px;
		border: 1px solid #a7a7a7;
		background: #fff;
		border-radius: 2px;
	}
	.custom-checkbox > .weekendDayClass:not(:checked) + label:after {
		font: normal normal normal 12px/1 'Glyphicons Halflings';
		content: '\e013';
		position: absolute;
		top: 50%;
		margin-top:-7px;
		left: 2px;
		color: #ffffff;
		xtransition: all .2s;
	}
	.custom-checkbox > .weekendDayClass:checked + label:before {
		content: '';
		position: absolute;
		left:0; 
		top: 50%;
		margin-top:-10px;
		width: 17px; 
		height: 17px;
		border: 1px solid #ff0000;
		background: #ff0000;
		border-radius: 2px;
	}
	.custom-checkbox > .weekendDayClass:checked + label:after {
		font: normal normal normal 12px/1 'Glyphicons Halflings';
		content: '\e013';
		position: absolute;
		top: 50%;
		margin-top:-7px;
		left: 2px;
		color: #ffffff;
		xtransition: all .2s;
	}
	
	.custom-checkbox > .weekendDayClass:not(:checked) + label:after {
		opacity: 0;
		transform: scale(0);
	}
	.custom-checkbox > .weekendDayClass:checked + label:after {
		opacity: 1;
		transform: scale(1);
	}
	
	.custom-checkbox > .weekendDayClass[data-indeterminate] + label:after,
	.custom-checkbox > .weekendDayClass[data-indeterminate] + label:after {
		content: '\2212';
		left: 2px;
		opacity: 1;
		transform: scale(1);
	}
	
	.custom-checkbox > .weekendDayClass:disabled:not(:checked) + label:before,
	.custom-checkbox > .weekendDayClass:disabled:checked + label:before {
	  	box-shadow: none;
	  	background-color: #eeeeee;
		border-color: #eeeeee;
		cursor: not-allowed;
		opacity: 1;
		color: #dadada;
	}
	table tbody tr td p{
	    text-wrap: balance !important;
	    white-space: break-spaces;
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
            
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel overflow-inner">
                    <div class="x_title table_head_title">
                        <h2>Work Schedule List</h2>
						<a href="<?=base_url();?>add_work_schedule" class="btn btn-primary float-right">
						<!-- <i class="fa fa-plus" aria-hidden="true"></i>  -->
						Add Work Schedule</a>
                        <div class="clearfix"></div>
                    </div>

                    <table class="table table-striped dt-responsive nowrap example list_table" style="width:100%;">
                        <thead class="thead_tab_new">
                            <tr>
                                <th>Sr. No.</th>
                                <th>Work Schedule Name</th>
                                <th>Work Schedule Description</th>
                                <th>View Schedule</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            

                        </tbody>
                    </table>
                    <div class="clearfix"></div>

                    <div class="x_content">
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Modal -->
        <div class="modal fade scheduleModal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Work Schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body schedule_data">
                ...
              </div>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
        <?php include('footer.php');
			$id = 0;
			if($this->uri->segment(2) != ""){
				$id = $this->uri->segment(2);
			}
		?>
        <script>
        $("#package_form").validate({
            rules: {
                enquiry_status: "required",
            },
            messages: {
                enquiry_status: "Please enter Enquiry Status !",

            },
            submitHandler: function(form) {
				
                //form.submit();
            }
        });
        $("#enquiry_status ").keyup(function() {
            // alert("Hiii");
            $.ajax({
                type: "POST",
                url: "<?=base_url();?>admin/ajax_controller/get_unique_enquiry_status_ajax",
                data: {
                    'name': $("#enquiry_status ").val(),
                    'table_name': "tbl_enquiry_status",
                    'id': '<?=$id?>'
                },

                success: function(data) {
                    if (data == "0") {
                        $(".status_error").html("");

                        $("#submit_button").attr('disabled', false);
                    } else {
                        $(".status_error").html("Enquiry Status is already added.");

                        $("#submit_button").attr('disabled', true);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });
        </script>
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
						// Just this once, load all data from the server...
						data.start = 0;
						data.length = 2147483647;
				
						dt.one('preDraw', function (e, settings) {
							// Call the original action function 
							oldExportAction(self, e, dt, button, config);
				
							dt.one('preXhr', function (e, s, data) {
								// DataTables thinks the first item displayed is index 0, but we're not drawing that.
								// Set the property to what it was before exporting.
								settings._iDisplayStart = oldStart;
								data.start = oldStart;
							});
				
							// Reload the grid with the original page. Otherwise, API functions like table.cell(this) don't work properly.
							setTimeout(dt.ajax.reload, 0);
				
							// Prevent rendering of the full data to the DOM
							return false;
						});
					});
				
					// Requery the server with the new one-time export settings
					dt.ajax.reload();
				};
				
				var table = $('.example').DataTable({
					"lengthChange": true,
					'searching': true,
					"processing": true,
					"serverSide": true,
					"responsive": true,
					"cache": false,
					"order": [[0, "desc" ]],
					dom:"Blfrtip",
					buttons:[
						{
							extend: "excelHtml5",
							messageBottom: '',
							exportOptions: {
								columns: [0,1,2,4],
								modifier: {
									search: 'applied',
									order: 'applied'
								},
							},
							action: newExportAction,
						}
					],
					lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
					
					"ajax":{
						"url" : "<?=base_url();?>hr/ajax_controller/get_work_schedule_list_ajx",
						"type": "POST",
					},
					"complete": function() {
						$('[data-toggle="tooltip"]').tooltip();			
					}, 
				});
				/*var info = table.page.info();
				$('#tableInfo').html(
					'Currently showing page '+(info.page+1)+' of '+info.pages+' pages.'
				);*/
			});
			
			function openschedulemodal(id){
			    $.ajax({
                    type: "POST",
                    url: "<?=base_url();?>hr/ajax_controller/get_schedule_data_ajax",
                    data: {
                        'schedule_id': id,
                    },
    
                    success: function(data) {
                        $('.schedule_data').html(data);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
			   
			}
			
		</script>