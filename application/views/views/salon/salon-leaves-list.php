<?php include('header.php');?>
<style>
    .dt-button .buttons-excel .buttons-html5{
  height: 42px !important;
}
div.dataTables_wrapper div.dataTables_filter {
    top: 0;}
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Employee Leaves
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
                        <table id="example" class="table table-striped responsive-utilities jambo_table" style="width:100%;">
                            <thead>
                                <tr class="headings">
                                    <th>Sr. No.</th>
                                    <th>Empolyee</th>
                                    <th>From Date</th>
                                    <th>To Date</th>
                                    <th>Days</th>
                                    <th>Reason</th>
                                    <th>Applied On</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i=1;
                                    if(!empty($leaves)){
                                        foreach($leaves as $leaves_result){
                                ?>
                                <tr>
                                    <td><?=$i++;?></td>
                                    <td><?=$leaves_result->full_name;?></td>
                                    <td><?=date('d-m-Y',strtotime($leaves_result->from_date));?></td>
                                    <td><?=date('d-m-Y',strtotime($leaves_result->to_date));?></td>
                                    <td><?=$leaves_result->days;?></td>
                                    <td><?=$leaves_result->reason;?></td>
                                    <td><?=date('d-m-Y h:i A',strtotime($leaves_result->leave_submitted_on));?></td>
                                </tr>
                                <?php }} ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer.php');?>


<script>
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
</script>
<script>
    $(document).ready(function() {
        $('#attendance .child_menu').show();
        $('#attendance').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.weekly_off_list').addClass('active_cc');
    });
</script>