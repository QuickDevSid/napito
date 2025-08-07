<?php include('header.php') ?>
<!-- Image loader -->
<div class="right_col" role="main">
	<div class="">
		<section class="attendence_section">
			<form name="attendence_form" id="attendence_form" method="post">
				<div class="container animated fadeInRight">
					<div class="">
						<div class="title_left">
							<h3>
								Add Attendance
							</h3>
						</div>
						<div class="row top-section">
							<div class="col-lg-12 col-md-12 one">
								<div class="form-group">
									<div class="col-lg-12 col-md-12">
										<label class="">Attendance Date</label>
									</div>
									<div class="col-lg-4 col-md-8 input_error">
										<input type="text" readonly name="attendance_date" id="attendance_date" placeholder="DD-MM-YYYY" class="form-control" value="<?php if (isset($_GET['date']) && $_GET['date'] != "") {
																																											echo date('d-m-Y', strtotime($_GET['date']));
																																										} else {
																																											echo date('d-m-Y');
																																										} ?>">
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
						<div class="attendence_inner"></div>
						<div class="large_screen_bottom_btn">
							<div class="submit_attendence">
								<button class="btn btn-success" name="submit_attendence" value="submit attendence">Submit</button>
							</div>
						</div>
					</div>
				</div>
			</form>
			<div class="clearfix"></div>
		</section>
	</div>
	</div>
	<?php if($this->session->flashdata('success') !=""){?>
        <div class="alert alert-success animated fadeInUp">
            <strong>Success!</strong> <?=$this->session->flashdata('success')?>
        </div>
    <?php }else if($this->session->flashdata('message') !=""){?>
        <div class="alert alert-danger animated fadeInUp">
            <strong>Error!</strong> <?=$this->session->flashdata('message')?>
        </div>
    <?php }elseif(validation_errors()!=''){?>
        <div class="alert alert-danger animated fadeInUp">
            <strong>Error!</strong> <?=validation_errors()?>
        </div>
    <?php }?>
<!-- Mainly scripts -->
	<script src="<?=base_url('assets/js/jquery-3.3.1.js');?>"></script>
    <script src="<?=base_url("assets/admin/js/popper.min.js");?>"></script>
    <script src="<?=base_url("assets/admin/js/bootstrap.js");?>"></script>
    <script src="<?=base_url("assets/admin/js/plugins/metisMenu/jquery.metisMenu.js");?>"></script>
    <script src="<?=base_url("assets/admin/js/plugins/slimscroll/jquery.slimscroll.min.js");?>"></script>

    <!-- Flot -->
    <script src="<?=base_url("assets/admin/js/plugins/flot/jquery.flot.js");?>"></script>
    <script src="<?=base_url("assets/admin/js/plugins/flot/jquery.flot.tooltip.min.js");?>"></script>
    <script src="<?=base_url("assets/admin/js/plugins/flot/jquery.flot.spline.js");?>"></script>
    <script src="<?=base_url("assets/admin/js/plugins/flot/jquery.flot.resize.js");?>"></script>
    <script src="<?=base_url("assets/admin/js/plugins/flot/jquery.flot.pie.js");?>"></script>
    <script src="<?=base_url("assets/admin/js/plugins/flot/jquery.flot.symbol.js");?>"></script>
    <script src="<?=base_url("assets/admin/js/plugins/flot/jquery.flot.time.js");?>"></script>

    <!-- Peity -->
    <script src="<?=base_url("assets/admin/js/plugins/peity/jquery.peity.min.js");?>"></script>
    <script src="<?=base_url("assets/admin/js/demo/peity-demo.js");?>"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?=base_url("assets/admin/js/inspinia.js");?>"></script>
    <script src="<?=base_url("assets/admin/js/plugins/pace/pace.min.js");?>"></script>

    <!-- jQuery UI -->
    <script src="<?=base_url("assets/admin/js/plugins/jquery-ui/jquery-ui.min.js");?>"></script>

    <!-- Jvectormap -->
    <script src="<?=base_url("assets/admin/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js");?>"></script>
    <script src="<?=base_url("assets/admin/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js");?>"></script>

    <!-- EayPIE -->
    <script src="<?=base_url("assets/admin/js/plugins/easypiechart/jquery.easypiechart.js")?>"></script>

    <!-- Sparkline -->
    <script src="<?=base_url("assets/admin/js/plugins/sparkline/jquery.sparkline.min.js")?>"></script>

    <!-- Sparkline demo data  -->
    <script src="<?=base_url("assets/admin/js/demo/sparkline-demo.js")?>"></script>

     <!-- SUMMERNOTE -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <!-- jquery foemvalidation - added-->
    <script src="<?=base_url('assets/js/jquery.validate.min.js');?>"></script>

    <!-- for datatable -->
     <script src="<?=base_url('assets/admin/js/plugins/dataTables/datatables.min.js');?>"></script>
    <script src="<?=base_url('assets/admin/js/plugins/dataTables/dataTables.bootstrap4.min.js');?>"></script>

     <!-- Tags Input -->
    <script src="<?=base_url('assets/admin/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js');?>"></script>

    <!-- Data picker -->
   <!-- <script src="<?=base_url('assets/admin/js/plugins/datapicker/bootstrap-datepicker.js');?>"></script> -->
   <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
   <script>
             $(".alert").fadeTo(5000, 500).slideUp(500, function(){
                    $(".alert").slideUp(500);
                }); 
            </script>
	<script>
		$("#attendance_date").datepicker({
			dateFormat:"dd-mm-yy",
			changeMonth:true,
			changeYear:true,
			maxDate:0,
			maxDate: "0",
			minDate: "-80Y",
			 
		});
		
		
		$(document).ready(function() {
			getAttendanceForm();
			$("#attendence_form").validate({
				//ignore:'[]';
				rules: {
					attendance_date: {
						required: true,
					},
				},
				messages: {
					attendance_date: {
						required: "Please select attendance date.",
					},
				},
				errorElement: 'span',
				errorPlacement: function(error, element) {
					error.addClass('invalid-feedback');
					element.closest('.input_error').append(error);
				},
				highlight: function(element, errorClass, validClass) {
					$(element).addClass('is-invalid');
				},
				unhighlight: function(element, errorClass, validClass) {
					$(element).removeClass('is-invalid');
				}
			});
		}); 
		$('#attendance_date').change(function(){
			getAttendanceForm();
		});
		function getAttendanceForm(){
			var attendance_date = $('#attendance_date').val();
			$.ajax({
				type: "POST",
				beforeSend: function(){
					$('.ajax_loader').css("visibility", "visible");
				},
				url: "<?=base_url();?>admin/Ajax_controller/get_datewise_emp_attendance_ajx",
				data:{'attendance_date':attendance_date},
				success: function(data){
					$('.attendence_inner').html('').append(data);
				},
				complete: function(){
					setTimeout(function() {
						$('.ajax_loader').css("visibility", "hidden");
					}, 1000);
					
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(textStatus, errorThrown);
				}
			});
		}
		
		
		
		
	</script>
<?php include('footer.php') ?>