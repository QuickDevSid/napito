<?php include('header.php'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<style>
	table.dataTable {
		width: 100% !important;
	}
	table .btn-success{
            font-size: 17px;
        }
</style>
<div class="right_col" role="main">
	<div class="">
		<!-- <div class="page-title">
              <div class="title_left">            
              </div>
            </div> -->
		<!-- <div class="clearfix"></div> -->
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin:0px auto;">
				<div class="x_panel" style="padding-left:0">
					<div class="x_title">
						<h2 style="float:none;">Salon Survey List</h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<form id="make_form" style="display: flex;flex-wrap:wrap" name="make_form" method="get" enctype="multipart/form-data" data-parsley-validate>
							<div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<label for="fullname">Accept/Not Accept</label>
								<select id="valid_invalid" class="form-control chosen-select" name="valid_invalid">
									<option value="">Select Option</option>
									<option value="0" <?php if (isset($_GET['valid_invalid']) && ($_GET['valid_invalid'] == '0')) { ?> selected <?php } ?>>Accept</option>
									<option value="1" <?php if (isset($_GET['valid_invalid']) && ($_GET['valid_invalid'] == '1')) { ?> selected <?php } ?>>Not Accept</option>
								</select>
							</div>
							<div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<label for="fullname">Salon Category </label>
								<select id="salon_category" class="form-control chosen-select" name="salon_category">
									<option value="">Select Salon Category</option>
									<option value="Standard" <?php if (isset($_GET['salon_category']) && ($_GET['salon_category'] == 'Standard')) { ?> selected <?php } ?>>Standard</option>
									<option value="Premium" <?php if (isset($_GET['salon_category']) && ($_GET['salon_category'] == 'Premium')) { ?> selected <?php } ?>>Premium</option>
									<option value="Competitor" <?php if (isset($_GET['salon_category']) && ($_GET['salon_category'] == 'Competitor')) { ?> selected <?php } ?>>Competitor</option>
									<option value="Basic" <?php if (isset($_GET['salon_category']) && ($_GET['salon_category'] == 'Basic')) { ?> selected <?php } ?>>Basic</option>
								</select>
							</div>
							<div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<label for="fullname">Salon Type</label>
								<select id="salon_type" class="form-control chosen-select" name="salon_type">
									<option value="">Select Salon Type</option>
									<option value="0" <?php if (isset($_GET['salon_type']) && ($_GET['salon_type'] == '0')) { ?> selected <?php } ?>>Male</option>
									<option value="1" <?php if (isset($_GET['salon_type']) && ($_GET['salon_type'] == '1')) { ?> selected <?php } ?>>Female</option>
									<option value="2" <?php if (isset($_GET['salon_type']) && ($_GET['salon_type'] == '2')) { ?> selected <?php } ?>>Unisex</option>
								</select>
							</div>
							<div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<label for="fullname">Service Provide Type</label>
								<select id="service_provide_type" class="form-control chosen-select" name="service_provide_type">
									<option value="">Select Service Provide Type</option>
									<option value="Waiting" <?php if (isset($_GET['service_provide_type']) && ($_GET['service_provide_type'] == 'Waiting')) { ?> selected <?php } ?>>Waiting</option>
									<option value="Register" <?php if (isset($_GET['service_provide_type']) && ($_GET['service_provide_type'] == 'Register')) { ?> selected <?php } ?>>Register</option>
									<option value="Vendor App" <?php if (isset($_GET['service_provide_type']) && ($_GET['service_provide_type'] == 'Vendor App')) { ?> selected <?php } ?>>Vendor App</option>
									<option value="Customer App" <?php if (isset($_GET['service_provide_type']) && ($_GET['service_provide_type'] == 'Customer App')) { ?> selected <?php } ?>>Customer App</option>
								</select>
							</div>
							<div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<label for="fullname">Billing Counter</label>
								<select id="billing_counter" class="form-control chosen-select" name="billing_counter">
									<option value="">Select Billing Counter</option>
									<option value="Yes@@" <?php if (isset($_GET['billing_counter']) && ($_GET['billing_counter'] == 'Yes@@')) { ?> selected <?php } ?>>Yes</option>
									<option value="Yes@@Receptionist" <?php if (isset($_GET['billing_counter']) && ($_GET['billing_counter'] == 'Yes@@Receptionist')) { ?> selected <?php } ?>>Yes with Receptionist</option>
									<option value="No@@" <?php if (isset($_GET['billing_counter']) && ($_GET['billing_counter'] == "No@@")) { ?> selected <?php } ?>>No</option>
								</select>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<label>City</label>
								<select class="form-control chosen-select" name="city" id="city">
									<option value="">Select City</option>
									<?php
									$city = $this->Admin_model->get_state_city_list('4008');
									if (!empty($city)) {
										foreach ($city as $city_result) {
									?>
											<option value="<?= $city_result->id; ?>" <?php if (isset($_GET['city']) && ($_GET['city'] == $city_result->id)) { ?> selected <?php } ?>><?= $city_result->name; ?> [<?= $city_result->state_name; ?>]</option>
									<?php }
									} ?>
								</select>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<label>Location</label>
								<select class="form-control chosen-select" name="location" id="location">
									<option value="">Select Location</option>
									<?php
									if (isset($_GET['city']) && $_GET['city'] != "") {
										$location = $this->Admin_model->get_city_location($_GET['city']);
										if (!empty($location)) {
											foreach ($location as $customers_result) {
									?>
												<option value="<?= $customers_result->id; ?>" <?php if (isset($_GET['location']) && ($_GET['location'] == $customers_result->id)) { ?> selected <?php } ?>><?= $customers_result->name; ?> [<?= $customers_result->city_name; ?>, <?= $customers_result->state_name; ?>]</option>
									<?php }
										}
									} ?>
								</select>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="<?php echo ($this->session->userdata('user_type') == "0") ? 'display:block;' : 'display:none;'; ?>">
								<label>Executive Name</label>
								<select class="form-control chosen-select" name="executive_name" id="executive_name">
									<option value="">Select Executive Name</option>
									<?php
									$executive_name = $this->Admin_model->get_all_employee_list();

									if (!empty($executive_name)) {
										foreach ($executive_name as $customers_result) {
									?>
											<option value="<?= $customers_result->id; ?>" <?php if (isset($_GET['executive_name']) && ($_GET['executive_name'] == $customers_result->id)) { ?> selected <?php } ?>><?= $customers_result->full_name; ?></option>
									<?php }
									} ?>
								</select>
							</div>
							<div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<label for="fullname">Survey Date</label>
								<input id="date" autocomplete="off" class="form-control" placeholder="Select Survey Date" name="date" value="<?php if (isset($_GET['date']) && ($_GET['date'] != '')) {
																																					echo date('d-m-Y', strtotime($_GET['date']));
																																				} ?>">
							</div>

						<!-- <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<label for="fullname">Executive Name</label>
							<select id="salon_type" class="form-control chosen-select" name="salon_type">
								<option value="">Select Salon Type</option>
								<option value="0" <?php if(isset($_GET['salon_type']) && ($_GET['salon_type'] == '0')){?> selected <?php } ?>>Male</option>
								<option value="1" <?php if(isset($_GET['salon_type']) && ($_GET['salon_type'] == '1')){?> selected <?php } ?>>Female</option>
								<option value="2" <?php if(isset($_GET['salon_type']) && ($_GET['salon_type'] == '2')){?> selected <?php } ?>>Unisex</option>
							</select>
                        </div> -->

						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
							<button style="margin-top: 20px;" type="submit" id="submit_button" class="btn btn-success">Search</button>
							<?php if(isset($_GET['location']) || isset($_GET['billing_counter']) || isset($_GET['service_provide_type']) || isset($_GET['salon_type'])){?>
								<a style="margin-top: 20px;" id="reset_button" class="btn btn-warning" href="<?=base_url().$this->uri->segment(1);?>">Reset</a>
							<?php } ?>
						</div>	
						<div class="clearfix"></div>
                    </form> 
                  </div>
                </div>
            </div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin:0px auto;">
                <div class="x_panel">
                    <table class="table table-striped responsive-utilities jambo_table"style="width: 100%;" id="example">
                        <thead>
                            <tr>

							<?php
							if($this->session->userdata('user_type')  == "0"){?>
                                <th>Sr.No.</th>
								<th>Action</th>
                                <th>Accept/Not Accept</th>
								<!-- <th>Salon Category</th> -->
                                <th>Added On</th>
                                <!-- <th>Executive Name</th> -->
                                <!-- <th>Salon Type</th> -->
                                <th>Salon Name</th>
                                <th>Salon Address</th>
                                <!-- <th>Location</th> -->
                                <th>Service Type</th>
                                <th>Billing Counter</th>
                                <th>No. of People</th>
                                <th>No. of Chairs</th>
                                <!-- <th>Celebrities Names</th> -->
                                <th>Service Rates</th>
                                <th>Salon Owner</th>
                                <th>Owner Contact No.</th>
                                <!-- <th>Owner Free On</th> -->
                                <th>Salon Board Selfie</th>
							<?php }else{ ?>
								<th>Sr.No.</th>
								<th>Salon Name</th>
								<th>Action</th>
							<?php }?>
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
<?php include('footer.php'); ?>
<script>
    	$(document).ready(function() {
			$('#date').datepicker({    
				dateFormat:"dd-mm-yy",
				changeMonth:true,
				changeYear:true,
				maxDate:0,
				maxDate: "0",
				minDate: "-80Y",
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

			var userType = '<?= $this->session->userdata('user_type'); ?>';
			var exportColumns = [0, 3, 4, 6, 7, 8, 9, 11, 12];
			if (userType !== '0') {
				exportColumns = [0, 1]; 
			}
			var table = $('#example').DataTable({
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
				// scrollX:300,
				buttons:[
					{
						extend: "excelHtml5",
						messageBottom: '',
						exportOptions: {
							columns: exportColumns,
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
					"url" : "<?=base_url();?>admin/Ajax_controller/get_salon_survey_ajx",
					"type": "POST",
					"data": function (d) {
						d.city = '<?php echo isset($_GET['city']) ? $_GET['city'] : ''; ?>';
						d.valid_invalid = '<?php echo isset($_GET['valid_invalid']) ? $_GET['valid_invalid'] : ''; ?>';
						d.salon_category = '<?php echo isset($_GET['salon_category']) ? $_GET['salon_category'] : ''; ?>';
						d.location = '<?php echo isset($_GET['location']) ? $_GET['location'] : ''; ?>';
						d.salon_type = '<?php echo isset($_GET['salon_type']) ? $_GET['salon_type'] : ''; ?>';
						d.service_provide_type = '<?php echo isset($_GET['service_provide_type']) ? $_GET['service_provide_type'] : ''; ?>';
						d.billing_counter = '<?php echo isset($_GET['billing_counter']) ? $_GET['billing_counter'] : ''; ?>';
						d.executive_name = '<?php echo isset($_GET['executive_name']) ? $_GET['executive_name'] : ''; ?>';
						d.date = '<?php echo isset($_GET['date']) ? $_GET['date'] : ''; ?>';
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
		
        $("#city").change(function() {
            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>admin/Ajax_controller/get_city_location_ajax",
                data: {
                    'city_name': $("#city").val()
                },
                success: function(data) {
                    $("#location").empty();
                    $('#location').append('<option value="">Select Location</option>');
                    var opts = $.parseJSON(data);
                    $.each(opts, function(i, d) {
                        $('#location').append('<option value="' + d.id + '">' + d.name + '</option>');
                    });
                    $('#location').trigger('chosen:updated');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });
        $(".chosen-select").chosen({
             
        });
</script>
