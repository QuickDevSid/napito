<style>
    .dialog-container {
        position: fixed;
        top: 0;
        left: 0;
        /* transform: translate(-50%, -50%); */
        z-index: 9999;
        width: 100%;
        height: 100%;
        background-color: #20202066;
    }
    .dialog {
        position: absolute;
        top: 20%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 400px;
        background: #fff;
        padding: 10px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    .dialog-header {
        padding: 10px;
        font-weight: bold;
        background: #0056d0;
        color: #f6f7f8;
    }

    .dialog-body {
        padding: 10px;
    }

    .dialog-footer {
        text-align: center;
        padding: 10px 0;
    }

    .dialog-footer button {
        padding: 5px 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
        background: #eee;
        cursor: pointer;
    }

    .dialog-footer button:hover {
        box-shadow: inset 2px 2px 4px 0 #ccc;
    }
         .back_button_class{
            position: fixed;
            bottom: 15px !important;
            right: 15px;
            background: #0000ff !important;
            color: #fff;
            padding: 10px 20px 10px 20px;
            display: block !important;
            z-index:9 !important;
            border-radius: 20px;
        }
        .back_button_class:hover{
            background: #fff !important;
            color: #0000ff;
        }
</style> 
<?php if($this->uri->segment(1) == 'add-enquiry-form'){ ?>
<div id="feedback-form" class="feedback-form">
      <!-- <button type="button" class="feedback-form-btn btn-lg btn-enquiry" id="OpenForm">Rate Card</button> -->
      <div class="feedback_form_area">
         <div class="form-head">
            <h3>Rate Card</h3>
         </div>
         <div class="feedback_form_area_inner">
		 <div class="col-md-12">
				<div class="row">					
					<div class="col-md-6">
						<h4>Services</h4>
						<table class="declare" style="450px;">
							<thead>
								<tr>
									<th>Sr.No</th>
									<th>Category</th>
									<th>Service</th>
									<th>Price</th>
									<th>Discounted Price</th>
								</tr>
							</thead>
							<tbody>						
								<tr>
									<td>1</td>
									<td>May</td>
									<td>2021</td>
									<td>01-11-2021 </td>
									<td>01-11-2021</td>
								</tr>								
							</tbody> 
						</table>
					</div>
				<div class="col-md-6"> 
						<h4>Products</h4>
						<table class="declare" style="450px;">
							<thead>
								<tr>
									<th>Sr.No</th>
									<th>Category</th>
									<th>Product</th>
									<th>Price</th>
									<th>Discounted Price</th>
								</tr>
							</thead>
							<tbody>	
								<tr>
									<td>1</td>
									<td>July</td>
									<td>2021</td>
									<td>01-11-2021</td>
									<td>01-11-2021</td>
								</tr> 
							</tbody> 
						</table>
					</div>
				</div>
				</div>
         </div>
    </div>
</div>
<?php } ?>
<div class="row">
    <div class="col-md-12"  style="text-align:right;">
        <button class="btn btn-default back_button_class" id="backButton"><i class="fa fa-chevron-left"></i>&nbsp;&nbsp;Back</button>
    </div>
</div>
<div class="modal fade" id="dashboardModal" tabindex="-1" aria-labelledby="dashboardModalLabel" aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.62);">
    <div class="modal-dialog" id="dashboardModal_dialog" style="margin-top:150px;width:1000px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dashboardModalLabel"></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;"  onclick="closePopup('dashboardModal')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="dashboardModal_response"></div>
        </div>
    </div>
</div>
<div class="dialog-container" id="alertDialog" style="display: none;">
  <div class="dialog">
    <div class="dialog-header" id="alertMessage"></div>
    <div class="dialog-footer">
      <button onclick="closeDialog()">OK</button>
    </div>
  </div>
</div>
<div class="dialog-container" id="confirmDialog" style="display: none;">
  <div class="dialog">
    <div class="dialog-header">Confirmation</div>
    <div class="dialog-body" id="confirmMessage">Are you sure?</div>
    <div class="dialog-footer">
      <button id="cancelButton">Cancel</button>
      <button id="okButton">OK</button>
    </div>
  </div>
</div>

 <!-- footer content -->
 <!-- <?php if($this->session->flashdata('success') !=""){?>
                <div class="login_hide_show">
                <div class="alert alert-success animated fadeInUp " style="color:#297401;">
                    <strong style="color:#297401;">Success!</strong> <?=$this->session->flashdata('success')?>
                </div>
                </div>
            <?php }else if($this->session->flashdata('message') !=""){?>
                <div class="login_hide_show">
                <div class="alert alert-danger animated fadeInUp">
                    <strong>Error!</strong> <?=$this->session->flashdata('message')?>
                </div>
                </div>
            <?php }elseif(validation_errors()!=''){?>
                <div class="login_hide_show">
                <div class="alert alert-danger animated fadeInUp">
                    <strong>Error!</strong> <?=validation_errors()?>
                </div>
            </div>
            <?php }?>
            <script>
             $(".alert").fadeTo(5000, 500).slideUp(500, function(){
                    $(".alert").slideUp(500);
                });  -->

<div id="alert-box"></div>

                <?php if($this->session->flashdata('success') !=""){?>
    <div class="login_hide_show alert alert-success animated fadeInUp" style="color:#297401;">
        <strong style="color:#297401;"></strong> <?=$this->session->flashdata('success')?>
    </div>
<?php } else if($this->session->flashdata('message') !=""){?>
    <div class="login_hide_show alert alert-danger animated fadeInUp">
        <strong></strong> <?=$this->session->flashdata('message')?>
    </div>
<?php } elseif(validation_errors()!=''){?>
    <div class="login_hide_show alert alert-danger animated fadeInUp">
        <strong></strong> <?=validation_errors()?>
    </div>
<?php }?>

<script>
   	$("#OpenForm").click(function(){
        $(".feedback_form_area").animate({
            width: "toggle"
        }, function() {
            if ($(".feedback_form_area").is(":visible")) {
                $('body').append('<div class="hide_body"></div>');
            } else {
                $('.hide_body').remove();
            }
        });
    });
        document.getElementById("backButton").addEventListener("click", function () {
            window.history.back();
        });
    function openDialog(message) {
        $("#alertMessage").text(message); 
        $("#alertDialog").show();
    }
    function closeDialog() {
        $("#alertDialog").hide();
    }
    function openConfirmationDialog(message, callback) {
        $("#confirmMessage").text(message);
        $("#confirmDialog").show();

        $("#okButton").click(function() {
            $("#confirmDialog").hide();
            callback(true);
        });

        $("#cancelButton").click(function() {
            $("#confirmDialog").hide();
            callback(false);
        });
    }

    $(".alert").fadeTo(5000, 500).slideUp(500, function(){
        $(".alert").slideUp(500);
    });
</script>


            </script>
                
                <!-- /footer content -->
            </div>
            <!-- /page content -->

        </div>

    </div>

    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>



    <!-- here php code written which is use for success or login fail with color -->



    <script src="<?=base_url()?>salon_assets/js/bootstrap.min.js"></script>
    
   
    <script src="<?=base_url()?>salon_assets/js/chartjs/chart.min.js"></script>
    <!-- bootstrap progress js -->
    <script src="<?=base_url()?>salon_assets/js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="<?=base_url()?>salon_assets/js/nicescroll/jquery.nicescroll.min.js"></script>
    <!-- icheck -->
    <script src="<?=base_url()?>salon_assets/js/icheck/icheck.min.js"></script>
    <!-- daterangepicker -->
    <script type="text/javascript" src="<?=base_url()?>salon_assets/js/moment.min.js"></script>
    <!-- <script type="text/javascript" src="<?=base_url()?>salon_assets/js/datepicker/daterangepicker.js"></script> -->
    
    <script src="<?=base_url()?>salon_assets/js/custom-salon.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery.filer@1.3.0/js/jquery.filer.min.js"></script>

    <!-- flot js -->
    <!--[if lte IE 8]><script type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
    <script type="text/javascript" src="<?=base_url()?>salon_assets/js/flot/jquery.flot.js"></script>
    <script type="text/javascript" src="<?=base_url()?>salon_assets/js/flot/jquery.flot.pie.js"></script>
    <script type="text/javascript" src="<?=base_url()?>salon_assets/js/flot/jquery.flot.orderBars.js"></script>
    <script type="text/javascript" src="<?=base_url()?>salon_assets/js/flot/jquery.flot.time.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>salon_assets/js/flot/date.js"></script>
    <script type="text/javascript" src="<?=base_url()?>salon_assets/js/flot/jquery.flot.spline.js"></script>
    <script type="text/javascript" src="<?=base_url()?>salon_assets/js/flot/jquery.flot.stack.js"></script>
    <script type="text/javascript" src="<?=base_url()?>salon_assets/js/flot/curvedLines.js"></script>
    <script type="text/javascript" src="<?=base_url()?>salon_assets/js/flot/jquery.flot.resize.js"></script>
    <script type="text/javascript" src="<?=base_url()?>salon_assets/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>admin_assets/js/chosen.jquery.js"></script>
    <script type="text/javascript" src="<?=base_url()?>admin_assets/js/chosen.jquery.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>admin_assets/js/chosen.proto.js"></script>
    <script type="text/javascript" src="<?=base_url()?>admin_assets/js/chosen.proto.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/js/slick.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/js/slick.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/air-datepicker/dist/js/datepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/air-datepicker/dist/js/i18n/datepicker.en.js"></script>
    <!-- <script src="admin_assets/js/jquery.timesetter.js"></script> -->
    <!-- <script src="admin_assets/js/booking_calender.js"></script> -->
    <!-- <script src="admin_assets/js/jquery.timesetter.es5"></script> -->
    <!-- <script src="admin_assets/js/jquery.timesetter.es5.min"></script> -->


                <!-- script for validation which is used in all forms -->
    


    <!-- worldmap -->
   
    <script src="https://cdn.jsdelivr.net/npm/clockpicker/dist/jquery-clockpicker.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>salon_assets/js/maps/jquery-jvectormap-2.0.1.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>salon_assets/js/maps/gdp-data.js"></script>
    <script type="text/javascript" src="<?=base_url()?>salon_assets/js/maps/jquery-jvectormap-world-mill-en.js"></script>
    <script type="text/javascript" src="<?=base_url()?>salon_assets/js/maps/jquery-jvectormap-us-aea-en.js"></script>
   <script type="text/javascript" src="<?=base_url()?>salon_assets/js/datepicker/daterangepicker.js"></script>
        <!-- Datatables -->
        <script src="<?=base_url()?>salon_assets/js/datatables/js/jquery.dataTables.js"></script>
        <script src="<?=base_url()?>salon_assets/js/datatables/tools/js/dataTables.tableTools.js"></script>


        <script src="<?=base_url("assets/admin/js/popper.min.js");?>"></script>
    <script src="<?=base_url("assets/admin/js/bootstrap.js");?>"></script>
   
    <script src="<?=base_url("assets/admin/js/plugins/jquery-ui/jquery-ui.min.js");?>"></script>

    <!-- Jvectormap -->
    <script src="<?=base_url("assets/admin/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js");?>"></script>
    <script src="<?=base_url("assets/admin/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js");?>"></script>

    <!-- EayPIE -->
    <script src="<?=base_url("assets/admin/js/plugins/easypiechart/jquery.easypiechart.js")?>"></script>


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
    <script src="<?=base_url();?>assets/admin/js/chosen.jquery.js"></script>

    <link rel="stylesheet" href="<?=base_url()?>salon_assets/css/flatpickr.min.css">  
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tippy.js/6.3.1/tippy-bundle.umd.min.js"></script>


    <script type="text/javascript">  
        $(document).ready(function () {
            $('.single_date').daterangepicker({         //here single_date which is use for date display
                                                        //which is used by using class="single_date"
                singleDatePicker: true,
                calender_style: "picker_1",
                format:"DD-MM-YYYY"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
            $('#single_cal2').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_2"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
            $('#single_cal3').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_3"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
            $('#single_cal4').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_4"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
        });

        function showDashboardDataPopup(type){
            $('.loader_div').show();
            $.ajax({
                url: "<?= base_url(); ?>salon/Ajax_controller/get_dashboard_popup_data_ajx",
                method: 'POST',
                data: { type: type },
                success: function(response) {
                    $('#dashboardModal_response').html(response)
                    showPopup('dashboardModal');
                    $('.loader_div').hide();
                },
                error: function() {
                    $('.loader_div').hide();
                    alert("Error fetching service details");
                }
            });
        }
   
    </script>
    <script type="text/javascript">
                        $(document).ready(function () {
                            $(".chosen-select").chosen();
                            $(".form-select").chosen();
							$('.bell_open').click(function(){
									$('.bell_open_cc').toggle();
							});
				});
				setTimeout(function(){
					$('.loader_Box').fadeOut();
				},1500);
    </script>
    
    <script>
        $(document).ready(function() {
            updateSubscriptionData();
        $('.timepicker').clockpicker({
            donetext: 'Done', 
            twelvehour: false
        });
    });
    </script>
    <script>	
        flatpickr(".datepicker_show", { 
        	dateFormat: "d-m-Y", 
        });    
    </script>


<script>
// var socketURL = "ws://localhost:8080";
var branch_id = '<?php echo base64_encode($this->session->userdata('branch_id')); ?>';
var salon_id = '<?php echo base64_encode($this->session->userdata('salon_id')); ?>';
var uid = '<?php echo base64_encode($this->session->userdata('branch_id').'@@@'.$this->session->userdata('salon_id')); ?>';
var type = '<?php echo base64_encode('receiver'); ?>';
var project = '<?php echo base64_encode('salon'); ?>';
var socketURL = "wss://napit.in:4444?project="+project+"&uid="+uid+"&type="+type;

var websocket = new WebSocket(socketURL);

websocket.onopen = function() {
    console.log('Connected to WebSocket server at ' + socketURL);
};

websocket.onmessage = function(event) {
    try {
        var eventData = JSON.parse(event.data);
        console.log(eventData);

        if (eventData.service_date && eventData.stylist) {
            var alertBox = document.getElementById('alert-box');
            var message = eventData.message;
            alertBox.innerHTML = message;
            alertBox.style.display = 'block';
            setTimeout(function() {
                alertBox.style.display = 'none';
            }, 10000);
        }else if(eventData.subscription_id){
            console.log('Subscription data updation triggered');
            updateSubscriptionData();
        }
    } catch (error) {
        console.log('Error parsing WebSocket message:', error);
    }
};

websocket.onclose = function(event) {
    console.log('WebSocket connection closed:', event);
};

websocket.onerror = function(error) {
    console.log('WebSocket error:', error);
};

function updateSubscriptionData(){
    $.ajax({
        url: "<?= base_url(); ?>salon/Ajax_controller/set_updated_subscription_data_ajx",
        method: 'POST',
        data: { },
        success: function(response) {
            if(response == '1'){
                console.log('Subscription data updated successfully');
            }else{
                console.log('Something went wrong');
            }
        },
        error: function() {
            console.log('Error while subscription data update');
        }
    });
}
</script>


    
    <!-- /datepicker -->
    <!-- /footer content -->
      <!-- Datatables -->
        <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>
        <!-- <script src='https://unpkg.com/fullcalendar@3.10.2/dist/fullcalendar.min.js'></script> -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css">
</body>

</html>
