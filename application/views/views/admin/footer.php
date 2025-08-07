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
				
				
				// document.addEventListener('DOMContentLoaded', function () {
                //     var toggleMenus = document.querySelectorAll('.side-menu > li > a');
                //     toggleMenus.forEach(function (toggleMenu) {
                //         toggleMenu.addEventListener('click', function (event) {
                //             event.preventDefault(); // Prevent default link behavior
                //             var submenu = this.nextElementSibling;
                //             if (submenu.classList.contains('child_menu')) {
                //                 submenu.classList.toggle('show');
                //             }
                //         });
                //     });
                // });
	
            </script>

                <!-- <footer>
                    <div class="">
                        
                    </div>
                    <div class="clearfix"></div>
                </footer> -->
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


    <script src="<?=base_url()?>admin_assets/js/jquery-ui.js"></script>
    <script src="<?=base_url()?>admin_assets/js/bootstrap.min.js"></script>

   
    <script src="<?=base_url()?>admin_assets/js/chartjs/chart.min.js"></script>
    <!-- bootstrap progress js -->
    <script src="<?=base_url()?>admin_assets/js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="<?=base_url()?>admin_assets/js/nicescroll/jquery.nicescroll.min.js"></script>
    <!-- icheck -->
    <script src="<?=base_url()?>admin_assets/js/icheck/icheck.min.js"></script>
    <!-- daterangepicker -->
    <script type="text/javascript" src="<?=base_url()?>admin_assets/js/moment.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>admin_assets/js/datepicker/daterangepicker.js"></script>

    <script src="<?=base_url()?>admin_assets/js/custom.js"></script>

    <!-- flot js -->
    <!--[if lte IE 8]><script type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
    <script type="text/javascript" src="<?=base_url()?>admin_assets/js/flot/jquery.flot.js"></script>
    <script type="text/javascript" src="<?=base_url()?>admin_assets/js/flot/jquery.flot.pie.js"></script>
    <script type="text/javascript" src="<?=base_url()?>admin_assets/js/flot/jquery.flot.orderBars.js"></script>
    <script type="text/javascript" src="<?=base_url()?>admin_assets/js/flot/jquery.flot.time.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>admin_assets/js/flot/date.js"></script>
    <script type="text/javascript" src="<?=base_url()?>admin_assets/js/flot/jquery.flot.spline.js"></script>
    <script type="text/javascript" src="<?=base_url()?>admin_assets/js/flot/jquery.flot.stack.js"></script>
    <script type="text/javascript" src="<?=base_url()?>admin_assets/js/flot/curvedLines.js"></script>
    <script type="text/javascript" src="<?=base_url()?>admin_assets/js/flot/jquery.flot.resize.js"></script>
    <script type="text/javascript" src="<?=base_url()?>admin_assets/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>admin_assets/js/chosen.jquery.js"></script>
    <script type="text/javascript" src="<?=base_url()?>admin_assets/js/chosen.jquery.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>admin_assets/js/chosen.proto.js"></script>
    <script type="text/javascript" src="<?=base_url()?>admin_assets/js/chosen.proto.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/tinymce@5/tinymce.min.js" referrerpolicy="origin"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script> -->
    <script src="<?=base_url()?>admin_assets/js/jquery.timesetter.js"></script>
	<script type="text/javascript" src="<?=base_url()?>admin_assets/js/maps/jquery-jvectormap-2.0.1.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>admin_assets/js/maps/gdp-data.js"></script>
	<script type="text/javascript" src="<?=base_url()?>admin_assets/js/maps/jquery-jvectormap-world-mill-en.js"></script>
	<script type="text/javascript" src="<?=base_url()?>admin_assets/js/maps/jquery-jvectormap-us-aea-en.js"></script>
	<script type="text/javascript" src="<?=base_url()?>admin_assets/js/datepicker/daterangepicker.js"></script>
	<!-- Datatables -->
	<script src="<?=base_url()?>admin_assets/js/datatables/js/jquery.dataTables.js"></script>
	<script src="<?=base_url()?>admin_assets/js/datatables/tools/js/dataTables.tableTools.js"></script>
	<script type="text/javascript">
        $(document).ready(function () {
            // $('.single_date').daterangepicker({         //here single_date which is use for date display
            //                                             //which is used by using class="single_date"
            //     singleDatePicker: true,
            //     calender_style: "picker_1",
            //     format:"DD-MM-YYYY"
            // }, function (start, end, label) {
            //     console.log(start.toISOString(), end.toISOString(), label);
            // });
            // $('#single_cal2').daterangepicker({
            //     singleDatePicker: true,
            //     calender_style: "picker_2"
            // }, function (start, end, label) {
            //     console.log(start.toISOString(), end.toISOString(), label);
            // });
            // $('#single_cal3').daterangepicker({
            //     singleDatePicker: true,
            //     calender_style: "picker_3"
            // }, function (start, end, label) {
            //     console.log(start.toISOString(), end.toISOString(), label);
            // });
            // $('#single_cal4').daterangepicker({
            //     singleDatePicker: true,
            //     calender_style: "picker_4"
            // }, function (start, end, label) {
            //     console.log(start.toISOString(), end.toISOString(), label);
            // });
        });
   
    </script>
	<script type="text/javascript" charset="utf8" src="<?=base_url()?>admin_assets/js/jquery.dataTables.js"></script>
	<script type="text/javascript" charset="utf8" src="<?=base_url()?>admin_assets/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" charset="utf8" src="<?=base_url()?>admin_assets/js/buttons.html5.min.js"></script>
	<script type="text/javascript" charset="utf8" src="<?=base_url()?>admin_assets/js/buttons.print.min.js"></script> 
</body> 
</html>
