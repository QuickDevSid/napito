<?php include('header.php');?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Attendance List
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
                                <tr class="headings">
                                    <th>Sr. No.</th>
                                    <th>Empolyee Name</th>
                                    <th>Date</th>
                                    <th>Attendance Type</th>
                                    <th>Created On</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php 
                                if(!empty($list)){
                                    $i=1;
                                        foreach($list as $salary_list_result){                                    
                                            if ($salary_list_result->attendence_type == '1') {
                                                $type = 'Present';
                                                $badge_class = 'label label-success';
                                            } elseif ($salary_list_result->attendence_type == '2') {
                                                $type = 'Absent';
                                                $badge_class = 'label label-danger';
                                            } elseif ($salary_list_result->attendence_type == '3') {
                                                $type = 'Half Day';
                                                $badge_class = 'label label-warning';
                                            } else {
                                                $type = '';
                                                $badge_class = '';
                                            }
                                ?>
                                <tr>
                                    <th scope="row"><?=$i++?></th>
                                    <td><?=$salary_list_result->full_name?></td>
                                    <td><?=date('d-m-Y',strtotime($salary_list_result->att_date));?></td>
                                    <td><?php if($type != ""){ ?><label class="<?=$badge_class;?>"><?= $type; ?></label><?php } else{ ?>-<?php } ?></td>
                                    <td><?=date('d-m-Y h:i A',strtotime($salary_list_result->created_on));?></td> 
                                </tr>
                            <?php }}?>

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
responsive: false,
lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
 
    buttons: [
        
       
        {
            extend: 'excel',
            filename: 'salon-salary-list',
            exportOptions: {
                columns: [0,1,2,3,4] 
            }
        },
       
        
        
    ], 
});
</script>