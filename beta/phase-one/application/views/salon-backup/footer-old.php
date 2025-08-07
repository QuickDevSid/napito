 <!-- footer content -->
 <?php if($this->session->flashdata('success') !=""){?>
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
                }); 
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
    <script type="text/javascript" src="<?=base_url()?>salon_assets/js/datepicker/daterangepicker.js"></script>

    <script src="<?=base_url()?>salon_assets/js/custom-salon.js"></script>

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
                <!-- script for validation which is used in all forms -->
    


    <!-- worldmap -->
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

   
    </script>
    <script type="text/javascript">
                        $(document).ready(function () {
                            $(".chosen-select").chosen({
                                max_selected_options: 5
                            });
							$('.bell_open').click(function(){
									$('.bell_open_cc').toggle();
							});
				});
				setTimeout(function(){
					$('.loader_Box').fadeOut();
				},1500);
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css">
</body>

</html>
