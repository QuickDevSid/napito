<?php include('header.php');?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">

             <h3>   <?php if(!empty($student_name)){
                    
                    echo $student_name->student_name;?> Payments
                    <?php } ?>
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
                                    <th>
                                        Sr.No
                                    </th>
                                    <th>Course</th>
                                    <th>Total Fees</th>
                                    <th>Paid Amount</th>
                                    <th>Pending Fees</th>
                                    <th>Payment Date</th>
                                    <th>Mode</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php if(!empty($student_fees)){
                                    $i=1;
                                        foreach($student_fees as $student_fees_result){
                                ?>
                                <tr>
                                    <td><?=$i++?></td>
                                    <td><?=$student_fees_result->course_enrolled?></td>
                                    <td><?=$student_fees_result->total_fees?></td>
                                    <td><?=$student_fees_result->amount_to_paid?></td>
                                    <td><?=$student_fees_result->total_pending_fees?></td>
                                    <td><?=date('d/m/Y',strtotime($student_fees_result->date));?></td>
                                    <td>
                                        <?php
                                            if($student_fees_result->payment_mode == '1'){
                                                echo 'UPI';
                                            }elseif($student_fees_result->payment_mode == '2'){
                                                echo 'Cash';
                                            }elseif($student_fees_result->payment_mode == '3'){
                                                echo 'Cheque';
                                            }elseif($student_fees_result->payment_mode == '4'){
                                                echo 'Online';
                                            }else{
                                                echo '-';
                                            }
                                        ?>
                                    </td>
                                </tr>
                            <?php }}?>

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

            <br />
            <br />
            <br />

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
            filename: 'offer-list',
            exportOptions: {
                columns: [0,1,2,3,4] 
            }
        }
       
        
    ], 
});
</script>
<script>
    $(document).ready(function() {
        $('#back-office .child_menu').show();
        $('#back-office').addClass('nv active');
        $('.right_col').addClass('active_right');
        $('.student_list').addClass('active_cc');
    });
</script>