<?php include('header.php');?>

<style>
    table.dataTable{
        width: 100% !important;
    }
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left" style="width:100%;">
                <h3 style="width:100%;">
                    Reminders List <a style="float:right;" class="btn btn-primary" href="<?=base_url();?>add-reminder-form">Add Reminder</a>
                </h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                    
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                    <table id="example" class="table table-striped responsive-utilities jambo_table">
                    <thead>
                    <tr>
                        <th style="">Sr. No.</th>
                        <th style="">Date</th>
                        <th style="">Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i = 1;
                        if(!empty($result)){
                            foreach($result as $data){
                    ?>  
                    <tr>
                        <td><?=$i++;?></td>
                        <td><?=date('d-m-Y',strtotime($data->reminder_date));?></td>
                        <td><?=$data->description;?></td>
                    </tr>
                    <?php }}else{ ?>
                        <tr>
                            <td colspan="3" style="text-align:center;">No Data Available</td>
                        </tr>
                    <?php } ?>
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
// responsive: false,
        // scrollX:300,
lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
 
    buttons: [
        
       
        {
            extend: 'excel',
            filename: 'salon-salary-list',
            exportOptions: {
                columns: [0,1,2] 
            }
        },
       
        
        
    ], 
});
</script>
<script>
      $(document).ready(function () {
			$('#employee .child_menu').show();
			$('#employee').addClass('nv active');
			// $('.right_col').addClass('active_right');
			$('.cc_salon_salary_list').addClass('active_cc');
		});
</script>