<?php include('header.php');?>
<style>
    .punch-out-btn:hover{
    
    color: white !important;
    background: #0074d9 !important;


}

.dataTables_paginate {
    float: right;
    text-align: right;
    margin: 20px 0 18px 10px !important;
}
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Attendance List
                </h3>
            </div>

            <!-- <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  
                </div>
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
                        <table id="example_2" class="table table-striped responsive-utilities jambo_table" style="width:100%;">
                            <thead>
                                <tr class="headings">
                                    <th>Sr. No.</th>
                                    <th>Empolyee</th>
                                    <th>Date</th>
                                    <th>Shift</th>
                                    <th>Punch In</th>
                                    <th>Punch Out</th>
                                    <th>Shift In</th>
                                    <th>Shift Out</th>
                                    <th>Break</th>
                                    <th>Overtime</th>
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
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" id="order_details_dialog" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="display: flex; justify-content: space-between; align-items: center;">
                        <span>Set Punch Out</span>
                    </h5> 
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="float:none !important; position:absolute;right:10px;top:10px;"  onclick="closePopup('myModal')">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="booking_details_response"></div>
            </div>
        </div>
    </div>
    <?php include('footer.php');?>


<script>
    $(document).ready(function() {
        $( ".custom_date" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "dd-mm-yy",
            minDate: "-10y",
            maxDate: "+10y"
        });
        $(".choosen").chosen({
            no_results_text: "Oops, nothing found!"
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
        var table = $('#example_2').DataTable({
            "responsive":true,
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
                        columns: [0,1,2,3,4,5,6],
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
                "url" : "<?=base_url();?>salon/Ajax_controller/get_employee_attendance_list_ajx",
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
$('#example').DataTable({ 
dom: 'Blfrtip',
responsive: true,
lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
 
    buttons: [
        
       
        {
            extend: 'excel',
            filename: 'salon-attendance-list',
            exportOptions: {
                columns: [0,1,2,3,4] 
            }
        },
       
        
        
    ], 
});
function setPunchOut(id){
    $.ajax({
        url: "<?= base_url(); ?>salon/Ajax_controller/set_employee_attendance_ajx",
        method: 'POST',
        data: { attendance_id: id },
        success: function(response) {
            $('#booking_details_response').html(response)
            showPopup('myModal');
        },
        error: function(xhr, status, error) {
            console.error('Error fetching booking details:', error);
            alert("Error fetching booking details");
        }
    });
}
function showPopup(id){
    var exampleModal = $('#'+id);
    exampleModal.css('display','block');
    exampleModal.css('opacity','1');
    $('.modal-open').css('overflow','auto').css('padding-right','0px'); 
}
function closePopup(id){
    var exampleModal = $('#'+id);

    exampleModal.css('display','none');
    exampleModal.css('opacity','0');
    $('.modal-open').css('overflow','auto').css('padding-right','0px');
}
</script>
<script>
      $(document).ready(function () {
			$('#employee .child_menu').show();
			$('#employee').addClass('nv active');
			// $('.right_col').addClass('active_right');
			$('.cc_salon_attendance_list').addClass('active_cc');
		});
</script>